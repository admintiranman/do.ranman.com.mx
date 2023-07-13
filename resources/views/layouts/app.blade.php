<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token()}}">

    <title>@yield('title', config('app.name', 'Laravel')) | V2</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- fontawaesome.com/font-awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('header_style')

</head>
<body>
    <div id="app">
        @yield('content')
        
        @if (session()->has('success'))
            <v-toast message="{{session()->get('success')}}" type="is-success"></v-toast>
        @endif
        @if(session()->has('error'))
            <v-toast message="{{session()->get('error')}}" type="is-danger"></v-toast>
        @endif
        @if(session()->has('warning'))
        <v-toast message="{{session()->get('warning')}}" type="is-warning"></v-toast>
    @endif
    </div>
    @yield('javascript')
</body>
</html>
