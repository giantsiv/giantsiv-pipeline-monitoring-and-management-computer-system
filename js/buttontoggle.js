
      function showtemperature() {
  var x = document.getElementById("temperatureAnalytics");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById('button1').innerHTML = "Hide Raw Temperature Readings";
  } else {
    x.style.display = "none";
    document.getElementById('button1').innerHTML = "Show Raw Temperature Readings";
  }
}
function showflow() {
  var x = document.getElementById("flowAnalytics");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById('button2').innerHTML = "Hide Raw Flowspeed Readings";
  } else {
    x.style.display = "none";
    document.getElementById('button2').innerHTML = "Show Raw Flowspeed Readings";
  }
}
function showpressure() {
  var x = document.getElementById("pressureAnalytics");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById('button3').innerHTML = "Hide Raw Pressure Readings";
  } else {
    x.style.display = "none";
    document.getElementById('button3').innerHTML = "Show Raw Pressure Readings";
  }
}
