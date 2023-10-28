<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    public function index()
    {
        /*　$attendances = Attendance::all();　*/
        return view('attendance');/*, ['attendance' => $attendances]);*/
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showAttendance()
    {
        $attendances = Attendance::with('user')->paginate(5);
        // 現在の日付を使用して前日と次日の日付を計算
    $date = date('Y-m-d');
    $prevDate = date('Y-m-d', strtotime($date . ' -1 day'));
    $nextDate = date('Y-m-d', strtotime($date . ' +1 day'));
        return view('attendance', ['attendances' => $attendances]);
    }

    public function show($date)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('clock_in', $date)
            ->first();

        // 前日と次日の日付を計算
        $prevDate = date('Y-m-d', strtotime($date . ' -1 day'));
        $nextDate = date('Y-m-d', strtotime($date . ' +1 day'));

        // 勤怠データと日付をViewに渡す
        return view('attendance', [
            'attendance' => $attendance,
            'date' => $date,
            'prevDate' => $prevDate,
            'nextDate' => $nextDate,
        ]);
    }

    public function userAttendance($id)
    {
        $attendances = Attendance::filterByUser($id)->paginate(5);
        $users = User::all();
        return view('user_attendance', ['attendances' => $attendances, 'users' => $users]);
    }

}
