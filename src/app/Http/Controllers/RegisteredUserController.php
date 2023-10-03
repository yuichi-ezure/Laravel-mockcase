<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Http\Requests\RegisterRequest;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        $register = $request->only(['name', 'email', 'password']);
        return view('register', ['register' => $register]);//
    }

    public function store(Request $request)
    {
        //
    }

}