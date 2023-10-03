<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="">
            Atte
            </a>
        </div>
    </header>
<main>
    <div class="login-form__content">
        <div class="login-form__heading">
            <h2>ログイン</h2>
        </div>
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form-content">
                <div class="form-content--text">
                    <input type="text" name="email" placeholder="メールアドレス"><br>
                </div>
                <div class="form__error">
                <!--バリデーション機能を実装したら記述します。-->
                </div>
            </div>
            <div class="form-content">
                <div class="form-content--password">
                    <input type="password" name="password" placeholder="パスワード"><br>
                </div>
                <div class="form__error">
                <!--バリデーション機能を実装したら記述します。-->
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
            <div class="form-info">
                <p class="form-info--text">
                    アカウントをお持ちでない方はこちらから
                </p>
                <a class="form-info--link" href="/register">
                    会員登録
                </a>
            </div>
        </form>
    </div>
</main>
<footer class="footer">
    Atte, Inc.
</footer>
</body>