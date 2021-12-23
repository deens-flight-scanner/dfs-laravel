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
            <div class="menu-browse">
                <p><a href="/">Home</a></p>
                <p><a href="/">Favorites</a></p>
                <p><a href="/">Airports</a></p>
                <p><a href="/">Logout</a></p>
            </div>
        </div>
        @yield("body-content")
    </body>
</html>
