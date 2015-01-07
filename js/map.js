//Map Javascript Functions

//gelocation function
function geolocationSuccess(position) {
    //map positions
    var lat = position.coords.latitude;
    var long = position.coords.longitude;
    
    //output latitude and longitude into text fields
    sendLatLong(lat, long);
    
    //get center coordinates
    var userLatLng = new google.maps.LatLng(lat, long);
    
    //Map Options
    var myOptions = {
        zoom : 16,
        center : userLatLng,
        mapTypeId : google.maps.MapTypeId.ROADMAP
    };
    
    // Draw the map    
    var mapObject = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
    
    // Create the marker for the user's position
    var uMarker = new google.maps.Marker({
        position: userLatLng,
        title: 'Your Location',
        map: mapObject,
            icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
    });
}

//error for geolocation
function geolocationError(positionError) {
    document.getElementById("error").innerHTML += "Error: " + positionError.message + "<br />";
}

//output latitude and longitude into text fields
function sendLatLong(lat,long){
    document.getElementById("latitude").value = lat;
    document.getElementById("longitude").value = long;
}

//get the user's current position
function geolocateUser() {
    // If the browser supports the Geolocation API
    if (navigator.geolocation) {
        var positionOptions = {
            enableHighAccuracy: true,
            timeout: 10 * 1000 // 10 seconds
        };
        //geolocation API to get current location of the user
        navigator.geolocation.getCurrentPosition(geolocationSuccess, geolocationError, positionOptions);
    } else
    document.getElementById("error").innerHTML += "Your browser doesn't support the Geolocation API";
}

//search nearby locations
function searchNearLocations()
{
    clearLocations();
    var bounds = new google.maps.LatLngBounds();
   
    var drugSearch = document.getElementById('drug_name').value;

    var searchURL = 'searchDrug.php?drug_name=' + drugSearch;

    downloadUrl(searchURL, function (data) {
        var xml = data.responseXML;
        var markerNodes = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markerNodes.length; i++)
        {
            var shop_name = markerNodes[i].getAttribute("shop_name");
            var product_name = markerNodes[i].getAttribute("product_name");
            var product_price = markerNodes[i].getAttribute("product_price");
            var product_category = markerNodes[i].getAttribute("category_name");
            var point = new google.maps.LatLng(
                parseFloat(markerNodes[i].getAttribute("latitude")),
                parseFloat(markerNodes[i].getAttribute("longitude")));

            createMarker(point, shop_name, product_name, product_price, product_category);
            //bounds.extend(point);
        }
    });
    //mapObject.fitBounds(bounds);
}

//Function for clearing any markers on the map when searching for another product
function clearLocations() {
    infoWindow.close();
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers.length = 0;
}

//function for creating map marker
function createMarker(point, shop_name, product_name, product_price, product_category) {
    var html = '<div id="content" style="font-family:9px;"><small>Business Name:<b>' + shop_name + '</b></small><br/><small>Product: <b>' + product_name + '</b></small><br /><small>Price(Ksh.): <b>' + product_price + '</b></small><br /><small>Category: <b>' + product_category + '</b></small></div>';
    var marker = new google.maps.Marker({
        map: mapObject,
        position: point
    });

    //CREATE INFO WINDOW WHEN MARKER IS CLICKED
    google.maps.event.addListener(marker, 'click', function () {
        infoWindow.setContent(html);
        infoWindow.open(mapObject, marker);
    });
    markers.push(marker);
}

function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
}

function doNothing() {}

window.onload = geolocateUser;