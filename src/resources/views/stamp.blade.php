<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stamp Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/stamp.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="login">
            Atte
            </a>
            <nav>
                <ul class="header__menu">
                    @if (Auth::check())
                    <li><a class="header__menu-list" href="/">ホーム</a></li>
                    <li><a class="header__menu-list" href="/attendance">日付一覧</a></li>
                    <li><a class="header__menu-list" href="{{ route('logout') }}">ログアウト</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
<main class="attendance__stamp">
@auth
<div class="attendance__alert">
    <p>{{ Auth::user()->name }}さんお疲れ様です！</p>
    @if (session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
@endauth
<div class="attendance__content">
    <div class="attendance__panel1">
        <form class="attendance__button" method="POST" action="/clock_in">
            @csrf
            <button class="attendance__button-submit1" type="submit">勤務開始</button>
        </form>
        <form class="attendance__button" method="POST" action="/clock_out">
            @csrf
            <button class="attendance__button-submit2" type="submit">勤務終了</button>
        </form>
    </div>
    <div class="attendance__panel2">
        <form class="attendance__button" method="POST" action="/break_start">
            @csrf
            <button class="attendance__button-submit3" type="submit">休憩開始</button>
        </form>
        <form class="attendance__button" method="POST" action="/break_end">
            @csrf
            <button class="attendance__button-submit4" type="submit">休憩終了</button>
        </form>
    </div>
</div>
</main>
<footer class="footer">
    Atte, Inc.
</footer>
</body>