<?php
include('lcheck.php');
if(isset($_POST['franchisesession']))
{
$franchisesession=mysqli_real_escape_string($con, $_POST['franchisesession']);
$_SESSION['franchisesession']=$franchisesession;
$url=explode('?',$_POST['url']);
$urlamp = explode('&', $url[1]);
$pagetomove = 'Location: '.$url[0].'?remarks=Franchise Changed Successfully';
foreach($urlamp as $urlamps) {
if ($urlamps!='') {
if (!str_contains($urlamps, "error")) {
if (!str_contains($urlamps, "remarks")) {
$pagetomove .= "&".$urlamps;
}
}
}
}
header($pagetomove);
}
?>