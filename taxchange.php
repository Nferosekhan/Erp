<?php
include('lcheck.php');
if (isset($_GET['id'])) {
$id=mysqli_real_escape_string($con, $_GET['id']);
$val=mysqli_real_escape_string($con, $_GET['val']);
if(($id!="")&&($val!=""))
	{		
		// Query if email exists in db
	$sqlcon = "SELECT id From pairtaxrates WHERE id = '{$id}' and createdid='{$companymainid}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        // If query fails, show the reason 
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
        // Check if email exist
        if($rowCountcon > 0) 
		{	
			// Query if email exists in db
			$sqlup = "update pairtaxrates set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."',is_active='$val' where id='$id'";
			$queryup = mysqli_query($con, $sqlup);
			// If query fails, show the reason 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed User Status', '{$id}')");
				header("Location: taxs.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: taxs.php?error=This record is Not Found! Kindly check in All Users List");
			}
	}
	else
			{
				header("Location: taxs.php?error=Error Data");
			}
}
?>