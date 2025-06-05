<?php
include('session.php');
include('bd.php');
if(((isset($_SESSION['unqwerty']))&&(isset($_SESSION['psqwerty'])))||((isset($_COOKIE['unqwerty']))&&(isset($_COOKIE['psqwerty']))))
{
if(((isset($_SESSION['unqwerty']))&&(isset($_SESSION['psqwerty']))))
{	
$username = $_SESSION['unqwerty'];  
$password = $_SESSION['psqwerty'];  
}
if(((isset($_COOKIE['unqwerty']))&&(isset($_COOKIE['psqwerty']))))
{
$username = $_COOKIE['unqwerty'];  
$password = $_COOKIE['psqwerty'];  	
}
$username = stripcslashes($username);  
$password = stripcslashes($password);  
$username = mysqli_real_escape_string($con, $username);  
$password = mysqli_real_escape_string($con, $password);  
$sql = "select is_active,username,password,firstname,profileimage,id,items,invoice,customer,settings,email,role,franchises,reseton,createdid,createdby,permissionfranchise,permissionuser,permissionpreference,preferencefranchisepermission,permissionuserr,permissionbooks,permissionconfig,language,time,currency,taxes,storeaccess,permissiondashboard,permissionmyaccount,permissioninsights,permissionnotification,permissionhelp,permissionsidebooks,permissiondeepbooks,franchiseandroles, userandroles, books, franchises, languages, countries, currencies from paircontrols where (username = '$username' or usernewname = '$username') and password = '$password'";  
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);  
if($count>0)
{	
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row['is_active']=='0')
{
	
$_SESSION["unqwerty"] = $row['username'];
$_SESSION["psqwerty"] = $row['password'];
$_SESSION["firstname"] = $row['firstname'];
$_SESSION["profileimage"] = str_replace('../ups','ups',$row['profileimage']);
setcookie('unqwerty', $row['username'], time() + (86400 * 30), "/");    
setcookie('psqwerty', $row['password'], time() + (86400 * 30), "/");
setcookie('firstname', $row['firstname'], time() + (86400 * 30), "/");
setcookie('profileimage', str_replace('../ups','ups',$row['profileimage']), time() + (86400 * 30), "/");
if(isset($_SESSION['rememberMe']))
{
setcookie('rememberMe', $_SESSION['rememberMe'], time() + (86400 * 30), "/");
}
$userid=$row['id'];
$itemsaction=$row['items'];
$invoiceaction=$row['invoice'];
$customeraction=$row['customer'];
$settingsaction=$row['settings'];
$currentuseremail=$row['email'];
$currentuserid=$row['id'];
$currentusername=$row['firstname'];
/*******PERMISSION FROM CONTROL*******/

$userrole=$row['role'];
$franchisesrole=$row['franchises'];
$lastreseton=$row['reseton'];
if($userrole=='SUPER ADMIN')
{
	$companymainid=$row['id'];
	$accessnamefor=$row['username'];
}
else
{
	$companymainid=$row['createdid'];
	$accessnamefor=$row['createdby'];
}
$sqliexpdate=mysqli_query($con, "select expdate,remindon from paircontrols where id='".$companymainid."' order by id desc");
$infoexpdate=mysqli_fetch_array($sqliexpdate);
$expiryDate = strtotime($infoexpdate['expdate'] . ' 24:00:00');
$reminderDays = $infoexpdate['remindon'];
$currentDate = time();
if ($currentDate >= $expiryDate) {
session_start();
session_unset();
session_destroy();
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
header('Location: index.php?error=Your license is expired. Contact Pairscript to activate it.');
}
$franpos = 'TAMIL NADU (33)';
$sqlmaincurrency=mysqli_query($con,"select * from paircurrency");
$rowmaincurrency=mysqli_fetch_array($sqlmaincurrency);
$ansmaincurrency=$rowmaincurrency['currencysymbol'];
$resmaincurrency=explode('-',$ansmaincurrency);
$resmaincurrencyans=$resmaincurrency[0];
$dateformatmainphp = mysqli_query($con,"select * from paricountry");
$datefetchmainphp = mysqli_fetch_array($dateformatmainphp);
if ($datefetchmainphp['date']=='DD/MM/YYYY') {
$datemainphp = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if(($franchisesrole!='')&&(!isset($_SESSION['franchisesession'])))
{
$sqlifr=mysqli_query($con, "select id from pairfranchises where id in (".$franchisesrole.") order by id asc");
$infofr=mysqli_fetch_array($sqlifr);
$_SESSION['franchisesession']=$infofr['id'];
}
if ($franchisesrole!='') {
if ($_SESSION['franchisesession']=='') {
$franchisesrole = '';
}
}
if ($franchisesrole!='') {
$sqlifranch=mysqli_query($con, "select id from pairfranchises where id in (".$franchisesrole.") and astatus='0' order by id desc");
if (mysqli_num_rows($sqlifranch)==0) {
$franchisesrole = '';
}
}

/*******PERMISSION FROM CONTROL*******/

$permissionfranchise=$row['permissionfranchise'];
$permissionuser=$row['permissionuser'];
$permissionpreference=$row['permissionpreference'];
$preferencefranchisepermission=$row['preferencefranchisepermission'];
$permissionuserr=$row['permissionuserr'];
$permissionbooks=$row['permissionbooks'];
$permissionconfig=$row['permissionconfig'];
$language=$row['language'];
$time=$row['time'];
$currency=$row['currency'];
$taxes=$row['taxes'];
$storeaccess=$row['storeaccess'];

$permissiondashboard=$row['permissiondashboard'];
$permissionmyaccount=$row['permissionmyaccount'];
$permissioninsights=$row['permissioninsights'];
$permissionnotification=$row['permissionnotification'];
$permissionhelp=$row['permissionhelp'];
$permissionsidebooks=$row['permissionsidebooks'];
// $permissiondeepbooks=$row['permissiondeepbooks'];

$parray=array(  'permissiondashboard', 'permissionnotification', 'permissionhelp', 'permissioninsights', 'permissionmyaccount', 'permissionfranchise', 'permissionuser', 'permissionpreference', 'preferencefranchisepermission', 'permissionuserr', 'permissionbooks', 'permissionconfig', 'language', 'time', 'currency', 'taxes', 'franchiseandroles', 'userandroles', 'books', 'franchises', 'languages', 'countries', 'currencies', 'storeaccess');
foreach($parray as $pa)
{
	${'pm'.$pa}=$row[$pa];
}



}

else
{  
header('Location: index.php?error=Your Accout is Disabled. Please Contact Administrator');  
}
}  
else
{  
header('Location: index.php?error=Login failed. Invalid username or password.');  
}
}
else
{
header('Location: logout.php?error=Login failed. Invalid username or password.');  	
}
function calculateOverdueDays($dueDate, $currentDate) {
    if($dueDate==''){
        return "No Due";
    }
    else{
        $dueDateTime = new DateTime($dueDate);
        $currentDateTime = new DateTime($currentDate);
        $interval = $currentDateTime->diff($dueDateTime);
        $overdueDays = $interval->days;
        if ($overdueDays > 0) {
            return $overdueDays . " " . ($overdueDays == 1 ? "day" : "days") . (($dueDateTime<$currentDateTime)?' Over Due':'');
        }
        else {
            return "Today";
        }
    }
}
function argon2idHash($plaintext, $password, $encoding = null) {
    $plaintextsecured = hash_hmac("sha256", $plaintext, $password);
    return $encoding == "hex" ? bin2hex(password_hash($plaintextsecured, PASSWORD_ARGON2ID)) : ($encoding == "base64" ? base64_encode(password_hash($plaintextsecured, PASSWORD_ARGON2ID)) : password_hash($plaintextsecured, PASSWORD_ARGON2ID));
}
function argon2idHashVerify($plaintext, $password, $hash, $encoding = null) {
    $plaintextsecured = hash_hmac("sha256", $plaintext, $password);
    return password_verify($plaintextsecured, $encoding == "hex" ? hex2bin($hash) : ($encoding == "base64" ? base64_decode($hash) : $hash)) ? true : false;
}
?>