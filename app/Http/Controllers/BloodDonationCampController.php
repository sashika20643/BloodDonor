<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodCamp;
use App\Models\Doctor;
use App\Notifications\BloodDonationCampNotification;
use App\Notifications\NextBloodCampNotification;


class BloodDonationCampController extends Controller
{


    
public function index()
{
    $bloodDonationCamps = BloodCamp::all();
    return view('dashboard.blood_bank.index', compact('bloodDonationCamps'));
}
    public function create()
    {
        $doctors = Doctor::all();

        return view('Dashboard.Blood_bank.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organisation_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'validity' => 'required|date',
            'number_of_donors' => 'required|integer',
            'target_address' => 'required',
            'target_location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Pending,Active,Completed',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('blood_donation_camp_images', $imageName, 'public');
        }

        $bloodDonationCamp = BloodCamp::create([
            'organisation_name' => $request->input('organisation_name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'validity' => $request->input('validity'),
            'number_of_donors' => $request->input('number_of_donors'),
            'target_address' => $request->input('target_address'),
            'target_location' => $request->input('target_location'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'image' => $imagePath,
            'status' => $request->input('status'),
            'doctor_id' => $request->input('doctor_id'),
        ]);

        $doctor = $bloodDonationCamp->doctor; 
        $doctor->user->notify(new BloodDonationCampNotification($bloodDonationCamp));
        $donors = Donor::all(); // Adjust this based on your actual query for donors
        foreach ($donors as $donor) {
            $donor->user->notify(new NextBloodCampNotification($donor));
        }
    

        return redirect()->route('blood_donation_camps.index')->with('success', 'Blood Donation Camp created successfully');
    }



    public function edit($id)
    {
        $bloodDonationCamp = BloodCamp::findOrFail($id);
        $doctors = Doctor::all();
        return view('Blood_bank.edit', compact('bloodDonationCamp','doctors'));
    }

  
    public function update(Request $request, $id)
    {
        $request->validate([
            'organisation_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'validity' => 'required|date',
            'number_of_donors' => 'required|integer',
            'target_address' => 'required',
            'target_location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Pending,Active,Completed',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        $bloodDonationCamp = BloodCamp::findOrFail($id);

        $bloodDonationCamp->update($request->all());

        return redirect()->route('blood_donation_camps.index')->with('success', 'Blood donation camp updated successfully');
    }

    public function destroy($id)
    {
        $bloodDonationCamp = BloodCamp::findOrFail($id);
        $bloodDonationCamp->delete();

        return redirect()->route('blood_donation_camps.index')->with('success', 'Blood donation camp deleted successfully');
    }
}

