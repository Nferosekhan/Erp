<?php      
$host = "localhost";  
$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
$user = "tonic_pairscript";  
$password = 'dNzy2GXyLRteHFbW';  
$db_name = "tonic_pairscript"; 
}
else
{
$user = "root";  
$password = '';  
$db_name = "tonic_pairscript"; 
}
$con = mysqli_connect($host, $user, $password, $db_name);  
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>