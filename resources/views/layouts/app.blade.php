<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

        body.night {
            background: #00151f;
            color: #fff;
        }

        .toggle {
            position: absolute;
            top: 40px;
            right: 50px;
            background: #fff;
            border: 2px solid #00151f;
            width: 45px;
            height: 20px;
            cursor: pointer;
            border-radius: 20px;
            transition: 0.5s;
        }

        .toggle.active {
            background: #00151f;
            border: 1px solid #fff;
        }

        .toggle:before {
            left: 0px;
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #00151f;
            border-radius: 50%;
            transition: 0.5s;
        }

        .toggle.active:before {
            left: 27px;
            background: #fff;
        }
    </style>

</head>
<body class="mt-5">
    <div id="app">
        <main>
            @include('inc.navbar')
            <div class="container">
                @include('inc.messages')
                @yield('content')
            </div>
        </main>
    </div>

    <script>

        jQuery(document).ready(function($) {
            $(".toggle").click(function() {
                $(".toggle").toggleClass("active");
                $("body").toggleClass("night");
                $.cookie("toggle", $(".toggle").hasClass('active'));
            });

            if ($.cookie("toggle") == "true") {
                $(".toggle").addClass("active");
                $("body").addClass("night");
            }
        });
    </script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>


</body>
</html>
