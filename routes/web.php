<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FounderController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\ProfileController;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/sample', function () {
    return view('sample');
});

// Public About Us page with volunteer registration
Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::post('/aboutus', function (Request $request) {
    $validated = $request->validate([
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|email|unique:volunteers,email|max:255',
        'phone_number' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20',
    ]);

    Volunteer::create($validated);

    return redirect()->back()->with('success', 'Thank you for registering as a volunteer!');
});

Route::get('/ancestralhomes', function () {
    return view('ancestralhomes');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/getinvolved', function () {
    return view('getinvolved');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Volunteers
    Route::get('volunteers/deleted', [VolunteerController::class, 'showDeleted'])->name('volunteers.deleted');
    Route::get('volunteers', [VolunteerController::class, 'index'])->name('volunteers.index');
    Route::get('volunteers/create', [VolunteerController::class, 'create'])->name('volunteers.create');
    Route::post('volunteers', [VolunteerController::class, 'store'])->name('volunteers.store');
    Route::get('volunteers/{volunteer}', [VolunteerController::class, 'show'])->name('volunteers.show');
    Route::get('volunteers/{volunteer}/edit', [VolunteerController::class, 'edit'])->name('volunteers.edit');
    Route::put('volunteers/{volunteer}', [VolunteerController::class, 'update'])->name('volunteers.update');
    Route::delete('volunteers/{volunteer}', [VolunteerController::class, 'destroy'])->name('volunteers.destroy');
    Route::post('volunteers/{id}/restore', [VolunteerController::class, 'restore'])->name('volunteers.restore');
    Route::delete('volunteers/{id}/force', [VolunteerController::class, 'forceDelete'])->name('volunteers.force-delete');

    // Founders
    Route::get('founders/deleted', [FounderController::class, 'showDeleted'])->name('founders.deleted');
    Route::get('founders', [FounderController::class, 'index'])->name('founders.index');
    Route::get('founders/create', [FounderController::class, 'create'])->name('founders.create');
    Route::post('founders', [FounderController::class, 'store'])->name('founders.store');
    Route::get('founders/{founder}', [FounderController::class, 'show'])->name('founders.show');
    Route::get('founders/{founder}/edit', [FounderController::class, 'edit'])->name('founders.edit');
    Route::put('founders/{founder}', [FounderController::class, 'update'])->name('founders.update');
    Route::delete('founders/{founder}', [FounderController::class, 'destroy'])->name('founders.destroy');
    Route::post('founders/{id}/restore', [FounderController::class, 'restore'])->name('founders.restore');
    Route::delete('founders/{id}/force', [FounderController::class, 'forceDelete'])->name('founders.force-delete');

    // Homes
    Route::get('homes/deleted', [HomeController::class, 'showDeleted'])->name('homes.deleted');
    Route::get('homes', [HomeController::class, 'index'])->name('homes.index');
    Route::get('homes/create', [HomeController::class, 'create'])->name('homes.create');
    Route::post('homes', [HomeController::class, 'store'])->name('homes.store');
    Route::get('homes/{home}', [HomeController::class, 'show'])->name('homes.show');
    Route::get('homes/{home}/edit', [HomeController::class, 'edit'])->name('homes.edit');
    Route::put('homes/{home}', [HomeController::class, 'update'])->name('homes.update');
    Route::delete('homes/{home}', [HomeController::class, 'destroy'])->name('homes.destroy');
    Route::post('homes/{id}/restore', [HomeController::class, 'restore'])->name('homes.restore');
    Route::delete('homes/{id}/force', [HomeController::class, 'forceDelete'])->name('homes.force-delete');
});

require __DIR__.'/auth.php';
