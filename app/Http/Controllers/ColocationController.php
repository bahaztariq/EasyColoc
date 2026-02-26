<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\UpdateColocationRequest;
use App\Models\Colocation;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $colocation = $user->colocation;

        if ($colocation) {
            $colocation->load(['members', 'expenses.payer', 'expenses.category', 'categories']);
        }

        return view('colocation', compact('colocation'));
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

        auth()->user()->update(['colocation_id' => $colocation->id]);

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

        $user->update(['colocation_id' => null]);

        return redirect()->route('colocation.index')->with('success', 'You have left the colocation.');
    }
}
