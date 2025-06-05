<?php
include('lcheck.php');
date_default_timezone_set('Asia/Calcutta');
$createdon=date('Y-m-d H:i:s');
$chartaccountcategory= mysqli_real_escape_string($con,$_POST['chartaccountcategory']);
$chartaccountsubcategory = mysqli_real_escape_string($con,$_POST['chartaccountsubcategory']);
$chartaccountcode = mysqli_real_escape_string($con,$_POST['chartaccountcode']);
$chartaccountname = mysqli_real_escape_string($con,$_POST['chartaccountname']);
$watchlist = mysqli_real_escape_string($con, (isset($_POST['watchlist'])) ? '1' : '0');
$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Chart of Accounts' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Chart of Accounts' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
$publicsql=mysqli_query($con,"select count(publicid) from pairchartaccounts where createdid='$companymainid'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publicid=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
$privatesql=mysqli_query($con,"select count(privateid) from pairchartaccounts where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privateid=$infomainaccesspublicname['moduleprefix'] . $infomainaccesspublicname['modulesuffix']+1;
$notes = mysqli_real_escape_string($con,$_POST['notes']);
if(isset($_POST['edit']))
{
$id = mysqli_real_escape_string($con,$_POST['id']);
$sql=mysqli_query($con,"update pairchartaccounts set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',   chartaccountcategory='$chartaccountcategory',  childname='$chartaccountsubcategory',  chartaccountcode='$chartaccountcode',  parentname='$chartaccountname', notes='$notes',publicid='$publicid',privateid='$privateid',watchlist='$watchlist' where id='$id'");
if($sql)
{
header("Location: chartaccounts.php?remarks=Update Successfully");
}
else
{
header("Location: chartaccounts.php?remarks=Error");
}
}
else
{
$sql=mysqli_query($con,"insert into pairchartaccounts set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',   chartaccountcategory='$chartaccountcategory',  childname='$chartaccountsubcategory',  chartaccountcode='$chartaccountcode', parentname='$chartaccountname', notes='$notes',publicid='$publicid',privateid='$privateid',watchlist='$watchlist'");
$sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Chart of Accounts'");
if($sql)
{
$id=mysqli_insert_id($con);
if(isset($_POST['open']))
{
header("Location: chartaccountadd.php?remarks=Added Successfully");	
}
else
{
header("Location: chartaccounts.php?remarks=Added Successfully");	
}

}
else
{
header("Location: chartaccounts.php?remarks=Error");
}
}
?>
