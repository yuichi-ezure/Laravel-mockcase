<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Http\Requests\LoginRequest;


class AuthenticatedSessionController extends Controller
{
    //
    public function store(Request $request)
    {
        $login = $request->only(['email', 'password']);
        return view('login', ['login' => $login]);
    } //

    public function destroy()
    {
        return view();
    }
}


