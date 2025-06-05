<?php
include ('lcheck.php');
if (isset($_POST['submit'])) {
$chartaccounttypegroup = mysqli_real_escape_string($con, $_POST['chartaccounttypegroup']);
$chartaccounttypelists = mysqli_real_escape_string($con, $_POST['chartaccounttypelists']);
$sqlcon = "SELECT id From pairchartaccounttypes WHERE chartaccounttypelists = '$chartaccounttypelists' and chartaccounttypegroup = '$chartaccounttypegroup' and (createdid='0' or createdid='$companymainid') and (franchisesession='0' or franchisesession='".$_SESSION['franchisesession']."')";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if (!$querycon) {
die("SQL query failed: " . mysqli_error($con));
}
if ($rowCountcon == 0) {
$sqlup = "insert into pairchartaccounttypes set createdon='$times', createdby='" . $_SESSION["unqwerty"] . "', createdid='$companymainid',franchisesession='".$_SESSION['franchisesession']."', chartaccounttypegroup='$chartaccounttypegroup', chartaccounttypelists='$chartaccounttypelists'";
$queryup = mysqli_query($con, $sqlup);
if (!$queryup) {
die("SQL query failed: " . mysqli_error($con));
}
else {
$tid = mysqli_insert_id($con);
$ch='';
if($ch!='')
{
	$ch.='<br> Account Group <span style="color:green;" id="prohisfromtospan">( '.$chartaccounttypegroup.' ) </span>';
}
else
{
	$ch.='Account Group <span style="color:green;" id="prohisfromtospan">( '.$chartaccounttypegroup.' ) </span>';
}
if($ch!='')
{
	$ch.='<br> Account Name <span style="color:green;" id="prohisfromtospan">( '.$chartaccounttypelists.' ) </span>';
}
else
{
	$ch.='Account Name <span style="color:green;" id="prohisfromtospan">( '.$chartaccounttypelists.' ) </span>';
}
mysqli_query($con, "insert into pairusehistory set usetype='CHARTACCOUNTTYPE', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$tid', useremarks='".$ch."'");
echo "Added Successfully|".$tid;
}
}
else {
echo "This record is Already Found! Kindly check in All Account Category List|0";
}
}
?>