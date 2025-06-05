<?php
include 'lcheck.php';
// Invoice
if ($_GET['types']=='inv') {
function getCurrentFinancialYear() {
  $today = new DateTime();
  $fiscalYearStartMonth = 4;
  $currentMonth = $today->format('n');
  $year = $_GET['finyear'];
  function formatMonth($month) {
    return ($month < 10 ? "0" : "") . $month;
  }
  if ($currentMonth < $fiscalYearStartMonth) {
    $anscurrentfinancial = ($year - 1) . '-' . formatMonth($fiscalYearStartMonth) . '-01,' . $year . '-' . formatMonth($fiscalYearStartMonth - 1) . '-31';
  } else {
    $anscurrentfinancial = $year . '-' . formatMonth($fiscalYearStartMonth) . '-01,' . ($year + 1) . '-' . formatMonth($fiscalYearStartMonth - 1) . '-31';
  }
  return $anscurrentfinancial;
}
$anscurrentfinancial = getCurrentFinancialYear();
$greaterdate = explode(',',$anscurrentfinancial)[0];
$lessdate = explode(',',$anscurrentfinancial)[1];
$sqlismainaccessuserno=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Invoices' order by id  asc");
$infomainaccessuserno=mysqli_fetch_array($sqlismainaccessuserno);
$existnoalert = $infomainaccessuserno['moduleprefix'].str_pad(($infomainaccessuserno['modulesuffix']+1), 0, "0", STR_PAD_LEFT);
$sqlexistalert=mysqli_query($con, "select id from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='$existnoalert' and invoicedate>='$greaterdate' and invoicedate<='$lessdate'");
if (mysqli_num_rows($sqlexistalert)>0) {
echo "exist";
}
else{
echo "nothing";
}
}
// Invoice
// Bill
if ($_GET['types']=='bill') {
function getCurrentFinancialYear() {
  $today = new DateTime();
  $fiscalYearStartMonth = 4;
  $currentMonth = $today->format('n');
  $year = $_GET['finyear'];
  function formatMonth($month) {
    return ($month < 10 ? "0" : "") . $month;
  }
  if ($currentMonth < $fiscalYearStartMonth) {
    $anscurrentfinancial = ($year - 1) . '-' . formatMonth($fiscalYearStartMonth) . '-01,' . $year . '-' . formatMonth($fiscalYearStartMonth - 1) . '-31';
  } else {
    $anscurrentfinancial = $year . '-' . formatMonth($fiscalYearStartMonth) . '-01,' . ($year + 1) . '-' . formatMonth($fiscalYearStartMonth - 1) . '-31';
  }
  return $anscurrentfinancial;
}
$anscurrentfinancial = getCurrentFinancialYear();
$greaterdate = explode(',',$anscurrentfinancial)[0];
$lessdate = explode(',',$anscurrentfinancial)[1];
$sqlismainaccessuserno=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Bills' order by id  asc");
$infomainaccessuserno=mysqli_fetch_array($sqlismainaccessuserno);
$existnoalert = $infomainaccessuserno['moduleprefix'].str_pad(($infomainaccessuserno['modulesuffix']+1), 0, "0", STR_PAD_LEFT);
$sqlexistalert=mysqli_query($con, "select id from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$existnoalert' and billdate>='$greaterdate' and billdate<='$lessdate'");
if (mysqli_num_rows($sqlexistalert)>0) {
echo "exist";
}
else{
echo "nothing";
}
}
// Bill
?>