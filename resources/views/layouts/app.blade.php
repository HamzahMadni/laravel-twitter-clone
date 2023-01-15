<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        <title>Twitter Clone</title>
    </head>
    <body class="bg-teal-700">
        <nav class="py-4 px-6 bg-teal-900 flex justify-between mb-6 text-white">
            <ul class="flex items-center space-x-2">
                <li>
                    <a
                        href="{{ route('home') }}"
                        class="text-sm sm:text-base px-2 py-1 sm:p-3 rounded hover:bg-white/20 @if(request()->routeIs('home')) {{'font-bold bg-white/10'}} @endif"
                    >Home</a>
                </li>
                <li>
                    <a href="{{ route('explore.index') }}" class="text-sm sm:text-base px-2 py-1 sm:p-3 rounded hover:bg-white/20 @if(request()->routeIs('explore.index')) {{'font-bold bg-white/10'}} @endif">Explore</a>
                </li>
            </ul>
            <div class="hidden sm:block font-bold text-3xl">Twitter Clone</div>
            <ul class="flex items-center space-x-2">
                @auth
                    <li>
                        <a href="{{ route('users.profile', auth()->user())}}" class="text-sm sm:text-base px-2 py-1 sm:p-3 rounded hover:bg-white/20 @if(request()->routeIs('users.profile')) {{'font-bold bg-white/10'}} @endif">{{ auth()->user()->name }}</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="text-sm sm:text-base px-2 py-1 sm:p-3 rounded hover:bg-white/20">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
                
                @guest
                    <li>
                        <a href="{{ route('login')}}" class="text-sm sm:text-base px-2 py-1 sm:p-3 rounded hover:bg-white/20 @if(request()->routeIs('login')) {{'font-bold bg-white/10'}} @endif">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register')}}" class="text-sm sm:text-base px-2 py-1 sm:p-3 rounded hover:bg-white/20 @if(request()->routeIs('register')) {{'font-bold bg-white/10'}} @endif">Register</a>
                    </li>
                @endguest


            </ul>

        </nav>
        @yield('content')
    </body>
</html>