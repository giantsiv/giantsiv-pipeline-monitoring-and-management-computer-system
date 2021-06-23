<script>
      
      google.charts.load('current', {'packages':['corechart','line']});
      google.charts.setOnLoadCallback(drawChartTemperature);
      google.charts.setOnLoadCallback(drawChartPressure);
      google.charts.setOnLoadCallback(drawChartFlowspeed);

      function drawChartTemperature() {
        var data = google.visualization.arrayToDataTable([
        	['time','temperature'],
        	<?php echo $datachartTemperature; ?>
        ]);

        var options = {
          title: 'Station temperature Graph',
          backgroundColor:'#bfc0d6',
          vAxis: {gridlines: {color: 'grey'},title:'celsius'},
          hAxis: {textStyle:{fontSize:9}},
          pointSize: 3,
          curveType: 'function',
          position:'relative',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart 
(document.getElementById('curve_chart1'));

        chart.draw(data, options);
      }
      function drawChartFlowspeed() {
        var data = google.visualization.arrayToDataTable([
          ['time', 'flow'],
          <?php echo $datachartFlowspeed; ?>
        ]);

        var options = {
          title: 'Station Flowspeed Graph',
          backgroundColor:'#bfc0d6',
          vAxis: {gridlines: {color: 'grey'}, title:'Liters per Minute'},
          hAxis: {textStyle:{fontSize:9}},
          pointSize: 3,
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart 
(document.getElementById('curve_chart2'));

        chart.draw(data, options);
      }
      function drawChartPressure() {
        var data = google.visualization.arrayToDataTable([
          ['time','pressure'],
          <?php echo $datachartPressure; ?>
        ]);

        var options = {
          title: 'Station Pressure Graph',
          backgroundColor:'#bfc0d6',
          vAxis: {gridlines: {color: 'grey'}, title:'tbd'},
          hAxis: {textStyle:{fontSize:9}},
          pointSize: 3,
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart 
(document.getElementById('curve_chart3'));

        chart.draw(data, options);
      }
    
      </script>
