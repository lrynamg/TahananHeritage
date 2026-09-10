<?php

use App\Http\Controllers\FounderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

// Route::get('/aboutus', function () {
//     return view('aboutus');
// });

Route::get('/aboutus', [FounderController::class, 'index']);


Route::get("/ancestralhomes", [HomeController::class, "index"]);
Route::get('/ancestralhomes/{id}', [HomeController::class, 'show']);


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
    Route::get('/admin/homes', function () {
        return view('admin.heritagehomes');
    });

    Route::get('/admin/users', function () {
        return view('admin.users');
    });

    Route::get('/admin/volunteers', function () {
        return view('admin.volunteer');
    });

});

require __DIR__ . '/auth.php';
