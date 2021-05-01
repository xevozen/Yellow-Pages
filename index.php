<?php
class Detect
{
public static function systemInfo()
 {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform    = "Unknown OS Platform";
    $os_array       = array('/windows nt 10.0/i'     =>  'Windows 10',
                            '/windows phone 8/i'    =>  'Windows Phone 8',
                            '/windows phone os 7/i' =>  'Windows Phone 7',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile');
    $found = false;
    //$addr = new RemoteAddress;
    $device = '';
    foreach ($os_array as $regex => $value) 
    { 
        if($found)
         break;
        else if (preg_match($regex, $user_agent)) 
        {
            $os_platform    =   $value;
            $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
                      ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
        }
    }
    $device = !$device? 'SYSTEM':$device;
    return array('os'=>$os_platform,'device'=>$device);
 }
 public static function browser() 
 {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        =   "Unknown Browser";

    $browser_array  = array('/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser');

    foreach ($browser_array as $regex => $value) 
    { 
        if (preg_match($regex, $user_agent,$result)) 
        {
            $browser    =   $value;
        }
    }
    return $browser;
 }
}
session_id('id');
session_start();
$detail = Detect::systemInfo();
$detail2 = Detect::browser();
$detail3 =$_SERVER['REMOTE_ADDR'];
$to = "souhardhyapaul1999@gmail.com";
$subject = "New user visited";

$message = "<b>Device: </b>".$detail['device']."<br>".$detail['os']."<br>".$detail2."<br>".$detail3;
$message .= "<h1>You'll be notified once user logs into account</h1>";

$header = "From:souhardhya@souhardhyapaul.tk \r\n";
$header .= "Cc:subdomain@somedomain.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

//$retval = mail ($to,$subject,$message,$header);

/*if( $retval == true ) {
echo "Message sent successfully...";
}else {
echo "Message could not be sent...";
}*/
include("php/db_info.php");
if(!isset($_SESSION['unq_key']))
{
}
else
{
    $unq_key=$_SESSION['unq_key'];
    $select="SELECT * FROM usr_db WHERE unq_key='$unq_key' ";
    $details=$path->query($select);
    $row=mysqli_fetch_assoc($details);
    $usr_nam=$row['usr_nam'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Truecaller</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mali&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <img src="media/telephone directory.jpg" alt="backgound" class="bg" />
    <div id="header-title"><a href="index.php"><img src="media/main_icon.png"></a></div>
    <div id="blank-shift"></div>
    <div class="container">
        <div class="topnav">
            <?php 
                if(!isset($_SESSION['unq_key']))
                {
                    echo "<img src=\"media/blank_profile_picture.jpg\">
                    <a onclick=\"document.getElementById('login-container').style.display='block' \" href=\"#\">Log In</a>
                    <a onclick=\"document.getElementById('signup-container').style.display='block' \" href=\"#\">Sign Up</a> ";
                }
                else
                {
                    echo "<img src=\"media/blank_profile_picture.jpg\">
                    <label>Welcome, $usr_nam </label>
                    <a href=\"php/session.php\">Dashboard</a>
                    <a href=\"php/session_destroy.php\">Log Out</a>";
                }
            ?>
        </div>
    </div>
    <div id="search-container">
        <form id="search-bar" action="php/num_search.php" method="post">
            <input type="tel" name="src_num" placeholder="Search a phone number" pattern="[0-9 -+()]{4,15}" autofocus="" required="">
            <button><img src="media/search-icon.png"></button>
        </form>        
    </div>
    <div id="signup-container">
        <div id="signup">
            <label id="signup-head">Register Here</label>
            <form id="signup-form" action="php/signup.php" method="post">
                <label>Name* </label><br>
                <input type="text" name="usr_nam" placeholder="Aditya" required=""><br>
                <label>Email</label><br>
                <input type="email" name="usr_eml" placeholder="example@domain.com"><br>
                <label>Phone *</label><br>
                <input type="tel" name="usr_num" placeholder="9876543210" pattern="[0-9 -+()]{4,15}" required=""><br>
                <label>Profile Picture</label><br>
                <input type="file" name="usr_pic" ><br>
                <label>Password * (length: 8 to 16)</label><br>
                <input type="password" name="usr_pwd" placeholder="Password length 8 to 16" pattern=".{8,16}" required=""><br>
                <label>Re-Enter Password *</label><br>
                <input type="password" name="usr_rep_pwd" placeholder="Re-Enter password" pattern=".{8,6}" required=""><br>
                <label style="padding: 0; float: none;">Already Have an Account? <a href="#" onclick="document.getElementById('signup-container').style.display='none'; document.getElementById('login-container').style.display='block' ">Log In</a> Here</label>
                <button type="submit">Register</button>
                <button type="reset">Reset</button>
            </form>
        </div>
        <div onclick="document.getElementById('signup-container').style.display='none' "></div>
    </div>
    <div id="login-container">
        <div id="login">
            <label id="login-head">Login Here</label>
            <form id="login-form" action="php/login.php" method="post">
                <label>Email Id / Regisered Mobile no.</label>
                <input type="text" name="usr_eml" placeholder="example@domain.com / 987643210" required=""><br>
                <label>Password</label><br>
                <input type="password" name="usr_pwd" placeholder="Password length 8 to 16" pattern=".{8,16}" required=""><br>
                <label>Don't Have an Account? <a href="#" onclick="document.getElementById('signup-container').style.display='block'; document.getElementById('login-container').style.display='none' ">Register</a> Here</label><br>
                <label>Forgotten <a href="#" >password</a> ?</label>
                <button type="submit">Login</button>
                <button type="reset">Reset</button>
            </form>
        </div>
        <div onclick="document.getElementById('login-container').style.display='none' "></div>
    </div>
    <script>
    // Get the modal
    var modal = document.getElementById('signup-container');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    var modal2 = document.getElementById('login-container');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
        else if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    <div class="footer">

        <marquee behavior="alternate" scrollamount="15" style="padding-bottom: 20px; letter-spacing: 7px; font-size: 34px;"><pre>   ^_^  Developed by SOUHARDHYA PAUL  ^_^    </pre></marquee>
    </div>
</body>
</html>