<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fontawesome --> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/solid.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/brands.css') }}">

        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])        
        
    </head>   

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->           
            <main>       
                <!-- Session to pass the message for the CRUD operations success or error -->
                @if(session()->has('message'))
                    <div class="bg-green-700 text-white py-2 px-2">                
                        {{ session('message') }}
                        <a href="{{URL::current()}}">X</a>
                    </div>
                @endif     
                
               <!-- Session to pass the message for the CRUD operations success or error -->
                @if(session()->has('success'))
                    <div class="bg-green-500 text-white py-2 px-2">                
                        {{ session('success') }}
                        <a href="{{URL::current()}}">X</a>
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="bg-red-500 text-white py-2 px-2">                
                        {{ session('error') }}
                        <a href="{{URL::current()}}">X</a>
                    </div>
                @endif
                
                
                {{--
                <!-- Session to pass the message for the CRUD operations -->
                @session('message')
                <div class="success-message">
                    {{ session('message') }}
                </div>
                @endsession

                --}}

                <!-- To output variables in blade, use slot --> 
                
                    {{ $slot }}
                
            </main>
        </div>
        @livewireScripts
        <!-- TEST JS -->
        @stack('other-scripts')
    </body>
</html>
