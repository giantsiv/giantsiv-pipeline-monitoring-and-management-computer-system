<?php
$level=2;
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
    <div class="grid-container">
  	 <?php include('topbar.php');?>
  	 <div class="master-single">
  	 	<h3>Φόρμα προσθήκης νέου Σταθμού</h3>
  	 	<form method="post" action="addstation.php">
  	 		<input type="text" class="newinput" name="stationname" placeholder="Όνομα Σταθμού" required></br>
  	 		<input type="text" class="newinput" name="telephone" placeholder="Τηλέφωνο" required></br>
      Επιλέξτε την περιφέρεια στην οποία ανήκει ο νέος σταθμός </br>
  	 		<?php include('newstationpref.php') ?><br>
        Για κάθε νέο σταθμό ορίζονται τα προεπιλεγμένα όρια μετρήσεων<br>
        Μπορείτε να τα αλλάξετε στην συνέχεια από την επεξεργασία σταθμού<br>
  	 		<input type="submit" class="incontentbutton2" name="submit" value="Προσθήκη Σταθμού"></br>

  	 	</form>
  	 </div>
     <?php include('footer.php');?>
   </div>
  </body>
</html>