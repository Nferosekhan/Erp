<?php
include('lcheck.php');
if (isset($_GET['id'])) {
$id=mysqli_real_escape_string($con, $_GET['id']);
$val=mysqli_real_escape_string($con, ((isset($_GET['val']))?$_GET['val']:'1'));

if(($id!="")&&($val!=""))
	{	
		// Query if email exists in db
        $sqlcon = "SELECT id From paircustomers WHERE id = '{$id}'";
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
			$sqlup = "update paircustomers set is_active='$val' where id='$id'";
			$queryup = mysqli_query($con, $sqlup);
			// If query fails, show the reason 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				if($val=='1')
				{
					$useremarks='DEACTIVED';
				}
				else
				{
					$useremarks='ACTIVED';
				}
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='VENDOR', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='$useremarks' ");
				
				// mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed User Status', '{$id}')");
				header("Location: vendorview.php?id=".$id."&remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: vendors.php?error=This record is Not Found! Kindly check in All Users List");
			}
	}
	else
			{
				header("Location: vendors.php?error=Error Data");
			}
}
?>