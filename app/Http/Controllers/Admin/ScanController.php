<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $scans = Scan::all();

        return view("Admin.Scan.scans", compact('scans'));
    }

    public function destory($id)
    {
        Scan::find($id)->delete();

        Session::flash("message", "Scan History Record Deleted");
        return redirect()->back();
    }

}
