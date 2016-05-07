var lat = document.getElementById("latitude");
var lon = document.getElementById("longitude");
getLatitude();
getLongitude();

function getLatitude() {
    if (navigator.geolocation) {
    	navigator.geolocation.getCurrentPosition(setLatitude);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function getLongitude() {
    if (navigator.geolocation) {
    	navigator.geolocation.getCurrentPosition(setLongitude);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function setLatitude(position) {
    var latitude = position.coords.latitude;
    console.log(latitude);
	lat.setAttribute("value", latitude);
}

function setLongitude(position) {
    var longitude = position.coords.longitude;
    console.log(longitude);
	lon.setAttribute("value", longitude);
}

setTimeout(function(){
	console.log(lat.getAttribute("type"));
	console.log(lon.getAttribute("type"));
    console.log(lat.getAttribute("value"));
	console.log(lon.getAttribute("value"));
}, 2000);

var leftHeight = $('#left').outerHeight();
var rightHeight = $('#right').outerHeight();
console.log(leftHeight);
console.log(rightHeight);
if (leftHeight > rightHeight){
	$('#left').outerHeight($('#left').outerHeight()+30);
	$('#right').outerHeight($('#left').outerHeight());
} else {
	$('#right').outerHeight($('#right').outerHeight()+30);
	$('#left').outerHeight($('#right').outerHeight());
}