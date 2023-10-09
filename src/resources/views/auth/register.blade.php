<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
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
    <div class="register-form__content">
        <div class="register-form__heading">
            <h2>会員登録</h2>
        </div>
        <form class="form" action={{ route('register') }} method="post">
            @csrf
            <div class="form-content">
                <div class="form-content--name">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="名前"><br>
                </div>
                <div class="form__error">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-content">
                <div class="form-content--text">
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="メールアドレス"><br>
                </div>
                <div class="form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-content">
                <div class="form-content--password">
                    <input type="password" name="password" placeholder="パスワード"><br>
                </div>
                <div class="form__error">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-content">
                <div class="form-content--password">
                    <input type="password" name="password_confirmation" placeholder="確認用パスワード"><br>
                </div>
                <div class="form__error">
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">会員登録</button>
            </div>
            <div class="form-info">
                <p class="form-info--text">
                    アカウントをお持ちの方はこちらから
                </p>
                <a class="form-info--link" href="/login">
                    ログイン
                </a>
            </div>
        </form>
    </div>
</main>
<footer class="footer">
    Atte, Inc.
</footer>
</body>