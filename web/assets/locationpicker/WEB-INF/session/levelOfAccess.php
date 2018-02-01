<?php

session_start();
ob_start();
if ($_SESSION['usertype']!=102 and $_SESSION['usertype']!=101 and $_SESSION['usertype']!=104 ){
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
}
else if($_SESSION['usertype']==101){
 include '../navigation/nav_admin.php';
}
else if ($_SESSION['usertype']==102){
	 include '../navigation/nav_dealer.php';
}
else if($_SESSION['usertype']==104){
 include '../navigation/nav_farmer.php';
}
?>