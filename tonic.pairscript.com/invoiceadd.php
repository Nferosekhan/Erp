<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE

$sqlismainaccessfields=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype=? ORDER BY id ASC");
$invmodtype = 'Invoices';
$sqlismainaccessfields->bind_param("is", $companymainid,$invmodtype);
$sqlismainaccessfields->execute();
$sqlismainaccessfield = $sqlismainaccessfields->get_result();

while($infomainaccessfield=$sqlismainaccessfield->fetch_assoc()){
	$coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
	$add = $infomainaccessfield['modulefieldcreate'];
	$fieldadd = explode(',',$add);
	$edit = $infomainaccessfield['modulefieldedit'];
	$fieldedit = explode(',',$edit);
	$view = $infomainaccessfield['modulefieldview'];
	$fieldview = explode(',',$view);
}
$sqlismainaccessfield->close();
$sqlismainaccessfields->close();
//FOR CHECK THE THIS FILES PREFERENCE FIELDS ARE ON OR OFF

// This is for Restriction of Pages
$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype=? ORDER BY id ASC");
$sqlismainaccessusers->bind_param("is", $userid,$invmodtype);
$sqlismainaccessusers->execute();
$sqlismainaccessuser = $sqlismainaccessusers->get_result();
$infomainaccessuser=$sqlismainaccessuser->fetch_assoc();
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccesscreate']==0)))) {
	header('Location:dashboard.php');
}
$sqlismainaccessuser->close();
$sqlismainaccessusers->close();
//FOR CHECK THE THIS FILES ACCESSES ARE ALLOW OR NOT

$sesunqwerty = $_SESSION['unqwerty'];
$sqlprefer=$con->prepare("SELECT * FROM paircontrols WHERE (username = ? OR usernewname = ?)");
$sqlprefer->bind_param("ss", $sesunqwerty,$sesunqwerty);
$sqlprefer->execute();
$resultprefer = $sqlprefer->get_result();
$sidebarprefer=$resultprefer->fetch_assoc();
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&($sidebarprefer['permissionsidebooks']==0))||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
	header('location:dashboard.php');
}
$resultprefer->close();
$sqlprefer->close();
//FOR CHECK THE THIS FILES BACKENDS CONTROL ACCESSES ARE ON OR OFF

if(isset($_POST['grandtotal'])){
	date_default_timezone_set('Asia/Calcutta');
	if (($infomainaccessuser['invoicecustinfo']=='defone')||($infomainaccessuser['invoicecustinfo']=='deftwo')){
		$scriptonetwo = htmlspecialchars($_POST['customerinfodefault'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$scriptonetwo = 'three';
	}
	//FOR CHECK THE TYPE B2C OR B2B
	$createdon=date('Y-m-d H:i:s');
	$dlno20 = '';
	$dlno21 = '';
	if (($infomainaccessuser['invoicecustinfo']=='one')||($scriptonetwo=='one')) {

		$customername = htmlspecialchars($_POST['customername'], ENT_QUOTES, 'UTF-8');
		$customerid = htmlspecialchars($_POST['customerid'], ENT_QUOTES, 'UTF-8');
		$dlno20 = htmlspecialchars( $_POST['dlno20'], ENT_QUOTES, 'UTF-8');
		$dlno21 = htmlspecialchars( $_POST['dlno21'], ENT_QUOTES, 'UTF-8');
		$address1 = htmlspecialchars($_POST['address1'], ENT_QUOTES, 'UTF-8');
		$address2 = htmlspecialchars($_POST['address2'], ENT_QUOTES, 'UTF-8');
		$saddress1 = htmlspecialchars($_POST['saddress1'], ENT_QUOTES, 'UTF-8');
		$saddress2 = htmlspecialchars($_POST['saddress2'], ENT_QUOTES, 'UTF-8');
		$gstno = htmlspecialchars($_POST['gstgstin'], ENT_QUOTES, 'UTF-8');
		$pos = htmlspecialchars($_POST['pos'], ENT_QUOTES, 'UTF-8');
		$twoworkphone = htmlspecialchars($_POST['workworkphone'], ENT_QUOTES, 'UTF-8');
		$twomobilephone = htmlspecialchars($_POST['workmobile'], ENT_QUOTES, 'UTF-8');
		$twosameasbilling = htmlspecialchars(0, ENT_QUOTES, 'UTF-8');

		if(isset($_POST['gstgstrtype'])){
			$gstrtype = htmlspecialchars($_POST['gstgstrtype'], ENT_QUOTES, 'UTF-8');
		}
		else{
			$gstrtype='';
		}
	//FOR B2B PROCESS
	}
	else{
		$gstrtype = htmlspecialchars($_POST['twogsttreatment'], ENT_QUOTES, 'UTF-8');
	//FOR B2C PROCESS 
	}

	if($access['definvpay']=='split'){
		$invoiceterm = 'CASH,CARD,GPAY';
	}
	else{
		$invoiceterm = htmlspecialchars($_POST['invoiceterm'], ENT_QUOTES, 'UTF-8');
	}

	$franchsess = $_SESSION['franchisesession'];
	$sqlismainaccessusers=$con->prepare("SELECT moduleno, moduleprefix, modulesuffix FROM pairmainaccess WHERE franchiseid=? AND moduletype=? ORDER BY id ASC");
	$sqlismainaccessusers->bind_param("is", $franchsess,$invmodtype);
	$sqlismainaccessusers->execute();
	$sqlismainaccessuser = $sqlismainaccessusers->get_result();
	$infomainaccessuser=$sqlismainaccessuser->fetch_assoc();
	$sqlismainaccessuser->close();
	$sqlismainaccessusers->close();

	$invoiceno = htmlspecialchars($infomainaccessuser['moduleprefix'].(str_pad($infomainaccessuser['modulesuffix']+1, 0, "0", STR_PAD_LEFT)), ENT_QUOTES, 'UTF-8');
	//FOR GET THE CURRENT INVOICE NO 
   $ordering = (str_pad($infomainaccessuser['modulesuffix']+1, 0, "0", STR_PAD_LEFT));
	$invoicedate = htmlspecialchars($_POST['invoicedate'], ENT_QUOTES, 'UTF-8');
	$invoicetime = htmlspecialchars($_POST['invoicetime'], ENT_QUOTES, 'UTF-8');
	$cashreceived = htmlspecialchars( (($_POST['cashreceived']!='')?$_POST['cashreceived']:0), ENT_QUOTES, 'UTF-8');
	$cardreceived = htmlspecialchars( (($_POST['cardreceived']!='')?$_POST['cardreceived']:0), ENT_QUOTES, 'UTF-8');
	$gpayreceived = htmlspecialchars( (($_POST['gpayreceived']!='')?$_POST['gpayreceived']:0), ENT_QUOTES, 'UTF-8');
	$duedate = htmlspecialchars($_POST['duedate'], ENT_QUOTES, 'UTF-8');
	$duedates = htmlspecialchars(((isset($_POST['duedates']))?$_POST['duedates']:''), ENT_QUOTES, 'UTF-8');
	$orderdcno="";

	if ((in_array('Sale Person', $fieldadd))) {
		if(isset($_POST['saleperson'])){
			$saleperson = htmlspecialchars($_POST['saleperson'], ENT_QUOTES, 'UTF-8');
		}
		else{
			$saleperson='';
		}
	}
	else{
			$saleperson='';
	}
	if ((in_array('Reference', $fieldadd))) {
		$reference = htmlspecialchars($_POST['reference'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$reference='';
	}

	$totalitems = htmlspecialchars($_POST['totalitems'], ENT_QUOTES, 'UTF-8');
	$totalvatamount = htmlspecialchars($_POST['totalvatamount'], ENT_QUOTES, 'UTF-8');
	$totalamount = htmlspecialchars($_POST['totalamount'], ENT_QUOTES, 'UTF-8');
	$discount = htmlspecialchars($_POST['discount'], ENT_QUOTES, 'UTF-8');
	$totalquantity = htmlspecialchars($_POST['totalquantity'], ENT_QUOTES, 'UTF-8');
	$discounttype = htmlspecialchars($_POST['discounttype'], ENT_QUOTES, 'UTF-8');
	$discountamount = htmlspecialchars($_POST['discountamount'], ENT_QUOTES, 'UTF-8');
	$freightamount = htmlspecialchars($_POST['freightamount'], ENT_QUOTES, 'UTF-8');
	$roundoff = htmlspecialchars($_POST['roundoff'], ENT_QUOTES, 'UTF-8');
	$grandtotal = htmlspecialchars($_POST['grandtotal'], ENT_QUOTES, 'UTF-8');
	$invoiceamount = htmlspecialchars($_POST['grandtotal'], ENT_QUOTES, 'UTF-8');
	$preparedby = htmlspecialchars($_POST['preparedby'], ENT_QUOTES, 'UTF-8');
	$checkedby = htmlspecialchars($_POST['checkedby'], ENT_QUOTES, 'UTF-8');
	$taxtype = htmlspecialchars($_POST['taxtype'], ENT_QUOTES, 'UTF-8');
	//FOR GET ALL THE DATA WITHOUT LOOPING

	$tax = '';
	$cgst = '';
	$sgst = '';
	$igst = '';
	$gst = '';
	$gstpercent = '';
	$csgstpercent = '';
	for($i=0; $i<count($_POST['tax']); $i++)
	{
		$tax .= ','.htmlspecialchars($_POST['tax'][$i], ENT_QUOTES, 'UTF-8');
		$cgst .= ','.htmlspecialchars($_POST['cgst'][$i], ENT_QUOTES, 'UTF-8');
		$sgst .= ','.htmlspecialchars($_POST['sgst'][$i], ENT_QUOTES, 'UTF-8');
		$igst .= ','.htmlspecialchars($_POST['igst'][$i], ENT_QUOTES, 'UTF-8');
		$gst .= ','.htmlspecialchars($_POST['gst'][$i], ENT_QUOTES, 'UTF-8');
		$gstpercent .= ','.htmlspecialchars($_POST['gstpercent'][$i], ENT_QUOTES, 'UTF-8');
		$csgstpercent .= ','.htmlspecialchars($_POST['csgstpercent'][$i], ENT_QUOTES, 'UTF-8');
	}
	//FOR GET THE TAX INFORMATIONS IN LOOP

	if ((in_array('Terms and Conditions', $fieldadd))) {
		$terms = htmlspecialchars($_POST['terms'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$terms='';
	}
	if ((in_array('Notes', $fieldadd))) {
		$notes = htmlspecialchars($_POST['notes'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$notes='';
	}
	if ((in_array('Description', $fieldadd))) {
		$description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$description='';
	}

	$validpaidamount = htmlspecialchars((($_POST['validpaidamount']!='')?$_POST['validpaidamount']:0), ENT_QUOTES, 'UTF-8');
	$validbalance = htmlspecialchars((float)$_POST['grandtotal'], ENT_QUOTES, 'UTF-8') - htmlspecialchars((float)$_POST['validpaidamount'], ENT_QUOTES, 'UTF-8');
	$ansforsepgstval = htmlspecialchars($_POST['ansforsepgstval'], ENT_QUOTES, 'UTF-8');
	//FOR GET PAYMENT DETAILS AND GST VALUES

	if ((in_array('Attachment', $fieldadd))) {
		$fileattach ="";
   	$total_count = count($_FILES['fileattach']['name']);
   	for( $i=0 ; $i < $total_count ; $i++ ) {
   	$files = $_FILES["fileattach"]["tmp_name"][$i];
       	if ($files != ""){
           	if(is_uploaded_file($files)) {
               	$targetFile = "ups/fileattach/".time().basename($_FILES['fileattach']['name'][$i]);
               	if (move_uploaded_file($files, $targetFile)) {
                   	if($fileattach!=""){
                       	$fileattach.=" | ".$targetFile;
                   	}
                   	else{
                       	$fileattach.="".$targetFile;
                   	}
               	}
           	}
           	else {
               	$fileattach ="";
           	}
       	}
		}
	}
	else{
		$fileattach='';
	}
	//FOR ATTACHMENT FILES

	$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype=? ORDER BY id ASC");
	$sqlismainaccessusers->bind_param("is", $userid,$invmodtype);
	$sqlismainaccessusers->execute();
	$sqlismainaccessuser = $sqlismainaccessusers->get_result();
	$infomainaccessuser=$sqlismainaccessuser->fetch_assoc();
	$sqlismainaccessuser->close();
	$sqlismainaccessusers->close();
	//FOR CHECK THE B2B OR B2C ENABLED

	if (($infomainaccessuser['invoicecustinfo']=='one')||($scriptonetwo=='one')) {
		$custid = htmlspecialchars($_POST['customer'], ENT_QUOTES, 'UTF-8');
		$franchsess = $_SESSION["franchisesession"];
		$pubcvisiblity = 'PUBLIC';
		$cusmodtype = 'Customers';

		$custsqlanscuss=$con->prepare("SELECT * FROM paircustomers WHERE (franchisesession=? OR cvisiblity=?) AND (createdid=? AND moduletype=?) AND id=? ORDER BY id ASC");
		$custsqlanscuss->bind_param("ssssi", $franchsess,$pubcvisiblity,$companymainid,$cusmodtype,$custid);
		$custsqlanscuss->execute();
		$custsqlcushis = $custsqlanscuss->get_result();
		$custsqlanscus=$custsqlcushis->fetch_assoc();
		$custsqlcushis->close();
		$custsqlanscuss->close();

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
		$custolddlno20 = $custsqlanscus['dlno20'];
		$custolddlno21 = $custsqlanscus['dlno21'];

		$area = htmlspecialchars($_POST['billstreet'], ENT_QUOTES, 'UTF-8');
		$city = htmlspecialchars($_POST['billcity'], ENT_QUOTES, 'UTF-8');
		$state = htmlspecialchars($_POST['billstate'], ENT_QUOTES, 'UTF-8');
		$pincode = htmlspecialchars($_POST['billpincode'], ENT_QUOTES, 'UTF-8');
		$district = htmlspecialchars($_POST['billcountry'], ENT_QUOTES, 'UTF-8');

		$custgstin = htmlspecialchars($_POST['gstgstin'], ENT_QUOTES, 'UTF-8');
		$twoworkphone = htmlspecialchars($_POST['workworkphone'], ENT_QUOTES, 'UTF-8');
		$twomobilephone = htmlspecialchars($_POST['workmobile'], ENT_QUOTES, 'UTF-8');
		$sarea = htmlspecialchars($_POST['shipstreet'], ENT_QUOTES, 'UTF-8');
		$scity = htmlspecialchars($_POST['shipcity'], ENT_QUOTES, 'UTF-8');
		$sstate = htmlspecialchars($_POST['shipstate'], ENT_QUOTES, 'UTF-8');
		$spincode = htmlspecialchars($_POST['shippincode'], ENT_QUOTES, 'UTF-8');
		$sdistrict = htmlspecialchars($_POST['shipcountry'], ENT_QUOTES, 'UTF-8');
		$sesunqwerty = $_SESSION['unqwerty'];
		$franchsess = $_SESSION["franchisesession"];
		$cusmodtype = 'Customers';
		$pubcvisiblity = 'PUBLIC';

		$custsqlup = $con->prepare("UPDATE paircustomers SET dlno20=?, dlno21=?, createdon=?, createdid=?, createdby=?, franchisesession=?,billstreet=?,billcity=?,billstate=?,billpincode=?,billcountry=?,shipstreet=?,shipcity=?,shipstate=?,shippincode=?,shipcountry=?,gstrtype=?,gstin=?,workphone=?,mobile=? WHERE id=? AND createdid=? AND moduletype=? AND (franchisesession=? OR cvisiblity=?)");
    	$custsqlup->bind_param("ssssssssssssssssssssissss", $dlno20, $dlno21, $times, $companymainid, $sesunqwerty, $franchsess, $area, $city, $state, $pincode, $district, $sarea, $scity, $sstate, $spincode, $sdistrict, $gstrtype, $custgstin, $twoworkphone, $twomobilephone, $custid, $companymainid, $cusmodtype, $franchsess, $pubcvisiblity);
    	$custsqlup->execute();
    	$custsqlup->close();

		$custch='';
		if($twoworkphone!=$custoldworkphone){
			if($custch!=''){
				$custch.='<br> Work Phone<span style="color:green;" id="prohisfromtospan">( From '.$custoldworkphone.' To '.$twoworkphone.' ) </span>';
			}
			else{
				$custch.='Work Phone<span style="color:green;" id="prohisfromtospan">( From '.$custoldworkphone.' To '.$twoworkphone.' ) </span>';
			}
		}
		if($twomobilephone!=$custoldmobilephone){
			if($custch!=''){
				$custch.='<br> Mobile Phone<span style="color:green;" id="prohisfromtospan">( From '.$custoldmobilephone.' To '.$twomobilephone.' ) </span>';
			}
			else{
				$custch.='Mobile Phone<span style="color:green;" id="prohisfromtospan">( From '.$custoldmobilephone.' To '.$twomobilephone.' ) </span>';
			}
		}
		if($area!=$custoldbillstreet){
			if($custch!=''){
				$custch.='<br> Billing Street<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillstreet.' To '.$area.' ) </span>';
			}
			else{
				$custch.='Billing Street<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillstreet.' To '.$area.' ) </span>';
			}
		}
		if($city!=$custoldbillcity){
			if($custch!=''){
				$custch.='<br> Billing City<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillcity.' To '.$city.' ) </span>';
			}
			else{
				$custch.='Billing City<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillcity.' To '.$city.' ) </span>';
			}
		}
		if($state!=$custoldbillstate){
			if($custch!=''){
				$custch.='<br> Billing State<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillstate.' To '.$state.' ) </span>';
			}
			else{
				$custch.='Billing State<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillstate.' To '.$state.' ) </span>';
			}
		}
		if($pincode!=$custoldbillpincode){
			if($custch!=''){
				$custch.='<br> Billing Pincode<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillpincode.' To '.$pincode.' ) </span>';
			}
			else{
				$custch.='Billing Pincode<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillpincode.' To '.$pincode.' ) </span>';
			}
		}
		if($district!=$custoldbillcountry){
			if($custch!=''){
				$custch.='<br> Billing Country<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillcountry.' To '.$district.' ) </span>';
			}
			else{
				$custch.='Billing Country<span style="color:green;" id="prohisfromtospan">( From '.$custoldbillcountry.' To '.$district.' ) </span>';
			}
		}
		if($sarea!=$custoldshipstreet){
			if($custch!=''){
				$custch.='<br> Shipping Street<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipstreet.' To '.$sarea.' ) </span>';
			}
			else{
				$custch.='Shipping Street<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipstreet.' To '.$sarea.' ) </span>';
			}
		}
		if($scity!=$custoldshipcity){
			if($custch!=''){
				$custch.='<br> Shipping City<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipcity.' To '.$scity.' ) </span>';
			}
			else{
				$custch.='Shipping City<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipcity.' To '.$scity.' ) </span>';
			}
		}
		if($sstate!=$custoldshipstate){
			if($custch!=''){
				$custch.='<br> Shipping State<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipstate.' To '.$sstate.' ) </span>';
			}
			else{
				$custch.='Shipping State<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipstate.' To '.$sstate.' ) </span>';
			}
		}
		if($spincode!=$custoldshippincode){
			if($custch!=''){
				$custch.='<br> Shipping Pincode<span style="color:green;" id="prohisfromtospan">( From '.$custoldshippincode.' To '.$spincode.' ) </span>';
			}
			else{
				$custch.='Shipping Pincode<span style="color:green;" id="prohisfromtospan">( From '.$custoldshippincode.' To '.$spincode.' ) </span>';
			}
		}
		if($sdistrict!=$custoldshipcountry){
			if($custch!=''){
				$custch.='<br> Shipping Country<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipcountry.' To '.$sdistrict.' ) </span>';
			}
			else{
				$custch.='Shipping Country<span style="color:green;" id="prohisfromtospan">( From '.$custoldshipcountry.' To '.$sdistrict.' ) </span>';
			}
		}
		if($gstrtype!=$custoldgstrtype){
			if($custch!=''){
				$custch.='<br> GST Registration Type<span style="color:green;" id="prohisfromtospan">( From '.$custoldgstrtype.' To '.$gstrtype.' ) </span>';
			}
			else{
				$custch.='GST Registration Type<span style="color:green;" id="prohisfromtospan">( From '.$custoldgstrtype.' To '.$gstrtype.' ) </span>';
			}
		}
		if($custgstin!=$custoldgstin){
			if($custch!=''){
				$custch.='<br> GSTIN / UIN<span style="color:green;" id="prohisfromtospan">( From '.$custoldgstin.' To '.$custgstin.' ) </span>';
			}
			else{
				$custch.='GSTIN / UIN<span style="color:green;" id="prohisfromtospan">( From '.$custoldgstin.' To '.$custgstin.' ) </span>';
			}
		}
		if($dlno20!=$custolddlno20){
			if($custch!=''){
				$custch.='<br> DL No 20<span style="color:green;" id="prohisfromtospan">( From '.$custolddlno20.' To '.$dlno20.' ) </span>';
			}
			else{
				$custch.='DL No 20<span style="color:green;" id="prohisfromtospan">( From '.$custolddlno20.' To '.$dlno20.' ) </span>';
			}                   
		}
		if($dlno21!=$custolddlno21){
			if($custch!=''){
				$custch.='<br> DL No 21<span style="color:green;" id="prohisfromtospan">( From '.$custolddlno21.' To '.$dlno21.' ) </span>';
			}
			else{
				$custch.='DL No 21<span style="color:green;" id="prohisfromtospan">( From '.$custolddlno21.' To '.$dlno21.' ) </span>';
			}                   
		}
		if($custch!=''){
			$custsqluse = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,useremarks) VALUES ('CUSTOMERS', ?, ?, ?, ?)");
    		$custsqluse->bind_param("ssss", $times, $_SESSION["unqwerty"], $custid, $custch);
    		$custsqluse->execute();
    		$custsqluse->close();
		}
	//FOR THE B2B CUSTOMER CHANGES
	}
	$twoage = '';
	$twosex = '';
	if (($infomainaccessuser['invoicecustinfo']=='two')||($scriptonetwo=='two')) {
		$address1 = '';
		$address2 = '';
		$saddress1 = '';
		$saddress2 = '';
		$customername = htmlspecialchars($_POST['twocustomername'], ENT_QUOTES, 'UTF-8');
		$twoage = htmlspecialchars($_POST['twoage'], ENT_QUOTES, 'UTF-8');
		$twosex = htmlspecialchars($_POST['twosex'], ENT_QUOTES, 'UTF-8');
		$area = htmlspecialchars($_POST['twobillstreet'], ENT_QUOTES, 'UTF-8');
		$city = htmlspecialchars($_POST['twobillcity'], ENT_QUOTES, 'UTF-8');
		$state = htmlspecialchars($_POST['twobillstate'], ENT_QUOTES, 'UTF-8');
		$pincode = htmlspecialchars($_POST['twobillpincode'], ENT_QUOTES, 'UTF-8');
		$district = htmlspecialchars($_POST['twobillcountry'], ENT_QUOTES, 'UTF-8');
		$gstno = htmlspecialchars($_POST['twogstin'], ENT_QUOTES, 'UTF-8');
		$twoworkphone = htmlspecialchars($_POST['twoworkphone'], ENT_QUOTES, 'UTF-8');
		$twomobilephone = htmlspecialchars($_POST['twomobilephone'], ENT_QUOTES, 'UTF-8');
		$pos = htmlspecialchars($_POST['twopos'], ENT_QUOTES, 'UTF-8');
		$twosameasbilling = htmlspecialchars(((isset($_POST['twosameasbilling']))?1:0), ENT_QUOTES, 'UTF-8');
		if (isset($_POST['twosameasbilling'])) {
			$sarea = htmlspecialchars($_POST['twobillstreet'], ENT_QUOTES, 'UTF-8');
			$scity = htmlspecialchars($_POST['twobillcity'], ENT_QUOTES, 'UTF-8');
			$sstate = htmlspecialchars($_POST['twobillstate'], ENT_QUOTES, 'UTF-8');
			$spincode = htmlspecialchars($_POST['twobillpincode'], ENT_QUOTES, 'UTF-8');
			$sdistrict = htmlspecialchars($_POST['twobillcountry'], ENT_QUOTES, 'UTF-8');
		}
		else{
			$sarea = htmlspecialchars($_POST['twoshipstreet'], ENT_QUOTES, 'UTF-8');
			$scity = htmlspecialchars($_POST['twoshipcity'], ENT_QUOTES, 'UTF-8');
			$sstate = htmlspecialchars($_POST['twoshipstate'], ENT_QUOTES, 'UTF-8');
			$spincode = htmlspecialchars($_POST['twoshippincode'], ENT_QUOTES, 'UTF-8');
			$sdistrict = htmlspecialchars($_POST['twoshipcountry'], ENT_QUOTES, 'UTF-8');
		}
		$sesunqwerty = $_SESSION['unqwerty'];
		$franchsess = $_SESSION["franchisesession"];
		$cusmodtype = 'Customers';
		$pubcvisiblity = 'PUBLIC';

		$sqlismodulespublicnamecusts=$con->prepare("SELECT * FROM pairmodules WHERE moduletype=? ORDER BY id ASC");
		$sqlismodulespublicnamecusts->bind_param("s", $cusmodtype);
		$sqlismodulespublicnamecusts->execute();
		$sqlismodulespublicnamecust = $sqlismodulespublicnamecusts->get_result();
		$infomodulespublicnamecust=$sqlismodulespublicnamecust->fetch_assoc();
		$sqlismodulespublicnamecust->close();
		$sqlismodulespublicnamecusts->close();

		$sqlismainaccesspublicnamecusts=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype=? AND franchiseid=? ORDER BY id ASC");
		$sqlismainaccesspublicnamecusts->bind_param("isi", $companymainid, $cusmodtype, $franchsess);
		$sqlismainaccesspublicnamecusts->execute();
		$sqlismainaccesspublicnamecust = $sqlismainaccesspublicnamecusts->get_result();
		$infomainaccesspublicnamecust=$sqlismainaccesspublicnamecust->fetch_assoc();
		$sqlismainaccesspublicnamecust->close();
		$sqlismainaccesspublicnamecusts->close();

		$custsqlinss=$con->prepare("SELECT count(customercode) FROM paircustomers WHERE moduletype=?");
		$custsqlinss->bind_param("s", $cusmodtype);
		$custsqlinss->execute();
		$custsqlins = $custsqlinss->get_result();
		$custansins=$custsqlins->fetch_array();
		$custsqlins->close();
		$custsqlinss->close();
		
		$custoldid = $custansins[0];
		$custcustomercode = $custoldid + 1;

		$custpublicsqls=$con->prepare("SELECT count(publicid) FROM paircustomers WHERE createdid=? AND moduletype=?");
		$custpublicsqls->bind_param("ss", $companymainid, $cusmodtype);
		$custpublicsqls->execute();
		$custpublicsql = $custpublicsqls->get_result();
		$custpublicans=$custpublicsql->fetch_array();
		$custpublicsql->close();
		$custpublicsqls->close();
		
		$custoldcodepublic=$custpublicans[0];
		$custpubliccode=$infomodulespublicnamecust['publiccolumn'] . $custoldcodepublic+1;

		$custprivatesqls=$con->prepare("SELECT count(privateid) FROM paircustomers WHERE createdid=? AND moduletype=? AND franchisesession=?");
		$custprivatesqls->bind_param("sss", $companymainid, $cusmodtype, $franchsess);
		$custprivatesqls->execute();
		$custprivatesql = $custprivatesqls->get_result();
		$custprivateans=$custprivatesql->fetch_array();
		$custprivatesql->close();
		$custprivatesqls->close();
		
		$custoldcodeprivate=$custprivateans[0];
		$custprivatecode=$infomainaccesspublicnamecust['moduleprefix'] . $custoldcodeprivate+1;

		$sqlup = $con->prepare("INSERT INTO paircustomers (dlno20,dlno21,createdon,createdid,createdby,franchisesession,customername,billstreet,billcity,billstate,billpincode,billcountry,shipstreet,shipcity,shipstate,shippincode,shipcountry,sameasbilling,gstrtype,gstin,moduletype,placeos,workphone,mobile,customercode,publicid,privateid,cvisiblity,age,sex) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    	$sqlup->bind_param("sssssssssssssssssissssssssssss", $dlno20, $dlno21, $times, $companymainid, $sesunqwerty, $franchsess, $customername, $area, $city, $state, $pincode, $district, $sarea, $scity, $sstate, $spincode, $sdistrict, $twosameasbilling, $gstrtype, $gstno, $cusmodtype, $pos, $twoworkphone, $twomobilephone, $custcustomercode, $custpubliccode, $custprivatecode, $infomainaccesspublicnamecust['customervisible'], $twoage, $twosex);
    	$sqlup->execute();
    	$sqlup->close();

		$customerid=$con->insert_id;
	//FOR B2C NEW CUSTOMER INSERTION
	}

	$invmodtype = 'Invoices';
	$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype=? ORDER BY id ASC");
	$sqlismainaccessusers->bind_param("is", $userid, $invmodtype);
	$sqlismainaccessusers->execute();
	$sqlismainaccessuser = $sqlismainaccessusers->get_result();
	$infomainaccessuser=$sqlismainaccessuser->fetch_array();
	$sqlismainaccessuser->close();
	$sqlismainaccessusers->close();
	$sesunqwerty = $_SESSION['unqwerty'];
	$franchsess = $_SESSION["franchisesession"];
	$sql3 = $con->prepare("UPDATE pairmainaccess SET modulesuffix=modulesuffix + 1 WHERE franchiseid=? AND moduletype='Invoices'");
    $sql3->bind_param("s", $_SESSION['franchisesession']);
    $sql3->execute();
	$sql3->close();
	//FOR INCREMENT THE AUTO NUMBER SERIES OF THE FILE

	$sql2=$con->prepare("SELECT id FROM pairinvoices WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=?");
	$sql2->bind_param("iiss", $franchsess, $companymainid, $invoiceno, $invoicedate);
	$sql2->execute();
	$sql2->store_result();
	//FOR CHECK THE INVOICE IS IN OR NOT
	$customerid = htmlspecialchars($customerid, ENT_QUOTES, 'UTF-8');

	if($sql2->num_rows==0){
		for($i=0; $i<count($_POST['productname']); $i++){
			$barcode = htmlspecialchars($_POST['barcode'][$i], ENT_QUOTES, 'UTF-8');
			$productid = htmlspecialchars($_POST['productid'][$i], ENT_QUOTES, 'UTF-8');
			$productname = htmlspecialchars($_POST['productname'][$i], ENT_QUOTES, 'UTF-8');
			$manufacturer = htmlspecialchars($_POST['manufacturer'][$i], ENT_QUOTES, 'UTF-8');
			$producthsn = htmlspecialchars($_POST['producthsn'][$i], ENT_QUOTES, 'UTF-8');
			$productnotes = htmlspecialchars($_POST['productnotes'][$i], ENT_QUOTES, 'UTF-8');
			$productdescription = htmlspecialchars($_POST['productdescription'][$i], ENT_QUOTES, 'UTF-8');
			$itemmodule = htmlspecialchars($_POST['itemmodule'][$i], ENT_QUOTES, 'UTF-8');
			$rack = htmlspecialchars($_POST['rack'][$i], ENT_QUOTES, 'UTF-8');
			if ($access['batchexpiryval']==1) {
				$batch = htmlspecialchars($_POST['batch'][$i], ENT_QUOTES, 'UTF-8');
				$expdate = htmlspecialchars($_POST['expdate'][$i], ENT_QUOTES, 'UTF-8');
			}
			else{
				$batch='';
				$expdate='';
			}
			$mrp=htmlspecialchars( (($_POST['mrp'][$i]!='')?$_POST['mrp'][$i]:0), ENT_QUOTES, 'UTF-8');
			$vat = floatval(htmlspecialchars($_POST['vat'][$i], ENT_QUOTES, 'UTF-8'));
			$quantity=htmlspecialchars((($_POST['quantity'][$i]!='')?$_POST['quantity'][$i]:0), ENT_QUOTES, 'UTF-8');
			$unit = htmlspecialchars($_POST['productunit'][$i], ENT_QUOTES, 'UTF-8');
			$productrate=htmlspecialchars((($_POST['productrate'][$i]!='')?$_POST['productrate'][$i]:'0'), ENT_QUOTES, 'UTF-8');
			$noofpacks = floatval(htmlspecialchars($_POST['noofpacks'][$i], ENT_QUOTES, 'UTF-8'));
			$prodiscount = floatval(htmlspecialchars($_POST['prodiscount'][$i], ENT_QUOTES, 'UTF-8'));
			$prodisvalueforledger = floatval(htmlspecialchars($_POST['prodisvalueforledger'][$i], ENT_QUOTES, 'UTF-8'));
			$prodiscounttype = htmlspecialchars($_POST['prodiscounttype'][$i], ENT_QUOTES, 'UTF-8');
			$productvalue = floatval(htmlspecialchars($_POST['productvalue'][$i], ENT_QUOTES, 'UTF-8'));
			$taxvalue = floatval(htmlspecialchars($_POST['taxvalue'][$i], ENT_QUOTES, 'UTF-8'));
			$cgstvat = floatval(htmlspecialchars($_POST['cgstvat'][$i], ENT_QUOTES, 'UTF-8'));
			$sgstvat = floatval(htmlspecialchars($_POST['sgstvat'][$i], ENT_QUOTES, 'UTF-8'));
			$productnetvalue = floatval(htmlspecialchars($_POST['productnetvalue'][$i], ENT_QUOTES, 'UTF-8'));
			$marginupdates = htmlspecialchars($_POST['marginupdates'][$i], ENT_QUOTES, 'UTF-8');
			$margintotalvalue = floatval(htmlspecialchars($_POST['margintotalvalue'][$i], ENT_QUOTES, 'UTF-8'));
			$chartaccountid=htmlspecialchars($_POST['accountname'][$i], ENT_QUOTES, 'UTF-8');
			$sqlaccmanuals=$con->prepare("SELECT accountname FROM pairchartaccountings WHERE id=?");
			$sqlaccmanuals->bind_param("i", $chartaccountid);
			$sqlaccmanuals->execute();
			$sqlaccmanual = $sqlaccmanuals->get_result();
			$fetaccmanual=$sqlaccmanual->fetch_array();

			$accountname=$fetaccmanual['accountname'];

			$sqlaccmanual->close();
			$sqlaccmanuals->close();

			if($productname!=''){
				$sesunqwerty = $_SESSION['unqwerty'];
				$franchsess = $_SESSION["franchisesession"];
				$sql = $con->prepare("INSERT INTO pairinvoices (barcode,createdon,createdid,createdby,franchisesession,customername,customerid,address1,address2,area,city,state,district,pincode,saddress1,saddress2,sarea,scity,sstate,sdistrict,spincode,gstno,invoiceterm,invoiceno,invoicedate,invoiceamount,duedate,duedates,productid,productname,manufacturer,producthsn,productnotes,productdescription,itemmodule,rack,batch,expdate,mrp,vat,quantity,unit,productrate,noofpacks,prodiscount,productvalue,taxvalue,cgstvat,sgstvat,productnetvalue,totalitems,orderdcno,reference,saleperson,totalvatamount,totalamount,totalquantity,discounttype,discount,discountamount,freightamount,roundoff,grandtotal,preparedby,checkedby,taxtype,tax,cgst,sgst,igst,gst,gstpercent,csgstpercent,terms,notes,description,fileattach,pos,workphone,mobile,sameasbilling,customerinfodefault,gstrtype,validpaidamount,validbalance,icsgsthis,prodiscounttype,marginupdates,margintotalvalue,age,sex,accountid,accountname,invoicetime,cashreceived,cardreceived,gpayreceived,ordering,dlno20,dlno21,invoicetype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Invoice')");
    			$sql->bind_param("sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssissssssss", $barcode, $times, $companymainid, $sesunqwerty, $franchsess, $customername, $customerid, $address1, $address2, $area, $city, $state, $district, $pincode, $saddress1, $saddress2, $sarea, $scity, $sstate, $sdistrict, $spincode, $gstno, $invoiceterm, $invoiceno, $invoicedate, $invoiceamount, $duedate, $duedates, $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $itemmodule, $rack, $batch, $expdate, $mrp, $vat, $quantity, $unit, $productrate, $noofpacks, $prodiscount, $productvalue, $taxvalue,$cgstvat,$sgstvat, $productnetvalue, $totalitems, $orderdcno, $reference, $saleperson, $totalvatamount, $totalamount, $totalquantity, $discounttype, $discount, $discountamount, $freightamount, $roundoff, $grandtotal, $preparedby, $checkedby, $taxtype, $tax, $cgst, $sgst, $igst, $gst, $gstpercent, $csgstpercent, $terms, $notes, $description, $fileattach, $pos, $twoworkphone, $twomobilephone, $twosameasbilling, $scriptonetwo, $gstrtype, $validpaidamount, $validbalance, $ansforsepgstval, $prodiscounttype, $marginupdates, $margintotalvalue, $twoage, $twosex, $chartaccountid, $accountname, $invoicetime, $cashreceived, $cardreceived, $gpayreceived, $ordering, $dlno20, $dlno21);
				//FOR INSERT THE NEW INVOICE 
				if($sql->execute()){
					$sql->close();
					$salesid=$con->insert_id;
					if($invoiceterm=='CASH'){
						$sqlismodulespublicnamemanuals=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Manual Journals' ORDER BY id ASC");
						$sqlismodulespublicnamemanuals->execute();
						$sqlismodulespublicnamemanual = $sqlismodulespublicnamemanuals->get_result();
						$infomodulespublicnamemanual=$sqlismodulespublicnamemanual->fetch_array();

						$sqlismainaccesspublicnamemanuals=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Manual Journals' AND franchiseid=? ORDER BY id ASC");
						$sqlismainaccesspublicnamemanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
						$sqlismainaccesspublicnamemanuals->execute();
						$sqlismainaccesspublicnamemanual = $sqlismainaccesspublicnamemanuals->get_result();
						$infomainaccesspublicnamemanual=$sqlismainaccesspublicnamemanual->fetch_array();

						$publicsqlmanuals=$con->prepare("SELECT count(publicid) FROM pairledgers WHERE createdid=? AND type='ledger'");
						$publicsqlmanuals->bind_param("i", $companymainid);
						$publicsqlmanuals->execute();
						$publicsqlmanual = $publicsqlmanuals->get_result();
						$publicansmanual=$publicsqlmanual->fetch_array();

						$oldcodepublicmanual=$publicansmanual[0];
						$publicsqlmanual->close();
						$publicsqlmanuals->close();
						$publicidmanual=$infomodulespublicnamemanual['publiccolumn'] . intval($oldcodepublicmanual)+1;

						$privatesqlmanuals=$con->prepare("SELECT count(privateid) FROM pairledgers WHERE createdid=? AND franchisesession=? AND type='ledger'");
						$privatesqlmanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
						$privatesqlmanuals->execute();
						$privatesqlmanual = $privatesqlmanuals->get_result();
						$privateansmanual=$privatesqlmanual->fetch_array();

						$oldcodeprivatemanual=$privateansmanual[0];
						$privatesqlmanual->close();
						$privatesqlmanuals->close();
						$privateidmanual=$infomainaccesspublicnamemanual['moduleprefix'] . intval($infomainaccesspublicnamemanual['modulesuffix'])+1;

						$sqlismainaccesspublicnamemanual->close();
						$sqlismainaccesspublicnamemanuals->close();

						$sqlismodulespublicnamemanual->close();
						$sqlismodulespublicnamemanuals->close();

						if($accountname!=''){
							$sqlaccins = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice')");
		    				$sqlaccins->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $accountname, $chartaccountid, $customerid, $customername, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
		    				if($sqlaccins->execute()){
		    					if ($prodisvalueforledger>0) {
		    						$sqlaccdefaultdiscounts=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Discount'");
									$sqlaccdefaultdiscounts->execute();
									$sqlaccdefaultdiscount = $sqlaccdefaultdiscounts->get_result();
									$fetaccdefaultdiscounts=$sqlaccdefaultdiscount->fetch_array();

									$defaccountnamediscount=$fetaccdefaultdiscounts['accountname'];
									$defaccountiddiscount=$fetaccdefaultdiscounts['id'];

									$sqlaccdefaultdiscount->close();
									$sqlaccdefaultdiscounts->close();

									$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice')");
				    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamediscount, $defaccountiddiscount, $customerid, $customername, $prodisvalueforledger, $prodisvalueforledger, $grandtotal, $publicidmanual, $privateidmanual);
				    				$sqlaccdefault->execute();
				    				$sqlaccdefault->close();
		    					}
		    				}
		    				else{
		    					echo mysqli_error($con);
		    				}
		    				$sqlaccins->close();
		    				if ($taxvalue>0) {
								$sqlaccdefaulttdss=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='TDS Receivable'");
								$sqlaccdefaulttdss->execute();
								$sqlaccdefaulttds = $sqlaccdefaulttdss->get_result();
								$fetaccdefaulttds=$sqlaccdefaulttds->fetch_array();

								$defaccountnametds=$fetaccdefaulttds['accountname'];
								$defaccountidtds=$fetaccdefaulttds['id'];

								$sqlaccdefaulttds->close();
								$sqlaccdefaulttdss->close();

								$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice')");
			    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnametds, $defaccountidtds, $customerid, $customername, $taxvalue, $taxvalue, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccdefault->execute();
			    				$sqlaccdefault->close();
			    			}
							$sqlaccdefaultsales=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Sales'");
							$sqlaccdefaultsales->execute();
							$sqlaccdefaultsale = $sqlaccdefaultsales->get_result();
							$fetaccdefaultsales=$sqlaccdefaultsale->fetch_array();

							$defaccountname=$fetaccdefaultsales['accountname'];
							$defaccountid=$fetaccdefaultsales['id'];

							$sqlaccdefaultsale->close();
							$sqlaccdefaultsales->close();

							$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice')");
		    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountname, $defaccountid, $customerid, $customername, $productvalue, $productvalue, $grandtotal, $publicidmanual, $privateidmanual);
		    				$sqlaccdefault->execute();
		    				$sqlaccdefault->close();

							$sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
							$sqlaccdefaultpettycashpays->execute();
							$sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
							$fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

							$defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'];
							$defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

							$sqlaccdefaultpettycashpay->close();
							$sqlaccdefaultpettycashpays->close();

							$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
		    				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
		    				$sqlaccinspay->execute();
		    				$sqlaccinspay->close();
							$sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Receivable'");
							$sqlaccdefaultcashpays->execute();
							$sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
							$fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

							$defaccountnamepay=$fetaccdefaultcashpay['accountname'];
							$defaccountidpay=$fetaccdefaultcashpay['id'];

							$sqlaccdefaultcashpay->close();
							$sqlaccdefaultcashpays->close();

							$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice payment')");
		    				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
		    				$sqlaccdefaultpay->execute();
		    				$sqlaccdefaultpay->close();
						}
					//FOR INSERT THE MANUAL JOURNAL
					}
					elseif($invoiceterm=='CASH,CARD,GPAY'){
						$sqlismodulespublicnamemanuals=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Manual Journals' ORDER BY id ASC");
						$sqlismodulespublicnamemanuals->execute();
						$sqlismodulespublicnamemanual = $sqlismodulespublicnamemanuals->get_result();
						$infomodulespublicnamemanual=$sqlismodulespublicnamemanual->fetch_array();

						$sqlismainaccesspublicnamemanuals=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Manual Journals' AND franchiseid=? ORDER BY id ASC");
						$sqlismainaccesspublicnamemanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
						$sqlismainaccesspublicnamemanuals->execute();
						$sqlismainaccesspublicnamemanual = $sqlismainaccesspublicnamemanuals->get_result();
						$infomainaccesspublicnamemanual=$sqlismainaccesspublicnamemanual->fetch_array();

						$publicsqlmanuals=$con->prepare("SELECT count(publicid) FROM pairledgers WHERE createdid=? AND type='ledger'");
						$publicsqlmanuals->bind_param("i", $companymainid);
						$publicsqlmanuals->execute();
						$publicsqlmanual = $publicsqlmanuals->get_result();
						$publicansmanual=$publicsqlmanual->fetch_array();

						$oldcodepublicmanual=$publicansmanual[0];
						$publicsqlmanual->close();
						$publicsqlmanuals->close();
						$publicidmanual=$infomodulespublicnamemanual['publiccolumn'] . intval($oldcodepublicmanual)+1;

						$privatesqlmanuals=$con->prepare("SELECT count(privateid) FROM pairledgers WHERE createdid=? AND franchisesession=? AND type='ledger'");
						$privatesqlmanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
						$privatesqlmanuals->execute();
						$privatesqlmanual = $privatesqlmanuals->get_result();
						$privateansmanual=$privatesqlmanual->fetch_array();

						$oldcodeprivatemanual=$privateansmanual[0];
						$privatesqlmanual->close();
						$privatesqlmanuals->close();
						$privateidmanual=$infomainaccesspublicnamemanual['moduleprefix'] . intval($infomainaccesspublicnamemanual['modulesuffix'])+1;

						$sqlismainaccesspublicnamemanual->close();
						$sqlismainaccesspublicnamemanuals->close();

						$sqlismodulespublicnamemanual->close();
						$sqlismodulespublicnamemanuals->close();

						if($accountname!=''){
							$sqlaccins = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice')");
		    				$sqlaccins->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $accountname, $chartaccountid, $customerid, $customername, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
		    				if($sqlaccins->execute()){
		    					if ($prodisvalueforledger>0) {
		    						$sqlaccdefaultdiscounts=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Discount'");
									$sqlaccdefaultdiscounts->execute();
									$sqlaccdefaultdiscount = $sqlaccdefaultdiscounts->get_result();
									$fetaccdefaultdiscounts=$sqlaccdefaultdiscount->fetch_array();

									$defaccountnamediscount=$fetaccdefaultdiscounts['accountname'];
									$defaccountiddiscount=$fetaccdefaultdiscounts['id'];

									$sqlaccdefaultdiscount->close();
									$sqlaccdefaultdiscounts->close();

									$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice')");
				    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamediscount, $defaccountiddiscount, $customerid, $customername, $prodisvalueforledger, $prodisvalueforledger, $grandtotal, $publicidmanual, $privateidmanual);
				    				$sqlaccdefault->execute();
				    				$sqlaccdefault->close();
		    					}
		    				}
		    				else{
		    					echo mysqli_error($con);
		    				}
		    				$sqlaccins->close();
		    				if ($taxvalue>0) {
								$sqlaccdefaulttdss=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='TDS Receivable'");
								$sqlaccdefaulttdss->execute();
								$sqlaccdefaulttds = $sqlaccdefaulttdss->get_result();
								$fetaccdefaulttds=$sqlaccdefaulttds->fetch_array();

								$defaccountnametds=$fetaccdefaulttds['accountname'];
								$defaccountidtds=$fetaccdefaulttds['id'];

								$sqlaccdefaulttds->close();
								$sqlaccdefaulttdss->close();

								$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice')");
			    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnametds, $defaccountidtds, $customerid, $customername, $taxvalue, $taxvalue, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccdefault->execute();
			    				$sqlaccdefault->close();
			    			}
							$sqlaccdefaultsales=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Sales'");
							$sqlaccdefaultsales->execute();
							$sqlaccdefaultsale = $sqlaccdefaultsales->get_result();
							$fetaccdefaultsales=$sqlaccdefaultsale->fetch_array();

							$defaccountname=$fetaccdefaultsales['accountname'];
							$defaccountid=$fetaccdefaultsales['id'];

							$sqlaccdefaultsale->close();
							$sqlaccdefaultsales->close();

							$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice')");
		    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountname, $defaccountid, $customerid, $customername, $productvalue, $productvalue, $grandtotal, $publicidmanual, $privateidmanual);
		    				$sqlaccdefault->execute();
		    				$sqlaccdefault->close();
		    				if ($cashreceived>0) {
								$sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
								$sqlaccdefaultpettycashpays->execute();
								$sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
								$fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

								$defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'];
								$defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

								$sqlaccdefaultpettycashpay->close();
								$sqlaccdefaultpettycashpays->close();

								$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
			    				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $cashreceived, $cashreceived, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccinspay->execute();
			    				$sqlaccinspay->close();
								$sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Receivable'");
								$sqlaccdefaultcashpays->execute();
								$sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
								$fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

								$defaccountnamepay=$fetaccdefaultcashpay['accountname'];
								$defaccountidpay=$fetaccdefaultcashpay['id'];

								$sqlaccdefaultcashpay->close();
								$sqlaccdefaultcashpays->close();

								$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice payment')");
			    				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $cashreceived, $cashreceived, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccdefaultpay->execute();
			    				$sqlaccdefaultpay->close();
		    				}
		    				if ($cardreceived>0) {
								$sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
								$sqlaccdefaultpettycashpays->execute();
								$sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
								$fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

								$defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'].'(CARD)';
								$defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

								$sqlaccdefaultpettycashpay->close();
								$sqlaccdefaultpettycashpays->close();

								$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
			    				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $cardreceived, $cardreceived, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccinspay->execute();
			    				$sqlaccinspay->close();
								$sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Receivable'");
								$sqlaccdefaultcashpays->execute();
								$sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
								$fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

								$defaccountnamepay=$fetaccdefaultcashpay['accountname'];
								$defaccountidpay=$fetaccdefaultcashpay['id'];

								$sqlaccdefaultcashpay->close();
								$sqlaccdefaultcashpays->close();

								$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice payment')");
			    				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $cardreceived, $cardreceived, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccdefaultpay->execute();
			    				$sqlaccdefaultpay->close();
		    				}
		    				if ($gpayreceived>0) {
								$sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
								$sqlaccdefaultpettycashpays->execute();
								$sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
								$fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

								$defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'].'(GPAY)';
								$defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

								$sqlaccdefaultpettycashpay->close();
								$sqlaccdefaultpettycashpays->close();

								$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
			    				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $gpayreceived, $gpayreceived, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccinspay->execute();
			    				$sqlaccinspay->close();
								$sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Receivable'");
								$sqlaccdefaultcashpays->execute();
								$sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
								$fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

								$defaccountnamepay=$fetaccdefaultcashpay['accountname'];
								$defaccountidpay=$fetaccdefaultcashpay['id'];

								$sqlaccdefaultcashpay->close();
								$sqlaccdefaultcashpays->close();

								$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice payment')");
			    				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $gpayreceived, $gpayreceived, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccdefaultpay->execute();
			    				$sqlaccdefaultpay->close();
		    				}
						}
					//FOR INSERT THE MANUAL JOURNAL
					}
					else{
						$sqlismodulespublicnamemanuals=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Manual Journals' ORDER BY id ASC");
						$sqlismodulespublicnamemanuals->execute();
						$sqlismodulespublicnamemanual = $sqlismodulespublicnamemanuals->get_result();
						$infomodulespublicnamemanual=$sqlismodulespublicnamemanual->fetch_array();

						$sqlismainaccesspublicnamemanuals=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Manual Journals' AND franchiseid=? ORDER BY id ASC");
						$sqlismainaccesspublicnamemanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
						$sqlismainaccesspublicnamemanuals->execute();
						$sqlismainaccesspublicnamemanual = $sqlismainaccesspublicnamemanuals->get_result();
						$infomainaccesspublicnamemanual=$sqlismainaccesspublicnamemanual->fetch_array();

						$publicsqlmanuals=$con->prepare("SELECT count(publicid) FROM pairledgers WHERE createdid=? AND type='ledger'");
						$publicsqlmanuals->bind_param("i", $companymainid);
						$publicsqlmanuals->execute();
						$publicsqlmanual = $publicsqlmanuals->get_result();
						$publicansmanual=$publicsqlmanual->fetch_array();

						$oldcodepublicmanual=$publicansmanual[0];
						$publicsqlmanual->close();
						$publicsqlmanuals->close();
						$publicidmanual=$infomodulespublicnamemanual['publiccolumn'] . intval($oldcodepublicmanual)+1;

						$privatesqlmanuals=$con->prepare("SELECT count(privateid) FROM pairledgers WHERE createdid=? AND franchisesession=? AND type='ledger'");
						$privatesqlmanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
						$privatesqlmanuals->execute();
						$privatesqlmanual = $privatesqlmanuals->get_result();
						$privateansmanual=$privatesqlmanual->fetch_array();

						$oldcodeprivatemanual=$privateansmanual[0];
						$privatesqlmanual->close();
						$privatesqlmanuals->close();
						$privateidmanual=$infomainaccesspublicnamemanual['moduleprefix'] . intval($infomainaccesspublicnamemanual['modulesuffix'])+1;

						$sqlismainaccesspublicnamemanual->close();
						$sqlismainaccesspublicnamemanuals->close();

						$sqlismodulespublicnamemanual->close();
						$sqlismodulespublicnamemanuals->close();

						if($accountname!=''){
							$sqlaccins = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice')");
		    				$sqlaccins->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $accountname, $chartaccountid, $customerid, $customername, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
		    				$sqlaccins->execute();
		    				$sqlaccins->close();
		    				if ($prodisvalueforledger>0) {
		    					$sqlaccdefaultdiscounts=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Discount'");
								$sqlaccdefaultdiscounts->execute();
								$sqlaccdefaultdiscount = $sqlaccdefaultdiscounts->get_result();
								$fetaccdefaultdiscounts=$sqlaccdefaultdiscount->fetch_array();

								$defaccountnamediscount=$fetaccdefaultdiscounts['accountname'];
								$defaccountiddiscount=$fetaccdefaultdiscounts['id'];

								$sqlaccdefaultdiscount->close();
								$sqlaccdefaultdiscounts->close();

								$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice')");
				    			$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamediscount, $defaccountiddiscount, $customerid, $customername, $prodisvalueforledger, $prodisvalueforledger, $grandtotal, $publicidmanual, $privateidmanual);
				    			$sqlaccdefault->execute();
				    			$sqlaccdefault->close();
		    				}
		    				if ($taxvalue>0) {
								$sqlaccdefaulttdss=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='TDS Receivable'");
								$sqlaccdefaulttdss->execute();
								$sqlaccdefaulttds = $sqlaccdefaulttdss->get_result();
								$fetaccdefaulttds=$sqlaccdefaulttds->fetch_array();

								$defaccountnametds=$fetaccdefaulttds['accountname'];
								$defaccountidtds=$fetaccdefaulttds['id'];

								$sqlaccdefaulttds->close();
								$sqlaccdefaulttdss->close();

								$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice')");
			    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnametds, $defaccountidtds, $customerid, $customername, $taxvalue, $taxvalue, $grandtotal, $publicidmanual, $privateidmanual);
			    				$sqlaccdefault->execute();
			    				$sqlaccdefault->close();
			    			}
							$sqlaccdefaultsales=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Sales'");
							$sqlaccdefaultsales->execute();
							$sqlaccdefaultsale = $sqlaccdefaultsales->get_result();
							$fetaccdefaultsales=$sqlaccdefaultsale->fetch_array();

							$defaccountname=$fetaccdefaultsales['accountname'];
							$defaccountid=$fetaccdefaultsales['id'];

							$sqlaccdefaultsale->close();
							$sqlaccdefaultsales->close();

							$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice')");
		    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountname, $defaccountid, $customerid, $customername, $productvalue, $productvalue, $grandtotal, $publicidmanual, $privateidmanual);
		    				$sqlaccdefault->execute();
		    				$sqlaccdefault->close();
						}
					//FOR INSERT THE MANUAL JOURNAL
					}
					$runtheans = explode(';', $marginupdates);
					$emptyqty = 0;
					$margintotal = 0;
					$showtheempty=true;
					for($ans=0;$ans<count($runtheans);$ans++){
						if (strpos($runtheans[$ans], '|||')!==false) {
							$runtheansnxt = explode('|||', $runtheans[$ans]);
							$emptyqty+=$runtheansnxt[4];
							$margintotal+=$runtheansnxt[5];
							$selbillmargins=$con->prepare("SELECT id FROM pairmargins WHERE billerid=? AND productid=? AND createdid=? AND franchisesession=? AND type='buying' AND batch=? AND expiry=? AND billingno=? AND billingdate=? AND nowstatus='added' GROUP BY billingdate, billingno ORDER BY billingdate ASC, billingno ASC");
							$selbillmargins->bind_param("iiiissss", $runtheansnxt[0], $productid, $companymainid, $_SESSION["franchisesession"], $batch, $expdate, $runtheansnxt[2], $runtheansnxt[3]);
							$selbillmargins->execute();
							// $selbillmargins->store_result();
							if($selbillmargins->num_rows>0){
								$fetbillmarginss = $selbillmargins->get_result();
								$fetbillmargins=$fetbillmarginss->fetch_array();
								$reduceqty = $runtheansnxt[4];
									$updbillmargins = $con->prepare("UPDATE pairmargins SET quantity=quantity - ?,taxablevalue=?,discountvalue=?,prodiscounttype=? WHERE billerid=? AND productid=? AND createdid=? AND franchisesession=? AND type='buying' AND batch=? AND expiry=? AND billingno=? AND billingdate=? AND nowstatus='added'");
    								$updbillmargins->bind_param("ssssiiiissss", $reduceqty, $productvalue, $prodiscount, $prodiscounttype, $runtheansnxt[0], $productid, $companymainid, $_SESSION["franchisesession"], $batch, $expdate, $runtheansnxt[2], $runtheansnxt[3]);
    								$updbillmargins->execute();
    								$updbillmargins->close();
									$sqlsellingmargins = $con->prepare("INSERT INTO pairmargins (createdon,createdid,franchisesession,type,billername,billerid,billingno,billingdate,productid,productname,batch,expiry,quantity,mrp,rate,nowstatus,taxablevalue,discountvalue,prodiscounttype) VALUES (?, ?, ?, 'selling', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'added', ?, ?, ?)");
    								$sqlsellingmargins->bind_param("siisississsssssss", $times, $companymainid, $_SESSION["franchisesession"], $runtheansnxt[1], $runtheansnxt[0], $runtheansnxt[2], $runtheansnxt[3], $productid, $productname, $batch, $expdate, $reduceqty, $mrp, $productrate, $productvalue, $prodiscount, $prodiscounttype);
    								$sqlsellingmargins->execute();
    								$sqlsellingmargins->close();
								$fetbillmarginss->close();
							}
							$selbillmargins->close();
						}
						//FOR INSERT OR UPDATE THE MARGIN PROFIT DETAILS
					}
					$sql4 = $con->prepare("UPDATE pairproducts SET openingstock=openingstock - ? WHERE id=?");
    				$sql4->bind_param("si", $quantity, $productid);
    				$sql4->execute();
					if($sql4){
    					$sql4->close();
    					$sqlibatch=$con->prepare("SELECT id FROM pairbatch WHERE createdid=? AND franchisesession=? AND productid=? AND batch=? AND expdate=?");
						$sqlibatch->bind_param("sssss", $companymainid, $_SESSION["franchisesession"], $productid, $batch, $expdate);
						$sqlibatch->execute();
						$sqlibatch->store_result();
						if($sqlibatch->num_rows>0){
							$sqlibatch->close();
							$sqlbatchupd = $con->prepare("UPDATE pairbatch SET createdon=?, createdid=?, createdby=?, franchisesession=?, productid=?, productname=?, manufacturer=?, producthsn=?, productnotes=?, productdescription=?, batch=?, expdate=?, mrp=?, vat=?, quantity=quantity - ?, productrate=?, noofpacks=?, prodiscount=? WHERE createdid=? AND franchisesession=? AND productid=? AND batch=? AND expdate=?");
    						$sqlbatchupd->bind_param("ssssssssssssssissssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $batch, $expdate, $mrp, $vat, $quantity, $productrate, $noofpacks, $prodiscount, $companymainid, $_SESSION["franchisesession"], $productid, $batch, $expdate);
    						$sqlbatchupd->execute();
							$sqlbatchupd->close();
						}
						else{
							$sqlibatch->close();
							$quantitynewans = $quantity * -1;
							$sqlbatchins = $con->prepare("INSERT INTO pairbatch (createdon,createdid,createdby,franchisesession,productid,productname,manufacturer,producthsn,productnotes,productdescription,batch,expdate,mrp,vat,quantity,productrate,noofpacks,prodiscount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    						$sqlbatchins->bind_param("ssssssssssssssisss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $batch, $expdate, $mrp, $vat, $quantitynewans, $productrate, $noofpacks, $prodiscount);
    						$sqlbatchins->execute();
    						$sqlbatchins->close();
						}
					}
				}
				else{
					echo mysqli_error($con);
				}
			}
		}
		//FOR BATCH INSERT OR UPDATE CHECK AND PROCEED
		$tid=$con->insert_id;
		if(($invoiceterm=='CASH')){
			// if ($validpaidamount!=0) {
				$sqlismodulespublicnames=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Payments Received' ORDER BY id ASC");
				$sqlismodulespublicnames->execute();
				$sqlismodulespublicname = $sqlismodulespublicnames->get_result();
				$infomodulespublicname=$sqlismodulespublicname->fetch_array();

				$sqlismainaccesspublicnames=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Payments Received' AND franchiseid=? ORDER BY id ASC");
				$sqlismainaccesspublicnames->bind_param("ii", $companymainid, $_SESSION["franchisesession"]);
				$sqlismainaccesspublicnames->execute();
				$sqlismainaccesspublicname = $sqlismainaccesspublicnames->get_result();
				$infomainaccesspublicname=$sqlismainaccesspublicname->fetch_array();

				$publicsqls=$con->prepare("SELECT count(publicid) FROM pairsalespayments WHERE createdid=?");
				$publicsqls->bind_param("s", $companymainid);
				$publicsqls->execute();
				$publicsql = $publicsqls->get_result();
				$publicans=$publicsql->fetch_array();

				$oldcodepublic=$publicans[0];
				$publicsql->close();
				$publicsqls->close();
				$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;

				$privatesqls=$con->prepare("SELECT count(privateid) FROM pairsalespayments WHERE createdid=? AND franchisesession=?");
				$privatesqls->bind_param("ss", $companymainid, $_SESSION["franchisesession"]);
				$privatesqls->execute();
				$privatesql = $privatesqls->get_result();
				$privateans=$privatesql->fetch_array();

				$oldcodeprivate=$privateans[0];
				$privatesql->close();
				$privatesqls->close();
				$privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;

				$sqlismainaccesspublicname->close();
				$sqlismainaccesspublicnames->close();

				$sqlismodulespublicname->close();
				$sqlismodulespublicnames->close();

				$sqlsalepayins = $con->prepare("INSERT INTO pairsalespayments (createdid,createdby,franchisesession,createdon,term,type,customername,customerid,receiptno,receiptdate,amount,paymentmode,notes,publicid,privateid) VALUES (?, ?, ?, ?, 'RECEIPT', 'invoice', ?, ?, ?, ?, ?, ?, '-', ?, ?)");
    			$sqlsalepayins->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $customername, $customerid, $invoiceno, $invoicedate, $validpaidamount, $invoiceterm, $publiccode, $privatecode);
    			$sqlsalepayins->execute();
				//FOR INSERT THE PAYMENT DETAILS
			// }
			if($sqlsalepayins){
    			$sqlsalepayins->close();
				// if ($validpaidamount!=0) {
					$paymentid=$con->insert_id;
					$sqle = $con->prepare("INSERT INTO pairsalespayhistory (createdid,createdby,franchisesession,createdon,paymentid,customerid,invoiceno,invoicedate,amount,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'invoice')");
    				$sqle->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $paymentid, $customerid, $invoiceno, $invoicedate, $validpaidamount);
    				$sqle->execute();
    				$sqle->close();
				//FOR INSERT THE PAYMENT DETAILS HISTORY
					$chforpayments='PAYMENT CREATED';
					$sqlismainaccessusercuss=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Customers' ORDER BY id ASC");
					$sqlismainaccessusercuss->bind_param("s", $userid);
					$sqlismainaccessusercuss->execute();
					$sqlismainaccessusercus = $sqlismainaccessusercuss->get_result();
					$infomainaccessusercus=$sqlismainaccessusercus->fetch_array();
					$sqlismainaccessusercus->close();
					$sqlismainaccessusercuss->close();
					if($customername!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> '.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$customername.' ) </span>';
						}
						else{
							$chforpayments.=''.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$customername.' ) </span>';
						}					
					}
					if($invoicedate!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($invoicedate)).' ) </span>';
						}
						else{
							$chforpayments.=' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($invoicedate)).' ) </span>';
						}					
					}
					if($invoiceno!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
						}
						else{
							$chforpayments.='Reference Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
						}					
					}
					if($invoiceterm!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.$invoiceterm.' ) </span>';
						}
						else{
							$chforpayments.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.$invoiceterm.' ) </span>';
						}					
					}
					if($validpaidamount!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
						}
						else{
							$chforpayments.='Amount Received <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
						}					
					}
					if($invoicedate!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> <span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> (Selected) <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($invoicedate)).' ) </span>';
						}
						else{
							$chforpayments.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> (Selected) <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($invoicedate)).' ) </span>';
						}
					}
					if($invoiceno!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
						}
						else{
							$chforpayments.=''.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
						}
					}
					if($grandtotal!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> '.$infomainaccessuser['modulename'].' Amount <span style="color:green;" id="prohisfromtospan">( '.$grandtotal.' ) </span>';
						}
						else{
							$chforpayments.=''.$infomainaccessuser['modulename'].' Amount <span style="color:green;" id="prohisfromtospan">( '.$grandtotal.' ) </span>';
						}
					}
					if($validbalance!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> Balance <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
						}
						else{
							$chforpayments.='Balance <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
						}
					}
					if($validpaidamount!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> Payment <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
						}
						else{
							$chforpayments.='Payment <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
						}
					}
					if($validpaidamount!=''){
						if($chforpayments!=''){
							$chforpayments.='<br> Total <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
						}
						else{
							$chforpayments.='Total <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
						}
					}
					if($chforpayments!=''){
						$sqlusepayments = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,useremarks) VALUES ('SALESPAY', ?, ?, ?, ?)");
						$sqlusepayments->bind_param("ssss", $times, $_SESSION["unqwerty"], $paymentid, $chforpayments);
						$sqlusepayments->execute();
						$sqlusepayments->close();
					}
				// }
				if($validpaidamount==$grandtotal){
					$sqler = $con->prepare("UPDATE pairinvoices SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='1' WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
    				$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $invoiceno, $invoicedate, $customerid, $_SESSION['franchisesession'], $companymainid);
    				$sqler->execute();
					$sqler->close();
					//FOR UPDATE THE PAYMENT STATUS PAID
				}
				else{
					$sqler = $con->prepare("UPDATE pairinvoices SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='2' WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
    				$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $invoiceno, $invoicedate, $customerid, $_SESSION['franchisesession'], $companymainid);
    				$sqler->execute();
					$sqler->close();
					//FOR UPDATE THE PAYMENT STATUS UNPAID
				}
			}
		}
		elseif(($invoiceterm=='CASH,CARD,GPAY')){
			$invarr = [$cashreceived,$cardreceived,$gpayreceived];
			for($termrun = 0;$termrun<count(explode(',', $invoiceterm));$termrun++){
				if ($invarr[$termrun]>0) {
					$sqlismodulespublicnames=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Payments Received' ORDER BY id ASC");
					$sqlismodulespublicnames->execute();
					$sqlismodulespublicname = $sqlismodulespublicnames->get_result();
					$infomodulespublicname=$sqlismodulespublicname->fetch_array();

					$sqlismainaccesspublicnames=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Payments Received' AND franchiseid=? ORDER BY id ASC");
					$sqlismainaccesspublicnames->bind_param("ii", $companymainid, $_SESSION["franchisesession"]);
					$sqlismainaccesspublicnames->execute();
					$sqlismainaccesspublicname = $sqlismainaccesspublicnames->get_result();
					$infomainaccesspublicname=$sqlismainaccesspublicname->fetch_array();

					$publicsqls=$con->prepare("SELECT count(publicid) FROM pairsalespayments WHERE createdid=?");
					$publicsqls->bind_param("s", $companymainid);
					$publicsqls->execute();
					$publicsql = $publicsqls->get_result();
					$publicans=$publicsql->fetch_array();

					$oldcodepublic=$publicans[0];
					$publicsql->close();
					$publicsqls->close();
					$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;

					$privatesqls=$con->prepare("SELECT count(privateid) FROM pairsalespayments WHERE createdid=? AND franchisesession=?");
					$privatesqls->bind_param("ss", $companymainid, $_SESSION["franchisesession"]);
					$privatesqls->execute();
					$privatesql = $privatesqls->get_result();
					$privateans=$privatesql->fetch_array();

					$oldcodeprivate=$privateans[0];
					$privatesql->close();
					$privatesqls->close();
					$privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;

					$sqlismainaccesspublicname->close();
					$sqlismainaccesspublicnames->close();

					$sqlismodulespublicname->close();
					$sqlismodulespublicnames->close();

					$sqlsalepayins = $con->prepare("INSERT INTO pairsalespayments (createdid,createdby,franchisesession,createdon,term,type,customername,customerid,receiptno,receiptdate,amount,paymentmode,notes,publicid,privateid) VALUES (?, ?, ?, ?, 'RECEIPT', 'invoice', ?, ?, ?, ?, ?, ?, '-', ?, ?)");
	    			$sqlsalepayins->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $customername, $customerid, $invoiceno, $invoicedate, $invarr[$termrun], explode(',', $invoiceterm)[$termrun], $publiccode, $privatecode);
	    			$sqlsalepayins->execute();
					//FOR INSERT THE PAYMENT DETAILS
					if($sqlsalepayins){
		    			$sqlsalepayins->close();
						if ($invarr[$termrun]>0) {
							$paymentid=$con->insert_id;
							$sqle = $con->prepare("INSERT INTO pairsalespayhistory (createdid,createdby,franchisesession,createdon,paymentid,customerid,invoiceno,invoicedate,amount,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'invoice')");
		    				$sqle->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $paymentid, $customerid, $invoiceno, $invoicedate, $invarr[$termrun]);
		    				$sqle->execute();
		    				$sqle->close();
						//FOR INSERT THE PAYMENT DETAILS HISTORY
							$chforpayments='PAYMENT CREATED';
							$sqlismainaccessusercuss=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Customers' ORDER BY id ASC");
							$sqlismainaccessusercuss->bind_param("s", $userid);
							$sqlismainaccessusercuss->execute();
							$sqlismainaccessusercus = $sqlismainaccessusercuss->get_result();
							$infomainaccessusercus=$sqlismainaccessusercus->fetch_array();
							$sqlismainaccessusercus->close();
							$sqlismainaccessusercuss->close();
							if($customername!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> '.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$customername.' ) </span>';
								}
								else{
									$chforpayments.=''.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$customername.' ) </span>';
								}					
							}
							if($invoicedate!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($invoicedate)).' ) </span>';
								}
								else{
									$chforpayments.=' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($invoicedate)).' ) </span>';
								}					
							}
							if($invoiceno!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
								}
								else{
									$chforpayments.='Reference Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
								}					
							}
							if(explode(',', $invoiceterm)[$termrun]!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.explode(',', $invoiceterm)[$termrun].' ) </span>';
								}
								else{
									$chforpayments.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.explode(',', $invoiceterm)[$termrun].' ) </span>';
								}					
							}
							if($invarr[$termrun]!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( '.$invarr[$termrun].' ) </span>';
								}
								else{
									$chforpayments.='Amount Received <span style="color:green;" id="prohisfromtospan">( '.$invarr[$termrun].' ) </span>';
								}					
							}
							if($invoicedate!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> <span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> (Selected) <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($invoicedate)).' ) </span>';
								}
								else{
									$chforpayments.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> (Selected) <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($invoicedate)).' ) </span>';
								}
							}
							if($invoiceno!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
								}
								else{
									$chforpayments.=''.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
								}
							}
							if($grandtotal!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> '.$infomainaccessuser['modulename'].' Amount <span style="color:green;" id="prohisfromtospan">( '.$grandtotal.' ) </span>';
								}
								else{
									$chforpayments.=''.$infomainaccessuser['modulename'].' Amount <span style="color:green;" id="prohisfromtospan">( '.$grandtotal.' ) </span>';
								}
							}
							if($validbalance!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> Balance <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
								}
								else{
									$chforpayments.='Balance <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
								}
							}
							if($invarr[$termrun]!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> Payment <span style="color:green;" id="prohisfromtospan">( '.$invarr[$termrun].' ) </span>';
								}
								else{
									$chforpayments.='Payment <span style="color:green;" id="prohisfromtospan">( '.$invarr[$termrun].' ) </span>';
								}
							}
							if($invarr[$termrun]!=''){
								if($chforpayments!=''){
									$chforpayments.='<br> Total <span style="color:green;" id="prohisfromtospan">( '.$invarr[$termrun].' ) </span>';
								}
								else{
									$chforpayments.='Total <span style="color:green;" id="prohisfromtospan">( '.$invarr[$termrun].' ) </span>';
								}
							}
							if($chforpayments!=''){
								$sqlusepayments = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,useremarks) VALUES ('SALESPAY', ?, ?, ?, ?)");
								$sqlusepayments->bind_param("ssss", $times, $_SESSION["unqwerty"], $paymentid, $chforpayments);
								$sqlusepayments->execute();
								$sqlusepayments->close();
							}
						}
						if($validpaidamount==$grandtotal){
							$sqler = $con->prepare("UPDATE pairinvoices SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='1' WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
		    				$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $invoiceno, $invoicedate, $customerid, $_SESSION['franchisesession'], $companymainid);
		    				$sqler->execute();
							$sqler->close();
							//FOR UPDATE THE PAYMENT STATUS PAID
						}
					}
				}
			}
		}
		$sqlmanualinc = $con->prepare("UPDATE pairmainaccess SET modulesuffix=modulesuffix + 1 WHERE franchiseid=? AND moduletype='Manual Journals'");
    	$sqlmanualinc->bind_param("s", $_SESSION['franchisesession']);
    	$sqlmanualinc->execute();
		$sqlmanualinc->close();
		//FOR INCREMENT THE AUTO NUMBER SERIES OF THE MANUAL JOURNAL FILE

		if($sql3){
		$invinfoch = '';
		$dateformats=$con->prepare("SELECT * FROM paricountry");
		$dateformats->execute();
		$dateformat = $dateformats->get_result();
		$datefetch=$dateformat->fetch_array();
		if ($datefetch['date']=='DD/MM/YYYY') {
			$date = 'd/m/Y';
		}
		$dateformat->close();
		$dateformats->close();
		$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
		$sqlismainaccessusers->bind_param("i", $userid);
		$sqlismainaccessusers->execute();
		$sqlismainaccessuser = $sqlismainaccessusers->get_result();
		$infomainaccessuser=$sqlismainaccessuser->fetch_array();
		$sqlismainaccessuser->close();
		$sqlismainaccessusers->close();
		if($invoiceno!=''){
			if($invinfoch!=''){
				$invinfoch.='<br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
			}
			else{
				$invinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$invoiceno.' ) </span>';
			}                   
		}
		if($invoicedate!=''){
			if($invinfoch!=''){
				$invinfoch.='<br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($invoicedate)).' ) </span>';
			}
			else{
				$invinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($invoicedate)).' ) </span>';
			}                   
		}
		if($reference!=''){
			if($invinfoch!=''){
				$invinfoch.='<br> Reference <span style="color:green;" id="prohisfromtospan">( '.$reference.' ) </span>';
			}
			else{
				$invinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Reference <span style="color:green;" id="prohisfromtospan">( '.$reference.' ) </span>';
			}                   
		}
		if($saleperson!=''){
			if($invinfoch!=''){
				$invinfoch.='<br> Sale Person <span style="color:green;" id="prohisfromtospan">( '.$saleperson.' ) </span>';
			}
			else{
				$invinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Sale Person <span style="color:green;" id="prohisfromtospan">( '.$saleperson.' ) </span>';
			}                   
		}
		if($preparedby!=''){
			if($invinfoch!=''){
				$invinfoch.='<br> Prepared By <span style="color:green;" id="prohisfromtospan">( '.$preparedby.' ) </span>';
			}
			else{
				$invinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Prepared By <span style="color:green;" id="prohisfromtospan">( '.$preparedby.' ) </span>';
			}                   
		}
		if($checkedby!=''){
			if($invinfoch!=''){
				$invinfoch.='<br> Checked By <span style="color:green;" id="prohisfromtospan">( '.$checkedby.' ) </span>';
			}
			else{
				$invinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Checked By <span style="color:green;" id="prohisfromtospan">( '.$checkedby.' ) </span>';
			}                   
		}
		//FOR INVOICE INFORMATIONS HISTORY DETAILS
		$invcustinfoch = '';
		$sqlismainaccessusercuss=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Customers' ORDER BY id ASC");
    	$sqlismainaccessusercuss->bind_param("s", $userid);
		$sqlismainaccessusercuss->execute();
		$sqlismainaccessusercus = $sqlismainaccessusercuss->get_result();
		$infomainaccessusercus=$sqlismainaccessusercus->fetch_array();
		$sqlismainaccessusercus->close();
		$sqlismainaccessusercuss->close();
		if($customername!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> '.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$customername.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> '.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$customername.' ) </span>';
			}                   
		}
		if($twoage!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> AGE <span style="color:green;" id="prohisfromtospan">( '.$twoage.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> AGE <span style="color:green;" id="prohisfromtospan">( '.$twoage.' ) </span>';
			}                   
		}
		if($twosex!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> SEX <span style="color:green;" id="prohisfromtospan">( '.$twosex.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> SEX <span style="color:green;" id="prohisfromtospan">( '.$twosex.' ) </span>';
			}                   
		}
		if($area!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> BILLING STREET <span style="color:green;" id="prohisfromtospan">( '.$area.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> BILLING STREET <span style="color:green;" id="prohisfromtospan">( '.$area.' ) </span>';
			}                   
		}
		if($city!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> BILLING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( '.$city.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> BILLING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( '.$city.' ) </span>';
			}                   
		}
		if($state!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> BILLING STATE <span style="color:green;" id="prohisfromtospan">( '.$state.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> BILLING STATE <span style="color:green;" id="prohisfromtospan">( '.$state.' ) </span>';
			}                   
		}
		if($district!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> BILLING PIN <span style="color:green;" id="prohisfromtospan">( '.$district.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> BILLING PIN <span style="color:green;" id="prohisfromtospan">( '.$district.' ) </span>';
			}                   
		}
		if($pincode!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> BILLING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( '.$pincode.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> BILLING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( '.$pincode.' ) </span>';
			}                   
		}
		if($sarea!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> SHIPPING STREET <span style="color:green;" id="prohisfromtospan">( '.$sarea.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> SHIPPING STREET <span style="color:green;" id="prohisfromtospan">( '.$sarea.' ) </span>';
			}                   
		}
		if($scity!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> SHIPPING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( '.$scity.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> SHIPPING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( '.$scity.' ) </span>';
			}                   
		}
		if($sstate!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> SHIPPING STATE <span style="color:green;" id="prohisfromtospan">( '.$sstate.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> SHIPPING STATE <span style="color:green;" id="prohisfromtospan">( '.$sstate.' ) </span>';
			}                   
		}
		if($sdistrict!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> SHIPPING PIN <span style="color:green;" id="prohisfromtospan">( '.$sdistrict.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> SHIPPING PIN <span style="color:green;" id="prohisfromtospan">( '.$sdistrict.' ) </span>';
			}                   
		}
		if($spincode!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> SHIPPING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( '.$spincode.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> SHIPPING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( '.$spincode.' ) </span>';
			}                   
		}
		if($twoworkphone!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> WORK PHONE <span style="color:green;" id="prohisfromtospan">( '.$twoworkphone.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> WORK PHONE <span style="color:green;" id="prohisfromtospan">( '.$twoworkphone.' ) </span>';
			}                   
		}
		if($twomobilephone!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> MOBILE PHONE <span style="color:green;" id="prohisfromtospan">( '.$twomobilephone.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> MOBILE PHONE <span style="color:green;" id="prohisfromtospan">( '.$twomobilephone.' ) </span>';
			}                   
		}
		if($gstrtype!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> GST TREATMENT <span style="color:green;" id="prohisfromtospan">( '.$gstrtype.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> GST TREATMENT <span style="color:green;" id="prohisfromtospan">( '.$gstrtype.' ) </span>';
			}                   
		}
		if($gstno!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> GSTIN <span style="color:green;" id="prohisfromtospan">( '.$gstno.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> GSTIN <span style="color:green;" id="prohisfromtospan">( '.$gstno.' ) </span>';
			}                   
		}
		if($pos!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> PLACE OF SUPPLY <span style="color:green;" id="prohisfromtospan">( '.$pos.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> PLACE OF SUPPLY <span style="color:green;" id="prohisfromtospan">( '.$pos.' ) </span>';
			}                   
		}
		if($dlno20!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> DL No 20 <span style="color:green;" id="prohisfromtospan">( '.$dlno20.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> DL No 20 <span style="color:green;" id="prohisfromtospan">( '.$dlno20.' ) </span>';
			}                   
		}
		if($dlno21!=''){
			if($invcustinfoch!=''){
				$invcustinfoch.='<br> DL No 21 <span style="color:green;" id="prohisfromtospan">( '.$dlno21.' ) </span>';
			}
			else{
				$invcustinfoch.=''.(($invinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessusercus['modulename'].' Information</span> <br> DL No 21 <span style="color:green;" id="prohisfromtospan">( '.$dlno21.' ) </span>';
			}                   
		}
		//FOR INVOICE CUSTOMER INFORMATIONS DETAILS HISTORY
		$inviteminfoch = '';
		$sqlismainaccessuserpros=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Products' ORDER BY id ASC");
    	$sqlismainaccessuserpros->bind_param("s", $userid);
		$sqlismainaccessuserpros->execute();
		$sqlismainaccessuserpro = $sqlismainaccessuserpros->get_result();
		$infomainaccessuserpro=$sqlismainaccessuserpro->fetch_array();
		$sqlismainaccessuserpro->close();
		$sqlismainaccessuserpros->close();
		for($i=0; $i<count($_POST['productname']); $i++){
			$productid = htmlspecialchars($_POST['productid'][$i], ENT_QUOTES, 'UTF-8');
			$productname = htmlspecialchars($_POST['productname'][$i], ENT_QUOTES, 'UTF-8');
			$manufacturer = htmlspecialchars($_POST['manufacturer'][$i], ENT_QUOTES, 'UTF-8');
			$producthsn = htmlspecialchars($_POST['producthsn'][$i], ENT_QUOTES, 'UTF-8');
			$productnotes = htmlspecialchars($_POST['productnotes'][$i], ENT_QUOTES, 'UTF-8');
			$productdescription = htmlspecialchars($_POST['productdescription'][$i], ENT_QUOTES, 'UTF-8');
			$itemmodule = htmlspecialchars($_POST['itemmodule'][$i], ENT_QUOTES, 'UTF-8');
			$rack = htmlspecialchars($_POST['rack'][$i], ENT_QUOTES, 'UTF-8');
			if ($access['batchexpiryval']==1) {
				$batch = htmlspecialchars($_POST['batch'][$i], ENT_QUOTES, 'UTF-8');
				$expdate = htmlspecialchars($_POST['expdate'][$i], ENT_QUOTES, 'UTF-8');
			}
			else{
				$batch='';
				$expdate='';
			}
			$mrp=htmlspecialchars( (($_POST['mrp'][$i]!='')?$_POST['mrp'][$i]:0), ENT_QUOTES, 'UTF-8');
			$vat = floatval(htmlspecialchars($_POST['vat'][$i], ENT_QUOTES, 'UTF-8'));
			$quantity = floatval(htmlspecialchars($_POST['quantity'][$i], ENT_QUOTES, 'UTF-8'));
			$unit = htmlspecialchars($_POST['productunit'][$i], ENT_QUOTES, 'UTF-8');
			$productrate = floatval(htmlspecialchars($_POST['productrate'][$i], ENT_QUOTES, 'UTF-8'));
			$noofpacks = floatval(htmlspecialchars($_POST['noofpacks'][$i], ENT_QUOTES, 'UTF-8'));
			$prodiscount = floatval(htmlspecialchars($_POST['prodiscount'][$i], ENT_QUOTES, 'UTF-8'));
			$prodiscounttype = htmlspecialchars($_POST['prodiscounttype'][$i], ENT_QUOTES, 'UTF-8');
			$productvalue = floatval(htmlspecialchars($_POST['productvalue'][$i], ENT_QUOTES, 'UTF-8'));
			$taxvalue = floatval(htmlspecialchars($_POST['taxvalue'][$i], ENT_QUOTES, 'UTF-8'));
			$productnetvalue = floatval(htmlspecialchars($_POST['productnetvalue'][$i], ENT_QUOTES, 'UTF-8'));
			$marginupdates = htmlspecialchars($_POST['marginupdates'][$i], ENT_QUOTES, 'UTF-8');
			$margintotalvalue = floatval(htmlspecialchars($_POST['margintotalvalue'][$i], ENT_QUOTES, 'UTF-8'));
			if($productname!=''){
				if($productname!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$productname.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$productname.' ) </span>';
					}                   
				}
				if($manufacturer!=' '){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( '.$manufacturer.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( '.$manufacturer.' ) </span>';
					}                   
				}
				if($producthsn!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> HSN Code <span style="color:green;" id="prohisfromtospan">( '.$producthsn.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> HSN Code <span style="color:green;" id="prohisfromtospan">( '.$producthsn.' ) </span>';
					}                   
				}
				if($productdescription!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( '.$productdescription.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( '.$productdescription.' ) </span>';
					}                   
				}
				if($batch!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Batch <span style="color:green;" id="prohisfromtospan">( '.$batch.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Batch <span style="color:green;" id="prohisfromtospan">( '.$batch.' ) </span>';
					}                   
				}
				if($expdate!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Expiry <span style="color:green;" id="prohisfromtospan">( '.$expdate.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Expiry <span style="color:green;" id="prohisfromtospan">( '.$expdate.' ) </span>';
					}                   
				}
				if($productrate!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Rate <span style="color:green;" id="prohisfromtospan">( '.$productrate.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Rate <span style="color:green;" id="prohisfromtospan">( '.$productrate.' ) </span>';
					}                   
				}
				if($mrp!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Mrp <span style="color:green;" id="prohisfromtospan">( '.$mrp.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Mrp <span style="color:green;" id="prohisfromtospan">( '.$mrp.' ) </span>';
					}                   
				}
				if($quantity!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Quantity <span style="color:green;" id="prohisfromtospan">( '.$quantity.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Quantity <span style="color:green;" id="prohisfromtospan">( '.$quantity.' ) </span>';
					}                   
				}
				if($unit!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Unit <span style="color:green;" id="prohisfromtospan">( '.$unit.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Unit <span style="color:green;" id="prohisfromtospan">( '.$unit.' ) </span>';
					}                   
				}
				if($noofpacks!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Pack <span style="color:green;" id="prohisfromtospan">( '.$noofpacks.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Pack <span style="color:green;" id="prohisfromtospan">( '.$noofpacks.' ) </span>';
					}                   
				}
				if($productvalue!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Taxable Value <span style="color:green;" id="prohisfromtospan">( '.$productvalue.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Taxable Value <span style="color:green;" id="prohisfromtospan">( '.$productvalue.' ) </span>';
					}                   
				}
				if($prodiscount!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> '.$access['txtprodisinv'].' <span style="color:green;" id="prohisfromtospan">( '.$prodiscount.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtprodisinv'].' <span style="color:green;" id="prohisfromtospan">( '.$prodiscount.' ) </span>';
					}                   
				}
				if($prodiscounttype!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Discounted By <span style="color:green;" id="prohisfromtospan">( '.(($prodiscounttype==0)?'%':'?').' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discounted By <span style="color:green;" id="prohisfromtospan">( '.(($prodiscounttype==0)?'%':'?').' ) </span>';
					}                   
				}
				if($taxvalue!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Tax Value <span style="color:green;" id="prohisfromtospan">( '.$taxvalue.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Tax Value <span style="color:green;" id="prohisfromtospan">( '.$taxvalue.' ) </span>';
					}                   
				}
				if($vat!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Gst <span style="color:green;" id="prohisfromtospan">( '.$vat.' % ('.$ansforsepgstval.') ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Gst <span style="color:green;" id="prohisfromtospan">( '.$vat.' % ('.$ansforsepgstval.') ) </span>';
					}                   
				}
				if($productnetvalue!=''){
					if($inviteminfoch!=''){
						$inviteminfoch.='<br> Amount <span style="color:green;" id="prohisfromtospan">( '.$productnetvalue.' ) </span>';
					}
					else{
						$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Amount <span style="color:green;" id="prohisfromtospan">( '.$productnetvalue.' ) </span>';
					}                   
				}
			}
		}
		//FOR PRODUCT ALL ROWS HISTORY IN LOOPING
		if($totalitems!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Total Items <span style="color:green;" id="prohisfromtospan">( '.$totalitems.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Items <span style="color:green;" id="prohisfromtospan">( '.$totalitems.' ) </span>';
			}                   
		}
		if($totalquantity!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Total Qty <span style="color:green;" id="prohisfromtospan">( '.$totalquantity.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Qty <span style="color:green;" id="prohisfromtospan">( '.$totalquantity.' ) </span>';
			}                   
		}
		if($totalamount!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Sub Total <span style="color:green;" id="prohisfromtospan">( '.$totalamount.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sub Total <span style="color:green;" id="prohisfromtospan">( '.$totalamount.' ) </span>';
			}                   
		}
		if($discountamount!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Discount <span style="color:green;" id="prohisfromtospan">( '.$discountamount.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discount <span style="color:green;" id="prohisfromtospan">( '.$discountamount.' ) </span>';
			}                   
		}
		if($totalvatamount!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Total Tax <span style="color:green;" id="prohisfromtospan">( '.$totalvatamount.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Tax <span style="color:green;" id="prohisfromtospan">( '.$totalvatamount.' ) </span>';
			}                   
		}
		if($roundoff!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Round Off <span style="color:green;" id="prohisfromtospan">( '.$roundoff.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Round Off <span style="color:green;" id="prohisfromtospan">( '.$roundoff.' ) </span>';
			}                   
		}
		if($grandtotal!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Grand Total <span style="color:green;" id="prohisfromtospan">( '.$grandtotal.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Grand Total <span style="color:green;" id="prohisfromtospan">( '.$grandtotal.' ) </span>';
			}                   
		}
		if($description!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( '.$description.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( '.$description.' ) </span>';
			}                   
		}
		if($notes!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
			}                   
		}
		if($terms!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Terms And Conditions <span style="color:green;" id="prohisfromtospan">( '.$terms.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Terms And Conditions <span style="color:green;" id="prohisfromtospan">( '.$terms.' ) </span>';
			}                   
		}
		if($fileattach!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Attach <span style="color:green;" id="prohisfromtospan">( Added ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Attach <span style="color:green;" id="prohisfromtospan">( Added ) </span>';
			}                   
		}
		if($invoiceterm!=''){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Payment Method <span style="color:green;" id="prohisfromtospan">( '.$invoiceterm.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Payment Method <span style="color:green;" id="prohisfromtospan">( '.$invoiceterm.' ) </span>';
			}                   
		}
		if($validpaidamount!=''&&$invoiceterm=='CASH'){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> '.(($access['definvpay']=='split')?'Amount Received':'Cash Received').' <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.(($access['definvpay']=='split')?'Amount Received':'Cash Received').' <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
			}                   
		}
		if($validpaidamount!=''&&$invoiceterm=='CASH,CARD,GPAY'){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> '.(($access['definvpay']=='split')?'Amount Received':'Cash Received').' <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.(($access['definvpay']=='split')?'Amount Received':'Cash Received').' <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
			}                   
		}
		if($validbalance!=''&&$invoiceterm=='CASH'){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Change Due <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Change Due <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
			}                   
		}
		if($validbalance!=''&&$invoiceterm=='CASH,CARD,GPAY'){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Change Due <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Change Due <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
			}                   
		}
		if($duedates!=''&&$invoiceterm=='CREDIT'){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Due Term <span style="color:green;" id="prohisfromtospan">( '.$duedates.' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Due Term <span style="color:green;" id="prohisfromtospan">( '.$duedates.' ) </span>';
			}                   
		}
		if($duedate!=''&&$invoiceterm=='CREDIT'){
			if($inviteminfoch!=''){
				$inviteminfoch.='<br> Due Date <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($duedate)).' ) </span>';
			}
			else{
				$inviteminfoch.=''.(($invinfoch!=''||$invcustinfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Due Date <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($duedate)).' ) </span>';
			}                   
		}
		//FOR INVOICE OTHER INFORMATIONS LIKE PAYMENT AND TERMS AND DESCRIPTION......
		$invtotinfoch = "INVOICE CREATED<br>".$invinfoch.$invcustinfoch.$inviteminfoch;
		if($invtotinfoch!=''){
			$sqluse = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,uniqueid,useremarks) VALUES ('INVOICES', ?, ?, ?, ?, ?)");
    		$sqluse->bind_param("sssss", $times, $_SESSION["unqwerty"], $invoiceno, $salesid, $invtotinfoch);
    		$sqluse->execute();
    		$sqluse->close();
		}
		//FOR INVOICE HISTORY

		$sqliinvoices=$con->prepare("SELECT invoiceamount, invoicedate, invoiceno FROM pairinvoices WHERE franchisesession=? AND createdid=? AND customerid=? GROUP BY invoicedate, invoiceno ORDER BY invoicedate DESC, invoiceno DESC");
    	$sqliinvoices->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $customerid);
		$sqliinvoices->execute();
		$sqliinvoice = $sqliinvoices->get_result();
		$invoiceamount=0;
		$balanceamount=0;
		$currentamount=0;
		$overdueamount=0;
		while($infoinvoice=$sqliinvoice->fetch_array()){
			$invoiceamount+=(float)$infoinvoice['invoiceamount'];
			$paidamount=0;
			$sqlsalespays=$con->prepare("SELECT amount FROM pairsalespayhistory WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? AND customerid=? ORDER BY id ASC");
    		$sqlsalespays->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $infoinvoice['invoiceno'], $infoinvoice['invoicedate'], $customerid);
			$sqlsalespays->execute();
			$sqlsalespay = $sqlsalespays->get_result();
			while($infosalespay=$sqlsalespay->fetch_array()){
				$paidamount+=(float)$infosalespay['amount'];
			}
			$balanceamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
			$diff = abs(time() - strtotime($infoinvoice['invoicedate']));
			$days = floor(($diff)/ (60*60*24));
			if($days>30){
				$overdueamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
			}
			else{
				$currentamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
			}
			$sqlsalespay->close();
			$sqlsalespays->close();
		}
		$sqliinvoice->close();
		$sqliinvoices->close();
		$sqlicreditnotes=$con->prepare("SELECT creditnoteamount, creditnotedate, creditnoteno FROM paircreditnotes WHERE franchisesession=? AND createdid=? AND customerid=? GROUP BY creditnotedate, creditnoteno ORDER BY creditnotedate DESC, creditnoteno DESC");
		$sqlicreditnotes->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $customerid);
		$sqlicreditnotes->execute();
		$sqlicreditnote = $sqlicreditnotes->get_result();
		while($infocreditnote=$sqlicreditnote->fetch_array()){
			$invoiceamount+=(float)$infocreditnote['creditnoteamount'];
			$paidamount=0;
			$sqlsalespays=$con->prepare("SELECT amount FROM paircreditnotepayhistory WHERE franchisesession=? AND createdid=? AND creditnoteno=? AND creditnotedate=? AND customerid=? ORDER BY id ASC");
			$sqlsalespays->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $infocreditnote['creditnoteno'], $infocreditnote['creditnotedate'], $customerid);
			$sqlsalespays->execute();
			$sqlsalespay = $sqlsalespays->get_result();
			while($infosalespay=$sqlsalespay->fetch_array()){
				$paidamount+=(float)$infosalespay['amount'];
			}
			$balanceamount-=((float)$infocreditnote['creditnoteamount']);
			$diff = abs(time() - strtotime($infocreditnote['creditnotedate']));
			$days = floor(($diff)/ (60*60*24));
			if($days>30){
				$overdueamount-=((float)$infocreditnote['creditnoteamount']);
			}
			else{
				$currentamount-=((float)$infocreditnote['creditnoteamount']);
			}
			$sqlsalespay->close();
			$sqlsalespays->close();
		}
		$sqlicreditnote->close();
		$sqlicreditnotes->close();
		$cussqlup = $con->prepare("UPDATE paircustomers SET invoiceamount=?, balanceamount=?, currentamount=?, overdueamount=? WHERE id=?");
    	$cussqlup->bind_param("ssssi", $invoiceamount, $balanceamount, $currentamount, $overdueamount, $customerid);
    	$cussqlup->execute();
		$cussqlup->close();
		//FOR UPDATE THE CUSTOMERS BALANCE AND OTHER PAYMENT INFORMATIONS
		if(isset($_POST['submit1'])){
			echo '<script> window.open("invoiceprint.php?invoiceno='.$invoiceno.'&invoicedate='.$invoicedate.'", "_blank");</script>';
			echo '<script> window.location.href="invoices.php?remarks=Added Successfully";</script>';
		}
		else{
			$sqlusefinal = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,uniqueid,useremarks) VALUES ('INVOICES', ?, ?, ?, ?, '<span style=\"color:green;\" id=\"prohisfromtospan\">Added Successfully</span>')");
    		$sqlusefinal->bind_param("ssss", $times, $_SESSION["unqwerty"], $invoiceno, $salesid);
    		$sqlusefinal->execute();
    		$sqlusefinal->close();
    		if ($access['invautosave']=='1') {
    			echo '<script> window.location.href="invoiceedit.php?id='.$salesid.'&invoiceno='.$invoiceno.'&invoicedate='.$invoicedate.'&remarks=Added Successfully";</script>';
    		}
    		else{
    			echo '<script> window.location.href="invoiceview.php?id='.$salesid.'&invoiceno='.$invoiceno.'&invoicedate='.$invoicedate.'&remarks=Added Successfully";</script>';
    		}
		}
	}
}
else{
	header("Location: invoices.php?error=Error Data");
	//FOR IF THE INVOICE IS ALREADY EXISTS IN THIS NUMBER AND DATE AND FRANCHISE AND COMPANY
}
}
$sqlismainaccessusercuss=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Customers' ORDER BY id ASC");
$sqlismainaccessusercuss->bind_param("s", $userid);
$sqlismainaccessusercuss->execute();
$sqlismainaccessusercus = $sqlismainaccessusercuss->get_result();
$infomainaccessusercus=$sqlismainaccessusercus->fetch_array();
$sqlismainaccessusercus->close();
$sqlismainaccessusercuss->close();
//FOR GET CUSTOMER MODULENAME AND OTHER DETAILS
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="favicon.ico">
	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
	<!-- FOR ADDING CSS -->
	<?php
		include('externals.php');
	?>
	<!-- FOR ADDING COMMON CSS FILE -->
	<title> New <?= $infomainaccessuser['modulename'] ?> </title>
	<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<!-- FOR ADDING TITLE -->
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6">
	<div id="loadimgbiggerscrrbackgrey" style="display:none;z-index: 10;width: 100%;height: 100%;position: absolute;background-color: #7f7f7f;opacity: 0.5;"></div>
	<?php
		// sidebar
		include('sidebar.php');
	?>
	<!-- FOR ADDING SIDEBAR -->
<main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
	<?php
		// navbar
		include('navhead.php');
	?>
	<!-- FOR ADDING NAVBAR -->
	<div class="container-fluid py-4 bg-body">
		<?php
			// notifications
			if(isset($_GET['remarks'])){
		?>
		<div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
			<button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button>
			<p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
				<i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?>
			</p>
		</div>
		<?php
			}
		?>
		<?php
			if(isset($_GET['error'])){
		?>
		<div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
			<button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button>
			<p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
				<i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?>
			</p>
		</div>
		<!-- FOR ALERT MESSAGES -->
		<?php
			}
			$sqlismainaccessusers=$con->prepare("SELECT moduleno, moduleprefix, modulesuffix,modulename FROM pairmainaccess WHERE franchiseid=? AND moduletype='Invoices' ORDER BY id ASC");
    		$sqlismainaccessusers->bind_param("s", $_SESSION['franchisesession']);
			$sqlismainaccessusers->execute();
			$sqlismainaccessuser = $sqlismainaccessusers->get_result();
			$infomainaccessuser=$sqlismainaccessuser->fetch_array();
			$sqlismainaccessuser->close();
			$sqlismainaccessusers->close();
		?>
		<!-- FOR INVOICE MODULE INFORMATIONS AND PREFERENCES -->
		<div style="max-width: 1650px;">
			<div class="row min-height-480">
				<div class="col-12">
					<div class="card mb-4 mt-5">
						<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
							<p style="font-size:20px;margin-top: -9px !important;margin-bottom: 6px !important;"><i class="fa fa-file-import"></i> New <?= $infomainaccessuser['modulename'] ?></p>
							<?php
								$sqlismainaccessusers=$con->prepare("SELECT moduleno, moduleprefix, modulesuffix,modulename FROM pairmainaccess WHERE franchiseid=? AND moduletype='Invoices' ORDER BY id ASC");
    							$sqlismainaccessusers->bind_param("s", $_SESSION['franchisesession']);
								$sqlismainaccessusers->execute();
								$sqlismainaccessuser = $sqlismainaccessusers->get_result();
								$infomainaccessuser=$sqlismainaccessuser->fetch_array();
								$sqlismainaccessuser->close();
								$sqlismainaccessusers->close();
								if($infomainaccessuser['moduleno']!='1'){
									// IF THE FILE WAS DISABLED BY THE FRANCHISE
							?>
								<div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise</div>
							<?php
								}
								else{
									// THIS FILE NOT DISABLED BY THE FRANCHISE
									// $sqligsts=$con->prepare("SELECT gstno FROM pairgst WHERE companymainid=?");
    								// $sqligsts->bind_param("s", $companymainid);
									// $sqligsts->execute();
									// $sqligst = $sqligsts->get_result();
									// $infogst=$sqligst->fetch_array();
									// $sqligst->close();
									// $sqligsts->close();
									// FOR GST INFORMATIONS

									$sqlismainaccessuserpros=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Products' ORDER BY id ASC");
    								$sqlismainaccessuserpros->bind_param("s", $userid);
									$sqlismainaccessuserpros->execute();
									$sqlismainaccessuserpro = $sqlismainaccessuserpros->get_result();
									$infomainaccessuserpro=$sqlismainaccessuserpro->fetch_array();
									$sqlismainaccessuserpro->close();
									$sqlismainaccessuserpros->close();
									// FOR PRODUCT MODULE INFORAMTIONS AND ACCESSES
							?>
							<hr class="p-0 mt-1" style="margin-bottom:6px !important;">
							<div class="modal fade" id="TimerAlertModal" tabindex="-1" role="dialog">
								<div class="modal-dialog modal-md" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">
												ALERT !
											</h5>
											<span type="button" onclick="funestimeralertmodal()" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true" id="procloseicon">&times;</span>
											</span>
										</div>
										<div class="modal-body mbsub" id="promodal">
											<p class="blink10seconds">Only <span id="lessthanten">10</span> Seconds Left Plese Do It Faster</p>
										</div>
									</div>
								</div>
							</div>
							<!-- TIMER ALERT MODAL -->
							<!--------------------------- product add start --------------------------->
							<div class="modal fade" id="AddNewProduct" tabindex="-1" role="dialog">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">
												New <?=$infomainaccessuserpro['modulename']?>
											</h5>
											<span type="button" onclick="funesproduct()" class="close" data-dismiss="modal" aria-label="Close">
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
													<button onclick="funaddproduct()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit" name="submitproduct" id="submitproduct" value="Submit">
														<span class="label">Save</span>
														<span class="spinner"></span>
													</button>
													<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funesproduct()">
													Cancel
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- PRODUCT ADD MODAL -->
							<!--------------------------- product add end --------------------------->
							<!--------------------------- frequent product start --------------------------->
							<div class="modal fade" id="Viewfrequentproduct" tabindex="-1" role="dialog">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">
												Frequently Bought <?=$infomainaccessuserpro['modulename']?>
											</h5>
											<span type="button" onclick="funesfrequentproduct()" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true" id="procloseicon">&times;</span>
											</span>
										</div>
										<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-0" role="form">
											<div class="modal-body mbsub">
												<?php
													include("frequentproduct.php");
												?>
											</div>
											<div class="modal-footer mfsub" style="margin: 0px 9px !important;border-top: 1px solid #b6bcc5 !important;">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- FREQUENT PRODUCT MODAL -->
							<!--------------------------- frequent product close --------------------------->
							<!--------------------------- margin details start --------------------------->
							<div class="modal fade" id="ViewMarginDetails" tabindex="-1" role="dialog">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header" style="padding: 7px 18px !important;">
											<h5 class="modal-title" id="exampleModalLabel" style="font-size: 20px !important;">
												Profit Margin Details
											</h5>
											<span type="button" onclick="funesmargindetails()" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true" id="procloseicon">&times;</span>
											</span>
										</div>
										<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-0" role="form">
											<div class="modal-body mbsub">
												<?php
													include("margindetails.php");
												?>
											</div>
											<div class="modal-footer mfsub" style="margin: 0px 9px !important;border-top: 1px solid #b6bcc5 !important;">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- MARGIN DETAILS MODAL -->
							<!--------------------------- margin details close --------------------------->
							<!--------------------------- customer view start --------------------------->
							<div class="modal fade" id="Viewcustdetails" tabindex="-1" role="dialog">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">
												<?= $infomainaccessusercus['modulename'] ?> Details
											</h5>
											<span type="button" onclick="funescustomerview()" class="close" data-dismiss="modal" aria-label="Close">
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
							<!-- CUSTOMER VIEW MODAL -->
							<!--------------------------- customer view close --------------------------->
							<!--------------------------- Start AddNewCustomer modal --------------------------->
							<link href="customeradd.css" rel="stylesheet">
							<div class="modal fade" id="custAddNewCustomer" tabindex="-1" role="dialog">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content" style="border-radius: 0px;">
										<div class="modal-header" style="border-radius:0px !important;">
											<h5 class="modal-title" style="color:#212529;">
												New <?= $infomainaccessusercus['modulename'] ?>
											</h5>
											<span type="button" onclick="funescustomer()" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true" style="font-size: 21px;font-weight: 600;">&times;</span>
											</span>
										</div>
										<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">
											<div class="modal-body" id="custmodal" style="padding-bottom: 0px !important;margin-bottom: -24.5px !important;">
												<?php
													include("customeraddmodal.php");
												?>
											</div>
											<div class="modal-footer " style="display: block;margin-top: 24px !important;">
												<div class="col">
													<button onclick="funaddcustomer()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit" name="custsubmitcustomer" id="custsubmitcustomer" value="Submit">
														<span class="label">Save</span>
														<span class="spinner"></span>
													</button>
													<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funescustomer()">
														Cancel
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- CUSTOMER ADD MODAL -->
							<!--------------------------- End AddNewCustomer modal --------------------------->
							<form autocomplete="off" id="invoiceform" action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
								<div style="display:none;position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10;" id="loadimgbiggerscr">
    								<img src="loading.gif" alt="Loading..." id="loadimgbiggerscrr" style="position: relative; width: 250px; height: 250px; background-color: white;box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);z-index: 9;">
    								<div style="position: absolute; top: 10px; right: 10px; z-index: 10;" onclick="closebigload()">
        								<i class="fa fa-close"></i>
    								</div>
								</div>
								<div class="row">
									<?php
										// if ((in_array('Invoice Information', $fieldadd))) {
									?>
									<div class="col-lg-4">
										<div class="accordion" id="accordionRental">
											<div class="accordion-item mb-1">
												<h5 class="accordion-header" id="headingTwo">
													<button class="accordion-button font-weight-bold" type="button">
														<div class="customcont-header ml-0 mb-1" style="height: 30px;">
															<a class="customcont-heading" style="padding: 7px 0 7px;">
																<?= $infomainaccessuser['modulename'] ?> Information
															</a>
														</div>
													</button>
												</h5>
												<div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
													<div class="accordion-body text-sm" style="background-color:#fbfafa;" id="modulegreydesign">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="invoiceno" class="custom-label">
																			<span class="text-danger">
																				<?= $infomainaccessuser['modulename'] ?> Number *
																			</span>
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control form-control-sm" id="invoiceno" name="invoiceno" required value="<?=$infomainaccessuser['moduleprefix']?><?=str_pad(($infomainaccessuser['modulesuffix']+1), 0, "0", STR_PAD_LEFT)?>" readonly>
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="invoicedate" class="custom-label">
																			<span class="text-danger">
																				<?= $infomainaccessuser['modulename'] ?> Date *
																			</span>
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<?php
																			$dateformats=$con->prepare("SELECT * FROM paricountry");
																			$dateformats->execute();
																			$dateformat = $dateformats->get_result();
																			$datefetch=$dateformat->fetch_array();
																			if ($datefetch['date']=='DD/MM/YYYY') {
																				$date = date('d-m-Y');
																			}
																			$dateformat->close();
																			$dateformats->close();
																			$dt = new DateTime();
																		?>
																		<input type="date" class="form-control form-control-sm" id="invoicedate" name="invoicedate" value="<?= $dt->format('Y-m-d') ?>" required>
																	</div>
																</div>
															</div>
															<div class="col-lg-12" <?=((in_array('Invoice Time', $fieldadd))?'':'style="display:none;"')?>>
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="invoicetime" class="custom-label">
																			<span class="text-danger">
																				<?= $infomainaccessuser['modulename'] ?> Time *
																			</span>
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<?php
																			$current_time_def = date('H:i:s');
																		?>
																		<input type="time" class="form-control form-control-sm" value="<?php echo $current_time_def; ?>" id="invoicetime" name="invoicetime" required>
																	</div>
																</div>
															</div>
														<?php
															if ((in_array('Reference', $fieldadd))) {
														?>
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="reference" class="custom-label">
																			Reference
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control form-control-sm" id="reference" name="reference" oninput="referget()" autocomplete="off">
																			<div id="referencedropdown" class="dvi" style="display:none;width: 186px;z-index: 1;"></div>
																			<input type="text" id="errrefer" style="display:none;">
																	</div>
																</div>
															</div>
														<?php
															}
														?>
														<?php
															if ((in_array('Sale Person', $fieldadd))) {
														?>
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="saleperson" class="custom-label">
																			Sale Person
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<select class="select2-field form-control form-control-sm" name="saleperson" id="saleperson">
																			<option selected disabled>Select</option>
																			<?php
																				$sqlis=$con->prepare("SELECT saleperson FROM pairsaleperson WHERE (createdid=? OR createdid='0') ORDER BY saleperson ASC");
    																			$sqlis->bind_param("s", $companymainid);
																				$sqlis->execute();
																				$sqli = $sqlis->get_result();
																				while($info=$sqli->fetch_array()){
																			?>
																				<option value="<?= $info['saleperson'] ?>"><?= $info['saleperson'] ?></option>
																			<?php
																				}
																				$sqli->close();
																				$sqlis->close();
																			?>
																		</select>
																	</div>
																</div>
															</div>
														<?php
															}
														?>
															<div class="col-lg-12" <?=((in_array('Prepared By', $fieldadd))?'':'style="display:none;"')?>>
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="preparedby" class="custom-label">
																			Prepared By
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control form-control-sm" id="preparedby" maxlength="350" name="preparedby">
																	</div>
																</div>
															</div>
															<div class="col-lg-12" <?=((in_array('Checked By', $fieldadd))?'':'style="display:none;"')?>>
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="checkedby" class="custom-label">
																			Checked By
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control form-control-sm" id="checkedby" maxlength="350" name="checkedby">
																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- FOR INVOICE INFORMATIONS -->
									<?php
										// }
									?>
									<input type="hidden" id="custoriginpage">
									<input type="hidden" id="prooriginpage">
									<?php
										// if ((in_array('Customer Information', $fieldadd))) {
									?>
										<div class="col-lg-8">
											<div class="accordion" id="accordionRental">
												<div class="accordion-item mb-1">
													<h5 class="accordion-header" id="headingOne">
														<button class="accordion-button font-weight-bold" type="button" id="customerinfotoggler">
															<div class="row" style="width:100% !important;">
																<div class="col-lg-6" id="customerinfofirst">
																	<div class="customcont-header ml-0 mb-1" style="height: 30px;">
																		<a class="customcont-heading" style="padding: 7px 0 7px;">
																			<?= $infomainaccessusercus['modulename'] ?> Information
																		</a>
																		<input type="hidden" id="propos">
																		<input type="hidden" id="proposfinal">
																		<!-- <input type="hidden" id="dlno20" name="dlno20"> -->
																		<!-- <input type="hidden" id="dlno21" name="dlno21"> -->
																	</div>
																</div>
															<div class="col-lg-6" id="customerinfosecond" style="margin-bottom: 4px !important;">
															<?php
																$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
    															$sqlismainaccessusers->bind_param("s", $userid);
																$sqlismainaccessusers->execute();
																$sqlismainaccessuser = $sqlismainaccessusers->get_result();
																$infomainaccessuser=$sqlismainaccessuser->fetch_array();
																$sqlismainaccessuser->close();
																$sqlismainaccessusers->close();
																if (($infomainaccessuser['invoicecustinfo']=='defone')||($infomainaccessuser['invoicecustinfo']=='deftwo')) {
															?>
																<div class="row">
																	<div class="col-lg-2 col-md-2 col-3">
																		<div class="custom-control custom-radio mr-sm-2">
																			<input type="radio" class="custom-control-input" name="customerinfodefault" id="onecustomerinfo" value="one" <?= ($infomainaccessuser['invoicecustinfo']=='defone')?'checked':'' ?> onclick="onetwo()">
																			<label class="custom-control-label custom-label" for="onecustomerinfo">
																				B2B
																			</label>
																		</div>
																	</div>
																	<div class="col-lg-2 col-md-2 col-3">
																		<div class="custom-control custom-radio mr-sm-2">
																			<input type="radio" class="custom-control-input" name="customerinfodefault" id="twocustomerinfo" value="two" <?= ($infomainaccessuser['invoicecustinfo']=='deftwo')?'checked':'' ?> onclick="onetwo()">
																			<label class="custom-control-label custom-label" for="twocustomerinfo">
																				B2C
																			</label>
																		</div>
																	</div>
																</div>
																<!-- FOR B2B AND B2C RADIO BUTTONS -->
																<script type="text/javascript">
																	$(document).ready(function () {
																		let one = document.getElementById("onecustomerinfo");
																		let two = document.getElementById("twocustomerinfo");
																		if (one.checked==true) {
																			$("#one").show();
																			$("#two").hide();
																			$("#customer").attr("required","required");
																			<?php
																				if ($access['invbtwocnamerequired']=='Yes') {
																			?>
																					$("#twocustomername").removeAttr("required");
																			<?php
																				}
																				if ($access['invbtwocwphonerequired']=='Yes') {
																			?>
																					$("#twoworkphone").removeAttr("required");
																			<?php
																				}
																			?>
																			$("#twopos").removeAttr("required");
																			let proposfinal = $("#proposfinal").val();
																			$("#propos").val(proposfinal);
																			var btndel = document.getElementsByName('productname[]');
																			var btndels = document.getElementsByName('product[]');
																			if ((btndel.length>1)||(btndel[0].value!='')) {
																				for(i=0;i<btndel.length;i++){
																					if (btndels[i].value!=0) {
																						var ids = btndel[i].id.split('productname');
																						var id = ids[1];
																						productcalc(id);
																					}
																				}
																			}
																			else{
																				document.getElementById('totalitems').value=0;
																				document.getElementById('totalquantity').value=0;
																				document.getElementById('totalamount').value=0;
																				document.getElementById('totalvatamount').value=0;
																				document.getElementById('roundoff').value=0;
																				document.getElementById('grandtotal').value=0;
																				document.getElementById('grandtotalfixed').value=0;
																			}
																		}
																		else if (two.checked==true) {
																			$("#two").show();
																			$("#one").hide();
																			<?php
																				if ($access['invbtwocnamerequired']=='Yes') {
																			?>
																					$("#twocustomername").attr("required","required");
																			<?php
																				}
																				if ($access['invbtwocwphonerequired']=='Yes') {
																			?>
																					$("#twoworkphone").attr("required","required");
																			<?php
																				}
																			?>
																			$("#twopos").attr("required","required");
																			$("#customer").removeAttr("required");
																			let propos = $("#twopos").val();
																			$("#propos").val(propos);
																			var btndel = document.getElementsByName('productname[]');
																			var btndels = document.getElementsByName('product[]');
																			if ((btndel.length>1)||(btndel[0].value!='')) {
																				for(i=0;i<btndel.length;i++){
																					if (btndels[i].value!=0) {
																						var ids = btndel[i].id.split('productname');
																						var id = ids[1];
																						productcalc(id);
																					}
																				}
																			}
																			else{
																				document.getElementById('totalitems').value=0;
																				document.getElementById('totalquantity').value=0;
																				document.getElementById('totalamount').value=0;
																				document.getElementById('totalvatamount').value=0;
																				document.getElementById('roundoff').value=0;
																				document.getElementById('grandtotal').value=0;
																				document.getElementById('grandtotalfixed').value=0;
																			}
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
																				if ($access['invbtwocnamerequired']=='Yes') {
																			?>
																				$("#twocustomername").removeAttr("required");
																			<?php
																				}
																				if ($access['invbtwocwphonerequired']=='Yes') {
																			?>
																				$("#twoworkphone").removeAttr("required");
																			<?php
																				}
																			?>
																			$("#twopos").removeAttr("required");
																			let proposfinal = $("#proposfinal").val();
																			$("#propos").val(proposfinal);
																			var btndel = document.getElementsByName('productname[]');
																			var btndels = document.getElementsByName('product[]');
																			if ((btndel.length>1)||(btndel[0].value!='')) {
																				for(i=0;i<btndel.length;i++){
																					if (btndels[i].value!=0) {
																						var ids = btndel[i].id.split('productname');
																						var id = ids[1];
																						productcalc(id);
																					}
																				}
																			}
																			else{
																				document.getElementById('totalitems').value=0;
																				document.getElementById('totalquantity').value=0;
																				document.getElementById('totalamount').value=0;
																				document.getElementById('totalvatamount').value=0;
																				document.getElementById('roundoff').value=0;
																				document.getElementById('grandtotal').value=0;
																				document.getElementById('grandtotalfixed').value=0;
																			}
																		}
																		else if (two.checked==true) {
																			$("#two").show();
																			$("#one").hide();
																			<?php
																				if ($access['invbtwocnamerequired']=='Yes') {
																			?>
																				$("#twocustomername").attr("required","required");
																			<?php
																				}
																				if ($access['invbtwocwphonerequired']=='Yes') {
																			?>
																				$("#twoworkphone").attr("required","required");
																			<?php
																				}
																			?>
																			$("#twopos").attr("required","required");
																			$("#customer").removeAttr("required");
																			let propos = $("#twopos").val();
																			$("#propos").val(propos);
																			var btndel = document.getElementsByName('productname[]');
																			var btndels = document.getElementsByName('product[]');
																			if ((btndel.length>1)||(btndel[0].value!='')) {
																				for(i=0;i<btndel.length;i++){
																					if (btndels[i].value!=0) {
																						var ids = btndel[i].id.split('productname');
																						var id = ids[1];
																						productcalc(id);
																					}
																				}
																			}
																			else{
																				document.getElementById('totalitems').value=0;
																				document.getElementById('totalquantity').value=0;
																				document.getElementById('totalamount').value=0;
																				document.getElementById('totalvatamount').value=0;
																				document.getElementById('roundoff').value=0;
																				document.getElementById('grandtotal').value=0;
																				document.getElementById('grandtotalfixed').value=0;
																			}
																		}
																	}
																</script>
																<!-- FOR B2B AND B2C CHANGES -->
															<?php
																}
															?>
															</div>
															</div>
														</button>
													</h5>
													<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" style="padding-left:7px !important;padding-right: 7px !important;">
														<div class="accordion-body text-sm" style="padding-bottom: 0px;padding-top: 3px">
														<?php
															$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
    														$sqlismainaccessusers->bind_param("s", $userid);
															$sqlismainaccessusers->execute();
															$sqlismainaccessuser = $sqlismainaccessusers->get_result();
															$infomainaccessuser=$sqlismainaccessuser->fetch_array();
															$sqlismainaccessuser->close();
															$sqlismainaccessusers->close();

															$sqlismainaccessuserbills=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
    														$sqlismainaccessuserbills->bind_param("s", $userid);
															$sqlismainaccessuserbills->execute();
															$sqlismainaccessuserbill = $sqlismainaccessuserbills->get_result();
															$infomainaccessuserbill=$sqlismainaccessuserbill->fetch_array();
															$sqlismainaccessuserbill->close();
															$sqlismainaccessuserbills->close();
															if ($infomainaccessuser['invoicecustinfo']=='one'||(($infomainaccessuser['invoicecustinfo']=='defone')||($infomainaccessuser['invoicecustinfo']=='deftwo'))) {
														?>
															<div id="one">
																<div class="row">
																	<div class="col-lg-12">
																		<div class="form-group row" style="align-items: center !important;">
																			<input type="hidden" name="customerid" id="customerid">
																			<div class="col-sm-3">
																				<label for="customername" class="custom-label">
																					<span class="text-danger">
																						<?= $infomainaccessusercus['modulename'] ?> Name *
																					</span>
																				</label>
																			</div>
																			<div class="col-sm-9" onclick="andus()">
																				<select class="form-control form-control-sm" name="customer" id="customer" required onchange="custchval(this)">
																					<option value='' selected disabled>Select</option>
																				</select>
																				<input type="text" class="form-control form-control-sm" id="customername" name="customername" placeholder="<?= $infomainaccessusercus['modulename'] ?> Name" style="display:none">
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
																					<div class="row">
																						<div class="col-sm-6">
																							<span class="text-blue" data-bs-toggle="modal" data-bs-target="#Viewcustdetails">
																								<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon align-text-bottom"><path d="M394.8 422h-90c-11 0-20-9-20-20s9-20 20-20h90c11 0 20 9 20 20s-9 20-20 20zm97-145h-187c-11 0-20-9-20-20s9-20 20-20h187c11 0 20 9 20 20s-9 20-20 20zm0-145h-187c-11 0-20-9-20-20s9-20 20-20h187c11 0 20 9 20 20s-9 20-20 20zM227.2 422c-11 0-20-9-20-20v-37.3c0-22.2-22.3-40.3-49.8-40.3H89.8c-27.4 0-49.8 18.1-49.8 40.3V402c0 11-9 20-20 20s-20-9-20-20v-37.3c0-44.3 40.3-80.3 89.8-80.3h67.6c49.5 0 89.8 36 89.8 80.3V402c0 11-8.9 20-20 20zM123.6 244.8C80.8 244.8 46 210 46 167.2s34.8-77.6 77.6-77.6 77.6 34.8 77.6 77.6-34.8 77.6-77.6 77.6zm0-115.1c-20.7 0-37.6 16.9-37.6 37.6 0 20.7 16.8 37.6 37.6 37.6s37.6-16.9 37.6-37.6c0-20.8-16.8-37.6-37.6-37.6z"></path></svg>
																								&nbsp; View <?= $infomainaccessusercus['modulename'] ?> Details
																							</span>
																						</div>
																						<div class="col-sm-6 svgforfrequent">
																							<span class="text-blue" data-bs-toggle="modal" data-bs-target="#Viewfrequentproduct">
																								<svg width="14px" height="14px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000" class="bi bi-cart-check"><path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg> 
																								Frequently Bought <?=$infomainaccessuserpro['modulename']?>
																							</span>
																						</div>
																					</div>
																					<div id="ember530" class="ember-view">
																						<div id="ember531" class="ember-view">
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="col-lg-6" style="padding-left: 3px !important;font-size: 13px !important;<?=(in_array('Billing Address', $fieldadd))?'':'display:none;'?>">
																				<div id="ember532" class="popovercontainer address-group ember-view">
																					<span class="font-small" style="color:#777777;">
																					 BILLING ADDRESS&nbsp;&nbsp;&nbsp;
																					<input type="hidden" name="pos" id="pos">
																					<input type="hidden" name="address1" id="address1">
																					<input type="hidden" name="address2" id="address2">
																					<input type="hidden" name="area" id="area">
																					<input type="hidden" name="city" id="city">
																					<input type="hidden" name="state" id="state">
																					<input type="hidden" name="pincode" id="pincode">
																					<input type="hidden" name="district" id="district">
																					<span id="billingaddressspan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#billingaddressmodel" style="font-size:13px !important;">
																						Change
																					</span>
																					<address id="billingaddressdiv" class="font-small ember-view" style="color:green;margin-bottom: 1px !important;">
																						New Delhi <br> Delhi 110032 <br> India <br> Phone: 1-195-145-2657 x4235 <br>
																					</address>
																				</div>
																			</div>
																			<!-- Billing Modal -->
																			<div class="modal fade" id="billingaddressmodel" tabindex="-1" role="dialog" aria-labelledby="billingaddressmodelLabel" aria-hidden="true">
																				<div class="modal-dialog modal-dialog-centered" role="document">
																					<div class="modal-content">
																						<div class="modal-header">
																							<h5 class="modal-title" id="billingaddressmodelLabel">
																								Billing Address
																							</h5>
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
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="billstreet" id="billstreet" placeholder="Street">
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="billcity" id="billcity" placeholder="City/Town">
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
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="billstate" id="billstate" placeholder="State">
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="billpincode" id="billpincode" min="0" placeholder="Pin">
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="billcountry" id="billcountry" placeholder="Country/Region">
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal-footer" style="margin-bottom: -9px !important;margin-top: 34.5px !important;">
																							<button onclick="funbillingaddress()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button" name="submitbilling" value="Save">
																								<span class="label">Save</span>
																								<span class="spinner"></span>
																							</button>
																							<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">
																								Cancel
																							</button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<script>
																			function funbillingaddress(){
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
																				if(ase==""){
																					$("#billingaddressdiv").html(ase);
																					$("#billingaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
																				}
																				else{
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
																			<div class="col-lg-6" style="padding-left: 3px !important;font-size: 13px !important;<?=(in_array('Shipping Address', $fieldadd))?'':'display:none;'?>">
																				<div id="ember532" class="popovercontainer address-group ember-view">
																					<span class="font-small" style="color:#777777;">
																					 SHIPPING ADDRESS&nbsp;&nbsp;&nbsp;
																					<input type="hidden" name="saddress1" id="saddress1">
																					<input type="hidden" name="saddress2" id="saddress2">
																					<input type="hidden" name="sarea" id="sarea">
																					<input type="hidden" name="scity" id="scity">
																					<input type="hidden" name="sstate" id="sstate">
																					<input type="hidden" name="spincode" id="spincode">
																					<input type="hidden" name="sdistrict" id="sdistrict">
																					<span id="shippingaddressspan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#shippingaddressmodel" style="font-size:13px !important;">
																						Change
																					</span>
																					<address id="shippingaddressdiv" class="font-small ember-view" style="color:green;margin-bottom: 1px !important;">
																						New Delhi <br> Delhi 110032 <br> India <br> Phone: 1-195-145-2657 x4235 <br>
																					</address>
																				</div>
																			</div>
																			<!-- Shipping Modal -->
																			<div class="modal fade" id="shippingaddressmodel" tabindex="-1" role="dialog" aria-labelledby="shippingaddressmodelLabel" aria-hidden="true">
																				<div class="modal-dialog modal-dialog-centered" role="document">
																					<div class="modal-content">
																						<div class="modal-header">
																							<h5 class="modal-title" id="shippingaddressmodelLabel">
																								Shipping Address
																							</h5>
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
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="shipstreet" id="shipstreet" placeholder="Street">
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="shipcity" id="shipcity" placeholder="City/Town">
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
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="shipstate" id="shipstate" placeholder="State">
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="shippincode" id="shippincode" min="0" placeholder="Pin">
																												<input type="text" autocomplete="off" class="form-control form-control-sm" name="shipcountry" id="shipcountry" placeholder="Country/Region">
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal-footer">
																							<button onclick="funshippingaddress()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button" name="submitshipping" value="Save">
																								<span class="label">Save</span>
																								<span class="spinner"></span>
																							</button>
																							<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">
																								Cancel
																							</button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<script>
																			function funshippingaddress(){
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
																				if(ase==""){
																					$("#shippingaddressdiv").html(ase);
																					$("#shippingaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
																				}
																				else{
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
																			<div class="col-lg-6" style="padding-left: 3px !important;<?=(in_array('Work Phone', $fieldadd))?'':'display:none;'?>">
																				<input type="hidden" name="mobile" id="mobile">
																				<input type="hidden" name="workphone" id="workphone">
																				<span class="font-small" style="color:#777777;font-size: 12px !important">
																					WORK PHONE&nbsp;&nbsp;&nbsp;
																				</span>
																				<span id="worktypespan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#workphonemodel" style="font-size:12px !important;">
																					Change
																				</span>
																				<div id="workphonediv" style="color:green;margin-bottom: 1px !important;">
																				</div>
																			</div>
																			<div class="modal fade" id="workphonemodel" tabindex="-1" role="dialog" aria-labelledby="workphonemodelLabel" aria-hidden="true">
																				<div class="modal-dialog modal-dialog-centered" role="document">
																					<div class="modal-content">
																						<div class="modal-header">
																							<h5 class="modal-title" id="workphonemodelLabel">
																								WORK PHONE
																							</h5>
																							<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
																								<span aria-hidden="true">&times;</span>
																							</button>
																						</div>
																						<div class="modal-body" style="height:110px">
																							<div class="row justify-content-center">
																								<div class="col-lg-12">
																									<div class="form-group row">
																										<div class="col-sm-4">
																											<label for="workphone" class="custom-label workphone" data-toggle="tooltip" title="Work Phone" data-placement="top">
																												Work Phone
																											</label>
																										</div>
																										<div class="col-sm-8 ali">
																											<input type="text" class="form-control form-control-sm" maxlength="100" id="workworkphone" name="workworkphone" placeholder="Work Phone" maxlength="25">
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal-footer">
																							<button onclick="funworkphone()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button" name="submitwork" value="Save">
																								<span class="label">Save</span>
																								<span class="spinner"></span>
																							</button>
																							<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">
																								Cancel
																							</button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="col-lg-6" style="padding-left: 3px !important;<?=(in_array('Mobile Phone', $fieldadd))?'':'display:none;'?>">
																				<input type="hidden" name="mobile" id="mobile">
																				<input type="hidden" name="mobilephone" id="mobilephone">
																				<span class="font-small" style="color:#777777;font-size: 12px !important">
																					MOBILE PHONE&nbsp;&nbsp;&nbsp;
																				</span>
																				<span id="mobiletypespan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#mobilephonemodel" style="font-size:12px !important;">
																					Change
																				</span>
																				<div id="mobilephonediv" style="color:green;margin-bottom: 1px !important;">
																				</div>
																			</div>
																			<div class="col-lg-6" style="padding-left: 3px !important;margin-top: 0px ;<?=(in_array('GSTIN', $fieldadd))?'':'display:none;'?>" id="mphonemob">
																				<input type="hidden" name="gstno" id="gstno">
																				<input type="hidden" name="gstrtype" id="gstrtype">
																				<span class="font-small" style="color:#777777;font-size: 12px !important">
																					GST TREATMENT&nbsp;&nbsp;&nbsp;
																				</span>
																				<span id="gsttypespan" class="text-blue font-xxs cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#gstrtypemodel" style="font-size:12px !important;">
																					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>
																				</span>
																				<div id="gstrtypediv" style="color:green;margin-bottom: 1px !important;">
																					Registered Business - Regular
																				</div>
																			</div>
																			<div class="col-lg-3" style="padding-left: 3px !important;<?=(in_array('DL No 20', $fieldadd))?'':'display:none;'?>">
																				<input type="hidden" name="dlno20" id="dlno20">
																				<span class="font-small" style="color:#777777;font-size: 12px !important">
																					DL No 20&nbsp;&nbsp;&nbsp;
																				</span>
																				<span id="dlno20typespan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#dlno20model" style="font-size:12px !important;">
																					Change
																				</span>
																				<div id="dlno20div" style="color:green;margin-bottom: 1px !important;">
																				</div>
																			</div>
																			<div class="modal fade" id="dlno20model" tabindex="-1" role="dialog" aria-labelledby="mobilephonemodelLabel" aria-hidden="true">
																				<div class="modal-dialog modal-dialog-centered" role="document">
																					<div class="modal-content">
																						<div class="modal-header">
																							<h5 class="modal-title" id="mobilephonemodelLabel">
																								DL No 21
																							</h5>
																							<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">&times;</span>
																							</button>
																						</div>
																						<div class="modal-body" style="height:110px">
																							<div class="row justify-content-center">
																								<div class="col-lg-12">
																									<div class="form-group row">
																										<div class="col-sm-4">
																											<label for="dlno20modal" class="custom-label mobile" data-toggle="tooltip" title="DL No 21" data-placement="top">
																												DL No 21
																											</label>
																										</div>
																										<div class="col-sm-8 ali">
																											<input type="text" class="form-control form-control-sm" id="dlno20modal" name="dlno20modal" placeholder="DL No 21">
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal-footer">
																							<button onclick="fundlno20()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button" name="submitmobile" value="Save">
																								<span class="label">Save</span>
																								<span class="spinner"></span>
																							</button>
																							<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">
																								Cancel
																							</button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<script>
																			function fundlno20(){
																				// var workworkphone=document.getElementById("workworkphone").value;
																				var dlno20=document.getElementById("dlno20modal").value;
																				// document.getElementById("workphone").value=workworkphone;
																				document.getElementById("dlno20").value=dlno20;
																				var ase=dlno20+'';
																				ase=ase.trim();
																				if(ase==""){
																					$("#dlno20div").html(ase);
																					$("#dlno20typespan").html('<div style="margin-top:-4.5px !important;"> Add New DL No 21 </div>');
																				}
																				else{
																					ase='<div id="dlno20line">'+dlno20+'</div>';
																					$("#dlno20div").html(ase);
																					$("#dlno20typespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
																				}
																				document.getElementById("dlno20model").classList.remove("show");
																				document.getElementById("dlno20model").style.display="none";
																				document.getElementById("dlno20model").removeAttribute("aria-modal");
																				document.getElementById("dlno20model").removeAttribute("role");
																				document.getElementById("dlno20model").setAttribute("aria-hidden", "true");
																				const backdrop = document.getElementsByClassName("modal-backdrop");
																				backdrop[0].classList.remove("show");
																				backdrop[0].classList.remove("modal-backdrop");
																			}
																			</script>
																			<div class="col-lg-3" style="padding-left: 3px !important;<?=(in_array('DL No 21', $fieldadd))?'':'display:none;'?>">
																				<input type="hidden" name="dlno21" id="dlno21">
																				<span class="font-small" style="color:#777777;font-size: 12px !important">
																					DL No 21&nbsp;&nbsp;&nbsp;
																				</span>
																				<span id="dlno21typespan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#dlno21model" style="font-size:12px !important;">
																					Change
																				</span>
																				<div id="dlno21div" style="color:green;margin-bottom: 1px !important;">
																				</div>
																			</div>
																			<div class="modal fade" id="dlno21model" tabindex="-1" role="dialog" aria-labelledby="mobilephonemodelLabel" aria-hidden="true">
																				<div class="modal-dialog modal-dialog-centered" role="document">
																					<div class="modal-content">
																						<div class="modal-header">
																							<h5 class="modal-title" id="mobilephonemodelLabel">
																								DL No 21
																							</h5>
																							<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">&times;</span>
																							</button>
																						</div>
																						<div class="modal-body" style="height:110px">
																							<div class="row justify-content-center">
																								<div class="col-lg-12">
																									<div class="form-group row">
																										<div class="col-sm-4">
																											<label for="dlno21modal" class="custom-label mobile" data-toggle="tooltip" title="DL No 21" data-placement="top">
																												DL No 21
																											</label>
																										</div>
																										<div class="col-sm-8 ali">
																											<input type="text" class="form-control form-control-sm" id="dlno21modal" name="dlno21modal" placeholder="DL No 21">
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal-footer">
																							<button onclick="fundlno21()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button" name="submitmobile" value="Save">
																								<span class="label">Save</span>
																								<span class="spinner"></span>
																							</button>
																							<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">
																								Cancel
																							</button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<script>
																			function fundlno21(){
																				// var workworkphone=document.getElementById("workworkphone").value;
																				var dlno21=document.getElementById("dlno21modal").value;
																				// document.getElementById("workphone").value=workworkphone;
																				document.getElementById("dlno21").value=dlno21;
																				var ase=dlno21+'';
																				ase=ase.trim();
																				if(ase==""){
																					$("#dlno21div").html(ase);
																					$("#dlno21typespan").html('<div style="margin-top:-4.5px !important;"> Add New DL No 21 </div>');
																				}
																				else{
																					ase='<div id="dlno21line">'+dlno21+'</div>';
																					$("#dlno21div").html(ase);
																					$("#dlno21typespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
																				}
																				document.getElementById("dlno21model").classList.remove("show");
																				document.getElementById("dlno21model").style.display="none";
																				document.getElementById("dlno21model").removeAttribute("aria-modal");
																				document.getElementById("dlno21model").removeAttribute("role");
																				document.getElementById("dlno21model").setAttribute("aria-hidden", "true");
																				const backdrop = document.getElementsByClassName("modal-backdrop");
																				backdrop[0].classList.remove("show");
																				backdrop[0].classList.remove("modal-backdrop");
																			}
																			</script>
																			<div class="modal fade" id="mobilephonemodel" tabindex="-1" role="dialog" aria-labelledby="mobilephonemodelLabel" aria-hidden="true">
																				<div class="modal-dialog modal-dialog-centered" role="document">
																					<div class="modal-content">
																						<div class="modal-header">
																							<h5 class="modal-title" id="mobilephonemodelLabel">
																								MOBILE PHONE
																							</h5>
																							<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">&times;</span>
																							</button>
																						</div>
																						<div class="modal-body" style="height:110px">
																							<div class="row justify-content-center">
																								<div class="col-lg-12">
																									<div class="form-group row">
																										<div class="col-sm-4">
																											<label for="mobile" class="custom-label mobile" data-toggle="tooltip" title="Mobile Phone" data-placement="top">
																												Mobile Phone
																											</label>
																										</div>
																										<div class="col-sm-8 ali">
																											<input type="text" class="form-control form-control-sm" maxlength="100" id="workmobile" name="workmobile" placeholder="Mobile Phone" maxlength="25">
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal-footer">
																							<button onclick="funmobilephone()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button" name="submitmobile" value="Save">
																								<span class="label">Save</span>
																								<span class="spinner"></span>
																							</button>
																							<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">
																								Cancel
																							</button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<script>
																			function funworkphone(){
																				var workworkphone=document.getElementById("workworkphone").value;
																				// var workmobile=document.getElementById("workmobile").value;
																				document.getElementById("workphone").value=workworkphone;
																				// document.getElementById("mobile").value=workmobile;
																				var ase=workworkphone+' ';
																				ase=ase.trim();
																				if(ase==""){
																					$("#workphonediv").html(ase);
																					$("#worktypespan").html('<div style="margin-top:-4.5px !important;"> Add New Phone </div>');
																				}
																				else{
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
																			function funmobilephone(){
																				// var workworkphone=document.getElementById("workworkphone").value;
																				var mobile=document.getElementById("workmobile").value;
																				// document.getElementById("workphone").value=workworkphone;
																				document.getElementById("mobile").value=mobile;
																				var ase=mobile+'';
																				ase=ase.trim();
																				if(ase==""){
																					$("#mobilephonediv").html(ase);
																					$("#mobiletypespan").html('<div style="margin-top:-4.5px !important;"> Add New Phone </div>');
																				}
																				else{
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
																			<div class="modal fade" id="gstrtypemodel" tabindex="-1" role="dialog" aria-labelledby="gstrtypemodelLabel" aria-hidden="true">
																				<div class="modal-dialog modal-dialog-centered" role="document">
																					<div class="modal-content">
																						<div class="modal-header">
																							<h5 class="modal-title" id="gstrtypemodelLabel">
																								GST TREATMENT
																							</h5>
																							<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
																								<span aria-hidden="true">&times;</span>
																							</button>
																						</div>
																						<div class="modal-body" style="height:180px">
																							<div class="row justify-content-center">
																								<div class="col-sm-12">
																									<div class="form-group row">
																										<div class="col-sm-12 mb-2">
																											<label class="form-check-label" for="gstinlineRadio3">
																												GST Registration Type
																											</label>
																										</div>
																										<div class="col-sm-12">
																											<select class="selectpicker form-control select2" data-live-search="true" title="Search title OR description..." onchange="showDivcust(this.value)" id="gstgstrtype" name="gstgstrtype">
																												<option selected disabled value="" data-foo="Select Type of Add">
																													Select Type of Add
																												</option>
																												<option data-foo="Business that is registered under GST" value="Registered Business - Regular">
																													Registered Business - Regular
																												</option>
																												<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition">
																													Registered Business - Composition
																												</option>
																												<option data-foo="Business that has not been registered under GST" value="Unregistered Business">
																													Unregistered Business
																												</option>
																												<option data-foo="A customer who is a regular consumer" value="Consumer">
																													Consumer
																												</option>
																												<option data-foo="Persons with whom you do import OR export of supplies outside India" value="Overseas">
																													Overseas
																												</option>
																												<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India OR a SEZ Developer" value="Special Economic Zone">
																													Special Economic Zone
																												</option>
																												<option data-foo="Supply of goods to an Export Oriented Unit OR against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export">
																													Deemed Export
																												</option>
																												<option data-foo="Departments of the State / Central government, government agencies OR local authorities" value="Tax Deductor">
																													Tax Deductor
																												</option>
																												<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer">
																													SEZ Developer
																												</option>
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
																												<label class="form-check-label text-danger" for="gstgstin">
																													GSTIN / UIN *
																												</label>
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
																							<button onclick="fungstrtype()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button" name="submitgst" value="Save">
																								<span class="label">Save</span>
																								<span class="spinner"></span>
																							</button>
																							<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">
																								Cancel
																							</button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<script>
																			function fungstrtype(){
																				var custcustgsttype = document.getElementById("gstgstrtype");
																				var custcustgsttypeans = custcustgsttype.options[custcustgsttype.selectedIndex].text;
																				var custcustgstin = document.getElementById("gstgstin");
																				if(custcustgsttypeans=="Select Type of Add"||((custcustgsttypeans=="Registered Business - Regular"||custcustgsttypeans=="Registered Business - Composition"||custcustgsttypeans=="Special Economic Zone"||custcustgsttypeans=="Deemed Export"||custcustgsttypeans=="Tax Deductor"||custcustgsttypeans=="SEZ Developer")&&custcustgstin.value=='')){
																					if (custcustgsttypeans=="Select Type of Add") {
																						custcustgsttype.focus();alert("Please Select the GST Type");
																					}
																					else if ((custcustgsttypeans=="Registered Business - Regular"||custcustgsttypeans=="Registered Business - Composition"||custcustgsttypeans=="Special Economic Zone"||custcustgsttypeans=="Deemed Export"||custcustgsttypeans=="Tax Deductor"||custcustgsttypeans=="SEZ Developer")&&custcustgstin.value=='') {
																						custcustgstin.focus();alert("Please Enter the GST IN Value");
																					}
																					return false;
																				}
																				else{
																					if(custcustgsttypeans=="Registered Business - Regular"||custcustgsttypeans=="Registered Business - Composition"||custcustgsttypeans=="Special Economic Zone"||custcustgsttypeans=="Deemed Export"||custcustgsttypeans=="Tax Deductor"||custcustgsttypeans=="SEZ Developer"){
																							ase='<div id="gstfirstline">'+custcustgsttypeans+'</div> <div id="gstsecondline">'+'GSTIN:'+custcustgstin.value+'</div>';
																					}
																					else{
																						ase='<div id="gstfirstline">'+custcustgsttypeans+'</div>';
																					}
																					$("#gstrtypediv").html(ase);
																					$("#gsttypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
																				}
																				$("#twogsttreatment").val(custcustgsttypeans);
																				$("#twogstin").val(custcustgstin.value);
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
															<!-- FOR B2B INFORMATIONS -->
														<?php
															}
															if ($infomainaccessuser['invoicecustinfo']=='two'||(($infomainaccessuser['invoicecustinfo']=='defone')||($infomainaccessuser['invoicecustinfo']=='deftwo'))) {
														?>
															<script type="text/javascript">
															function twoposans() {
																$("#propos").val($("#twopos").val());
																var btndel = document.getElementsByName('productname[]');
																var btndels = document.getElementsByName('product[]');
																if ((btndel.length>1)||(btndel[0].value!='')) {
																	for(i=0;i<btndel.length;i++){
																		if (btndels[i].value!=0) {
																			var ids = btndel[i].id.split('productname');
																			var id = ids[1];
																			productcalc(id);
																		}
																	}
																}
																else{
																	document.getElementById('totalitems').value=0;
																	document.getElementById('totalquantity').value=0;
																	document.getElementById('totalamount').value=0;
																	document.getElementById('totalvatamount').value=0;
																	document.getElementById('roundoff').value=0;
																	document.getElementById('grandtotal').value=0;
																	document.getElementById('grandtotalfixed').value=0;
																}
															}
															</script>
															<div id="two">
																<div class="row">
																	<div class="<?=((!in_array('Age', $fieldadd))&&(!in_array('Sex', $fieldadd)))?'col-lg-3':'col-lg-2'?>" style="padding-right: 0px;">
																		<label for="customername" class="custom-label">
																			<?= ($access['invbtwocnamerequired']=='Yes')? '<span class="text-danger">'. $infomainaccessusercus['modulename'] . ' Name * </span>': $infomainaccessusercus['modulename'] . ' Name ' ?>
																		</label>
																	</div>
																	<div class="<?=((in_array('Age', $fieldadd))&&(in_array('Sex', $fieldadd)))?'col-lg-4':(((in_array('Age', $fieldadd))||(in_array('Sex', $fieldadd)))?'col-lg-7':'col-lg-9')?>">
																		<input type="text" name="twocustomername" id="twocustomername" class="form-control form-control-sm" placeholder="<?= $infomainaccessusercus['modulename'] ?> Name" <?= ($access['invbtwocnamerequired']=='Yes')? 'required': ' ' ?>>
																	</div>
																	<div class="col-lg-1" style="padding-right: 0px;<?=(in_array('Age', $fieldadd))?'':'display:none;'?>">
																		<label for="customername" class="custom-label">
																			AGE
																		</label>
																	</div>
																	<div class="col-lg-2" style="<?=(in_array('Age', $fieldadd))?'':'display:none;'?>">
																		<input type="text" class="form-control form-control-sm" id="twoage" name="twoage" placeholder="AGE">
																	</div>
																	<div class="col-lg-1" style="padding-right: 0px;<?=(in_array('Sex', $fieldadd))?'':'display:none;'?>">
																		<label for="customername" class="custom-label">
																			SEX
																		</label>
																	</div>
																	<div class="col-lg-2" style="<?=(in_array('Sex', $fieldadd))?'':'display:none;'?>">
																		<input type="text" class="form-control form-control-sm" id="twosex" name="twosex" placeholder="SEX">
																	</div>
																</div>
																<div class="row mt-1">
																	<div class="col-lg-12">
																		<div class="row mb-0" id="custaddressdiv" style="background-color:#fbfafa; color:#777777; display:block;margin: 0px !important;padding: 9px 9px 0px 9px !important;">
																			<div class="col-lg-12 mb-0 mt-0" style="padding-left: 3px !important;">
																				<div id="ember529" class="info-item cursor-pointer ember-view" style="margin-top:-3px !important;">
																					<div id="ember530" class="ember-view">
																						<div id="ember531" class="ember-view">
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="row" style="padding:0px !important;margin: 0px !important;">
																				<div class="col-lg-6" <?=(in_array('Billing Address', $fieldadd))?'':'style="display:none;"'?>>
																					<label for="twobilling" class="custom-label" style="margin:0px !important;font-size: 13px !important;color: #777777;">
																						BILLING ADDRESS
																					</label>
																					<div class="row justify-content-center">
																						<div class="col-lg-12">
																							<div class="form-group row">
																								<div class="col-sm-12">
																									<div class="input-group input-group-sm">
																										<div class="input-group-prepend">
																										</div>
																										<input type="text" autocomplete="off" class="form-control form-control-sm" name="twobillstreet" id="twobillstreet" placeholder="Street" oninput="twobillstreetoip(this)">
																										<input type="text" autocomplete="off" class="form-control form-control-sm" name="twobillcity" id="twobillcity" placeholder="City/Town" oninput="twobillcityoip(this)">
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
																										<input type="text" autocomplete="off" class="form-control form-control-sm" name="twobillstate" id="twobillstate" placeholder="State" oninput="twobillstateoip(this)">
																										<input type="text" autocomplete="off" class="form-control form-control-sm" name="twobillpincode" id="twobillpincode" min="0" placeholder="Pin" oninput="twobillpincodeiop(this)">
																										<input type="text" autocomplete="off" class="form-control form-control-sm" name="twobillcountry" id="twobillcountry" placeholder="Country/Region" oninput="twobillcountryiop(this)">
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<script type="text/javascript">
																				function twobillstreetoip(xstreet) {
																					twobillstreetans = xstreet.value;
																					twobillstreetlen = twobillstreetans.length;
																					let twoshoworhide = document.getElementById('twosameasbilling');
																					if (twoshoworhide.checked==true) {
																						if (twobillstreetlen>=0) {
																							twoshipstreet.value=twobillstreetans;
																						}
																					}
																				}
																				function twobillcityoip(xcity) {
																					twobillcityans = xcity.value;
																					twobillcitylen = twobillcityans.length;
																					let twoshoworhide = document.getElementById('twosameasbilling');
																					if (twoshoworhide.checked==true) {
																						if (twobillcitylen>=0) {
																							twoshipcity.value=twobillcityans;
																						}
																					}
																				}
																				function twobillstateoip(xstate) {
																					twobillstateans = xstate.value;
																					twobillstatelen = twobillstateans.length;
																					let twoshoworhide = document.getElementById('twosameasbilling');
																					if (twoshoworhide.checked==true) {
																						if (twobillstatelen>=0) {
																							twoshipstate.value=twobillstateans;
																						}
																					}
																				}
																				function twobillpincodeiop(xpin) {
																					twobillpinans = xpin.value;
																					twobillpinlen = twobillpinans.length;
																					let twoshoworhide = document.getElementById('twosameasbilling');
																					if (twoshoworhide.checked==true) {
																						if (twobillpinlen>=0) {
																							twoshippincode.value=twobillpinans;
																						}
																					}
																				}
																				function twobillcountryiop(xcountry) {
																					twobillcountryans = xcountry.value;
																					twobillcountrylen = twobillcountryans.length;
																					let twoshoworhide = document.getElementById('twosameasbilling');
																					if (twoshoworhide.checked==true) {
																						if (twobillcountrylen>=0) {
																							twoshipcountry.value=twobillcountryans;
																						}
																					}
																				}
																				</script>
																				<div class="col-lg-6" <?=(in_array('Shipping Address', $fieldadd))?'':'style="display:none;"'?>>
																					<div class="row">
																						<div class="col-lg-6">
																							<label for="twoshipping" class="custom-label" style="width:max-content !important;margin: 0px !important;font-size: 13px !important;color: #777777;">
																								SHIPPING ADDRESS
																							</label>
																						</div>
																						<div class="col-lg-6">
																							<div class="custom-control custom-checkbox" onclick="twosameasbillingticaccess()" style="min-height: 19.5px !important;">
																								<input type="checkbox" class="custom-control-input" name="twosameasbilling" id="twosameasbilling" checked>
																								<label class="custom-control-label custom-label" for="twosameasbilling" style="width:max-content !important;font-size: 11px !important;margin: 0px !important;color: #777777;">
																									Same as Billing Address
																								</label>
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
																											<input type="text" autocomplete="off" class="form-control form-control-sm" name="twoshipstreet" id="twoshipstreet" placeholder="Street">
																											<input type="text" autocomplete="off" class="form-control form-control-sm" name="twoshipcity" id="twoshipcity" placeholder="City/Town">
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
																											<input type="text" autocomplete="off" class="form-control form-control-sm" name="twoshipstate" id="twoshipstate" placeholder="State">
																											<input type="text" autocomplete="off" class="form-control form-control-sm" name="twoshippincode" id="twoshippincode" min="0" placeholder="Pin">
																											<input type="text" autocomplete="off" class="form-control form-control-sm" name="twoshipcountry" id="twoshipcountry" placeholder="Country/Region">
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>

																					</div>
																				</div>
																			</div>
																			<div class="row" style="padding:0px !important;margin: 0px !important;">
																				<div class="col-lg-6" <?=(in_array('Work Phone', $fieldadd))?'':'style="display:none;"'?>>
																					<label for="twoworkphone" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																						<?= ($access['invbtwocwphonerequired']=='Yes')? '<span class="text-danger"> WORK PHONE * </span>': ' WORK PHONE ' ?>
																					</label>
																					<input type="text" class="form-control form-control-sm" id="twoworkphone" name="twoworkphone" placeholder="Work Phone" <?= ($access['invbtwocwphonerequired']=='Yes')? 'required': ' ' ?> maxlength="25">
																				</div>
																				<div class="col-lg-6" <?=(in_array('Mobile Phone', $fieldadd))?'':'style="display:none;"'?>>
																					<label for="twomobilephone" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																						MOBILE PHONE
																					</label>
																					<input type="text" class="form-control form-control-sm" id="twomobilephone" name="twomobilephone" placeholder="Mobile Phone" maxlength="25">
																				</div>
																			</div>
																			<div class="row" style="padding:9px 0px !important;margin: 0px !important;">
																				<div class="col-lg-8" <?=(in_array('GSTIN', $fieldadd))?'':'style="display:none;"'?>>
																					<div class="row">
																						<div class="col-lg-6">
																							<label for="twogsttreatment" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																								GST TREATMENT
																							</label>
																							<input type="text" class="form-control form-control-sm" id="twogsttreatment" name="twogsttreatment" placeholder="GST TREATMENT" value="<?=$infomainaccessuser['invoicetwogst']?>" readonly>
																						</div>
																						<div class="col-lg-6" id="twogstinblock">
																							<label for="twogstin" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																								GSTIN
																							</label>
																							<input type="text" class="form-control form-control-sm" id="twogstin" name="twogstin" placeholder="GSTIN" readonly>
																						</div>
																					</div>
																				</div>
																				<div class="col-lg-4" <?=(in_array('Place of Supply', $fieldadd))?'':'style="display:none;"'?>>
																					<div class="row">
																						<div class="col-lg-12" id="twoposblock">
																							<label for="twomobilephone" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																								<span class="text-danger">
																									PLACE OF SUPPLY *
																								</span>
																							</label>
																							<select name="twopos" id="twopos" class="select5 form-control form-control-sm" required onchange="twoposans()">
																								<option disabled value="" <?=($infomainaccessuser['invoicetwopos']=='manual'||'auto')?'selected':''?>>
																									Select The Place
																								</option>
																								<option value="JAMMU AND KASHMIR (1)" <?=($infomainaccessuser['invoicetwopos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>
																									JAMMU AND KASHMIR (1)
																								</option>
																								<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($infomainaccessuser['invoicetwopos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>
																									ANDAMAN AND NICOBAR ISLANDS (35)
																								</option>
																								<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($infomainaccessuser['invoicetwopos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>
																									ANDHRA PRADESH (NEWLY ADDED) (37)
																								</option>
																								<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($infomainaccessuser['invoicetwopos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>
																									ANDHRA PRADESH(BEFORE DIVISION) (28)
																								</option>
																								<option value="ARUNACHAL PRADESH (12)" <?=($infomainaccessuser['invoicetwopos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>
																									ARUNACHAL PRADESH (12)
																								</option>
																								<option value="ASSAM (18)" <?=($infomainaccessuser['invoicetwopos']=="ASSAM (18)")?'selected':''?>>
																									ASSAM (18)
																								</option>
																								<option value="BIHAR (10)" <?=($infomainaccessuser['invoicetwopos']=="BIHAR (10)")?'selected':''?>>
																									BIHAR (10)
																								</option>
																								<option value="CENTRE JURISDICTION (99)" <?=($infomainaccessuser['invoicetwopos']=="CENTRE JURISDICTION (99)")?'selected':''?>>
																									CENTRE JURISDICTION (99)
																								</option>
																								<option value="CHANDIGARH (4)" <?=($infomainaccessuser['invoicetwopos']=="CHANDIGARH (4)")?'selected':''?>>
																									CHANDIGARH (4)
																								</option>
																								<option value="CHATTISGARH (22)" <?=($infomainaccessuser['invoicetwopos']=="CHATTISGARH (22)")?'selected':''?>>
																									CHATTISGARH (22)
																								</option>
																								<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($infomainaccessuser['invoicetwopos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>
																									DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)
																								</option>
																								<option value="DELHI (7)" <?=($infomainaccessuser['invoicetwopos']=="DELHI (7)")?'selected':''?>>
																									DELHI (7)
																								</option>
																								<option value="GOA (30)" <?=($infomainaccessuser['invoicetwopos']=="GOA (30)")?'selected':''?>>
																									GOA (30)
																								</option>
																								<option value="GUJARAT (24)" <?=($infomainaccessuser['invoicetwopos']=="GUJARAT (24)")?'selected':''?>>
																									GUJARAT (24)
																								</option>
																								<option value="HARYANA (6)" <?=($infomainaccessuser['invoicetwopos']=="HARYANA (6)")?'selected':''?>>
																									HARYANA (6)
																								</option>
																								<option value="HIMACHAL PRADESH (2)" <?=($infomainaccessuser['invoicetwopos']=="HIMACHAL PRADESH (2)")?'selected':''?>>
																									HIMACHAL PRADESH (2)
																								</option>
																								<option value="JHARKHAND (20)" <?=($infomainaccessuser['invoicetwopos']=="JHARKHAND (20)")?'selected':''?>>
																									JHARKHAND (20)
																								</option>
																								<option value="KARNATAKA (29)" <?=($infomainaccessuser['invoicetwopos']=="KARNATAKA (29)")?'selected':''?>>
																									KARNATAKA (29)
																								</option>
																								<option value="KERALA (32)" <?=($infomainaccessuser['invoicetwopos']=="KERALA (32)")?'selected':''?>>
																									KERALA (32)
																								</option>
																								<option value="LADAKH (NEWLY ADDED) (38)" <?=($infomainaccessuser['invoicetwopos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>
																									LADAKH (NEWLY ADDED) (38)
																								</option>
																								<option value="LAKSHADWEEP (31)" <?=($infomainaccessuser['invoicetwopos']=="LAKSHADWEEP (31)")?'selected':''?>>
																									LAKSHADWEEP (31)
																								</option>
																								<option value="MADHYA PRADESH (23)" <?=($infomainaccessuser['invoicetwopos']=="MADHYA PRADESH (23)")?'selected':''?>>
																									MADHYA PRADESH (23)
																								</option>
																								<option value="MAHARASHTRA (27)" <?=($infomainaccessuser['invoicetwopos']=="MAHARASHTRA (27)")?'selected':''?>>
																									MAHARASHTRA (27)
																								</option>
																								<option value="MANIPUR (14)" <?=($infomainaccessuser['invoicetwopos']=="MANIPUR (14)")?'selected':''?>>
																									MANIPUR (14)
																								</option>
																								<option value="MEGHALAYA (17)" <?=($infomainaccessuser['invoicetwopos']=="MEGHALAYA (17)")?'selected':''?>>
																									MEGHALAYA (17)
																								</option>
																								<option value="MIZORAM (15)" <?=($infomainaccessuser['invoicetwopos']=="MIZORAM (15)")?'selected':''?>>
																									MIZORAM (15)
																								</option>
																								<option value="NAGALAND (13)" <?=($infomainaccessuser['invoicetwopos']=="NAGALAND (13)")?'selected':''?>>
																									NAGALAND (13)
																								</option>
																								<option value="ODISHA (21)" <?=($infomainaccessuser['invoicetwopos']=="ODISHA (21)")?'selected':''?>>
																									ODISHA (21)
																								</option>
																								<option value="OTHER TERRITORY (97)" <?=($infomainaccessuser['invoicetwopos']=="OTHER TERRITORY (97)")?'selected':''?>>
																									OTHER TERRITORY (97)
																								</option>
																								<option value="PUDUCHERRY (34)" <?=($infomainaccessuser['invoicetwopos']=="PUDUCHERRY (34)")?'selected':''?>>
																									PUDUCHERRY (34)
																								</option>
																								<option value="PUNJAB (3)" <?=($infomainaccessuser['invoicetwopos']=="PUNJAB (3)")?'selected':''?>>
																									PUNJAB (3)
																								</option>
																								<option value="RAJASTHAN (8)" <?=($infomainaccessuser['invoicetwopos']=="RAJASTHAN (8)")?'selected':''?>>
																									RAJASTHAN (8)
																								</option>
																								<option value="SIKKIM (11)" <?=($infomainaccessuser['invoicetwopos']=="SIKKIM (11)")?'selected':''?>>
																									SIKKIM (11)
																								</option>
																								<option value="TAMIL NADU (33)"  <?=($infomainaccessuser['invoicetwopos']=="TAMIL NADU (33)")?'selected':''?>>
																									TAMIL NADU (33)
																								</option>
																								<option value="TELANGANA (36)" <?=($infomainaccessuser['invoicetwopos']=="TELANGANA (36)")?'selected':''?>>
																									TELANGANA (36)
																								</option>
																								<option value="TRIPURA (16)" <?=($infomainaccessuser['invoicetwopos']=="TRIPURA (16)")?'selected':''?>>
																									TRIPURA (16)
																								</option>
																								<option value="UTTAR PRADESH (9)" <?=($infomainaccessuser['invoicetwopos']=="UTTAR PRADESH (9)")?'selected':''?>>
																									UTTAR PRADESH (9)
																								</option>
																								<option value="UTTARAKHAND (5)" <?=($infomainaccessuser['invoicetwopos']=="UTTARAKHAND (5)")?'selected':''?>>
																									UTTARAKHAND (5)
																								</option>
																								<option value="WEST BENGAL (19)" <?=($infomainaccessuser['invoicetwopos']=="WEST BENGAL (19)")?'selected':''?>>
																									WEST BENGAL (19)
																								</option>
																							</select>
																						</div>
																					</div>
																				</div>
																			</div>

																		</div>
																	</div>
																</div>
															</div>
															<!-- FOR B2C INFORMATIONS -->
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
									function sameadd(){
										var address1=document.getElementById('address1');
										var address2=document.getElementById('address2');
										var area=document.getElementById('area');
										var city=document.getElementById('city');
										var district=document.getElementById('district');
										var state=document.getElementById('state');
										var pincode=document.getElementById('pincode');
										var sameaddress=document.getElementById('sameaddress');
										if(sameaddress.checked==true){
											document.getElementById('saddress1').value=address1.value;
											document.getElementById('saddress2').value=address2.value;
											document.getElementById('sarea').value=area.value;
											document.getElementById('scity').value=city.value;
											document.getElementById('sdistrict').value=district.value;
											document.getElementById('sstate').value=state.value;
											document.getElementById('spincode').value=pincode.value;
										}
										else{
											document.getElementById('saddress1').value='';
											document.getElementById('saddress2').value='';
											document.getElementById('sarea').value='';
											document.getElementById('scity').value='';
											document.getElementById('sdistrict').value='';
											document.getElementById('sstate').value='';
											document.getElementById('spincode').value='';
										}
									}
									// FOR B2C SAME AS BILLING CHECKBOX
									</script>
									<hr class="p-0 mb-1 mt-1">
									<?php
										// }
									?>
									<?php
										// if ((in_array('Item Information', $fieldadd))) {
									?>
										<div class="row">
											<div class="accordion" id="accordionRental">
												<div class="accordion-item mb-1">
													<h5 class="accordion-header" id="headingOne">
														<button class="accordion-button font-weight-bold" type="button">
															<div class="customcont-header ml-0 mb-1" style="height: 30px;">
																<a class="customcont-heading" style="padding: 7px 0 7px;">
																	Item Information
																</a>
																<span style="font-weight: normal;font-size: 13px;">
																	(<span id="totalProCount">1</span> of 50)
																</span>
															</div>
														</button>
													</h5>
													<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
														<div class="accordion-body text-sm" style="padding-bottom: 0px !important;padding-top: 3px">
															<div class="table-responsive" style="overflow-y: hidden;">
																<table class="table table-bordered" id="purchasetable">
																	<thead>
																		<tr>
																			<th style="display:none">
																			</th>
																			<th <?=((in_array('Barcode', $fieldadd))||(in_array('Item Details', $fieldadd))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldadd))||(in_array('Quantity', $fieldadd))||(in_array('Taxable Value', $fieldadd))||(in_array('Tax Value', $fieldadd))||(in_array('Amount', $fieldadd)))?'':'style="display:none !important;"'?>>
																			</th>
																	<?php
																		if (in_array('Barcode', $fieldadd)) {
																	?>
																			<th width="16%">
																				BARCODE
																			</th>
																	<?php
																		}
																	?>
																	<?php
																		if (in_array('Item Details', $fieldadd)) {
																	?>
																			<th width="16%">
																				ITEM DETAILS<span class="text-danger"> *</span>
																			</th>
																	<?php
																		}
																	?>
																	<?php
																		if ($access['batchexpiryval']==1) {
																	?>
																			<th width="13%">
																				BATCH <?=(($access['invbatexprequired']=='Yes')?'<span class="text-danger"> *</span>':'')?>
																			</th>
																	<?php
																		}
																	?>
																			<th style="display:none">
																				DESCRIPTION
																			</th>
																			<th style="display:none">
																				HSN
																			</th>
																			<th style="display:none">
																				MRP
																			</th>
																	<?php
																		if (in_array('Rate', $fieldadd)) {
																	?>
																			<th style="width: 100px;text-align: right !important;">
																				RATE<span class="text-danger"> *</span>
																			</th>
																	<?php
																		}
																	?>
																	<?php
																		if (in_array('Quantity', $fieldadd)) {
																	?>
																			<th style="width: 87px !important;text-align: right !important;">
																				<?=($access['txtqtyinv'])?><span class="text-danger"> *</span>
																			</th>
																	<?php
																		}
																	?>
																	<?php
																		if ((in_array('Taxable Value', $fieldadd))) {
																	?>
																			<th style="text-align: right !important;">
																				<?=$access['txttaxableinv']?>
																			</th>
																	<?php
																		}
																	?>
																	<?php
																		if ((in_array('Tax Value', $fieldadd))) {
																	?>
																			<th style="text-align: right !important;">
																				TAX VALUE
																			</th>
																	<?php
																		}
																	?>
																			<th style="display:none">
																				Discount
																			</th>
																	<?php
																		if ((in_array('Amount', $fieldadd))) {
																	?>
																			<th style="text-align: right !important;">
																				AMOUNT
																			</th>
																	<?php
																		}
																	?>
																			<th <?=((in_array('Barcode', $fieldadd))||(in_array('Item Details', $fieldadd))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldadd))||(in_array('Quantity', $fieldadd))||(in_array('Taxable Value', $fieldadd))||(in_array('Tax Value', $fieldadd))||(in_array('Amount', $fieldadd)))?'':'style="display:none !important;"'?>>
																				<div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldadd))?'display:none !important;':'display:none !important;'?>">
  																					<a href="javascript:;" class="p-0" id="dropdownadditionalinfo" data-bs-toggle="dropdown" aria-expanded="false">
  																						<svg width="15" height="15" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg>
  																					</a>
  																					<div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownadditionalinfo">
	 																					<div style="background-color: #3c3c46;margin-top: -50px !important;">
																							<a class="nav-link" style="color: #fff;width:max-content !important;" onclick="additionalinfototal()">
		  																						<span class="nav-link-text ms-2 showorhidewords">
		  																							<span id="showaddtotal">
		  																								Show
		  																							</span>
		  																							<span id="hideaddtotal" style="display: none;">
		  																								Hide
		  																							</span>
		  																							All Additional Information
		  																						</span>
																							</a>
	 																					</div>
  																					</div>
																				</div>
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td class="priority" style="display:none">
																				1
																			</td>
																			<td class="tdmove" <?=((in_array('Barcode', $fieldadd))||(in_array('Item Details', $fieldadd))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldadd))||(in_array('Quantity', $fieldadd))||(in_array('Taxable Value', $fieldadd))||(in_array('Tax Value', $fieldadd))||(in_array('Amount', $fieldadd)))?'':'style="display:none !important;"'?>>
																				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg>
																			</td>
																			<td data-label="BARCODE" style="<?=(in_array('Barcode', $fieldadd))?'':'display:none !important;'?>">
																				<div>
																					<input type="text" name="barcode[]" id="barcode1" class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" onchange="checkthecode(1)">
																				</div>
																				<div>
																					<span id="viewbarcode1" style="display:none; font-size:11px;color: royalblue;" data-bs-toggle="modal" data-bs-target="#barcodeModal" onclick="generateBarcode(1)">
																						View and Download Barcode
																					</span>
																					<input type="hidden" id="barcodeformat1">
																					<input type="hidden" id="barcodetitle1">
																					<input type="hidden" id="barcodesubtitle1">
																					<input type="hidden" id="barcodeval1">
																					<input type="hidden" id="underbarcodelabel1">
																					<input type="hidden" id="footernote1">
																				</div>
																			</td>
																			<td data-label="ITEM DETAILS" style="padding-top: 1px !important;<?=(in_array('Item Details', $fieldadd))?'':'display:none !important;'?>">
																				<input type="hidden" name="productid[]" id="productid1">
																				<input type="hidden" name="productname[]" id="productname1">
																				<div class="col-sm-9" onclick="andus()" style="width:278px;display: inline-block;margin-top: 1.5px !important;" id="selecttheproduct">
																					<select class="form-control form-control-sm product proitemselect product1" name="product[]" id="product1" required onChange="productchange(1)">
																						<option value="" selected disabled>Select</option>
																					</select>
																				</div>
																				<span class="badge" style="display:none; width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan1">
																				</span>
																				<br>
																				<input type="hidden" name="itemmodule[]" id="itemmodule1">
																				<div <?=(in_array('Category', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="productmanufacturerspan1" style="display:none; font-size:11px;">
																						<?=$access['txtnamecategory']?>:
																					</span>
																					<input type="text" name="manufacturer[]" id="manufacturer1" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;" readonly>
																					<span id="productmanufacturerval1" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																					</span>
																					<span id="productmanufactureredit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer(1)">
																						<i class="fa fa-edit"></i>
																					</span>
																					<span id="productmanufacturerupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer(1)">
																						<i class="fa fa-save"></i>
																					</span>
																				</div>
																				<div <?=(in_array('Hsn OR Sac', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="producthsncodespan1" style="display:none; font-size:11px;">
																						HSN Code:
																					</span>
																					<input type="text" name="producthsn[]" maxlength="100" id="producthsn1" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;">
																					<span id="producthsncodeval1" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																					</span>
																					<span id="producthsncodeedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode(1)">
																						<i class="fa fa-edit"></i>
																					</span>
																					<span id="producthsncodeupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode(1)">
																						<i class="fa fa-save"></i>
																					</span>
																				</div>
																				<div <?=(in_array('Rack', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="rackspan1" style="display:none; font-size:11px;">
																						Rack:
																					</span>
																					<span id="rackval1" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																					</span>
																					<input type="hidden" name="rack[]" id="rack1">
																				</div>
																				<span <?=(in_array('Product Description', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="productdescriptionspan1" style="display:none; font-size:11px;">
																						Description:
																					</span>
																					<textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription1" style="height:50px; display:none;width: 146px !important;"></textarea>
																				</span>
																				<div class="col-sm-9 totalaccounts account1" onclick="andus()" style="width:278px;display: none;margin-top: 5.5px !important;" id="selecttheproduct">
																					<select style=" width: 100%;" class="select4 form-control form-control-sm" name="accountname[]" id="accountname1">
																						<option selected disabled value="">
																							Select
																						</option>
																					</select>
																				</div>
																			</td>
																			<td style="display:none">
																				<input type="text" name="productnotes[]" id="productnotes1" class="form-control form-control-sm proitemselect bordernoneinput">
																			</td>
																			<td data-label="BATCH" <?=($access['batchexpiryval']==1)?'':'style="display:none;"'?>>
																				<div>
																					<input type="text" name="batch[]" maxlength="100" id="batch1" onClick="batchget(1);" onFocus="batchget(1);" class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" list="" autocomplete="off" <?=(($access['invbatexprequired']=='Yes')?'required':'')?> <?= ($access['invbatchdef']=='availdrop')?'readonly':'' ?>>
																				</div>
																				<div>
																					<span id="productexpdatespan1" style="display:none; font-size:11px;">
																						EXPIRY:
																					</span>
																					<input type="date" name="expdate[]" id="expdate1" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" <?=(($access['invbatexprequired']=='Yes')?'required':'')?> <?= ($access['invbatchdef']=='availdrop')?'readonly':'' ?>>
																					<span id="productexpdateval1" style=" font-size:11px;" class="text-primary">
																					</span>
																					<span id="productexpdateedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate(1)">
																						<i class="fa fa-edit"></i>
																					</span>
																					<span id="productexpdateupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate(1)">
																						<i class="fa fa-save"></i>
																					</span>
																				</div>
																				<div>
																					<div id="outfordone1" class="dvi" style="display:none;width: 250px;">
																					</div>
																					<input type="text" id="errbatch1" style="display:none;">
																				</div>
																			</td>
																			<td data-label="RATE" <?=(in_array('Rate', $fieldadd))?'':'style="display:none !important;"'?>>
																				<div>
																					<span style="font-size:15px !important;">
																						<?= $resmaincurrencyans; ?>
																					</span>
																					<input type="number" min="0" step="0.01" name="productrate[]"   required id="productrate1" class="form-control form-control-sm proitemselect productselectwidth" onChange="productcalc(1)" onClick="rateget(1);" onFocus="rateget(1);" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;">
																				</div>
																				<div <?=(in_array('Mrp', $fieldadd))?'':'style="visibility:hidden !important;"'?>>
																					<span id="productmrpspan1" style="display:none; font-size:11px;">
																						MRP:
																						<input type="number" name="mrp[]" id="mrp1" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01">
																						<span id="productmrpval1" style=" font-size:11px;" class="text-primary">
																						</span>
																						<span id="productmrpedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp(1)">
																							<i class="fa fa-edit"></i>
																						</span>
																						<span id="productmrpupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp(1)">
																							<i class="fa fa-save"></i>
																						</span>
																					</span>
																				</div>
																				<div>
																					<div class="dvi invbillgets" id="invbillgets1" style="margin-top:-22px;display: none;width: 250px;border-radius: 0px !important;">
																						<table width="100%">
																							<tr style="border-bottom: 1px solid #cccccc;margin-bottom: 0px;">
																								<td align="center" style="border-right: 1px solid #cccccc;width: 50% !important;display: inline-block !important;text-align: center;">
																									<span onclick="invgetfun(1,0)" id="invonoff1">
																										<?= strtoupper($infomainaccessuser['modulename']) ?>
																									</span>
																								</td>
																								<td align="center" style="width: 50% !important;display: inline-block !important;text-align: center;">
																									<span onclick="billgetfun(1)" id="billonoff1">
																										<?= strtoupper($infomainaccessuserbill['modulename']) ?>
																									</span>
																								</td>
																								<input type="text" style="display: none;" value="inv" id="billorinv1">
																							</tr>
																						</table>
																					</div>
																					<div id="ratelist1" class="dvi ratedvi" style="display:none;width: 250px;">
																					</div>
																					<input type="text" id="errrate1" style="display:none;">
																				</div>
																			</td>
																			<td data-label="<?=($access['txtqtyinv'])?>" <?=(in_array('Quantity', $fieldadd))?'':'style="display:none !important;"'?>>
																				<div>
																					<input type="number" min="0" step="0.01" name="quantity[]" required id="quantity1" class="form-control form-control-sm proitemselect productselectwidth" onClick="qtych(1)" onFocus="qtych(1)" onChange="productcalc(1)" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;">
																				</div>
																				<div <?=(in_array('Unit', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="productunitspan1" style="display:none; font-size:11px;">
																						UNIT:
																					</span>
																					<input type="text" name="productunit[]" id="productunit1" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" readonly>
																					<span id="productunitval1" style=" font-size:11px;" class="text-primary">
																					</span>
																					<span id="productunitedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editunit(1)">
																						<i class="fa fa-edit"></i>
																					</span>
																					<span id="productunitupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit(1)">
																						<i class="fa fa-save"></i>
																					</span>
																				</div>
																				<div <?=(in_array('Pack', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="productnoofpacksspan1" style="display:none; font-size:11px;">
																						PACK:
																					</span>
																					<input type="text" name="noofpacks[]" maxlength="100" id="noofpacks1" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;">
																					<span id="productnoofpacksval1" style=" font-size:11px;" class="text-primary">
																					</span>
																					<span id="productnoofpacksedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks(1)">
																						<i class="fa fa-edit"></i>
																					</span>
																					<span id="productnoofpacksupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks(1)">
																						<i class="fa fa-save"></i>
																					</span>
																				</div>
																			</td>
																			<td data-label="<?=$access['txttaxableinv']?>" <?=(in_array('Taxable Value', $fieldadd))?'':'style="display:none;"'?>>
																				<div id="ruppeitemtablemobdfs">
																					<span style="font-size:15px !important;">
																						<?= $resmaincurrencyans; ?>
																					</span>
																					<input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue1" class="form-control form-control-sm proitemselect productselectwidth productvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly>
																				</div>
																				<div <?=(in_array('Discount', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="productprodiscountspan1" style="display:none; font-size:11px;">
																							<?=$access['txtprodisinv']?>:
																						<div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect1">
																							<div class="input-group-prepend">
																								<input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount1" class="form-control form-control-sm proitemselect" style="display:none;width: 35px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(1)">
																							</div>
																							<select name="prodiscounttype[]" id="prodiscounttype1" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 0px !important;" onChange="productcalc(1)">
																								<option value="0">
																									%
																								</option>
																								<option value="1">
																									<?= $resmaincurrencyans; ?>
																								</option>
																							</select>
																						</div>
																						<input type="hidden" name="prodisvalueforledger[]" id="prodisvalueforledger1">
																						<span id="productprodiscountval1" style=" font-size:11px;" class="text-primary">
																						</span>
																						<span id="productprodiscountedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount(1)">
																							<i class="fa fa-edit"></i>
																						</span>
																						<span id="productprodiscountupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount(1)">
																							<i class="fa fa-save"></i>
																						</span>
																					</span>
																				</div>
																				<div style="<?=(in_array('Profit Margin', $fieldadd))?'':'display:none;'?>">
																					<span data-bs-toggle="modal" data-bs-target="#ViewMarginDetails" style="color: green;font-size:13px;display: none;" id="margintotal1" onclick="getmargindetails(1)">
																						Profit Margin : 
																						<span id="totalmarginvalue1">
																							0
																						</span>
																					</span>
																					<input type="hidden" name="marginupdates[]" id="formarginupdates1">
																					<input type="hidden" name="margintotalvalue[]" id="margintotalvalue1">
																				</div>
																			</td>
																			<td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldadd))?'':'style="display:none;"'?>>
																				<div id="ruppeitemtablemobasdf">
																					<span style="font-size:15px !important;">
																						<?= $resmaincurrencyans; ?>
																					</span>
																					<input type="hidden" name="cgstvat[]" id="cgstvat1">
																					<input type="hidden" name="sgstvat[]" id="sgstvat1">
																					<input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue1" class="form-control form-control-sm proitemselect productselectwidth taxvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly>
																				</div>
																				<div <?=(in_array('GST Percentage', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="productvatspan1" style="display:none; font-size:11px;">
																						GST:
																						<input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm proitemselect notforfixed" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(1)">
																						<span id="productvatval1" style=" font-size:11px;" class="text-primary">
																						</span>
																						<span id="productvatedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editvat(1)">
																							<i class="fa fa-edit"></i>
																						</span>
																						<span id="productvatupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat(1)">
																							<i class="fa fa-save"></i>
																						</span>
																					</span>
																				</div>
																				<div <?=(in_array('GST Rupee', $fieldadd))?'':'style="display:none !important;"'?>>
																					<span id="productcgstvatspan1" style="display:none; font-size:11px;">
																						CGST:
																					</span>
																					<span id="productcgstvatval1" style=" font-size:11px;" class="text-primary">
																					</span>
																					<span id="productsgstvatspan1" style="display:none; font-size:11px;">SGST:
																					</span>
																					<span id="productsgstvatval1" style=" font-size:11px;" class="text-primary">
																					</span>
																					<span id="productigstvatspan1" style="display:none; font-size:11px;">IGST:
																					</span>
																					<span id="productigstvatval1" style=" font-size:11px;" class="text-primary">
																					</span>
																				</div>
																			</td>
																			<td data-label="AMOUNT" <?=(in_array('Amount', $fieldadd))?'':'style="display:none !important;"'?>>
																				<div id="ruppeitemtablemobasdf">
																					<span style="font-size:15px !important;">
																						<?= $resmaincurrencyans; ?>
																					</span>
																					<input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue1" class="form-control form-control-sm proitemselect productselectwidth productnetvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly>
																				</div>
																			</td>
																			<td <?=((in_array('Barcode', $fieldadd))||(in_array('Item Details', $fieldadd))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldadd))||(in_array('Quantity', $fieldadd))||(in_array('Taxable Value', $fieldadd))||(in_array('Tax Value', $fieldadd))||(in_array('Amount', $fieldadd)))?'style="white-space:nowrap !important;"':'style="display:none !important;"'?>>
																				<div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldadd))?'display:none !important;':'display:none !important;'?>">
  																					<a href="javascript:;" class="p-0" id="dropdownadditionalinfo" data-bs-toggle="dropdown" aria-expanded="false">
  																						<svg width="15" height="15" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg>
  																					</a>
  																					<div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownadditionalinfo">
    																					<div style="background-color: #3c3c46;margin-top: -50px !important;">
      																					<a class="nav-link" style="color: #fff;width:max-content !important;" onclick="additionalinfo(1)">
        																						<span class="nav-link-text ms-2 showorhidewords">
        																							<span id="showadd1">
        																								Show
        																							</span>
        																							<span id="hideadd1" style="display: none;">
        																								Hide
        																							</span>
        																							Additional Information
        																						</span>
      																					</a>
    																					</div>
  																					</div>
																				</div>
																				<a class="btn-delete" style="cursor:pointer">
																					<img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;margin-left: 3px;">
																				</a>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<script type="text/javascript">
															setTimeout(function() {
																$.ajax({
																	type: "GET",
																	url: 'inlistaccsearch.php?idname=accountname&lineNo=1',
																	success: function (result) {
																		// console.log(result);
																		if (result!='') {
																			$("#accountname1").html(result);
																			$('select[name^="accountname"] option').filter(function() {
																			return $(this).text().toLowerCase() == 'accounts receivable';
																			}).prop('selected', true);
																		}
																		else{
																			$("#accountname1").val("");
																			$("#accountname1").append('<option selected disabled value="">Select</option>');
																		}
																	},
																	error: function (error) {
																		// console.log(error);
																	}
																});
															},1500);
															function additionalinfo(lineid) {
																var currentDisplay = $(".account" + lineid).css("display");
																if (currentDisplay === 'none') {
																	$(".account" + lineid).css("display", "inline-block");
																}
																else {
																	$(".account" + lineid).css("display", "none");
																}
																$("#showadd"+lineid+"").toggle();
																$("#hideadd"+lineid+"").toggle();
															}
															function additionalinfototal() {
																for(i=0;i<document.getElementsByClassName("totalaccounts").length;i++){
																	var currentDisplay = $(".account" + i).css("display");
																	if (currentDisplay === 'none') {
																		$(".account" + i).css("display", "inline-block");
																	}
																	else {
																		$(".account" + i).css("display", "none");
																	}
																	$("#showadd"+i+"").toggle();
																	$("#hideadd"+i+"").toggle();
																}
																$("#showaddtotal").toggle();
																$("#hideaddtotal").toggle();
															}
															</script>
															<style type="text/css">
															.blink10seconds{
																color: red !important;
																animation: blinksecondsleft 1s linear infinite;
															}
															#secondsleft{
																background-color: red !important;
																color: white !important;
																animation: blinksecondsleft 1s linear infinite;
															}
															@keyframes blinksecondsleft{
																0%{opacity: 0;}
																50%{opacity: .5;}
																100%{opacity: 1;}
															}
															@media screen and (max-width: 991px){
	 															.dvi {
		  															width: 200px !important;
		  															right: 25px !important;
	 															}
	 															.ratedvi{
		  															margin-top: -3px !important;
	 															}
																.invbillgets td{
																	width: 50% !important;
																	display: inline-block;
																}
															}
	 														.ratedvi{
		  														margin-top: 3px;
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
															.invbillgets td{
																padding: 0px 0px !important;
																width: 50%;
															}
															.invbillgets span{
																padding: 0px;
																border-radius: 6px;
																color: black;
																display: inline-block;
																width: 100%;
															}
															.invbillgets span:hover{
																background-color: #1BBC9B !important;
																color: #fff !important;
															}
															.select2-container .select2-selection--single .select2-selection__rendered{
																white-space: normal !important;
															}
															.select2-container .select2-selection--single{
	 															overflow: hidden !important;
															}
  															</style>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- FOR ITEM INFORMATIONS PRODUCT DETAILS -->
										<div class="row">
											<div class="col-lg-8">
												<div class="row">
													<div class="form-group row" id="mobadddesign">
														<div class="col-lg-4 col-md-4 col-sm-12 col-12">
															<p align="left" style="margin:0px;padding:0px;">
																<a class="productadd-row btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 2px 4.5px 1px 4.5px !important; margin-bottom:0.25rem;">
																	<i style="font-size: 14px;color:#0066cc;" class="fa fa-plus-circle"></i>
																	Add another line
																</a>
																<a class="btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 3.5px 4.5px 3.5px 4.5px !important; margin-bottom:0.25rem; display:none" id="productadd" data-bs-toggle="modal" data-bs-target="#AddNewProduct">
																	<i style="font-size: 14px;color:#0066cc;" class="fa fa-plus"></i>
																	Missing <?=$infomainaccessuserpro['modulename']?>? Add Here
																</a>
															</p>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4 mt-0 mb-3" id="grandbottom">
														<div class="row mt-2">
															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																<label class="custom-label" for="totalitems" style="margin-top: 0px !important;">
																	Total Items
																</label>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																<input required type="text" name="totalitems" id="totalitems" class="form-control form-control-sm "  readonly  value="0">
															</div>
														</div>
														<div class="row mt-2">
															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																<label class="custom-label" for="totalitems" style="margin-top: 0px !important;">
																	Total Qty
																</label>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																<input required type="text" name="totalquantity" id="totalquantity" class="form-control form-control-sm " readonly  value="0">
															</div>
														</div>
													</div>
													<!-- FOR TOTAL INFORMATIONS -->
													<div class="col-lg-8">
														<div class="table-responsive mt-1" id="gsttablediv" <?=(in_array('Tax Informations', $fieldadd))?'':'style="display:none;"'?>>
															<table class="table table-bordered" id="gsttable" style="font-size:12px;">
																<thead>
																	<tr>
																		<th rowspan="2" style="width:30%;background-color:#e9ecef !important;font-size: 12px !important;border: 1px solid #999;text-align: right !important;vertical-align: middle;padding: 0px 3px !important;">
																			<b>
																				TAXABLE VALUE <?=$resmaincurrencyans?>
																			</b>
																		</th>
																		<th colspan="2" style="width:23%;background-color:#e9ecef !important;font-size: 12px !important;border: 1px solid #999;text-align: center !important;padding: 0px !important;" id="cgsthead">
																			CGST
																		</th>
																		<th colspan="2" style="width:23%;background-color:#e9ecef !important;font-size: 12px !important;border: 1px solid #999;text-align: center !important;padding: 0px !important;" id="sgsthead">
																			SGST
																		</th>
																		<th colspan="4" style="width:23%;background-color:#e9ecef !important;font-size: 12px !important;border: 1px solid #999;text-align: center !important;padding: 0px !important;" id="igsthead">
																			IGST
																		</th>
																		<th colspan="2" style="width:24%;background-color:#e9ecef !important;font-size: 12px !important;border: 1px solid #999;text-align: center !important;padding: 0px !important;">
																			GST
																		</th>
																	</tr>
																	<tr>
																		<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;" id="cgstpercent">
																			<b>
																				%
																			</b>
																		</th>
																		<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;" id="cgstruppee">
																			<b>
																				<?=$resmaincurrencyans?>
																			</b>
																		</th>
																		<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;" id="sgstpercent">
																			<b>
																				%
																			</b>
																		</th>
																		<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;" id="sgstruppee">
																			<b>
																				<?=$resmaincurrencyans?>
																			</b>
																		</th>
																		<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;" id="igstpercent" colspan="2">
																			<b>
																				%
																			</b>
																		</th>
																		<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;" id="igstruppee" colspan="2">
																			<b>
																				<?=$resmaincurrencyans?>
																			</b>
																		</th>
																		<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;">
																			<b>
																				%
																			</b>
																		</th>
																		<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;">
																			<b>
																				<?=$resmaincurrencyans?>
																			</b>
																		</th>
																	</tr>
																</thead>
																<tbody id="gstautotable">
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- FOR TAX INFORMATIONS -->
												<div class="row mb-1" style="display:none">
													<div class="col-lg-3">
														Tax Type
													</div>
													<div class="col-lg-3">
														<select required type="text" name="taxtype" id="taxtype" class="form-control form-control-sm" onChange="gstcalc();">
															<option value="IntraState" selected>
																IntraState
															</option>
															<option value="InterState">
																InterState
															</option>
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
														<div class="col-6">
															Sub Total 
															<span class="pull-right">
																:
															</span>
														</div>
														<div class="col-6">
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																		<?= $resmaincurrencyans; ?>
																	</div>
																</div>
																<input required type="text" name="totalamount" id="totalamount" class="form-control form-control-sm " style="background:none; text-align:right;border: 1px solid #e1dbdb;"  readonly  value="0">
															</div>
														</div>
													</div>
													<div class="row mb-1">
														<div class="col-6">
															<div class="input-group input-group-sm">
																<div class="input-group-prepend">
																	<div class="input-group input-group-sm">
																		<div class="input-group-prepend" style="padding-right: 3px !important;">
																			Discount
																		</div>
																		<input type="text" name="discount" class="form-control form-control-sm"  id="discount" value="0" onChange="discount1()" style="width:24px;border: 1px solid #e0e3e6 !important;border-radius: 0px !important;padding: 0px !important;">
																	</div>
																</div>
																<select name="discounttype" id="discounttype" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;" onChange="discount1()">
																	<option value="0">
																		%
																	</option>
																	<option value="1">
																		<?= $resmaincurrencyans; ?>
																	</option>
																</select>
															</div>
															<span class="pull-right" style="margin-top:-25px !important;">
																:
															</span>
														</div>
														<div class="col-6">
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																		<?= $resmaincurrencyans; ?>
																	</div>
																</div>
																<input required type="text" name="discountamount" id="discountamount" class="form-control form-control-sm " style="background:none; text-align:right;border:1px solid #e1dbdb;" value="0" onChange="productcalc1()">
															</div>
														</div>
													</div>
													<div class="row mb-1" <?=(in_array('Total Tax', $fieldadd))?'':'style="display:none;"'?>>
														<div class="col-6">
															Total Tax
															<span class="pull-right">
																:
															</span>
														</div>
														<div class="col-6">
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																		<?= $resmaincurrencyans; ?>
																	</div>
																</div>
																<input required type="text" name="totalvatamount" id="totalvatamount" class="form-control form-control-sm " style="background:none; text-align:right;border: 1px solid #e1dbdb;"  readonly  value="0">
															</div>
														</div>
													</div>
													<div class="row mb-1" style="display:none">
														<div class="col-6">
															Freight
															<span class="pull-right">
																:
															</span>
															<?= $resmaincurrencyans; ?>
														</div>
														<div class="col-6">
															<input required type="text" name="freightamount" id="freightamount" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right" value="0" onChange="productcalc1()">
														</div>
													</div>
													<div class="row mb-1">
														<div class="col-6">
															Round off
															<span class="pull-right">
																:
															</span>
														</div>
														<div class="col-6">
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																		<?= $resmaincurrencyans; ?>
																	</div>
																</div>
																<input required type="text" name="roundoff" id="roundoff" class="form-control form-control-sm " style="background:none; text-align:right;border:1px solid #e1dbdb;" value="0" onChange="productcalcround()">
															</div>
														</div>
													</div>
													<div class="row mb-1" style="font-size:14.6px;">
														<div class="col-6">
															<strong>
																Grand Total
																<span class="pull-right">
																	:
																</span>
															</strong>
														</div>
														<div class="col-6">
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																		<?= $resmaincurrencyans; ?>
																	</div>
																</div>
																<input required type="text" name="grandtotal" id="grandtotal" class="form-control form-control-sm " style="background:none; text-align:right; font-size:14.6px;border: 1px solid #e1dbdb;font-weight: 700 !important;" value="0" onChange="productcalc1()" readonly>
															</div>
														</div>
													</div>
													<div class="row mb-1">
														<div class="col-12">
															<span id="grandwords">
															</span>
														</div>
													</div>
													<div class="row mb-1" style="font-size:18px; display:none">
														<div class="col-6">
															<label class="custom-label" for="mode">
																Mode
															</label>
														</div>
														<div class="col-6">
															<select class="select4 form-control form-control-sm" name="mode" id="mode">
																<option>
																	1
																</option>
																<option>
																	2
																</option>
																<option>
																	3
																</option>
															</select>
														</div>
													</div>
													<div class="row mb-1" style="font-size:18px; display:none">
														<div class="col-6">
															<label class="custom-label" for="balancedue">
																Change Due
															</label>
														</div>
														<div class="col-6">
															<input type="text" name="balancedue" id="balancedue" class="form-control form-control-sm">
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- FOR PAYMENT TOTAL VALUES WITH DIVISIONS -->
										<div class="row mt-2 mb-2">
											<div class="col-lg-8">
												<div class="row" <?=(in_array('Description', $fieldadd))?'':'style="display:none;"'?>>
													<div class="col-lg-2">
														<label class="custom-label" for="description">
															Description
														</label>
													</div>
													<div class="col-lg-10">
														<textarea class="form-control form-control-sm" name="description" id="description" style="height: 60px !important;"></textarea>
													</div>
												</div>
												<div class="row mt-2" <?=(in_array('Notes', $fieldadd))?'':'style="display:none;"'?>>
													<div class="col-lg-2">
														<label class="custom-label" for="notes">
															Notes
														</label>
													</div>
													<div class="col-lg-10">
														<textarea class="form-control form-control-sm" name="notes" id="notes" style="height: 60px !important;"></textarea>
													</div>
												</div>
												<div class="row mt-2" <?=(in_array('Terms and Conditions', $fieldadd))?'':'style="display:none;"'?>>
													<div class="col-lg-2">
														<label class="custom-label" for="terms">
															Terms and Conditions
														</label>
													</div>
													<div class="col-lg-10">
														<textarea class="form-control form-control-sm" name="terms" id="terms" style="height: 80px !important;"></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-4 mt-1" <?=(in_array('Attachment', $fieldadd))?'':'style="display:none;"'?>>
												<div style="background-color:#fbfafa;">
													<label class="custom-label mb-2" for="fileattach">
														Attach File(s) to <?= $infomainaccessuser['modulename'] ?>
													</label>
													<div class="form-group">
														<input type="file" name="fileattach[]" id="fileattach" class="form-control form-control-sm" multiple onchange="previewatt()">
													</div>
													<span style="font-size:11px;">
														You can upload a maximum of 5 files, 5MB each
													</span>
													<img alt="Attachment" src="<?=str_replace('../ups','ups',$img)?>" id="attach" style="height: 30px !important;width: 30px !important;display: none;">
													<input type="hidden" name="fileattachs" value="">
												</div>
												<script type="text/javascript">
												function previewatt() {
  													var preview = document.getElementById('attach');
  													var file    = document.getElementById('fileattach').files[0];
  													var reader  = new FileReader();
  													reader.addEventListener("load", function () {
														preview.src = reader.result;
														preview.style.display = 'block';
  													}, false);
  													if (file) {
														reader.readAsDataURL(file);
  													}
  												}
												</script>
											</div>
										</div>
									<?php
										// }
									?>
									<input type="hidden" id="ansforsepgstval" name="ansforsepgstval">
									<!-- FOR OTHER ALL DETAILS AND FILES -->
									<!---navbottom---->
									<header class="app-header fixed-bottom" style="height:48px !important;z-index: 1 !important;">
										<div class="app-header-inner">
											<div class="py-2 px-3">
												<div class="app-header-content" style="margin-left: -45px;" id="ilu">
													<div class="row">
														<div class="col-auto pt-1" style="width:34px !important;margin-top: -8px !important;height: 100px;margin-left: -18px !important;border-top: 1px solid #eff0f4;">
														</div>
														<div class="col" style="width:34px !important;margin-top: 1px !important;margin-left: -9px !important;">
															<div class="form-group row">
																<div class="col-7 col-sm-6">
																	<button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="trigggerbutton" name="triggerbutton" value="Submit"  onClick="triggerpayment('','','','1','1')">
																		<span class="label">
																			NEXT
																		</span>
																		<span class="spinner">
																		</span>
																	</button>
																	<a class="btn btn-primary btn-sm btn-custom-grey" href="invoices.php" style="margin-top:-3px !important;">
																		Cancel
																	</a>
																	<span class="btn btn-primary btn-sm btn-custom" style="margin-left: 10px !important;margin-top: -3px !important;background-color: red;border-color: red !important;display: none;" id="secondsleft">
																		30 Seconds Left
																	</span>
																</div>
																<div class="col-5 col-sm-6">
																	<div class="row mb-1" style="font-size:14.6px;">
																		<div class="col-1 col-sm-6 col-lg-6 grandtotalfixed">
																			<strong>
																				<span class="pull-right">
																					Grand Total:
																				</span>
																			</strong>
																		</div>
																		<div class="col-11 col-sm-6 col-lg-6" style="padding-left: 0px;padding-right: 35px;">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																						<?= $resmaincurrencyans; ?>
																					</div>
																				</div>
																				<input required type="text" name="grandtotalfixed" id="grandtotalfixed" class="form-control form-control-sm" style="background:none; text-align:right; font-size:14.6px;border: 1px solid #e1dbdb;font-weight: 700 !important;" value="0" readonly>
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
									</header>
									<!---navbottom---->
									<!-- FOR FIXED FOOTER -->
									<!---payment confirm---->
<!-- BARCODE -->
<div class="modal fade" id="barcodeModal" tabindex="-1" role="dialog" aria-labelledby="barcodeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px !important;">
<div class="modal-header" style="border-radius:0px !important;">
<h5 class="modal-title" id="barcodeModalLabel" style="font-weight: normal !important;color: black !important;">Barcode Viewer</h5>
<span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true" style="font-weight: 600 !important;font-size: 21px !important;">&times;</span>
</span>
</div>
<div class="modal-body">
<div class="barcodediv">
<div class="container">

    <!-- Barcode Preview -->
    <div class="barcode-preview">
      <div class="barcode-label" id="barcode-title-label" style="font-size: 23px;"></div>
      <div class="barcode-label" id="barcode-subtitle-label" style="font-size: 16px;"></div>
      <svg id="barcode"></svg>
      <div class="barcode-label" id="barcode-under-label" style="font-size: 23px;"></div>
      <div class="barcode-label" id="barcode-note-label" style="font-size: 16px;"></div>
    </div>

    <!-- Save Type Selection -->
  <div class="row mt-3">
    <div class="row">
      <div class="col-lg-6">
        <label for="save-type">Barcode Format:</label>
      </div>
      <div class="col-lg-6">
        <select id="save-type" class="select4">
          <option value="png">PNG</option>
          <option value="jpg">JPG</option>
          <option value="svg">SVG</option>
        </select>
      </div>
    </div>
    <!-- <div class="row mt-3" style="justify-content: center;"> -->
      <!-- Generate Barcode Button -->
      <!-- <button type="button" id="generate-barcode" style="width:max-content;">Generate Barcode</button> -->
    <!-- </div> -->
  </div>
  <iframe id="pdf-preview" style="width: 100%; height: 500px; border: 1px solid #ccc;margin-top: 18px;display: none;"></iframe>

    <div class="row mt-3" style="justify-content: center;">
      <!-- Download Barcode Button -->
      <input type="hidden" id="dynamicchanginput">
      <div class="col-lg-6" style="text-align:center;">
        <button id="print-barcode" type="button" style="width: 100%;">Print Barcode</button>
      </div>
      <div class="col-lg-6" style="text-align:center;">
        <button id="download-barcode" type="button" style="width: 100%;">Download Barcode</button>
      </div>
    </div>

  </div>
</div>
</div>
<div class="modal-footer" style="margin-top: 33px !important;text-align: right !important;">
<a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>
</div>
</div>
</div>
</div>
<!-- BARCODE -->
<script type="text/javascript">
function generateBarcode(lineNo) {
	 document.getElementById('pdf-preview').style.display = 'none';
	 document.getElementById("dynamicchanginput").value = lineNo;
    var barcodeType = document.getElementById("barcodeformat"+lineNo+"").value;
    var barcodeData = document.getElementById("barcodeval"+lineNo+"").value;
    var barcodeTitle = document.getElementById("barcodetitle"+lineNo+"").value;
    var barcodeSubtitle = document.getElementById("barcodesubtitle"+lineNo+"").value;
    var barcodeNote = document.getElementById("footernote"+lineNo+"").value;
    var underbarcodelabel = document.getElementById("underbarcodelabel"+lineNo+"").value;
    if (barcodeData) {
      JsBarcode("#barcode", barcodeData, {
        format: barcodeType,
        lineColor: "#000",
        width: 2,
        height: 50,
        displayValue: false,
      });

      // Set the barcode title, subtitle, and note as text above and below the barcode
      document.getElementById('barcode-title-label').textContent = barcodeTitle ? barcodeTitle : '';
      document.getElementById('barcode-subtitle-label').textContent = barcodeSubtitle ? barcodeSubtitle : '';
      document.getElementById('barcode-under-label').textContent = underbarcodelabel ? underbarcodelabel : '';
      document.getElementById('barcode-note-label').textContent = barcodeNote ? barcodeNote : '';
    }
  }


  // Download the barcode as an image (PNG, JPG, SVG)
  document.getElementById('download-barcode').addEventListener('click', function () {
  	 lineNo = document.getElementById("dynamicchanginput").value;
    var svg = document.getElementById('barcode');
    var svgData = new XMLSerializer().serializeToString(svg);
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext("2d");
    var img = new Image();

    // Barcode title, subtitle, and note values
    var barcodeTitle = document.getElementById("barcodetitle"+lineNo+"").value;
    var barcodeSubtitle = document.getElementById("barcodesubtitle"+lineNo+"").value;
    var underbarcodelabels = document.getElementById("underbarcodelabel"+lineNo+"").value;
    var barcodeNote = document.getElementById("footernote"+lineNo+"").value;

    // Get the selected save type (png, jpg, svg)
    var saveType = document.getElementById('save-type').value;

    img.onload = function () {
      // Measure the text width to calculate the required canvas width
      ctx.font = "23px Arial";
      var titleWidth = ctx.measureText(barcodeTitle).width;
      var subtitleWidth = ctx.measureText(barcodeSubtitle).width;
      var underlabel = ctx.measureText(underbarcodelabels).width;
      var noteWidth = ctx.measureText(barcodeNote).width;

      // Determine the maximum width between the image and the longest text
      var textMaxWidth = Math.max(titleWidth, subtitleWidth, underlabel, noteWidth);
      var canvasWidth = Math.max(img.width, textMaxWidth + 70); // Add padding
      var canvasHeight = img.height + 105; // Extra space for title, subtitle, and note

      canvas.width = canvasWidth;
      canvas.height = canvasHeight;

      // Clear the canvas and set background color to white
      ctx.fillStyle = "#fff";
      ctx.fillRect(0, 0, canvasWidth, canvasHeight);

      // Draw the barcode title at the top
      ctx.font = "23px Arial";
      ctx.fillStyle = "#000";
      ctx.textAlign = "center";
      if (barcodeTitle) {
        ctx.fillText(barcodeTitle, canvasWidth / 2, 30);
      }
      ctx.font = "16px Arial";
      ctx.fillStyle = "#000";
      ctx.textAlign = "center";
      // Draw the barcode subtitle below the title
      if (barcodeSubtitle) {
        ctx.fillText(barcodeSubtitle, canvasWidth / 2, 55);
      }
      // Draw the barcode in the center
      ctx.drawImage(img, (canvasWidth - img.width) / 2, 60); // Center the barcode
      // Draw the barcode under at the bottom
      ctx.font = "23px Arial";
      if (underbarcodelabels) {
        ctx.fillText(underbarcodelabels, canvasWidth / 2, canvasHeight - 30);
      }
      // Draw the barcode note at the bottom
      ctx.font = "16px Arial";
      if (barcodeNote) {
        ctx.fillText(barcodeNote, canvasWidth / 2, canvasHeight - 10);
      }
      // Create a link and trigger download based on the selected format
      if (saveType === 'png' || saveType === 'jpg') {
        var imgFile = canvas.toDataURL("image/" + saveType);
        var link = document.createElement('a');
        link.download = document.getElementById("barcodeval"+lineNo+"").value+ '.' + saveType;
        link.href = imgFile;
        link.click();
      } else if (saveType === 'svg') {
        var link = document.createElement('a');
        link.download = document.getElementById("barcodeval"+lineNo+"").value+ '.svg';
        link.href = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
        link.click();
      }
    };

    img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
  });
  // Print the barcode using a new window
document.getElementById('print-barcode').addEventListener('click', function () {
    document.getElementById('pdf-preview').style.display = 'none';
    lineNo = document.getElementById("dynamicchanginput").value;
    var svg = document.getElementById('barcode');
    var svgData = new XMLSerializer().serializeToString(svg);
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext("2d");
    var img = new Image();

    // Barcode title, subtitle, and note values
    var barcodeTitle = document.getElementById("barcodetitle"+lineNo+"").value;
    var barcodeSubtitle = document.getElementById("barcodesubtitle"+lineNo+"").value;
    var underbarcodelabels = document.getElementById("underbarcodelabel"+lineNo+"").value;
    var barcodeNote = document.getElementById("footernote"+lineNo+"").value;

    img.onload = function () {
        // Calculate canvas size based on barcode image and text sizes
        ctx.font = "23px Arial";
        var titleWidth = ctx.measureText(barcodeTitle).width;
        var subtitleWidth = ctx.measureText(barcodeSubtitle).width;
        var underLabelWidth = ctx.measureText(underbarcodelabels).width;
        var noteWidth = ctx.measureText(barcodeNote).width;

        var canvasWidth = Math.max(img.width, titleWidth, subtitleWidth, underLabelWidth, noteWidth) + 70; // Add padding
        var canvasHeight = img.height + 105; // Extra space for title, subtitle, and note

        canvas.width = canvasWidth;
        canvas.height = canvasHeight;

        // Clear canvas and set background to white
        ctx.fillStyle = "#fff";
        ctx.fillRect(0, 0, canvasWidth, canvasHeight);

        // Draw the barcode title at the top
        ctx.font = "23px Arial";
        ctx.fillStyle = "#000";
        ctx.textAlign = "center";
        if (barcodeTitle) {
            ctx.fillText(barcodeTitle, canvasWidth / 2, 30);
        }

        // Draw the barcode subtitle below the title
        ctx.font = "16px Arial";
        if (barcodeSubtitle) {
            ctx.fillText(barcodeSubtitle, canvasWidth / 2, 55);
        }

        // Draw the barcode image in the center
        ctx.drawImage(img, (canvasWidth - img.width) / 2, 60);

        // Draw the under barcode label
        ctx.font = "23px Arial";
        if (underbarcodelabels) {
            ctx.fillText(underbarcodelabels, canvasWidth / 2, canvasHeight - 30);
        }

        // Draw the footer note
        ctx.font = "16px Arial";
        if (barcodeNote) {
            ctx.fillText(barcodeNote, canvasWidth / 2, canvasHeight - 10);
        }

        // Generate PDF and display in iframe
        var { jsPDF } = window.jspdf; // Reference jsPDF
        var pdf = new jsPDF('p', 'px', 'a4');
        var imgData = canvas.toDataURL('image/png');

        // Add the image to the PDF
        pdf.addImage(imgData, 'PNG', 0, 0, canvasWidth, canvasHeight);

        // Convert the PDF to Blob and create an object URL
        var pdfBlob = pdf.output('blob');
        var pdfUrl = URL.createObjectURL(pdfBlob);

        // Create a hidden iframe and load the PDF into it
        var iframe = document.createElement('iframe');
        iframe.style.display = 'none';
        document.body.appendChild(iframe);
        iframe.src = pdfUrl;

        // Automatically trigger the print action once the iframe is loaded
        iframe.onload = function() {
            iframe.contentWindow.print();
        };
    };

    // Load the barcode SVG data as an image
    img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
});
</script>
									<div class="modal fade" id="triggerconfirm-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<p class="modal-title" id="exampleModalLabel" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 18px;">
														Confirm Submit
													</p>
													<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -33px;">
														<span aria-hidden="true" style="font-size: 21px;font-weight: 600;">
															&times;
														</span>
													</button>
												</div>
												<div class="modal-body" style="height: max-content;">
													<div id="loadimgbig" style="display: none;">
														<!-- <div class="text-center">
															<span id="timer">Please wait <span id="time"></span> Seconds</span>
														</div>
														<br>
														<img src="loading.gif" alt="Loading..." style="width: 100%;">
														<br> -->
														<img src="loading.gif" alt="Loading..." style="width: 100%;">
													</div>
													<table class="table notforfinaloutputsave showhideload">
														<tr>
															<th style="text-align:left !important">
																<label class="custom-label">
																	<?= $infomainaccessuser['modulename'] ?> No
																</label>
															</th>
															<td>
																<input type="text" name="validinvoiceno" id="validinvoiceno" class="form-control form-control-sm finalsubmitrequired" readonly required>
															</td>
														</tr>
														<tr>
															<th style="text-align:left !important">
																<label class="custom-label">
																	<?= $infomainaccessuser['modulename'] ?> Date
																</label>
															</th>
															<td>
																<input type="date" name="validinvoicedate" id="validinvoicedate" class="form-control form-control-sm finalsubmitrequired" readonly required>
															</td>
														</tr>
														<tr>
															<th style="text-align:left !important">
																<label class="custom-label">
																	Total Amount
																</label>
															</th>
															<td>
																<input type="number" name="validinvoiceamount" id="validinvoiceamount" class="form-control form-control-sm finalsubmitrequired" readonly required>
															</td>
														</tr>
														<tr style="<?=(($access['definvpay']=='split')?'':'display: none;')?>">
															<th style="text-align:left !important;background-color: #e9ecef;">
																<label class="custom-label">
																	Cash Received
																</label>
															</th>
															<td style="background-color: #e9ecef;">
																<input type="number" name="cashreceived" id="cashreceived" oninput="splitchecking()" class="form-control form-control-sm finalsubmitrequired" required step="any" value="0.00">
															</td>
														</tr>
														<tr style="<?=(($access['definvpay']=='split')?'':'display: none;')?>">
															<th style="text-align:left !important;background-color: #e9ecef;">
																<label class="custom-label">
																	Card Received
																</label>
															</th>
															<td style="background-color: #e9ecef;">
																<input type="number" name="cardreceived" id="cardreceived" oninput="splitchecking()" class="form-control form-control-sm finalsubmitrequired" required step="any" value="0.00">
															</td>
														</tr>
														<tr style="<?=(($access['definvpay']=='split')?'':'display: none;')?>">
															<th style="text-align:left !important;background-color: #e9ecef;">
																<label class="custom-label">
																	Gpay Received
																</label>
															</th>
															<td style="background-color: #e9ecef;">
																<input type="number" name="gpayreceived" id="gpayreceived" oninput="splitchecking()" class="form-control form-control-sm finalsubmitrequired" required step="any" value="0.00">
															</td>
														</tr>
														<tr style="<?=(($access['definvpay']=='split')?'display: none;':'')?>">
															<th style="text-align:left !important;background-color: #e9ecef;">
																<label class="custom-label">
																	Payment Method
																</label>
															</th>
															<?php
																if ($access['invautosave']=='1') {
															?>
															<td style="background-color: #e9ecef;">
																<div class="col-lg-12">
																	<select class="select2-field form-control form-control-sm finalsubmitrequired" name="invoiceterm" maxlength="100" id="invoiceterm" required onchange="ihaveblock()">
																	<?php
																		$sqlis=$con->prepare("SELECT term FROM pairterms WHERE (createdid=? OR createdid='0') ORDER BY term ASC");
    																	$sqlis->bind_param("i", $companymainid);
																		$sqlis->execute();
																		$sqli = $sqlis->get_result();
																		while($info=$sqli->fetch_array()){
																			if (($info['term']!='BANK ACCOUNT')&&($info['term']!='UPI')) {
																	?>
																				<option value="<?= $info['term'] ?>" <?=($info['term']==$access['invdefautosaveterm'])?'selected':''?>>
																					<?= $info['term'] ?>
																				</option>
																	<?php
																			}
																		}
																		$sqli->close();
																		$sqlis->close();
																	?>
																	</select>
																</div>
															</td>
														<?php
															}
															else{
														?>
															<td style="background-color: #e9ecef;">
																<div class="col-lg-12">
																	<select class="select2-field form-control form-control-sm finalsubmitrequired" name="invoiceterm" maxlength="100" id="invoiceterm" required onchange="ihaveblock()">
																	<?php
																		$sqlis=$con->prepare("SELECT term FROM pairterms WHERE (createdid=? OR createdid='0') ORDER BY term ASC");
    																	$sqlis->bind_param("i", $companymainid);
																		$sqlis->execute();
																		$sqli = $sqlis->get_result();
																		while($info=$sqli->fetch_array()){
																			if (($info['term']!='BANK ACCOUNT')&&($info['term']!='UPI')) {
																	?>
																				<option value="<?= $info['term'] ?>" <?=($info['term']=="CASH")?'selected':''?>>
																					<?= $info['term'] ?>
																				</option>
																	<?php
																			}
																		}
																		$sqli->close();
																		$sqlis->close();
																	?>
																	</select>
																</div>
															</td>
														<?php
															}
														?>
														</tr>
														<tr style="<?=(($access['definvpay']=='split')?'':'display: none;')?>">
															<td id="usermessage"></td>
														</tr>
														<tr id="validpaidblock">
															<th style="text-align:left !important;background-color: #e9ecef;">
																<label class="custom-label text-danger">
																	<?=(($access['definvpay']=='split')?'Amount Received':'Cash Received')?> *
																</label>
															</th>
															<td style="background-color: #e9ecef;">
																<input type="number" name="validpaidamount" id="validpaidamount" class="form-control form-control-sm finalsubmitrequired" placeholder="0.00" required oninput="paidamountcalc()" value="">
																<script>
																function paidamountcalc(){
																	var validinvoiceamount=$("#validinvoiceamount").val();
																	var validpaidamount=$("#validpaidamount").val();
																	// $("#validpaidamount").val(validinvoiceamount);
																	if((validinvoiceamount!='')&&(validpaidamount!='')){
																		var balance=parseFloat(validinvoiceamount)-parseFloat(validpaidamount);
																		$("#validbalance").val((balance*-1));
																		$("#validbalances").val((balance*-1));
																	}
																	else{
																		// $("#validpaidamount").val(0);
																	}
																}
																</script>
															</td>
														</tr>
														<input type="hidden" name="validbalances" id="validbalances">
														<tr id="duedateblock">
															<th style="text-align:left !important;background-color: #e9ecef;">
																<label for="duedates" class="custom-label">
																	Due Date
																</label>
															</th>
															<td style="background-color: #e9ecef;">
																<div class="row">
																	<div class="col-lg-5 duedateselect" style="margin-top: -3px !important;" onclick="andus()">
																		<select class="select2-field form-control form-control-sm" name="duedates" maxlength="100" id="duedates" onchange="funduedates()">
																		<?php
																			$sqlis=$con->prepare("SELECT * FROM pairduedates WHERE (createdid=? or createdid='0') ORDER BY duedate ASC");
    																		$sqlis->bind_param("i", $companymainid);
																			$sqlis->execute();
																			$sqli = $sqlis->get_result();
																			while($info=$sqli->fetch_array()){
																		?>
																				<option value="<?= $info['noofdays'] ?>,<?=$info['duedate']?>" <?=($info['duedate']=="Net 30")?'selected':''?>>
																					<?= $info['duedate'] ?>
																				</option>
																		<?php
																			}
																			$sqli->close();
																			$sqlis->close();
																		?>
																		</select>
																	</div>
																	<div class="col-lg-7 duedatepicker">
																		<input type="date" class="form-control form-control-sm" id="duedate" name="duedate">
																	</div>
																</div>
																<script>
																function splitchecking() {
																	if ($("#cashreceived").val()=='') {
																		// $("#cashreceived").val(0);
																	}
																	if ($("#cardreceived").val()=='') {
																		// $("#cardreceived").val(0);
																	}
																	if ($("#gpayreceived").val()=='') {
																		// $("#gpayreceived").val(0);
																	}
																	$("#validpaidamount").val((parseFloat($("#cashreceived").val()) + parseFloat($("#cardreceived").val()) + parseFloat($("#gpayreceived").val())));
																	$("#validbalance").val(((parseFloat($("#validinvoiceamount").val())-parseFloat($("#validpaidamount").val()))*-1));
																	$("#validbalances").val(((parseFloat($("#validinvoiceamount").val())-parseFloat($("#validpaidamount").val()))*-1));
																	if (($("#validinvoiceamount").val()) == (parseFloat($("#cashreceived").val()) + parseFloat($("#cardreceived").val()) + parseFloat($("#gpayreceived").val()))) {
																		$("#usermessage").html('<span class="text-success">Total Amount Matched</span>');
																		document.getElementById("ihavediv").style.display='block';
																		if (document.getElementById("ihavereceived").checked==true) {
																			document.getElementById("savecanceldiv").style.display='block';
																		}
																	}
																	else{
																		$("#usermessage").html('<span class="text-danger">Total Amount Mismatched</span>');
																		document.getElementById("ihavediv").style.display='none';
																		document.getElementById("savecanceldiv").style.display='none';
																	}
																}
																function addDays(date, days) {
																	var result = new Date(date);
																	days=parseFloat(days);
																	result.setDate(result.getDate() + days);
																	return result;
																}
																setTimeout(function() {
																	funduedates();
																	ihaveblock();
																},1500);
																function funduedates(){
																	var duedates=$("#duedates").val().split(',')[0];
																	var invoicedate=$("#invoicedate").val();
																	var today="";
																	if(duedates!=''){
																		// console.log(invoicedate);
																		// console.log(duedates);
																		today=addDays(invoicedate, duedates);
																		var dd = String(today.getDate()).padStart(2, '0');
																		var mm = String(today.getMonth() + 1).padStart(2, '0');
																		var yyyy = today.getFullYear();
																		today = yyyy + '-' + mm + '-' + dd;
																	}
																	$("#duedate").val(today);
																}
																</script>
															</td>
														</tr>
														<tr id="validbalanceblock">
															<th style="text-align:left !important;background-color: #e9ecef;">
																<label class="custom-label">
																	Change Due
																</label>
															</th>
															<td style="background-color: #e9ecef;">
																<input type="number" name="validbalance" id="validbalance" class="form-control form-control-sm finalsubmitrequired" value="0" required readonly>
															</td>
														</tr>
													</table>
													<div class="custom-control custom-checkbox mr-sm-2 mx-2 showhideload" id="ihavediv">
														<input type="checkbox" class="custom-control-input" name="ihavereceived" id="ihavereceived" value="1" onclick="ihavereceive()">
														<label class="custom-control-label custom-label" for="ihavereceived">
															I have Received this Payment
														</label>
													</div>
													<script type="text/javascript">
													$(document).ready(function() {
														var ihaveterm = document.getElementById("invoiceterm").value;
														var ihavereceived = document.getElementById("ihavereceived");
														if (ihaveterm=='CASH'&&ihavereceived.checked==true) {
															document.getElementById("savecanceldiv").style.display='block';
														}
														else if(ihaveterm=='CASH'&&ihavereceived.checked==false){
		  													document.getElementById("savecanceldiv").style.display='none';
														}
														else{
															document.getElementById("savecanceldiv").style.display='block';
														}
	 													if (ihaveterm=='CASH') {
		  													document.getElementById("ihavediv").style.display='block';
		  													document.getElementById("duedateblock").style.display='none';
															document.getElementById("validbalanceblock").style.display='table-row';
															document.getElementById("validpaidblock").style.display='table-row';
		  													$("#validpaidamount").attr("required","required");
	 													}
	 													else{
		  													document.getElementById("ihavediv").style.display='none';
		  													document.getElementById("duedateblock").style.display='table-row';
															document.getElementById("validbalanceblock").style.display='none';
															document.getElementById("validpaidblock").style.display='none';
		  													$("#validpaidamount").removeAttr("required");
	 													}
													});
													function ihavereceive() {
														var ihaveterm = document.getElementById("invoiceterm").value;
														var ihavereceived = document.getElementById("ihavereceived");
														if (ihaveterm=='CASH'&&ihavereceived.checked==true) {
															document.getElementById("savecanceldiv").style.display='block';
														}
														else if(ihaveterm=='CASH'&&ihavereceived.checked==false){
		  													document.getElementById("savecanceldiv").style.display='none';
														}
														else{
															document.getElementById("savecanceldiv").style.display='block';
														}
													}
													function ihaveblock() {
														var ihaveterm = document.getElementById("invoiceterm").value;
														var ihavereceived = document.getElementById("ihavereceived");
														if (ihaveterm=='CASH'&&ihavereceived.checked==true) {
															document.getElementById("savecanceldiv").style.display='block';
														}
														else if(ihaveterm=='CASH'&&ihavereceived.checked==false){
		  													document.getElementById("savecanceldiv").style.display='none';
														}
														else{
															document.getElementById("savecanceldiv").style.display='block';
														}
														if (ihaveterm=='CASH') {
															document.getElementById("ihavediv").style.display='block';
		  													document.getElementById("duedateblock").style.display='none';
															document.getElementById("validbalanceblock").style.display='table-row';
															document.getElementById("validpaidblock").style.display='table-row';
		  													$("#validpaidamount").attr("required","required");
														}
														else{
															document.getElementById("ihavediv").style.display='none';
		  													document.getElementById("duedateblock").style.display='table-row';
															document.getElementById("validbalanceblock").style.display='none';
															document.getElementById("validpaidblock").style.display='none';
		  													$("#validpaidamount").removeAttr("required");
														}
	 													if (ihaveterm=='CREDIT') {
		  													var selectElement = document.getElementById("duedates");
															var options = selectElement.getElementsByTagName("option");
															for (var i = options.length - 1; i>= 0; i--) {
		  														if (options[i].hasAttribute("disabled")) {
			 														selectElement.removeChild(options[i]);
		  														}
															}
		  													$("#duedates").val('30,Net 30');
		  													$('select[name^="duedates"] option').filter(function() {
	 															return $(this).text() == 'Net 30';
															}).prop('selected', true);
		  													funduedates();
	 													}
	 													else{
		  													$("#duedate").val('');
		  													$("#duedates").val('');
		  													$("#duedates").append('<option selected disabled value="">Due Terms</option>');
	 													}
													}
													</script>
												</div>
												<div class="modal-footer mt-4">
													<div  id="savecanceldiv">
														<button type="submit" id="Submit" name="submit" class="btn btn-primary btn-sm btn-custom ">
															SAVE
														</button>
														<a class="btn btn-primary btn-sm btn-custom-grey" onclick="finalmodalclose()" data-bs-dismiss="modal" aria-label="Close" style="margin-top:-3px !important;">
															CANCEL
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!---payment confirm---->
									<!-- FOR PAYMENT MODAL -->
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
		include('footer.php');
		// FOR FOOTER FILES
	?>
	</div>
</main>
<!-- subtext -->
<script type="text/javascript">
$(function(){
	$(".select2").select2({
		matcher: matchCustom,
		templateResult: formatCustom
	});
});
function stringMatch(term, candidate) {
	return candidate && candidate.toLowerCase().indexOf(term.toLowerCase())>= 0;
}
function matchCustom(params, data) {
	if ($.trim(params.term) === '') {
		return data;
	}
	if (typeof data.text === 'undefined') {
		return null;
	}
	if (stringMatch(params.term, data.text)) {
		return data;
	}
	if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
		return data;
	}
	return null;
}
function formatCustom(state) {
	return $('<div><div>' + state.text + '</div><div class="foo">'+ $(state.element).attr('data-foo')+ '</div></div>');
}
// FOR SELECT2 ASSIGING

$(document).ready(function() {
	$("#customer").on("select2:open", function() {
		$("#configureunits").attr("data-bs-target","#custAddNewCustomer");
		$("#configureunits").show();
	});
	$("#customer").on("select2:open", function() {
		$("#configureunits").show();
	<?php
		if($access['invnewcustomerdef']=='1'){
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
});
// FOR NEW MODAL WORD AND PATH WHEN THE SELECT DROP DOWN OPENS
</script>
<?php
include('fexternals.php');
// FOR COMMON JAVASCRIPT FILES AND SOURCES
?>
<script type="text/javascript">
$("#validpaidamount").click(function(){
	setTimeout(function() {
		$("#validpaidamount").select();
	},100);
});
$("#cashreceived").click(function(){
	setTimeout(function() {
	$("#cashreceived").select();
},100);
});
$("#cardreceived").click(function(){
	setTimeout(function() {
	$("#cardreceived").select();
},100);
});
$("#gpayreceived").click(function(){
	setTimeout(function() {
	$("#gpayreceived").select();
},100);
});
</script>
<script type="text/javascript">
function andun() {
	$(".select2-container--open .select2-dropdown--above").hide();
	$(".select2-container--open .select2-dropdown--below").hide();
}
function andus() {
	$(".select2-container--open .select2-dropdown--above").show();
	$(".select2-container--open .select2-dropdown--below").show();
}
// FOR SELECT DROP DOWN CONTAINER

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
// FOR CUSTOMER ADD MODAL SAMES AS BILLING CHECKBOX

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
// FOR CUSTOEMR ADD MODAL TAX PREFERENCE RADIO BUTTONS

function showDiv(element){
	if (element.value == '') {
		document.getElementById('custgstblock').style.display = 'none';
		document.getElementById('custplaceofsupply').style.display = 'block';
		$("#custpos").attr("required","required");
		$("#custgstin").removeAttr("required");
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
function showDivcust(elementcust){
	if (elementcust == '') {
		document.getElementById('custgstinblock').style.display = 'none';
	}
	else if (elementcust == 'Registered Business - Regular') {
		document.getElementById('custgstinblock').style.display = 'block';
	}
	else if (elementcust == 'Registered Business - Composition') {
		document.getElementById('custgstinblock').style.display = 'block';
	}
	else if (elementcust == 'Unregistered Business') {
		document.getElementById('custgstinblock').style.display = 'none';
	}
	else if (elementcust == 'Consumer') {
		document.getElementById('custgstinblock').style.display = 'none';
	}
	else if (elementcust == 'Overseas') {
		document.getElementById('custgstinblock').style.display = 'none';
	}
	else if (elementcust == 'Special Economic Zone') {
		document.getElementById('custgstinblock').style.display = 'block';
	}
	else if (elementcust == 'Deemed Export') {
		document.getElementById('custgstinblock').style.display = 'block';
	}
	else if (elementcust == 'Tax Deductor') {
		document.getElementById('custgstinblock').style.display = 'block';
	}
	else if (elementcust == 'SEZ Developer') {
		document.getElementById('custgstinblock').style.display = 'block';
	}
}
// FOR CUSTOMER ADD MODAL GST TYPE CONCEPTS

function funaddcategory() {
	var missingcategory = document.getElementById('custmissingcategory');
	if (missingcategory.value == '') {
		alert('Please Enter New Category Name');
		missingcategory.focus();
		return false;
	}
	else {
		$('#custcategory').append('<option value="' + missingcategory.value + '">' + missingcategory.value + '</option>');
		$('#custcategory').val(missingcategory.value).change();
		$('#custAddNewCategory').modal('hide');
		return false;
	}
}
function funescategory() {
	$('#custAddNewCategory').modal('hide');
	return false;
}
// FOR NEW CATEGORY IN CUSTOMER ADD MODAL

function funaddsubcategory() {
	var missingsubcategory = document.getElementById('custmissingsubcategory');
	if (missingsubcategory.value == '') {
		alert('Please Enter New Sub Category Name');
		missingsubcategory.focus();
		return false;
	}
	else {
		$('#custsubcategory').append('<option value="' + missingsubcategory.value + '">' + missingsubcategory.value + '</option>');
		$('#custsubcategory').val(missingsubcategory.value).change();
		$('#custAddNewSubCategory').modal('hide');
		return false;
	}
}
function funessubcategory() {
	$('#custAddNewSubCategory').modal('hide');
	return false;
}
// FOR NEW SUBCATEGORY IN CUSTOMER ADD MODAL

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
// FOR SELECT NEW WORD AND PATHS

function funaddcustomer() {
	var custcustomerdname = document.getElementById('custcustomerdname');
	var custgsttype = document.getElementById("custgstrtype");
	var custgsttypeans = custgsttype.options[custgsttype.selectedIndex].text;
	var custpos = document.getElementById("custpos");
	var custposans = custpos.options[custpos.selectedIndex].text;
	var custgstin = document.getElementById("custgstin");
	if (custcustomerdname.value == ''||custgsttypeans=="Select Type of Add"||(custposans=="Select The Place"&&custgsttypeans!="Overseas")||((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin.value=='')) {
		if (custcustomerdname.value == '') {
			custcustomerdname.focus();
		}
		else if (custgsttypeans=="Select Type of Add") {
			custgsttype.focus();
		}
		else if ((custposans=="Select The Place"&&custgsttypeans!="Overseas")) {
			custpos.focus();
		}
		else if (((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin.value=='')) {
			custgstin.focus();
		}
		return false;
	}
	else {
		$('#custcustomer').append('<option value="' + custcustomerdname.value + '">' + custcustomerdname.value + '</option>');
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

$(function(){
	$("#custgstrtype").select2({
		matcher: matchCustom,
		templateResult: formatCustom
	});
	$("#gstgstrtype").select2({
		matcher: matchCustom,
		templateResult: formatCustom
	});
})
function stringMatch(term, candidate) {
	return candidate && candidate.toLowerCase().indexOf(term.toLowerCase())>= 0;
}
function matchCustom(params, data) {
	if ($.trim(params.term) === '') {
		return data;
	}
	if (typeof data.text === 'undefined') {
		return null;
	}
	if (stringMatch(params.term, data.text)) {
		return data;
	}
	if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
		return data;
	}
	return null;
}
function formatCustom(state) {
	return $('<div><div>' + state.text + '</div><div class="foo">' + $(state.element).attr('data-foo') + '</div></div>');
}
// FOR NEW CUSTOMER
$(document).ready(function(){
	$("#submitproduct").click(function(e){
		e.preventDefault();
		var proproductname=$("#proproductname").val();
		var prodefaultunit = document.getElementById("prodefaultunit");
		var prodefaultunitans = prodefaultunit.options[prodefaultunit.selectedIndex].text;
		if(proproductname==""||prodefaultunitans=="Unit"){
			if (proproductname == '') {
				alert("Please Enter the <?=$infomainaccessuserpro['modulename']?> Name");
			}
			else if (prodefaultunitans=="Unit") {
				alert("Please Select the Unit");
			}
			return false;
		}
		else{
			$.ajax({
				type: "POST",
				url: "productadds.php",
				data: {
					productname: $("#proproductname").val(),
					codetags: $("#procodetags").val(),
					hsncode: $("#prohsncode").val(),
					delivery: $("#prodelinpbrd").val(),
					defaultunit: $("#prodefaultunit").val(),
					procategory: $("#procategory").val(),
					prosubcategory: $("#prosubcategory").val(),
					rack: $("#prorack").val(),
					description: $("#prodescription").val(),
					provisibility: $("#provisibility").val(),
					probarcodetitle: $("#probarcodetitle").val(),
					probarcodehead: $("#probarcodehead").val(),
					probarcodeformat: $("#probarcodeformat").val(),
					probarcode: $("#probarcode").val(),
					prounderbarcodelabel: $("#prounderbarcodelabel").val(),
					probarcodenotes: $("#probarcodenotes").val(),
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
					});
					function stringMatch(term, candidate) {
						return candidate && candidate.toLowerCase().indexOf(term.toLowerCase())>= 0;
					}
					function matchCustom(params, data) {
						if ($.trim(params.term) === '') {
							return data;
						}
						if (typeof data.text === 'undefined') {
							return null;
						}
						if (stringMatch(params.term, data.text)) {
							return data;
						}
						if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
							return data;
						}
						return null;
					}
					function formatCustom(state) {
						return $('<div><div>' + state.text + '</div><div class="foo">' + $(state.element).attr('data-foo') + '</div></div>');
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
					$("#procategory").on("select2:open", function() {
						document.getElementById("configureunits").innerHTML = "New <?=$access['txtnamecategory']?>";
					});
					$("#prodefaultunit").on("select2:open", function() {
						$("#configureunits").attr("data-bs-target","#proAddNewDefaultUnit");
					});
					$("#prodefaultunit").on("select2:open", function() {
						document.getElementById("configureunits").innerHTML = "New Unit";
					});
					const resarray = result.split("|");
					alert(resarray[0]);
					if(resarray[1]=='0'){}
					else{
						var proproductname=$("#prooriginpage").val();
						var proids=$("#ppp").val();
						$('.product1').append('<option value="' + resarray[1] + '">' + proproductname + '</option>');
						$('select[name^="product'+proids+'"] option[value="' + resarray[1] + '"]').attr("selected","selected");
						$('#product'+proids+'').val(resarray[1]).change();
						$('#AddNewProduct').modal('hide');
					}
				}
			});
		}
	});
// FOR NEW PRODUCT

	$("#custsubmitcustomer").click(function(e){
		e.preventDefault();
		var custcustomerdname=$("#custcustomerdname").val();
		var custgsttype = document.getElementById("custgstrtype");
		var custgsttypeans = custgsttype.options[custgsttype.selectedIndex].text;
		var custpos = document.getElementById("custpos");
		var custposans = custpos.options[custpos.selectedIndex].text;
		var custgstin = $("#custgstin").val();
		if(custcustomerdname==""||custgsttypeans=="Select Type of Add"||(custposans=="Select The Place"&&custgsttypeans!="Overseas")||((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin=='')){
			if (custcustomerdname == '') {
				alert("Please Enter the <?= $infomainaccessusercus['modulename'] ?> Name");
			}
			else if (custgsttypeans=="Select Type of Add") {
				alert("Please Select the GST Type");
			}
			else if ((custposans=="Select The Place"&&custgsttypeans!="Overseas")) {
				alert("Please Select the Place of Supply");
			}
			else if (((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin=='')) {
				alert("Please Enter the GST In Value");
			}
			return false;
		}
		else{
			$.ajax({
				type: "POST",
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
					dlt: $("#custdlt").val(),
					dlo: $("#custdlo").val(),
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
					});
					function stringMatch(term, candidate) {
						return candidate && candidate.toLowerCase().indexOf(term.toLowerCase())>= 0;
					}
					function matchCustom(params, data) {
						if ($.trim(params.term) === '') {
							return data;
						}
						if (typeof data.text === 'undefined') {
							return null;
						}
						if (stringMatch(params.term, data.text)) {
							return data;
						}
						if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
							return data;
						}
						return null;
					}
					function formatCustom(state) {
						return $('<div><div>' + state.text + '</div><div class="foo">' + $(state.element).attr('data-foo') + '</div></div>');
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
					if(resarray[1]=='0'){}
					else{
						var custcustomerdname=$("#custoriginpage").val();
						var billcity=$("#custbillcity").val();
						var mobilephone=$("#custmobilephone").val();
						$('#customer').append('<option value="' + resarray[1] + '">' + custcustomerdname + '</option>');
						$('select[name^="customer"] option[value="' + resarray[1] + '"]').attr("selected","selected");
						$('#customer').val(resarray[1]).change();
						$('#custAddNewCustomer').modal('hide');
					}
				}
			});
		}
	});
});
// FOR NEW CUSTOMER

let lineNo = 2;
$(document).ready(function () {
	$(".productadd-row").click(function () {
		addnewrow(lineNo);
		lineNo++;
	});
});
// FOR ADD ANOTHER LINE IN PRODUCT

var proalreadychnxtlvl = 0;
function proautocomp(lineNo){
	$("#product"+lineNo).on("select2:open", function() {
		$("#configureunits").attr("data-bs-target","#AddNewProduct");
		$("#configureunits").show();
	});
	$("#product"+lineNo).on("select2:open", function() {
	<?php
		if($access['invnewproductdef']=='1'){
	?>
		$("#configureunits").show();
		document.getElementById("configureunits").innerHTML = "New <?=$infomainaccessuserpro['modulename']?>";
	<?php
		}
		else{
	?>
		$("#configureunits").hide();
	<?php
		}
	?>
	});
	$('#product'+lineNo).change(function(){
		proalreadychnxtlvl = 0;
		var id= $('#product'+lineNo).val();
		if(id != ''){
			$.get("prosearch1.php", {term: id} , function(data){
				// console.log(data);
				const obj = JSON.parse(data);
				// console.log(obj[0]);
				var oldproductnames = document.getElementsByName('productname[]');
				var oldbatch = document.getElementsByName('batch[]');
				var oldexp = document.getElementsByName('expdate[]');
				var proalreadych = 0;
				var nowthepro = obj[0].productname;
				var finalbatexp = 0;
			<?php
				if ($access['batchexpiryval']==1) {
			?>
				for (var i = 0; i < oldproductnames.length; i++){
					if(document.getElementById("outfordone"+(i+1)).innerHTML!=''){
						var gottedbatch = "Batch : "+oldbatch[i].value+" </td>";
						var gottedexp = "Expiry : "+oldexp[i].value+" </td>";
					}
					else{
						var gottedbatch = oldbatch[i].value;
						var gottedexp = oldexp[i].value;
					}
					if ((oldproductnames[i].value==nowthepro)&&(i+1!=lineNo)) {
						if(document.getElementById("outfordone"+(i+1)).innerHTML!=''){
							var lenofold = document.querySelectorAll("#outfordone"+(i+1)+" table").length;
						}
						else{
							var lenofold = 0;
						}
						for(f=0;f<lenofold;f++){
							if(document.getElementById("outfordone"+(i+1)).innerHTML!=''){
								var fully = document.getElementById("outfordone"+(i+1)).childNodes[f].innerHTML;
								if ((fully.includes(gottedbatch))&&(fully.includes(gottedexp))) {
									finalbatexp++;
								}
							}
						}
						if(document.getElementById("outfordone"+(i+1)).innerHTML==''){
							if (gottedbatch!=''||gottedexp!='') {
								finalbatexp++;
							}
							else if (gottedbatch==''&&gottedexp=='') {
								finalbatexp=0;
							}
						}
						if (finalbatexp==(parseInt(lenofold) + 1)) {
							proalreadych++;
		  					proalreadychnxtlvl++;
						}
					}
				}
			<?php
				}
				else{
			?>
				for (var i = 0; i < oldproductnames.length; i++){
					if ((oldproductnames[i].value==nowthepro)){
						proalreadych++;
						proalreadychnxtlvl++;
					}
				}
			<?php
				}
			?>
				if (proalreadych==0) {
					$("#productid"+lineNo).val(obj[0].id);
					$("#productname"+lineNo).val(obj[0].productname);
					$("#productnotes"+lineNo).val(obj[0].description);
					$("#productdescription"+lineNo).val(obj[0].description);
					$("#productdescription"+lineNo).css('display', 'inline');
					$("#viewbarcode"+lineNo).css('display', 'inline');
					$("#barcodeformat"+lineNo).val(obj[0].barcodeformat);
					$("#barcodetitle"+lineNo).val(obj[0].barcodetitle);
					$("#barcodesubtitle"+lineNo).val(obj[0].barcodesubtitle);
					$("#barcodeval"+lineNo).val(obj[0].barcodeval);
					$("#barcode"+lineNo).val(obj[0].barcodeval);
					$("#underbarcodelabel"+lineNo).val(obj[0].underbarcodelabel);
					$("#footernote"+lineNo).val(obj[0].footernote);
					$("#productdescriptionspan"+lineNo).css('display', 'block');
					$("#rackval"+lineNo).html(obj[0].rack);
					$("#rackval"+lineNo).css('display', 'inline-flex');
					$("#rack"+lineNo).val(obj[0].rack);
					$("#rackspan"+lineNo).css('display', 'inline');
					$("#itemmodulespan"+lineNo).html(obj[0].itemmodule);
					$("#itemmodule"+lineNo).val(obj[0].itemmodule);
					$("#itemmodulespan"+lineNo).css('display', 'inline-block');
					$("#producthsn"+lineNo).val(obj[0].hsncode);
					$("#vat"+lineNo).val(<?=(in_array('Tax Value', $fieldadd))?'obj[0].tax':'0'?>);
					$("#productrate"+lineNo).val(obj[0].salecost);
					$("#prodiscount"+lineNo).val(obj[0].salediscount);
					$("#prodisvalueforledger"+lineNo).val(obj[0].salediscount);
					$("#margintotal"+lineNo).css('display', 'inline-block');
					$("#productmanufacturerval"+lineNo).html(obj[0].category);
					$("#productmanufacturerval"+lineNo).css('display', 'inline-flex');
					$("#manufacturer"+lineNo).val(obj[0].category);
					$("#manufacturer"+lineNo).css('display', 'none');
					$("#productmanufacturerspan"+lineNo).css('display', 'inline');
					$("#productmanufactureredit"+lineNo).css('display', 'inline');
					$("#productmanufacturerupdate"+lineNo).css('display', 'none');
					$("#producthsncodeval"+lineNo).html(obj[0].hsncode);
					$("#producthsncodeval"+lineNo).css('display', 'inline-flex');
					$("#producthsn"+lineNo).val(obj[0].hsncode);
					$("#producthsn"+lineNo).css('display', 'none');
					$("#producthsncodespan"+lineNo).css('display', 'inline');
					$("#producthsncodeedit"+lineNo).css('display', 'inline');
					$("#producthsncodeupdate"+lineNo).css('display', 'none');
					$("#batch"+lineNo).val("");
					$("#quantity"+lineNo).val("");
					$("#productexpdateval"+lineNo).html("");
					$("#productexpdateval"+lineNo).css('display', 'inline');
					$("#expdate"+lineNo).val("");
					$("#expdate"+lineNo).css('display', 'none');
					$("#productexpdatespan"+lineNo).css('display', 'inline');
					$("#productexpdateedit"+lineNo).css('display', 'inline');
					$("#productexpdateupdate"+lineNo).css('display', 'none');
					$("#productmrpval"+lineNo).html("<?=$resmaincurrencyans?>"+((obj[0].salemrp!='')?obj[0].salemrp:'0.00')+"");
					$("#productmrpval"+lineNo).css('display', 'inline');
					$("#mrp"+lineNo).val(((obj[0].salemrp!='')?obj[0].salemrp:'0.00'));
					$("#mrp"+lineNo).css('display', 'none');
					$("#productmrpspan"+lineNo).css('display', 'inline-block');
					$("#productmrpedit"+lineNo).css('display', 'inline');
					$("#productmrpupdate"+lineNo).css('display', 'none');
					$("#productnoofpacksval"+lineNo).html(obj[0].noofpacks);
					$("#productnoofpacksval"+lineNo).css('display', 'inline');
					$("#noofpacks"+lineNo).val(obj[0].noofpacks);
					$("#noofpacks"+lineNo).css('display', 'none');
					$("#productnoofpacksspan"+lineNo).css('display', 'inline');
					$("#productunitspan"+lineNo).css('display', 'inline');
					$("#productunitval"+lineNo).html(obj[0].defaultunit);
					$("#productunit"+lineNo).val(obj[0].defaultunit);
					$("#productunit"+lineNo).css('display', 'none');
					$("#productunitval"+lineNo).css('display', 'inline');
					$("#productnoofpacksedit"+lineNo).css('display', 'inline');
					$("#productunitedit"+lineNo).css('display', 'inline');
					$("#productnoofpacksupdate"+lineNo).css('display', 'none');
					$("#productunitupdate"+lineNo).css('display', 'none');
					$("#productprodiscountval"+lineNo).html(obj[0].salediscount+'%');
					$("#productprodiscountval"+lineNo).css('display', 'inline');
					$("#prodiscount"+lineNo).val(obj[0].salediscount);
					$("#prodisvalueforledger"+lineNo).val(obj[0].salediscount);
					$("#prodiscount"+lineNo).css('display', 'none');
					$("#productprodiscountspan"+lineNo).css('display', 'inline-block');
					$("#productprodiscountedit"+lineNo).css('display', 'inline');
					$("#productprodiscountupdate"+lineNo).css('display', 'none');
					$("#productvatval"+lineNo).html(<?=(in_array('Tax Value', $fieldadd))?'obj[0].tax':'0'?>+'%');
					$("#productvatval"+lineNo).css('display', 'inline');
					$("#vat"+lineNo).val(<?=(in_array('Tax Value', $fieldadd))?'obj[0].tax':'0'?>);
					$("#vat"+lineNo).css('display', 'none');
					$("#productvatspan"+lineNo).css('display', 'inline-block');
					$("#productvatedit"+lineNo).css('display', 'inline');
					$("#productvatupdate"+lineNo).css('display', 'none');
					// var btndel = document.getElementsByName('productname[]');
					// var btndels = document.getElementsByName('product[]');
					// if ((btndel.length>1)||(btndel[0].value!='')) {
					// 	for(i=0;i<btndel.length;i++){
					// 		if (btndels[i].value!=0) {
					// 			var ids = btndel[i].id.split('productname');
					// 			var id = ids[1];
					// 			productcalc(id);
					// 		}
					// 	}
					// }
					// else{
					// 	document.getElementById('totalitems').value=0;
					// 	document.getElementById('totalquantity').value=0;
					// 	document.getElementById('totalamount').value=0;
					// 	document.getElementById('totalvatamount').value=0;
					// 	document.getElementById('roundoff').value=0;
					// 	document.getElementById('grandtotal').value=0;
					// 	document.getElementById('grandtotalfixed').value=0;
					// }
				}
				else{
					alert("This <?=$infomainaccessuserpro['modulename']?> Is Already Selected! Please Select The Another <?=$infomainaccessuserpro['modulename']?>");
					$('#product'+lineNo).parents("tr").remove();
					$("#loadimgbiggerscr").css("display","block");
					$("#loadimgbiggerscrrbackgrey").css("display","block");
					let timerForClose;
					let secondsforclose = 0;
	   			timerForClose = setInterval(() => {
	       			secondsforclose++;
	   			}, 1000);
					setTimeout(function() {
						var btndel = document.getElementsByName('productname[]');
						var btndels = document.getElementsByName('product[]');
						if ((btndel.length>1)||(btndel[0].value!='')) {
							for(i=0;i<btndel.length;i++){
								if (btndels[i].value!=0) {
									var ids = btndel[i].id.split('productname');
									var id = ids[1];
									productcalc(id);
								}
							}
						}
						else{
							document.getElementById('totalitems').value=0;
							document.getElementById('totalquantity').value=0;
							document.getElementById('totalamount').value=0;
							document.getElementById('totalvatamount').value=0;
							document.getElementById('roundoff').value=0;
							document.getElementById('grandtotal').value=0;
							document.getElementById('grandtotalfixed').value=0;
						}
						function closebigload() {
							if (secondsforclose>60) {
								$("#loadimgbiggerscr").css("display","none");
								$("#loadimgbiggerscrrbackgrey").css("display","none");
								clearInterval(timerForClose);
							}
						}
						clearInterval(timerForClose);
						$("#loadimgbiggerscr").css("display","none");
						$("#loadimgbiggerscrrbackgrey").css("display","none");
					},100);
				}
			});
		}
	});
	$("#product"+lineNo).on("select2:open", function() {
		document.getElementById("ppp").value = lineNo;
	});
}
// FOR GET THE PRODUCT INFORMATIONS WHEN THE PAGE LANDING 
proautocomp(1);
function addnewrow(lineNo){
	var y=0;
	var productvalues = document.getElementsByName('productvalue[]');
	for (var i = 0; i < productvalues.length; i++){
		if(productvalues[i].value==''){
			y++;
		}
	}
	if(y==0){
		markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td class="tdmove"><svg version="1.1" id="Layer_'+lineNo+'" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="BARCODE" style="<?=(in_array('Barcode', $fieldadd))?'':'display:none !important;'?>"><div><input type="text" name="barcode[]" id="barcode'+lineNo+'" onchange="checkthecode('+lineNo+')" class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;"></div><div><span id="viewbarcode'+lineNo+'" style="display:none; font-size:11px;color: royalblue;" data-bs-toggle="modal" data-bs-target="#barcodeModal" onclick="generateBarcode('+lineNo+')">View and Download Barcode</span><input type="hidden" id="barcodeformat'+lineNo+'"><input type="hidden" id="barcodetitle'+lineNo+'"><input type="hidden" id="barcodesubtitle'+lineNo+'"><input type="hidden" id="barcodeval'+lineNo+'"><input type="hidden" id="underbarcodelabel'+lineNo+'"><input type="hidden" id="footernote'+lineNo+'"></div></td><td data-label="ITEM DETAILS" style="padding-top: 1px !important;<?=(in_array('Item Details', $fieldadd))?'':'display:none !important;'?>"><input type="hidden" name="productid[]" id="productid'+lineNo+'"><input type="hidden" name="productname[]" id="productname'+lineNo+'"><div class="col-sm-9" onclick="andus()" style="width:278px;display: inline-block;margin-top: 1.5px !important;" id="selecttheproduct"><select class="form-control form-control-sm product proitemselect product1 proselect2" name="product[]" id="product'+lineNo+'"  onChange="productchange('+lineNo+')"><option value="" selected disabled>Select</option></select></div><span class="badge" style="display:none; width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan'+lineNo+'"></span><br><input type="hidden" name="itemmodule[]" id="itemmodule'+lineNo+'"><div <?=(in_array('Category', $fieldadd))?'':'style="display:none !important;"'?>><span id="productmanufacturerspan'+lineNo+'" style="display:none; font-size:11px;"><?=$access['txtnamecategory']?>:<input type="text" name="manufacturer[]" id="manufacturer'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;" readonly onChange="productcalc('+lineNo+')">  <span id="productmanufacturerval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><span id="productmanufactureredit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmanufacturerupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Hsn OR Sac', $fieldadd))?'':'style="display:none !important;"'?>><span id="producthsncodespan'+lineNo+'" style="display:none; font-size:11px;">HSN Code:</span><input type="text" name="producthsn[]" maxlength="100" id="producthsn'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="producthsncodeval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><span id="producthsncodeedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode('+lineNo+')"><i class="fa fa-edit"></i></span><span id="producthsncodeupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Rack', $fieldadd))?'':'style="display:none !important;"'?>><span id="rackspan'+lineNo+'" style="display:none; font-size:11px;">Rack:</span><span id="rackval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><input type="hidden" name="rack[]" id="rack'+lineNo+'"></div><span <?=(in_array('Product Description', $fieldadd))?'':'style="display:none !important;"'?>><span id="productdescriptionspan'+lineNo+'" style="display:none; font-size:11px;">Description:</span><textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription'+lineNo+'" style="height:50px; display:none;width: 146px !important;"></textarea></span><div class="col-sm-9 totalaccounts account'+lineNo+'" onclick="andus()" style="width:278px;display: none;margin-top: 5.5px !important;" id="selecttheproduct"><select style=" width: 100%;" class="select4 form-control form-control-sm" name="accountname[]" id="accountname'+lineNo+'"><option selected disabled value="">Select</option></select></div></td><td style="display:none"><input type="text" name="productnotes[]" id="productnotes'+lineNo+'" class="form-control form-control-sm proitemselect bordernoneinput"></td><td data-label="BATCH" <?=($access['batchexpiryval']==1)?'':'style="display:none;"'?>><div><input type="text" name="batch[]" maxlength="100" id="batch'+lineNo+'" onClick="batchget('+lineNo+');" onFocus="batchget('+lineNo+');" class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;display:inline;" list="" autocomplete="off"><div id="outfordone'+lineNo+'" class="dvi" style="display:none;width: 250px;"></div><input type="text" id="errbatch'+lineNo+'" style="display:none;"></div><span id="productexpdatespan'+lineNo+'" style="display:none; font-size:11px;">EXPIRY:</span><input type="date" name="expdate[]" id="expdate'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productexpdateval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productexpdateedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productexpdateupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate('+lineNo+')"><i class="fa fa-save"></i></span></td><td data-label="RATE" <?=(in_array('Rate', $fieldadd))?'':'style="display:none !important;"'?>><div><span style="font-size:15px !important;"><?= $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productrate[]"    id="productrate'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth productselectadd" onChange="productcalc('+lineNo+')" onClick="rateget('+lineNo+');" onFocus="rateget('+lineNo+');" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;"></div><div <?=(in_array('Mrp', $fieldadd))?'':'style="visibility:hidden !important;"'?>><span id="productmrpspan'+lineNo+'" style="display:none; font-size:11px;">MRP:<input type="number" name="mrp[]" id="mrp'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" onChange="productcalc('+lineNo+')"> <span id="productmrpval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productmrpedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmrpupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp('+lineNo+')"><i class="fa fa-save"></i></span></span></div><div class="dvi invbillgets" id="invbillgets'+lineNo+'" style="margin-top:-22px;display: none;width: 250px;border-radius: 0px !important;"><table width="100%"><tr style="border-bottom: none;"><td align="center" style="border-right: 1px solid #cccccc;width: 50% !important;display: inline-block !important;text-align: center;"><span onclick="invgetfun('+lineNo+',0)" id="invonoff'+lineNo+'"><?= strtoupper($infomainaccessuser['modulename']) ?></span></td><td align="center" style="width: 50% !important;display: inline-block !important;text-align: center;"><span onclick="billgetfun('+lineNo+')" id="billonoff'+lineNo+'"><?= strtoupper($infomainaccessuserbill['modulename']) ?></span></td><input type="text" style="display: none;" id="billorinv'+lineNo+'" value="inv"></tr></table></div><div id="ratelist'+lineNo+'" class="dvi ratedvi" style="display:none;width: 250px;"></div><input type="text" id="errrate'+lineNo+'" style="display:none;"></td><td data-label="<?=($access['txtqtyinv'])?>" <?=(in_array('Quantity', $fieldadd))?'':'style="display:none !important;"'?>><div><input type="number" min="0" step="0.01" name="quantity[]"  id="quantity'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth" onClick="qtych('+lineNo+')" onFocus="qtych('+lineNo+')" onChange="productcalc('+lineNo+')" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;display:inline;"></div><div <?=(in_array('Unit', $fieldadd))?'':'style="display:none !important;"'?>><span id="productunitspan'+lineNo+'" style="display:none; font-size:11px;">UNIT:</span><input type="text" name="productunit[]" id="productunit'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')" readonly><span id="productunitval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productunitedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editunit('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productunitupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Pack', $fieldadd))?'':'style="display:none !important;"'?>><span id="productnoofpacksspan'+lineNo+'" style="display:none; font-size:11px;">PACK:</span><input type="text" name="noofpacks[]" maxlength="100" id="noofpacks'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productnoofpacksval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productnoofpacksedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productnoofpacksupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks('+lineNo+')"><i class="fa fa-save"></i></span></div></td><td data-label="<?=$access['txttaxableinv']?>" <?=(in_array('Taxable Value', $fieldadd))?'':'style="display:none;"'?>> <div id="ruppeitemtablemobdfs"><span style="font-size:15px !important;"><?= $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly></div><div <?=(in_array('Discount', $fieldadd))?'':'style="display:none !important;"'?>><span id="productprodiscountspan'+lineNo+'" style="display:none; font-size:11px;"><?=$access['txtprodisinv']?>:<div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect'+lineNo+'"> <div class="input-group-prepend"> <input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 35px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> </div><select name="prodiscounttype[]" id="prodiscounttype'+lineNo+'" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 0px !important;" onChange="productcalc('+lineNo+')"><option value="0">%</option><option value="1"><?= $resmaincurrencyans; ?></option></select> </div> <input type="hidden" name="prodisvalueforledger[]" id="prodisvalueforledger'+lineNo+'"><span id="productprodiscountval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productprodiscountedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productprodiscountupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount('+lineNo+')"><i class="fa fa-save"></i></span></span></div><div style="<?=(in_array('Profit Margin', $fieldadd))?'':'display:none;'?>"><span data-bs-toggle="modal" data-bs-target="#ViewMarginDetails" style="color: green;font-size:13px;display: none;" id="margintotal'+lineNo+'" onclick="getmargindetails('+lineNo+')">Profit Margin : <span id="totalmarginvalue'+lineNo+'">0</span></span><input type="hidden" name="marginupdates[]" id="formarginupdates'+lineNo+'"><input type="hidden" name="margintotalvalue[]" id="margintotalvalue'+lineNo+'"></div></td><td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldadd))?'':'style="display:none;"'?>><div id="ruppeitemtablemobasdf"><span style="font-size:15px !important;"><?= $resmaincurrencyans; ?></span><input type="hidden" name="cgstvat[]" id="cgstvat'+lineNo+'"><input type="hidden" name="sgstvat[]" id="sgstvat'+lineNo+'"><input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly></div><div <?=(in_array('GST Percentage', $fieldadd))?'':'style="display:none !important;"'?>><span id="productvatspan'+lineNo+'" style="display:none; font-size:11px;">GST:<input type="number" min="0" step="0.01" name="vat[]" id="vat'+lineNo+'" class="form-control form-control-sm proitemselect notforfixed" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productvatedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editvat('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productvatupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat('+lineNo+')"><i class="fa fa-save"></i></span></span></div><div <?=(in_array('GST Rupee', $fieldadd))?'':'style="display:none !important;"'?>><span id="productcgstvatspan'+lineNo+'" style="display:none; font-size:11px;">CGST:</span><span id="productcgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productsgstvatspan'+lineNo+'" style="display:none; font-size:11px;">SGST:</span><span id="productsgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productigstvatspan'+lineNo+'" style="display:none; font-size:11px;">IGST:</span><span id="productigstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span></div></td><td data-label="AMOUNT" <?=(in_array('Amount', $fieldadd))?'':'style="display:none !important;"'?>><div id="ruppeitemtablemobasdf"><span style="font-size:15px !important;"><?= $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly></div></td><td <?=((in_array('Barcode', $fieldedit))||(in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit)))?'style="white-space:nowrap !important;"':'style="display:none !important;"'?>><div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldadd))?'display:none !important;':'display:none !important;'?>"><a href="javascript:;" class="p-0" id="dropdownadditionalinfo" data-bs-toggle="dropdown" aria-expanded="false"><svg width="15" height="15" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg></a><div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownadditionalinfo"><div style="background-color: #3c3c46;margin-top: -50px !important;"><a class="nav-link" style="color: #fff;width:max-content !important;" onclick="additionalinfo('+lineNo+')"><span class="nav-link-text ms-2 showorhidewords"> <span id="showadd'+lineNo+'">Show</span><span id="hideadd'+lineNo+'" style="display: none;">Hide</span> Additional Information</span></a></div></div></div><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;margin-left:7px;"></a></td></tr>';
	tableBody = $("#purchasetable");
	tableBody.append(markup);
	document.getElementById("totalProCount").innerHTML = document.getElementsByClassName("product1").length;
	$('#accountname'+lineNo+'').select4();
	$.ajax({
		type: "GET",
		url: 'inlistaccsearch.php?idname=accountname&lineNo='+lineNo+'',
		success: function (result) {
			// console.log(result);
			if (result!='') {
				$("#accountname"+lineNo+"").html(result);
				$('select[id^="accountname'+lineNo+'"] option').filter(function() {
					return $(this).text().toLowerCase() == 'accounts receivable';
				}).prop('selected', true);
			}
			else{
				$("#accountname"+lineNo+"").val("");
				$("#accountname"+lineNo+"").append('<option selected disabled value="">Select</option>');
			}
		},
		error: function (error) {
			// console.log(error);
		}
	});
	function template(data) {
  		return data.html;
	}
	$('input').on('mouseover', function() {
		$(this).attr('title', $(this).val());
	});
	$("input[type='number']").on("change", function () {
		$('input[type="number"]').not('#custbillpincode, #custshippincode, #billpincode, #twobillpincode, #shippincode, #twoshippincode, .notforfixed , #missingnoofdays').each(function () {
			if (!isNaN($(this).val())) {
				$(this).val(parseFloat($(this).val()).toFixed(2));
			}
	 	});
  	});
	$('textarea').on('mouseover', function() {
		$(this).attr('title', $(this).val());
	});
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
	$("#product"+lineNo).on("select2:open", function() {
		$("#configureunits").attr("data-bs-target","#AddNewProduct");
		$("#configureunits").show();
	});
	$("#product"+lineNo).on("select2:open", function() {
	<?php
		if($access['invnewproductdef']=='1'){
	?>
		$("#configureunits").show();
		document.getElementById("configureunits").innerHTML = "New <?=$infomainaccessuserpro['modulename']?>";
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
// FOR ADD NEW ROW IN PRODUCT TABLE

$(document).ready(function() {
	var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index){
			$(this).width($originals.eq(index).width())
		});
		return $helper;
	};
	$("#purchasetable tbody").sortable({
		helper: fixHelperModified,
		stop: function(event,ui) {
			renumber_table('#purchasetable')
		}
	}).disableSelection();
	$('table').on('click','.btn-delete',function() {
		tableID = '#' + $(this).closest('table').attr('id');
		var x = document.getElementById("purchasetable").rows.length;
		if(x!=2){
			r = confirm('Delete this item?');
			if(r) {
				$(this).closest('tr').remove();
				$("#loadimgbiggerscr").css("display","block");
				$("#loadimgbiggerscrrbackgrey").css("display","block");
				let timerForClose;
				let secondsforclose = 0;
   			timerForClose = setInterval(() => {
       			secondsforclose++;
   			}, 1000);
				renumber_table(tableID);
				setTimeout(function() {
					var btndel = document.getElementsByName('productname[]');
					var btndels = document.getElementsByName('product[]');
					if ((btndel.length>1)||(btndel[0].value!='')) {
						for(i=0;i<btndel.length;i++){
							if (btndels[i].value!=0) {
								var ids = btndel[i].id.split('productname');
								var id = ids[1];
								productcalc(id);
							}
						}
					}
					else{
						document.getElementById('totalitems').value=0;
						document.getElementById('totalquantity').value=0;
						document.getElementById('totalamount').value=0;
						document.getElementById('totalvatamount').value=0;
						document.getElementById('roundoff').value=0;
						document.getElementById('grandtotal').value=0;
						document.getElementById('grandtotalfixed').value=0;
					}
					function closebigload() {
						if (secondsforclose>60) {
							$("#loadimgbiggerscr").css("display","none");
							$("#loadimgbiggerscrrbackgrey").css("display","none");
							clearInterval(timerForClose);
						}
					}
					clearInterval(timerForClose);
					$("#loadimgbiggerscr").css("display","none");
					$("#loadimgbiggerscrrbackgrey").css("display","none");
				},100);
				document.getElementById("totalProCount").innerHTML = document.getElementsByClassName("product1").length;
			}
		}
		else{
			alert('Unable to Delete First row');
		}
	});
});
function renumber_table(tableID) {
	$(tableID + " tr").each(function() {
		count = $(this).parent().children().index($(this)) + 1;
		$(this).find('.priority').html(count);
	});
}
// FOR REMOVE THE ROW IN PRODUCT TABLE

function editmanufacturer(id){
	$("#productmanufacturerval"+id).css('display', 'none');
	$("#manufacturer"+id).css('display', 'inline');
	setTimeout(function() {
		$("#manufacturer"+id).select();
	},5);
	$("#productmanufacturerspan"+id).css('display', 'inline');
	$("#productmanufactureredit"+id).css('display', 'none');
	$("#productmanufacturerupdate"+id).css('display', 'inline');
}
function changemanufacturer(id){
	$("#productmanufacturerval"+id).html($("#manufacturer"+id).val());
	$("#productmanufacturerval"+id).css('display', 'inline-flex');
	$("#manufacturer"+id).css('display', 'none');
	$("#productmanufacturerspan"+id).css('display', 'inline');
	$("#productmanufactureredit"+id).css('display', 'inline');
	$("#productmanufacturerupdate"+id).css('display', 'none');
}
// FOR CATEGORY EDITS

function edithsncode(id){
	$("#producthsncodeval"+id).css('display', 'none');
	$("#producthsn"+id).css('display', 'inline');
	setTimeout(function() {
		$("#producthsn"+id).select();
	},5);
	$("#producthsncodespan"+id).css('display', 'inline');
	$("#producthsncodeedit"+id).css('display', 'none');
	$("#producthsncodeupdate"+id).css('display', 'inline');
}
function changehsncode(id){
	$("#producthsncodeval"+id).html($("#producthsn"+id).val());
	$("#producthsncodeval"+id).css('display', 'inline-flex');
	$("#producthsn"+id).css('display', 'none');
	$("#producthsncodespan"+id).css('display', 'inline');
	$("#producthsncodeedit"+id).css('display', 'inline');
	$("#producthsncodeupdate"+id).css('display', 'none');
}
// FOR HSN EDITS

function editexpdate(id){
	$("#productexpdateval"+id).css('display', 'none');
	$("#expdate"+id).css('display', 'inline');
	setTimeout(function() {
		$("#expdate"+id).select();
		$("#expdate"+id).focus();
	},5);
	$("#productexpdatespan"+id).css('display', 'inline');
	$("#productexpdateedit"+id).css('display', 'none');
	$("#productexpdateupdate"+id).css('display', 'inline');
}
function changeexpdate(id){
	if ($("#expdate"+id).val()!='') {
	<?php
		$dateformats=$con->prepare("SELECT * FROM paricountry");
		$dateformats->execute();
		$dateformat = $dateformats->get_result();
		$datefetch=$dateformat->fetch_array();
		if ($datefetch['date']=='DD/MM/YYYY') {
	?>
		var ymd = ($("#expdate"+id).val()).split('-');
		if ((ymd[2]!=undefined)&&(ymd[1]!=undefined)&&(ymd[0]!=undefined)) {
			var finalDate = ymd[2] + '/' + ymd[1] + '/' + ymd[0];
		}
		$("#productexpdateval"+id).html(finalDate);
	<?php
		}
		$dateformat->close();
		$dateformats->close();
	?>
	}
	else{
		$("#productexpdateval"+id).html('');
	}
	$("#productexpdateval"+id).css('display', 'inline');
	$("#expdate"+id).css('display', 'none');
	$("#productexpdatespan"+id).css('display', 'inline');
	$("#productexpdateedit"+id).css('display', 'inline');
	$("#productexpdateupdate"+id).css('display', 'none');
}
// FOR EXPIRY DATE EDITS

function editmrp(id){
	$("#productmrpval"+id).css('display', 'none');
	$("#mrp"+id).css('display', 'inline');
	setTimeout(function() {
		$("#mrp"+id).select();
	},5);
	$("#productmrpspan"+id).css('display', 'inline-block');
	$("#productmrpedit"+id).css('display', 'none');
	$("#productmrpupdate"+id).css('display', 'inline');
}
function changemrp(id){
	$("#productmrpval"+id).html('<span style="margin-right:-3px !important;"><?=$resmaincurrencyans;?></span>'+$("#mrp"+id).val());
	$("#productmrpval"+id).css('display', 'inline');
	$("#mrp"+id).css('display', 'none');
	$("#productmrpspan"+id).css('display', 'inline-block');
	$("#productmrpedit"+id).css('display', 'inline');
	$("#productmrpupdate"+id).css('display', 'none');
}
// FOR MRP EDITS

function editunit(id){
	$("#productunitval"+id).css('display', 'none');
	$("#productunit"+id).css('display', 'inline');
	setTimeout(function() {
		$("#productunit"+id).select();
	},5);
	$("#productunitspan"+id).css('display', 'inline');
	$("#productunitedit"+id).css('display', 'none');
	$("#productunitupdate"+id).css('display', 'inline');
}
function changeunit(id){
	$("#productunitval"+id).html($("#productunit"+id).val());
	$("#productunitval"+id).css('display', 'inline');
	$("#productunit"+id).css('display', 'none');
	$("#productunitspan"+id).css('display', 'inline');
	$("#productunitedit"+id).css('display', 'inline');
	$("#productunitupdate"+id).css('display', 'none');
}
// FOR UNIT EDITS

function editnoofpacks(id){
	$("#productnoofpacksval"+id).css('display', 'none');
	$("#noofpacks"+id).css('display', 'inline');
	setTimeout(function() {
		$("#noofpacks"+id).select();
	},5);
	$("#productnoofpacksspan"+id).css('display', 'inline');
	$("#productnoofpacksedit"+id).css('display', 'none');
	$("#productnoofpacksupdate"+id).css('display', 'inline');
}
function changenoofpacks(id){
	$("#productnoofpacksval"+id).html($("#noofpacks"+id).val());
	$("#productnoofpacksval"+id).css('display', 'inline');
	$("#noofpacks"+id).css('display', 'none');
	$("#productnoofpacksspan"+id).css('display', 'inline');
	$("#productnoofpacksedit"+id).css('display', 'inline');
	$("#productnoofpacksupdate"+id).css('display', 'none');
}
// FOR NO OF PACKS EDITS

function editprodiscount(id){
	$("#productprodiscountval"+id).css('display', 'none');
	$("#prodiscount"+id).css('display', 'inline');
	setTimeout(function() {
		$("#prodiscount"+id).select();
	},5);
	$("#prodiscounttype"+id).css('display', 'inline');
	$("#discountselect"+id).css('display', 'inline-flex');
	$("#productprodiscountspan"+id).css('display', 'inline-block');
	$("#productprodiscountedit"+id).css('display', 'none');
$	("#productprodiscountupdate"+id).css('display', 'inline');
}
function changeprodiscount(id){
	var quantity = $('#quantity'+id).val();
	if ($('#productrate'+id).val()=='') {
		$('#productrate'+id).val(0);
		var productrate = 0;
	}
	else{
		var productrate = $('#productrate'+id).val();
	}
	if ($('#prodiscount'+id).val()=='') {
		$('#prodiscount'+id).val(0);
		var prodiscount = 0;
	}
	else{
		var prodiscount = $('#prodiscount'+id).val();
	}
	if (quantity=='') {
		quantity = 0;
	}
	if (productrate=='') {
		productrate = 0;
	}
	var productvalue = (parseFloat(quantity)*parseFloat(productrate));
	var discounttype = $("#prodiscounttype"+id).val();
	if (discounttype==0) {
		var discountamounttype=(parseFloat(prodiscount)/100)*parseFloat(productvalue);
		var productdiscount=parseFloat(Math.round((discountamounttype) * 100) / 100).toFixed(2);
	}
	else{
		var discountamounttype=parseFloat(prodiscount);
		var productdiscount=parseFloat(Math.round((discountamounttype) * 100) / 100).toFixed(2);
	}
	$("#productprodiscountval"+id).html(((discounttype=='0')?''+$("#prodiscount"+id).val()+'%':'<span style="color:#cb0c9f !important;margin-right:-3px !important;"><?=$resmaincurrencyans?></span> '+$("#prodiscount"+id).val())+'(<span style="color:green !important;"><span style="color:green !important;margin-right:-3px !important;"><?=$resmaincurrencyans;?></span>'+productvalue+' - '+'<span style="color:green !important;margin-right:-3px !important;"><?=$resmaincurrencyans;?></span>'+(Math.round(productdiscount).toFixed(2))+'</span>)');
	$("#prodisvalueforledger"+id).val((Math.round(productdiscount).toFixed(2)));
	$("#productprodiscountval"+id).css('display', 'inline');
	$("#prodiscount"+id).css('display', 'none');
	$("#prodiscounttype"+id).css('display', 'none');
	$("#discountselect"+id).css('display', 'none');
	$("#productprodiscountspan"+id).css('display', 'inline-block');
	$("#productprodiscountedit"+id).css('display', 'inline');
	$("#productprodiscountupdate"+id).css('display', 'none');
}
// FOR PRODUCT TABLE DISCOUNT EDITS

function editvat(id){
	$("#productvatval"+id).css('display', 'none');
	$("#vat"+id).css('display', 'inline');
	setTimeout(function() {
		$("#vat"+id).select();
	},5);
	$("#productvatspan"+id).css('display', 'inline-block');
	$("#productvatedit"+id).css('display', 'none');
	$("#productvatupdate"+id).css('display', 'inline');
}
function changevat(id){
	$("#productvatval"+id).html($("#vat"+id).val()+'%');
	$("#productvatval"+id).css('display', 'inline');
	$("#vat"+id).css('display', 'none');
	$("#productvatspan"+id).css('display', 'inline-block');
	$("#productvatedit"+id).css('display', 'inline');
	$("#productvatupdate"+id).css('display', 'none');
}
// FOR GST EDITS
$("body").click(function(){
	setTimeout(function() {
		var btndel = document.getElementsByName('productname[]');
		var btndels = document.getElementsByName('product[]');
		if ((btndel.length>1)||(btndel[0].value!='')) {
			for(i=0;i<btndel.length;i++){
				if (btndels[i].value!=0) {
					var ids = btndel[i].id.split('productname');
					var id = ids[1];
					if($("#manufacturer"+id).is(":focus")){}
					else{
						changemanufacturer(id);
					}
					if($("#producthsn"+id).is(":focus")){}
					else{
						changehsncode(id);
					}
					if($("#expdate"+id).is(":focus")){}
					else{
						changeexpdate(id);
					}
					if($("#mrp"+id).is(":focus")){}
					else{
						changemrp(id);
					}
					if($("#productunit"+id).is(":focus")){}
					else{
						changeunit(id);
					}
					if($("#noofpacks"+id).is(":focus")){}
					else{
						changenoofpacks(id);
					}
					if(($("#prodiscount"+id).is(":focus"))||($("#prodiscounttype"+id).is(":focus"))){}
					else{
						changeprodiscount(id);
					}
					if($("#vat"+id).is(":focus")){}
					else{
						changevat(id);
					}
				}
			}
		}
	},15);
});
// FOR AUTOSAVING IN ALL EDITS IN PRODUCT TABLE

function isEmpty(object) {
	for (const property in object) {
		return false;
	}
	return true;
}
function custchval(ids) {
	$('#custaddressdiv').css("display", "none");
	var id= ids.value;
	if(id != ''){
		$("#transactionans").html('');
		$.ajax({
			type: "GET",
			url: 'transactionfetch.php?term=0&types=customer&id='+id+'',
			success: function (result) {
				// console.log(result);
				$("#transactionans").append(result);
			},
			error: function (error) {
				// console.log(error);
			}
		});
		$("#frequentproans").html('');
		$.ajax({
			type: "GET",
			url: 'frequentproductfetch.php?term=0&types=customer&id='+id+'',
			success: function (result) {
				// console.log(result);
				$("#frequentproans").append(result);
			},
			error: function (error) {
				// console.log(error);
			}
		});
		$.get("customersearch1.php", {term: id} , function(data){
			// console.log(data);
			const obj = JSON.parse(data);
			if(isEmpty(obj)==false){
				$('#custaddressdiv').css("display", "flex");
			}
			else{
				$('#custaddressdiv').css("display", "none");
			}
			// console.log(obj[0]);
		<?php
			$sqlismainaccessfieldcusviews=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Customers' ORDER BY id ASC");
			$sqlismainaccessfieldcusviews->bind_param("i", $companymainid);
			$sqlismainaccessfieldcusviews->execute();
			$sqlismainaccessfieldcusview = $sqlismainaccessfieldcusviews->get_result();
			while($infomainaccessfieldcusview=$sqlismainaccessfieldcusview->fetch_array()){
				$coltype = preg_replace('/\s+/', '', $infomainaccessfieldcusview['moduletype']);
				$addcusview = $infomainaccessfieldcusview[21];
				$fieldaddcusview = explode(',',$addcusview);
				$editcusview = $infomainaccessfieldcusview[22];
				$fieldeditcusview = explode(',',$editcusview);
				$viewcusview = $infomainaccessfieldcusview[23];
				$fieldviewcusview = explode(',',$viewcusview);
			}
			$sqlismainaccessfieldcusview->close();
			$sqlismainaccessfieldcusviews->close();
		?>
		<?php
			// if ((in_array('Customer Information', $fieldviewcusview))) {
		?>
			document.getElementById("idforcust").value=obj[0].id;
			document.getElementById("outstandans").innerHTML=obj[0].balanceamount;
		<?php
			if ((in_array('Customer Id', $fieldviewcusview))) {
		?>
			document.getElementById("custviewcode").innerHTML=obj[0].customercode;
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
			document.getElementById("frequentcustname").innerHTML=obj[0].customername;
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
			// }
		?>
		<?php
			if ((in_array('Customers Visibility', $fieldviewcusview))) {
		?>
			(obj[0].cvisiblity=='PUBLIC'?document.getElementById("custviewvisibility").checked=true:			document.getElementById("custviewnovisibility").checked=true);
		<?php
			}
		?>
		<?php
			if ((in_array('Tax Information', $fieldviewcusview))) {
		?>
		<?php
			if ((in_array('Tax Preference', $fieldviewcusview))) {
		?>
			(obj[0].custaxprefer=='0'?document.getElementById("custviewtaxprefer").checked=true:			document.getElementById("custviewtaxpreferno").checked=true);
		<?php
			}
		?>
		<?php
			if ((in_array('GST Registration Type', $fieldviewcusview))) {
		?>
			(obj[0].custaxprefer=='0'?document.getElementById("custviewgstrtypesh").style.display='block':			document.getElementById("custviewgstrtypesh").style.display='none');
			if (obj[0].gstrtype!='') {
			document.getElementById("custviewgstrtype").innerHTML=obj[0].gstrtype;
				if((obj[0].gstrtype=='Registered Business - Regular'||obj[0].gstrtype=='Registered Business - Composition'||obj[0].gstrtype=='Special Economic Zone'||obj[0].gstrtype=='Deemed Export'||obj[0].gstrtype=='Tax Deductor'||obj[0].gstrtype=='SEZ Developer')&&(obj[0].gstrtype!='Unregistered Business'||obj[0].gstrtype!='Consumer'||obj[0].gstrtype!='Overseas')){
				$("#gstinshowhideforcust").show();
		<?php
			if ((in_array('GSTIN OR UIN', $fieldviewcusview))) {
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
				else{
					$("#gstinshowhideforcust").hide();
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
			(obj[0].gstrtype!='Overseas'?document.getElementById("custviewposdiv").style.display='block':			document.getElementById("custviewposdiv").style.display='none');
			if(obj[0].gstrtype!='Overseas'){
				document.getElementById("custviewpos").innerHTML=obj[0].placeos;
			}
		<?php
			}
		?>
		<?php
			}
		?>
		<?php
			if ((in_array('Other Information', $fieldviewcusview))) {
		?>
		<?php
			if ((in_array('DL dot No dot OR 20', $fieldviewcusview))) {
		?>
			document.getElementById("custviewdlt").innerHTML=obj[0].dlno20;
		<?php
			}
		?>
		<?php
			if ((in_array('DL dot No dot OR 21', $fieldviewcusview))) {
		?>
			document.getElementById("custviewdlo").innerHTML=obj[0].dlno21;
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
			$("#dlno20").val(obj[0].dlno20);
			$("#dlno21").val(obj[0].dlno21);
			$("#dlno20modal").val(obj[0].dlno20);
			$("#dlno21modal").val(obj[0].dlno21);
			$("#gstgstrtype").val(obj[0].gstrtype);
			var gstrtypeans = '<option '+((obj[0].gstrtype=='')?'selected':'')+' disabled value="" data-foo="Select Type of Add">Select Type of Add</option><option '+((obj[0].gstrtype=='Registered Business - Regular')?'selected':'')+' data-foo="Business that is registered under GST" value="Registered Business - Regular">Registered Business - Regular</option><option '+((obj[0].gstrtype=='Registered Business - Composition')?'selected':'')+' data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition">Registered Business - Composition</option><option '+((obj[0].gstrtype=='Unregistered Business')?'selected':'')+' data-foo="Business that has not been registered under GST" value="Unregistered Business">Unregistered Business</option><option '+((obj[0].gstrtype=='Consumer')?'selected':'')+' data-foo="A customer who is a regular consumer" value="Consumer">Consumer</option><option '+((obj[0].gstrtype=='Overseas')?'selected':'')+' data-foo="Persons with whom you do import OR export of supplies outside India" value="Overseas">Overseas</option><option '+((obj[0].gstrtype=='Special Economic Zone')?'selected':'')+' data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India OR a SEZ Developer" value="Special Economic Zone">Special Economic Zone</option><option '+((obj[0].gstrtype=='Deemed Export')?'selected':'')+' data-foo="Supply of goods to an Export Oriented Unit OR against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export">Deemed Export</option><option '+((obj[0].gstrtype=='Tax Deductor')?'selected':'')+' data-foo="Departments of the State / Central government, government agencies OR local authorities" value="Tax Deductor">Tax Deductor</option><option '+((obj[0].gstrtype=='SEZ Developer')?'selected':'')+' data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer">SEZ Developer</option>';
			$("#gstgstrtype").html(gstrtypeans);
			showDivcust(obj[0].gstrtype);
			$("#twogsttreatment").val(obj[0].gstrtype);
			$("#twogstin").val(obj[0].gstin);
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
			setTimeout(function() {
				var btndel = document.getElementsByName('productname[]');
				var btndels = document.getElementsByName('product[]');
				if ((btndel.length>1)||(btndel[0].value!='')) {
					for(i=0;i<btndel.length;i++){
						if (btndels[i].value!=0) {
							var ids = btndel[i].id.split('productname');
							var id = ids[1];
							productcalc(id);
						}
					}
				}
				else{
					document.getElementById('totalitems').value=0;
					document.getElementById('totalquantity').value=0;
					document.getElementById('totalamount').value=0;
					document.getElementById('totalvatamount').value=0;
					document.getElementById('roundoff').value=0;
					document.getElementById('grandtotal').value=0;
					document.getElementById('grandtotalfixed').value=0;
				}
			},100);
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
			var ase5=obj[0].dlno20+'';
			ase5=ase5.trim();
			var ase6=obj[0].dlno21+'';
			ase6=ase6.trim();
			if(ase==""){
				$("#billingaddressdiv").html(ase);
				$("#billingaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
			}
			else{
				ase='<div id="firstadd">'+obj[0].address+' '+obj[0].city+'</div> <div id="secadd">'+obj[0].state+' '+obj[0].pin+' '+obj[0].country+'</div>';
				$("#billingaddressdiv").html(ase);
				$("#billingaddressspan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:12px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
			}
			if(ase1==""){
				$("#shippingaddressdiv").html(ase1);
				$("#shippingaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
			}
			else{
				ase1='<div id="firstadd">'+obj[0].saddress+' '+obj[0].scity+'</div> <div id="secadd">'+obj[0].sstate+' '+obj[0].spin+' '+obj[0].scountry+'</div>';
				$("#shippingaddressdiv").html(ase1);
				$("#shippingaddressspan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:12px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
			}
			if(ase2==""){
				$("#gstrtypediv").html(ase2);
				$("#gsttypespan").html('<div style="margin-top:-4.5px !important;"> Add New GSTIN </div>');
			}
			else{
				if(obj[0].gstrtype=="Registered Business - Regular"||obj[0].gstrtype=="Registered Business - Composition"||obj[0].gstrtype=="Special Economic Zone"||obj[0].gstrtype=="Deemed Export"||obj[0].gstrtype=="Tax Deductor"||obj[0].gstrtype=="SEZ Developer"){
					ase2='<div id="gstfirstline">'+obj[0].gstrtype+'</div> <div id="gstsecondline"> GSTIN:'+obj[0].gstin+'</div>';
				}
				else{
					ase2='<div id="gstfirstline">'+obj[0].gstrtype+'</div>';
				}
				$("#gstrtypediv").html(ase2);
				$("#gsttypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
			}
			if(ase3==""){
				$("#workphonediv").html(ase3);
				$("#worktypespan").html('<div style="margin-top:-4.5px !important;"> Add New Phone </div>');
			}
			else{
				ase3='<div id="workphoneline">'+obj[0].workphone+'</div>';
				$("#workphonediv").html(ase3);
				$("#worktypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
			}
			if(ase4==""){
				$("#mobilephonediv").html(ase4);
				$("#mobiletypespan").html('<div style="margin-top:-4.5px !important;"> Add New Phone </div>');
			}
			else{
				ase4='<div id="mobilephoneline">'+obj[0].mobile+'</div>';
				$("#mobilephonediv").html(ase4);
				$("#mobiletypespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
			}
			if(ase5==""){
				$("#dlno20div").html(ase5);
				$("#dlno20typespan").html('<div style="margin-top:-4.5px !important;"> Add New DL No 20 </div>');
			}
			else{
				ase5='<div id="dlno20line">'+obj[0].dlno20+'</div>';
				$("#dlno20div").html(ase5);
				$("#dlno20typespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
			}
			if(ase6==""){
				$("#dlno21div").html(ase6);
				$("#dlno21typespan").html('<div style="margin-top:-4.5px !important;"> Add New DL No 21 </div>');
			}
			else{
				ase6='<div id="dlno21line">'+obj[0].dlno21+'</div>';
				$("#dlno21div").html(ase6);
				$("#dlno21typespan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
			}
		});
	}
	else{
		alert("Please Select <?= $infomainaccessusercus['modulename'] ?>");
		$('#custaddressdiv').css("display", "none");
	}
};
// FOR CUSTOMER VIEW INFORMATIONS OTHER DETAILS

var sIndex = 20, offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
$('.main-content').on('scroll', function() {
	var scrollTop = $(this).scrollTop();
	if ((scrollTop + $(this).innerHeight()>= this.scrollHeight-50)||scrollTop + $(this).innerHeight() <= this.scrollHeight-50) {
		if (isPreviousEventComplete && isDataAvailable) {
			isPreviousEventComplete = false;
			$("#loadimg").css("display","block");
			// console.log('ss');
			// ajax for get
			$.ajax({
				type: "GET",
				url: 'transactionfetch.php?term=' + sIndex + '&types=customer&id='+document.getElementById("idforcust").value+'',
				success: function (result) {
					$("#transactionans").append(result);
					sIndex = sIndex + offSet;
					isPreviousEventComplete = true;
					if (result == '')
						isDataAvailable = false;
					$("#loadimg").css("display","none");
					// console.log(result);
				},
				error: function (error) {
					// console.log(error);
				}
			});
			// it is done
		}
	}
});
// FOR GET TRANSACTION DETAILS OF THE CURRENT SELECTED CUSTOMER
var sIndexpro = 20, offSetpro = 20, isPreviousEventCompletepro = true, isDataAvailablepro = true;
$('.main-content').on('scroll', function() {
	var scrollToppro = $(this).scrollTop();
	if ((scrollToppro + $(this).innerHeight()>= this.scrollHeight-50)||scrollToppro + $(this).innerHeight() <= this.scrollHeight-50) {
		if (isPreviousEventCompletepro && isDataAvailablepro) {
			isPreviousEventCompletepro = false;
			$("#loadimg").css("display","block");
			// console.log('ss');
			// ajax for get
			$.ajax({
				type: "GET",
				url: 'frequentproductfetch.php?term=' + sIndexpro + '&types=customer&id='+document.getElementById("idforcust").value+'',
				success: function (result) {
					$("#frequentproans").append(result);
					sIndexpro = sIndexpro + offSetpro;
					isPreviousEventCompletepro = true;
					if (result == '') //When data is not available
						isDataAvailablepro = false;
					$("#loadimg").css("display","none");
					// console.log(result);
				},
				error: function (error) {
					// console.log(error);
				}
			});
			// it is done
		}
	}
});
// FOR GET THE FREQUENTLY BOUGHTED PRODUCTS INFORMATIONS BY THE SELECTED CUSTOMER

function getmargindetails(linidno) {
	marginproductid = $("#product"+linidno+"").val();
	marginbatchval = $("#batch"+linidno+"").val();
	marginexpval = $("#expdate"+linidno+"").val();
	marginprorate = $("#productrate"+linidno+"").val();
	marginproqty = $("#quantity"+linidno+"").val();
	margindiscountvalue = $("#prodiscount"+linidno+"").val();
	marginprodiscounttype = $("#prodiscounttype"+linidno+"").val();
	$.ajax({
		type: "GET",
		url: 'marginchecking.php?productid='+marginproductid+'&batch='+marginbatchval+'&expiry='+marginexpval+'&prorate='+marginprorate+'&proqty='+marginproqty+'&discountvalue='+margindiscountvalue+'&prodiscounttype='+marginprodiscounttype+'',
		success: function (result) {
			var resultdata = JSON.parse(result);
			// console.log(resultdata.margintotal);
			if (resultdata.margintotal>=0) {
				$("#margintotal"+linidno+"").css("color","green");
			}
			else{
				$("#margintotal"+linidno+"").css("color","red");
			}
			$("#promarginans").html(resultdata.htmlvalues);
			$("#marginproname").html(resultdata.productname);
		},
		error: function (error) {
			// console.log(error);
		}
	});
}
// FOR GET THE MARGIN PROFIT DETAILS OF THE CURRENT SELECTED CUSTOMER

function checkthecode(lineNo) {
	var barcode= $('#barcode'+lineNo).val();
	if(barcode != ''){
		$.get("codeortagssearch.php", {term: barcode} , function(data){
			const obj = JSON.parse(data);
			if(obj[0].productid){
				console.log(obj[0].productid);
				$('#product'+lineNo).append('<option value="' + obj[0].productid + '">' + obj[0].productname + '</option>');
				$('select[id^="product'+lineNo+'"] option[value="' + obj[0].productid + '"]').attr("selected","selected");
				$('#product'+lineNo).val(obj[0].productid).change();
			}
			else{
				alert("Product Not Found");
				$('#barcode'+lineNo).val('');
				$('#barcode'+lineNo).focus();
			}
		});
	}

}
// FOR CODE TAGS

function productchange(lineNo){
	var id= $('#product'+lineNo).val();
	if(id != ''){
		$.get("prosearch1.php", {term: id} , function(data){
			// console.log(data);
			const obj = JSON.parse(data);
			// console.log(obj[0]);
			if (proalreadychnxtlvl==0) {
				$("#productid"+lineNo).val(obj[0].id);
				$("#productname"+lineNo).val(obj[0].productname);
				$("#productnotes"+lineNo).val(obj[0].description);
				$("#productdescription"+lineNo).val(obj[0].description);
				$("#productdescription"+lineNo).css('display', 'inline');
				$("#productdescriptionspan"+lineNo).css('display', 'block');
				$("#rackval"+lineNo).html(obj[0].rack);
				$("#rackval"+lineNo).css('display', 'inline-flex');
				$("#rack"+lineNo).val(obj[0].rack);
				$("#rackspan"+lineNo).css('display', 'inline');
				$("#itemmodulespan"+lineNo).html(obj[0].itemmodule);
				$("#itemmodule"+lineNo).val(obj[0].itemmodule);
				$("#itemmodulespan"+lineNo).css('display', 'inline-block');
				$("#producthsn"+lineNo).val(obj[0].hsncode);
				$("#vat"+lineNo).val(<?=(in_array('Tax Value', $fieldadd))?'obj[0].tax':'0'?>);
				$("#productrate"+lineNo).val(obj[0].salecost);
				$("#prodiscount"+lineNo).val(obj[0].salediscount);
				$("#prodisvalueforledger"+lineNo).val(obj[0].salediscount);
				$("#margintotal"+lineNo).css('display', 'inline-block');
				$("#productmanufacturerval"+lineNo).html(obj[0].category);
				$("#productmanufacturerval"+lineNo).css('display', 'inline-flex');
				$("#manufacturer"+lineNo).val(obj[0].category);
				$("#manufacturer"+lineNo).css('display', 'none');
				$("#productmanufacturerspan"+lineNo).css('display', 'inline');
				$("#viewbarcode"+lineNo).css('display', 'inline');
				$("#barcodeformat"+lineNo).val(obj[0].barcodeformat);
				$("#barcodetitle"+lineNo).val(obj[0].barcodetitle);
				$("#barcodesubtitle"+lineNo).val(obj[0].barcodesubtitle);
				$("#barcodeval"+lineNo).val(obj[0].barcodeval);
				$("#barcode"+lineNo).val(obj[0].barcodeval);
				$("#underbarcodelabel"+lineNo).val(obj[0].underbarcodelabel);
				$("#footernote"+lineNo).val(obj[0].footernote);
				$("#productmanufactureredit"+lineNo).css('display', 'inline');
				$("#productmanufacturerupdate"+lineNo).css('display', 'none');
				$("#producthsncodeval"+lineNo).html(obj[0].hsncode);
				$("#producthsncodeval"+lineNo).css('display', 'inline-flex');
				$("#producthsn"+lineNo).val(obj[0].hsncode);
				$("#producthsn"+lineNo).css('display', 'none');
				$("#producthsncodespan"+lineNo).css('display', 'inline');
				$("#producthsncodeedit"+lineNo).css('display', 'inline');
				$("#producthsncodeupdate"+lineNo).css('display', 'none');
				$("#batch"+lineNo).val("");
				$("#quantity"+lineNo).val("");
				$("#productexpdateval"+lineNo).html("");
				$("#productexpdateval"+lineNo).css('display', 'inline');
				$("#expdate"+lineNo).val("");
				$("#expdate"+lineNo).css('display', 'none');
				$("#productexpdatespan"+lineNo).css('display', 'inline');
				$("#productexpdateedit"+lineNo).css('display', 'inline');
				$("#productexpdateupdate"+lineNo).css('display', 'none');
				$("#productmrpval"+lineNo).html("<?=$resmaincurrencyans?>"+((obj[0].salemrp!='')?obj[0].salemrp:'0.00')+"");
				$("#productmrpval"+lineNo).css('display', 'inline');
				$("#mrp"+lineNo).val(((obj[0].salemrp!='')?obj[0].salemrp:'0.00'));
				$("#mrp"+lineNo).css('display', 'none');
				$("#productmrpspan"+lineNo).css('display', 'inline-block');
				$("#productmrpedit"+lineNo).css('display', 'inline');
				$("#productmrpupdate"+lineNo).css('display', 'none');
				$("#productnoofpacksval"+lineNo).html(obj[0].noofpacks);
				$("#productnoofpacksval"+lineNo).css('display', 'inline');
				$("#noofpacks"+lineNo).val(obj[0].noofpacks);
				$("#noofpacks"+lineNo).css('display', 'none');
				$("#productnoofpacksspan"+lineNo).css('display', 'inline');
				$("#productunitspan"+lineNo).css('display', 'inline');
				$("#productunitval"+lineNo).html(obj[0].defaultunit);
				$("#productunit"+lineNo).val(obj[0].defaultunit);
				$("#productunit"+lineNo).css('display', 'none');
				$("#productunitval"+lineNo).css('display', 'inline');
				$("#productnoofpacksedit"+lineNo).css('display', 'inline');
				$("#productunitedit"+lineNo).css('display', 'inline');
				$("#productnoofpacksupdate"+lineNo).css('display', 'none');
				$("#productunitupdate"+lineNo).css('display', 'none');
				$("#productprodiscountval"+lineNo).html(obj[0].salediscount+'%');
				$("#productprodiscountval"+lineNo).css('display', 'inline');
				$("#prodiscount"+lineNo).val(obj[0].salediscount);
				$("#prodisvalueforledger"+lineNo).val(obj[0].salediscount);
				$("#prodiscount"+lineNo).css('display', 'none');
				$("#productprodiscountspan"+lineNo).css('display', 'inline-block');
				$("#productprodiscountedit"+lineNo).css('display', 'inline');
				$("#productprodiscountupdate"+lineNo).css('display', 'none');
				$("#productvatval"+lineNo).html(<?=(in_array('Tax Value', $fieldadd))?'obj[0].tax':'0'?>+'%');
				$("#productvatval"+lineNo).css('display', 'inline');
				$("#vat"+lineNo).val(<?=(in_array('Tax Value', $fieldadd))?'obj[0].tax':'0'?>);
				$("#vat"+lineNo).css('display', 'none');
				$("#productvatspan"+lineNo).css('display', 'inline-block');
				$("#productvatedit"+lineNo).css('display', 'inline');
				$("#productvatupdate"+lineNo).css('display', 'none');
				invgetfun(lineNo,1);
				$("#productrate"+lineNo).attr("required","required");
				$("#quantity"+lineNo).attr("required","required");
				<?php
					if($access['invbatexprequired']=='Yes'){
				?>
				if(obj[0].itemmodule=='Products'){
					$("#batch"+lineNo).attr("required","required");
					$("#expdate"+lineNo).attr("required","required");
				}
				else{
					$("#batch"+lineNo).removeAttr("required");
					$("#expdate"+lineNo).removeAttr("required");
				}
				<?php
					}
					if($access['invbatchdef']=='availdrop'){
				?>
				$("#batch"+lineNo).attr("readonly","readonly");
				$("#expdate"+lineNo).attr("readonly","readonly");
				<?php
					}
				?>
			}
			else{
				$('#product'+lineNo).parents("tr").remove();
				setTimeout(function() {
					var btndel = document.getElementsByName('productname[]');
					var btndels = document.getElementsByName('product[]');
					if ((btndel.length>1)||(btndel[0].value!='')) {
						for(i=0;i<btndel.length;i++){
							if (btndels[i].value!=0) {
								var ids = btndel[i].id.split('productname');
								var id = ids[1];
								productcalc(id);
							}
						}
					}
					else{
						document.getElementById('totalitems').value=0;
						document.getElementById('totalquantity').value=0;
						document.getElementById('totalamount').value=0;
						document.getElementById('totalvatamount').value=0;
						document.getElementById('roundoff').value=0;
						document.getElementById('grandtotal').value=0;
						document.getElementById('grandtotalfixed').value=0;
					}
				},100);
			}
		});
	}
}
// FOR GET THE PRODUCT INFORMATIONS

function productcalc(id){
	var quantity = $('#quantity'+id).val();
	if ($('#productrate'+id).val()=='') {
		$('#productrate'+id).val(0);
		var productrate = 0;
	}
	else{
		var productrate = $('#productrate'+id).val();
	}
	if ($('#prodiscount'+id).val()=='') {
		$('#prodiscount'+id).val(0);
		var prodiscount = 0;
	}
	else{
		var prodiscount = $('#prodiscount'+id).val();
	}
	if (productrate=='') {
		productrate = 0;
	}
	if (quantity=='') {
		quantity = 0;
	}
	if (prodiscount=='') {
		prodiscount = 0;
	}
	marginproductid = $("#product"+id+"").val();
	marginbatchval = $("#batch"+id+"").val();
	marginexpval = $("#expdate"+id+"").val();
	marginprorate = $("#productrate"+id+"").val();
	marginproqty = $("#quantity"+id+"").val();
	margindiscountvalue = $("#prodiscount"+id+"").val();
	marginprodiscounttype = $("#prodiscounttype"+id+"").val();
	$.ajax({
		type: "GET",
		url: 'marginchecking.php?productid='+marginproductid+'&batch='+marginbatchval+'&expiry='+marginexpval+'&prorate='+marginprorate+'&proqty='+marginproqty+'&discountvalue='+margindiscountvalue+'&prodiscounttype='+marginprodiscounttype+'',
		success: function (result) {
			var resultdata = JSON.parse(result);
			// console.log(resultdata.margintotal);
			if (resultdata.margintotal>=0) {
				$("#margintotal"+id+"").css("color","green");
			}
			else{
				$("#margintotal"+id+"").css("color","red");
			}
			$("#formarginupdates"+id+"").val(resultdata.formarginupdates);
			$("#totalmarginvalue"+id+"").html(resultdata.margintotal);
			$("#margintotalvalue"+id+"").val(resultdata.margintotal);
		},
		error: function (error) {
			// console.log(error);
		}
	});
	var productvalue = (parseFloat(quantity)*parseFloat(productrate));
	var discounttype = $("#prodiscounttype"+id).val();
	if (discounttype==0) {
		var discountamounttype=(parseFloat(prodiscount)/100)*parseFloat(productvalue);
		var productdiscount=parseFloat(Math.round((discountamounttype) * 100) / 100).toFixed(2);
	}
	else{
		var discountamounttype=parseFloat(prodiscount);
		var productdiscount=parseFloat(Math.round((discountamounttype) * 100) / 100).toFixed(2);
	}
	productvalue=productvalue-parseFloat(productdiscount);
	$('#productvalue'+id).val(parseFloat(Math.round(productvalue * 100) / 100).toFixed(2));
	$('#productvalue'+id).tooltip('hide').attr('data-original-title', parseFloat(Math.round(productvalue * 100) / 100).toFixed(2)).tooltip('show');
	var x = document.getElementById("purchasetable").rows.length;
	x--;
	var totalvat=0;
	var totalproductval=0;
	var totalproductdiscountval=0;
	var productnames = document.getElementsByName('productname[]');
	var vats = document.getElementById('vat'+id);
	var productvalues = document.getElementById('productvalue'+id);
	var quantitys = document.getElementsByName('quantity[]');
	var totquan=0;
	var totitem=0;
	var vat = parseFloat(vats.value);
	var productvalue = parseFloat((productvalues.value!='')?productvalues.value:0);
	var productvat=(productvalue*(1+(vat/100)));
	var taxval=parseFloat(productvat)-parseFloat(productvalue);
	if(!isNaN(vat)){
		var pos=$('#propos').val();
		var franpos="<?=$franpos?>";
		if(pos==""){
			pos="TAMIL NADU (33)";
		}
		if(franpos==""){
			franpos="TAMIL NADU (33)";
		}
		if(pos!=franpos){
			$('#productcgstvatspan'+id).css("display", "none");
			$('#productcgstvatval'+id).css("display", "none");
			$('#productsgstvatspan'+id).css("display", "none");
			$('#productsgstvatval'+id).css("display", "none");
			$('#productigstvatspan'+id).css("display", "inline");
			$('#productigstvatval'+id).css("display", "inline");
			$('#productigstvatspan'+id).html("IGST: ");
			$('#productigstvatval'+id).html(""+(parseFloat(vat)+'%')+" ("+'<span style="margin-right:-3px !important;"><?=$resmaincurrencyans;?></span>'+(parseFloat(Math.round((taxval) * 100) / 100).toFixed(2))+")");
			$("#ansforsepgstval").val("IGST "+(parseFloat(vat)+'%')+"( ? "+(parseFloat(Math.round((taxval) * 100) / 100).toFixed(2))+")");
		}
		else{
			$('#productcgstvatspan'+id).css("display", "inline");
			$('#productcgstvatval'+id).css("display", "inline");
			$('#productsgstvatspan'+id).css("display", "inline");
			$('#productsgstvatval'+id).css("display", "inline");
			$('#productigstvatspan'+id).css("display", "none");
			$('#productigstvatval'+id).css("display", "none");
			$('#productcgstvatspan'+id).html("CGST: ");
			$('#productsgstvatspan'+id).html("<br>SGST: ");
			$('#productcgstvatval'+id).html(""+(parseFloat(vat)/2+'%')+" ("+'<span style="margin-right:-3px !important;"><?=$resmaincurrencyans;?></span>'+(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2))+")");
			$('#productsgstvatval'+id).html(""+(parseFloat(vat)/2+'%')+" ("+'<span style="margin-right:-3px !important;"><?=$resmaincurrencyans;?></span>'+(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2))+")");
			$("#ansforsepgstval").val("CGST "+(parseFloat(vat)/2+'%')+"( ? "+(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2))+") , SGST "+(parseFloat(vat)/2+'%')+"( ? "+(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2))+")");
		}
		$('#taxvalue'+id).val(parseFloat(Math.round((taxval) * 100) / 100).toFixed(2));
		$('#cgstvat'+id).val(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2));
		$('#sgstvat'+id).val(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2));
		$('#productnetvalue'+id).val(parseFloat(Math.round(productvat * 100) / 100).toFixed(2));
	}
	var vatss = document.getElementsByName('vat[]');
	var productvaluess = document.getElementsByName('productvalue[]');
	for (var i = 0; i < productnames.length; i++){
		var vat = parseFloat(vatss[i].value);
		if(!isNaN(vat)){
			var productvalue = parseFloat((productvaluess[i].value!='')?productvaluess[i].value:0);
			var productvat=(productvalue*(1+(vat/100)));
			var taxval=parseFloat(productvat)-parseFloat(productvalue);
			totalproductval+=productvalue;
			totalproductdiscountval+=productdiscount;
			totalvat+=productvat;
			totitem++;
			totquan+=parseFloat((quantitys[i].value!='')?quantitys[i].value:0);
		}
	}
	document.getElementById('totalitems').value=totitem;
	document.getElementById('totalquantity').value=totquan;
	discount1();
	gstcalc(id);
	totalvat=totalvat-totalproductval;
	document.getElementById('totalamount').value=parseFloat(Math.round(totalproductval * 100) / 100).toFixed(2);
	$('#totalamount').tooltip('hide').attr('data-original-title', parseFloat(Math.round(totalproductval * 100) / 100).toFixed(2)).tooltip('show');
	document.getElementById('totalvatamount').value=parseFloat(Math.round(totalvat * 100) / 100).toFixed(2);
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
	document.getElementById('grandtotalfixed').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
	RsPaise(parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2));
	$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
	var btndel = document.getElementsByName('productname[]');
	var btndels = document.getElementsByName('product[]');
	var ide = 0;
	for(i=0;i<btndel.length;i++){
		if (btndels[i].value!=0) {
			var ids = btndel[i].id.split('productname');
			ide = parseInt(ids[1])+1;
		}
	}
	addnewrow(ide);
}
// FOR PRODUCT CALCULATIONS
function productcalc1(){
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
	document.getElementById('grandtotalfixed').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
	$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
}
// FOR ANOTHER PRODUCT CALCULATIONS IN THE FILE
setTimeout(function() {
	var pos=$('#propos').val();
	var franpos="<?=$franpos?>";
	if(pos==""){
		pos="TAMIL NADU (33)";
	}
	if(franpos==""){
		franpos="TAMIL NADU (33)";
	}
	if(pos!=franpos){
		$("#cgsthead").hide();
		$("#sgsthead").hide();
		$("#cgstpercent").hide();
		$("#cgstruppee").hide();
		$("#sgstpercent").hide();
		$("#sgstruppee").hide();
		$("#igsthead").show();
		$("#igstpercent").show();
		$("#igstruppee").show();
		$(".cgstinp").hide();
		$(".sgstinp").hide();
		$(".igstinp").show();
	}
	else{
		$("#igsthead").hide();
		$("#igstpercent").hide();
		$("#igstruppee").hide();
		$("#cgsthead").show();
		$("#sgsthead").show();
		$("#cgstpercent").show();
		$("#cgstruppee").show();
		$("#sgstpercent").show();
		$("#sgstruppee").show();
		$(".igstinp").hide();
		$(".cgstinp").show();
		$(".sgstinp").show();
	}
},1000);
// FOR GST INTRA OR INTER CHECKING
function gstcalc(id){
	var pos=$('#propos').val();
	var franpos="<?=$franpos?>";
	if(pos==""){
		pos="TAMIL NADU (33)";
	}
	if(franpos==""){
		franpos="TAMIL NADU (33)";
	}
	if(pos!=franpos){
		$("#cgsthead").hide();
		$("#sgsthead").hide();
		$("#cgstpercent").hide();
		$("#cgstruppee").hide();
		$("#sgstpercent").hide();
		$("#sgstruppee").hide();
		$("#igsthead").show();
		$("#igstpercent").show();
		$("#igstruppee").show();
		$(".cgstinp").hide();
		$(".sgstinp").hide();
		$(".igstinp").show();
	}
	else{
		$("#igsthead").hide();
		$("#igstpercent").hide();
		$("#igstruppee").hide();
		$("#cgsthead").show();
		$("#sgsthead").show();
		$("#cgstpercent").show();
		$("#cgstruppee").show();
		$("#sgstpercent").show();
		$("#sgstruppee").show();
		$(".igstinp").hide();
		$(".cgstinp").show();
		$(".sgstinp").show();
	}
	var oldproductnames = document.getElementsByName('productname[]');
	var oldvat = document.getElementsByName('vat[]');
	var oldproductvalue = document.getElementsByName('productvalue[]');
	var oldtaxvalue = document.getElementsByName('taxvalue[]');
	var nowvat = document.getElementById("vat"+id).value;
	var nowproval = document.getElementById("productvalue"+id).value;
	var nowvatval = document.getElementById("taxvalue"+id).value;
	var nextvat = 0;
	var updtax = 0;
	var updcgst = 0;
	var updsgst = 0;
	var updgst = 0;
	var checknewid = '';
	var checknewtax = 0;
	var checknewcgst = 0;
	var checknewsgst = 0;
	var checknewigst = 0;
	var checknewgst = 0;
	var checknewcheck = 0;
	var totalvatans = 0;
	for (var i = 0; i < oldproductnames.length; i++){
		var gottedvatid = 'id="cgst'+nowvat+'"';
		var gottedvat = 'cgst'+oldvat[i].value+'';
		var gottedvats = oldvat[i].value;
		if (oldproductnames[i].value!='') {
			var fully = document.getElementById("gstautotable").innerHTML;
			if ((fully.includes(gottedvatid))) {}
			else{
				$("#tgstamount").parent().remove();
				$("#gstautotable").append('<tr><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" data-label="TAXABLE VALUE"><input type="hidden" value="'+(oldvat[i].value)+'" id="gstpercent'+nowvat+'" name="gstpercent[]"><input type="hidden" value="'+(oldvat[i].value/2)+'" id="csgstpercent'+nowvat+'" name="csgstpercent[]"><input value="'+oldproductvalue[i].value+'" type="text" name="tax[]" id="tax'+nowvat+'" class="form-control form-control-sm bordernoneinput taxabledesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="CGST %" class="cgstinp" id="cgstinner'+nowvat+'">'+(oldvat[i].value/2)+'%</td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="CGST" class="cgstinp"><div><?= $resmaincurrencyans; ?> <input value="'+(oldtaxvalue[i].value/2).toFixed(2)+'" type="text" name="cgst[]" id="cgst'+nowvat+'" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></div></td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="SGST %" class="sgstinp" id="sgstinner'+nowvat+'">'+(oldvat[i].value/2)+'%</td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="SGST" class="sgstinp"><div><?= $resmaincurrencyans; ?> <input value="'+(oldtaxvalue[i].value/2).toFixed(2)+'" type="text" name="sgst[]" id="sgst'+nowvat+'" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></div></td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="IGST %" class="igstinp" colspan="2" id="igstinner'+nowvat+'">'+(oldvat[i].value)+'%</td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="IGST" class="igstinp" colspan="2"><div><?= $resmaincurrencyans; ?> <input value="'+oldtaxvalue[i].value+'" type="text" name="igst[]" id="igst'+nowvat+'" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></div></td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="GST %" class="gstforauto" id="gstinner'+nowvat+'">'+oldvat[i].value+'%</td> <td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;white-space: nowrap;border-left: 1px dashed #999;" data-label="GST"><input value="'+oldtaxvalue[i].value+'" type="text" name="gst[]" id="gst'+nowvat+'"  class="form-control form-control-sm totaldesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></td></tr><tr><td colspan="6" style="text-align:right;width: 92.3px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" id="tgstamount">Total GST Amount&nbsp;</td> <td id="tgstinp" style="padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;font-weight:bold;"><div><?= $resmaincurrencyans; ?><input value="'+totalvatans.toFixed(2)+'" type="text" name="totalvatamount1" id="totalvatamount1"  class="form-control form-control-sm totaldesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;font-weight:bold;"></div></td></tr>');
				var btndel = document.getElementsByName('productname[]');
				var btndels = document.getElementsByName('product[]');
				if ((btndel.length>1)||(btndel[0].value!='')) {
					for(i=0;i<btndel.length;i++){
						if (btndels[i].value!=0) {
							var ids = btndel[i].id.split('productname');
							var idd = ids[1];
							productcalc(idd);
						}
					}
				}
			}
			var fully = document.getElementById("gstautotable").innerHTML;
			if ((fully.includes(gottedvatid))) {
				if (gottedvats==nowvat) {
					checknewid += ','+nowvat;
					checknewtax += parseFloat(oldproductvalue[i].value);
					checknewcgst += parseFloat(Math.round((oldtaxvalue[i].value/2) * 100) / 100);
					checknewsgst += parseFloat(Math.round((oldtaxvalue[i].value/2) * 100) / 100);
					checknewigst += parseFloat(Math.round((oldtaxvalue[i].value) * 100) / 100);
					checknewgst += parseFloat(Math.round((oldtaxvalue[i].value) * 100) / 100);
					checknewcheck++;
				}
			}
		}
	}
	for(n=0;n<checknewcheck;n++){
		$("#cgstinner"+checknewid.split(',')[n+1]+"").html(''+(checknewid.split(',')[n+1]/2)+'%');
		$("#sgstinner"+checknewid.split(',')[n+1]+"").html(''+(checknewid.split(',')[n+1]/2)+'%');
		$("#igstinner"+checknewid.split(',')[n+1]+"").html(''+checknewid.split(',')[n+1]+'%');
		$("#gstinner"+checknewid.split(',')[n+1]+"").html(''+checknewid.split(',')[n+1]+'%');
		$("#gstpercent"+checknewid.split(',')[n+1]+"").val(''+checknewid.split(',')[n+1]+'');
		$("#csgstpercent"+checknewid.split(',')[n+1]+"").val(''+(checknewid.split(',')[n+1]/2)+'');
		$("#tax"+checknewid.split(',')[n+1]+"").val(''+checknewtax.toFixed(2)+'');
		$("#cgst"+checknewid.split(',')[n+1]+"").val(''+checknewcgst.toFixed(2)+'');
		$("#sgst"+checknewid.split(',')[n+1]+"").val(''+checknewsgst.toFixed(2)+'');
		$("#igst"+checknewid.split(',')[n+1]+"").val(''+checknewigst.toFixed(2)+'');
		$("#gst"+checknewid.split(',')[n+1]+"").val(''+checknewgst.toFixed(2)+'');
	}
	var checktaxold = '';
	var checktaxolds = 0;
	for (var i = 0; i < oldproductnames.length; i++){
		if (oldproductnames[i].value!='') {
			totalvatans += parseFloat(oldtaxvalue[i].value);
			checktaxold += ',%'+oldvat[i].value+'%';
			checktaxolds++;
		}
	}
	var checktaxlen = document.getElementsByClassName("gstforauto");
	var checktaxval = '';
	var checktaxvals = 0;
	for (var i = 0; i < checktaxlen.length; i++){
		checktaxval += ',%'+checktaxlen[i].innerHTML.split('%')[0]+'%';
		checktaxvals++;
	}
	var forfinalone = '';
	var forfinallen = 0;
	for(i=0;i<checktaxvals;i++){
		if(checktaxold.includes(checktaxval.split(',')[i+1])){}
		else{
		forfinalone += ','+checktaxval.split(',')[i+1];
		forfinallen++;
		}
	}
	var ansforfin = forfinalone.replace(/%/g,'');
	for(i=0;i<forfinallen;i++){
		var remparfor = $("#tax"+ansforfin.split(',')[i+1]).parent();
		remparfor.parent().remove();
	}
	$("#totalvatamount1").val(totalvatans.toFixed(2));
	var pos=$('#propos').val();
	var franpos="<?=$franpos?>";
	if(pos==""){
		pos="TAMIL NADU (33)";
	}
	if(franpos==""){
		franpos="TAMIL NADU (33)";
	}
	if(pos!=franpos){
		$("#cgsthead").hide();
		$("#sgsthead").hide();
		$("#cgstpercent").hide();
		$("#cgstruppee").hide();
		$("#sgstpercent").hide();
		$("#sgstruppee").hide();
		$("#igsthead").show();
		$("#igstpercent").show();
		$("#igstruppee").show();
		$(".cgstinp").hide();
		$(".sgstinp").hide();
		$(".igstinp").show();
	}
	else{
		$("#igsthead").hide();
		$("#igstpercent").hide();
		$("#igstruppee").hide();
		$("#cgsthead").show();
		$("#sgsthead").show();
		$("#cgstpercent").show();
		$("#cgstruppee").show();
		$("#sgstpercent").show();
		$("#sgstruppee").show();
		$(".igstinp").hide();
		$(".cgstinp").show();
		$(".sgstinp").show();
	}
}
// FOR GST INFORMATIONS
function productcalcround(){
	var grandtotal;
	var totalamount=document.getElementById('totalamount').value;
	var totalvatamount=document.getElementById('totalvatamount').value;
	var freightamount=document.getElementById('freightamount').value;
	var discountamount=document.getElementById('discountamount').value;
	var roundofff=document.getElementById('roundoff').value;
	grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
	grandtotal=grandtotal-parseFloat(discountamount);
	if(parseFloat(roundofff)!=0){
		var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);
		var roundoff=grandtotal1-grandtotal;
		document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
		document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
		document.getElementById('grandtotalfixed').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
		$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
	}
	else{
		document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal * 100) / 100).toFixed(2);
		document.getElementById('grandtotalfixed').value=parseFloat(Math.round(grandtotal * 100) / 100).toFixed(2);
	}
}
// FOR ROUNDING THE PRODUCT RATES
function discount1(){
	if (document.getElementById('discount').value=='') {
		var disper=0;
		document.getElementById('discount').value = 0;
	}
	else{
		var disper=document.getElementById('discount').value;
	}
	var totalamount=document.getElementById('totalamount').value;
	var discounttype=document.getElementById('discounttype').value;
	if((disper!='')&&(disper!='0')){
		if(discounttype=="0"){
		var discountamount=(parseFloat(disper)/100)*parseFloat(totalamount);
		document.getElementById('discountamount').value=parseFloat(Math.round((discountamount) * 100) / 100).toFixed(2);
		productcalc1();
		}
		else{
			var discountamount=parseFloat(disper);
			document.getElementById('discountamount').value=parseFloat(Math.round((discountamount) * 100) / 100).toFixed(2);
			productcalc1();
		}
	}
}
// FOR DISCOUNT CHANGES

var buttons = document.querySelectorAll('.arlina-button');
Array.prototype.slice.call(buttons).forEach(function(button) {
	var resetTimeout;
	button.addEventListener('click', function() {
		if (typeof button.getAttribute('data-loading') === 'string') {
			button.removeAttribute('data-loading');
		}
		else {
			button.setAttribute('data-loading', '');
		}
		clearTimeout(resetTimeout);
		resetTimeout = setTimeout(function() {
			button.removeAttribute('data-loading');
		}, 1000);
	}, false);
});

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
// FOR THE SAVE BUTTON SPINNER

function funadddue() {
	var missingduename = document.getElementById('missingduename');
	var missingduedate = document.getElementById('missingduedate');
	if (missingduename.value == ''||missingduedate.value == '') {
		alert('Please Enter New Due Name And Due Date');
		missingduename.focus();
		return false;
	}
	else {
		$('#duedateselects').append('<option value="' + missingduename.value + '">' + missingduename.value + '-' + missingduedate.value + '</option>');
		$('select[name^="duedateselects"] option[value="' + missingduename.value + '"]').attr("selected","selected");
		$('#duedateselects').val(missingduename.value).change();
		$('#AddNewDue').modal('hide');
		return false;
	}
}
function funesdue() {
	$('#AddNewDue').modal('hide');
	return false;
}

$("#duedateselects").on("select2:open", function() {
	$("#configureunits").attr("data-bs-target","#AddNewDue");
});
$("#duedateselects").on("select2:open", function() {
	document.getElementById("configureunits").innerHTML = "+ New";
});
// FOR NEW DUE DATE AND THE SELECT

function taxable() {
	document.getElementById('protaxablediv').style.display = "block";
	document.getElementById('pronontaxablediv').style.display = "none";
}
function nontaxable() {
	document.getElementById('protaxablediv').style.display = "none";
	document.getElementById('pronontaxablediv').style.display = "block";
}
// FOR TAX INFORMATION IN PRODUCT ADD MODAL

function profunadddefaultunit() {
	var promissingdefaultunit = document.getElementById('promissingdefaultunit');
	var prouqc = document.getElementById('prouqc');
	if (promissingdefaultunit.value == ''||prouqc.value == '') {
		alert('Please Enter New Default Unit Name And Uqc');
		promissingdefaultunit.focus();
		return false;
	}
	else {
		$('#prodefaultunit').append('<option value="' + promissingdefaultunit.value + ',' + prouqc.value + '">' + promissingdefaultunit.value + '-' + prouqc.value + '</option>');
		$('select[name^="prodefaultunit"] option[value="' + promissingdefaultunit.value + ',' + prouqc.value + '"]').attr("selected","selected");
		$('#prodefaultunit').val(promissingdefaultunit.value).change();
		$('#proAddNewDefaultUnit').modal('hide');
		return false;
	}
}
function profunesdefaultunit() {
	$('#proAddNewDefaultUnit').modal('hide');
	return false;
}
// FOR PRODUCT ADD NEW UNIT MODAL

function profunaddcategory() {
	var promissingcategory = document.getElementById('promissingcategory');
	if (promissingcategory.value == '') {
		alert('Please Enter New <?=$access['txtnamecategory']?> Name');
		promissingcategory.focus();
		return false;
	}
	else {
		$('#procategory').append('<option value="' + promissingcategory.value + '">' + promissingcategory.value + '</option>');
		$('#procategory').val(promissingcategory.value).change();
		$('#proAddNewCategory').modal('hide');
		return false;
	}
}
function profunescategory() {
	$('#proAddNewCategory').modal('hide');
	return false;
}
// FOR PRODUCT ADD NEW CATEGORY MODAL

function profunaddsubcategory() {
	var promissingsubcategory = document.getElementById('promissingsubcategory');
	if (promissingsubcategory.value == '') {
		alert('Please Enter New Sub Category Name');
		promissingsubcategory.focus();
		return false;
	}
	else {
		$('#prosubcategory').append('<option value="' + promissingsubcategory.value + '">' + promissingsubcategory.value + '</option>');
		$('#prosubcategory').val(promissingsubcategory.value).change();
		$('#proAddNewSubCategory').modal('hide');
		return false;
	}
}
function profunessubcategory() {
	$('#proAddNewSubCategory').modal('hide');
	return false;
}
// FOR PRODUCT ADD NEW SUBCATEGORY MODAL

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
$("#procategory").on("select2:open", function() { 
	document.getElementById("configureunits").innerHTML = "New <?=$access['txtnamecategory']?>";
});
$("#prodefaultunit").on("select2:open", function() {
	$("#configureunits").attr("data-bs-target","#proAddNewDefaultUnit");
});
$("#prodefaultunit").on("select2:open", function() {
	document.getElementById("configureunits").innerHTML = "New Unit";
});
// FOR SELECT NEW AND THAT PATHS WHERE THE ACTION WILL MOVE

function funaddproduct() {
	var missingproduct = document.getElementById('proproductname');
	var prodefaultunit = document.getElementById("prodefaultunit");
	var prodefaultunitans = prodefaultunit.options[prodefaultunit.selectedIndex].text;
	if (missingproduct.value == ''||prodefaultunitans=="Unit") {
		if (missingproduct.value == '') {
			missingproduct.focus();
		}
		else if (prodefaultunitans=="Unit") {
			prodefaultunit.focus();
		}
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
// FOR NEW PRODUCT
</script>
<!--term start-->
<div class="modal fade" id="AddNewInvoiceTerm" tabindex="-1" role="dialog" style="z-index: 1051;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					New <?= $infomainaccessuser['modulename'] ?> Term
				</h5>
				<span type="button" onclick="funesinvoiceterm()" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" id="closeicon">&times;</span>
				</span>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="form-group row">
								<div class="col-sm-6">
									<label for="missinginvoiceterm" class="custom-label">
										<span class="text-danger">
											<?= $infomainaccessuser['modulename'] ?> Term *
										</span>
									</label>
								</div>
								<div class="col-sm-6">
									<input type="text" name="invoiceterm" class="form-control form-control-sm mb-4" id="missinginvoiceterm" placeholder="Name" required>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer " style="margin-top: 10px !important;">
				<div class="col">
					<button onclick="funaddinvoiceterm()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit" name="submitinvoiceterm" value="Submit">
						<span class="label">
							Save
						</span>
						<span class="spinner">
						</span>
					</button>
					<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funesinvoiceterm()">
						Cancel
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function funaddinvoiceterm() {
	var missinginvoiceterm = document.getElementById('missinginvoiceterm');
	if (missinginvoiceterm.value == '') {
		alert('Please Enter New <?= $infomainaccessuser['modulename'] ?> Term Name');
		missinginvoiceterm.focus();
		return false;
	}
	else {
		$.ajax({
			type: "POST",
			url: "termadds.php",
			data: {
				term: $("#missinginvoiceterm").val(),
				submit: "Submit"
			},
			success:function(result){
				const resarray = result.split("|");
				alert(resarray[0]);
				if(resarray[1]=='0'){}
				else{
					$('#invoiceterm').append('<option value="' + missinginvoiceterm.value + '">' + missinginvoiceterm.value + '</option>');
					$('#invoiceterm').val(missinginvoiceterm.value).change();
					$("#invoiceterm").select2();
					$('#AddNewInvoiceTerm').modal('hide');
					return false;
				}
			}
		});
	}
}
function funesinvoiceterm() {
	$("#invoiceterm").select2();
	$('#AddNewInvoiceTerm').modal('hide');
	return false;
}
$("#saleperson").on("select2:open", function() {
	$("#configureunits").attr("data-bs-target","#AddNewSaleperson");
});
$("#saleperson").on("select2:open", function() {
	document.getElementById("configureunits").innerHTML = "New Sale Person";
});
$("#invoiceterm").on("select2:open", function() {
	$("#configureunits").attr("data-bs-target","#AddNewInvoiceTerm");
});
$("#invoiceterm").on("select2:open", function() {
	document.getElementById("configureunits").innerHTML = "New <?= $infomainaccessuser['modulename'] ?> Term";
});
</script>
<!-- FOR NEW TERMS -->
<div class="modal fade" id="AddNewSaleperson" tabindex="-1" role="dialog" style="z-index: 1051;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					New Sale Person
				</h5>
				<span type="button" onclick="funessaleperson()" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" id="closeicon">&times;</span>
				</span>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="form-group row">
								<div class="col-sm-5">
									<label for="missingsaleperson" class="custom-label">
										<span class="text-danger">
											Sale Person *
										</span>
									</label>
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
					<button onclick="funaddsaleperson()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit" name="submitsaleperson" value="Submit">
						<span class="label">
							Save
						</span>
						<span class="spinner">
						</span>
					</button>
					<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funessaleperson()">
						Cancel
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function funaddsaleperson() {
	var missingsaleperson = document.getElementById('missingsaleperson');
	if (missingsaleperson.value == '') {
		alert('Please Enter New Sale Person Name');
		missingsaleperson.focus();
		return false;
	}
	else {
		$.ajax({
			type: "POST",
			url: "salepersonadds.php",
			data: {
				saleperson: $("#missingsaleperson").val(),
				submit: "Submit"
			},
			success:function(result){
				const resarray = result.split("|");
				alert(resarray[0]);
				if(resarray[1]=='0'){}
				else{
					$('#saleperson').append('<option value="' + missingsaleperson.value + '">' + missingsaleperson.value + '</option>');
					$('#saleperson').val(missingsaleperson.value).change();
					$("#saleperson").select2();
					$('#AddNewSaleperson').modal('hide');
					return false;
				}
			}
		});
	}
}
function funessaleperson() {
	$("#saleperson").select2();
	$('#AddNewSaleperson').modal('hide');
	return false;
}
</script>
<!-- FOR NEW SALEPERSONS -->
<!--term end-->
<!--duedates start-->
<div class="modal fade" id="AddNewDueDate" tabindex="-1" role="dialog" style="z-index: 1051;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					New Due Date
				</h5>
				<span type="button" onclick="funesduedates()" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" id="closeicon">&times;</span>
				</span>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="form-group row">
								<div class="col-sm-5">
									<label for="missingduedates" class="custom-label">
										<span class="text-danger">
											Name *
										</span>
									</label>
								</div>
								<div class="col-sm-7">
									<input type="text" name="duedates" maxlength="100" class="form-control form-control-sm mb-1" id="missingduedates" placeholder="Name" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="form-group row">
								<div class="col-sm-5">
									<label for="missingnoofdays" class="custom-label">
										<span class="text-danger">
											No of Dates *
										</span>
									</label>
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
					<button onclick="funaddduedates()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit" name="submitduedates" value="Submit">
						<span class="label">
							Save
						</span>
						<span class="spinner">
						</span>
					</button>
					<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funesduedates()">
						Cancel
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function funaddduedates() {
	var missingduedates = document.getElementById('missingduedates');
	var missingnoofdays = document.getElementById('missingnoofdays');
	if (missingduedates.value == '') {
		alert('Please Enter New DueDate Name');
		missingduedates.focus();
		return false;
	}
	else if (missingnoofdays.value == '') {
		alert('Please Enter New DueDate No of Days');
		missingnoofdays.focus();
		return false;
	}
	else {
		$.ajax({
			type: "POST",
			url: "duedateadds.php",
			data: {
				duedate: $("#missingduedates").val(),
				noofdays: $("#missingnoofdays").val(),
				submit: "Submit"
			},
			success:function(result){
				const resarray = result.split("|");
				alert(resarray[0]);
				if(resarray[1]=='0'){}
				else{
					$('#duedates').append('<option value="' + missingnoofdays.value + ',' + missingduedates.value + '">' + missingduedates.value + '</option>');
					$('#duedates').val(missingnoofdays.value+','+missingduedates.value).change();
					$("#duedates").select2();
					$('#AddNewDueDate').modal('hide');
					return false;
				}
			}
		});
	}
}
function funesduedates() {
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
// FOR NEW DUEDATE
// duedates end
// invoice attach start
$(document).ready(function (){
	$("#fileattach").change(function (){
		if($("#fileattach").get(0).files.length>5){
			alert("Sorry only 5 files allowed");
			$("#fileattach").val("");
			return false;
		}
		else{
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
					}
					else{
						alert("One of the File size is too large.");
						$("#fileattach").val("");
						return false;
					}
				}
				else{
					alert("Choose Any Attachment");
					return false;
				}
			}
		}
	});
});
// FOR FILE ATTACHMENT CHECKING PROCESSES
// invoice attach end
// gst
$("#gstgstrtype").on("select2:open", function() {
	$("#configureunits").hide();
});
// FOR GST TYPE
// payment confirm
var checkalreadyalerted = true;
function triggerpayment(invoiceno,invoicedate,invoiceamount,cancelstatus,whatdonext){
	let allAreFilled = true;
	document.getElementById("invoiceform").querySelectorAll("[required]").forEach(function(i) {
		if (!allAreFilled) return;
		if (i.type === "radio") {
			let radioValueCheck = false;
			document.getElementById("invoiceform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
				if (r.checked) radioValueCheck = true;
			})
			allAreFilled = radioValueCheck;
			return;
		}
		if (!i.value) {
			$('#triggerconfirm-adddelete').modal('hide');
			allAreFilled = false; return; 
		}
	})
	if (!allAreFilled) {
		$('#triggerconfirm-adddelete').modal('hide');
		$("#loadimgbig").css("display","none");
		$(".showhideload").css("display","block");
		$("#ihavediv").css("display","block");
		$("#savecanceldiv").css("display","block");
		if(checkalreadyalerted){
			checkalreadyalerted = true;
			<?php
				if ($access['invautosave']=='1') {
			?>
			autosavefun();
			alert('Fill all the fields for auto save');
			<?php
				}
				else{
			?>
			alert('Fill all the fields');
			<?php
				}
			?>
		}
	}
	else{
		$('#triggerconfirm-adddelete').modal('show');
		$("#loadimgbig").css("display","block");
		$(".showhideload").css("display","none");
		$("#ihavediv").css("display","none");
		$("#savecanceldiv").css("display","none");
	}
	setTimeout(function() {
		var btndel = document.getElementsByName('productname[]');
		var btndels = document.getElementsByName('product[]');
		if ((btndel.length>1)||(btndel[0].value!='')) {
			for(i=0;i<btndel.length;i++){
				if (btndels[i].value!=0) {
					var idds = btndel[i].id.split('productname');
					var idd = idds[1];
					productcalc(idd);
				}
			}
		}
		if (btndel.length==i) {
			accessallow = true;
		}
		else{
			accessallow = false;
		}
		let allAreFilled = true;
		document.getElementById("invoiceform").querySelectorAll("[required]").forEach(function(i) {
			if (!allAreFilled) return;
			if (i.type === "radio") {
				let radioValueCheck = false;
				document.getElementById("invoiceform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
					if (r.checked) radioValueCheck = true;
				})
				allAreFilled = radioValueCheck;
				return;
			}
			if (!i.value) {
				$('#triggerconfirm-adddelete').modal('hide');
				allAreFilled = false; return; 
			}
		})
		if (!allAreFilled) {
			$('#triggerconfirm-adddelete').modal('hide');
			$("#loadimgbig").css("display","none");
			$(".showhideload").css("display","block");
			$("#ihavediv").css("display","block");
			$("#savecanceldiv").css("display","block");
			// alert('Fill all the fields');
		}
		else{
			if(accessallow){
				$("#loadimgbig").css("display","none");
				$(".showhideload").css("display","block");
				$("#ihavediv").css("display","block");
				$("#savecanceldiv").css("display","block");
				$.ajax({
					type: "GET",
					url: 'financialyear.php?types=inv&finyear='+document.getElementById("invoicedate").value.split('-')[0]+'',
					success: function (result) {
						// console.log(result);
						if (result=='exist') {
							alert("This Number Is Already Exist");
						}
					},
					error: function (error) {
						// console.log(error);
					}
				});
				let modaltriggercheck = document.getElementById("triggerconfirm-adddelete");
				if ($('#triggerconfirm-adddelete').modal('show')) {
					$(".finalsubmitrequired").attr("required","required");
				}
				else{
					$(".finalsubmitrequired").removeAttr("required");
				}
				isValidFinal = true;
				checkvalidate();
				$('#validinvoiceno').val($('#invoiceno').val());
				$('#validinvoicedate').val($('#invoicedate').val());
				$('#validinvoiceamount').val($('#grandtotal').val());
				var validinvoiceamount=$("#validinvoiceamount").val();
				var validpaidamount=$("#validpaidamount").val();
				$("#validpaidamount").val(validinvoiceamount);
				<?php
					if($access['definvpay']=='split'){
				?>
				splitchecking();
				<?php
					}
				?>
				if (whatdonext==0) {
					$("#loadimgbig").css("display","block");
					$(".showhideload").css("display","none");
					$("#ihavediv").css("display","none");
					$("#savecanceldiv").css("display","none");
					$("#Submit").attr("disabled","disabled");
				}
				else if(whatdonext==1){
					ihaveblock();
					ihavereceive();
					$("#Submit").removeAttr("disabled");
				}
			}
		}
	},1000);
}
function finalmodalclose() {
	$(".finalsubmitrequired").removeAttr("required");
}
$("body").click(function(){
	$(".finalsubmitrequired").removeAttr("required");
});
var isValidFinal = false;
$("#Submit").on("click",function() {
	// isValidFinal = true;
	// setTimeout(function() {
	// 	$("#Submit").attr("disabled","disabled");
	// },100);
	<?php
		if ($access['invautosave']=='0') {
	?>
	triggerpayment('','','','1','0');
	<?php
		}
	?>
});
$("#trigggerbutton").on("click",function() {
isValidFinal = false;
checkvalidate();
});
function checkvalidate() {
	if (isValidFinal) {
		return true;
	}
	else{
		return false;
	}
}
// FOR FINAL SUBMIT
// payment confirm
// rupees
function Rs(amount){
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
			received_n_array[i] = number.substr(i, 1);
		}
		for (var i = 9 - n_length, j = 0; i < 9; i++, j++){
			n_array[i] = received_n_array[j];
		}
		for (var i = 0, j = 1; i < 9; i++, j++){
			if(i == 0 || i == 2 || i == 4 || i == 7){
				if(n_array[i] == 1){
					n_array[j] = 10 + parseInt(n_array[j]);
					n_array[i] = 0;
				}
			}
		}
		value = '';
		for (var i = 0; i < 9; i++){
			if(i == 0 || i == 2 || i == 4 || i == 7){
				value = n_array[i] * 10;
			}
			else {
				value = n_array[i];}
				if(value != 0){
					words_string += words[value] + ' ';
				}
				if((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)){
					words_string += 'Crores ';
				}
				if((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)){
					words_string += 'Lakhs ';
				}
				if((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)){
					words_string += 'Thousand ';
				}
				if(i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)){
					words_string += 'Hundred and ';
				}
				else if(i == 6 && value != 0){
					words_string += 'Hundred ';
				}
			}
			words_string = words_string.split(' ').join(' ');
		}
		return words_string;
	}
function RsPaise(n){
	nums = n.toString().split('.')
	var whole = Rs(nums[0])
	if(nums[1]==null)nums[1]=0;
	if(nums[1].length == 1 )nums[1]=nums[1]+'0';
	if(nums[1].length> 2){
		nums[1]=nums[1].substring(2,length - 1)
	}
	if(nums.length == 2){
		if(nums[0]<=9){
			nums[0]=nums[0]*10
		}
		else {
			nums[0]=nums[0]
		};
		var fraction = Rs(nums[1])
		if(whole=='' && fraction==''){
			op= 'Zero only';
		}
		if(whole=='' && fraction!=''){
			op= 'paise ' + fraction + ' only';
		}
		if(whole!='' && fraction==''){
			op='Rupees ' + whole + ' only';
		}
		if(whole!='' && fraction!=''){
			op='Rupees ' + whole + 'and paise ' + fraction + ' only';
		}
		amt=n;
		if(amt> 999999999.99){
			op='Oops!!! The amount is too big to convert';
		}
		if(isNaN(amt) == true ){
			op='Error : Amount in number appears to be incorrect. Please Check.';
		}
		document.getElementById('grandwords').innerHTML="<hr><strong>Total In Words:</strong>"+op;
	}
}
RsPaise(0);
// FOR GRAND TOTAL IN WORDS

function invgetfun(lineNo,boolean) {
	$("#invonoff"+lineNo).css("background-color","#1BBC9B");
	$("#invonoff"+lineNo).css("color","#fff");
	$("#billonoff"+lineNo).css("background-color","#fff");
	$("#billonoff"+lineNo).css("color","#000");
	$("#billorinv"+lineNo).val('inv');
	var productid= $('#product'+lineNo).val();
	var customerid = $("#customer").val();
<?php
	if ($access['invratedef']=='avail') {
?>
	var invratedef = 'and quantity>0 ';
<?php
	}
	else{
?>
	var invratedef = '';
<?php
	}
?>
	$.get("ratesearch.php", {term: productid,custid: customerid,ratedef: invratedef,differ: 'inv'} , function(datas){
		// console.log("normal"+datas);
		$("#errrate"+lineNo).val(datas);
		var letters = "<br /><b>Warning</b>:  Undefined variable $ratedatas in";
		brrch = document.getElementById("errrate"+lineNo);
		if (brrch.value.includes(letters)||brrch.value=='') {
			// $("#ratelist"+lineNo).html("");
			// var browsers = document.getElementById("ratelist"+lineNo);
			// browsers.style.display = 'none';
			// browsers.style.backgroundColor = 'transparent';
			// browsers.style.border = 'none';
			$("#ratelist"+lineNo).html('<div style="text-align:center;background-color:white;color:#54575a;font-size:13px;padding:6px;">No results found</div>');
		}
		else{
			const objbatch = JSON.parse(datas);
			let check='';
			for (var key in objbatch) {
  				// console.log("key"+key);
  				check+="<div id='option"+lineNo+objbatch[key].invoiceno+"inv' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' style='border:none;overflow:hidden;white-space:nowrap;' title='<?=strtoupper($infomainaccessuser['modulename'])?>'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='invbilltxt'><?=strtoupper($infomainaccessuser['modulename'])?></span></td><td align='right' id='invno"+objbatch[key].invoiceno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].invoiceno+"'>  "+objbatch[key].invoiceno+" </td><td align='right' id='invdt"+objbatch[key].invoiceno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].invoicedate+"'>"+objbatch[key].invoicedate+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' colspan='2' id='rate"+objbatch[key].productrate+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td><td align='right' id='dis"+objbatch[key].productdiscount+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productdiscount+"'><?=$access['txtprodisinv']?> : "+objbatch[key].productdiscount+" </td></tr></table></div>";
			}
			// console.log(check);
			$("#ratelist"+lineNo).html(check);
			var browsers = document.getElementById("ratelist"+lineNo);
			browsers.style.display = 'none';
			browsers.style.backgroundColor = 'transparent';
			browsers.style.border = 'none';
			if (boolean==0) {
				$("#productrate"+lineNo).focus();
			}
		}
	});
}
// FOR GET OLD RATE OF THE CUSTOMER AND PRODUCT IN INVOICE
function billgetfun(lineNo) {
	$("#invonoff"+lineNo).css("background-color","#fff");
	$("#invonoff"+lineNo).css("color","#000");
	$("#billonoff"+lineNo).css("background-color","#1BBC9B");
	$("#billonoff"+lineNo).css("color","#fff");
	$("#billorinv"+lineNo).val('bill');
	var productid= $('#product'+lineNo).val();
	var customerid = $("#customer").val();
<?php
	if ($access['invratedef']=='avail') {
?>
	var invratedef = 'and quantity>0 ';
<?php
	}
	else{
?>
	var invratedef = '';
<?php
	}
?>
	$.get("ratesearch.php", {term: productid,custid: customerid,ratedef: invratedef,differ: 'bill'} , function(datas){
		// console.log("normal"+datas);
		$("#errrate"+lineNo).val(datas);
		var letters = "<br /><b>Warning</b>:  Undefined variable $ratedatas in";
		brrch = document.getElementById("errrate"+lineNo);
		if (brrch.value.includes(letters)||brrch.value=='') {
			// $("#ratelist"+lineNo).html("");
			// var browsers = document.getElementById("ratelist"+lineNo);
			// browsers.style.display = 'none';
			// browsers.style.backgroundColor = 'transparent';
			// browsers.style.border = 'none';
			$("#ratelist"+lineNo).html('<div style="text-align:center;background-color:white;color:#54575a;font-size:13px;padding:6px;">No results found</div>');
		}
		else{
			const objbatch = JSON.parse(datas);
			let check='';
			for (var key in objbatch) {
  				// console.log("key"+key);
  				check+="<div id='option"+lineNo+objbatch[key].invoiceno+"inv' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' style='border:none;overflow:hidden;white-space:nowrap;' title='<?=strtoupper($infomainaccessuser['modulename'])?>'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='invbilltxt'><?=strtoupper($infomainaccessuserbill['modulename'])?></span></td><td align='right' id='invno"+objbatch[key].invoiceno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].invoiceno+"'>  "+objbatch[key].invoiceno+" </td><td align='right' id='invdt"+objbatch[key].invoiceno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].invoicedate+"'>"+objbatch[key].invoicedate+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' colspan='2' id='rate"+objbatch[key].productrate+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td><td align='right' id='dis"+objbatch[key].productdiscount+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productdiscount+"'><?=$access['txtprodisinv']?> : "+objbatch[key].productdiscount+" </td></tr></table></div>";
			}
			// console.log(check);
			$("#ratelist"+lineNo).html(check);
			var browsers = document.getElementById("ratelist"+lineNo);
			browsers.style.display = 'none';
			browsers.style.backgroundColor = 'transparent';
			browsers.style.border = 'none';
			$("#productrate"+lineNo).focus();
			for(i=0;i<document.getElementsByClassName("invbilltxt").length;i++){
				document.getElementsByClassName("invbilltxt")[i].innerHTML = "<?=strtoupper($infomainaccessuserbill['modulename'])?>";
			}
		}
	});
}
// FOR GET OLD RATE OF THE PRODUCT IN BILLS

var alertsbatchexpiry = true;
function batchget(id){
	if($("#productid"+id).val()==''){
		$("#product"+id).focus();
		alert('Please Select <?=$infomainaccessuserpro['modulename']?>');
	}
	else{
		var browsersrate = document.getElementById("ratelist"+id);
		var browsersinvbill = document.getElementById("invbillgets"+id);
		browsersrate.style.display = 'none';
		browsersinvbill.style.display = 'none';
		var input = document.getElementById("batch"+id);
		var browsers = document.getElementById("outfordone"+id);
		browsers.style.display = 'block';
		var productid= $('#product'+id).val();
		input.onclick = function () {
			browsers.style.display = 'block';
			$("#outfordone"+id).scrollTop( 1 );
			$("#outfordone"+id).on('scroll', function() {
				var scrollTop = $(this).scrollTop();
  				if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
					$("#outfordone"+id).scrollTop( 201.3 );
  				}
  				else if (scrollTop <= 0) {
					$("#outfordone"+id).scrollTop( 1 );
  				}
			});
			$("body").on("click",function() {
				if($("#batch"+id).is(":focus")){
					browsers.style.display = 'block';
					$("#outfordone"+id).scrollTop( 1 );
					$("#outfordone"+id).on('scroll', function() {
						var scrollTop = $(this).scrollTop();
  						if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
							$("#outfordone"+id).scrollTop( 201.3 );
  						}
  						else if (scrollTop <= 0) {
							$("#outfordone"+id).scrollTop( 1 );
  						}
					});
				}
				else{
					browsers.style.display = 'none';
					alertsbatchexpiry = true;
				}
			});
		}
		$('#batch'+id).change(function(){
			var oldproductnames = document.getElementsByName('productname[]');
			var oldbatch = document.getElementsByName('batch[]');
			var oldexp = document.getElementsByName('expdate[]');
			var batexpoldornow = 0;
			for (var i = 0; i < oldproductnames.length; i++){
				if (i+1!=id) {
					if ((oldproductnames[i].value==$('#productname'+id).val())&&(oldbatch[i].value==$('#batch'+id).val())&&(oldexp[i].value==$('#expdate'+id).val())) {
						batexpoldornow++;
					}
				}
			}
			if (batexpoldornow==0) {
				alertsbatchexpiry = true;
			}
			else{
				if (alertsbatchexpiry==true) {
					alert("Already Selected This Batch And Expiry Please Select Another One!");
					$('#batch'+id).focus();
					alertsbatchexpiry=false;
				}
			}
		});
	<?php
		if (($access['invbatchdef']=='avail')||($access['invbatchdef']=='availdrop')) {
	?>
		var invbatchdef = 'and quantity>0 ';
	<?php
		}
		else{
	?>
		var invbatchdef = '';
	<?php
		}
	?>
		$.get("batchsearch.php", {term: productid,batchdef: invbatchdef} , function(datas){
			const objbatch = JSON.parse(datas);
			option='';
			batch='';
			exp='';
			qty='';
			rate='';
			var chnew = 0;
			let check='';
			for (var key in objbatch) {
				chnew++;
				option+='option'+id+chnew+'d'+';';
				batch+='batch'+objbatch[key].batch+';';
				exp+='exp'+objbatch[key].batch+';';
				qty+='qty'+objbatch[key].batch+';';
				rate+='rate'+objbatch[key].batch+';';
				check+="<div id='option"+id+chnew+'d'+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].batch+"'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].quantity+"'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].expdate+"'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
			}
			$("#outfordone"+id).html(check);
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
					var oldproductnames = document.getElementsByName('productname[]');
					var oldbatch = document.getElementsByName('batch[]');
					var oldexp = document.getElementsByName('expdate[]');
					var oldproductrates = document.getElementsByName('productrate[]');
					var batexpoldornow = 0;
					for (var i = 0; i < oldproductnames.length; i++){
						if (i+1!=id) {
							if ((oldproductnames[i].value==$('#productname'+id).val())&&(oldbatch[i].value==batqtyspl[6])&&(oldexp[i].value==expratespl[6].split('/')[2]+'-'+expratespl[6].split('/')[1]+'-'+expratespl[6].split('/')[0])&&(oldproductrates[i].value>0)) {
								batexpoldornow++;
							}
						}
					}
					if (batexpoldornow==0) {
						$('#batch'+id).val(batqtyspl[6]);
						$("#productexpdateval"+id).html(expratespl[6]);
						var ymd = expratespl[6].split('/');
						var finalDate = ymd[2] + '-' + ymd[1] + '-' + ymd[0];
						$("#expdate"+id).val(finalDate);
						$("#productrate"+id).val(expratespl[12]);
						var btndel = document.getElementsByName('productname[]');
						var btndels = document.getElementsByName('product[]');
						if ((btndel.length>1)||(btndel[0].value!='')) {
							for(i=0;i<btndel.length;i++){
								if (btndels[i].value!=0) {
									var idds = btndel[i].id.split('productname');
									var idd = idds[1];
									productcalc(idd);
								}
							}
						}
						else{
							document.getElementById('totalitems').value=0;
							document.getElementById('totalquantity').value=0;
							document.getElementById('totalamount').value=0;
							document.getElementById('totalvatamount').value=0;
							document.getElementById('roundoff').value=0;
							document.getElementById('grandtotal').value=0;
							document.getElementById('grandtotalfixed').value=0;
						}
						$('#quantity'+id).focus();
						alertsbatchexpiry = true;
					}
					else{
						if (alertsbatchexpiry==true) {
							alert("Already Selected This Batch And Expiry Please Select Another One!");
							alertsbatchexpiry=false;
						}
					}
				});
			}
		});
		$('#batch'+id).on("keyup", function() {
			alertsbatchexpiry = true;
			var value = $(this).val().toLowerCase();
			$("#outfordone"+id+" "+"table").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value)> -1);
				if ($(this).text().toLowerCase().indexOf(value)> -1) {
					$(this).parent().css({"display": "block"});
					var browsers = document.getElementById("outfordone"+id);
					browsers.style.display = 'block';
				}
				else{
					$(this).parent().css({"display": "none"});
					var oldproductnames = document.getElementsByName('productname[]');
					var browsers = document.getElementById("outfordone"+id);
					for (var i = 0; i < oldproductnames.length; i++){
						if(document.getElementById("outfordone"+(i+1)).innerHTML!=''){
							var lenofold = document.querySelectorAll("#outfordone"+(i+1)+" table").length;
						}
						else{
							var lenofold = 0;
						}
						if (lenofold==0) {
							browsers.style.display = 'none';
						}
						else{
							browsers.style.display = 'block';
						}
					}
				}
			});
		});
	}
}
// FOR GET THE BATCH INFORMATIONS

function qtych(id){
	if($("#productid"+id).val()==''){
		$("#product"+id).focus();
		alert('Please Select <?=$infomainaccessuserpro['modulename']?>');
	}
	else{
		var browsersrate = document.getElementById("ratelist"+id);
		var browsersinvbill = document.getElementById("invbillgets"+id);
		browsersrate.style.display = 'none';
		browsersinvbill.style.display = 'none';
		var browsersbatexp = document.getElementById("outfordone"+id);
		browsersbatexp.style.display = 'none';
	}
}
// FOR QUANTITY PROCESS

var firstornonerate = true;
var firstornoneidrate = 0;
var firstornoneidcust = 0;
function rateget(id){
	if($("#productid"+id).val()==''){
		$("#product"+id).focus();
		alert('Please Select <?=$infomainaccessuserpro['modulename']?>');
	}
	else{
		if (firstornoneidcust!=$("#customer").val()) {
			firstornoneidcust = $("#customer").val();
			firstornonerate = true;
		}
		if (firstornoneidrate!=id) {
			firstornoneidrate = id;
			firstornonerate = true;
		}
		if (firstornonerate) {
			firstornonerate = false;
			if (document.getElementById("billorinv"+id).value=='inv') {
				invgetfun(id,0);
			}
			else{
				billgetfun(id);
			}
		}
		var browsersbatexp = document.getElementById("outfordone"+id);
		browsersbatexp.style.display = 'none';
		var input = document.getElementById("productrate"+id);
		var browsers = document.getElementById("ratelist"+id);
		var browsersinvbill = document.getElementById("invbillgets"+id);
		browsers.style.display = 'block';
		browsersinvbill.style.display = 'block';
		var productid= $('#product'+id).val();
		var customerid = $("#customer").val();
		input.onclick = function () {
			browsers.style.display = 'block';
			browsersinvbill.style.display = 'block';
			$("#ratelist"+id).scrollTop( 1 );
			$("#ratelist"+id).on('scroll', function() {
				var scrollTop = $(this).scrollTop();
  				if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
					$("#ratelist"+id).scrollTop( 201.3 );
  				}
  				else if (scrollTop <= 0) {
					$("#ratelist"+id).scrollTop( 1 );
  				}
			});
			$("body").on("click",function() {
				if($("#productrate"+id).is(":focus")){
					browsers.style.display = 'block';
					browsersinvbill.style.display = 'block';
					$("#ratelist"+id).scrollTop( 1 );
					$("#ratelist"+id).on('scroll', function() {
						var scrollTop = $(this).scrollTop();
  						if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
							$("#ratelist"+id).scrollTop( 201.3 );
  						}
  						else if (scrollTop <= 0) {
							$("#ratelist"+id).scrollTop( 1 );
  						}
					});
				}
				else{
					browsers.style.display = 'none';
					browsersinvbill.style.display = 'none';
				}
			});
		}
	<?php
		if ($access['invratedef']=='avail') {
	?>
		var invratedef = 'and quantity>0 ';
	<?php
		}
		else{
	?>
		var invratedef = '';
	<?php
		}
	?>
		if (document.getElementById("billorinv"+id).value=='inv') {
			var invorbills = 'inv';
		}
		else{
			var invorbills = 'bill';
		}
		$.get("ratesearch.php", {term: productid,custid: customerid,ratedef: invratedef,differ: invorbills} , function(datas){
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
					var ratesspldis = rates.split(" : ");
					if (ratesspldis[2].split(" </td>")[0].includes('%')) {
						var disamountval = ratesspldis[2].split(" </td>")[0].split('%')[0];
						var distypeval = 0;
						var dishtmlval = ratesspldis[2].split(" </td>")[0].split('%')[0]+'%';
					}
					else{
						var disamountval = ratesspldis[2].split(" </td>")[0].split("</span> ")[1];
						var distypeval = 1;
						var dishtmlval = '<?=$resmaincurrencyans?>'+ratesspldis[2].split(" </td>")[0].split("</span> ")[1];
					}
					$('#prodiscount'+id).val(disamountval);
					$('#prodiscounttype'+id).val(distypeval);
					$('#productprodiscountval'+id).html(dishtmlval);
					$('#productrate'+id).val(ratesspl[7]);
					var btndel = document.getElementsByName('productname[]');
					var btndels = document.getElementsByName('product[]');
					if ((btndel.length>1)||(btndel[0].value!='')) {
						for(i=0;i<btndel.length;i++){
							if (btndels[i].value!=0) {
								var idds = btndel[i].id.split('productname');
								var idd = idds[1];
								productcalc(idd);
							}
						}
					}
					else{
						document.getElementById('totalitems').value=0;
						document.getElementById('totalquantity').value=0;
						document.getElementById('totalamount').value=0;
						document.getElementById('totalvatamount').value=0;
						document.getElementById('roundoff').value=0;
						document.getElementById('grandtotal').value=0;
						document.getElementById('grandtotalfixed').value=0;
					}
					$('#quantity'+id).focus();
				});
			}
		});
		$('#productrate'+id).on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#ratelist"+id+" "+"table").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value)> -1);
				if ($(this).text().toLowerCase().indexOf(value)> -1) {
					$(this).parent().css({"display": "block"});
					var browsers = document.getElementById("ratelist"+id);
					browsers.style.display = 'block';
					browsersinvbill.style.display = 'block';
				}
				else{
					$(this).parent().css({"display": "none"});
					var oldproductnames = document.getElementsByName('productname[]');
					var browsers = document.getElementById("ratelist"+id);
					for (var i = 0; i < oldproductnames.length; i++){
						if(document.getElementById("ratelist"+(i+1)).innerHTML!=''){
							var lenofold = document.querySelectorAll("#ratelist"+(i+1)+" table").length;
						}
						else{
							var lenofold = 0;
						}
						if (lenofold==0) {
							browsers.style.display = 'none';
							browsersinvbill.style.display = 'none';
						}
						else{
							browsers.style.display = 'block';
							browsersinvbill.style.display = 'block';
						}
					}
				}
			});
		});
	}
}
// FOR GET THE OLD RATES

setTimeout(function() {
	$.get("refersearch.php", {term: 'invref'} , function(datas){
		// console.log("Reference"+datas);
		$("#errrefer").val(datas);
		var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
		errcheck = document.getElementById("errrefer");
		if (errcheck.value.includes(letters)) {
			$("#referencedropdown").html("");
			var browsers = document.getElementById("referencedropdown");
			browsers.style.display = 'none';
			browsers.style.backgroundColor = 'transparent';
			browsers.style.border = 'none';
		}
		else{
			const objrefer = JSON.parse(datas);
			let check='';
			for (var key in objrefer) {
  				// console.log("key"+key);
  				check+="<div id='referdivs"+objrefer[key].reference.replace(/\./g, "dot").replace(/\//g, "slash").replace(/-/g, "hyphen").replace(/,/g, "comma").replace(/\s/g, "")+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='refer"+objrefer[key].reference.replace(/\./g, "dot").replace(/\//g, "slash").replace(/-/g, "hyphen").replace(/,/g, "comma").replace(/\s/g, "")+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objrefer[key].reference+"'>"+objrefer[key].reference+" </td></tr></table></div>";
			}
			// console.log(check);
			$("#referencedropdown").html(check);
			var browsers = document.getElementById("referencedropdown");
			browsers.style.display = 'none';
			browsers.style.backgroundColor = 'transparent';
			browsers.style.border = 'none';
		}
	});
},1500);
function referget(){
		var input = document.getElementById("reference");
		var browsers = document.getElementById("referencedropdown");
		input.onclick = function () {
			browsers.style.display = 'block';
			$("#referencedropdown").scrollTop( 1 );
			$("#referencedropdown").on('scroll', function() {
				var scrollTop = $(this).scrollTop();
  				if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
					$("#referencedropdown").scrollTop( 201.3 );
  				}
  				else if (scrollTop <= 0) {
					$("#referencedropdown").scrollTop( 1 );
  				}
			});
			$("body").on("click",function() {
				if($("#reference").is(":focus")){
					browsers.style.display = 'block';
					$("#referencedropdown").scrollTop( 1 );
					$("#referencedropdown").on('scroll', function() {
						var scrollTop = $(this).scrollTop();
  						if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
							$("#referencedropdown").scrollTop( 201.3 );
  						}
  						else if (scrollTop <= 0) {
							$("#referencedropdown").scrollTop( 1 );
  						}
					});
				}
				else{
					browsers.style.display = 'none';
				}
			});
		}
		$.get("refersearch.php", {term: 'invref'} , function(datas){
			const objrefer = JSON.parse(datas);
			option='';
			for (var key in objrefer) {
				option+='referdivs'+objrefer[key].reference.replace(/\./g, "dot").replace(/\//g, "slash").replace(/-/g, "hyphen").replace(/,/g, "comma").replace(/\s/g, "")+';';
			}
			optionspl = option.split(';');
			for (var i = 0; i <= optionspl.length; i++) {
				var optionans = document.getElementById(optionspl[i]);
				$("#"+optionspl[i]).on("click",function() {
					const child = this.children;
					const childone = child[0].children;
					const childtwo = childone[0].children;
					var refer = childtwo[0].innerHTML;
					var referspl = refer.split(" ");
						$('#reference').val($("#"+refer.split('id="')[1].split('" style')[0]).html());
						$('#twocustomername').focus();
						browsers.style.display = 'none';
				});
			}
		});
		$('#reference').on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#referencedropdown"+" "+"table").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value)> -1);
				if ($(this).text().toLowerCase().indexOf(value)> -1) {
					$(this).parent().css({"display": "block"});
					var browsers = document.getElementById("referencedropdown");
					browsers.style.display = 'block';
				}
				else{
					$(this).parent().css({"display": "none"});
					var browsers = document.getElementById("referencedropdown");
						if(document.getElementById("referencedropdown").innerHTML!=''){
							var lenofold = document.querySelectorAll("#referencedropdown table").length;
						}
						else{
							var lenofold = 0;
						}
						if (lenofold==0) {
							browsers.style.display = 'none';
						}
						else{
							browsers.style.display = 'block';
						}
				}
			});
		});
}
// FOR GET THE REFERENCE INFORMATIONS

$(document).ready(function () {
	$("input[type='number']").on("change", function () {
		$('input[type="number"]').not('#custbillpincode, #custshippincode, #billpincode, #twobillpincode, #shippincode, #twoshippincode, .notforfixed , #missingnoofdays').each(function () {
			if (!isNaN($(this).val())) {
				$(this).val(parseFloat($(this).val()).toFixed(2));
			}
		});
	});
});
// FOR TO FIX ALL THE NUMBER TYPE INPUTS TO 2 DECIMAL PLACES WHEN CHANGING SELF
document.addEventListener("keyup", function(event) {
	if (event.keyCode === 13) {
		var btndel = document.getElementsByName('productname[]');
		var btndels = document.getElementsByName('product[]');
		if ((btndel.length>1)||(btndel[0].value!='')) {
			for(i=0;i<btndel.length;i++){
				if (btndels[i].value!=0) {
					var ids = btndel[i].id.split('productname');
					var id = ids[1];
					changemanufacturer(id);
					changehsncode(id);
					changeexpdate(id);
					changemrp(id);
					changeunit(id);
					changenoofpacks(id);
					changeprodiscount(id);
					changevat(id);
				}
			}
		}
	}
});
// FOR AUTOMATICALLY SAVE WHEN CLICK THE ENTER KEY ( ENTER KEY CODE IS 13 )
<?php
if ($access['invautosave']=='1') {
?>
setTimeout(function() {
	autosavefun();
},15000);
<?php
}
?>
function funestimeralertmodal() {
	$("#TimerAlertModal").modal("hide");
}
function autosavefun() {
	$("#secondsleft").show();
	var iterative = 60;
	var applythischeck = true;
	var applythischecksave = true;
	if(iterative>=1){
		setInterval(function() {
			if(iterative>=1){
				$("#secondsleft").html(iterative+" Seconds Left");
				if(iterative<=10){
					$("#TimerAlertModal").modal("show");
					$("#lessthanten").html(iterative);
				}
				iterative--;
			}
			else{
				$("#secondsleft").html("Time Up");
				if (applythischeck) {
					document.getElementById("ihavereceived").checked=true;
					setTimeout(function() {
						if (applythischecksave) {
							triggerpayment('','','','1','1');
							isValidFinal = true;
							checkvalidate();
							setTimeout(function() {
								$('#triggerconfirm-adddelete').modal('hide');
								applythischeck = false;
								applythischecksave = false;
								$("#Submit").trigger("click");
								$("#loadimgbig").css("display","block");
								$(".showhideload").css("display","none");
								$("#ihavediv").css("display","none");
								$("#savecanceldiv").css("display","none");
								$("#Submit").attr("disabled","disabled");
							},800);
						}
					},1000);
				}
			}
		},1000);
	}
}
</script>
</body>
</html>