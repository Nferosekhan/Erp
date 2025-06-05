<?php
include('lcheck.php');
if(isset($_GET['cid']))
{
$franchisesession=mysqli_real_escape_string($con, $_GET['cid']);
$page=mysqli_real_escape_string($con, $_GET['type']);
$_SESSION['franchisesession']=$franchisesession;
header("Location: ".$page.".php");
}
?>