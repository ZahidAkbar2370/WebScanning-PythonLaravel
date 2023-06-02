<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::whereNotIn("is_admin", ["1"])->with("scans")->get();

        return view("Admin.User.view_users", compact('users'));
    }

    public function create()
    {
        return view('Admin.User.create_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required|min:8",
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        Session::flash("message", "User Created Successfully!");
        return redirect("admin/users");
    }

    public function destory($id)
    {
        User::find($id)->delete();

        Session::flash("message", "User Deleted Successfully!");
        return redirect()->back();
    }

    public function active($id)
    {
        $user = User::find($id);
        $user->status = "active";
        $user->update();

        Session::flash("message", "User Activated Successfully!");
        return redirect()->back();
    }

    public function inactive($id)
    {
        $user = User::find($id);
        $user->status = "inactive";
        $user->update();

        Session::flash("message", "User Inactivated Successfully!");
        return redirect()->back();
    }
}
