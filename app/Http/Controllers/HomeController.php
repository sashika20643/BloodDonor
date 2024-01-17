<?php

namespace App\Http\Controllers;

use App\Models\BloodCamp;
use App\Models\DonorHistory;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Auth;
use App\Models\Blood_camp_requests;
use App\Models\Doctor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role=="Doctor"){

            $doctor = auth()->user()->doctor;
            $bloodCampRequests = $doctor->Blood_camp_requests->where('status','pending');

            return view('Dashboard.doctor.show_requests', compact('bloodCampRequests'));
        }
        else if(Auth::user()->role=="Bank")
        {
            $bloodDonationCamps = BloodCamp::all();
            return view('dashboard.blood_bank.index', compact('bloodDonationCamps'));


        }
        else if(Auth::user()->role=="Donor"){
            $donorHistory = DonorHistory::where('user_id', auth()->id())
            ->with(['user', 'bloodCamp'])
            ->get();


            return view('Dashboard.Donor.index', compact('donorHistory'));
        }
        else if(Auth::user()->role=="Admin"){
        $hospitals = Hospital::all();
        return view('Dashboard.Admin.index',compact('hospitals'));
        }
        else{
            return view('home');

        }

    }
}
