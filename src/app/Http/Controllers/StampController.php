<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rest;
use App\Models\Attendance;

class StampController extends Controller

{
    public function index() {
        return view('stamp');
    }

    public function destroy() {

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    //出退勤管理
    public function clockIn()
    {
        $attendance = Attendance::where('user_id', Auth::id())->whereNull('clock_out')->first();

        if (!$attendance) {
            // 勤怠開始がない場合は、新しいレコードを作成する
            $attendance = new Attendance;
            $attendance->user_id = Auth::id();
            $attendance->clock_in = now();
            $attendance->save();
        }

        return redirect('/');
    }

    public function clockOut()
{
    $attendance = Attendance::where('user_id', Auth::id())->whereNull('clock_out')->latest()->first();

    if (!$attendance) {
        // clock_inが開始されていない場合はエラーメッセージを表示してリダイレクト
        return redirect('/')->with('error', '勤務が開始されていません！');
    }

    if ($attendance) {
        $latestRest = $attendance->rests()->latest()->first();

        if (!$latestRest || $latestRest->break_end) {
            // 休憩が終了しているか、休憩レコードが存在しない場合にのみ勤怠終了を行う
            $attendance->clock_out = now();
            $attendance->save();
        }
    }

    return redirect('/');
}

    public function autoClockOut()
    {
        $attendances = Attendance::whereNull('clock_out')->get();

        foreach ($attendances as $attendance) {
            $attendance->clock_out = now()->setTime(00, 00, 00);
            $attendance->save();

            // Check if the user is on break
            $latestRest = $attendance->rests()->latest()->first();

            if ($latestRest && is_null($latestRest->break_end)) {
                // If the user is on break, end the break
                $latestRest->break_end = now()->setTime(00, 00, 00);
                $latestRest->save();

                // Start a new break
                $newRest = new Rest;
                $newRest->attendance_id = $attendance->id;
                $newRest->break_start = now()->addSecond();
                $newRest->save();
            }

            // Check if a new attendance has already been started
            $newAttendance = Attendance::where('user_id', $attendance->user_id)
                ->whereDate('clock_in', now()->addSecond())
                ->first();

            // If no new attendance has been started, start a new one
            if (!$newAttendance) {
                $newAttendance = new Attendance;
                $newAttendance->user_id = $attendance->user_id;
                $newAttendance->clock_in = now()->addSecond();
                $newAttendance->save();
            }
        }
    }

    //休憩管理
    public function breakStart()
    {
        $attendance = Attendance::where('user_id', Auth::id())->whereNotNull('clock_in')->whereNull('clock_out')->latest()->first();

        if (!$attendance) {
            // 勤怠が開始されていない場合はエラーメッセージを設定して次に進む
            session()->flash('error', '勤務が開始されていません！');
        } else {
            $latestRest = $attendance->rests()->latest()->first();

            if (!$latestRest || $latestRest->break_end) {
                $rest = new Rest;
                $rest->attendance_id = $attendance->id;
                $rest->break_start = now();
                $rest->save();
            }
        }

        return redirect('/');
    }

    public function breakEnd()
    {
        $attendance = Attendance::where('user_id', Auth::id())->whereNull('clock_out')->latest()->first();
        $rest = $attendance->rests()->whereNull('break_end')->latest()->first();
        $rest->break_end = now();
        $rest->save();

        return redirect('/');
    }
}