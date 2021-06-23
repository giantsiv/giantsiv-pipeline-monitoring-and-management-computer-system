<?php include('redirecthttps.php');?>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style-login.css?v=<?=time();?>">
    <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
  <div class="logobox">
    <font class="welcome">Welcome to</br></font>
    <font class="mainlogo">N.G.P.M.S.</br>
    </font>
    <font class="sublogo">Natural Gas Pipeline Monitoring System</font>
  </div>
  <div class="login-box">
<section>
  <h1>Είσοδος Στο Σύστημα</h1>
  <?php include('errorreport.php'); ?>
  <form class="login-form" method="post" action="login.php" >
    <label>
      <input type="text" class="newinput" name="username" required placeholder="Username">
    </label>
    <label>
      <input type="password" class="newinput" name="password" required placeholder="Password">
    </label>
    </br>
    <input type="submit" class="incontentbutton2" name="submit" value="Log-in">
  </form>

</section>
<div class="notice">Ξεχάσατε τον κωδικό σας? <br> Παρακαλώ επικοινωνήστε με τον διαχειριστή του συστήματος</div>
</div>
<div class="footer">2020&copy;<font class="footer_text">N.G.P.M.S.</font></div>
</body>
</html>