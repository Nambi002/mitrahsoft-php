function showDateTime() {
    let d = new Date();
    document.getElementById("current-year").innerHTML = "Year : " + d.getFullYear();
    document.getElementById("current-month").innerHTML = "Month : " + (d.getMonth() + 1);
    document.getElementById("current-date").innerHTML = "Date : " + d.getDate();
    document.getElementById("current-hour").innerHTML = "hour : " + d.getHours();
    document.getElementById("current-minute").innerHTML = "minute : " + d.getMinutes();
    document.getElementById("current-seconds").innerHTML = "seconds : " + d.getSeconds();
    document.getElementById("current-millisec").innerHTML = "millisec : " + d.getMilliseconds();
    document.getElementById("local-date-timer").innerHTML = "local-date-timer : " + d.toLocaleString();
    document.getElementById("utc").innerHTML = "utc : " + d.toUTCString("en-US");
    document.getElementById("utc-milliseconds").innerHTML = "utc-milliseconds : " + d.getTime();
    document.getElementById("indian").innerHTML = "Indian Time : " + d.toLocaleTimeString("en-US");


}

function resetResult() {
    document.getElementById("current-year").innerHTML = "";
    document.getElementById("current-month").innerHTML = "";
    document.getElementById("current-date").innerHTML = "";
    document.getElementById("current-hour").innerHTML = "";
    document.getElementById("current-minute").innerHTML = "";
    document.getElementById("current-seconds").innerHTML = "";
    document.getElementById("current-millisec").innerHTML = "";
    document.getElementById("local-date-timer").innerHTML = "";
    document.getElementById("utc").innerHTML = "";
    document.getElementById("utc-milliseconds").innerHTML = "";
    document.getElementById("indian").innerHTML = "";
}

