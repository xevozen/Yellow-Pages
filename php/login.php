<!DOCTYPE html>
<html>
<head>
	<title>Log In Here</title>
</head>
</html>

<?php
include("db_info.php");
$usr_eml=$_POST['usr_eml'];
$usr_pwd=$_POST['usr_pwd'];
$path=mysqli_connect($ip,$user,$password,$dbname);#db linked
$select="SELECT * FROM usr_db WHERE usr_eml='$usr_eml'AND usr_pwd='$usr_pwd' OR usr_num='$usr_eml' AND usr_pwd='$usr_pwd'";
$details=$path->query($select);#processing of sql
$num=mysqli_num_rows($details);
//echo $num."<br>";
if($num>0){
	
	//echo "Login Successful!";
	$c="SELECT * FROM usr_db WHERE usr_pwd='$usr_pwd' AND usr_eml='$usr_eml' OR usr_pwd='$usr_pwd' AND usr_num='$usr_eml' ";
	$q=$path->query($c);
	if(mysqli_num_rows($q)>0)
	{
		$label="Login Successful<br>";
		session_id('id');
		session_start();
		$row=mysqli_fetch_assoc($q);
		$_SESSION['unq_key']=$row['unq_key'];
		if(isset($_SESSION['last_screen']))
		{
			$label.="Redirecting to........";
			//echo "Redirecting to...";
			$redirect=$_SESSION['last_screen'];
			$label.=$redirect;
			//echo $redirect;
			header("refresh:5; url=$redirect ");
		}
		else
		{
			$label.="Loading Dashboard";
			//echo "<br>Loading Dashboard";
			echo "<script>alert('login successfull');</script>";
			header( "refresh:5;url=session.php" );
		}
	}
	else
	{
		$label="Wrong Password<br> Redirecting to.........index page";
		//echo "Wrong Password";
		header( "refresh:5;url=../index.php");
	}
}
else{
	$label="Invalid Login Credentials<br> Redirecting to..........index page";
	//echo "Invalid login credentials!";
	header( "refresh:5;url=../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
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
            <label id="addnew-head">Log In</label>
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