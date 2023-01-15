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
        <nav class="p-6 bg-teal-900 flex justify-between mb-6 text-white">
            <ul class="flex items-center">
                <li>
                    <a href="/" class="p-3">Home</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('posts') }}" class="p-3">Posts</a>
                </li>
            </ul>
            <ul class="flex items-center">
                @auth
                    <li>
                        <a href="{{ route('users.profile', auth()->user())}}" class="p-3">{{ auth()->user()->name }}</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="p-3 inline">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
                
                @guest
                    <li>
                        <a href="{{ route('login')}}" class="p-3">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register')}}" class="p-3">Register</a>
                    </li>
                @endguest


            </ul>

        </nav>
        @yield('content')
    </body>
</html>