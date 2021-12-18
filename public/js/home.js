$(document).ready(function () {
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
            var date = new Date(departure_date);
            var dd = date.getDate();
            dd = dd.toString().length == 1 ? '0' + dd : dd;
            var mm = date.getMonth() + 1;
            mm = mm.toString().length == 1 ? '0' + mm : mm;
            var yy = date.getFullYear();
            departure_date = yy + '' + mm + '' + dd;
        }

        if (return_date === '') {
            return_date = 'none';
        } else {
            var date = new Date(return_date);
            var dd = date.getDate();
            dd = dd.toString().length == 1 ? '0' + dd : dd;
            var mm = date.getMonth() + 1;
            mm = mm.toString().length == 1 ? '0' + mm : mm;
            var yy = date.getFullYear();
            return_date = yy + '' + mm + '' + dd;
        }

        console.log(departure_airport, budget, departure_date, return_date, exact_date);

        if (departure_airport.charAt(3) === ':') {
            fetch("/searchFlights/" + departure_airport.substring(0, 3) + "/" + budget + "/" + departure_date + "/" + return_date + "/" + exact_date)
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
    fetch("https://dfs-co2.herokuapp.com/calculate-co2?departure=" + departure + "&arrival=" + arrival)
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