<?php
$level = 1;
include('checksession.php');
if (!isset($_GET['id'])){ // for accountpref
	$_GET['id'] = $_SESSION['user_id'];
}
if (isset($_GET['id'])){
	echo $_SESSION['update'];
	unset($_SESSION['update']);
	$userid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	include('connect.php');
	$stmt = $connect->prepare('SELECT * FROM users WHERE `userid` = :id');
	$stmt->execute(array(':id' => $userid));
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
  if($_SESSION['user_type'] == 3 ){
    $enable = "";
  }
  else{
    $enable = "disabled";
  }
	$formcontent = "";
	$formcontent .= '
       <font size=5px;>Πληροφορίες Χρήστη</font></br>
      <font size=3px;>Για επεξεργασία πατήστε:</font>
          <button class="incontentbutton2" onclick="enabled()">Επεξεργασία</button></br>
			<form method="post" action="updateuserinfo.php">
        	<fieldset id ="inputform" name="inputform" disabled="true">
            

			  <font class="creds">Όνομα:</font></br><input type="text" class="newinput" name="firstname" value="'.$user['firstname'].'" placeholder="Όνομα" '.$enable.' required></br>
  	 		<font class="creds">Επίθετο:</font></br><input type="text" class="newinput" name="lastname" value="'.$user['lastname'].'" placeholder="Επίθετο" '.$enable.' required></br>
  	 		<font class="creds";>E-mail:</font></br><input type="text" class="newinput" name="email" value="'.$user['email'].'" placeholder="E-mail" required></br>
  	 		<font class="creds">Username:</font></br><input type="text" class="newinput" name="username" value="'.$user['username'].'" placeholder="Username" required></br>
   	 		<font class="creds">Τηλέφωνο:</font></br><input type="text" class="newinput" name="telephone" value="'.$user['telephone'].'" placeholder="Τηλέφωνο" required></br>
  	 		<input type="hidden" name="idtoupdate" value="'.$user['userid'].'">
  	 		<input type="submit" class="incontentbutton2" name="submitupdate" value="Αποθήκευση Αλλαγών"></br>
  	 		</fieldset>
      		</form>
      		<form method="post" action="updateuserinfo.php">
      		<fieldset id ="inputform" name="inputform">
      		<font size=5px;>Αλλαγή Password</font></br>
      		<font class="creds">Νέο Password:</font></br><input type="password" class="newinput" name="password1" id="password1"  onkeyup="checkpass();" placeholder="New Password" required></br>
      		<font class="creds">Επαναλάβετε το νέο Password:</font></br><input type="password" class="newinput" name="password2" id="password2" onkeyup="checkpass();" placeholder="Password" required></br>
      		<span id="message"></span>
      		<input type="submit" class="incontentbutton2" value="Αλλαγή password" name="passchange">
      		<input type="hidden" name="idtoupdate" value="'.$user['userid'].'">
      		</fieldset>
      		</form>
      		';
  	$selecteduserid = $userid;
  	$selectedusertype = $user['usertype']; //data to be used to user assingment
	echo $formcontent;
	$active = $user['activeaccount'];
}
?>

<script>
	var checkpass = function() {
  if (document.getElementById('password1').value == document.getElementById('password2').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Passwords match!';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Passwords do not match!';
  }
}
</script>