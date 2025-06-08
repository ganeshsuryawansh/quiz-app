<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function login(Request $request)
    {
        $validation = $request->validate(
            [
                "name" => "required",
                "password" => "required"
            ]
        );

        $admin = admin::where(
            ['name' => $request->name, 'password' => $request->password]
        )->first();

        if (!$admin) {
            $validation = $request->validate(
                [
                    "user" => "required"
                ],
                [
                    "user.required" => "User does not Exists!"
                ]
            );
        }

        Session::put('admin', $admin);
        return redirect('dashboard');
    }


    function dashboard()
    {
        $admin = Session::get('admin');

        if ($admin) {
            return view('admin', ['name' => $admin->name]);
        } else {
            return redirect('admin-login');
        }
    }
}
