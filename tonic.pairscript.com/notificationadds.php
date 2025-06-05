<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	date_default_timezone_set('Asia/Calcutta');
$createdon=date('Y-m-d H:i:s');
$notification=mysqli_real_escape_string($con, $_POST['notification']);
if($vendorid=='')
{
$sqlcon = "SELECT id From pairnotifications WHERE createdid='$companymainid' and notification = '{$notification}'";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
   die("SQL query failed: " . mysqli_error($con));
}
if($rowCountcon == 0) 
{   
$sqlup = "insert into pairnotifications set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', notification='$notification'";
$queryup = mysqli_query($con, $sqlup);
if(!$queryup){
   die("SQL query failed: " . mysqli_error($con));
}
else
{
$tid=mysqli_insert_id($con);
$notificationid=$tid;

$sqlis=mysqli_query($con, "select id from pairfranchises where createdid='$companymainid'");
while($infos=mysqli_fetch_array($sqlis))
{
$sqlup2 = "insert into pairnothistory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', notificationid='$notificationid'";
$queryup2 = mysqli_query($con, $sqlup2);
}
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Notification', '{$tid}')");
header("Location: dashboard.php?remarks=Notification is Published Successfully");
} 
}
else
{
	header("Location: dashboard.php?error=This Notification is already Published");
}
}	
else
{
	header("Location: dashboard.php?error=This Notification is Empty");
}	
}
else
{
	header("Location: dashboard.php");
}
?>