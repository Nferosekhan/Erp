<?php
include('lcheck.php');
 if((isset($_GET['estimateno']))&&(isset($_GET['estimatedate'])))
 {
     $estimateno=mysqli_real_escape_string($con, $_GET['estimateno']);
     $estimatedate=mysqli_real_escape_string($con, $_GET['estimatedate']);
 $sql=mysqli_query($con, "select * from pairestimates where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and estimateno='$estimateno' and estimatedate='$estimatedate' order by id asc");
if(mysqli_num_rows($sql)>0)
{
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Estimates' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Estimates' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)||($infomainaccessuser['useraccessedit']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
$sqlgetcur=mysqli_query($con,"select * from paircurrency");
$rowcur=mysqli_fetch_array($sqlgetcur);
$anscur=$rowcur['currencysymbol'];
$rescurrency=explode('-',$anscur);

if(isset($_POST['grandtotal']))
{
date_default_timezone_set('Asia/Calcutta');
if (($infomainaccessuser['estimatecustinfo']=='defone')||($infomainaccessuser['estimatecustinfo']=='deftwo')) {
    $scriptonetwo = mysqli_real_escape_string($con, $_POST['customerinfodefault']);
}
else{
    $scriptonetwo = 'three';
}
$createdon=date('Y-m-d H:i:s');
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Estimates' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if ($infomainaccessuser['estimatecustinfo']=='one'||($scriptonetwo=='one')) {
$customername=mysqli_real_escape_string($con, $_POST['customername']);
$customerid=mysqli_real_escape_string($con, $_POST['customerid']);
$address1 = mysqli_real_escape_string($con, $_POST['address1']);
$address2 = mysqli_real_escape_string($con, $_POST['address2']);
// $area = mysqli_real_escape_string($con, $_POST['area']);
// $city = mysqli_real_escape_string($con, $_POST['city']);
// $state = mysqli_real_escape_string($con, $_POST['state']);
// $district = mysqli_real_escape_string($con, $_POST['district']);
// $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
$saddress1 = mysqli_real_escape_string($con, $_POST['saddress1']);
$saddress2 = mysqli_real_escape_string($con, $_POST['saddress2']);
// $sarea = mysqli_real_escape_string($con, $_POST['sarea']);
// $scity = mysqli_real_escape_string($con, $_POST['scity']);
// $sstate = mysqli_real_escape_string($con, $_POST['sstate']);
// $sdistrict = mysqli_real_escape_string($con, $_POST['sdistrict']);
// $spincode = mysqli_real_escape_string($con, $_POST['spincode']);
$gstno = mysqli_real_escape_string($con, $_POST['gstgstin']);
$pos=mysqli_real_escape_string($con, $_POST['pos']);
$twoworkphone = mysqli_real_escape_string($con, $_POST['workworkphone']);
$twomobilephone = mysqli_real_escape_string($con, $_POST['workmobile']);
$twosameasbilling = '0';
if(isset($_POST['gstgstrtype'])){
$gstrtype=mysqli_real_escape_string($con, $_POST['gstgstrtype']);
}
else{
$gstrtype='';
}
}
else{
$gstrtype = mysqli_real_escape_string($con, $_POST['twogsttreatment']);
}
$estimateterm=mysqli_real_escape_string($con, $_POST['estimateterm']);
$oldestimateno=mysqli_real_escape_string($con, $_GET['estimateno']);
$oldestimatedate=mysqli_real_escape_string($con, $_GET['estimatedate']);
$estimateno=mysqli_real_escape_string($con, $_POST['estimateno']);
$estimatedate=mysqli_real_escape_string($con, $_POST['estimatedate']);
$duedate=mysqli_real_escape_string($con, $_POST['duedate']);
$duedates=mysqli_real_escape_string($con, (isset($_POST['duedates']))?$_POST['duedates']:'');
//$orderdcno=mysqli_real_escape_string($con, $_POST['orderdcno']);
$orderdcno="";
if ((in_array('Sale Person', $fieldedit))) {
if(isset($_POST['saleperson'])){
$saleperson=mysqli_real_escape_string($con, $_POST['saleperson']);
}
else{
$saleperson='';
}
}
else{
$saleperson='';
}
if ((in_array('Reference', $fieldedit))) {
$reference=mysqli_real_escape_string($con, $_POST['reference']);
}
else{
$reference='';
}
$totalitems=mysqli_real_escape_string($con, $_POST['totalitems']);
$totalvatamount=mysqli_real_escape_string($con, $_POST['totalvatamount']);
$totalamount=mysqli_real_escape_string($con, $_POST['totalamount']);
$discount=mysqli_real_escape_string($con, $_POST['discount']);
$totalquantity=mysqli_real_escape_string($con, $_POST['totalquantity']);
$discounttype=mysqli_real_escape_string($con, $_POST['discounttype']);
$discountamount=mysqli_real_escape_string($con, $_POST['discountamount']);
$freightamount=mysqli_real_escape_string($con, $_POST['freightamount']);
$roundoff=mysqli_real_escape_string($con, $_POST['roundoff']);
$grandtotal=mysqli_real_escape_string($con, $_POST['grandtotal']);
$estimateamount=mysqli_real_escape_string($con, $_POST['grandtotal']);
$preparedby=mysqli_real_escape_string($con, $_POST['preparedby']);
$checkedby=mysqli_real_escape_string($con, $_POST['checkedby']);
$taxtype=mysqli_real_escape_string($con, $_POST['taxtype']);
if ((in_array('Tax Table', $fieldedit))) {
$cgst25=mysqli_real_escape_string($con, $_POST['cgst25']);
$sgst25=mysqli_real_escape_string($con, $_POST['sgst25']);
$gst25=mysqli_real_escape_string($con, $_POST['gst25']);
$cgst6=mysqli_real_escape_string($con, $_POST['cgst6']);
$sgst6=mysqli_real_escape_string($con, $_POST['sgst6']);
$gst6=mysqli_real_escape_string($con, $_POST['gst6']);
$cgst9=mysqli_real_escape_string($con, $_POST['cgst9']);
$sgst9=mysqli_real_escape_string($con, $_POST['sgst9']);
$gst9=mysqli_real_escape_string($con, $_POST['gst9']);
$cgst14=mysqli_real_escape_string($con, $_POST['cgst14']);
$sgst14=mysqli_real_escape_string($con, $_POST['sgst14']);
$gst14=mysqli_real_escape_string($con, $_POST['gst14']);
$tax25=mysqli_real_escape_string($con, $_POST['tax25']);
$tax6=mysqli_real_escape_string($con, $_POST['tax6']);
$tax9=mysqli_real_escape_string($con, $_POST['tax9']);
$tax14=mysqli_real_escape_string($con, $_POST['tax14']);
}
else{
$cgst25='';
$sgst25='';
$gst25='';
$cgst6='';
$sgst6='';
$gst6='';
$cgst9='';
$sgst9='';
$gst9='';
$cgst14='';
$sgst14='';
$gst14='';
$tax25='';
$tax6='';
$tax9='';
$tax14='';
}
if ((in_array('Terms and Conditions', $fieldedit))) {
$terms=mysqli_real_escape_string($con, $_POST['terms']);
}
else{
$terms='';
}
if ((in_array('Notes', $fieldedit))) {
$notes=mysqli_real_escape_string($con, $_POST['notes']);
}
else{
$notes='';
}

if ((in_array('Description', $fieldedit))) {
$description=mysqli_real_escape_string($con, $_POST['description']);
}
else{
$description='';
}
if ((in_array('Attach', $fieldedit))) {
//$validpaidamount=mysqli_real_escape_string($con, $_POST['validpaidamount']);
//$validbalance=mysqli_real_escape_string($con, $_POST['validbalance']);
$fileattach=mysqli_real_escape_string($con, $_POST['fileattach1']);

$files = array_filter($_FILES['fileattach']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['fileattach']['name']);
// Loop through every file
for( $i=0 ; $i < $total_count ; $i++ ) {
//The temp file path is obtained
$tmpFilePath = $_FILES['fileattach']['tmp_name'][$i];
//A file path needs to be present
if ($tmpFilePath != ""){
//Setup our new file path
$newFilePath = "ups/fileattach/".time().$_FILES['fileattach']['name'][$i];
//File is uploaded to temp dir
if(move_uploaded_file($tmpFilePath, $newFilePath)) {
if($fileattach!="")
{
$fileattach.=" | ".$newFilePath;
}
else
{
$fileattach.="".$newFilePath;
}
}
}
}
}
else{
$fileattach='';
}
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Estimates' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if ($infomainaccessuser['estimatecustinfo']=='one'||($scriptonetwo=='one')) {

$custid=mysqli_real_escape_string($con, $_POST['customer']);
$custsqlcushis=mysqli_query($con,"select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and id='".$custid."'");
$custsqlanscus = mysqli_fetch_array($custsqlcushis);
$custoldworkphone = $custsqlanscus['workphone'];
$custoldmobilephone = $custsqlanscus['mobile'];
$custoldbillstreet = $custsqlanscus['billstreet'];
$custoldbillcity = $custsqlanscus['billcity'];
$custoldbillstate = $custsqlanscus['billstate'];
$custoldbillpincode = $custsqlanscus['billpincode'];
$custoldbillcountry = $custsqlanscus['billcountry'];
$custoldshipstreet = $custsqlanscus['shipstreet'];
$custoldshipcity = $custsqlanscus['shipcity'];
$custoldshipstate = $custsqlanscus['shipstate'];
$custoldshippincode = $custsqlanscus['shippincode'];
$custoldshipcountry = $custsqlanscus['shipcountry'];
$custoldgstrtype = $custsqlanscus['gstrtype'];
$custoldgstin = $custsqlanscus['gstin'];
$area = mysqli_real_escape_string($con, $_POST['billstreet']);
$city = mysqli_real_escape_string($con, $_POST['billcity']);
$state = mysqli_real_escape_string($con, $_POST['billstate']);
$pincode = mysqli_real_escape_string($con, $_POST['billpincode']);
$district = mysqli_real_escape_string($con, $_POST['billcountry']);

$custgstin = mysqli_real_escape_string($con, $_POST['gstgstin']);
$custworkphone = mysqli_real_escape_string($con, $_POST['workworkphone']);
$custmobilephone = mysqli_real_escape_string($con, $_POST['workmobile']);
$sarea = mysqli_real_escape_string($con, $_POST['shipstreet']);
$scity = mysqli_real_escape_string($con, $_POST['shipcity']);
$sstate = mysqli_real_escape_string($con, $_POST['shipstate']);
$spincode = mysqli_real_escape_string($con, $_POST['shippincode']);
$sdistrict = mysqli_real_escape_string($con, $_POST['shipcountry']);
$custsqlup = "update paircustomers set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."',billstreet='$area',billcity='$city',billstate='$state',billpincode='$pincode',billcountry='$district',shipstreet='$sarea',shipcity='$scity',shipstate='$sstate',shippincode='$spincode',shipcountry='$sdistrict',gstrtype='$gstrtype',gstin='$custgstin',workphone='$custworkphone',mobile='$custmobilephone' where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and id='$custid'";
$custqueryup = mysqli_query($con, $custsqlup);
$custch='';
if($custworkphone!=$custoldworkphone)
{
if($custch!='')
{
$custch.='<br> Work Phone<span style="color:green;" id="prohisfromtospan">( From '.$custoldworkphone.' To '.$custworkphone.' ) </span>';
}
else
{
$custch.='Work Phone<span style="color:green;" id="prohisfromtospan">( From '.$custoldworkphone.' To '.$custworkphone.' ) </span>';
}
}
if($custmobilephone!=$custoldmobilephone)
{
if($custch!='')
{
$custch.='<br> Mobile Phone<span style="color:green;" id="prohisfromtospan">( From '.$custoldmobilephone.' To '.$custmobilephone.' ) </span>';
}
else
{
$custch.='Mobile Phone<span style="color:green;" id="prohisfromtospan">( From '.$custoldmobilephone.' To '.$custmobilephone.' ) </span>';
}
}
if($area!=$custoldbillstreet)
{
if($custch!='')
{
$custch.='<br> Billing Street<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillstreet.' To '.$area.' ) </span>';
}
else
{
$custch.='Billing Street<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillstreet.' To '.$area.' ) </span>';
}
}
if($city!=$custoldbillcity)
{
if($custch!='')
{
$custch.='<br> Billing City<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillcity.' To '.$city.' ) </span>';
}
else
{
$custch.='Billing City<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillcity.' To '.$city.' ) </span>';
}
}
if($state!=$custoldbillstate)
{
if($custch!='')
{
$custch.='<br> Billing State<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillstate.' To '.$state.' ) </span>';
}
else
{
$custch.='Billing State<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillstate.' To '.$state.' ) </span>';
}
}
if($pincode!=$custoldbillpincode)
{
if($custch!='')
{
$custch.='<br> Billing Pincode<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillpincode.' To '.$pincode.' ) </span>';
}
else
{
$custch.='Billing Pincode<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillpincode.' To '.$pincode.' ) </span>';
}
}
if($district!=$custoldbillcountry)
{
if($custch!='')
{
$custch.='<br> Billing Country<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillcountry.' To '.$district.' ) </span>';
}
else
{
$custch.='Billing Country<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillcountry.' To '.$district.' ) </span>';
}
}
if($sarea!=$custoldshipstreet)
{
if($custch!='')
{
$custch.='<br> Shipping Street<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipstreet.' To '.$sarea.' ) </span>';
}
else
{
$custch.='Shipping Street<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipstreet.' To '.$sarea.' ) </span>';
}
}
if($scity!=$custoldshipcity)
{
if($custch!='')
{
$custch.='<br> Shipping City<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipcity.' To '.$scity.' ) </span>';
}
else
{
$custch.='Shipping City<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipcity.' To '.$scity.' ) </span>';
}
}
if($sstate!=$custoldshipstate)
{
if($custch!='')
{
$custch.='<br> Shipping State<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipstate.' To '.$sstate.' ) </span>';
}
else
{
$custch.='Shipping State<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipstate.' To '.$sstate.' ) </span>';
}
}
if($spincode!=$custoldshippincode)
{
if($custch!='')
{
$custch.='<br> Shipping Pincode<span style="color:green;" id="prohisfromtospan">( From '.$custoldshippincode.' To '.$spincode.' ) </span>';
}
else
{
$custch.='Shipping Pincode<span style="color:green;" id="prohisfromtospan">( From '.$custoldshippincode.' To '.$spincode.' ) </span>';
}
}
if($sdistrict!=$custoldshipcountry)
{
if($custch!='')
{
$custch.='<br> Shipping Country<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipcountry.' To '.$sdistrict.' ) </span>';
}
else
{
$custch.='Shipping Country<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipcountry.' To '.$sdistrict.' ) </span>';
}
}
if($gstrtype!=$custoldgstrtype)
{
if($custch!='')
{
$custch.='<br> GST Registration Type<span style="color:green;" id="prohisfromtospan">( From '.$custoldgstrtype.' To '.$gstrtype.' ) </span>';
}
else
{
$custch.='GST Registration Type<span style="color:green;" id="prohisfromtospan">( From '.$custoldgstrtype.' To '.$gstrtype.' ) </span>';
}
}
if($custgstin!=$custoldgstin)
{
if($custch!='')
{
$custch.='<br> GSTIN / UIN<span style="color:green;" id="prohisfromtospan">( From '.$custoldgstin.' To '.$custgstin.' ) </span>';
}
else
{
$custch.='GSTIN / UIN<span style="color:green;" id="prohisfromtospan">( From '.$custoldgstin.' To '.$custgstin.' ) </span>';
}
}
if($custch!='')
{
$custsqluse=mysqli_query($con, "insert into pairusehistory set usetype='CUSTOMERS', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$custid', useremarks='".$custch."' ");
}
}
               if ($infomainaccessuser['estimatecustinfo']=='two'||($scriptonetwo=='two')) {
$address1 = '';
$address2 = '';
$saddress1 = '';
$saddress2 = '';
$customername = mysqli_real_escape_string($con, $_POST['twocustomername']);
$area = mysqli_real_escape_string($con, $_POST['twobillstreet']);
$city = mysqli_real_escape_string($con, $_POST['twobillcity']);
$state = mysqli_real_escape_string($con, $_POST['twobillstate']);
$pincode = mysqli_real_escape_string($con, $_POST['twobillpincode']);
$district = mysqli_real_escape_string($con, $_POST['twobillcountry']);

$gstno = mysqli_real_escape_string($con, $_POST['twogstin']);
$twoworkphone = mysqli_real_escape_string($con, $_POST['twoworkphone']);
$twomobilephone = mysqli_real_escape_string($con, $_POST['twomobilephone']);
$pos=mysqli_real_escape_string($con, $_POST['twopos']);
$twosameasbilling = mysqli_real_escape_string($con, (isset($_POST['twosameasbilling']))?'1':'0');
if ($twosameasbilling=='1') {
$sarea = mysqli_real_escape_string($con, $_POST['twobillstreet']);
$scity = mysqli_real_escape_string($con, $_POST['twobillcity']);
$sstate = mysqli_real_escape_string($con, $_POST['twobillstate']);
$spincode = mysqli_real_escape_string($con, $_POST['twobillpincode']);
$sdistrict = mysqli_real_escape_string($con, $_POST['twobillcountry']);
}
else{
$sarea = mysqli_real_escape_string($con, $_POST['twoshipstreet']);
$scity = mysqli_real_escape_string($con, $_POST['twoshipcity']);
$sstate = mysqli_real_escape_string($con, $_POST['twoshipstate']);
$spincode = mysqli_real_escape_string($con, $_POST['twoshippincode']);
$sdistrict = mysqli_real_escape_string($con, $_POST['twoshipcountry']);
}
$oldtwoworkphone = mysqli_real_escape_string($con, $_POST['oldtwoworkphone']);
$customerid = mysqli_real_escape_string($con, $_POST['oldcustomername']);
$sqlup = "update paircustomers set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', customername='$customername',billstreet='$area',billcity='$city',billstate='$state',billpincode='$pincode',billcountry='$district',shipstreet='$sarea',shipcity='$scity',shipstate='$sstate',shippincode='$spincode',shipcountry='$sdistrict',sameasbilling='$twosameasbilling',gstrtype='$gstrtype',gstin='$gstno',moduletype='Customers',placeos='$pos',workphone='$twoworkphone',mobile='$twomobilephone' where id='$customerid'";
$queryup = mysqli_query($con, $sqlup);
// $sqlcusupdate=mysqli_query($con, "select * from paircustomers where customername='$customername' and workphone='$oldtwoworkphone'");
// $sqlcusupdateup=mysqli_fetch_array($sqlcusupdate);
// $customerid=$sqlcusupdateup['id'];
}
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Estimates' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if ($infomainaccessuser['estimatecustinfo']=='one'||($scriptonetwo=='one')) {
// if($customerid=='')
// {
// $sqlcon = "SELECT id From paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' and customername = '{$customername}'";
// $querycon = mysqli_query($con, $sqlcon);
// $rowCountcon = mysqli_num_rows($querycon);
// if(!$querycon){
// die("SQL query failed: " . mysqli_error($con));
// }
// if($rowCountcon == 0)
// {
// $sqlup = "insert into paircustomers set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', customername='$customername', city='$city', address='$area', pin='$pincode', state='$state', country='$district'";
// $queryup = mysqli_query($con, $sqlup);
// if(!$queryup){
// die("SQL query failed: " . mysqli_error($con));
// }
// else
// {
// // $tid=mysqli_insert_id($con);
// // $customerid=$tid;
// mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Customer', '{$tid}')");
// }
// }
// }
}
for($i=0; $i<count($_POST['oldproductname']); $i++)
{
$productid=mysqli_real_escape_string($con, $_POST['oldproductid'][$i]);
$productname=mysqli_real_escape_string($con, $_POST['oldproductname'][$i]);
$manufacturer=mysqli_real_escape_string($con, $_POST['oldmanufacturer'][$i]);
$producthsn=mysqli_real_escape_string($con, $_POST['oldproducthsn'][$i]);
$productnotes=mysqli_real_escape_string($con, $_POST['oldproductnotes'][$i]);
$productdescription=mysqli_real_escape_string($con, $_POST['oldproductdescription'][$i]);
$itemmodule=mysqli_real_escape_string($con, $_POST['olditemmodule'][$i]);
$batch=mysqli_real_escape_string($con, $_POST['oldbatch'][$i]);
$expdate=mysqli_real_escape_string($con, $_POST['oldexpdate'][$i]);
$mrp=mysqli_real_escape_string($con, $_POST['oldmrp'][$i]);
$vat=mysqli_real_escape_string($con, $_POST['oldvat'][$i]);
$quantity=mysqli_real_escape_string($con, $_POST['oldquantity'][$i]);
$unit=mysqli_real_escape_string($con, $_POST['oldproductunit'][$i]);
$productrate=mysqli_real_escape_string($con, $_POST['oldproductrate'][$i]);
$noofpacks=mysqli_real_escape_string($con, $_POST['oldnoofpacks'][$i]);
$prodiscount=mysqli_real_escape_string($con, $_POST['oldprodiscount'][$i]);
$productvalue=mysqli_real_escape_string($con, $_POST['oldproductvalue'][$i]);
$taxvalue=mysqli_real_escape_string($con, $_POST['oldtaxvalue'][$i]);
$productnetvalue=mysqli_real_escape_string($con, $_POST['oldproductnetvalue'][$i]);

if($productname!='')
{
$sql=mysqli_query($con, "delete from pairestimates where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and estimateno='$oldestimateno' and estimatedate='$oldestimatedate'");
if($sql)
{
}
else
{
echo mysqli_error($con);
}
}
}


$sql2=mysqli_query($con, "SET sql_mode = ''");
$sql2=mysqli_query($con, "select id from pairestimates where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and estimateno='$oldestimateno' and estimatedate='$oldestimatedate'");
if(mysqli_num_rows($sql2)==0)
{
for($i=0; $i<count($_POST['productname']); $i++)
{
$productid=mysqli_real_escape_string($con, $_POST['productid'][$i]);
$productname=mysqli_real_escape_string($con, $_POST['productname'][$i]);
$manufacturer=mysqli_real_escape_string($con, $_POST['manufacturer'][$i]);
$producthsn=mysqli_real_escape_string($con, $_POST['producthsn'][$i]);
$productnotes=mysqli_real_escape_string($con, $_POST['productnotes'][$i]);
$productdescription=mysqli_real_escape_string($con, $_POST['productdescription'][$i]);
$itemmodule=mysqli_real_escape_string($con, $_POST['itemmodule'][$i]);
if ((in_array('Batch', $fieldedit))) {
$batch=mysqli_real_escape_string($con, $_POST['batch'][$i]);
$expdate=mysqli_real_escape_string($con, $_POST['expdate'][$i]);
}
else{
$batch='';
$expdate='';
}
$mrp=mysqli_real_escape_string($con, $_POST['mrp'][$i]);
$vat=mysqli_real_escape_string($con, $_POST['vat'][$i]);
$quantity=mysqli_real_escape_string($con, $_POST['quantity'][$i]);
$unit=mysqli_real_escape_string($con, $_POST['productunit'][$i]);
$productrate=mysqli_real_escape_string($con, $_POST['productrate'][$i]);
$noofpacks=mysqli_real_escape_string($con, $_POST['noofpacks'][$i]);
$prodiscount=mysqli_real_escape_string($con, $_POST['prodiscount'][$i]);
$productvalue=mysqli_real_escape_string($con, $_POST['productvalue'][$i]);
$taxvalue=mysqli_real_escape_string($con, $_POST['taxvalue'][$i]);
$productnetvalue=mysqli_real_escape_string($con, $_POST['productnetvalue'][$i]);

if($productname!='')
{
$sql=mysqli_query($con, "insert into pairestimates set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', customername='$customername', customerid='$customerid', address1='$address1', address2='$address2', area='$area', city='$city', state='$state', district='$district', pincode='$pincode', saddress1='$saddress1', saddress2='$saddress2', sarea='$sarea', scity='$scity', sstate='$sstate', sdistrict='$sdistrict', spincode='$spincode', gstno='$gstno', estimateterm='$estimateterm', estimateno='$estimateno', estimatedate='$estimatedate', estimateamount='$estimateamount', duedate='$duedate', duedates='$duedates', productid='$productid', productname='$productname', manufacturer='$manufacturer', producthsn='$producthsn', productnotes='$productnotes', productdescription='$productdescription', itemmodule='$itemmodule', batch='$batch', expdate='$expdate', mrp='$mrp', vat='$vat', quantity='$quantity',unit='$unit', productrate='$productrate', noofpacks='$noofpacks', prodiscount='$prodiscount', productvalue='$productvalue',  taxvalue='$taxvalue',  productnetvalue='$productnetvalue', totalitems='$totalitems', orderdcno='$orderdcno', reference='$reference', saleperson='$saleperson', totalvatamount='$totalvatamount', totalamount='$totalamount', totalquantity='$totalquantity', discounttype='$discounttype', discount='$discount', discountamount='$discountamount', freightamount='$freightamount', roundoff='$roundoff', grandtotal='$grandtotal', preparedby='$preparedby',checkedby='$checkedby', taxtype='$taxtype', cgst25='$cgst25', sgst25='$sgst25', gst25='$gst25', cgst6='$cgst6', sgst6='$sgst6', gst6='$gst6', cgst9='$cgst9', sgst9='$sgst9', gst9='$gst9', cgst14='$cgst14', sgst14='$sgst14', gst14='$gst14', tax25='$tax25', tax6='$tax6', tax9='$tax9', tax14='$tax14', terms='$terms', notes='$notes', description='$description', fileattach='$fileattach',pos='$pos',workphone='$twoworkphone',mobile='$twomobilephone',sameasbilling='$twosameasbilling',customerinfodefault='$scriptonetwo',gstrtype='$gstrtype'");
if($sql)
{
$salesid=mysqli_insert_id($con);
}
else
{
echo mysqli_error($con);
}
}

}
$tid=mysqli_insert_id($con);
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Estimate', '{$tid}')");
if($sql)
{
 if(isset($_POST['submit1']))
{
echo '<script> window.open("estimateprint.php?estimateno='.$estimateno.'&estimatedate='.$estimatedate.'", "_blank");</script>';
echo '<script> window.location.href="estimates.php?remarks=Updated Successfully";</script>'; 
}
else
{
echo '<script> window.location.href="estimateview.php?estimateno='.$estimateno.'&estimatedate='.$estimatedate.'&remarks=Updated Successfully";</script>';
}
}
}
else
{
header("Location: estimates.php?error=Error Data");
}
if ($sql) {
$hissql=mysqli_query($con, "insert into pairusehistory set usetype='ESTIMATES', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$estimateno', useremarks='Estimate Updated' ");
}
}
$sqlismainaccessusercus=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
$infomainaccessusercus=mysqli_fetch_array($sqlismainaccessusercus);
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
<!-------------------customer add info start ------------------------------->
<!-------------------customer add info end ------------------------------->
<title>
Edit <?= $infomainaccessuser['modulename'] ?>
</title>
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6">
<?php
// sidebar
include('sidebar.php');
?>
<main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
<?php
// navbar
include('navhead.php');
?>
<div class="container-fluid py-4 bg-body">
<?php
// notifications
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
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Estimates' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
?>
 <?php
 if((isset($_GET['estimateno']))&&(isset($_GET['estimatedate'])))
 {
	 $estimateno=mysqli_real_escape_string($con, $_GET['estimateno']);
	 $estimatedate=mysqli_real_escape_string($con, $_GET['estimatedate']);
 $sql=mysqli_query($con, "select * from pairestimates where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and estimateno='$estimateno' and estimatedate='$estimatedate' order by id asc");
$count=1;
if(mysqli_num_rows($sql)>0)
{
$rows = array();
while($row = mysqli_fetch_assoc($sql)){ 
$rows[] = $row;
}
?> 
<div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<p style="font-size:20px;margin-top: -9px !important;margin-bottom: 6px !important;"><i class="fa fa-pencil"></i> Edit <?= $infomainaccessuser['modulename'] ?></p>
<?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Estimates' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
?>
<div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise</div>
<?php
}
else
{
?>
<?php
$sqligst=mysqli_query($con, "select gstno from pairgst where companymainid='$companymainid' ");
$infogst=mysqli_fetch_array($sqligst);
?>
<hr class="p-0 mb-1 mt-1">
<!----------------------------------------------- product add start ----------------------------------------->

<!------------------------------------------ pro style start ------------------------------------------>
<!------------------------------------------ productadd.css ------------------------------------------>
<!-- <link href="productadd.css" rel="stylesheet"> -->

<!------------------------------------------ pro style end ------------------------------------------>
<div class="modal fade" id="AddNewProduct" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">New Product</h5>
<span type="button" onclick="funesproduct()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">
<div class="modal-body mbsub" id="promodal">
<?php
include("productaddmodal.php");
?>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button onclick="funaddproduct()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit"  name="submitproduct" id="submitproduct" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funesproduct()">Cancel</button> </div>
</div>
</form>
</div>
</div>
</div>
<!--------------------------------------------- product add end --------------------------------------------->
<!-- customer view start -->
<div class="modal fade" id="Viewcustdetails" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">View Customer</h5>
<span type="button" onclick="funescustomerview()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-0" role="form">
<div class="modal-body mbsub">
<?php
include("customerviewmodal.php");
?>
</div>
<div class="modal-footer mfsub" style="margin: 0px 9px !important;border-top: 1px solid #b6bcc5 !important;">
</div>
</form>
</div>
</div>
</div>
<!-- customer view close -->
<!-------------------customer add info start ------------------------------->
<!-- Start AddNewCategory modal -->

<!-- </form> -->
<!-- End AddNewSubCategory modal -->
<!-- Start AddNewCustomer modal -->
<!-- customer style start  -->
<!-- customeradd -->

<link href="customeradd.css" rel="stylesheet">
<!-- gst select design -->

<!-- customer style end -->
<div class="modal fade" id="custAddNewCustomer" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content" style="border-radius: 0px;">
<div class="modal-header" style="border-radius:0px !important;">
<h5 class="modal-title" style="color:#212529;">New <?= $infomainaccessusercus['modulename'] ?></h5>
<span type="button" onclick="funescustomer()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" style="font-size: 21px;font-weight: 600;">&times;</span>
</span>
</div>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">
<div class="modal-body" id="custmodal" style="padding-bottom: 0px !important;margin-bottom: -24.5px !important;">
<!---------model begin------------------->
<?php
include("customeraddmodal.php");
?>

<!-----------model ends----------------------------->
</div>
<div class="modal-footer " style="display: block;margin-top: 24px !important;">
<div class="col">
<button onclick="funaddcustomer()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="custsubmitcustomer" id="custsubmitcustomer" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funescustomer()">Cancel</button> </div>
</div>
</form>
</div>
</div>
</div>
<!-- </form> -->
<!-- End AddNewCustomer modal -->
<!-------------------customer add info end ------------------------------->
<form id="estimateform" action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<input type="hidden" name="oldestimateno" value="<?=$rows[0]['estimateno']?>">
<input type="hidden" name="oldestimatedate" value="<?=$rows[0]['estimatedate']?>">
<input type="hidden" name="estimateterm" value="<?=$rows[0]['estimateterm']?>">

<div class="row">
        <?php
     if ((in_array('Estimate Information', $fieldedit))) {
        ?>
<div class="col-lg-4">
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingTwo" >
<button class="accordion-button font-weight-bold" type="button">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;"><?= $infomainaccessuser['modulename'] ?> Information</a>
</div>
</button>
</h5>
<div id="collapseTwo" class="accordion-collapse collapse show"
aria-labelledby="headingTwo">
<div class="accordion-body text-sm" style="background-color:#fbfafa;" id="modulegreydesign">
<div class="row">
<div class="col-lg-12">
<div class="form-group row" style="align-items: center !important;">
<div class="col-lg-5">
<label for="estimateno" class="custom-label"><span class="text-danger"><?= $infomainaccessuser['modulename'] ?> Number *</span></label>
</div>
<div class="col-lg-7">
<input type="text" class="form-control  form-control-sm" id="estimateno" name="estimateno" required  value="<?=$rows[0]['estimateno']?>" readonly>
</div>
</div>
</div>
<div class="col-lg-12">
<div class="form-group row" style="align-items: center !important;">
<div class="col-lg-5" style="padding-right:0px">
<label for="estimatedate" class="custom-label"><span class="text-danger"><?= $infomainaccessuser['modulename'] ?> Date *</span></label>
</div>
<div class="col-lg-7">
<input type="date" class="form-control  form-control-sm" id="estimatedate" name="estimatedate" required value="<?=$rows[0]['estimatedate']?>">
</div>
</div>
</div>


<div class="col-lg-12" style="display:none !important;">
<div class="form-group row" style="align-items: center !important;">
<div class="col-lg-5" style="padding-right:0px">
<label for="estimatedate" class="custom-label"><span class="text-danger"><?= $infomainaccessuser['modulename'] ?> Term *</span></label>
</div>
<div class="col-lg-7">
<select class="select2-field form-control  form-control-sm" name="estimateterm" id="estimateterm" required>
<option value="">Select</option>
<?php
$sqli = mysqli_query($con, "select term from pairterms where (createdid='$companymainid' or createdid='0') order by term asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['term'] ?>" <?=($info['term']==$rows[0]['estimateterm'])?'selected':''?>><?= $info['term'] ?></option>
<?php
}
?>
</select>

</div>
</div>
</div>

<div class="col-lg-12" style="display:none !important;">
<div class="form-group row" style="align-items: center !important;">
<div class="col-lg-5">
<label for="duedates" class="custom-label">Due Date</label>
</div>
<div class="col-lg-2 duedateselect" style="margin-top: -3px !important;" onclick="andus()">
<select class="select2-field form-control  form-control-sm" name="duedates" id="duedates" onchange="funduedates()">
<option disabled>Due Terms</option>
<?php
$sqli = mysqli_query($con, "select * from pairduedates where (createdid='$companymainid' or createdid='0') order by duedate asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['noofdays'] ?>"  <?=($rows[0]['duedates']==$info['noofdays'])?'selected':''?>><?= $info['duedate'] ?></option>
<?php
}
?>

</select>
</div>
<div class="col-lg-5 duedatepicker">
<input type="date" class="form-control  form-control-sm" id="duedate" name="duedate" value="<?=$rows[0]['duedate']?>">
</div>
<script>
function addDays(date, days) {
var result = new Date(date);
days=parseFloat(days);
result.setDate(result.getDate() + days);
return result;
}
function funduedates()
{
var duedates=$("#duedates").val();
var estimatedate=$("#estimatedate").val();
var today="";
if(duedates!='')
{
console.log(estimatedate);
console.log(duedates);
today=addDays(estimatedate, duedates);
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;
}
$("#duedate").val(today);
}
</script>
</div>
</div>
<?php
     if ((in_array('Reference', $fieldedit))) {
        ?>
<div class="col-lg-12">
<div class="form-group row" style="align-items: center !important;">
<div class="col-lg-5">
<label for="reference" class="custom-label">Reference</label>
</div>
<div class="col-lg-7">
<input type="text" class="form-control  form-control-sm" id="reference" name="reference" value="<?=$rows[0]['reference']?>">
</div>
</div>
</div>
<?php
     }
        ?>
<?php
     if ((in_array('Sale Person', $fieldedit))) {
        ?>
<div class="col-lg-12">
<div class="form-group row" style="align-items: center !important;">
<div class="col-lg-5">
<label for="saleperson" class="custom-label">Sale Person</label>
</div>
<div class="col-lg-7">
<select class="select2-field form-control  form-control-sm" name="saleperson" id="saleperson">
<option selected disabled>Select</option>
<?php
$sqli = mysqli_query($con, "select saleperson from pairsaleperson where (createdid='$companymainid' or createdid='0') order by saleperson asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['saleperson'] ?>" <?=($rows[0]['saleperson']==$info['saleperson'])?'selected':''?>><?= $info['saleperson'] ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
<?php
     }
        ?>
<div class="col-lg-12" <?=((in_array('Prepared By', $fieldedit))?'':'style="display:none;"')?>>
<div class="form-group row" style="align-items: center !important;">
<div class="col-lg-5">
<label for="preparedby" class="custom-label">Prepared By</label>
</div>
<div class="col-lg-7">
<input type="text" class="form-control  form-control-sm" id="preparedby" name="preparedby" value="<?=$rows[0]['preparedby']?>">
</div>
</div>
</div>
<div class="col-lg-12" <?=((in_array('Checked By', $fieldedit))?'':'style="display:none;"')?>>
<div class="form-group row" style="align-items: center !important;">
<div class="col-lg-5">
<label for="checkedby" class="custom-label">Checked By</label>
</div>
<div class="col-lg-7">
<input type="text" class="form-control  form-control-sm" id="checkedby" name="checkedby" value="<?=$rows[0]['checkedby']?>">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
     }
        ?>
<input type="hidden" id="custoriginpage">
<input type="hidden" id="prooriginpage">
        <?php
     if ((in_array('Customer Information', $fieldedit))) {
        ?>
<div class="col-lg-8">
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingOne" >
<button class="accordion-button font-weight-bold" type="button" id="customerinfotoggler">
<div class="row" style="width:100% !important;">
<div class="col-lg-6" id="customerinfofirst">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;"><?= $infomainaccessusercus['modulename'] ?> Information</a>
<input type="hidden" id="propos">
<input type="hidden" id="proposfinal">
</div>
</div>
<div class="col-lg-6" id="customerinfosecond" style="margin-bottom: 4px !important;">
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Estimates' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['estimatecustinfo']=='defone')||($infomainaccessuser['estimatecustinfo']=='deftwo')) {
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="customerinfodefault" id="onecustomerinfo" value="one" <?= ($rows[0]['customerinfodefault']=='one'||$infomainaccessuser['estimatecustinfo']=='defone')?'checked':'' ?> onclick="onetwo()">
<label class="custom-control-label custom-label" for="onecustomerinfo">B2B</label>
</div>
</div>
<div class="col-lg-2 col-md-2 col-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="customerinfodefault" id="twocustomerinfo" value="two" <?= ($rows[0]['customerinfodefault']=='two'||$infomainaccessuser['estimatecustinfo']=='deftwo')?'checked':'' ?> onclick="onetwo()">
<label class="custom-control-label custom-label" for="twocustomerinfo">B2C</label>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
let one = document.getElementById("onecustomerinfo");
let two = document.getElementById("twocustomerinfo");
if (one.checked==true) {
$("#one").show();
$("#two").hide();
$("#customer").attr("required","required");
<?php
if ($access['estbtwocnamerequired']=='Yes') {
?>
$("#twocustomername").removeAttr("required");
<?php
}
if ($access['estbtwocwphonerequired']=='Yes') {
?>
$("#twoworkphone").removeAttr("required");
<?php
}
?>
$("#twopos").removeAttr("required");
let proposfinal = $("#proposfinal").val();
$("#propos").val(proposfinal);
    // productcalc(1);
}
else if (two.checked==true) {
var gstintype = document.getElementById("twogsttreatment").value;
if (gstintype == '') {
document.getElementById('twogstinblock').style.display = 'none';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").removeAttr("required");
}
else if (gstintype == 'Registered Business - Regular') {
document.getElementById('twogstinblock').style.display = 'block';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'Registered Business - Composition') {
document.getElementById('twogstinblock').style.display = 'block';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'Unregistered Business') {
document.getElementById('twogstinblock').style.display = 'none';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").removeAttr("required");
}
else if (gstintype == 'Consumer') {
document.getElementById('twogstinblock').style.display = 'none';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").removeAttr("required");
}
else if (gstintype == 'Overseas') {
document.getElementById('twoposblock').style.display = 'none';
document.getElementById('twogstinblock').style.display = 'none';
$("#twopos").removeAttr("required");
$("#twopos").val("");
$("#twogstin").removeAttr("required");
}
else if (gstintype == 'Special Economic Zone') {
document.getElementById('twoposblock').style.display = 'block';
document.getElementById('twogstinblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'Deemed Export') {
document.getElementById('twoposblock').style.display = 'block';
document.getElementById('twogstinblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'Tax Deductor') {
document.getElementById('twoposblock').style.display = 'block';
document.getElementById('twogstinblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'SEZ Developer') {
document.getElementById('twoposblock').style.display = 'block';
document.getElementById('twogstinblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
$("#two").show();
$("#one").hide();
<?php
if ($access['estbtwocnamerequired']=='Yes') {
?>
$("#twocustomername").attr("required","required");
<?php
}
if ($access['estbtwocwphonerequired']=='Yes') {
?>
$("#twoworkphone").attr("required","required");
<?php
}
?>
$("#twopos").attr("required","required");
$("#customer").removeAttr("required");
let propos = $("#twopos").val();
$("#propos").val(propos);
    // productcalc(1);
}
});
function onetwo() {
let one = document.getElementById("onecustomerinfo");
let two = document.getElementById("twocustomerinfo");
if (one.checked==true) {
$("#one").show();
$("#two").hide();
$("#customer").attr("required","required");
<?php
if ($access['estbtwocnamerequired']=='Yes') {
?>
$("#twocustomername").removeAttr("required");
<?php
}
if ($access['estbtwocwphonerequired']=='Yes') {
?>
$("#twoworkphone").removeAttr("required");
<?php
}
?>
$("#twopos").removeAttr("required");
let proposfinal = $("#proposfinal").val();
$("#propos").val(proposfinal);
    // productcalc(1);
}
else if (two.checked==true) {
var gstintype = document.getElementById("twogsttreatment").value;
if (gstintype == '') {
document.getElementById('twogstinblock').style.display = 'none';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").removeAttr("required");
}
else if (gstintype == 'Registered Business - Regular') {
document.getElementById('twogstinblock').style.display = 'block';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'Registered Business - Composition') {
document.getElementById('twogstinblock').style.display = 'block';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'Unregistered Business') {
document.getElementById('twogstinblock').style.display = 'none';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").removeAttr("required");
}
else if (gstintype == 'Consumer') {
document.getElementById('twogstinblock').style.display = 'none';
document.getElementById('twoposblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").removeAttr("required");
}
else if (gstintype == 'Overseas') {
document.getElementById('twoposblock').style.display = 'none';
document.getElementById('twogstinblock').style.display = 'none';
$("#twopos").removeAttr("required");
$("#twopos").val("");
$("#twogstin").removeAttr("required");
}
else if (gstintype == 'Special Economic Zone') {
document.getElementById('twoposblock').style.display = 'block';
document.getElementById('twogstinblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'Deemed Export') {
document.getElementById('twoposblock').style.display = 'block';
document.getElementById('twogstinblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'Tax Deductor') {
document.getElementById('twoposblock').style.display = 'block';
document.getElementById('twogstinblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
else if (gstintype == 'SEZ Developer') {
document.getElementById('twoposblock').style.display = 'block';
document.getElementById('twogstinblock').style.display = 'block';
$("#twopos").attr("required","required");
$("#twogstin").attr("required","required");
}
$("#two").show();
$("#one").hide();
<?php
if ($access['estbtwocnamerequired']=='Yes') {
?>
$("#twocustomername").attr("required","required");
<?php
}
if ($access['estbtwocwphonerequired']=='Yes') {
?>
$("#twoworkphone").attr("required","required");
<?php
}
?>
$("#twopos").attr("required","required");
$("#customer").removeAttr("required");
let propos = $("#twopos").val();
$("#propos").val(propos);
    // productcalc(1);
}
}
</script>
<?php
}
?>
</div>
</div>
</button>
</h5>
<div id="collapseOne" class="accordion-collapse collapse show"
aria-labelledby="headingOne" style="padding-left:7px !important;padding-right: 7px !important;">
<div class="accordion-body text-sm" style="padding-bottom: 0px;padding-top: 3px">
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Estimates' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if ($infomainaccessuser['estimatecustinfo']=='one'||(($infomainaccessuser['estimatecustinfo']=='defone')||($infomainaccessuser['estimatecustinfo']=='deftwo'))) {
?>
<div id="one">
<div class="row">
<div class="col-lg-12">
<div class="form-group row" style="align-items: center !important;">
<input type="hidden" name="customerid" id="customerid" value="<?=$rows[0]['customerid']?>">
<div class="col-sm-3">
<label for="customername" class="custom-label"><span class="text-danger"><?= $infomainaccessusercus['modulename'] ?> Name *</span></label>
</div>
<div class="col-sm-9" onclick="andus()">
<select class="form-control  form-control-sm" name="customer" id="customer" required>
<option value="" data-foo="" data-receivable="" selected disabled>Select</option>
<?php
$sqli = mysqli_query($con, "SELECT id, customername, city, mobile, workphone From paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' and (createdid='$companymainid' and moduletype='Customers') order by customername asc");
while ($info = mysqli_fetch_array($sqli))
{
$sqliestimate=mysqli_query($con, "select estimateamount, estimatedate, estimateno from pairestimates where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='".$info['id']."' GROUP BY estimatedate, estimateno order by estimatedate desc, estimateno desc");
$estimateamount=0;
$balanceamount=0;
$currentamount=0;
$overdueamount=0;
while($infoestimate=mysqli_fetch_array($sqliestimate))
{
$estimateamount+=(float)$infoestimate['estimateamount'];
$paidamount=0;
$sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$infoestimate['estimateno']."' and invoicedate='".$infoestimate['estimatedate']."' and customerid='".$info['id']."' order by id desc");
while($infosalespay=mysqli_fetch_array($sqlsalespay))
{
$paidamount+=(float)$infosalespay['amount'];
}
$balanceamount+=((float)$infoestimate['estimateamount']-$paidamount);
$diff = abs(time() - strtotime($infoestimate['estimatedate']));
$days = floor(($diff)/ (60*60*24));
if($days>30)
{
$overdueamount+=((float)$infoestimate['estimateamount']-$paidamount);
}
else
{
$currentamount+=((float)$infoestimate['estimateamount']-$paidamount);
}
}
?>
<option value="<?=$info['id']?>" data-foo="<?=$info['workphone']?>" data-receivable="<?php echo $rescurrency[0]; ?> <?=number_format((float)$balanceamount, 2, ".", "")?>" <?=($rows[0]['customerid']==$info['id'])?'selected':''?>><?=$info['customername']?></option>
<?php
}
?>
</select>
<!----------->
<input type="text" class="form-control  form-control-sm" id="customername" name="customername" placeholder="<?= $infomainaccessusercus['modulename'] ?> Name" style="display:none" value="<?=$rows[0]['customername']?>">
<!----------->
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-3">
</div>
<div class="col-lg-9">
<div class="row mb-0" id="custaddressdiv" style="background-color:#fbfafa; color:#777777; display:none;margin: 0px !important;">
<div class="col-lg-12 mb-0 mt-0" style="padding-left: 3px !important;">
<div id="ember529" class="info-item cursor-pointer ember-view" style="margin-top:-3px !important;">
<span class="text-blue" data-bs-toggle="modal" data-bs-target="#Viewcustdetails">
<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon align-text-bottom">
<path d="M394.8 422h-90c-11 0-20-9-20-20s9-20 20-20h90c11 0 20 9 20 20s-9 20-20 20zm97-145h-187c-11 0-20-9-20-20s9-20 20-20h187c11 0 20 9 20 20s-9 20-20 20zm0-145h-187c-11 0-20-9-20-20s9-20 20-20h187c11 0 20 9 20 20s-9 20-20 20zM227.2 422c-11 0-20-9-20-20v-37.3c0-22.2-22.3-40.3-49.8-40.3H89.8c-27.4 0-49.8 18.1-49.8 40.3V402c0 11-9 20-20 20s-20-9-20-20v-37.3c0-44.3 40.3-80.3 89.8-80.3h67.6c49.5 0 89.8 36 89.8 80.3V402c0 11-8.9 20-20 20zM123.6 244.8C80.8 244.8 46 210 46 167.2s34.8-77.6 77.6-77.6 77.6 34.8 77.6 77.6-34.8 77.6-77.6 77.6zm0-115.1c-20.7 0-37.6 16.9-37.6 37.6 0 20.7 16.8 37.6 37.6 37.6s37.6-16.9 37.6-37.6c0-20.8-16.8-37.6-37.6-37.6z"></path>
</svg>&nbsp; View <?= $infomainaccessusercus['modulename'] ?> Details </span>
<!---->
<div id="ember530" class="ember-view">
<div id="ember531" class="ember-view"></div>
</div>
</div>
</div>
<div class="col-lg-6" style="padding-left: 3px !important;font-size: 13px !important;<?=(in_array('Billing Address', $fieldedit))?'':'display:none;'?>">
<div id="ember532" class="popovercontainer address-group ember-view">
<span class="font-small" style="color:#777777;"> BILLING ADDRESS&nbsp;&nbsp;&nbsp;
<input type="hidden" name="pos" id="pos" value="<?=$rows[0]['pos']?>" >
<input type="hidden" name="address1" id="address1" value="<?=$rows[0]['address1']?>">
<input type="hidden" name="address2" id="address2" value="<?=$rows[0]['address2']?>">
<input type="hidden" name="area" id="area" value="<?=$rows[0]['area']?>">
<input type="hidden" name="city" id="city" value="<?=$rows[0]['city']?>">
<input type="hidden" name="state" id="state" value="<?=$rows[0]['state']?>">
<input type="hidden" name="pincode" id="pincode" value="<?=$rows[0]['pincode']?>">
<input type="hidden" name="district" id="district" value="<?=$rows[0]['district']?>">
<span id="billingaddressspan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#billingaddressmodel" style="font-size:13px !important;">Change</span>
<address id="billingaddressdiv" class="font-small ember-view" style="color:green;margin-bottom: 1px !important;">
<?=$rows[0]['area']?> <?=$rows[0]['city']?><br> <?=$rows[0]['state']?> <?=$rows[0]['pincode']?>  <?=$rows[0]['district']?>
</address>
</div>
</div>
<!-- Billing Modal -->
<div class="modal fade" id="billingaddressmodel" tabindex="-1" role="dialog" aria-labelledby="billingaddressmodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="billingaddressmodelLabel">Billing Address</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-12">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstreet" id="billstreet"  placeholder="Street">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcity" id="billcity" placeholder="City/Town">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-12">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstate" id="billstate" placeholder="State">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="billpincode" id="billpincode" min="0" placeholder="Pin">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcountry" id="billcountry" placeholder="Country/Region">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer" style="margin-bottom: -9px !important;margin-top: 34.5px !important;">
<button   onclick="funbillingaddress()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitbilling" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<script>
function funbillingaddress()
{
var billstreet=document.getElementById("billstreet").value;
var billcity=document.getElementById("billcity").value;
var billstate=document.getElementById("billstate").value;
var billpincode=document.getElementById("billpincode").value;
var billcountry=document.getElementById("billcountry").value;
document.getElementById("area").value=billstreet;
document.getElementById("city").value=billcity;
document.getElementById("district").value=billcountry;
document.getElementById("state").value=billstate;
document.getElementById("pincode").value=billpincode;
var ase=billstreet+' '+billcity+' '+billstate+' '+billpincode+' '+billcountry+'';
ase=ase.trim();
if(ase=="")
{
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
}
else
{
ase='<div id="firstadd">'+billstreet+' '+billcity+'</div> <div id="secadd">'+billstate+' '+billpincode+' '+billcountry+'</div>';
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:12px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
document.getElementById("billingaddressmodel").classList.remove("show");
document.getElementById("billingaddressmodel").style.display="none";
document.getElementById("billingaddressmodel").removeAttribute("aria-modal");
document.getElementById("billingaddressmodel").removeAttribute("role");
document.getElementById("billingaddressmodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>
<div class="col-lg-6" style="padding-left: 3px !important;font-size: 13px !important;<?=(in_array('Shipping Address', $fieldedit))?'':'display:none;'?>">
<div id="ember532" class="popovercontainer address-group ember-view">
<span class="font-small" style="color:#777777;"> SHIPPING ADDRESS&nbsp;&nbsp;&nbsp;
<input type="hidden" name="saddress1" id="saddress1" value="<?=$rows[0]['saddress1']?>">
<input type="hidden" name="saddress2" id="saddress2" value="<?=$rows[0]['saddress2']?>">
<input type="hidden" name="sarea" id="sarea" value="<?=$rows[0]['sarea']?>">
<input type="hidden" name="scity" id="scity" value="<?=$rows[0]['scity']?>">
<input type="hidden" name="sstate" id="sstate" value="<?=$rows[0]['sstate']?>">
<input type="hidden" name="spincode" id="spincode" value="<?=$rows[0]['spincode']?>">
<input type="hidden" name="sdistrict" id="sdistrict" value="<?=$rows[0]['sdistrict']?>">
<span id="shippingaddressspan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#shippingaddressmodel" style="font-size:13px !important;">Change</span>
<address id="shippingaddressdiv" class="font-small ember-view" style="color:green;margin-bottom: 1px !important;">
<?=$rows[0]['sarea']?> <?=$rows[0]['scity']?> <br> <?=$rows[0]['sstate']?> <?=$rows[0]['spincode']?> <?=$rows[0]['sdistrict']?>
</address>
</div>
</div>
<!-- Shipping Modal -->
<div class="modal fade" id="shippingaddressmodel" tabindex="-1" role="dialog" aria-labelledby="shippingaddressmodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="shippingaddressmodelLabel">Shipping Address</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="height:120px">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-12">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstreet" id="shipstreet"  placeholder="Street">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcity" id="shipcity" placeholder="City/Town">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-12">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstate" id="shipstate" placeholder="State">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="shippincode" id="shippincode" min="0" placeholder="Pin">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcountry" id="shipcountry" placeholder="Country/Region">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button   onclick="funshippingaddress()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitshipping" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<script>
function funshippingaddress()
{
var shipstreet=document.getElementById("shipstreet").value;
var shipcity=document.getElementById("shipcity").value;
var shipstate=document.getElementById("shipstate").value;
var shippincode=document.getElementById("shippincode").value;
var shipcountry=document.getElementById("shipcountry").value;
document.getElementById("sarea").value=shipstreet;
document.getElementById("scity").value=shipcity;
document.getElementById("sdistrict").value=shipcountry;
document.getElementById("sstate").value=shipstate;
document.getElementById("spincode").value=shippincode;
var ase=shipstreet+' '+shipcity+' '+shipstate+' '+shippincode+' '+shipcountry+'';
ase=ase.trim();
if(ase=="")
{
$("#shippingaddressdiv").html(ase);
$("#shippingaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
}
else
{
ase='<div id="firstadd">'+shipstreet+' '+shipcity+'</div> <div id="secadd">'+shipstate+' '+shippincode+' '+shipcountry+'</div>';
$("#shippingaddressdiv").html(ase);
$("#shippingaddressspan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:12px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
document.getElementById("shippingaddressmodel").classList.remove("show");
document.getElementById("shippingaddressmodel").style.display="none";
document.getElementById("shippingaddressmodel").removeAttribute("aria-modal");
document.getElementById("shippingaddressmodel").removeAttribute("role");
document.getElementById("shippingaddressmodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>
<div class="col-lg-6" style="padding-left: 3px !important;<?=(in_array('Work Phone', $fieldedit))?'':'display:none;'?>">
<input type="hidden" name="mobile" id="mobile" >
<input type="hidden" name="workphone" id="workphone" >
<span class="font-small" style="color:#777777;font-size: 12px !important">WORK PHONE&nbsp;&nbsp;&nbsp;</span>
<span id="worktypespan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#workphonemodel" style="font-size:12px !important;">Change</span>
<div id="workphonediv" style="color:green;margin-bottom: 1px !important;"></div>
</div>
<!-- GSTping Modal -->
<div class="modal fade" id="workphonemodel" tabindex="-1" role="dialog" aria-labelledby="workphonemodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="workphonemodelLabel">WORK PHONE</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="height:110px">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-4">
<label for="workphone" class="custom-label workphone" data-toggle="tooltip" title="Work Phone" data-placement="top">Work Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="workworkphone" name="workworkphone" placeholder="Work Phone">
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button   onclick="funworkphone()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitwork" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<div class="col-lg-6" style="padding-left: 3px !important;<?=(in_array('Mobile Phone', $fieldedit))?'':'display:none;'?>">
<input type="hidden" name="mobile" id="mobile" >
<input type="hidden" name="mobilephone" id="mobilephone" >
<span class="font-small" style="color:#777777;font-size: 12px !important">MOBILE PHONE&nbsp;&nbsp;&nbsp;</span>
<span id="mobiletypespan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#mobilephonemodel" style="font-size:12px !important;">Change</span>
<div id="mobilephonediv" style="color:green;margin-bottom: 1px !important;"></div>
</div>
<div class="col-lg-6" style="padding-left: 3px !important;margin-top: 0px ;<?=(in_array('GSTIN', $fieldedit))?'':'display:none;'?>" id="mphonemob">
<input type="hidden" name="gstno" id="gstno" >
<input type="hidden" name="gstrtype" id="gstrtype" >
<span class="font-small" style="color:#777777;font-size: 12px !important">GST TREATMENT&nbsp;&nbsp;&nbsp;</span>
<span id="gsttypespan" class="text-blue font-xxs cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#gstrtypemodel" style="font-size:12px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer">
<path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z">
</path>
</svg>
</span>
<div id="gstrtypediv" style="color:green;margin-bottom: 1px !important;">Registered Business - Regular</div>
</div>
<!-- GSTping Modal -->
<div class="modal fade" id="mobilephonemodel" tabindex="-1" role="dialog" aria-labelledby="mobilephonemodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="mobilephonemodelLabel">MOBILE PHONE</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="height:110px">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-4">
<label for="mobile" class="custom-label mobile" data-toggle="tooltip" title="Mobile Phone" data-placement="top">Mobile Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="workmobile" name="workmobile" placeholder="Mobile Phone">
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button   onclick="funmobilephone()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitmobile" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<script>
function funworkphone()
{
var workworkphone=document.getElementById("workworkphone").value;
// var workmobile=document.getElementById("workmobile").value;
document.getElementById("workphone").value=workworkphone;
// document.getElementById("mobile").value=workmobile;
var ase=workworkphone+' ';
ase=ase.trim();
if(ase=="")
{
$("#workphonediv").html(ase);
$("#worktypespan").html('<div style="margin-top:-4.5px !important;"> Add New Phone </div>');
}
else
{
ase='<div id="workphoneline">'+workworkphone+'</div>';
$("#workphonediv").html(ase);
$("#worktypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
document.getElementById("workphonemodel").classList.remove("show");
document.getElementById("workphonemodel").style.display="none";
document.getElementById("workphonemodel").removeAttribute("aria-modal");
document.getElementById("workphonemodel").removeAttribute("role");
document.getElementById("workphonemodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>
<script>
function funmobilephone()
{
// var workworkphone=document.getElementById("workworkphone").value;
var mobile=document.getElementById("workmobile").value;
// document.getElementById("workphone").value=workworkphone;
document.getElementById("mobile").value=mobile;
var ase=mobile+'';
ase=ase.trim();
if(ase=="")
{
$("#mobilephonediv").html(ase);
$("#mobiletypespan").html('<div style="margin-top:-4.5px !important;"> Add New Phone </div>');
}
else
{
ase='<div id="mobilephoneline">'+mobile+'</div>';
$("#mobilephonediv").html(ase);
$("#mobiletypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
document.getElementById("mobilephonemodel").classList.remove("show");
document.getElementById("mobilephonemodel").style.display="none";
document.getElementById("mobilephonemodel").removeAttribute("aria-modal");
document.getElementById("mobilephonemodel").removeAttribute("role");
document.getElementById("mobilephonemodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>
<!-- GSTping Modal -->
<div class="modal fade" id="gstrtypemodel" tabindex="-1" role="dialog" aria-labelledby="gstrtypemodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="gstrtypemodelLabel">GST TREATMENT</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="height:180px">
<div class="row justify-content-center">
<div class="col-sm-12">
<div class="form-group row">
<div class="col-sm-12 mb-2">
<label class="form-check-label" for="gstinlineRadio3">GST Registration Type</label>
</div>
<div class="col-sm-12">
<select class="selectpicker form-control select2" data-live-search="true" title="Search title or description..." onchange="showDivcust(this)" id="gstgstrtype" name="gstgstrtype">
<option selected disabled value="" data-foo="Select Type of Add">Select Type of Add</option>
<option data-foo="Business that is registered under GST" value="Registered Business - Regular">Registered Business - Regular</option>
<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition">Registered Business - Composition</option>
<option data-foo="Business that has not been registered under GST" value="Unregistered Business">Unregistered Business</option>
<option data-foo="A gstomer who is a regular consumer" value="Consumer">Consumer</option>
<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas">Overseas</option>
<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone">Special Economic Zone</option>
<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export">Deemed Export</option>
<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor">Tax Deductor</option>
<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer">SEZ Developer</option>
</select>
</div>
</div>
</div>
</div>
<div id="custgstinblock">
<div class="row justify-content-center">
<div class="col-sm-12">
<div class="form-group row">
<div class="col-sm-12 mb-2">
<label class="form-check-label text-danger" for="gstgstin">GSTIN / UIN *</label>
</div>
<div class="col-sm-12">
<input type="text" name="gstgstin" placeholder="GSTIN / UIN" id="gstgstin" class="form-control form-control-sm">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button   onclick="fungstrtype()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitgst" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<script>
function fungstrtype()
{
var custcustgsttype = document.getElementById("gstgstrtype");
var custcustgsttypeans = custcustgsttype.options[custcustgsttype.selectedIndex].text;
var custcustgstin = document.getElementById("gstgstin");
if(custcustgsttypeans=="Select Type of Add"||((custcustgsttypeans=="Registered Business - Regular"||custcustgsttypeans=="Registered Business - Composition"||custcustgsttypeans=="Special Economic Zone"||custcustgsttypeans=="Deemed Export"||custcustgsttypeans=="Tax Deductor"||custcustgsttypeans=="SEZ Developer")&&custcustgstin.value==''))
{
if (custcustgsttypeans=="Select Type of Add") {custcustgsttype.focus();alert("Please Select the GST Type");}
else if ((custcustgsttypeans=="Registered Business - Regular"||custcustgsttypeans=="Registered Business - Composition"||custcustgsttypeans=="Special Economic Zone"||custcustgsttypeans=="Deemed Export"||custcustgsttypeans=="Tax Deductor"||custcustgsttypeans=="SEZ Developer")&&custcustgstin.value=='') {custcustgstin.focus();alert("Please Enter the GST IN Value");}
return false;
}
else
{
if(custcustgsttypeans=="Registered Business - Regular"||custcustgsttypeans=="Registered Business - Composition"||custcustgsttypeans=="Special Economic Zone"||custcustgsttypeans=="Deemed Export"||custcustgsttypeans=="Tax Deductor"||custcustgsttypeans=="SEZ Developer")
{
ase='<div id="gstfirstline">'+custcustgsttypeans+'</div> <div id="gstsecondline">'+'GSTIN:'+custcustgstin.value+'</div>';
}
else{
ase='<div id="gstfirstline">'+custcustgsttypeans+'</div>';
}
$("#gstrtypediv").html(ase);
$("#gsttypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
document.getElementById("gstrtypemodel").classList.remove("show");
document.getElementById("gstrtypemodel").style.display="none";
document.getElementById("gstrtypemodel").removeAttribute("aria-modal");
document.getElementById("gstrtypemodel").removeAttribute("role");
document.getElementById("gstrtypemodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>
</div>
</div>
</div>
</div>
<?php
}
if ($infomainaccessuser['estimatecustinfo']=='two'||(($infomainaccessuser['estimatecustinfo']=='defone')||($infomainaccessuser['estimatecustinfo']=='deftwo'))) {
?>
<script type="text/javascript">
function twoposans() {
    $("#propos").val($("#twopos").val());
let id = 1;
productcalc(id);
id++;
}
</script>
<div id="two">
<div class="row">
<div class="col-lg-3">
<label for="customername" class="custom-label">
<?= ($access['estbtwocnamerequired']=='Yes')? '<span class="text-danger">'. $infomainaccessusercus['modulename'] . ' Name * </span>': $infomainaccessusercus['modulename'] . ' Name ' ?>
</label>
</div>
<div class="col-lg-9">
<input type="text" name="twocustomername" id="twocustomername" class="form-control form-control-sm" placeholder="<?= $infomainaccessusercus['modulename'] ?> Name" value="<?= $rows[0]['customername'] ?>" <?= ($access['estbtwocnamerequired']=='Yes')? 'required': ' ' ?>>
<input type="hidden" name="oldcustomername" value="<?=$rows[0]['customerid']?>">
</div>
</div>
<div class="row mt-1">
<div class="col-lg-12">
<div class="row mb-0" id="custaddressdiv" style="background-color:#fbfafa; color:#777777; display:block;margin: 0px !important;padding: 9px 9px 0px 9px !important;">
<div class="col-lg-12 mb-0 mt-0" style="padding-left: 3px !important;">
<div id="ember529" class="info-item cursor-pointer ember-view" style="margin-top:-3px !important;">
<!---->
<div id="ember530" class="ember-view">
<div id="ember531" class="ember-view"></div>
</div>
</div>
</div>
<div class="row" style="padding:0px !important;margin: 0px !important;">
<div class="col-lg-6" <?=(in_array('Billing Address', $fieldedit))?'':'style="display:none;"'?>>
<label for="twobilling" class="custom-label" style="margin:0px !important;font-size: 13px !important;color: #777777;">BILLING ADDRESS</label>
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-12">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twobillstreet" id="twobillstreet"  placeholder="Street" value="<?=$rows[0]['area']?>" oninput="twobillstreetoip(this)">
<script type="text/javascript">
function twobillstreetoip(xstreet) {
twobillstreetans = xstreet.value;
twobillstreetlen = twobillstreetans.length;
let twoshoworhide = document.getElementById('twosameasbilling');
if (twoshoworhide.checked==true) {
if (twobillstreetlen>=0) {twoshipstreet.value=twobillstreetans;}
}
}
function twobillcityoip(xcity) {
twobillcityans = xcity.value;
twobillcitylen = twobillcityans.length;
let twoshoworhide = document.getElementById('twosameasbilling');
if (twoshoworhide.checked==true) {
if (twobillcitylen>=0) {twoshipcity.value=twobillcityans;}
}
}
function twobillstateoip(xstate) {
twobillstateans = xstate.value;
twobillstatelen = twobillstateans.length;
let twoshoworhide = document.getElementById('twosameasbilling');
if (twoshoworhide.checked==true) {
if (twobillstatelen>=0) {twoshipstate.value=twobillstateans;}
}
}
function twobillpincodeiop(xpin) {
twobillpinans = xpin.value;
twobillpinlen = twobillpinans.length;
let twoshoworhide = document.getElementById('twosameasbilling');
if (twoshoworhide.checked==true) {
if (twobillpinlen>=0) {twoshippincode.value=twobillpinans;}
}
}
function twobillcountryiop(xcountry) {
twobillcountryans = xcountry.value;
twobillcountrylen = twobillcountryans.length;
let twoshoworhide = document.getElementById('twosameasbilling');
if (twoshoworhide.checked==true) {
if (twobillcountrylen>=0) {twoshipcountry.value=twobillcountryans;}
}
}
</script>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twobillcity" id="twobillcity" placeholder="City/Town" value="<?=$rows[0]['city']?>" oninput="twobillcityoip(this)">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-12">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twobillstate" id="twobillstate" placeholder="State" value="<?=$rows[0]['state']?>" oninput="twobillstateoip(this)">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="twobillpincode" id="twobillpincode" min="0" placeholder="Pin" value="<?=$rows[0]['pincode']?>" oninput="twobillpincodeiop(this)">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twobillcountry" id="twobillcountry" placeholder="Country/Region" value="<?=$rows[0]['district']?>" oninput="twobillcountryiop(this)">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-6" <?=(in_array('Shipping Address', $fieldedit))?'':'style="display:none;"'?>>
<div class="row">
<div class="col-lg-6">
<label for="twoshipping" class="custom-label" style="width:max-content !important;margin: 0px !important;font-size: 13px !important;color: #777777;">SHIPPING ADDRESS</label>
</div>
<div class="col-lg-6">
<div class="custom-control custom-checkbox" onclick="twosameasbillingticaccess()" style="min-height: 19.5px !important;">
<input type="checkbox" class="custom-control-input" name="twosameasbilling" id="twosameasbilling" <?=($rows[0]['sameasbilling']=='1')?'checked':''?>>
<label class="custom-control-label custom-label" for="twosameasbilling" style="width:max-content !important;font-size: 11px !important;margin: 0px !important;color: #777777;"> Same as Billing Address</label>
</div>
</div>
</div>
<script type="text/javascript">
function twosameasbillingticaccess() {
let twoshoworhide = document.getElementById('twosameasbilling');
let twoshipstreet = document.getElementById('twoshipstreet');
let twoshipcity = document.getElementById('twoshipcity');
let twoshipstate = document.getElementById('twoshipstate');
let twoshippincode = document.getElementById('twoshippincode');
let twoshipcountry = document.getElementById('twoshipcountry');
if (twoshoworhide.checked==true) {
twoshipstreet.setAttribute("readonly","readonly");
twoshipcity.setAttribute("readonly","readonly");
twoshipstate.setAttribute("readonly","readonly");
twoshippincode.setAttribute("readonly","readonly");
twoshipcountry.setAttribute("readonly","readonly");
}
else{
twoshipstreet.removeAttribute("readonly");
twoshipcity.removeAttribute("readonly");
twoshipstate.removeAttribute("readonly");
twoshippincode.removeAttribute("readonly");
twoshipcountry.removeAttribute("readonly");
}
}
$(document).ready(function() {
let twoshoworhide = document.getElementById('twosameasbilling');
if (twoshoworhide.checked==true) {
twoshipstreet.setAttribute("readonly","readonly");
twoshipcity.setAttribute("readonly","readonly");
twoshipstate.setAttribute("readonly","readonly");
twoshippincode.setAttribute("readonly","readonly");
twoshipcountry.setAttribute("readonly","readonly");
}
else{
twoshipstreet.removeAttribute("readonly");
twoshipcity.removeAttribute("readonly");
twoshipstate.removeAttribute("readonly");
twoshippincode.removeAttribute("readonly");
twoshipcountry.removeAttribute("readonly");
}
});
</script>
<div id="twototalshipadd">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-12">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twoshipstreet" id="twoshipstreet"  placeholder="Street" value="<?=$rows[0]['sarea']?>">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twoshipcity" id="twoshipcity" placeholder="City/Town" value="<?=$rows[0]['scity']?>">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-12">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twoshipstate" id="twoshipstate" placeholder="State" value="<?=$rows[0]['sstate']?>">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="twoshippincode" id="twoshippincode" min="0" placeholder="Pin" value="<?=$rows[0]['spincode']?>">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twoshipcountry" id="twoshipcountry" placeholder="Country/Region" value="<?=$rows[0]['sdistrict']?>">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="padding:0px !important;margin: 0px !important;">
<div class="col-lg-6" <?=(in_array('Work Phone', $fieldedit))?'':'style="display:none;"'?>>
<label for="twoworkphone" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
<?= ($access['estbtwocwphonerequired']=='Yes')? '<span class="text-danger"> WORK PHONE * </span>': ' WORK PHONE ' ?>
</label>
<input type="text" class="form-control form-control-sm" id="twoworkphone" name="twoworkphone" placeholder="Work Phone" value="<?=$rows[0]['workphone']?>" <?= ($access['estbtwocwphonerequired']=='Yes')? 'required': ' ' ?>>
<input type="hidden" name="oldtwoworkphone" value="<?=$rows[0]['workphone']?>">
</div>
<div class="col-lg-6" <?=(in_array('Mobile Phone', $fieldedit))?'':'style="display:none;"'?>>
<label for="twomobilephone" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">MOBILE PHONE</label>
<input type="text" class="form-control form-control-sm" id="twomobilephone" name="twomobilephone" placeholder="Mobile Phone" value="<?=$rows[0]['mobile']?>">
</div>
</div>
<div class="row" style="padding:9px 0px !important;margin: 0px !important;">
<div class="col-lg-8" <?=(in_array('GSTIN', $fieldedit))?'':'style="display:none;"'?>>
<div class="row">
<div class="col-lg-6">
<label for="twogsttreatment" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">GST TREATMENT</label>
<input type="text" class="form-control form-control-sm" id="twogsttreatment" name="twogsttreatment" placeholder="GST TREATMENT" value="<?=$rows[0]['gstrtype']?>" readonly>
</div>
<div class="col-lg-6" id="twogstinblock">
<label for="twogstin" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">GSTIN</label>
<input type="text" class="form-control form-control-sm" id="twogstin" name="twogstin" placeholder="GSTIN" value="<?=$rows[0]['gstno']?>">
</div>
</div>
</div>
<div class="col-lg-4" <?=(in_array('Place of Supply', $fieldedit))?'':'style="display:none;"'?>>
<div class="row">
<div class="col-lg-12" id="twoposblock">
<label for="twomobilephone" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;"><span class="text-danger">PLACE OF SUPPLY *</span></label>
<select name="twopos" id="twopos" class="select5 form-control form-control-sm" required onchange="twoposans()">
<option value="JAMMU AND KASHMIR (1)" <?=($rows[0]['pos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($rows[0]['pos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($rows[0]['pos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($rows[0]['pos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($rows[0]['pos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($rows[0]['pos']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($rows[0]['pos']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($rows[0]['pos']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($rows[0]['pos']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($rows[0]['pos']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($rows[0]['pos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($rows[0]['pos']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($rows[0]['pos']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($rows[0]['pos']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($rows[0]['pos']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($rows[0]['pos']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($rows[0]['pos']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($rows[0]['pos']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($rows[0]['pos']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($rows[0]['pos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($rows[0]['pos']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($rows[0]['pos']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($rows[0]['pos']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($rows[0]['pos']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($rows[0]['pos']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($rows[0]['pos']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($rows[0]['pos']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($rows[0]['pos']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($rows[0]['pos']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($rows[0]['pos']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($rows[0]['pos']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($rows[0]['pos']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($rows[0]['pos']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($rows[0]['pos']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($rows[0]['pos']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($rows[0]['pos']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($rows[0]['pos']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($rows[0]['pos']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($rows[0]['pos']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
?>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function sameadd()
{
var address1=document.getElementById('address1');
var address2=document.getElementById('address2');
var area=document.getElementById('area');
var city=document.getElementById('city');
var district=document.getElementById('district');
var state=document.getElementById('state');
var pincode=document.getElementById('pincode');
var sameaddress=document.getElementById('sameaddress');
if(sameaddress.checked==true)
{
document.getElementById('saddress1').value=address1.value;
document.getElementById('saddress2').value=address2.value;
document.getElementById('sarea').value=area.value;
document.getElementById('scity').value=city.value;
document.getElementById('sdistrict').value=district.value;
document.getElementById('sstate').value=state.value;
document.getElementById('spincode').value=pincode.value;
}
else
{
document.getElementById('saddress1').value='';
document.getElementById('saddress2').value='';
document.getElementById('sarea').value='';
document.getElementById('scity').value='';
document.getElementById('sdistrict').value='';
document.getElementById('sstate').value='';
document.getElementById('spincode').value='';
}
}
</script>
<hr class="p-0 mb-1 mt-1">
<?php
     }
        ?>
        <?php
     if ((in_array('Item Information', $fieldedit))) {
        ?>
<div class="row">
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingOne" >
<button class="accordion-button font-weight-bold" type="button">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;">Item Information</a>
</div>
</button>
</h5>
<div id="collapseOne" class="accordion-collapse collapse show"
aria-labelledby="headingOne">
<div class="accordion-body text-sm" style="padding-bottom: 0px !important;padding-top: 3px">
<div class="table-responsive">
<table class="table table-bordered" id="purchasetable">
<thead>
<tr><th style="display:none"></th><th></th><th width="16%">ITEM DETAILS<span class="text-danger"> *</span></th><?php
     if ((in_array('Batch', $fieldedit))) {
        ?>
        <th width="16%">BATCH</th>
        <?php
    }
    ?>
        <th style="display:none">DESCRIPTION</th><th style="display:none">HSN</th><th style="display:none">MRP</th><th>RATE<span class="text-danger"> *</span></th><th style="width: 96px !important;">QUANTITY<span class="text-danger"> *</span></th>
<?php
     if ((in_array('Taxable Value', $fieldedit))) {
        ?>
        <th>TAXABLE VALUE</th>
<?php
    }
    ?>
<?php
     if ((in_array('Tax Value', $fieldedit))) {
        ?>
        <th>TAX VALUE</th>
        <?php
    }
    ?>
    <th style="display:none">Discount</th><th>AMOUNT</th><th></th></tr>
</thead>
<tbody>
<?php
$i=1;
foreach($rows as $row)
{
?>

<input type="hidden" name="oldproductid[]" id="oldproductid<?=$i?>" value="<?=$row['productid']?>">
<input type="hidden" name="oldproductname[]" id="oldproductname<?=$i?>" value="<?=$row['productname']?>">
<input type="hidden" name="oldmanufacturer[]" id="oldmanufacturer<?=$i?>" value="<?=$row['manufacturer']?>">
<input type="hidden" name="oldproducthsn[]" id="oldproducthsn<?=$i?>" value="<?=$row['producthsn']?>">
<input type="hidden" name="oldproductnotes[]" id="oldproductnotes<?=$i?>" value="<?=$row['productnotes']?>">
<input type="hidden" name="oldproductdescription[]" id="oldproductdescription<?=$i?>" value="<?=$row['productdescription']?>">
<input type="hidden" name="olditemmodule[]" id="olditemmodule<?=$i?>" value="<?=$row['itemmodule']?>">
<input type="hidden" name="oldbatch[]" id="oldbatch<?=$i?>" value="<?=$row['batch']?>">
<input type="hidden" name="oldexpdate[]" id="oldexpdate<?=$i?>" value="<?=$row['expdate']?>">
<input type="hidden" name="oldmrp[]" id="oldmrp<?=$i?>" value="<?=$row['mrp']?>">
<input type="hidden" name="oldvat[]" id="oldvat<?=$i?>" value="<?=$row['vat']?>">
<input type="hidden" name="oldquantity[]" id="oldquantity<?=$i?>" value="<?=$row['quantity']?>">
<input type="hidden" name="oldproductunit[]" id="oldproductunit<?=$i?>" value="<?=$row['unit']?>">
<input type="hidden" name="oldproductrate[]" id="oldproductrate<?=$i?>" value="<?=$row['productrate']?>">
<input type="hidden" name="oldnoofpacks[]" id="oldnoofpacks<?=$i?>" value="<?=$row['noofpacks']?>">
<input type="hidden" name="oldprodiscount[]" id="oldprodiscount<?=$i?>" value="<?=$row['prodiscount']?>">
<input type="hidden" name="oldproductvalue[]" id="oldproductvalue<?=$i?>" value="<?=$row['productvalue']?>">
<input type="hidden" name="oldtaxvalue[]" id="oldtaxvalue<?=$i?>" value="<?=$row['taxvalue']?>">
<input type="hidden" name="oldproductnetvalue[]" id="oldproductnetvalue<?=$i?>" value="<?=$row['productnetvalue']?>">


<tr>
<td class="priority" style="display:none"> <?=$i?></td>
<td class="tdmove"><svg version="1.1" id="Layer_<?=$i?>" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="ITEM DETAILS" style="padding-top: 1px !important;"><input type="hidden" name="productid[]" id="productid<?=$i?>" value="<?=$row['productid']?>">
<input type="hidden" name="productname[]" id="productname<?=$i?>" value="<?=$row['productname']?>">
<div class="col-sm-9" onclick="andus()" style="width:300px;display: inline-block;" id="selecttheproduct">
<select class="form-control  form-control-sm product proitemselect product1" name="product[]" id="product<?=$i?>" required onChange="productchange(<?=$i?>)">


<option value="" data-foo="" data-receivable="" selected disabled>Select</option>
<?php
$sqli = mysqli_query($con, "SELECT t1.productname, t1.category, t1.id, t1.description, t1.itemmodule, t1.hsncode, t1.openingstock, t2.tax, t3.salemrp, t3.salecost, t3.salediscount, t3.saleofferprice, t1.manufacturer, t1.defaultunit FROM pairproducts t1, pairtaxrates t2, pairprosale t3 WHERE t1.createdid='$companymainid' and ((t1.franchisesession='".$_SESSION["franchisesession"]."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and t2.id=t1.intratax and t3.productid=t1.id and t1.isactive='0' ORDER BY t1.productname ASC");
while ($info = mysqli_fetch_array($sqli))
{
?>
<option value="<?=mysqli_real_escape_string($con, $info['id']);?>" data-foo="<?=mysqli_real_escape_string($con, $info['category']);?>" data-salecost="<?php echo $rescurrency[0]; ?> <?=mysqli_real_escape_string($con, number_format((float)$info['salecost'], 2, ".", ""));?>" data-salemrp="<?php echo $rescurrency[0]; ?> <?=mysqli_real_escape_string($con, number_format((float)$info['salemrp'], 2, ".", ""));?>" data-default="<?=mysqli_real_escape_string($con, $info['defaultunit']);?>" data-itemmodule="<?=mysqli_real_escape_string($con, $info['itemmodule']);?>" data-openingstock="<?=mysqli_real_escape_string($con, $info['openingstock']);?>" <?=($row['productid']==$info['id'])?'selected':''?>><?=mysqli_real_escape_string($con, $info['productname']);?></option>
<?php
}
?>

</select>
</div>
<span class="badge" style="width:75px; padding:3px; margin:5px 0; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan<?=$i?>"><?=$row['itemmodule']?></span><input type="hidden" name="itemmodule[]" id="itemmodule<?=$i?>" value="<?=$row['itemmodule']?>">
<div <?=(in_array('Product Category', $fieldedit))?'':'style="display:none !important;"'?>>
<span id="productmanufacturerspan<?=$i?>" style=" font-size:11px;"><?=$access['txtnamecategory']?>:<input type="text" name="manufacturer[]" id="manufacturer<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 39px !important;padding: 0px !important;height: 18px !important;border: 1px solid #eee !important;" min="0" step="0.01" value="<?=$row['manufacturer']?>" readonly></span> <span id="productmanufacturerval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=$row['manufacturer']?></span>
<span id="productmanufactureredit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="productmanufacturerupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer(<?=$i?>)"><i class="fa fa-save"></i></span>
</div>
<span id="producthsncodespan<?=$i?>" style="font-size:11px;">HSN Code:</span><input type="text" name="producthsn[]" id="producthsn<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;border: 1px solid #eee !important;" value="<?=$row['producthsn']?>"> <span id="producthsncodeval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=$row['producthsn']?></span>
<span id="producthsncodeedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="producthsncodeupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode(<?=$i?>)"><i class="fa fa-save"></i></span>
<br>
<span <?=(in_array('Product Description', $fieldedit))?'':'style="display:none !important;"'?>><span id="productdescriptionspan<?=$i?>" style="font-size:11px;display: block;">Description:</span><textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription<?=$i?>" style="height:50px;  border:1px solid #eee !important;width: 146px;display: inline;"><?=$row['productdescription']?></textarea></span></td>
<td style="display:none"><input type="text" name="productnotes[]" id="productnotes<?=$i?>" class="form-control form-control-sm bordernoneinput" value="<?=$row['productnotes']?>"></td>

<td data-label="BATCH" <?=(in_array('Batch', $fieldedit))?'':'style="display:none;"'?>><div><input type="text" name="batch[]" id="batch<?=$i?>" onClick="batchget(<?=$i?>);" onFocus="batchget(<?=$i?>);"  class="form-control form-control-sm proitemselect" style="margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;" value="<?=$row['batch']?>" autocomplete="off"></div>
    <div>
<span id="productexpdatespan<?=$i?>" style="font-size:11px;">EXPIRY:</span>
<input type="date" name="expdate[]" id="expdate<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['expdate']?>"> <span id="productexpdateval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=$row['expdate']?></span>
<span id="productexpdateedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="productexpdateupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate(<?=$i?>)"><i class="fa fa-save"></i></span>
</div>
<div>
<script type="text/javascript">
$(document).ready(function () {
var productid= $('#product'+<?=$i?>).val();
$.get("batchsearch.php", {term: productid} , function(datas){
console.log("normal"+datas);
$("#errbatch"+<?=$i?>).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
brrch = document.getElementById("errbatch"+<?=$i?>);
if (brrch.value.includes(letters)) {
$("#outfordone"+<?=$i?>).html("");
var browsers = document.getElementById("outfordone"+<?=$i?>);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
for (var key in objbatch) {
  console.log("key"+key);
  check+="<div id='option"+<?=$i?>+objbatch[key].batch+"' style='border:1px solid #cccccc;'><table width='100%'><tr style='border-bottom:none;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#outfordone"+<?=$i?>).html(check);
var browsers = document.getElementById("outfordone"+<?=$i?>);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
});
</script>
<div id="outfordone<?=$i?>" class="dvi" style="display:none;"></div>
<input type="text" id="errbatch<?=$i?>" style="display:none;">
</div>
</td>
<style type="text/css">
@media screen and (max-width: 991px){
    .dvi {
        width: 200px !important;
        right: 25px !important;
    }
}
.dvi {
  position: absolute;
  float: right;
  background-color: #fff;
  border: 1px solid #cccccc !important;
  border-radius: 0 0 5px 5px;
  border-top: none;
  font-family: sans-serif;
  width: 354px;
  padding: 0px;
  max-height: 10rem;
  overflow-y: auto;
  border-bottom: 1px solid #cccccc !important;
}

.dvi div td{
    white-space: nowrap !important;
}

.dvi div {
  background-color: #fff;
  padding: 0px;
  color: black;
  margin-bottom: 0px;
   font-size: 13px;
  cursor: pointer;
}

.dvi div:hover{
  background-color: #1BBC9B !important;
  color: #fff;
}

.select2-container .select2-selection--single .select2-selection__rendered{
white-space: normal !important;
}

.select2-container .select2-selection--single{
    overflow: hidden !important;
}

  </style>

<td data-label="RATE"><div><span style="font-size:15px !important;"><?php echo $rescurrency[0]; ?></span>
<input type="number" min="0" step="0.01" name="productrate[]"   required id="productrate<?=$i?>" class="form-control form-control-sm proitemselect mobinp productselectadd productselectwidth" oninput="mobinpadd(this)" onChange="productcalc(<?=$i?>)" onClick="rateget(<?=$i?>);" onFocus="rateget(<?=$i?>);" value="<?=$row['productrate']?>" style="border: 1px solid #eee !important;margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;font-size:16px !important;"></div>
<div <?=(in_array('Product Mrp', $fieldedit))?'':'style="display:none !important;"'?>>
<span id="productmrpspan<?=$i?>" style=" font-size:11px;white-space: nowrap !important;">MRP:<input type="number" name="mrp[]" id="mrp<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 39px !important;padding: 0px !important;height: 18px !important;border: 1px solid #eee !important;" min="0" step="0.01" value="<?=$row['mrp']?>"> <span id="productmrpval<?=$i?>" style=" font-size:11px;" class="text-primary"><span style="margin-right: -3px !important"><?php echo $rescurrency[0]; ?></span><?=$row['mrp']?></span>
<span id="productmrpedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="productmrpupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp(<?=$i?>)"><i class="fa fa-save"></i></span>
</span>
</div>
<div>
<script type="text/javascript">
$(document).ready(function () {
var productid= $('#product'+<?=$i?>).val();
var customerid = $("#customer").val();
$.get("ratesearch.php", {term: productid,custid: customerid} , function(datas){
console.log("normal"+datas);
$("#errrate"+<?=$i?>).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $ratedatas in";
brrch = document.getElementById("errrate"+<?=$i?>);
if (brrch.value.includes(letters)||brrch.value=='') {
$("#ratelist"+<?=$i?>).html("");
var browsers = document.getElementById("ratelist"+<?=$i?>);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
for (var key in objbatch) {
  console.log("key"+key);
  check+="<div id='option"+<?=$i?>+objbatch[key].invoiceno+"inv' style='border:1px solid #cccccc;'><table width='100%'><tr style='border-bottom:none;'><td align='left' id='invno"+objbatch[key].invoiceno+"inv' style='border:none;'>Invoice No : "+objbatch[key].invoiceno+" </td><td align='right' id='invdt"+objbatch[key].invoiceno+"inv' style='border:none;'>Invoice Date : "+objbatch[key].invoicedate+" </td></tr><tr style='border-bottom:none;'><td align='left' id='rate"+objbatch[key].productrate+"inv' style='border:none;'>Product Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#ratelist"+<?=$i?>).html(check);
var browsers = document.getElementById("ratelist"+<?=$i?>);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
});
</script>
<div id="ratelist<?=$i?>" class="dvi" style="display:none;"></div>
<input type="text" id="errrate<?=$i?>" style="display:none;">
</div>
</td>

<td data-label="QUANTITY"><div><input type="number" min="0" step="0.01" name="quantity[]" required id="quantity<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth" onChange="productcalc(<?=$i?>)" style="margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;font-size:16px !important;" value="<?=$row['quantity']?>"></div>
    <div>
        <span id="productunitspan<?=$i?>" style="font-size:11px;">UNIT:</span><input type="text" name="productunit[]" id="productunit<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['unit']?>" readonly>
<span id="productunitval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=$row['unit']?></span>
<span id="productunitedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editunit(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="productunitupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit(<?=$i?>)"><i class="fa fa-save"></i></span>
</div>
<span id="productnoofpacksspan<?=$i?>" style=" font-size:11px;">PACK:</span><input type="text" name="noofpacks[]" id="noofpacks<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['noofpacks']?>"> <span id="productnoofpacksval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=$row['noofpacks']?></span>
<span id="productnoofpacksedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="productnoofpacksupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks(<?=$i?>)"><i class="fa fa-save"></i></span>

</td>

<td data-label="TAXABLE VALUE" <?=(in_array('Taxable Value', $fieldedit))?'':'style="display:none;"'?>><div><span style="font-size:15px !important;"><?php echo $rescurrency[0]; ?></span>
<input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectadd"style="background:none;margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['productvalue']?>" ></div>
<span id="productprodiscountspan<?=$i?>" style=" font-size:11px;white-space: nowrap !important;">DISCOUNT:</span><div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect1">
     <div class="input-group-prepend">
       <input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(<?=$i?>)" value="<?=$row['prodiscount']?>">
    </div>
    <select name="prodiscounttype" id="prodiscounttype1" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 1.5px !important;">
<option value="0">%</option>
<option value="1"><?php echo $rescurrency[0]; ?></option>
</select>
  </div> <span id="productprodiscountval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=$row['prodiscount']?>(<span style="color:green !important;"><span style="color:green !important;margin-right:-3px !important;"><?=$rescurrency[0];?></span><?=$row['productvalue']?> - <span style="color:green !important;margin-right:-3px !important;"><?=$rescurrency[0];?></span><?=$row['prodiscount']?></span>)</span>
<span id="productprodiscountedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="productprodiscountupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount(<?=$i?>)"><i class="fa fa-save"></i></span>

</td>

<td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldedit))?'':'style="display:none;"'?>><div><span style="font-size:15px !important;"><?php echo $rescurrency[0]; ?></span>
<input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectadd" style="background:none;margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['taxvalue']?>" ></div>
<span id="productvatspan<?=$i?>" style="font-size:11px;white-space: nowrap !important;">GST:<input type="number" min="0" step="0.01" name="vat[]" id="vat<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(<?=$i?>)" value="<?=$row['vat']?>"> <span id="productvatval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=$row['vat']?>%</span>
<span id="productvatedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editvat(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="productvatupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat(<?=$i?>)"><i class="fa fa-save"></i></span></span>
<br>
<span id="productcgstvatspan<?=$i?>" style=" font-size:11px;">CGST:</span>
<span id="productcgstvatval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=($row['vat']/2)?>% (<span style="margin-right: -3px !important"><?php echo $rescurrency[0]; ?></span><?=($row['taxvalue']/2)?>)</span><br>
<span id="productsgstvatspan<?=$i?>" style=" font-size:11px;">SGST:</span>
<span id="productsgstvatval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=($row['vat']/2)?>% (<span style="margin-right: -3px !important"><?php echo $rescurrency[0]; ?></span><?=($row['taxvalue']/2)?>)</span><br>
<span id="productigstvatspan<?=$i?>" style="display:none; font-size:11px;">IGST:</span>
<span id="productigstvatval<?=$i?>" style="display:none; font-size:11px;" class="text-primary"><?=$row['vat']?>% (<span style="margin-right: -3px !important"><?php echo $rescurrency[0]; ?></span><?=$row['taxvalue']?>)</span>
</td>

<td data-label="AMOUNT"><div><span style="font-size:15px !important;"><?php echo $rescurrency[0]; ?></span>
<input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectadd"style="background:none;margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['productnetvalue']?>" ></div></td>
<td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
<?php
$i++;
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-8">


<div class="row">
<div class="form-group row" id="mobadddesign">
<div class="col-lg-4 col-md-4 col-sm-12 col-12">
<p align="left" style="margin:0px;padding:0px;">
<a class="productadd-row btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 2px 4.5px 1px 4.5px !important; margin-bottom:0.25rem;"><i style="font-size: 14px;color:#0066cc;" class="fa fa-plus-circle"></i> Add another line</a>
<a class="btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 3.5px 4.5px 3.5px 4.5px !important; margin-bottom:0.25rem; display:none" id="productadd" data-bs-toggle="modal" data-bs-target="#AddNewProduct"><i style="font-size: 14px;color:#0066cc;" class="fa fa-plus"></i> Missing Products? Add Here</a></p>
</div>

</div>
</div>

<div class="row">
<div class="col-lg-4 mt-0 mb-3" id="grandbottom">
    <div class="row mt-2">
    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
<label class="custom-label" for="totalitems" style="margin-top: 0px !important;">Total Items</label>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-6">
<input required type="text" name="totalitems" id="totalitems" class="form-control form-control-sm "  readonly  value="<?=$rows[0]['totalitems']?>" >
</div>
</div>
<div class="row mt-2">
 <div class="col-lg-6 col-md-6 col-sm-6 col-6">
<label class="custom-label" for="totalitems" style="margin-top: 0px !important;">Total Qty</label>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-6">
<input required type="text" name="totalquantity" id="totalquantity" class="form-control form-control-sm " readonly  value="<?=$rows[0]['totalquantity']?>" >
</div> 
</div>
</div>
<div class="col-lg-8">



<div class="table-responsive mt-1" id="gsttablediv" <?=(in_array('Tax Table', $fieldedit))?'':'style="display:none;"'?>>
<table class="table table-bordered" id="gsttable" style="font-size:12px;">
    <thead>
<tr>
<th rowspan="2" style="width:30%;background-color:#d1d3d5 !important;font-size: 12px !important;border: 1px solid #999;text-align: right !important;border-bottom: 0px !important;vertical-align: middle;"><b>TAXABLE VALUE <?=$rescurrency[0]?></b></th>
<th colspan="2" style="width:23%;background-color:#d1d3d5 !important;font-size: 12px !important;border: 1px solid #999;text-align: center !important;">CGST</th>
<th colspan="2" style="width:23%;background-color:#d1d3d5 !important;font-size: 12px !important;border: 1px solid #999;text-align: center !important;">SGST</th>
<th colspan="2" style="width:24%;background-color:#d1d3d5 !important;font-size: 12px !important;border: 1px solid #999;text-align: center !important;">GST</th>
</tr>
<tr>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #d1d3d5 !important;font-size: 12px !important;"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #d1d3d5 !important;font-size: 12px !important;"><b><?=$rescurrency[0]?></b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #d1d3d5 !important;font-size: 12px !important;"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #d1d3d5 !important;font-size: 12px !important;"><b><?=$rescurrency[0]?></b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #d1d3d5 !important;font-size: 12px !important;"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #d1d3d5 !important;font-size: 12px !important;"><b><?=$rescurrency[0]?></b></th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" data-label="TAXABLE VALUE"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm amountdesign bordernoneinput"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['tax25']?>"></td><td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999 !important;" data-label="CGST %">2.5%</td><td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="CGST"><div><?php echo $rescurrency[0]; ?><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['cgst25']?>"></div></td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="SGST %">2.5%</td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="SGST"><div><?php echo $rescurrency[0]; ?><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['sgst25']?>"></div></td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="GST">5%</td> <td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;white-space: nowrap;border-left: 1px dashed #999;" data-label="GST"><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['gst25']?>"></td>
</tr>
<tr>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" data-label="TAXABLE VALUE"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['tax6']?>" ></td><td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999 !important;" data-label="CGST %">6%</td><td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="CGST"><div><?php echo $rescurrency[0]; ?><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"  value="<?=$rows[0]['cgst6']?>"></div></td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="SGST %">6%</td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="SGST"><div><?php echo $rescurrency[0]; ?><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['sgst6']?>" ></div></td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="GST">12%</td> <td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;white-space: nowrap;border-left: 1px dashed #999;" data-label="GST"><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['gst6']?>" ></td>
</tr>
<tr>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" data-label="TAXABLE VALUE"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['tax9']?>" ></td><td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999 !important;" data-label="CGST %">9%</td><td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="CGST"><div><?php echo $rescurrency[0]; ?><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['cgst9']?>" ></div></td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="SGST %">9%</td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="SGST"><div><?php echo $rescurrency[0]; ?><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['sgst9']?>" ></div></td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="GST">18%</td> <td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;white-space: nowrap;border-left: 1px dashed #999;" data-label="GST"><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['gst9']?>" ></td>
</tr>
<tr>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" data-label="TAXABLE VALUE"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['tax14']?>" ></td><td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999 !important;" data-label="CGST %">14%</td> <td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="CGST"><div><?php echo $rescurrency[0]; ?><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['cgst14']?>" ></div></td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="SGST %">14%</td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="SGST"><div><?php echo $rescurrency[0]; ?><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['sgst14']?>" ></div></td>
<td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="GST">28%</td> <td style="text-align: right;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;white-space: nowrap;border-left: 1px dashed #999;" data-label="GST"><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"  value="<?=$rows[0]['gst14']?>"></td>
</tr>
<tr>
<td colspan="6" style="text-align:right;width: 92.3px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" id="tgstamount">Total GST Amount </td> <td id="tgstinp" style="padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;"><div><?php echo $rescurrency[0]; ?><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm amountdesign" readonly style="background-color:#E9ECEF !important;text-align: right !important;" value="<?=$rows[0]['totalvatamount']?>" ></div></td>
</tr>
</tbody>
</table>
</div>

</div>


</div>

<div class="row mb-1" style="display:none">
<div class="col-lg-3"> Tax Type </div>
<div class="col-lg-3">
<select required type="text" name="taxtype" id="taxtype" class="form-control form-control-sm" onChange="gstcalc();">
<option value="IntraState" selected>IntraState</option>
<option value="InterState">InterState</option>
</select>
</div>
</div>
<div class="row mb-1" style="display:none">
<div class="col-lg-8">

</div>
</div>
</div>
<div class="col-lg-4 mb-1" style="background-color:#fbfafa; font-size: 0.85rem;margin-top:-10px;" id="nextcontentdesignforweb">
<div class="p-1">
<div class="row mb-1">
<div class="col-6">Sub Total <span class="pull-right">:</span></div>
<div class="col-6">
<div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div><input required type="text" name="totalamount" id="totalamount" class="form-control form-control-sm" style="background:none; text-align:right;border: 1px solid #eee;"  readonly  value="<?=number_format((float)$rows[0]['totalamount'],2,'.','')?>" ></div>
</div>
</div>
<div class="row mb-1" >
<div class="col-6" > <!-- <span style="float:left">Discount </span>
<input type="text" name="discount" class="form-control form-control-sm"  id="discount" value="0" onChange="discount1()" style="width:50px;"  >  -->
<div class="input-group input-group-sm">
     <div class="input-group-prepend">
        <div class="input-group input-group-sm">
     <div class="input-group-prepend" style="padding-right: 3px !important;">
     Discount</div>
<input type="text" name="discount" class="form-control form-control-sm"  id="discount" value="<?=number_format((float)$rows[0]['discount'],2,'.','')?>" onChange="discount1()" style="width:24px;border: 1px solid #e0e3e6 !important;border-radius: 0px !important;padding: 0px !important;">
</div>
</div>
<select name="discounttype" id="discounttype" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;" onChange="discount1()">
<option value="0" <?=($rows[0]['discounttype']=='0')?'selected':''?>>%</option>
<option value="1" <?=($rows[0]['discounttype']=='1')?'selected':''?>><?php echo $rescurrency[0]; ?></option>
</select>
</div>
  <span class="pull-right" style="margin-top:-25px !important;">:</span>
</div>
<div class="col-6" >
    <div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div>
<input required type="text" name="discountamount" id="discountamount" class="form-control form-control-sm " style="background:none; text-align:right;border:1px solid #eee;" value="<?=number_format((float)$rows[0]['discountamount'],2,'.','')?>" onChange="productcalc1()" >
</div>
</div>
</div>
<div class="row mb-1" >
<div class="col-6" > Total Tax <span class="pull-right">:</span></div>
<div class="col-6">
    <div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div>
<input required type="text" name="totalvatamount" id="totalvatamount" class="form-control form-control-sm " style="background:none; text-align:right;border: 1px solid #eee;"  readonly  value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" ></div>
</div>
</div>
<div class="row mb-1" style="display:none" >
<div class="col-6" > Freight<span class="pull-right">:</span> <?php echo $rescurrency[0]; ?></div>
<div class="col-6" >
<input required type="text" name="freightamount" id="freightamount" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right" value="<?=number_format((float)$rows[0]['freightamount'],2,'.','')?>" onChange="productcalc1()" >
</div>
</div>
<div class="row mb-1" >
<div class="col-6" > Round off<span class="pull-right">:</span> </div>
<div class="col-6">
<div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div>
<input required type="text" name="roundoff" id="roundoff" class="form-control form-control-sm" style="background:none; text-align:right;border:1px solid #eee;padding: 3px !important;" value="<?=number_format((float)$rows[0]['roundoff'],2,'.','')?>" onChange="productcalcround()" ></div>
</div>
</div>
<div class="row mb-1" style="font-size:14.6px;" >
<div class="col-6" > <strong>Grand Total<span class="pull-right">:</span></strong> </div>
<div class="col-6">
<div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div>
<input required type="text" name="grandtotal" id="grandtotal" class="form-control form-control-sm " style="background:none; text-align:right; border: 1px solid #eee;padding: 3px !important;font-weight: 700 !important;font-size: 14.6px !important;" value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" onChange="productcalc1()" readonly ></div>
</div>
</div>
<div class="row mb-1">
<div class="col-12">
<span id="grandwords">adfsadf</span>
</div>
</div>
<div class="row mb-1" style="font-size:18px; display:none" >
<div class="col-6" >
<label class="custom-label" for="mode">Mode</label>
</div>
<div class="col-6">
<select class="select4 form-control form-control-sm" name="mode" id="mode">
<option>1</option>
<option>2</option>
<option>3</option>
</select>
</div>
</div>
<div class="row mb-1" style="font-size:18px; display:none" >
<div class="col-6" >
<label class="custom-label" for="balancedue">Balance Due</label>
</div>
<div class="col-6">
<input type="text" name="balancedue" id="balancedue" class="form-control form-control-sm">
</div>
</div>
</div>
</div>
</div>


<div class="row mt-2 mb-2">
<div class="col-lg-8">
<?php
     if ((in_array('Description', $fieldedit))) {
        ?>
<div class="row">
<div class="col-lg-2">
<label class="custom-label" for="description">Description</label>
</div>
<div class="col-lg-10">
<textarea class="form-control form-control-sm" name="description" id="description" style="height: 60px !important;"><?=$rows[0]['description']?></textarea>
</div>
</div>
<?php
}
?>
<?php
     if ((in_array('Notes', $fieldedit))) {
        ?>
<div class="row mt-2">
<div class="col-lg-2">
<label class="custom-label" for="notes">Notes</label>
</div>
<div class="col-lg-10">
<textarea class="form-control form-control-sm" name="notes" id="notes" style="height: 60px !important;"><?=$rows[0]['notes']?></textarea>
</div>
</div>
<?php
}
?>
<?php
     if ((in_array('Terms and Conditions', $fieldedit))) {
        ?>
<div class="row">
<div class="col-lg-2">
<label class="custom-label" for="terms">Terms and Conditions</label>
</div>
<div class="col-lg-10">
<textarea class="form-control form-control-sm" name="terms" id="terms" style="height: 80px !important;"><?=$rows[0]['terms']?></textarea>
</div>

</div>

</div>
<?php
}
?>
<?php
     if ((in_array('Attach', $fieldedit))) {
        ?>
<div class="col-lg-4">
<label class="custom-label mb-2" for="fileattach">Attach File(s) to <?= $infomainaccessuser['modulename'] ?></label>
<div class="form-group">
<input type="hidden" name="fileattach1" id="fileattach1" value="<?=$rows[0]['fileattach']?>">
<input type="file" name="fileattach[]" id="fileattach" class="form-control form-control-sm" multiple>
</div>
<span style="font-size:11px;">You can upload a maximum of 5 files, 5MB each</span><br>
<?php
if($rows[0]['fileattach']!='')
{
	$filesat=explode(' | ', $rows[0]['fileattach']);
	foreach($filesat as $file)
	{
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		if(strtolower($ext)=='pdf')
		{
			?>
			<a href="<?=$file?>" target="_blank"><div style="width:30px; height:30px; border:1px solid #cccccc; font-size:22px; padding:2px"><i class="fa fa-file-pdf"></i></div> PDF</a>
			<?php
		}
		if((strtolower($ext)=='doc')||(strtolower($ext)=='docx'))
		{
			?>
			<a href="<?=$file?>" target="_blank"><div style="width:30px; height:30px; border:1px solid #cccccc; font-size:25px; padding:2px"><i class="fa fa-file-word"></i></div>WORD</a>
			<?php
		}
		if((strtolower($ext)=='xls')||(strtolower($ext)=='xlsx'))
		{
			?>
			<a href="<?=$file?>" target="_blank"><div style="width:30px; height:30px; border:1px solid #cccccc; font-size:22px; padding:2px"><i class="fa fa-file-excel"></i></div>EXCEL</a>
            <?php
        }
    }
}
?>
</div>

</div>
<?php
}
?>
</div>
<?php
     }
        ?>



<!---payment confirm---->
<!---payment confirm---->
<!---navbottom---->
<header class="app-header fixed-bottom" style="height:48px !important;z-index: 1 !important;">
<div class="app-header-inner">
<div class="py-2 px-3">
<div class="app-header-content" style="margin-left: -45px;" id="ilu">
<div class="row">
<div class="col-auto pt-1" style="width:34px !important;margin-top: -8px !important;height: 100px;margin-left: -18px !important;border-top: 1px solid #eff0f4;">
</div>
<div class="col" style="width:34px !important;margin-top: 1px !important;margin-left: -9px !important;">
<button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="SAVET">
<span class="label">SAVE</span> <span class="spinner"></span>
</button>
<!-- <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit1" name="submit1" value="SAVE & PRINT">
<span class="label">SAVE & PRINT</span> <span class="spinner"></span>
</button> -->

<a class="btn btn-primary btn-sm btn-custom-grey"
href="estimates.php" style="margin-top:-3px !important;">Cancel</a>

</div>
</div>
</div>
</div>
</div>
</header>
<!---navbottom---->
</form>
<?php
}
?>
</div>
</div>
</div>
</div>
</div>
 <?php
}
 else
 {
	 ?>
	 <div class="alert alert-danger text-white">
	 No Data Found
	 </div>
	 <?php
 }
 }
 else
 {
	 ?>
	 <div class="alert alert-danger text-white">
	 No Information
	 </div>
	 <?php
 }
?> 
<?php
include('footer.php');
?>
</div>
</main>
<!-------------------customer add info start ------------------------------->
<!-- subtext -->
<script type="text/javascript">
$(function(){
$(".select2").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
return $(
'<div><div>' + state.text + '</div><div class="foo">'
+ $(state.element).attr('data-foo')
+ '</div></div>'
);
}
</script>
<!-------------------customer add info end ------------------------------->
<?php
include('fexternals.php');
?>
<!-------------------customer add info start ------------------------------->
<!--salutation-->
<script type="text/javascript">
$("#custsalute").click(function(){
document.getElementById('custcustdrpsalute').classList.toggle("custdropdownsalute");
});
</script>
<!-- cat -->
<script type="text/javascript">
function andun() {
$(".select2-container--open .select2-dropdown--above").hide();
$(".select2-container--open .select2-dropdown--below").hide();
}
function andus() {
$(".select2-container--open .select2-dropdown--above").show();
$(".select2-container--open .select2-dropdown--below").show();
}
</script>
<!-- subcat -->

<!-- same as bill -->
<script type="text/javascript">
function sameasbillingticaccess() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
}
$(document).ready(function() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
});
</script>
<!-- gstrtype -->
<script type="text/javascript">
$(document).ready(function() {
let noaccess = document.getElementById('custtaxprefnontaxable');
let access = document.getElementById('custtaxpreftaxable');
if (noaccess.checked == true) {
document.getElementById('custgstrtypesh').style.display='none';
}
if (access.checked == true) {
document.getElementById('custgstrtypesh').style.display='block';
}
});
function gettaxable(){
let noaccess = document.getElementById('custtaxprefnontaxable');
let access = document.getElementById('custtaxpreftaxable');
if (noaccess.checked == true) {
document.getElementById('custgstrtypesh').style.display='none';
}
else{
document.getElementById('custgstrtypesh').style.display='block';
}
}
</script>
<script type="text/javascript">
function showDiv(element)
{
if (element.value == '') {
document.getElementById('custgstblock').style.display = 'none';
document.getElementById('custplaceofsupply').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").removeAttr("required");
// $("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Regular') {
document.getElementById('custgstblock').style.display = 'block';
document.getElementById('custplaceofsupply').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").attr("required","required");
}
else if (element.value == 'Registered Business - Composition') {
document.getElementById('custgstblock').style.display = 'block';
document.getElementById('custplaceofsupply').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").attr("required","required");
}
else if (element.value == 'Unregistered Business') {
document.getElementById('custgstblock').style.display = 'none';
document.getElementById('custplaceofsupply').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").removeAttr("required");
}
else if (element.value == 'Consumer') {
document.getElementById('custgstblock').style.display = 'none';
document.getElementById('custplaceofsupply').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").removeAttr("required");
}
else if (element.value == 'Overseas') {
document.getElementById('custplaceofsupply').style.display = 'none';
document.getElementById('custgstblock').style.display = 'none';
$("#custpos").removeAttr("required");
$("#custgstin").removeAttr("required");
}
else if (element.value == 'Special Economic Zone') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").attr("required","required");
}
else if (element.value == 'Deemed Export') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").attr("required","required");
}
else if (element.value == 'Tax Deductor') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").attr("required","required");
}
else if (element.value == 'SEZ Developer') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
$("#custpos").attr("required","required");
$("#custgstin").attr("required","required");
}
}
function showDivcust(elementcust)
{
if (elementcust.value == '') {
document.getElementById('custgstinblock').style.display = 'none';
}
else if (elementcust.value == 'Registered Business - Regular') {
document.getElementById('custgstinblock').style.display = 'block';
}
else if (elementcust.value == 'Registered Business - Composition') {
document.getElementById('custgstinblock').style.display = 'block';
}
else if (elementcust.value == 'Unregistered Business') {
document.getElementById('custgstinblock').style.display = 'none';
}
else if (elementcust.value == 'Consumer') {
document.getElementById('custgstinblock').style.display = 'none';
}
else if (elementcust.value == 'Overseas') {
document.getElementById('custgstinblock').style.display = 'none';
}
else if (elementcust.value == 'Special Economic Zone') {
document.getElementById('custgstinblock').style.display = 'block';
}
else if (elementcust.value == 'Deemed Export') {
document.getElementById('custgstinblock').style.display = 'block';
}
else if (elementcust.value == 'Tax Deductor') {
document.getElementById('custgstinblock').style.display = 'block';
}
else if (elementcust.value == 'SEZ Developer') {
document.getElementById('custgstinblock').style.display = 'block';
}
}
</script>
<!-- cat -->
<script>
$("#custcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#custAddNewCategory') {
$('#custAddNewCategory').modal('show');
}
});
$("#custsubcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#custAddNewSubCategory') {
$('#custAddNewSubCategory').modal('show');
}
});
</script>
<script>
function funaddcategory() {
var missingcategory = document.getElementById('custmissingcategory');
if (missingcategory.value == '') {
alert('Please Enter New Category Name');
missingcategory.focus();
return false;
} else {
$('#custcategory').append('<option value="' + missingcategory.value + '">' + missingcategory.value +
'</option>');
$('#custcategory').val(missingcategory.value).change();
$('#custAddNewCategory').modal('hide');
return false;
}
}
function funescategory() {
$('#custcategory').val('').change();
$('#custAddNewCategory').modal('hide');
return false;
}
</script>
<!-- subcat -->
<script>
function funaddsubcategory() {
var missingsubcategory = document.getElementById('custmissingsubcategory');
if (missingsubcategory.value == '') {
alert('Please Enter New Sub Category Name');
missingsubcategory.focus();
return false;
} else {
$('#custsubcategory').append('<option value="' + missingsubcategory.value + '">' + missingsubcategory.value +
'</option>');
$('#custsubcategory').val(missingsubcategory.value).change();
$('#custAddNewSubCategory').modal('hide');
return false;
}
}
function funessubcategory() {
$('#custsubcategory').val('').change();
$('#custAddNewSubCategory').modal('hide');
return false;
}
</script>
<!-- unit cat subcat select modal design -->
<script>
$("#customer").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewCustomer");
$("#configureunits").show();
});
$("#customer").on("select2:open", function() {
<?php
if($access['estnewcustomerdef']=='1'){
?>
$("#configureunits").show();
document.getElementById("configureunits").innerHTML = "New <?= $infomainaccessusercus['modulename'] ?>";
<?php
}
else{
?>
$("#configureunits").hide();
<?php
}
?>
});

$(".product1").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewProduct");
$("#configureunits").show();
});
$(".product1").on("select2:open", function() {
<?php
if($access['estnewproductdef']=='1'){
?>
$("#configureunits").show();
document.getElementById("configureunits").innerHTML = "New Product";
<?php
}
else{
?>
$("#configureunits").hide();
<?php
}
?>
});

$("#custgstrtype").on("select2:open", function() {
$("#configureunits").hide();
});
$("#custsubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewSubCategory");
});
$("#custsubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#custcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewCategory");
});
$("#custcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Category";
});
$("#custpos").on("select2:open", function() {
$("#configureunits").hide();
});
</script>
<script>
function funaddcustomer() {
var custcustomerdname = document.getElementById('custcustomerdname');
var custgsttype = document.getElementById("custgstrtype");
var custgsttypeans = custgsttype.options[custgsttype.selectedIndex].text;
var custpos = document.getElementById("custpos");
var custposans = custpos.options[custpos.selectedIndex].text;
var custgstin = document.getElementById("custgstin");
if (custcustomerdname.value == ''||custgsttypeans=="Select Type of Add"||(custposans=="Select The Place"&&custgsttypeans!="Overseas")||((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin.value=='')) {
// alert('Please Enter New Customer Name');
if (custcustomerdname.value == '') {custcustomerdname.focus();}
else if (custgsttypeans=="Select Type of Add") {custgsttype.focus();}
else if ((custposans=="Select The Place"&&custgsttypeans!="Overseas")) {custpos.focus();}
else if (((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin.value=='')) {custgstin.focus();}
return false;
} else {
$('#custcustomer').append('<option value="' + custcustomerdname.value + '">' + custcustomerdname.value +
'</option>');
$('#custcustomer').val(custcustomerdname.value).change();
$('#custAddNewCustomer').modal('hide');
return false;
}
}
function funescustomer() {
$('#custcustomer').val('').change();
$('#custAddNewCustomer').modal('hide');
return false;
}
</script>
<script>
$(document).ready(function(){
$("#submitproduct").click(function(e){
e.preventDefault();
var proproductname=$("#proproductname").val();
var prodefaultunit = document.getElementById("prodefaultunit");
var prodefaultunitans = prodefaultunit.options[prodefaultunit.selectedIndex].text;
if(proproductname==""||prodefaultunitans=="Unit")
{
if (proproductname == '') {alert("Please Enter the Product Name");}
else if (prodefaultunitans=="Unit") {alert("Please Select the Unit");}
return false;
}
else
{
$.ajax({type: "POST",
url: "productadds.php",
data: {
productname: $("#proproductname").val(),
codetags: $("#procodetags").val(),
hsncode: $("#prohsncode").val(),
delivery: $("#prodelinpbrd").val(),
defaultunit: $("#prodefaultunit").val(),
procategory: $("#procategory").val(),
prosubcategory: $("#prosubcategory").val(),
description: $("#prodescription").val(),
provisibility: $("#provisibility").val(),
taxable: $("#protaxable").val(),
intratax: $("#prointratax").val(),
intertax: $("#prointertax").val(),
pricename: $("#proproductname1").val(),
mrp: $("#proquantity1").val(),
sellingprice: $("#proproductrate1").val(),
descriptions: $("#provat1").val(),
pricenamepur: $("#purproproductname1").val(),
mrppur: $("#purproquantity1").val(),
sellingpricepur: $("#purproproductrate1").val(),
descriptionspur: $("#purprovat1").val(),
submit: "Submit"
},
success:function(result){
$.ajax({
            type: "POST",
            url: "productaddmodal.php",
            success: function(data){
              $("#promodal").html(data); 
                }
            });
$('.select2-field').select2({
        tags: "true"
    });
$(function(){
$("#custgstrtype").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
if($(state.element).attr('data-receivable')=="")
{
return $(
'<div><div>' + state.text + '</div></div>'
);
}
else
{
if($(state.element).attr('data-receivable')=="0")
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:green">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
else
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:red">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
}
}
 $("#prointratax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prointertax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prosubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewSubCategory");
});
$("#prosubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#procategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewCategory");
});
$("#procategory").on("select2:open", function() { document.getElementById("configureunits").innerHTML = "New <?=$access['txtnamecategory']?>";
});
$("#prodefaultunit").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewDefaultUnit");
});
$("#prodefaultunit").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Unit";
});
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
var proproductname=$("#prooriginpage").val();
var proids=$("#ppp").val();
$('.product1').append('<option value="' + resarray[1] + '">' + proproductname + '</option>');
$('select[name^="product'+proids+'"] option[value="' + resarray[1] + '"]').attr("selected","selected");
$('#product'+proids+'').val(resarray[1]).change();
$('#AddNewProduct').modal('hide');
}
}});
}
});
});
</script>
<script>
$(document).ready(function(){
$("#custsubmitcustomer").click(function(e){
e.preventDefault();
var custcustomerdname=$("#custcustomerdname").val();
var custgsttype = document.getElementById("custgstrtype");
var custgsttypeans = custgsttype.options[custgsttype.selectedIndex].text;
var custpos = document.getElementById("custpos");
var custposans = custpos.options[custpos.selectedIndex].text;
var custgstin = $("#custgstin").val();
if(custcustomerdname==""||custgsttypeans=="Select Type of Add"||(custposans=="Select The Place"&&custgsttypeans!="Overseas")||((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin==''))
{
if (custcustomerdname == '') {alert("Please Enter the <?= $infomainaccessusercus['modulename'] ?> Name");}
else if (custgsttypeans=="Select Type of Add") {alert("Please Select the GST Type");}
else if ((custposans=="Select The Place"&&custgsttypeans!="Overseas")) {alert("Please Select the Place of Supply");}
else if (((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin=='')) {alert("Please Enter the GST In Value");}
return false;
}
else
{
$.ajax({type: "POST",
url: "customeradds.php",
data: {
customercode: $("#custcustomercode").val(),
landline: $("#custlandline").val(),
cstno: $("#custcstno").val(),
customerid: $("#custcustomerid").val(),
publiccode: $("#custpubliccode").val(),
privatecode: $("#custprivatecode").val(),
salute: $("#custsalute").val(),
pcontact: $("#custpcontact").val(),
companyname: $("#custcompanyname").val(),
customerdname: $("#custcustomerdname").val(),
custcategory: $("#custcategory").val(),
custsubcategory: $("#custsubcategory").val(),
workphone: $("#custworkphone").val(),
mobilephone: $("#custmobilephone").val(),
email: $("#custemail").val(),
website: $("#custwebsite").val(),
billstreet: $("#custbillstreet").val(),
billcity: $("#custbillcity").val(),
billstate: $("#custbillstate").val(),
billpincode: $("#custbillpincode").val(),
billcountry: $("#custbillcountry").val(),
sameasbilling: $("#custsameasbilling").val(),
shipstreet: $("#custshipstreet").val(),
shipcity: $("#custshipcity").val(),
shipstate: $("#custshipstate").val(),
shippincode: $("#custshippincode").val(),
shipcountry: $("#custshipcountry").val(),
custvisibility: $("#custvisibility").val(),
taxpref: $("#custtaxpref").val(),
gstrtype: $("#custgstrtype").val(),
gstin: $("#custgstin").val(),
bln: $("#custbln").val(),
btname: $("#custbtname").val(),
pan: $("#custpan").val(),
pos: $("#custpos").val(),
submit: "Submit"
},
success:function(result){
$.ajax({
            type: "POST",
            url: "customeraddmodal.php",
            success: function(data){
              $("#custmodal").html(data); 
                }
            });
$('.select2-field').select2({
        tags: "true"
    });
$(function(){
$("#custgstrtype").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
if($(state.element).attr('data-receivable')=="")
{
return $(
'<div><div>' + state.text + '</div></div>'
);
}
else
{
if($(state.element).attr('data-receivable')=="0")
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:green">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
else
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:red">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
}
}
$("#custgstrtype").on("select2:open", function() {
$("#configureunits").hide();
});
$("#custsubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewSubCategory");
});
$("#custsubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#custcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewCategory");
});
$("#custcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Category";
});
$("#custpos").on("select2:open", function() {
$("#configureunits").hide();
});
function sameasbillingticaccess() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
}
$(document).ready(function() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
});
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
var custcustomerdname=$("#custoriginpage").val();
var billcity=$("#custbillcity").val();
var mobilephone=$("#custmobilephone").val();
$('#customer').append('<option value="' + resarray[1] + '">' + custcustomerdname + '</option>');
$('select[name^="customer"] option[value="' + resarray[1] + '"]').attr("selected","selected");
$('#customer').val(resarray[1]).change();
$('#custAddNewCustomer').modal('hide');
}
}});
}
/* $.ajax({type: "POST",
url: "/imball-reagens/public/shareitem",
data: { id: $("#Shareitem").val(), access_token: $("#access_token").val() },
success:function(result){
$("#sharelink").html(result);
}}); */
});
});
</script>
<!-------------------customer add info end ------------------------------->
<script>
let lineNo = <?=$i?>;
$(document).ready(function () {
$(".productadd-row").click(function () {
addnewrow(lineNo);
lineNo++;
});
});
</script><script>
function proautocomp(lineNo)
{
$('#product'+lineNo).change(function(){
var id= $('#product'+lineNo).val();
if(id != '')
{
$.get("prosearch1.php", {term: id} , function(data){
console.log(data);
const obj = JSON.parse(data);
console.log(obj[0]);
$("#productid"+lineNo).val(obj[0].id);
$("#productname"+lineNo).val(obj[0].productname);
$("#productnotes"+lineNo).val(obj[0].description);
$("#productdescription"+lineNo).val(obj[0].description);
$("#productdescription"+lineNo).css('display', 'inline');
$("#productdescriptionspan"+lineNo).css('display', 'block');
$("#itemmodulespan"+lineNo).html(obj[0].itemmodule);
$("#itemmodule"+lineNo).val(obj[0].itemmodule);
$("#itemmodulespan"+lineNo).css('display', 'inline');
$("#producthsn"+lineNo).val(obj[0].hsncode);
$("#mrp"+lineNo).val(obj[0].salemrp);
$("#vat"+lineNo).val(obj[0].tax);
$("#productrate"+lineNo).val(obj[0].salecost);
$("#prodiscount"+lineNo).val(obj[0].salediscount);
$("#productmanufacturerval"+lineNo).html(obj[0].category);
$("#productmanufacturerval"+lineNo).css('display', 'inline');
$("#manufacturer"+lineNo).val(obj[0].category);
$("#manufacturer"+lineNo).css('display', 'none');
$("#productmanufacturerspan"+lineNo).css('display', 'inline');
$("#productmanufactureredit"+lineNo).css('display', 'inline');
$("#productmanufacturerupdate"+lineNo).css('display', 'none');
$("#producthsncodeval"+lineNo).html(obj[0].hsncode);
$("#producthsncodeval"+lineNo).css('display', 'inline');
$("#producthsn"+lineNo).val(obj[0].hsncode);
$("#producthsn"+lineNo).css('display', 'none');
$("#producthsncodespan"+lineNo).css('display', 'inline');
$("#producthsncodeedit"+lineNo).css('display', 'inline');
$("#producthsncodeupdate"+lineNo).css('display', 'none');
//$("#productexpdateval"+lineNo).html(obj[0].expdate);
$("#productexpdateval"+lineNo).css('display', 'inline');
//$("#expdate"+lineNo).val(obj[0].expdate);
$("#expdate"+lineNo).css('display', 'none');
$("#productexpdatespan"+lineNo).css('display', 'inline');
$("#productexpdateedit"+lineNo).css('display', 'inline');
$("#productexpdateupdate"+lineNo).css('display', 'none');
$("#productmrpval"+lineNo).html(obj[0].mrp);
$("#productmrpval"+lineNo).css('display', 'inline');
$("#mrp"+lineNo).val(obj[0].mrp);
$("#mrp"+lineNo).css('display', 'none');
$("#productmrpspan"+lineNo).css('display', 'inline-block');
$("#productmrpedit"+lineNo).css('display', 'inline');
$("#productmrpupdate"+lineNo).css('display', 'none');
$("#productnoofpacksval"+lineNo).html(obj[0].noofpacks);
$("#productnoofpacksval"+lineNo).css('display', 'inline');
$("#productunitval"+lineNo).html(obj[0].defaultunit);
$("#productunitval"+lineNo).css('display', 'inline');
$("#noofpacks"+lineNo).val(obj[0].noofpacks);
$("#noofpacks"+lineNo).css('display', 'none');
$("#productunit"+lineNo).css('display', 'none');
$("#productunit"+lineNo).val(obj[0].defaultunit);
$("#productnoofpacksspan"+lineNo).css('display', 'inline');
$("#productunitspan"+lineNo).css('display', 'inline');
$("#productnoofpacksedit"+lineNo).css('display', 'inline');
$("#productunitedit"+lineNo).css('display', 'inline');
$("#productnoofpacksupdate"+lineNo).css('display', 'none');
$("#productunitupdate"+lineNo).css('display', 'none');
$("#productprodiscountval"+lineNo).html(obj[0].salediscount+'(<span style="color:green !important;"><span style="color:green !important;margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+<?=$row['productvalue']?>+' - '+'<span style="color:green !important;margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+obj[0].salediscount+'</span>)');
$("#productprodiscountval"+lineNo).css('display', 'inline');
$("#prodiscount"+lineNo).val(obj[0].salediscount);
$("#prodiscount"+lineNo).css('display', 'none');
$("#productprodiscountspan"+lineNo).css('display', 'inline-block');
$("#productprodiscountedit"+lineNo).css('display', 'inline');
$("#productprodiscountupdate"+lineNo).css('display', 'none');
$("#productvatval"+lineNo).html(obj[0].tax+'%');
$("#productvatval"+lineNo).css('display', 'inline');
$("#vat"+lineNo).val(obj[0].tax);
$("#vat"+lineNo).css('display', 'none');
$("#productvatspan"+lineNo).css('display', 'inline-block');
$("#productvatedit"+lineNo).css('display', 'inline');
$("#productvatupdate"+lineNo).css('display', 'none');
});
}
});
$("#product"+lineNo).on("select2:open", function() {
document.getElementById("ppp").value = lineNo;
});
var productid= $('#product'+lineNo).val();
$.get("batchsearch.php", {term: productid} , function(datas){
console.log("normal"+datas);
$("#errbatch"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
brrch = document.getElementById("errbatch"+lineNo);
if (brrch.value.includes(letters)) {
$("#outfordone"+lineNo).html("");
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
for (var key in objbatch) {
  console.log("key"+key);
  check+="<div id='option"+lineNo+objbatch[key].batch+"' style='border:1px solid #cccccc;'><table width='100%'><tr style='border-bottom:none;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#outfordone"+lineNo).html(check);
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
var productid= $('#product'+lineNo).val();
var customerid = $("#customer").val();
$.get("ratesearch.php", {term: productid,custid: customerid} , function(datas){
console.log("normal"+datas);
$("#errrate"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $ratedatas in";
brrch = document.getElementById("errrate"+lineNo);
if (brrch.value.includes(letters)||brrch.value=='') {
$("#ratelist"+lineNo).html("");
var browsers = document.getElementById("ratelist"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
for (var key in objbatch) {
  console.log("key"+key);
  check+="<div id='option"+lineNo+objbatch[key].invoiceno+"inv' style='border:1px solid #cccccc;'><table width='100%'><tr style='border-bottom:none;'><td align='left' id='invno"+objbatch[key].invoiceno+"inv' style='border:none;'>Invoice No : "+objbatch[key].invoiceno+" </td><td align='right' id='invdt"+objbatch[key].invoiceno+"inv' style='border:none;'>Invoice Date : "+objbatch[key].invoicedate+" </td></tr><tr style='border-bottom:none;'><td align='left' id='rate"+objbatch[key].productrate+"inv' style='border:none;'>Product Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#ratelist"+lineNo).html(check);
var browsers = document.getElementById("ratelist"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
}
proautocomp(1);
function addnewrow(lineNo)
{
var y=0;
var productvalues = document.getElementsByName('productvalue[]');
for (var i = 0; i < productvalues.length; i++)
{
if(productvalues[i].value=='')
{
y++;
}
}
if(y==0)
{
markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td class="tdmove"><svg version="1.1" id="Layer_'+lineNo+'" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="ITEM DETAILS" style="padding-top: 1px !important;"><input type="hidden" name="productid[]" id="productid'+lineNo+'"><input type="hidden" name="productname[]" id="productname'+lineNo+'"><div class="col-sm-9" onclick="andus()" style="width:300px;display: inline-block;" id="selecttheproduct"><select class="form-control  form-control-sm product proitemselect product1 proselect2" name="product[]" id="product'+lineNo+'"  onChange="productchange('+lineNo+')"><option value="0" selected disabled>Select</option></select></div><span class="badge" style="display:none; width:75px; padding:3px; margin:5px 0; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan'+lineNo+'"></span><br><input type="hidden" name="itemmodule[]" id="itemmodule'+lineNo+'"><div <?=(in_array('Product Category', $fieldedit))?'':'style="display:none !important;"'?>><span id="productmanufacturerspan'+lineNo+'" style="display:none; font-size:11px;"><?=$access['txtnamecategory']?>:<input type="text" name="manufacturer[]" id="manufacturer'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;border: 1px solid #eee !important;" readonly> <span id="productmrpval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span> <span id="productmanufacturerval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productmanufactureredit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmanufacturerupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer('+lineNo+')"><i class="fa fa-save"></i></span></div><span id="producthsncodespan'+lineNo+'" style="display:none; font-size:11px;">HSN Code:</span><input type="text" name="producthsn[]" id="producthsn'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;border: 1px solid #eee !important;"> <span id="producthsncodeval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="producthsncodeedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode('+lineNo+')"><i class="fa fa-edit"></i></span><span id="producthsncodeupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode('+lineNo+')"><i class="fa fa-save"></i></span><span <?=(in_array('Product Description', $fieldedit))?'':'style="display:none !important;"'?>><span id="productdescriptionspan'+lineNo+'" style="display:none; font-size:11px;">Description:</span><textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription'+lineNo+'" style="height:50px; display:none; border:1px solid #eee !important;width: 146px !important;"></textarea></span></td><td style="display:none"><input type="text" name="productnotes[]" id="productnotes'+lineNo+'" class="form-control form-control-sm proitemselect bordernoneinput"></td><td data-label="BATCH" <?=(in_array('Batch', $fieldedit))?'':'style="display:none;"'?>><div><input type="text" name="batch[]" id="batch'+lineNo+'" onClick="batchget('+lineNo+');" onFocus="batchget('+lineNo+');"  class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;font-size:16px !important;display:inline;" list="" autocomplete="off"><div id="outfordone'+lineNo+'" class="dvi" style="display:none;"></div><input type="text" id="errbatch'+lineNo+'" style="display:none;"></div><span id="productexpdatespan'+lineNo+'" style="display:none; font-size:11px;">EXPIRY:</span><input type="date" name="expdate[]" id="expdate'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;"> <span id="productexpdateval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productexpdateedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productexpdateupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate('+lineNo+')"><i class="fa fa-save"></i></span></td><td data-label="RATE"><div><span style="font-size:15px !important;padding-right:3px !important;"><?php echo $rescurrency[0]; ?></span><input type="number" min="0" step="0.01" name="productrate[]"    id="productrate'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth productselectadd" onChange="productcalc('+lineNo+')" onClick="rateget('+lineNo+');" onFocus="rateget('+lineNo+');" style="border: 1px solid #eee !important;margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;font-size:16px !important;float:right;width:146px;"></div><div <?=(in_array('Product Mrp', $fieldedit))?'':'style="display:none !important;"'?>><span id="productmrpspan'+lineNo+'" style="display:none; font-size:11px;">MRP:<input type="number" name="mrp[]" id="mrp'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;border: 1px solid #eee !important;" min="0" step="0.01"> <span id="productmrpval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productmrpedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmrpupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp('+lineNo+')"><i class="fa fa-save"></i></span></span></div><div id="ratelist'+lineNo+'" class="dvi" style="display:none;"></div><input type="text" id="errrate'+lineNo+'" style="display:none;"></td><td data-label="QUANTITY"><div><input type="number" min="0" step="0.01" name="quantity[]"  id="quantity'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth" onChange="productcalc('+lineNo+')" style="margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;font-size:16px !important;display:inline;"></div><div><span id="productunitspan'+lineNo+'" style="display:none; font-size:11px;">UNIT:</span><input type="text" name="productunit[]" id="productunit'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;"><span id="productunitval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productunitedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editunit('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productunitupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit('+lineNo+')"><i class="fa fa-save"></i></span></div><span id="productnoofpacksspan'+lineNo+'" style="display:none; font-size:11px;">PACK:</span><input type="text" name="noofpacks[]" id="noofpacks'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;"> <span id="productnoofpacksval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productnoofpacksedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productnoofpacksupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks('+lineNo+')"><i class="fa fa-save"></i></span></td><td data-label="TAXABLE VALUE" <?=(in_array('Taxable Value', $fieldedit))?'':'style="display:none;"'?>> <div id="ruppeitemtablemobdfs"><span style="font-size:15px !important;padding-right:3px !important;"><?php echo $rescurrency[0]; ?></span><input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="background:none;margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div><span id="productprodiscountspan'+lineNo+'" style="display:none; font-size:11px;">DISCOUNT:</span><div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect'+lineNo+'"> <div class="input-group-prepend"> <input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> </div><select name="prodiscounttype" id="prodiscounttype'+lineNo+'" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 1.5px !important;"><option value="0">%</option><option value="1"><?php echo $rescurrency[0]; ?></option></select> </div> <span id="productprodiscountval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productprodiscountedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productprodiscountupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount('+lineNo+')"><i class="fa fa-save"></i></span></td><td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldedit))?'':'style="display:none;"'?>><div id="ruppeitemtablemobasdf"><span style="font-size:15px !important;padding-right:3px !important;"><?php echo $rescurrency[0]; ?></span><input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="background:none;margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div><span id="productvatspan'+lineNo+'" style="display:none; font-size:11px;">GST:<input type="number" min="0" step="0.01" name="vat[]" id="vat'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productvatedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editvat('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productvatupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat('+lineNo+')"><i class="fa fa-save"></i></span></span><span id="productcgstvatspan'+lineNo+'" style="display:none; font-size:11px;">CGST:</span><span id="productcgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productsgstvatspan'+lineNo+'" style="display:none; font-size:11px;">SGST:</span><span id="productsgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productigstvatspan'+lineNo+'" style="display:none; font-size:11px;">IGST:</span><span id="productigstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span></td><td data-label="AMOUNT"><div id="ruppeitemtablemobasdf"><span style="font-size:15px !important;padding-right:3px !important;"><?php echo $rescurrency[0]; ?></span><input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="background:none;margin-bottom: 3px !important;border: 1px solid #eee !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div></td><td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#purchasetable");
tableBody.append(markup);
function template(data) {
  return data.html;
}

$('#product'+lineNo).select2({
                width: '100%',
                ajax: {
                    url: "inlistprosearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
var productid= $('#product'+lineNo).val();
$.get("batchsearch.php", {term: productid} , function(datas){
console.log("normal"+datas);
$("#errbatch"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
brrch = document.getElementById("errbatch"+lineNo);
if (brrch.value.includes(letters)) {
$("#outfordone"+lineNo).html("");
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
for (var key in objbatch) {
  console.log("key"+key);
  check+="<div id='option"+lineNo+objbatch[key].batch+"' style='border:1px solid #cccccc;'><table width='100%'><tr style='border-bottom:none;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#outfordone"+lineNo).html(check);
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
var productid= $('#product'+lineNo).val();
var customerid = $("#customer").val();
$.get("ratesearch.php", {term: productid,custid: customerid} , function(datas){
console.log("normal"+datas);
$("#errrate"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $ratedatas in";
brrch = document.getElementById("errrate"+lineNo);
if (brrch.value.includes(letters)||brrch.value=='') {
$("#ratelist"+lineNo).html("");
var browsers = document.getElementById("ratelist"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
for (var key in objbatch) {
  console.log("key"+key);
  check+="<div id='option"+lineNo+objbatch[key].invoiceno+"inv' style='border:1px solid #cccccc;'><table width='100%'><tr style='border-bottom:none;'><td align='left' id='invno"+objbatch[key].invoiceno+"inv' style='border:none;'>Invoice No : "+objbatch[key].invoiceno+" </td><td align='right' id='invdt"+objbatch[key].invoiceno+"inv' style='border:none;'>Invoice Date : "+objbatch[key].invoicedate+" </td></tr><tr style='border-bottom:none;'><td align='left' id='rate"+objbatch[key].productrate+"inv' style='border:none;'>Product Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#ratelist"+lineNo).html(check);
var browsers = document.getElementById("ratelist"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
$("#product"+lineNo).on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewProduct");
$("#configureunits").show();
});
$("#product"+lineNo).on("select2:open", function() {
<?php
if($access['estnewproductdef']=='1'){
?>
$("#configureunits").show();
document.getElementById("configureunits").innerHTML = "New Product";
<?php
}
else{
?>
$("#configureunits").hide();
<?php
}
?>
});
proautocomp(lineNo);
renumber_table('#purchasetable');
}
}
</script>
<script type="text/javascript">
$(document).ready(function() {
//Helper function to keep table row from collapsing when being sorted
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index)
{
$(this).width($originals.eq(index).width())
});
return $helper;
};
//Make diagnosis table sortable
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: function(event,ui) {renumber_table('#purchasetable')}
}).disableSelection();
//Delete button in table rows
$('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchasetable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
alert('Unable to Delete First row');
}
});
});
//Renumber  table rows
function renumber_table(tableID) {
$(tableID + " tr").each(function() {
count = $(this).parent().children().index($(this)) + 1;
$(this).find('.priority').html(count);
});
}
</script>
<script type="text/javascript">
$(function() {
/* $("#productname1").autocomplete({
source: 'prosearch.php',
select: function(event, ui) {
$("#productid1").val(ui.item.id);
$("#productname1").val(ui.item.productname);
$("#productnotes1").val(ui.item.description);
$("#productdescription1").val(ui.item.description);
$("#productdescription1").css('display', 'block');
$("#productdescriptionspan1").css('display', 'block');
$("#itemmodule1").html(ui.item.itemmodule);
$("#itemmodule1").css('display', 'block');
$("#producthsn1").val(ui.item.hsncode);
$("#mrp1").val(ui.item.salemrp);
$("#vat1").val(ui.item.tax);
$("#productrate1").val(ui.item.salecost);
$("#prodiscount1").val(ui.item.salediscount);
$("#productmanufacturerval1").html(ui.item.manufacturer);
$("#productmanufacturerval1").css('display', 'inline');
$("#manufacturer1").val(ui.item.manufacturer);
$("#manufacturer1").css('display', 'none');
$("#productmanufacturerspan1").css('display', 'inline');
$("#productmanufactureredit1").css('display', 'inline');
$("#productmanufacturerupdate1").css('display', 'none');
$("#producthsncodeval1").html(ui.item.hsncode);
$("#producthsncodeval1").css('display', 'inline');
$("#producthsn1").val(ui.item.hsncode);
$("#producthsn1").css('display', 'none');
$("#producthsncodespan1").css('display', 'inline');
$("#producthsncodeedit1").css('display', 'inline');
$("#producthsncodeupdate1").css('display', 'none');
//$("#productexpdateval1").html(ui.item.expdate);
$("#productexpdateval1").css('display', 'inline');
//$("#expdate1").val(ui.item.expdate);
$("#expdate1").css('display', 'none');
$("#productexpdatespan1").css('display', 'inline');
$("#productexpdateedit1").css('display', 'inline');
$("#productexpdateupdate1").css('display', 'none');
$("#productmrpval1").html(ui.item.mrp);
$("#productmrpval1").css('display', 'inline');
$("#mrp1").val(ui.item.mrp);
$("#mrp1").css('display', 'none');
$("#productmrpspan1").css('display', 'inline');
$("#productmrpedit1").css('display', 'inline');
$("#productmrpupdate1").css('display', 'none');
$("#productnoofpacksval1").html(ui.item.noofpacks);
$("#productnoofpacksval1").css('display', 'inline');
$("#noofpacks1").val(ui.item.noofpacks);
$("#noofpacks1").css('display', 'none');
$("#productnoofpacksspan1").css('display', 'inline');
$("#productnoofpacksedit1").css('display', 'inline');
$("#productnoofpacksupdate1").css('display', 'none');
$("#productprodiscountval1").html(ui.item.salediscount);
$("#productprodiscountval1").css('display', 'inline');
$("#prodiscount1").val(ui.item.salediscount);
$("#prodiscount1").css('display', 'none');
$("#productprodiscountspan1").css('display', 'inline');
$("#productprodiscountedit1").css('display', 'inline');
$("#productprodiscountupdate1").css('display', 'none');
$("#productvatval1").html(ui.item.tax);
$("#productvatval1").css('display', 'inline');
$("#vat1").val(ui.item.tax);
$("#vat1").css('display', 'none');
$("#productvatspan1").css('display', 'inline');
$("#productvatedit1").css('display', 'inline');
$("#productvatupdate1").css('display', 'none');
},
minLength: 2
}).data("ui-autocomplete")._renderItem = function(ui, item) {
return $("<li class='ui-autocomplete-row'></li>")
.data("item.autocomplete", item)
.append(item.label)
.appendTo(ui);
}; */
/*  $( "#customername" ).autocomplete({
source: 'customersearch.php', select: function (event, ui) { $("#area").val(ui.item.address); $("#city").val(ui.item.city); $("#district").val(ui.item.country); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pin); $( "#productname1" ).focus();}, minLength: 1
}); */
$( "#area" ).autocomplete({
source: 'areasearch.php', select: function (event, ui) { $("#area").val(ui.item.area); $("#city").val(ui.item.city); $("#district").val(ui.item.district); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pincode);}, minLength: 2
});
$( "#email" ).autocomplete({
source: 'franchisesearch.php?type=email',
});
});
</script>
<script>
function editmanufacturer(id)
{
$("#productmanufacturerval"+id).css('display', 'none');
$("#manufacturer"+id).css('display', 'inline');
$("#productmanufacturerspan"+id).css('display', 'inline');
$("#productmanufactureredit"+id).css('display', 'none');
$("#productmanufacturerupdate"+id).css('display', 'inline');
}
function changemanufacturer(id)
{
$("#productmanufacturerval"+id).html($("#manufacturer"+id).val());
$("#productmanufacturerval"+id).css('display', 'inline');
$("#manufacturer"+id).css('display', 'none');
$("#productmanufacturerspan"+id).css('display', 'inline');
$("#productmanufactureredit"+id).css('display', 'inline');
$("#productmanufacturerupdate"+id).css('display', 'none');
}
</script>
<script>
function edithsncode(id)
{
$("#producthsncodeval"+id).css('display', 'none');
$("#producthsn"+id).css('display', 'inline');
$("#producthsncodespan"+id).css('display', 'inline');
$("#producthsncodeedit"+id).css('display', 'none');
$("#producthsncodeupdate"+id).css('display', 'inline');
}
function changehsncode(id)
{
$("#producthsncodeval"+id).html($("#producthsn"+id).val());
$("#producthsncodeval"+id).css('display', 'inline');
$("#producthsn"+id).css('display', 'none');
$("#producthsncodespan"+id).css('display', 'inline');
$("#producthsncodeedit"+id).css('display', 'inline');
$("#producthsncodeupdate"+id).css('display', 'none');
}
</script>
<script>
function editexpdate(id)
{
$("#productexpdateval"+id).css('display', 'none');
$("#expdate"+id).css('display', 'inline');
$("#productexpdatespan"+id).css('display', 'inline');
$("#productexpdateedit"+id).css('display', 'none');
$("#productexpdateupdate"+id).css('display', 'inline');
}
function changeexpdate(id)
{
$("#productexpdateval"+id).html($("#expdate"+id).val());
$("#productexpdateval"+id).css('display', 'inline');
$("#expdate"+id).css('display', 'none');
$("#productexpdatespan"+id).css('display', 'inline');
$("#productexpdateedit"+id).css('display', 'inline');
$("#productexpdateupdate"+id).css('display', 'none');
}
</script>
<script>
function editmrp(id)
{
$("#productmrpval"+id).css('display', 'none');
$("#mrp"+id).css('display', 'inline');
$("#productmrpspan"+id).css('display', 'inline-block');
$("#productmrpedit"+id).css('display', 'none');
$("#productmrpupdate"+id).css('display', 'inline');
}
function changemrp(id)
{
$("#productmrpval"+id).html('<span style="margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+$("#mrp"+id).val());
$("#productmrpval"+id).css('display', 'inline');
$("#mrp"+id).css('display', 'none');
$("#productmrpspan"+id).css('display', 'inline-block');
$("#productmrpedit"+id).css('display', 'inline');
$("#productmrpupdate"+id).css('display', 'none');
}
</script>
<script>
function editunit(id)
{
$("#productunitval"+id).css('display', 'none');
$("#productunit"+id).css('display', 'inline');
$("#productunitspan"+id).css('display', 'inline');
$("#productunitedit"+id).css('display', 'none');
$("#productunitupdate"+id).css('display', 'inline');
}
function changeunit(id)
{
$("#productunitval"+id).html($("#productunit"+id).val());
$("#productunitval"+id).css('display', 'inline');
$("#productunit"+id).css('display', 'none');
$("#productunitspan"+id).css('display', 'inline');
$("#productunitedit"+id).css('display', 'inline');
$("#productunitupdate"+id).css('display', 'none');
}
</script>
<script>
function editnoofpacks(id)
{
$("#productnoofpacksval"+id).css('display', 'none');
$("#noofpacks"+id).css('display', 'inline');
$("#productnoofpacksspan"+id).css('display', 'inline');
$("#productnoofpacksedit"+id).css('display', 'none');
$("#productnoofpacksupdate"+id).css('display', 'inline');
}
function changenoofpacks(id)
{
$("#productnoofpacksval"+id).html($("#noofpacks"+id).val());
$("#productnoofpacksval"+id).css('display', 'inline');
$("#noofpacks"+id).css('display', 'none');
$("#productnoofpacksspan"+id).css('display', 'inline');
$("#productnoofpacksedit"+id).css('display', 'inline');
$("#productnoofpacksupdate"+id).css('display', 'none');
}
</script>
<script>
function editprodiscount(id)
{
$("#productprodiscountval"+id).css('display', 'none');
$("#prodiscount"+id).css('display', 'inline');
$("#prodiscounttype"+id).css('display', 'inline');
$("#discountselect"+id).css('display', 'inline-flex');
$("#productprodiscountspan"+id).css('display', 'inline-block');
$("#productprodiscountedit"+id).css('display', 'none');
$("#productprodiscountupdate"+id).css('display', 'inline');
}
function changeprodiscount(id)
{
    var discountvalue = $("#prodiscount"+id).val();
$("#productprodiscountval"+id).html($("#prodiscount"+id).val()+'(<span style="color:green !important;"><span style="color:green !important;margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+$("#productvalue"+id).val()+' - '+'<span style="color:green !important;margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+(Math.round(discountvalue).toFixed(2))+'</span>)');
$("#productprodiscountval"+id).css('display', 'inline');
$("#prodiscount"+id).css('display', 'none');
$("#prodiscounttype"+id).css('display', 'none');
$("#discountselect"+id).css('display', 'none');
$("#productprodiscountspan"+id).css('display', 'inline-block');
$("#productprodiscountedit"+id).css('display', 'inline');
$("#productprodiscountupdate"+id).css('display', 'none');
}
</script>
<script>
function editvat(id)
{
$("#productvatval"+id).css('display', 'none');
$("#vat"+id).css('display', 'inline');
$("#productvatspan"+id).css('display', 'inline-block');
$("#productvatedit"+id).css('display', 'none');
$("#productvatupdate"+id).css('display', 'inline');
}
function changevat(id)
{
$("#productvatval"+id).html($("#vat"+id).val()+'%');
$("#productvatval"+id).css('display', 'inline');
$("#vat"+id).css('display', 'none');
$("#productvatspan"+id).css('display', 'inline-block');
$("#productvatedit"+id).css('display', 'inline');
$("#productvatupdate"+id).css('display', 'none');
}
</script>
<script>
function isEmpty(object) {
for (const property in object) {
return false;
}
return true;
}
$(document).ready(function(){
$('#customer').change(function(){
$('#custaddressdiv').css("display", "none");
var id= $('#customer').val();
if(id != '')
{
$.get("customersearch1.php", {term: id} , function(data){
console.log(data);
const obj = JSON.parse(data);
if(isEmpty(obj)==false)
{
$('#custaddressdiv').css("display", "flex");
}
else
{
$('#custaddressdiv').css("display", "none");
}
console.log(obj[0]);
<?php
$sqlismainaccessfieldcusview=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customers' order by id  asc");
while($infomainaccessfieldcusview=mysqli_fetch_array($sqlismainaccessfieldcusview)){
$coltype = preg_replace('/\s+/', '', $infomainaccessfieldcusview['moduletype']);
$addcusview = $infomainaccessfieldcusview[21];
$fieldaddcusview = explode(',',$addcusview);
$editcusview = $infomainaccessfieldcusview[22];
$fieldeditcusview = explode(',',$editcusview);
$viewcusview = $infomainaccessfieldcusview[23];
$fieldviewcusview = explode(',',$viewcusview);
}
?>
<?php
if ((in_array('Customer Information', $fieldviewcusview))) {
?>
<?php
if ((in_array('Customer Id', $fieldviewcusview))) {
?>
document.getElementById("custviewid").innerHTML=obj[0].id;
<?php
}
?>
<?php
if ((in_array('Customer Public Id', $fieldviewcusview))) {
?>
document.getElementById("custviewpublicid").innerHTML=obj[0].publicid;
<?php
 }
?>
<?php
if ((in_array('Customer Private Id', $fieldviewcusview))) {
?>
document.getElementById("custviewprivateid").innerHTML=obj[0].privateid;
<?php
 }
?>
<?php
if ((in_array('Primary Contact', $fieldviewcusview))) {
?>
document.getElementById("custviewpsalutation").innerHTML=obj[0].primarysalutation;
document.getElementById("custviewpcontact").innerHTML=obj[0].primarycontact;
<?php
}
?>
<?php
if ((in_array('Company Name', $fieldviewcusview))) {
?>
document.getElementById("custviewcname").innerHTML=obj[0].companyname;
<?php
}
?>
<?php
// if ((in_array('Customer Display Name', $fieldviewcusview))) {
?>
document.getElementById("custviewname").innerHTML=obj[0].customername;
<?php
// }
?>
<?php
if ((in_array('Category', $fieldviewcusview))) {
?>
document.getElementById("custviewcat").innerHTML=obj[0].category;
<?php
}
?>
<?php
if ((in_array('Sub Category', $fieldviewcusview))) {
?>
document.getElementById("custviewsubcat").innerHTML=obj[0].subcategory;
<?php
}
?>
<?php
if ((in_array('Work Phone', $fieldviewcusview))) {
?>
document.getElementById("custviewwork").innerHTML=obj[0].workphone;
<?php
}
?>
<?php
if ((in_array('Mobile Phone', $fieldviewcusview))) {
?>
document.getElementById("custviewmobile").innerHTML=obj[0].mobile;
<?php
}
?>
<?php
if ((in_array('Email', $fieldviewcusview))) {
?>
document.getElementById("custviewemail").innerHTML=obj[0].email;
<?php
}
?>
<?php
if ((in_array('Website', $fieldviewcusview))) {
?>
document.getElementById("custviewweb").innerHTML=obj[0].website;
<?php
}
?>
<?php
if ((in_array('Billing Address', $fieldviewcusview))) {
?>
document.getElementById("custviewbstreet").innerHTML=obj[0].address;
document.getElementById("custviewbcity").innerHTML=obj[0].city;
document.getElementById("custviewbstate").innerHTML=obj[0].state;
document.getElementById("custviewbpincode").innerHTML=obj[0].pin;
document.getElementById("custviewbcountry").innerHTML=obj[0].country;
<?php
}
?>
<?php
if ((in_array('Shipping Address', $fieldviewcusview))) {
?>
document.getElementById("custviewsstreet").innerHTML=obj[0].saddress;
document.getElementById("custviewscity").innerHTML=obj[0].scity;
document.getElementById("custviewsstate").innerHTML=obj[0].sstate;
document.getElementById("custviewspincode").innerHTML=obj[0].spin;
document.getElementById("custviewscountry").innerHTML=obj[0].scountry;
<?php
}
?>
<?php
}
?>
<?php
if ((in_array('Customers Visibility', $fieldviewcusview))) {
?>
(obj[0].cvisiblity=='PUBLIC'?document.getElementById("custviewvisibility").checked=true:document.getElementById("custviewnovisibility").checked=true);
<?php
}
?>
<?php
if ((in_array('Tax Information', $fieldviewcusview))) {
?>
<?php
if ((in_array('Tax Preference', $fieldviewcusview))) {
?>
(obj[0].custaxprefer=='0'?document.getElementById("custviewtaxprefer").checked=true:document.getElementById("custviewtaxpreferno").checked=true);
<?php
}
?>
<?php
if ((in_array('GST Registration Type', $fieldviewcusview))) {
?>
(obj[0].custaxprefer=='0'?document.getElementById("custviewgstrtypesh").style.display='block':document.getElementById("custviewgstrtypesh").style.display='none');
if (obj[0].gstrtype!='') {
if((obj[0].gstrtype=='Registered Business - Regular'||obj[0].gstrtype=='Registered Business - Composition'||obj[0].gstrtype=='Special Economic Zone'||obj[0].gstrtype=='Deemed Export'||obj[0].gstrtype=='Tax Deductor'||obj[0].gstrtype=='SEZ Developer')&&(obj[0].gstrtype!='Unregistered Business'||obj[0].gstrtype!='Consumer'||obj[0].gstrtype!='Overseas'))
{
document.getElementById("custviewgstrtype").innerHTML=obj[0].gstrtype;
<?php
if ((in_array('GSTIN or UIN', $fieldviewcusview))) {
?>
document.getElementById("custviewgstin").innerHTML=obj[0].gstin;
<?php
}
?>
<?php
if ((in_array('Business Legal Name', $fieldviewcusview))) {
?>
document.getElementById("custviewbuslegname").innerHTML=obj[0].buslegname;
<?php
}
?>
<?php
if ((in_array('Business Trade Name', $fieldviewcusview))) {
?>
document.getElementById("custviewbustrdname").innerHTML=obj[0].bustrdname;
<?php
}
?>
}
}
<?php
}
?>
<?php
if ((in_array('Pan', $fieldviewcusview))) {
?>
document.getElementById("custviewpan").innerHTML=obj[0].pan;
<?php
}
?>
<?php
if ((in_array('Place Of Supply', $fieldviewcusview))) {
?>
(obj[0].gstrtype!='Overseas'?document.getElementById("custviewposdiv").style.display='block':document.getElementById("custviewposdiv").style.display='none');
if(obj[0].gstrtype!='Overseas'){
document.getElementById("custviewpos").innerHTML=obj[0].placeos;
}
<?php
}
?>
<?php
}
?>
$("#customername").val(obj[0].customername);
$("#customerid").val(obj[0].id);
$("#billstreet").val(obj[0].address);
$("#billcity").val(obj[0].city);
$("#billcountry").val(obj[0].country);
$("#billstate").val(obj[0].state);
$("#billpincode").val(obj[0].pin);
$("#gstgstin").val(obj[0].gstin);
$("#gstgstrtype").val(obj[0].gstrtype);
$("#workworkphone").val(obj[0].workphone);
$("#workmobile").val(obj[0].mobile);
$("#shipstreet").val(obj[0].saddress);
$("#shipcity").val(obj[0].scity);
$("#shipcountry").val(obj[0].scountry);
$("#shipstate").val(obj[0].sstate);
$("#shippincode").val(obj[0].spin);
$("#pos").val(obj[0].pos);
$("#propos").val(obj[0].pos);
$("#proposfinal").val(obj[0].pos);
//$( "#productname1" ).focus();
var ase=obj[0].address+' '+obj[0].city+' '+obj[0].state+' '+obj[0].pin+' '+obj[0].country+'';
ase=ase.trim();
var ase1=obj[0].saddress+' '+obj[0].scity+' '+obj[0].sstate+' '+obj[0].spin+' '+obj[0].scountry+'';
ase1=ase1.trim();
var ase2=obj[0].gstrtype+' '+obj[0].gstin+'';
ase2=ase2.trim();
var ase3=obj[0].workphone+'';
ase3=ase3.trim();
var ase4=obj[0].mobile+'';
ase4=ase4.trim();
if(ase=="")
{
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
}
else
{
ase='<div id="firstadd">'+obj[0].address+' '+obj[0].city+'</div> <div id="secadd">'+obj[0].state+' '+obj[0].pin+' '+obj[0].country+'</div>';
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:12px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
if(ase1=="")
{
$("#shippingaddressdiv").html(ase1);
$("#shippingaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
}
else
{
ase1='<div id="firstadd">'+obj[0].saddress+' '+obj[0].scity+'</div> <div id="secadd">'+obj[0].sstate+' '+obj[0].spin+' '+obj[0].scountry+'</div>';
$("#shippingaddressdiv").html(ase1);
$("#shippingaddressspan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:12px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
if(ase2=="")
{
$("#gstrtypediv").html(ase2);
$("#gsttypespan").html('<div style="margin-top:-4.5px !important;"> Add New GSTIN </div>');
}
else
{
if(obj[0].gstrtype=="Registered Business - Regular"||obj[0].gstrtype=="Registered Business - Composition"||obj[0].gstrtype=="Special Economic Zone"||obj[0].gstrtype=="Deemed Export"||obj[0].gstrtype=="Tax Deductor"||obj[0].gstrtype=="SEZ Developer")
{
ase2='<div id="gstfirstline">'+obj[0].gstrtype+'</div> <div id="gstsecondline"> GSTIN:'+obj[0].gstin+'</div>';
}
else{
    ase2='<div id="gstfirstline">'+obj[0].gstrtype+'</div>';
}
$("#gstrtypediv").html(ase2);
$("#gsttypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
if(ase3=="")
{
$("#workphonediv").html(ase3);
$("#worktypespan").html('<div style="margin-top:-4.5px !important;"> Add New Phone </div>');
}
else
{
ase3='<div id="workphoneline">'+obj[0].workphone+'</div>';
$("#workphonediv").html(ase3);
$("#worktypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
if(ase4=="")
{
$("#mobilephonediv").html(ase4);
$("#mobiletypespan").html('<div style="margin-top:-4.5px !important;"> Add New Phone </div>');
}
else
{
ase4='<div id="mobilephoneline">'+obj[0].mobile+'</div>';
$("#mobilephonediv").html(ase4);
$("#mobiletypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
}
});
}
else
{
alert("Please Select <?= $infomainaccessusercus['modulename'] ?>");
$('#custaddressdiv').css("display", "none");
}
});

//////////////////////

});
</script>
<script>
function productchange(lineNo)
{
var id= $('#product'+lineNo).val();
if(id != '')
{
$.get("prosearch1.php", {term: id} , function(data){
console.log(data);
const obj = JSON.parse(data);
console.log(obj[0]);
$("#productid"+lineNo).val(obj[0].id);
$("#productname"+lineNo).val(obj[0].productname);
$("#productnotes"+lineNo).val(obj[0].description);
$("#productdescription"+lineNo).val(obj[0].description);
$("#productdescription"+lineNo).css('display', 'inline');
$("#productdescriptionspan"+lineNo).css('display', 'block');
$("#itemmodulespan"+lineNo).html(obj[0].itemmodule);
$("#itemmodule"+lineNo).val(obj[0].itemmodule);
$("#itemmodulespan"+lineNo).css('display', 'inline');
$("#producthsn"+lineNo).val(obj[0].hsncode);
$("#mrp"+lineNo).val(obj[0].salemrp);
$("#vat"+lineNo).val(obj[0].tax);
$("#productrate"+lineNo).val(obj[0].salecost);
$("#prodiscount"+lineNo).val(obj[0].salediscount);
$("#productmanufacturerval"+lineNo).html(obj[0].category);
$("#productmanufacturerval"+lineNo).css('display', 'inline');
$("#manufacturer"+lineNo).val(obj[0].category);
$("#manufacturer"+lineNo).css('display', 'none');
$("#productmanufacturerspan"+lineNo).css('display', 'inline');
$("#productmanufactureredit"+lineNo).css('display', 'inline');
$("#productmanufacturerupdate"+lineNo).css('display', 'none');
$("#producthsncodeval"+lineNo).html(obj[0].hsncode);
$("#producthsncodeval"+lineNo).css('display', 'inline');
$("#producthsn"+lineNo).val(obj[0].hsncode);
$("#producthsn"+lineNo).css('display', 'none');
$("#producthsncodespan"+lineNo).css('display', 'inline');
$("#producthsncodeedit"+lineNo).css('display', 'inline');
$("#producthsncodeupdate"+lineNo).css('display', 'none');
//$("#productexpdateval"+lineNo).html(obj[0].expdate);
$("#productexpdateval"+lineNo).css('display', 'inline');
//$("#expdate"+lineNo).val(obj[0].expdate);
$("#expdate"+lineNo).css('display', 'none');
$("#productexpdatespan"+lineNo).css('display', 'inline');
$("#productexpdateedit"+lineNo).css('display', 'inline');
$("#productexpdateupdate"+lineNo).css('display', 'none');
$("#productmrpval"+lineNo).html(obj[0].mrp);
$("#productmrpval"+lineNo).css('display', 'inline');
$("#mrp"+lineNo).val(obj[0].mrp);
$("#mrp"+lineNo).css('display', 'none');
$("#productmrpspan"+lineNo).css('display', 'inline-block');
$("#productmrpedit"+lineNo).css('display', 'inline');
$("#productmrpupdate"+lineNo).css('display', 'none');
$("#productnoofpacksval"+lineNo).html(obj[0].noofpacks);
$("#productnoofpacksval"+lineNo).css('display', 'inline');
$("#productunitval"+lineNo).html(obj[0].defaultunit);
$("#productunitval"+lineNo).css('display', 'inline');
$("#noofpacks"+lineNo).val(obj[0].noofpacks);
$("#noofpacks"+lineNo).css('display', 'none');
$("#productunit"+lineNo).css('display', 'none');
$("#productunit"+lineNo).val(obj[0].defaultunit);
$("#productnoofpacksspan"+lineNo).css('display', 'inline');
$("#productunitspan"+lineNo).css('display', 'inline');
$("#productnoofpacksedit"+lineNo).css('display', 'inline');
$("#productunitedit"+lineNo).css('display', 'inline');
$("#productnoofpacksupdate"+lineNo).css('display', 'none');
$("#productunitupdate"+lineNo).css('display', 'none');
$("#productprodiscountval"+lineNo).html(obj[0].salediscount+'(<span style="color:green !important;"><span style="color:green !important;margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+<?=$row['productvalue']?>+' - '+'<span style="color:green !important;margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+obj[0].salediscount+'</span>)');
$("#productprodiscountval"+lineNo).css('display', 'inline');
$("#prodiscount"+lineNo).val(obj[0].salediscount);
$("#prodiscount"+lineNo).css('display', 'none');
$("#productprodiscountspan"+lineNo).css('display', 'inline-block');
$("#productprodiscountedit"+lineNo).css('display', 'inline');
$("#productprodiscountupdate"+lineNo).css('display', 'none');
$("#productvatval"+lineNo).html(obj[0].tax+'%');
$("#productvatval"+lineNo).css('display', 'inline');
$("#vat"+lineNo).val(obj[0].tax);
$("#vat"+lineNo).css('display', 'none');
$("#productvatspan"+lineNo).css('display', 'inline-block');
$("#productvatedit"+lineNo).css('display', 'inline');
$("#productvatupdate"+lineNo).css('display', 'none');
});
var productid= $('#product'+lineNo).val();
$.get("batchsearch.php", {term: productid} , function(datas){
console.log("normal"+datas);
$("#errbatch"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
brrch = document.getElementById("errbatch"+lineNo);
if (brrch.value.includes(letters)) {
$("#outfordone"+lineNo).html("");
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
for (var key in objbatch) {
  console.log("key"+key);
  check+="<div id='option"+lineNo+objbatch[key].batch+"' style='border:1px solid #cccccc;'><table width='100%'><tr style='border-bottom:none;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#outfordone"+lineNo).html(check);
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
var productid= $('#product'+lineNo).val();
var customerid = $("#customer").val();
$.get("ratesearch.php", {term: productid,custid: customerid} , function(datas){
console.log("normal"+datas);
$("#errrate"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $ratedatas in";
brrch = document.getElementById("errrate"+lineNo);
if (brrch.value.includes(letters)||brrch.value=='') {
$("#ratelist"+lineNo).html("");
var browsers = document.getElementById("ratelist"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
for (var key in objbatch) {
  console.log("key"+key);
  check+="<div id='option"+lineNo+objbatch[key].invoiceno+"inv' style='border:1px solid #cccccc;'><table width='100%'><tr style='border-bottom:none;'><td align='left' id='invno"+objbatch[key].invoiceno+"inv' style='border:none;'>Invoice No : "+objbatch[key].invoiceno+" </td><td align='right' id='invdt"+objbatch[key].invoiceno+"inv' style='border:none;'>Invoice Date : "+objbatch[key].invoicedate+" </td></tr><tr style='border-bottom:none;'><td align='left' id='rate"+objbatch[key].productrate+"inv' style='border:none;'>Product Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#ratelist"+lineNo).html(check);
var browsers = document.getElementById("ratelist"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
}
}
</script>
<script>
function productcalc(id)
{
var quantity = $('#quantity'+id).val();
var productrate = $('#productrate'+id).val();
var prodiscount = $('#prodiscount'+id).val();
if((quantity!='')&&(productrate!='')&&(prodiscount!=''))
{
var productvalue = (parseFloat(quantity)*parseFloat(productrate));
var productdiscount=(parseFloat(prodiscount)/100)*parseFloat(productvalue);
productvalue=productvalue-parseFloat(productdiscount);
$('#productvalue'+id).val(parseFloat(Math.round(productvalue * 100) / 100).toFixed(2));
$('#productvalue'+id).tooltip('hide').attr('data-original-title', parseFloat(Math.round(productvalue * 100) / 100).toFixed(2)).tooltip('show');
var x = document.getElementById("purchasetable").rows.length;
x--;
var totalvat=0;
var totalproductval=0;
var totalproductdiscountval=0;
var productnames = document.getElementsByName('productname[]');
var vats = document.getElementsByName('vat[]');
var productvalues = document.getElementsByName('productvalue[]');
var quantitys = document.getElementsByName('quantity[]');
var totquan=0;
var totitem=0;
for (var i = 0; i < productnames.length; i++)
{
var vat = parseFloat(vats[i].value);
if(!isNaN(vat))
{
var productvalue = parseFloat(productvalues[i].value);
var productvat=(productvalue*(1+(vat/100)));
var taxval=parseFloat(productvat)-parseFloat(productvalue);
var pos=$('#propos').val();
var franpos="<?=$franpos?>";
if(pos=="")
{
pos="TAMIL NADU (33)";
}
if(franpos=="")
{
franpos="TAMIL NADU (33)";
}

if(pos!=franpos)
{
$('#productcgstvatspan'+id).css("display", "none");
$('#productcgstvatval'+id).css("display", "none");
$('#productsgstvatspan'+id).css("display", "none");
$('#productsgstvatval'+id).css("display", "none");
$('#productigstvatspan'+id).css("display", "inline");
$('#productigstvatval'+id).css("display", "inline");
$('#productigstvatspan'+id).html("<br>IGST: ");
$('#productigstvatval'+id).html(""+(parseFloat(vat)+'%')+" ("+'<span style="margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+(parseFloat(Math.round((taxval) * 100) / 100).toFixed(2))+")");
}
else
{
$('#productcgstvatspan'+id).css("display", "inline");
$('#productcgstvatval'+id).css("display", "inline");
$('#productsgstvatspan'+id).css("display", "inline");
$('#productsgstvatval'+id).css("display", "inline");
$('#productigstvatspan'+id).css("display", "none");
$('#productigstvatval'+id).css("display", "none");
$('#productcgstvatspan'+id).html("<br>CGST: ");
$('#productsgstvatspan'+id).html("<br>SGST: ");
$('#productcgstvatval'+id).html(""+(parseFloat(vat)/2+'%')+" ("+'<span style="margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2))+")");
$('#productsgstvatval'+id).html(""+(parseFloat(vat)/2+'%')+" ("+'<span style="margin-right:-3px !important;"><?=$rescurrency[0];?></span>'+(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2))+")");
}
$('#taxvalue'+id).val(parseFloat(Math.round((taxval) * 100) / 100).toFixed(2));
$('#productnetvalue'+id).val(parseFloat(Math.round(productvat * 100) / 100).toFixed(2));
totalproductval+=productvalue;
totalproductdiscountval+=productdiscount;
totalvat+=productvat;
totitem++;
totquan+=parseFloat(quantitys[i].value);
}
}
document.getElementById('totalitems').value=totitem;
document.getElementById('totalquantity').value=totquan;
discount1();
gstcalc();
totalvat=totalvat-totalproductval;
document.getElementById('totalamount').value=parseFloat(Math.round(totalproductval * 100) / 100).toFixed(2);
$('#totalamount').tooltip('hide').attr('data-original-title', parseFloat(Math.round(totalproductval * 100) / 100).toFixed(2)).tooltip('show');
document.getElementById('totalvatamount').value=parseFloat(Math.round(totalvat * 100) / 100).toFixed(2);
addnewrow((productnames.length+1));
var grandtotal;
var totalamount=document.getElementById('totalamount').value;
var totalvatamount=document.getElementById('totalvatamount').value;
var freightamount=document.getElementById('freightamount').value;
var discountamount=document.getElementById('discountamount').value;
grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
grandtotal=grandtotal-parseFloat(discountamount);
var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);
var roundoff=grandtotal1-grandtotal;
document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
RsPaise(parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2));
$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');

}
}
function productcalc1()
{
var grandtotal;
var totalamount=document.getElementById('totalamount').value;
var totalvatamount=document.getElementById('totalvatamount').value;
var freightamount=document.getElementById('freightamount').value;
var discountamount=document.getElementById('discountamount').value;
grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
grandtotal=grandtotal-parseFloat(discountamount);
var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);
var roundoff=grandtotal1-grandtotal;
document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
}
function gstcalc()
{
var totalvat=0;
var totalproductval=0;
var totalproductdiscountval=0;
var cgst25amt=0;
var sgst25amt=0;
var gst25amt=0;
var cgst6amt=0;
var sgst6amt=0;
var gst6amt=0;
var cgst9amt=0;
var sgst9amt=0;
var gst9amt=0;
var cgst14amt=0;
var sgst14amt=0;
var gst14amt=0;
var tax25=0;
var tax6=0;
var tax9=0;
var tax14=0;
var taxtype=document.getElementById('taxtype');
if(taxtype.value!='')
{
var productnames = document.getElementsByName('productname[]');
var vats = document.getElementsByName('vat[]');
var productvalues = document.getElementsByName('productvalue[]');
for (var i = 0; i < productnames.length; i++)
{
var vat = parseFloat(vats[i].value);
if(!isNaN(vat))
{
var productvalue = parseFloat(productvalues[i].value);
var productvat=(productvalue*(1+(vat/100)));
if(vat==5)
{
cgst25amt+=(productvalue*(1+(2.5/100)))-productvalue;
sgst25amt+=(productvalue*(1+(2.5/100)))-productvalue;
gst25amt+=(productvalue*(1+(5/100)))-productvalue;
tax25+=productvalue;
}
if(vat==12)
{
cgst6amt+=(productvalue*(1+(6/100)))-productvalue;
sgst6amt+=(productvalue*(1+(6/100)))-productvalue;
gst6amt+=(productvalue*(1+(12/100)))-productvalue;
tax6+=productvalue;
}
if(vat==18)
{
cgst9amt+=(productvalue*(1+(9/100)))-productvalue;
sgst9amt+=(productvalue*(1+(9/100)))-productvalue;
gst9amt+=(productvalue*(1+(18/100)))-productvalue;
tax9+=productvalue;
}
if(vat==28)
{
cgst14amt+=(productvalue*(1+(14/100)))-productvalue;
sgst14amt+=(productvalue*(1+(14/100)))-productvalue;
gst14amt+=(productvalue*(1+(28/100)))-productvalue;
tax14+=productvalue;
}
}
}
if(taxtype.value=='IntraState')
{
// document.getElementById('gsttablediv').innerHTML='<table class="table table-bordered" id="gsttable" style="font-size:12px;"><tr> <th >Taxable Amount</th><th >SGST %</th><th >Taxable Amount</th><th >CGST %</th> <th >Taxable Amount</th> <th >GST</th><th >Taxable Amount</th> </tr> <tr> <td class="text-center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm" style="width:50px;" readonly ></td><td  data-label="SGST %">2.5%</td><td class="text-center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td  data-label="SGST %">2.5%</td> <td class="text-center"><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >6%</td><td class="text-center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >6%</td> <td class="text-center"><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >9%</td><td class="text-center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >9%</td> <td class="text-center"><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >14%</td> <td class="text-center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >14%</td> <td class="text-center"><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td colspan="6" style="text-align:right; ">Total GST Amount <?php echo $rescurrency[0]; ?></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> </table>';
document.getElementById('cgst25').value=parseFloat(Math.round(cgst25amt * 100) / 100).toFixed(2);
document.getElementById('sgst25').value=parseFloat(Math.round(sgst25amt * 100) / 100).toFixed(2);
document.getElementById('gst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('cgst6').value=parseFloat(Math.round(cgst6amt * 100) / 100).toFixed(2);
document.getElementById('sgst6').value=parseFloat(Math.round(sgst6amt * 100) / 100).toFixed(2);
document.getElementById('gst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('cgst9').value=parseFloat(Math.round(cgst9amt * 100) / 100).toFixed(2);
document.getElementById('sgst9').value=parseFloat(Math.round(sgst9amt * 100) / 100).toFixed(2);
document.getElementById('gst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('cgst14').value=parseFloat(Math.round(cgst14amt * 100) / 100).toFixed(2);
document.getElementById('sgst14').value=parseFloat(Math.round(sgst14amt * 100) / 100).toFixed(2);
document.getElementById('gst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('tax25').value=parseFloat(Math.round(tax25 * 100) / 100).toFixed(2);
document.getElementById('tax6').value=parseFloat(Math.round(tax6 * 100) / 100).toFixed(2);
document.getElementById('tax9').value=parseFloat(Math.round(tax9 * 100) / 100).toFixed(2);
document.getElementById('tax14').value=parseFloat(Math.round(tax14 * 100) / 100).toFixed(2);
document.getElementById('totalvatamount1').value=parseFloat(Math.round((gst25amt+gst6amt+gst9amt+gst14amt) * 100) / 100).toFixed(2);
}
else
{
// document.getElementById('gsttablediv').innerHTML='<table class="table table-bordered" id="gsttable" style="font-size:12px;"><tr> <th >Taxable Amount</th><th >IGST %</th> <th >Taxable Amount</th> <th style="display:none"  >SGST %</th> <th style="display:none"  >Amount</th> <th >GST</th><th >Taxable Amount</th> </tr> <tr> <td class="text-center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm" style="width:50px;" readonly ></td><td >5%</td> <td class="text-center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none"  data-label="SGST %">2.5%</td> <td style="display:none" ><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr>  <td class="text-center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >12%</td> <td class="text-center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >6%</td> <td style="display:none" ><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >18%</td> <td class="text-center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >9%</td> <td style="display:none" ><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >28%</td> <td class="text-center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >14%</td> <td style="display:none" ><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td colspan="4" style="text-align:right; ">Total GST Amount <?php echo $rescurrency[0]; ?></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> </table>';
document.getElementById('cgst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('sgst25').value='0.00';
document.getElementById('gst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('cgst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('sgst6').value='0.00';
document.getElementById('gst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('cgst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('sgst9').value='0.00';
document.getElementById('gst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('cgst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('sgst14').value='0.00';
document.getElementById('gst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('tax25').value=parseFloat(Math.round(tax25 * 100) / 100).toFixed(2);
document.getElementById('tax6').value=parseFloat(Math.round(tax6 * 100) / 100).toFixed(2);
document.getElementById('tax9').value=parseFloat(Math.round(tax9 * 100) / 100).toFixed(2);
document.getElementById('tax14').value=parseFloat(Math.round(tax14 * 100) / 100).toFixed(2);
document.getElementById('totalvatamount1').value=parseFloat(Math.round((gst25amt+gst6amt+gst9amt+gst14amt) * 100) / 100).toFixed(2);
}
}
}
function productcalcround()
{
var grandtotal;
var totalamount=document.getElementById('totalamount').value;
var totalvatamount=document.getElementById('totalvatamount').value;
var freightamount=document.getElementById('freightamount').value;
var discountamount=document.getElementById('discountamount').value;
var roundofff=document.getElementById('roundoff').value;
grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
grandtotal=grandtotal-parseFloat(discountamount);
if(parseFloat(roundofff)!=0)
{
var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);
var roundoff=grandtotal1-grandtotal;
document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
}
else
{
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal * 100) / 100).toFixed(2);
}
}
function discount1()
{
var disper=document.getElementById('discount').value;
var totalamount=document.getElementById('totalamount').value;
var discounttype=document.getElementById('discounttype').value;
if((disper!='')&&(disper!='0'))
{
if(discounttype=="0")
{
var discountamount=(parseFloat(disper)/100)*parseFloat(totalamount);
document.getElementById('discountamount').value=parseFloat(Math.round((discountamount) * 100) / 100).toFixed(2);
productcalc1();	
}
else
{
var discountamount=parseFloat(disper);
document.getElementById('discountamount').value=parseFloat(Math.round((discountamount) * 100) / 100).toFixed(2);
productcalc1();	
}	

}
}
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

<script>
$(function(){
$("[data-toggle=popover]").popover({
html : true,
content: function() {
var content = $(this).attr("data-popover-content");
return $(content).children(".popover-body").html();
},
title: function() {
var title = $(this).attr("data-popover-content");
return $(title).children(".popover-heading").html();
}
});
});
</script>
<script>
function funadddue() {
var missingduename = document.getElementById('missingduename');
var missingduedate = document.getElementById('missingduedate');
if (missingduename.value == ''||missingduedate.value == '') {
alert('Please Enter New Due Name And Due Date');
missingduename.focus();
return false;
}
else {
$('#duedateselects').append('<option value="' + missingduename.value + '">' + missingduename.value + '-' + missingduedate.value +
'</option>');
$('select[name^="duedateselects"] option[value="' + missingduename.value + '"]').attr("selected","selected");
$('#duedateselects').val(missingduename.value).change();
$('#AddNewDue').modal('hide');
return false;
}
}
function funesdue() {
// $('#duedateselects').val('').change();
$('#AddNewDue').modal('hide');
return false;
}
</script>
<script type="text/javascript">
$("#duedateselects").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewDue");
});
$("#duedateselects").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "+ New";
});
</script>
<!-- sve button spinner -->
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
<!-- purchase table add another row -->
<!------------------------------------------ pro script start ------------------------------------------>



<script type="text/javascript">
function title(x){
var Characters = x.value;
}
</script>
<script type="text/javascript">
function title(x){
var Characters = x.value;
}
</script>
<script type="text/javascript">
function taxable() {
document.getElementById('protaxablediv').style.display = "block";
document.getElementById('pronontaxablediv').style.display = "none";
}
function nontaxable() {
document.getElementById('protaxablediv').style.display = "none";
document.getElementById('pronontaxablediv').style.display = "block";
}
</script>

<script type="text/javascript">
$(function() {
$("#estimatesuffix").autocomplete({
source: 'estimatesuffixsearch.php',
select: function(event, ui) {
$("#estimatesuffix").val(ui.item.estimatesuffix);
$("#city").val(ui.item.city);
$("#district").val(ui.item.district);
$("#state").val(ui.item.state);
$("#pincode").val(ui.item.pincode);
},
minLength: 2
});
$("#email").autocomplete({
source: 'franchisesearch.php?type=email',
});
});
</script>
<script>
$("#prodefaultunit").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewDefaultUnit') {
$('#proAddNewDefaultUnit').modal('show');
}
});
</script>
<script>
function profunadddefaultunit() {
var promissingdefaultunit = document.getElementById('promissingdefaultunit');
var prouqc = document.getElementById('prouqc');
if (promissingdefaultunit.value == ''||prouqc.value == '') {
alert('Please Enter New Default Unit Name And Uqc');
promissingdefaultunit.focus();
return false;
} else {
$('#prodefaultunit').append('<option value="' + promissingdefaultunit.value + ',' + prouqc.value + '">' + promissingdefaultunit.value + '-' + prouqc.value +
'</option>');
$('select[name^="prodefaultunit"] option[value="' + promissingdefaultunit.value + ',' + prouqc.value + '"]').attr("selected","selected");
$('#prodefaultunit').val(promissingdefaultunit.value).change();
$('#proAddNewDefaultUnit').modal('hide');
return false;
}
}
function profunesdefaultunit() {
$('#prodefaultunit').val('').change();
$('#proAddNewDefaultUnit').modal('hide');
return false;
}
</script>
<script>
$("#procategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewCategory') {
$('#proAddNewCategory').modal('show');
}
});
$("#prosubcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewSubCategory') {
$('#proAddNewSubCategory').modal('show');
}
});
</script>
<script>
function profunaddcategory() {
var promissingcategory = document.getElementById('promissingcategory');
if (promissingcategory.value == '') {
alert('Please Enter New <?=$access['txtnamecategory']?> Name');
promissingcategory.focus();
return false;
} else {
$('#procategory').append('<option value="' + promissingcategory.value + '">' + promissingcategory.value +
'</option>');
$('#procategory').val(promissingcategory.value).change();
$('#proAddNewCategory').modal('hide');
return false;
}
}
function profunescategory() {
$('#procategory').val('').change();
$('#proAddNewCategory').modal('hide');
return false;
}
</script>
<script>
function profunaddsubcategory() {
var promissingsubcategory = document.getElementById('promissingsubcategory');
if (promissingsubcategory.value == '') {
alert('Please Enter New Sub Category Name');
promissingsubcategory.focus();
return false;
} else {
$('#prosubcategory').append('<option value="' + promissingsubcategory.value + '">' + promissingsubcategory.value +
'</option>');
$('#prosubcategory').val(promissingsubcategory.value).change();
$('#proAddNewSubCategory').modal('hide');
return false;
}
}
function profunessubcategory() {
$('#prosubcategory').val('').change();
$('#proAddNewSubCategory').modal('hide');
return false;
}
</script>
<!-- <script type="text/javascript">
function funaddintratax() {
var missingintra = document.getElementById('missingintratax');
if (missingintratax.value == '') {
alert('Please Enter New Intra Tax');
missingintratax.focus();
return false;
} else {
$('#intratax').append('<option value="' + missingintratax.value + '">' + missingintratax.value +
'</option>');
$('#intratax').val(missingintratax.value).change();
$('#NewIntraTax').modal('hide');
return false;
}
}
function funesintratax() {
$('#intratax').val('').change();
$('#NewIntraTax').modal('hide');
return false;
}
</script> -->
<script type="text/javascript">
$(function() {
$("#proproductname").autocomplete({
source: 'productsearch.php?type=proproductname',
});
$("#procategory").autocomplete({
source: 'productsearch.php?type=procategory',
});
});
</script>
<script>
let lineNo = 2;
$(document).ready(function() {
$(".purchaseadd-row").click(function() {
markup =
'<tr><td style="width:3%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td style="width:18%;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="proproductname[]" id="proproductname1' +
lineNo +
'" required class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td><td style="width:11%;"><div class="input-group mb-3 input-group-sm"><div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div><td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td style="width:3%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
tableBody = $("#purchasetable");
tableBody.append(markup);
renumber_table('#purchasetable');
lineNo++;
});
});
</script>
<script>
let linesNo = 2;
$(document).ready(function() {
$(".saleadd-row").click(function() {
markup =
'<tr><td data-label="" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="PRICE NAME" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="proproductname[]" id="proproductname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Sale Price or Trade Price or Wholesale Price"></td><td data-label="MRP" style="padding-bottom:0px !important;margin-bottom: -18px !important;padding-top: 13.2px !important;"><div class="input-group mb-3 input-group-sm"><div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div></td><td data-label="SELLING PRICE" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td data-label="DESCRIPTION" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td data-label="" style="padding-bottom: 9px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-deletes" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#saletable");
tableBody.append(markup);
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange' + linesNo).daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
.subtract(1, 'month').endOf('month')
]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
' to ' + end.format('YYYY-MM-DD'));
});
renumber_table('#saletable');
linesNo++;
});
});
</script>
<script>
let linesNo = 2;
$(document).ready(function() {
$(".inventoryadd-row").click(function() {
markup =
'<tr><td style="width:3%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td style="width:18%;"><input type="hidden" name="productid[]" id="productid1' +
linesNo +
'"><input type="text" name="proproductname[]" id="proproductname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td><td style="width:11%;"> <div class="input-group mb-3 input-group-sm"> <div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1' +
linesNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div></td><td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1' +
linesNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td style="width:3%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete' +
linesNo +
'" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
tableBody = $("#inventorytable");
tableBody.append(markup);
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange' + linesNo).daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
.subtract(1, 'month').endOf('month')
]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
' to ' + end.format('YYYY-MM-DD'));
});
renumber_table('#inventorytable');
linesNo++;
});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
//Helper function to keep table row from collapsing when being sorted
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index) {
$(this).width($originals.eq(index).width())
});
return $helper;
};
//Make diagnosis table sortable
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#purchasetable')
}
}).disableSelection();
//Make diagnosis table sortable
$("#saletable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#saletable')
}
}).disableSelection();
$("#inventorytable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#inventorytable')
}
}).disableSelection();
//Delete button in table rows
//     $('table').on('click', '.btn-delete', function() {
//         tableID = '#' + $(this).closest('table').attr('id');
//         r = confirm('Delete this item?');
//         if (r) {
//             $(this).closest('tr').remove();
//             renumber_table(tableID);
//         }
//     });
// });
$('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchasestable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
alert('Unable to Delete First row');
}
});
});
//Renumber  table rows
function renumber_table(tableID) {
$(tableID + " tr").each(function() {
count = $(this).parent().children().index($(this)) + 1;
$(this).find('.priority').html(count);
});
}
</script>
<script type="text/javascript">
$(document).ready(function() {
$('table').on('click','.btn-deletes',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("saletable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
alert('Unable to Delete First row');
}
});
});
</script>
<!------------------------------------------------ what is this ------------------------------------------------>
<!-- <script>
$("#prosubcategory").select2({
placeholder: "Select Country",
allowClear: true
});
</script> -->
<!------------------------------------------------ what is this ------------------------------------------------>
<script>
function readURL(input, imgControlName) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function(e) {
$(imgControlName).attr('src', e.target.result);
}
reader.readAsDataURL(input.files[0]);
}
}
$("#imag").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview";
readURL(this, imgControlName);
$('.preview1').addClass('it');
$('#removeImage1').css("color", "black");
});
$("#imag2").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview2";
readURL(this, imgControlName);
$('.preview2').addClass('it');
$('.btn-rmv2').addClass('rmv');
});
$("#imag3").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview3";
readURL(this, imgControlName);
$('.preview3').addClass('it');
$('.btn-rmv3').addClass('rmv');
});
$("#imag4").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview4";
readURL(this, imgControlName);
$('.preview4').addClass('it');
$('.btn-rmv4').addClass('rmv');
});
$("#imag5").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview5";
readURL(this, imgControlName);
$('.preview5').addClass('it');
});
$("#removeImage1").click(function(e) {
e.preventDefault();
$("#imag").val("");
$("#ImgPreview").attr("src",
"assets/img/productimage1.png"
);
$('.preview1').removeClass('it');
$('#removeImage1').css("color", "#6c757d");
});
$("#removeImage2").click(function(e) {
e.preventDefault();
$("#imag2").val("");
$("#ImgPreview2").attr("src",
"assets/img/productimage1.png"
);
$('.preview2').removeClass('it');
$('#removeImage2').css("color", "#6c757d");
});
$("#removeImage3").click(function(e) {
e.preventDefault();
$("#imag3").val("");
$("#ImgPreview3").attr("src",
"assets/img/productimage1.png"
);
$('.preview3').removeClass('it');
$('#removeImage3').css("color", "#6c757d");
});
$("#removeImage4").click(function(e) {
e.preventDefault();
$("#imag4").val("");
$("#ImgPreview4").attr("src",
"assets/img/productimage1.png"
);
$('.preview4').removeClass('it');
$('#removeImage4').css("color", "#6c757d");
});
$("#removeImage5").click(function(e) {
e.preventDefault();
$("#imag5").val("");
$("#ImgPreview5").attr("src",
"assets/img/productimage1.png"
);
$('.preview5').removeClass('it');
$('#removeImage5').css("color", "#6c757d");
});
</script>
<script>
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index) {
$(this).width($originals.eq(index).width())
});
return $helper;
},
updateIndex = function(e, ui) {
$('td.index', ui.item.parent()).each(function(i) {
$(this).html(i + 1);
});
$('input[type=text]', ui.item.parent()).each(function(i) {
$(this).val(i + 1);
});
};
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: updateIndex
}).disableSelection();
$("tbody").sortable({
distance: 5,
delay: 100,
opacity: 0.6,
cursor: 'move',
update: function() {}
});
</script>
<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<script>
$(function() {
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange1').daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
'month').endOf('month')]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
.format('YYYY-MM-DD'));
});
});
</script>
<script>
$(document).ready(function() {
$("#prodefaultunit").change(function(event) {
$('.unitchange span').html($(this).val());
});
});
$('#purchaseunit').on('change', function() {
var defaultunitval = $('#defaultunit').find(":selected").val();
var purchaseunitval = $('#purchaseunit').find(":selected").val();
if (defaultunitval === purchaseunitval) {
$('#purchaseindunit1').attr('disabled', true);
} else {
$('#purchaseindunit1').attr('disabled', false);
}
});
$('#salesunit').on('change', function() {
var defaultunitval = $('#defaultunit').find(":selected").val();
var salesunittval = $('#salesunit').find(":selected").val();
if (defaultunitval === salesunittval) {
$('#saleindunit').attr('disabled', true);
} else {
$('#saleindunit').attr('disabled', false);
}
});
</script>
<script>
$(document).ready(function() {
$('[data-toggle="tooltip"]').tooltip();
});
$("#submit").click(function() {
$(".Spinnn").css("display", "block");
$(".Spinnn").fadeOut(200);
});
checkBox = document.getElementById('trackinventory').addEventListener('click', event => {
if (event.target.checked) {
document.getElementById('table').style.display='none';
} else {
document.getElementById('table').style.display='block';
}
});
$('#ImgPreview').click(function() {
$('#imag').click();
});
$('#ImgPreview2').click(function() {
$('#imag2').click();
});
$('#ImgPreview3').click(function() {
$('#imag3').click();
});
$('#ImgPreview4').click(function() {
$('#imag4').click();
});
$('#ImgPreview5').click(function() {
$('#imag5').click();
});
</script>
<script>
var buttons = document.querySelectorAll( '.arlina-button' );
Array.prototype.slice.call( buttons ).forEach( function( button ) {
var resetTimeout;
button.addEventListener( 'click', function() {
if( typeof button.getAttribute( 'data-loading' ) === 'string' ) {
button.removeAttribute( 'data-loading' );
}
else {
button.setAttribute( 'data-loading', '' );
}
clearTimeout( resetTimeout );
resetTimeout = setTimeout( function() {
button.removeAttribute( 'data-loading' );
}, 1000 );
}, false );
} );
</script>
<script>
$("#prointratax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prointertax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prosubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewSubCategory");
});
$("#prosubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#procategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewCategory");
});
$("#procategory").on("select2:open", function() { document.getElementById("configureunits").innerHTML = "New <?=$access['txtnamecategory']?>";
});
$("#prodefaultunit").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewDefaultUnit");
});
$("#prodefaultunit").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Unit";
});
</script>
<script>
function funaddproduct() {
var missingproduct = document.getElementById('proproductname');
var prodefaultunit = document.getElementById("prodefaultunit");
var prodefaultunitans = prodefaultunit.options[prodefaultunit.selectedIndex].text;
if (missingproduct.value == ''||prodefaultunitans=="Unit") {
// alert('Please Enter New Product Name');
if (missingproduct.value == '') {missingproduct.focus();}
else if (prodefaultunitans=="Unit") {prodefaultunit.focus();}
return false;
}
else {
$('#AddNewProduct').modal('hide');
return false;
}
}
function funesproduct() {
$('#AddNewProduct').modal('hide');
return false;
}
</script>
<!------------------------------------------- pro script end ------------------------------------------->
<!--term start-->
<div class="modal fade" id="AddNewEstimateTerm" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New <?= $infomainaccessuser['modulename'] ?> Term</h5>
<span type="button" onclick="funesestimateterm()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingestimateterm" class="custom-label"><span class="text-danger">
<?= $infomainaccessuser['modulename'] ?> Term *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="estimateterm" class="form-control form-control-sm mb-4" id="missingestimateterm" placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddestimateterm()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitestimateterm" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funesestimateterm()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<script>
$("#estimateterm").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewEstimateTerm') {
$('#AddNewEstimateTerm').modal('show');
}
});
function funaddestimateterm() {
var missingestimateterm = document.getElementById('missingestimateterm');
if (missingestimateterm.value == '') {
alert('Please Enter New EstimateTerm Name');
missingestimateterm.focus();
return false;
} else {

$.ajax({type: "POST",
url: "termadds.php",
data: {
term: $("#missingestimateterm").val(),
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
$('#estimateterm').append('<option value="' + missingestimateterm.value + '">' + missingestimateterm.value +
'</option>');
$('#estimateterm').val(missingestimateterm.value).change();
$("#estimateterm").select2();
$('#AddNewEstimateTerm').modal('hide');
return false;
}
}});



}
}
function funesestimateterm() {
//$('#estimateterm').val('').change();
$("#estimateterm").select2();
$('#AddNewEstimateTerm').modal('hide');
return false;
}
$("#saleperson").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewSaleperson");
});
$("#saleperson").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sale Person";
});
$("#estimateterm").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewEstimateTerm");
});
$("#estimateterm").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New EstimateTerm";
});
</script>

<div class="modal fade" id="AddNewSaleperson" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Sale Person</h5>
<span type="button" onclick="funessaleperson()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingsaleperson" class="custom-label"><span class="text-danger"> Sale Person *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="saleperson" class="form-control form-control-sm mb-4" id="missingsaleperson" placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer " style="margin-top: 10px !important;">
<div class="col">
<button   onclick="funaddsaleperson()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitsaleperson" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funessaleperson()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<script>
$("#saleperson").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewSaleperson') {
$('#AddNewSaleperson').modal('show');
}
});
function funaddsaleperson() {
var missingsaleperson = document.getElementById('missingsaleperson');
if (missingsaleperson.value == '') {
alert('Please Enter New Sale Person Name');
missingsaleperson.focus();
return false;
} else {
$.ajax({type: "POST",
url: "salepersonadds.php",
data: {
saleperson: $("#missingsaleperson").val(),
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
$('#saleperson').append('<option value="' + missingsaleperson.value + '">' + missingsaleperson.value +
'</option>');
$('#saleperson').val(missingsaleperson.value).change();
$("#saleperson").select2();
$('#AddNewSaleperson').modal('hide');
return false;
}
}});
}
}
function funessaleperson() {
//$('#saleperson').val('').change();
$("#saleperson").select2();
$('#AddNewSaleperson').modal('hide');
return false;
}
</script>
<!--term end-->

<!--duedates start-->
<div class="modal fade" id="AddNewDueDate" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Due Date</h5>
<span type="button" onclick="funesduedates()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingduedates" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="duedates" class="form-control form-control-sm mb-1" id="missingduedates" placeholder="Name" required>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingnoofdays" class="custom-label"><span class="text-danger">
No of Dates *</span></label>
</div>
<div class="col-sm-7">
<input type="number" min="0" step="1" name="duedates" class="form-control form-control-sm mb-4" id="missingnoofdays" placeholder="No of Days" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddduedates()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitduedates" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funesduedates()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<script>
$("#duedates").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewDueDate') {
$('#AddNewDueDate').modal('show');
}
});
function funaddduedates() {
var missingduedates = document.getElementById('missingduedates');
var missingnoofdays = document.getElementById('missingnoofdays');
if (missingduedates.value == '') {
alert('Please Enter New DueDate Name');
missingduedates.focus();
return false;
} else if (missingnoofdays.value == '') {
alert('Please Enter New DueDate No of Days');
missingnoofdays.focus();
return false;
} else {

$.ajax({type: "POST",
url: "duedateadds.php",
data: {
duedate: $("#missingduedates").val(),
noofdays: $("#missingnoofdays").val(),
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
$('#duedates').append('<option value="' + missingnoofdays.value + '">' + missingduedates.value +
'</option>');
$('#duedates').val(missingnoofdays.value).change();
$("#duedates").select2();
$('#AddNewDueDate').modal('hide');
return false;
}
}});
}
}
function funesduedates() {
//$('#duedates').val('').change();
$("#duedates").select2();
$('#AddNewDueDate').modal('hide');
return false;
}
$("#duedates").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewDueDate");
});
$("#duedates").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = " New ";
});
</script>
<!--duedates end-->
<!--estimate attach start-->
<script>
$(document).ready(function (){
$("#fileattach").change(function (){
if($("#fileattach").get(0).files.length>5)
{
alert("Sorry only 5 files allowed");
$("#fileattach").val("");
return false;
}
else
{
for (var i = 0; i < $("#fileattach").get(0).files.length; ++i) {
var file1=$("#fileattach").get(0).files[i].name;

if(file1){
var file_size=$("#fileattach").get(0).files[i].size;
const files = Math.round((file_size / 1024));
if(files<5000){
var ext = file1.split('.').pop().toLowerCase();
if($.inArray(ext,['jpg','jpeg','gif','doc','docx','xls','xlsx','pdf'])===-1){
alert("Invalid file extension");
$("#fileattach").val("");
return false;
}

}else{
alert("One of the File size is too large.");
$("#fileattach").val("");
return false;
}
}else{
alert("Choose Any Attachment");
return false;
}
}
}
});
});
</script>
<!--estimate attach end-->
<!---gst---->
<script>
$("#gstgstrtype").on("select2:open", function() {
$("#configureunits").hide();
});
</script>
<!---gst---->
<!---payment confirm---->
<script>
function triggerpayment(estimateno,estimatedate,estimateamount,cancelstatus)
{
let allAreFilled = true;
document.getElementById("estimateform").querySelectorAll("[required]").forEach(function(i) {
if (!allAreFilled) return;
if (i.type === "radio") {
let radioValueCheck = false;
document.getElementById("estimateform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
if (r.checked) radioValueCheck = true;
})
allAreFilled = radioValueCheck;
return;
}
if (!i.value) { allAreFilled = false; return; }
})
if (!allAreFilled) {
alert('Fill all the fields');
}
else
{
$('#validestimateno').val($('#estimateno').val());
$('#validestimatedate').val($('#estimatedate').val());
$('#validestimateamount').val($('#grandtotal').val());
$('#triggerconfirm-adddelete').modal('show');
}
}

</script>
<!---payment confirm---->
<!----rupees--->
<script>function Rs(amount){
var words = new Array();
words[0] = 'Zero';words[1] = 'One';words[2] = 'Two';words[3] = 'Three';words[4] = 'Four';words[5] = 'Five';words[6] = 'Six';words[7] = 'Seven';words[8] = 'Eight';words[9] = 'Nine';words[10] = 'Ten';words[11] = 'Eleven';words[12] = 'Twelve';words[13] = 'Thirteen';words[14] = 'Fourteen';words[15] = 'Fifteen';words[16] = 'Sixteen';words[17] = 'Seventeen';words[18] = 'Eighteen';words[19] = 'Nineteen';words[20] = 'Twenty';words[30] = 'Thirty';words[40] = 'Forty';words[50] = 'Fifty';words[60] = 'Sixty';words[70] = 'Seventy';words[80] = 'Eighty';words[90] = 'Ninety';var op;
amount = amount.toString();
var atemp = amount.split('.');
var number = atemp[0].split(',').join('');
var n_length = number.length;
var words_string = '';
if(n_length <= 9){
var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
var received_n_array = new Array();
for (var i = 0; i < n_length; i++){
received_n_array[i] = number.substr(i, 1);}
for (var i = 9 - n_length, j = 0; i < 9; i++, j++){
n_array[i] = received_n_array[j];}
for (var i = 0, j = 1; i < 9; i++, j++){
if(i == 0 || i == 2 || i == 4 || i == 7){
if(n_array[i] == 1){
n_array[j] = 10 + parseInt(n_array[j]);
n_array[i] = 0;}}}
value = '';
for (var i = 0; i < 9; i++){
if(i == 0 || i == 2 || i == 4 || i == 7){
value = n_array[i] * 10;} else {
value = n_array[i];}
if(value != 0){
words_string += words[value] + ' ';}
if((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Crores ';}
if((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Lakhs ';}
if((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Thousand ';}
if(i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)){
words_string += 'Hundred and ';} else if(i == 6 && value != 0){
words_string += 'Hundred ';}}
words_string = words_string.split(' ').join(' ');}
return words_string;}

function RsPaise(n){
nums = n.toString().split('.')
var whole = Rs(nums[0])
if(nums[1]==null)nums[1]=0;
if(nums[1].length == 1 )nums[1]=nums[1]+'0';
if(nums[1].length> 2){nums[1]=nums[1].substring(2,length - 1)}
if(nums.length == 2){
if(nums[0]<=9){nums[0]=nums[0]*10} else {nums[0]=nums[0]};
var fraction = Rs(nums[1])
if(whole=='' && fraction==''){op= 'Zero only';}
if(whole=='' && fraction!=''){op= 'paise ' + fraction + ' only';}
if(whole!='' && fraction==''){op='Rupees ' + whole + ' only';}
if(whole!='' && fraction!=''){op='Rupees ' + whole + 'and paise ' + fraction + ' only';}
amt=n;
if(amt > 999999999.99){op='Oops!!! The amount is too big to convert';}
if(isNaN(amt) == true ){op='Error : Amount in number appears to be incorrect. Please Check.';}
document.getElementById('grandwords').innerHTML="<hr><strong>Total In Words:</strong>"+op;}}
RsPaise(0);
</script>
<script>
function batchget(id)
{
if($("#productid"+id).val()=='')
{
$("#product"+id).focus();
alert('Please Select Product');
}
else
{
var input = document.getElementById("batch"+id);
var browsers = document.getElementById("outfordone"+id);
var productid= $('#product'+id).val();
input.onclick = function () {
browsers.style.display = 'block';
$("body").on("click",function() {
if($("#batch"+id).is(":focus")){
browsers.style.display = 'block';
}
else{
browsers.style.display = 'none';
}
});
}
$.get("batchsearch.php", {term: productid} , function(datas){
const objbatch = JSON.parse(datas);
option='';
batch='';
exp='';
qty='';
rate='';
for (var key in objbatch) {
option+='option'+id+objbatch[key].batch+';';
batch+='batch'+objbatch[key].batch+';';
exp+='exp'+objbatch[key].expdate+';';
qty+='qty'+objbatch[key].quantity+';';
rate+='rate'+objbatch[key].productrate+';';
}
optionspl = option.split(';');
batchspl = batch.split(';');
expspl = exp.split(';');
qtyspl = qty.split(';');
ratespl = rate.split(';');
for (var i = 0; i <= optionspl.length; i++) {
var optionans = document.getElementById(optionspl[i]);
$("#"+optionspl[i]).on("click",function() {
const child = this.children;
const childone = child[0].children;
const childtwo = childone[0].children;
var batchqty = childtwo[0].innerHTML;
var batqtyspl = batchqty.split(" ");
var exprate = childtwo[1].innerHTML;
var expratespl = exprate.split(" ");
$('#batch'+id).val(batqtyspl[5]);
$("#productexpdateval"+id).html(expratespl[5]);
$("#expdate"+id).val(expratespl[5]);
$("#productrate"+id).val(expratespl[11]);
$('#quantity'+id).focus();
});
}
});
$('#batch'+id).on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#outfordone"+id+" "+"table").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
if ($(this).text().toLowerCase().indexOf(value) > -1) {
    $(this).parent().css({"display": "block"});
}
else{
    $(this).parent().css({"display": "none"});
}
});
});
}
}
</script>
<script>
function rateget(id)
{
if($("#productid"+id).val()=='')
{
$("#product"+id).focus();
alert('Please Select Product');
}
else
{
var input = document.getElementById("productrate"+id);
var browsers = document.getElementById("ratelist"+id);
var productid= $('#product'+id).val();
var customerid = $("#customer").val();
input.onclick = function () {
browsers.style.display = 'block';
$("body").on("click",function() {
if($("#productrate"+id).is(":focus")){
browsers.style.display = 'block';
}
else{
browsers.style.display = 'none';
}
});
}
$.get("ratesearch.php", {term: productid,custid: customerid} , function(datas){
const objbatch = JSON.parse(datas);
option='';
invno='';
invdt='';
rate='';
for (var key in objbatch) {
option+='option'+id+objbatch[key].invoiceno+'inv;';
invno+='invno'+objbatch[key].invoiceno+'inv;';
invdt+='invdt'+objbatch[key].invoicedate+'inv;';
rate+='rate'+objbatch[key].productrate+'inv;';
}
optionspl = option.split(';');
invnospl = invno.split(';');
invdtspl = invdt.split(';');
ratespl = rate.split(';');
for (var i = 0; i <= optionspl.length; i++) {
var optionans = document.getElementById(optionspl[i]);
$("#"+optionspl[i]).on("click",function() {
const child = this.children;
const childone = child[0].children;
const childtwo = childone[0].children;
var invnoinvdt = childtwo[0].innerHTML;
var invnoinvdtspl = invnoinvdt.split(" ");
var rates = childtwo[1].innerHTML;
var ratesspl = rates.split(" ");
$('#productrate'+id).val(ratesspl[6]);
$('#quantity'+id).focus();
});
}
});
$('#productrate'+id).on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#ratelist"+id+" "+"table").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
if ($(this).text().toLowerCase().indexOf(value) > -1) {
    $(this).parent().css({"display": "block"});
}
else{
    $(this).parent().css({"display": "none"});
}
});
});
}
}
</script>
<script>
$(document).ready(function (){
$("#customer").trigger("change");
});
</script>


</body>
</html>
<?php
}
else{
header("Location:estimates.php?error=No Information Found");
}
}
else{
header("Location:estimates.php?error=No Information Found");  
}
?>