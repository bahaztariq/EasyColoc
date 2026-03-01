<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\Membership;
use App\Models\User;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseSplittingTest extends TestCase
{
    use RefreshDatabase;

    public function test_expense_is_split_between_members()
    {
        // 1. Setup: Colocation with 3 members
        $owner = User::factory()->create();
        $colocation = Colocation::factory()->create(['owner_id' => $owner->id]);
        
        $owner->colocations()->attach($colocation->id, ['role' => 'owner']);

        $member1 = User::factory()->create();
        $member1->colocations()->attach($colocation->id, ['role' => 'member']);

        $member2 = User::factory()->create();
        $member2->colocations()->attach($colocation->id, ['role' => 'member']);

        $category = Category::factory()->create();

        // 2. Action: Create an expense of 90
        $response = $this->actingAs($owner)->post(route('expenses.store'), [
            'title' => 'Groceries',
            'amount' => 90,
            'category_id' => $category->id,
            'date' => now()->format('Y-m-d'),
        ]);

        $response->assertRedirect();
        
        // 3. Verification: Expense created
        $this->assertDatabaseHas('expenses', [
            'title' => 'Groceries',
            'amount' => 90,
            'payerid' => $owner->id,
        ]);

        $expense = Expense::first();

        // 4. Verification: 2 payments of 30 each created for others
        $this->assertDatabaseCount('payments', 2);
        
        $this->assertDatabaseHas('payments', [
            'expense_id' => $expense->id,
            'payer_id' => $member1->id,
            'payee_id' => $owner->id,
            'amount' => 30,
            'status' => 'pending',
        ]);

        $this->assertDatabaseHas('payments', [
            'expense_id' => $expense->id,
            'payer_id' => $member2->id,
            'payee_id' => $owner->id,
            'amount' => 30,
            'status' => 'pending',
        ]);
        
        // Ensure owner doesn't owe themselves
        $this->assertDatabaseMissing('payments', [
            'payer_id' => $owner->id,
        ]);
    }
}
