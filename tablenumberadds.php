<?php
include ('lcheck.php');
if ((isset($_POST['submit']))&&(isset($_POST['permission']))&&($_POST['permission']=='rename')) {
	if (isset($_POST['tablenumber'])) {
		$tablenumber = mysqli_real_escape_string($con, $_POST['tablenumber']);
	}
	else {
		$tablenumber = " ";
	}
	$tableid = mysqli_real_escape_string($con, $_POST['tableid']);
	$msg = "";
	$msg_class = "";
	if (($tablenumber != "" || $tablenumber == "")) {
		$sqlcon = "SELECT id From pairtables WHERE tablenumber = '{$tablenumber}' and createdid='$companymainid'";
		$querycon = mysqli_query($con, $sqlcon);
		$rowCountcon = mysqli_num_rows($querycon);
		if (!$querycon) {
			die("SQL query failed: " . mysqli_error($con));
		}
		if ($rowCountcon == 0) {
			$sqlup = "UPDATE pairtables SET  tablenumber='$tablenumber', tablename='$tablenumber' WHERE id='$tableid'";
			$queryup = mysqli_query($con, $sqlup);
			if (!$queryup) {
				die("SQL query failed: " . mysqli_error($con));
			}
			else {
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Rename A Table Number', '$tableid')");
				echo "Renamed Successfully|$tableid";
			}
		}
		else {
			echo "This record is Already Found! Kindly check in All List|0";
		}
	}
	else {
		echo "Error Data|0";
	}
}
else{
	if (isset($_POST['submit'])) {
	if (isset($_POST['tablenumber'])) {
	$tablenumber = mysqli_real_escape_string($con, $_POST['tablenumber']);
	} else {
	$tablenumber = " ";
	}
	$msg = "";
	$msg_class = "";
	if (($tablenumber != "" || $tablenumber == "")) {
	$sqlcon = "SELECT id From pairtables WHERE tablenumber = '{$tablenumber}' and createdid='$companymainid'";
	$querycon = mysqli_query($con, $sqlcon);
	$rowCountcon = mysqli_num_rows($querycon);
	if (!$querycon) {
	die("SQL query failed: " . mysqli_error($con));
	}
	if ($rowCountcon == 0) {
	$sqlup = "insert into pairtables set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', tablenumber='$tablenumber', tablename='$tablenumber'";
	$queryup = mysqli_query($con, $sqlup);
	if (!$queryup) {
	die("SQL query failed: " . mysqli_error($con));
	} else {
	$tid = mysqli_insert_id($con);
	mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Table Number', '{$tid}')");
	echo "Added Successfully|".$tid;
	}
	} else {
	echo "This record is Already Found! Kindly check in All List|0";
	}
	} else {
	echo "Error Data|0";
	}
	}
}
?>