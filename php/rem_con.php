<?php
$con_unq_key = $_REQUEST["con_unq_key"];
include("db_info.php");
session_id('id');
session_start();
$unq_key=$_SESSION['unq_key'];
$remove="DELETE FROM ".$unq_key." WHERE unq_key='$con_unq_key' ";
$retval=$path->query($remove);
if ($retval) {
	echo "Deleted Successfully";
	header("location:session.php");
	# code...
}
else{
	echo "Could not be Deleted";
}
header("refresh:5;url:session.php");
# code...
?>