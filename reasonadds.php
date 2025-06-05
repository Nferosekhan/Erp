<?php
include ('lcheck.php');
if (isset($_POST['submit'])) {
if (isset($_POST['reason'])) {
$reason = mysqli_real_escape_string($con, $_POST['reason']);
} else {
$reason = " ";
}
$itemmodule = mysqli_real_escape_string($con, $_POST['itemmodule']);
$msg = "";
$msg_class = "";
if (($reason != "" || $reason == "")) {
$sqlcon = "SELECT id FROM pairreasons WHERE reason = '{$reason}' AND createdid='$companymainid' AND itemmodule='$itemmodule'";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if (!$querycon) {
die("SQL query failed: " . mysqli_error($con));
}
if ($rowCountcon == 0) {
$sqlup = "insert into pairreasons set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', reason='$reason',itemmodule='$itemmodule'";
$queryup = mysqli_query($con, $sqlup);
if (!$queryup) {
die("SQL query failed: " . mysqli_error($con));
} else {
$tid = mysqli_insert_id($con);
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Term', '{$tid}')");
echo "Added Successfully|".$tid;
}
} else {
echo "This record is Already Found! Kindly check in All Terms List|0";
}
} else {
echo "Error Data|0";
}
}
?>