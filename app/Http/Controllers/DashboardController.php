<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment; // Import the Model so we can talk to the database
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Get all equipment from the database
        $equipment = Equipment::all();

        // 2. Send the data to the 'dashboard' view
        return view('dashboard', compact('equipment'));
    }
}