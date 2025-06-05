<?php      
$host = "localhost";  
$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
$user = "tonic_pairscript";  
$password = 'dNzy2GXyLRteHFbW';  
$db_name = "tonic_pairscript"; 
}
else
{
$user = "root";  
$password = '';  
$db_name = "tonic_pairscript"; 
}
$con = mysqli_connect($host, $user, $password, $db_name);  
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$times=date('Y-m-d H:i:s');
if (isset($_POST['submit'])) {

// $pairreportmodules = mysqli_query($con,"INSERT INTO pairreportmodules SET types='[types]', typefields=''");

// $pairreportfavmodules = mysqli_query($con,"INSERT INTO pairreportfavmodules SET reportnames='[types]', reporturlname='[filename]', reportstatus='0', reportoriginals='[original file name]', reportfunctions='[favourite onclick function]', reporturl='[filename].php?period=thismonth', reporthref=''");

$pairmodules = mysqli_query($con,"UPDATE pairmodules SET modulecolumns = 'Business Overview,Horizontal Balance Sheet,Horizontal Profit and Loss,Account Transactions,Receivables or Who owes you,Invoice List or Details,Payments Received,Payables or What you owe,Bills List or Details,Payments Made,Taxes,Summary of Inward Supplies opparen GSTR hypens 2 closparen,Summary of Outward Supplies opparen GSTR hypens 1 closparen,Summary of Credit Note,Summary of Debit Note,Customer Balance,Balance,Sales Details,Sales,Product Customer Wise Sales,Product Movement,Sales Person,Profit And Loss,Accounts,Journal,Accounts Transactions' WHERE id = 33;");

$sql = "select * from paircontrols";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)){

if($row['role']=='SUPER ADMIN')
{
	$companymainid=$row['id'];
	$companymainidforaccess=0;
}
else
{
	$companymainid=$row['createdid'];
	$companymainidforaccess=$row['createdid'];
}

if ($row['franchises']!='') {

$franchiseValues = explode(',', $row['franchises']);
if (!empty($franchiseValues)) {
foreach ($franchiseValues as $franchiseValue) {
if (!empty($franchiseValue)) {

$reportone = mysqli_query($con,"SELECT * FROM pairreports WHERE createdid='$companymainid' AND franchiseid='".$franchiseValue."' AND types='crnote'");

if (mysqli_num_rows($reportone)==0) {

$pairreports = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', franchiseid='".$franchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='crnote', rowcolumns='', rowcolumnsorder='Description,IGST Amount,CGST Amount,SGST Amount,Credit Note Total'");

$pairreportfavourites = mysqli_query($con,"INSERT INTO pairreportfavourites SET createdid='$companymainid', franchisesession='".$franchiseValue."', reportnames='crnote', reporturlname='reportcrnote', reportstatus='0', reportoriginals='Summary of Credit Note', reportfunctions='favouritecrnote', reporturl='reportcrnote.php?period=thismonth&proid=all', reporthref=''");

$pairreportscrreg = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', franchiseid='".$franchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='crnoteregistered', rowcolumns='', rowcolumnsorder=''");

$pairreportscrcon = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', franchiseid='".$franchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='crnoteconsumer', rowcolumns='', rowcolumnsorder=''");

}

$reporttwo = mysqli_query($con,"SELECT * FROM pairreports WHERE createdid='$companymainid' AND franchiseid='".$franchiseValue."' AND types='drnote'");

if (mysqli_num_rows($reporttwo)==0) {

$pairreports = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', franchiseid='".$franchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='drnote', rowcolumns='', rowcolumnsorder='Description,IGST Amount,CGST Amount,SGST Amount,Debit Note Total'");

$pairreportfavourites = mysqli_query($con,"INSERT INTO pairreportfavourites SET createdid='$companymainid', franchisesession='".$franchiseValue."', reportnames='drnote', reporturlname='reportdrnote', reportstatus='0', reportoriginals='Summary of Debit Note', reportfunctions='favouritedrnote', reporturl='reportdrnote.php?period=thismonth&proid=all', reporthref=''");

$pairreportsdrreg = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', franchiseid='".$franchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='drnoteregistered', rowcolumns='', rowcolumnsorder=''");

$pairreportsdrcon = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', franchiseid='".$franchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='drnoteconsumer', rowcolumns='', rowcolumnsorder=''");

}

}
}
}

}
else{

$reportone = mysqli_query($con,"SELECT * FROM pairreports WHERE createdid='$companymainid' AND types='crnote'");

if (mysqli_num_rows($reportone)==0) {

$pairreports = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='crnote', rowcolumns='', rowcolumnsorder='Description,IGST Amount,CGST Amount,SGST Amount,Credit Note Total'");

$pairreportfavourites = mysqli_query($con,"INSERT INTO pairreportfavourites SET createdid='$companymainid',  reportnames='crnote', reporturlname='reportcrnote', reportstatus='0', reportoriginals='Summary of Credit Note', reportfunctions='favouritecrnote', reporturl='reportcrnote.php?period=thismonth&proid=all', reporthref=''");

$pairreportscrreg = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='crnoteregistered', rowcolumns='', rowcolumnsorder=''");

$pairreportscrcon = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='crnoteconsumer', rowcolumns='', rowcolumnsorder=''");

}

$reporttwo = mysqli_query($con,"SELECT * FROM pairreports WHERE createdid='$companymainid' AND types='drnote'");

if (mysqli_num_rows($reporttwo)==0) {

$pairreports = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='drnote', rowcolumns='', rowcolumnsorder='Description,IGST Amount,CGST Amount,SGST Amount,Debit Note Total'");

$pairreportfavourites = mysqli_query($con,"INSERT INTO pairreportfavourites SET createdid='$companymainid',  reportnames='drnote', reporturlname='reportdrnote', reportstatus='0', reportoriginals='Summary of Debit Note', reportfunctions='favouritedrnote', reporturl='reportdrnote.php?period=thismonth&proid=all', reporthref=''");

$pairreportsdrreg = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='drnoteregistered', rowcolumns='', rowcolumnsorder=''");

$pairreportsdrcon = mysqli_query($con,"INSERT INTO pairreports SET createdid='$companymainid', createdby='".$row['username']."', username='".$row['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='drnoteconsumer', rowcolumns='', rowcolumnsorder=''");

}

}
}

header("Location:index.php?remarks=Reports Succesfully Pushed");

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
  <title>
    Push
  </title>
</head>

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
				$sqliu=mysqli_query($con, "select count(id) AS id from paircontrols");
            $infou=mysqli_fetch_assoc($sqliu);
            $userlen=$infou['id'];
            $sql = "select * from paircontrols";
$result = mysqli_query($con, $sql);
$checksumbit = 0;
while($row = mysqli_fetch_array($result)){

if($row['role']=='SUPER ADMIN')
{
	$companymainid=$row['id'];
	$companymainidforaccess=0;
}
else
{
	$companymainid=$row['createdid'];
	$companymainidforaccess=$row['createdid'];
}

if ($row['franchises']!='') {

$franchiseValues = explode(',', $row['franchises']);
if (!empty($franchiseValues)) {
foreach ($franchiseValues as $franchiseValue) {
if (!empty($franchiseValue)) {

$reportone = mysqli_query($con,"SELECT * FROM pairreports WHERE createdid='$companymainid' AND franchiseid='".$franchiseValue."' AND types='crnote'");

if (mysqli_num_rows($reportone)==0) {

$checksumbit = 1;

}

$reporttwo = mysqli_query($con,"SELECT * FROM pairreports WHERE createdid='$companymainid' AND franchiseid='".$franchiseValue."' AND types='drnote'");

if (mysqli_num_rows($reporttwo)==0) {

$checksumbit = 1;

}

}
}
}

}
else{

$reportone = mysqli_query($con,"SELECT * FROM pairreports WHERE createdid='$companymainid' AND types='crnote'");

if (mysqli_num_rows($reportone)==0) {

$checksumbit = 1;

}

$reporttwo = mysqli_query($con,"SELECT * FROM pairreports WHERE createdid='$companymainid' AND types='drnote'");

if (mysqli_num_rows($reporttwo)==0) {

$checksumbit = 1;

}

}
}
				?>
                  <form role="form" method="post">
                  	<h1 align="center" class="p-3">PUSH</h1>
                    <div class="row m-3" id="aligncenterall">
							  <div class="col-sm-6 p-1">
					          <span id="insideheadall">Name :</span>
					        </div>
					        <div class="col-md-6 p-1">
					           Tonic
					        </div>
					     </div>
                    <div class="row m-3" id="aligncenterall">
							  <div class="col-sm-6 p-1">
					          <span id="insideheadall">Users :</span>
					        </div>
					        <div class="col-md-6 p-1">
					           <?=$userlen?>
					        </div>
					     </div>
                    <div class="row m-3" id="aligncenterall">
							  <div class="col-sm-6 p-1">
					          <span id="insideheadall">Push :</span>
					        </div>
					        <div class="col-md-6 p-1">
					           <button type="submit" name="submit" class="btn btn-primary btn-sm btn-custom" style="<?=(($checksumbit == 1)?'display: block':'display: none')?>">Push</button>
					           <a class="btn btn-primary btn-sm btn-custom" style="<?=(($checksumbit == 1)?'display: none':'display: block')?>">Pushed</a>
					        </div>
					     </div>
                  </form>
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
</body>
</html>