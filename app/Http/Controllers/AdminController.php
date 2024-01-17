<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\BloodBank;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create()
    {
        $hospitals = Hospital::all();
        return view('Dashboard.Admin.index',compact('hospitals'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:Donor,Hospital,Doctor,Bank',
        'phone' => 'required|numeric',
        'address' => 'required',
        'category' => 'required_if:role,Hospital|in:Private,Government,Ayurved',
        'hospital_id' => 'required_if:role,Doctor|exists:hospitals,id',
    ]);


    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'role' => $request->input('role'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        // Add more common fields as needed
    ]);

    // Handle role-specific details
    switch ($request->input('role')) {
        case 'Doctor':
            // Create a doctor record
            $user->doctor()->create([
                'hospital_id' => $request->input('hospital_id'),
                // Add more doctor-specific fields as needed
            ]);
            break;
        case 'Hospital':
            // Create a hospital record
            $user->hospital()->create([
                'category' => $request->input('category'),
                // Add more hospital-specific fields as needed
            ]);
            break;
        case 'BloodBank':
            // Create a blood bank record
            $user->bloodBank()->create([
                // Add blood bank-specific fields as needed
            ]);
            break;
        // Add more cases for other roles as needed
    }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'User added successfully');
}
}
