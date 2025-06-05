<?php
include('lcheck.php');
if($permissionfranchise=='0'||$permissionfranchise=='1')
{
	header('Location: dashboard.php');
}
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqli=mysqli_query($con, "select * from pairfranchises where tdelete='0' and id='".$id."' order by franchisename asc");
if(mysqli_num_rows($sqli)>0)
{
$info=mysqli_fetch_array($sqli);
if(isset($_POST['submit']))
{
$id=mysqli_real_escape_string($con, $_POST['id']);
$upiid=mysqli_real_escape_string($con, $_POST['upiid']);
$franchisename=mysqli_real_escape_string($con, $_POST['franchisename']);
$displayname=mysqli_real_escape_string($con, $_POST['displayname']);
$street=mysqli_real_escape_string($con, $_POST['street']);
$city=mysqli_real_escape_string($con, $_POST['city']);
$pincode=mysqli_real_escape_string($con, $_POST['pincode']);
$state=mysqli_real_escape_string($con, $_POST['state']);
$country=mysqli_real_escape_string($con, $_POST['country']);
$mobile=mysqli_real_escape_string($con, $_POST['mobile']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$website=mysqli_real_escape_string($con, $_POST['website']);
$gstno=mysqli_real_escape_string($con, $_POST['gstno']);
$pos=mysqli_real_escape_string($con, $_POST['pos']);

$bank=mysqli_real_escape_string($con, $_POST['bank']);
$names=mysqli_real_escape_string($con, $_POST['names']);
$accountnumber=mysqli_real_escape_string($con, $_POST['accountnumber']);
$ifsccode=mysqli_real_escape_string($con, $_POST['ifsccode']);
$branchandcity=mysqli_real_escape_string($con, $_POST['branchandcity']);
$dlno20=mysqli_real_escape_string($con, $_POST['dlno20']);
$dlno21=mysqli_real_escape_string($con, $_POST['dlno21']);

$branchimages=array();
// Configure upload directory and allowed file types
$upload_dir = 'ups/profile/';
$allowed_types = array('jpg', 'png', 'jpeg', 'gif');    
// Define maxsize for files i.e 2MB
$maxsize = 2 * 1024 * 1024;
// Checks if user sent an empty form
if(!empty(array_filter($_FILES['branchimage']['name']))) {
foreach ($_FILES['branchimage']['tmp_name'] as $key => $value) {            
$file_tmpname = $_FILES['branchimage']['tmp_name'][$key];
$file_name = $_FILES['branchimage']['name'][$key];
$file_size = $_FILES['branchimage']['size'][$key];
$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$filepath = $upload_dir.$file_name;
if(in_array(strtolower($file_ext), $allowed_types)) {
if ($file_size > $maxsize)        
header("Location: franchiseadd.php?error=File size is larger than the allowed limit");
if(file_exists($filepath)) {
$filepath = $upload_dir.time().$file_name; 
if( move_uploaded_file($file_tmpname, $filepath)) {
$branchimages[]=$filepath;
// echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}
else {
if( move_uploaded_file($file_tmpname, $filepath)) {
$branchimages[]=$filepath;
//echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}          
}
else {      
// If file extension not valid
// echo "Error uploading {$file_name} ";
//  echo "({$file_ext} file type is not allowed)<br / >";
}
}
}
else {
 
}
if(!empty($branchimages))
{
$branchimage=implode(",",$branchimages);
}
else
{
$branchimage=mysqli_real_escape_string($con, $_POST['branchimages']);
}

$signimages=array();
// Configure upload directory and allowed file types
$upload_dir = 'ups/profile/';
$allowed_types = array('jpg', 'png', 'jpeg', 'gif');    
// Define maxsize for files i.e 2MB
$maxsize = 2 * 1024 * 1024;
// Checks if user sent an empty form
if(!empty(array_filter($_FILES['signimage']['name']))) {
foreach ($_FILES['signimage']['tmp_name'] as $key => $value) {            
$file_tmpname = $_FILES['signimage']['tmp_name'][$key];
$file_name = $_FILES['signimage']['name'][$key];
$file_size = $_FILES['signimage']['size'][$key];
$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$filepath = $upload_dir.$file_name;
if(in_array(strtolower($file_ext), $allowed_types)) {
if ($file_size > $maxsize)        
header("Location: franchiseadd.php?error=File size is larger than the allowed limit");
if(file_exists($filepath)) {
$filepath = $upload_dir.time().$file_name; 
if( move_uploaded_file($file_tmpname, $filepath)) {
$signimages[]=$filepath;
// echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}
else {
if( move_uploaded_file($file_tmpname, $filepath)) {
$signimages[]=$filepath;
//echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}          
}
else {      
// If file extension not valid
// echo "Error uploading {$file_name} ";
//  echo "({$file_ext} file type is not allowed)<br / >";
}
}
}
else {
 
}
if(!empty($signimages))
{
$signimage=implode(",",$signimages);
}
else
{
$signimage=mysqli_real_escape_string($con, $_POST['signimages']);
}


$scanqrs=array();
// Configure upload directory and allowed file types
$upload_dir = 'ups/profile/';
$allowed_types = array('jpg', 'png', 'jpeg', 'gif');    
// Define maxsize for files i.e 2MB
$maxsize = 2 * 1024 * 1024;
// Checks if user sent an empty form
if(!empty(array_filter($_FILES['scanqrimage']['name']))) {
foreach ($_FILES['scanqrimage']['tmp_name'] as $key => $value) {            
$file_tmpname = $_FILES['scanqrimage']['tmp_name'][$key];
$file_name = $_FILES['scanqrimage']['name'][$key];
$file_size = $_FILES['scanqrimage']['size'][$key];
$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$filepath = $upload_dir.$file_name;
if(in_array(strtolower($file_ext), $allowed_types)) {
if ($file_size > $maxsize)        
header("Location: franchiseadd.php?error=File size is larger than the allowed limit");
if(file_exists($filepath)) {
$filepath = $upload_dir.time().$file_name; 
if( move_uploaded_file($file_tmpname, $filepath)) {
$scanqrs[]=$filepath;
// echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}
else {
if( move_uploaded_file($file_tmpname, $filepath)) {
$scanqrs[]=$filepath;
//echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}          
}
else {      
// If file extension not valid
// echo "Error uploading {$file_name} ";
//  echo "({$file_ext} file type is not allowed)<br / >";
}
}
}
else {
 
}
if(!empty($scanqrs))
{
$qrcode=implode(",",$scanqrs);
}
else
{
$qrcode=mysqli_real_escape_string($con, $_POST['scanqrs']);
}

// $salesorder=mysqli_real_escape_string($con, $_POST['salesorder']);
// $salesorderprefix=mysqli_real_escape_string($con, $_POST['salesorderprefix']);
// $salesordersuffix=mysqli_real_escape_string($con, $_POST['salesordersuffix']);

// $oldsalesorder=mysqli_real_escape_string($con, $_POST['oldsalesorder']);
// $oldsalesorderprefix=mysqli_real_escape_string($con, $_POST['oldsalesorderprefix']);
// $oldsalesordersuffix=mysqli_real_escape_string($con, $_POST['oldsalesordersuffix']);

// $quotation=mysqli_real_escape_string($con, $_POST['quotation']);
// $quotationprefix=mysqli_real_escape_string($con, $_POST['quotationprefix']);
// $quotationsuffix=mysqli_real_escape_string($con, $_POST['quotationsuffix']);

// $oldquotation=mysqli_real_escape_string($con, $_POST['oldquotation']);
// $oldquotationprefix=mysqli_real_escape_string($con, $_POST['oldquotationprefix']);
// $oldquotationsuffix=mysqli_real_escape_string($con, $_POST['oldquotationsuffix']);

// $estimate=mysqli_real_escape_string($con, $_POST['estimate']);
// $estimateprefix=mysqli_real_escape_string($con, $_POST['estimateprefix']);
// $estimatesuffix=mysqli_real_escape_string($con, $_POST['estimatesuffix']);

// $oldestimate=mysqli_real_escape_string($con, $_POST['oldestimate']);
// $oldestimateprefix=mysqli_real_escape_string($con, $_POST['oldestimateprefix']);
// $oldestimatesuffix=mysqli_real_escape_string($con, $_POST['oldestimatesuffix']);

// $proforma=mysqli_real_escape_string($con, $_POST['proforma']);
// $proformaprefix=mysqli_real_escape_string($con, $_POST['proformaprefix']);
// $proformasuffix=mysqli_real_escape_string($con, $_POST['proformasuffix']);

// $oldproforma=mysqli_real_escape_string($con, $_POST['oldproforma']);
// $oldproformaprefix=mysqli_real_escape_string($con, $_POST['oldproformaprefix']);
// $oldproformasuffix=mysqli_real_escape_string($con, $_POST['oldproformasuffix']);

// $invoice=mysqli_real_escape_string($con, $_POST['invoice']);
// $invoiceprefix=mysqli_real_escape_string($con, $_POST['invoiceprefix']);
// $invoicesuffix=mysqli_real_escape_string($con, $_POST['invoicesuffix']);

// $oldinvoice=mysqli_real_escape_string($con, $_POST['oldinvoice']);
// $oldinvoiceprefix=mysqli_real_escape_string($con, $_POST['oldinvoiceprefix']);
// $oldinvoicesuffix=mysqli_real_escape_string($con, $_POST['oldinvoicesuffix']);

// $salesreturn=mysqli_real_escape_string($con, $_POST['salesreturn']);
// $salesreturnprefix=mysqli_real_escape_string($con, $_POST['salesreturnprefix']);
// $salesreturnsuffix=mysqli_real_escape_string($con, $_POST['salesreturnsuffix']);

// $oldsalesreturn=mysqli_real_escape_string($con, $_POST['oldsalesreturn']);
// $oldsalesreturnprefix=mysqli_real_escape_string($con, $_POST['oldsalesreturnprefix']);
// $oldsalesreturnsuffix=mysqli_real_escape_string($con, $_POST['oldsalesreturnsuffix']);

// $purchaseorder=mysqli_real_escape_string($con, $_POST['purchaseorder']);
// $purchaseorderprefix=mysqli_real_escape_string($con, $_POST['purchaseorderprefix']);
// $purchaseordersuffix=mysqli_real_escape_string($con, $_POST['purchaseordersuffix']);

// $oldpurchaseorder=mysqli_real_escape_string($con, $_POST['oldpurchaseorder']);
// $oldpurchaseorderprefix=mysqli_real_escape_string($con, $_POST['oldpurchaseorderprefix']);
// $oldpurchaseordersuffix=mysqli_real_escape_string($con, $_POST['oldpurchaseordersuffix']);

// $bill=mysqli_real_escape_string($con, $_POST['bill']);
// $billprefix=mysqli_real_escape_string($con, $_POST['billprefix']);
// $billsuffix=mysqli_real_escape_string($con, $_POST['billsuffix']);

// $oldbill=mysqli_real_escape_string($con, $_POST['oldbill']);
// $oldbillprefix=mysqli_real_escape_string($con, $_POST['oldbillprefix']);
// $oldbillsuffix=mysqli_real_escape_string($con, $_POST['oldbillsuffix']);

// $purchasereturn=mysqli_real_escape_string($con, $_POST['purchasereturn']);
// $purchasereturnprefix=mysqli_real_escape_string($con, $_POST['purchasereturnprefix']);
// $purchasereturnsuffix=mysqli_real_escape_string($con, $_POST['purchasereturnsuffix']);

// $oldpurchasereturn=mysqli_real_escape_string($con, $_POST['oldpurchasereturn']);
// $oldpurchasereturnprefix=mysqli_real_escape_string($con, $_POST['oldpurchasereturnprefix']);
// $oldpurchasereturnsuffix=mysqli_real_escape_string($con, $_POST['oldpurchasereturnsuffix']);


// $job=mysqli_real_escape_string($con, $_POST['job']);
// $jobprefix=mysqli_real_escape_string($con, $_POST['jobprefix']);
// $jobsuffix=mysqli_real_escape_string($con, $_POST['jobsuffix']);

// $oldjob=mysqli_real_escape_string($con, $_POST['oldjob']);
// $oldjobprefix=mysqli_real_escape_string($con, $_POST['oldjobprefix']);
// $oldjobsuffix=mysqli_real_escape_string($con, $_POST['oldjobsuffix']);


// $ledger=mysqli_real_escape_string($con, $_POST['ledger']);
// $ledgerprefix=mysqli_real_escape_string($con, $_POST['ledgerprefix']);
// $ledgersuffix=mysqli_real_escape_string($con, $_POST['ledgersuffix']);

// $oldledger=mysqli_real_escape_string($con, $_POST['oldledger']);
// $oldledgerprefix=mysqli_real_escape_string($con, $_POST['oldledgerprefix']);
// $oldledgersuffix=mysqli_real_escape_string($con, $_POST['oldledgersuffix']);


// $project=mysqli_real_escape_string($con, $_POST['project']);
// $projectprefix=mysqli_real_escape_string($con, $_POST['projectprefix']);
// $projectsuffix=mysqli_real_escape_string($con, $_POST['projectsuffix']);

// $oldproject=mysqli_real_escape_string($con, $_POST['oldproject']);
// $oldprojectprefix=mysqli_real_escape_string($con, $_POST['oldprojectprefix']);
// $oldprojectsuffix=mysqli_real_escape_string($con, $_POST['oldprojectsuffix']);


// $deliverychallan=mysqli_real_escape_string($con, $_POST['deliverychallan']);
// $deliverychallanprefix=mysqli_real_escape_string($con, $_POST['deliverychallanprefix']);
// $deliverychallansuffix=mysqli_real_escape_string($con, $_POST['deliverychallansuffix']);

// $enquiry=mysqli_real_escape_string($con, $_POST['enquiry']);
// $enquiryprefix=mysqli_real_escape_string($con, $_POST['enquiryprefix']);
// $enquirysuffix=mysqli_real_escape_string($con, $_POST['enquirysuffix']);

// $purchasereceive=mysqli_real_escape_string($con, $_POST['purchasereceive']);
// $purchasereceiveprefix=mysqli_real_escape_string($con, $_POST['purchasereceiveprefix']);
// $purchasereceivesuffix=mysqli_real_escape_string($con, $_POST['purchasereceivesuffix']);


// $olddeliverychallan=mysqli_real_escape_string($con, $_POST['olddeliverychallan']);
// $olddeliverychallanprefix=mysqli_real_escape_string($con, $_POST['olddeliverychallanprefix']);
// $olddeliverychallansuffix=mysqli_real_escape_string($con, $_POST['olddeliverychallansuffix']);

// $oldenquiry=mysqli_real_escape_string($con, $_POST['oldenquiry']);
// $oldenquiryprefix=mysqli_real_escape_string($con, $_POST['oldenquiryprefix']);
// $oldenquirysuffix=mysqli_real_escape_string($con, $_POST['oldenquirysuffix']);

// $oldpurchasereceive=mysqli_real_escape_string($con, $_POST['oldpurchasereceive']);
// $oldpurchasereceiveprefix=mysqli_real_escape_string($con, $_POST['oldpurchasereceiveprefix']);
// $oldpurchasereceivesuffix=mysqli_real_escape_string($con, $_POST['oldpurchasereceivesuffix']);
//, salesorder='$salesorder', salesorderprefix='$salesorderprefix', salesordersuffix='$salesordersuffix', quotation='$quotation', quotationprefix='$quotationprefix', quotationsuffix='$quotationsuffix', estimate='$estimate', estimateprefix='$estimateprefix', estimatesuffix='$estimatesuffix', proforma='$proforma', proformaprefix='$proformaprefix', proformasuffix='$proformasuffix', invoice='$invoice', invoiceprefix='$invoiceprefix', invoicesuffix='$invoicesuffix', salesreturn='$salesreturn', salesreturnprefix='$salesreturnprefix', salesreturnsuffix='$salesreturnsuffix', purchaseorder='$purchaseorder', purchaseorderprefix='$purchaseorderprefix', purchaseordersuffix='$purchaseordersuffix', bill='$bill', billprefix='$billprefix', billsuffix='$billsuffix', purchasereturn='$purchasereturn', purchasereturnprefix='$purchasereturnprefix', purchasereturnsuffix='$purchasereturnsuffix', job='$job', jobprefix='$jobprefix', jobsuffix='$jobsuffix', ledger='$ledger', ledgerprefix='$ledgerprefix', ledgersuffix='$ledgersuffix', project='$project', projectprefix='$projectprefix', projectsuffix='$projectsuffix', deliverychallan='$deliverychallan', deliverychallanprefix='$deliverychallanprefix', deliverychallansuffix='$deliverychallansuffix',  enquiry='$enquiry', enquiryprefix='$enquiryprefix', enquirysuffix='$enquirysuffix', purchasereceive='$purchasereceive', purchasereceiveprefix='$purchasereceiveprefix', purchasereceivesuffix='$purchasereceivesuffix'

$oldfranchisename=mysqli_real_escape_string($con, $_POST['oldfranchisename']);
$olddisplayname=mysqli_real_escape_string($con, $_POST['olddisplayname']);
$oldstreet=mysqli_real_escape_string($con, $_POST['oldstreet']);
$oldcity=mysqli_real_escape_string($con, $_POST['oldcity']);
$oldpincode=mysqli_real_escape_string($con, $_POST['oldpincode']);
$oldstate=mysqli_real_escape_string($con, $_POST['oldstate']);
$oldcountry=mysqli_real_escape_string($con, $_POST['oldcountry']);
$oldmobile=mysqli_real_escape_string($con, $_POST['oldmobile']);
$oldemail=mysqli_real_escape_string($con, $_POST['oldemail']);
$oldwebsite=mysqli_real_escape_string($con, $_POST['oldwebsite']);
$oldgstno=mysqli_real_escape_string($con, $_POST['oldgstno']);
$oldpos=mysqli_real_escape_string($con, $_POST['oldpos']);
$olddlno20=mysqli_real_escape_string($con, $_POST['olddlno20']);
$olddlno21=mysqli_real_escape_string($con, $_POST['olddlno21']);
$oldbank=mysqli_real_escape_string($con, $_POST['oldbank']);
$oldnames=mysqli_real_escape_string($con, $_POST['oldnames']);
$oldaccountnumber=mysqli_real_escape_string($con, $_POST['oldaccountnumber']);
$oldifsccode=mysqli_real_escape_string($con, $_POST['oldifsccode']);
$oldbranchandcity=mysqli_real_escape_string($con, $_POST['oldbranchandcity']);

$msg = "";
$msg_class = "";
	if(($franchisename!=""))
	{		
        $sqlcon = "SELECT id From pairfranchises WHERE id = '{$id}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon > 0) 
		{	


			$sqlup = "update pairfranchises set upiid='$upiid',createdon='$times',  createdby='".$_SESSION["unqwerty"]."', email='$email', mobile='$mobile', franchisename='$franchisename',displayname='$displayname', website='$website', gstno='$gstno', pos='$pos', street='$street', country='$country',  city='$city',  state='$state', pincode='$pincode',branchimage='$branchimage',signimage='$signimage',bank='$bank',names='$names',accountnumber='$accountnumber',ifsccode='$ifsccode',branchandcity='$branchandcity',dlno20='$dlno20',dlno21='$dlno21',qrcode='$qrcode' where id='$id'";
			$queryup = mysqli_query($con, $sqlup);

            $ch='';			 
$sqlmainhis = mysqli_query($con,"select distinct grouptype,groupname,groupaccess from pairmainaccess where userid='$userid' and moduletype!=''");
while($sqlmainresulthis = mysqli_fetch_array($sqlmainhis)){
$grouptype = preg_replace('/\s+/', '', $sqlmainresulthis['grouptype']);
$maingrouptypehis=$sqlmainresulthis['grouptype'];
$sqlismainaccesshis=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype,moduleno,moduleprefix,modulesuffix,groupaccess,groupname from pairmainaccess where franchiseid='$id' and (grouptype='$maingrouptypehis' and moduletype!='') ORDER BY ordering ASC");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
$coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
if ($infomainaccesshis['moduleaccess']==1) {
$modulenocolhis="moduleno".strtolower($coltype);
$modulenohis=mysqli_real_escape_string($con, $_POST[$modulenocolhis]);
$moduleprefixcolhis="moduleprefix".strtolower($coltype);
$moduleprefixhis=mysqli_real_escape_string($con, $_POST[$moduleprefixcolhis]);
$modulesuffixcolhis="modulesuffix".strtolower($coltype);
$modulesuffixhis=mysqli_real_escape_string($con, $_POST[$modulesuffixcolhis]);
$oldmodulenohis=$infomainaccesshis['moduleno'];
$oldmoduleprefixcolhis=$infomainaccesshis['moduleprefix'];
$oldmodulesuffixcolhis=$infomainaccesshis['modulesuffix'];
if ($modulenohis!=$oldmodulenohis) {
if ($modulenohis=='0') {
if($ch!='')
{
$ch.='<br> '.$infomainaccesshis['modulename'].' (New '.$infomainaccesshis['modulename'].') <span style="color:green;" id="prohisfromtospan">( From FULL ACCESS To NO ACCESS ) </span>';
}
else
{
$ch.=''.$infomainaccesshis['modulename'].' (New '.$infomainaccesshis['modulename'].') <span style="color:green;" id="prohisfromtospan">( From FULL ACCESS To NO ACCESS ) </span>';
}
}
else{
if($ch!='')
{
$ch.='<br> '.$infomainaccesshis['modulename'].' (New '.$infomainaccesshis['modulename'].') <span style="color:green;" id="prohisfromtospan">( From NO ACCESS To FULL ACCESS ) </span>';
}
else
{
$ch.=''.$infomainaccesshis['modulename'].' (New '.$infomainaccesshis['modulename'].') <span style="color:green;" id="prohisfromtospan">( From NO ACCESS To FULL ACCESS ) </span>';
}
}
}
if ($moduleprefixhis!=$oldmoduleprefixcolhis) {
if($ch!='')
{
$ch.='<br> '.$infomainaccesshis['modulename'].' (New '.$infomainaccesshis['modulename'].') Transaction Series Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldmoduleprefixcolhis.' To '.$moduleprefixhis.' ) </span>';
}
else
{
$ch.=''.$infomainaccesshis['modulename'].' (New '.$infomainaccesshis['modulename'].') Transaction Series Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldmoduleprefixcolhis.' To '.$moduleprefixhis.' ) </span>';
}     
}
if ($modulesuffixhis!=$oldmodulesuffixcolhis) {
if($ch!='')
{
$ch.='<br> '.$infomainaccesshis['modulename'].' (New '.$infomainaccesshis['modulename'].') Transaction Series Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldmodulesuffixcolhis.' To '.$modulesuffixhis.' ) </span>';
}
else
{
$ch.=''.$infomainaccesshis['modulename'].' (New '.$infomainaccesshis['modulename'].') Transaction Series Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldmodulesuffixcolhis.' To '.$modulesuffixhis.' ) </span>';
}     
}
}
}
}
            $sqlisaccess=mysqli_query($con, "select * from pairmodules where moduletype!='' order by id  asc");
            while($infosaccess=mysqli_fetch_array($sqlisaccess))
            {
                $coltype = preg_replace('/\s+/', '', $infosaccess['moduletype']);
                $moduletypeans=$infosaccess['moduletype'];
                $moduleaccesscol="module".strtolower($coltype);
                $moduleaccess=mysqli_real_escape_string($con, $_POST[$moduleaccesscol]);
                $moduletypecol="moduletype".strtolower($coltype);
                $moduletype=mysqli_real_escape_string($con, $_POST[$moduletypecol]);
                $modulenocol="moduleno".strtolower($coltype);
                $moduleno=mysqli_real_escape_string($con, $_POST[$modulenocol]);
                $moduleprefixcol="moduleprefix".strtolower($coltype);
                $modulesuffixcol="modulesuffix".strtolower($coltype);
                // $prefixsuffixcol="prefixsuffix".strtolower($coltype);
                // $prefixsuffix=mysqli_real_escape_string($con, $_POST[$prefixsuffixcol]);,explode='$prefixsuffix'
                $moduleprefix=mysqli_real_escape_string($con, $_POST[$moduleprefixcol]);
                $modulesuffix=mysqli_real_escape_string($con, $_POST[$modulesuffixcol]);
                $sqlmainaccess = "update pairmainaccess set moduleno='$moduleno',moduleprefix='$moduleprefix',modulesuffix='$modulesuffix' where franchiseid='$id' and moduletype='$moduletypeans'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
            }
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
            if($displayname!=$olddisplayname)
            {
               $franchisenamech=$displayname;
               if($ch!='')
               {
                  $ch.='<br> Display Name <span style="color:green;" id="prohisfromtospan">( From '.$olddisplayname.' To '.$displayname.' ) </span>';
               }
               else
               {
                  $ch.='Display Name <span style="color:green;" id="prohisfromtospan">( From '.$olddisplayname.' To '.$displayname.' ) </span>';
               }              
            }
				if($franchisename!=$oldfranchisename)
				{
					$franchisenamech=$franchisename;
					if($ch!='')
					{
						$ch.='<br> '.$row['franchiseandroles'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldfranchisename.' To '.$franchisename.' ) </span>';
					}
					else
					{
						$ch.=''.$row['franchiseandroles'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldfranchisename.' To '.$franchisename.' ) </span>';
					}					
				}
				if($street!=$oldstreet)
				{
					$franchiseaddressch=$street;
					if($ch!='')
					{
						$ch.='<br> Street <span style="color:green;" id="prohisfromtospan">( From '.$oldstreet.' To '.$street.' ) </span>';
					}
					else
					{
						$ch.='Street <span style="color:green;" id="prohisfromtospan">( From '.$oldstreet.' To '.$street.' ) </span>';
					}					
				}
				if($city!=$oldcity)
				{
					$franchisecitych=$city;
					if($ch!='')
					{
						$ch.='<br> City <span style="color:green;" id="prohisfromtospan">( From '.$oldcity.' To '.$city.' ) </span>';
					}
					else
					{
						$ch.='City <span style="color:green;" id="prohisfromtospan">( From '.$oldcity.' To '.$city.' ) </span>';
					}					
				}
				if($pincode!=$oldpincode)
				{
					$franchisepincodech=$pincode;
					if($ch!='')
					{
						$ch.='<br> Pincode <span style="color:green;" id="prohisfromtospan">( From '.$oldpincode.' To '.$pincode.' ) </span>';
					}
					else
					{
						$ch.='Pincode <span style="color:green;" id="prohisfromtospan">( From '.$oldpincode.' To '.$pincode.' ) </span>';
					}					
				}
				if($state!=$oldstate)
				{
					$franchisestatech=$state;
					if($ch!='')
					{
						$ch.='<br> State <span style="color:green;" id="prohisfromtospan">( From '.$oldstate.' To '.$state.' ) </span>';
					}
					else
					{
						$ch.='State <span style="color:green;" id="prohisfromtospan">( From '.$oldstate.' To '.$state.' ) </span>';
					}					
				}
				if($country!=$oldcountry)
				{
					$franchisecountrych=$country;
					if($ch!='')
					{
						$ch.='<br> Country <span style="color:green;" id="prohisfromtospan">( From '.$oldcountry.' To '.$country.' ) </span>';
					}
					else
					{
						$ch.='Country <span style="color:green;" id="prohisfromtospan">( From '.$oldcountry.' To '.$country.' ) </span>';
					}					
				}
				if($mobile!=$oldmobile)
				{
					$franchisemobilech=$mobile;
					if($ch!='')
					{
						$ch.='<br> '.$row['franchiseandroles'].' Phone <span style="color:green;" id="prohisfromtospan">( From '.$oldmobile.' To '.$mobile.' ) </span>';
					}
					else
					{
						$ch.=''.$row['franchiseandroles'].' Phone <span style="color:green;" id="prohisfromtospan">( From '.$oldmobile.' To '.$mobile.' ) </span>';
					}					
				}
				if($email!=$oldemail)
				{
					$franchiseemailch=$email;
					if($ch!='')
					{
						$ch.='<br> '.$row['franchiseandroles'].' E-mail <span style="color:green;" id="prohisfromtospan">( From '.$oldemail.' To '.$email.' ) </span>';
					}
					else
					{
						$ch.=''.$row['franchiseandroles'].' E-mail <span style="color:green;" id="prohisfromtospan">( From '.$oldemail.' To '.$email.' ) </span>';
					}					
				}
				if($website!=$oldwebsite)
				{
					$franchisewebsitech=$website;
					if($ch!='')
					{
						$ch.='<br> Website <span style="color:green;" id="prohisfromtospan">( From '.$oldwebsite.' To '.$website.' ) </span>';
					}
					else
					{
						$ch.='Website <span style="color:green;" id="prohisfromtospan">( From '.$oldwebsite.' To '.$website.' ) </span>';
					}					
				}
				if($gstno!=$oldgstno)
				{
					$franchisegstch=$gstno;
					if($ch!='')
					{
						$ch.='<br> GSTIN <span style="color:green;" id="prohisfromtospan">( From '.$oldgstno.' To '.$gstno.' ) </span>';
					}
					else
					{
						$ch.='GSTIN <span style="color:green;" id="prohisfromtospan">( From '.$oldgstno.' To '.$gstno.' ) </span>';
					}					
				}
				if($pos!=$oldpos)
				{
					// $franchisegstch=$pos;
					if($ch!='')
					{
						$ch.='<br> Place of Supply <span style="color:green;" id="prohisfromtospan">( From '.$oldpos.' To '.$pos.' ) </span>';
					}
					else
					{
						$ch.='Place of Supply <span style="color:green;" id="prohisfromtospan">( From '.$oldpos.' To '.$pos.' ) </span>';
					}					
				}
            if($dlno20!=$olddlno20)
            {
               // $franchisegstch=$dlno20;
               if($ch!='')
               {
                  $ch.='<br> DL No 20 <span style="color:green;" id="prohisfromtospan">( From '.$olddlno20.' To '.$dlno20.' ) </span>';
               }
               else
               {
                  $ch.='DL No 20 <span style="color:green;" id="prohisfromtospan">( From '.$olddlno20.' To '.$dlno20.' ) </span>';
               }              
            }
            if($dlno21!=$olddlno21)
            {
               // $franchisegstch=$dlno21;
               if($ch!='')
               {
                  $ch.='<br> DL No 21 <span style="color:green;" id="prohisfromtospan">( From '.$olddlno21.' To '.$dlno21.' ) </span>';
               }
               else
               {
                  $ch.='DL No 21 <span style="color:green;" id="prohisfromtospan">( From '.$olddlno21.' To '.$dlno21.' ) </span>';
               }              
            }
            if($bank!=$oldbank)
            {
               // $franchisegstch=$bank;
               if($ch!='')
               {
                  $ch.='<br> Bank <span style="color:green;" id="prohisfromtospan">( From '.$oldbank.' To '.$bank.' ) </span>';
               }
               else
               {
                  $ch.='Bank <span style="color:green;" id="prohisfromtospan">( From '.$oldbank.' To '.$bank.' ) </span>';
               }              
            }
            if($names!=$oldnames)
            {
               // $franchisegstch=$names;
               if($ch!='')
               {
                  $ch.='<br> Name <span style="color:green;" id="prohisfromtospan">( From '.$oldnames.' To '.$names.' ) </span>';
               }
               else
               {
                  $ch.='Name <span style="color:green;" id="prohisfromtospan">( From '.$oldnames.' To '.$names.' ) </span>';
               }              
            }
            if($accountnumber!=$oldaccountnumber)
            {
               // $franchisegstch=$accountnumber;
               if($ch!='')
               {
                  $ch.='<br> Account Number <span style="color:green;" id="prohisfromtospan">( From '.$oldaccountnumber.' To '.$accountnumber.' ) </span>';
               }
               else
               {
                  $ch.='Account Number <span style="color:green;" id="prohisfromtospan">( From '.$oldaccountnumber.' To '.$accountnumber.' ) </span>';
               }              
            }
            if($ifsccode!=$oldifsccode)
            {
               // $franchisegstch=$ifsccode;
               if($ch!='')
               {
                  $ch.='<br> IFSC Code <span style="color:green;" id="prohisfromtospan">( From '.$oldifsccode.' To '.$ifsccode.' ) </span>';
               }
               else
               {
                  $ch.='IFSC Code <span style="color:green;" id="prohisfromtospan">( From '.$oldifsccode.' To '.$ifsccode.' ) </span>';
               }              
            }
            if($branchandcity!=$oldbranchandcity)
            {
               // $franchisegstch=$branchandcity;
               if($ch!='')
               {
                  $ch.='<br> Branch & City <span style="color:green;" id="prohisfromtospan">( From '.$oldbranchandcity.' To '.$branchandcity.' ) </span>';
               }
               else
               {
                  $ch.='Branch & City <span style="color:green;" id="prohisfromtospan">( From '.$oldbranchandcity.' To '.$branchandcity.' ) </span>';
               }              
            }
				// if($invoice!=$oldinvoice)
				// {
				// 	$oldinvoiceans=$oldinvoice;
				// 		$invoiceans=$invoice;
				// 		if ($oldinvoiceans==1) {
				// 			$oldinvoiceansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldinvoiceansfinal='DISABLE';
				// 		}
				// 		if ($invoiceans==1) {
				// 			$invoiceansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$invoiceansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Invoice Access <span style="color:green;" id="prohisfromtospan">( From '.$oldinvoiceansfinal.' To '.$invoiceansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Invoice Access <span style="color:green;" id="prohisfromtospan">( From '.$oldinvoiceansfinal.' To '.$invoiceansfinal.' ) </span>';
				// 	}					
				// }
				// if($invoiceprefix!=$oldinvoiceprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Invoice Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldinvoiceprefix.' To '.$invoiceprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Invoice Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldinvoiceprefix.' To '.$invoiceprefix.' ) </span>';
				// 	}					
				// }
				// if($invoicesuffix!=$oldinvoicesuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Invoice Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldinvoicesuffix.' To '.$invoicesuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Invoice Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldinvoicesuffix.' To '.$invoicesuffix.' ) </span>';
				// 	}					
				// }
				
				
				// if($salesorder!=$oldsalesorder)
				// {
				// 	$oldsalesorderans=$oldsalesorder;
				// 		$salesorderans=$salesorder;
				// 		if ($oldsalesorderans==1) {
				// 			$oldsalesorderansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldsalesorderansfinal='DISABLE';
				// 		}
				// 		if ($salesorderans==1) {
				// 			$salesorderansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$salesorderansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Sales Order Access <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesorderansfinal.' To '.$salesorderansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Sales Order Access <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesorderansfinal.' To '.$salesorderansfinal.' ) </span>';
				// 	}					
				// }
				// if($salesorderprefix!=$oldsalesorderprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Sales Order Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesorderprefix.' To '.$salesorderprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Sales Order Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesorderprefix.' To '.$salesorderprefix.' ) </span>';
				// 	}					
				// }
				// if($salesordersuffix!=$oldsalesordersuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Sales Order Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesordersuffix.' To '.$salesordersuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Sales Order Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesordersuffix.' To '.$salesordersuffix.' ) </span>';
				// 	}					
				// }
				
				// if($quotation!=$oldquotation)
				// {
				// 	$oldquotationans=$oldquotation;
				// 		$quotationans=$quotation;
				// 		if ($oldquotationans==1) {
				// 			$oldquotationansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldquotationansfinal='DISABLE';
				// 		}
				// 		if ($quotationans==1) {
				// 			$quotationansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$quotationansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Quotation Access <span style="color:green;" id="prohisfromtospan">( From '.$oldquotationansfinal.' To '.$quotationansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Quotation Access <span style="color:green;" id="prohisfromtospan">( From '.$oldquotationansfinal.' To '.$quotationansfinal.' ) </span>';
				// 	}					
				// }
				// if($quotationprefix!=$oldquotationprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Quotation Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldquotationprefix.' To '.$quotationprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Quotation Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldquotationprefix.' To '.$quotationprefix.' ) </span>';
				// 	}					
				// }
				// if($quotationsuffix!=$oldquotationsuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Quotation Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldquotationsuffix.' To '.$quotationsuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Quotation Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldquotationsuffix.' To '.$quotationsuffix.' ) </span>';
				// 	}					
				// }
				
				// if($estimate!=$oldestimate)
				// {
				// 	$oldestimateans=$oldestimate;
				// 		$estimateans=$estimate;
				// 		if ($oldestimateans==1) {
				// 			$oldestimateansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldestimateansfinal='DISABLE';
				// 		}
				// 		if ($estimateans==1) {
				// 			$estimateansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$estimateansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Estimate Access <span style="color:green;" id="prohisfromtospan">( From '.$oldestimateansfinal.' To '.$estimateansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Estimate Access <span style="color:green;" id="prohisfromtospan">( From '.$oldestimateansfinal.' To '.$estimateansfinal.' ) </span>';
				// 	}					
				// }
				// if($estimateprefix!=$oldestimateprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Estimate Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldestimateprefix.' To '.$estimateprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Estimate Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldestimateprefix.' To '.$estimateprefix.' ) </span>';
				// 	}					
				// }
				// if($estimatesuffix!=$oldestimatesuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Estimate Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldestimatesuffix.' To '.$estimatesuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Estimate Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldestimatesuffix.' To '.$estimatesuffix.' ) </span>';
				// 	}					
				// }
				
				// if($proforma!=$oldproforma)
				// {
				// 	$oldproformaans=$oldproforma;
				// 		$proformaans=$proforma;
				// 		if ($oldproformaans==1) {
				// 			$oldproformaansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldproformaansfinal='DISABLE';
				// 		}
				// 		if ($proformaans==1) {
				// 			$proformaansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$proformaansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Proforma Invoice Access <span style="color:green;" id="prohisfromtospan">( From '.$oldproformaansfinal.' To '.$proformaansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Proforma Invoice Access <span style="color:green;" id="prohisfromtospan">( From '.$oldproformaansfinal.' To '.$proformaansfinal.' ) </span>';
				// 	}					
				// }
				// if($proformaprefix!=$oldproformaprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Proforma Invoice Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldproformaprefix.' To '.$proformaprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Proforma Invoice Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldproformaprefix.' To '.$proformaprefix.' ) </span>';
				// 	}					
				// }
				// if($proformasuffix!=$oldproformasuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Proforma Invoice Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldproformasuffix.' To '.$proformasuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Proforma Invoice Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldproformasuffix.' To '.$proformasuffix.' ) </span>';
				// 	}					
				// }
				
				// if($salesreturn!=$oldsalesreturn)
				// {
				// 	$oldsalesreturnans=$oldsalesreturn;
				// 		$salesreturnans=$salesreturn;
				// 		if ($oldsalesreturnans==1) {
				// 			$oldsalesreturnansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldsalesreturnansfinal='DISABLE';
				// 		}
				// 		if ($salesreturnans==1) {
				// 			$salesreturnansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$salesreturnansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Sales Return Access <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesreturnansfinal.' To '.$salesreturnansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Sales Return Access <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesreturnansfinal.' To '.$salesreturnansfinal.' ) </span>';
				// 	}					
				// }
				// if($salesreturnprefix!=$oldsalesreturnprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Sales Return Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesreturnprefix.' To '.$salesreturnprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Sales Return Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesreturnprefix.' To '.$salesreturnprefix.' ) </span>';
				// 	}					
				// }
				// if($salesreturnsuffix!=$oldsalesreturnsuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Sales Return Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesreturnsuffix.' To '.$salesreturnsuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Sales Return Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldsalesreturnsuffix.' To '.$salesreturnsuffix.' ) </span>';
				// 	}					
				// }
				
				
				// if($purchaseorder!=$oldpurchaseorder)
				// {
				// 	$oldpurchaseorderans=$oldpurchaseorder;
				// 		$purchaseorderans=$purchaseorder;
				// 		if ($oldpurchaseorderans==1) {
				// 			$oldpurchaseorderansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldpurchaseorderansfinal='DISABLE';
				// 		}
				// 		if ($purchaseorderans==1) {
				// 			$purchaseorderansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$purchaseorderansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Purchase Order Access <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchaseorderansfinal.' To '.$purchaseorderansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Purchase Order Access <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchaseorderansfinal.' To '.$purchaseorderansfinal.' ) </span>';
				// 	}					
				// }
				// if($purchaseorderprefix!=$oldpurchaseorderprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Purchase Order Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchaseorderprefix.' To '.$purchaseorderprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Purchase Order Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchaseorderprefix.' To '.$purchaseorderprefix.' ) </span>';
				// 	}					
				// }
				// if($purchaseordersuffix!=$oldpurchaseordersuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Purchase Order Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchaseordersuffix.' To '.$purchaseordersuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Purchase Order Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchaseordersuffix.' To '.$purchaseordersuffix.' ) </span>';
				// 	}					
				// }
				
				// if($bill!=$oldbill)
				// {
				// 	$oldbillans=$oldbill;
				// 		$billans=$bill;
				// 		if ($oldbillans==1) {
				// 			$oldbillansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldbillansfinal='DISABLE';
				// 		}
				// 		if ($billans==1) {
				// 			$billansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$billansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Bill Access <span style="color:green;" id="prohisfromtospan">( From '.$oldbillansfinal.' To '.$billansfinal.' ) </span>';
				// 		}
				// 	else
				// 	{
				// 		$ch.='New Bill Access <span style="color:green;" id="prohisfromtospan">( From '.$oldbillansfinal.' To '.$billansfinal.' ) </span>';
				// 	}					
				// }
				// if($billprefix!=$oldbillprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Bill Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldbillprefix.' To '.$billprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Bill Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldbillprefix.' To '.$billprefix.' ) </span>';
				// 	}					
				// }
				// if($billsuffix!=$oldbillsuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Bill Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldbillsuffix.' To '.$billsuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Bill Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldbillsuffix.' To '.$billsuffix.' ) </span>';
				// 	}					
				// }
				
				
				// if($job!=$oldjob)
				// {
				// 	$oldjobans=$oldjob;
				// 		$jobans=$job;
				// 		if ($oldjobans==1) {
				// 			$oldjobansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldjobansfinal='DISABLE';
				// 		}
				// 		if ($jobans==1) {
				// 			$jobansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$jobansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Job Access <span style="color:green;" id="prohisfromtospan">( From '.$oldjobansfinal.' To '.$jobansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Job Access <span style="color:green;" id="prohisfromtospan">( From '.$oldjobansfinal.' To '.$jobansfinal.' ) </span>';
				// 	}					
				// }
				// if($jobprefix!=$oldjobprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Job Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldjobprefix.' To '.$jobprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Job Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldjobprefix.' To '.$jobprefix.' ) </span>';
				// 	}					
				// }
				// if($jobsuffix!=$oldjobsuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Job Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldjobsuffix.' To '.$jobsuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Job Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldjobsuffix.' To '.$jobsuffix.' ) </span>';
				// 	}					
				// }
				
				
				
				// if($ledger!=$oldledger)
				// {
				// 	$oldledgerans=$oldledger;
				// 		$ledgerans=$ledger;
				// 		if ($oldledgerans==1) {
				// 			$oldledgeransfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldledgeransfinal='DISABLE';
				// 		}
				// 		if ($ledgerans==1) {
				// 			$ledgeransfinal='ENABLE';
				// 		}
				// 		else{
				// 			$ledgeransfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Journal Access <span style="color:green;" id="prohisfromtospan">( From '.$oldledgeransfinal.' To '.$ledgeransfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Journal Access <span style="color:green;" id="prohisfromtospan">( From '.$oldledgeransfinal.' To '.$ledgeransfinal.' ) </span>';
				// 	}					
				// }
				// if($ledgerprefix!=$oldledgerprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Journal Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldledgerprefix.' To '.$ledgerprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Journal Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldledgerprefix.' To '.$ledgerprefix.' ) </span>';
				// 	}					
				// }
				// if($ledgersuffix!=$oldledgersuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Journal Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldledgersuffix.' To '.$ledgersuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Journal Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldledgersuffix.' To '.$ledgersuffix.' ) </span>';
				// 	}					
				// }
				
				
				
				// if($project!=$oldproject)
				// {
				// 	$oldprojectans=$oldproject;
				// 		$projectans=$project;
				// 		if ($oldprojectans==1) {
				// 			$oldprojectansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldprojectansfinal='DISABLE';
				// 		}
				// 		if ($projectans==1) {
				// 			$projectansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$projectansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Project Access <span style="color:green;" id="prohisfromtospan">( From '.$oldprojectansfinal.' To '.$projectansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Project Access <span style="color:green;" id="prohisfromtospan">( From '.$oldprojectansfinal.' To '.$projectansfinal.' ) </span>';
				// 	}					
				// }			
				// if($projectprefix!=$oldprojectprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Project Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldprojectprefix.' To '.$projectprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Project Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldprojectprefix.' To '.$projectprefix.' ) </span>';
				// 	}					
				// }
				// if($projectsuffix!=$oldprojectsuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Project Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldprojectsuffix.' To '.$projectsuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Project Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldprojectsuffix.' To '.$projectsuffix.' ) </span>';
				// 	}					
				// }
				
				
				// if($deliverychallan!=$olddeliverychallan)
				// {
				// 	$olddeliverychallanans=$olddeliverychallan;
				// 		$deliverychallanans=$deliverychallan;
				// 		if ($olddeliverychallanans==1) {
				// 			$olddeliverychallanansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$olddeliverychallanansfinal='DISABLE';
				// 		}
				// 		if ($deliverychallanans==1) {
				// 			$deliverychallanansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$deliverychallanansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Delivery Challan Access <span style="color:green;" id="prohisfromtospan">( From '.$olddeliverychallanansfinal.' To '.$deliverychallanansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Delivery Challan Access <span style="color:green;" id="prohisfromtospan">( From '.$olddeliverychallanansfinal.' To '.$deliverychallanansfinal.' ) </span>';
				// 	}					
				// }			
				// if($deliverychallanprefix!=$olddeliverychallanprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Delivery Challan Prefix <span style="color:green;" id="prohisfromtospan">( From '.$olddeliverychallanprefix.' To '.$deliverychallanprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Delivery Challan Prefix <span style="color:green;" id="prohisfromtospan">( From '.$olddeliverychallanprefix.' To '.$deliverychallanprefix.' ) </span>';
				// 	}					
				// }
				// if($deliverychallansuffix!=$olddeliverychallansuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Delivery Challan Suffix <span style="color:green;" id="prohisfromtospan">( From '.$olddeliverychallansuffix.' To '.$deliverychallansuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Delivery Challan Suffix <span style="color:green;" id="prohisfromtospan">( From '.$olddeliverychallansuffix.' To '.$deliverychallansuffix.' ) </span>';
				// 	}					
				// }
				
				
				// if($enquiry!=$oldenquiry)
				// {
				// 	$oldenquiryans=$oldenquiry;
				// 		$enquiryans=$enquiry;
				// 		if ($oldenquiryans==1) {
				// 			$oldenquiryansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldenquiryansfinal='DISABLE';
				// 		}
				// 		if ($enquiryans==1) {
				// 			$enquiryansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$enquiryansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Enquiry Access <span style="color:green;" id="prohisfromtospan">( From '.$oldenquiryansfinal.' To '.$enquiryansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Enquiry Access <span style="color:green;" id="prohisfromtospan">( From '.$oldenquiryansfinal.' To '.$enquiryansfinal.' ) </span>';
				// 	}					
				// }			
				// if($enquiryprefix!=$oldenquiryprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Enquiry Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldenquiryprefix.' To '.$enquiryprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Enquiry Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldenquiryprefix.' To '.$enquiryprefix.' ) </span>';
				// 	}					
				// }
				// if($enquirysuffix!=$oldenquirysuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Enquiry Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldenquirysuffix.' To '.$enquirysuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Enquiry Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldenquirysuffix.' To '.$enquirysuffix.' ) </span>';
				// 	}					
				// }
				
				
				// if($purchasereceive!=$oldpurchasereceive)
				// {
				// 	$oldpurchasereceiveans=$oldpurchasereceive;
				// 		$purchasereceiveans=$purchasereceive;
				// 		if ($oldpurchasereceiveans==1) {
				// 			$oldpurchasereceiveansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldpurchasereceiveansfinal='DISABLE';
				// 		}
				// 		if ($purchasereceiveans==1) {
				// 			$purchasereceiveansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$purchasereceiveansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Purchase Receives Access <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereceiveansfinal.' To '.$purchasereceiveansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Purchase Receives Access <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereceiveansfinal.' To '.$purchasereceiveansfinal.' ) </span>';
				// 	}					
				// }			
				// if($purchasereceiveprefix!=$oldpurchasereceiveprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Purchase Receives Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereceiveprefix.' To '.$purchasereceiveprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Purchase Receives Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereceiveprefix.' To '.$purchasereceiveprefix.' ) </span>';
				// 	}					
				// }
				// if($purchasereceivesuffix!=$oldpurchasereceivesuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Purchase Receives Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereceivesuffix.' To '.$purchasereceivesuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Purchase Receives Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereceivesuffix.' To '.$purchasereceivesuffix.' ) </span>';
				// 	}					
				// }
				
				
				
				
				// if($purchasereturn!=$oldpurchasereturn)
				// {
				// 	$oldpurchasereturnans=$oldpurchasereturn;
				// 		$purchasereturnans=$purchasereturn;
				// 		if ($oldpurchasereturnans==1) {
				// 			$oldpurchasereturnansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$oldpurchasereturnansfinal='DISABLE';
				// 		}
				// 		if ($purchasereturnans==1) {
				// 			$purchasereturnansfinal='ENABLE';
				// 		}
				// 		else{
				// 			$purchasereturnansfinal='DISABLE';
				// 		}
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> New Purchase Return Access <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereturnansfinal.' To '.$purchasereturnansfinal.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='New Purchase Return Access <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereturnansfinal.' To '.$purchasereturnansfinal.' ) </span>';
				// 	}					
				// }
				// if($purchasereturnprefix!=$oldpurchasereturnprefix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Purchase Return Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereturnprefix.' To '.$purchasereturnprefix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Purchase Return Prefix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereturnprefix.' To '.$purchasereturnprefix.' ) </span>';
				// 	}					
				// }
				// if($purchasereturnsuffix!=$oldpurchasereturnsuffix)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Purchase Return Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereturnsuffix.' To '.$purchasereturnsuffix.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Purchase Return Suffix <span style="color:green;" id="prohisfromtospan">( From '.$oldpurchasereturnsuffix.' To '.$purchasereturnsuffix.' ) </span>';
				// 	}					
				// }
			     
                 // , franchisenamech='$franchisenamech',franchiseaddressch='$franchiseaddressch',city='$franchisecitych',pincode='$franchisepincodech',state='$franchisestatech',country='$franchisecountrych',franchisephonech='$franchisemobilech',franchiseemailch='$franchiseemailch',franchisewebsitech='$franchisewebsitech',franchisegstch='$franchisegstch'

			
				
				if($ch!='')
				{
				$sqlhis=mysqli_query($con,"insert pairusehistory set usetype='FRANCHISE', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='".$ch." '");
				}
		
				header("Location: franchiseview.php?id=".$id."&remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: franchises.php?error=This record is Not Found! Kindly check in All ".$row['franchiseandroles']." and Roles List");
			}
	}
	else
			{
				header("Location: franchises.php?error=Error Data");
			}
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
?>
  <title>
    Edit <?= $row['franchiseandroles'] ?>
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
     ?>
       <div style="max-width: 1650px;">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;z-index: 0;">

 <p class="mb-3"  style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 20px;"><i class="fa fa-pencil-square-o"></i> Edit <?= $row['franchiseandroles'] ?></p>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<?php
	$oldarray=array( 'bank','names','accountnumber','ifsccode','branchandcity','dlno20','dlno21','displayname','franchisename', 'street', 'city', 'pincode', 'state', 'country', 'mobile', 'email', 'website', 'gstno', 'invoice', 'invoiceprefix', 'invoicesuffix', 'estimate', 'estimateprefix', 'estimatesuffix', 'quotation', 'quotationprefix', 'quotationsuffix', 'salesorder', 'salesorderprefix', 'salesordersuffix', 'bill', 'billprefix', 'billsuffix', 'purchaseorder', 'purchaseorderprefix', 'purchaseordersuffix', 'proforma', 'proformaprefix', 'proformasuffix', 'salesreturn', 'salesreturnprefix', 'salesreturnsuffix', 'purchasereturn', 'purchasereturnprefix', 'purchasereturnsuffix', 'job', 'jobprefix', 'jobsuffix', 'ledger', 'ledgerprefix', 'ledgersuffix', 'project', 'projectprefix', 'projectsuffix' , 'deliverychallan', 'deliverychallanprefix', 'deliverychallansuffix' , 'enquiry', 'enquiryprefix', 'enquirysuffix' , 'purchasereceive', 'purchasereceiveprefix', 'purchasereceivesuffix','pos' );
	foreach($oldarray as $oldinfo)
	{
	?>
	<input type="hidden" name="old<?=$oldinfo?>" value="<?=$info[$oldinfo]?>">
	<?php
	}
	?>
	
<input type="hidden" name="id" value="<?=$info['id']?>">
<div class="accordion" id="accordionRental">
          <div class="accordion-item mb-1" <?=((($access['branchinfohead']=='0')&&($access['branchinfoedit']=='0'))?'style="display:none;"':'')?>>
            <h5 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-size:18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Details</a>	
             
				</div> 
                
              </button>
            </h5>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"  style="">
              <div class="accordion-body text-sm">
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="branch-image1" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Print Logo</label>
            </div>
            <div class="col-sm-8">
              <?php
if($info['branchimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Branch Pic" src="<?=str_replace('../ups','ups',$img)?>" id="branch-image1" style="height: 30px !important;width: 30px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>


        <img alt="Branch Pic" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="branch-image1" style="height: 30px !important;width: 30px !important;">

    <?php
}
?>
<input id="branch-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="branchimage" name="branchimage[]" accept="image/*" onchange="previewLogo()" >
<input type="hidden" name="branchimages" value="<?= $info['branchimage'] ?>">
<span style="color:#4285F4; cursor:pointer"  id="branch-image2"> Upload Photo </span>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="sign-image1" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Authorized Signature</label>
            </div>
            <div class="col-sm-8">
              <?php
if($info['signimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Sign Pic" src="<?=str_replace('../ups','ups',$img)?>" id="sign-image1" style="height: 30px !important;width: 30px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>


        <img alt="Sign Pic" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="sign-image1" style="height: 30px !important;width: 30px !important;">

    <?php
}
?>
<input id="sign-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="signimage" name="signimage[]" accept="image/*" onchange="previewSign()" >
<input type="hidden" name="signimages" value="<?= $info['signimage'] ?>">
<span style="color:#4285F4; cursor:pointer"  id="sign-image2"> Upload Photo </span>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="scanqr-image1" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Scanner QR Code</label>
            </div>
            <div class="col-sm-4">
              <?php
if($info['qrcode']!='')
{
    $imgs=explode(',',$info['qrcode']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Scanner QR Code" src="<?=str_replace('../ups','ups',$img)?>" id="scanqr-image1" style="height: 30px !important;width: 30px !important;">
    <?php
    }
}
else
{
    ?>
        <img alt="Scanner QR Code" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="scanqr-image1" style="height: 30px !important;width: 30px !important;">
    <?php
}
?>
<input id="scanqr-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="scanqrimage" name="scanqrimage[]" accept="image/*" onchange="previewscanqr()" >
<input type="hidden" name="scanqrimages" value="<?= $info['qrcode'] ?>">
<span style="color:#4285F4; cursor:pointer"  id="scanqr-image2"> Upload Photo </span>
            </div>
            <div class="col-sm-4">
                <div class="custom-control custom-checkbox" onclick="upiidaccess()">
                    <input type="checkbox" class="custom-control-input" name="upiidaccess" id="upiidaccess" <?=(($info['upiid']!='')?'checked':'')?>>
                    <label class="custom-control-label custom-label" for="upiidaccess" style="width:max-content !important;color: black;">
                        Enable Upi Id For Qr Code
                    </label>
                </div>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center" style="<?=(($info['upiid']!='')?'':'display: none;')?>" id="upicontainer">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="upiid" class="custom-label"><span class="text-danger">Upi Id *</span></label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="text" class="form-control  form-control-sm" id="upiid" name="upiid" placeholder="Upi Id" value="<?=$info['upiid']?>" <?=(($info['upiid']!='')?'required':'')?>>
            </div>
          </div>
    </div>
</div>
              	<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="displayname" class="custom-label"><span class="text-danger">Display Name *</span></label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="text" class="form-control  form-control-sm" id="displayname" name="displayname" placeholder="Display Name" value="<?=$info['displayname']?>" required>
            </div>
          </div>
    </div>
</div>
	<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="franchisename" class="custom-label"><span class="text-danger"><?= $row['franchiseandroles'] ?> Name *</span></label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="text" class="form-control  form-control-sm" id="franchisename" name="franchisename" placeholder="<?= $row['franchiseandroles'] ?> Name" value="<?=$info['franchisename']?>" required>
            </div>
          </div>
    </div>
</div>
	<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="franchisename" class="custom-label"><?= $row['franchiseandroles'] ?> Address</label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="text" class="form-control  form-control-sm" id="street" name="street" placeholder="Street" value="<?=$info['street']?>">
			  
            </div>
			</div>
		 <div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
			<div class="form-group">
              <input type="text" class="form-control  form-control-sm" id="city" name="city" placeholder="City" value="<?=$info['city']?>">
			  </div>
            </div>
			<div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
			<div class="form-group">
			<input type="text" class="form-control  form-control-sm" id="pincode" name="pincode" placeholder="Pin Code" value="<?=$info['pincode']?>">
			</div>
            </div>
          </div>
		  <div class=" row">
			<div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
			</div>
			<div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
			<div class="form-group">
              <input type="text" class="form-control  form-control-sm" id="state" name="state" placeholder="State" value="<?=$info['state']?>">
			  </div>
            </div>
			<div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
			<div class="form-group">
              <input type="text" class="form-control  form-control-sm" id="country" name="country" placeholder="Country" value="<?=$info['country']?>">
			  </div>
            </div>
          </div>
		  <div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="mobile" class="custom-label"><?= $row['franchiseandroles'] ?> Phone</label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="text" class="form-control  form-control-sm" id="mobile" name="mobile" placeholder="<?= $row['franchiseandroles'] ?> Phone" value="<?=$info['mobile']?>">			  
            </div>
			</div>
			 <div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="email" class="custom-label"><?= $row['franchiseandroles'] ?> E-mail</label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="email" class="form-control  form-control-sm" id="email" name="email" placeholder="<?= $row['franchiseandroles'] ?> E-mail" value="<?=$info['email']?>">			  
            </div>
			</div>
			
			<div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="website" class="custom-label">Website</label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="text" class="form-control  form-control-sm" id="website" name="website" placeholder="Website" value="<?=$info['website']?>">
			  
            </div>
			</div>
			<div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="gstno" class="custom-label">GSTIN</label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="text" class="form-control  form-control-sm" id="gstno" name="gstno" placeholder="GSTIN" value="<?=$info['gstno']?>">
			  
            </div>
			</div>
			<div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="custom-label text-danger" for="pos">Place Of Supply *</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                               
		<select name="pos" id="pos" class="form-control  form-control-sm select4" required>
<option value="JAMMU AND KASHMIR (1)" <?=($info['pos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($info['pos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($info['pos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($info['pos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($info['pos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($info['pos']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($info['pos']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($info['pos']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($info['pos']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($info['pos']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($info['pos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($info['pos']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($info['pos']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($info['pos']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($info['pos']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($info['pos']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($info['pos']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($info['pos']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($info['pos']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($info['pos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($info['pos']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($info['pos']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($info['pos']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($info['pos']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($info['pos']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($info['pos']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($info['pos']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($info['pos']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($info['pos']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($info['pos']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($info['pos']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($info['pos']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($info['pos']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($info['pos']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($info['pos']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($info['pos']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($info['pos']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($info['pos']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($info['pos']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>																	   
																			   
																			   
                                                                            </div>
                                                                        </div>
<div class="form-group row" <?=(($access['dlnotwohead']=='0'&&($access['dlnotwoedit']=='0'))?'style="display:none;"':'')?>>
<div class="col-sm-4">
<label for="dlno20" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">DL No 20</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="dlno20" name="dlno20" placeholder="DL No 20" value="<?=$info['dlno20']?>">
</div>
</div>
<div class="form-group row" <?=(($access['dlnotonehead']=='0'&&($access['dlnotoneedit']=='0'))?'style="display:none;"':'')?>>
<div class="col-sm-4">
<label for="dlno21" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">DL No 21</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="dlno21" name="dlno21" placeholder="DL No 21" value="<?=$info['dlno21']?>">
</div>
</div>
			
			
    </div>
</div>

			   
              </div>
            </div>
          </div>

<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingBank">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBank" aria-expanded="true" aria-controls="collapseBank">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading" style="font-size:18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Bank Details</a> 
</div>          
</button>
</h5>
<div id="collapseBank" class="accordion-collapse collapse show" aria-labelledby="headingBank"  style="">
<div class="accordion-body text-sm">

<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="bank" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Bank</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="bank" name="bank" placeholder="Bank" value="<?=$info['bank']?>">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="names" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Name</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="names" name="names" placeholder="Name" value="<?=$info['names']?>">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="accountnumber" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Account Number</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="accountnumber" name="accountnumber" placeholder="Account Number" value="<?=$info['accountnumber']?>">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="ifsccode" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">IFSC Code</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="ifsccode" name="ifsccode" placeholder="IFSC Code" value="<?=$info['ifsccode']?>">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="branchandcity" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Branch & City</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="branchandcity" name="branchandcity" placeholder="Branch & City" value="<?=$info['branchandcity']?>">
</div>
</div>
</div>
</div>

</div>
</div>
</div>
		  
        <?php
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if ((($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']!=0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']!=0))) {
?>
		  <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingTwo">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Roles</a>	
				</div> 
                
              </button>
            </h5>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"  style="">
              <div class="accordion-body text-sm">
<!-- 
<?php
$sqlisaccess=mysqli_query($con, "select * from pairmodules order by id  asc");
while($infosaccess=mysqli_fetch_array($sqlisaccess))
{
    $coltype = preg_replace('/\s+/', '', $infosaccess['moduletype']);
    $moduletypeans=$infosaccess['moduletype'];
?>
<?php
$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where franchiseid='$id' and moduletype='$moduletypeans' ORDER BY ordering ASC");
$infomainaccess=mysqli_fetch_array($sqlismainaccess);
if ($infomainaccess['moduleaccess']==1) {
?>
<input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
<input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
<div class="row" style="align-items: end; border-top:1px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
<div class="col-lg-2 p-0">
    
    <div class="tree ">
        
<ul style="padding-left:0; margin-bottom:0">
    <li><span><?= $infosaccess['grouptype'] ?></span>
        <ul>
            <li><span><?= $infomainaccess['modulename'] ?></span>
                <ul>
                <li style="font-size:10px;"><span>New <?= $infomainaccess['modulename'] ?> </span></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
</div>

</div>
<div class="col-lg-10 px-0">


   
<div class="row align-items-center mt-2">
<div class="col-lg-2 pe-0"> 
    <div class="form-check">
    
      <input class="form-check-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenono<?=strtolower($coltype)?>" value="0" <?= ($infomainaccess['moduleno']=='0')?'checked':''?>> 
<label class="form-check-label" for="modulenono<?=strtolower($coltype)?>">No Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
    </div>
<div class="col-lg-2 p-0" id="fulla">   
    <div class="form-check">    
      <input class="form-check-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenofull<?=strtolower($coltype)?>" value="1" <?= ($infomainaccess['moduleno']=='1')?'checked':''?>>
<label class="form-check-label" for="modulenofull<?=strtolower($coltype)?>">Full Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
  </div>

<?php
$sqlismainaccesspresuf=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='$moduletypeans' ORDER BY ordering ASC");
$infomainaccesspresuf=mysqli_fetch_array($sqlismainaccesspresuf);
if ($infomainaccesspresuf['explode']==0) {
    ?>
  <div class="col-lg-2" style="background-color:#F7F7F7; height:42px; align-item:middle; margin-right:-10px;">  
    <label for="moduleno<?=strtolower($coltype)?>" class="custom-label" style="margin-top: 0.7rem; margin-left:0rem;font-size: 0.8rem;">Transaction Series</label>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:5px 0">   
    <input type="text" class="form-control  form-control-sm myinput" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" placeholder="Prefix (Static Characters E.g. INV-)" value="<?= $infomainaccess['moduleprefix'] ?>">
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:5px 0">   
    <input type="number" class="form-control  form-control-sm myinput" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" placeholder="Suffix (Automatic Numbering E.g. 001)" style="width:98%" value="<?= $infomainaccess['modulesuffix'] ?>">
  </div>
  <?php
}
else{
    ?>
    <input type="hidden" class="form-control  form-control-sm myinput" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" value="">
    <input type="hidden" class="form-control  form-control-sm myinput" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" value="">
    <?php
}
?>
</div>
 
  </div>
  
</div>
<?php
}
else{
?>
<input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
<input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
<input type="hidden" name="moduleno<?=strtolower($coltype)?>" id="moduleno<?=strtolower($coltype)?>" value="0">
<input type="hidden" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" value="">
<input type="hidden" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" value="">
<?php
}
}
?> -->
<div class="row" style=" border-top:2px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-12">
            <label class="custom-label mt-2" style="color:royalblue !important;"><span style="margin-left: -6px !important;"><?= $row['books'] ?></span></label>
            </div>
            </div>
            <?php
$sqlmain = mysqli_query($con,"select distinct grouptype,groupname,groupaccess from pairmainaccess where userid='$userid' and moduletype!=''");
while($sqlmainresult = mysqli_fetch_array($sqlmain)){
    $grouptype = preg_replace('/\s+/', '', $sqlmainresult['grouptype']);
    $maingrouptype=$sqlmainresult['grouptype'];
    if ($sqlmainresult['groupaccess']=='1') {
?>
<div class="row" style=" border-top:1px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
<div class="col-lg-2">
<label class="custom-label mt-2" style="margin-left: 12.3px;color: royalblue !important;"><?=$sqlmainresult['groupname']?></label>
</div>
</div>
<?php
}
$sqlismainaccess=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype,moduleno,moduleprefix,modulesuffix,groupaccess,groupname from pairmainaccess where franchiseid='$id' and (grouptype='$maingrouptype' and moduletype!='') ORDER BY ordering ASC");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and (grouptype='$maingrouptype' and moduletype='".$infomainaccess['moduletype']."') ORDER BY ordering ASC");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if(($infomainaccess['moduleaccess']==1)&&((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessview']==1||$infomainaccessuser['useraccesscreate']==1||$infomainaccessuser['useraccessedit']==1||$infomainaccessuser['useraccessdelete']==1)))) {
?>
<input type="hidden" name="group<?=strtolower($coltype)?>" id="group<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupaccess'] ?>">
<input type="hidden" name="grouptype<?=strtolower($coltype)?>" id="grouptype<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupname'] ?>">
<input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
<input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
            <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left:18px;">
            <div class="col-lg-2">
                        <label class="custom-label"> <?= $infomainaccess['modulename']; ?> (New <?= $infomainaccess['modulename'] ?>)</label>
                      </div>
            <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-3 my-1"> 
    <div class="custom-control custom-radio mr-sm-2">
    
      <input class="custom-control-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenono<?=strtolower($coltype)?>" value="0" <?= ($infomainaccess['moduleno']=='0')?'checked':''?>> 
<label class="custom-control-label custom-label" for="modulenono<?=strtolower($coltype)?>">No Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
    </div>
    <div class="col-lg-3 my-1" id="fulla">   
    <div class="custom-control custom-radio mr-sm-2">    
      <input class="custom-control-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenofull<?=strtolower($coltype)?>" value="1" <?= ($infomainaccess['moduleno']=='1')?'checked':''?>>
<label class="custom-control-label custom-label" for="modulenofull<?=strtolower($coltype)?>">Full Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
  </div>

                  </div>
            </div>
            </div>
            <!-- <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left:18px;">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10">
            <div class="row">
 <div class="col-lg-3 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input implode" name="prefixsuffix<?=strtolower($coltype)?>" id="implode<?=strtolower($coltype)?>" value="0" <?= ($infomainaccess['explode']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="implode<?=strtolower($coltype)?>">Implode Prefix Suffix</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-3 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input explode" name="prefixsuffix<?=strtolower($coltype)?>" id="explode<?=strtolower($coltype)?>" value="1" <?= ($infomainaccess['explode']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="explode<?=strtolower($coltype)?>">Explode Prefix Suffix</label>
                      </div>
                      
                      </div>
                  </div>
            </div>
            </div> -->
             <?php
                        if ($coltype=='Products') {
                            $placeholderforprefix = 'PRO';
                        }
                        elseif ($coltype=='Services') {
                            $placeholderforprefix = 'SERV';
                        }
                        elseif ($coltype=='InventoryAdjustments') {
                            $placeholderforprefix = 'INVADJ';
                        }
                        elseif ($coltype=='Customers') {
                            $placeholderforprefix = 'CUS';
                        }
                        elseif ($coltype=='Enquiries') {
                            $placeholderforprefix = 'ENQ';
                        }
                        elseif ($coltype=='Quotations') {
                            $placeholderforprefix = 'QUO';
                        }
                        elseif ($coltype=='Estimates') {
                            $placeholderforprefix = 'EST';
                        }
                        elseif ($coltype=='ProformaInvoices') {
                            $placeholderforprefix = 'PROINV';
                        }
                        elseif ($coltype=='Jobs') {
                            $placeholderforprefix = 'JOB';
                        }
                        elseif ($coltype=='SalesOrders') {
                            $placeholderforprefix = 'SOR';
                        }
                        elseif ($coltype=='DeliveryChallans') {
                            $placeholderforprefix = 'DLC';
                        }
                        elseif ($coltype=='Invoices') {
                            $placeholderforprefix = 'INV';
                        }
                        elseif ($coltype=='Paymentsreceived') {
                            $placeholderforprefix = 'PMR';
                        }
                        elseif ($coltype=='SalesReturns') {
                            $placeholderforprefix = 'SLR';
                        }
                        elseif ($coltype=='CustomerRefunds') {
                            $placeholderforprefix = 'CRE';
                        }
                        elseif ($coltype=='Vendors') {
                            $placeholderforprefix = 'VEN';
                        }
                        elseif ($coltype=='PurchaseOrders') {
                            $placeholderforprefix = 'PUO';
                        }
                        elseif ($coltype=='PurchaseReceives') {
                            $placeholderforprefix = 'PUR';
                        }
                        elseif ($coltype=='Bills') {
                            $placeholderforprefix = 'BIL';
                        }
                        elseif ($coltype=='PaymentsMade') {
                            $placeholderforprefix = 'PYM';
                        }
                        elseif ($coltype=='PurchaseReturns') {
                            $placeholderforprefix = 'PRT';
                        }
                        elseif ($coltype=='VendorRefunds') {
                            $placeholderforprefix = 'VRE';
                        }
                        elseif ($coltype=='ManualJournals') {
                            $placeholderforprefix = 'MJS';
                        }
                        elseif ($coltype=='ChartofAccounts') {
                            $placeholderforprefix = 'CAC';
                        }
                        elseif ($coltype=='Projects') {
                            $placeholderforprefix = 'PRJ';
                        }
                        elseif ($coltype=='Timesheet') {
                            $placeholderforprefix = 'TSH';
                        }
                        ?>
            <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left:18px;">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-2" style="background-color:#F7F7F7;  align-item:middle; margin-right:-10px;">    
    <label for="moduleno<?=strtolower($coltype)?>" class="custom-label" style="margin-top: 1rem; margin-left:0rem;font-size: 0.8rem;">Transaction Series</label>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:12px 0">   
    <input type="text" class="form-control  form-control-sm myinput" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" placeholder="Prefix (Static Characters E.g. <?= $placeholderforprefix ?>-)" value="<?= $infomainaccess['moduleprefix']?>" maxlength="90">
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:12px 0px 15px 0px">   
    <input type="number" class="form-control  form-control-sm myinput" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" placeholder="Suffix (Automatic Numbering E.g. 0)" value="<?= $infomainaccess['modulesuffix']?>">
  </div>
                  </div>
            </div>
            </div>
<?php
}
else{
?>
<input type="hidden" name="group<?=strtolower($coltype)?>" id="group<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupaccess'] ?>">
<input type="hidden" name="grouptype<?=strtolower($coltype)?>" id="grouptype<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupname'] ?>">
<input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
<input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
<input type="hidden" name="moduleno<?=strtolower($coltype)?>" id="moduleno<?=strtolower($coltype)?>" value="0">
<!-- <input type="hidden" name="prefixsuffix<?=strtolower($coltype)?>" id="implode<?=strtolower($coltype)?>" value="0"> -->
<input type="hidden" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" value="">
<input type="hidden" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" value="0">  
<?php
}
}
}
?><div class="row" style=" border-top:1px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
</div>
  
</div>
</div>
</div>
<?php
}
?>


  </div>

			   
              <!-- </div> -->
			  
			  <div class="row justify-content-center" style="margin-bottom: -14px;">
    <div class="col-lg-12"><hr>
        <button name="submit" 
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Save"
                                                            style="margin-bottom: 15px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>
                                                        <a class="btn btn-primary btn-sm btn-custom-grey " href="franchises.php" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Cancel</a>
    </div>
</div>
            </div>
          </div>
</div>
</div>





</form>

			 
            </div>
          </div>

	  <?php
	  include('footer.php');
	  ?>
    </div>
  
	</main>
 <?php
 include('fexternals.php');
 ?>
<script>
 function previewLogo() {
  var preview = document.getElementById('branch-image1');
  var file    = document.getElementById('branch-image-upload').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
                      $(function() {
            $('#branch-image1').on('click', function() {
                $('#branch-image-upload').click();
            });
            $('#branch-image2').on('click', function() {
                $('#branch-image-upload').click();
            });
        });
 function previewSign() {
  var preview = document.getElementById('sign-image1');
  var file    = document.getElementById('sign-image-upload').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
                      $(function() {
            $('#sign-image1').on('click', function() {
                $('#sign-image-upload').click();
            });
            $('#sign-image2').on('click', function() {
                $('#sign-image-upload').click();
            });
        });
 function previewscanqr() {
  var preview = document.getElementById('scanqr-image1');
  var file    = document.getElementById('scanqr-image-upload').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
function upiidaccess(){
    if(document.getElementById("upiidaccess").checked){
        document.getElementById('upicontainer').style.display = 'flex';
        document.getElementById('upiid').required = true;
        document.getElementById('upiid').value = '';
    }
    else{
        document.getElementById('upicontainer').style.display = 'none';
        document.getElementById('upiid').required = false;
        document.getElementById('upiid').value = '';
    }
}
                      $(function() {
            $('#scanqr-image1').on('click', function() {
                $('#scanqr-image-upload').click();
            });
            $('#scanqr-image2').on('click', function() {
                $('#scanqr-image-upload').click();
            });
        });
        
</script>






</body>

</html>
<?php
}
else
{
	header("Location: franchises.php?error=No Information Found");
}
}
else
{
	header("Location: franchises.php?remarks= ".$row['franchiseandroles']." Changed Successfully");
}
?>