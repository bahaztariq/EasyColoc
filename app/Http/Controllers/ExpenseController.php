<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Payment; 

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $user = auth()->user();
        $colocation = $user->colocation;

        if (!$colocation) {
            return redirect()->back()->with('error', 'You must be part of a colocation to add an expense.');
        }

        $expense = Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'expense_date' => $request->date,
            'payerid' => $user->id,
            'colocation_id' => $colocation->id,
        ]);

        $members = $colocation->members;
        $memberCount = $members->count();

        if ($memberCount > 1) {
            $share = $expense->amount / $memberCount;

            foreach ($members as $member) {
                if ($member->id === $user->id) {
                    continue;
                }

                Payment::create([
                    'expense_id' => $expense->id,
                    'payer_id' => $member->id,
                    'payee_id' => $user->id,
                    'amount' => $share,
                    'status' => 'pending',
                ]);
            }
        }

        return redirect()->route('colocation.index')->with('success', 'Expense added and split successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
