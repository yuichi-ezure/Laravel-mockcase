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
            <a class="header__logo" href="">
            Atte
            </a>
            <nav>
                <ul class="header__menu">
                    @if (Auth::check())
                    <li><a class="header__menu-list" href="/">ホーム</a></li>
                    <li><a class="header__menu-list" href="/attendance">日付一覧</a></li>
                    <li>
                        <form class="form" action="/login" method="post">
                            @csrf
                            <button class="header__menu-list">ログアウト</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
<main>
    <div class="attendance-table">
        <table class="attendance-table__inner">
            <tr class="attendance-table__row">
                <td class="attendance-table__item">サンプル太郎</td>
                <td class="attendance-table__item">サンプル</td>
                <td class="attendance-table__item">サンプル</td>
            </tr>
        </table>
    </div>
</main>
<footer class="footer">
    Atte, Inc.
</footer>
</body>