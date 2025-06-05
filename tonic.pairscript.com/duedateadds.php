<?php
include ('lcheck.php');
if (isset($_POST['submit'])) {
if (isset($_POST['duedate'])) {
$duedate = mysqli_real_escape_string($con, $_POST['duedate']);
} else {
$duedate = " ";
}
if (isset($_POST['noofdays'])) {
$noofdays = mysqli_real_escape_string($con, $_POST['noofdays']);
} else {
$noofdays = " ";
}
$msg = "";
$msg_class = "";
if (($duedate != "" || $duedate == "")) {
$sqlcon = "SELECT id From pairduedates WHERE duedate = '{$duedate}' and noofdays = '{$noofdays}' and (createdid='$companymainid' or createdid='0')";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if (!$querycon) {
die("SQL query failed: " . mysqli_error($con));
}
if ($rowCountcon == 0) {
$sqlup = "insert into pairduedates set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', duedate='$duedate', noofdays='$noofdays'";
$queryup = mysqli_query($con, $sqlup);
if (!$queryup) {
die("SQL query failed: " . mysqli_error($con));
} else {
$tid = mysqli_insert_id($con);
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Due Date', '{$tid}')");
echo "Added Successfully|".$tid;
}
} else {
echo "This record is Already Found! Kindly check in All Due Dates List|0";
}
} else {
echo "Error Data|0";
}
}
?>