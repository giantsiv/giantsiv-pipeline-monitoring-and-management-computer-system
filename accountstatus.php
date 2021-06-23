<?php
$level=1;
include('checksession.php');

$content = "";
if ($active == 1){ //if selected account is active 
	$content .= 'Αυτός ο λογαριασμός είναι <font color="green">Ενεργός</font></br>Για απενεργποίηση πατήστε εδώ</br><input type="hidden" name="id" value="'.$_GET['id'].'"><input type="submit" name="disable" class="incontentbutton2" value="Απενεργοποίηση">';

}
elseif($active == 0){ //if selected account is inactive
	$content .= 'Αυτός ο λογαριασμός είναι <font color="red">Ανενεργός</font></br>Για ενεργοποίηση πατήστε εδώ</br><input type="hidden" name="id" value="'.$_GET['id'].'"><input type="submit" name="enable" class="incontentbutton2" value="Ενεργοποίηση">';

}
else{
	echo "Κάτι πήγε λάθος, επικοινωνήστε με τον διαχειρηστή του συστήματος";
}
echo $content;
?>