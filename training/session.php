<?php
if(strpos($_SERVER['REQUEST_URI'], "%27") !== false)
{
    $removeurl=str_replace("%27", "", $_SERVER['REQUEST_URI']);
    header("location:".$removeurl);
}
if(isset($_POST))
{
}
else
{
if(strpos($_SERVER['REQUEST_URI'], ".php") !== false)
{
    $removeurl=str_replace(".php", "", $_SERVER['REQUEST_URI']);
    header("location:".$removeurl);
}
}
session_start();
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
$ip = getIPAddress();  
date_default_timezone_set('Asia/Kolkata');
$times=date('Y-m-d H:i:s');	
$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
{
   $actuallink="https://pairscript.com/newtemp";
}
else
{
	$actuallink="http://localhost/newtemp/";
}
$pairscriptcolors=array("#FF6C95", "#6F9FF5", "#04DCCB", "#FF9C7F", "#77808F", "#8A61EA", "#FF5D68", "#C976DB", "#FEC368", "#02DB9E", "#398CE8", "#028FFD", "#F0484E", "#767AE3", "#FF7265", "#FEDB02");
$current_file_name = basename($_SERVER['PHP_SELF']);function getOS() { 		$user_agent = $_SERVER['HTTP_USER_AGENT'];	$os_platform =   "";	$os_array =   array(		'/windows nt 10/i'      =>  'Windows 10',		'/windows nt 6.3/i'     =>  'Windows 8.1',		'/windows nt 6.2/i'     =>  'Windows 8',		'/windows nt 6.1/i'     =>  'Windows 7',		'/windows nt 6.0/i'     =>  'Windows Vista',		'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',		'/windows nt 5.1/i'     =>  'Windows XP',		'/windows xp/i'         =>  'Windows XP',		'/windows nt 5.0/i'     =>  'Windows 2000',		'/windows me/i'         =>  'Windows ME',		'/win98/i'              =>  'Windows 98',		'/win95/i'              =>  'Windows 95',		'/win16/i'              =>  'Windows 3.11',		'/macintosh|mac os x/i' =>  'Mac OS X',		'/mac_powerpc/i'        =>  'Mac OS 9',		'/linux/i'              =>  'Linux',		'/ubuntu/i'             =>  'Ubuntu',		'/iphone/i'             =>  'iPhone',		'/ipod/i'               =>  'iPod',		'/ipad/i'               =>  'iPad',		'/android/i'            =>  'Android',		'/blackberry/i'         =>  'BlackBerry',		'/webos/i'              =>  'Mobile'	);	foreach ( $os_array as $regex => $value ) { 		if ( preg_match($regex, $user_agent ) ) {			$os_platform = $value;		}	}   	return $os_platform;}/** * Kullanicinin kullandigi internet tarayici bilgisini alir. *  * @since 2.0 */function getBrowser() {	$user_agent = $_SERVER['HTTP_USER_AGENT'];	$browser        = "";	$browser_array  = array(		'/msie/i'       =>  'Internet Explorer',		'/firefox/i'    =>  'Firefox',		'/safari/i'     =>  'Safari',		'/chrome/i'     =>  'Chrome',		'/edge/i'       =>  'Edge',		'/opera/i'      =>  'Opera',		'/netscape/i'   =>  'Netscape',		'/maxthon/i'    =>  'Maxthon',		'/konqueror/i'  =>  'Konqueror',		'/mobile/i'     =>  'Handheld Browser'	);	foreach ( $browser_array as $regex => $value ) { 		if ( preg_match( $regex, $user_agent ) ) {			$browser = $value;		}	}	return $browser;}


$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
?>