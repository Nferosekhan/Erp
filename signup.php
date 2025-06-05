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
if((isset($_POST['user']))&&(isset($_POST['pass']))&&(isset($_POST['fname']))&&(isset($_POST['submit'])))
{
function generateRandomString($length = 18) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}   
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
$username = $_POST['user'];  
$username = stripcslashes($username);  
$username = mysqli_real_escape_string($con, $username);  

$saltforpassword = "PAIRSALT";
$password = argon2idHash(mysqli_real_escape_string($con, $_POST['pass']), $saltforpassword);

$firstname = $_POST['fname'];  
$firstname = stripcslashes($firstname);  
$firstname = mysqli_real_escape_string($con, $firstname);  

$usernewname="";

$sql = "select id from paircontrols where (username = '$username' or usernewname = '$username')";  
$result = mysqli_query($con, $sql);  
$count = mysqli_num_rows($result);  
if($count==0)
{  
$email=$username;

if($usernewname=='')
{
    $ema=explode('@',$email);
    if(isset($ema[0]))
    {
    $usernewname=strtolower($ema[0]);
    }
}

$csql=mysqli_query($con,"select id from paricountry");
    while($cresult=mysqli_fetch_assoc($csql)) {
        $coid=$cresult['id'];
    }
 $sqlc=mysqli_query($con,"select id from paircurrency");
    while($resultc=mysqli_fetch_assoc($sqlc)){
        $cuid=$resultc['id'];
    }
$lsql=mysqli_query($con,"select id from parilanguage");
   while($lresult=mysqli_fetch_assoc($lsql)){
        $laid=$lresult['id'];
    }
$today=date("Y-m-d");
$sqlup = "insert into paircontrols set createdon='$times', createdid='0', role='SUPER ADMIN', createdby='".$email."', username='$email', usernewname='$usernewname', email='$email', firstname='$firstname', permissiondashboard='1', permissionmyaccount='1',franchiseandroles='Branch',userandroles='User',books='Books', franchises='', password='$password',languages='".$laid."',currencies='".$cuid."',countries='".$coid."', permissioninsights='0',permissionnotification='0',permissionhelp='0',language='0',time='0',currency='0',taxes='0',permissionconfig='0',permissionpreference='0',preferencefranchisepermission='0',permissionuserr='0',permissionbooks='0',expdate='$today'";
            $queryup = mysqli_query($con, $sqlup);
             
            if(!$queryup){
               die("SQL query failed: " . mysqli_error($con));
            }
            else
            {
        $success='yes';
                $id=mysqli_insert_id($con);
                $sqlaccess = "insert into pairaccess set  createdid='$id',createdby='control',username='$email'"; 
$sqlaccessup = mysqli_query($con, $sqlaccess);
$sqlreport = "insert into pairreports set createdid='$id',createdby='control',username='$email'"; 
$sqlreportup = mysqli_query($con, $sqlreport);
$sqlisaccess=mysqli_query($con, "select moduletype,grouptype,modulefields,modulecolumns,publiccolumn from pairmodules order by id  asc");
            while($infosaccess=mysqli_fetch_array($sqlisaccess))
            {
                $coltype = preg_replace('/\s+/', '', $infosaccess['moduletype']);
                $moduleaccesscol="module".strtolower($coltype);
                $groupaccess=1;
                $moduleaccess=1;
                $moduletype=$infosaccess['moduletype'];
                if ($moduletype!='') {
                    $moduletypeans=$infosaccess['moduletype'];
                }
                else {
                    $moduletypeans='';
                }
                $grouptype=$infosaccess['grouptype'];
                $modulefields=$infosaccess['modulefields'];
                $modulecolumns=$infosaccess['modulecolumns'];
                $publiccolumn=$infosaccess['publiccolumn'];
                $sqlmainaccess = "insert into pairmainaccess set createdon='$times',createdid='0',createdby='control',grouptype='$grouptype',groupname='$grouptype',groupaccess='$groupaccess',moduletype='$moduletypeans',modulename='$moduletypeans',moduleaccess='$moduleaccess',userid='$id',modulefieldcreate='$modulefields',modulefieldedit='$modulefields',modulefieldview='$modulefields',modulecolumns='$modulecolumns',publiccolumn='$publiccolumn'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
                if ($sqlmainaccessup) {
                    $ansproduct = "Product Information,Product Public Code,Product Private Code,Name,Code or Tags,Unit,HSN Code,Category,Sub Category,Delivery,Description,Product Visibility,Sales Information,Sale Price Name,Sale MRP,Sale Price Rate,Sale Description,Purchase Information,Purchase Price Name,Purchase MRP,Purchase Price Rate,Purchase Description,Tax Information,Tax Preference,Tax Rate,Intra State Tax Rate,Inter State Tax Rate";
                    $sqluppro = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansproduct',modulefieldedit='$ansproduct',modulefieldview='$ansproduct' where (userid='$id') and moduletype='Products'");
                    $ansserv = "Service Information,Service Public Code,Service Private Code,Name,Code or Tags,Unit,SAC Code,Category,Sub Category,Delivery,Description,Service Visibility,Sales Information,Sale Price Name,Sale MRP,Sale Price Rate,Sale Description,Purchase Information,Purchase Price Name,Purchase MRP,Purchase Price Rate,Purchase Description,Tax Information,Tax Preference,Tax Rate,Intra State Tax Rate,Inter State Tax Rate";
                    $sqlupserv = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansserv',modulefieldedit='$ansserv',modulefieldview='$ansserv' where (userid='$id') and moduletype='Services'");
                    $anscus = "Customer Information,Customer Public Id,Customer Private Id,Primary Contact,Company Name,Customer Display Name,Category,Sub Category,Work Phone,Mobile Phone,Email,Website,Billing Address,Shipping Address,Customers Visibility,Tax Information,Tax Preference,GST Registration Type,GSTIN or UIN,Business Legal Name,Business Trade Name,Pan,Place Of Supply";
                    $sqlupcus = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anscus',modulefieldedit='$anscus',modulefieldview='$anscus' where (userid='$id') and moduletype='Customers'");
                    $ansven = "Vendor Information,Vendor Public Id,Vendor Private Id,Primary Contact,Company Name,Vendor Display Name,Category,Sub Category,Work Phone,Mobile Phone,Email,Website,Billing Address,Shipping Address,Vendors Visibility,Tax Information,Tax Preference,GST Registration Type,GSTIN or UIN,Business Legal Name,Business Trade Name,Pan,Place Of Supply";
                    $sqlupven = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansven',modulefieldedit='$ansven',modulefieldview='$ansven' where (userid='$id') and moduletype='Vendors'");
$ansenquiry = "Enquiry Information,Customer Information,Item Information";
$ansenqcolumn = "Date,No,Name,Amount";
$sqlupenquiry = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansenquiry',modulefieldedit='$ansenquiry',modulefieldview='$ansenquiry',modulecolumns='$ansenqcolumn' where (userid='$id') and moduletype='Enquiries'");
$ansquotcolumn = "Date,No,Name,Amount,Proforma Invoice,Invoice";
$ansquotation = "Quotation Information,Customer Information,Item Information,Notes,Terms and Conditions";
$sqlupquotation = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansquotation',modulefieldedit='$ansquotation',modulefieldview='$ansquotation',modulecolumns='$ansquotcolumn' where (userid='$id') and moduletype='Quotations'");
$ansestimate = "Estimate Information,Reference,Sale Person,Customer Information,Item Information";
$ansestcolumn = "Date,No,Name,Amount";
$sqlupestimate = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansestimate',modulefieldedit='$ansestimate',modulefieldview='$ansestimate',modulecolumns='$ansestcolumn' where (userid='$id') and moduletype='Estimates'");
$ansproforma = "Proforma Invoice Information,Due Date,Term,Reference,Sale Person,Customer Information,Item Information,Tax Table,Attach,Description,Notes,Terms and Conditions";
$ansproformacolumn = "Date,No,Name,Amount,Invoice";
$sqlupproforma = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansproforma',modulefieldedit='$ansproforma',modulefieldview='$ansproforma',modulecolumns='$ansproformacolumn' where (userid='$id') and moduletype='Proforma Invoices'");
$ansjob = "Job Information,Due Date,Term,Reference,Sale Person,Customer Information,Item Information,Tax Table,Attach,Description,Notes,Terms and Conditions";
$ansjobcolumn = "Date,No,Name,Amount";
$sqlupjob = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansjob',modulefieldedit='$ansjob',modulefieldview='$ansjob',modulecolumns='$ansjobcolumn' where (userid='$id') and moduletype='Jobs'");
$anssaleorder = "Sales Order Information,Due Date,Term,Reference,Sale Person,Customer Information,Item Information,Tax Table,Attach,Description,Notes,Terms and Conditions";
$anssaleordercolumn = "Date,No,Name,Amount";
$sqlupsaleorder = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anssaleorder',modulefieldedit='$anssaleorder',modulefieldview='$anssaleorder',modulecolumns='$anssaleordercolumn' where (userid='$id') and moduletype='Sales Orders'");
$ansdeliverychallan = "Delivery Challan Information,Due Date,Term,Reference,Sale Person,Customer Information,Item Information";
$ansdeliverychallancolumn = "Date,No,Name,Amount";
$sqlupdeliverychallan = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansdeliverychallan',modulefieldedit='$ansdeliverychallan',modulefieldview='$ansdeliverychallan',modulecolumns='$ansdeliverychallancolumn' where (userid='$id') and moduletype='Delivery Challans'");
$ansinvoice = "Invoice Information,Reference,Sale Person,Customer Information,Item Information,Taxable Value,Tax Value,Tax Table,Attach,Description,Notes,Terms and Conditions";
$ansinvoicecolumn = "Date,No,Name,Term,Amount,Status,Balance";
$sqlupinvoice = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansinvoice',modulefieldedit='$ansinvoice',modulefieldview='$ansinvoice',modulecolumns='$ansinvoicecolumn' where (userid='$id') and moduletype='Invoices'");
$anssalereturn = "Sales Return Information,Reference,Sale Person,Customer Information,Item Information";
$anssalereturncolumn = "Date,No,Name,Term,Amount";
$sqlupsalereturn = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anssalereturn',modulefieldedit='$anssalereturn',modulefieldview='$anssalereturn',modulecolumns='$anssalereturncolumn' where (userid='$id') and moduletype='Sales Returns'");
$anspurchaseorder = "Purchase Order Information";
$anspurchaseordercolumn = "Date,No,Name,Term,Amount";
$sqluppurchaseorder = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anspurchaseorder',modulefieldedit='$anspurchaseorder',modulefieldview='$anspurchaseorder',modulecolumns='$anspurchaseordercolumn' where (userid='$id') and moduletype='Purchase Orders'");
$anspurchasereceive = "Purchase Receive Information";
$anspurchasereceivecolumn = "Date,No,Name,Term,Amount";
$sqluppurchasereceive = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anspurchasereceive',modulefieldedit='$anspurchasereceive',modulefieldview='$anspurchasereceive',modulecolumns='$anspurchasereceivecolumn' where (userid='$id') and moduletype='Purchase Receives'");
$ansbill = "Bill Information,Reference,Sale Person,Vendor Information,Item Information,Taxable Value,Tax Value";
$ansbillcolumn = "Date,No,Name,Term,Amount,Status,Balance";
$sqlupbill = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansbill',modulefieldedit='$ansbill',modulefieldview='$ansbill',modulecolumns='$ansbillcolumn' where (userid='$id') and moduletype='Bills'");
$anspurchasereturn = "Purchase Return Information,Reference,Sale Person,Vendor Information,Item Information";
$anspurchasereturncolumn = "Date,No,Name,Amount";
$sqluppurchasereturn = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anspurchasereturn',modulefieldedit='$anspurchasereturn',modulefieldview='$anspurchasereturn',modulecolumns='$anspurchasereturncolumn' where (userid='$id') and moduletype='Purchase Returns'");
$anssalepayreceive = "Private Id,Notes";
// $anspurchasereturncolumn = "Date,No,Name,Amount";,modulecolumns='$anspurchasereturncolumn'
$sqlupsalepayreceive = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anssalepayreceive',modulefieldedit='$anssalepayreceive',modulefieldview='$anssalepayreceive' where (userid='$id') and moduletype='Payments Received'");
$anssalepaymade = "Private Id,Notes";
// $anspurchasereturncolumn = "Date,No,Name,Amount";,modulecolumns='$anspurchasereturncolumn'
$sqlupsalepaymade = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anssalepaymade',modulefieldedit='$anssalepaymade',modulefieldview='$anssalepaymade' where (userid='$id') and moduletype='Customer Refunds'");
$anspurchasepaymade = "Private Id,Notes";
// $anspurchasereturncolumn = "Date,No,Name,Amount";,modulecolumns='$anspurchasereturncolumn'
$sqluppurchasepaymade = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anspurchasepaymade',modulefieldedit='$anspurchasepaymade',modulefieldview='$anspurchasepaymade' where (userid='$id') and moduletype='Payments Made'");
$anspurchasepaymadefor = "Private Id,Notes";
// $anspurchasereturncolumn = "Date,No,Name,Amount";,modulecolumns='$anspurchasereturncolumn'
$sqluppurchasepaymadefor = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$anspurchasepaymadefor',modulefieldedit='$anspurchasepaymadefor',modulefieldview='$anspurchasepaymadefor' where (userid='$id') and moduletype='Vendor Refunds'");
$ansinventory = "Private Id";
$ansinventorycolumn = "Inventory Adjustments Date,Inventory Adjustments No,Reason,Adjusted By";
$sqlupinventory = mysqli_query($con,"update pairmainaccess set modulefieldcreate='$ansinventory',modulefieldedit='$ansinventory',modulefieldview='$ansinventory',modulecolumns='$ansinventorycolumn' where (userid='$id') and moduletype='Inventory Adjustments'");
                }
            }
                $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='USER', createdon='$times',  createdby='".$email."', useid='$id', useremarks='ACCOUNT CREATED' ");
                mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Create their Profile', '{$id}')");
                
                if($email!='')
                {                   
                    $mail->addAddress($email, $firstname);
                    $mail->Subject = 'Tonic Welcomes You';
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
                                 Hi '.$firstname.',
                                 </div>
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                 Welcome to Tonic. Your account has been created successfully.
                                 
                                 
                                 <div style="padding-top:32px;">   
                               
                               <a href="https://tonic.pairscript.com" dir="ltr" style="text-align:center;display:inline-block" target="_blank" data-saferedirecturl="https://tonic.pairscript.com">
<table role="presentation" cellspacing="0" cellpadding="0" align="center">
    <tbody><tr style="padding:0;margin:0;font-size:0;line-height:0"><td style="border-top:4px;border-top-left-radius:4px;border-top-right-radius:4px;display:inline-block;text-align:center"></td></tr>
        <tr><td style="background-color:#1a73e8;border:1px solid #1a73e8;border-radius:4px;color:#ffffff;display:inline-block;font-family:Google Sans,Roboto,Arial;font-size:13px;line-height:25px;text-decoration:none;padding:7px 24px 7px 24px;font-weight:500;text-align:center;word-break:normal;direction:ltr;min-width:159px">
Login
</td></tr>
    <tr style="padding:0;margin:0;font-size:0;line-height:0"><td style="border-top:3px;display:inline-block;border-bottom-left-radius:4px;border-bottom-right-radius:4px;text-align:center"></td></tr>
</tbody></table></a>
                               
                               
                             </div>
                                 
                                
                              </div>
                              
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                 <b>Need Help?</b>
                                 <p>
                                 Our support team is here to assist you!
                                 </p>
                                 <p>
                                 <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none">Contact Us</a>
                                 </p>
                                 </div>
                              
                              
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding-top:20px;font-size:12px;line-height:16px;color:#5f6368;letter-spacing:0.3px;text-align:center">
                              
                              <p>Replies to this email aren\'t monitored. If you have a question about your new account, the <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none;">Help Center</a> likely has the answer you\'re looking for</p>
                              <p>&copy; '.$year.' Pairscript. All Rights Reserved<br>Pairscript is a registered trademark of pairscript.com</p>
                              <p style="font-size:10px;">Pairscript<br>
                              India</p>
                              
                              
                              </div>
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding-top:20px;font-size:9px;line-height:16px;color:#5f6368;letter-spacing:0.3px;text-align:center">
                              
                              <p>This email was sent to <a style="text-decoration:none" href="mailto:'.$email.'">'.$email.'</a> because you enter this email to create an account with Tonic. If you think this is SPAM or do not wish to receive pairscript.com emails in future,<a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none;"> Contact Us</a> or <a href="https://www.pairscript.com" targe="_blank" style="text-decoration:none;"> Unsubscribe.</a></p>
                              
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
else
{  
header('Location: signup.php?error=Account is already exist. Please use different email or username.');  
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
  <title>
    Sign Up
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
                  <h5 class="m-0 font-weight-bolder">Create a new Account</h5>
                  <h6 class="m-0 text-md font-weight-normal">It's Free and always will be.</h6>
                </div>
                <div class="card-body pt-3">
                
                  <form role="form" method="post">
                    <div class="mb-2">
                      <input type="text" class="form-control" name="fname" placeholder="Name" aria-label="Name" aria-describedby="fname-addon" required>
                    </div>
                    <div class="mb-2">
                      <input type="email" class="form-control" name="user" placeholder="Email Address" aria-label="Email Address or username" aria-describedby="email-addon" required>
                    </div>
                    
                    <div class="mb-2">
                        <input type="password" class="form-control" name="pass" placeholder="Password" aria-label="Email Address or username" aria-describedby="email-addon" required>
                    </div>
<div class="mb-1 text-justify text-secondary">
  By clicking Create Account, you agree to our <a href="#" style= "color:#2960B4;">Terms of Service</a> and <a href="#" style="color:#2960B4;">Privacy Policy</a>, including Cookie Use.
  </div>



                    <?php
                if(isset($_GET['remarks']))
                {
                    ?>
                    <div class="text-sm text-success"><?=$_GET['remarks']?></div>
                    <?php
                }
                if(isset($_GET['error']))
                {
                    ?>
                    <div class="text-sm text-danger"><i class="fa fa-exclamation-circle"></i> <?=$_GET['error']?></div>
                    <?php
                }
                ?>
                    <div class="text-center">
                      <button type="submit" name="submit" class="btn bg-gradient-info w-100 mt-3 mb-0 btn-custom" style="background-image:linear-gradient(310deg, #6200ee 0%, #6200ee 100%);">Create Account</button>
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
<footer class="footer py-5" style="color:#5D6778;">
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
                  <h5 class="mb-0" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-weight: 545;">Account Created Successfully</h5>


                  <a href="index.php" class="btn bg-gradient-info w-100 mt-3 mb-0 btn-custom" style="background-image:linear-gradient(310deg, #6200ee 0%, #6200ee 100%); width:75% !important">Login</a>

                </div>
                <div class="card-body pt-2">
                
                  
                  <hr>
                  <div class="copyright text-center text-sm mt-2 text-muted">
         <p style="margin:0;padding:0; color:#333333;" class="text-secondary"> © <script>
              document.write(new Date().getFullYear())
                </script> Pairscript. All Rights Reserved.<br>
        Pairscript is a registered Trademark of pairscript.com
          <br>
                Made with <i class="fa fa-heart" style="color: red;"></i> by
                <a href="https://www.pairscript.com" style="color:#2960B4;" target="_blank">Pairscript</a>
                for a better web.
                </p>
              </div>
              <!-- <footer class="footer py-5" style="color:#5D6778;">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center mt-1">
          <div class="copyright text-center text-sm text-muted">
         <p style="margin:0;padding:0; color:#333333" class="text-secondary"> © <script>
              document.write(new Date().getFullYear())
                </script> . All Rights Reserved.<br>
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