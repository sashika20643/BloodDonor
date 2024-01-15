<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodDonationCampController;


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
    return view('welcome');
});
route::get('/admin/dash',[AdminController::class,'create'])->name('admin.users.create');
route::post('/admin/dash/store',[AdminController::class,'store'])->name('admin.users.store');


Route::get('/dash', function () {
    return view('Dashboard.index');
});



Route::middleware(['auth', 'is_blood_bank'])->group(function () {
    Route::prefix('dashboard/blood_bank')->group(function () {
        Route::resource('blood_donation_camps', BloodDonationCampController::class);
    });
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
