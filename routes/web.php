<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodDonationCampController;

use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\BloodCampDonorController;
use App\Http\Controllers\DonorHistoryController;




use App\Models\BloodCamp;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $activeBloodCamps = BloodCamp::where('status', 'Active')->get();
    $pendingBloodCamps = BloodCamp::where('status', 'Pending')->get();
    $completedBloodCamps = BloodCamp::where('status', 'Completed')->get();
    return view('welcome',compact('activeBloodCamps', 'pendingBloodCamps', 'completedBloodCamps'));
});
route::get('/admin/dash',[AdminController::class,'create'])->name('admin.users.create')->middleware(['auth','is_Admin']);
route::post('/admin/dash/store',[AdminController::class,'store'])->name('admin.users.store')->middleware(['auth','is_Admin']);
route::get('/blood_camps/{id}',[BloodDonationCampController::class,'show'])->name('blood_camps.show');
// route::post('/blood_camps/{id}',[BloodCampRequestController::class,'create'])->name('blood_camp_requests.create')->middleware(['auth']);
route::post('/blood_request/{bloodCampId}/create',[BloodRequestController::class,'create'])->middleware(['auth','is_Donor'])->name('blood_camp_requests.create');


Route::get('/dash', function () {

    return view('Dashboard.index',);
});



Route::middleware(['auth', 'is_blood_bank'])->group(function () {
    Route::prefix('dashboard/blood_bank')->group(function () {
        Route::resource('blood_donation_camps', BloodDonationCampController::class);
        Route::get('/blood_donation_camps/{id}/showDonors', [BloodDonationCampController::class, 'showDonors'])->name('blood_donation_camps.showDonors');
        Route::put('/blood_camp_donor/{blood_camp_donor}', [BloodCampDonorController::class, 'update'])->name('blood_camp_donor.update');


    });
});

Route::middleware(['auth', 'is_Doctor'])->group(function () {
    Route::prefix('dashboard/Doctor')->group(function () {

        route::get('/',[BloodRequestController::class,'showRequests'])->name('Doctor.requests.show');
        Route::post('/donor_requests/respond/{id}', [BloodRequestController::class,'respondToDonorRequest'])->name('doctors.donor_requests.respond');



    });
});
route::get('/users/{id}',[UserController::class,'show'])->name('users.show');
Route::post('/donor/register', [DonorController::class, 'store'])->name('donor.register');
Route::get('/donor_history/{userId?}', [DonorHistoryController::class, 'index'])->name('donor_history.user');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

