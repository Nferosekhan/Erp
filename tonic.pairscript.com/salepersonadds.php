<?php
include ('lcheck.php');
if (isset($_POST['submit'])) {
if (isset($_POST['saleperson'])) {
$saleperson = mysqli_real_escape_string($con, $_POST['saleperson']);
} else {
$saleperson = " ";
}
$msg = "";
$msg_class = "";
if (($saleperson != "" || $saleperson == "")) {
$sqlcon = "SELECT id From pairsaleperson WHERE saleperson = '{$saleperson}' and createdid='$companymainid'";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if (!$querycon) {
die("SQL query failed: " . mysqli_error($con));
}
if ($rowCountcon == 0) {
$sqlup = "insert into pairsaleperson set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', saleperson='$saleperson'";
$queryup = mysqli_query($con, $sqlup);
if (!$queryup) {
die("SQL query failed: " . mysqli_error($con));
} else {
$tid = mysqli_insert_id($con);
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Sale Person', '{$tid}')");
echo "Added Successfully|".$tid;
}
} else {
echo "This record is Already Found! Kindly check in All Sale Person List|0";
}
} else {
echo "Error Data|0";
}
}
?>