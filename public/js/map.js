function initMap(lats, lngs) {
  var sum_lat = lats.reduce((a, b) => a + b, 0);
  var avg_lat = (sum_lat / lats.length) || 0;
  
  var sum_lng = lng.reduce((a, b) => a + b, 0);
  var avg_lng = (sum_lng / lngs.length) || 0;


  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 3,
    center: {
      lat: avg_lat,
      lng: avg_lng
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

  flowline.setMap(map);
}
google.maps.event.addDomListener(window, "load", initMap);