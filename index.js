month_names = ["January", "February", "March", "April", "May", "June", "July", "August",
"September", "October", "November", "December"]

function updateClassInnerHTMLWithValue (class_name, innerHTMLvalue) {
	var objects = document.getElementsByClassName(class_name);
	for (i = 0; i < objects.length; i++) objects[i].innerHTML = innerHTMLvalue;
}

// Create a timer for the clock:
function updateClock () {
	var current_time = new Date();
	var hour = checkTime(current_time.getHours());
	var minute = checkTime(current_time.getMinutes());
	var seconds = checkTime(current_time.getSeconds());
	var month = month_names[current_time.getMonth()];
	var day = current_time.getDate();
	var year = current_time.getFullYear();
	var isodate = year + "-" + checkTime(current_time.getMonth()) + "-" + checkTime(day);
	isodate += " " + hour + ":" + minute + ":" + seconds;
	updateClassInnerHTMLWithValue("isodt", isodate); // Unlikely to ever be utilized
	updateClassInnerHTMLWithValue("chour", hour);
	updateClassInnerHTMLWithValue("cminu", minute);
	updateClassInnerHTMLWithValue("cscnd", seconds); // Q: Would this be better as a loop?
	updateClassInnerHTMLWithValue("cyear", year);    // A: Yes.
	updateClassInnerHTMLWithValue("cmnth", month);   // Q: Can I be bothered to do that?
	updateClassInnerHTMLWithValue("cdate", day);     // A: No.

	setTimeout(updateClock, 500); // Update time every half-second
}
updateClock();
// If a number is less than 10, add a zero in front of it.
function checkTime (x) { return ((x < 10) ? "0" : "") + x; }

// Fetch weather data
function updateData (element, url) {
	fetch(url).then(response => {
		// if (!response.ok) { throw new Error("HTTP error: ${response.status}"); }
		return response.text();
	}).then(text => {
		updateClassInnerHTMLWithValue(element, text);
	});
}
