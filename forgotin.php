<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';	
include('lcheck.php');
$success='';
$year=date("Y");
if((isset($_GET['user']))&&(isset($_GET['submit'])))
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
function generateRandomString($length = 18) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$username = $_SESSION["unqwerty"];  
$username = stripcslashes($username);  
$username = mysqli_real_escape_string($con, $username);  
$sql = "select is_active,username,firstname,lastname,id from paircontrols where (username = '$username' or usernewname = '$username')";  
$result = mysqli_query($con, $sql);  
$count = mysqli_num_rows($result);  
if($count>0)
{  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row['is_active']=='0')
{
$success='yes';
$email=$row['username'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];

$resetkey=generateRandomString();
$reseton=$times;

$sqla=mysqli_query($con, "update paircontrols set resetkey='$resetkey', reseton='$reseton' where id='".$row['id']."'");
if($email!='')
				{	
          
          $id=$row['id'];
    $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='USER', createdon='$times',  createdby='".$email."', useid='$id', useremarks='PASSWORD RESET REQUEST' ");
    mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$email}', '{$ip}', '{$times}', 'Request Password Reset', '{$id}')");

					$mail->addAddress($email, $firstname);
					$mail->Subject = 'Password Reset Request - Security Alert';
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
                                 We received a request to reset your tonic password.
								 
                                 <div style="padding-top:32px;">   
                               
                               <a href="https://tonic.pairscript.com/resetpass.php?v='.$resetkey.'&e='.$email.'" dir="ltr" style="text-align:center;display:inline-block" target="_blank" data-saferedirecturl="https://tonic.pairscript.com/resetpass.php?v='.$resetkey.'&e='.$email.'">
<table role="presentation" cellspacing="0" cellpadding="0" align="center">
    <tbody><tr style="padding:0;margin:0;font-size:0;line-height:0"><td style="border-top:4px;border-top-left-radius:4px;border-top-right-radius:4px;display:inline-block;text-align:center"></td></tr>
        <tr><td style="background-color:#1a73e8;border:1px solid #1a73e8;border-radius:4px;color:#ffffff;display:inline-block;font-family:Google Sans,Roboto,Arial;font-size:13px;line-height:25px;text-decoration:none;padding:7px 24px 7px 24px;font-weight:500;text-align:center;word-break:normal;direction:ltr;min-width:159px">
Reset Password
</td></tr>
    <tr style="padding:0;margin:0;font-size:0;line-height:0"><td style="border-top:3px;display:inline-block;border-bottom-left-radius:4px;border-bottom-right-radius:4px;text-align:center"></td></tr>
</tbody></table></a>
                               
                               
                             </div>
                              </div>
                              
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                 <b>Did not request this change?</b>
                                 <p>
                                 If you did not request new password, <a href="https://www.pairscript.com" target="_blank" style="text-decoration:none;">let us know.</a>
                                 </p>
                                 
                                 </div>
                              
                              
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding-top:20px;font-size:12px;line-height:16px;color:#5f6368;letter-spacing:0.3px;text-align:center">
                              
                              <p>Replies to this email aren\'t monitored. If you have a question about your account, the <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none">Help Center</a> likely has the answer you\'re looking for</p>
                              <p>&copy; '.$year.' Pairscript. All Rights Reserved<br>Pairscript is a registered trademark of pairscript.com</p>
                              <p style="font-size:10px;">Pairscript<br>
                              India</p>
                              
                              
                              </div>
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding-top:20px;font-size:9px;line-height:16px;color:#5f6368;letter-spacing:0.3px;text-align:center">
                              
                              <p>This email was sent to <a style="text-decoration:none" href="mailto:'.$email.'">'.$email.'</a> at your request.<br> If you think this is SPAM or do not wish to receive pairscript.com emails in future, <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none;">Contact Us</a> or <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none;">Unsubscribe.</a></p>
                              
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
					header("Location: myaccount.php?error=".$mail->ErrorInfo);
						//echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
					header("Location: myaccount.php?remarks=Please check your email. We have sent an email to ".$email." to reset your password.");
						//echo 'Message sent!';
					}
				}
}
else
{  
header('Location: myaccount.php?error=Your Accout is Disabled. Please Contact Administrator');  
}
}  
else
{  
header('Location: myaccount.php?error=Account does not exist. Please use different email or username.');  
}
}
?>