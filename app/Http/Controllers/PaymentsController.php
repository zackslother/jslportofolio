<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Projects;
use App\Models\User;
use App\Http\Requests\StorePaymentRequest;
use Illuminate\Support\Str;

class PaymentsController extends Controller
{
    /**
     * Display checkout page for a project
     */
    public function showByProject(Projects $project)
    {
        return view('payments.checkout', [
            'project' => $project,
            'title' => 'Checkout - ' . $project->judul_project,
        ]);
    }

    /**
     * Store payment submission 
     */
    public function paymentByProject(StorePaymentRequest $request, Projects $project)
    {
        $currentSessionId = session()->getId();
        
        // Check if this session already has a pending/paid payment for this project
        $existingPayment = Payment::where('session_id', $currentSessionId)
            ->where('project_id', $project->id)
            ->whereIn('status', ['pending', 'paid'])
            ->first();
        
        if ($existingPayment) {
            return redirect()->back()
                ->with('error', 'You have already submitted a payment for this project. Please wait for approval.')
                ->withInput();
        }
        
        // // Also check by email to prevent same user with different sessions
        // $existingPaymentByEmail = Payment::where('customer_email', $request->customer_email)
        //     ->where('project_id', $project->id)
        //     ->whereIn('status', ['pending', 'paid'])
        //     ->first();
        
        // if ($existingPaymentByEmail) {
        //     return redirect()->back()
        //         ->with('error', 'A payment for this project already exists with your email address.')
        //         ->withInput();
        // }

        // Create payment record
        $user = User::firstOrCreate
        (
            ['session_id' => $currentSessionId],
            [
                'name' => $request->customer_name,
                'email' => $request->customer_email,
            ]
        );

        // Create payment with user_id
        Payment::create([
            'order_id' => 'ORD-' . strtoupper(Str::random(10)),
            'user_id' => $user->id, 
            'project_id' => $project->id,
            'session_id' => $currentSessionId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'amount' => $project->project_price,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.success')
            ->with('success', 'Payment submitted! We will review your payment shortly.');
    }

    /**
     * Success page after payment submission
     */
    public function success()
    {
        return view('payments.success', [
            'title' => 'Payment Submitted',
        ]);
    }
}