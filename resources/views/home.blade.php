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
            <!-- <form action="">
                <input class="search-form" type="text" placeholder="From" id="departure-input">
                <input class="search-form" type="text" placeholder="Price" id="budget-input">
                <input class="search-form" type="date" placeholder="Departure date" id="departure-date-input">
                <input class="search-form" type="date" placeholder="Return date" id="return-date-input">
                <input class="search-form" type="checkbox" id="exact-date-input">
                <button class="search-form"  type="button" id="search-flights-button">Zoek</button>
            </form> -->

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
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                    <tr><td>Brussels</td><td>New York</td><td>$555</td><td>10/12/2021</td><td>20/12/2021</td></tr>
                </tbody>
            </table>
        </div>

        <div class="container-right" id="container_right">

        </div>
    </div>
@stop

