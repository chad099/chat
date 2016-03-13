getLocation();
var directionsService = new google.maps.DirectionsService;
var directionsDisplay = new google.maps.DirectionsRenderer;

function initService(location) {
  var displaySuggestions = function(predictions, status) {
    if (status != google.maps.places.PlacesServiceStatus.OK) {
      alert(status);
      return;
    }

	var availableTags = [];
    predictions.forEach(function(prediction) {
		 var data = { "value": ''+prediction.description+'', "data": ''+prediction.description+'' };
		availableTags.push(data);
    });
     $( "#location" ).autocomplete({
		 lookup: availableTags
		}); 
  };

  var service = new google.maps.places.AutocompleteService();
  service.getQueryPredictions({ input: ''+location+'' }, displaySuggestions);
}


$('body').on('keyup','#location',function(){
	var location = $(this).val();
	initService(location);
});

$('#searchbutton').click(function(e){
		
		$('.filterinput').prop('checked',false);
		e.preventDefault();
		_this = $(this);
		var location = $('#location').val();
		if(!location.length){
			Materialize.toast('Enter your Location!', 4000);
			return false; 
			}
			
		$('#placeshow').html('');
		$('.progress').show();
		if(location.length){
			getLatLong(location);
		}	
	});
	
function getLatLong(location){
	$('#user_location').val(location);
	geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': location}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      //alert("Latitude: "+results[0].geometry.location.lat());
      //alert("Longitude: "+results[0].geometry.location.lng());
      createMap(results[0].geometry.location.lat(), results[0].geometry.location.lng(),location);
      $('#lat').val(results[0].geometry.location.lat());
      $('#lng').val(results[0].geometry.location.lng());
      $('.filterinput').prop('disabled',false);
      //searchNearbyPlaces(results[0].geometry.location.lat(), results[0].geometry.location.lng(),location);
	}
});
}

function createMap(lat,lng,location) {
	
  var myLatlng = new google.maps.LatLng(lat, lng);
  var mapOptions = {
    zoom: 10,
    center: myLatlng,
    disableDefaultUI: false,
    mapTypeId: 'Styled'
    
  }
  
mapTypeControlOptions: {
	mapTypeIds: ['Styled']
}
  $('#map').css('max-width','1100px').css('height','400px');
  var map = new google.maps.Map(document.getElementById('map'), mapOptions);
  directionsDisplay.setMap(map);
  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      animation: google.maps.Animation.BOUNCE,
      title: location
  });
  
  var contentString = location;
  
  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
  
  var styles = [
    {
        featureType: 'water',
        elementType: 'geometry.fill',
        stylers: [
            { color: '#adc9b8' }
        ]
    },{
        featureType: 'landscape.natural',
        elementType: 'all',
        stylers: [
            { hue: '#809f80' },
            { lightness: -35 }
        ]
    },
    
];

var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
    map.mapTypes.set('Styled', styledMapType);
 
$('.progress').hide();    
}	

$('.filterinput').click(function(){
	var lat = $('#lat').val();
	var lnt = $('#lng').val();
	var type = $(this).val();
	$('#placeshow').html();
	$('.progress').show();
	$.post( '/search/nearbyplace',{"lat":lat,"longt":lnt,"type":type},function(result){
			$('.progress').hide();
			$('#placeshow').html(result);
		});
	
	});	
	
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition,showError,{ enableHighAccuracy: true,timeout : 75000 });
    } else {
		Materialize.toast('Geolocation is not supported by this browser.', 4000);
    }
}

function showError(error) {
	$('.progress').hide();
    switch(error.code) {
        case error.PERMISSION_DENIED:
			Materialize.toast('User denied the request for Geolocation.', 4000);
			break;
        case error.POSITION_UNAVAILABLE:
			Materialize.toast('Location information is unavailable.', 4000);
            break;
        case error.TIMEOUT:
            Materialize.toast('The request to get user location timed out.', 4000);
            break;
        case error.UNKNOWN_ERROR:
            Materialize.toast('An unknown error occurred.', 4000);
            break;
    }
}

function showPosition(position) {
	$('#Latitude').val(position.coords.latitude);
	$('#Longitude').val(position.coords.longitude);
	
	GetAddress(position.coords.latitude, position.coords.longitude);	
}	

function calcRoute(start , end) {
  var request = {
    origin:start,
    destination:end,
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC
  };
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
		console.log(result);
		
	  directionsDisplay.setPanel(document.getElementById('right-panel'));
      directionsDisplay.setDirections(result);
       $('.progress').hide();
    }
  });
 
}

function GetAddress(lat,lng) {
	var latlng = new google.maps.LatLng(lat, lng);
	var geocoder  = new google.maps.Geocoder();
	geocoder.geocode({ 'latLng': latlng }, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			if (results[0]) {
				$('#user_address').val(results[0].formatted_address);
				//alert("Location: " + results[1].formatted_address);
			}
		}
	});
}

$('body').on('click','.getdirection',function(){
	$('.progress').show();
	var start = document.getElementById("user_address").value;
	var end = $(this).attr('data-vicinity'); //document.getElementById("user_location").value;
	console.log(end);
	if(end.length){
		calcRoute(start, end);
	}else{
		console.log('no end address provided');
		}	
});

$('#findmylocation').click(function(){
	$('.progress').show();
	findMyLocation();
});


function findMyLocation() {	
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showMyPosition,showError,{ enableHighAccuracy: true,timeout : 6000 });
    } else {
		Materialize.toast('Geolocation is not supported by this browser.', 4000);
    }
}

function showMyPosition(position) {
	$('#Latitude').val(position.coords.latitude);
	$('#Longitude').val(position.coords.longitude);
	
	var address  = GetAddress(position.coords.latitude, position.coords.longitude);	
	$('#location').val($('#user_address').val());
	$('#locationLabel').addClass('active');
	createMap(position.coords.latitude, position.coords.longitude, address);
	$('.progress').hide();
}	

