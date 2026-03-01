<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
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

    public function settle(Request $request)
    {
        $request->validate([
            'debtor_id' => 'required|exists:users,id',
            'creditor_id' => 'required|exists:users,id',
        ]);

        $debtor = auth()->user();
        $debtorId = $request->debtor_id;
        $creditorId = $request->creditor_id;

        // Security: Ensure the person clicking is the debtor
        if ($debtor->id != $debtorId) {
            return redirect()->back()->with('error', 'You are not authorized to settle this debt.');
        }

        // Mark all pending payments from the debtor to the creditor as completed
        Payment::where('payer_id', $debtorId)
            ->where('payee_id', $creditorId)
            ->where('status', 'pending')
            ->update([
                'status' => 'completed',
                'paid_at' => now(),
            ]);

        // Hand over offsetting logic remains (clearing any pending inverse debts)
        Payment::where('payer_id', $creditorId)
            ->where('payee_id', $debtorId)
            ->where('status', 'pending')
            ->update([
                'status' => 'completed',
                'paid_at' => now(),
            ]);

        return redirect()->back()->with('success', 'You have marked the debt as paid!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
