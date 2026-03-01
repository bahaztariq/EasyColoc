<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\UpdateColocationRequest;
use App\Models\Colocation;
use App\Models\User;
use App\Models\Payment;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $colocation = $user->colocation;
        $balances = [];

        if ($colocation) {
            $colocation->load(['currentMembers', 'expenses.payer', 'expenses.category', 'categories']);
            
            $members = $colocation->currentMembers;
            $memberIds = $members->pluck('id')->toArray();
            
            // Calculate net balances between members
            for ($i = 0; $i < count($memberIds); $i++) {
                for ($j = $i + 1; $j < count($memberIds); $j++) {
                    $id1 = $memberIds[$i];
                    $id2 = $memberIds[$j];
                    
                    $owes1to2 = Payment::where('payer_id', $id1)
                        ->where('payee_id', $id2)
                        ->where('status', 'pending')
                        ->sum('amount');
                        
                    $owes2to1 = Payment::where('payer_id', $id2)
                        ->where('payee_id', $id1)
                        ->where('status', 'pending')
                        ->sum('amount');
                        
                    $net = $owes1to2 - $owes2to1;
                    
                    if ($net > 0) {
                        $balances[] = [
                            'debtor' => $members->firstWhere('id', $id1),
                            'creditor' => $members->firstWhere('id', $id2),
                            'amount' => $net
                        ];
                    } elseif ($net < 0) {
                        $balances[] = [
                            'debtor' => $members->firstWhere('id', $id2),
                            'creditor' => $members->firstWhere('id', $id1),
                            'amount' => abs($net)
                        ];
                    }
                }
            }
        }

        return view('colocation', compact('colocation', 'balances'));
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
    public function store(StoreColocationRequest $request)
    {
        $colocation = Colocation::create([
            'name' => $request->name,
            'owner_id' => auth()->id(),
        ]);

        auth()->user()->colocations()->attach($colocation->id, ['role' => 'owner']);

        return redirect()->route('colocation.index')->with('success', 'Colocation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colocation $colocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColocationRequest $request, Colocation $colocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colocation $colocation)
    {
        //
    }

    /**
     * Leave the current colocation.
     */
    public function leave()
    {
        $user = auth()->user();

        if (!$user->colocation_id) {
            return redirect()->route('colocation.index')->with('error', 'You are not in a colocation.');
        }

        $colocation = $user->colocation;

        if ($colocation && $colocation->owner_id === $user->id) {
            return redirect()->route('colocation.index')->with('error', 'As the owner, you cannot leave. Transfer ownership or delete the colocation.');
        }

        if ($user->isDebtor()) {
            $user->decrement('ReputationScore');
        }

        $user->colocations()->updateExistingPivot($colocation->id, ['left_at' => now()]);

        return redirect()->route('colocation.index')->with('success', 'You have left the colocation.');
    }


    public function kick(User $user)
    {
        $currentUser = auth()->user();
        $currentColocation = $currentUser->colocation;

        if (!$currentColocation) {
            return redirect()->route('colocation.index')->with('error', 'You are not in a colocation.');
        }

        if (!$currentColocation->members->contains($user->id)) {
            return redirect()->route('colocation.index')->with('error', 'This user is not in your colocation.');
        }

        if ($currentUser->id === $user->id) {
            return redirect()->route('colocation.index')->with('error', 'You cannot kick yourself.');
        }

        if ($currentUser->id !== $currentColocation->owner_id) {
            return redirect()->route('colocation.index')->with('error', 'Only the owner can kick members.');
        }

        if ($user->isDebtor()) {
            $currentUser->decrement('ReputationScore');
        }

        $user->colocations()->updateExistingPivot($currentUser->colocation->id, ['left_at' => now()]);

        return redirect()->route('colocation.index')->with('success', 'Member has been kicked from the colocation.');
    }
}
