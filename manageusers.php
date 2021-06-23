
<!DOCTYPE HTML>
<html>
  <head>
      <link rel="stylesheet" type="text/css" href="style.css?v=<?=time();?>">
      <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
      <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
      <link rel="manifest" href="img/site.webmanifest">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">
  </head>
  <body>
  <div class="grid-table-container">
  <?php include('topbar.php');?>
  <div class="master2">
    <?php include('errorreport.php');?>
    <div class="incontentdiv">
    	<a href="newuser.php" class="incontentbutton"><i style="margin-right: 4px;" class="fa fa-user-plus"></i>Προσθήκη Νέου Χρήστη</a>
      <input type="text" id="search" onkeyup="searchtable()" placeholder="Αναζήτηση χρήστη..." title="">
    </div>
    <?php 
    include('loadusertable.php');
    ?>
    <script type="text/javascript" src="js/searchtable.js"></script>
  </div>
  <?php include('footer.php');?>
</div>
</body>
</html>
<script src="js/tablebuttontoggle.js"></script>