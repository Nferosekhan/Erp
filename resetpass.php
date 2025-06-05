<?php
	use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';	
include('session.php');
include('bd.php');
function argon2idHash($plaintext, $password, $encoding = null) {
    $plaintextsecured = hash_hmac("sha256", $plaintext, $password);
    return $encoding == "hex" ? bin2hex(password_hash($plaintextsecured, PASSWORD_ARGON2ID)) : ($encoding == "base64" ? base64_encode(password_hash($plaintextsecured, PASSWORD_ARGON2ID)) : password_hash($plaintextsecured, PASSWORD_ARGON2ID));
}
function argon2idHashVerify($plaintext, $password, $hash, $encoding = null) {
    $plaintextsecured = hash_hmac("sha256", $plaintext, $password);
    return password_verify($plaintextsecured, $encoding == "hex" ? hex2bin($hash) : ($encoding == "base64" ? base64_decode($hash) : $hash)) ? true : false;
}
$success='';
$year=date("Y");
if((isset($_GET['v']))&&(isset($_GET['e'])))
{
$resetkey = $_GET['v'];  
$email = $_GET['e'];  
$resetkey = stripcslashes($resetkey);  
$email = stripcslashes($email);  
$resetkey = mysqli_real_escape_string($con, $resetkey);  
$email = mysqli_real_escape_string($con, $email);  
$sql = "select is_active,username,firstname,lastname,id from paircontrols where (username = '$email' or usernewname = '$email') and resetkey = '$resetkey'";  
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
if(isset($_POST['submit']))
{
  $saltforpassword = "PAIRSALT";
  $password = argon2idHash(mysqli_real_escape_string($con, $_POST['password']), $saltforpassword);
	$sqli=mysqli_query($con, "update paircontrols set password='$password', resetkey='', reseton='$times' where id='".$row['id']."'");
	if($sqli)
	{
    $id=$row['id'];
    $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='USER', createdon='$times',  createdby='".$email."', useid='$id', useremarks='PASSWORD RESET' ");
    mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$email}', '{$ip}', '{$times}', 'Update their Password', '{$id}')");
    
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
		
		if($email!='')
				{					
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
                           <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:20px 20px;background-color:#ffffff" align="center" class="m_37516624310573855mdv2rw">
                             <div style="margin-top: -30px;">
                             <img src="https://tonic.pairscript.com/assets/img/loginlogo.png" width="200" aria-hidden="true" style="margin-bottom:16px;margin-top:11px;" alt="Tonic" class="CToWUd">
                              
                              
                               <div style="font-family:\'Google Sans\',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:5px;text-align:center;word-break:break-word;margin-top:-15px;">
                         
                              </div>
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
}
//header('Location: dashboard.php');  
}
else
{  
header('Location: index.php?error=Your Accout is Disabled. Please Contact Administrator');  
}
}  
else
{  
header('Location: index.php?error=Invalid Attempt');  
}
}
else
{  
header('Location: index.php');  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
  <title>
    Reset Password
  </title>
</head>
<?php
	if($success=='')
	{
?>	
<body>

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-3">
                <div class="card-header pb-0 text-left bg-transparent">
				<img src="assets/img/loginlogo.png" width="100%" class="img-responsive mb-3">
                  <h5 class="font-weight-bolder">Reset Password</h5>
                  <p class="mb-0 text-sm">A Secure and Strong Password helps protect your account.</p>
                </div>
                <div class="card-body pt-3">
				
                  <form role="form" method="post" onsubmit="return matchPassword()">
                    <div class="mb-2">
                      <input type="password" class="form-control" name="password" id="password" placeholder="New Password" aria-label="New Password" aria-describedby="password-addon" required onchange="matchPassword()" maxlength="15">
                    </div>
					<div class="mb-2">
                      <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="cpassword-addon" required onchange="matchPassword()" maxlength="15">
                    </div>
                    <div class="text-sm text-danger" id="password_response"></div>
					<div class="text-sm">Changing your password will sign you out on your devices</div>
					<div class="text-center">
                      <button type="submit" name="submit" class="btn bg-gradient-info w-100 mt-3 mb-0 btn-custom" style="background-image:linear-gradient(310deg, #6200ee 0%, #6200ee 100%);">Change Password</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
<!-- <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center mt-1">
          <div class="copyright text-center text-sm text-muted">
		 <p style="margin:0;padding:0; color:#333333" class="text-secondary"> © <script>
			  document.write(new Date().getFullYear())
                </script>, . All Rights Reserved.<br>
				 is a registered Trademark of .in
		  <br>
                Made with <i class="fa fa-heart" style="color: red;"></i> by
                <a href="https://www.pairscript.com" style="color:#2960B4;" target="_blank">Pairscript</a>
                for a better web.
				</p>
              </div>
        </div>
      </div>
    </div>
  </footer> -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center mt-1">
          <div class="copyright text-center text-sm text-muted">
     <p style="margin:0;padding:0; color:#333333" class="text-secondary"> © <script>
        document.write(new Date().getFullYear())
                </script> Pairscript. All Rights Reserved.<br>
        Pairscript is a registered Trademark of pairscript.com
      <br>
                Made with <i class="fa fa-heart" style="color: red;"></i> by
                <a href="https://www.pairscript.com" style="color:#2960B4;" target="_blank">Pairscript</a>
                for a better web.
        </p>
              </div>
        </div>
      </div>
    </div>
  </footer>
  <?php
include('fexternals.php');
?>
<script>  
function matchPassword()
{
var pw1 = document.getElementById("password"); 
var password=pw1.value;
var pw2 = document.getElementById("cpassword");  
var strength = 0;
if(pw1.value != pw2.value)
{
$("#password_response").html('<span style="color: red;"><i class="fa fa-exclamation-circle"></i> Those passwords didn\'t match. Try again</span>');  
pw2.focus();
return false;
}
else{
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
else if(strength>2)
{
	$("#password_response").html('<span style="color: green;"><i class="fa fa-exclamation-circle"></i> Password Strength: Strong </span>');  
}
else
{
$("#password_response").html('');  	
}
}
}
</script>
</body>

<?php
}
else
{
?>
<body style="background-color:#EAEBEF">
<main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-3 bg-white">
                <div class="card-header pb-0 text-left bg-transparent text-center">
			<img src="assets/img/loginlogo.png" width="80%" class="img-responsive mb-1">
				<hr>
                  <h1 style="color:#00D257"><i class="fa fa-check-circle"></i></h1>
                  <h5 style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-weight: 545;" class="mb-0">Password Reset Successfully</h5>
                </div>
                <div class="card-body pt-2">
				
                  
				  <hr>
				  <div class="copyright text-center text-sm mt-2 text-muted">
		 <p style="margin:0;padding:0; color:#333333" class="text-secondary"> © <script>
			  document.write(new Date().getFullYear())
                </script> Pairscript. All Rights Reserved.<br>
        Pairscript is a registered Trademark of pairscript.com
		  <br>
                Made with <i class="fa fa-heart" style="color: red;"></i> by
                <a href="https://www.pairscript.com" style="color:#2960B4;" target="_blank">Pairscript</a>
                for a better web.
				</p>
              </div>
                </div>
				
				
              </div>
            </div>
          </div>

	   </div>
      </div>
    </section>
  </main>

<?php
include('fexternals.php');
?>
<script>
	window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.location.href = "index.php";
    }, 20000); 
	</script>
</body>

<?php
}
?>
</html>