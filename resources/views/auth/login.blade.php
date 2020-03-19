<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="login, signin">

    <title>Login Page 2 &mdash; TheAdmin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
</head>

<body class="min-h-fullscreen bg-img center-vh p-20" style="background-image: url(../assets/img/bg/bgTruman.jpg);"
    data-overlay="7">

    <div class="card card-round card-shadowed px-50 py-30 w-400px mb-0" style="max-width: 100%">
        <h5 class="text-uppercase">Sign in</h5>
        <br>

        <form method="POST" class="form-type-material" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">
                <label for="username">{{ __('E-Mail Address') }}</label>
                {{-- @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror --}}
            </div>

            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    required autocomplete="current-password" id="password">
                <label for="password">{{ __('Password') }}</label>
                {{-- @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror --}}
            </div>

            <div class="form-group">
                <button class="btn btn-bold btn-block btn-primary" type="submit">{{ __('Login') }}</button>
            </div>
        </form>

    </div>

    <!-- Scripts -->
    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>

</body>

</html>
