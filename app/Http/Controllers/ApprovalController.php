<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LendingRequest;
use App\Models\Approval;
use App\Models\Equipment;
use Illuminate\Routing\Controller;

class ApprovalController extends Controller
{
    // 1. Show all Pending Requests
    public function index()
    {
        // SQL: SELECT * FROM LendingRequest WHERE Status = 'Pending'
        $pendingRequests = LendingRequest::with(['borrower', 'equipment'])
                            ->where('Status', 'Pending')
                            ->get();

        return view('approvals', compact('pendingRequests'));
    }

    // 2. Approve a Request
    public function approve($id)
    {
        $request = LendingRequest::findOrFail($id);

        // A. Log the Approval (Matches your PDF SQL Task 2, Item 3)
        Approval::create([
            'RequestID' => $id,
            'ApproverID' => auth()->id(),
            'Decision' => 'Approved',
            'ApprovalDate' => now(),
        ]);

        // B. Update Request Status to 'Approved'
        $request->Status = 'Approved';
        $request->save();

        // C. Update Equipment Status to 'Borrowed' (Red Badge)
        $equipment = Equipment::findOrFail($request->EquipmentID);
        $equipment->AvailabilityStatus = 'Borrowed';
        $equipment->save();

        return redirect()->back()->with('success', 'Request Approved!');
    }

    // 3. Decline a Request
    public function decline($id)
    {
        $request = LendingRequest::findOrFail($id);

        // Update Request Status
        $request->Status = 'Declined';
        $request->save();

        // Set Equipment back to 'Available'
        $equipment = Equipment::findOrFail($request->EquipmentID);
        $equipment->AvailabilityStatus = 'Available';
        $equipment->save();

        return redirect()->back()->with('error', 'Request Declined.');
    }

    // 4. Show Active Loans (Items currently borrowed)
    public function showActiveLoans()
    {
        // Get requests where Status is 'Approved' (meaning they have the item)
        $activeLoans = LendingRequest::with(['borrower', 'equipment'])
                        ->where('Status', 'Approved')
                        ->get();

        return view('returns', compact('activeLoans'));
    }

    // 5. Process Return & Penalty
    public function processReturn(Request $request, $id)
    {
        $loan = LendingRequest::findOrFail($id);
        
        // A. Create Penalty Record (If amount is entered)
        if ($request->penalty_amount > 0) {
            \App\Models\Penalty::create([
                'RequestID' => $id,
                'Amount' => $request->penalty_amount,
                'Reason' => $request->penalty_reason ?? 'Late/Damaged',
                'DateIssued' => now()
            ]);
        }

        // B. Update Request Status to 'Returned'
        $loan->Status = 'Returned';
        $loan->save();

        // C. Make Equipment Available again
        $equipment = Equipment::findOrFail($loan->EquipmentID);
        $equipment->AvailabilityStatus = 'Available';
        $equipment->save();

        return redirect()->back()->with('success', 'Equipment returned successfully.');
    }

    // NEW: Security Check
    public function __construct()
    {
        // If the user is NOT an approver, kick them out
        if (auth()->check() && auth()->user()->role !== 'approver') {
            abort(403, 'Unauthorized action. Admins only.');
        }
    }

    public function showHistory()
    {
        // Get requests that are 'Returned' or 'Declined'
        $history = LendingRequest::with(['borrower', 'equipment'])
                    ->whereIn('Status', ['Returned', 'Declined'])
                    ->get();
                    
        // Get all penalties
        $penalties = \App\Models\Penalty::with(['request.borrower'])
                    ->get();

        return view('history', compact('history', 'penalties'));
    }
}