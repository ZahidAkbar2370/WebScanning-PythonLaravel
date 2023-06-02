<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ScanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $targetUrl = $_GET["type"];
        return view("scan", compact('targetUrl'));
    }

    public function scan(Request $request)
    {
        $request->validate([
            "url" => "required",
            "type" => "required"
        ]);

        $createScan = Scan::create([
            "user_name" => Auth::user()->name ?? "Unknown",
            "user_email" => Auth::user()->email ?? "example@gmail.com",
            "website_url" => $request->url,
            "type" => $request->type

        ]);

            $targetUrl = $request->type;
            $response = Http::post('http://127.0.0.1:5000/'.$targetUrl, [
                'url' => $request->url,
            ]);
            $url = $request->url;
    
            $urlScanning = json_decode($response);

            return view("scan", compact('urlScanning', 'url', 'targetUrl'));
    }
}
