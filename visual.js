var lat = document.getElementById("latitude");
var lon = document.getElementById("longitude");
getLatitude();
getLongitude();
var counter = 2;

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
	counter--;
}

function setLongitude(position) {
    var longitude = position.coords.longitude;
    console.log(longitude);
	lon.setAttribute("value", longitude);
	counter--;
}

document.getElementById("trends").onclick = function(){formSubmit()};
	
function formSubmit(){
	console.log("clicked");
	if (counter <= 0){
		document.getElementById('trender').submit();
	} else {
        setTimeout( formSubmit, 500 );
    }
}

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