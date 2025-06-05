<?php
include('lcheck.php');
if($permissionbooks=='0')
{
  header('Location: dashboard.php');
}
$sqlgetcur=mysqli_query($con,"select * from paircurrency");
$rowcur=mysqli_fetch_array($sqlgetcur);
$anscur=$rowcur['currencysymbol'];
$rescurrency=explode('-',$anscur);
$sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Purchase' order by id  asc");
$infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
if ($infomainaccesspurchase['groupaccess']=='0') {
header('Location: preference_billing.php');
}
$sql="SELECT * FROM paircontrols WHERE id='$companymainid';";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if (isset($_POST['submit'])) {
$ch='';
    $paymadeside=mysqli_real_escape_string($con, (isset($_POST['paymadeside']))?'1':'0');
    $purchasereturnsidebar=mysqli_real_escape_string($con, (isset($_POST['purchasereturnsidebar']))?'1':'0');
    $purpaymadeforside=mysqli_real_escape_string($con, (isset($_POST['purpaymadeforside']))?'1':'0');
    $debitnotesidesidebar=mysqli_real_escape_string($con, (isset($_POST['debitnotesidesidebar']))?'1':'0');
    $billbtwocnamerequired=mysqli_real_escape_string($con, $_POST['billbtwocnamerequired']);
    $billbtwocwphonerequired=mysqli_real_escape_string($con, $_POST['billbtwocwphonerequired']);
    $purorderbtwocnamerequired=mysqli_real_escape_string($con, $_POST['purorderbtwocnamerequired']);
    $purorderbtwocwphonerequired=mysqli_real_escape_string($con, $_POST['purorderbtwocwphonerequired']);
    $purreceivebtwocnamerequired=mysqli_real_escape_string($con, $_POST['purreceivebtwocnamerequired']);
    $purreceivebtwocwphonerequired=mysqli_real_escape_string($con, $_POST['purreceivebtwocwphonerequired']);
    $purreturnbtwocnamerequired=mysqli_real_escape_string($con, $_POST['purreturnbtwocnamerequired']);
    $purreturnbtwocwphonerequired=mysqli_real_escape_string($con, $_POST['purreturnbtwocwphonerequired']);
    $debitnotebtwocnamerequired=mysqli_real_escape_string($con, $_POST['debitnotebtwocnamerequired']);
    $debitnotebtwocwphonerequired=mysqli_real_escape_string($con, $_POST['debitnotebtwocwphonerequired']);

    $purorderbranchphone=mysqli_real_escape_string($con, (isset($_POST['purorderbranchphone']))?'1':'0');
    $purorderbranchemail=mysqli_real_escape_string($con, (isset($_POST['purorderbranchemail']))?'1':'0');
    $purorderbranchgstin=mysqli_real_escape_string($con, (isset($_POST['purorderbranchgstin']))?'1':'0');
    $purreceivebranchphone=mysqli_real_escape_string($con, (isset($_POST['purreceivebranchphone']))?'1':'0');
    $purreceivebranchemail=mysqli_real_escape_string($con, (isset($_POST['purreceivebranchemail']))?'1':'0');
    $purreceivebranchgstin=mysqli_real_escape_string($con, (isset($_POST['purreceivebranchgstin']))?'1':'0');
    $billbranchphone=mysqli_real_escape_string($con, (isset($_POST['billbranchphone']))?'1':'0');
    $billbranchemail=mysqli_real_escape_string($con, (isset($_POST['billbranchemail']))?'1':'0');
    $billbranchgstin=mysqli_real_escape_string($con, (isset($_POST['billbranchgstin']))?'1':'0');
    $purreturnbranchphone=mysqli_real_escape_string($con, (isset($_POST['purreturnbranchphone']))?'1':'0');
    $purreturnbranchemail=mysqli_real_escape_string($con, (isset($_POST['purreturnbranchemail']))?'1':'0');
    $purreturnbranchgstin=mysqli_real_escape_string($con, (isset($_POST['purreturnbranchgstin']))?'1':'0');

    $billprintexpdate=mysqli_real_escape_string($con, (isset($_POST['billprintexpdate']))?'1':'0');
    $billprintexpmonth=mysqli_real_escape_string($con, (isset($_POST['billprintexpmonth']))?'1':'0');
    $billprintexpyear=mysqli_real_escape_string($con, (isset($_POST['billprintexpyear']))?'1':'0');
    $billprintdlno20=mysqli_real_escape_string($con, (isset($_POST['billprintdlno20']))?'1':'0');
    $billprintdlno21=mysqli_real_escape_string($con, (isset($_POST['billprintdlno21']))?'1':'0');
    $billbank=mysqli_real_escape_string($con, (isset($_POST['billbank']))?'1':'0');
    $billname=mysqli_real_escape_string($con, (isset($_POST['billname']))?'1':'0');
    $billaccnumber=mysqli_real_escape_string($con, (isset($_POST['billaccnumber']))?'1':'0');
    $billifsccode=mysqli_real_escape_string($con, (isset($_POST['billifsccode']))?'1':'0');
    $billbranchandcity=mysqli_real_escape_string($con, (isset($_POST['billbranchandcity']))?'1':'0');
    $purreturnprintdlno20=mysqli_real_escape_string($con, (isset($_POST['purreturnprintdlno20']))?'1':'0');
    $purreturnprintdlno21=mysqli_real_escape_string($con, (isset($_POST['purreturnprintdlno21']))?'1':'0');
    $purreturnbank=mysqli_real_escape_string($con, (isset($_POST['purreturnbank']))?'1':'0');
    $purreturnname=mysqli_real_escape_string($con, (isset($_POST['purreturnname']))?'1':'0');
    $purreturnaccnumber=mysqli_real_escape_string($con, (isset($_POST['purreturnaccnumber']))?'1':'0');
    $purreturnifsccode=mysqli_real_escape_string($con, (isset($_POST['purreturnifsccode']))?'1':'0');
    $purreturnbranchandcity=mysqli_real_escape_string($con, (isset($_POST['purreturnbranchandcity']))?'1':'0');

    $purpaymadebranchphone=mysqli_real_escape_string($con, (isset($_POST['purpaymadebranchphone']))?'1':'0');
    $purpaymadebranchemail=mysqli_real_escape_string($con, (isset($_POST['purpaymadebranchemail']))?'1':'0');
    $purpaymadebranchgstin=mysqli_real_escape_string($con, (isset($_POST['purpaymadebranchgstin']))?'1':'0');
    $purpaymadeprintdlno20=mysqli_real_escape_string($con, (isset($_POST['purpaymadeprintdlno20']))?'1':'0');
    $purpaymadeprintdlno21=mysqli_real_escape_string($con, (isset($_POST['purpaymadeprintdlno21']))?'1':'0');
    $purpaymadebank=mysqli_real_escape_string($con, (isset($_POST['purpaymadebank']))?'1':'0');
    $purpaymadename=mysqli_real_escape_string($con, (isset($_POST['purpaymadename']))?'1':'0');
    $purpaymadeaccnumber=mysqli_real_escape_string($con, (isset($_POST['purpaymadeaccnumber']))?'1':'0');
    $purpaymadeifsccode=mysqli_real_escape_string($con, (isset($_POST['purpaymadeifsccode']))?'1':'0');
    $purpaymadebranchandcity=mysqli_real_escape_string($con, (isset($_POST['purpaymadebranchandcity']))?'1':'0');

    $billbatchdef=mysqli_real_escape_string($con, $_POST['billbatchdef']);
    $billratedef=mysqli_real_escape_string($con, $_POST['billratedef']);
    $defpurchasereturnaccess=mysqli_real_escape_string($con, $_POST['defpurchasereturnaccess']);
    $purchasereturnbatchdef=mysqli_real_escape_string($con, $_POST['purchasereturnbatchdef']);
    $purchasereturnratedef=mysqli_real_escape_string($con, $_POST['purchasereturnratedef']);
    $debitnotebatchdef=mysqli_real_escape_string($con, $_POST['debitnotebatchdef']);
    $debitnoteratedef=mysqli_real_escape_string($con, $_POST['debitnoteratedef']);

    $purordernewproductdef=mysqli_real_escape_string($con, (isset($_POST['purordernewproductdef']))?'1':'0');
    $purordernewvendordef=mysqli_real_escape_string($con, (isset($_POST['purordernewvendordef']))?'1':'0');
    $purreceivenewproductdef=mysqli_real_escape_string($con, (isset($_POST['purreceivenewproductdef']))?'1':'0');
    $purreceivenewvendordef=mysqli_real_escape_string($con, (isset($_POST['purreceivenewvendordef']))?'1':'0');
    $billnewproductdef=mysqli_real_escape_string($con, (isset($_POST['billnewproductdef']))?'1':'0');
    $billnewvendordef=mysqli_real_escape_string($con, (isset($_POST['billnewvendordef']))?'1':'0');
    $purreturnnewproductdef=mysqli_real_escape_string($con, (isset($_POST['purreturnnewproductdef']))?'1':'0');
    $purreturnnewvendordef=mysqli_real_escape_string($con, (isset($_POST['purreturnnewvendordef']))?'1':'0');
    $debitnotenewproductdef=mysqli_real_escape_string($con, (isset($_POST['debitnotenewproductdef']))?'1':'0');
    $debitnotenewvendordef=mysqli_real_escape_string($con, (isset($_POST['debitnotenewvendordef']))?'1':'0');
    $drrefundoption = mysqli_real_escape_string($con, $_POST['drrefundoption']);

    $purorderpageload=mysqli_real_escape_string($con, $_POST['purorderpageload']);
    $purreceivepageload=mysqli_real_escape_string($con, $_POST['purreceivepageload']);
    $billpageload=mysqli_real_escape_string($con, $_POST['billpageload']);
    $purreturnpageload=mysqli_real_escape_string($con, $_POST['purreturnpageload']);
    $venpageload=mysqli_real_escape_string($con, $_POST['venpageload']);
    $purpaypageload=mysqli_real_escape_string($con, $_POST['purpaypageload']);
    $purreturnpaypageload=mysqli_real_escape_string($con, $_POST['purreturnpaypageload']);

$venmodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Vendors'");
$venmodhis=mysqli_fetch_array($venmodsql);
$purordermodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Purchase Orders'");
$purordermodhis=mysqli_fetch_array($purordermodsql);
$purreceivemodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Purchase Receives'");
$purreceivemodhis=mysqli_fetch_array($purreceivemodsql);
$purreturnmodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Purchase Returns'");
$purreturnmodhis=mysqli_fetch_array($purreturnmodsql);
$billmodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Bills'");
$billmodhis=mysqli_fetch_array($billmodsql);
$paymademodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Payments Made'");
$paymademodhis=mysqli_fetch_array($paymademodsql);
$purpaymademodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Vendor Refunds'");
$purpaymademodhis=mysqli_fetch_array($purpaymademodsql);
if ($access['venpageload']!=$venpageload) {
if ($venpageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$venmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$venmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$venmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$venmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['purpaypageload']!=$purpaypageload) {
if ($purpaypageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['purreturnpaypageload']!=$purreturnpaypageload) {
if ($purreturnpaypageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$purpaymademodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$purpaymademodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purpaymademodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$purpaymademodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['purorderpageload']!=$purorderpageload) {
if ($purorderpageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['purreceivepageload']!=$purreceivepageload) {
if ($purreceivepageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['billpageload']!=$billpageload) {
if ($billpageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['purreturnpageload']!=$purreturnpageload) {
if ($purreturnpageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['purordernewproductdef']!=$purordernewproductdef) {
if ($purordernewproductdef=="1") {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purordernewvendordef']!=$purordernewvendordef) {
if ($purordernewvendordef=="1") {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreceivenewproductdef']!=$purreceivenewproductdef) {
if ($purreceivenewproductdef=="1") {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreceivenewvendordef']!=$purreceivenewvendordef) {
if ($purreceivenewvendordef=="1") {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billnewproductdef']!=$billnewproductdef) {
if ($billnewproductdef=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billnewvendordef']!=$billnewvendordef) {
if ($billnewvendordef=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnnewproductdef']!=$purreturnnewproductdef) {
if ($purreturnnewproductdef=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' New Product <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnnewvendordef']!=$purreturnnewvendordef) {
if ($purreturnnewvendordef=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' New Vendor <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billbatchdef']!=$billbatchdef) {
if ($billbatchdef=="show") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Batch Default <span style="color:green;" id="prohisfromtospan">( From Available Only(Custom) To Show All ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Batch Default <span style="color:green;" id="prohisfromtospan">( From Available Only(Custom) To Show All ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Batch Default <span style="color:green;" id="prohisfromtospan">( From Show All To Available Only(Custom) ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Batch Default <span style="color:green;" id="prohisfromtospan">( From Show All To Available Only(Custom) ) </span>';
}
}
}
if ($access['billratedef']!=$billratedef) {
if ($billratedef=="show") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Rate Default <span style="color:green;" id="prohisfromtospan">( From Available Only To Show All ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Rate Default <span style="color:green;" id="prohisfromtospan">( From Available Only To Show All ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Rate Default <span style="color:green;" id="prohisfromtospan">( From Show All To Available Only ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Rate Default <span style="color:green;" id="prohisfromtospan">( From Show All To Available Only ) </span>';
}
}
}
if ($access['purchasereturnbatchdef']!=$purchasereturnbatchdef) {
if ($purchasereturnbatchdef=="show") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Batch Default <span style="color:green;" id="prohisfromtospan">( From Available Only(Custom) To Show All ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Batch Default <span style="color:green;" id="prohisfromtospan">( From Available Only(Custom) To Show All ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Batch Default <span style="color:green;" id="prohisfromtospan">( From Show All To Available Only(Custom) ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Batch Default <span style="color:green;" id="prohisfromtospan">( From Show All To Available Only(Custom) ) </span>';
}
}
}
if ($access['purchasereturnratedef']!=$purchasereturnratedef) {
if ($purchasereturnratedef=="show") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Rate Default <span style="color:green;" id="prohisfromtospan">( From Available Only To Show All ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Rate Default <span style="color:green;" id="prohisfromtospan">( From Available Only To Show All ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Rate Default <span style="color:green;" id="prohisfromtospan">( From Show All To Available Only ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Rate Default <span style="color:green;" id="prohisfromtospan">( From Show All To Available Only ) </span>';
}
}
}
if ($access['billprintdlno20']!=$billprintdlno20) {
if ($billprintdlno20=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billprintdlno21']!=$billprintdlno21) {
if ($billprintdlno21=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billbank']!=$billbank) {
if ($billbank=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billname']!=$billname) {
if ($billname=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billaccnumber']!=$billaccnumber) {
if ($billaccnumber=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billifsccode']!=$billifsccode) {
if ($billifsccode=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billbranchandcity']!=$billbranchandcity) {
if ($billbranchandcity=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnprintdlno20']!=$purreturnprintdlno20) {
if ($purreturnprintdlno20=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnprintdlno21']!=$purreturnprintdlno21) {
if ($purreturnprintdlno21=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnbank']!=$purreturnbank) {
if ($purreturnbank=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnname']!=$purreturnname) {
if ($purreturnname=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnaccnumber']!=$purreturnaccnumber) {
if ($purreturnaccnumber=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnifsccode']!=$purreturnifsccode) {
if ($purreturnifsccode=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnbranchandcity']!=$purreturnbranchandcity) {
if ($purreturnbranchandcity=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['paymadeside']!=$paymadeside) {
if ($paymadeside=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Sidebar <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Sidebar <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Sidebar <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Sidebar <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadeforside']!=$purpaymadeforside) {
if ($purpaymadeforside=="1") {
if ($ch!='') {
$ch.='<br> '.$purpaymademodhis['moduletype'].' Sidebar <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purpaymademodhis['moduletype'].' Sidebar <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purpaymademodhis['moduletype'].' Sidebar <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purpaymademodhis['moduletype'].' Sidebar <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purorderbranchphone']!=$purorderbranchphone) {
if ($purorderbranchphone=="1") {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purorderbranchemail']!=$purorderbranchemail) {
if ($purorderbranchemail=="1") {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purorderbranchgstin']!=$purorderbranchgstin) {
if ($purorderbranchgstin=="1") {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreceivebranchphone']!=$purreceivebranchphone) {
if ($purreceivebranchphone=="1") {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreceivebranchemail']!=$purreceivebranchemail) {
if ($purreceivebranchemail=="1") {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreceivebranchgstin']!=$purreceivebranchgstin) {
if ($purreceivebranchgstin=="1") {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billbranchphone']!=$billbranchphone) {
if ($billbranchphone=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billbranchemail']!=$billbranchemail) {
if ($billbranchemail=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['billbranchgstin']!=$billbranchgstin) {
if ($billbranchgstin=="1") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnbranchphone']!=$purreturnbranchphone) {
if ($purreturnbranchphone=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnbranchemail']!=$purreturnbranchemail) {
if ($purreturnbranchemail=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnbranchgstin']!=$purreturnbranchgstin) {
if ($purreturnbranchgstin=="1") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purorderbtwocnamerequired']!=$purorderbtwocnamerequired) {
if ($purorderbtwocnamerequired=="Yes") {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
}
}
if ($access['purorderbtwocwphonerequired']!=$purorderbtwocwphonerequired) {
if ($purorderbtwocwphonerequired=="Yes") {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
}
}
if ($access['purreceivebtwocnamerequired']!=$purreceivebtwocnamerequired) {
if ($purreceivebtwocnamerequired=="Yes") {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
}
}
if ($access['purreceivebtwocwphonerequired']!=$purreceivebtwocwphonerequired) {
if ($purreceivebtwocwphonerequired=="Yes") {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
}
}
if ($access['billbtwocnamerequired']!=$billbtwocnamerequired) {
if ($billbtwocnamerequired=="Yes") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
}
}
if ($access['billbtwocwphonerequired']!=$billbtwocwphonerequired) {
if ($billbtwocwphonerequired=="Yes") {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
}
}
if ($access['purpaymadebranchphone']!=$purpaymadebranchphone) {
if ($purpaymadebranchphone=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Phone <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadebranchemail']!=$purpaymadebranchemail) {
if ($purpaymadebranchemail=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print E-mail <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadebranchgstin']!=$purpaymadebranchgstin) {
if ($purpaymadebranchgstin=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print GSTIN <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadeprintdlno20']!=$purpaymadeprintdlno20) {
if ($purpaymadeprintdlno20=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print DL NO 20 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadeprintdlno21']!=$purpaymadeprintdlno21) {
if ($purpaymadeprintdlno21=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print DL NO 21 <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadebank']!=$purpaymadebank) {
if ($purpaymadebank=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Bank <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadename']!=$purpaymadename) {
if ($purpaymadename=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Name <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadeaccnumber']!=$purpaymadeaccnumber) {
if ($purpaymadeaccnumber=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Account Number <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadeifsccode']!=$purpaymadeifsccode) {
if ($purpaymadeifsccode=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print IFSC Code <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purpaymadebranchandcity']!=$purpaymadebranchandcity) {
if ($purpaymadebranchandcity=="1") {
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$paymademodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.=''.$paymademodhis['moduletype'].' Print Branch & City <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($access['purreturnbtwocnamerequired']!=$purreturnbtwocnamerequired) {
if ($purreturnbtwocnamerequired=="Yes") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Required Name <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
}
}
if ($access['purreturnbtwocwphonerequired']!=$purreturnbtwocwphonerequired) {
if ($purreturnbtwocwphonerequired=="Yes") {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From No To Yes ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Required Phone <span style="color:green;" id="prohisfromtospan">( From Yes To No ) </span>';
}
}
}

    $txttaxablebill=mysqli_real_escape_string($con, $_POST['txttaxablebill']);
    $txtqtybill=mysqli_real_escape_string($con, $_POST['txtqtybill']);
    $txtprodisbill=mysqli_real_escape_string($con, $_POST['txtprodisbill']);
    $txtsqty=mysqli_real_escape_string($con, $_POST['txtsqty']);
    $sqlupaccess=mysqli_query($con,"update pairaccess set txtsqty='$txtsqty',txtprodisbill='$txtprodisbill',txtqtybill='$txtqtybill',txttaxablebill='$txttaxablebill',venpageload='$venpageload',purpaypageload='$purpaypageload',purreturnpaypageload='$purreturnpaypageload',purorderpageload='$purorderpageload',purreceivepageload='$purreceivepageload',billpageload='$billpageload',purreturnpageload='$purreturnpageload',purordernewproductdef='$purordernewproductdef',purordernewvendordef='$purordernewvendordef',purreceivenewproductdef='$purreceivenewproductdef',purreceivenewvendordef='$purreceivenewvendordef',billnewproductdef='$billnewproductdef',billnewvendordef='$billnewvendordef',purreturnnewproductdef='$purreturnnewproductdef',purreturnnewvendordef='$purreturnnewvendordef',purchasereturnbatchdef='$purchasereturnbatchdef',purchasereturnratedef='$purchasereturnratedef',defpurchasereturnaccess='$defpurchasereturnaccess',billbatchdef='$billbatchdef',billratedef='$billratedef',billprintdlno20='$billprintdlno20',billprintdlno21='$billprintdlno21',billbank='$billbank',billname='$billname',billaccnumber='$billaccnumber',billifsccode='$billifsccode',billbranchandcity='$billbranchandcity',purreturnprintdlno20='$purreturnprintdlno20',purreturnprintdlno21='$purreturnprintdlno21',purreturnbank='$purreturnbank',purreturnname='$purreturnname',purreturnaccnumber='$purreturnaccnumber',purreturnifsccode='$purreturnifsccode',purreturnbranchandcity='$purreturnbranchandcity',purorderbranchphone='$purorderbranchphone',purorderbranchemail='$purorderbranchemail',purorderbranchgstin='$purorderbranchgstin',purreceivebranchphone='$purreceivebranchphone',purreceivebranchemail='$purreceivebranchemail',purreceivebranchgstin='$purreceivebranchgstin',billbranchphone='$billbranchphone',billbranchemail='$billbranchemail',billbranchgstin='$billbranchgstin',purreturnbranchphone='$purreturnbranchphone',purreturnbranchemail='$purreturnbranchemail',purreturnbranchgstin='$purreturnbranchgstin',paymadeside='$paymadeside',purpaymadeforside='$purpaymadeforside',debitnotesidesidebar='$debitnotesidesidebar',purchasereturnsidebar='$purchasereturnsidebar',billbtwocnamerequired='$billbtwocnamerequired',billbtwocwphonerequired='$billbtwocwphonerequired',purorderbtwocnamerequired='$purorderbtwocnamerequired',purorderbtwocwphonerequired='$purorderbtwocwphonerequired',purreceivebtwocnamerequired='$purreceivebtwocnamerequired',purreceivebtwocwphonerequired='$purreceivebtwocwphonerequired',purreturnbtwocnamerequired='$purreturnbtwocnamerequired',purreturnbtwocwphonerequired='$purreturnbtwocwphonerequired',billprintexpdate='$billprintexpdate',billprintexpmonth='$billprintexpmonth',billprintexpyear='$billprintexpyear',purpaymadebranchphone = '$purpaymadebranchphone',purpaymadebranchemail = '$purpaymadebranchemail',purpaymadebranchgstin = '$purpaymadebranchgstin',purpaymadeprintdlno20 = '$purpaymadeprintdlno20',purpaymadeprintdlno21 = '$purpaymadeprintdlno21',purpaymadebank = '$purpaymadebank',purpaymadename = '$purpaymadename',purpaymadeaccnumber = '$purpaymadeaccnumber',purpaymadeifsccode = '$purpaymadeifsccode',purpaymadebranchandcity = '$purpaymadebranchandcity',debitnotebtwocnamerequired='$debitnotebtwocnamerequired',debitnotebtwocwphonerequired='$debitnotebtwocwphonerequired',debitnotebatchdef='$debitnotebatchdef',debitnoteratedef='$debitnoteratedef',debitnotenewproductdef='$debitnotenewproductdef',debitnotenewvendordef='$debitnotenewvendordef',drrefundoption='$drrefundoption' where createdid='$companymainid'");
$purorderveninfodefaulttwo=mysqli_real_escape_string($con, $_POST['purordervendorinfodefault']);
    if ($purorderveninfodefaulttwo=='two') {
    $purorderveninfodefault=mysqli_real_escape_string($con, $_POST['purordervendorinfodefault']);
    $purordertwogst=mysqli_real_escape_string($con, $_POST['purordertwogst']);
    $purordertwopos=mysqli_real_escape_string($con, $_POST['purordertwopos']);
    }
    else if ($purorderveninfodefaulttwo!='one'&&$purorderveninfodefaulttwo!='two') {
    $purorderveninfodefault=mysqli_real_escape_string($con, $_POST['purorderveninfoselect']);
    $purordertwogst=mysqli_real_escape_string($con, $_POST['purordertwogst']);
    $purordertwopos=mysqli_real_escape_string($con, $_POST['purordertwopos']);
    }
    else{
    $purordertwogst='';
    $purordertwopos='';
    $purorderveninfodefault=mysqli_real_escape_string($con, $_POST['purordervendorinfodefault']);
    }
$purreceiveveninfodefaulttwo=mysqli_real_escape_string($con, $_POST['purreceivevendorinfodefault']);
    if ($purreceiveveninfodefaulttwo=='two') {
    $purreceiveveninfodefault=mysqli_real_escape_string($con, $_POST['purreceivevendorinfodefault']);
    $purreceivetwogst=mysqli_real_escape_string($con, $_POST['purreceivetwogst']);
    $purreceivetwopos=mysqli_real_escape_string($con, $_POST['purreceivetwopos']);
    }
    else if ($purreceiveveninfodefaulttwo!='one'&&$purreceiveveninfodefaulttwo!='two') {
    $purreceiveveninfodefault=mysqli_real_escape_string($con, $_POST['purreceiveveninfoselect']);
    $purreceivetwogst=mysqli_real_escape_string($con, $_POST['purreceivetwogst']);
    $purreceivetwopos=mysqli_real_escape_string($con, $_POST['purreceivetwopos']);
    }
    else{
    $purreceivetwogst='';
    $purreceivetwopos='';
    $purreceiveveninfodefault=mysqli_real_escape_string($con, $_POST['purreceivevendorinfodefault']);
    }
$purreturnveninfodefaulttwo=mysqli_real_escape_string($con, $_POST['purreturnvendorinfodefault']);
    if ($purreturnveninfodefaulttwo=='two') {
    $purreturnveninfodefault=mysqli_real_escape_string($con, $_POST['purreturnvendorinfodefault']);
    $purreturntwogst=mysqli_real_escape_string($con, $_POST['purreturntwogst']);
    $purreturntwopos=mysqli_real_escape_string($con, $_POST['purreturntwopos']);
    }
    else if ($purreturnveninfodefaulttwo!='one'&&$purreturnveninfodefaulttwo!='two') {
    $purreturnveninfodefault=mysqli_real_escape_string($con, $_POST['purreturnveninfoselect']);
    $purreturntwogst=mysqli_real_escape_string($con, $_POST['purreturntwogst']);
    $purreturntwopos=mysqli_real_escape_string($con, $_POST['purreturntwopos']);
    }
    else{
    $purreturntwogst='';
    $purreturntwopos='';
    $purreturnveninfodefault=mysqli_real_escape_string($con, $_POST['purreturnvendorinfodefault']);
    }
$billveninfodefaulttwo=mysqli_real_escape_string($con, $_POST['billvendorinfodefault']);
    if ($billveninfodefaulttwo=='two') {
    $billveninfodefault=mysqli_real_escape_string($con, $_POST['billvendorinfodefault']);
    $billtwogst=mysqli_real_escape_string($con, $_POST['billtwogst']);
    $billtwopos=mysqli_real_escape_string($con, $_POST['billtwopos']);
    }
    else if ($billveninfodefaulttwo!='one'&&$billveninfodefaulttwo!='two') {
    $billveninfodefault=mysqli_real_escape_string($con, $_POST['billveninfoselect']);
    $billtwogst=mysqli_real_escape_string($con, $_POST['billtwogst']);
    $billtwopos=mysqli_real_escape_string($con, $_POST['billtwopos']);
    }
    else{
    $billtwogst='';
    $billtwopos='';
    $billveninfodefault=mysqli_real_escape_string($con, $_POST['debitnotevendorinfodefault']);
    }
$debitnoteveninfodefaulttwo=mysqli_real_escape_string($con, $_POST['debitnotevendorinfodefault']);
    if ($debitnoteveninfodefaulttwo=='two') {
    $debitnoteveninfodefault=mysqli_real_escape_string($con, $_POST['debitnotevendorinfodefault']);
    $debitnotetwogst=mysqli_real_escape_string($con, $_POST['debitnotetwogst']);
    $debitnotetwopos=mysqli_real_escape_string($con, $_POST['debitnotetwopos']);
    }
    else if ($debitnoteveninfodefaulttwo!='one'&&$debitnoteveninfodefaulttwo!='two') {
    $debitnoteveninfodefault=mysqli_real_escape_string($con, $_POST['debitnoteveninfoselect']);
    $debitnotetwogst=mysqli_real_escape_string($con, $_POST['debitnotetwogst']);
    $debitnotetwopos=mysqli_real_escape_string($con, $_POST['debitnotetwopos']);
    }
    else{
    $debitnotetwogst='';
    $debitnotetwopos='';
    $debitnoteveninfodefault=mysqli_real_escape_string($con, $_POST['debitnotevendorinfodefault']);
    }
$purorderprintpos=mysqli_real_escape_string($con, $_POST['purorderprintpos']);
    $purorderprintgsttreatment=mysqli_real_escape_string($con, $_POST['purorderprintgsttreatment']);
    $purorderprintgstin=mysqli_real_escape_string($con, $_POST['purorderprintgstin']);
    $purreceiveprintpos=mysqli_real_escape_string($con, $_POST['purreceiveprintpos']);
    $purreceiveprintgsttreatment=mysqli_real_escape_string($con, $_POST['purreceiveprintgsttreatment']);
    $purreceiveprintgstin=mysqli_real_escape_string($con, $_POST['purreceiveprintgstin']);
    $purreturnprintpos=mysqli_real_escape_string($con, $_POST['purreturnprintpos']);
    $purreturnprintgsttreatment=mysqli_real_escape_string($con, $_POST['purreturnprintgsttreatment']);
    $purreturnprintgstin=mysqli_real_escape_string($con, $_POST['purreturnprintgstin']);
    $billprintpos=mysqli_real_escape_string($con, $_POST['billprintpos']);
    $billviewprintdlno20=mysqli_real_escape_string($con, $_POST['billviewprintdlno20']);
    $billviewprintdlno21=mysqli_real_escape_string($con, $_POST['billviewprintdlno21']);
    $billprintgsttreatment=mysqli_real_escape_string($con, $_POST['billprintgsttreatment']);
    $billprintgstin=mysqli_real_escape_string($con, $_POST['billprintgstin']);
$gsttypevenans=mysqli_real_escape_string($con, (isset($_POST['gstrtype']))?$_POST['gstrtype']:'');
    $vendorvisible=mysqli_real_escape_string($con, $_POST['defaultvisibleven']);
$pos = mysqli_real_escape_string($con,(isset($_POST['pos']))?$_POST['pos']:'');
if ($pos!='') {
    $placeofsupplydefaultven = mysqli_real_escape_string($con,$_POST['pos']);
}
else{
    $placeofsupplydefaultven = mysqli_real_escape_string($con,$_POST['placeofsupplydefaultven']);
}
if ($gsttypevenans!='') {
    $gsttypeven = mysqli_real_escape_string($con,$_POST['gstrtype']);
}
else{
    $gsttypeven = mysqli_real_escape_string($con,$_POST['gsttypeven']);
}
    $payablepurchase=mysqli_real_escape_string($con, (isset($_POST['payablepurchase']))?'1':'0');

    $sqlmainaccesshissql = mysqli_query($con,"select * from pairmainaccess where (userid='$companymainid' or createdid='0' or franchiseid='".$_SESSION['franchisesession']."')"); 
    $sqlmainaccesshis = mysqli_fetch_array($sqlmainaccesshissql);
    
if ($sqlmainaccesshis['payablepurchase']!=$payablepurchase) {
if ($payablepurchase=="1") {
if ($ch!='') {
$ch.='<br> Total Payable in Purchase <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
else{
$ch.='Total Payable in Purchase <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> Total Payable in Purchase <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
else{
$ch.='Total Payable in Purchase <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
}
}
}
if ($venmodhis['vendorvisible']!=$vendorvisible) {
if ($ch!='') {
$ch.='<br> '.$venmodhis['moduletype'].' Visibility Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($venmodhis['vendorvisible']).' To '.strtoupper($vendorvisible).' ) </span>';
}
else{
$ch.=''.$venmodhis['moduletype'].' Visibility Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($venmodhis['vendorvisible']).' To '.strtoupper($vendorvisible).' ) </span>';
}
}
if ($venmodhis['gsttypeven']!=$gsttypeven) {
if ($ch!='') {
$ch.='<br> '.$venmodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($venmodhis['gsttypeven']).' To '.strtoupper($gsttypeven).' ) </span>';
}
else{
$ch.=''.$venmodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($venmodhis['gsttypeven']).' To '.strtoupper($gsttypeven).' ) </span>';
}
}
if ($venmodhis['placeofsupplydefaultven']!=$placeofsupplydefaultven) {
if ($ch!='') {
$ch.='<br> '.$venmodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($venmodhis['placeofsupplydefaultven']).' To '.strtoupper($placeofsupplydefaultven).' ) </span>';
}
else{
$ch.=''.$venmodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($venmodhis['placeofsupplydefaultven']).' To '.strtoupper($placeofsupplydefaultven).' ) </span>';
}
}
if ($purordermodhis['purorderveninfo']=='one') {
$oldpurorder = "B2B";
}
else if ($purordermodhis['purorderveninfo']=='two') {
$oldpurorder = "B2C";
}
else {
if ($purordermodhis['purorderveninfo']=='defone') {
$oldpurorder = "Default B2B";
}
else {
$oldpurorder = "Default B2C";
}
}
if ($purordervenomerinfodefault=='one') {
$newpurorder = "B2B";
}
else if ($purordervenomerinfodefault=='two') {
$newpurorder = "B2C";
}
else {
if ($purordervenomerinfodefault=='defone') {
$newpurorder = "Default B2B";
}
else {
$newpurorder = "Default B2C";
}
}
if ($oldpurorder!=$newpurorder) {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Customer Information Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($oldpurorder).' To '.strtoupper($newpurorder).' ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Customer Information Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($oldpurorder).' To '.strtoupper($newpurorder).' ) </span>';
}
}
if ($purordermodhis['purordertwogst']!=$purordertwogst) {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purordermodhis['purordertwogst']!='')?strtoupper($purordermodhis['purordertwogst']):'B2B').' To '.(($purordertwogst!='')?strtoupper($purordertwogst):'B2B').' ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purordermodhis['purordertwogst']!='')?strtoupper($purordermodhis['purordertwogst']):'B2B').' To '.(($purordertwogst!='')?strtoupper($purordertwogst):'B2B').' ) </span>';
}
}
if ($purordermodhis['purordertwopos']!=$purordertwopos) {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purordermodhis['purordertwopos']!='')?strtoupper($purordermodhis['purordertwopos']):'B2B').' To '.(($purordertwopos!='')?strtoupper($purordertwopos):'B2B').' ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purordermodhis['purordertwopos']!='')?strtoupper($purordermodhis['purordertwopos']):'B2B').' To '.(($purordertwopos!='')?strtoupper($purordertwopos):'B2B').' ) </span>';
}
}
if ($purordermodhis['purorderprintgsttreatment']!=$purorderprintgsttreatment) {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' GST Treatment Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purordermodhis['purorderprintgsttreatment']).' To '.strtoupper($purorderprintgsttreatment).' ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' GST Treatment Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purordermodhis['purorderprintgsttreatment']).' To '.strtoupper($purorderprintgsttreatment).' ) </span>';
}
}
if ($purordermodhis['purorderprintgstin']!=$purorderprintgstin) {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' GSTIN Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purordermodhis['purorderprintgstin']).' To '.strtoupper($purorderprintgstin).' ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' GSTIN Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purordermodhis['purorderprintgstin']).' To '.strtoupper($purorderprintgstin).' ) </span>';
}
}
if ($purordermodhis['purorderprintpos']!=$purorderprintpos) {
if ($ch!='') {
$ch.='<br> '.$purordermodhis['moduletype'].' Place Of Supply Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purordermodhis['purorderprintpos']).' To '.strtoupper($purorderprintpos).' ) </span>';
}
else{
$ch.=''.$purordermodhis['moduletype'].' Place Of Supply Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purordermodhis['purorderprintpos']).' To '.strtoupper($purorderprintpos).' ) </span>';
}
}
if ($purreceivemodhis['purreceiveveninfo']=='one') {
$oldpurreceive = "B2B";
}
else if ($purreceivemodhis['purreceiveveninfo']=='two') {
$oldpurreceive = "B2C";
}
else {
if ($purreceivemodhis['purreceiveveninfo']=='defone') {
$oldpurreceive = "Default B2B";
}
else {
$oldpurreceive = "Default B2C";
}
}
if ($purreceivevenomerinfodefault=='one') {
$newpurreceive = "B2B";
}
else if ($purreceivevenomerinfodefault=='two') {
$newpurreceive = "B2C";
}
else {
if ($purreceivevenomerinfodefault=='defone') {
$newpurreceive = "Default B2B";
}
else {
$newpurreceive = "Default B2C";
}
}
if ($oldpurreceive!=$newpurreceive) {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Customer Information Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($oldpurreceive).' To '.strtoupper($newpurreceive).' ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Customer Information Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($oldpurreceive).' To '.strtoupper($newpurreceive).' ) </span>';
}
}
if ($purreceivemodhis['purreceivetwogst']!=$purreceivetwogst) {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purreceivemodhis['purreceivetwogst']!='')?strtoupper($purreceivemodhis['purreceivetwogst']):'B2B').' To '.(($purreceivetwogst!='')?strtoupper($purreceivetwogst):'B2B').' ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purreceivemodhis['purreceivetwogst']!='')?strtoupper($purreceivemodhis['purreceivetwogst']):'B2B').' To '.(($purreceivetwogst!='')?strtoupper($purreceivetwogst):'B2B').' ) </span>';
}
}
if ($purreceivemodhis['purreceivetwopos']!=$purreceivetwopos) {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purreceivemodhis['purreceivetwopos']!='')?strtoupper($purreceivemodhis['purreceivetwopos']):'B2B').' To '.(($purreceivetwopos!='')?strtoupper($purreceivetwopos):'B2B').' ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purreceivemodhis['purreceivetwopos']!='')?strtoupper($purreceivemodhis['purreceivetwopos']):'B2B').' To '.(($purreceivetwopos!='')?strtoupper($purreceivetwopos):'B2B').' ) </span>';
}
}
if ($purreceivemodhis['purreceiveprintgsttreatment']!=$purreceiveprintgsttreatment) {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' GST Treatment Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreceivemodhis['purreceiveprintgsttreatment']).' To '.strtoupper($purreceiveprintgsttreatment).' ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' GST Treatment Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreceivemodhis['purreceiveprintgsttreatment']).' To '.strtoupper($purreceiveprintgsttreatment).' ) </span>';
}
}
if ($purreceivemodhis['purreceiveprintgstin']!=$purreceiveprintgstin) {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' GSTIN Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreceivemodhis['purreceiveprintgstin']).' To '.strtoupper($purreceiveprintgstin).' ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' GSTIN Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreceivemodhis['purreceiveprintgstin']).' To '.strtoupper($purreceiveprintgstin).' ) </span>';
}
}
if ($purreceivemodhis['purreceiveprintpos']!=$purreceiveprintpos) {
if ($ch!='') {
$ch.='<br> '.$purreceivemodhis['moduletype'].' Place Of Supply Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreceivemodhis['purreceiveprintpos']).' To '.strtoupper($purreceiveprintpos).' ) </span>';
}
else{
$ch.=''.$purreceivemodhis['moduletype'].' Place Of Supply Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreceivemodhis['purreceiveprintpos']).' To '.strtoupper($purreceiveprintpos).' ) </span>';
}
}
if ($purreturnmodhis['purreturnveninfo']=='one') {
$oldpurreturn = "B2B";
}
else if ($purreturnmodhis['purreturnveninfo']=='two') {
$oldpurreturn = "B2C";
}
else {
if ($purreturnmodhis['purreturnveninfo']=='defone') {
$oldpurreturn = "Default B2B";
}
else {
$oldpurreturn = "Default B2C";
}
}
if ($purreturnvenomerinfodefault=='one') {
$newpurreturn = "B2B";
}
else if ($purreturnvenomerinfodefault=='two') {
$newpurreturn = "B2C";
}
else {
if ($purreturnvenomerinfodefault=='defone') {
$newpurreturn = "Default B2B";
}
else {
$newpurreturn = "Default B2C";
}
}
if ($oldpurreturn!=$newpurreturn) {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Customer Information Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($oldpurreturn).' To '.strtoupper($newpurreturn).' ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Customer Information Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($oldpurreturn).' To '.strtoupper($newpurreturn).' ) </span>';
}
}
if ($purreturnmodhis['purreturntwogst']!=$purreturntwogst) {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purreturnmodhis['purreturntwogst']!='')?strtoupper($purreturnmodhis['purreturntwogst']):'B2B').' To '.(($purreturntwogst!='')?strtoupper($purreturntwogst):'B2B').' ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purreturnmodhis['purreturntwogst']!='')?strtoupper($purreturnmodhis['purreturntwogst']):'B2B').' To '.(($purreturntwogst!='')?strtoupper($purreturntwogst):'B2B').' ) </span>';
}
}
if ($purreturnmodhis['purreturntwopos']!=$purreturntwopos) {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purreturnmodhis['purreturntwopos']!='')?strtoupper($purreturnmodhis['purreturntwopos']):'B2B').' To '.(($purreturntwopos!='')?strtoupper($purreturntwopos):'B2B').' ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($purreturnmodhis['purreturntwopos']!='')?strtoupper($purreturnmodhis['purreturntwopos']):'B2B').' To '.(($purreturntwopos!='')?strtoupper($purreturntwopos):'B2B').' ) </span>';
}
}
if ($purreturnmodhis['purreturnprintgsttreatment']!=$purreturnprintgsttreatment) {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' GST Treatment Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreturnmodhis['purreturnprintgsttreatment']).' To '.strtoupper($purreturnprintgsttreatment).' ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' GST Treatment Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreturnmodhis['purreturnprintgsttreatment']).' To '.strtoupper($purreturnprintgsttreatment).' ) </span>';
}
}
if ($purreturnmodhis['purreturnprintgstin']!=$purreturnprintgstin) {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' GSTIN Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreturnmodhis['purreturnprintgstin']).' To '.strtoupper($purreturnprintgstin).' ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' GSTIN Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreturnmodhis['purreturnprintgstin']).' To '.strtoupper($purreturnprintgstin).' ) </span>';
}
}
if ($purreturnmodhis['purreturnprintpos']!=$purreturnprintpos) {
if ($ch!='') {
$ch.='<br> '.$purreturnmodhis['moduletype'].' Place Of Supply Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreturnmodhis['purreturnprintpos']).' To '.strtoupper($purreturnprintpos).' ) </span>';
}
else{
$ch.=''.$purreturnmodhis['moduletype'].' Place Of Supply Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($purreturnmodhis['purreturnprintpos']).' To '.strtoupper($purreturnprintpos).' ) </span>';
}
}
if ($billmodhis['billveninfo']=='one') {
$oldbill = "B2B";
}
else if ($billmodhis['billveninfo']=='two') {
$oldbill = "B2C";
}
else {
if ($billmodhis['billveninfo']=='defone') {
$oldbill = "Default B2B";
}
else {
$oldbill = "Default B2C";
}
}
if ($billvenomerinfodefault=='one') {
$newbill = "B2B";
}
else if ($billvenomerinfodefault=='two') {
$newbill = "B2C";
}
else {
if ($billvenomerinfodefault=='defone') {
$newbill = "Default B2B";
}
else {
$newbill = "Default B2C";
}
}
if ($oldbill!=$newbill) {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Customer Information Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($oldbill).' To '.strtoupper($newbill).' ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Customer Information Defaults <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($oldbill).' To '.strtoupper($newbill).' ) </span>';
}
}
if ($billmodhis['billtwogst']!=$billtwogst) {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($billmodhis['billtwogst']!='')?strtoupper($billmodhis['billtwogst']):'B2B').' To '.(($billtwogst!='')?strtoupper($billtwogst):'B2B').' ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' GST Registration Type Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($billmodhis['billtwogst']!='')?strtoupper($billmodhis['billtwogst']):'B2B').' To '.(($billtwogst!='')?strtoupper($billtwogst):'B2B').' ) </span>';
}
}
if ($billmodhis['billtwopos']!=$billtwopos) {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($billmodhis['billtwopos']!='')?strtoupper($billmodhis['billtwopos']):'B2B').' To '.(($billtwopos!='')?strtoupper($billtwopos):'B2B').' ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Place Of Supply Defaults <span style="color:green;" id="prohisfromtospan">( From '.(($billmodhis['billtwopos']!='')?strtoupper($billmodhis['billtwopos']):'B2B').' To '.(($billtwopos!='')?strtoupper($billtwopos):'B2B').' ) </span>';
}
}
if ($billmodhis['billprintgsttreatment']!=$billprintgsttreatment) {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' GST Treatment Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['billprintgsttreatment']).' To '.strtoupper($billprintgsttreatment).' ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' GST Treatment Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['billprintgsttreatment']).' To '.strtoupper($billprintgsttreatment).' ) </span>';
}
}
if ($billmodhis['billprintgstin']!=$billprintgstin) {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' GSTIN Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['billprintgstin']).' To '.strtoupper($billprintgstin).' ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' GSTIN Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['billprintgstin']).' To '.strtoupper($billprintgstin).' ) </span>';
}
}
if ($billmodhis['billprintpos']!=$billprintpos) {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' Place Of Supply Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['billprintpos']).' To '.strtoupper($billprintpos).' ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' Place Of Supply Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['billprintpos']).' To '.strtoupper($billprintpos).' ) </span>';
}
}
if ($billmodhis['viewprintdlno20']!=$billviewprintdlno20) {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' DL No 20 Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['viewprintdlno20']).' To '.strtoupper($billviewprintdlno20).' ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' DL No 20 Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['viewprintdlno20']).' To '.strtoupper($billviewprintdlno20).' ) </span>';
}
}
if ($billmodhis['viewprintdlno21']!=$billviewprintdlno21) {
if ($ch!='') {
$ch.='<br> '.$billmodhis['moduletype'].' DL No 21 Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['viewprintdlno21']).' To '.strtoupper($billviewprintdlno21).' ) </span>';
}
else{
$ch.=''.$billmodhis['moduletype'].' DL No 21 Print <span style="color:green;" id="prohisfromtospan">( From '.strtoupper($billmodhis['viewprintdlno21']).' To '.strtoupper($billviewprintdlno21).' ) </span>';
}
}

    
    $sqlmainaccessven = "update pairmainaccess set placeofsupplydefaultven='$placeofsupplydefaultven',vendorvisible='$vendorvisible',gsttypeven='$gsttypeven' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Vendors'"; 
        $sqlmainaccessupven = mysqli_query($con, $sqlmainaccessven);

$sqlmainaccessdefpurorder = "update pairmainaccess set purordertwogst='$purordertwogst',purordertwopos='$purordertwopos',purorderveninfo='$purorderveninfodefault',purorderprintpos='$purorderprintpos',purorderprintgsttreatment='$purorderprintgsttreatment',purorderprintgstin='$purorderprintgstin' where (userid='$companymainid' or createdid='$companymainid' or franchiseid='".$_SESSION['franchisesession']."') and moduletype='Purchase Orders'"; 
        $sqlmainaccessdefpurorderup = mysqli_query($con, $sqlmainaccessdefpurorder);

$sqlmainaccessdefpurreceive = "update pairmainaccess set purreceivetwogst='$purreceivetwogst',purreceivetwopos='$purreceivetwopos',purreceiveveninfo='$purreceiveveninfodefault',purreceiveprintpos='$purreceiveprintpos',purreceiveprintgsttreatment='$purreceiveprintgsttreatment',purreceiveprintgstin='$purreceiveprintgstin' where (userid='$companymainid' or createdid='$companymainid' or franchiseid='".$_SESSION['franchisesession']."') and moduletype='Purchase Receives'"; 
$sqlmainaccessdefpurreceiveup = mysqli_query($con, $sqlmainaccessdefpurreceive);

$sqlmainaccessdefpurreturn = "update pairmainaccess set purreturntwogst='$purreturntwogst',purreturntwopos='$purreturntwopos',purreturnveninfo='$purreturnveninfodefault',purreturnprintpos='$purreturnprintpos',purreturnprintgsttreatment='$purreturnprintgsttreatment',purreturnprintgstin='$purreturnprintgstin' where (userid='$companymainid' or createdid='$companymainid' or franchiseid='".$_SESSION['franchisesession']."') and moduletype='Purchase Returns'"; 
$sqlmainaccessdefpurreturnup = mysqli_query($con, $sqlmainaccessdefpurreturn);

$sqlmainaccessdefbill = "update pairmainaccess set billtwogst='$billtwogst',billtwopos='$billtwopos',billveninfo='$billveninfodefault',viewprintdlno20='$billviewprintdlno20',viewprintdlno21='$billviewprintdlno21',billprintpos='$billprintpos',billprintgsttreatment='$billprintgsttreatment',billprintgstin='$billprintgstin' where (userid='$companymainid' or createdid='$companymainid' or franchiseid='".$_SESSION['franchisesession']."') and moduletype='Bills'"; 
$sqlmainaccessdefbillup = mysqli_query($con, $sqlmainaccessdefbill);

    $sqlmainaccesspayable = "update pairmainaccess set payablepurchase='$payablepurchase' where (userid='$companymainid' or createdid='0' or franchiseid='".$_SESSION['franchisesession']."')"; 
        $sqlmainaccesspayableup = mysqli_query($con, $sqlmainaccesspayable);

$sqlmainaccessdefdrnotes = "update pairmainaccess set debitnotetwogst='$debitnotetwogst',debitnotetwopos='$debitnotetwopos',debitnoteveninfo='$debitnoteveninfodefault' where (userid='$companymainid' or createdid='$companymainid' or franchiseid='".$_SESSION['franchisesession']."') and moduletype='Debit Notes'"; 
$sqlmainaccessdefdrnotesup = mysqli_query($con, $sqlmainaccessdefdrnotes);

    // $vendorhead=mysqli_real_escape_string($con, (isset($_POST['vendorhead']))?'1':'0');
    // $veninfoadd=mysqli_real_escape_string($con, (isset($_POST['veninfoadd']))?'1':'0');
    // $veninfoedit=mysqli_real_escape_string($con, (isset($_POST['veninfoedit']))?'1':'0');
    // $veninfoview=mysqli_real_escape_string($con, (isset($_POST['veninfoview']))?'1':'0');
    // $vendorname=mysqli_real_escape_string($con, (isset($_POST['vendorname']))?'1':'0');
    // $vennadd=mysqli_real_escape_string($con, (isset($_POST['vennadd']))?'1':'0');
    // $vennedit=mysqli_real_escape_string($con, (isset($_POST['vennedit']))?'1':'0');
    // $vennview=mysqli_real_escape_string($con, (isset($_POST['vennview']))?'1':'0');
    // $vencode=mysqli_real_escape_string($con, (isset($_POST['vencode']))?'1':'0');
    // $vencodeadd=mysqli_real_escape_string($con, (isset($_POST['vencodeadd']))?'1':'0');
    // $vencodeedit=mysqli_real_escape_string($con, (isset($_POST['vencodeedit']))?'1':'0');
    // $vencodeview=mysqli_real_escape_string($con, (isset($_POST['vencodeview']))?'1':'0');
    // $venpcontacthead=mysqli_real_escape_string($con, (isset($_POST['venpcontacthead']))?'1':'0');
    // $venpcontactadd=mysqli_real_escape_string($con, (isset($_POST['venpcontactadd']))?'1':'0');
    // $venpcontactedit=mysqli_real_escape_string($con, (isset($_POST['venpcontactedit']))?'1':'0');
    // $venpcontactview=mysqli_real_escape_string($con, (isset($_POST['venpcontactview']))?'1':'0');
    // $vencnamehead=mysqli_real_escape_string($con, (isset($_POST['vencnamehead']))?'1':'0');
    // $vencnameadd=mysqli_real_escape_string($con, (isset($_POST['vencnameadd']))?'1':'0');
    // $vencnameedit=mysqli_real_escape_string($con, (isset($_POST['vencnameedit']))?'1':'0');
    // $vencnameview=mysqli_real_escape_string($con, (isset($_POST['vencnameview']))?'1':'0');
    // $venidhead=mysqli_real_escape_string($con, (isset($_POST['venidhead']))?'1':'0');
    // $venidadd=mysqli_real_escape_string($con, (isset($_POST['venidadd']))?'1':'0');
    // $venidedit=mysqli_real_escape_string($con, (isset($_POST['venidedit']))?'1':'0');
    // $venidview=mysqli_real_escape_string($con, (isset($_POST['venidview']))?'1':'0');
    // $venbillhead=mysqli_real_escape_string($con, (isset($_POST['venbillhead']))?'1':'0');
    // $venbilladd=mysqli_real_escape_string($con, (isset($_POST['venbilladd']))?'1':'0');
    // $venbilledit=mysqli_real_escape_string($con, (isset($_POST['venbilledit']))?'1':'0');
    // $venbillview=mysqli_real_escape_string($con, (isset($_POST['venbillview']))?'1':'0');
    // $venshiphead=mysqli_real_escape_string($con, (isset($_POST['venshiphead']))?'1':'0');
    // $venshipadd=mysqli_real_escape_string($con, (isset($_POST['venshipadd']))?'1':'0');
    // $venshipedit=mysqli_real_escape_string($con, (isset($_POST['venshipedit']))?'1':'0');
    // $venshipview=mysqli_real_escape_string($con, (isset($_POST['venshipview']))?'1':'0');
    // $venvisinfo=mysqli_real_escape_string($con, (isset($_POST['venvisinfo']))?'1':'0');
    // $venvisadd=mysqli_real_escape_string($con, (isset($_POST['venvisadd']))?'1':'0');
    // $venvisedit=mysqli_real_escape_string($con, (isset($_POST['venvisedit']))?'1':'0');
    // $venvisview=mysqli_real_escape_string($con, (isset($_POST['venvisview']))?'1':'0');
    // $vencathead=mysqli_real_escape_string($con, (isset($_POST['vencathead']))?'1':'0');
    // $vencatadd=mysqli_real_escape_string($con, (isset($_POST['vencatadd']))?'1':'0');
    // $vencatedit=mysqli_real_escape_string($con, (isset($_POST['vencatedit']))?'1':'0');
    // $vencatview=mysqli_real_escape_string($con, (isset($_POST['vencatview']))?'1':'0');
    // $vensubhead=mysqli_real_escape_string($con, (isset($_POST['vensubhead']))?'1':'0');
    // $vensubadd=mysqli_real_escape_string($con, (isset($_POST['vensubadd']))?'1':'0');
    // $vensubedit=mysqli_real_escape_string($con, (isset($_POST['vensubedit']))?'1':'0');
    // $vensubview=mysqli_real_escape_string($con, (isset($_POST['vensubview']))?'1':'0');
    // $ventaxinfo=mysqli_real_escape_string($con, (isset($_POST['ventaxinfo']))?'1':'0');
    // $ventaxadd=mysqli_real_escape_string($con, (isset($_POST['ventaxadd']))?'1':'0');
    // $ventaxedit=mysqli_real_escape_string($con, (isset($_POST['ventaxedit']))?'1':'0');
    // $ventaxview=mysqli_real_escape_string($con, (isset($_POST['ventaxview']))?'1':'0');

    // $venlistserial=mysqli_real_escape_string($con, (isset($_POST['venlistserialhead']))?'1':'0');
    // $venlistname=mysqli_real_escape_string($con, (isset($_POST['venlistnamehead']))?'1':'0');
    // $venlistaddress=mysqli_real_escape_string($con, (isset($_POST['venlistaddresshead']))?'1':'0');
    // $venlistmail=mysqli_real_escape_string($con, (isset($_POST['venlistmailhead']))?'1':'0');
    // $venlistmobile=mysqli_real_escape_string($con, (isset($_POST['venlistmobilehead']))?'1':'0');
    // $venlistaction=mysqli_real_escape_string($con, (isset($_POST['venlistactionhead']))?'1':'0');

    // $venmailhead=mysqli_real_escape_string($con, (isset($_POST['venmailhead']))?'1':'0');
    // $venmailadd=mysqli_real_escape_string($con, (isset($_POST['venmailadd']))?'1':'0');
    // $venmailedit=mysqli_real_escape_string($con, (isset($_POST['venmailedit']))?'1':'0');
    // $venmailview=mysqli_real_escape_string($con, (isset($_POST['venmailview']))?'1':'0');
    // $venphonehead=mysqli_real_escape_string($con, (isset($_POST['venphonehead']))?'1':'0');
    // $venphoneadd=mysqli_real_escape_string($con, (isset($_POST['venphoneadd']))?'1':'0');
    // $venphoneedit=mysqli_real_escape_string($con, (isset($_POST['venphoneedit']))?'1':'0');
    // $venphoneview=mysqli_real_escape_string($con, (isset($_POST['venphoneview']))?'1':'0');
    // $venwebhead=mysqli_real_escape_string($con, (isset($_POST['venwebhead']))?'1':'0');
    // $venwebadd=mysqli_real_escape_string($con, (isset($_POST['venwebadd']))?'1':'0');
    // $venwebedit=mysqli_real_escape_string($con, (isset($_POST['venwebedit']))?'1':'0');
    // $venwebview=mysqli_real_escape_string($con, (isset($_POST['venwebview']))?'1':'0');
    // $venmobilephonehead=mysqli_real_escape_string($con, (isset($_POST['venmobilephonehead']))?'1':'0');
    // $venmobilephoneadd=mysqli_real_escape_string($con, (isset($_POST['venmobilephoneadd']))?'1':'0');
    // $venmobilephoneedit=mysqli_real_escape_string($con, (isset($_POST['venmobilephoneedit']))?'1':'0');
    // $venmobilephoneview=mysqli_real_escape_string($con, (isset($_POST['venmobilephoneview']))?'1':'0');

    // $ventaxpreferhead=mysqli_real_escape_string($con, (isset($_POST['ventaxpreferhead']))?'1':'0');
    // $ventaxpreferadd=mysqli_real_escape_string($con, (isset($_POST['ventaxpreferadd']))?'1':'0');
    // $ventaxpreferedit=mysqli_real_escape_string($con, (isset($_POST['ventaxpreferedit']))?'1':'0');
    // $ventaxpreferview=mysqli_real_escape_string($con, (isset($_POST['ventaxpreferview']))?'1':'0');
    // $vengstrtypehead=mysqli_real_escape_string($con, (isset($_POST['vengstrtypehead']))?'1':'0');
    // $vengstrtypeadd=mysqli_real_escape_string($con, (isset($_POST['vengstrtypeadd']))?'1':'0');
    // $vengstrtypeedit=mysqli_real_escape_string($con, (isset($_POST['vengstrtypeedit']))?'1':'0');
    // $vengstrtypeview=mysqli_real_escape_string($con, (isset($_POST['vengstrtypeview']))?'1':'0');
    // $vengstinhead=mysqli_real_escape_string($con, (isset($_POST['vengstinhead']))?'1':'0');
    // $vengstinadd=mysqli_real_escape_string($con, (isset($_POST['vengstinadd']))?'1':'0');
    // $vengstinedit=mysqli_real_escape_string($con, (isset($_POST['vengstinedit']))?'1':'0');
    // $vengstinview=mysqli_real_escape_string($con, (isset($_POST['vengstinview']))?'1':'0');
    // $venbusleghead=mysqli_real_escape_string($con, (isset($_POST['venbusleghead']))?'1':'0');
    // $venbuslegadd=mysqli_real_escape_string($con, (isset($_POST['venbuslegadd']))?'1':'0');
    // $venbuslegedit=mysqli_real_escape_string($con, (isset($_POST['venbuslegedit']))?'1':'0');
    // $venbuslegview=mysqli_real_escape_string($con, (isset($_POST['venbuslegview']))?'1':'0');
    // $venbustrdhead=mysqli_real_escape_string($con, (isset($_POST['venbustrdhead']))?'1':'0');
    // $venbustrdadd=mysqli_real_escape_string($con, (isset($_POST['venbustrdadd']))?'1':'0');
    // $venbustrdedit=mysqli_real_escape_string($con, (isset($_POST['venbustrdedit']))?'1':'0');
    // $venbustrdview=mysqli_real_escape_string($con, (isset($_POST['venbustrdview']))?'1':'0');
    // $venpanhead=mysqli_real_escape_string($con, (isset($_POST['venpanhead']))?'1':'0');
    // $venpanadd=mysqli_real_escape_string($con, (isset($_POST['venpanadd']))?'1':'0');
    // $venpanedit=mysqli_real_escape_string($con, (isset($_POST['venpanedit']))?'1':'0');
    // $venpanview=mysqli_real_escape_string($con, (isset($_POST['venpanview']))?'1':'0');
    // $venposhead=mysqli_real_escape_string($con, (isset($_POST['venposhead']))?'1':'0');
    // $venposadd=mysqli_real_escape_string($con, (isset($_POST['venposadd']))?'1':'0');
    // $venposedit=mysqli_real_escape_string($con, (isset($_POST['venposedit']))?'1':'0');
    // $venposview=mysqli_real_escape_string($con, (isset($_POST['venposview']))?'1':'0');

    // // $custaxinfo=mysqli_real_escape_string($con, (isset($_POST['custaxinfo']))?'1':'0');
    // // $custaxadd=mysqli_real_escape_string($con, (isset($_POST['custaxadd']))?'1':'0');
    // // $custaxedit=mysqli_real_escape_string($con, (isset($_POST['custaxedit']))?'1':'0');
    // // $custaxview=mysqli_real_escape_string($con, (isset($_POST['custaxview']))?'1':'0');
    // // $cuspayinfo=mysqli_real_escape_string($con, (isset($_POST['cuspayinfo']))?'1':'0');
    // // $cuspayadd=mysqli_real_escape_string($con, (isset($_POST['cuspayadd']))?'1':'0');
    // // $cuspayedit=mysqli_real_escape_string($con, (isset($_POST['cuspayedit']))?'1':'0');
    // // $cuspayview=mysqli_real_escape_string($con, (isset($_POST['cuspayview']))?'1':'0');
    // // $cusbankinfo=mysqli_real_escape_string($con, (isset($_POST['cusbankinfo']))?'1':'0');
    // // $cusbankadd=mysqli_real_escape_string($con, (isset($_POST['cusbankadd']))?'1':'0');
    // // $cusbankedit=mysqli_real_escape_string($con, (isset($_POST['cusbankedit']))?'1':'0');
    // // $cusbankview=mysqli_real_escape_string($con, (isset($_POST['cusbankview']))?'1':'0');
    // // $cusothinfo=mysqli_real_escape_string($con, (isset($_POST['cusothinfo']))?'1':'0');
    // // $cusothadd=mysqli_real_escape_string($con, (isset($_POST['cusothadd']))?'1':'0');
    // // $cusothedit=mysqli_real_escape_string($con, (isset($_POST['cusothedit']))?'1':'0');
    // // $cusothview=mysqli_real_escape_string($con, (isset($_POST['cusothview']))?'1':'0');
    // // $cusattinfo=mysqli_real_escape_string($con, (isset($_POST['cusattinfo']))?'1':'0');
    // // $cusattadd=mysqli_real_escape_string($con, (isset($_POST['cusattadd']))?'1':'0');
    // // $cusattedit=mysqli_real_escape_string($con, (isset($_POST['cusattedit']))?'1':'0');
    // // $cusattview=mysqli_real_escape_string($con, (isset($_POST['cusattview']))?'1':'0');
    // // $invinfo=mysqli_real_escape_string($con, (isset($_POST['invinfo']))?'1':'0');
    // // $invinfoadd=mysqli_real_escape_string($con, (isset($_POST['invinfoadd']))?'1':'0');
    // // $invinfoedit=mysqli_real_escape_string($con, (isset($_POST['invinfoedit']))?'1':'0');
    // // $invinfoview=mysqli_real_escape_string($con, (isset($_POST['invinfoview']))?'1':'0');
    // // $invcusinfo=mysqli_real_escape_string($con, (isset($_POST['invcusinfo']))?'1':'0');
    // // $invcusadd=mysqli_real_escape_string($con, (isset($_POST['invcusadd']))?'1':'0');
    // // $invcusedit=mysqli_real_escape_string($con, (isset($_POST['invcusedit']))?'1':'0');
    // // $invcusview=mysqli_real_escape_string($con, (isset($_POST['invcusview']))?'1':'0');
    // // $invitminfo=mysqli_real_escape_string($con, (isset($_POST['invitminfo']))?'1':'0');
    // // $invitmadd=mysqli_real_escape_string($con, (isset($_POST['invitmadd']))?'1':'0');
    // // $invitmedit=mysqli_real_escape_string($con, (isset($_POST['invitmedit']))?'1':'0');
    // // $invitmview=mysqli_real_escape_string($con, (isset($_POST['invitmview']))?'1':'0');
    // // $cusidhead=mysqli_real_escape_string($con, (isset($_POST['cusidhead']))?'1':'0');
    // // $cusidadd=mysqli_real_escape_string($con, (isset($_POST['cusidadd']))?'1':'0');
    // // $cusidedit=mysqli_real_escape_string($con, (isset($_POST['cusidedit']))?'1':'0');
    // // $cusidview=mysqli_real_escape_string($con, (isset($_POST['cusidview']))?'1':'0');
    // // $cuspcontacthead=mysqli_real_escape_string($con, (isset($_POST['cuspcontacthead']))?'1':'0');
    // // $cuspcontactadd=mysqli_real_escape_string($con, (isset($_POST['cuspcontactadd']))?'1':'0');
    // // $cuspcontactedit=mysqli_real_escape_string($con, (isset($_POST['cuspcontactedit']))?'1':'0');
    // // $cuspcontactview=mysqli_real_escape_string($con, (isset($_POST['cuspcontactview']))?'1':'0');
    // // $cuscnamehead=mysqli_real_escape_string($con, (isset($_POST['cuscnamehead']))?'1':'0');
    // // $cuscnameadd=mysqli_real_escape_string($con, (isset($_POST['cuscnameadd']))?'1':'0');
    // // $cuscnameedit=mysqli_real_escape_string($con, (isset($_POST['cuscnameedit']))?'1':'0');
    // // // $cuscnameview=mysqli_real_escape_string($con, (isset($_POST['cuscnameview']))?'1':'0');
    // // $vengenhead=mysqli_real_escape_string($con, (isset($_POST['vengenhead']))?'1':'0');
    // // $vengenadd=mysqli_real_escape_string($con, (isset($_POST['vengenadd']))?'1':'0');
    // // $vengenedit=mysqli_real_escape_string($con, (isset($_POST['vengenedit']))?'1':'0');
    // // $vengenview=mysqli_real_escape_string($con, (isset($_POST['vengenview']))?'1':'0');
    // // $venagehead=mysqli_real_escape_string($con, (isset($_POST['venagehead']))?'1':'0');
    // // $venageadd=mysqli_real_escape_string($con, (isset($_POST['venageadd']))?'1':'0');
    // // $venageedit=mysqli_real_escape_string($con, (isset($_POST['venageedit']))?'1':'0');
    // // $venageview=mysqli_real_escape_string($con, (isset($_POST['venageview']))?'1':'0');
    // // $qtcusinfo=mysqli_real_escape_string($con, (isset($_POST['qtcusinfo']))?'1':'0');
    // // $qtcusadd=mysqli_real_escape_string($con, (isset($_POST['qtcusadd']))?'1':'0');
    // // $qtcusedit=mysqli_real_escape_string($con, (isset($_POST['qtcusedit']))?'1':'0');
    // // $qtcusview=mysqli_real_escape_string($con, (isset($_POST['qtcusview']))?'1':'0');
    // // $qtqtinfo=mysqli_real_escape_string($con, (isset($_POST['qtqtinfo']))?'1':'0');
    // // $qtqtadd=mysqli_real_escape_string($con, (isset($_POST['qtqtadd']))?'1':'0');
    // // $qtqtedit=mysqli_real_escape_string($con, (isset($_POST['qtqtedit']))?'1':'0');
    // // $qtqtview=mysqli_real_escape_string($con, (isset($_POST['qtqtview']))?'1':'0');
    // // $qtitinfo=mysqli_real_escape_string($con, (isset($_POST['qtitinfo']))?'1':'0');
    // // $qtitadd=mysqli_real_escape_string($con, (isset($_POST['qtitadd']))?'1':'0');
    // // $qtitedit=mysqli_real_escape_string($con, (isset($_POST['qtitedit']))?'1':'0');
    // // $qtitview=mysqli_real_escape_string($con, (isset($_POST['qtitview']))?'1':'0');

    // $sqlup=mysqli_query($con,"update paircontrols set vendorhead='$vendorhead',vendorname='$vendorname',veninfoadd='$veninfoadd',veninfoedit='$veninfoedit',veninfoview='$veninfoview',vencode='$vencode',vencodeadd='$vencodeadd',vencodeedit='$vencodeedit',vencodeview='$vencodeview',vennadd='$vennadd',vennedit='$vennedit',vennview='$vennview',venpcontacthead='$venpcontacthead',venpcontactadd='$venpcontactadd',venpcontactedit='$venpcontactedit',venpcontactview='$venpcontactview',vencnamehead='$vencnamehead',vencnameadd='$vencnameadd',vencnameedit='$vencnameedit',vencnameview='$vencnameview',venidhead='$venidhead',venidadd='$venidadd',venidedit='$venidedit',venidview='$venidview',venbillhead='$venbillhead',venbilladd='$venbilladd',venbilledit='$venbilledit',venbillview='$venbillview',venshiphead='$venshiphead',venshipadd='$venshipadd',venshipedit='$venshipedit',venshipview='$venshipview',venvisinfo='$venvisinfo',venvisadd='$venvisadd',venvisedit='$venvisedit',venvisview='$venvisview',vencathead='$vencathead',vencatadd='$vencatadd',vencatedit='$vencatedit',vencatview='$vencatview',vensubhead='$vensubhead',vensubadd='$vensubadd',vensubedit='$vensubedit',vensubview='$vensubview',ventaxinfo='$ventaxinfo',ventaxadd='$ventaxadd',ventaxedit='$ventaxedit',ventaxview='$ventaxview',venlistserial='$venlistserial',venlistname='$venlistname',venlistaddress='$venlistaddress',venlistmail='$venlistmail',venlistmobile='$venlistmobile',venlistaction='$venlistaction',venmailhead='$venmailhead',venmailadd='$venmailadd',venmailedit='$venmailedit',venmailview='$venmailview',venphonehead='$venphonehead',venphoneadd='$venphoneadd',venphoneedit='$venphoneedit',venphoneview='$venphoneview',venwebhead='$venwebhead',venwebadd='$venwebadd',venwebedit='$venwebedit',venwebview='$venwebview',venmobilephonehead='$venmobilephonehead',venmobilephoneadd='$venmobilephoneadd',venmobilephoneedit='$venmobilephoneedit',venmobilephoneview='$venmobilephoneview',ventaxprefer='$ventaxpreferhead',ventaxpreferadd='$ventaxpreferadd',ventaxpreferedit='$ventaxpreferedit',ventaxpreferview='$ventaxpreferview',vengstrtype='$vengstrtypehead',vengstrtypeadd='$vengstrtypeadd',vengstrtypeedit='$vengstrtypeedit',vengstrtypeview='$vengstrtypeview',vengstin='$vengstinhead',vengstinadd='$vengstinadd',vengstinedit='$vengstinedit',vengstinview='$vengstinview',venbusleg='$venbusleghead',venbuslegadd='$venbuslegadd',venbuslegedit='$venbuslegedit',venbuslegview='$venbuslegview',venbustrd='$venbustrdhead',venbustrdadd='$venbustrdadd',venbustrdedit='$venbustrdedit',venbustrdview='$venbustrdview',venpan='$venpanhead',venpanadd='$venpanadd',venpanedit='$venpanedit',venpanview='$venpanview',venpos='$venposhead',venposadd='$venposadd',venposedit='$venposedit',venposview='$venposview' where id='$companymainid' or createdid='$companymainid'");
    // // $permissionitems=mysqli_real_escape_string($con, (isset($_POST['items']))?'1':'0');
    // // $permissionproducts=mysqli_real_escape_string($con, (isset($_POST['product']))?'1':'0');
    // $purorderdatelist=mysqli_real_escape_string($con, (isset($_POST['purorderdatelist']))?'1':'0');
    // $purordernolist=mysqli_real_escape_string($con, (isset($_POST['purordernolist']))?'1':'0');
    // $purordervendornamelist=mysqli_real_escape_string($con, (isset($_POST['purordervendornamelist']))?'1':'0');
    // $purordertermlist=mysqli_real_escape_string($con, (isset($_POST['purordertermlist']))?'1':'0');
    // $purorderamountlist=mysqli_real_escape_string($con, (isset($_POST['purorderamountlist']))?'1':'0');
    // $purordereditlist=mysqli_real_escape_string($con, (isset($_POST['purordereditlist']))?'1':'0');
    // $purorderprintlist=mysqli_real_escape_string($con, (isset($_POST['purorderprintlist']))?'1':'0');
    // $purordergeneratebilllist=mysqli_real_escape_string($con, (isset($_POST['purordergeneratebilllist']))?'1':'0');
    // $billdatelist=mysqli_real_escape_string($con, (isset($_POST['billdatelist']))?'1':'0');
    // $billnolist=mysqli_real_escape_string($con, (isset($_POST['billnolist']))?'1':'0');
    // $billvendornamelist=mysqli_real_escape_string($con, (isset($_POST['billvendornamelist']))?'1':'0');
    // $billtermlist=mysqli_real_escape_string($con, (isset($_POST['billtermlist']))?'1':'0');
    // $billamountlist=mysqli_real_escape_string($con, (isset($_POST['billamountlist']))?'1':'0');
    // $billstatuslist=mysqli_real_escape_string($con, (isset($_POST['billstatuslist']))?'1':'0');
    // $billbalancelist=mysqli_real_escape_string($con, (isset($_POST['billbalancelist']))?'1':'0');
    // $billprintlist=mysqli_real_escape_string($con, (isset($_POST['billprintlist']))?'1':'0');
    // $paymadedatelist=mysqli_real_escape_string($con, (isset($_POST['paymadedatelist']))?'1':'0');
    // $paymadenolist=mysqli_real_escape_string($con, (isset($_POST['paymadenolist']))?'1':'0');
    // $paymadevendornamelist=mysqli_real_escape_string($con, (isset($_POST['paymadevendornamelist']))?'1':'0');
    // $paymadetermlist=mysqli_real_escape_string($con, (isset($_POST['paymadetermlist']))?'1':'0');
    // $paymademodeofpaylist=mysqli_real_escape_string($con, (isset($_POST['paymademodeofpaylist']))?'1':'0');
    // $paymadeamountreceivedlist=mysqli_real_escape_string($con, (isset($_POST['paymadeamountreceivedlist']))?'1':'0');
    // $paymadenoteslist=mysqli_real_escape_string($con, (isset($_POST['paymadenoteslist']))?'1':'0');
    // $paymadeeditlist=mysqli_real_escape_string($con, (isset($_POST['paymadeeditlist']))?'1':'0');
    // $purreturndatelist=mysqli_real_escape_string($con, (isset($_POST['purreturndatelist']))?'1':'0');
    // $purreturnnolist=mysqli_real_escape_string($con, (isset($_POST['purreturnnolist']))?'1':'0');
    // $purreturnvendornamelist=mysqli_real_escape_string($con, (isset($_POST['purreturnvendornamelist']))?'1':'0');
    // $purreturntermlist=mysqli_real_escape_string($con, (isset($_POST['purreturntermlist']))?'1':'0');
    // $purreturnamountlist=mysqli_real_escape_string($con, (isset($_POST['purreturnamountlist']))?'1':'0');
    // $purreturnprintlist=mysqli_real_escape_string($con, (isset($_POST['purreturnprintlist']))?'1':'0');
    // $sqlup=mysqli_query($con,"update pairaccess set purorderdatelist='$purorderdatelist',purordernolist='$purordernolist',purordervendornamelist='$purordervendornamelist',purordertermlist='$purordertermlist',purorderamountlist='$purorderamountlist',purordereditlist='$purordereditlist',purorderprintlist='$purorderprintlist',purordergeneratebilllist='$purordergeneratebilllist',billdatelist='$billdatelist',billnolist='$billnolist',billvendornamelist='$billvendornamelist',billtermlist='$billtermlist',billamountlist='$billamountlist',billstatuslist='$billstatuslist',billbalancelist='$billbalancelist',billprintlist='$billprintlist',paymadedatelist='$paymadedatelist',paymadenolist='$paymadenolist',paymadevendornamelist='$paymadevendornamelist',paymadetermlist='$paymadetermlist',paymademodeofpaylist='$paymademodeofpaylist',paymadeamountreceivedlist='$paymadeamountreceivedlist',paymadenoteslist='$paymadenoteslist',paymadeeditlist='$paymadeeditlist',purreturndatelist='$purreturndatelist',purreturnnolist='$purreturnnolist',purreturnvendornamelist='$purreturnvendornamelist',purreturntermlist='$purreturntermlist',purreturnamountlist='$purreturnamountlist',purreturnprintlist='$purreturnprintlist' where createdid='$companymainid'");
    //  header('Location:preference_billing.php?remarks=Updated Successfully');
    // // ,proinfoview='$proinfoview',provisibility='$provishead',provisadd='$provisadd',provisedit='$provisedit',provisview='$provisview',proimage='$proimghead',proimgadd='$proimgadd',proimgedit='$proimgedit',proimgview='$proimgview',propurchase='$propurhead',propuradd='$propuradd',propuredit='$propuredit',propurview='$propurview',prosales='$prosalehead',prosaleadd='$prosaleadd',prosaleedit='$prosaleedit',prosaleview='$prosaleview',protaxes='$protaxhead',protaxadd='$protaxadd',protaxedit='$protaxedit',protaxview='$protaxview',proinventory='$proinvhead',proinvadd='$proinvadd',proinvedit='$proinvedit',proinvview='$proinvview',prostock='$prostkhead',prostkadd='$prostkadd',prostkedit='$prostkedit',prostkview='$prostkview',proother='$proothhead',proothadd='$proothadd',proothedit='$proothedit',proothview='$proothview'
  $sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Vendors' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Vendors' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendors' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."addvendors";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editvendors";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewvendors";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Vendors' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."vendorcol";
                $modcolumncolumn=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
               if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncolumn;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncolumn;
                }
                $modacchis=$coltypemod."vendorcol";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Vendors'"; 
                $sqlmainaccessupven = mysqli_query($con, $sqlmainaccess);
                if ($sqlmainaccessupven) {
  $sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Orders' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Orders' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Orders' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."addpurchaseorders";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editpurchaseorders";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewpurchaseorders";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Orders' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."purchaseordercol";
                $modcolumncolumn=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
               if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncolumn;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncolumn;
                }
                $modacchis=$coltypemod."purchaseordercol";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Purchase Orders'"; 
                $sqlmainaccessuppurorder = mysqli_query($con, $sqlmainaccess);
              }
                if ($sqlmainaccessuppurorder) {
  $sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Bills' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Bills' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Bills' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."addbills";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editbills";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewbills";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Bills' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."billcol";
                $modcolumncolumn=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
               if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncolumn;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncolumn;
                }
                $modacchis=$coltypemod."billcol";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Bills'"; 
                $sqlmainaccessupbill = mysqli_query($con, $sqlmainaccess);
              }
                if ($sqlmainaccessupbill) {
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Payments Made' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Payments Made' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Payments Made' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."addpaymades";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editpaymades";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewpaymades";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Payments Made' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."paymadecol";
                $modcolumncolumn=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
               if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncolumn;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncolumn;
                }
                $modacchis=$coltypemod."paymadecol";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Payments Made'"; 
                $sqlmainaccessuppaymade = mysqli_query($con, $sqlmainaccess);
              }
                if ($sqlmainaccessuppaymade) {
  $sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Returns' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Returns' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Returns' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."addpurchasereturns";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editpurchasereturns";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewpurchasereturns";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Returns' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."purreturncol";
                $modcolumncolumn=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
               if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncolumn;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncolumn;
                }
                $modacchis=$coltypemod."purreturncol";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Purchase Returns'"; 
                $sqlmainaccessuppurreturn = mysqli_query($con, $sqlmainaccess);
              }
              if ($sqlmainaccessuppurreturn) {
  $sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Receives' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Receives' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Receives' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."addpurchasereceives";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editpurchasereceives";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewpurchasereceives";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Receives' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."purchasereceivecol";
                $modcolumncolumn=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
               if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncolumn;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncolumn;
                }
                $modacchis=$coltypemod."purchasereceivecol";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Purchase Receives'"; 
                $sqlmainaccessuppurreceive = mysqli_query($con, $sqlmainaccess);
              }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Debit Notes' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Debit Notes' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Debit Notes' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."adddebitnotes";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editdebitnotes";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewdebitnotes";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Debit Notes' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."debitnotecol";
                $modcolumncolumn=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
               if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncolumn;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncolumn;
                }
                $modacchis=$coltypemod."debitnotecol";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Debit Notes'"; 
                $sqlmainaccessuppaymade = mysqli_query($con, $sqlmainaccess);
              if ($sqlmainaccessuppurreceive) {
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Vendor Refunds' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Vendor Refunds' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendor Refunds' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."addpaymadefor";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editpaymadefor";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewpaymadefor";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Vendor Refunds' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."purchasereturnpaycol";
                $modcolumncolumn=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
               if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncolumn;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncolumn;
                }
                $modacchis=$coltypemod."purchasereturnpaycol";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Vendor Refunds'"; 
                $sqlmainaccessuppurchasereturnpay = mysqli_query($con, $sqlmainaccess);
if($ch!='')
{
$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='Books', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$companymainid', useremarks='".$ch."'");
}
              }
// $sqlselbill=mysqli_query($con,"select * from pairmainaccess where moduletype='Bills'");
// $sqlselupbill=mysqli_fetch_array($sqlselbill);
// $addbill=$sqlselupbill['modulefieldcreate'].',Batch';
// $editbill=$sqlselupbill['modulefieldedit'].',Batch';
// $viewbill=$sqlselupbill['modulefieldview'].',Batch';
// $sqlupaccessbatchexpirybill=mysqli_query($con,"update pairmainaccess set modulefieldcreate='$addbill',modulefieldedit='$editbill',modulefieldview='$viewbill' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Bills'");
              header('Location:preference_billing.php?remarks=Updated Successfully');
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
      $sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Purchase' order by id  asc");
      $infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
?>
    <title>
        Preference &gt; <?= $row['books'] ?> &gt; <?= $infomainaccesspurchase['groupname'] ?>
    </title>
        <style type="text/css">
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
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.table td, .table th {
    white-space: normal;
}
    </style>
    <style>
   

    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }
    </style>
    <style>
   /* .accordion-button:not(.collapsed)::after {
        background-image: url();
        margin-left: -20px;
        margin-top: -5px;
    }

    .accordion-button:not(.collapsed) a.customcont-heading {
        border-bottom: 1.5px solid #000000;
        color: #000000;
    }*/
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}

.alignright
{
    text-align: right;
}


    @media screen and (min-device-width: 260px) and (max-device-width: 575px) { 
    /* STYLES HERE */

    /* STYLES HERE */
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}
.alignright{
    text-align: center;
    
}
.mobliview
{
    text-align: center;
    
}




}
@media screen and (min-device-width: 366px) and (max-device-width: 575px) { 
.row1
{
    width: auto;
}

}

    
    </style>

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
     <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -32px;border-radius: 0px !important;">
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
      <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -32px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>
                                    <?php
      $sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Purchase' order by id  asc");
      $infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
      $sqlismainaccessvendor=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendors' order by id  asc");
      $infomainaccessvendor=mysqli_fetch_array($sqlismainaccessvendor);
$sqlismainaccesspurchaseorder=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Orders' order by id  asc");
$infomainaccesspurchaseorder=mysqli_fetch_array($sqlismainaccesspurchaseorder);
$sqlismainaccesspurchasereceive=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Receives' order by id  asc");
$infomainaccesspurchasereceive=mysqli_fetch_array($sqlismainaccesspurchasereceive);
$sqlismainaccesspurchasebill=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Bills' order by id  asc");
$infomainaccesspurchasebill=mysqli_fetch_array($sqlismainaccesspurchasebill);
$sqlismainaccesspaymade=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Payments Made' order by id  asc");
$infomainaccesspaymade=mysqli_fetch_array($sqlismainaccesspaymade);
$sqlismainaccesspurchasereturn=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Returns' order by id  asc");
$infomainaccesspurchasereturn=mysqli_fetch_array($sqlismainaccesspurchasereturn);
$sqlismainaccesspurchasereturnpay=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendor Refunds' order by id  asc");
$infomainaccesspurchasereturnpay=mysqli_fetch_array($sqlismainaccesspurchasereturnpay);
$sqlismainaccessdebitnotes=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Debit Notes' order by id  asc");
$infomainaccessdebitnotes=mysqli_fetch_array($sqlismainaccessdebitnotes);
      ?>
             <div class="card card-body p-3 mt-5" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;max-width: 1650px;height: auto;">
                <form action="" method="post" style="position: relative;top: -27px;margin-bottom: -78px;z-index: 0;">
    <p class="mb-3" style="font-size: 14.6px;color: black;position: relative;top: 15px;"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference </a><span>&gt;</span><a href="preference_billing.php" style="color: #1878F1"> <!-- <i class="fa fa-book"></i> -->
                                    <?= $row['books'] ?> </a> &gt; <!-- <i class="fa fa-shopping-basket"></i>  --><?= $infomainaccesspurchase['groupname'] ?></p>
                                    <div class="mt-3" style="border-top: 1px solid #dee2e6;position: relative;top: 0px;"></div>
                                    <p class="mb-0" style="font-size: 20px;color: black;position: relative;top: 12px;"><?= $infomainaccesspurchase['groupname'] ?></p>
                                      <div style="margin-top: -42px !important;">
                                        <div style="visibility: visible;" id="arrowsalltabs">
<svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
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
        <script type="text/javascript">   
$(document).ready(function() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
window.onresize = function (event) {
applyOrientation();
}         
function applyOrientation() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
}
});
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
.nav-tabs button{
    margin-bottom: 2px !important;
}
.nav-tabs .customcont-header{
    border-bottom: 0px !important;
}
@media screen and (max-width: 1470px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 1471px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
  }
}
      </style>
    <div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: 9px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button <?=(($infomainaccessvendor['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=(($infomainaccessvendor['moduleaccess']=='1')?'active':'')?>" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccessvendor['modulename'] ?> 
</a>  
             
                </div></button>
                <button <?=(($infomainaccesspurchaseorder['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']=='1'))?'active':'')?>" id="nav-purorder-tab" data-bs-toggle="tab" data-bs-target="#nav-purorder" type="button" role="tab" aria-controls="nav-purorder"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccesspurchaseorder['modulename'] ?></a>  
             
                </div></button>
                <button <?=(($infomainaccesspurchasereceive['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']=='1'))?'active':'')?>" id="nav-purreceive-tab" data-bs-toggle="tab" data-bs-target="#nav-purreceive" type="button" role="tab" aria-controls="nav-purreceive"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccesspurchasereceive['modulename'] ?></a>  
             
                </div></button>
                <button <?=(($infomainaccesspurchasebill['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']=='1'))?'active':'')?>" id="nav-bills-tab" data-bs-toggle="tab" data-bs-target="#nav-bills" type="button" role="tab" aria-controls="nav-bills"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccesspurchasebill['modulename'] ?></a>  
             
                </div></button>
                <button <?=(($infomainaccesspaymade['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']!='1')&&($infomainaccesspaymade['moduleaccess']=='1'))?'active':'')?>" id="nav-paymade-tab" data-bs-toggle="tab" data-bs-target="#nav-paymade" type="button" role="tab" aria-controls="nav-paymade"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccesspaymade['modulename'] ?></a>  
             
                </div></button>
                <button <?=(($infomainaccesspurchasereturn['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']!='1')&&($infomainaccesspaymade['moduleaccess']!='1')&&($infomainaccesspurchasereturn['moduleaccess']=='1'))?'active':'')?>" id="nav-purreturn-tab" data-bs-toggle="tab" data-bs-target="#nav-purreturn" type="button" role="tab" aria-controls="nav-purreturn"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccesspurchasereturn['modulename'] ?></a>  
             
                </div></button>
                <button <?=(($infomainaccessdebitnotes['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']!='1')&&($infomainaccesspaymade['moduleaccess']!='1')&&($infomainaccesspurchasereturn['moduleaccess']!='1')&&($infomainaccessdebitnotes['moduleaccess']=='1'))?'active':'')?>" id="nav-debitnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-debitnotes" type="button" role="tab" aria-controls="nav-debitnotes"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccessdebitnotes['modulename'] ?></a>  
             
                </div></button>
                <button <?=(($infomainaccesspurchasereturnpay['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']!='1')&&($infomainaccesspaymade['moduleaccess']!='1')&&($infomainaccesspurchasereturn['moduleaccess']!='1')&&($infomainaccesspurchasereturnpay['moduleaccess']=='1')&&($infomainaccessdebitnotes['moduleaccess']!='1'))?'active':'')?>" id="nav-purchasereturnpay-tab" data-bs-toggle="tab" data-bs-target="#nav-purchasereturnpay" type="button" role="tab" aria-controls="nav-purchasereturnpay"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccesspurchasereturnpay['modulename'] ?></a>  
             
                </div></button>
 </div>
</div>
 <style type="text/css">
     /*.custom-control-label{
        color: red !important;
     }*/
 </style>
<div class="tab-content" id="nav-tabContent" style="position:relative;top: -18px;">
  <div class="tab-pane fade show mt-4 p-3 <?=(($infomainaccessvendor['moduleaccess']=='1')?'active':'')?>" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" <?=(($infomainaccessvendor['moduleaccess']=='1')?'':'style="display:none"')?>>
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallven">
<svg id="rightarrowvenacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowvenacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowvenacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowvenacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchvenacc() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#vendorfield').outerWidth()
            var scrollWidth = $('#vendorfield')[0].scrollWidth; 
            var scrollLeft = $('#vendorfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowvenacc').style.visibility = 'hidden';
            document.getElementById('rightarrowvenacc').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowvenacc').style.visibility = 'hidden';
            document.getElementById('leftarrowvenacc').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowvenacc').style.visibility = 'visible';
            document.getElementById('rightarrowvenacc').style.visibility = 'visible';
          }
            }
          }
          function leftarrowvenacc() {
            document.getElementById('vendorfield').scrollLeft += -90;
            var width = $('#vendorfield').outerWidth()
            var scrollWidth = $('#vendorfield')[0].scrollWidth; 
            var scrollLeft = $('#vendorfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowvenacc').style.visibility = 'hidden';
            document.getElementById('rightarrowvenacc').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowvenacc').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowvenacc() {
            document.getElementById('vendorfield').scrollLeft += 90;
            var width = $('#vendorfield').outerWidth()
            var scrollWidth = $('#vendorfield')[0].scrollWidth; 
            var scrollLeft = $('#vendorfield').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowvenacc').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowvenacc').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #vendorfield::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#vendorfield::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#vendorfield::-webkit-scrollbar-track {
  background-color: green;
}

#vendorfield::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#vendorfield::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallven{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallven{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchvenacc()" class="accordion-header scrollbar-2" id="vendorfield" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#vendorfields"
                                                    aria-expanded="true" aria-controls="vendorfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="vendorfields" class="accordion-collapse collapse show"
                                                aria-labelledby="vendorfield">
                                                <div class="accordion-body text-sm">
                                                   <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendors' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Vendors' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Vendor Information')||($newmoduleskey=='Vendors Visibility')||($newmoduleskey=='Tax Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Vendor Information')||($newmoduleskey=='Vendors Visibility')||($newmoduleskey=='Tax Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='VendorInformation')) {
                  $fullaccessans = 'vendor';
                }
                else if (($coltypemod=='VendorsVisibility')) {
                  $fullaccessans = 'vendorvisible';
                }
                else if (($coltypemod=='TaxInformation')) {
                  $fullaccessans = 'vendortax';
                }
                else if (($coltypemod=='OtherInformation')) {
                  $fullaccessans = 'vendorother';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>vendor()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Vendor Public Id')||($newmoduleskey=='Vendor Private Id')||($newmoduleskey=='Vendor Id')||($newmoduleskey=='Primary Contact')||($newmoduleskey=='Company Name')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Work Phone')||($newmoduleskey=='Mobile Phone')||($newmoduleskey=='Email')||($newmoduleskey=='Website')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Shipping Address'))?'vendors vendorsubhead':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='GST Registration Type')||($newmoduleskey=='GSTIN or UIN')||($newmoduleskey=='Business Legal Name')||($newmoduleskey=='Business Trade Name')||($newmoduleskey=='Pan')||($newmoduleskey=='Place Of Supply'))?'vendorstax vendortaxsubhead':'' ?> <?= (($newmoduleskey=='DL dot No dot or 20')||($newmoduleskey=='DL dot No dot or 21'))?'vendorsother vendorothersubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>vendor"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Vendor Display Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>vendor" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Vendor Information')||($newmoduleskey=='Vendors Visibility')||($newmoduleskey=='Tax Information')||($newmoduleskey=='Other Information'))?'royalblue':'' ?> !important;"> <?= str_replace("S dot NO", "(#) Row Number",str_replace(" or ", " /",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey)))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Vendor Public Id')||($newmoduleskey=='Vendor Private Id')||($newmoduleskey=='Vendor Id')||($newmoduleskey=='Primary Contact')||($newmoduleskey=='Company Name')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Work Phone')||($newmoduleskey=='Mobile Phone')||($newmoduleskey=='Email')||($newmoduleskey=='Website')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Shipping Address'))?'vendors':'' ?> <?= (($newmoduleskey=='Vendors Visibility'))?'vendorsvisible':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='GST Registration Type')||($newmoduleskey=='GSTIN or UIN')||($newmoduleskey=='Business Legal Name')||($newmoduleskey=='Business Trade Name')||($newmoduleskey=='Pan')||($newmoduleskey=='Place Of Supply'))?'vendorstax':'' ?> <?= (($newmoduleskey=='Other Information')||($newmoduleskey=='DL dot No dot or 20')||($newmoduleskey=='DL dot No dot or 21'))?'vendorsother':'' ?> <?= (($newmoduleskey=='Vendor Public Id')||($newmoduleskey=='Vendor Private Id')||($newmoduleskey=='Vendor Id')||($newmoduleskey=='Primary Contact')||($newmoduleskey=='Company Name')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Work Phone')||($newmoduleskey=='Mobile Phone')||($newmoduleskey=='Email')||($newmoduleskey=='Website')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Shipping Address'))?'vendoradd aevforvendor':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='GST Registration Type')||($newmoduleskey=='GSTIN or UIN')||($newmoduleskey=='Business Legal Name')||($newmoduleskey=='Business Trade Name')||($newmoduleskey=='Pan')||($newmoduleskey=='Place Of Supply'))?'vendortaxadd aevforvendortax':'' ?> <?= (($newmoduleskey=='DL dot No dot or 20')||($newmoduleskey=='DL dot No dot or 21'))?'vendorotheradd aevforvendorother':'' ?>" name="<?= $coltypemod; ?>addvendors" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>vendor" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Vendor Display Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>vendor" style="color:<?= (($newmoduleskey=='Vendor Information')||($newmoduleskey=='Vendors Visibility')||($newmoduleskey=='Tax Information')||($newmoduleskey=='Other Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Vendor Public Id')||($newmoduleskey=='Vendor Private Id')||($newmoduleskey=='Vendor Id')||($newmoduleskey=='Primary Contact')||($newmoduleskey=='Company Name')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Work Phone')||($newmoduleskey=='Mobile Phone')||($newmoduleskey=='Email')||($newmoduleskey=='Website')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Shipping Address'))?'vendors':'' ?> <?= (($newmoduleskey=='Vendors Visibility'))?'vendorsvisible':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='GST Registration Type')||($newmoduleskey=='GSTIN or UIN')||($newmoduleskey=='Business Legal Name')||($newmoduleskey=='Business Trade Name')||($newmoduleskey=='Pan')||($newmoduleskey=='Place Of Supply'))?'vendorstax':'' ?> <?= (($newmoduleskey=='Other Information')||($newmoduleskey=='DL dot No dot or 20')||($newmoduleskey=='DL dot No dot or 21'))?'vendorsother':'' ?> <?= (($newmoduleskey=='Vendor Public Id')||($newmoduleskey=='Vendor Private Id')||($newmoduleskey=='Vendor Id')||($newmoduleskey=='Primary Contact')||($newmoduleskey=='Company Name')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Work Phone')||($newmoduleskey=='Mobile Phone')||($newmoduleskey=='Email')||($newmoduleskey=='Website')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Shipping Address'))?'vendoredit aevforvendor':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='GST Registration Type')||($newmoduleskey=='GSTIN or UIN')||($newmoduleskey=='Business Legal Name')||($newmoduleskey=='Business Trade Name')||($newmoduleskey=='Pan')||($newmoduleskey=='Place Of Supply'))?'vendortaxedit aevforvendortax':'' ?> <?= (($newmoduleskey=='DL dot No dot or 20')||($newmoduleskey=='DL dot No dot or 21'))?'vendorotheredit aevforvendorother':'' ?>" name="<?= $coltypemod; ?>editvendors" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>vendor" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Vendor Display Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>vendor" style="color:<?= (($newmoduleskey=='Vendor Information')||($newmoduleskey=='Vendors Visibility')||($newmoduleskey=='Tax Information')||($newmoduleskey=='Other Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Vendor Public Id')||($newmoduleskey=='Vendor Private Id')||($newmoduleskey=='Vendor Id')||($newmoduleskey=='Primary Contact')||($newmoduleskey=='Company Name')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Work Phone')||($newmoduleskey=='Mobile Phone')||($newmoduleskey=='Email')||($newmoduleskey=='Website')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Shipping Address'))?'vendors':'' ?> <?= (($newmoduleskey=='Vendors Visibility'))?'vendorsvisible':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='GST Registration Type')||($newmoduleskey=='GSTIN or UIN')||($newmoduleskey=='Business Legal Name')||($newmoduleskey=='Business Trade Name')||($newmoduleskey=='Pan')||($newmoduleskey=='Place Of Supply'))?'vendorstax':'' ?> <?= (($newmoduleskey=='Other Information')||($newmoduleskey=='DL dot No dot or 20')||($newmoduleskey=='DL dot No dot or 21'))?'vendorsother vendorsothersubhead':'' ?> <?= (($newmoduleskey=='Vendor Public Id')||($newmoduleskey=='Vendor Private Id')||($newmoduleskey=='Vendor Id')||($newmoduleskey=='Primary Contact')||($newmoduleskey=='Company Name')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Work Phone')||($newmoduleskey=='Mobile Phone')||($newmoduleskey=='Email')||($newmoduleskey=='Website')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Shipping Address'))?'vendorview aevforvendor':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='GST Registration Type')||($newmoduleskey=='GSTIN or UIN')||($newmoduleskey=='Business Legal Name')||($newmoduleskey=='Business Trade Name')||($newmoduleskey=='Pan')||($newmoduleskey=='Place Of Supply'))?'vendortaxview aevforvendortax':'' ?> <?= (($newmoduleskey=='DL dot No dot or 20')||($newmoduleskey=='DL dot No dot or 21'))?'vendorotherview aevforvendorother':'' ?>" name="<?= $coltypemod; ?>viewvendors" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>vendor" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Vendor Display Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>vendor" style="color:<?= (($newmoduleskey=='Vendor Information')||($newmoduleskey=='Vendors Visibility')||($newmoduleskey=='Tax Information')||($newmoduleskey=='Other Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              // function VendorInformationvendorvendor() {
              //   let vendors = document.getElementsByClassName("vendors");
              //   customerslen = vendors.length;
              //   if ($("#VendorInformationvendorvendor").prop("checked")) {
              //   for (i=0;i<customerslen;i++) {
              //   vendors[i].checked=true;
              //   vendors[i].disabled=false;
              //   }
              //   }
              //   else{
              //   for (i=0;i<customerslen;i++) {
              //   vendors[i].checked=false;
              //   vendors[i].disabled=true;
              //   }
              //   }
              // }
              function VendorsVisibilityvendorvisiblevendor() {
                let vendorsvisible = document.getElementsByClassName("vendorsvisible");
                customerslen = vendorsvisible.length;
                if ($("#VendorsVisibilityvendorvisiblevendor").prop("checked")) {
                for (i=0;i<customerslen;i++) {
                vendorsvisible[i].checked=true;
                vendorsvisible[i].disabled=false;
                }
                }
                else{
                for (i=0;i<customerslen;i++) {
                vendorsvisible[i].checked=false;
                vendorsvisible[i].disabled=true;
                }
                }
              }
              function TaxInformationvendortaxvendor() {
                let vendorstax = document.getElementsByClassName("vendorstax");
                customerslen = vendorstax.length;
                if ($("#TaxInformationvendortaxvendor").prop("checked")) {
                for (i=0;i<customerslen;i++) {
                vendorstax[i].checked=true;
                vendorstax[i].disabled=false;
                }
                }
                else{
                for (i=0;i<customerslen;i++) {
                vendorstax[i].checked=false;
                vendorstax[i].disabled=true;
                }
                }
              }
              function OtherInformationvendorothervendor() {
                let vendorsother = document.getElementsByClassName("vendorsother");
                customerslen = vendorsother.length;
                if ($("#OtherInformationvendorothervendor").prop("checked")) {
                for (i=0;i<customerslen;i++) {
                vendorsother[i].checked=true;
                vendorsother[i].disabled=false;
                }
                }
                else{
                for (i=0;i<customerslen;i++) {
                vendorsother[i].checked=false;
                vendorsother[i].disabled=true;
                }
                }
              }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>vendor() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>vendor");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>vendor");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>vendor");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>vendor");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
// let vendorsubhead = document.getElementsByClassName("vendorsubhead");
// let vendorsubheadchnumof = vendorsubhead.length;
// for (i=0;i<vendorsubhead.length;i++) {
// if (vendorsubhead[i].checked) {
// vendorsubheadchnumof+=1;
// }
// else{
// vendorsubheadchnumof-=1;
// }
// }
// if (vendorsubheadchnumof==0) {
// document.getElementById("VendorInformationvendorvendor").checked=false;
// document.getElementById("VendorInformationaddvendorvendor").checked=false;
// document.getElementById("VendorInformationeditvendorvendor").checked=false;
// document.getElementById("VendorInformationviewvendorvendor").checked=false;
// }
// else{
// document.getElementById("VendorInformationvendorvendor").checked=true;
// document.getElementById("VendorInformationaddvendorvendor").checked=true;
// document.getElementById("VendorInformationeditvendorvendor").checked=true;
// document.getElementById("VendorInformationviewvendorvendor").checked=true;
// }
let vendortaxsubhead = document.getElementsByClassName("vendortaxsubhead");
let vendortaxsubheadchnumof = vendortaxsubhead.length;
for (i=0;i<vendortaxsubhead.length;i++) {
if (vendortaxsubhead[i].checked) {
vendortaxsubheadchnumof+=1;
}
else{
vendortaxsubheadchnumof-=1;
}
}
if (vendortaxsubheadchnumof==0) {
document.getElementById("TaxInformationvendortaxvendor").checked=false;
document.getElementById("TaxInformationaddvendortaxvendor").checked=false;
document.getElementById("TaxInformationeditvendortaxvendor").checked=false;
document.getElementById("TaxInformationviewvendortaxvendor").checked=false;
}
else{
document.getElementById("TaxInformationvendortaxvendor").checked=true;
document.getElementById("TaxInformationaddvendortaxvendor").checked=true;
document.getElementById("TaxInformationeditvendortaxvendor").checked=true;
document.getElementById("TaxInformationviewvendortaxvendor").checked=true;
}
let vendorothersubhead = document.getElementsByClassName("vendorothersubhead");
let vendorothersubheadchnumof = vendorothersubhead.length;
for (i=0;i<vendorothersubhead.length;i++) {
if (vendorothersubhead[i].checked) {
vendorothersubheadchnumof+=1;
}
else{
vendorothersubheadchnumof-=1;
}
}
if (vendorothersubheadchnumof==0) {
document.getElementById("OtherInformationvendorothervendor").checked=false;
document.getElementById("OtherInformationaddvendorothervendor").checked=false;
document.getElementById("OtherInformationeditvendorothervendor").checked=false;
document.getElementById("OtherInformationviewvendorothervendor").checked=false;
}
else{
document.getElementById("OtherInformationvendorothervendor").checked=true;
document.getElementById("OtherInformationaddvendorothervendor").checked=true;
document.getElementById("OtherInformationeditvendorothervendor").checked=true;
document.getElementById("OtherInformationviewvendorothervendor").checked=true;
}
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>vendor");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>vendor");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>vendor");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>vendor");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                // if (($coltypemod=='VendorPublicId')||($coltypemod=='VendorPrivateId')||($coltypemod=='VendorId')||($coltypemod=='PrimaryContact')||($coltypemod=='CompanyName')||($coltypemod=='Category')||($coltypemod=='SubCategory')||($coltypemod=='WorkPhone')||($coltypemod=='MobilePhone')||($coltypemod=='Email')||($coltypemod=='Website')||($coltypemod=='BillingAddress')||($coltypemod=='ShippingAddress')) {
                ?>
                // let aevforvendorch = document.getElementsByClassName("aevforvendor");
                // let aevchnumofvendor = aevforvendorch.length;
                // for (i=0;i<aevforvendorch.length;i++) {
                // if (aevforvendorch[i].checked) {
                //     aevchnumofvendor+=1;
                // }
                // else{
                //     aevchnumofvendor-=1;
                // }
                // }
                //     if (aevchnumofvendor==0) {
                //     document.getElementById("VendorInformationvendorvendor").checked=false;
                //     }
                //     else{
                //     document.getElementById("VendorInformationvendorvendor").checked=true;
                // }
                // let aevforvendoradd = document.getElementsByClassName("vendoradd");
                // let aevnumofvendoradd = aevforvendoradd.length;
                // for (i=0;i<aevforvendoradd.length;i++) {
                // if (aevforvendoradd[i].checked) {
                //     aevnumofvendoradd+=1;
                // }
                // else{
                //     aevnumofvendoradd-=1;
                // }
                // }
                // if (aevnumofvendoradd==0) {
                // document.getElementById("VendorInformationaddvendorvendor").checked=false;
                // }
                // else{
                // document.getElementById("VendorInformationaddvendorvendor").checked=true;
                // }
                // let aevforvendoredit = document.getElementsByClassName("vendoredit");
                // let aevnumofvendoredit = aevforvendoredit.length;
                // for (i=0;i<aevforvendoredit.length;i++) {
                // if (aevforvendoredit[i].checked) {
                //     aevnumofvendoredit+=1;
                // }
                // else{
                //     aevnumofvendoredit-=1;
                // }
                // }
                // if (aevnumofvendoredit==0) {
                // document.getElementById("VendorInformationeditvendorvendor").checked=false;
                // }
                // else{
                // document.getElementById("VendorInformationeditvendorvendor").checked=true;
                // }
                // let aevforvendorview = document.getElementsByClassName("vendorview");
                // let aevnumofvendorview = aevforvendorview.length;
                // for (i=0;i<aevforvendorview.length;i++) {
                // if (aevforvendorview[i].checked) {
                //     aevnumofvendorview+=1;
                // }
                // else{
                //     aevnumofvendorview-=1;
                // }
                // }
                // if (aevnumofvendorview==0) {
                // document.getElementById("VendorInformationviewvendorvendor").checked=false;
                // }
                // else{
                // document.getElementById("VendorInformationviewvendorvendor").checked=true;
                // }
                <?php
                // }
                if (($coltypemod=='TaxPreference')||($coltypemod=='GSTRegistrationType')||($coltypemod=='GSTINorUIN')||($coltypemod=='BusinessLegalName')||($coltypemod=='BusinessTradeName')||($coltypemod=='Pan')||($coltypemod=='PlaceOfSupply')) {
                ?>
                let aevforvendortaxch = document.getElementsByClassName("aevforvendortax");
                let aevchnumofvendortax = aevforvendortaxch.length;
                for (i=0;i<aevforvendortaxch.length;i++) {
                if (aevforvendortaxch[i].checked) {
                    aevchnumofvendortax+=1;
                }
                else{
                    aevchnumofvendortax-=1;
                }
                }
                    if (aevchnumofvendortax==0) {
                    document.getElementById("TaxInformationvendortaxvendor").checked=false;
                    }
                    else{
                    document.getElementById("TaxInformationvendortaxvendor").checked=true;
                }
                let aevforvendortaxadd = document.getElementsByClassName("vendortaxadd");
                let aevnumofvendortaxadd = aevforvendortaxadd.length;
                for (i=0;i<aevforvendortaxadd.length;i++) {
                if (aevforvendortaxadd[i].checked) {
                    aevnumofvendortaxadd+=1;
                }
                else{
                    aevnumofvendortaxadd-=1;
                }
                }
                if (aevnumofvendortaxadd==0) {
                document.getElementById("TaxInformationaddvendortaxvendor").checked=false;
                }
                else{
                document.getElementById("TaxInformationaddvendortaxvendor").checked=true;
                }
                let aevforvendortaxedit = document.getElementsByClassName("vendortaxedit");
                let aevnumofvendortaxedit = aevforvendortaxedit.length;
                for (i=0;i<aevforvendortaxedit.length;i++) {
                if (aevforvendortaxedit[i].checked) {
                    aevnumofvendortaxedit+=1;
                }
                else{
                    aevnumofvendortaxedit-=1;
                }
                }
                if (aevnumofvendortaxedit==0) {
                document.getElementById("TaxInformationeditvendortaxvendor").checked=false;
                }
                else{
                document.getElementById("TaxInformationeditvendortaxvendor").checked=true;
                }
                let aevforvendortaxview = document.getElementsByClassName("vendortaxview");
                let aevnumofvendortaxview = aevforvendortaxview.length;
                for (i=0;i<aevforvendortaxview.length;i++) {
                if (aevforvendortaxview[i].checked) {
                    aevnumofvendortaxview+=1;
                }
                else{
                    aevnumofvendortaxview-=1;
                }
                }
                if (aevnumofvendortaxview==0) {
                document.getElementById("TaxInformationviewvendortaxvendor").checked=false;
                }
                else{
                document.getElementById("TaxInformationviewvendortaxvendor").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='DLdotNodotor20')||($coltypemod=='DLdotNodotor21')) {
                ?>
                let aevforvendorotherch = document.getElementsByClassName("aevforvendorother");
                let aevchnumofvendorother = aevforvendorotherch.length;
                for (i=0;i<aevforvendorotherch.length;i++) {
                if (aevforvendorotherch[i].checked) {
                    aevchnumofvendorother+=1;
                }
                else{
                    aevchnumofvendorother-=1;
                }
                }
                    if (aevchnumofvendorother==0) {
                    document.getElementById("OtherInformationvendorothervendor").checked=false;
                    }
                    else{
                    document.getElementById("OtherInformationvendorothervendor").checked=true;
                }
                let aevforvendorotheradd = document.getElementsByClassName("vendorotheradd");
                let aevnumofvendorotheradd = aevforvendorotheradd.length;
                for (i=0;i<aevforvendorotheradd.length;i++) {
                if (aevforvendorotheradd[i].checked) {
                    aevnumofvendorotheradd+=1;
                }
                else{
                    aevnumofvendorotheradd-=1;
                }
                }
                if (aevnumofvendorotheradd==0) {
                document.getElementById("OtherInformationaddvendorothervendor").checked=false;
                }
                else{
                document.getElementById("OtherInformationaddvendorothervendor").checked=true;
                }
                let aevforvendorotheredit = document.getElementsByClassName("vendorotheredit");
                let aevnumofvendorotheredit = aevforvendorotheredit.length;
                for (i=0;i<aevforvendorotheredit.length;i++) {
                if (aevforvendorotheredit[i].checked) {
                    aevnumofvendorotheredit+=1;
                }
                else{
                    aevnumofvendorotheredit-=1;
                }
                }
                if (aevnumofvendorotheredit==0) {
                document.getElementById("OtherInformationeditvendorothervendor").checked=false;
                }
                else{
                document.getElementById("OtherInformationeditvendorothervendor").checked=true;
                }
                let aevforvendorotherview = document.getElementsByClassName("vendorotherview");
                let aevnumofvendorotherview = aevforvendorotherview.length;
                for (i=0;i<aevforvendorotherview.length;i++) {
                if (aevforvendorotherview[i].checked) {
                    aevnumofvendorotherview+=1;
                }
                else{
                    aevnumofvendorotherview-=1;
                }
                }
                if (aevnumofvendorotherview==0) {
                document.getElementById("OtherInformationviewvendorothervendor").checked=false;
                }
                else{
                document.getElementById("OtherInformationviewvendorothervendor").checked=true;
                }
                <?php
                }
                ?>
              }
// function VendorInformationaddvendor() {
// let vendor = document.getElementsByClassName("vendoradd");
// vendorlen = vendor.length;
// let aevforvendor = document.getElementsByClassName("aevforvendor");
// let vendorsubhead = document.getElementsByClassName("vendorsubhead");
// let chnumofvendor = aevforvendor.length;
// if ($("#VendorInformationaddvendorvendor").prop("checked")) {
// for (i=0;i<vendorlen;i++) {
// vendor[i].checked=true;
// }
// }
// else{
// for (i=0;i<vendorlen;i++) {
// vendor[i].checked=false;
// }
// }
// for (i=0;i<aevforvendor.length;i++) {
// if (aevforvendor[i].checked) {
// chnumofvendor+=1;
// }
// else{
// chnumofvendor-=1;
// }
// }
// for (i=0;i<vendorlen;i++) {
// if (chnumofvendor==0) {
// vendorsubhead[i].checked=false;
// }
// else{
// vendorsubhead[i].checked=true;
// }
// }
// }
// function VendorInformationeditvendor() {
// let vendor = document.getElementsByClassName("vendoredit");
// vendorlen = vendor.length;
// let aevforvendor = document.getElementsByClassName("aevforvendor");
// let vendorsubhead = document.getElementsByClassName("vendorsubhead");
// let chnumofvendor = aevforvendor.length;
// if ($("#VendorInformationeditvendorvendor").prop("checked")) {
// for (i=0;i<vendorlen;i++) {
// vendor[i].checked=true;
// }
// }
// else{
// for (i=0;i<vendorlen;i++) {
// vendor[i].checked=false;
// }
// }
// for (i=0;i<aevforvendor.length;i++) {
// if (aevforvendor[i].checked) {
// chnumofvendor+=1;
// }
// else{
// chnumofvendor-=1;
// }
// }
// for (i=0;i<vendorlen;i++) {
// if (chnumofvendor==0) {
// vendorsubhead[i].checked=false;
// }
// else{
// vendorsubhead[i].checked=true;
// }
// }
// }
// function VendorInformationviewvendor() {
// let vendor = document.getElementsByClassName("vendorview");
// vendorlen = vendor.length;
// let aevforvendor = document.getElementsByClassName("aevforvendor");
// let vendorsubhead = document.getElementsByClassName("vendorsubhead");
// let chnumofvendor = aevforvendor.length;
// if ($("#VendorInformationviewvendorvendor").prop("checked")) {
// for (i=0;i<vendorlen;i++) {
// vendor[i].checked=true;
// }
// }
// else{
// for (i=0;i<vendorlen;i++) {
// vendor[i].checked=false;
// }
// }
// for (i=0;i<aevforvendor.length;i++) {
// if (aevforvendor[i].checked) {
// chnumofvendor+=1;
// }
// else{
// chnumofvendor-=1;
// }
// }
// for (i=0;i<vendorlen;i++) {
// if (chnumofvendor==0) {
// vendorsubhead[i].checked=false;
// }
// else{
// vendorsubhead[i].checked=true;
// }
// }
// }
function TaxInformationaddvendortax() {
let vendortax = document.getElementsByClassName("vendortaxadd");
vendortaxlen = vendortax.length;
let aevforvendortax = document.getElementsByClassName("aevforvendortax");
let vendortaxsubhead = document.getElementsByClassName("vendortaxsubhead");
let chnumofvendortax = aevforvendortax.length;
if ($("#TaxInformationaddvendortaxvendor").prop("checked")) {
for (i=0;i<vendortaxlen;i++) {
vendortax[i].checked=true;
}
}
else{
for (i=0;i<vendortaxlen;i++) {
vendortax[i].checked=false;
}
}
for (i=0;i<aevforvendortax.length;i++) {
if (aevforvendortax[i].checked) {
chnumofvendortax+=1;
}
else{
chnumofvendortax-=1;
}
}
for (i=0;i<vendortaxlen;i++) {
if (chnumofvendortax==0) {
vendortaxsubhead[i].checked=false;
}
else{
vendortaxsubhead[i].checked=true;
}
}
}
function TaxInformationeditvendortax() {
let vendortax = document.getElementsByClassName("vendortaxedit");
vendortaxlen = vendortax.length;
let aevforvendortax = document.getElementsByClassName("aevforvendortax");
let vendortaxsubhead = document.getElementsByClassName("vendortaxsubhead");
let chnumofvendortax = aevforvendortax.length;
if ($("#TaxInformationeditvendortaxvendor").prop("checked")) {
for (i=0;i<vendortaxlen;i++) {
vendortax[i].checked=true;
}
}
else{
for (i=0;i<vendortaxlen;i++) {
vendortax[i].checked=false;
}
}
for (i=0;i<aevforvendortax.length;i++) {
if (aevforvendortax[i].checked) {
chnumofvendortax+=1;
}
else{
chnumofvendortax-=1;
}
}
for (i=0;i<vendortaxlen;i++) {
if (chnumofvendortax==0) {
vendortaxsubhead[i].checked=false;
}
else{
vendortaxsubhead[i].checked=true;
}
}
}
function TaxInformationviewvendortax() {
let vendortax = document.getElementsByClassName("vendortaxview");
vendortaxlen = vendortax.length;
let aevforvendortax = document.getElementsByClassName("aevforvendortax");
let vendortaxsubhead = document.getElementsByClassName("vendortaxsubhead");
let chnumofvendortax = aevforvendortax.length;
if ($("#TaxInformationviewvendortaxvendor").prop("checked")) {
for (i=0;i<vendortaxlen;i++) {
vendortax[i].checked=true;
}
}
else{
for (i=0;i<vendortaxlen;i++) {
vendortax[i].checked=false;
}
}
for (i=0;i<aevforvendortax.length;i++) {
if (aevforvendortax[i].checked) {
chnumofvendortax+=1;
}
else{
chnumofvendortax-=1;
}
}
for (i=0;i<vendortaxlen;i++) {
if (chnumofvendortax==0) {
vendortaxsubhead[i].checked=false;
}
else{
vendortaxsubhead[i].checked=true;
}
}
}
function OtherInformationaddvendorother() {
let vendorother = document.getElementsByClassName("vendorotheradd");
vendorotherlen = vendorother.length;
let aevforvendorother = document.getElementsByClassName("aevforvendorother");
let vendorothersubhead = document.getElementsByClassName("vendorothersubhead");
let chnumofvendorother = aevforvendorother.length;
if ($("#OtherInformationaddvendorothervendor").prop("checked")) {
for (i=0;i<vendorotherlen;i++) {
vendorother[i].checked=true;
}
}
else{
for (i=0;i<vendorotherlen;i++) {
vendorother[i].checked=false;
}
}
for (i=0;i<aevforvendorother.length;i++) {
if (aevforvendorother[i].checked) {
chnumofvendorother+=1;
}
else{
chnumofvendorother-=1;
}
}
for (i=0;i<vendorotherlen;i++) {
if (chnumofvendorother==0) {
vendorothersubhead[i].checked=false;
}
else{
vendorothersubhead[i].checked=true;
}
}
}
function OtherInformationeditvendorother() {
let vendorother = document.getElementsByClassName("vendorotheredit");
vendorotherlen = vendorother.length;
let aevforvendorother = document.getElementsByClassName("aevforvendorother");
let vendorothersubhead = document.getElementsByClassName("vendorothersubhead");
let chnumofvendorother = aevforvendorother.length;
if ($("#OtherInformationeditvendorothervendor").prop("checked")) {
for (i=0;i<vendorotherlen;i++) {
vendorother[i].checked=true;
}
}
else{
for (i=0;i<vendorotherlen;i++) {
vendorother[i].checked=false;
}
}
for (i=0;i<aevforvendorother.length;i++) {
if (aevforvendorother[i].checked) {
chnumofvendorother+=1;
}
else{
chnumofvendorother-=1;
}
}
for (i=0;i<vendorotherlen;i++) {
if (chnumofvendorother==0) {
vendorothersubhead[i].checked=false;
}
else{
vendorothersubhead[i].checked=true;
}
}
}
function OtherInformationviewvendorother() {
let vendorother = document.getElementsByClassName("vendorotherview");
vendorotherlen = vendorother.length;
let aevforvendorother = document.getElementsByClassName("aevforvendorother");
let vendorothersubhead = document.getElementsByClassName("vendorothersubhead");
let chnumofvendorother = aevforvendorother.length;
if ($("#OtherInformationviewvendorothervendor").prop("checked")) {
for (i=0;i<vendorotherlen;i++) {
vendorother[i].checked=true;
}
}
else{
for (i=0;i<vendorotherlen;i++) {
vendorother[i].checked=false;
}
}
for (i=0;i<aevforvendorother.length;i++) {
if (aevforvendorother[i].checked) {
chnumofvendorother+=1;
}
else{
chnumofvendorother-=1;
}
}
for (i=0;i<vendorotherlen;i++) {
if (chnumofvendorother==0) {
vendorothersubhead[i].checked=false;
}
else{
vendorothersubhead[i].checked=true;
}
}
}
            </script>
<?php
}
?>
<div class="row" style="border-top:1px solid #eee;padding:5px 0;"></div>
                      </div>
                      </div>
                      </div>
                      </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallvendef">
<svg id="rightarrowvenaccdef" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowvenaccdef()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowvenaccdef" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowvenaccdef()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchvenaccdef() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#vendordefault').outerWidth()
            var scrollWidth = $('#vendordefault')[0].scrollWidth; 
            var scrollLeft = $('#vendordefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowvenaccdef').style.visibility = 'hidden';
            document.getElementById('rightarrowvenaccdef').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowvenaccdef').style.visibility = 'hidden';
            document.getElementById('leftarrowvenaccdef').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowvenaccdef').style.visibility = 'visible';
            document.getElementById('rightarrowvenaccdef').style.visibility = 'visible';
          }
            }
          }
          function leftarrowvenaccdef() {
            document.getElementById('vendordefault').scrollLeft += -90;
            var width = $('#vendordefault').outerWidth()
            var scrollWidth = $('#vendordefault')[0].scrollWidth; 
            var scrollLeft = $('#vendordefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowvenaccdef').style.visibility = 'hidden';
            document.getElementById('rightarrowvenaccdef').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowvenaccdef').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowvenaccdef() {
            document.getElementById('vendordefault').scrollLeft += 90;
            var width = $('#vendordefault').outerWidth()
            var scrollWidth = $('#vendordefault')[0].scrollWidth; 
            var scrollLeft = $('#vendordefault').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowvenaccdef').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowvenaccdef').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #vendordefault::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#vendordefault::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#vendordefault::-webkit-scrollbar-track {
  background-color: green;
}

#vendordefault::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#vendordefault::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallvendef{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallvendef{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchvenaccdef()" class="accordion-header scrollbar-2" id="vendordefault" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#vendordefaults"
                                                    aria-expanded="true" aria-controls="vendordefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="vendordefaults" class="accordion-collapse collapse show"
                                                aria-labelledby="vendordefault">
                                                <div class="accordion-body text-sm">
                                                  <?php
                                                  $sqlismainaccessdef=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Vendors' order by id  asc");
                                                  $infomainaccessdef=mysqli_fetch_array($sqlismainaccessdef);
                                                  ?>
                                                            <div class="row mb-3" style="border-top:2px solid #eee;border-bottom:2px solid #eee;">
                                                                <div class="col-lg-2">
                                                                    <label class="custom-label mt-3 mb-3">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
                  </div>
                  <div class="col-lg-4">
                      <div class="row mb-2 mt-2">
                      <div class="col-lg-4 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="defaultvisibleven" id="publicvisibleven" value="PUBLIC" <?= ($infomainaccessdef['vendorvisible']=='PUBLIC')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="publicvisibleven">Public</label>
                      </div>
                      </div>
                      <div class="col-lg-4 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="defaultvisibleven" id="privatevisibleven" value="PRIVATE" <?= ($infomainaccessdef['vendorvisible']=='PRIVATE')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="privatevisibleven">Private</label>
                      </div>
                      </div>
                  </div>
              </div>
            </div>
<div class="row mb-3" style="border-bottom:2px solid #eee;">
<div class="col-lg-2">
<label class="form-check-label" for="inlineRadio3">GST Registration Type</label>
</div>
<div class="col-lg-4">
                                                      <div class="row mb-2">
                      <div class="col-lg-4">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="gsttypeven" id="manualgst" value="manual" <?= ($infomainaccessdef['gsttypeven']=='manual')?'checked':'' ?> onclick="defgstvalue()">
                        <label class="custom-control-label custom-label" for="manualgst">Manual</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-4 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="gsttypeven" id="defaultgst" value="default" onclick="defgstvalue()">
                        <label class="custom-control-label custom-label" for="defaultgst">Default</label>
                      </div>
                      
                      </div>
                  </div>
                                                    </div>
<div class="col-lg-4 mb-2" style="display: none;" id="gstfulldiv">
<select class="selectpicker form-control select2" data-live-search="true" title="Search title or description..." id="myBtn" name="gstrtype">
                                                                                    <option <?=($infomainaccessdef['gsttypeven']=='manual')?'selected':'';?> value="" data-foo="Select Type of Add" disabled>Select Type of Add</option>

                                                                                    <option data-foo="Business that is registered under GST" value="Registered Business - Regular" <?=($infomainaccessdef['gsttypeven']=='Registered Business - Regular')?'selected':'';?>>Registered Business - Regular</option>

                                                                                    <option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition" <?=($infomainaccessdef['gsttypeven']=='Registered Business - Composition')?'selected':'';?>>Registered Business - Composition</option>

                                                                                    <option data-foo="Business that has not been registered under GST" value="Unregistered Business" <?=($infomainaccessdef['gsttypeven']=='Unregistered Business')?'selected':'';?>>Unregistered Business</option>

                                                                                    <option data-foo="A customer who is a regular consumer" value="Consumer" <?=($infomainaccessdef['gsttypeven']=='Consumer')?'selected':'';?>>Consumer</option>

                                                                                    <option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas" <?=($infomainaccessdef['gsttypeven']=='Overseas')?'selected':'';?>>Overseas</option>

                                                                                    <option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone" <?=($infomainaccessdef['gsttypeven']=='Special Economic Zone')?'selected':'';?>>Special Economic Zone</option>

                                                                                    <option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export" <?=($infomainaccessdef['gsttypeven']=='Deemed Export')?'selected':'';?>>Deemed Export</option>

                                                                                    <option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor" <?=($infomainaccessdef['gsttypeven']=='Tax Deductor')?'selected':'';?>>Tax Deductor</option>

                                                                                    <option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer" <?=($infomainaccessdef['gsttypeven']=='SEZ Developer')?'selected':'';?>>SEZ Developer</option>
                                                                                </select>
</div>
</div>

<input type="hidden" id="gsttypedb" value="<?= $infomainaccessdef['gsttypeven'] ?>">
                                                  <script type="text/javascript">
    $(document).ready(function () {
        var gsttypedb = document.getElementById('gsttypedb');
        if (gsttypedb.value=='manual') {
            document.getElementById("gstfulldiv").style.display="none !important";
            $("#myBtn").removeAttr("required");
        }
        else{
            document.getElementById("gstfulldiv").style.display="block";
            document.getElementById("defaultgst").checked=true;
            $("#myBtn").attr("required","required");
        }
    });
    function defgstvalue() {
        var manual = document.getElementById('manualgst');
        var defaults = document.getElementById('defaultgst');
        if (manual.checked==true) {
            document.getElementById("gstfulldiv").style.display="none";
            var myBtn = document.getElementById("myBtn");
            var myBtnans = myBtn.options[myBtn.selectedIndex].text;
            myBtn.value='';
            $("#myBtn").removeAttr("required");
        }
        else{
            document.getElementById("gstfulldiv").style.display="block";
            var myBtn = document.getElementById("myBtn");
            var myBtnans = myBtn.options[myBtn.selectedIndex].text;
            if (myBtnans=='Select Type of Add') {$("#myBtn").attr("required","required");}
        }
    }
</script>

                                                  <div class="row mb-3" style="border-bottom:3px solid #eee;">
                                                    <div class="col-lg-2 mt-2">
                                                      Place of Supply
                                                    </div>
                                                    <div class="col-lg-4">
                                                      <div class="row pb-3">
                                                         <div class="col-lg-4 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="placeofsupplydefaultven" id="autopos" value="auto" <?= $infomainaccessdef['placeofsupplydefaultven']=='auto'?'checked':'' ?> onclick="defposvalue()">
<label class="custom-control-label custom-label text-danger" for="autopos">Auto</label>
</div>
</div>
                      <div class="col-lg-4 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="placeofsupplydefaultven" id="manualpos" value="manual" <?= ($infomainaccessdef['placeofsupplydefaultven']=='manual')?'checked':'' ?> onclick="defposvalue()">
                        <label class="custom-control-label custom-label" for="manualpos">manual</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-4 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="placeofsupplydefaultven" id="defaultpos" value="default" onclick="defposvalue()">
                        <label class="custom-control-label custom-label" for="defaultpos">Default</label>
                      </div>
                      
                      </div>
                  </div>
                                                    </div>
                                                    <div class="col-lg-4 mb-2" style="display: none;" id="posfulldiv">
<select name="pos" id="pos" class="select4 form-control form-control-sm">
<option disabled value="" <?=($infomainaccessdef['placeofsupplydefaultven']=='manual'||'auto')?'selected':''?>>Select The Place</option> 
<option value="JAMMU AND KASHMIR (1)" <?=($infomainaccessdef['placeofsupplydefaultven']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($infomainaccessdef['placeofsupplydefaultven']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($infomainaccessdef['placeofsupplydefaultven']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($infomainaccessdef['placeofsupplydefaultven']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($infomainaccessdef['placeofsupplydefaultven']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($infomainaccessdef['placeofsupplydefaultven']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($infomainaccessdef['placeofsupplydefaultven']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($infomainaccessdef['placeofsupplydefaultven']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($infomainaccessdef['placeofsupplydefaultven']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($infomainaccessdef['placeofsupplydefaultven']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($infomainaccessdef['placeofsupplydefaultven']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($infomainaccessdef['placeofsupplydefaultven']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($infomainaccessdef['placeofsupplydefaultven']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($infomainaccessdef['placeofsupplydefaultven']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($infomainaccessdef['placeofsupplydefaultven']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($infomainaccessdef['placeofsupplydefaultven']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($infomainaccessdef['placeofsupplydefaultven']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($infomainaccessdef['placeofsupplydefaultven']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($infomainaccessdef['placeofsupplydefaultven']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($infomainaccessdef['placeofsupplydefaultven']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($infomainaccessdef['placeofsupplydefaultven']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($infomainaccessdef['placeofsupplydefaultven']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($infomainaccessdef['placeofsupplydefaultven']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($infomainaccessdef['placeofsupplydefaultven']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($infomainaccessdef['placeofsupplydefaultven']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($infomainaccessdef['placeofsupplydefaultven']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($infomainaccessdef['placeofsupplydefaultven']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($infomainaccessdef['placeofsupplydefaultven']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($infomainaccessdef['placeofsupplydefaultven']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($infomainaccessdef['placeofsupplydefaultven']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($infomainaccessdef['placeofsupplydefaultven']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($infomainaccessdef['placeofsupplydefaultven']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($infomainaccessdef['placeofsupplydefaultven']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($infomainaccessdef['placeofsupplydefaultven']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($infomainaccessdef['placeofsupplydefaultven']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($infomainaccessdef['placeofsupplydefaultven']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($infomainaccessdef['placeofsupplydefaultven']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($infomainaccessdef['placeofsupplydefaultven']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($infomainaccessdef['placeofsupplydefaultven']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
</div>
                                                  </div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: -13px;"></div>
<input type="hidden" id="hidchok" value="<?= $infomainaccessdef['placeofsupplydefaultven'] ?>">
                                                  <script type="text/javascript">
    $(document).ready(function () {
        var hidchok = document.getElementById('hidchok');
        if (hidchok.value=='auto') {
            document.getElementById("posfulldiv").style.display="none !important";
            $("#pos").removeAttr("required");
        }
        else if (hidchok.value=='manual') {
            document.getElementById("posfulldiv").style.display="none !important";
            $("#pos").removeAttr("required");
        }
        else if (hidchok.value!='manual'||'auto') {
            document.getElementById("posfulldiv").style.display="block";
            document.getElementById("defaultpos").checked=true;
            $("#pos").attr("required","required");
        }
    });
    function defposvalue() {
        var auto = document.getElementById('autopos');
        var manual = document.getElementById('manualpos');
        var defaults = document.getElementById('defaultpos');
        if (auto.checked==true) {
            document.getElementById("posfulldiv").style.display="none";
            var pos = document.getElementById("pos");
            var posans = pos.options[pos.selectedIndex].text;
            pos.value='';
            $("#pos").removeAttr("required");
        }
        else if (manual.checked==true) {
            document.getElementById("posfulldiv").style.display="none";
            var pos = document.getElementById("pos");
            var posans = pos.options[pos.selectedIndex].text;
            pos.value='';
            $("#pos").removeAttr("required");
        }
        else if (defaults.checked==true) {
            document.getElementById("posfulldiv").style.display="block";
            var pos = document.getElementById("pos");
            var posans = pos.options[pos.selectedIndex].text;
            if (posans=='Select The Place') {$("#pos").attr("required","required");}
        }
    }
</script>
                      </div>
                      </div>
                      </div>
                      </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallvencol">
<svg id="rightarrowvenacccol" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowvenacccol()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowvenacccol" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowvenacccol()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchvenacccol() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#vendorcolumn').outerWidth()
            var scrollWidth = $('#vendorcolumn')[0].scrollWidth; 
            var scrollLeft = $('#vendorcolumn').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowvenacccol').style.visibility = 'hidden';
            document.getElementById('rightarrowvenacccol').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowvenacccol').style.visibility = 'hidden';
            document.getElementById('leftarrowvenacccol').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowvenacccol').style.visibility = 'visible';
            document.getElementById('rightarrowvenacccol').style.visibility = 'visible';
          }
            }
          }
          function leftarrowvenacccol() {
            document.getElementById('vendorcolumn').scrollLeft += -90;
            var width = $('#vendorcolumn').outerWidth()
            var scrollWidth = $('#vendorcolumn')[0].scrollWidth; 
            var scrollLeft = $('#vendorcolumn').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowvenacccol').style.visibility = 'hidden';
            document.getElementById('rightarrowvenacccol').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowvenacccol').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowvenacccol() {
            document.getElementById('vendorcolumn').scrollLeft += 90;
            var width = $('#vendorcolumn').outerWidth()
            var scrollWidth = $('#vendorcolumn')[0].scrollWidth; 
            var scrollLeft = $('#vendorcolumn').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowvenacccol').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowvenacccol').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #vendorcolumn::-webkit-scrollbar {
  width: 12px;
  background-color: #ffffff;
}

#vendorcolumn::-webkit-scrollbar-thumb {
  background-color: #ffffff;
}

#vendorcolumn::-webkit-scrollbar-track {
  background-color: #ffffff;
}

#vendorcolumn::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#vendorcolumn::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: thin;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: thin;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallvencol{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallvencol{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchvenacccol()" class="accordion-header scrollbar-2" id="vendorcolumn" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#vendorcolumns"
                                                    aria-expanded="true" aria-controls="vendorcolumns">
                                                    <div class="customcont-header ml-0 mb-0 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable in all <?=strtolower($infomainaccessvendor['modulename'])?></a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="vendorcolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="vendorcolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendors' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Vendors' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>vendorcol" id="<?= $coltypemod; ?>vendorcol" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>vendorcol" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace("S dot NO", "(#) Row Number",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
                      </div>
                      </div>
                      </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallvendordefpage">
<svg id="rightarrowvendoraccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowvendoraccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowvendoraccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowvendoraccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchvendoraccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#vendordefaultpage').outerWidth()
            var scrollWidth = $('#vendordefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#vendordefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowvendoraccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowvendoraccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowvendoraccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowvendoraccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowvendoraccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowvendoraccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowvendoraccdefpage() {
            document.getElementById('vendordefaultpage').scrollLeft += -90;
            var width = $('#vendordefaultpage').outerWidth()
            var scrollWidth = $('#vendordefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#vendordefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowvendoraccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowvendoraccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowvendoraccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowvendoraccdefpage() {
            document.getElementById('vendordefaultpage').scrollLeft += 90;
            var width = $('#vendordefaultpage').outerWidth()
            var scrollWidth = $('#vendordefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#vendordefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowvendoraccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowvendoraccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #vendordefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#vendordefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#vendordefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#vendordefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#vendordefaultpage::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallvendordefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallvendordefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchvendoraccdefpage()" class="accordion-header scrollbar-2" id="vendordefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#vendordefaultspages"
                                                    aria-expanded="true" aria-controls="vendordefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="vendordefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="vendordefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row" style="padding-top: 5px;padding-bottom: 0px;margin-bottom: 0px;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="venpageload" id="venpagenum" value="pagenum" <?= ($access['venpageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="venpagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="venpageload" id="venpageauto" value="pageauto" <?= ($access['venpageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="venpageauto">Auto Scroll</label>
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
            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
<div class="tab-pane fade show mt-4 p-3 <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']=='1'))?'active':'')?>" id="nav-purorder" role="tabpanel" aria-labelledby="nav-purorder-tab" <?=(($infomainaccesspurchaseorder['moduleaccess']=='1')?'':'style="display:none"')?>>
      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purorderfield">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purorderfields"
                                                    aria-expanded="true" aria-controls="purorderfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="purorderfields" class="accordion-collapse collapse show"
                                                aria-labelledby="purorderfield">
                                                <div class="accordion-body text-sm">
                                                    <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Orders' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Orders' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Purchase Order Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Purchase Order Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='PurchaseOrderInformation')) {
                  $fullaccessans = 'purchaseorder';
                }
                else if (($coltypemod=='VendorInformation')) {
                  $fullaccessans = 'purordervendor';
                }
                else if (($coltypemod=='ItemInformation')) {
                  $fullaccessans = 'purorderitem';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>purchaseorder()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchaseorders purchaseorderssubhead':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purordervendors purordervendorssubhead':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purorderitems purorderitemssubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>purchaseorder"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>purchaseorder" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Purchase Order Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> <?= str_replace(" or ", " / ",(str_replace("Purchase Order", $infomainaccesspurchaseorder['modulename'],(str_replace("Category",$access['txtnamecategory'],(str_replace("Batch","Batch & Expiry",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchaseorder()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchaseorder()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Order Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchaseorders':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purordervendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purorderitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchaseordersadd aevforpurchaseorders':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purordervendorsadd aevforpurordervendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purorderitemsadd aevforpurorderitems':'' ?>" name="<?= $coltypemod; ?>addpurchaseorders" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchaseorder" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Vendor Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchaseorder" style="color:<?= (($newmoduleskey=='Purchase Order Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchaseorder()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchaseorder()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Order Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchaseorders':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purordervendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purorderitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchaseordersedit aevforpurchaseorders':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purordervendorsedit aevforpurordervendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purorderitemsedit aevforpurorderitems':'' ?>" name="<?= $coltypemod; ?>editpurchaseorders" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchaseorder" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchaseorder" style="color:<?= (($newmoduleskey=='Purchase Order Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchaseorder()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchaseorder()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Order Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchaseorders':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purordervendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purorderitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchaseordersview aevforpurchaseorders':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purordervendorsview aevforpurordervendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purorderitemsview aevforpurorderitems':'' ?>" name="<?= $coltypemod; ?>viewpurchaseorders" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchaseorder" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchaseorder" style="color:<?= (($newmoduleskey=='Purchase Order Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              function PurchaseOrderInformationpurchaseorderpurchaseorder() {
                let purpurchaseorders = document.getElementsByClassName("purchaseorders");
                purchaseorderlen = purpurchaseorders.length;
                if ($("#PurchaseOrderInformationpurchaseorderpurchaseorder").prop("checked")) {
                for (i=0;i<purchaseorderlen;i++) {
                purpurchaseorders[i].checked=true;
                purpurchaseorders[i].disabled=false;
                }
                }
                else{
                for (i=0;i<purchaseorderlen;i++) {
                purpurchaseorders[i].checked=false;
                purpurchaseorders[i].disabled=true;
                }
                }
              }
              function VendorInformationpurordervendorpurchaseorder() {
                let purordervendors = document.getElementsByClassName("purordervendors");
                vendorslen = purordervendors.length;
                if ($("#VendorInformationpurordervendorpurchaseorder").prop("checked")) {
                for (i=0;i<vendorslen;i++) {
                purordervendors[i].checked=true;
                purordervendors[i].disabled=false;
                }
                }
                else{
                for (i=0;i<vendorslen;i++) {
                purordervendors[i].checked=false;
                purordervendors[i].disabled=true;
                }
                }
              }
              function ItemInformationpurorderitempurchaseorder() {
                let purorderitems = document.getElementsByClassName("purorderitems");
                vendorslen = purorderitems.length;
                if ($("#ItemInformationpurorderitempurchaseorder").prop("checked")) {
                for (i=0;i<vendorslen;i++) {
                purorderitems[i].checked=true;
                purorderitems[i].disabled=false;
                }
                }
                else{
                for (i=0;i<vendorslen;i++) {
                purorderitems[i].checked=false;
                purorderitems[i].disabled=true;
                }
                }
              }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>purchaseorder() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>purchaseorder");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchaseorder");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchaseorder");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchaseorder");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
let purchaseorderssubhead = document.getElementsByClassName("purchaseorderssubhead");
let purchaseorderssubheadchnumof = purchaseorderssubhead.length;
for (i=0;i<purchaseorderssubhead.length;i++) {
if (purchaseorderssubhead[i].checked) {
purchaseorderssubheadchnumof+=1;
}
else{
purchaseorderssubheadchnumof-=1;
}
}
if (purchaseorderssubheadchnumof==0) {
document.getElementById("PurchaseOrderInformationpurchaseorderpurchaseorder").checked=false;
document.getElementById("PurchaseOrderInformationaddpurchaseorderpurchaseorder").checked=false;
document.getElementById("PurchaseOrderInformationeditpurchaseorderpurchaseorder").checked=false;
document.getElementById("PurchaseOrderInformationviewpurchaseorderpurchaseorder").checked=false;
}
else{
document.getElementById("PurchaseOrderInformationpurchaseorderpurchaseorder").checked=true;
document.getElementById("PurchaseOrderInformationaddpurchaseorderpurchaseorder").checked=true;
document.getElementById("PurchaseOrderInformationeditpurchaseorderpurchaseorder").checked=true;
document.getElementById("PurchaseOrderInformationviewpurchaseorderpurchaseorder").checked=true;
}
let purordervendorssubhead = document.getElementsByClassName("purordervendorssubhead");
let purordervendorssubheadchnumof = purordervendorssubhead.length;
for (i=0;i<purordervendorssubhead.length;i++) {
if (purordervendorssubhead[i].checked) {
purordervendorssubheadchnumof+=1;
}
else{
purordervendorssubheadchnumof-=1;
}
}
if (purordervendorssubheadchnumof==0) {
document.getElementById("VendorInformationpurordervendorpurchaseorder").checked=false;
document.getElementById("VendorInformationaddpurordervendorpurchaseorder").checked=false;
document.getElementById("VendorInformationeditpurordervendorpurchaseorder").checked=false;
document.getElementById("VendorInformationviewpurordervendorpurchaseorder").checked=false;
}
else{
document.getElementById("VendorInformationpurordervendorpurchaseorder").checked=true;
document.getElementById("VendorInformationaddpurordervendorpurchaseorder").checked=true;
document.getElementById("VendorInformationeditpurordervendorpurchaseorder").checked=true;
document.getElementById("VendorInformationviewpurordervendorpurchaseorder").checked=true;
}
let purorderitemssubhead = document.getElementsByClassName("purorderitemssubhead");
let purorderitemssubheadchnumof = purorderitemssubhead.length;
for (i=0;i<purorderitemssubhead.length;i++) {
if (purorderitemssubhead[i].checked) {
purorderitemssubheadchnumof+=1;
}
else{
purorderitemssubheadchnumof-=1;
}
}
if (purorderitemssubheadchnumof==0) {
document.getElementById("ItemInformationpurorderitempurchaseorder").checked=false;
document.getElementById("ItemInformationaddpurorderitempurchaseorder").checked=false;
document.getElementById("ItemInformationeditpurorderitempurchaseorder").checked=false;
document.getElementById("ItemInformationviewpurorderitempurchaseorder").checked=false;
}
else{
document.getElementById("ItemInformationpurorderitempurchaseorder").checked=true;
document.getElementById("ItemInformationaddpurorderitempurchaseorder").checked=true;
document.getElementById("ItemInformationeditpurorderitempurchaseorder").checked=true;
document.getElementById("ItemInformationviewpurorderitempurchaseorder").checked=true;
}
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchaseorder() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>purchaseorder");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchaseorder");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchaseorder");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchaseorder");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                if (($coltypemod=='Reference'||$coltypemod=='SalePerson'||$coltypemod=='PreparedBy'||$coltypemod=='CheckedBy'||$coltypemod=='DueDate'||$coltypemod=='Term')) {
                ?>
                let aevforpurchaseordersch = document.getElementsByClassName("aevforpurchaseorders");
                let aevchnumofpurchaseorder = aevforpurchaseordersch.length;
                for (i=0;i<aevforpurchaseordersch.length;i++) {
                if (aevforpurchaseordersch[i].checked) {
                    aevchnumofpurchaseorder+=1;
                }
                else{
                    aevchnumofpurchaseorder-=1;
                }
                }
                    if (aevchnumofpurchaseorder==0) {
                    document.getElementById("PurchaseOrderInformationpurchaseorderpurchaseorder").checked=false;
                    }
                    else{
                    document.getElementById("PurchaseOrderInformationpurchaseorderpurchaseorder").checked=true;
                }
                let aevforpurchaseordersadd = document.getElementsByClassName("purchaseordersadd");
                let purchaseordersadd = aevforpurchaseordersadd.length;
                for (i=0;i<aevforpurchaseordersadd.length;i++) {
                if (aevforpurchaseordersadd[i].checked) {
                    purchaseordersadd+=1;
                }
                else{
                    purchaseordersadd-=1;
                }
                }
                if (purchaseordersadd==0) {
                document.getElementById("PurchaseOrderInformationaddpurchaseorderpurchaseorder").checked=false;
                }
                else{
                document.getElementById("PurchaseOrderInformationaddpurchaseorderpurchaseorder").checked=true;
                }
                let aevforpurchaseordersedit = document.getElementsByClassName("purchaseordersedit");
                let purchaseordersedit = aevforpurchaseordersedit.length;
                for (i=0;i<aevforpurchaseordersedit.length;i++) {
                if (aevforpurchaseordersedit[i].checked) {
                    purchaseordersedit+=1;
                }
                else{
                    purchaseordersedit-=1;
                }
                }
                if (purchaseordersedit==0) {
                document.getElementById("PurchaseOrderInformationeditpurchaseorderpurchaseorder").checked=false;
                }
                else{
                document.getElementById("PurchaseOrderInformationeditpurchaseorderpurchaseorder").checked=true;
                }
                let aevforpurchaseordersview = document.getElementsByClassName("purchaseordersview");
                let purchaseordersview = aevforpurchaseordersview.length;
                for (i=0;i<aevforpurchaseordersview.length;i++) {
                if (aevforpurchaseordersview[i].checked) {
                    purchaseordersview+=1;
                }
                else{
                    purchaseordersview-=1;
                }
                }
                if (purchaseordersview==0) {
                document.getElementById("PurchaseOrderInformationviewpurchaseorderpurchaseorder").checked=false;
                }
                else{
                document.getElementById("PurchaseOrderInformationviewpurchaseorderpurchaseorder").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='BillingName'||$coltypemod=='BillingAddress'||$coltypemod=='WorkPhone'||$coltypemod=='GSTIN'||$coltypemod=='ShippingName'||$coltypemod=='ShippingAddress'||$coltypemod=='MobilePhone'||$coltypemod=='PlaceofSupply')) {
                ?>
                let aevforpurordervendorsch = document.getElementsByClassName("aevforpurordervendors");
                let aevchnumofpurchaseorder = aevforpurordervendorsch.length;
                for (i=0;i<aevforpurordervendorsch.length;i++) {
                if (aevforpurordervendorsch[i].checked) {
                    aevchnumofpurchaseorder+=1;
                }
                else{
                    aevchnumofpurchaseorder-=1;
                }
                }
                    if (aevchnumofpurchaseorder==0) {
                    document.getElementById("VendorInformationpurordervendorpurchaseorder").checked=false;
                    }
                    else{
                    document.getElementById("VendorInformationpurordervendorpurchaseorder").checked=true;
                }
                let aevforpurordervendorsadd = document.getElementsByClassName("purordervendorsadd");
                let purordervendorsadd = aevforpurordervendorsadd.length;
                for (i=0;i<aevforpurordervendorsadd.length;i++) {
                if (aevforpurordervendorsadd[i].checked) {
                    purordervendorsadd+=1;
                }
                else{
                    purordervendorsadd-=1;
                }
                }
                if (purordervendorsadd==0) {
                document.getElementById("VendorInformationaddpurordervendorpurchaseorder").checked=false;
                }
                else{
                document.getElementById("VendorInformationaddpurordervendorpurchaseorder").checked=true;
                }
                let aevforpurordervendorsedit = document.getElementsByClassName("purordervendorsedit");
                let purordervendorsedit = aevforpurordervendorsedit.length;
                for (i=0;i<aevforpurordervendorsedit.length;i++) {
                if (aevforpurordervendorsedit[i].checked) {
                    purordervendorsedit+=1;
                }
                else{
                    purordervendorsedit-=1;
                }
                }
                if (purordervendorsedit==0) {
                document.getElementById("VendorInformationeditpurordervendorpurchaseorder").checked=false;
                }
                else{
                document.getElementById("VendorInformationeditpurordervendorpurchaseorder").checked=true;
                }
                let aevforpurordervendorsview = document.getElementsByClassName("purordervendorsview");
                let purordervendorsview = aevforpurordervendorsview.length;
                for (i=0;i<aevforpurordervendorsview.length;i++) {
                if (aevforpurordervendorsview[i].checked) {
                    purordervendorsview+=1;
                }
                else{
                    purordervendorsview-=1;
                }
                }
                if (purordervendorsview==0) {
                document.getElementById("VendorInformationviewpurordervendorpurchaseorder").checked=false;
                }
                else{
                document.getElementById("VendorInformationviewpurordervendorpurchaseorder").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='ProductCategory'||$coltypemod=='ProductMrp'||$coltypemod=='ProductDescription'||$coltypemod=='Batch'||$coltypemod=='TaxableValue'||$coltypemod=='TaxValue'||$coltypemod=='TaxTable'||$coltypemod=='Attach'||$coltypemod=='Description'||$coltypemod=='Notes'||$coltypemod=='TermsandConditions')) {
                ?>
                let aevforpurorderitemsch = document.getElementsByClassName("aevforpurorderitems");
                let aevchnumofpurchaseorder = aevforpurorderitemsch.length;
                for (i=0;i<aevforpurorderitemsch.length;i++) {
                if (aevforpurorderitemsch[i].checked) {
                    aevchnumofpurchaseorder+=1;
                }
                else{
                    aevchnumofpurchaseorder-=1;
                }
                }
                    if (aevchnumofpurchaseorder==0) {
                    document.getElementById("ItemInformationpurorderitempurchaseorder").checked=false;
                    }
                    else{
                    document.getElementById("ItemInformationpurorderitempurchaseorder").checked=true;
                }
                let aevforpurorderitemsadd = document.getElementsByClassName("purorderitemsadd");
                let purorderitemsadd = aevforpurorderitemsadd.length;
                for (i=0;i<aevforpurorderitemsadd.length;i++) {
                if (aevforpurorderitemsadd[i].checked) {
                    purorderitemsadd+=1;
                }
                else{
                    purorderitemsadd-=1;
                }
                }
                if (purorderitemsadd==0) {
                document.getElementById("ItemInformationaddpurorderitempurchaseorder").checked=false;
                }
                else{
                document.getElementById("ItemInformationaddpurorderitempurchaseorder").checked=true;
                }
                let aevforpurorderitemsedit = document.getElementsByClassName("purorderitemsedit");
                let purorderitemsedit = aevforpurorderitemsedit.length;
                for (i=0;i<aevforpurorderitemsedit.length;i++) {
                if (aevforpurorderitemsedit[i].checked) {
                    purorderitemsedit+=1;
                }
                else{
                    purorderitemsedit-=1;
                }
                }
                if (purorderitemsedit==0) {
                document.getElementById("ItemInformationeditpurorderitempurchaseorder").checked=false;
                }
                else{
                document.getElementById("ItemInformationeditpurorderitempurchaseorder").checked=true;
                }
                let aevforpurorderitemsview = document.getElementsByClassName("purorderitemsview");
                let purorderitemsview = aevforpurorderitemsview.length;
                for (i=0;i<aevforpurorderitemsview.length;i++) {
                if (aevforpurorderitemsview[i].checked) {
                    purorderitemsview+=1;
                }
                else{
                    purorderitemsview-=1;
                }
                }
                if (purorderitemsview==0) {
                document.getElementById("ItemInformationviewpurorderitempurchaseorder").checked=false;
                }
                else{
                document.getElementById("ItemInformationviewpurorderitempurchaseorder").checked=true;
                }
                <?php
                }
                ?>
              }
function PurchaseOrderInformationaddpurchaseorderpurchaseorder() {
let purchaseorder = document.getElementsByClassName("purchaseordersadd");
purchaseorderlen = purchaseorder.length;
let aevforpurchaseorders = document.getElementsByClassName("aevforpurchaseorders");
let purchaseorderssubhead = document.getElementsByClassName("purchaseorderssubhead");
let chnumofpurchaseorder = aevforpurchaseorders.length;
if ($("#PurchaseOrderInformationaddpurchaseorderpurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurchaseorders.length;i++) {
if (aevforpurchaseorders[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purchaseorderssubhead[i].checked=false;
}
else{
purchaseorderssubhead[i].checked=true;
}
}
}
function PurchaseOrderInformationeditpurchaseorderpurchaseorder() {
let purchaseorder = document.getElementsByClassName("purchaseordersedit");
purchaseorderlen = purchaseorder.length;
let aevforpurchaseorders = document.getElementsByClassName("aevforpurchaseorders");
let purchaseorderssubhead = document.getElementsByClassName("purchaseorderssubhead");
let chnumofpurchaseorder = aevforpurchaseorders.length;
if ($("#PurchaseOrderInformationeditpurchaseorderpurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurchaseorders.length;i++) {
if (aevforpurchaseorders[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purchaseorderssubhead[i].checked=false;
}
else{
purchaseorderssubhead[i].checked=true;
}
}
}
function PurchaseOrderInformationviewpurchaseorderpurchaseorder() {
let purchaseorder = document.getElementsByClassName("purchaseordersview");
purchaseorderlen = purchaseorder.length;
let aevforpurchaseorders = document.getElementsByClassName("aevforpurchaseorders");
let purchaseorderssubhead = document.getElementsByClassName("purchaseorderssubhead");
let chnumofpurchaseorder = aevforpurchaseorders.length;
if ($("#PurchaseOrderInformationviewpurchaseorderpurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurchaseorders.length;i++) {
if (aevforpurchaseorders[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purchaseorderssubhead[i].checked=false;
}
else{
purchaseorderssubhead[i].checked=true;
}
}
}
function VendorInformationaddpurordervendorpurchaseorder() {
let purchaseorder = document.getElementsByClassName("purordervendorsadd");
purchaseorderlen = purchaseorder.length;
let aevforpurordervendors = document.getElementsByClassName("aevforpurordervendors");
let purordervendorssubhead = document.getElementsByClassName("purordervendorssubhead");
let chnumofpurchaseorder = aevforpurordervendors.length;
if ($("#VendorInformationaddpurordervendorpurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurordervendors.length;i++) {
if (aevforpurordervendors[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purordervendorssubhead[i].checked=false;
}
else{
purordervendorssubhead[i].checked=true;
}
}
}
function VendorInformationeditpurordervendorpurchaseorder() {
let purchaseorder = document.getElementsByClassName("purordervendorsedit");
purchaseorderlen = purchaseorder.length;
let aevforpurordervendors = document.getElementsByClassName("aevforpurordervendors");
let purordervendorssubhead = document.getElementsByClassName("purordervendorssubhead");
let chnumofpurchaseorder = aevforpurordervendors.length;
if ($("#VendorInformationeditpurordervendorpurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurordervendors.length;i++) {
if (aevforpurordervendors[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purordervendorssubhead[i].checked=false;
}
else{
purordervendorssubhead[i].checked=true;
}
}
}
function VendorInformationviewpurordervendorpurchaseorder() {
let purchaseorder = document.getElementsByClassName("purordervendorsview");
purchaseorderlen = purchaseorder.length;
let aevforpurordervendors = document.getElementsByClassName("aevforpurordervendors");
let purordervendorssubhead = document.getElementsByClassName("purordervendorssubhead");
let chnumofpurchaseorder = aevforpurordervendors.length;
if ($("#VendorInformationviewpurordervendorpurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurordervendors.length;i++) {
if (aevforpurordervendors[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purordervendorssubhead[i].checked=false;
}
else{
purordervendorssubhead[i].checked=true;
}
}
}
function ItemInformationaddpurorderitempurchaseorder() {
let purchaseorder = document.getElementsByClassName("purorderitemsadd");
purchaseorderlen = purchaseorder.length;
let aevforpurorderitems = document.getElementsByClassName("aevforpurorderitems");
let purorderitemssubhead = document.getElementsByClassName("purorderitemssubhead");
let chnumofpurchaseorder = aevforpurorderitems.length;
if ($("#ItemInformationaddpurorderitempurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurorderitems.length;i++) {
if (aevforpurorderitems[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purorderitemssubhead[i].checked=false;
}
else{
purorderitemssubhead[i].checked=true;
}
}
}
function ItemInformationeditpurorderitempurchaseorder() {
let purchaseorder = document.getElementsByClassName("purorderitemsedit");
purchaseorderlen = purchaseorder.length;
let aevforpurorderitems = document.getElementsByClassName("aevforpurorderitems");
let purorderitemssubhead = document.getElementsByClassName("purorderitemssubhead");
let chnumofpurchaseorder = aevforpurorderitems.length;
if ($("#ItemInformationeditpurorderitempurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurorderitems.length;i++) {
if (aevforpurorderitems[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purorderitemssubhead[i].checked=false;
}
else{
purorderitemssubhead[i].checked=true;
}
}
}
function ItemInformationviewpurorderitempurchaseorder() {
let purchaseorder = document.getElementsByClassName("purorderitemsview");
purchaseorderlen = purchaseorder.length;
let aevforpurorderitems = document.getElementsByClassName("aevforpurorderitems");
let purorderitemssubhead = document.getElementsByClassName("purorderitemssubhead");
let chnumofpurchaseorder = aevforpurorderitems.length;
if ($("#ItemInformationviewpurorderitempurchaseorder").prop("checked")) {
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=true;
}
}
else{
for (i=0;i<purchaseorderlen;i++) {
purchaseorder[i].checked=false;
}
}
for (i=0;i<aevforpurorderitems.length;i++) {
if (aevforpurorderitems[i].checked) {
chnumofpurchaseorder+=1;
}
else{
chnumofpurchaseorder-=1;
}
}
for (i=0;i<purchaseorderlen;i++) {
if (chnumofpurchaseorder==0) {
purorderitemssubhead[i].checked=false;
}
else{
purorderitemssubhead[i].checked=true;
}
}
}
            </script>
<?php
}
?>
<div class="row" style="border-top:1px solid #eee;padding:5px 0;"></div>
</div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="purorderbtwocreqfield">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#purorderbtwocreqfields"
aria-expanded="true" aria-controls="purorderbtwocreqfields">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display as required</a>
</div>
</button>
</h5>
</div>
<div id="purorderbtwocreqfields" class="accordion-collapse collapse show"
aria-labelledby="purorderbtwocreqfield">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2"> <span class="text-danger">Vendor Name *</span> </div>
<div class="col-lg-10 mt-2 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderbtwocnamerequired" id="purorderbtwocnamerequiredyes" value="Yes" <?= ($access['purorderbtwocnamerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderbtwocnamerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="purorderbtwocnamerequired" id="purorderbtwocnamerequiredno" value="No" <?= ($access['purorderbtwocnamerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="purorderbtwocnamerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:3px solid #eee;">
<div class="col-lg-2 mt-1 mb-2"> <span class="text-danger">Work Phone *</span> </div>
<div class="col-lg-10 mt-1 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderbtwocwphonerequired" id="purorderbtwocwphonerequiredyes" value="Yes" <?= ($access['purorderbtwocwphonerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderbtwocwphonerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="purorderbtwocwphonerequired" id="purorderbtwocwphonerequiredno" value="No" <?= ($access['purorderbtwocwphonerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="purorderbtwocwphonerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purorderdefault">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purorderdefaults"
                                                    aria-expanded="true" aria-controls="purorderdefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="purorderdefaults" class="accordion-collapse collapse show"
                                                aria-labelledby="purorderdefault">
                                                <div class="accordion-body text-sm">
                                                  <?php
                                                  $sqlismainaccessdef=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Purchase Orders' order by id  asc");
                                                  $infomainaccessdef=mysqli_fetch_array($sqlismainaccessdef);
                                                  ?>
                                                  <div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
                                                    <div class="col-lg-2 mt-2 mb-2">
                                                      Vendor Information
                                                    </div>
                                                    <div class="col-lg-10 mt-2 mb-2">
                                                      <div class="row">
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purordervendorinfodefault" id="purordermanualvendorinfo" value="one" onclick="purorderveninfodefault()" <?= ($infomainaccessdef['purorderveninfo']=='one')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="purordermanualvendorinfo">B2B</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purordervendorinfodefault" id="purorderdefaultvendorinfo" value="two" onclick="purorderveninfodefault()" <?= ($infomainaccessdef['purorderveninfo']=='two')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="purorderdefaultvendorinfo">B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purordervendorinfodefault" id="purorderbothvendorinfo" value="both" onclick="purorderveninfodefault()">
                        <label class="custom-control-label custom-label" for="purorderbothvendorinfo">B2B & B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3" style="display: none;" id="purorderveninfodefault">
<select name="purorderveninfoselect" id="purorderveninfoselect" class="select4 form-control form-control-sm">
<option value="" <?= ($infomainaccessdef['purorderveninfo']=='one'||'two')?'selected':'' ?> disabled>Select</option> 
<option value="defone" <?= ($infomainaccessdef['purorderveninfo']=='defone')?'selected':'' ?>>B2B</option> 
<option value="deftwo" <?= ($infomainaccessdef['purorderveninfo']=='deftwo')?'selected':'' ?>>B2C</option> 
</select>
</div>
<input type="hidden" id="purordercheckvalue" value="<?= $infomainaccessdef['purorderveninfo'] ?>">
<script type="text/javascript">
    $(document).ready(function () {
        var purordercheckvalue = document.getElementById('purordercheckvalue');
        if (purordercheckvalue.value=='one') {
            document.getElementById("purorderveninfodefault").style.display="none !important";
            $("#purorderveninfoselect").removeAttr("required");
            document.getElementById("purorderb2cpos").style.display='none';
        }
        else if (purordercheckvalue.value=='two') {
            document.getElementById("purorderveninfodefault").style.display="none !important";
            $("#purorderveninfoselect").removeAttr("required");
            document.getElementById("purorderb2cpos").style.display='flex';
        }
        else if (purordercheckvalue.value!='two'||'one') {
            document.getElementById("purorderveninfodefault").style.display="block";
            document.getElementById("purorderbothvendorinfo").checked=true;
            $("#purorderveninfoselect").attr("required","required");
            document.getElementById("purorderb2cpos").style.display='flex';
        }
    });
    function purorderveninfodefault() {
        var one = document.getElementById('purordermanualvendorinfo');
        var two = document.getElementById('purorderdefaultvendorinfo');
        var both = document.getElementById('purorderbothvendorinfo');
        if (one.checked==true) {
            document.getElementById("purorderveninfodefault").style.display="none";
            var purorderveninfoselect = document.getElementById("purorderveninfoselect");
            var purorderveninfoselectans = purorderveninfoselect.options[purorderveninfoselect.selectedIndex].text;
            purorderveninfoselect.value='';
            $("#purorderveninfoselect").removeAttr("required");
            document.getElementById("purorderb2cpos").style.display='none';
        }
        else if (two.checked==true) {
            document.getElementById("purorderveninfodefault").style.display="none";
            var purorderveninfoselect = document.getElementById("purorderveninfoselect");
            var purorderveninfoselectans = purorderveninfoselect.options[purorderveninfoselect.selectedIndex].text;
            purorderveninfoselect.value='';
            $("#purorderveninfoselect").removeAttr("required");
            document.getElementById("purorderb2cpos").style.display='flex';
        }
        else if (both.checked==true) {
            document.getElementById("purorderveninfodefault").style.display="block";
            var purorderveninfoselect = document.getElementById("purorderveninfoselect");
            var purorderveninfoselectans = purorderveninfoselect.options[purorderveninfoselect.selectedIndex].text;
            if (purorderveninfoselectans=='Select') {$("#purorderveninfoselect").attr("required","required");}
            document.getElementById("purorderb2cpos").style.display='flex';
        }
    }
</script>
                  </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2" id="purorderb2cpos" style="display:none;border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2 pt-1">
GST Registration Type
</div>
<div class="col-lg-4 mt-1 mb-2">
<select class="selectpicker form-control select2 twogst" data-live-search="true" title="Search title or description..." id="purordertwogst" name="purordertwogst">

<option data-foo="Business that is registered under GST" value="Registered Business - Regular" <?=($infomainaccessdef['purordertwogst']=='Registered Business - Regular')?'selected':'';?>>Registered Business - Regular</option>

<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition" <?=($infomainaccessdef['purordertwogst']=='Registered Business - Composition')?'selected':'';?>>Registered Business - Composition</option>

<option data-foo="Business that has not been registered under GST" value="Unregistered Business" <?=($infomainaccessdef['purordertwogst']=='Unregistered Business')?'selected':'';?>>Unregistered Business</option>

<option data-foo="A customer who is a regular consumer" value="Consumer" <?=(($infomainaccessdef['purordertwogst']=='Consumer')||($infomainaccessdef['purordertwogst']==''))?'selected':'';?>>Consumer</option>

<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas" <?=($infomainaccessdef['purordertwogst']=='Overseas')?'selected':'';?>>Overseas</option>

<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone" <?=($infomainaccessdef['purordertwogst']=='Special Economic Zone')?'selected':'';?>>Special Economic Zone</option>

<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export" <?=($infomainaccessdef['purordertwogst']=='Deemed Export')?'selected':'';?>>Deemed Export</option>

<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor" <?=($infomainaccessdef['purordertwogst']=='Tax Deductor')?'selected':'';?>>Tax Deductor</option>

<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer" <?=($infomainaccessdef['purordertwogst']=='SEZ Developer')?'selected':'';?>>SEZ Developer</option>
</select>
</div>
                                                    <div class="col-lg-2 mt-1 mb-2 pt-1">
                                                      Place of Supply
                                                    </div>
                                                    <div class="col-lg-4 mt-1 mb-2">
                                                        <select name="purordertwopos" id="purordertwopos" class="select4 form-control form-control-sm">
<option value="Select Place of Supply" <?= ($infomainaccessdef['purordertwopos']=='Select Place of Supply')?'selected':'' ?>>Select Place of Supply</option>
<option value="JAMMU AND KASHMIR (1)" <?=($infomainaccessdef['purordertwopos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($infomainaccessdef['purordertwopos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($infomainaccessdef['purordertwopos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($infomainaccessdef['purordertwopos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($infomainaccessdef['purordertwopos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($infomainaccessdef['purordertwopos']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($infomainaccessdef['purordertwopos']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($infomainaccessdef['purordertwopos']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($infomainaccessdef['purordertwopos']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($infomainaccessdef['purordertwopos']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($infomainaccessdef['purordertwopos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($infomainaccessdef['purordertwopos']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($infomainaccessdef['purordertwopos']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($infomainaccessdef['purordertwopos']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($infomainaccessdef['purordertwopos']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($infomainaccessdef['purordertwopos']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($infomainaccessdef['purordertwopos']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($infomainaccessdef['purordertwopos']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($infomainaccessdef['purordertwopos']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($infomainaccessdef['purordertwopos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($infomainaccessdef['purordertwopos']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($infomainaccessdef['purordertwopos']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($infomainaccessdef['purordertwopos']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($infomainaccessdef['purordertwopos']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($infomainaccessdef['purordertwopos']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($infomainaccessdef['purordertwopos']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($infomainaccessdef['purordertwopos']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($infomainaccessdef['purordertwopos']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($infomainaccessdef['purordertwopos']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($infomainaccessdef['purordertwopos']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($infomainaccessdef['purordertwopos']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($infomainaccessdef['purordertwopos']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($infomainaccessdef['purordertwopos']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($infomainaccessdef['purordertwopos']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($infomainaccessdef['purordertwopos']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($infomainaccessdef['purordertwopos']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($infomainaccessdef['purordertwopos']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($infomainaccessdef['purordertwopos']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($infomainaccessdef['purordertwopos']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
                                                      </div>
                                                      </div>
<div class="row mb-2" style="border-bottom:3px solid #eee;">
<div class="col-lg-2 mb-2">Display in Dropdown</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purordernewproductdef" id="purordernewproductdef" <?= ($access['purordernewproductdef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purordernewproductdef">New Product</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purordernewvendordef" id="purordernewvendordef" <?= ($access['purordernewvendordef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purordernewvendordef">New Vendor</label>
</div>
</div>
</div>
</div>
</div>
                      </div>
                      </div>
                      </div>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purordercolumn">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purordercolumns"
                                                    aria-expanded="true" aria-controls="purordercolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="purordercolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="purordercolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Orders' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Orders' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>purchaseordercol" id="<?= $coltypemod; ?>purchaseordercol" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>purchaseordercol" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace(" or ", " / ",(str_replace("Vendors", $infomainaccessvendor['modulename'],(str_replace("No", "Number",(str_replace("Purchase Order", $infomainaccesspurchaseorder['modulename'],(str_replace("Bill", $infomainaccesspurchasebill['modulename'],$newmoduleskey))))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
<div class="row" style="border-top:2px solid #eee;padding:5px 0;"></div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallpurorderpaydefpage">
<svg id="rightarrowpurorderpayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowpurorderpayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowpurorderpayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowpurorderpayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchpurorderpayaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#purorderpaydefaultpage').outerWidth()
            var scrollWidth = $('#purorderpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purorderpaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurorderpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurorderpayaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowpurorderpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowpurorderpayaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowpurorderpayaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowpurorderpayaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowpurorderpayaccdefpage() {
            document.getElementById('purorderpaydefaultpage').scrollLeft += -90;
            var width = $('#purorderpaydefaultpage').outerWidth()
            var scrollWidth = $('#purorderpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purorderpaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurorderpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurorderpayaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowpurorderpayaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowpurorderpayaccdefpage() {
            document.getElementById('purorderpaydefaultpage').scrollLeft += 90;
            var width = $('#purorderpaydefaultpage').outerWidth()
            var scrollWidth = $('#purorderpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purorderpaydefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowpurorderpayaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowpurorderpayaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #purorderpaydefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#purorderpaydefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#purorderpaydefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#purorderpaydefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#purorderpaydefaultpage::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallpurorderpaydefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpurorderpaydefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchpurorderpayaccdefpage()" class="accordion-header scrollbar-2" id="purorderpaydefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purorderpaydefaultspages"
                                                    aria-expanded="true" aria-controls="purorderpaydefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="purorderpaydefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="purorderpaydefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row pb-3" style="border-bottom:3px solid #eee;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderpageload" id="purorderpagenum" value="pagenum" <?= ($access['purorderpageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderpagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderpageload" id="purorderpageauto" value="pageauto" <?= ($access['purorderpageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderpageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
</div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="purorderprint">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#purorderprints" aria-expanded="true" aria-controls="purorderprints">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the things would you like to display in print</a>
</div>
</button>
</h5>
<div id="purorderprints" class="accordion-collapse collapse show" aria-labelledby="purorderprint">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">GST Treatment</div>
<div class="col-lg-4 mt-2 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintgsttreatment" id="purorderprintgsttreatauto" value="auto" <?= $infomainaccessdef['purorderprintgsttreatment']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintgsttreatauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintgsttreatment" id="purorderprintgsttreatshow" value="show" <?= ($infomainaccessdef['purorderprintgsttreatment']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintgsttreatshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintgsttreatment" id="purorderprintgsttreathide" value="hide" <?= $infomainaccessdef['purorderprintgsttreatment']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintgsttreathide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">GSTIN</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintgstin" id="purorderprintgstinauto" value="auto" <?= $infomainaccessdef['purorderprintgstin']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintgstinauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintgstin" id="purorderprintgstinshow" value="show" <?= ($infomainaccessdef['purorderprintgstin']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintgstinshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintgstin" id="purorderprintgstinhide" value="hide" <?= $infomainaccessdef['purorderprintgstin']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintgstinhide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">Place of Supply</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintpos" id="purorderprintposauto" value="auto" <?= $infomainaccessdef['purorderprintpos']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintposauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintpos" id="purorderprintposshow" value="show" <?= ($infomainaccessdef['purorderprintpos']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintposshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purorderprintpos" id="purorderprintposhide" value="hide" <?= $infomainaccessdef['purorderprintpos']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderprintposhide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purorderbranchphone" id="purorderbranchphone" <?= $access['purorderbranchphone']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderbranchphone">Phone</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purorderbranchemail" id="purorderbranchemail" <?= $access['purorderbranchemail']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderbranchemail">E-mail</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 0px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purorderbranchgstin" id="purorderbranchgstin" <?= $access['purorderbranchgstin']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purorderbranchgstin">GSTIN</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>

</div>
</div>
</div>
</div>

    <!-- <div style="border-top: 1px solid #dee2e6;margin-top: 15px !important;">
                                                                <div class="mt-2 mb-2 btn-custom-grey">
                                                                <a href="products_preference.php" style="font-size:18px;padding: 20px 0px 14px;width: 61.25;height: 55.5;color: black;"><?= $row['franchiseandroles'] ?></a>
                                                                </div>
                                                            </div> -->
                                                            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
<div class="tab-pane fade show mt-4 p-3 <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']=='1'))?'active':'')?>" id="nav-purreceive" role="tabpanel" aria-labelledby="nav-purreceive-tab" <?=(($infomainaccesspurchasereceive['moduleaccess']=='1')?'':'style="display:none"')?>>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purreceivefield">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreceivefields"
                                                    aria-expanded="true" aria-controls="purreceivefields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="purreceivefields" class="accordion-collapse collapse show"
                                                aria-labelledby="purreceivefield">
                                                <div class="accordion-body text-sm">
                                                    <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Receives' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Receives' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Purchase Receive Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Purchase Receive Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='PurchaseReceiveInformation')) {
                  $fullaccessans = 'purchasereceive';
                }
                else if (($coltypemod=='VendorInformation')) {
                  $fullaccessans = 'purreceivevendor';
                }
                else if (($coltypemod=='ItemInformation')) {
                  $fullaccessans = 'purreceiveitem';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereceive()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchasereceives purchasereceivessubhead':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purreceivevendors purreceivevendorssubhead':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'purreceiveitems purreceiveitemssubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereceive"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereceive" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Purchase Receive Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> <?= str_replace(" or ", " / ",(str_replace("Purchase Receive", $infomainaccesspurchasereceive['modulename'],(str_replace("Category",$access['txtnamecategory'],(str_replace("Batch","Batch & Expiry",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchasereceive()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereceive()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Receive Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchasereceives':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purreceivevendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'purreceiveitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchasereceivesadd aevforpurchasereceives':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purreceivevendorsadd aevforpurreceivevendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'purreceiveitemsadd aevforpurreceiveitems':'' ?>" name="<?= $coltypemod; ?>addpurchasereceives" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereceive" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Vendor Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereceive" style="color:<?= (($newmoduleskey=='Purchase Receive Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchasereceive()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereceive()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Receive Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchasereceives':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purreceivevendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'purreceiveitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchasereceivesedit aevforpurchasereceives':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purreceivevendorsedit aevforpurreceivevendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'purreceiveitemsedit aevforpurreceiveitems':'' ?>" name="<?= $coltypemod; ?>editpurchasereceives" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereceive" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereceive" style="color:<?= (($newmoduleskey=='Purchase Receive Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchasereceive()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereceive()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Receive Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchasereceives':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purreceivevendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'purreceiveitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'||$newmoduleskey=='Due Date'||$newmoduleskey=='Term'))?'purchasereceivesview aevforpurchasereceives':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purreceivevendorsview aevforpurreceivevendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'purreceiveitemsview aevforpurreceiveitems':'' ?>" name="<?= $coltypemod; ?>viewpurchasereceives" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereceive" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereceive" style="color:<?= (($newmoduleskey=='Purchase Receive Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              function PurchaseReceiveInformationpurchasereceivepurchasereceive() {
                let purpurchasereceives = document.getElementsByClassName("purchasereceives");
                purchasereceivelen = purpurchasereceives.length;
                if ($("#PurchaseReceiveInformationpurchasereceivepurchasereceive").prop("checked")) {
                for (i=0;i<purchasereceivelen;i++) {
                purpurchasereceives[i].checked=true;
                purpurchasereceives[i].disabled=false;
                }
                }
                else{
                for (i=0;i<purchasereceivelen;i++) {
                purpurchasereceives[i].checked=false;
                purpurchasereceives[i].disabled=true;
                }
                }
              }
              function VendorInformationpurreceivevendorpurchasereceive() {
                let purreceivevendors = document.getElementsByClassName("purreceivevendors");
                vendorslen = purreceivevendors.length;
                if ($("#VendorInformationpurreceivevendorpurchasereceive").prop("checked")) {
                for (i=0;i<vendorslen;i++) {
                purreceivevendors[i].checked=true;
                purreceivevendors[i].disabled=false;
                }
                }
                else{
                for (i=0;i<vendorslen;i++) {
                purreceivevendors[i].checked=false;
                purreceivevendors[i].disabled=true;
                }
                }
              }
              function ItemInformationpurreceiveitempurchasereceive() {
                let purreceiveitems = document.getElementsByClassName("purreceiveitems");
                vendorslen = purreceiveitems.length;
                if ($("#ItemInformationpurreceiveitempurchasereceive").prop("checked")) {
                for (i=0;i<vendorslen;i++) {
                purreceiveitems[i].checked=true;
                purreceiveitems[i].disabled=false;
                }
                }
                else{
                for (i=0;i<vendorslen;i++) {
                purreceiveitems[i].checked=false;
                purreceiveitems[i].disabled=true;
                }
                }
              }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>purchasereceive() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereceive");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereceive");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereceive");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereceive");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
let purchasereceivessubhead = document.getElementsByClassName("purchasereceivessubhead");
let purchasereceivessubheadchnumof = purchasereceivessubhead.length;
for (i=0;i<purchasereceivessubhead.length;i++) {
if (purchasereceivessubhead[i].checked) {
purchasereceivessubheadchnumof+=1;
}
else{
purchasereceivessubheadchnumof-=1;
}
}
if (purchasereceivessubheadchnumof==0) {
document.getElementById("PurchaseReceiveInformationpurchasereceivepurchasereceive").checked=false;
document.getElementById("PurchaseReceiveInformationaddpurchasereceivepurchasereceive").checked=false;
document.getElementById("PurchaseReceiveInformationeditpurchasereceivepurchasereceive").checked=false;
document.getElementById("PurchaseReceiveInformationviewpurchasereceivepurchasereceive").checked=false;
}
else{
document.getElementById("PurchaseReceiveInformationpurchasereceivepurchasereceive").checked=true;
document.getElementById("PurchaseReceiveInformationaddpurchasereceivepurchasereceive").checked=true;
document.getElementById("PurchaseReceiveInformationeditpurchasereceivepurchasereceive").checked=true;
document.getElementById("PurchaseReceiveInformationviewpurchasereceivepurchasereceive").checked=true;
}
let purreceivevendorssubhead = document.getElementsByClassName("purreceivevendorssubhead");
let purreceivevendorssubheadchnumof = purreceivevendorssubhead.length;
for (i=0;i<purreceivevendorssubhead.length;i++) {
if (purreceivevendorssubhead[i].checked) {
purreceivevendorssubheadchnumof+=1;
}
else{
purreceivevendorssubheadchnumof-=1;
}
}
if (purreceivevendorssubheadchnumof==0) {
document.getElementById("VendorInformationpurreceivevendorpurchasereceive").checked=false;
document.getElementById("VendorInformationaddpurreceivevendorpurchasereceive").checked=false;
document.getElementById("VendorInformationeditpurreceivevendorpurchasereceive").checked=false;
document.getElementById("VendorInformationviewpurreceivevendorpurchasereceive").checked=false;
}
else{
document.getElementById("VendorInformationpurreceivevendorpurchasereceive").checked=true;
document.getElementById("VendorInformationaddpurreceivevendorpurchasereceive").checked=true;
document.getElementById("VendorInformationeditpurreceivevendorpurchasereceive").checked=true;
document.getElementById("VendorInformationviewpurreceivevendorpurchasereceive").checked=true;
}
let purreceiveitemssubhead = document.getElementsByClassName("purreceiveitemssubhead");
let purreceiveitemssubheadchnumof = purreceiveitemssubhead.length;
for (i=0;i<purreceiveitemssubhead.length;i++) {
if (purreceiveitemssubhead[i].checked) {
purreceiveitemssubheadchnumof+=1;
}
else{
purreceiveitemssubheadchnumof-=1;
}
}
if (purreceiveitemssubheadchnumof==0) {
document.getElementById("ItemInformationpurreceiveitempurchasereceive").checked=false;
document.getElementById("ItemInformationaddpurreceiveitempurchasereceive").checked=false;
document.getElementById("ItemInformationeditpurreceiveitempurchasereceive").checked=false;
document.getElementById("ItemInformationviewpurreceiveitempurchasereceive").checked=false;
}
else{
document.getElementById("ItemInformationpurreceiveitempurchasereceive").checked=true;
document.getElementById("ItemInformationaddpurreceiveitempurchasereceive").checked=true;
document.getElementById("ItemInformationeditpurreceiveitempurchasereceive").checked=true;
document.getElementById("ItemInformationviewpurreceiveitempurchasereceive").checked=true;
}
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchasereceive() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereceive");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereceive");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereceive");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereceive");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                if (($coltypemod=='Reference'||$coltypemod=='SalePerson'||$coltypemod=='PreparedBy'||$coltypemod=='CheckedBy'||$coltypemod=='DueDate'||$coltypemod=='Term')) {
                ?>
                let aevforpurchasereceivesch = document.getElementsByClassName("aevforpurchasereceives");
                let aevchnumofpurchasereceive = aevforpurchasereceivesch.length;
                for (i=0;i<aevforpurchasereceivesch.length;i++) {
                if (aevforpurchasereceivesch[i].checked) {
                    aevchnumofpurchasereceive+=1;
                }
                else{
                    aevchnumofpurchasereceive-=1;
                }
                }
                    if (aevchnumofpurchasereceive==0) {
                    document.getElementById("PurchaseReceiveInformationpurchasereceivepurchasereceive").checked=false;
                    }
                    else{
                    document.getElementById("PurchaseReceiveInformationpurchasereceivepurchasereceive").checked=true;
                }
                let aevforpurchasereceivesadd = document.getElementsByClassName("purchasereceivesadd");
                let purchasereceivesadd = aevforpurchasereceivesadd.length;
                for (i=0;i<aevforpurchasereceivesadd.length;i++) {
                if (aevforpurchasereceivesadd[i].checked) {
                    purchasereceivesadd+=1;
                }
                else{
                    purchasereceivesadd-=1;
                }
                }
                if (purchasereceivesadd==0) {
                document.getElementById("PurchaseReceiveInformationaddpurchasereceivepurchasereceive").checked=false;
                }
                else{
                document.getElementById("PurchaseReceiveInformationaddpurchasereceivepurchasereceive").checked=true;
                }
                let aevforpurchasereceivesedit = document.getElementsByClassName("purchasereceivesedit");
                let purchasereceivesedit = aevforpurchasereceivesedit.length;
                for (i=0;i<aevforpurchasereceivesedit.length;i++) {
                if (aevforpurchasereceivesedit[i].checked) {
                    purchasereceivesedit+=1;
                }
                else{
                    purchasereceivesedit-=1;
                }
                }
                if (purchasereceivesedit==0) {
                document.getElementById("PurchaseReceiveInformationeditpurchasereceivepurchasereceive").checked=false;
                }
                else{
                document.getElementById("PurchaseReceiveInformationeditpurchasereceivepurchasereceive").checked=true;
                }
                let aevforpurchasereceivesview = document.getElementsByClassName("purchasereceivesview");
                let purchasereceivesview = aevforpurchasereceivesview.length;
                for (i=0;i<aevforpurchasereceivesview.length;i++) {
                if (aevforpurchasereceivesview[i].checked) {
                    purchasereceivesview+=1;
                }
                else{
                    purchasereceivesview-=1;
                }
                }
                if (purchasereceivesview==0) {
                document.getElementById("PurchaseReceiveInformationviewpurchasereceivepurchasereceive").checked=false;
                }
                else{
                document.getElementById("PurchaseReceiveInformationviewpurchasereceivepurchasereceive").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='BillingName'||$coltypemod=='BillingAddress'||$coltypemod=='WorkPhone'||$coltypemod=='GSTIN'||$coltypemod=='ShippingName'||$coltypemod=='ShippingAddress'||$coltypemod=='MobilePhone'||$coltypemod=='PlaceofSupply')) {
                ?>
                let aevforpurreceivevendorsch = document.getElementsByClassName("aevforpurreceivevendors");
                let aevchnumofpurchasereceive = aevforpurreceivevendorsch.length;
                for (i=0;i<aevforpurreceivevendorsch.length;i++) {
                if (aevforpurreceivevendorsch[i].checked) {
                    aevchnumofpurchasereceive+=1;
                }
                else{
                    aevchnumofpurchasereceive-=1;
                }
                }
                    if (aevchnumofpurchasereceive==0) {
                    document.getElementById("VendorInformationpurreceivevendorpurchasereceive").checked=false;
                    }
                    else{
                    document.getElementById("VendorInformationpurreceivevendorpurchasereceive").checked=true;
                }
                let aevforpurreceivevendorsadd = document.getElementsByClassName("purreceivevendorsadd");
                let purreceivevendorsadd = aevforpurreceivevendorsadd.length;
                for (i=0;i<aevforpurreceivevendorsadd.length;i++) {
                if (aevforpurreceivevendorsadd[i].checked) {
                    purreceivevendorsadd+=1;
                }
                else{
                    purreceivevendorsadd-=1;
                }
                }
                if (purreceivevendorsadd==0) {
                document.getElementById("VendorInformationaddpurreceivevendorpurchasereceive").checked=false;
                }
                else{
                document.getElementById("VendorInformationaddpurreceivevendorpurchasereceive").checked=true;
                }
                let aevforpurreceivevendorsedit = document.getElementsByClassName("purreceivevendorsedit");
                let purreceivevendorsedit = aevforpurreceivevendorsedit.length;
                for (i=0;i<aevforpurreceivevendorsedit.length;i++) {
                if (aevforpurreceivevendorsedit[i].checked) {
                    purreceivevendorsedit+=1;
                }
                else{
                    purreceivevendorsedit-=1;
                }
                }
                if (purreceivevendorsedit==0) {
                document.getElementById("VendorInformationeditpurreceivevendorpurchasereceive").checked=false;
                }
                else{
                document.getElementById("VendorInformationeditpurreceivevendorpurchasereceive").checked=true;
                }
                let aevforpurreceivevendorsview = document.getElementsByClassName("purreceivevendorsview");
                let purreceivevendorsview = aevforpurreceivevendorsview.length;
                for (i=0;i<aevforpurreceivevendorsview.length;i++) {
                if (aevforpurreceivevendorsview[i].checked) {
                    purreceivevendorsview+=1;
                }
                else{
                    purreceivevendorsview-=1;
                }
                }
                if (purreceivevendorsview==0) {
                document.getElementById("VendorInformationviewpurreceivevendorpurchasereceive").checked=false;
                }
                else{
                document.getElementById("VendorInformationviewpurreceivevendorpurchasereceive").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='ProductCategory'||$coltypemod=='ProductMrp'||$coltypemod=='ProductDescription'||$coltypemod=='Batch'||$coltypemod=='TaxableValue'||$coltypemod=='TaxValue'||$coltypemod=='TaxTable'||$coltypemod=='Attach'||$coltypemod=='Description'||$coltypemod=='Notes'||$coltypemod=='TermsandConditions'||$coltypemod=='Sale Quantity')) {
                ?>
                let aevforpurreceiveitemsch = document.getElementsByClassName("aevforpurreceiveitems");
                let aevchnumofpurchasereceive = aevforpurreceiveitemsch.length;
                for (i=0;i<aevforpurreceiveitemsch.length;i++) {
                if (aevforpurreceiveitemsch[i].checked) {
                    aevchnumofpurchasereceive+=1;
                }
                else{
                    aevchnumofpurchasereceive-=1;
                }
                }
                    if (aevchnumofpurchasereceive==0) {
                    document.getElementById("ItemInformationpurreceiveitempurchasereceive").checked=false;
                    }
                    else{
                    document.getElementById("ItemInformationpurreceiveitempurchasereceive").checked=true;
                }
                let aevforpurreceiveitemsadd = document.getElementsByClassName("purreceiveitemsadd");
                let purreceiveitemsadd = aevforpurreceiveitemsadd.length;
                for (i=0;i<aevforpurreceiveitemsadd.length;i++) {
                if (aevforpurreceiveitemsadd[i].checked) {
                    purreceiveitemsadd+=1;
                }
                else{
                    purreceiveitemsadd-=1;
                }
                }
                if (purreceiveitemsadd==0) {
                document.getElementById("ItemInformationaddpurreceiveitempurchasereceive").checked=false;
                }
                else{
                document.getElementById("ItemInformationaddpurreceiveitempurchasereceive").checked=true;
                }
                let aevforpurreceiveitemsedit = document.getElementsByClassName("purreceiveitemsedit");
                let purreceiveitemsedit = aevforpurreceiveitemsedit.length;
                for (i=0;i<aevforpurreceiveitemsedit.length;i++) {
                if (aevforpurreceiveitemsedit[i].checked) {
                    purreceiveitemsedit+=1;
                }
                else{
                    purreceiveitemsedit-=1;
                }
                }
                if (purreceiveitemsedit==0) {
                document.getElementById("ItemInformationeditpurreceiveitempurchasereceive").checked=false;
                }
                else{
                document.getElementById("ItemInformationeditpurreceiveitempurchasereceive").checked=true;
                }
                let aevforpurreceiveitemsview = document.getElementsByClassName("purreceiveitemsview");
                let purreceiveitemsview = aevforpurreceiveitemsview.length;
                for (i=0;i<aevforpurreceiveitemsview.length;i++) {
                if (aevforpurreceiveitemsview[i].checked) {
                    purreceiveitemsview+=1;
                }
                else{
                    purreceiveitemsview-=1;
                }
                }
                if (purreceiveitemsview==0) {
                document.getElementById("ItemInformationviewpurreceiveitempurchasereceive").checked=false;
                }
                else{
                document.getElementById("ItemInformationviewpurreceiveitempurchasereceive").checked=true;
                }
                <?php
                }
                ?>
              }
function PurchaseReceiveInformationaddpurchasereceivepurchasereceive() {
let purchasereceive = document.getElementsByClassName("purchasereceivesadd");
purchasereceivelen = purchasereceive.length;
let aevforpurchasereceives = document.getElementsByClassName("aevforpurchasereceives");
let purchasereceivessubhead = document.getElementsByClassName("purchasereceivessubhead");
let chnumofpurchasereceive = aevforpurchasereceives.length;
if ($("#PurchaseReceiveInformationaddpurchasereceivepurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurchasereceives.length;i++) {
if (aevforpurchasereceives[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purchasereceivessubhead[i].checked=false;
}
else{
purchasereceivessubhead[i].checked=true;
}
}
}
function PurchaseReceiveInformationeditpurchasereceivepurchasereceive() {
let purchasereceive = document.getElementsByClassName("purchasereceivesedit");
purchasereceivelen = purchasereceive.length;
let aevforpurchasereceives = document.getElementsByClassName("aevforpurchasereceives");
let purchasereceivessubhead = document.getElementsByClassName("purchasereceivessubhead");
let chnumofpurchasereceive = aevforpurchasereceives.length;
if ($("#PurchaseReceiveInformationeditpurchasereceivepurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurchasereceives.length;i++) {
if (aevforpurchasereceives[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purchasereceivessubhead[i].checked=false;
}
else{
purchasereceivessubhead[i].checked=true;
}
}
}
function PurchaseReceiveInformationviewpurchasereceivepurchasereceive() {
let purchasereceive = document.getElementsByClassName("purchasereceivesview");
purchasereceivelen = purchasereceive.length;
let aevforpurchasereceives = document.getElementsByClassName("aevforpurchasereceives");
let purchasereceivessubhead = document.getElementsByClassName("purchasereceivessubhead");
let chnumofpurchasereceive = aevforpurchasereceives.length;
if ($("#PurchaseReceiveInformationviewpurchasereceivepurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurchasereceives.length;i++) {
if (aevforpurchasereceives[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purchasereceivessubhead[i].checked=false;
}
else{
purchasereceivessubhead[i].checked=true;
}
}
}
function VendorInformationaddpurreceivevendorpurchasereceive() {
let purchasereceive = document.getElementsByClassName("purreceivevendorsadd");
purchasereceivelen = purchasereceive.length;
let aevforpurreceivevendors = document.getElementsByClassName("aevforpurreceivevendors");
let purreceivevendorssubhead = document.getElementsByClassName("purreceivevendorssubhead");
let chnumofpurchasereceive = aevforpurreceivevendors.length;
if ($("#VendorInformationaddpurreceivevendorpurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurreceivevendors.length;i++) {
if (aevforpurreceivevendors[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purreceivevendorssubhead[i].checked=false;
}
else{
purreceivevendorssubhead[i].checked=true;
}
}
}
function VendorInformationeditpurreceivevendorpurchasereceive() {
let purchasereceive = document.getElementsByClassName("purreceivevendorsedit");
purchasereceivelen = purchasereceive.length;
let aevforpurreceivevendors = document.getElementsByClassName("aevforpurreceivevendors");
let purreceivevendorssubhead = document.getElementsByClassName("purreceivevendorssubhead");
let chnumofpurchasereceive = aevforpurreceivevendors.length;
if ($("#VendorInformationeditpurreceivevendorpurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurreceivevendors.length;i++) {
if (aevforpurreceivevendors[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purreceivevendorssubhead[i].checked=false;
}
else{
purreceivevendorssubhead[i].checked=true;
}
}
}
function VendorInformationviewpurreceivevendorpurchasereceive() {
let purchasereceive = document.getElementsByClassName("purreceivevendorsview");
purchasereceivelen = purchasereceive.length;
let aevforpurreceivevendors = document.getElementsByClassName("aevforpurreceivevendors");
let purreceivevendorssubhead = document.getElementsByClassName("purreceivevendorssubhead");
let chnumofpurchasereceive = aevforpurreceivevendors.length;
if ($("#VendorInformationviewpurreceivevendorpurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurreceivevendors.length;i++) {
if (aevforpurreceivevendors[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purreceivevendorssubhead[i].checked=false;
}
else{
purreceivevendorssubhead[i].checked=true;
}
}
}
function ItemInformationaddpurreceiveitempurchasereceive() {
let purchasereceive = document.getElementsByClassName("purreceiveitemsadd");
purchasereceivelen = purchasereceive.length;
let aevforpurreceiveitems = document.getElementsByClassName("aevforpurreceiveitems");
let purreceiveitemssubhead = document.getElementsByClassName("purreceiveitemssubhead");
let chnumofpurchasereceive = aevforpurreceiveitems.length;
if ($("#ItemInformationaddpurreceiveitempurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurreceiveitems.length;i++) {
if (aevforpurreceiveitems[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purreceiveitemssubhead[i].checked=false;
}
else{
purreceiveitemssubhead[i].checked=true;
}
}
}
function ItemInformationeditpurreceiveitempurchasereceive() {
let purchasereceive = document.getElementsByClassName("purreceiveitemsedit");
purchasereceivelen = purchasereceive.length;
let aevforpurreceiveitems = document.getElementsByClassName("aevforpurreceiveitems");
let purreceiveitemssubhead = document.getElementsByClassName("purreceiveitemssubhead");
let chnumofpurchasereceive = aevforpurreceiveitems.length;
if ($("#ItemInformationeditpurreceiveitempurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurreceiveitems.length;i++) {
if (aevforpurreceiveitems[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purreceiveitemssubhead[i].checked=false;
}
else{
purreceiveitemssubhead[i].checked=true;
}
}
}
function ItemInformationviewpurreceiveitempurchasereceive() {
let purchasereceive = document.getElementsByClassName("purreceiveitemsview");
purchasereceivelen = purchasereceive.length;
let aevforpurreceiveitems = document.getElementsByClassName("aevforpurreceiveitems");
let purreceiveitemssubhead = document.getElementsByClassName("purreceiveitemssubhead");
let chnumofpurchasereceive = aevforpurreceiveitems.length;
if ($("#ItemInformationviewpurreceiveitempurchasereceive").prop("checked")) {
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=true;
}
}
else{
for (i=0;i<purchasereceivelen;i++) {
purchasereceive[i].checked=false;
}
}
for (i=0;i<aevforpurreceiveitems.length;i++) {
if (aevforpurreceiveitems[i].checked) {
chnumofpurchasereceive+=1;
}
else{
chnumofpurchasereceive-=1;
}
}
for (i=0;i<purchasereceivelen;i++) {
if (chnumofpurchasereceive==0) {
purreceiveitemssubhead[i].checked=false;
}
else{
purreceiveitemssubhead[i].checked=true;
}
}
}
            </script>
<?php
}
?>
<div class="row" style="border-top:1px solid #eee;padding:5px 0;"></div>
                                                </div> 
                                                </div>
                                                </div>
                                                </div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="purreceivebtwocreqfield">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#purreceivebtwocreqfields"
aria-expanded="true" aria-controls="purreceivebtwocreqfields">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display as required</a>
</div>
</button>
</h5>
</div>
<div id="purreceivebtwocreqfields" class="accordion-collapse collapse show"
aria-labelledby="purreceivebtwocreqfield">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2"> <span class="text-danger">Vendor Name *</span> </div>
<div class="col-lg-10 mt-2 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceivebtwocnamerequired" id="purreceivebtwocnamerequiredyes" value="Yes" <?= ($access['purreceivebtwocnamerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivebtwocnamerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="purreceivebtwocnamerequired" id="purreceivebtwocnamerequiredno" value="No" <?= ($access['purreceivebtwocnamerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="purreceivebtwocnamerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:3px solid #eee;">
<div class="col-lg-2 mt-1 mb-2"> <span class="text-danger">Work Phone *</span> </div>
<div class="col-lg-10 mt-1 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceivebtwocwphonerequired" id="purreceivebtwocwphonerequiredyes" value="Yes" <?= ($access['purreceivebtwocwphonerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivebtwocwphonerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="purreceivebtwocwphonerequired" id="purreceivebtwocwphonerequiredno" value="No" <?= ($access['purreceivebtwocwphonerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="purreceivebtwocwphonerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purreceivedefault">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreceivedefaults"
                                                    aria-expanded="true" aria-controls="purreceivedefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="purreceivedefaults" class="accordion-collapse collapse show"
                                                aria-labelledby="purreceivedefault">
                                                <div class="accordion-body text-sm">
                                                  <?php
                                                  $sqlismainaccessdef=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Purchase Receives' order by id  asc");
                                                  $infomainaccessdef=mysqli_fetch_array($sqlismainaccessdef);
                                                  ?>
                                                  <div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
                                                    <div class="col-lg-2 mt-2 mb-2">
                                                      Vendor Information
                                                    </div>
                                                    <div class="col-lg-10 mt-2 mb-2">
                                                      <div class="row">
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purreceivevendorinfodefault" id="purreceivemanualvendorinfo" value="one" onclick="purreceiveveninfodefault()" <?= ($infomainaccessdef['purreceiveveninfo']=='one')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="purreceivemanualvendorinfo">B2B</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purreceivevendorinfodefault" id="purreceivedefaultvendorinfo" value="two" onclick="purreceiveveninfodefault()" <?= ($infomainaccessdef['purreceiveveninfo']=='two')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="purreceivedefaultvendorinfo">B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purreceivevendorinfodefault" id="purreceivebothvendorinfo" value="both" onclick="purreceiveveninfodefault()">
                        <label class="custom-control-label custom-label" for="purreceivebothvendorinfo">B2B & B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3" style="display: none;" id="purreceiveveninfodefault">
<select name="purreceiveveninfoselect" id="purreceiveveninfoselect" class="select4 form-control form-control-sm">
<option value="" <?= ($infomainaccessdef['purreceiveveninfo']=='one'||'two')?'selected':'' ?> disabled>Select</option> 
<option value="defone" <?= ($infomainaccessdef['purreceiveveninfo']=='defone')?'selected':'' ?>>B2B</option> 
<option value="deftwo" <?= ($infomainaccessdef['purreceiveveninfo']=='deftwo')?'selected':'' ?>>B2C</option> 
</select>
</div>
<input type="hidden" id="purreceivecheckvalue" value="<?= $infomainaccessdef['purreceiveveninfo'] ?>">
<script type="text/javascript">
    $(document).ready(function () {
        var purreceivecheckvalue = document.getElementById('purreceivecheckvalue');
        if (purreceivecheckvalue.value=='one') {
            document.getElementById("purreceiveveninfodefault").style.display="none !important";
            $("#purreceiveveninfoselect").removeAttr("required");
            document.getElementById("purreceiveb2cpos").style.display='none';
        }
        else if (purreceivecheckvalue.value=='two') {
            document.getElementById("purreceiveveninfodefault").style.display="none !important";
            $("#purreceiveveninfoselect").removeAttr("required");
            document.getElementById("purreceiveb2cpos").style.display='flex';
        }
        else if (purreceivecheckvalue.value!='two'||'one') {
            document.getElementById("purreceiveveninfodefault").style.display="block";
            document.getElementById("purreceivebothvendorinfo").checked=true;
            $("#purreceiveveninfoselect").attr("required","required");
            document.getElementById("purreceiveb2cpos").style.display='flex';
        }
    });
    function purreceiveveninfodefault() {
        var one = document.getElementById('purreceivemanualvendorinfo');
        var two = document.getElementById('purreceivedefaultvendorinfo');
        var both = document.getElementById('purreceivebothvendorinfo');
        if (one.checked==true) {
            document.getElementById("purreceiveveninfodefault").style.display="none";
            var purreceiveveninfoselect = document.getElementById("purreceiveveninfoselect");
            var purreceiveveninfoselectans = purreceiveveninfoselect.options[purreceiveveninfoselect.selectedIndex].text;
            purreceiveveninfoselect.value='';
            $("#purreceiveveninfoselect").removeAttr("required");
            document.getElementById("purreceiveb2cpos").style.display='none';
        }
        else if (two.checked==true) {
            document.getElementById("purreceiveveninfodefault").style.display="none";
            var purreceiveveninfoselect = document.getElementById("purreceiveveninfoselect");
            var purreceiveveninfoselectans = purreceiveveninfoselect.options[purreceiveveninfoselect.selectedIndex].text;
            purreceiveveninfoselect.value='';
            $("#purreceiveveninfoselect").removeAttr("required");
            document.getElementById("purreceiveb2cpos").style.display='flex';
        }
        else if (both.checked==true) {
            document.getElementById("purreceiveveninfodefault").style.display="block";
            var purreceiveveninfoselect = document.getElementById("purreceiveveninfoselect");
            var purreceiveveninfoselectans = purreceiveveninfoselect.options[purreceiveveninfoselect.selectedIndex].text;
            if (purreceiveveninfoselectans=='Select') {$("#purreceiveveninfoselect").attr("required","required");}
            document.getElementById("purreceiveb2cpos").style.display='flex';
        }
    }
</script>
                  </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2" id="purreceiveb2cpos" style="display:none;border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2 pt-1">
GST Registration Type
</div>
<div class="col-lg-4 mt-1 mb-2">
<select class="selectpicker form-control select2 twogst" data-live-search="true" title="Search title or description..." id="purreceivetwogst" name="purreceivetwogst">

<option data-foo="Business that is registered under GST" value="Registered Business - Regular" <?=($infomainaccessdef['purreceivetwogst']=='Registered Business - Regular')?'selected':'';?>>Registered Business - Regular</option>

<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition" <?=($infomainaccessdef['purreceivetwogst']=='Registered Business - Composition')?'selected':'';?>>Registered Business - Composition</option>

<option data-foo="Business that has not been registered under GST" value="Unregistered Business" <?=($infomainaccessdef['purreceivetwogst']=='Unregistered Business')?'selected':'';?>>Unregistered Business</option>

<option data-foo="A customer who is a regular consumer" value="Consumer" <?=(($infomainaccessdef['purreceivetwogst']=='Consumer')||($infomainaccessdef['purreceivetwogst']==''))?'selected':'';?>>Consumer</option>

<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas" <?=($infomainaccessdef['purreceivetwogst']=='Overseas')?'selected':'';?>>Overseas</option>

<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone" <?=($infomainaccessdef['purreceivetwogst']=='Special Economic Zone')?'selected':'';?>>Special Economic Zone</option>

<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export" <?=($infomainaccessdef['purreceivetwogst']=='Deemed Export')?'selected':'';?>>Deemed Export</option>

<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor" <?=($infomainaccessdef['purreceivetwogst']=='Tax Deductor')?'selected':'';?>>Tax Deductor</option>

<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer" <?=($infomainaccessdef['purreceivetwogst']=='SEZ Developer')?'selected':'';?>>SEZ Developer</option>
</select>
</div>
                                                    <div class="col-lg-2 mt-1 mb-2 pt-1">
                                                      Place of Supply
                                                    </div>
                                                    <div class="col-lg-4 mt-1 mb-2">
                                                        <select name="purreceivetwopos" id="purreceivetwopos" class="select4 form-control form-control-sm">
<option value="Select Place of Supply" <?= ($infomainaccessdef['purreceivetwopos']=='Select Place of Supply')?'selected':'' ?>>Select Place of Supply</option>
<option value="JAMMU AND KASHMIR (1)" <?=($infomainaccessdef['purreceivetwopos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($infomainaccessdef['purreceivetwopos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($infomainaccessdef['purreceivetwopos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($infomainaccessdef['purreceivetwopos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($infomainaccessdef['purreceivetwopos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($infomainaccessdef['purreceivetwopos']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($infomainaccessdef['purreceivetwopos']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($infomainaccessdef['purreceivetwopos']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($infomainaccessdef['purreceivetwopos']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($infomainaccessdef['purreceivetwopos']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($infomainaccessdef['purreceivetwopos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($infomainaccessdef['purreceivetwopos']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($infomainaccessdef['purreceivetwopos']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($infomainaccessdef['purreceivetwopos']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($infomainaccessdef['purreceivetwopos']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($infomainaccessdef['purreceivetwopos']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($infomainaccessdef['purreceivetwopos']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($infomainaccessdef['purreceivetwopos']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($infomainaccessdef['purreceivetwopos']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($infomainaccessdef['purreceivetwopos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($infomainaccessdef['purreceivetwopos']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($infomainaccessdef['purreceivetwopos']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($infomainaccessdef['purreceivetwopos']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($infomainaccessdef['purreceivetwopos']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($infomainaccessdef['purreceivetwopos']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($infomainaccessdef['purreceivetwopos']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($infomainaccessdef['purreceivetwopos']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($infomainaccessdef['purreceivetwopos']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($infomainaccessdef['purreceivetwopos']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($infomainaccessdef['purreceivetwopos']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($infomainaccessdef['purreceivetwopos']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($infomainaccessdef['purreceivetwopos']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($infomainaccessdef['purreceivetwopos']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($infomainaccessdef['purreceivetwopos']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($infomainaccessdef['purreceivetwopos']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($infomainaccessdef['purreceivetwopos']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($infomainaccessdef['purreceivetwopos']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($infomainaccessdef['purreceivetwopos']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($infomainaccessdef['purreceivetwopos']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
                                                      </div>
                                                      </div>
<div class="row mb-2" style="border-bottom:3px solid #eee;">
<div class="col-lg-2 mb-2">Display in Dropdown</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreceivenewproductdef" id="purreceivenewproductdef" <?= ($access['purreceivenewproductdef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivenewproductdef">New Product</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreceivenewvendordef" id="purreceivenewvendordef" <?= ($access['purreceivenewvendordef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivenewvendordef">New Vendor</label>
</div>
</div>
</div>
</div>
</div>
                      </div>
                      </div>
                      </div>
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purreceivecolumn">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreceivecolumns"
                                                    aria-expanded="true" aria-controls="purreceivecolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="purreceivecolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="purreceivecolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Receives' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Receives' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>purchasereceivecol" id="<?= $coltypemod; ?>purchasereceivecol" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>purchasereceivecol" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace(" or ", " / ",(str_replace("Vendors", $infomainaccessvendor['modulename'],(str_replace("No", "Number",(str_replace("Purchase Receive", $infomainaccesspurchasereceive['modulename'],$newmoduleskey))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
<div class="row" style="border-top:2px solid #eee;padding:5px 0;"></div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallpurreceivepaydefpage">
<svg id="rightarrowpurreceivepayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowpurreceivepayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowpurreceivepayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowpurreceivepayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchpurreceivepayaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#purreceivepaydefaultpage').outerWidth()
            var scrollWidth = $('#purreceivepaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreceivepaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurreceivepayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurreceivepayaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowpurreceivepayaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowpurreceivepayaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowpurreceivepayaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowpurreceivepayaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowpurreceivepayaccdefpage() {
            document.getElementById('purreceivepaydefaultpage').scrollLeft += -90;
            var width = $('#purreceivepaydefaultpage').outerWidth()
            var scrollWidth = $('#purreceivepaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreceivepaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurreceivepayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurreceivepayaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowpurreceivepayaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowpurreceivepayaccdefpage() {
            document.getElementById('purreceivepaydefaultpage').scrollLeft += 90;
            var width = $('#purreceivepaydefaultpage').outerWidth()
            var scrollWidth = $('#purreceivepaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreceivepaydefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowpurreceivepayaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowpurreceivepayaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #purreceivepaydefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#purreceivepaydefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#purreceivepaydefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#purreceivepaydefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#purreceivepaydefaultpage::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallpurreceivepaydefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpurreceivepaydefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchpurreceivepayaccdefpage()" class="accordion-header scrollbar-2" id="purreceivepaydefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreceivepaydefaultspages"
                                                    aria-expanded="true" aria-controls="purreceivepaydefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="purreceivepaydefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="purreceivepaydefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row pb-3" style="border-bottom:3px solid #eee;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceivepageload" id="purreceivepagenum" value="pagenum" <?= ($access['purreceivepageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivepagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceivepageload" id="purreceivepageauto" value="pageauto" <?= ($access['purreceivepageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivepageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
</div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="purreceiveprint">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#purreceiveprints" aria-expanded="true" aria-controls="purreceiveprints">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the things would you like to display in print</a>
</div>
</button>
</h5>
<div id="purreceiveprints" class="accordion-collapse collapse show" aria-labelledby="purreceiveprint">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">GST Treatment</div>
<div class="col-lg-4 mt-2 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintgsttreatment" id="purreceiveprintgsttreatauto" value="auto" <?= $infomainaccessdef['purreceiveprintgsttreatment']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintgsttreatauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintgsttreatment" id="purreceiveprintgsttreatshow" value="show" <?= ($infomainaccessdef['purreceiveprintgsttreatment']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintgsttreatshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintgsttreatment" id="purreceiveprintgsttreathide" value="hide" <?= $infomainaccessdef['purreceiveprintgsttreatment']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintgsttreathide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">GSTIN</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintgstin" id="purreceiveprintgstinauto" value="auto" <?= $infomainaccessdef['purreceiveprintgstin']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintgstinauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintgstin" id="purreceiveprintgstinshow" value="show" <?= ($infomainaccessdef['purreceiveprintgstin']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintgstinshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintgstin" id="purreceiveprintgstinhide" value="hide" <?= $infomainaccessdef['purreceiveprintgstin']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintgstinhide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">Place of Supply</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintpos" id="purreceiveprintposauto" value="auto" <?= $infomainaccessdef['purreceiveprintpos']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintposauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintpos" id="purreceiveprintposshow" value="show" <?= ($infomainaccessdef['purreceiveprintpos']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintposshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreceiveprintpos" id="purreceiveprintposhide" value="hide" <?= $infomainaccessdef['purreceiveprintpos']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceiveprintposhide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreceivebranchphone" id="purreceivebranchphone" <?= $access['purreceivebranchphone']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivebranchphone">Phone</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreceivebranchemail" id="purreceivebranchemail" <?= $access['purreceivebranchemail']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivebranchemail">E-mail</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 0px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreceivebranchgstin" id="purreceivebranchgstin" <?= $access['purreceivebranchgstin']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreceivebranchgstin">GSTIN</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>

</div>
</div>
</div>
</div>
                                                
                                                            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
<div class="tab-pane fade show <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']=='1'))?'active':'')?>" id="nav-bills" role="tabpanel" aria-labelledby="nav-bills-tab" style="margin-top: 39.5px !important;padding: 0px 18px !important;<?=(($infomainaccesspurchasebill['moduleaccess']=='1')?'':'display:none;')?>">
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <div style="visibility: visible;" id="arrowsallbillbillone">
<svg id="rightarrowbillbillone" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowbillbillone()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowbillbillone" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowbillbillone()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchbillbillone() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#payablereceivablepurchase').outerWidth()
            var scrollWidth = $('#payablereceivablepurchase')[0].scrollWidth; 
            var scrollLeft = $('#payablereceivablepurchase').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillone').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillone').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowbillbillone').style.visibility = 'hidden';
            document.getElementById('leftarrowbillbillone').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowbillbillone').style.visibility = 'visible';
            document.getElementById('rightarrowbillbillone').style.visibility = 'visible';
          }
            }
          }
          function leftarrowbillbillone() {
            document.getElementById('payablereceivablepurchase').scrollLeft += -90;
            var width = $('#payablereceivablepurchase').outerWidth()
            var scrollWidth = $('#payablereceivablepurchase')[0].scrollWidth; 
            var scrollLeft = $('#payablereceivablepurchase').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillone').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillone').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowbillbillone').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowbillbillone() {
            document.getElementById('payablereceivablepurchase').scrollLeft += 90;
            var width = $('#payablereceivablepurchase').outerWidth()
            var scrollWidth = $('#payablereceivablepurchase')[0].scrollWidth; 
            var scrollLeft = $('#payablereceivablepurchase').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowbillbillone').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowbillbillone').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #payablereceivablepurchase::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#payablereceivablepurchase::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#payablereceivablepurchase::-webkit-scrollbar-track {
  background-color: green;
}

#payablereceivablepurchase::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#payablereceivablepurchase::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallbillbillone{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsallbillbillone{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchbillbillone()" class="accordion-header scrollbar-2" id="payablereceivablepurchase" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#payablereceivablepurchases"
                                                    aria-expanded="true" aria-controls="payablereceivablepurchases">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the things you would like to display in dashboard</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="payablereceivablepurchases" class="accordion-collapse collapse show"
                                                aria-labelledby="payablereceivablepurchase">
                                                <div class="accordion-body text-sm">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="payablepurchase" id="payablepurchase" <?= ($infomainaccessdef['payablepurchase']=='1')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="payablepurchase"> Total Payable in Purchase</label>
                      </div>
<br>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
                      </div>
                      </div>
                      </div>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <div style="visibility: visible;" id="arrowsallbillbilltwo">
<svg id="rightarrowbillbilltwo" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowbillbilltwo()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowbillbilltwo" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowbillbilltwo()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchbillbilltwo() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#billfield').outerWidth()
            var scrollWidth = $('#billfield')[0].scrollWidth; 
            var scrollLeft = $('#billfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbilltwo').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbilltwo').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowbillbilltwo').style.visibility = 'hidden';
            document.getElementById('leftarrowbillbilltwo').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowbillbilltwo').style.visibility = 'visible';
            document.getElementById('rightarrowbillbilltwo').style.visibility = 'visible';
          }
            }
          }
          function leftarrowbillbilltwo() {
            document.getElementById('billfield').scrollLeft += -90;
            var width = $('#billfield').outerWidth()
            var scrollWidth = $('#billfield')[0].scrollWidth; 
            var scrollLeft = $('#billfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbilltwo').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbilltwo').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowbillbilltwo').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowbillbilltwo() {
            document.getElementById('billfield').scrollLeft += 90;
            var width = $('#billfield').outerWidth()
            var scrollWidth = $('#billfield')[0].scrollWidth; 
            var scrollLeft = $('#billfield').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowbillbilltwo').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowbillbilltwo').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #billfield::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#billfield::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#billfield::-webkit-scrollbar-track {
  background-color: green;
}

#billfield::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#billfield::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallbillbilltwo{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsallbillbilltwo{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchbillbilltwo()" class="accordion-header scrollbar-2" id="billfield" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#billfields"
                                                    aria-expanded="true" aria-controls="billfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="billfields" class="accordion-collapse collapse show"
                                                aria-labelledby="billfield">
                                                <div class="accordion-body text-sm">
                                                    <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Bills' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Bills' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='BillInformation')) {
                  $fullaccessans = 'bill';
                }
                else if (($coltypemod=='VendorInformation')) {
                  $fullaccessans = 'billvendor';
                }
                else if (($coltypemod=='ItemInformation')) {
                  $fullaccessans = 'billitem';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>bill()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'bills billssubhead':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'billvendors billvendorssubhead':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'billitems billitemssubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>bill"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= ($newmoduleskey=='Batch')?'disabled':'' ?> <?= ($newmoduleskey=='Batch'&&$access['batchexpiryval']==1)?'checked':'' ?> <?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>bill" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> <?php
                        if ($newmoduleskey=='Taxable Value') {
echo '<input type="text" value="'. $access['txttaxablebill'] .'" class="form-control form-control-sm" style="border: 1px dashed lightgrey;position: relative;top: -2.5px;" name="txttaxablebill">';
}
else if ($newmoduleskey=='Quantity') {
echo '<input type="text" value="'. $access['txtqtybill'] .'" class="form-control form-control-sm" style="border: 1px dashed lightgrey;position: relative;top: -2.5px;" name="txtqtybill">';
}
else if ($newmoduleskey=='Discount') {
echo '<input type="text" value="'. $access['txtprodisbill'] .'" class="form-control form-control-sm" style="border: 1px dashed lightgrey;position: relative;top: -2.5px;" name="txtprodisbill">';
}
else if ($newmoduleskey=='Sale Quantity') {
echo '<input type="text" value="'. $access['txtsqty'] .'" class="form-control form-control-sm" style="border: 1px dashed lightgrey;position: relative;top: -2.5px;" name="txtsqty">';
}
else{
echo ''.str_replace(" or ", " / ",(str_replace("Rupee", $rescurrency[0],(str_replace("opparen", '(',(str_replace("closparen", ')',(str_replace("Percentage", '%',(str_replace("Bill ", $infomainaccesspurchasebill['modulename']." ",(str_replace("Batch","Batch & Expiry",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))))))))))))))).'';
}
?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>bill()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>bill()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Bill Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'bills':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'billvendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'billitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'billsadd aevforbills':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'billvendorsadd aevforbillvendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'billitemsadd aevforbillitems':'' ?>" name="<?= $coltypemod; ?>addbills" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>bill" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Batch')?'disabled':'' ?> <?= ($newmoduleskey=='Batch'&&$access['batchexpiryval']==1)?'checked':'' ?> <?= ($newmoduleskey=='Vendor Name')?'disabled checked':'' ?> <?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>bill" style="color:<?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>bill()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>bill()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Bill Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'bills':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'billvendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'billitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'billsedit aevforbills':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'billvendorsedit aevforbillvendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'billitemsedit aevforbillitems':'' ?>" name="<?= $coltypemod; ?>editbills" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>bill" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?> <?= ($newmoduleskey=='Batch')?'disabled':'' ?> <?= ($newmoduleskey=='Batch'&&$access['batchexpiryval']==1)?'checked':'' ?> <?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>bill" style="color:<?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>bill()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>bill()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Bill Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'bills':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'billvendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'billitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'billsview aevforbills':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'billvendorsview aevforbillvendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'||$newmoduleskey=='Sale Quantity'))?'billitemsview aevforbillitems':'' ?>" name="<?= $coltypemod; ?>viewbills" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>bill" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= ($newmoduleskey=='Batch')?'disabled':'' ?> <?= ($newmoduleskey=='Batch'&&$access['batchexpiryval']==1)?'checked':'' ?> <?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>bill" style="color:<?= (($newmoduleskey=='Bill Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              // function BillInformationbillbill() {
              //   let purbills = document.getElementsByClassName("bills");
              //   billlen = purbills.length;
              //   if ($("#BillInformationbillbill").prop("checked")) {
              //   for (i=0;i<billlen;i++) {
              //   purbills[i].checked=true;
              //   purbills[i].disabled=false;
              //   }
              //   }
              //   else{
              //   for (i=0;i<billlen;i++) {
              //   purbills[i].checked=false;
              //   purbills[i].disabled=true;
              //   }
              //   }
              // }
              // function VendorInformationbillvendorbill() {
              //   let billvendors = document.getElementsByClassName("billvendors");
              //   vendorslen = billvendors.length;
              //   if ($("#VendorInformationbillvendorbill").prop("checked")) {
              //   for (i=0;i<vendorslen;i++) {
              //   billvendors[i].checked=true;
              //   billvendors[i].disabled=false;
              //   }
              //   }
              //   else{
              //   for (i=0;i<vendorslen;i++) {
              //   billvendors[i].checked=false;
              //   billvendors[i].disabled=true;
              //   }
              //   }
              // }
              // function ItemInformationbillitembill() {
              //   let billitems = document.getElementsByClassName("billitems");
              //   vendorslen = billitems.length;
              //   if ($("#ItemInformationbillitembill").prop("checked")) {
              //   for (i=0;i<vendorslen;i++) {
              //   billitems[i].checked=true;
              //   billitems[i].disabled=false;
              //   }
              //   }
              //   else{
              //   for (i=0;i<vendorslen;i++) {
              //   billitems[i].checked=false;
              //   billitems[i].disabled=true;
              //   }
              //   }
              // }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>bill() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>bill");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>bill");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>bill");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>bill");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
// let billssubhead = document.getElementsByClassName("billssubhead");
// let billssubheadchnumof = billssubhead.length;
// for (i=0;i<billssubhead.length;i++) {
// if (billssubhead[i].checked) {
// billssubheadchnumof+=1;
// }
// else{
// billssubheadchnumof-=1;
// }
// }
// if (billssubheadchnumof==0) {
// document.getElementById("BillInformationbillbill").checked=false;
// document.getElementById("BillInformationaddbillbill").checked=false;
// document.getElementById("BillInformationeditbillbill").checked=false;
// document.getElementById("BillInformationviewbillbill").checked=false;
// }
// else{
// document.getElementById("BillInformationbillbill").checked=true;
// document.getElementById("BillInformationaddbillbill").checked=true;
// document.getElementById("BillInformationeditbillbill").checked=true;
// document.getElementById("BillInformationviewbillbill").checked=true;
// }
// let billvendorssubhead = document.getElementsByClassName("billvendorssubhead");
// let billvendorssubheadchnumof = billvendorssubhead.length;
// for (i=0;i<billvendorssubhead.length;i++) {
// if (billvendorssubhead[i].checked) {
// billvendorssubheadchnumof+=1;
// }
// else{
// billvendorssubheadchnumof-=1;
// }
// }
// if (billvendorssubheadchnumof==0) {
// document.getElementById("VendorInformationbillvendorbill").checked=false;
// document.getElementById("VendorInformationaddbillvendorbill").checked=false;
// document.getElementById("VendorInformationeditbillvendorbill").checked=false;
// document.getElementById("VendorInformationviewbillvendorbill").checked=false;
// }
// else{
// document.getElementById("VendorInformationbillvendorbill").checked=true;
// document.getElementById("VendorInformationaddbillvendorbill").checked=true;
// document.getElementById("VendorInformationeditbillvendorbill").checked=true;
// document.getElementById("VendorInformationviewbillvendorbill").checked=true;
// }
// let billitemssubhead = document.getElementsByClassName("billitemssubhead");
// let billitemssubheadchnumof = billitemssubhead.length;
// for (i=0;i<billitemssubhead.length;i++) {
// if (billitemssubhead[i].checked) {
// billitemssubheadchnumof+=1;
// }
// else{
// billitemssubheadchnumof-=1;
// }
// }
// if (billitemssubheadchnumof==0) {
// document.getElementById("ItemInformationbillitembill").checked=false;
// document.getElementById("ItemInformationaddbillitembill").checked=false;
// document.getElementById("ItemInformationeditbillitembill").checked=false;
// document.getElementById("ItemInformationviewbillitembill").checked=false;
// }
// else{
// document.getElementById("ItemInformationbillitembill").checked=true;
// document.getElementById("ItemInformationaddbillitembill").checked=true;
// document.getElementById("ItemInformationeditbillitembill").checked=true;
// document.getElementById("ItemInformationviewbillitembill").checked=true;
// }
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>bill() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>bill");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>bill");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>bill");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>bill");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                // if (($coltypemod=='Reference'||$coltypemod=='SalePerson'||$coltypemod=='PreparedBy'||$coltypemod=='CheckedBy')) {
                ?>
                // let aevforbillsch = document.getElementsByClassName("aevforbills");
                // let aevchnumofbill = aevforbillsch.length;
                // for (i=0;i<aevforbillsch.length;i++) {
                // if (aevforbillsch[i].checked) {
                //     aevchnumofbill+=1;
                // }
                // else{
                //     aevchnumofbill-=1;
                // }
                // }
                //     if (aevchnumofbill==0) {
                //     document.getElementById("BillInformationbillbill").checked=false;
                //     }
                //     else{
                //     document.getElementById("BillInformationbillbill").checked=true;
                // }
                // let aevforbillsadd = document.getElementsByClassName("billsadd");
                // let billsadd = aevforbillsadd.length;
                // for (i=0;i<aevforbillsadd.length;i++) {
                // if (aevforbillsadd[i].checked) {
                //     billsadd+=1;
                // }
                // else{
                //     billsadd-=1;
                // }
                // }
                // if (billsadd==0) {
                // document.getElementById("BillInformationaddbillbill").checked=false;
                // }
                // else{
                // document.getElementById("BillInformationaddbillbill").checked=true;
                // }
                // let aevforbillsedit = document.getElementsByClassName("billsedit");
                // let billsedit = aevforbillsedit.length;
                // for (i=0;i<aevforbillsedit.length;i++) {
                // if (aevforbillsedit[i].checked) {
                //     billsedit+=1;
                // }
                // else{
                //     billsedit-=1;
                // }
                // }
                // if (billsedit==0) {
                // document.getElementById("BillInformationeditbillbill").checked=false;
                // }
                // else{
                // document.getElementById("BillInformationeditbillbill").checked=true;
                // }
                // let aevforbillsview = document.getElementsByClassName("billsview");
                // let billsview = aevforbillsview.length;
                // for (i=0;i<aevforbillsview.length;i++) {
                // if (aevforbillsview[i].checked) {
                //     billsview+=1;
                // }
                // else{
                //     billsview-=1;
                // }
                // }
                // if (billsview==0) {
                // document.getElementById("BillInformationviewbillbill").checked=false;
                // }
                // else{
                // document.getElementById("BillInformationviewbillbill").checked=true;
                // }
                <?php
                // }
                // else 
                    // if (($coltypemod=='BillingName'||$coltypemod=='BillingAddress'||$coltypemod=='WorkPhone'||$coltypemod=='GSTIN'||$coltypemod=='ShippingName'||$coltypemod=='ShippingAddress'||$coltypemod=='MobilePhone'||$coltypemod=='PlaceofSupply')) {
                ?>
                // let aevforbillvendorsch = document.getElementsByClassName("aevforbillvendors");
                // let aevchnumofbill = aevforbillvendorsch.length;
                // for (i=0;i<aevforbillvendorsch.length;i++) {
                // if (aevforbillvendorsch[i].checked) {
                //     aevchnumofbill+=1;
                // }
                // else{
                //     aevchnumofbill-=1;
                // }
                // }
                //     if (aevchnumofbill==0) {
                //     document.getElementById("VendorInformationbillvendorbill").checked=false;
                //     }
                //     else{
                //     document.getElementById("VendorInformationbillvendorbill").checked=true;
                // }
                // let aevforbillvendorsadd = document.getElementsByClassName("billvendorsadd");
                // let billvendorsadd = aevforbillvendorsadd.length;
                // for (i=0;i<aevforbillvendorsadd.length;i++) {
                // if (aevforbillvendorsadd[i].checked) {
                //     billvendorsadd+=1;
                // }
                // else{
                //     billvendorsadd-=1;
                // }
                // }
                // if (billvendorsadd==0) {
                // document.getElementById("VendorInformationaddbillvendorbill").checked=false;
                // }
                // else{
                // document.getElementById("VendorInformationaddbillvendorbill").checked=true;
                // }
                // let aevforbillvendorsedit = document.getElementsByClassName("billvendorsedit");
                // let billvendorsedit = aevforbillvendorsedit.length;
                // for (i=0;i<aevforbillvendorsedit.length;i++) {
                // if (aevforbillvendorsedit[i].checked) {
                //     billvendorsedit+=1;
                // }
                // else{
                //     billvendorsedit-=1;
                // }
                // }
                // if (billvendorsedit==0) {
                // document.getElementById("VendorInformationeditbillvendorbill").checked=false;
                // }
                // else{
                // document.getElementById("VendorInformationeditbillvendorbill").checked=true;
                // }
                // let aevforbillvendorsview = document.getElementsByClassName("billvendorsview");
                // let billvendorsview = aevforbillvendorsview.length;
                // for (i=0;i<aevforbillvendorsview.length;i++) {
                // if (aevforbillvendorsview[i].checked) {
                //     billvendorsview+=1;
                // }
                // else{
                //     billvendorsview-=1;
                // }
                // }
                // if (billvendorsview==0) {
                // document.getElementById("VendorInformationviewbillvendorbill").checked=false;
                // }
                // else{
                // document.getElementById("VendorInformationviewbillvendorbill").checked=true;
                // }
                <?php
                // }
                // else if (($coltypemod=='ProductCategory'||$coltypemod=='ProductMrp'||$coltypemod=='ProductDescription'||$coltypemod=='TaxableValue'||$coltypemod=='TaxValue'||$coltypemod=='TaxTable'||$coltypemod=='Attach'||$coltypemod=='Description'||$coltypemod=='Notes'||$coltypemod=='TermsandConditions'||$coltypemod=='SaleQuantity')) {
                ?>
                // let aevforbillitemsch = document.getElementsByClassName("aevforbillitems");
                // let aevchnumofbill = aevforbillitemsch.length;
                // for (i=0;i<aevforbillitemsch.length;i++) {
                // if (aevforbillitemsch[i].checked) {
                //     aevchnumofbill+=1;
                // }
                // else{
                //     aevchnumofbill-=1;
                // }
                // }
                //     if (aevchnumofbill==0) {
                //     document.getElementById("ItemInformationbillitembill").checked=false;
                //     }
                //     else{
                //     document.getElementById("ItemInformationbillitembill").checked=true;
                // }
                // let aevforbillitemsadd = document.getElementsByClassName("billitemsadd");
                // let billitemsadd = aevforbillitemsadd.length;
                // for (i=0;i<aevforbillitemsadd.length;i++) {
                // if (aevforbillitemsadd[i].checked) {
                //     billitemsadd+=1;
                // }
                // else{
                //     billitemsadd-=1;
                // }
                // }
                // if (billitemsadd==0) {
                // document.getElementById("ItemInformationaddbillitembill").checked=false;
                // }
                // else{
                // document.getElementById("ItemInformationaddbillitembill").checked=true;
                // }
                // let aevforbillitemsedit = document.getElementsByClassName("billitemsedit");
                // let billitemsedit = aevforbillitemsedit.length;
                // for (i=0;i<aevforbillitemsedit.length;i++) {
                // if (aevforbillitemsedit[i].checked) {
                //     billitemsedit+=1;
                // }
                // else{
                //     billitemsedit-=1;
                // }
                // }
                // if (billitemsedit==0) {
                // document.getElementById("ItemInformationeditbillitembill").checked=false;
                // }
                // else{
                // document.getElementById("ItemInformationeditbillitembill").checked=true;
                // }
                // let aevforbillitemsview = document.getElementsByClassName("billitemsview");
                // let billitemsview = aevforbillitemsview.length;
                // for (i=0;i<aevforbillitemsview.length;i++) {
                // if (aevforbillitemsview[i].checked) {
                //     billitemsview+=1;
                // }
                // else{
                //     billitemsview-=1;
                // }
                // }
                // if (billitemsview==0) {
                // document.getElementById("ItemInformationviewbillitembill").checked=false;
                // }
                // else{
                // document.getElementById("ItemInformationviewbillitembill").checked=true;
                // }
                <?php
                // }
                ?>
              }
// function BillInformationaddbillbill() {
// let bill = document.getElementsByClassName("billsadd");
// billlen = bill.length;
// let aevforbills = document.getElementsByClassName("aevforbills");
// let billssubhead = document.getElementsByClassName("billssubhead");
// let chnumofbill = aevforbills.length;
// if ($("#BillInformationaddbillbill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbills.length;i++) {
// if (aevforbills[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billssubhead[i].checked=false;
// }
// else{
// billssubhead[i].checked=true;
// }
// }
// }
// function BillInformationeditbillbill() {
// let bill = document.getElementsByClassName("billsedit");
// billlen = bill.length;
// let aevforbills = document.getElementsByClassName("aevforbills");
// let billssubhead = document.getElementsByClassName("billssubhead");
// let chnumofbill = aevforbills.length;
// if ($("#BillInformationeditbillbill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbills.length;i++) {
// if (aevforbills[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billssubhead[i].checked=false;
// }
// else{
// billssubhead[i].checked=true;
// }
// }
// }
// function BillInformationviewbillbill() {
// let bill = document.getElementsByClassName("billsview");
// billlen = bill.length;
// let aevforbills = document.getElementsByClassName("aevforbills");
// let billssubhead = document.getElementsByClassName("billssubhead");
// let chnumofbill = aevforbills.length;
// if ($("#BillInformationviewbillbill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbills.length;i++) {
// if (aevforbills[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billssubhead[i].checked=false;
// }
// else{
// billssubhead[i].checked=true;
// }
// }
// }
// function VendorInformationaddbillvendorbill() {
// let bill = document.getElementsByClassName("billvendorsadd");
// billlen = bill.length;
// let aevforbillvendors = document.getElementsByClassName("aevforbillvendors");
// let billvendorssubhead = document.getElementsByClassName("billvendorssubhead");
// let chnumofbill = aevforbillvendors.length;
// if ($("#VendorInformationaddbillvendorbill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbillvendors.length;i++) {
// if (aevforbillvendors[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billvendorssubhead[i].checked=false;
// }
// else{
// billvendorssubhead[i].checked=true;
// }
// }
// }
// function VendorInformationeditbillvendorbill() {
// let bill = document.getElementsByClassName("billvendorsedit");
// billlen = bill.length;
// let aevforbillvendors = document.getElementsByClassName("aevforbillvendors");
// let billvendorssubhead = document.getElementsByClassName("billvendorssubhead");
// let chnumofbill = aevforbillvendors.length;
// if ($("#VendorInformationeditbillvendorbill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbillvendors.length;i++) {
// if (aevforbillvendors[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billvendorssubhead[i].checked=false;
// }
// else{
// billvendorssubhead[i].checked=true;
// }
// }
// }
// function VendorInformationviewbillvendorbill() {
// let bill = document.getElementsByClassName("billvendorsview");
// billlen = bill.length;
// let aevforbillvendors = document.getElementsByClassName("aevforbillvendors");
// let billvendorssubhead = document.getElementsByClassName("billvendorssubhead");
// let chnumofbill = aevforbillvendors.length;
// if ($("#VendorInformationviewbillvendorbill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbillvendors.length;i++) {
// if (aevforbillvendors[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billvendorssubhead[i].checked=false;
// }
// else{
// billvendorssubhead[i].checked=true;
// }
// }
// }
// function ItemInformationaddbillitembill() {
// let bill = document.getElementsByClassName("billitemsadd");
// billlen = bill.length;
// let aevforbillitems = document.getElementsByClassName("aevforbillitems");
// let billitemssubhead = document.getElementsByClassName("billitemssubhead");
// let chnumofbill = aevforbillitems.length;
// if ($("#ItemInformationaddbillitembill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbillitems.length;i++) {
// if (aevforbillitems[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billitemssubhead[i].checked=false;
// }
// else{
// billitemssubhead[i].checked=true;
// }
// }
// }
// function ItemInformationeditbillitembill() {
// let bill = document.getElementsByClassName("billitemsedit");
// billlen = bill.length;
// let aevforbillitems = document.getElementsByClassName("aevforbillitems");
// let billitemssubhead = document.getElementsByClassName("billitemssubhead");
// let chnumofbill = aevforbillitems.length;
// if ($("#ItemInformationeditbillitembill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbillitems.length;i++) {
// if (aevforbillitems[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billitemssubhead[i].checked=false;
// }
// else{
// billitemssubhead[i].checked=true;
// }
// }
// }
// function ItemInformationviewbillitembill() {
// let bill = document.getElementsByClassName("billitemsview");
// billlen = bill.length;
// let aevforbillitems = document.getElementsByClassName("aevforbillitems");
// let billitemssubhead = document.getElementsByClassName("billitemssubhead");
// let chnumofbill = aevforbillitems.length;
// if ($("#ItemInformationviewbillitembill").prop("checked")) {
// for (i=0;i<billlen;i++) {
// bill[i].checked=true;
// }
// }
// else{
// for (i=0;i<billlen;i++) {
// bill[i].checked=false;
// }
// }
// for (i=0;i<aevforbillitems.length;i++) {
// if (aevforbillitems[i].checked) {
// chnumofbill+=1;
// }
// else{
// chnumofbill-=1;
// }
// }
// for (i=0;i<billlen;i++) {
// if (chnumofbill==0) {
// billitemssubhead[i].checked=false;
// }
// else{
// billitemssubhead[i].checked=true;
// }
// }
// }
            </script>
<?php
}
?>
<div class="row" style="border-top:1px solid #eee;padding:5px 0;"></div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<div style="visibility: visible;" id="arrowsallbillbillthree">
<svg id="rightarrowbillbillthree" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowbillbillthree()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowbillbillthree" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowbillbillthree()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchbillbillthree() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#btwocreqfield').outerWidth()
            var scrollWidth = $('#btwocreqfield')[0].scrollWidth; 
            var scrollLeft = $('#btwocreqfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillthree').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillthree').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowbillbillthree').style.visibility = 'hidden';
            document.getElementById('leftarrowbillbillthree').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowbillbillthree').style.visibility = 'visible';
            document.getElementById('rightarrowbillbillthree').style.visibility = 'visible';
          }
            }
          }
          function leftarrowbillbillthree() {
            document.getElementById('btwocreqfield').scrollLeft += -90;
            var width = $('#btwocreqfield').outerWidth()
            var scrollWidth = $('#btwocreqfield')[0].scrollWidth; 
            var scrollLeft = $('#btwocreqfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillthree').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillthree').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowbillbillthree').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowbillbillthree() {
            document.getElementById('btwocreqfield').scrollLeft += 90;
            var width = $('#btwocreqfield').outerWidth()
            var scrollWidth = $('#btwocreqfield')[0].scrollWidth; 
            var scrollLeft = $('#btwocreqfield').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowbillbillthree').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowbillbillthree').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #btwocreqfield::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#btwocreqfield::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#btwocreqfield::-webkit-scrollbar-track {
  background-color: green;
}

#btwocreqfield::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#btwocreqfield::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallbillbillthree{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsallbillbillthree{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchbillbillthree()" class="accordion-header scrollbar-2" id="btwocreqfield" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#btwocreqfields"
aria-expanded="true" aria-controls="btwocreqfields">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display as required</a>
</div>
</button>
</h5>
</div>
<div id="btwocreqfields" class="accordion-collapse collapse show"
aria-labelledby="btwocreqfield">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2"> <span class="text-danger">Vendor Name *</span> </div>
<div class="col-lg-10 mt-2 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billbtwocnamerequired" id="billbtwocnamerequiredyes" value="Yes" <?= ($access['billbtwocnamerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbtwocnamerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="billbtwocnamerequired" id="billbtwocnamerequiredno" value="No" <?= ($access['billbtwocnamerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="billbtwocnamerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:3px solid #eee;">
<div class="col-lg-2 mt-1 mb-2"> <span class="text-danger">Work Phone *</span> </div>
<div class="col-lg-10 mt-1 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billbtwocwphonerequired" id="billbtwocwphonerequiredyes" value="Yes" <?= ($access['billbtwocwphonerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbtwocwphonerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="billbtwocwphonerequired" id="billbtwocwphonerequiredno" value="No" <?= ($access['billbtwocwphonerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="billbtwocwphonerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <div style="visibility: visible;" id="arrowsallbillbillfour">
<svg id="rightarrowbillbillfour" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowbillbillfour()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowbillbillfour" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowbillbillfour()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchbillbillfour() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#billdefault').outerWidth()
            var scrollWidth = $('#billdefault')[0].scrollWidth; 
            var scrollLeft = $('#billdefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillfour').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillfour').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowbillbillfour').style.visibility = 'hidden';
            document.getElementById('leftarrowbillbillfour').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowbillbillfour').style.visibility = 'visible';
            document.getElementById('rightarrowbillbillfour').style.visibility = 'visible';
          }
            }
          }
          function leftarrowbillbillfour() {
            document.getElementById('billdefault').scrollLeft += -90;
            var width = $('#billdefault').outerWidth()
            var scrollWidth = $('#billdefault')[0].scrollWidth; 
            var scrollLeft = $('#billdefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillfour').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillfour').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowbillbillfour').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowbillbillfour() {
            document.getElementById('billdefault').scrollLeft += 90;
            var width = $('#billdefault').outerWidth()
            var scrollWidth = $('#billdefault')[0].scrollWidth; 
            var scrollLeft = $('#billdefault').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowbillbillfour').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowbillbillfour').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #billdefault::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#billdefault::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#billdefault::-webkit-scrollbar-track {
  background-color: green;
}

#billdefault::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#billdefault::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallbillbillfour{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsallbillbillfour{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchbillbillfour()" class="accordion-header scrollbar-2" id="billdefault" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#billdefaults"
                                                    aria-expanded="true" aria-controls="billdefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="billdefaults" class="accordion-collapse collapse show"
                                                aria-labelledby="billdefault">
                                                <div class="accordion-body text-sm">
                                                  <?php
                                                  $sqlismainaccessdef=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Bills' order by id  asc");
                                                  $infomainaccessdef=mysqli_fetch_array($sqlismainaccessdef);
                                                  ?>
                                                  <div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
                                                    <div class="col-lg-2 mt-2 mb-2">
                                                      Vendor Information
                                                    </div>
                                                    <div class="col-lg-10 mt-2 mb-2">
                                                      <div class="row">
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="billvendorinfodefault" id="billmanualvendorinfo" value="one" onclick="billveninfodefault()" <?= ($infomainaccessdef['billveninfo']=='one')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="billmanualvendorinfo">B2B</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="billvendorinfodefault" id="billdefaultvendorinfo" value="two" onclick="billveninfodefault()" <?= ($infomainaccessdef['billveninfo']=='two')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="billdefaultvendorinfo">B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="billvendorinfodefault" id="billbothvendorinfo" value="both" onclick="billveninfodefault()">
                        <label class="custom-control-label custom-label" for="billbothvendorinfo">B2B & B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3" style="display: none;" id="billveninfodefault">
<select name="billveninfoselect" id="billveninfoselect" class="select4 form-control form-control-sm">
<option value="" <?= ($infomainaccessdef['billveninfo']=='one'||'two')?'selected':'' ?> disabled>Select</option> 
<option value="defone" <?= ($infomainaccessdef['billveninfo']=='defone')?'selected':'' ?>>B2B</option> 
<option value="deftwo" <?= ($infomainaccessdef['billveninfo']=='deftwo')?'selected':'' ?>>B2C</option> 
</select>
</div>
<input type="hidden" id="billcheckvalue" value="<?= $infomainaccessdef['billveninfo'] ?>">
<script type="text/javascript">
    $(document).ready(function () {
        var billcheckvalue = document.getElementById('billcheckvalue');
        if (billcheckvalue.value=='one') {
            document.getElementById("billveninfodefault").style.display="none !important";
            $("#billveninfoselect").removeAttr("required");
            document.getElementById("billb2cpos").style.display='none';
        }
        else if (billcheckvalue.value=='two') {
            document.getElementById("billveninfodefault").style.display="none !important";
            $("#billveninfoselect").removeAttr("required");
            document.getElementById("billb2cpos").style.display='flex';
        }
        else if (billcheckvalue.value!='two'||'one') {
            document.getElementById("billveninfodefault").style.display="block";
            document.getElementById("billbothvendorinfo").checked=true;
            $("#billveninfoselect").attr("required","required");
            document.getElementById("billb2cpos").style.display='flex';
        }
    });
    function billveninfodefault() {
        var one = document.getElementById('billmanualvendorinfo');
        var two = document.getElementById('billdefaultvendorinfo');
        var both = document.getElementById('billbothvendorinfo');
        if (one.checked==true) {
            document.getElementById("billveninfodefault").style.display="none";
            var billveninfoselect = document.getElementById("billveninfoselect");
            var billveninfoselectans = billveninfoselect.options[billveninfoselect.selectedIndex].text;
            billveninfoselect.value='';
            $("#billveninfoselect").removeAttr("required");
            document.getElementById("billb2cpos").style.display='none';
        }
        else if (two.checked==true) {
            document.getElementById("billveninfodefault").style.display="none";
            var billveninfoselect = document.getElementById("billveninfoselect");
            var billveninfoselectans = billveninfoselect.options[billveninfoselect.selectedIndex].text;
            billveninfoselect.value='';
            $("#billveninfoselect").removeAttr("required");
            document.getElementById("billb2cpos").style.display='flex';
        }
        else if (both.checked==true) {
            document.getElementById("billveninfodefault").style.display="block";
            var billveninfoselect = document.getElementById("billveninfoselect");
            var billveninfoselectans = billveninfoselect.options[billveninfoselect.selectedIndex].text;
            if (billveninfoselectans=='Select') {$("#billveninfoselect").attr("required","required");}
            document.getElementById("billb2cpos").style.display='flex';
        }
    }
</script>
                  </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2" id="billb2cpos" style="display:none;border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2 pt-1">
GST Registration Type
</div>
<div class="col-lg-4 mt-1 mb-2">
<select class="selectpicker form-control select2 twogst" data-live-search="true" title="Search title or description..." id="billtwogst" name="billtwogst">

<option data-foo="Business that is registered under GST" value="Registered Business - Regular" <?=($infomainaccessdef['billtwogst']=='Registered Business - Regular')?'selected':'';?>>Registered Business - Regular</option>

<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition" <?=($infomainaccessdef['billtwogst']=='Registered Business - Composition')?'selected':'';?>>Registered Business - Composition</option>

<option data-foo="Business that has not been registered under GST" value="Unregistered Business" <?=($infomainaccessdef['billtwogst']=='Unregistered Business')?'selected':'';?>>Unregistered Business</option>

<option data-foo="A customer who is a regular consumer" value="Consumer" <?=(($infomainaccessdef['billtwogst']=='Consumer')||($infomainaccessdef['billtwogst']==''))?'selected':'';?>>Consumer</option>

<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas" <?=($infomainaccessdef['billtwogst']=='Overseas')?'selected':'';?>>Overseas</option>

<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone" <?=($infomainaccessdef['billtwogst']=='Special Economic Zone')?'selected':'';?>>Special Economic Zone</option>

<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export" <?=($infomainaccessdef['billtwogst']=='Deemed Export')?'selected':'';?>>Deemed Export</option>

<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor" <?=($infomainaccessdef['billtwogst']=='Tax Deductor')?'selected':'';?>>Tax Deductor</option>

<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer" <?=($infomainaccessdef['billtwogst']=='SEZ Developer')?'selected':'';?>>SEZ Developer</option>
</select>
</div>
                                                    <div class="col-lg-2 mt-1 mb-2 pt-1">
                                                      Place of Supply
                                                    </div>
                                                    <div class="col-lg-4 mt-1 mb-2">
                                                        <select name="billtwopos" id="billtwopos" class="select4 form-control form-control-sm">
<option value="Select Place of Supply" <?= ($infomainaccessdef['billtwopos']=='Select Place of Supply')?'selected':'' ?>>Select Place of Supply</option>
<option value="JAMMU AND KASHMIR (1)" <?=($infomainaccessdef['billtwopos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($infomainaccessdef['billtwopos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($infomainaccessdef['billtwopos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($infomainaccessdef['billtwopos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($infomainaccessdef['billtwopos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($infomainaccessdef['billtwopos']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($infomainaccessdef['billtwopos']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($infomainaccessdef['billtwopos']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($infomainaccessdef['billtwopos']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($infomainaccessdef['billtwopos']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($infomainaccessdef['billtwopos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($infomainaccessdef['billtwopos']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($infomainaccessdef['billtwopos']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($infomainaccessdef['billtwopos']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($infomainaccessdef['billtwopos']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($infomainaccessdef['billtwopos']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($infomainaccessdef['billtwopos']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($infomainaccessdef['billtwopos']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($infomainaccessdef['billtwopos']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($infomainaccessdef['billtwopos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($infomainaccessdef['billtwopos']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($infomainaccessdef['billtwopos']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($infomainaccessdef['billtwopos']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($infomainaccessdef['billtwopos']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($infomainaccessdef['billtwopos']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($infomainaccessdef['billtwopos']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($infomainaccessdef['billtwopos']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($infomainaccessdef['billtwopos']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($infomainaccessdef['billtwopos']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($infomainaccessdef['billtwopos']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($infomainaccessdef['billtwopos']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($infomainaccessdef['billtwopos']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($infomainaccessdef['billtwopos']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($infomainaccessdef['billtwopos']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($infomainaccessdef['billtwopos']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($infomainaccessdef['billtwopos']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($infomainaccessdef['billtwopos']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($infomainaccessdef['billtwopos']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($infomainaccessdef['billtwopos']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
                                                      </div>
                                                      </div>
<div class="row mb-2" style="border-bottom:2px solid #eee;<?= ($access['batchexpiryval']==1)?'':'display: none;' ?>">
<div class="col-lg-2 mb-2">
Product Batch
</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billbatchdef" id="billbatchshow" value="show" <?= ($access['billbatchdef']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbatchshow">Show All</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billbatchdef" id="billbatchavail" value="avail" <?= ($access['billbatchdef']=='avail')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbatchavail">Available Only(Custom)</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mb-2">
Product Rate
</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billratedef" id="billrateshow" value="show" <?= ($access['billratedef']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billrateshow">Show All</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billratedef" id="billrateavail" value="avail" <?= ($access['billratedef']=='avail')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billrateavail">Available Only</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="<?=(($infomainaccessdebitnotes['moduleaccess']=='1')?'border-bottom:2px solid #eee;':'')?>">
<div class="col-lg-2 mb-2">Display in Dropdown</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billnewproductdef" id="billnewproductdef" <?= ($access['billnewproductdef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billnewproductdef">New Product</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billnewvendordef" id="billnewvendordef" <?= ($access['billnewvendordef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billnewvendordef">New Vendor</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-1" style="<?=(($infomainaccessdebitnotes['moduleaccess']=='1')?'':'display:none;')?>">
<div class="col-lg-2 mb-1">
<?= $infomainaccesspurchasereturn['modulename'] ?> (View)
</div>
<div class="col-lg-10 mb-1" style="<?=(($infomainaccessdebitnotes['moduleaccess']=='1')?'':'display:none;')?>">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="defpurchasereturnaccess" id="defpurchasereturnaccessone" value="0" <?= ($access['defpurchasereturnaccess']=='0')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="defpurchasereturnaccessone"><?= $infomainaccesspurchasereturn['modulename'] ?></label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="defpurchasereturnaccess" id="defpurchasereturnaccesstwo" value="1" <?= ($access['defpurchasereturnaccess']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="defpurchasereturnaccesstwo"><?= $infomainaccessdebitnotes['modulename'] ?></label>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>

                      </div>
                      </div>
                      </div>
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <div style="visibility: visible;" id="arrowsallbillbillfive">
<svg id="rightarrowbillbillfive" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowbillbillfive()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowbillbillfive" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowbillbillfive()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchbillbillfive() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#billcolumn').outerWidth()
            var scrollWidth = $('#billcolumn')[0].scrollWidth; 
            var scrollLeft = $('#billcolumn').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillfive').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillfive').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowbillbillfive').style.visibility = 'hidden';
            document.getElementById('leftarrowbillbillfive').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowbillbillfive').style.visibility = 'visible';
            document.getElementById('rightarrowbillbillfive').style.visibility = 'visible';
          }
            }
          }
          function leftarrowbillbillfive() {
            document.getElementById('billcolumn').scrollLeft += -90;
            var width = $('#billcolumn').outerWidth()
            var scrollWidth = $('#billcolumn')[0].scrollWidth; 
            var scrollLeft = $('#billcolumn').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillfive').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillfive').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowbillbillfive').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowbillbillfive() {
            document.getElementById('billcolumn').scrollLeft += 90;
            var width = $('#billcolumn').outerWidth()
            var scrollWidth = $('#billcolumn')[0].scrollWidth; 
            var scrollLeft = $('#billcolumn').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowbillbillfive').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowbillbillfive').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #billcolumn::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#billcolumn::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#billcolumn::-webkit-scrollbar-track {
  background-color: green;
}

#billcolumn::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#billcolumn::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallbillbillfive{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsallbillbillfive{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchbillbillfive()" class="accordion-header scrollbar-2" id="billcolumn" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#billcolumns"
                                                    aria-expanded="true" aria-controls="billcolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable in all <?=strtolower($infomainaccesspurchasebill['modulename'])?></a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="billcolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="billcolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Bills' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Bills' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>billcol" id="<?= $coltypemod; ?>billcol" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>billcol" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Print')||($newmoduleskey=='Import'))?'red !important':'royalblue !important' ?>;"> <?= str_replace(" or ", " / ",(str_replace("Vendors", $infomainaccessvendor['modulename'],(str_replace("No", "Number",(str_replace("Bill", $infomainaccesspurchasebill['modulename'],$newmoduleskey))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallbillpaydefpage">
<svg id="rightarrowbillpayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowbillpayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowbillpayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowbillpayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchbillpayaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#billpaydefaultpage').outerWidth()
            var scrollWidth = $('#billpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#billpaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowbillpayaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowbillpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowbillpayaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowbillpayaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowbillpayaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowbillpayaccdefpage() {
            document.getElementById('billpaydefaultpage').scrollLeft += -90;
            var width = $('#billpaydefaultpage').outerWidth()
            var scrollWidth = $('#billpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#billpaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowbillpayaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowbillpayaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowbillpayaccdefpage() {
            document.getElementById('billpaydefaultpage').scrollLeft += 90;
            var width = $('#billpaydefaultpage').outerWidth()
            var scrollWidth = $('#billpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#billpaydefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowbillpayaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowbillpayaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #billpaydefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#billpaydefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#billpaydefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#billpaydefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#billpaydefaultpage::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallbillpaydefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallbillpaydefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchbillpayaccdefpage()" class="accordion-header scrollbar-2" id="billpaydefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#billpaydefaultspages"
                                                    aria-expanded="true" aria-controls="billpaydefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="billpaydefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="billpaydefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row pb-3" style="border-bottom:3px solid #eee;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billpageload" id="billpagenum" value="pagenum" <?= ($access['billpageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billpagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billpageload" id="billpageauto" value="pageauto" <?= ($access['billpageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billpageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
</div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<div style="visibility: visible;" id="arrowsallbillbillsix">
<svg id="rightarrowbillbillsix" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowbillbillsix()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowbillbillsix" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowbillbillsix()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchbillbillsix() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#billprint').outerWidth()
            var scrollWidth = $('#billprint')[0].scrollWidth; 
            var scrollLeft = $('#billprint').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillsix').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillsix').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowbillbillsix').style.visibility = 'hidden';
            document.getElementById('leftarrowbillbillsix').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowbillbillsix').style.visibility = 'visible';
            document.getElementById('rightarrowbillbillsix').style.visibility = 'visible';
          }
            }
          }
          function leftarrowbillbillsix() {
            document.getElementById('billprint').scrollLeft += -90;
            var width = $('#billprint').outerWidth()
            var scrollWidth = $('#billprint')[0].scrollWidth; 
            var scrollLeft = $('#billprint').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowbillbillsix').style.visibility = 'hidden';
            document.getElementById('rightarrowbillbillsix').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowbillbillsix').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowbillbillsix() {
            document.getElementById('billprint').scrollLeft += 90;
            var width = $('#billprint').outerWidth()
            var scrollWidth = $('#billprint')[0].scrollWidth; 
            var scrollLeft = $('#billprint').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowbillbillsix').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowbillbillsix').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #billprint::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#billprint::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#billprint::-webkit-scrollbar-track {
  background-color: green;
}

#billprint::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#billprint::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallbillbillsix{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsallbillbillsix{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchbillbillsix()" class="accordion-header scrollbar-2" id="billprint" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#billprints" aria-expanded="true" aria-controls="billprints">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the things would you like to display in print</a>
</div>
</button>
</h5>
<div id="billprints" class="accordion-collapse collapse show" aria-labelledby="billprint">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:0px solid #eee;color: royalblue !important;">
<div class="col-lg-12 mt-0 mb-0"><?=$infomainaccessvendor['modulename']?></div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;display: none;">
<div class="col-lg-2 mt-2 mb-2">GST Treatment</div>
<div class="col-lg-4 mt-2 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintgsttreatment" id="billprintgsttreatauto" value="auto" <?= $infomainaccessdef['billprintgsttreatment']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintgsttreatauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintgsttreatment" id="billprintgsttreatshow" value="show" <?= ($infomainaccessdef['billprintgsttreatment']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintgsttreatshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintgsttreatment" id="billprintgsttreathide" value="hide" <?= $infomainaccessdef['billprintgsttreatment']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintgsttreathide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">GSTIN</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintgstin" id="billprintgstinauto" value="auto" <?= $infomainaccessdef['billprintgstin']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintgstinauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintgstin" id="billprintgstinshow" value="show" <?= ($infomainaccessdef['billprintgstin']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintgstinshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintgstin" id="billprintgstinhide" value="hide" <?= $infomainaccessdef['billprintgstin']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintgstinhide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">Place of Supply</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintpos" id="billprintposauto" value="auto" <?= $infomainaccessdef['billprintpos']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintposauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintpos" id="billprintposshow" value="show" <?= ($infomainaccessdef['billprintpos']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintposshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billprintpos" id="billprintposhide" value="hide" <?= $infomainaccessdef['billprintpos']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintposhide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">DL No 20</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billviewprintdlno20" id="billviewprintdlno20auto" value="auto" <?= $infomainaccessdef['viewprintdlno20']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billviewprintdlno20auto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billviewprintdlno20" id="billviewprintdlno20show" value="show" <?= ($infomainaccessdef['viewprintdlno20']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billviewprintdlno20show">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billviewprintdlno20" id="billviewprintdlno20hide" value="hide" <?= $infomainaccessdef['viewprintdlno20']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billviewprintdlno20hide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">DL No 21</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billviewprintdlno21" id="billviewprintdlno21auto" value="auto" <?= $infomainaccessdef['viewprintdlno21']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billviewprintdlno21auto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billviewprintdlno21" id="billviewprintdlno21show" value="show" <?= ($infomainaccessdef['viewprintdlno21']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billviewprintdlno21show">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="billviewprintdlno21" id="billviewprintdlno21hide" value="hide" <?= $infomainaccessdef['viewprintdlno21']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billviewprintdlno21hide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mb-2">Expiry</div>
<div class="col-lg-4 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billprintexpdate" id="billprintexpdate" <?= ($access['billprintexpdate']=='1'&&$access['batchexpiryval']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintexpdate">Date</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billprintexpmonth" id="billprintexpmonth" <?= ($access['billprintexpmonth']=='1'&&$access['batchexpiryval']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintexpmonth">Month</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billprintexpyear" id="billprintexpyear" <?= ($access['billprintexpyear']=='1'&&$access['batchexpiryval']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintexpyear">Year</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:0px solid #eee;color: royalblue !important;">
<div class="col-lg-12 mt-1 mb-0"><?=$row['franchiseandroles']?></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billbranchphone" id="billbranchphone" <?= $access['billbranchphone']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbranchphone">Phone</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billbranchemail" id="billbranchemail" <?= $access['billbranchemail']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbranchemail">E-mail</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billbranchgstin" id="billbranchgstin" <?= $access['billbranchgstin']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbranchgstin">GSTIN</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billprintdlno20" id="billprintdlno20" <?= $access['billprintdlno20']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintdlno20">DL No 20</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billprintdlno21" id="billprintdlno21" <?= $access['billprintdlno21']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billprintdlno21">DL No 21</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billbank" id="billbank" <?= $access['billbank']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbank">Bank</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billname" id="billname" <?= $access['billname']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billname">Name</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billaccnumber" id="billaccnumber" <?= $access['billaccnumber']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billaccnumber">Account Number</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billifsccode" id="billifsccode" <?= $access['billifsccode']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billifsccode">IFSC Code</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="billbranchandcity" id="billbranchandcity" <?= $access['billbranchandcity']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="billbranchandcity">Branch & City</label>
</div>
</div><div class="col-lg-10"></div>
</div>

</div>
</div>
</div>
</div>
                                                
                                                            <div class="row justify-content-center mb-3">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
            </div>
<div class="tab-pane fade show mt-4 p-3 <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']!='1')&&($infomainaccesspaymade['moduleaccess']=='1'))?'active':'')?>" id="nav-paymade" role="tabpanel" aria-labelledby="nav-paymade-tab" <?=(($infomainaccesspaymade['moduleaccess']=='1')?'':'style="display:none"')?>>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="paymadesidebar">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#paymadesidebars" aria-expanded="true" aria-controls="paymadesidebars">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select would you like to display in sidebar</a>
</div>
</button>
</h5>
</div>
<div id="paymadesidebars" class="accordion-collapse collapse show"
aria-labelledby="paymadesidebar">
<div class="accordion-body text-sm">
<div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
<div class="col-lg-6 mb-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="paymadeside" id="paymadeside" <?= ($access['paymadeside']==1)?'checked':'' ?>>
<label class="custom-control-label custom-label" for="paymadeside" style="font-size: 14.6px;color:royalblue !important;"> <?= $infomainaccesspaymade['modulename'] ?></label>
</div>
</div>
<div class="col-lg-6"></div>       
</div>
</div>
</div>
</div>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="paymadefield">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#paymadefields"
                                                    aria-expanded="true" aria-controls="paymadefields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="paymadefields" class="accordion-collapse collapse show"
                                                aria-labelledby="paymadefield">
                                                <div class="accordion-body text-sm">
<?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Payments Made' order by id asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
$coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
$ans = $infomainaccess[21];
$newans = explode(',',$ans);
$ans1 = $infomainaccess[22];
$newans1 = explode(',',$ans1);
$ans2 = $infomainaccess[23];
$newans2 = explode(',',$ans2);
}

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Payments Made' order by id asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
$coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
$ansmodules = $infomodules[3];
$newmodules = explode(',',$ansmodules);
}
foreach ($newmodules as $newmoduleskey) {
$coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:0.5px solid #eee; border-bottom:0.5px solid #eee; padding:5px 0">
<div class="col-lg-2">
<div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>paymades()">
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?>paymades"<?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>paymades" style="font-size: 14.6px;"> <?= str_replace(" or ", " / ",(str_replace("Payments Made", $infomainaccesspaymade['modulename'],(str_replace("Category",$access['txtnamecategory'],(str_replace("Batch","Batch & Expiry",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))))))))) ?></label>
</div>
</div>
<div class="col-lg-10">
<div class="row">
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aevpaymades()">
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>addpaymades" id="<?= $coltypemod; ?>addpaymades" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>addpaymades" style="color:<?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Work Phone')||($newmoduleskey=='GSTIN'))?'yellow !important':'' ?>;"> Add</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aevpaymades()">
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>editpaymades" id="<?= $coltypemod; ?>editpaymades" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?>>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>editpaymades" style="color:<?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Billing Address')||($newmoduleskey=='Work Phone')||($newmoduleskey=='GSTIN'))?'yellow !important':'' ?>;"> Edit</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aevpaymades()">
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>viewpaymades" id="<?= $coltypemod; ?>viewpaymades" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>viewpaymades"> View</label>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
function <?= $coltypemod; ?>paymades() {
let fullhigh = document.getElementById("<?= $coltypemod; ?>paymades");
let addhigh = document.getElementById("<?= $coltypemod; ?>addpaymades");
let edithigh = document.getElementById("<?= $coltypemod; ?>editpaymades");
let viewhigh = document.getElementById("<?= $coltypemod; ?>viewpaymades");
if (fullhigh.checked == true) {
addhigh.checked=true;
edithigh.checked=true;
viewhigh.checked=true;
}
else{
addhigh.checked=false;
edithigh.checked=false;
viewhigh.checked=false;
}
}
function <?= $coltypemod; ?>aevpaymades() {
let full = document.getElementById("<?= $coltypemod; ?>paymades");
let add = document.getElementById("<?= $coltypemod; ?>addpaymades");
let edit = document.getElementById("<?= $coltypemod; ?>editpaymades");
let view = document.getElementById("<?= $coltypemod; ?>viewpaymades");
if (add.checked == true||edit.checked==true||view.checked==true) {
full.checked=true;
}
else{
full.checked=false;
}
}
</script>
<?php
}
?>
                                                </div> 
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
                                                </div>
                                                </div>
                                                </div>
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="paymadecolumn">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#paymadecolumns"
                                                    aria-expanded="true" aria-controls="paymadecolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable in all <?=strtolower($infomainaccesspaymade['modulename'])?></a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="paymadecolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="paymadecolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Payments Made' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Payments Made' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>paymadecol" id="<?= $coltypemod; ?>paymadecol" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>paymadecol" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace(" or ", " / ",(str_replace("Vendors", $infomainaccessvendor['modulename'],(str_replace("Payments Made", $infomainaccesspaymade['modulename'],$newmoduleskey))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
<div class="row" style="border-top:2px solid #eee;padding:5px 0;"></div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallpurpaypaydefpage">
<svg id="rightarrowpurpaypayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowpurpaypayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowpurpaypayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowpurpaypayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchpurpaypayaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#purpaypaydefaultpage').outerWidth()
            var scrollWidth = $('#purpaypaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purpaypaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurpaypayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurpaypayaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowpurpaypayaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowpurpaypayaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowpurpaypayaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowpurpaypayaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowpurpaypayaccdefpage() {
            document.getElementById('purpaypaydefaultpage').scrollLeft += -90;
            var width = $('#purpaypaydefaultpage').outerWidth()
            var scrollWidth = $('#purpaypaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purpaypaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurpaypayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurpaypayaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowpurpaypayaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowpurpaypayaccdefpage() {
            document.getElementById('purpaypaydefaultpage').scrollLeft += 90;
            var width = $('#purpaypaydefaultpage').outerWidth()
            var scrollWidth = $('#purpaypaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purpaypaydefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowpurpaypayaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowpurpaypayaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #purpaypaydefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#purpaypaydefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#purpaypaydefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#purpaypaydefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#purpaypaydefaultpage::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallpurpaypaydefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpurpaypaydefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchpurpaypayaccdefpage()" class="accordion-header scrollbar-2" id="purpaypaydefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purpaypaydefaultspages"
                                                    aria-expanded="true" aria-controls="purpaypaydefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="purpaypaydefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="purpaypaydefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row" style="padding-top: 5px;padding-bottom: 0px;margin-bottom: 0px;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purpaypageload" id="purpaypagenum" value="pagenum" <?= ($access['purpaypageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaypagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purpaypageload" id="purpaypageauto" value="pageauto" <?= ($access['purpaypageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaypageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<div style="visibility: visible;" id="arrowsallpurpaymadeprintseven">
<svg id="rightarrowpurpaymadeprintseven" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowpurpaymadeprintseven()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowpurpaymadeprintseven" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowpurpaymadeprintseven()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchpurpaymadeprintseven() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#purpaymadeprintprint').outerWidth()
            var scrollWidth = $('#purpaymadeprintprint')[0].scrollWidth; 
            var scrollLeft = $('#purpaymadeprintprint').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurpaymadeprintseven').style.visibility = 'hidden';
            document.getElementById('rightarrowpurpaymadeprintseven').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowpurpaymadeprintseven').style.visibility = 'hidden';
            document.getElementById('leftarrowpurpaymadeprintseven').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowpurpaymadeprintseven').style.visibility = 'visible';
            document.getElementById('rightarrowpurpaymadeprintseven').style.visibility = 'visible';
          }
            }
          }
          function leftarrowpurpaymadeprintseven() {
            document.getElementById('purpaymadeprintprint').scrollLeft += -90;
            var width = $('#purpaymadeprintprint').outerWidth()
            var scrollWidth = $('#purpaymadeprintprint')[0].scrollWidth; 
            var scrollLeft = $('#purpaymadeprintprint').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurpaymadeprintseven').style.visibility = 'hidden';
            document.getElementById('rightarrowpurpaymadeprintseven').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowpurpaymadeprintseven').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowpurpaymadeprintseven() {
            document.getElementById('purpaymadeprintprint').scrollLeft += 90;
            var width = $('#purpaymadeprintprint').outerWidth()
            var scrollWidth = $('#purpaymadeprintprint')[0].scrollWidth; 
            var scrollLeft = $('#purpaymadeprintprint').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowpurpaymadeprintseven').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowpurpaymadeprintseven').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #purpaymadeprintprint::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#purpaymadeprintprint::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#purpaymadeprintprint::-webkit-scrollbar-track {
  background-color: green;
}

#purpaymadeprintprint::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#purpaymadeprintprint::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallpurpaymadeprintseven{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsallpurpaymadeprintseven{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchpurpaymadeprintseven()" class="accordion-header scrollbar-2" id="purpaymadeprintprint" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#purpaymadeprintprints" aria-expanded="true" aria-controls="purpaymadeprintprints">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the things would you like to display in print</a>
</div>
</button>
</h5>
<div id="purpaymadeprintprints" class="accordion-collapse collapse show" aria-labelledby="purpaymadeprintprint">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:0px solid #eee;color: royalblue !important;">
<div class="col-lg-12 mt-1 mb-0"><?=$row['franchiseandroles']?></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadebranchphone" id="purpaymadebranchphone" <?= $access['purpaymadebranchphone']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadebranchphone">Phone</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadebranchemail" id="purpaymadebranchemail" <?= $access['purpaymadebranchemail']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadebranchemail">E-mail</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadebranchgstin" id="purpaymadebranchgstin" <?= $access['purpaymadebranchgstin']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadebranchgstin">GSTIN</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadeprintdlno20" id="purpaymadeprintdlno20" <?= $access['purpaymadeprintdlno20']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadeprintdlno20">DL No 20</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadeprintdlno21" id="purpaymadeprintdlno21" <?= $access['purpaymadeprintdlno21']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadeprintdlno21">DL No 21</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadebank" id="purpaymadebank" <?= $access['purpaymadebank']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadebank">Bank</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadename" id="purpaymadename" <?= $access['purpaymadename']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadename">Name</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadeaccnumber" id="purpaymadeaccnumber" <?= $access['purpaymadeaccnumber']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadeaccnumber">Account Number</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadeifsccode" id="purpaymadeifsccode" <?= $access['purpaymadeifsccode']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadeifsccode">IFSC Code</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadebranchandcity" id="purpaymadebranchandcity" <?= $access['purpaymadebranchandcity']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadebranchandcity">Branch & City</label>
</div>
</div><div class="col-lg-10"></div>
</div>
</div>
</div>
</div>
</div>
                                                
                                                            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
<div class="tab-pane fade show mt-4 p-3 <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']!='1')&&($infomainaccesspaymade['moduleaccess']!='1')&&($infomainaccesspurchasereturn['moduleaccess']=='1'))?'active':'')?>" id="nav-purreturn" role="tabpanel" aria-labelledby="nav-purreturn-tab" <?=(($infomainaccesspurchasereturn['moduleaccess']=='1')?'':'style="display:none"')?>>

<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<div style="margin-top: -9px !important;">
<div style="visibility: visible;" id="arrowsallpurchasereturn">
<svg id="rightarrowpurchasereturnacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowpurchasereturnacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowpurchasereturnacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowpurchasereturnacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
          <script type="text/javascript">
             function checkscrolltouchpurchasereturnacc() {
                // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
                // console.log($('#nav-tab').scrollLeft());
                // console.log($('#nav-tab').width());
                var width = $('#purchasereturnfieldside').outerWidth()
                var scrollWidth = $('#purchasereturnfieldside')[0].scrollWidth; 
                var scrollLeft = $('#purchasereturnfieldside').scrollLeft();
                if (scrollLeft===0){
                document.getElementById('leftarrowpurchasereturnacc').style.visibility = 'hidden';
                document.getElementById('rightarrowpurchasereturnacc').style.visibility = 'visible';
                }
                else if (scrollLeft!=0){
                  if (scrollWidth - width === scrollLeft) {
                document.getElementById('rightarrowpurchasereturnacc').style.visibility = 'hidden';
                document.getElementById('leftarrowpurchasereturnacc').style.visibility = 'visible'; 
                  }
                  else{
                document.getElementById('leftarrowpurchasereturnacc').style.visibility = 'visible';
                document.getElementById('rightarrowpurchasereturnacc').style.visibility = 'visible';
             }
                }
             }
             function leftarrowpurchasereturnacc() {
                document.getElementById('purchasereturnfieldside').scrollLeft += -90;
                var width = $('#purchasereturnfieldside').outerWidth()
                var scrollWidth = $('#purchasereturnfieldside')[0].scrollWidth; 
                var scrollLeft = $('#purchasereturnfieldside').scrollLeft();
                if (scrollLeft===0){
                document.getElementById('leftarrowpurchasereturnacc').style.visibility = 'hidden';
                document.getElementById('rightarrowpurchasereturnacc').style.visibility = 'visible';
                }
                else{
                document.getElementById('rightarrowpurchasereturnacc').style.visibility = 'visible';
                }
             }
          </script>
          <script type="text/javascript">
             function rightarrowpurchasereturnacc() {
                document.getElementById('purchasereturnfieldside').scrollLeft += 90;
                var width = $('#purchasereturnfieldside').outerWidth()
                var scrollWidth = $('#purchasereturnfieldside')[0].scrollWidth; 
                var scrollLeft = $('#purchasereturnfieldside').scrollLeft();
                // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
                if (scrollWidth - width === scrollLeft){
                document.getElementById('rightarrowpurchasereturnacc').style.visibility = 'hidden';
                }
                document.getElementById('leftarrowpurchasereturnacc').style.visibility = 'visible';
             }
          </script>
          <style type="text/css">
          #purchasereturnfieldside::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#purchasereturnfieldside::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#purchasereturnfieldside::-webkit-scrollbar-track {
  background-color: green;
}

#purchasereturnfieldside::-webkit-scrollbar-button:horizontal:increment {
     background-color: #ffffff !important;
  height: 12px;
     width: 12px;
}

#purchasereturnfieldside::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallpurchasereturn{
     visibility: visible !important;
     display: block !important;
     margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpurchasereturn{
     visibility: hidden !important;
     display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
        </style>
                                                          <h5 ontouchmove="checkscrolltouchpurchasereturnacc()" class="accordion-header scrollbar-2" id="purchasereturnfieldside" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                                <button class="accordion-button" type="button"
                                                                     data-bs-toggle="collapse" data-bs-target="#purchasereturnfieldsides"
                                                                     aria-expanded="true" aria-controls="purchasereturnfieldsides">
                                                                     <div class="customcont-header ml-0 mb-1 mt-3">
                                                                          <a class="customcont-heading" style="font-size: 18px;"> Select would like to display in sidebar</a>
                                                                     </div>
                                                                </button>
                                                          </h5>
                                                        </div>
                                                          <div id="purchasereturnfieldsides" class="accordion-collapse collapse show"
                                                                aria-labelledby="purchasereturnfieldside">
                                                                <div class="accordion-body text-sm">
                                                                    <div class="row" style="'border-top:1.5px solid #eee;border-bottom:1px solid #eee;padding:5px 0;">
                                                                        <div class="col-lg-6">
                                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" name="purchasereturnsidebar" id="purchasereturnsidebar" <?= ($access['purchasereturnsidebar']==1)?'checked':'' ?>>
                                                                        <label class="custom-control-label custom-label" for="purchasereturnsidebar" style="font-size: 14.6px;color:royalblue !important;"> <?= $infomainaccesspurchasereturn['modulename'] ?></label>
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-lg-6"></div>       
                                                                        </div>
                                                                </div>
                                                             </div>
                                                          </div>
                                                        </div>
  <div class="accordion" id="accordionRental" style="display: none;">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purreturnfield">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreturnfields"
                                                    aria-expanded="true" aria-controls="purreturnfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="purreturnfields" class="accordion-collapse collapse show"
                                                aria-labelledby="purreturnfield">
                                                <div class="accordion-body text-sm">
                                                    <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Returns' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Returns' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Purchase Return Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Purchase Return Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='PurchaseReturnInformation')) {
                  $fullaccessans = 'purchasereturn';
                }
                else if (($coltypemod=='VendorInformation')) {
                  $fullaccessans = 'purchasereturnvendor';
                }
                else if (($coltypemod=='ItemInformation')) {
                  $fullaccessans = 'purchasereturnitem';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereturn()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'purchasereturns purchasereturnssubhead':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purchasereturnvendors purchasereturnvendorssubhead':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purchasereturnitems purchasereturnitemssubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereturn"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereturn" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Purchase Return Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> <?= str_replace(" or ", " / ",(str_replace("opparen", '(',(str_replace("closparen", ')',(str_replace("Bill", $infomainaccesspurchasereturn['modulename'],(str_replace("Category",$access['txtnamecategory'],(str_replace("Batch","Batch & Expiry",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))))))))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchasereturn()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereturn()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Return Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'purchasereturns':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purchasereturnvendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purchasereturnitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'purchasereturnsadd aevforpurchasereturns':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purchasereturnvendorsadd aevforpurchasereturnvendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purchasereturnitemsadd aevforpurchasereturnitems':'' ?>" name="<?= $coltypemod; ?>addpurchasereturns" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereturn" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Vendor Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereturn" style="color:<?= (($newmoduleskey=='Purchase Return Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchasereturn()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereturn()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Return Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'purchasereturns':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purchasereturnvendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purchasereturnitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'purchasereturnsedit aevforpurchasereturns':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purchasereturnvendorsedit aevforpurchasereturnvendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purchasereturnitemsedit aevforpurchasereturnitems':'' ?>" name="<?= $coltypemod; ?>editpurchasereturns" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereturn" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereturn" style="color:<?= (($newmoduleskey=='Purchase Return Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchasereturn()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereturn()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Purchase Return Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'purchasereturns':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purchasereturnvendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purchasereturnitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'purchasereturnsview aevforpurchasereturns':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'purchasereturnvendorsview aevforpurchasereturnvendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'purchasereturnitemsview aevforpurchasereturnitems':'' ?>" name="<?= $coltypemod; ?>viewpurchasereturns" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereturn" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereturn" style="color:<?= (($newmoduleskey=='Purchase Return Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              function PurchaseReturnInformationpurchasereturnpurchasereturn() {
                let purpurchasereturns = document.getElementsByClassName("purchasereturns");
                purchasereturnlen = purpurchasereturns.length;
                if ($("#PurchaseReturnInformationpurchasereturnpurchasereturn").prop("checked")) {
                for (i=0;i<purchasereturnlen;i++) {
                purpurchasereturns[i].checked=true;
                purpurchasereturns[i].disabled=false;
                }
                }
                else{
                for (i=0;i<purchasereturnlen;i++) {
                purpurchasereturns[i].checked=false;
                purpurchasereturns[i].disabled=true;
                }
                }
              }
              function VendorInformationpurchasereturnvendorpurchasereturn() {
                let purchasereturnvendors = document.getElementsByClassName("purchasereturnvendors");
                vendorslen = purchasereturnvendors.length;
                if ($("#VendorInformationpurchasereturnvendorpurchasereturn").prop("checked")) {
                for (i=0;i<vendorslen;i++) {
                purchasereturnvendors[i].checked=true;
                purchasereturnvendors[i].disabled=false;
                }
                }
                else{
                for (i=0;i<vendorslen;i++) {
                purchasereturnvendors[i].checked=false;
                purchasereturnvendors[i].disabled=true;
                }
                }
              }
              function ItemInformationpurchasereturnitempurchasereturn() {
                let purchasereturnitems = document.getElementsByClassName("purchasereturnitems");
                vendorslen = purchasereturnitems.length;
                if ($("#ItemInformationpurchasereturnitempurchasereturn").prop("checked")) {
                for (i=0;i<vendorslen;i++) {
                purchasereturnitems[i].checked=true;
                purchasereturnitems[i].disabled=false;
                }
                }
                else{
                for (i=0;i<vendorslen;i++) {
                purchasereturnitems[i].checked=false;
                purchasereturnitems[i].disabled=true;
                }
                }
              }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>purchasereturn() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereturn");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereturn");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereturn");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereturn");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
let purchasereturnssubhead = document.getElementsByClassName("purchasereturnssubhead");
let purchasereturnssubheadchnumof = purchasereturnssubhead.length;
for (i=0;i<purchasereturnssubhead.length;i++) {
if (purchasereturnssubhead[i].checked) {
purchasereturnssubheadchnumof+=1;
}
else{
purchasereturnssubheadchnumof-=1;
}
}
if (purchasereturnssubheadchnumof==0) {
document.getElementById("PurchaseReturnInformationpurchasereturnpurchasereturn").checked=false;
document.getElementById("PurchaseReturnInformationaddpurchasereturnpurchasereturn").checked=false;
document.getElementById("PurchaseReturnInformationeditpurchasereturnpurchasereturn").checked=false;
document.getElementById("PurchaseReturnInformationviewpurchasereturnpurchasereturn").checked=false;
}
else{
document.getElementById("PurchaseReturnInformationpurchasereturnpurchasereturn").checked=true;
document.getElementById("PurchaseReturnInformationaddpurchasereturnpurchasereturn").checked=true;
document.getElementById("PurchaseReturnInformationeditpurchasereturnpurchasereturn").checked=true;
document.getElementById("PurchaseReturnInformationviewpurchasereturnpurchasereturn").checked=true;
}
let purchasereturnvendorssubhead = document.getElementsByClassName("purchasereturnvendorssubhead");
let purchasereturnvendorssubheadchnumof = purchasereturnvendorssubhead.length;
for (i=0;i<purchasereturnvendorssubhead.length;i++) {
if (purchasereturnvendorssubhead[i].checked) {
purchasereturnvendorssubheadchnumof+=1;
}
else{
purchasereturnvendorssubheadchnumof-=1;
}
}
if (purchasereturnvendorssubheadchnumof==0) {
document.getElementById("VendorInformationpurchasereturnvendorpurchasereturn").checked=false;
document.getElementById("VendorInformationaddpurchasereturnvendorpurchasereturn").checked=false;
document.getElementById("VendorInformationeditpurchasereturnvendorpurchasereturn").checked=false;
document.getElementById("VendorInformationviewpurchasereturnvendorpurchasereturn").checked=false;
}
else{
document.getElementById("VendorInformationpurchasereturnvendorpurchasereturn").checked=true;
document.getElementById("VendorInformationaddpurchasereturnvendorpurchasereturn").checked=true;
document.getElementById("VendorInformationeditpurchasereturnvendorpurchasereturn").checked=true;
document.getElementById("VendorInformationviewpurchasereturnvendorpurchasereturn").checked=true;
}
let purchasereturnitemssubhead = document.getElementsByClassName("purchasereturnitemssubhead");
let purchasereturnitemssubheadchnumof = purchasereturnitemssubhead.length;
for (i=0;i<purchasereturnitemssubhead.length;i++) {
if (purchasereturnitemssubhead[i].checked) {
purchasereturnitemssubheadchnumof+=1;
}
else{
purchasereturnitemssubheadchnumof-=1;
}
}
if (purchasereturnitemssubheadchnumof==0) {
document.getElementById("ItemInformationpurchasereturnitempurchasereturn").checked=false;
document.getElementById("ItemInformationaddpurchasereturnitempurchasereturn").checked=false;
document.getElementById("ItemInformationeditpurchasereturnitempurchasereturn").checked=false;
document.getElementById("ItemInformationviewpurchasereturnitempurchasereturn").checked=false;
}
else{
document.getElementById("ItemInformationpurchasereturnitempurchasereturn").checked=true;
document.getElementById("ItemInformationaddpurchasereturnitempurchasereturn").checked=true;
document.getElementById("ItemInformationeditpurchasereturnitempurchasereturn").checked=true;
document.getElementById("ItemInformationviewpurchasereturnitempurchasereturn").checked=true;
}
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>purchasereturn() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>purchasereturn");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>purchasereturn");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>purchasereturn");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>purchasereturn");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                if (($coltypemod=='Reference'||$coltypemod=='SalePerson'||$coltypemod=='PreparedBy'||$coltypemod=='CheckedBy')) {
                ?>
                let aevforpurchasereturnsch = document.getElementsByClassName("aevforpurchasereturns");
                let aevchnumofpurchasereturn = aevforpurchasereturnsch.length;
                for (i=0;i<aevforpurchasereturnsch.length;i++) {
                if (aevforpurchasereturnsch[i].checked) {
                    aevchnumofpurchasereturn+=1;
                }
                else{
                    aevchnumofpurchasereturn-=1;
                }
                }
                    if (aevchnumofpurchasereturn==0) {
                    document.getElementById("PurchaseReturnInformationpurchasereturnpurchasereturn").checked=false;
                    }
                    else{
                    document.getElementById("PurchaseReturnInformationpurchasereturnpurchasereturn").checked=true;
                }
                let aevforpurchasereturnsadd = document.getElementsByClassName("purchasereturnsadd");
                let purchasereturnsadd = aevforpurchasereturnsadd.length;
                for (i=0;i<aevforpurchasereturnsadd.length;i++) {
                if (aevforpurchasereturnsadd[i].checked) {
                    purchasereturnsadd+=1;
                }
                else{
                    purchasereturnsadd-=1;
                }
                }
                if (purchasereturnsadd==0) {
                document.getElementById("PurchaseReturnInformationaddpurchasereturnpurchasereturn").checked=false;
                }
                else{
                document.getElementById("PurchaseReturnInformationaddpurchasereturnpurchasereturn").checked=true;
                }
                let aevforpurchasereturnsedit = document.getElementsByClassName("purchasereturnsedit");
                let purchasereturnsedit = aevforpurchasereturnsedit.length;
                for (i=0;i<aevforpurchasereturnsedit.length;i++) {
                if (aevforpurchasereturnsedit[i].checked) {
                    purchasereturnsedit+=1;
                }
                else{
                    purchasereturnsedit-=1;
                }
                }
                if (purchasereturnsedit==0) {
                document.getElementById("PurchaseReturnInformationeditpurchasereturnpurchasereturn").checked=false;
                }
                else{
                document.getElementById("PurchaseReturnInformationeditpurchasereturnpurchasereturn").checked=true;
                }
                let aevforpurchasereturnsview = document.getElementsByClassName("purchasereturnsview");
                let purchasereturnsview = aevforpurchasereturnsview.length;
                for (i=0;i<aevforpurchasereturnsview.length;i++) {
                if (aevforpurchasereturnsview[i].checked) {
                    purchasereturnsview+=1;
                }
                else{
                    purchasereturnsview-=1;
                }
                }
                if (purchasereturnsview==0) {
                document.getElementById("PurchaseReturnInformationviewpurchasereturnpurchasereturn").checked=false;
                }
                else{
                document.getElementById("PurchaseReturnInformationviewpurchasereturnpurchasereturn").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='BillingName'||$coltypemod=='BillingAddress'||$coltypemod=='WorkPhone'||$coltypemod=='GSTIN'||$coltypemod=='ShippingName'||$coltypemod=='ShippingAddress'||$coltypemod=='MobilePhone'||$coltypemod=='PlaceofSupply')) {
                ?>
                let aevforpurchasereturnvendorsch = document.getElementsByClassName("aevforpurchasereturnvendors");
                let aevchnumofpurchasereturn = aevforpurchasereturnvendorsch.length;
                for (i=0;i<aevforpurchasereturnvendorsch.length;i++) {
                if (aevforpurchasereturnvendorsch[i].checked) {
                    aevchnumofpurchasereturn+=1;
                }
                else{
                    aevchnumofpurchasereturn-=1;
                }
                }
                    if (aevchnumofpurchasereturn==0) {
                    document.getElementById("VendorInformationpurchasereturnvendorpurchasereturn").checked=false;
                    }
                    else{
                    document.getElementById("VendorInformationpurchasereturnvendorpurchasereturn").checked=true;
                }
                let aevforpurchasereturnvendorsadd = document.getElementsByClassName("purchasereturnvendorsadd");
                let purchasereturnvendorsadd = aevforpurchasereturnvendorsadd.length;
                for (i=0;i<aevforpurchasereturnvendorsadd.length;i++) {
                if (aevforpurchasereturnvendorsadd[i].checked) {
                    purchasereturnvendorsadd+=1;
                }
                else{
                    purchasereturnvendorsadd-=1;
                }
                }
                if (purchasereturnvendorsadd==0) {
                document.getElementById("VendorInformationaddpurchasereturnvendorpurchasereturn").checked=false;
                }
                else{
                document.getElementById("VendorInformationaddpurchasereturnvendorpurchasereturn").checked=true;
                }
                let aevforpurchasereturnvendorsedit = document.getElementsByClassName("purchasereturnvendorsedit");
                let purchasereturnvendorsedit = aevforpurchasereturnvendorsedit.length;
                for (i=0;i<aevforpurchasereturnvendorsedit.length;i++) {
                if (aevforpurchasereturnvendorsedit[i].checked) {
                    purchasereturnvendorsedit+=1;
                }
                else{
                    purchasereturnvendorsedit-=1;
                }
                }
                if (purchasereturnvendorsedit==0) {
                document.getElementById("VendorInformationeditpurchasereturnvendorpurchasereturn").checked=false;
                }
                else{
                document.getElementById("VendorInformationeditpurchasereturnvendorpurchasereturn").checked=true;
                }
                let aevforpurchasereturnvendorsview = document.getElementsByClassName("purchasereturnvendorsview");
                let purchasereturnvendorsview = aevforpurchasereturnvendorsview.length;
                for (i=0;i<aevforpurchasereturnvendorsview.length;i++) {
                if (aevforpurchasereturnvendorsview[i].checked) {
                    purchasereturnvendorsview+=1;
                }
                else{
                    purchasereturnvendorsview-=1;
                }
                }
                if (purchasereturnvendorsview==0) {
                document.getElementById("VendorInformationviewpurchasereturnvendorpurchasereturn").checked=false;
                }
                else{
                document.getElementById("VendorInformationviewpurchasereturnvendorpurchasereturn").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='ProductCategory'||$coltypemod=='ProductMrp'||$coltypemod=='ProductDescription'||$coltypemod=='Batch'||$coltypemod=='TaxableValue'||$coltypemod=='TaxValue'||$coltypemod=='TaxTable'||$coltypemod=='Attach'||$coltypemod=='Description'||$coltypemod=='Notes'||$coltypemod=='TermsandConditions')) {
                ?>
                let aevforpurchasereturnitemsch = document.getElementsByClassName("aevforpurchasereturnitems");
                let aevchnumofpurchasereturn = aevforpurchasereturnitemsch.length;
                for (i=0;i<aevforpurchasereturnitemsch.length;i++) {
                if (aevforpurchasereturnitemsch[i].checked) {
                    aevchnumofpurchasereturn+=1;
                }
                else{
                    aevchnumofpurchasereturn-=1;
                }
                }
                    if (aevchnumofpurchasereturn==0) {
                    document.getElementById("ItemInformationpurchasereturnitempurchasereturn").checked=false;
                    }
                    else{
                    document.getElementById("ItemInformationpurchasereturnitempurchasereturn").checked=true;
                }
                let aevforpurchasereturnitemsadd = document.getElementsByClassName("purchasereturnitemsadd");
                let purchasereturnitemsadd = aevforpurchasereturnitemsadd.length;
                for (i=0;i<aevforpurchasereturnitemsadd.length;i++) {
                if (aevforpurchasereturnitemsadd[i].checked) {
                    purchasereturnitemsadd+=1;
                }
                else{
                    purchasereturnitemsadd-=1;
                }
                }
                if (purchasereturnitemsadd==0) {
                document.getElementById("ItemInformationaddpurchasereturnitempurchasereturn").checked=false;
                }
                else{
                document.getElementById("ItemInformationaddpurchasereturnitempurchasereturn").checked=true;
                }
                let aevforpurchasereturnitemsedit = document.getElementsByClassName("purchasereturnitemsedit");
                let purchasereturnitemsedit = aevforpurchasereturnitemsedit.length;
                for (i=0;i<aevforpurchasereturnitemsedit.length;i++) {
                if (aevforpurchasereturnitemsedit[i].checked) {
                    purchasereturnitemsedit+=1;
                }
                else{
                    purchasereturnitemsedit-=1;
                }
                }
                if (purchasereturnitemsedit==0) {
                document.getElementById("ItemInformationeditpurchasereturnitempurchasereturn").checked=false;
                }
                else{
                document.getElementById("ItemInformationeditpurchasereturnitempurchasereturn").checked=true;
                }
                let aevforpurchasereturnitemsview = document.getElementsByClassName("purchasereturnitemsview");
                let purchasereturnitemsview = aevforpurchasereturnitemsview.length;
                for (i=0;i<aevforpurchasereturnitemsview.length;i++) {
                if (aevforpurchasereturnitemsview[i].checked) {
                    purchasereturnitemsview+=1;
                }
                else{
                    purchasereturnitemsview-=1;
                }
                }
                if (purchasereturnitemsview==0) {
                document.getElementById("ItemInformationviewpurchasereturnitempurchasereturn").checked=false;
                }
                else{
                document.getElementById("ItemInformationviewpurchasereturnitempurchasereturn").checked=true;
                }
                <?php
                }
                ?>
              }
function PurchaseReturnInformationaddpurchasereturnpurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnsadd");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturns = document.getElementsByClassName("aevforpurchasereturns");
let purchasereturnssubhead = document.getElementsByClassName("purchasereturnssubhead");
let chnumofpurchasereturn = aevforpurchasereturns.length;
if ($("#PurchaseReturnInformationaddpurchasereturnpurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturns.length;i++) {
if (aevforpurchasereturns[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnssubhead[i].checked=false;
}
else{
purchasereturnssubhead[i].checked=true;
}
}
}
function PurchaseReturnInformationeditpurchasereturnpurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnsedit");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturns = document.getElementsByClassName("aevforpurchasereturns");
let purchasereturnssubhead = document.getElementsByClassName("purchasereturnssubhead");
let chnumofpurchasereturn = aevforpurchasereturns.length;
if ($("#PurchaseReturnInformationeditpurchasereturnpurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturns.length;i++) {
if (aevforpurchasereturns[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnssubhead[i].checked=false;
}
else{
purchasereturnssubhead[i].checked=true;
}
}
}
function PurchaseReturnInformationviewpurchasereturnpurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnsview");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturns = document.getElementsByClassName("aevforpurchasereturns");
let purchasereturnssubhead = document.getElementsByClassName("purchasereturnssubhead");
let chnumofpurchasereturn = aevforpurchasereturns.length;
if ($("#PurchaseReturnInformationviewpurchasereturnpurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturns.length;i++) {
if (aevforpurchasereturns[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnssubhead[i].checked=false;
}
else{
purchasereturnssubhead[i].checked=true;
}
}
}
function VendorInformationaddpurchasereturnvendorpurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnvendorsadd");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturnvendors = document.getElementsByClassName("aevforpurchasereturnvendors");
let purchasereturnvendorssubhead = document.getElementsByClassName("purchasereturnvendorssubhead");
let chnumofpurchasereturn = aevforpurchasereturnvendors.length;
if ($("#VendorInformationaddpurchasereturnvendorpurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturnvendors.length;i++) {
if (aevforpurchasereturnvendors[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnvendorssubhead[i].checked=false;
}
else{
purchasereturnvendorssubhead[i].checked=true;
}
}
}
function VendorInformationeditpurchasereturnvendorpurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnvendorsedit");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturnvendors = document.getElementsByClassName("aevforpurchasereturnvendors");
let purchasereturnvendorssubhead = document.getElementsByClassName("purchasereturnvendorssubhead");
let chnumofpurchasereturn = aevforpurchasereturnvendors.length;
if ($("#VendorInformationeditpurchasereturnvendorpurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturnvendors.length;i++) {
if (aevforpurchasereturnvendors[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnvendorssubhead[i].checked=false;
}
else{
purchasereturnvendorssubhead[i].checked=true;
}
}
}
function VendorInformationviewpurchasereturnvendorpurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnvendorsview");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturnvendors = document.getElementsByClassName("aevforpurchasereturnvendors");
let purchasereturnvendorssubhead = document.getElementsByClassName("purchasereturnvendorssubhead");
let chnumofpurchasereturn = aevforpurchasereturnvendors.length;
if ($("#VendorInformationviewpurchasereturnvendorpurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturnvendors.length;i++) {
if (aevforpurchasereturnvendors[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnvendorssubhead[i].checked=false;
}
else{
purchasereturnvendorssubhead[i].checked=true;
}
}
}
function ItemInformationaddpurchasereturnitempurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnitemsadd");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturnitems = document.getElementsByClassName("aevforpurchasereturnitems");
let purchasereturnitemssubhead = document.getElementsByClassName("purchasereturnitemssubhead");
let chnumofpurchasereturn = aevforpurchasereturnitems.length;
if ($("#ItemInformationaddpurchasereturnitempurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturnitems.length;i++) {
if (aevforpurchasereturnitems[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnitemssubhead[i].checked=false;
}
else{
purchasereturnitemssubhead[i].checked=true;
}
}
}
function ItemInformationeditpurchasereturnitempurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnitemsedit");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturnitems = document.getElementsByClassName("aevforpurchasereturnitems");
let purchasereturnitemssubhead = document.getElementsByClassName("purchasereturnitemssubhead");
let chnumofpurchasereturn = aevforpurchasereturnitems.length;
if ($("#ItemInformationeditpurchasereturnitempurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturnitems.length;i++) {
if (aevforpurchasereturnitems[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnitemssubhead[i].checked=false;
}
else{
purchasereturnitemssubhead[i].checked=true;
}
}
}
function ItemInformationviewpurchasereturnitempurchasereturn() {
let purchasereturn = document.getElementsByClassName("purchasereturnitemsview");
purchasereturnlen = purchasereturn.length;
let aevforpurchasereturnitems = document.getElementsByClassName("aevforpurchasereturnitems");
let purchasereturnitemssubhead = document.getElementsByClassName("purchasereturnitemssubhead");
let chnumofpurchasereturn = aevforpurchasereturnitems.length;
if ($("#ItemInformationviewpurchasereturnitempurchasereturn").prop("checked")) {
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=true;
}
}
else{
for (i=0;i<purchasereturnlen;i++) {
purchasereturn[i].checked=false;
}
}
for (i=0;i<aevforpurchasereturnitems.length;i++) {
if (aevforpurchasereturnitems[i].checked) {
chnumofpurchasereturn+=1;
}
else{
chnumofpurchasereturn-=1;
}
}
for (i=0;i<purchasereturnlen;i++) {
if (chnumofpurchasereturn==0) {
purchasereturnitemssubhead[i].checked=false;
}
else{
purchasereturnitemssubhead[i].checked=true;
}
}
}
            </script>
<?php
}
?>
<div class="row" style="border-top:1px solid #eee;padding:5px 0;"></div>
                                                </div> 
                                                </div>
                                                </div>
                                                </div>
<div class="accordion" id="accordionRental" style="display: none;">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="purreturnbtwocreqfield">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#purreturnbtwocreqfields"
aria-expanded="true" aria-controls="purreturnbtwocreqfields">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display as required</a>
</div>
</button>
</h5>
</div>
<div id="purreturnbtwocreqfields" class="accordion-collapse collapse show"
aria-labelledby="purreturnbtwocreqfield">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2"> <span class="text-danger">Vendor Name *</span> </div>
<div class="col-lg-10 mt-2 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnbtwocnamerequired" id="purreturnbtwocnamerequiredyes" value="Yes" <?= ($access['purreturnbtwocnamerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnbtwocnamerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="purreturnbtwocnamerequired" id="purreturnbtwocnamerequiredno" value="No" <?= ($access['purreturnbtwocnamerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="purreturnbtwocnamerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:3px solid #eee;">
<div class="col-lg-2 mt-1 mb-2"> <span class="text-danger">Work Phone *</span> </div>
<div class="col-lg-10 mt-1 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnbtwocwphonerequired" id="purreturnbtwocwphonerequiredyes" value="Yes" <?= ($access['purreturnbtwocwphonerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnbtwocwphonerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="purreturnbtwocwphonerequired" id="purreturnbtwocwphonerequiredno" value="No" <?= ($access['purreturnbtwocwphonerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="purreturnbtwocwphonerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
                      <div class="accordion" id="accordionRental" style="display: none;">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purreturndefault">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreturndefaults"
                                                    aria-expanded="true" aria-controls="purreturndefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="purreturndefaults" class="accordion-collapse collapse show"
                                                aria-labelledby="purreturndefault">
                                                <div class="accordion-body text-sm">
                                                  <?php
                                                  $sqlismainaccessdef=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Purchase Returns' order by id  asc");
                                                  $infomainaccessdef=mysqli_fetch_array($sqlismainaccessdef);
                                                  ?>
                                                  <div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
                                                    <div class="col-lg-2 mt-2 mb-2">
                                                      Vendor Information
                                                    </div>
                                                    <div class="col-lg-10 mt-2 mb-2">
                                                      <div class="row">
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purreturnvendorinfodefault" id="purreturnmanualvendorinfo" value="one" onclick="purreturnveninfodefault()" <?= ($infomainaccessdef['purreturnveninfo']=='one')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="purreturnmanualvendorinfo">B2B</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purreturnvendorinfodefault" id="purreturndefaultvendorinfo" value="two" onclick="purreturnveninfodefault()" <?= ($infomainaccessdef['purreturnveninfo']=='two')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="purreturndefaultvendorinfo">B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="purreturnvendorinfodefault" id="purreturnbothvendorinfo" value="both" onclick="purreturnveninfodefault()">
                        <label class="custom-control-label custom-label" for="purreturnbothvendorinfo">B2B & B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3" style="display: none;" id="purreturnveninfodefault">
<select name="purreturnveninfoselect" id="purreturnveninfoselect" class="select4 form-control form-control-sm">
<option value="" <?= ($infomainaccessdef['purreturnveninfo']=='one'||'two')?'selected':'' ?> disabled>Select</option> 
<option value="defone" <?= ($infomainaccessdef['purreturnveninfo']=='defone')?'selected':'' ?>>B2B</option> 
<option value="deftwo" <?= ($infomainaccessdef['purreturnveninfo']=='deftwo')?'selected':'' ?>>B2C</option> 
</select>
</div>
<input type="hidden" id="purreturncheckvalue" value="<?= $infomainaccessdef['purreturnveninfo'] ?>">
<script type="text/javascript">
    $(document).ready(function () {
        var purreturncheckvalue = document.getElementById('purreturncheckvalue');
        if (purreturncheckvalue.value=='one') {
            document.getElementById("purreturnveninfodefault").style.display="none !important";
            $("#purreturnveninfoselect").removeAttr("required");
            document.getElementById("purreturnb2cpos").style.display='none';
        }
        else if (purreturncheckvalue.value=='two') {
            document.getElementById("purreturnveninfodefault").style.display="none !important";
            $("#purreturnveninfoselect").removeAttr("required");
            document.getElementById("purreturnb2cpos").style.display='flex';
        }
        else if (purreturncheckvalue.value!='two'||'one') {
            document.getElementById("purreturnveninfodefault").style.display="block";
            document.getElementById("purreturnbothvendorinfo").checked=true;
            $("#purreturnveninfoselect").attr("required","required");
            document.getElementById("purreturnb2cpos").style.display='flex';
        }
    });
    function purreturnveninfodefault() {
        var one = document.getElementById('purreturnmanualvendorinfo');
        var two = document.getElementById('purreturndefaultvendorinfo');
        var both = document.getElementById('purreturnbothvendorinfo');
        if (one.checked==true) {
            document.getElementById("purreturnveninfodefault").style.display="none";
            var purreturnveninfoselect = document.getElementById("purreturnveninfoselect");
            var purreturnveninfoselectans = purreturnveninfoselect.options[purreturnveninfoselect.selectedIndex].text;
            purreturnveninfoselect.value='';
            $("#purreturnveninfoselect").removeAttr("required");
            document.getElementById("purreturnb2cpos").style.display='none';
        }
        else if (two.checked==true) {
            document.getElementById("purreturnveninfodefault").style.display="none";
            var purreturnveninfoselect = document.getElementById("purreturnveninfoselect");
            var purreturnveninfoselectans = purreturnveninfoselect.options[purreturnveninfoselect.selectedIndex].text;
            purreturnveninfoselect.value='';
            $("#purreturnveninfoselect").removeAttr("required");
            document.getElementById("purreturnb2cpos").style.display='flex';
        }
        else if (both.checked==true) {
            document.getElementById("purreturnveninfodefault").style.display="block";
            var purreturnveninfoselect = document.getElementById("purreturnveninfoselect");
            var purreturnveninfoselectans = purreturnveninfoselect.options[purreturnveninfoselect.selectedIndex].text;
            if (purreturnveninfoselectans=='Select') {$("#purreturnveninfoselect").attr("required","required");}
            document.getElementById("purreturnb2cpos").style.display='flex';
        }
    }
</script>
                  </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2" id="purreturnb2cpos" style="display:none;border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2 pt-1">
GST Registration Type
</div>
<div class="col-lg-4 mt-1 mb-2">
<select class="selectpicker form-control select2 twogst" data-live-search="true" title="Search title or description..." id="purreturntwogst" name="purreturntwogst">

<option data-foo="Business that is registered under GST" value="Registered Business - Regular" <?=($infomainaccessdef['purreturntwogst']=='Registered Business - Regular')?'selected':'';?>>Registered Business - Regular</option>

<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition" <?=($infomainaccessdef['purreturntwogst']=='Registered Business - Composition')?'selected':'';?>>Registered Business - Composition</option>

<option data-foo="Business that has not been registered under GST" value="Unregistered Business" <?=($infomainaccessdef['purreturntwogst']=='Unregistered Business')?'selected':'';?>>Unregistered Business</option>

<option data-foo="A customer who is a regular consumer" value="Consumer" <?=(($infomainaccessdef['purreturntwogst']=='Consumer')||($infomainaccessdef['purreturntwogst']==''))?'selected':'';?>>Consumer</option>

<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas" <?=($infomainaccessdef['purreturntwogst']=='Overseas')?'selected':'';?>>Overseas</option>

<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone" <?=($infomainaccessdef['purreturntwogst']=='Special Economic Zone')?'selected':'';?>>Special Economic Zone</option>

<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export" <?=($infomainaccessdef['purreturntwogst']=='Deemed Export')?'selected':'';?>>Deemed Export</option>

<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor" <?=($infomainaccessdef['purreturntwogst']=='Tax Deductor')?'selected':'';?>>Tax Deductor</option>

<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer" <?=($infomainaccessdef['purreturntwogst']=='SEZ Developer')?'selected':'';?>>SEZ Developer</option>
</select>
</div>
                                                    <div class="col-lg-2 mt-1 mb-2 pt-1">
                                                      Place of Supply
                                                    </div>
                                                    <div class="col-lg-4 mt-1 mb-2">
                                                        <select name="purreturntwopos" id="purreturntwopos" class="select4 form-control form-control-sm">
<option value="Select Place of Supply" <?= ($infomainaccessdef['purreturntwopos']=='Select Place of Supply')?'selected':'' ?>>Select Place of Supply</option>
<option value="JAMMU AND KASHMIR (1)" <?=($infomainaccessdef['purreturntwopos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($infomainaccessdef['purreturntwopos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($infomainaccessdef['purreturntwopos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($infomainaccessdef['purreturntwopos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($infomainaccessdef['purreturntwopos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($infomainaccessdef['purreturntwopos']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($infomainaccessdef['purreturntwopos']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($infomainaccessdef['purreturntwopos']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($infomainaccessdef['purreturntwopos']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($infomainaccessdef['purreturntwopos']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($infomainaccessdef['purreturntwopos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($infomainaccessdef['purreturntwopos']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($infomainaccessdef['purreturntwopos']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($infomainaccessdef['purreturntwopos']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($infomainaccessdef['purreturntwopos']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($infomainaccessdef['purreturntwopos']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($infomainaccessdef['purreturntwopos']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($infomainaccessdef['purreturntwopos']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($infomainaccessdef['purreturntwopos']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($infomainaccessdef['purreturntwopos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($infomainaccessdef['purreturntwopos']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($infomainaccessdef['purreturntwopos']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($infomainaccessdef['purreturntwopos']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($infomainaccessdef['purreturntwopos']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($infomainaccessdef['purreturntwopos']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($infomainaccessdef['purreturntwopos']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($infomainaccessdef['purreturntwopos']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($infomainaccessdef['purreturntwopos']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($infomainaccessdef['purreturntwopos']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($infomainaccessdef['purreturntwopos']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($infomainaccessdef['purreturntwopos']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($infomainaccessdef['purreturntwopos']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($infomainaccessdef['purreturntwopos']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($infomainaccessdef['purreturntwopos']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($infomainaccessdef['purreturntwopos']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($infomainaccessdef['purreturntwopos']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($infomainaccessdef['purreturntwopos']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($infomainaccessdef['purreturntwopos']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($infomainaccessdef['purreturntwopos']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
                                                      </div>
                                                      </div>
<div class="row mb-2" style="border-bottom:2px solid #eee;<?= ($access['batchexpiryval']==1)?'':'display: none;' ?>">
<div class="col-lg-2 mb-2">
Product Batch
</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purchasereturnbatchdef" id="purchasereturnbatchshow" value="show" <?= ($access['purchasereturnbatchdef']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purchasereturnbatchshow">Show All</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purchasereturnbatchdef" id="purchasereturnbatchavail" value="avail" <?= ($access['purchasereturnbatchdef']=='avail')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purchasereturnbatchavail">Available Only(Custom)</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mb-2">
Product Rate
</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purchasereturnratedef" id="purchasereturnrateshow" value="show" <?= ($access['purchasereturnratedef']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purchasereturnrateshow">Show All</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purchasereturnratedef" id="purchasereturnrateavail" value="avail" <?= ($access['purchasereturnratedef']=='avail')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purchasereturnrateavail">Available Only</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:3px solid #eee;">
<div class="col-lg-2 mb-2">Display in Dropdown</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnnewproductdef" id="purreturnnewproductdef" <?= ($access['purreturnnewproductdef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnnewproductdef">New Product</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnnewvendordef" id="purreturnnewvendordef" <?= ($access['purreturnnewvendordef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnnewvendordef">New Vendor</label>
</div>
</div>
</div>
</div>
</div>
                      </div>
                      </div>
                      </div>
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purreturncolumn">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreturncolumns"
                                                    aria-expanded="true" aria-controls="purreturncolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="purreturncolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="purreturncolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Returns' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Purchase Returns' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>purreturncol" id="<?= $coltypemod; ?>purreturncol" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>purreturncol" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace(" or ", " / ",(str_replace("Vendors", $infomainaccessvendor['modulename'],(str_replace("No", "Number",(str_replace("Vendor Refunds", $infomainaccesspurchasereturnpay['modulename'],$newmoduleskey))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
<div class="row" style="border-top:2px solid #eee;padding:5px 0;"></div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallpurreturnpaydefpage">
<svg id="rightarrowpurreturnpayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowpurreturnpayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowpurreturnpayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowpurreturnpayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchpurreturnpayaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#purreturnpaydefaultpage').outerWidth()
            var scrollWidth = $('#purreturnpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreturnpaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurreturnpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurreturnpayaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowpurreturnpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowpurreturnpayaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowpurreturnpayaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowpurreturnpayaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowpurreturnpayaccdefpage() {
            document.getElementById('purreturnpaydefaultpage').scrollLeft += -90;
            var width = $('#purreturnpaydefaultpage').outerWidth()
            var scrollWidth = $('#purreturnpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreturnpaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurreturnpayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurreturnpayaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowpurreturnpayaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowpurreturnpayaccdefpage() {
            document.getElementById('purreturnpaydefaultpage').scrollLeft += 90;
            var width = $('#purreturnpaydefaultpage').outerWidth()
            var scrollWidth = $('#purreturnpaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreturnpaydefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowpurreturnpayaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowpurreturnpayaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #purreturnpaydefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#purreturnpaydefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#purreturnpaydefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#purreturnpaydefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#purreturnpaydefaultpage::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallpurreturnpaydefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpurreturnpaydefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchpurreturnpayaccdefpage()" class="accordion-header scrollbar-2" id="purreturnpaydefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreturnpaydefaultspages"
                                                    aria-expanded="true" aria-controls="purreturnpaydefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="purreturnpaydefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="purreturnpaydefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row pb-3" style="border-bottom:3px solid #eee;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnpageload" id="purreturnpagenum" value="pagenum" <?= ($access['purreturnpageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnpagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnpageload" id="purreturnpageauto" value="pageauto" <?= ($access['purreturnpageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnpageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
</div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental" style="display: none;">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="purreturnprint">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#purreturnprints" aria-expanded="true" aria-controls="purreturnprints">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the things would you like to display in print</a>
</div>
</button>
</h5>
<div id="purreturnprints" class="accordion-collapse collapse show" aria-labelledby="purreturnprint">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">GST Treatment</div>
<div class="col-lg-4 mt-2 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintgsttreatment" id="purreturnprintgsttreatauto" value="auto" <?= $infomainaccessdef['purreturnprintgsttreatment']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintgsttreatauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintgsttreatment" id="purreturnprintgsttreatshow" value="show" <?= ($infomainaccessdef['purreturnprintgsttreatment']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintgsttreatshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintgsttreatment" id="purreturnprintgsttreathide" value="hide" <?= $infomainaccessdef['purreturnprintgsttreatment']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintgsttreathide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">GSTIN</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintgstin" id="purreturnprintgstinauto" value="auto" <?= $infomainaccessdef['purreturnprintgstin']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintgstinauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintgstin" id="purreturnprintgstinshow" value="show" <?= ($infomainaccessdef['purreturnprintgstin']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintgstinshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintgstin" id="purreturnprintgstinhide" value="hide" <?= $infomainaccessdef['purreturnprintgstin']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintgstinhide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2">Place of Supply</div>
<div class="col-lg-4 mt-1 mb-2">
<div class="row">
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintpos" id="purreturnprintposauto" value="auto" <?= $infomainaccessdef['purreturnprintpos']=='auto'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintposauto">Auto</label>
</div>
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintpos" id="purreturnprintposshow" value="show" <?= ($infomainaccessdef['purreturnprintpos']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintposshow">Show</label>
</div>                
</div>
<div class="col-lg-4">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnprintpos" id="purreturnprintposhide" value="hide" <?= $infomainaccessdef['purreturnprintpos']=='hide'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintposhide">Hide</label>
</div>             
</div>
</div>
</div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnbranchphone" id="purreturnbranchphone" <?= $access['purreturnbranchphone']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnbranchphone">Phone</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnbranchemail" id="purreturnbranchemail" <?= $access['purreturnbranchemail']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnbranchemail">E-mail</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnbranchgstin" id="purreturnbranchgstin" <?= $access['purreturnbranchgstin']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnbranchgstin">GSTIN</label>
</div>
</div>
<div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnprintdlno20" id="purreturnprintdlno20" <?= $access['purreturnprintdlno20']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintdlno20">DL No 20</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnprintdlno21" id="purreturnprintdlno21" <?= $access['purreturnprintdlno21']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnprintdlno21">DL No 21</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnbank" id="purreturnbank" <?= $access['purreturnbank']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnbank">Bank</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnname" id="purreturnname" <?= $access['purreturnname']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnname">Name</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnaccnumber" id="purreturnaccnumber" <?= $access['purreturnaccnumber']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnaccnumber">Account Number</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnifsccode" id="purreturnifsccode" <?= $access['purreturnifsccode']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnifsccode">IFSC Code</label>
</div>
</div><div class="col-lg-10"></div>
</div>
<div class="row" style="border-bottom: 0px solid #eee;">
<div class="col-lg-2 mt-2 mb-2">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purreturnbranchandcity" id="purreturnbranchandcity" <?= $access['purreturnbranchandcity']=='1'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnbranchandcity">Branch & City</label>
</div>
</div><div class="col-lg-10"></div>
</div>

</div>
</div>
</div>
</div>
                                                
                                                            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
<div class="tab-pane fade show mt-4 p-3 <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']!='1')&&($infomainaccesspaymade['moduleaccess']!='1')&&($infomainaccesspurchasereturn['moduleaccess']!='1')&&($infomainaccessdebitnotes['moduleaccess']=='1'))?'active':'')?>" id="nav-debitnotes" role="tabpanel" aria-labelledby="nav-debitnotes-tab" <?=(($infomainaccessdebitnotes['moduleaccess']=='1')?'':'style="display:none"')?>>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<div style="margin-top: -9px !important;">
<div style="visibility: visible;" id="arrowsalldebitnoteside">
<svg id="rightarrowdebitnotesideacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowdebitnotesideacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowdebitnotesideacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowdebitnotesideacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
          <script type="text/javascript">
             function checkscrolltouchdebitnotesideacc() {
                // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
                // console.log($('#nav-tab').scrollLeft());
                // console.log($('#nav-tab').width());
                var width = $('#debitnotesidefieldside').outerWidth()
                var scrollWidth = $('#debitnotesidefieldside')[0].scrollWidth; 
                var scrollLeft = $('#debitnotesidefieldside').scrollLeft();
                if (scrollLeft===0){
                document.getElementById('leftarrowdebitnotesideacc').style.visibility = 'hidden';
                document.getElementById('rightarrowdebitnotesideacc').style.visibility = 'visible';
                }
                else if (scrollLeft!=0){
                  if (scrollWidth - width === scrollLeft) {
                document.getElementById('rightarrowdebitnotesideacc').style.visibility = 'hidden';
                document.getElementById('leftarrowdebitnotesideacc').style.visibility = 'visible'; 
                  }
                  else{
                document.getElementById('leftarrowdebitnotesideacc').style.visibility = 'visible';
                document.getElementById('rightarrowdebitnotesideacc').style.visibility = 'visible';
             }
                }
             }
             function leftarrowdebitnotesideacc() {
                document.getElementById('debitnotesidefieldside').scrollLeft += -90;
                var width = $('#debitnotesidefieldside').outerWidth()
                var scrollWidth = $('#debitnotesidefieldside')[0].scrollWidth; 
                var scrollLeft = $('#debitnotesidefieldside').scrollLeft();
                if (scrollLeft===0){
                document.getElementById('leftarrowdebitnotesideacc').style.visibility = 'hidden';
                document.getElementById('rightarrowdebitnotesideacc').style.visibility = 'visible';
                }
                else{
                document.getElementById('rightarrowdebitnotesideacc').style.visibility = 'visible';
                }
             }
          </script>
          <script type="text/javascript">
             function rightarrowdebitnotesideacc() {
                document.getElementById('debitnotesidefieldside').scrollLeft += 90;
                var width = $('#debitnotesidefieldside').outerWidth()
                var scrollWidth = $('#debitnotesidefieldside')[0].scrollWidth; 
                var scrollLeft = $('#debitnotesidefieldside').scrollLeft();
                // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
                if (scrollWidth - width === scrollLeft){
                document.getElementById('rightarrowdebitnotesideacc').style.visibility = 'hidden';
                }
                document.getElementById('leftarrowdebitnotesideacc').style.visibility = 'visible';
             }
          </script>
          <style type="text/css">
          #debitnotesidefieldside::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#debitnotesidefieldside::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#debitnotesidefieldside::-webkit-scrollbar-track {
  background-color: green;
}

#debitnotesidefieldside::-webkit-scrollbar-button:horizontal:increment {
     background-color: #ffffff !important;
  height: 12px;
     width: 12px;
}

#debitnotesidefieldside::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsalldebitnoteside{
     visibility: visible !important;
     display: block !important;
     margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsalldebitnoteside{
     visibility: hidden !important;
     display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
        </style>
                                                          <h5 ontouchmove="checkscrolltouchdebitnotesideacc()" class="accordion-header scrollbar-2" id="debitnotesidefieldside" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                                <button class="accordion-button" type="button"
                                                                     data-bs-toggle="collapse" data-bs-target="#debitnotesidefieldsides"
                                                                     aria-expanded="true" aria-controls="debitnotesidefieldsides">
                                                                     <div class="customcont-header ml-0 mb-1 mt-3">
                                                                          <a class="customcont-heading" style="font-size: 18px;"> Select would like to display in sidebar</a>
                                                                     </div>
                                                                </button>
                                                          </h5>
                                                        </div>
                                                          <div id="debitnotesidefieldsides" class="accordion-collapse collapse show"
                                                                aria-labelledby="debitnotesidefieldside">
                                                                <div class="accordion-body text-sm">
                                                                    <div class="row" style="'border-top:1.5px solid #eee;border-bottom:1px solid #eee;padding:5px 0;">
                                                                        <div class="col-lg-6">
                                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" name="debitnotesidesidebar" id="debitnotesidesidebar" <?= ($access['debitnotesidesidebar']==1)?'checked':'' ?>>
                                                                        <label class="custom-control-label custom-label" for="debitnotesidesidebar" style="font-size: 14.6px;color:royalblue !important;"> <?= $infomainaccessdebitnotes['modulename'] ?> (New / Add)</label>
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-lg-6"></div>       
                                                                        </div>
                                                                </div>
                                                             </div>
                                                          </div>
                                                        </div>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="debitnotefield">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#debitnotefields"
                                                    aria-expanded="true" aria-controls="debitnotefields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="debitnotefields" class="accordion-collapse collapse show"
                                                aria-labelledby="debitnotefield">
                                                <div class="accordion-body text-sm">
                                                    <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Debit Notes' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Debit Notes' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Debit Note Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Debit Note Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='DebitNoteInformation')) {
                  $fullaccessans = 'debitnote';
                }
                else if (($coltypemod=='VendorInformation')) {
                  $fullaccessans = 'debitnotevendor';
                }
                else if (($coltypemod=='ItemInformation')) {
                  $fullaccessans = 'debitnoteitem';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>debitnote()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Reason'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'debitnotes debitnotessubhead':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'debitnotevendors debitnotevendorssubhead':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'debitnoteitems debitnoteitemssubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>debitnote"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>debitnote" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Debit Note Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> <?= str_replace(" or ", " / ",(str_replace("opparen", '(',(str_replace("closparen", ')',(str_replace("Category",$access['txtnamecategory'],(str_replace("Batch","Batch & Expiry",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))))))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>debitnote()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>debitnote()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Debit Note Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Reason'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'debitnotes':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'debitnotevendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'debitnoteitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Reason'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'debitnotesadd aevfordebitnotes':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'debitnotevendorsadd aevfordebitnotevendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'debitnoteitemsadd aevfordebitnoteitems':'' ?>" name="<?= $coltypemod; ?>adddebitnotes" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>debitnote" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Vendor Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>debitnote" style="color:<?= (($newmoduleskey=='Debit Note Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?= (($newmoduleskey=='Billing Name')||($newmoduleskey=='Shipping Name'))?'style="display:none;"':'' ?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>debitnote()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>debitnote()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Debit Note Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Reason'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'debitnotes':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'debitnotevendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'debitnoteitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Reason'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'debitnotesedit aevfordebitnotes':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'debitnotevendorsedit aevfordebitnotevendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'debitnoteitemsedit aevfordebitnoteitems':'' ?>" name="<?= $coltypemod; ?>editdebitnotes" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>debitnote" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>debitnote" style="color:<?= (($newmoduleskey=='Debit Note Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>debitnote()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>debitnote()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Debit Note Information'||$newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Reason'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'debitnotes':'' ?> <?= (($newmoduleskey=='Vendor Information'||$newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'debitnotevendors':'' ?> <?= (($newmoduleskey=='Item Information'||$newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'debitnoteitems':'' ?> <?= (($newmoduleskey=='Reference'||$newmoduleskey=='Sale Person'||$newmoduleskey=='Reason'||$newmoduleskey=='Prepared By'||$newmoduleskey=='Checked By'))?'debitnotesview aevfordebitnotes':'' ?> <?= (($newmoduleskey=='Billing Name'||$newmoduleskey=='Billing Address'||$newmoduleskey=='Work Phone'||$newmoduleskey=='GSTIN'||$newmoduleskey=='Shipping Name'||$newmoduleskey=='Shipping Address'||$newmoduleskey=='Mobile Phone'||$newmoduleskey=='Place of Supply'))?'debitnotevendorsview aevfordebitnotevendors':'' ?> <?= (($newmoduleskey=='Product Category'||$newmoduleskey=='Product Mrp'||$newmoduleskey=='Product Description'||$newmoduleskey=='Batch'||$newmoduleskey=='Taxable Value'||$newmoduleskey=='Tax Value'||$newmoduleskey=='Tax Table'||$newmoduleskey=='Attach'||$newmoduleskey=='Description'||$newmoduleskey=='Notes'||$newmoduleskey=='Terms and Conditions'))?'debitnoteitemsview aevfordebitnoteitems':'' ?>" name="<?= $coltypemod; ?>viewdebitnotes" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>debitnote" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>debitnote" style="color:<?= (($newmoduleskey=='Debit Note Information')||($newmoduleskey=='Vendor Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              function DebitNoteInformationdebitnotedebitnote() {
                let purdebitnotes = document.getElementsByClassName("debitnotes");
                debitnotelen = purdebitnotes.length;
                if ($("#DebitNoteInformationdebitnotedebitnote").prop("checked")) {
                for (i=0;i<debitnotelen;i++) {
                purdebitnotes[i].checked=true;
                purdebitnotes[i].disabled=false;
                }
                }
                else{
                for (i=0;i<debitnotelen;i++) {
                purdebitnotes[i].checked=false;
                purdebitnotes[i].disabled=true;
                }
                }
              }
              function VendorInformationdebitnotevendordebitnote() {
                let debitnotevendors = document.getElementsByClassName("debitnotevendors");
                vendorslen = debitnotevendors.length;
                if ($("#VendorInformationdebitnotevendordebitnote").prop("checked")) {
                for (i=0;i<vendorslen;i++) {
                debitnotevendors[i].checked=true;
                debitnotevendors[i].disabled=false;
                }
                }
                else{
                for (i=0;i<vendorslen;i++) {
                debitnotevendors[i].checked=false;
                debitnotevendors[i].disabled=true;
                }
                }
              }
              function ItemInformationdebitnoteitemdebitnote() {
                let debitnoteitems = document.getElementsByClassName("debitnoteitems");
                vendorslen = debitnoteitems.length;
                if ($("#ItemInformationdebitnoteitemdebitnote").prop("checked")) {
                for (i=0;i<vendorslen;i++) {
                debitnoteitems[i].checked=true;
                debitnoteitems[i].disabled=false;
                }
                }
                else{
                for (i=0;i<vendorslen;i++) {
                debitnoteitems[i].checked=false;
                debitnoteitems[i].disabled=true;
                }
                }
              }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>debitnote() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>debitnote");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>debitnote");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>debitnote");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>debitnote");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
let debitnotessubhead = document.getElementsByClassName("debitnotessubhead");
let debitnotessubheadchnumof = debitnotessubhead.length;
for (i=0;i<debitnotessubhead.length;i++) {
if (debitnotessubhead[i].checked) {
debitnotessubheadchnumof+=1;
}
else{
debitnotessubheadchnumof-=1;
}
}
if (debitnotessubheadchnumof==0) {
document.getElementById("DebitNoteInformationdebitnotedebitnote").checked=false;
document.getElementById("DebitNoteInformationadddebitnotedebitnote").checked=false;
document.getElementById("DebitNoteInformationeditdebitnotedebitnote").checked=false;
document.getElementById("DebitNoteInformationviewdebitnotedebitnote").checked=false;
}
else{
document.getElementById("DebitNoteInformationdebitnotedebitnote").checked=true;
document.getElementById("DebitNoteInformationadddebitnotedebitnote").checked=true;
document.getElementById("DebitNoteInformationeditdebitnotedebitnote").checked=true;
document.getElementById("DebitNoteInformationviewdebitnotedebitnote").checked=true;
}
let debitnotevendorssubhead = document.getElementsByClassName("debitnotevendorssubhead");
let debitnotevendorssubheadchnumof = debitnotevendorssubhead.length;
for (i=0;i<debitnotevendorssubhead.length;i++) {
if (debitnotevendorssubhead[i].checked) {
debitnotevendorssubheadchnumof+=1;
}
else{
debitnotevendorssubheadchnumof-=1;
}
}
if (debitnotevendorssubheadchnumof==0) {
document.getElementById("VendorInformationdebitnotevendordebitnote").checked=false;
document.getElementById("VendorInformationadddebitnotevendordebitnote").checked=false;
document.getElementById("VendorInformationeditdebitnotevendordebitnote").checked=false;
document.getElementById("VendorInformationviewdebitnotevendordebitnote").checked=false;
}
else{
document.getElementById("VendorInformationdebitnotevendordebitnote").checked=true;
document.getElementById("VendorInformationadddebitnotevendordebitnote").checked=true;
document.getElementById("VendorInformationeditdebitnotevendordebitnote").checked=true;
document.getElementById("VendorInformationviewdebitnotevendordebitnote").checked=true;
}
let debitnoteitemssubhead = document.getElementsByClassName("debitnoteitemssubhead");
let debitnoteitemssubheadchnumof = debitnoteitemssubhead.length;
for (i=0;i<debitnoteitemssubhead.length;i++) {
if (debitnoteitemssubhead[i].checked) {
debitnoteitemssubheadchnumof+=1;
}
else{
debitnoteitemssubheadchnumof-=1;
}
}
if (debitnoteitemssubheadchnumof==0) {
document.getElementById("ItemInformationdebitnoteitemdebitnote").checked=false;
document.getElementById("ItemInformationadddebitnoteitemdebitnote").checked=false;
document.getElementById("ItemInformationeditdebitnoteitemdebitnote").checked=false;
document.getElementById("ItemInformationviewdebitnoteitemdebitnote").checked=false;
}
else{
document.getElementById("ItemInformationdebitnoteitemdebitnote").checked=true;
document.getElementById("ItemInformationadddebitnoteitemdebitnote").checked=true;
document.getElementById("ItemInformationeditdebitnoteitemdebitnote").checked=true;
document.getElementById("ItemInformationviewdebitnoteitemdebitnote").checked=true;
}
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>debitnote() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>debitnote");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>debitnote");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>debitnote");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>debitnote");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                if (($coltypemod=='Reference'||$coltypemod=='SalePerson'||$coltypemod=='PreparedBy'||$coltypemod=='CheckedBy')) {
                ?>
                let aevfordebitnotesch = document.getElementsByClassName("aevfordebitnotes");
                let aevchnumofdebitnote = aevfordebitnotesch.length;
                for (i=0;i<aevfordebitnotesch.length;i++) {
                if (aevfordebitnotesch[i].checked) {
                    aevchnumofdebitnote+=1;
                }
                else{
                    aevchnumofdebitnote-=1;
                }
                }
                    if (aevchnumofdebitnote==0) {
                    document.getElementById("DebitNoteInformationdebitnotedebitnote").checked=false;
                    }
                    else{
                    document.getElementById("DebitNoteInformationdebitnotedebitnote").checked=true;
                }
                let aevfordebitnotesadd = document.getElementsByClassName("debitnotesadd");
                let debitnotesadd = aevfordebitnotesadd.length;
                for (i=0;i<aevfordebitnotesadd.length;i++) {
                if (aevfordebitnotesadd[i].checked) {
                    debitnotesadd+=1;
                }
                else{
                    debitnotesadd-=1;
                }
                }
                if (debitnotesadd==0) {
                document.getElementById("DebitNoteInformationadddebitnotedebitnote").checked=false;
                }
                else{
                document.getElementById("DebitNoteInformationadddebitnotedebitnote").checked=true;
                }
                let aevfordebitnotesedit = document.getElementsByClassName("debitnotesedit");
                let debitnotesedit = aevfordebitnotesedit.length;
                for (i=0;i<aevfordebitnotesedit.length;i++) {
                if (aevfordebitnotesedit[i].checked) {
                    debitnotesedit+=1;
                }
                else{
                    debitnotesedit-=1;
                }
                }
                if (debitnotesedit==0) {
                document.getElementById("DebitNoteInformationeditdebitnotedebitnote").checked=false;
                }
                else{
                document.getElementById("DebitNoteInformationeditdebitnotedebitnote").checked=true;
                }
                let aevfordebitnotesview = document.getElementsByClassName("debitnotesview");
                let debitnotesview = aevfordebitnotesview.length;
                for (i=0;i<aevfordebitnotesview.length;i++) {
                if (aevfordebitnotesview[i].checked) {
                    debitnotesview+=1;
                }
                else{
                    debitnotesview-=1;
                }
                }
                if (debitnotesview==0) {
                document.getElementById("DebitNoteInformationviewdebitnotedebitnote").checked=false;
                }
                else{
                document.getElementById("DebitNoteInformationviewdebitnotedebitnote").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='BillingName'||$coltypemod=='BillingAddress'||$coltypemod=='WorkPhone'||$coltypemod=='GSTIN'||$coltypemod=='ShippingName'||$coltypemod=='ShippingAddress'||$coltypemod=='MobilePhone'||$coltypemod=='PlaceofSupply')) {
                ?>
                let aevfordebitnotevendorsch = document.getElementsByClassName("aevfordebitnotevendors");
                let aevchnumofdebitnote = aevfordebitnotevendorsch.length;
                for (i=0;i<aevfordebitnotevendorsch.length;i++) {
                if (aevfordebitnotevendorsch[i].checked) {
                    aevchnumofdebitnote+=1;
                }
                else{
                    aevchnumofdebitnote-=1;
                }
                }
                    if (aevchnumofdebitnote==0) {
                    document.getElementById("VendorInformationdebitnotevendordebitnote").checked=false;
                    }
                    else{
                    document.getElementById("VendorInformationdebitnotevendordebitnote").checked=true;
                }
                let aevfordebitnotevendorsadd = document.getElementsByClassName("debitnotevendorsadd");
                let debitnotevendorsadd = aevfordebitnotevendorsadd.length;
                for (i=0;i<aevfordebitnotevendorsadd.length;i++) {
                if (aevfordebitnotevendorsadd[i].checked) {
                    debitnotevendorsadd+=1;
                }
                else{
                    debitnotevendorsadd-=1;
                }
                }
                if (debitnotevendorsadd==0) {
                document.getElementById("VendorInformationadddebitnotevendordebitnote").checked=false;
                }
                else{
                document.getElementById("VendorInformationadddebitnotevendordebitnote").checked=true;
                }
                let aevfordebitnotevendorsedit = document.getElementsByClassName("debitnotevendorsedit");
                let debitnotevendorsedit = aevfordebitnotevendorsedit.length;
                for (i=0;i<aevfordebitnotevendorsedit.length;i++) {
                if (aevfordebitnotevendorsedit[i].checked) {
                    debitnotevendorsedit+=1;
                }
                else{
                    debitnotevendorsedit-=1;
                }
                }
                if (debitnotevendorsedit==0) {
                document.getElementById("VendorInformationeditdebitnotevendordebitnote").checked=false;
                }
                else{
                document.getElementById("VendorInformationeditdebitnotevendordebitnote").checked=true;
                }
                let aevfordebitnotevendorsview = document.getElementsByClassName("debitnotevendorsview");
                let debitnotevendorsview = aevfordebitnotevendorsview.length;
                for (i=0;i<aevfordebitnotevendorsview.length;i++) {
                if (aevfordebitnotevendorsview[i].checked) {
                    debitnotevendorsview+=1;
                }
                else{
                    debitnotevendorsview-=1;
                }
                }
                if (debitnotevendorsview==0) {
                document.getElementById("VendorInformationviewdebitnotevendordebitnote").checked=false;
                }
                else{
                document.getElementById("VendorInformationviewdebitnotevendordebitnote").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='ProductCategory'||$coltypemod=='ProductMrp'||$coltypemod=='ProductDescription'||$coltypemod=='Batch'||$coltypemod=='TaxableValue'||$coltypemod=='TaxValue'||$coltypemod=='TaxTable'||$coltypemod=='Attach'||$coltypemod=='Description'||$coltypemod=='Notes'||$coltypemod=='TermsandConditions')) {
                ?>
                let aevfordebitnoteitemsch = document.getElementsByClassName("aevfordebitnoteitems");
                let aevchnumofdebitnote = aevfordebitnoteitemsch.length;
                for (i=0;i<aevfordebitnoteitemsch.length;i++) {
                if (aevfordebitnoteitemsch[i].checked) {
                    aevchnumofdebitnote+=1;
                }
                else{
                    aevchnumofdebitnote-=1;
                }
                }
                    if (aevchnumofdebitnote==0) {
                    document.getElementById("ItemInformationdebitnoteitemdebitnote").checked=false;
                    }
                    else{
                    document.getElementById("ItemInformationdebitnoteitemdebitnote").checked=true;
                }
                let aevfordebitnoteitemsadd = document.getElementsByClassName("debitnoteitemsadd");
                let debitnoteitemsadd = aevfordebitnoteitemsadd.length;
                for (i=0;i<aevfordebitnoteitemsadd.length;i++) {
                if (aevfordebitnoteitemsadd[i].checked) {
                    debitnoteitemsadd+=1;
                }
                else{
                    debitnoteitemsadd-=1;
                }
                }
                if (debitnoteitemsadd==0) {
                document.getElementById("ItemInformationadddebitnoteitemdebitnote").checked=false;
                }
                else{
                document.getElementById("ItemInformationadddebitnoteitemdebitnote").checked=true;
                }
                let aevfordebitnoteitemsedit = document.getElementsByClassName("debitnoteitemsedit");
                let debitnoteitemsedit = aevfordebitnoteitemsedit.length;
                for (i=0;i<aevfordebitnoteitemsedit.length;i++) {
                if (aevfordebitnoteitemsedit[i].checked) {
                    debitnoteitemsedit+=1;
                }
                else{
                    debitnoteitemsedit-=1;
                }
                }
                if (debitnoteitemsedit==0) {
                document.getElementById("ItemInformationeditdebitnoteitemdebitnote").checked=false;
                }
                else{
                document.getElementById("ItemInformationeditdebitnoteitemdebitnote").checked=true;
                }
                let aevfordebitnoteitemsview = document.getElementsByClassName("debitnoteitemsview");
                let debitnoteitemsview = aevfordebitnoteitemsview.length;
                for (i=0;i<aevfordebitnoteitemsview.length;i++) {
                if (aevfordebitnoteitemsview[i].checked) {
                    debitnoteitemsview+=1;
                }
                else{
                    debitnoteitemsview-=1;
                }
                }
                if (debitnoteitemsview==0) {
                document.getElementById("ItemInformationviewdebitnoteitemdebitnote").checked=false;
                }
                else{
                document.getElementById("ItemInformationviewdebitnoteitemdebitnote").checked=true;
                }
                <?php
                }
                ?>
              }
function DebitNoteInformationadddebitnotedebitnote() {
let debitnote = document.getElementsByClassName("debitnotesadd");
debitnotelen = debitnote.length;
let aevfordebitnotes = document.getElementsByClassName("aevfordebitnotes");
let debitnotessubhead = document.getElementsByClassName("debitnotessubhead");
let chnumofdebitnote = aevfordebitnotes.length;
if ($("#DebitNoteInformationadddebitnotedebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnotes.length;i++) {
if (aevfordebitnotes[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnotessubhead[i].checked=false;
}
else{
debitnotessubhead[i].checked=true;
}
}
}
function DebitNoteInformationeditdebitnotedebitnote() {
let debitnote = document.getElementsByClassName("debitnotesedit");
debitnotelen = debitnote.length;
let aevfordebitnotes = document.getElementsByClassName("aevfordebitnotes");
let debitnotessubhead = document.getElementsByClassName("debitnotessubhead");
let chnumofdebitnote = aevfordebitnotes.length;
if ($("#DebitNoteInformationeditdebitnotedebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnotes.length;i++) {
if (aevfordebitnotes[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnotessubhead[i].checked=false;
}
else{
debitnotessubhead[i].checked=true;
}
}
}
function DebitNoteInformationviewdebitnotedebitnote() {
let debitnote = document.getElementsByClassName("debitnotesview");
debitnotelen = debitnote.length;
let aevfordebitnotes = document.getElementsByClassName("aevfordebitnotes");
let debitnotessubhead = document.getElementsByClassName("debitnotessubhead");
let chnumofdebitnote = aevfordebitnotes.length;
if ($("#DebitNoteInformationviewdebitnotedebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnotes.length;i++) {
if (aevfordebitnotes[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnotessubhead[i].checked=false;
}
else{
debitnotessubhead[i].checked=true;
}
}
}
function VendorInformationadddebitnotevendordebitnote() {
let debitnote = document.getElementsByClassName("debitnotevendorsadd");
debitnotelen = debitnote.length;
let aevfordebitnotevendors = document.getElementsByClassName("aevfordebitnotevendors");
let debitnotevendorssubhead = document.getElementsByClassName("debitnotevendorssubhead");
let chnumofdebitnote = aevfordebitnotevendors.length;
if ($("#VendorInformationadddebitnotevendordebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnotevendors.length;i++) {
if (aevfordebitnotevendors[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnotevendorssubhead[i].checked=false;
}
else{
debitnotevendorssubhead[i].checked=true;
}
}
}
function VendorInformationeditdebitnotevendordebitnote() {
let debitnote = document.getElementsByClassName("debitnotevendorsedit");
debitnotelen = debitnote.length;
let aevfordebitnotevendors = document.getElementsByClassName("aevfordebitnotevendors");
let debitnotevendorssubhead = document.getElementsByClassName("debitnotevendorssubhead");
let chnumofdebitnote = aevfordebitnotevendors.length;
if ($("#VendorInformationeditdebitnotevendordebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnotevendors.length;i++) {
if (aevfordebitnotevendors[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnotevendorssubhead[i].checked=false;
}
else{
debitnotevendorssubhead[i].checked=true;
}
}
}
function VendorInformationviewdebitnotevendordebitnote() {
let debitnote = document.getElementsByClassName("debitnotevendorsview");
debitnotelen = debitnote.length;
let aevfordebitnotevendors = document.getElementsByClassName("aevfordebitnotevendors");
let debitnotevendorssubhead = document.getElementsByClassName("debitnotevendorssubhead");
let chnumofdebitnote = aevfordebitnotevendors.length;
if ($("#VendorInformationviewdebitnotevendordebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnotevendors.length;i++) {
if (aevfordebitnotevendors[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnotevendorssubhead[i].checked=false;
}
else{
debitnotevendorssubhead[i].checked=true;
}
}
}
function ItemInformationadddebitnoteitemdebitnote() {
let debitnote = document.getElementsByClassName("debitnoteitemsadd");
debitnotelen = debitnote.length;
let aevfordebitnoteitems = document.getElementsByClassName("aevfordebitnoteitems");
let debitnoteitemssubhead = document.getElementsByClassName("debitnoteitemssubhead");
let chnumofdebitnote = aevfordebitnoteitems.length;
if ($("#ItemInformationadddebitnoteitemdebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnoteitems.length;i++) {
if (aevfordebitnoteitems[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnoteitemssubhead[i].checked=false;
}
else{
debitnoteitemssubhead[i].checked=true;
}
}
}
function ItemInformationeditdebitnoteitemdebitnote() {
let debitnote = document.getElementsByClassName("debitnoteitemsedit");
debitnotelen = debitnote.length;
let aevfordebitnoteitems = document.getElementsByClassName("aevfordebitnoteitems");
let debitnoteitemssubhead = document.getElementsByClassName("debitnoteitemssubhead");
let chnumofdebitnote = aevfordebitnoteitems.length;
if ($("#ItemInformationeditdebitnoteitemdebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnoteitems.length;i++) {
if (aevfordebitnoteitems[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnoteitemssubhead[i].checked=false;
}
else{
debitnoteitemssubhead[i].checked=true;
}
}
}
function ItemInformationviewdebitnoteitemdebitnote() {
let debitnote = document.getElementsByClassName("debitnoteitemsview");
debitnotelen = debitnote.length;
let aevfordebitnoteitems = document.getElementsByClassName("aevfordebitnoteitems");
let debitnoteitemssubhead = document.getElementsByClassName("debitnoteitemssubhead");
let chnumofdebitnote = aevfordebitnoteitems.length;
if ($("#ItemInformationviewdebitnoteitemdebitnote").prop("checked")) {
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=true;
}
}
else{
for (i=0;i<debitnotelen;i++) {
debitnote[i].checked=false;
}
}
for (i=0;i<aevfordebitnoteitems.length;i++) {
if (aevfordebitnoteitems[i].checked) {
chnumofdebitnote+=1;
}
else{
chnumofdebitnote-=1;
}
}
for (i=0;i<debitnotelen;i++) {
if (chnumofdebitnote==0) {
debitnoteitemssubhead[i].checked=false;
}
else{
debitnoteitemssubhead[i].checked=true;
}
}
}
            </script>
<?php
}
?>
<div class="row" style="border-top:1px solid #eee;padding:5px 0;"></div>
                                                </div> 
                                                </div>
                                                </div>
                                                </div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<div style="visibility: visible;" id="arrowsalldebitnotedebitnotethree">
<svg id="rightarrowdebitnotedebitnotethree" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowdebitnotedebitnotethree()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowdebitnotedebitnotethree" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowdebitnotedebitnotethree()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchdebitnotedebitnotethree() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#btwocreqfield').outerWidth()
            var scrollWidth = $('#btwocreqfield')[0].scrollWidth; 
            var scrollLeft = $('#btwocreqfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowdebitnotedebitnotethree').style.visibility = 'hidden';
            document.getElementById('rightarrowdebitnotedebitnotethree').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowdebitnotedebitnotethree').style.visibility = 'hidden';
            document.getElementById('leftarrowdebitnotedebitnotethree').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowdebitnotedebitnotethree').style.visibility = 'visible';
            document.getElementById('rightarrowdebitnotedebitnotethree').style.visibility = 'visible';
          }
            }
          }
          function leftarrowdebitnotedebitnotethree() {
            document.getElementById('btwocreqfield').scrollLeft += -90;
            var width = $('#btwocreqfield').outerWidth()
            var scrollWidth = $('#btwocreqfield')[0].scrollWidth; 
            var scrollLeft = $('#btwocreqfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowdebitnotedebitnotethree').style.visibility = 'hidden';
            document.getElementById('rightarrowdebitnotedebitnotethree').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowdebitnotedebitnotethree').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowdebitnotedebitnotethree() {
            document.getElementById('btwocreqfield').scrollLeft += 90;
            var width = $('#btwocreqfield').outerWidth()
            var scrollWidth = $('#btwocreqfield')[0].scrollWidth; 
            var scrollLeft = $('#btwocreqfield').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowdebitnotedebitnotethree').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowdebitnotedebitnotethree').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #btwocreqfield::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#btwocreqfield::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#btwocreqfield::-webkit-scrollbar-track {
  background-color: green;
}

#btwocreqfield::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#btwocreqfield::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsalldebitnotedebitnotethree{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsalldebitnotedebitnotethree{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchdebitnotedebitnotethree()" class="accordion-header scrollbar-2" id="btwocreqfield" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#btwocreqfields"
aria-expanded="true" aria-controls="btwocreqfields">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display as required</a>
</div>
</button>
</h5>
</div>
<div id="btwocreqfields" class="accordion-collapse collapse show"
aria-labelledby="btwocreqfield">
<div class="accordion-body text-sm">
<div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
<div class="col-lg-2 mt-2 mb-2"> <span class="text-danger">Vendor Name *</span> </div>
<div class="col-lg-10 mt-2 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="debitnotebtwocnamerequired" id="debitnotebtwocnamerequiredyes" value="Yes" <?= ($access['debitnotebtwocnamerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="debitnotebtwocnamerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="debitnotebtwocnamerequired" id="debitnotebtwocnamerequiredno" value="No" <?= ($access['debitnotebtwocnamerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="debitnotebtwocnamerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:3px solid #eee;">
<div class="col-lg-2 mt-1 mb-2"> <span class="text-danger">Work Phone *</span> </div>
<div class="col-lg-10 mt-1 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="debitnotebtwocwphonerequired" id="debitnotebtwocwphonerequiredyes" value="Yes" <?= ($access['debitnotebtwocwphonerequired']=='Yes')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="debitnotebtwocwphonerequiredyes">Yes</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
  <input type="radio" class="custom-control-input" name="debitnotebtwocwphonerequired" id="debitnotebtwocwphonerequiredno" value="No" <?= ($access['debitnotebtwocwphonerequired']=='No')?'checked':'' ?>>
  <label class="custom-control-label custom-label" for="debitnotebtwocwphonerequiredno">No</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <div style="visibility: visible;" id="arrowsalldebitnotedebitnotefour">
<svg id="rightarrowdebitnotedebitnotefour" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowdebitnotedebitnotefour()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowdebitnotedebitnotefour" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowdebitnotedebitnotefour()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchdebitnotedebitnotefour() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#debitnotedefault').outerWidth()
            var scrollWidth = $('#debitnotedefault')[0].scrollWidth; 
            var scrollLeft = $('#debitnotedefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowdebitnotedebitnotefour').style.visibility = 'hidden';
            document.getElementById('rightarrowdebitnotedebitnotefour').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowdebitnotedebitnotefour').style.visibility = 'hidden';
            document.getElementById('leftarrowdebitnotedebitnotefour').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowdebitnotedebitnotefour').style.visibility = 'visible';
            document.getElementById('rightarrowdebitnotedebitnotefour').style.visibility = 'visible';
          }
            }
          }
          function leftarrowdebitnotedebitnotefour() {
            document.getElementById('debitnotedefault').scrollLeft += -90;
            var width = $('#debitnotedefault').outerWidth()
            var scrollWidth = $('#debitnotedefault')[0].scrollWidth; 
            var scrollLeft = $('#debitnotedefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowdebitnotedebitnotefour').style.visibility = 'hidden';
            document.getElementById('rightarrowdebitnotedebitnotefour').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowdebitnotedebitnotefour').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowdebitnotedebitnotefour() {
            document.getElementById('debitnotedefault').scrollLeft += 90;
            var width = $('#debitnotedefault').outerWidth()
            var scrollWidth = $('#debitnotedefault')[0].scrollWidth; 
            var scrollLeft = $('#debitnotedefault').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowdebitnotedebitnotefour').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowdebitnotedebitnotefour').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #debitnotedefault::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#debitnotedefault::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#debitnotedefault::-webkit-scrollbar-track {
  background-color: green;
}

#debitnotedefault::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#debitnotedefault::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsalldebitnotedebitnotefour{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsalldebitnotedebitnotefour{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
<h5 ontouchmove="checkscrolltouchdebitnotedebitnotefour()" class="accordion-header scrollbar-2" id="debitnotedefault" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#debitnotedefaults"
                                                    aria-expanded="true" aria-controls="debitnotedefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="debitnotedefaults" class="accordion-collapse collapse show"
                                                aria-labelledby="debitnotedefault">
                                                <div class="accordion-body text-sm">
                                                  <?php
                                                  $sqlismainaccessdef=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Debit Notes' order by id  asc");
                                                  $infomainaccessdef=mysqli_fetch_array($sqlismainaccessdef);
                                                  ?>
                                                  <div class="row mb-2" style="border-bottom:2px solid #eee;border-top:2px solid #eee;">
                                                    <div class="col-lg-2 mt-2 mb-2">
                                                      Vendor Information
                                                    </div>
                                                    <div class="col-lg-10 mt-2 mb-2">
                                                      <div class="row">
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="debitnotevendorinfodefault" id="debitnotemanualvendorinfo" value="one" onclick="debitnoteveninfodefault()" <?= ($infomainaccessdef['debitnoteveninfo']=='one')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="debitnotemanualvendorinfo">B2B</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="debitnotevendorinfodefault" id="debitnotedefaultvendorinfo" value="two" onclick="debitnoteveninfodefault()" <?= ($infomainaccessdef['debitnoteveninfo']=='two')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="debitnotedefaultvendorinfo">B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="debitnotevendorinfodefault" id="debitnotebothvendorinfo" value="both" onclick="debitnoteveninfodefault()">
                        <label class="custom-control-label custom-label" for="debitnotebothvendorinfo">B2B & B2C</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-3" style="display: none;" id="debitnoteveninfodefault">
<select name="debitnoteveninfoselect" id="debitnoteveninfoselect" class="select4 form-control form-control-sm">
<option value="" <?= ($infomainaccessdef['debitnoteveninfo']=='one'||'two')?'selected':'' ?> disabled>Select</option> 
<option value="defone" <?= ($infomainaccessdef['debitnoteveninfo']=='defone')?'selected':'' ?>>B2B</option> 
<option value="deftwo" <?= ($infomainaccessdef['debitnoteveninfo']=='deftwo')?'selected':'' ?>>B2C</option> 
</select>
</div>
<input type="hidden" id="debitnotecheckvalue" value="<?= $infomainaccessdef['debitnoteveninfo'] ?>">
<script type="text/javascript">
    $(document).ready(function () {
        var debitnotecheckvalue = document.getElementById('debitnotecheckvalue');
        if (debitnotecheckvalue.value=='one') {
            document.getElementById("debitnoteveninfodefault").style.display="none !important";
            $("#debitnoteveninfoselect").removeAttr("required");
            document.getElementById("debitnoteb2cpos").style.display='none';
        }
        else if (debitnotecheckvalue.value=='two') {
            document.getElementById("debitnoteveninfodefault").style.display="none !important";
            $("#debitnoteveninfoselect").removeAttr("required");
            document.getElementById("debitnoteb2cpos").style.display='flex';
        }
        else if (debitnotecheckvalue.value!='two'||'one') {
            document.getElementById("debitnoteveninfodefault").style.display="block";
            document.getElementById("debitnotebothvendorinfo").checked=true;
            $("#debitnoteveninfoselect").attr("required","required");
            document.getElementById("debitnoteb2cpos").style.display='flex';
        }
    });
    function debitnoteveninfodefault() {
        var one = document.getElementById('debitnotemanualvendorinfo');
        var two = document.getElementById('debitnotedefaultvendorinfo');
        var both = document.getElementById('debitnotebothvendorinfo');
        if (one.checked==true) {
            document.getElementById("debitnoteveninfodefault").style.display="none";
            var debitnoteveninfoselect = document.getElementById("debitnoteveninfoselect");
            var debitnoteveninfoselectans = debitnoteveninfoselect.options[debitnoteveninfoselect.selectedIndex].text;
            debitnoteveninfoselect.value='';
            $("#debitnoteveninfoselect").removeAttr("required");
            document.getElementById("debitnoteb2cpos").style.display='none';
        }
        else if (two.checked==true) {
            document.getElementById("debitnoteveninfodefault").style.display="none";
            var debitnoteveninfoselect = document.getElementById("debitnoteveninfoselect");
            var debitnoteveninfoselectans = debitnoteveninfoselect.options[debitnoteveninfoselect.selectedIndex].text;
            debitnoteveninfoselect.value='';
            $("#debitnoteveninfoselect").removeAttr("required");
            document.getElementById("debitnoteb2cpos").style.display='flex';
        }
        else if (both.checked==true) {
            document.getElementById("debitnoteveninfodefault").style.display="block";
            var debitnoteveninfoselect = document.getElementById("debitnoteveninfoselect");
            var debitnoteveninfoselectans = debitnoteveninfoselect.options[debitnoteveninfoselect.selectedIndex].text;
            if (debitnoteveninfoselectans=='Select') {$("#debitnoteveninfoselect").attr("required","required");}
            document.getElementById("debitnoteb2cpos").style.display='flex';
        }
    }
</script>
                  </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2" id="debitnoteb2cpos" style="display:none;border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2 pt-1">
GST Registration Type
</div>
<div class="col-lg-4 mt-1 mb-2">
<select class="selectpicker form-control select2 twogst" data-live-search="true" title="Search title or description..." id="debitnotetwogst" name="debitnotetwogst">

<option data-foo="Business that is registered under GST" value="Registered Business - Regular" <?=($infomainaccessdef['debitnotetwogst']=='Registered Business - Regular')?'selected':'';?>>Registered Business - Regular</option>

<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition" <?=($infomainaccessdef['debitnotetwogst']=='Registered Business - Composition')?'selected':'';?>>Registered Business - Composition</option>

<option data-foo="Business that has not been registered under GST" value="Unregistered Business" <?=($infomainaccessdef['debitnotetwogst']=='Unregistered Business')?'selected':'';?>>Unregistered Business</option>

<option data-foo="A customer who is a regular consumer" value="Consumer" <?=(($infomainaccessdef['debitnotetwogst']=='Consumer')||($infomainaccessdef['debitnotetwogst']==''))?'selected':'';?>>Consumer</option>

<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas" <?=($infomainaccessdef['debitnotetwogst']=='Overseas')?'selected':'';?>>Overseas</option>

<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone" <?=($infomainaccessdef['debitnotetwogst']=='Special Economic Zone')?'selected':'';?>>Special Economic Zone</option>

<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export" <?=($infomainaccessdef['debitnotetwogst']=='Deemed Export')?'selected':'';?>>Deemed Export</option>

<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor" <?=($infomainaccessdef['debitnotetwogst']=='Tax Deductor')?'selected':'';?>>Tax Deductor</option>

<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer" <?=($infomainaccessdef['debitnotetwogst']=='SEZ Developer')?'selected':'';?>>SEZ Developer</option>
</select>
</div>
                                                    <div class="col-lg-2 mt-1 mb-2 pt-1">
                                                      Place of Supply
                                                    </div>
                                                    <div class="col-lg-4 mt-1 mb-2">
                                                        <select name="debitnotetwopos" id="debitnotetwopos" class="select4 form-control form-control-sm">
<option value="Select Place of Supply" <?= ($infomainaccessdef['debitnotetwopos']=='Select Place of Supply')?'selected':'' ?>>Select Place of Supply</option>
<option value="JAMMU AND KASHMIR (1)" <?=($infomainaccessdef['debitnotetwopos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($infomainaccessdef['debitnotetwopos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($infomainaccessdef['debitnotetwopos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($infomainaccessdef['debitnotetwopos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($infomainaccessdef['debitnotetwopos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($infomainaccessdef['debitnotetwopos']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($infomainaccessdef['debitnotetwopos']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($infomainaccessdef['debitnotetwopos']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($infomainaccessdef['debitnotetwopos']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($infomainaccessdef['debitnotetwopos']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($infomainaccessdef['debitnotetwopos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($infomainaccessdef['debitnotetwopos']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($infomainaccessdef['debitnotetwopos']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($infomainaccessdef['debitnotetwopos']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($infomainaccessdef['debitnotetwopos']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($infomainaccessdef['debitnotetwopos']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($infomainaccessdef['debitnotetwopos']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($infomainaccessdef['debitnotetwopos']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($infomainaccessdef['debitnotetwopos']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($infomainaccessdef['debitnotetwopos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($infomainaccessdef['debitnotetwopos']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($infomainaccessdef['debitnotetwopos']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($infomainaccessdef['debitnotetwopos']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($infomainaccessdef['debitnotetwopos']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($infomainaccessdef['debitnotetwopos']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($infomainaccessdef['debitnotetwopos']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($infomainaccessdef['debitnotetwopos']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($infomainaccessdef['debitnotetwopos']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($infomainaccessdef['debitnotetwopos']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($infomainaccessdef['debitnotetwopos']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($infomainaccessdef['debitnotetwopos']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($infomainaccessdef['debitnotetwopos']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($infomainaccessdef['debitnotetwopos']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($infomainaccessdef['debitnotetwopos']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($infomainaccessdef['debitnotetwopos']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($infomainaccessdef['debitnotetwopos']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($infomainaccessdef['debitnotetwopos']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($infomainaccessdef['debitnotetwopos']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($infomainaccessdef['debitnotetwopos']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
                                                      </div>
                                                      </div>
<div class="row mb-2" style="border-bottom:2px solid #eee;<?= ($access['batchexpiryval']==1)?'':'display: none;' ?>">
<div class="col-lg-2 mb-2">
Product Batch
</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="debitnotebatchdef" id="debitnotebatchshow" value="show" <?= ($access['debitnotebatchdef']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="debitnotebatchshow">Show All</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="debitnotebatchdef" id="debitnotebatchavail" value="avail" <?= ($access['debitnotebatchdef']=='avail')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="debitnotebatchavail">Available Only(Custom)</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mb-2">
Product Rate
</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="debitnoteratedef" id="debitnoterateshow" value="show" <?= ($access['debitnoteratedef']=='show')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="debitnoterateshow">Show All</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="debitnoteratedef" id="debitnoterateavail" value="avail" <?= ($access['debitnoteratedef']=='avail')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="debitnoterateavail">Available Only</label>
</div>
</div>
</div>
</div>
</div>
<div class="row mb-2" style="border-bottom:2px solid #eee;">
<div class="col-lg-2 mt-1 mb-2 pt-1">
Refund Option
</div>
<div class="col-lg-3 mt-1 mb-2">
<select class="select4 form-control  form-control-sm" name="drrefundoption" id="drrefundoption" required>
    <option value="refundnow" <?=($access['drrefundoption']=='refundnow')?'selected':''?>>
        Refund Now
    </option>
    <option value="refundlater" <?=($access['drrefundoption']=='refundlater')?'selected':''?>>
        Refund Later
    </option>
</select>
</div>
</div>
<div class="row mb-2">
<div class="col-lg-2 mb-2">Display in Dropdown</div>
<div class="col-lg-10 mb-2">
<div class="row">
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="debitnotenewproductdef" id="debitnotenewproductdef" <?= ($access['debitnotenewproductdef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="debitnotenewproductdef">New Product</label>
</div>
</div>
<div class="col-lg-3">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="debitnotenewvendordef" id="debitnotenewvendordef" <?= ($access['debitnotenewvendordef']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="debitnotenewvendordef">New Vendor</label>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>

                      </div>
                      </div>
                      </div>
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="debitnotecolumn">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#debitnotecolumns"
                                                    aria-expanded="true" aria-controls="debitnotecolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="debitnotecolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="debitnotecolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Debit Notes' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Debit Notes' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>debitnotecol" id="<?= $coltypemod; ?>debitnotecol" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>debitnotecol" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace(" or ", " / ",(str_replace("Vendors", $infomainaccessvendor['modulename'],(str_replace(" No ", "Number",(str_replace("Debit Notes", $infomainaccessdebitnotes['modulename'],$newmoduleskey))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
<div class="row" style="border-top:2px solid #eee;padding:5px 0;"></div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
<div class="tab-pane fade show mt-4 p-3 <?=((($infomainaccessvendor['moduleaccess']!='1')&&($infomainaccesspurchaseorder['moduleaccess']!='1')&&($infomainaccesspurchasereceive['moduleaccess']!='1')&&($infomainaccesspurchasebill['moduleaccess']!='1')&&($infomainaccesspaymade['moduleaccess']!='1')&&($infomainaccesspurchasereturn['moduleaccess']!='1')&&($infomainaccesspurchasereturnpay['moduleaccess']=='1')&&($infomainaccessdebitnotes['moduleaccess']!='1'))?'active':'')?>" id="nav-purchasereturnpay" role="tabpanel" aria-labelledby="nav-purchasereturnpay-tab" <?=(($infomainaccesspurchasereturnpay['moduleaccess']=='1')?'':'style="display:none"')?>>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="paymadeforsidebar">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#paymadeforsidebars" aria-expanded="true" aria-controls="paymadeforsidebars">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select would you like to display in sidebar</a>
</div>
</button>
</h5>
</div>
<div id="paymadeforsidebars" class="accordion-collapse collapse show"
aria-labelledby="paymadeforsidebar">
<div class="accordion-body text-sm">
<div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
<div class="col-lg-6">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="purpaymadeforside" id="purpaymadeforside" <?= ($access['purpaymadeforside']==1)?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purpaymadeforside" style="font-size: 14.6px;color:royalblue !important;"> <?= $infomainaccesspurchasereturnpay['modulename'] ?></label>
</div>
</div>
<div class="col-lg-6"></div>       
</div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purchasereturnpayfield">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purchasereturnpayfields"
                                                    aria-expanded="true" aria-controls="purchasereturnpayfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="purchasereturnpayfields" class="accordion-collapse collapse show"
                                                aria-labelledby="purchasereturnpayfield">
                                                <div class="accordion-body text-sm">
<?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendor Refunds' order by id asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
$coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
$ans = $infomainaccess[21];
$newans = explode(',',$ans);
$ans1 = $infomainaccess[22];
$newans1 = explode(',',$ans1);
$ans2 = $infomainaccess[23];
$newans2 = explode(',',$ans2);
}

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Vendor Refunds' order by id asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
$coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
$ansmodules = $infomodules[3];
$newmodules = explode(',',$ansmodules);
}
foreach ($newmodules as $newmoduleskey) {
$coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:0.5px solid #eee; border-bottom:0.5px solid #eee; padding:5px 0">
<div class="col-lg-2">
<div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>paymadefor()">
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?>paymadefor"<?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>paymadefor" style="font-size: 14.6px;"> <?= str_replace(" or ", " / ",(str_replace("Vendor Refunds", $infomainaccesspurchasereturnpay['modulename'],(str_replace("Category",$access['txtnamecategory'],(str_replace("Batch","Batch & Expiry",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))))))))) ?></label>
</div>
</div>
<div class="col-lg-10">
<div class="row">
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aevpaymadefor()">
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>addpaymadefor" id="<?= $coltypemod; ?>addpaymadefor" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>addpaymadefor"> Add</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aevpaymadefor()">
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>editpaymadefor" id="<?= $coltypemod; ?>editpaymadefor" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?>>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>editpaymadefor"> Edit</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aevpaymadefor()">
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>viewpaymadefor" id="<?= $coltypemod; ?>viewpaymadefor" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?>>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>viewpaymadefor"> View</label>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
function <?= $coltypemod; ?>paymadefor() {
let fullhigh = document.getElementById("<?= $coltypemod; ?>paymadefor");
let addhigh = document.getElementById("<?= $coltypemod; ?>addpaymadefor");
let edithigh = document.getElementById("<?= $coltypemod; ?>editpaymadefor");
let viewhigh = document.getElementById("<?= $coltypemod; ?>viewpaymadefor");
if (fullhigh.checked == true) {
addhigh.checked=true;
edithigh.checked=true;
viewhigh.checked=true;
}
else{
addhigh.checked=false;
edithigh.checked=false;
viewhigh.checked=false;
}
}
function <?= $coltypemod; ?>aevpaymadefor() {
let full = document.getElementById("<?= $coltypemod; ?>paymadefor");
let add = document.getElementById("<?= $coltypemod; ?>addpaymadefor");
let edit = document.getElementById("<?= $coltypemod; ?>editpaymadefor");
let view = document.getElementById("<?= $coltypemod; ?>viewpaymadefor");
if (add.checked == true||edit.checked==true||view.checked==true) {
full.checked=true;
}
else{
full.checked=false;
}
}
</script>
<?php
}
?>
            </div>
            </div>
            </div>
            </div>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="purchasereturnpaycolumn">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purchasereturnpaycolumns"
                                                    aria-expanded="true" aria-controls="purchasereturnpaycolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="purchasereturnpaycolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="purchasereturnpaycolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendor Refunds' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Vendor Refunds' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>purchasereturnpaycol" id="<?= $coltypemod; ?>purchasereturnpaycol" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Name')?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>purchasereturnpaycol" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace(" or ", " / ",(str_replace("Vendors", $infomainaccessvendor['modulename'],$newmoduleskey))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
                      
<div class="row" style="border-top:2px solid #eee;padding:5px 0;"></div>
                      </div>
                      </div>
                      </div>
                      </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallpurreturnpaypaydefpage">
<svg id="rightarrowpurreturnpaypayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowpurreturnpaypayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowpurreturnpaypayaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowpurreturnpaypayaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchpurreturnpaypayaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#purreturnpaypaydefaultpage').outerWidth()
            var scrollWidth = $('#purreturnpaypaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreturnpaypaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurreturnpaypayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurreturnpaypayaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowpurreturnpaypayaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowpurreturnpaypayaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowpurreturnpaypayaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowpurreturnpaypayaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowpurreturnpaypayaccdefpage() {
            document.getElementById('purreturnpaypaydefaultpage').scrollLeft += -90;
            var width = $('#purreturnpaypaydefaultpage').outerWidth()
            var scrollWidth = $('#purreturnpaypaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreturnpaypaydefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpurreturnpaypayaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowpurreturnpaypayaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowpurreturnpaypayaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowpurreturnpaypayaccdefpage() {
            document.getElementById('purreturnpaypaydefaultpage').scrollLeft += 90;
            var width = $('#purreturnpaypaydefaultpage').outerWidth()
            var scrollWidth = $('#purreturnpaypaydefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#purreturnpaypaydefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowpurreturnpaypayaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowpurreturnpaypayaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #purreturnpaypaydefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#purreturnpaypaydefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#purreturnpaypaydefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#purreturnpaypaydefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#purreturnpaypaydefaultpage::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 480px){
  #arrowsallpurreturnpaypaydefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpurreturnpaypaydefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchpurreturnpaypayaccdefpage()" class="accordion-header scrollbar-2" id="purreturnpaypaydefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#purreturnpaypaydefaultspages"
                                                    aria-expanded="true" aria-controls="purreturnpaypaydefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="purreturnpaypaydefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="purreturnpaypaydefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row" style="padding-top: 5px;padding-bottom: 0px;margin-bottom: 0px;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnpaypageload" id="purreturnpaypagenum" value="pagenum" <?= ($access['purreturnpaypageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnpaypagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="purreturnpaypageload" id="purreturnpaypageauto" value="pageauto" <?= ($access['purreturnpaypageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="purreturnpaypageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
        </div>
            
            </div>
</div>
</div>
</form>
            <?php
	  include('footer.php');
	  ?>
        </div>

    </main>
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
    <?php
 include('fexternals.php');
 ?>

<style type="text/css">
.foo { color: #808080; text-size: smaller;margin-top: -3px !important;}
.select2-container--default .select2-selection--single{height: 32px !important;}
.select2{width: 100% !important;}
.select2-results{border-bottom: 1px solid #aaa !important;}
</style>
<script type="text/javascript">
$(".twogst").on("select2:open", function() { 
    $("#configureunits").hide();
});
$(function(){
$("#myBtn").select2({
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
$("#myBtn").on("select2:open", function() {
$("#configureunits").hide();
});
</script>
    <script type="text/javascript">
    $(function() {
        $("#invoicesuffix").autocomplete({
            source: 'invoicesuffixsearch.php',
            select: function(event, ui) {
                $("#invoicesuffix").val(ui.item.invoicesuffix);
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