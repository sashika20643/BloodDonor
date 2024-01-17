<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonorHistory;
use App\Models\User;


class DonorHistoryController extends Controller
{
    public function index($userId = null)
    {
        // If a specific user ID is provided, filter by that user; otherwise, use the authenticated user
        $user = ($userId) ? User::find($userId) : auth()->user();

        if (!$user) {
            abort(404); // Handle the case where the user is not found
        }

        $donorHistory = DonorHistory::where('user_id', $user->id)
            ->with(['user', 'bloodCamp'])
            ->get();

        return view('Dashboard.Doctor.donorhistory', compact('donorHistory', 'user'));
    }
}
