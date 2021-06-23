<?php
$level = 1;
include('checksession.php'); //this option is for the user's own account only
include('connect.php');
$userid = $_SESSION['user_id'];
$stmt = $connect->prepare('SELECT notifpref FROM users WHERE userid = :userid');
$stmt->execute(array('userid' => $userid));
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$o = $data['notifpref'];
$o1='';
$o2='';
$o3='';
if($o == 1) $o1 = "selected";
if($o == 2) $o2 = "selected";
if($o == 3) $o3 = "selected";
$notifoption = '<select name="pref">';
$notifoption .= '<option value="1"'.$o1.'>Email</option><option value="2"'.$o2.'>SMS</option><option value="3"'.$o3.'>SMS & Email</option>';
$notifoption .= '</select>';
echo $notifoption;
?>