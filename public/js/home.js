$(document).ready(function () {
    $('.container-loading').hide();

    const departure_input = document.getElementById('departure-input');
    departure_input.addEventListener('input', () => searchDepartureAirports(departure_input.value));

    document.getElementById('search-flights-button').onclick = function(){
        var departure_airport = document.getElementById('departure-input').value;
        var budget = document.getElementById('budget-input').value;
        var departure_date = document.getElementById('departure-date-input').value;
        var return_date = document.getElementById('return-date-input').value;
        var exact_date = document.getElementById('exact-date-input').checked;

        if (budget == '') {
            budget = 'none';
        }

        if (departure_date === '') {
            departure_date = 'none';
        } else {
            departure_date = dateTransform(departure_date);
        }

        if (return_date === '') {
            return_date = 'none';
        } else {
            return_date = dateTransform(return_date);
        }

        if (departure_airport.charAt(3) === ':') {
            $('.container-loading').show();
            fetch("/api/flights/search/" + departure_airport.substring(0, 3) + "/" + budget + "/" + departure_date + "/" + return_date + "/" + exact_date)
            .then(response => {
                if (response.ok) return response.json();
                else return Promise.reject(response);
            })
            .then(showFlightsInTable)
            .catch(err => {
                alert(err);
            });
        } else {
            alert('Please select an airport from the suggestions.')
        }
    };

    document.getElementById('suprise-me-button').onclick = function(){
        var departure_airport = document.getElementById('departure-input').value;
        var budget = document.getElementById('budget-input').value;
        var departure_date = document.getElementById('departure-date-input').value;
        var return_date = document.getElementById('return-date-input').value;
        var exact_date = document.getElementById('exact-date-input').checked;

        if (budget == '') {
            budget = 'none';
        }

        if (departure_date === '') {
            departure_date = 'none';
        } else {
            departure_date = dateTransform(departure_date);
        }

        if (return_date === '') {
            return_date = 'none';
        } else {
            return_date = dateTransform(return_date);
        }

        if (departure_airport.charAt(3) === ':') {
            $('.container-loading').show();
            fetch("/api/flights/search/" + departure_airport.substring(0, 3) + "/" + budget + "/" + departure_date + "/" + return_date + "/" + exact_date)
            .then(response => {
                if (response.ok) return response.json();
                else return Promise.reject(response);
            })
            .then(showRandomFlight)
            .catch(err => {
                alert(err);
            });
        } else {
            alert('Please select an airport from the suggestions.')
        }
    };
    
    $("#form_add_favorite").submit(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            type: "POST",
            url: $(this).attr( 'action' ),
            data: $(this).serialize(),
            success: function(data){
                var message = data['message'];
                if (message != 'Success') {
                    alert(message);
                } else {
                    alert('Flight added to favorites');
                }
            }
        });

        return false;
    });
});

function dateTransform(date_object) {
    var date = new Date(date_object);
    var dd = date.getDate();
    dd = dd.toString().length == 1 ? '0' + dd : dd;
    var mm = date.getMonth() + 1;
    mm = mm.toString().length == 1 ? '0' + mm : mm;
    var yy = date.getFullYear();

    return yy + '' + mm + '' + dd;
}

function showRandomFlight(data) {
    if (isEmpty(user)) {
        alert('Please login or register to get a random flight.');
        return;
    }

    var origin = data['origin'];
    
    var destinations = data['destinations'];

    var destinations_filtered = destinations.filter(function(e) {
        return e['flightInfo']['price'] !== 999999;
    });

    var destination = destinations_filtered[Math.floor(Math.random()*destinations_filtered.length)];

    var departd = destination['departd'];
    var departure_date = departd.slice(0, 4) + '-' + departd.slice(4, 6) + '-' + departd.slice(6, 8);
    var returnd = destination['returnd'];
    var return_date = returnd.slice(0, 4) + '-' + returnd.slice(4, 6) + '-' + returnd.slice(6, 8);

    $('.container-loading').hide();
    
    $('.tbl').hide();
    
    showDetailsOfFlight(destination['originAirportShortName'], destination['airport']['shortName'], destination['airline'], destination['airlineCode'], departure_date, return_date, origin['cityName'], destination['city']['name'], destination['flightInfo']['price'], origin['latitude'], origin['longitude'], destination['airport']['latitude'], destination['airport']['longitude']);
}

function showFlightsInTable(data) {
    var origin = data['origin'];
    
    var destinations = data['destinations'];

    var destinations_filtered = destinations.filter(function(e) {
        return e['flightInfo']['price'] !== 999999;
    });

    var destinations_sorted = destinations_filtered.sort(function(a, b) {
        return a['flightInfo']['price'] - b['flightInfo']['price']
    });

    var tableHTML = '';
    destinations_sorted.forEach(destination => {
        var departd = destination['departd'];
        var departure_date = departd.slice(0, 4) + '-' + departd.slice(4, 6) + '-' + departd.slice(6, 8);
        var returnd = destination['returnd'];
        var return_date = returnd.slice(0, 4) + '-' + returnd.slice(4, 6) + '-' + returnd.slice(6, 8);

        tableHTML = tableHTML + "<tr onclick='showDetailsOfFlight(\"" + destination['originAirportShortName'] + "\", \"" + destination['airport']['shortName'] + "\", \"" + destination['airline'] + "\", \"" + destination['airlineCode'] + "\", \"" + departure_date + "\", \"" + return_date + "\", \"" + origin['cityName'] + "\", \"" + destination['city']['name'] + "\", \"" + destination['flightInfo']['price'] + "\", " + origin['latitude'] + ", " + origin['longitude'] + ", " + destination['airport']['latitude'] + ", " + destination['airport']['longitude'] + ")'><td> " + origin['cityName'] + " </td><td> " + destination['city']['name'] + " </td><td> $" + destination['flightInfo']['price'] + " </td><td> " + departure_date + " </td><td> " + return_date + " </td></tr>";
    });

    $('.container-loading').hide();

    $('.tbl').show();
    $('#table_flights_body').html(tableHTML);

    $('#container_right').hide();
}

function showDetailsOfFlight(departure_airport, arrival_airport, airline, airline_code, departure_date, return_date, departure_city, arrival_city, price, departure_lat, departure_lng, arrival_lat, arrival_lng) {
    if (isEmpty(user)) {
        alert('Please login or register to see the flight details.');
        return;
    }
    
    $('#favorite_departure_airport').val(departure_airport);
    $('#favorite_departure_city').val(departure_city);
    $('#favorite_departure_date').val(departure_date);
    $('#favorite_arrival_airport').val(arrival_airport);
    $('#favorite_arrival_city').val(arrival_city);
    $('#favorite_return_date').val(return_date);
    $('#favorite_price').val(price);
    $('#favorite_airline').val(airline);
    $('#favorite_airline_code').val(airline_code);

    
    
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


    initMap([departure_lat, arrival_lat], [departure_lng, arrival_lng]);

    showDate(departure_date, return_date, departure_city, arrival_city);
    showTime(departure_airport, arrival_airport);


    $('#wrapper_flight_price').html('$' + price);

    $('#container_right').show();
}

function showWeather(data) {
    var weather_main = data['main'];
    var weather_temp = parseInt(weather_main['temp']) - 272;
    var weather_icon = data['weather']['0']['icon'];

    $("#wrapper_weather_icon").attr("src","http://openweathermap.org/img/wn/" + weather_icon + "@4x.png");
    $('#wrapper_weather_temp').html(weather_temp + '??C');
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

function showDate(departure_date, return_date, departure_airport, arrival_airport) {
    $('#wrapper_date_departure').html(departure_date);
    $('#wrapper_date_return').html(return_date);

    $('#wrapper_airport_departure').html(departure_airport);
    $('#wrapper_airport_arrival').html(arrival_airport);
}

function showTime(departure_airport, arrival_airport) {
    fetch("/api/time/zone/" + departure_airport)
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(response);
        })
        .then(showHomeTime)
        .catch(err => {
            alert(err);
    });
    fetch("/api/time/zone/" + arrival_airport)
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(response);
        })
        .then(showAwayTime)
        .catch(err => {
            alert(err);
    });
    fetch("/api/time/difference/" + departure_airport + "/" + arrival_airport)
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(response);
        })
        .then(showTimeDifference)
        .catch(err => {
            alert(err);
    });
}

function showHomeTime(data) {
    var time = data.createTimeObjectResult;
    
    var hh = time.Hour.toString();
    hh = hh.length == 1 ? '0' + hh : hh;
    var mm = time.Minutes.toString();
    mm = mm.length == 1 ? '0' + mm : mm;

    var hour_string = hh + ':' + mm;
    $('#wrapper_time_home').html(hour_string);
}

function showAwayTime(data) {
    var time = data.createTimeObjectResult;
    
    var hh = time.Hour.toString();
    hh = hh.length == 1 ? '0' + hh : hh;
    var mm = time.Minutes.toString();
    mm = mm.length == 1 ? '0' + mm : mm;

    var hour_string = hh + ':' + mm;
    $('#wrapper_time_away').html(hour_string);
}

function showTimeDifference(data) {
    var utc_offset = data.timeDifferenceResult;

    var hh = parseInt(utc_offset);
    var min_offset = utc_offset - hh;
    if (min_offset == 0.5) {
        var mm = 30;
    } else {
        var mm = 0;
    }

    hh = hh.toString().length == 1 ? '0' + hh : hh;
    mm = mm.toString().length == 1 ? '0' + mm : mm;

    var hour_string = hh + ':' + mm;

    $('#wrapper_time_difference').html(hour_string);
}

function searchDepartureAirports(name) {
    if (name === '') {
        document.getElementById('departure-suggestions').innerHTML = '';
        document.getElementById("departure-suggestions").style.display = "none";
    } else {
        fetch("/api/airports/search/" + name)
            .then(response => {
                if (response.ok) return response.json();
                else return Promise.reject(response);
            })
            .then(showDepartureAirports)
            .catch(err => {
                alert(err);
            });
    }
}

function showDepartureAirports(airports) {
    if (airports.length === 0) {
        document.getElementById('departure-suggestions').innerHTML = '';
        document.getElementById("departure-suggestions").style.display = "none";
    } else {
        let innerHTML = '<table>';
        airports.forEach((airport) => {
            innerHTML = innerHTML + '<tr><td style="cursor: pointer" onclick="setDepartureAirport(\'' + airport.code + ': ' + airport.name + '\')">' + airport.code + ': ' + airport.name + '</td></tr>';
        });
        innerHTML = innerHTML + '<table>';

        document.getElementById('departure-suggestions').innerHTML = innerHTML;
        document.getElementById("departure-suggestions").style.display = "block";
    }
}

function setDepartureAirport(airport) {
    document.getElementById('departure-suggestions').innerHTML = '';
    document.getElementById("departure-suggestions").style.display = "none";
    document.getElementById('departure-input').value = airport;
}

// This example requires the Places library. Include the libraries=places
function initMap(lats = [0], lngs = [0]) {
    var lat_total = 0;
    for(var i = 0; i < lats.length; i++) {
        lat_total += lats[i];
    }
    var lat_avg = lat_total / lats.length;

    var lng_total = 0;
    for(var i = 0; i < lngs.length; i++) {
        lng_total += lngs[i];
    }
    var lng_avg = lng_total / lngs.length;

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 3,
      center: {
        lat: lat_avg,
        lng: lng_avg
      },
      mapTypeId: google.maps.MapTypeId.TERRAIN
    });
  
    var Lat = lats;
    var Lng = lngs;
  
    var lineSymbol = {
      path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
    };
  
    var Poly = new Array();
    for (var i = 0; i < Lat.length; i++) {
      var pos = new google.maps.LatLng(Lat[i], Lng[i]);
      Poly.push(pos);
    }
    for (var j = 0; j < Poly.length; j++) {
      if (j % 2 == 0) {
        var poly = Poly.slice(j, j + 2);
        var flowline = new google.maps.Polyline({
          map: map,
          path: poly,
          geodesic: true,
          strokeColor: "#DC143C",
          strokeOpacity: .8,
          strokeWeight: 2,
          icons: [{
            icon: lineSymbol,
            offset: '100%'
          }],
        });
      }
    };
}

function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}