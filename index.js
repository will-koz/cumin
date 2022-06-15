month_names = ["January", "February", "March", "April", "May", "June", "July", "August",
"September", "October", "November", "December"]

function updateClassInnerHTMLWithValue (class_name, innerHTMLvalue) {
	var objects = document.getElementsByClassName(class_name);
	for (i = 0; i < objects.length; i++) objects[i].innerHTML = innerHTMLvalue;
}

function updateClassBGWithImage (classname, url) {
	var objects = document.getElementsByClassName(classname);
	for (i = 0; i < objects.length; i++) {
		formatstring = "linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, .8) ), url(\"";
 		formatstring += url + "\")";
		objects[i].style.background = formatstring;
		objects[i].style.backgroundPosition = "center";
		objects[i].style.backgroundSize = "cover";
	}
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

function updateBGWithSubreddit (element, subreddit) {
	url = "https://www.reddit.com/r/" + subreddit + ".json";
	fetch(url).then(response => {
		return response.text();
	}).then(text => {
		var data = JSON.parse(text).data.children;
		for (var i = 0; i < data.length && i >= 0; i++) {
			if (data[i].data.url.substr(data[i].data.url.length - 4) == ".png" ||
				data[i].data.url.substr(data[i].data.url.length - 4) == ".jpg" ||
				data[i].data.url.substr(data[i].data.url.length - 4) == ".gif") {
				updateClassBGWithImage(element, data[i].data.url);
				return;
			}
		}
	});

	// If there are no images found, search through the top posts of all time
	url = "https://www.reddit.com/r/" + subreddit + "/top.json?t=all";
	fetch(url).then(response => {
		return response.text();
	}).then(text => {
		var data = JSON.parse(text).data.children;
		for (var i = 0; i < data.length && i >= 0; i++) {
			if (data[i].data.url.substr(data[i].data.url.length - 4) == ".png" ||
				data[i].data.url.substr(data[i].data.url.length - 4) == ".jpg" ||
				data[i].data.url.substr(data[i].data.url.length - 4) == ".gif") {
				updateClassBGWithImage(element, data[i].data.url);
				return;
			}
		}
	});
}
