      function shownonassigned() {
  var x = document.getElementById("nonassigned");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById('button1').innerHTML = "Hide non Assigned Users";
  } else {
    x.style.display = "none";
    document.getElementById('button1').innerHTML = "Show non Assigned Users"; 
  }
}
function showtechnicians() {
  var x = document.getElementById("technicians");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById('button2').innerHTML = "Hide Technicians";
  } else {
    x.style.display = "none";
    document.getElementById('button2').innerHTML = "Show Technicians";
  }
}
function showmanagers() {
  var x = document.getElementById("managers");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById('button3').innerHTML = "Hide Managers";
  } else {
    x.style.display = "none";
    document.getElementById('button3').innerHTML = "Show Managers";
  }
}
