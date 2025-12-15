<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;       // <--- Check this
use App\Models\LendingRequest;  // <--- Check this
use Illuminate\Routing\Controller; 

class LendingController extends Controller
{
    // 1. Show the "Fill out Request" form
    public function showBorrowForm($id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('borrow', compact('equipment'));
    }

    // 2. Process the Request (Save to Database)
    public function submitRequest(Request $request, $id)
{
    $request->validate([
        'purpose' => 'required',
        'return_date' => 'required|date|after:today',
    ]);

    // 1. Create the Lending Request
    LendingRequest::create([
        'BorrowerID' => auth()->id(),
        'EquipmentID' => $id,
        'Purpose' => $request->purpose,
        'DesiredReturnDate' => $request->return_date,
        'RequestDate' => now(),
        'Status' => 'Pending'
    ]);

    // 2. UPDATE EQUIPMENT STATUS (This makes it turn Yellow)
    $equipment = Equipment::findOrFail($id);
    $equipment->AvailabilityStatus = 'Pending'; // <--- NEW LINE
    $equipment->save();                         // <--- NEW LINE

    return redirect()->route('dashboard');
}
}