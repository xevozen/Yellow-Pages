<?php
include("db_info.php");
session_id('id');
session_start();
if (!isset($_SESSION['unq_key']))
{
	//sleep(2);
	//header("location:../index.php");
	# code...
}
else
{
	$unq_key=$_SESSION['unq_key'];
	$select="SELECT * FROM usr_db WHERE unq_key='$unq_key' ";
	$details=$path->query($select);
	$row=mysqli_fetch_assoc($details);
	$usr_nam=$row['usr_nam'];
	$usr_num=$row['usr_num'];
	$usr_eml=$row['usr_eml'];
	//echo $row['unq_key']."<br>";
	//echo "Usename: ".$usr_nam."<br>User Number: ".$usr_num."<br>User Email: ".$usr_eml."<br>Unique Key: ".$unq_key."<br>";
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Truecaller</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/common.css">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img src="../media/telephone directory.jpg" alt="backgound" class="bg" >
    <div id="header-title"><a href="../index.php"><img style="height: 100px;" src="../media/main_icon.png"></a></div>
    <div id="blank-shift"></div>
    <div class="container">
        <div class="topnav">
            <?php 
                if(!isset($_SESSION['unq_key']))
                {
                    echo "<img src=\"../media/blank_profile_picture.jpg\">
                    <a onclick=\"document.getElementById('login-container').style.display='block' \" href=\"#\">Log In</a>
                    <a onclick=\"document.getElementById('signup-container').style.display='block' \" href=\"#\">Sign Up</a> ";
                    header("refresh:5;url=../index.php");
                }
                else
                {
                    echo "<img src=\"../media/blank_profile_picture.jpg\">
                    <label>Welcome, $usr_nam </label>
                    <a href=\"user_info.php\">My Account</a>
                    <a href=\"../html/add_new.html\">Add New</a>
					<a href=\"session_destroy.php\">Log Out</a>";
                }
            ?>
        </div>
    </div>
    <div id="table-container">
    	<div id="scrollbar" class="table1">
	    	<table>
				<col width="auto">
				<col width="auto">
				<col width="auto">
				<col width="60">

				<tr>
					<th><strong>Contact Name</strong></th>
					<th><strong>Contact Number</strong></th>
					<th><strong>#Unique Key</strong></th>
					<th>Delete</th>
				</tr>
				<?php
				
					$select="SELECT * FROM ".$unq_key;
					$details=$path->query($select);
					//echo mysqli_num_rows($details);
					if (mysqli_num_rows($details)>0) {
						$con_unq_kys = array();
						$i=0;
						while ($row=mysqli_fetch_assoc($details)) {
							$con_unq_kys[$i]=$row['unq_key'];
							$con_unq_key=$con_unq_kys[$i++];
							$con_usr_nam=$row['usr_nam'];
							$retrieve="SELECT usr_num FROM usr_db WHERE unq_key='$con_unq_key' ";
							$retrieve2=$path->query($retrieve);
							$row=mysqli_fetch_assoc($retrieve2);
							$con_usr_num=$row['usr_num'];
							echo "<tr>
									<th>$con_usr_nam</th>
									<th>$con_usr_num</th>
									<th>$con_unq_key</th>
									<th><button><a href=\"rem_con.php?con_unq_key=$con_unq_key\">Delete</a></button></th>
								</tr>";				
						}
						
					}
					else{
						echo "<tr>
								<th>No Record</th>
								<th>No Record`</th>
								<th>No Record</th>
							</tr>";
					}
				?>
	    	</table> 
    	</div> 	
    </div>


    <div class="footer">
        <marquee behavior="alternate" scrollamount="15" style="padding-bottom: 20px; letter-spacing: 7px; font-size: 34px;"><pre>   ^_^  Developed by SOUHARDHYA PAUL  ^_^    </pre></marquee>
    </div>
</body>
</html>