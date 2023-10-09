<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Attendance Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="login">
            Atte
            </a>
            <nav>
                <ul class="header__menu">
                    <li><a class="header__menu-list" href="/">ホーム</a></li>
                    <li><a class="header__menu-list" href="/attendance">日付一覧</a></li>
                    <li><a class="header__menu-list" href="{{ route('logout') }}">ログアウト</a></li>
                </ul>
            </nav>
        </div>
    </header>
<main class="main-table">
    <div class="attendance-date">
        <h1>{{ date('y-m-d', ) }}</h1>
    </div>
    <div class="attendance-table1">
        <table class="attendance-table__inner1">
            <tr class="attendance-table__row1">
                <th class="attendance-table__item">名前</th>
                <th class="attendance-table__item">勤務開始</th>
                <th class="attendance-table__item">勤務終了</th>
                <th class="attendance-table__item">休憩時間</th>
                <th class="attendance-table__item">勤務時間</th>
            </tr>
        </table>
    </div>
    <div class="attendance-table2">
        <table class="attendance-table__inner2">
            @foreach ($attendances as $attendance)
            <tr class="attendance-table__row2">
                <td class="attendance-table__item">{{ $attendance->user->name }}</td>
                <td class="attendance-table__item">{{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i:s') }}</td>
                <td class="attendance-table__item">{{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i:s') }}</td>
                <td class="attendance-table__item">
                @php
                $totalBreak = 0;
                foreach ($attendance->rests as $rest) {
                $totalBreak += \Carbon\Carbon::parse($rest->break_end)->diffInSeconds(\Carbon\Carbon::parse($rest->break_start));
                }
                echo gmdate('H:i:s', $totalBreak);
                @endphp
                </td>
                <td class="attendance-table__item">
                {{ $attendance->clock_out->diff($attendance->clock_in)->format('%H:%I:%S') }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination">
        {{ $attendances->links() }}
    </div>
</main>
<footer class="footer">
    Atte, Inc.
</footer>
</body>