<?php
include('lcheck.php');
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$datefor = 'd/m/Y';
}
if ($_GET['differ']=='inv') {
function get_maincategory($con , $term, $companymainid, $fsess, $custid, $ratedef){ 
$query = "SELECT invoiceno,invoicedate,productrate,prodiscounttype,prodiscount FROM pairinvoices where createdid='$companymainid' and franchisesession='".$fsess."' and productid='".$term."' and customerid='".$custid."' ".$ratedef." group by invoiceno order by invoicedate desc";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $ratedatas[] = $row; }
 return $ratedatas; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")&&(isset($_GET['custid']))&&($_GET['custid']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']), $companymainid, $_SESSION["franchisesession"],mysqli_real_escape_string($con, $_GET['custid']),mysqli_real_escape_string($con, $_GET['ratedef']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
if($maincategory['invoiceno']==null)   
{
  $ratedatas['invoiceno']="";
}
else
{
  $ratedatas['invoiceno'] = $maincategory['invoiceno'];
}
if($maincategory['invoicedate']==null)   
{
  $ratedatas['invoicedate']="";
}
else
{
  $ratedatas['invoicedate'] = date($datefor,strtotime($maincategory['invoicedate']));
}
if($maincategory['productrate']==null)   
{
  $ratedatas['productrate']="";
}
else
{
  $ratedatas['productrate'] = $maincategory['productrate'];
}
if($maincategory['prodiscount']==null)   
{
  $ratedatas['productdiscount']="";
}
else
{
  $ansdis = ($maincategory['prodiscounttype']=='0')?''.$maincategory['prodiscount'].'%':'<span style="margin-right:-3px !important;"> '.$resmaincurrencyans.'</span> '.$maincategory['prodiscount'].'';
  $ratedatas['productdiscount'] = $ansdis;
}
 
    array_push($maincategoryList, $ratedatas);
 }
 echo json_encode($maincategoryList);
}
}
if ($_GET['differ']=='bill') {
function get_maincategory($con , $term, $companymainid, $fsess, $custid, $ratedef){ 
$query = "select billno,billdate,productrate,prodiscounttype,prodiscount from pairbills where createdid='$companymainid' and franchisesession='".$fsess."' and productid='".$term."' ".$ratedef." group by billno order by billdate desc";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $ratedatas[] = $row; }
 return $ratedatas; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")&&(isset($_GET['custid']))&&($_GET['custid']!="")) {
  
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']), $companymainid, $_SESSION["franchisesession"],mysqli_real_escape_string($con, $_GET['custid']),mysqli_real_escape_string($con, $_GET['ratedef']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
if($maincategory['billno']==null)   
{
  $ratedatas['invoiceno']="";
}
else
{
  $ratedatas['invoiceno'] = $maincategory['billno'];
}
if($maincategory['billdate']==null)   
{
  $ratedatas['invoicedate']="";
}
else
{
  $ratedatas['invoicedate'] = date($datefor,strtotime($maincategory['billdate']));
}
if($maincategory['productrate']==null)   
{
  $ratedatas['productrate']="";
}
else
{
  $ratedatas['productrate'] = $maincategory['productrate'];
}
if($maincategory['prodiscount']==null)   
{
  $ratedatas['productdiscount']="";
}
else
{
  $ansdis = ($maincategory['prodiscounttype']=='0')?''.$maincategory['prodiscount'].'%':'<span style="margin-right:-3px !important;"> '.$resmaincurrencyans.'</span> '.$maincategory['prodiscount'].'';
  $ratedatas['productdiscount'] = $ansdis;
}
 
    array_push($maincategoryList, $ratedatas);
 }
 echo json_encode($maincategoryList);
}
}
?>