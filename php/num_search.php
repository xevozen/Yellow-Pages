<?php
include("db_info.php");
session_id('id');
session_start();
//include("rem_con.php");
//header( "refresh:5" );
if(isset($_SESSION['value']))
{
	$str=$_SESSION['value'];
}
else
{
	$str=$_POST['src_num'];
}
if(!isset($_SESSION['unq_key']))
{
	echo "You're not logged in.<br>Redirecting to..login page";
	$_SESSION['last_screen']="num_search.php";
	$_SESSION['value']=$str;
	header( "refresh:2;url=../index.php");
}
else
{
    //echo "session";
    $unq_key=$_SESSION['unq_key'];
    $select="SELECT * FROM usr_db WHERE unq_key='$unq_key' ";
    $details=$path->query($select);
    $row=mysqli_fetch_assoc($details);
    $usr_nam=$row['usr_nam'];
    $usr_num=$row['usr_num'];
    $usr_eml=$row['usr_eml'];
    //echo $row['unq_key']."<br>";
    //echo "Usename: ".$usr_nam."<br>User Number: ".$usr_num."<br>User Email: ".$usr_eml."<br>Unique Key: ".$unq_key."<br><br>";
	$select="SELECT * FROM usr_db WHERE usr_num='$str' ";
	$details=$path->query($select);#processing of sql
	$num=mysqli_num_rows($details);
	if($num>0)
	{
		$row=mysqli_fetch_assoc($details);
		$usr_nam=$row['usr_nam'];
		$usr_num=$row['usr_num'];
		$usr_eml=$row['usr_eml'];
		$unq_key=$row['unq_key'];
		$add_new="add_new.php?btn1=1&usr_nam=".$usr_nam."&usr_num=".$usr_num;
		//echo $row['unq_key']."<br>";
		//echo "Usename: ".$usr_nam."<br>User Number: ".$usr_num."<br>User Email: ".$usr_eml."<br>Unique Key: ".$unq_key."<br>";
	}
	else
	{
		$usr_nam="Sorry!";
		$usr_num="No Records Available";
		$usr_eml="";
		$unq_key="";
		$add_new="#";
		//echo "No data found";
	}
	unset($_SESSION['value']);
	//echo $str;
	header( "refresh:5;url=session.php" );
	echo "<!DOCTYPE html>
		<html>
		<head>
		  <title>Add New Contact</title>
		    <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/contactcard.css\">
		    <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/common.css\">
		    <link href=\"https://fonts.googleapis.com/css?family=Anton&display=swap\" rel=\"stylesheet\">
		    <link href=\"https://fonts.googleapis.com/css?family=Montserrat&display=swap\" rel=\"stylesheet\">
		    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		</head>
		<body>
		  <img src=\"../media/telephone directory.jpg\" alt=\"backgound\" class=\"bg\" />
		    <div id=\"header-title\"><a href=\"../index.php\"><img style=\"height: 100px;\" src=\"../media/main_icon.png\"></a></div>
		    <div id=\"blank-shift\"></div>
		    <div class=\"container\">
		        <div class=\"topnav\">
		          <img src=\"../media/blank_profile_picture.jpg\">
		            <a>Log In</a>
		            <a>Sign Up</a>
		        </div>
		    </div>
		  <div id=\"card-container\">
		        <div id=\"card\">
		            <label id=\"card-head\">Contact Details</label>
		            <hr>
		            <div id=\"card-photo\">
		                <img src=\"../media/blank_profile_picture.jpg\">                
		            </div>
		            <div id=\"vl\"></div>
		            <div id=\"card-details\">
		                <br>
		                <label id=\"name\"><strong>Name: </strong>$usr_nam</label>
		                <br>
		                <br>
		                <label id=\"email\"><strong>Email: </strong>$usr_eml</label>
		                <br>
		                <label id=\"num\"><strong>Number: </strong>$usr_num</label>
		                <br>
		                
		                <label id=\"unq_key\"><strong>Unique Key:  #</strong>$unq_key</label>
		                <br>
		                <br>
		                <a href=$add_new><button id=\"add\">Add To My List</button></a>
		                
		                <a href=\"session.php\"><button id=\"close\">Close</button></a>
		                
		            </div>
		        </div>
		    </div>
		    <div class=\"footer\">
		        <br>
		        <marquee>Developed by SOUHARDHYA PAUL</marquee>
		    </div>
		</body>
		</html>";
		}
?>
