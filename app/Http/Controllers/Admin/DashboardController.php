<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where("status", "active")->count();
        $inactiveUsers = User::where("status", "inactive")->count();
        $totalScans = Scan::count();

        return view('Admin.Dashboard.dashboard', compact('totalUsers', 'activeUsers', 'inactiveUsers', 'totalScans'));
    }

}
