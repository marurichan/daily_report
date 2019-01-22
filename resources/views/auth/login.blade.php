<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slack_login.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>
<div class="main-center">
  <div class="login-wrap">
    <div class="box-title"><h2>Login</h2></div>
    <div class="attention-box">
      <p>{{ config('app.name') }} はSlackと連携したシステムです。Slackのアカウント情報をアプリケーション内で使用します。</p>
    </div>
    <div class="login-box">
      <button class="login-btn" type="button" onclick="location.href='slack/login'">
        <img src="/image/sign_in_with_slack.png" alt="Sign in with Slack" />
      </button>
    </div>
  </div>
</div>
</body>
</html>
