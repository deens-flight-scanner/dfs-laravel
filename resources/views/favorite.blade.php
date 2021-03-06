@extends("master")

@section("head-content")
<title>Dean's Flight Scanner - Home</title>

<link rel="stylesheet" href="/css/favorite.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/favorite.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section("body-content")
    <div class="container-content">
        <div class="container-left">
            <table class="tbl" cellpadding="0" cellspacing="0" border="0">
                <thead class="tbl-header">
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Price</th>
                        <th>Departure</th>
                        <th>Return</th>
                        <th>Airline</th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody class="tbl-body" id="table_flights_body">
                    @foreach ($favorites as $favorite)
                        <tr onclick="showDetailsOfFlight('{{ $favorite->departure_airport }}', '{{ $favorite->arrival_airport }}', '{{ $favorite->airline }}', '{{ $favorite->airline_code }}', '{{ $favorite->departure_date }}', '{{ $favorite->return_date }}', '{{ $favorite->departure_city }}', '{{ $favorite->arrival_city }}', '{{ $favorite->price}}', '{{ $favorite->id }}')">
                            <td>{{ $favorite->departure_city }}</td>
                            <td>{{ $favorite->arrival_city }}</td>
                            <td>${{ $favorite->price }}</td>
                            <td>{{ $favorite->departure_date }}</td>
                            <td>{{ $favorite->return_date }}</td>
                            <td>{{ $favorite->airline }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form id="form_delete_expired" method="POST" action="/api/favorites/expired">
                @method('DELETE')
                @csrf

                <input type="submit" class="exp-button" id="btn_delete_expired" value="Remove expired">
            </form>
        </div>

        <div class="container-right" id="container_right">
            <div class="wrapper-top">
                <div class="wrapper-top-left">
                    <div class="card-wrapper">
                        <div class="card-text">
                            <h1 id="wrapper_weather_temp"></h1>
                            <p id="wrapper_weather_city"></p>
                        </div>
                        <div class="card-icon">
                            <img id="wrapper_weather_icon" src="/">
                        </div>
                    </div>
                </div>
                <div class="wrapper-top-right">
                    <div class="card-wrapper top-left">
                        <div class="card-text">
                            <p>Airline</p>
                            <h1 id="wrapper_airline_name" style="font-size: 18px;"></h1>
                        </div>
                        <div class="card-icon">
                            <img id="wrapper_airline_icon" src="/">
                        </div>
                    </div>
                    <div class="card-wrapper top-left">
                        <div class="card-text">
                            <p>CO2 emission</p>
                            <h1 id="wrapper_co2_amount"></h1>
                        </div>
                        <div class="card-icon">
                            <img id="wrapper_co2_icon" src="/">
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-bottom">
                <div class="card-wrapper wrapper-bottom-left">
                    <div class="card-text">
                        <p>Departure</p>
                        <h1 class="h1-date" id="wrapper_date_departure">10/10/2021</h1>
                        <p>Return</p>
                        <h1 class="h1-date" id="wrapper_date_return">12/10/2021</h1>
                    </div>
                    <div class="card-text">
                        <div class="card-text-time-difference">
                            <p>Time difference</p>
                            <h1 id="wrapper_time_difference">3:30</h1>
                        </div>
                        <div class="card-text-times">
                            <div>          
                                <p id="wrapper_airport_departure">Brussels</p>
                                <h1 id="wrapper_time_home">12:00</h1>
                            </div>
                            <div>
                                <p id="wrapper_airport_arrival">New Delhi</p>
                                <h1 id="wrapper_time_away">15:40</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper-bottom-right">
                    <div class="card-wrapper">
                        <div class="card-text">
                            <p>Airline</p>
                            <h1 id="wrapper_flight_price">$$$</h1>
                        </div>
                    </div>
                    <form id="form_delete_favorite" method="POST" action="">
                        @method('DELETE')
                        @csrf

                        <div class="card-wrapper">
                            <input type="submit" class="fav-button" id="btn_delete_favorite" value="Unfavorite">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div style="display: none;" id="user_id">{{ Auth::user()->id }}</div> --}}
    </div>
@stop

