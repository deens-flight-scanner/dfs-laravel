@extends("master")

@section("head-content")
<title>Dean's Flight Scanner - Home</title>

<link rel="stylesheet" href="/css/home.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/home.js"></script>
@stop

@section("body-content")
    <div class="top-div">
        <p class="top-text top-text-left">Dean's Flight Scanner</p>
        <p class="top-text top-text-right">Favorites</p>
        <p class="top-text top-text-right">Home</p>
    </div>
    <div class="content-div">
        <div class="left-div">
            <form action="">
                <input class="search-form" type="text" placeholder="Van" id="departure-input">
                <!-- <input class="search-form"  type="text" placeholder="Naar" id="to-input"> -->
                <button class="search-form"  type="button" id="search-flights-button">Zoek</button>
            </form>
            
            <div class="left-suggestion" id="departure-suggestions"></div>

            <table>
                <thead>
                    <th>Van</th>
                    <th>Naar</th>
                    <th>Prijs</th>
                    <th>Vetrek</th>
                    <th>Terug</th>
                </thead>
                <tbody id="table_flights_body">
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                    <tr><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td><td style="opacity: 0">/</td></tr>
                </tbody>
            </table>
        </div>

        <div class="right-div">

        </div>
    </div>
@stop

