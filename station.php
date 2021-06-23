<?php 
$level = 1;
include('checksession.php');
?>
<!DOCTYPE HTML>
<html>
  <head>
      <link rel="stylesheet" type="text/css" href="style.css?v=<?=time();?>">
      <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
      <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
      <link rel="manifest" href="img/site.webmanifest">
      <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
  <div class="grid-table-container">
  <?php include('topbar.php'); include('loadstationstatistics.php');?>
  <div class="master2">
  <div class="option_gen">
	<div class="option1">
    <form method="get" action="#">
    <?php echo $stationname;?>
		<h4> Επιλέξτε διάστημα<br>ημερομηνιών</h4>
		Από:<input type="date" name="datefrom" required><br>
    Εώς:<input type="date" name="dateto" >
		<p><input type="submit" class="incontentbutton2" value="Επιλογή"></p>
	</form>
  <p style="font-size:10px;">*Για συγκεκριμένη ημερομηνία <br> επιλέξτε μόνο το "Από:" </p>
</div>
<div class="option3">
<p style="font-size:20px;">Event Board</p>
<?php include('checkforfailure.php'); echo $failure1;?>
</div>
<div class="option2">
<?php 
include('showeditstationbutton.php');
include('showfailurereporthistorybutton.php');
include('showreportbutton.php'); 

?>
</div>

</div>

<div id="curve_chart_gen">
<?php echo $date;?>
    <div id="curve_chart1"></div>
    <button id="button1" onclick="showtemperature()">Show Raw Temperature Readings</button>
    <div style="display: none; text-align: center;" id="temperatureAnalytics">
      <p>
          <h4>Raw Temperature measurements</br></h4>['Time(Hours:Minutes:Seconds)'Temperature]
      <?php echo $datachartTemperature; ?>
    </p>
    </div>
    <div id="curve_chart2"></div>
    <button id="button2"  onclick="showflow()">Show Raw Flowspeed Readings</button>
    <div style="display: none; text-align: center;" id="flowAnalytics">
      <p>
          <h4>Raw Flowspeed measurements</br></h4>['Time(Hours:Minutes:Seconds)',Flowspeed]
          
      <?php echo $datachartFlowspeed; ?>
    </p>
    </div>
    <div id="curve_chart3"></div>
    <button id="button3" onclick="showpressure()">Show Raw Pressure Readings</button>
    <div style="display: none; text-align: center;" id="pressureAnalytics">
      <p>
          <h4>Raw Pressure measurements</br></h4>['Time(Hours:Minutes:Seconds)',Pressure]</h4>
      <?php echo $datachartPressure; ?>
    </p>
    </div>
    </div>
  </div>
    <?php include('footer.php');?>
</div>
  </body>


</html>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php include('js/rendergraph.php');?>
    <script src="js/buttontoggle.js"></script>

