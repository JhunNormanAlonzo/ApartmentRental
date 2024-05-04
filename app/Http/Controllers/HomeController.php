<?php

namespace App\Http\Controllers;

use App\Enum\AvailabilityEnum;
use App\Models\Ledger;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Http\Request;

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
        $countRooms = Room::count();
        $countTenants = Tenant::count();
        $countOccupiedRoom = Room::where('availability', AvailabilityEnum::AVAILABLE)->count();
        $recentActivities = Ledger::with('tenant')->latest()->limit(5)->get();

        return view('home', compact(['countRooms', 'countTenants', 'countOccupiedRoom', 'recentActivities']));
    }
}
