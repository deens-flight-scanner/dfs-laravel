@extends("master")

@section("head-content")
<title>Dean's Flight Scanner - Home</title>

<link rel="stylesheet" href="/css/home.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/home.js"></script>
@stop

@section("body-content")
    <div class="container-content">
        <div class="container-left">
            <form class="container-form" action="">
                <div class="form-row-one">
                    <div class="form-group form-group-from">
                        <label for="name" class="form-label">From</label>
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
                <div class="card-wrapper">
                    <div class="card-text">
                        <h1>5º</h1>
                        <p>Bergamo</p>
                    </div>
                    <div class="card-icon">
                        <img src="http://openweathermap.org/img/wn/10d@4x.png">
                    </div>
                </div>
            </div>
            <div class="wrapper-bottom">
                <div class="card-wrapper">
                    <div class="card-text">
                        <h1>5º</h1>
                        <p>Bergamo</p>
                    </div>
                    <div class="card-icon">
                        <img src="http://openweathermap.org/img/wn/10d@4x.png">
                    </div>
                </div>
                <div class="card-wrapper">
                    <div class="card-text">
                        <h1>5º</h1>
                        <p>Bergamo</p>
                    </div>
                    <div class="card-icon">
                        <img src="http://openweathermap.org/img/wn/10d@4x.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

