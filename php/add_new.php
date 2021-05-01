<?php
include("db_info.php");
include("rand_str_gen.php");
session_id('id');
session_start();
if (!isset($_SESSION['unq_key']))
{
	sleep(2);
	header("location:../index.php");
	# code...
}
else
{
	if(isset($_GET['btn1']))
	{
		$usr_nam=$_GET['usr_nam'];
		$usr_num=$_GET['usr_num'];
		if(!empty($usr_num))
		{
			$unq_key=$_SESSION['unq_key'];
			$select="SELECT unq_key FROM usr_db WHERE usr_num='$usr_num'";
			$details=$path->query($select);
			$num=mysqli_num_rows($details);
			if($num>0){
				$row=mysqli_fetch_assoc($details);
				$con_unq_key=$row['unq_key'];

			}
			else{
				$flag=1;
				while($flag)
				{
					$con_unq_key=random_strings(5);
					$verify="SELECT unq_key FROM usr_db WHERE unq_key='$con_unq_key'";
					$details=$path->query($verify);#processing of sql
					$num=mysqli_num_rows($details);
					if($num==0)
						$flag=0;
				}
				$insert="INSERT INTO usr_db SET unq_key='$con_unq_key', usr_nam='$usr_nam', usr_num='$usr_num' ";
				$path->query($insert);
			}
			if ($unq_key==$con_unq_key) {
				# code...
				$label="It's your details<br>Your data cannot be added!";
				//echo "It's your details";
			}
			else{
				$insert="INSERT INTO ".$unq_key." SET unq_key='$con_unq_key', usr_nam='$usr_nam' ";
				$details=$path->query($insert);
				$label="Contact Name: ".$usr_nam."<br>Contact Number: ".$usr_num."<br>Your data is being recorded...<br>";
			}
			header( "refresh:5;url=session.php");
		}
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Add new contact</title>
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
            <label id="addnew-head">Add New Contact</label>
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