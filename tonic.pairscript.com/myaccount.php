<?php
	use PHPMailer\PHPMailer\PHPMailer;
  require 'vendor/autoload.php';	
include('lcheck.php');
if($permissionmyaccount!='1'){
	header('location:dashboard.php');
}
if(isset($_POST['submit']))
{
$id=mysqli_real_escape_string($con, $_POST['id']);	
$firstname=mysqli_real_escape_string($con, $_POST['firstname']);
$lastname=mysqli_real_escape_string($con, $_POST['lastname']);
$dob=mysqli_real_escape_string($con, $_POST['dob']);
$designation=mysqli_real_escape_string($con, $_POST['designation']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$oldemail=mysqli_real_escape_string($con, $_POST['oldemail']);
$usernewname=mysqli_real_escape_string($con, $_POST['usernewname']);
$oldusernewname=mysqli_real_escape_string($con, $_POST['oldusernewname']);
$mobile=mysqli_real_escape_string($con, $_POST['mobile']);
$msg = "";
$msg_class = "";
	if(($firstname!="")&&($email!=""))
	{		
        $sqlcon = "SELECT id From paircontrols WHERE id = '{$id}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon > 0) 
		{	
			$profileimages=array();
  // Configure upload directory and allowed file types
    $upload_dir = 'ups/profile/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
     
    // Define maxsize for files i.e 2MB
    $maxsize = 2 * 1024 * 1024;

    // Checks if user sent an empty form
    if(!empty(array_filter($_FILES['profileimage']['name']))) {

        foreach ($_FILES['profileimage']['tmp_name'] as $key => $value) {
               
            $file_tmpname = $_FILES['profileimage']['tmp_name'][$key];
            $file_name = $_FILES['profileimage']['name'][$key];
            $file_size = $_FILES['profileimage']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir.$file_name;
            if(in_array(strtolower($file_ext), $allowed_types)) {
 
                if ($file_size > $maxsize)        
                    header("Location: myaccount.php?error=File size is larger than the allowed limit");
 
                if(file_exists($filepath)) {
                    $filepath = $upload_dir.time().$file_name;
                     
                    if( move_uploaded_file($file_tmpname, $filepath)) {
						$profileimages[]=$filepath;
                       // echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        //echo "Error uploading {$file_name} <br />";
                    }
                }
                else {
                 
                    if( move_uploaded_file($file_tmpname, $filepath)) {
						$profileimages[]=$filepath;
                        //echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        //echo "Error uploading {$file_name} <br />";
                    }
                }
				
            }
            else {
                 
                // If file extension not valid
               // echo "Error uploading {$file_name} ";
              //  echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    }
    else {
         
    
    }

if(!empty($profileimages))
{
	$profileimage=implode(",",$profileimages);
}
else
{
	$profileimage=mysqli_real_escape_string($con, $_POST['profileimages']);
}
                if(isset($userid))
                {
                $count=1;
                $id=mysqli_real_escape_string($con, $userid);
                $sqli=mysqli_query($con, "select * from paircontrols where id='$userid' order by lastname asc");
                if(mysqli_num_rows($sqli)>0)
                {
                $info=mysqli_fetch_array($sqli);
                $oldfirstname=$info['firstname'];
                $oldlastname=$info['lastname'];
                $olddob=$info['dob'];
                $olddesignation=$info['designation'];
                $oldemail=$info['email'];
                $oldusernewname=$info['usernewname'];
                $oldmobile=$info['mobile'];
                $oldmyaccount=$info['permissionmyaccount'];
                $oldfp=$info['permissionfranchise'];
                $oldup=$info['permissionuser'];
                $oldprofileimage=$info['profileimage'];
                }
            }
                
                $ch='';
                if($profileimage!=$oldprofileimage)
				{
					if($ch!='')
					{
						$ch.='<br> Photo <span style="color:green;" id="prohisfromtospan">( From '.$oldprofileimage.' To '.$profileimage.' ) </span>';
					}
					else
					{
						$ch.='Photo <span style="color:green;" id="prohisfromtospan">( From '.$oldprofileimage.' To '.$profileimage.' ) </span>';
					}					
				}
				if($firstname!=$oldfirstname)
				{
					if($ch!='')
					{
						$ch.='<br> First Name <span style="color:green;" id="prohisfromtospan">( From '.$oldfirstname.' To '.$firstname.' ) </span>';
					}
					else
					{
						$ch.='First Name <span style="color:green;" id="prohisfromtospan">( From '.$oldfirstname.' To '.$firstname.' ) </span>';
					}					
				}
				if($lastname!=$oldlastname)
				{
					if($ch!='')
					{
						$ch.='<br> Last Name <span style="color:green;" id="prohisfromtospan">( From '.$oldlastname.' To '.$lastname.' ) </span>';
					}
					else
					{
						$ch.='Last Name <span style="color:green;" id="prohisfromtospan">( From '.$oldlastname.' To '.$lastname.' ) </span>';
					}					
				}
				if($dob!=$olddob)
				{
					if($ch!='')
					{
						$ch.='<br> D.O.B <span style="color:green;" id="prohisfromtospan">( From '.$olddob.' To '.$dob.' ) </span>';
					}
					else
					{
						$ch.='D.O.B <span style="color:green;" id="prohisfromtospan">( From '.$olddob.' To '.$dob.' ) </span>';
					}					
				}
				if($designation!=$olddesignation)
				{
					if($ch!='')
					{
						$ch.='<br> Designation <span style="color:green;" id="prohisfromtospan">( From '.$olddesignation.' To '.$designation.' ) </span>';
					}
					else
					{
						$ch.='Designation <span style="color:green;" id="prohisfromtospan">( From '.$olddesignation.' To '.$designation.' ) </span>';
					}					
				}
				if($email!=$oldemail)
				{
					if($ch!='')
					{
						$ch.='<br> E-mail <span style="color:green;" id="prohisfromtospan">( From '.$oldemail.' To '.$email.' ) </span>';
					}
					else
					{
						$ch.='E-mail <span style="color:green;" id="prohisfromtospan">( From '.$oldemail.' To '.$email.' ) </span>';
					}					
				}
				
				if($usernewname!=$oldusernewname)
				{
					if($ch!='')
					{
						$ch.='<br> Username <span style="color:green;" id="prohisfromtospan">( From '.$oldusernewname.' To '.$usernewname.' ) </span>';
					}
					else
					{
						$ch.='Username <span style="color:green;" id="prohisfromtospan">( From '.$oldusernewname.' To '.$usernewname.' ) </span>';
					}					
				}
				
				if($mobile!=$oldmobile)
				{
					if($ch!='')
					{
						$ch.='<br> Mobile <span style="color:green;" id="prohisfromtospan">( From '.$oldmobile.' To '.$mobile.' ) </span>';
					}
					else
					{
						$ch.='Mobile <span style="color:green;" id="prohisfromtospan">( From '.$oldmobile.' To '.$mobile.' ) </span>';
					}					
				}
				if($oldmyaccount!=$permissionmyaccount)
				{
					if($ch!='')
					{
						$ch.='<br> MYACCOUNT <span style="color:green;" id="prohisfromtospan">( From '.$oldmyaccount.' To '.$permissionmyaccount.' ) </span>';
					}
					else
					{
						$ch.='MYACCOUNT <span style="color:green;" id="prohisfromtospan">( From '.$oldmyaccount.' To '.$permissionmyaccount.' ) </span>';
					}					
				}
				if($oldfp!=$permissionfranchise)
				{
					if($ch!='')
					{
						$ch.='<br> FRANCHISE ROLE <span style="color:green;" id="prohisfromtospan">( From '.$oldfp.' To '.$permissionfranchise.' ) </span>';
					}
					else
					{
						$ch.='FRANCHISE ROLE <span style="color:green;" id="prohisfromtospan">( From '.$oldfp.' To '.$permissionfranchise.' ) </span>';
					}					
				}
				if($oldup!=$permissionuser)
				{
					if($ch!='')
					{
						$ch.='<br> USER ROLE <span style="color:green;" id="prohisfromtospan">( From '.$oldup.' To '.$permissionuser.' ) </span>';
					}
					else
					{
						$ch.='USER ROLE <span style="color:green;" id="prohisfromtospan">( From '.$oldup.' To '.$permissionuser.' ) </span>';
					}					
				}

                // if($firstname!=$oldfirstname){
                //   $hisfname=mysqli_real_escape_string($con, $_POST['firstname']);
				// }
				// if($lastname!=$oldlastname){
                //   $hislname=mysqli_real_escape_string($con, $_POST['lastname']);
				// }
				// if($dob!=$olddob){
                //   $hisdob=mysqli_real_escape_string($con, $_POST['dob']);
				// }
				// if($designation!=$olddesignation){
                //   $hisdesign=mysqli_real_escape_string($con, $_POST['designation']);
				// }
				// if($email!=$oldemail){
                //   $hisemail=mysqli_real_escape_string($con, $_POST['email']);
				// }
				// if($usernewname!=$oldusernewname){
                //   $hisuname=mysqli_real_escape_string($con, $_POST['usernewname']);
				// }
				// if($mobile!=$oldmobile){
                //   $hismobile=mysqli_real_escape_string($con, $_POST['mobile']);
				// }
				// if($oldmyaccount!=$permissionmyaccount){
                // $myaccountch=mysqli_real_escape_string($con, (isset($_POST['permissionmyaccount']))?'1':'0');
                // }
                // if($oldfp!=$permissionfranchise){
                // $permissionfranchisech=$permissionfranchise;
                // }
                // if($oldup!=$permissionuser){
                // $permissionuserch=$permissionuser;
                // }, fname='$hisfname', lastname='$hislname', dob='$hisdob', design='$hisdesign', email='$hisemail',username='$hisuname',mobile='$hismobile',myaccountch='$myaccountch', permissionfranchisech='$permissionfranchisech',permissionuserch='$permissionuserch'

                if($ch!='')
				{
                $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='USER', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='".$ch." ' ");
                }

			setcookie('unqwerty', $email, time() + (86400 * 30), "/"); 
			$sqlup = "update paircontrols set createdon='$times',createdby='".$_SESSION["unqwerty"]."', username='$email', usernewname='$usernewname', email='$email', firstname='$firstname', lastname='$lastname', dob='$dob', profileimage='$profileimage', designation='$designation', email='$email', mobile='$mobile' where id='$id'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Update their Profile', '{$id}')");
			    if($email!=$oldemail)
			    {
			        $sqlst=mysqli_query($con, "update paircontrols set createdby='".$email."' where createdby='".$oldemail."'");
			        // $sqlst=mysqli_query($con, "update paircontacts set createdby='".$email."' where createdby='".$oldemail."'");
			        $sqlst=mysqli_query($con, "update pairestimates set createdby='".$email."' where createdby='".$oldemail."'");
			        $sqlst=mysqli_query($con, "update pairgst set createdby='".$email."' where createdby='".$oldemail."'");
			        $sqlst=mysqli_query($con, "update pairhistory set user='".$email."' where user='".$oldemail."'");
			        $sqlst=mysqli_query($con, "update pairinvoices set createdby='".$email."' where createdby='".$oldemail."'");
			        $sqlst=mysqli_query($con, "update pairquotations set createdby='".$email."' where createdby='".$oldemail."'");
			        $sqlst=mysqli_query($con, "update pairtaxrates set createdby='".$email."' where createdby='".$oldemail."'");
			        $sqlst=mysqli_query($con, "update pairunits set createdby='".$email."' where createdby='".$oldemail."'");
			        
			       header("Location: myaccount.php?remarks=Updated Successfully");
			    }
			    else
			    {
				header("Location: myaccount.php?remarks=Updated Successfully");
			    }
			} 
	    }
		else
			{
				header("Location: myaccount.php?error=This record is Already Found! Kindly check in All Products List");
			}
	}
	else
			{
				header("Location: myaccount.php?error=Required fields are Mandatory");
			}
}


if(isset($_POST['changepass']))
{
  	$oldpassword=mysqli_real_escape_string($con, $_POST['oldpassword']);
	$saltforpassword = "PAIRSALT";
	$rowforpass = '';
	$sqlforpass = mysqli_query($con,"select * from paircontrols where (username = '".$_SESSION["unqwerty"]."' or usernewname = '".$_SESSION["unqwerty"]."')");
	if(mysqli_num_rows($sqlforpass)==1){
	  $rowforpass = mysqli_fetch_array($sqlforpass);
  		$hashedPassword = $rowforpass['password'];
	}
   if (argon2idHashVerify($oldpassword, $saltforpassword, $hashedPassword)) {
     	$oldpassword=$hashedPassword;
  		$password = argon2idHash(mysqli_real_escape_string($con, $_POST['password']), $saltforpassword);
  $sql = "select * from paircontrols where (username = '".$_SESSION["unqwerty"]."' or usernewname = '".$_SESSION["unqwerty"]."') and password = '$oldpassword'";  
  $result = mysqli_query($con, $sql);  
  $count = mysqli_num_rows($result);  
  if($count>0)
  {  
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if($row['is_active']=='0')
  {
  $email=$row['username'];
  $firstname=$row['firstname'];
  $lastname=$row['lastname'];

  	$sqli=mysqli_query($con, "update paircontrols set password='$password', resetkey='', reseton='$times' where id='".$row['id']."'");
  	if($sqli)
  	{   
  /*starts here */
  $mail = new PHPMailer(true); // create a new object
  $mail->isSMTP();
  $mail->Host = 'localhost';
  $mail->SMTPAuth = false;
  $mail->SMTPAutoTLS = false; 
  $mail->Port = 25; 
  $mail->IsHTML(true);
  $mail->Username = "tonic@pairscript.com";
  $mail->Password = "Rrifidr@tr7";
  $mail->setFrom('tonic@pairscript.com', 'Tonic - Pairscript');
  $mail->addReplyTo('tonic@pairscript.com', 'Tonic - Pairscript');
  /*end here*/
  		$success='yes';
  $year=date("Y");
  		
  		if($email!='')
  				{			
                  $id=mysqli_real_escape_string($con, $userid);
  				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='USER', createdon='$times',  createdby='".$email."', useid='$id', useremarks='PASSWORD RESET' ");		
  					$mail->addAddress($email, $firstname);
  					$mail->Subject = 'Tonic Password Reset - Security Alert';
  					$mail->msgHTML('<div style="margin:0;padding:0" bgcolor="#E4E6F3">
     <table width="100%" height="100%" style="min-width:348px; background-color:#E4E6F3" border="0" cellspacing="0" cellpadding="0" lang="en">
        <tbody>
           <tr height="32" style="height:32px">
              <td></td>
           </tr>
           <tr align="center">
              <td>
                 <div>
                    <div></div>
                 </div>
                 <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px; ">
                    <tbody>
                       <tr>
                          <td width="8" style="width:8px"></td>
                          <td>
                             <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px 20px 20px;background-color:#ffffff" align="center" class="m_37516624310573855mdv2rw">
                                <img src="https://tonic.pairscript.com/assets/img/loginlogo.png" width="200" aria-hidden="true" style="margin-bottom:16px;margin-top:-9px;" alt="Tonic" class="CToWUd">
                                
                                
                                 <div style="font-family:\'Google Sans\',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:5px;text-align:center;word-break:break-word">
                           
                                </div>
                                
                                
                                <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">
                                   Hi '.$firstname.' '.$lastname.',
                                   </div>
                                
                                <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                   Your Tonic account password was reset using the email address<a style="text-decoration:none;color:#0000EE;"> '.$email.' </a> on '.date('l, F d, Y ').' at '.date('h:i a').'. 
  								 
                                   
                                </div>
                  
                  <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                   <table style="width:100%; text-align:left">
                   <tr>
                   <td width="30%" style="color:#5f6368;">Operating System</td>
                   <td>'.getOS().'</td>
                   </tr>
                   <tr>
                   <td width="30%" style="color:#5f6368;">Browser</td>
                   <td>'.getBrowser().'</td>
                   </tr>
                   <tr>
                   <td width="30%" style="color:#5f6368;">IP Address</td>
                   <td>'.$ip.'</td>
                   </tr>
                   
                   </table>
                   
                   
                                   
                                </div>
                                
                                
                                <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                   <b>If you did this,</b> you can safely disregard this email.<br>
  								 <b>If you did not do this,</b> please <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none;"> contact us</a>
                                   </div>
                                
                                
                                
                                <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding-top:20px;font-size:12px;line-height:16px;color:#5f6368;letter-spacing:0.3px;text-align:center">
                                
                                <p>Replies to this email aren\'t monitored. If you have a question about your account, the <a style="text-decoration:none" href="https://www.pairscript.com" targe="_blank">Help Center</a> likely has the answer you\'re looking for</p>
                                <p>&copy; '.$year.' Pairscript. All Rights Reserved<br>Pairscript is a registered trademark of pairscript.com</p>
                                <p style="font-size:10px;">Pairscript<br>
                                India</p>
                                
                                
                                </div>
                                <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding-top:20px;font-size:9px;line-height:16px;color:#5f6368;letter-spacing:0.3px;text-align:center">
                                
                                <p><b>You received this email to let you know about important changes to your tonic account.</b><br> If you think this is SPAM or do not wish to receive pairscript.com emails in future, <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none;"> Contact Us</a> or <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none;">Unsubscribe.</a></p>
                                
                                </div>
                             </div>
                          </td>
                          <td width="8" style="width:8px"></td>
                       </tr>
                    </tbody>
                 </table>
              </td>
           </tr>
           <tr height="32" style="height:32px">
              <td></td>
           </tr>
        </tbody>
     </table>
  </div>');

  					if (!$mail->send()) {
  					//header("Location: users.php?error=".$mail->ErrorInfo);
  						//echo 'Mailer Error: ' . $mail->ErrorInfo;
  					} else {
  					//header("Location: users.php?remarks=Updated Successfully");
  						//echo 'Message sent!';
  					}
  				}
  	}
  header('Location: index.php?remarks=Password Updated Successfully! Please Login Again');  
  }
  else
  {  
  header('Location: index.php?error=Your Accout is Disabled. Please Contact Administrator');  
  }
  }  
  else
  {  
  header('Location: myaccount.php?error=Sorry! Your Current Password is Wrong');  
  }
}
else{  
  header('Location: myaccount.php?error=Sorry! Your Current Password is Wrong');  
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
<?php
include('externals.php');
?>
  <title>
    My Account
  </title>
<style>

.profile-badge{
    border:1px solid #c1c1c1;
    padding:5px;
    position: relative;
}

.profile-pic{
    height:80px;
    /*width:120px;*/
    padding: 10px;
}
.profile-pic img{
   
    border-radius: 50%;
    box-shadow: 0px 0px 5px 0px #c1c1c1;
    cursor: pointer;
    width: 60px;
    height: 60px;
}   
.modal{
     		z-index: 30000000 !important;
     	}
</style>
<style>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    color: grey !important;
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.table td, .table th {
    white-space: normal;
}

.input-group-text
{
	padding: 0.51rem 0.75rem;
}
</style>
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
  <?php
  // sidebar 
  include('sidebar.php');
  ?>
 <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">    <?php
     // navbar
     include('navhead.php'); 
     ?>
     <div class="container-fluid py-4 bg-body">
         
     
	  <?php
     if(isset($_GET['remarks']))
     {
     ?>
     <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
    <i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?></p>
  </div>
     <?php
     }
     ?>
     <?php
     if(isset($_GET['error']))
     {
     ?>
      <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>
	 <div style="max-width: 1650px;">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                  <p style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 20px;margin-bottom: -6px !important;"><i class="fa fa-user"></i> My Account</p>
                  
               
<?php
if(isset($userid))
{
$count=1;
$id=mysqli_real_escape_string($con, $userid);
$sqli=mysqli_query($con, "select * from paircontrols where id='$userid' order by lastname asc");
if(mysqli_num_rows($sqli)>0)
{
$info=mysqli_fetch_array($sqli);
?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<input type="hidden" name="id" id="id" value="<?=$info['id']?>">





<nav>
                                      <div style="margin-top: -42px !important;">
                                      	<div style="visibility: hidden;" id="arrowsall">
<svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 60px !important;z-index: 1 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 60px !important;z-index: 1 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouch() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('nav-tab').scrollLeft += -90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrow() {
            document.getElementById('nav-tab').scrollLeft += 90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #nav-tab::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#nav-tab::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#nav-tab::-webkit-scrollbar-track {
  background-color: green;
}

#nav-tab::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#nav-tab::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 350px){
	#arrowsall{
		visibility: visible !important;
	}
}
@media screen and (min-device-width: 351px) and (max-device-width: 3000px){
	#arrowsall{
		visibility: hidden !important;
	}
}
.nav-tabs button{
	margin-bottom: 1px !important;
}
.customcont-header{
	border-bottom: 0px !important;
}
      </style>
	<div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;padding-bottom: 0.3px !important;">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
	
		<a class="customcont-heading">My Account</a>	
             
				</div></button>
				<button class="nav-link" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-history" aria-selected="false">
    <div class="customcont-header ml-0">
  
    <a class="customcont-heading">History</a> 
             
        </div>
    
    </button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
		<div class="customcont-header ml-0">
	
		<a class="customcont-heading">Security</a>	
             
				</div>
		
		</button>
		 </div>
		
  </div>
  
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

<div class="row" style="margin-top:10px !important;">
<div class="col-lg-12">
<div class="row justify-content-center">
    <div class="col-lg-4 ml-2">
     
<div class="profile-pic text-center">
                 <?php
if($info['profileimage']!='')
{
	?>
	<?php
	$imgs=explode(',',$info['profileimage']);
	foreach($imgs as $img)
	{
	?>
	<img alt="User Pic" src="<?=str_replace('../ups','ups',$img)?>" id="profile-image1" height="200">
	<?php
	}
	?>

	<?php
}
else
{
	?>


	    <img alt="User Pic" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="profile-image1" height="200">

	<?php
}
?>
                        
						<input id="profile-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="profileimage" name="profileimage[]" accept="image/*" onchange="previewFile()" >
	<input type="hidden" name="profileimages" value="<?=$info['profileimage']?>">
                        <div style="color:#4285F4; cursor:pointer"  id="profile-image2"> Upload Photo </div><br>
                        
                </div>
</div>
</div>
<br>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="firstname" class="custom-label"><span class="text-danger">First Name *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="firstname" name="firstname" value="<?=$info['firstname']?>" placeholder="First Name" required>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="lastname" class="custom-label">Last Name</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="lastname" name="lastname" value="<?=$info['lastname']?>" placeholder="Last Name">
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="dob" class="custom-label">D.O.B</label>
            </div>
            <div class="col-sm-8">
              <input type="date" class="form-control  form-control-sm" id="dob" name="dob" value="<?=$info['dob']?>" placeholder="D.O.B" style="width:100% !important">
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="designation" class="custom-label">Designation</label>
            </div>
            <div class="col-sm-8">
             <input type="text" class="form-control  form-control-sm" id="designation" name="designation" value="<?=$info['designation']?>" placeholder="Designation">
            </div>
          </div>
    </div>
</div>
<input type="hidden" id="oldemail" name="oldemail" value="<?=$info['username']?>">
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="email" class="custom-label"><span class="text-danger">Email Address *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="email" class="form-control  form-control-sm" id="email" name="email" value="<?=$info['username']?>" placeholder="Email Address" required>
              <div id="uname_response" ></div>
            </div>
          </div>
    </div>
</div>
<input type="hidden" id="oldusernewname" name="oldusernewname" value="<?=$info['usernewname']?>">
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="usernewname" class="custom-label">Username</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="usernewname" name="usernewname" value="<?=$info['usernewname']?>" placeholder="Username">
              <div id="unewname_response" ></div>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="mobile" class="custom-label">Mobile Phone</label>
            </div>
            <div class="col-sm-8">
             <input type="number" min="0" step="0.01" step="0.01" class="form-control  form-control-sm" id="mobile" name="mobile" value="<?=$info['mobile']?>" placeholder="Mobile Phone">
            </div>
          </div>
    </div>
</div>

<div class="row justify-content-center" style="margin-bottom: -14px;margin-top: -10px !important;">
    <div class="col-lg-6"><hr>
        <button name="submit" 
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Save"
                                                            style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>
                                                        <a class="btn btn-primary btn-sm btn-custom-grey " href="dashboard.php" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Cancel</a>
    </div>
</div>

</div>

    </div>
	  
  </div>
</form>
<div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
	<div class="table-responsive m-3">
    <table class="table table-bordered">
    <thead>
    <tr>
    <th style="border:1px solid #ddd !important;">DATE</th>
    <th style="border:1px solid #ddd !important;">DETAILS</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sqluse=mysqli_query($con, "select * from pairusehistory where (useid='$id' OR useid='$companymainid') AND usetype='USER' order by createdon desc");
    while($infouse=mysqli_fetch_array($sqluse))
    {
        $fname=$infouse['fname'];
        $lname=$infouse['lastname'];
        $dob=$infouse['dob'];
        $design=$infouse['design'];
        $email=$infouse['email'];
        $uname=$infouse['username'];
        $mobile=$infouse['mobile'];
        $usetype=$infouse['usetype'];
        $myaccount=$infouse['myaccountch'];
        $franchise=$infouse['permissionfranchisech'];
        $user=$infouse['permissionuserch'];
          if($myaccount==1){
           $ansmyaccount='Enabled';
          }
          elseif($myaccount==0){
           $ansmyaccount='Disabled';
          }
          else{
            $ansmyaccount='';
          }
          if($franchise==2){
           $ansfranchise='FULL ACCESS';
          }
          elseif ($franchise==1) {
            $ansfranchise='VIEW ACCESS';
          }
          elseif($franchise==0){
           $ansfranchise='NO ACCESS';
          }
          else{
            $ansfranchise='';
          }
          if($user=='2'){
           $ansuser='FULL ACCESS';
          }
          elseif ($user=='1') {
            $ansuser='VIEW ACCESS';
          }
          elseif($user=='0'){
           $ansuser='NO ACCESS';
          }
          else{
            $ansuser='';
          }
          if ($infouse['useremarks']=='ACCOUNT CREATED') {
          $changesofhis = "Created By";
          }
          elseif ($infouse['useremarks']=='PASSWORD RESET REQUEST') {
          $changesofhis = "Request By";
          }
          elseif ($infouse['useremarks']=='PASSWORD RESET') {
          $changesofhis = "Reset By";
          }
          else {
          $changesofhis = "Changed By";
          }
    ?>
    <tr>
      <td data-label="DATE" style="color:grey"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
      <td data-label="DETAILS"><?=$infouse['useremarks']?> <br> <span><?=$changesofhis?></span> <span  style="color:grey"><?=$infouse['createdby']?></span></td>
    </tr>
    <?php
    }
	  $sqlusecontrol=mysqli_query($con, "select fname,lastname,dob,design,email,username,mobile,myaccountch,permissionfranchisech,permissionuserch,createdon,useremarks from pairusehistory where usetype='CONTROL' and useid='$companymainid' and useremarks='ACCOUNT CREATED' order by createdon desc");
	  while($infousecontrol=mysqli_fetch_array($sqlusecontrol))
	  {
	  	?>
		<tr>
		  <td data-label="DATE" style="color: #808080;"><?=date('d/m/Y h:i:s a', strtotime($infousecontrol['createdon']))?></td>
		  <td data-label="DETAILS"><?=$infousecontrol['useremarks']?> <br> <span><?=(($infousecontrol['useremarks']=='ACCOUNT CREATED')?'Created By':'Changed By')?></span> <span  style="color:grey">Control</span></td>
		</tr>
    <?php
    }
    ?>
    
    </tbody>
    </table>
    </div>
</div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  
  <div class="row">
  <div class="col-lg-4">
  
  <div class="card mt-4" style="box-shadow: 0px 0px 5px 0px #c1c1c1;">
  <div class="card-body" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
  <p class="" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 18px;">Password</p>
  <p class="text-center" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Change your account password often to prevent unauthorised access to your account.<br><br>
	  
	<img src="assets/img/pass.png" class="img-responsive img-rounded" width="100" style="border-radius:50%">   
	
	<?php
	if($lastreseton!='')
	{
		?><br>
	<span class="text-secondary">Last Changed <?=date('F d, Y',strtotime($lastreseton))?></span>
		<?php
	}
	?>
	  </p>
<!-- Button trigger modal -->
<div class="text-center mt-2">
<button type="button" class="btn bg-success btn-sm mygreenbutton" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
  Change Password
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="exampleModalLabel" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 18px;">Password</p>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -33px;">
          <span aria-hidden="true" style="font-size: 21px;font-weight: 600;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-sm mb-2" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">A secure & strong passwords helps protect your account.</div>
        <form id="formid" method="post" onsubmit="return matchPassword()">
        <input type="hidden" id="changepass" value="1" name="changepass">
		
		<div class="input-group mb-2">
  <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Current Password" aria-label="Current Password" aria-describedby="oldpassword-addon" required>
  <div class="input-group-append">
    <span class="input-group-text" id="oldpassword-addon"><i class="fa fa-eye-slash" id="togglePassword"></i></span>
  </div>
</div>
		
		
                 
        <div class="mb-2">
		<a href="forgotin.php?user=self&submit=submit" onclick="return confirm('Are you sure want to generate Password Reset Link')" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;color: #2960B4;">Forgot Password?</a>
		</div>
		
		<div class="input-group mb-2">
			<input type="password" class="form-control" name="password" id="password" placeholder="New Password" aria-label="New Password" aria-describedby="password-addon" required onchange="matchPassword()" onkeyup="matchPassword()" maxlength="15">
  <div class="input-group-append">
    <span class="input-group-text" id="password-addon"><i class="fa fa-eye-slash" id="togglePassword2"></i></span>
  </div>
</div>

		
      
					<div class="text-sm text-danger mb-2" id="password_response"></div>

<div class="input-group mb-2">
	<input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="cpassword-addon" required onchange="matchPassword()" onkeyup="matchPassword()" maxlength="15">
  <div class="input-group-append">
    <span class="input-group-text" id="cpassword-addon"><i class="fa fa-eye-slash" id="togglePassword3"></i></span>
  </div>
</div>

					
					<div class="text-sm">
						<div class="custom-control custom-checkbox mr-sm-2">
						<input type="checkbox" class="custom-control-input" name="permissiondashboard" id="permissiondashboard" checked disabled>
						<label class="custom-control-label custom-label" for="permissiondashboard" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"> Changing your password will sign you out on your devices</label>
					  </div>
						
						</div>
					<div class="text-center" style="margin-bottom:50px !important;">
                      <button type="submit" name="submit1" id="submit1" class="btn btn-sm bg-success w-100 mt-3 mb-0 mygreenbutton" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Change Password</button>
                    </div>
                  </form>

      </div>

    </div>
  </div>
</div>
  
  </div>
  </div>
  
  </div>
  </div>
  
  
  
  
 
  
  </div>
</div>


  
</form>


<?php
}
}
else
{
	?>
	<div class="alert alert-danger">No Results Found</div>
	<?php
	
}
?>
			 
            </div>
          </div>
        </div>
      </div>
      </div>
	  <?php
	  include('footer.php');
	  ?>
    </div>
  
	</main>
 <?php
 include('fexternals.php');
 ?>

<script type="text/javascript">
  $(function() {
     $( "#lastname" ).autocomplete({
       source: 'productsearch.php?type=lastname',
     });
  });
</script>
<script>
 function previewFile() {
  var preview = document.getElementById('profile-image1');
  var file    = document.getElementById('profile-image-upload').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
                      $(function() {
            $('#profile-image1').on('click', function() {
                $('#profile-image-upload').click();
            });
            $('#profile-image2').on('click', function() {
                $('#profile-image-upload').click();
            });
        });
        
</script>
<script>
$(document).ready(function(){
   $("#email").keyup(function(){
      var username = $(this).val().trim();
      var oldemail = $('#id').val().trim();
      if(username != ''){
         $.ajax({
            url: 'emailvalidate.php',
            type: 'post',
            data: {email: username, oldemail: <?=$id?>},
            success: function(response){
            $('#uname_response').html(response);
             }
         });
      }else{
         $("#uname_response").html("");
      }

    });

 });
</script>
<script>
$(document).ready(function(){
   $("#usernewname").keyup(function(){
      var usernewname = $(this).val().trim();
      var oldusernewname = $('#id').val().trim();
      if(usernewname != ''){
         $.ajax({
            url: 'usernewnamevalidate.php',
            type: 'post',
            data: {usernewname: usernewname, oldusernewname: <?=$id?>},
            success: function(response){
            $('#unewname_response').html(response);
             }
         });
      }else{
         $("#unewname_response").html("");
      }

    });

 });
</script>
<script>
    function checkvalidate()
    {
        var response=$('#uname_response').html();
        
        if(response=='<span style="color: red;">Not Available.</span>')
        {
            alert('This email is Not Available. Please Try Any other Email');
            return false;
        }
    }
</script>
<script>  
function matchPassword()
{
var pw1 = document.getElementById("password"); 
var password=pw1.value;
var pw2 = document.getElementById("cpassword");  
var strength = 0;

if (pw1.value==pw2.value) {
$("#submit1").removeAttr("disabled");
if (password.length > 5) strength += 1;

  if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1;

  if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 ;

  if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1;

  if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;

if(pw1.value.length<5)
{
	$("#password_response").html('<span style="color: red;"><i class="fa fa-exclamation-circle"></i> Password is Too Short</span>');  
}
else if(strength<2)
{
	$("#password_response").html('<span style="color: red;"><i class="fa fa-exclamation-circle"></i> Password Strength: Week </span>');  

}
else if(strength==2)
{
	$("#password_response").html('<span style="color: orange;"><i class="fa fa-exclamation-circle"></i> Password Strength: Good </span>');  
}
else if((pw2.value != "")&&(pw1.value != pw2.value))
{
$("#password_response").html('<span style="color: red;"><i class="fa fa-exclamation-circle"></i> Those passwords didn\'t match. Try again</span>');  
pw2.focus();
return false;
}
else if(strength>2)
{
	$("#password_response").html('<span style="color: green;"><i class="fa fa-exclamation-circle"></i> Password Strength: Strong </span>');  
}
else
{
$("#password_response").html('');  	
}
}
else{
$("#submit1").attr("disabled","disabled");
$("#password_response").html('<span style="color: red;"><i class="fa fa-exclamation-circle"></i> Password Not Matching.Please Enter Same Passwords.</span>');
}
}
</script>
<script>
  $('#formid').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
  </script>
  
  <script>
  
	  const togglePassword = document.querySelector("#togglePassword");
        const oldpassword = document.querySelector("#oldpassword");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = oldpassword.getAttribute("type") === "password" ? "text" : "password";
            oldpassword.setAttribute("type", type);
            
			//$("#togglePassword").html('<i class="fa fa-eye"></i>');
            // toggle the icon
			if(type=='password')
			{
			$("#togglePassword").addClass("fa-eye-slash");
			$("#togglePassword").removeClass("fa-eye");
			}
			else
			{
			$("#togglePassword").addClass("fa-eye");
			$("#togglePassword").removeClass("fa-eye-slash");	
			}
            //this.classList.toggle("fa-eye");
        });

     
    </script>
	
	<script>
  
	  const togglePassword2 = document.querySelector("#togglePassword2");
        const password = document.querySelector("#password");

        togglePassword2.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
			//$("#togglePassword").html('<i class="fa fa-eye"></i>');
            // toggle the icon
			if(type=='password')
			{
			$("#togglePassword2").addClass("fa-eye-slash");
			$("#togglePassword2").removeClass("fa-eye");
			}
			else
			{
			$("#togglePassword2").addClass("fa-eye");
			$("#togglePassword2").removeClass("fa-eye-slash");	
			}
            //this.classList.toggle("fa-eye");
        });

     
    </script>
	
	<script>
  
	  const togglePassword3 = document.querySelector("#togglePassword3");
        const cpassword = document.querySelector("#cpassword");

        togglePassword3.addEventListener("click", function () {
            // toggle the type attribute
            const type = cpassword.getAttribute("type") === "password" ? "text" : "password";
            cpassword.setAttribute("type", type);
            
			//$("#togglePassword").html('<i class="fa fa-eye"></i>');
            // toggle the icon
			if(type=='password')
			{
			$("#togglePassword3").addClass("fa-eye-slash");
			$("#togglePassword3").removeClass("fa-eye");
			}
			else
			{
			$("#togglePassword3").addClass("fa-eye");
			$("#togglePassword3").removeClass("fa-eye-slash");	
			}
            //this.classList.toggle("fa-eye");
        });

     
    </script>
    <script>
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
    </script>






    <style>
    /*************************************
 * BUTTON BASE
 */

    .arlina-button {
        position: relative;
        border: 0;
        cursor: pointer;
        outline: 0;
        -webkit-appearance: none;
        -webkit-font-smoothing: antialiased;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .arlina-button[data-loading] {
        cursor: default;
    }


    /* Blue button */
    .arlina-button.blue {
        background: #53b5e6;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.blue:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #58c2f8;
    }

    .arlina-button.blue[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }

    /* Orange button */
    .arlina-button.orange {
        background: #ea8557;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.orange:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #ffa96c;
    }

    .arlina-button.orange[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }


    /* Spinner animation */
    .arlina-button .spinner {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        margin-top: -10px;
        opacity: 0;

        background-image: url("./assets/img/spin.gif");
        background-repeat: no-repeat;

        /* background-image: url(http://2.bp.blogspot.com/-GPSLDnKmX3s/VSvPkXsCHvI/AAAAAAAACOg/Xmm2kIDu-CU/s1600/spin.gif); */


    }


    /*************************************
 * EASING
 */

    .arlina-button,
    .arlina-button .spinner,
    .arlina-button .label {
        -webkit-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -moz-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -ms-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
    }

    .arlina-button.zoom-in,
    .arlina-button.zoom-in .spinner,
    .arlina-button.zoom-in .label,
    .arlina-button.zoom-out,
    .arlina-button.zoom-out .spinner,
    .arlina-button.zoom-out .label {
        -webkit-transition: 0.3s ease all;
        -moz-transition: 0.3s ease all;
        -ms-transition: 0.3s ease all;
        transition: 0.3s ease all;
    }



    /*************************************
 * EXPAND RIGHT
 */

    .arlina-button.expand-left .spinner {
        left: 0.8em;
    }

    .arlina-button.expand-left[data-loading] {
        padding-left: 40px;
    }

    .arlina-button.expand-left[data-loading] .spinner {
        opacity: 1;
    }
    </style>
  
</body>

</html>