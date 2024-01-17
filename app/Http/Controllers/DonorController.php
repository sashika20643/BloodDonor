<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;

class DonorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'blood_group' => 'required',
            'donation_rate' => 'required',
        ]);

        Donor::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $request->only(['blood_group', 'donation_rate'])
        );

        return redirect('/home')->with('success', 'Donor information saved successfully!');
    }
}
