@extends("master")

@section("head-content")
<title>Dean's Flight Scanner - Home</title>

<link rel="stylesheet" href="/css/home.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script src="js/home.js"></script>
@stop

@section("body-content")
    <div class="container-content">
        <div class="container-left">
            <form class="container-form" action="">
                <div class="form-row-one">
                    <div class="form-group form-group-from">
                        <label for="name" class="form-label">From (*)</label>
                        <input type="text" class="form-input" placeholder="From" id="departure-input"/>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Price</label>
                        <input type="text" class="form-input" placeholder="Price" id="budget-input"/>
                    </div>
                </div>
                    
                <div class="form-input-suggestion" id="departure-suggestions"></div>
                <div class="form-row-two">
                    <div class="form-group">
                    <label for="name" class="form-label">Departure</label>
                    <input type="date" class="form-input" id="departure-date-input"/>
                    </div>
                    <div class="form-group">
                    <label for="name" class="form-label">Return</label>
                    <input type="date" class="form-input" id="return-date-input"/>
                    </div>  
                    <div class="form-group">
                    <label for="name" class="form-label">Exact dates</label>
                    <input type="checkbox" class="form-input" id="exact-date-input"/>
                    </div>
                </div>
                <button class="form-button" type="button" id="search-flights-button">Search</button>
            </form>

            <div class="container-tbl">
                <table class="tbl" cellpadding="0" cellspacing="0" border="0">
                    <thead class="tbl-header">
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Price</th>
                            <th>Departure</th>
                            <th>Return</th>
                        </tr>
                    </thead>
                    <tbody class="tbl-body" id="table_flights_body">
                    </tbody>
                </table>
            </div>
            
        </div>

        @auth
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
                    <div class="card-wrapper">
                        <div class="card-text">
                            <p>Airline</p>
                            <h1 id="wrapper_airline_name" style="font-size: 18px;"></h1>
                        </div>
                        <div class="card-icon">
                            <img id="wrapper_airline_icon" src="/">
                        </div>
                    </div>
                    <div class="card-wrapper">
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
            <div class="wrapper-middle">
                <div id="map"></div>
                <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
                <script
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtZn4UcvwxLZzv55xOLUDwGy3arbyadLA&callback=initMap&v=weekly"
                    async
                ></script>
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
                    <form id="form_add_favorite" method="POST" action="/api/favorites">
                        @csrf  

                        <div class="card-wrapper">
                            <input type="number" style="display: none" name="user_id" id="favorite_user_id" value={{ Auth::user()->id }}>
                            <input type="text" style="display: none" name="departure_airport" id="favorite_departure_airport">
                            <input type="text" style="display: none" name="departure_city" id="favorite_departure_city">
                            <input type="text" style="display: none" name="departure_date" id="favorite_departure_date">
                            <input type="text" style="display: none" name="arrival_airport" id="favorite_arrival_airport">
                            <input type="text" style="display: none" name="arrival_city" id="favorite_arrival_city">
                            <input type="text" style="display: none" name="return_date" id="favorite_return_date">
                            <input type="number" style="display: none" name="price" id="favorite_price" step=0.01>
                            <input type="text" style="display: none" name="airline" id="favorite_airline">
                            <input type="text" style="display: none" name="airline_code" id="favorite_airline_code">

                            <input type="submit" class="fav-button" id="btn_add_favorite" value="Favorite">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endauth
    </div>
@stop

