<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle', 'Pinceles mentales')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/icon/Icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/page.css') }}">
   {{-- <link rel="stylesheet" href="{{ asset('css/component/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/footer.css') }}">--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toast_notification.css') }}">
    <style>
        .notification-tab__icon{
        	background-image: url('{{ asset('img/icon/toast-notification-sprite.svg') }}');
        }
    </style>
    @stack('styles')
    @stack('headerScript')
</head>
<body>
    <div class="notification-container unselectable" id="notification-container">
    </div>
    <script src="{{ asset('js/toast_notification.js') }}">
    </script>
    <script src="{{ asset('js/state-toast.js') }}">
    </script>
    <script>
        
    </script>
	<div class="body__content" id="body__content">
		@yield('content')
        <x-status-component />
	</div>
</body>
@stack('script')
</html>