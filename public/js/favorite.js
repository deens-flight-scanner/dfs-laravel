$(document).ready(function () {
    $('#btn_delete_favorite').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
});

function showDetailsOfFlight(departure_airport, arrival_airport, airline, airline_code, departure_date, return_date, departure_city, arrival_city, price) {
    fetch("https://dfs-co2.herokuapp.com/calculate-co2?departure=" + departure_airport + "&arrival=" + arrival_airport)
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(response);
        })
        .then(showCO2Emission)
        .catch(err => {
            alert(err);
    });


    fetch("https://api.openweathermap.org/data/2.5/weather?q=" + arrival_city + "&appid=cf58e60f0dc4f801f6988ec3a38bb8b1")
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(response);
        })
        .then(showWeather)
        .catch(err => {
            alert(err);
    });

    
    showAirline(airline, airline_code);

    showTimeAndDate(departure_date, return_date, departure_city, arrival_city);


    $('#wrapper_flight_price').html('$' + price);

    $('#container_right').show();
}

function showWeather(data) {
    var weather_main = data['main'];
    var weather_temp = parseInt(weather_main['temp']) - 272;
    var weather_icon = data['weather']['0']['icon'];

    $("#wrapper_weather_icon").attr("src","http://openweathermap.org/img/wn/" + weather_icon + "@4x.png");
    $('#wrapper_weather_temp').html(weather_temp + 'ºC');
    $('#wrapper_weather_city').html(data['name']);
}

function showCO2Emission(data) {
    var co2_emission = data['flight']['co2_emission'];
    var co2_emission_in_tonnes = (parseFloat(co2_emission) * 0.001).toFixed(2);
    $('#wrapper_co2_amount').html(co2_emission_in_tonnes + ' t');

    if (0 <= co2_emission_in_tonnes < 0.2) {
        var co2_img = 'https://i.ibb.co/d20LjPC/co2-c5.png';
    } else if (0.2 <= co2_emission_in_tonnes < 0.4) {
        var co2_img = 'https://i.ibb.co/3m6XJMy/co2-c4.png';
    } else if (0.4 <= co2_emission_in_tonnes < 0.6) {
        var co2_img = 'https://i.ibb.co/1T34kWp/co2-c3.png';
    } else if (0.6 <= co2_emission_in_tonnes < 0.8) {
        var co2_img = 'https://i.ibb.co/vP9wwDx/co2-c2.png';
    } else {
        var co2_img = 'https://i.ibb.co/MkYPBks/co2-c1.png';
    }
    $("#wrapper_co2_icon").attr("src", co2_img);
}

function showAirline(airline, airlineCode) {
    $('#wrapper_airline_name').html(airline);
    $("#wrapper_airline_icon").attr("src","https://content.r9cdn.net/rimg/provider-logos/airlines/v/" + airlineCode + ".png?crop=false&width=50&height=50&fallback=default3.png&_v=be703666bbd51cff10e0564857e14808");
}

function showTimeAndDate(departure_date, return_date, departure_airport, arrival_airport) {
    $('#wrapper_date_departure').html(departure_date);
    $('#wrapper_date_return').html(return_date);

    $('#wrapper_airport_departure').html(departure_airport);
    $('#wrapper_airport_arrival').html(arrival_airport);
}