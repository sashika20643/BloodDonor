<?php

namespace App\Http\Controllers;
use App\Models\Blood_camp_requests;
use App\Models\BloodCampDonor;



use Illuminate\Http\Request;

class BloodRequestController extends Controller
{
    public function create(Request $request, $bloodCampId)
{
    // Validate the form data

    $request->validate([
        'medical_report' => 'required|max:2048',
    ]);

    // Handle file upload
    $medicalReportPath = $request->file('medical_report')->store('medical_reports', 'public');
    $existingRequest = Blood_camp_requests::where('user_id', auth()->user()->id)
        ->where('blood_camp_id', $bloodCampId)
        ->first();

    if ($existingRequest) {
        return redirect()->back()->with('error', 'You have already sent a request for this blood camp.');
    }
    // Create a new BloodCampRequest
    Blood_camp_requests::create([
        'user_id' => auth()->user()->id,
        'blood_camp_id' => $bloodCampId,
        'medical_report_path' => $medicalReportPath,
    ]);
    return redirect()->back();

}



public function showRequests()
{

    $doctor = auth()->user()->doctor;
    $bloodCampRequests = $doctor->Blood_camp_requests->where('status','pending');

    return view('Dashboard.doctor.show_requests', compact('bloodCampRequests'));
}

public function respondToDonorRequest(Request $request, $id)
{
    $request->validate([
        'response' => 'required|in:accept,reject',
    ]);


    $donorRequest = Blood_camp_requests::find($id);
    $donorRequest->status=($request->response == 'accept') ? 'Accepted' : 'Rejected';

    $donorRequest->save();
    if($request->response=='accept'){
        BloodCampDonor::create([
            'bloodCamp_id' => $donorRequest->bloodCamp->id,
            'request_id' =>$donorRequest->id,
            'user_id' => $donorRequest->user->id,
            'status' => 'pending',
        ]);
    }
    else{

    }

    return(redirect()->back());

    // Add any success message or redirect as needed
}
}
