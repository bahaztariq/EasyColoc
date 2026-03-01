<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Colocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the main test user
        $owner = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. Create the colocation
        $colocation = Colocation::factory()->create([
            'name' => 'The Dream Team Coloc',
            'owner_id' => $owner->id,
        ]);

        // 3. Assign the owner via memberships
        $owner->colocations()->attach($colocation->id, ['role' => 'owner']);

        // 4. Create more members
        $members = [
            ['name' => 'Alice Smith', 'email' => 'alice@example.com'],
            ['name' => 'Bob Jones', 'email' => 'bob@example.com'],
        ];

        foreach ($members as $memberData) {
            $user = User::factory()->create($memberData);
            $user->colocations()->attach($colocation->id, ['role' => 'member']);
        }

        // 5. Create some random members
        User::factory(2)->create()->each(function ($user) use ($colocation) {
            $user->colocations()->attach($colocation->id, ['role' => 'member']);
        });
        
        $this->command->info('Colocation created with Test User (Owner), Alice, and Bob!');
    }
}
