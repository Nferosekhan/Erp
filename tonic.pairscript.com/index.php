<?php
session_start();
session_unset();
session_destroy();
// if (isset($_SERVER['HTTP_COOKIE'])) {
//     $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
//     foreach($cookies as $cookie) {
//         $parts = explode('=', $cookie);
//         $name = trim($parts[0]);
//         setcookie($name, '', time()-1000);
//         setcookie($name, '', time()-1000, '/');
//     }
// }
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
if((isset($_POST['user']))&&(isset($_POST['pass']))&&(isset($_POST['submit'])))
{
$username = $_POST['user'];  
$befpassword = $_POST['pass'];  
$username = stripcslashes($username);  
$befpassword = stripcslashes($befpassword);  
$username = mysqli_real_escape_string($con, $username);  
$befpassword = mysqli_real_escape_string($con, $befpassword);  
$saltforpassword = "PAIRSALT";
$sqlforpass = mysqli_query($con,"select id,password from paircontrols where (username = '$username' or usernewname = '$username')");
  $rowforpass = mysqli_fetch_array($sqlforpass);
  $password = mysqli_real_escape_string($con, $rowforpass['password']);
  if (argon2idHashVerify($befpassword, $saltforpassword, $password)) {
  $sqlselect = "select id,role from paircontrols where (username = '$username' or usernewname = '$username') and password = '$password'";  
  $resultselect = mysqli_query($con, $sqlselect);  
  $count = mysqli_num_rows($resultselect);
  $rowselect = mysqli_fetch_array($resultselect, MYSQLI_ASSOC);
  if($rowselect['role']=='SUPER ADMIN')
  {
    $toggleid=$rowselect['id'];
  }
  else
  {
    $toggleid=$rowselect['createdid'];
  }
  $sqliexpdate=mysqli_query($con, "select expdate,remindon from paircontrols where createdid='".$toggleid."' order by id desc");
  $infoexpdate=mysqli_fetch_array($sqliexpdate);
  $expiryDate = strtotime($infoexpdate['expdate'] . ' 24:00:00');
  $reminderDays = $infoexpdate['remindon'];
  $currentDate = time();
  if ($currentDate >= $expiryDate) {
  header('Location: index.php?error=Your license is expired. Contact Pairscript to activate it.');
  }
  else{
  $sql = "select is_active,username,password,firstname,profileimage,id,items,invoice,customer,settings,role,createdid from paircontrols where (username = '$username' or usernewname = '$username') and password = '$password'";  
  $result = mysqli_query($con, $sql);  
  $count = mysqli_num_rows($result);  
  if($count>0)
  {  
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if($row['is_active']=='0')
  {
  $_SESSION["unqwerty"] = $row['username'];
  $_SESSION["psqwerty"] = $row['password'];
  $_SESSION["firstname"] = $row['firstname'];
  $_SESSION["rememberMe"] = $_POST['rememberMe'];
  setcookie('unqwerty', $row['username'], time() + (86400 * 30), "/");  
  setcookie('psqwerty', $row['password'], time() + (86400 * 30), "/");
  setcookie('firstname', $row['firstname'], time() + (86400 * 30), "/");
  if(isset($_POST['rememberMe']))
  {
  setcookie('rememberMe', $_POST['rememberMe'], time() + (86400 * 30), "/");
  }
  $updatelastlogin=mysqli_query($con, "UPDATE paircontrols SET lastlogin=NOW() WHERE createdid='".$toggleid."'");
  header('Location: dashboard.php');  
  }
  else
  {  
  header('Location: index.php?error=Your Accout is Disabled. Please Contact Administrator');  
  }
  }  
  else
  {  
  header('Location: index.php?error=Login failed. Invalid username or password.');  
  }
  }
}
else{  
  header('Location: index.php?error=Login failed. Invalid username or password.');  
}
}
if(((isset($_SESSION['unqwerty']))&&(isset($_SESSION['psqwerty'])))||((isset($_COOKIE['unqwerty']))&&(isset($_COOKIE['psqwerty'])))&&(((isset($_COOKIE['rememberMe']))&&($_COOKIE['rememberMe']==1))))
{
if(((isset($_SESSION['unqwerty']))&&(isset($_SESSION['psqwerty']))))
{ 
$username = $_SESSION['unqwerty'];  
$password = $_SESSION['psqwerty'];  
}
if(((isset($_COOKIE['unqwerty']))&&(isset($_COOKIE['psqwerty']))))
{
$username = $_COOKIE['unqwerty'];  
$password = $_COOKIE['psqwerty'];   
}
$username = stripcslashes($username);  
$password = stripcslashes($password);  
$username = mysqli_real_escape_string($con, $username);  
$password = mysqli_real_escape_string($con, $password);  
$sql = "select is_active,username,password,firstname,profileimage,id,items,invoice,customer,settings,role,createdid from paircontrols where (username = '$username' or usernewname = '$username') and password = '$password'";  
$result = mysqli_query($con, $sql);  
$count = mysqli_num_rows($result);  
if($count>0)
{ 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row['is_active']=='0')
{
  
$_SESSION["unqwerty"] = $row['username'];
$_SESSION["psqwerty"] = $row['password'];
$_SESSION["firstname"] = $row['firstname'];
$_SESSION["profileimage"] = $row['profileimage'];
setcookie('unqwerty', $row['username'], time() + (86400 * 30), "/");  
setcookie('psqwerty', $row['password'], time() + (86400 * 30), "/");
setcookie('firstname', $row['firstname'], time() + (86400 * 30), "/");
setcookie('profileimage', $row['profileimage'], time() + (86400 * 30), "/");
if(isset($_SESSION['rememberMe']))
{
setcookie('rememberMe', $_SESSION['rememberMe'], time() + (86400 * 30), "/");
}
$userid=$row['id'];
$itemsaction=$row['items'];
$invoiceaction=$row['invoice'];
$customeraction=$row['customer'];
$settingsaction=$row['settings'];
$userrole=$row['role'];
if($userrole=='SUPER ADMIN')
{
  $companymainid=$row['id'];
}
else if($userrole=='FRANCHISE')
{
  $companymainid=$row['id'];
}
else
{
  $companymainid=$row['createdid'];
}
$updatelastlogin=mysqli_query($con, "UPDATE paircontrols SET lastlogin=NOW() WHERE id='".$userid."'");
header('Location: dashboard.php'); 
}
else
{  

}
}  
else
{  
  
}
}
else{
  if (isset($_SERVER['HTTP_COOKIE'])) {
      $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
      foreach($cookies as $cookie) {
          $parts = explode('=', $cookie);
          $name = trim($parts[0]);
          setcookie($name, '', time()-1000);
          setcookie($name, '', time()-1000, '/');
      }
  }
}
$usernameval = '';
if (isset($_GET['email'])) {
   $usernameval = base64_decode($_GET['email']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
  <title>
    Login
  </title>
</head>

<body><!--  style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;" -->
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-3">
                <div class="card-header pb-0 text-left bg-transparent">
				<img src="assets/img/loginlogo.png" width="100%" class="img-responsive mb-3">
                  <!--<h3 class="font-weight-bolder text-info text-gradient"></h3>
                  <p class="mb-0 text-sm">Enter your email and password to sign in</p>-->
                </div>
                <div class="card-body">
				<?php
				if(isset($_GET['remarks']))
				{
					?>
					<div class="alert alert-success text-sm text-white"><?=$_GET['remarks']?></div>
					<?php
				}
				if(isset($_GET['error']))
				{
					?>
					<div class="alert alert-danger text-sm text-white"><?=$_GET['error']?></div>
					<?php
				}
				?>
                  <form role="form" method="post">
                    <div class="mb-3">
                      <input type="text" class="form-control" name="user" id="user" value="<?=$usernameval?>" placeholder="Email Address or username" aria-label="Email Address or username" aria-describedby="email-addon" required style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                    </div>
                    <div class="text-center">
                        <label style="font-size:13px;color:#787878"><input type="checkbox" name="rememberMe" id="rememberMe" value="1" <?=(((isset($_SESSION['rememberMe']))&&($_SESSION['rememberMe']==1))?'checked':'')?> style="height:11px;"> Remember me </label> <i class="fa fa-info-circle" style="height:11px;"></i> - <a href="forgot.php" style="color:#2960B4;">Forgot Password?</a> 
                    </div>
                    
                    
                    <div class="text-center">
                      <button type="submit" name="submit" class="btn bg-gradient-info w-100 mt-2 mb-0 btn-custom" style="background-image:linear-gradient(310deg, #6200ee 0%, #6200ee 100%);">Log In</button>
                    </div>
					<div class="brs text-center mt-2">
					<span class="brsbro">
					or
					</span>
					</div>
					<div class="text-center">
					<p style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Don't have an account? <a href="signup.php" style="color:#2960B4;">Sign Up</a></p>
					
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
<script type="text/javascript">
  <?php
    if ($usernameval!='') {
  ?>
  setTimeout(function(){
    document.getElementById("user").focus();
    document.getElementById("pass").focus();
    document.getElementById("pass").value = '';
  },1000);
  <?php
    }
  ?>
</script>
</body>
</html>