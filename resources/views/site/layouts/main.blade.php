<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/public/libs/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/site/css/main.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
    .loader {
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        justify-content: center;
        align-items: center;
        z-index: 99999999;
        background: #000000a1 !important;
        backdrop-filter: blur(1px);
        display: none;
        }
        .custom-loader {
        --d:22px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        color: #ff3100;
        box-shadow: 
            calc(1*var(--d))      calc(0*var(--d))     0 0,
            calc(0.707*var(--d))  calc(0.707*var(--d)) 0 1px,
            calc(0*var(--d))      calc(1*var(--d))     0 2px,
            calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
            calc(-1*var(--d))     calc(0*var(--d))     0 4px,
            calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
            calc(0*var(--d))      calc(-1*var(--d))    0 6px;
        animation: s7 1s infinite steps(8);
        }

        @keyframes s7 {
        100% {transform: rotate(1turn)}
        }

        #errors {
            position: fixed;
            top: 190px;
            right: 1.25rem;
            display: flex;
            flex-direction: column;
            max-width: calc(100% - 1.25rem * 2);
            gap: 1rem;
            z-index: 99999999999999999999;

            }
            #errors >* {
            width: 100%;
            color: #fff;
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            }

            #errors .error {
            background: #e41749;
            }
            #errors .success {
            background: #12c99b;
            }

    </style>
    <title>الجمهورية الجديدة | @yield('title')</title>
</head>
<body>
    <div class="loader" style="background-color: #fff;">
        <div class="custom-loader"></div>
    </div>
    <div id="errors"></div>
    @include('site.includes.header')
    @yield('content')
    @include('site.includes.footer')
    <script src="{{ asset('/public/libs/vue.js') }}"></script>
    <script src="{{ asset('/public/libs/jquery.js') }}"></script>
    <script src="{{ asset('/public/libs/axios.js') }}"></script>
    <script src="{{ asset('/public/libs/swiper.js') }}"></script>

    @yield('scripts')
</body>
</html>