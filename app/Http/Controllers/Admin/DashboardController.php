<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Founder;
use App\Models\Home;
use App\Models\Volunteer;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $volunteersCount = Volunteer::count();
        $foundersCount = Founder::count();
        $homesCount = Home::count();

        return view('admin.dashboard', [
            'volunteersCount' => $volunteersCount,
            'foundersCount' => $foundersCount,
            'homesCount' => $homesCount,
        ]);
    }
}
