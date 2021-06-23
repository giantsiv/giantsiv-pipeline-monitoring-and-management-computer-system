<?php
$level=3;
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">
  </head>
  <body>
  <div class="grid-table-container">
  <?php include('topbar.php');?>
  <div class="master2">
	<div class="incontentdiv">
  		<a href="newregion.php" class="incontentbutton"><i style="margin-right: 4px;" class="fa fa-plus-circle"></i>Νέα Περιφέρεια</a>
  		<input type="text" id="search" onkeyup="searchtable()" placeholder="Αναζήτηση περιφέρειας..." title="">
  </div>
  <?php 
  include('errorreport.php');
  include('loadregiontable.php');
  ?>
  <script type="text/javascript" src="js/searchtable.js"></script>
	</div>
  <?php include('footer.php');?>
</div>
</body>
</html>
