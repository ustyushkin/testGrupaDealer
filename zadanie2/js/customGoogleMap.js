var geocoder;
var map;
var marker;

function initialize() {
    var pos = {lat: 52.13, lng: 21.00};
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(pos);
    var myOptions = {
        zoom: 8,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    marker = new google.maps.Marker({
        position: pos,
        draggable: true,
        map: map
    });
    $.fn.sendRequest(pos.lat, pos.lng);


    google.maps.event.addListener(map, "dragend", function (event) {
        var g = map.getCenter();
        coords = new google.maps.LatLng(g.lat(), g.lng());
        marker.setPosition(g);
        $.fn.sendRequest(g.lat(), g.lng());
    });

    google.maps.event.addListener(marker, 'dragend', function (evt) {
        $.fn.sendRequest(evt.latLng.lat(), evt.latLng.lng())
    });
}

function codeAddress() {
    var address = document.getElementById("addr").value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
            $.fn.sendRequest(results[0].geometry.location.lat(), results[0].geometry.location.lng());
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

$("#addr").keypress(function (event) {
    if (event.which == 13) {
        codeAddress();
    }
});

$("#parameters").change(function () {
    $.fn.sendRequest(marker.getPosition().lat(), marker.getPosition().lng());
});

$.fn.sendRequest = function (lat, lng) {
    $.ajax({
        url: '/zadanie2/index.php',
        method: 'POST',
        data: JSON.stringify({lat: lat.toFixed(0), lng: lng.toFixed(0), parameters: $("#parameters").val()})

    }).then(function (data) {
        var obj = $.parseJSON(data);
        $('#description').text(obj['weather'][0]['description']);
        $('#temp').text(obj['main']['temp']);
        $('#wind').text(obj['wind']['speed']);
        //console.log(data);
    });
};

