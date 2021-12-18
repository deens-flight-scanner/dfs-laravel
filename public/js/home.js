$(document).ready(function () {
    const departure_input = document.getElementById('departure-input');
    departure_input.addEventListener('input', () => searchDepartureAirports(departure_input.value));

    document.getElementById('search-flights-button').onclick = function(){
        departure_airport = document.getElementById('departure-input').value;
        if (departure_airport.charAt(3) === ':') {
            // no date: https://www.momondo.be/s/horizon/exploreapi/destinations?airport=BRU&budget=&duration=&flightMaxStops=&stopsFilterActive=false&topRightLat=83.27442317147279&topRightLon=-120.61572565507146&bottomLeftLat=-69.66682820715249&bottomLeftLon=170.47802434492354&zoomLevel=1&selectedMarker=&themeCode=&selectedDestination=
            // date: https://www.momondo.be/s/horizon/exploreapi/destinations?airport=BRU&budget=&depart=20211213&return=20211216&duration=&exactDates=true&flightMaxStops=&stopsFilterActive=false&topRightLat=83.27442317147279&topRightLon=-120.61572565507146&bottomLeftLat=-69.66682820715249&bottomLeftLon=170.47802434492354&zoomLevel=1&selectedMarker=&themeCode=&selectedDestination=
            fetch("/searchFlights/" + departure_airport.substring(0, 3))
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
});

function showFlightsInTable(data) {
    var origin = data['origin'];
    console.log(origin)
    
    var destinations = data['destinations'];

    var destinations_sorted = destinations.sort(function(a, b) {
        return a['flightInfo']['price'] - b['flightInfo']['price']
    });

    var tableHTML = '';
    destinations_sorted.forEach(destination => {
        console.log(destination)
        var departd = destination['departd'];
        var departure_date = departd.slice(6, 8) + '-' + departd.slice(4, 6) + '-' + departd.slice(0, 4);
        var returnd = destination['returnd'];
        var return_date = returnd.slice(6, 8) + '-' + returnd.slice(4, 6) + '-' + returnd.slice(0, 4);

        tableHTML = tableHTML + '<tr onclick="showDetailsOfFlight(\'' + origin['shortName'] + '\', \'' + destination['airport']['shortName'] + '\')"><td> ' + origin['cityName'] + ' </td><td> ' 
        + destination['city']['name'] + ' </td><td> $' + destination['flightInfo']['price'] 
        + ' </td><td> ' + departure_date + ' </td><td> ' + return_date + ' </td></tr>'
    });
    $('#table_flights_body').html(tableHTML);
    
    // destinations.forEach(element => {
    //     console.log(element['flightInfo']['price'])
    // });
}

function showDetailsOfFlight(departure, arrival) {
    fetch("http://178.62.214.114:5000/calculate-co2?departure=" + departure + "&arrival=" + arrival)
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(response);
        })
        .then(console.log)
        .catch(err => {
            alert(err);
    });
}

function searchDepartureAirports(name) {
    if (name === '') {
        document.getElementById('departure-suggestions').innerHTML = '';
    } else {
        fetch("/api/searchSuggestion/" + name)
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
    } else {
        let innerHTML = '<table>';
        airports.forEach((airport) => {
            innerHTML = innerHTML + '<tr><td style="cursor: pointer" onclick="setDepartureAirport(\'' + airport.code + ': ' + airport.name + '\')">' + airport.code + ': ' + airport.name + '</td></tr>';
        });
        innerHTML = innerHTML + '<table>';

        document.getElementById('departure-suggestions').innerHTML = innerHTML;
    }
}

function setDepartureAirport(airport) {
    document.getElementById('departure-suggestions').innerHTML = '';
    document.getElementById('departure-input').value = airport;
}