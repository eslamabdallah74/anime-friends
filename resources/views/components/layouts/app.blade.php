<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>anime-friends</title>
    {{-- Tailwind --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="grid grid-cols-8 gap-6 px-6 mx-auto mt-16 max-w-7xl">
       <div class="col-span-2 space-y-6 border-r border-slate-200">
           @auth
                <ul>
                    {{-- Logged In --}}
                    <li>
                        {{-- Username Name --}}
                        <span
                         class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800">
                          {{ auth()->user()->name }} </span>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="/feed" class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800 ">Feed</a>
                    </li>
                </ul>
                {{-- Another list --}}
                <ul>
                    <li>
                        <a href="{{ route('Home') }}" class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800 ">My Anime</a>
                    </li>
                    <li>
                        <a href="{{ route('anime.create') }}" class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800 ">Add Anime</a>
                    </li>
                    <li>
                        <a href="{{ route('friends.index') }}" class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800 ">Friends</a>
                    </li>
                </ul>
                {{-- Another list --}}
                <ul>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800 ">Logout</button>
                        </form>
                    </li>
                </ul>
            @endauth
            @guest
            <ul>
                <li>
                    <a href="{{ route('Home') }}" class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800 ">Home</a>
                </li>
            </ul>
            {{-- Another list --}}
            <ul>
                <li>
                    <a href="{{ route('login') }}" class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800 ">Login</a>
                </li>
                <li>
                    <a href="{{ route('Register') }}" class="block py-1 text-lg font-bold text-slate-600 hover:text-slate-800 ">Register</a>
                </li>
            </ul>
            @endguest
       </div>
       {{-- Main content --}}
       <div class="col-span-6">
            @isset($header)
                <div class="text-2xl font-bold text-slate-800">
                    {{ $header }}
                </div>
            @endisset
            <div class="mt-8">
                {{ $slot }}
            </div>
       </div>
    </div>
</body>
</html>
