<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/css/master.css">
        @yield("head-content")
    </head>
    <body>
        <!-- <img src="{{ URL::to('/img/airport-wallpaper.jpg')}}" height="1080" width="1920"> -->
        <div class="menu-bar">
            <div class="menu-title">
                <p>Deans Flight Scanner</p>
            </div>
            @auth
            <div class="menu-user">
                @if (Auth::user()->avatar != null)
                    <img src="{{ Auth::user()->avatar }}" width="40" height="40">
                @endif
                <p>{{ Auth::user()->name }}</p>
            </div>
            <div class="menu-browse">
                <p><a href="/home">Home</a></p>

                <p><a href="/favorite">Favorites</a></p>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <p><a href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </a></p>
                </form>
            @else
            <div class="menu-browse">
                @if (Route::has('login'))
                <p><a href="{{ route('login') }}">Log in</a></p>
                @endif

                @if (Route::has('register'))
                <p><a href="{{ route('register') }}">Register</a></p>
                @endif
            </div>
            @endauth
            </div>
        </div>
        @yield("body-content")
    </body>
</html>
