<?php

namespace App\Http\Controllers;
use App\Models\BloodCampDonor;

use Illuminate\Http\Request;

class BloodCampDonorController extends Controller
{
    public function update(Request $request, BloodCampDonor $blood_camp_donor)
{
    $request->validate([
        'status' => 'required|in:donated,pending,cancelled',
    ]);

    $blood_camp_donor->update(['status' => $request->status]);

    return redirect()->back();
}
}
