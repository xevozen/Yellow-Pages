<?php
include("db_info.php");
include ("rand_str_gen.php"); 
  
// This function will generate 
// Random string of length 10 
//echo random_strings(10);
$usr_nam=$_POST['usr_nam'];
$usr_eml=$_POST['usr_eml'];
$usr_num=$_POST['usr_num'];
$usr_pwd=$_POST['usr_pwd'];
$usr_rep_pwd=$_POST['usr_rep_pwd'];
$select="SELECT unq_key FROM usr_db WHERE usr_num='$usr_num'";
$details=$path->query($select);#processing of sql
$num=mysqli_num_rows($details);
if($num>0)
{
	$zero="0";
	$select="SELECT unq_key FROM usr_db WHERE usr_num='$usr_num' AND usr_pwd=0 ";
	$details=$path->query($select);
	$num2=mysqli_num_rows($details);
	//echo $num."<br>";
	$select="SELECT unq_key FROM usr_db WHERE usr_num='$usr_num' ";
	$details=$path->query($select);
	$row=mysqli_fetch_assoc($details);
	//echo "Dubplicate Account";
	if ($num2!=0) {
		if($usr_pwd==$usr_rep_pwd)
		{
			
			$unq_key=$row['unq_key'];
			//echo $unq_key."<br>";
			$sql = "CREATE TABLE ".$unq_key." (
				unq_key VARCHAR(5) PRIMARY KEY, 
				usr_nam VARCHAR(50) NULL
				)";
			$path->query($sql);
			$label="password Matched<br>";
			//echo "Password Matched<br>";
			$label.="Account Created Successfully<br>";
			//echo "Account Created Successfully";
			$update="UPDATE usr_db SET usr_nam='$usr_nam', usr_num='$usr_num', usr_eml='$usr_eml', usr_pwd='$usr_pwd' WHERE unq_key='$unq_key' ";
			/*$insert="INSERT INTO usr_db SET unq_key='$unq_key', usr_nam='$usr_nam', usr_num='$usr_num', usr_eml='$usr_eml', usr_pwd='$usr_pwd' ";*/
			$path->query($update);
			//session_id('id');
			session_start();
			$_SESSION['unq_key']=$unq_key;
			if(isset($_SESSION['last_screen']))
			{
				$label.="Redirecting to.........";
				//echo "Redirecting to...";
				$redirect=$_SESSION['last_screen'];
				//echo $redirect;
				$label.=$redirect;
				header("refresh:2; url=$redirect ");
			}
			else
			{
				$label.="Loading Dashboard";
				//echo "<br>Loading Dashboard";
				header( "refresh:5;url=session.php" );
			}
		}
		else
		{
			$label="Password did not matched..try again<br>Returning to home screen";
			//echo "<br>";
			//echo "Password did not matched";
			//echo "<br>Returning to home screen";
			header( "refresh:5;url=../index.php" );
		}
			# code...
	}
	else{
		$label="Account already exists<br>Returning to home screen";
		//echo "Account already exists";
		//echo "<br>Returning to home screen";
		header( "refresh:5;url=../index.php" );
	}
}
else
{
	if($usr_pwd==$usr_rep_pwd)
	{
		$flag=1;
		while($flag)
		{
			$unq_key=random_strings(5);
			$verify="SELECT unq_key FROM usr_db WHERE unq_key='$unq_key' ";
			$details=$path->query($select);#processing of sql
			$num=mysqli_num_rows($details);
			if($num==0)
				$flag=0;
		}
		$sql = "CREATE TABLE ".$unq_key." (
		unq_key VARCHAR(5) PRIMARY KEY, 
		usr_nam VARCHAR(50) NULL
		)";
		//$sql = "CREATE TABLE ".$unq_key." (unq_key TEXT(5) PRIMARY KEY, usr_nam TEXT(50))";
		$path->query($sql);
		$label="New account created<br>password Matched<br>";
		$label.="Account Created Successfully<br>";
		//echo "New account created<br>";
		//echo "Password Matched<br>";
		//echo "Account Created Successfully";
		$insert="INSERT INTO usr_db SET unq_key='$unq_key', usr_nam='$usr_nam', usr_num='$usr_num', usr_eml='$usr_eml', usr_pwd='$usr_pwd' ";
		$path->query($insert);
		//session_id('id');
		session_start();
		$_SESSION['unq_key']=$unq_key;
		if(isset($_SESSION['last_screen']))
			{
				$label.="Redirecting to.........";
				//echo "Redirecting to...";
				$redirect=$_SESSION['last_screen'];
				//echo $redirect;
				$label.=$redirect;
				header("refresh:2; url=$redirect");
			}
			else
			{
				$label.="Loading Dashboard";
				//echo "<br>Loading Dashboard";
				header( "refresh:5;url=session.php" );
			}
		//echo "<br>Loading Dashboard<br>";
		//header( "refresh:5;url=session.php" );
	}
	else
	{
		$label="Password did not matched..try again<br>Returning to home screen";
		//echo "<br>";
		//echo "Password did not matched";
		//echo "<br>Return to home screen";
		header( "refresh:5;url=../index.php" );
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../css/add new.css">
    <link rel="stylesheet" type="text/css" href="../css/common.css">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
	svg {
	  position: relative;
	  width: 120px;
	  height: 60px;
	  right: 0;
	  bottom: 0; left: 0; 
	  margin: auto;
	}
	</style>
	<script>
	  window.console = window.console || function(t) {};
	</script>
	<script>
	  if (document.location.search.match(/type=embed/gi)) {
	    window.parent.postMessage("resize", "*");
	  }
	</script>



</head>
<body>
	<img src="../media/telephone directory.jpg" alt="backgound" class="bg" />
    <div id="header-title"><a href="index.php"><img style="height: 100px;" src="../media/main_icon.png"></a></div>
    <div id="blank-shift"></div>
    <div class="container">
        <div class="topnav">
        	<img src="../media/blank_profile_picture.jpg">
            <a>Log In</a>
            <a>Sign Up</a>
        </div>
    </div>
	<div id="addnew-container">
        <div id="addnew" style="background: #f05a30;">
            <label id="addnew-head">Sign Up</label>
            <form id="addnew-form" >
            	<br><br>
            	<label><?php echo $label; ?></label><br>
            	<svg version="1.1" id="preloader" x="0px" y="0px" width="120px" height="60px" viewBox="0 0 240 120">
				<style type="text/css">
						#plug,
						#socket { fill:lightblue }
						#loop-normal { fill: none; stroke: lightblue; stroke-width: 12 }
						#loop-offset { display: none }	
				</style>
				<path id="loop-normal" class="st1" d="M120.5,60.5L146.48,87.02c14.64,14.64,38.39,14.65,53.03,0s14.64-38.39,0-53.03s-38.39-14.65-53.03,0L120.5,60.5
				L94.52,87.02c-14.64,14.64-38.39,14.64-53.03,0c-14.64-14.64-14.64-38.39,0-53.03c14.65-14.64,38.39-14.65,53.03,0z">
				<animate attributeName="stroke-dasharray" attributeType="XML" from="500, 50" to="450 50" begin="0s" dur="2s" repeatCount="indefinite"></animate>
				<animate attributeName="stroke-dashoffset" attributeType="XML" from="-40" to="-540" begin="0s" dur="2s" repeatCount="indefinite"></animate>
				</path>
				<path id="loop-offset" d="M146.48,87.02c14.64,14.64,38.39,14.65,53.03,0s14.64-38.39,0-53.03s-38.39-14.65-53.03,0L120.5,60.5
				L94.52,87.02c-14.64,14.64-38.39,14.64-53.03,0c-14.64-14.64-14.64-38.39,0-53.03c14.65-14.64,38.39-14.65,53.03,0L120.5,60.5
				L146.48,87.02z"></path>
				<path id="socket" d="M7.5,0c0,8.28-6.72,15-15,15l0-30C0.78-15,7.5-8.28,7.5,0z"></path>
				<path id="plug" d="M0,9l15,0l0-5H0v-8.5l15,0l0-5H0V-15c-8.29,0-15,6.71-15,15c0,8.28,6.71,15,15,15V9z"></path>
				<animateMotion xlink:href="#plug" dur="2s" rotate="auto" repeatCount="indefinite" calcMode="linear" keyTimes="0;1" keySplines="0.42, 0, 0.58, 1">
				<mpath xlink:href="#loop-normal"></mpath>
				</animateMotion>
				<animateMotion xlink:href="#socket" dur="2s" rotate="auto" repeatCount="indefinite" calcMode="linear" keyTimes="0;1" keySplines="0.42, 0, 0.58, 1">
				<mpath xlink:href="#loop-offset"></mpath>
				</animateMotion>
				</svg>
				<script>
					!function(){function e(e){t(e),window.PrefixFree&&StyleFix.process()}function t(e){var t=n(),a=document.createElement("style");a.type="text/css",a.className="cp-pen-styles",a.styleSheet?a.styleSheet.cssText=e:a.appendChild(document.createTextNode(e)),c.appendChild(a),t&&t.parentNode.removeChild(t)}function n(){for(var e=document.getElementsByTagName("style"),t=e.length-1;t>=0;t--)if("cp-pen-styles"===e[t].className)return e[t];return!1}function a(e){window.addEventListener?window.addEventListener("message",e,!1):window.attachEvent("onmessage",e)}function s(e,t){try{if(!/codepen/.test(e.origin))return null;if("object"!=typeof e.data)return null;if(e.data.action===t)return e.data}catch(n){}return null}var c=document.head||document.getElementsByTagName("head")[0],r="ACTION_LIVE_VIEW_RELOAD_CSS";a(function(t){var n=s(t,r);n&&e(n.data.css)})}();
				</script>
            </form>
        </div>
    </div>
    <div class="footer">
        <br>
        <marquee>Developed by SOUHARDHYA PAUL</marquee>
    </div>
</body>
</html>