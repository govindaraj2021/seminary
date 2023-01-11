<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('assets/css/icon.min.css')}}" media="all">
    <link rel="icon" href="{{asset('assets/img/favicon/favicon-16x16.png')}}">
    <script async src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <title>
        Not Found | Alphonsa School
    </title>
</head>
<section class="error-page">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto text-center">
                <a href="{{ route('index') }}" class="brand">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Alphonsa School">
                </a>
                <h1>404</h1>
                <h2>Ooops...</h2>
                <p>We are sorry but requested page does not exist.<br /> Try again later or you can return to <a
                        class="text-decoration-underline" href="{{ route('index') }}">base.</a></p>
            </div>
        </div>
    </div>
</section>
</body>
</html>
