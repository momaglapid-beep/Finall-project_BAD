<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use Illuminate\Routing\Controller;

class EquipmentController extends Controller
{
    // Security: Kick out non-admins
    public function __construct()
    {
        if (auth()->check() && auth()->user()->role !== 'approver') {
            abort(403, 'Unauthorized');
        }
    }

    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'Name' => 'required',
            'Category' => 'required',
            'Condition' => 'required',
        ]);

        // Create
        Equipment::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Equipment added successfully!');
    }

    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Equipment updated!');
    }

    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);

        // Check for active loans before deleting
        $activeLoans = \App\Models\LendingRequest::where('EquipmentID', $id)
                        ->whereIn('Status', ['Pending', 'Approved'])
                        ->exists();

        if ($activeLoans) {
            return back()->with('error', 'Cannot delete: Item is currently being borrowed.');
        }

        $equipment->delete();
        return redirect()->route('dashboard')->with('success', 'Equipment deleted.');
    }
}