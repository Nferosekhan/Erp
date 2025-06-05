<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE
$sqlismainaccessfields=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Purchase Returns' ORDER BY id ASC");
$sqlismainaccessfields->bind_param("i", $companymainid);
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
$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Purchase Returns' ORDER BY id ASC");
$sqlismainaccessusers->bind_param("i", $userid);
$sqlismainaccessusers->execute();
$sqlismainaccessuser = $sqlismainaccessusers->get_result();
$infomainaccessuser=$sqlismainaccessuser->fetch_assoc();
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccesscreate']==0)))) {
	 header('Location:dashboard.php');
}
$sqlismainaccessuser->close();
$sqlismainaccessusers->close();
//FOR CHECK THE THIS FILES ACCESSES ARE ALLOW OR NOT
$sqlprefer=$con->prepare("SELECT * FROM paircontrols WHERE (username = ? OR usernewname = ?)");
$sqlprefer->bind_param("ss", $_SESSION['unqwerty'],$_SESSION['unqwerty']);
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
	 if (($infomainaccessuser['purreturnveninfo']=='defone')||($infomainaccessuser['purreturnveninfo']=='deftwo')) {
	 $scriptonetwo = htmlspecialchars($_POST['vendorinfodefault'], ENT_QUOTES, 'UTF-8');
	 }
	 else{
		  $scriptonetwo = 'three';
	 }
	 //FOR CHECK THE TYPE B2C OR B2B
	 $createdon=date('Y-m-d H:i:s');
	 $dlno20 = '';
	 $dlno21 = '';
	 if (($infomainaccessuser['purreturnveninfo']=='one')||($scriptonetwo=='one')) {
		  $vendorname=htmlspecialchars($_POST['vendorname'], ENT_QUOTES, 'UTF-8');
		  $vendorid=htmlspecialchars($_POST['vendorid'], ENT_QUOTES, 'UTF-8');
		  $dlno20 = htmlspecialchars( $_POST['dlno20'], ENT_QUOTES, 'UTF-8');
		  $dlno21 = htmlspecialchars( $_POST['dlno21'], ENT_QUOTES, 'UTF-8');
		  $address1 = htmlspecialchars($_POST['address1'], ENT_QUOTES, 'UTF-8');
		  $address2 = htmlspecialchars($_POST['address2'], ENT_QUOTES, 'UTF-8');
		  $saddress1 = htmlspecialchars($_POST['saddress1'], ENT_QUOTES, 'UTF-8');
		  $saddress2 = htmlspecialchars($_POST['saddress2'], ENT_QUOTES, 'UTF-8');
		  $gstno = htmlspecialchars($_POST['gstgstin'], ENT_QUOTES, 'UTF-8');
		  $pos=htmlspecialchars($_POST['pos'], ENT_QUOTES, 'UTF-8');
		  $twoworkphone = htmlspecialchars($_POST['workworkphone'], ENT_QUOTES, 'UTF-8');
		  $twomobilephone = htmlspecialchars($_POST['workmobile'], ENT_QUOTES, 'UTF-8');
		  $twosameasbilling = '0';
		  if(isset($_POST['gstgstrtype'])){
				$gstrtype=htmlspecialchars($_POST['gstgstrtype'], ENT_QUOTES, 'UTF-8');
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
	 $purchasereturnterm=htmlspecialchars($_POST['purchasereturnterm'], ENT_QUOTES, 'UTF-8');
	 $sqlismainaccessusers=$con->prepare("SELECT moduleno, moduleprefix, modulesuffix FROM pairmainaccess WHERE franchiseid=? AND moduletype='Purchase Returns' ORDER BY id ASC");
	 $sqlismainaccessusers->bind_param("i", $_SESSION['franchisesession']);
	 $sqlismainaccessusers->execute();
	 $sqlismainaccessuser = $sqlismainaccessusers->get_result();
	 $infomainaccessuser=$sqlismainaccessuser->fetch_assoc();
	 $sqlismainaccessuser->close();
	 $sqlismainaccessusers->close();
	 $purchasereturnno=htmlspecialchars($infomainaccessuser['moduleprefix'].(str_pad($infomainaccessuser['modulesuffix']+1, 0, "0", STR_PAD_LEFT)), ENT_QUOTES, 'UTF-8');
	 //FOR GET THE CURRENT PURCHASERETURN NO 
	$ordering = (str_pad($infomainaccessuser['modulesuffix']+1, 0, "0", STR_PAD_LEFT));
	 $purchasereturndate=htmlspecialchars($_POST['purchasereturndate'], ENT_QUOTES, 'UTF-8');
	 $duedate=htmlspecialchars($_POST['duedate'], ENT_QUOTES, 'UTF-8');
	 $duedates=htmlspecialchars(((isset($_POST['duedates']))?$_POST['duedates']:''), ENT_QUOTES, 'UTF-8');
	 $orderdcno="";
	 if ((in_array('Sale Person', $fieldadd))) {
		  if(isset($_POST['saleperson'])){
				$saleperson=htmlspecialchars($_POST['saleperson'], ENT_QUOTES, 'UTF-8');
		  }
		  else{
				$saleperson='';
		  }
	 }
	 else{
		  $saleperson='';
	 }
	 $invnumber=htmlspecialchars($_POST['invnumber'], ENT_QUOTES, 'UTF-8');
	 $invgrandtotal=htmlspecialchars($_POST['invgrandtotal'], ENT_QUOTES, 'UTF-8');
	 if ((in_array('Reference', $fieldadd))) {
		  $reference=htmlspecialchars($_POST['reference'], ENT_QUOTES, 'UTF-8');
	 }
	 else{
		  $reference='';
	 }
	 $totalitems=htmlspecialchars($_POST['totalitems'], ENT_QUOTES, 'UTF-8');
	 $totalvatamount=htmlspecialchars($_POST['totalvatamount'], ENT_QUOTES, 'UTF-8');
	 $totalamount=htmlspecialchars($_POST['totalamount'], ENT_QUOTES, 'UTF-8');
	 $discount=htmlspecialchars($_POST['discount'], ENT_QUOTES, 'UTF-8');
	 $totalquantity=htmlspecialchars($_POST['totalquantity'], ENT_QUOTES, 'UTF-8');
	 $discounttype=htmlspecialchars($_POST['discounttype'], ENT_QUOTES, 'UTF-8');
	 $discountamount=htmlspecialchars($_POST['discountamount'], ENT_QUOTES, 'UTF-8');
	 $freightamount=htmlspecialchars($_POST['freightamount'], ENT_QUOTES, 'UTF-8');
	 $roundoff=htmlspecialchars($_POST['roundoff'], ENT_QUOTES, 'UTF-8');
	 $grandtotal=htmlspecialchars($_POST['grandtotal'], ENT_QUOTES, 'UTF-8');
	 $purchasereturnamount=htmlspecialchars($_POST['grandtotal'], ENT_QUOTES, 'UTF-8');
	 $preparedby=htmlspecialchars($_POST['preparedby'], ENT_QUOTES, 'UTF-8');
	 $checkedby=htmlspecialchars($_POST['checkedby'], ENT_QUOTES, 'UTF-8');
	 $taxtype=htmlspecialchars($_POST['taxtype'], ENT_QUOTES, 'UTF-8');
	 //FOR GET ALL THE DATA WITHOUT LOOPING
	 $tax = '';
	 $cgst = '';
	 $sgst = '';
	 $igst = '';
	 $gst = '';
	 $gstpercent = '';
	 $csgstpercent = '';
	 for($i=0; $i<count($_POST['tax']); $i++){
		  $tax.=','.htmlspecialchars($_POST['tax'][$i], ENT_QUOTES, 'UTF-8');
		  $cgst.=','.htmlspecialchars($_POST['cgst'][$i], ENT_QUOTES, 'UTF-8');
		  $sgst.=','.htmlspecialchars($_POST['sgst'][$i], ENT_QUOTES, 'UTF-8');
		  $igst.=','.htmlspecialchars($_POST['igst'][$i], ENT_QUOTES, 'UTF-8');
		  $gst.=','.htmlspecialchars($_POST['gst'][$i], ENT_QUOTES, 'UTF-8');
		  $gstpercent.=','.htmlspecialchars($_POST['gstpercent'][$i], ENT_QUOTES, 'UTF-8');
		  $csgstpercent.=','.htmlspecialchars($_POST['csgstpercent'][$i], ENT_QUOTES, 'UTF-8');
	 }
	 //FOR GET THE TAX INFORMATIONS IN LOOP
	 if ((in_array('Terms and Conditions', $fieldadd))) {
		  $terms=htmlspecialchars($_POST['terms'], ENT_QUOTES, 'UTF-8');
	 }
	 else{
		  $terms='';
	 }
	 if ((in_array('Notes', $fieldadd))) {
		  $notes=htmlspecialchars($_POST['notes'], ENT_QUOTES, 'UTF-8');
	 }
	 else{
		  $notes='';
	 }
	 if ((in_array('Description', $fieldadd))) {
		  $description=htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
	 }
	 else{
		  $description='';
	 }
	 $validpaidamount=htmlspecialchars($_POST['validpaidamount'], ENT_QUOTES, 'UTF-8');
	 $validbalance=htmlspecialchars((float)$_POST['grandtotal'], ENT_QUOTES, 'UTF-8') - htmlspecialchars((float)$_POST['validpaidamount'], ENT_QUOTES, 'UTF-8');
	 $ansforsepgstval=htmlspecialchars($_POST['ansforsepgstval'], ENT_QUOTES, 'UTF-8');
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
	 $sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Purchase Returns' ORDER BY id ASC");
	 $sqlismainaccessusers->bind_param("i", $userid);
	 $sqlismainaccessusers->execute();
	 $sqlismainaccessuser = $sqlismainaccessusers->get_result();
	 $infomainaccessuser=$sqlismainaccessuser->fetch_assoc();
	 $sqlismainaccessuser->close();
	 $sqlismainaccessusers->close();
	 //FOR CHECK THE B2B OR B2C ENABLED
	 if (($infomainaccessuser['purreturnveninfo']=='one')||($scriptonetwo=='one')) {
		  $venid=htmlspecialchars($_POST['vendor'], ENT_QUOTES, 'UTF-8');
		  $vensqlvenhiss=$con->prepare("SELECT * FROM paircustomers WHERE (franchisesession=? OR cvisiblity='PUBLIC') AND (createdid=? AND moduletype='Vendors') AND id=? ORDER BY id ASC");
		  $vensqlvenhiss->bind_param("ssi", $_SESSION["franchisesession"],$companymainid,$venid);
		  $vensqlvenhiss->execute();
		  $vensqlvenhis = $vensqlvenhiss->get_result();
		  $vensqlanscus=$vensqlvenhis->fetch_assoc();
		  $vensqlvenhis->close();
		  $vensqlvenhiss->close();
		  $venoldworkphone = $vensqlanscus['workphone'];
		  $venoldmobilephone = $vensqlanscus['mobile'];
		  $venoldbillstreet = $vensqlanscus['billstreet'];
		  $venoldbillcity = $vensqlanscus['billcity'];
		  $venoldbillstate = $vensqlanscus['billstate'];
		  $venoldbillpincode = $vensqlanscus['billpincode'];
		  $venoldbillcountry = $vensqlanscus['billcountry'];
		  $venoldshipstreet = $vensqlanscus['shipstreet'];
		  $venoldshipcity = $vensqlanscus['shipcity'];
		  $venoldshipstate = $vensqlanscus['shipstate'];
		  $venoldshippincode = $vensqlanscus['shippincode'];
		  $venoldshipcountry = $vensqlanscus['shipcountry'];
		  $venoldgstrtype = $vensqlanscus['gstrtype'];
		  $venoldgstin = $vensqlanscus['gstin'];
		  $venolddlno20 = $vensqlanscus['dlno20'];
		  $venolddlno21 = $vensqlanscus['dlno21'];
		  $area = htmlspecialchars($_POST['billstreet'], ENT_QUOTES, 'UTF-8');
		  $city = htmlspecialchars($_POST['billcity'], ENT_QUOTES, 'UTF-8');
		  $state = htmlspecialchars($_POST['billstate'], ENT_QUOTES, 'UTF-8');
		  $pincode = htmlspecialchars($_POST['billpincode'], ENT_QUOTES, 'UTF-8');
		  $district = htmlspecialchars($_POST['billcountry'], ENT_QUOTES, 'UTF-8');
		  $vengstin = htmlspecialchars($_POST['gstgstin'], ENT_QUOTES, 'UTF-8');
		  $venworkphone = htmlspecialchars($_POST['workworkphone'], ENT_QUOTES, 'UTF-8');
		  $venmobilephone = htmlspecialchars($_POST['workmobile'], ENT_QUOTES, 'UTF-8');
		  $sarea = htmlspecialchars($_POST['shipstreet'], ENT_QUOTES, 'UTF-8');
		  $scity = htmlspecialchars($_POST['shipcity'], ENT_QUOTES, 'UTF-8');
		  $sstate = htmlspecialchars($_POST['shipstate'], ENT_QUOTES, 'UTF-8');
		  $spincode = htmlspecialchars($_POST['shippincode'], ENT_QUOTES, 'UTF-8');
		  $sdistrict = htmlspecialchars($_POST['shipcountry'], ENT_QUOTES, 'UTF-8');
		  $vensqlup = $con->prepare("UPDATE paircustomers SET dlno20=?, dlno21=?, createdon=?, createdid=?, createdby=?, franchisesession=?,billstreet=?,billcity=?,billstate=?,billpincode=?,billcountry=?,shipstreet=?,shipcity=?,shipstate=?,shippincode=?,shipcountry=?,gstrtype=?,gstin=?,workphone=?,mobile=? WHERE id=? AND createdid=? AND moduletype='Vendors' AND (franchisesession=? OR cvisiblity='PUBLIC')");
		  $vensqlup->bind_param("ssssssssssssssssssssiss", $dlno20, $dlno21, $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $area, $city, $state, $pincode, $district, $sarea, $scity, $sstate, $spincode, $sdistrict, $gstrtype, $vengstin, $venworkphone, $venmobilephone, $venid, $companymainid, $_SESSION["franchisesession"]);
		  $vensqlup->execute();
		  $vensqlup->close();
		  $vench='';
		  if($venworkphone!=$venoldworkphone){
				if($vench!=''){
					 $vench.='<br> Work Phone<span style="color:green;" id="prohisfromtospan">( From '.$venoldworkphone.' To '.$venworkphone.' ) </span>';
				}
				else{
					 $vench.='Work Phone<span style="color:green;" id="prohisfromtospan">( From '.$venoldworkphone.' To '.$venworkphone.' ) </span>';
				}                   
		  }
		  if($venmobilephone!=$venoldmobilephone){
				if($vench!=''){
					 $vench.='<br> Mobile Phone<span style="color:green;" id="prohisfromtospan">( From '.$venoldmobilephone.' To '.$venmobilephone.' ) </span>';
				}
				else{
					 $vench.='Mobile Phone<span style="color:green;" id="prohisfromtospan">( From '.$venoldmobilephone.' To '.$venmobilephone.' ) </span>';
				}                   
		  }
		  if($area!=$venoldbillstreet){
				if($vench!=''){
					 $vench.='<br> Billing Street<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillstreet.' To '.$area.' ) </span>';
				}
				else{
					 $vench.='Billing Street<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillstreet.' To '.$area.' ) </span>';
				}                   
		  }
		  if($city!=$venoldbillcity){
				if($vench!=''){
					 $vench.='<br> Billing City<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillcity.' To '.$city.' ) </span>';
				}
				else{
					 $vench.='Billing City<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillcity.' To '.$city.' ) </span>';
				}                   
		  }
		  if($state!=$venoldbillstate){
				if($vench!=''){
					 $vench.='<br> Billing State<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillstate.' To '.$state.' ) </span>';
				}
				else{
					 $vench.='Billing State<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillstate.' To '.$state.' ) </span>';
				}                   
		  }
		  if($pincode!=$venoldbillpincode){
				if($vench!=''){
					 $vench.='<br> Billing Pincode<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillpincode.' To '.$pincode.' ) </span>';
				}
				else{
					 $vench.='Billing Pincode<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillpincode.' To '.$pincode.' ) </span>';
				}                   
		  }
		  if($district!=$venoldbillcountry){
				if($vench!=''){
					 $vench.='<br> Billing Country<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillcountry.' To '.$district.' ) </span>';
				}
				else{
					 $vench.='Billing Country<span style="color:green;" id="prohisfromtospan">( From '.$venoldbillcountry.' To '.$district.' ) </span>';
				}                   
		  }
		  if($sarea!=$venoldshipstreet){
				if($vench!=''){
					 $vench.='<br> Shipping Street<span style="color:green;" id="prohisfromtospan">( From '.$venoldshipstreet.' To '.$sarea.' ) </span>';
				}
				else{
					 $vench.='Shipping Street<span style="color:green;" id="prohisfromtospan">( From '.$venoldshipstreet.' To '.$sarea.' ) </span>';
				}                   
		  }
		  if($scity!=$venoldshipcity){
				if($vench!=''){
					 $vench.='<br> Shipping City<span style="color:green;" id="prohisfromtospan">( From '.$venoldshipcity.' To '.$scity.' ) </span>';
				}
				else{
					 $vench.='Shipping City<span style="color:green;" id="prohisfromtospan">( From '.$venoldshipcity.' To '.$scity.' ) </span>';
				}                   
		  }
		  if($sstate!=$venoldshipstate){
				if($vench!=''){
					 $vench.='<br> Shipping State<span style="color:green;" id="prohisfromtospan">( From '.$venoldshipstate.' To '.$sstate.' ) </span>';
				}
				else{
					 $vench.='Shipping State<span style="color:green;" id="prohisfromtospan">( From '.$venoldshipstate.' To '.$sstate.' ) </span>';
				}                   
		  }
		  if($spincode!=$venoldshippincode){
				if($vench!=''){
					 $vench.='<br> Shipping Pincode<span style="color:green;" id="prohisfromtospan">( From '.$venoldshippincode.' To '.$spincode.' ) </span>';
				}
				else{
					 $vench.='Shipping Pincode<span style="color:green;" id="prohisfromtospan">( From '.$venoldshippincode.' To '.$spincode.' ) </span>';
				}                   
		  }
		  if($sdistrict!=$venoldshipcountry){
				if($vench!=''){
					 $vench.='<br> Shipping Country<span style="color:green;" id="prohisfromtospan">( From '.$venoldshipcountry.' To '.$sdistrict.' ) </span>';
				}
				else{
					 $vench.='Shipping Country<span style="color:green;" id="prohisfromtospan">( From '.$venoldshipcountry.' To '.$sdistrict.' ) </span>';
				}                   
		  }
		  if($gstrtype!=$venoldgstrtype){
				if($vench!=''){
					 $vench.='<br> GST Registration Type<span style="color:green;" id="prohisfromtospan">( From '.$venoldgstrtype.' To '.$gstrtype.' ) </span>';
				}
				else{
					 $vench.='GST Registration Type<span style="color:green;" id="prohisfromtospan">( From '.$venoldgstrtype.' To '.$gstrtype.' ) </span>';
				}                   
		  }
		  if($vengstin!=$venoldgstin){
				if($vench!=''){
					 $vench.='<br> GSTIN / UIN<span style="color:green;" id="prohisfromtospan">( From '.$venoldgstin.' To '.$vengstin.' ) </span>';
				}
				else{
					 $vench.='GSTIN / UIN<span style="color:green;" id="prohisfromtospan">( From '.$venoldgstin.' To '.$vengstin.' ) </span>';
				}                   
		  }
		  if($dlno20!=$venolddlno20){
				if($vench!=''){
					 $vench.='<br> DL No 20<span style="color:green;" id="prohisfromtospan">( From '.$venolddlno20.' To '.$dlno20.' ) </span>';
				}
				else{
					 $vench.='DL No 20<span style="color:green;" id="prohisfromtospan">( From '.$venolddlno20.' To '.$dlno20.' ) </span>';
				}                   
		  }
		  if($dlno21!=$venolddlno21){
				if($vench!=''){
					 $vench.='<br> DL No 21<span style="color:green;" id="prohisfromtospan">( From '.$venolddlno21.' To '.$dlno21.' ) </span>';
				}
				else{
					 $vench.='DL No 21<span style="color:green;" id="prohisfromtospan">( From '.$venolddlno21.' To '.$dlno21.' ) </span>';
				}                   
		  }
		  if($vench!=''){
				$vensqluse = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,useremarks) VALUES ('VENDORS', ?, ?, ?, ?)");
				$vensqluse->bind_param("ssss", $times, $_SESSION["unqwerty"], $venid, $vench);
				$vensqluse->execute();
				$vensqluse->close();
		  }
	 //FOR THE B2B CUSTOMER CHANGES
	 }
	 if (($infomainaccessuser['purreturnveninfo']=='two')||($scriptonetwo=='two')) {
		  $address1 = '';
		  $address2 = '';
		  $saddress1 = '';
		  $saddress2 = '';
		  $vendorname = htmlspecialchars($_POST['twovendorname'], ENT_QUOTES, 'UTF-8');
		  $area = htmlspecialchars($_POST['twobillstreet'], ENT_QUOTES, 'UTF-8');
		  $city = htmlspecialchars($_POST['twobillcity'], ENT_QUOTES, 'UTF-8');
		  $state = htmlspecialchars($_POST['twobillstate'], ENT_QUOTES, 'UTF-8');
		  $pincode = htmlspecialchars($_POST['twobillpincode'], ENT_QUOTES, 'UTF-8');
		  $district = htmlspecialchars($_POST['twobillcountry'], ENT_QUOTES, 'UTF-8');
		  $gstno = htmlspecialchars($_POST['twogstin'], ENT_QUOTES, 'UTF-8');
		  $twoworkphone = htmlspecialchars($_POST['twoworkphone'], ENT_QUOTES, 'UTF-8');
		  $twomobilephone = htmlspecialchars($_POST['twomobilephone'], ENT_QUOTES, 'UTF-8');
		  $pos=htmlspecialchars($_POST['twopos'], ENT_QUOTES, 'UTF-8');
		  $twosameasbilling = htmlspecialchars(((isset($_POST['twosameasbilling']))?'1':'0'), ENT_QUOTES, 'UTF-8');
		  if ($twosameasbilling=='1') {
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
		  $sqlismodulespublicnamevens=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Vendors' ORDER BY id ASC");
		  $sqlismodulespublicnamevens->execute();
		  $sqlismodulespublicnameven = $sqlismodulespublicnamevens->get_result();
		  $infomodulespublicnameven=$sqlismodulespublicnameven->fetch_assoc();
		  $sqlismodulespublicnameven->close();
		  $sqlismodulespublicnamevens->close();

		  $sqlismainaccesspublicnamevens=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Vendors' AND franchiseid=? ORDER BY id ASC");
		  $sqlismainaccesspublicnamevens->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
		  $sqlismainaccesspublicnamevens->execute();
		  $sqlismainaccesspublicnameven = $sqlismainaccesspublicnamevens->get_result();
		  $infomainaccesspublicnameven=$sqlismainaccesspublicnameven->fetch_assoc();
		  $sqlismainaccesspublicnameven->close();
		  $sqlismainaccesspublicnamevens->close();

		  $vensqlinss=$con->prepare("SELECT count(customercode) FROM paircustomers WHERE moduletype='Vendors'");
		  $vensqlinss->execute();
		  $vensqlins = $vensqlinss->get_result();
		  $venansins=$vensqlins->fetch_array();
		  $vensqlins->close();
		  $vensqlinss->close();

		  $venoldid = $venansins[0];
		  $venvendorcode = $venoldid + 1;

		  $venpublicsqls=$con->prepare("SELECT count(publicid) FROM paircustomers WHERE createdid=? AND moduletype='Vendors'");
		  $venpublicsqls->bind_param("s", $companymainid);
		  $venpublicsqls->execute();
		  $venpublicsql = $venpublicsqls->get_result();
		  $venpublicans=$venpublicsql->fetch_array();
		  $venpublicsql->close();
		  $venpublicsqls->close();

		  $venoldcodepublic=$venpublicans[0];
		  $venpubliccode=$infomodulespublicnameven['publiccolumn'] . $venoldcodepublic+1;
		  $venprivatesqls=$con->prepare("SELECT count(privateid) FROM paircustomers WHERE createdid=? AND moduletype='Vendors' AND franchisesession=?");
		  $venprivatesqls->bind_param("ss", $companymainid, $_SESSION['franchisesession']);
		  $venprivatesqls->execute();
		  $venprivatesql = $venprivatesqls->get_result();
		  $venprivateans=$venprivatesql->fetch_array();
		  $venprivatesql->close();
		  $venprivatesqls->close();

		  $venoldcodeprivate=$venprivateans[0];
		  $venprivatecode=$infomainaccesspublicnameven['moduleprefix'] . $venoldcodeprivate+1;

		  $sqlup = $con->prepare("INSERT INTO paircustomers (dlno20,dlno21,createdon,createdid,createdby,franchisesession,customername,billstreet,billcity,billstate,billpincode,billcountry,shipstreet,shipcity,shipstate,shippincode,shipcountry,sameasbilling,gstrtype,gstin,moduletype,placeos,workphone,mobile,customercode,publicid,privateid,cvisiblity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Vendors', ?, ?, ?, ?, ?, ?, ?)");
		  $sqlup->bind_param("sssssssssssssssssisssssssss", $dlno20, $dlno21, $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $vendorname, $area, $city, $state, $pincode, $district, $sarea, $scity, $sstate, $spincode, $sdistrict, $twosameasbilling, $gstrtype, $gstno, $pos, $twoworkphone, $twomobilephone, $venvendorcode, $venpubliccode, $venprivatecode, $infomainaccesspublicnameven['vendorvisible']);
		  $sqlup->execute();
		  $sqlup->close();

		  $vendorid=$con->insert_id;
	 //FOR B2C NEW VENDOR INSERTION
	 }
	 $sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Purchase Returns' ORDER BY id ASC");
	 $sqlismainaccessusers->bind_param("i", $userid);
	 $sqlismainaccessusers->execute();
	 $sqlismainaccessuser = $sqlismainaccessusers->get_result();
	 $infomainaccessuser=$sqlismainaccessuser->fetch_array();
	 $sqlismainaccessuser->close();
	 $sqlismainaccessusers->close();
	 $sql3 = $con->prepare("UPDATE pairmainaccess SET modulesuffix=modulesuffix + 1 WHERE franchiseid=? AND moduletype='Purchase Returns'");
	$sql3->bind_param("s", $_SESSION['franchisesession']);
	$sql3->execute();
	 $sql3->close();
	 //FOR INCREMENT THE AUTO NUMBER SERIES OF THE FILE
	 $sql2=$con->prepare("SELECT id FROM pairpurchasereturns WHERE franchisesession=? AND createdid=? AND purchasereturnno=? AND purchasereturndate=?");
	 $sql2->bind_param("iiss", $_SESSION['franchisesession'], $companymainid, $purchasereturnno, $purchasereturndate);
	 $sql2->execute();
	 $sql2->store_result();
	 //FOR CHECK THE PURCHASERETURN IS IN OR NOT
	 if($sql2->num_rows==0){
		  for($i=0; $i<count($_POST['productname']); $i++){
				$productid=htmlspecialchars($_POST['productid'][$i], ENT_QUOTES, 'UTF-8');
				$productname=htmlspecialchars($_POST['productname'][$i], ENT_QUOTES, 'UTF-8');
				$manufacturer=htmlspecialchars($_POST['manufacturer'][$i], ENT_QUOTES, 'UTF-8');
				$producthsn=htmlspecialchars($_POST['producthsn'][$i], ENT_QUOTES, 'UTF-8');
				$productnotes=htmlspecialchars($_POST['productnotes'][$i], ENT_QUOTES, 'UTF-8');
				$productdescription=htmlspecialchars($_POST['productdescription'][$i], ENT_QUOTES, 'UTF-8');
				$itemmodule=htmlspecialchars($_POST['itemmodule'][$i], ENT_QUOTES, 'UTF-8');
				$rack=htmlspecialchars($_POST['rack'][$i], ENT_QUOTES, 'UTF-8');
				if ($access['batchexpiryval']==1) {
					 $batch=htmlspecialchars($_POST['batch'][$i], ENT_QUOTES, 'UTF-8');
					 $expdate=htmlspecialchars($_POST['expdate'][$i], ENT_QUOTES, 'UTF-8');
				}
				else{
					 $batch='';
					 $expdate='';
				}
				$mrp=htmlspecialchars( (($_POST['mrp'][$i]!='')?$_POST['mrp'][$i]:0), ENT_QUOTES, 'UTF-8');
				$vat=htmlspecialchars($_POST['vat'][$i], ENT_QUOTES, 'UTF-8');
				$quantity=htmlspecialchars((($_POST['quantity'][$i]!='')?$_POST['quantity'][$i]:0), ENT_QUOTES, 'UTF-8');
				$unit=htmlspecialchars($_POST['productunit'][$i], ENT_QUOTES, 'UTF-8');
				$productrate=htmlspecialchars((($_POST['productrate'][$i]!='')?$_POST['productrate'][$i]:'0'), ENT_QUOTES, 'UTF-8');
				$noofpacks=htmlspecialchars($_POST['noofpacks'][$i], ENT_QUOTES, 'UTF-8');
				$prodiscount=htmlspecialchars($_POST['prodiscount'][$i], ENT_QUOTES, 'UTF-8');
				$prodisvalueforledger = floatval(htmlspecialchars($_POST['prodisvalueforledger'][$i], ENT_QUOTES, 'UTF-8'));
				$prodiscounttype=htmlspecialchars($_POST['prodiscounttype'][$i], ENT_QUOTES, 'UTF-8');
				$productvalue=htmlspecialchars($_POST['productvalue'][$i], ENT_QUOTES, 'UTF-8');
				$taxvalue=htmlspecialchars($_POST['taxvalue'][$i], ENT_QUOTES, 'UTF-8');
				$cgstvat=htmlspecialchars($_POST['cgstvat'][$i], ENT_QUOTES, 'UTF-8');
				$sgstvat=htmlspecialchars($_POST['sgstvat'][$i], ENT_QUOTES, 'UTF-8');
				$productnetvalue=htmlspecialchars($_POST['productnetvalue'][$i], ENT_QUOTES, 'UTF-8');
				$salequantity=htmlspecialchars((($_POST['salequantity'][$i]!='')?$_POST['salequantity'][$i]:'0'), ENT_QUOTES, 'UTF-8');
				$productwithouttax=htmlspecialchars($_POST['productwithouttax'][$i], ENT_QUOTES, 'UTF-8');
				$productwithtax=htmlspecialchars($_POST['productwithtax'][$i], ENT_QUOTES, 'UTF-8');
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
					 $sql = $con->prepare("INSERT INTO pairpurchasereturns (createdon,createdid,createdby,franchisesession,vendorname,vendorid,address1,address2,area,city,state,district,pincode,saddress1,saddress2,sarea,scity,sstate,sdistrict,spincode,gstno,purchasereturnterm,purchasereturnno,purchasereturndate,purchasereturnamount,duedate,duedates,productid,productname,manufacturer,producthsn,productnotes,productdescription,itemmodule,rack,batch,expdate,mrp,vat,quantity,unit,productrate,noofpacks,prodiscount,productvalue,taxvalue,cgstvat,sgstvat,productnetvalue,totalitems,orderdcno,reference,saleperson,totalvatamount,totalamount,totalquantity,discounttype,discount,discountamount,freightamount,roundoff,grandtotal,preparedby,checkedby,taxtype,tax,cgst,sgst,igst,gst,gstpercent,csgstpercent,terms,notes,description,fileattach,pos,workphone,mobile,sameasbilling,vendorinfodefault,gstrtype,validpaidamount,validbalance,icsgsthis,prodiscounttype,invnumber,invgrandtotal,salequantity,productwithouttax,productwithtax,accountid,accountname,ordering,dlno20,dlno21) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					 $sql->bind_param("sssssssssssssssssssssssssssssssssssssssisssssssssssssssssssssssssssssssssssssssssssssssssssissss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $vendorname, $vendorid, $address1, $address2, $area, $city, $state, $district, $pincode, $saddress1, $saddress2, $sarea, $scity, $sstate, $sdistrict, $spincode, $gstno, $purchasereturnterm, $purchasereturnno, $purchasereturndate, $purchasereturnamount, $duedate, $duedates, $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $itemmodule, $rack, $batch, $expdate, $mrp, $vat, $quantity, $unit, $productrate, $noofpacks, $prodiscount, $productvalue, $taxvalue,$cgstvat,$sgstvat, $productnetvalue, $totalitems, $orderdcno, $reference, $saleperson, $totalvatamount, $totalamount, $totalquantity, $discounttype, $discount, $discountamount, $freightamount, $roundoff, $grandtotal, $preparedby, $checkedby, $taxtype, $tax, $cgst, $sgst, $igst, $gst, $gstpercent, $csgstpercent, $terms, $notes, $description, $fileattach, $pos, $twoworkphone, $twomobilephone, $twosameasbilling, $scriptonetwo, $gstrtype, $validpaidamount, $validbalance, $ansforsepgstval, $prodiscounttype, $invnumber, $invgrandtotal, $salequantity, $productwithouttax, $productwithtax, $chartaccountid, $accountname, $ordering, $dlno20, $dlno21);
					 //FOR INSERT THE NEW PURCHASERETURN 
					 if($sql->execute()){
						  $sql->close();
						  $purchaseid=$con->insert_id;
						  if($purchasereturnterm=='CASH'){
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
									 $sqlaccins = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'purchasereturn')");
									 $sqlaccins->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $accountname, $chartaccountid, $vendorid, $vendorname, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
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

												$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'purchasereturn')");
												$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $defaccountnamediscount, $defaccountiddiscount, $vendorid, $vendorname, $prodisvalueforledger, $prodisvalueforledger, $grandtotal, $publicidmanual, $privateidmanual);
												$sqlaccdefault->execute();
												$sqlaccdefault->close();
										  }
									 }
									 else{
										  echo mysqli_error($con);
									 }
									 $sqlaccins->close();
									 if ($taxvalue>0) {
										  $sqlaccdefaulttdss=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='TDS Payable'");
										  $sqlaccdefaulttdss->execute();
										  $sqlaccdefaulttds = $sqlaccdefaulttdss->get_result();
										  $fetaccdefaulttds=$sqlaccdefaulttds->fetch_array();

										  $defaccountnametds=$fetaccdefaulttds['accountname'];
										  $defaccountidtds=$fetaccdefaulttds['id'];

										  $sqlaccdefaulttds->close();
										  $sqlaccdefaulttdss->close();

										  $sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'purchasereturn')");
										  $sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $defaccountnametds, $defaccountidtds, $vendorid, $vendorname, $taxvalue, $taxvalue, $grandtotal, $publicidmanual, $privateidmanual);
										  $sqlaccdefault->execute();
										  $sqlaccdefault->close();
									 }
									 $sqlaccdefaultsales=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Payable'");
									 $sqlaccdefaultsales->execute();
									 $sqlaccdefaultsale = $sqlaccdefaultsales->get_result();
									 $fetaccdefaultsales=$sqlaccdefaultsale->fetch_array();

									 $defaccountname=$fetaccdefaultsales['accountname'];
									 $defaccountid=$fetaccdefaultsales['id'];

									 $sqlaccdefaultsale->close();
									 $sqlaccdefaultsales->close();

									 $sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'purchasereturn')");
									 $sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $defaccountname, $defaccountid, $vendorid, $vendorname, $productrate, $productrate, $grandtotal, $publicidmanual, $privateidmanual);
									 $sqlaccdefault->execute();
									 $sqlaccdefault->close();

									 $sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Payable'");
									 $sqlaccdefaultpettycashpays->execute();
									 $sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
									 $fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

									 $defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'];
									 $defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

									 $sqlaccdefaultpettycashpay->close();
									 $sqlaccdefaultpettycashpays->close();

									 $sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'purchasereturn payment')");
									 $sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $vendorid, $vendorname, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
									 $sqlaccinspay->execute();
									 $sqlaccinspay->close();
									 $sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
									 $sqlaccdefaultcashpays->execute();
									 $sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
									 $fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

									 $defaccountnamepay=$fetaccdefaultcashpay['accountname'];
									 $defaccountidpay=$fetaccdefaultcashpay['id'];

									 $sqlaccdefaultcashpay->close();
									 $sqlaccdefaultcashpays->close();

									 $sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'purchasereturn payment')");
									 $sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $defaccountnamepay, $defaccountidpay, $vendorid, $vendorname, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
									 $sqlaccdefaultpay->execute();
									 $sqlaccdefaultpay->close();
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
									 $sqlaccins = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'purchasereturn')");
									 $sqlaccins->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $accountname, $chartaccountid, $vendorid, $vendorname, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
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

										  $sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'purchasereturn')");
										  $sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $defaccountnamediscount, $defaccountiddiscount, $vendorid, $vendorname, $prodisvalueforledger, $prodisvalueforledger, $grandtotal, $publicidmanual, $privateidmanual);
										  $sqlaccdefault->execute();
										  $sqlaccdefault->close();
									 }
									 if ($taxvalue>0) {
										  $sqlaccdefaulttdss=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='TDS Payable'");
										  $sqlaccdefaulttdss->execute();
										  $sqlaccdefaulttds = $sqlaccdefaulttdss->get_result();
										  $fetaccdefaulttds=$sqlaccdefaulttds->fetch_array();

										  $defaccountnametds=$fetaccdefaulttds['accountname'];
										  $defaccountidtds=$fetaccdefaulttds['id'];

										  $sqlaccdefaulttds->close();
										  $sqlaccdefaulttdss->close();

										  $sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'purchasereturn')");
										  $sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $defaccountnametds, $defaccountidtds, $vendorid, $vendorname, $taxvalue, $taxvalue, $grandtotal, $publicidmanual, $privateidmanual);
										  $sqlaccdefault->execute();
										  $sqlaccdefault->close();
									 }
									 $sqlaccdefaultsales=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Payable'");
									 $sqlaccdefaultsales->execute();
									 $sqlaccdefaultsale = $sqlaccdefaultsales->get_result();
									 $fetaccdefaultsales=$sqlaccdefaultsale->fetch_array();

									 $defaccountname=$fetaccdefaultsales['accountname'];
									 $defaccountid=$fetaccdefaultsales['id'];

									 $sqlaccdefaultsale->close();
									 $sqlaccdefaultsales->close();

									 $sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'purchasereturn')");
									 $sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $purchasereturndate, $purchasereturnno, $defaccountname, $defaccountid, $vendorid, $vendorname, $productrate, $productrate, $grandtotal, $publicidmanual, $privateidmanual);
									 $sqlaccdefault->execute();
									 $sqlaccdefault->close();
								}
						  //FOR INSERT THE MANUAL JOURNAL
						  }
						  $sqlmargins = $con->prepare("INSERT INTO pairmargins (createdon,createdid,franchisesession,type,billername,billerid,billingno,billingdate,productid,productname,batch,expiry,quantity,mrp,rate,nowstatus,taxablevalue,discountvalue,prodiscounttype) VALUES (?, ?, ?, 'buying', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'added', ?, ?, ?)");
						  $sqlmargins->bind_param("siisississsssssss", $times, $companymainid, $_SESSION["franchisesession"], $vendorname, $vendorid, $purchasereturnno, $purchasereturndate, $productid, $productname, $batch, $expdate, $quantity, $mrp, $productrate, $productvalue, $prodiscount, $prodiscounttype);
						  $sqlmargins->execute();
						  $sqlmargins->close();
						  //FOR INSERT THE MARGIN DETAILS
						  $sql4 = $con->prepare("UPDATE pairproducts SET openingstock=openingstock + ? WHERE id=?");
						  $sql4->bind_param("si", $salequantity, $productid);
						  $sql4->execute();
						  if($sql4){
								$sql4->close();
								$sqlibatch=$con->prepare("SELECT id FROM pairbatch WHERE createdid=? AND franchisesession=? AND productid=? AND batch=? AND expdate=?");
								$sqlibatch->bind_param("sssss", $companymainid, $_SESSION["franchisesession"], $productid, $batch, $expdate);
								$sqlibatch->execute();
								$sqlibatch->store_result();
								if($sqlibatch->num_rows>0){
									 $sqlibatch->close();
									 $sqlbatchupd = $con->prepare("UPDATE pairbatch SET createdon=?, createdid=?, createdby=?, franchisesession=?, productid=?, productname=?, manufacturer=?, producthsn=?, productnotes=?, productdescription=?, batch=?, expdate=?, mrp=?, vat=?, quantity=quantity - ?, productrate=?, noofpacks=?, prodiscount=?, inctaxmrp=?, exctaxmrp=? WHERE createdid=? AND franchisesession=? AND productid=? AND batch=? AND expdate=?");
									 $sqlbatchupd->bind_param("ssssssssssssssissssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $batch, $expdate, $mrp, $vat, $salequantity, $productrate, $noofpacks, $prodiscount, $productwithtax, $productwithouttax, $companymainid, $_SESSION["franchisesession"], $productid, $batch, $expdate);
									 $sqlbatchupd->execute();
									 $sqlbatchupd->close();
								}
								else{
									 $sqlibatch->close();
									 $sqlbatchins = $con->prepare("INSERT INTO pairbatch (createdon,createdid,createdby,franchisesession,productid,productname,manufacturer,producthsn,productnotes,productdescription,batch,expdate,mrp,vat,quantity,productrate,noofpacks,prodiscount,inctaxmrp,exctaxmrp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
									 $sqlbatchins->bind_param("ssssssssssssssisssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $batch, $expdate, $mrp, $vat, $salequantity, $productrate, $noofpacks, $prodiscount, $productwithtax, $productwithouttax);
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
		  if($purchasereturnterm=='CASH'){
				// if ($validpaidamount!=0) {
					 $sqlismodulespublicnames=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Payments Made' ORDER BY id ASC");
					 $sqlismodulespublicnames->execute();
					 $sqlismodulespublicname = $sqlismodulespublicnames->get_result();
					 $infomodulespublicname=$sqlismodulespublicname->fetch_array();

					 $sqlismainaccesspublicnames=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Payments Made' AND franchiseid=? ORDER BY id ASC");
					 $sqlismainaccesspublicnames->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
					 $sqlismainaccesspublicnames->execute();
					 $sqlismainaccesspublicname = $sqlismainaccesspublicnames->get_result();
					 $infomainaccesspublicname=$sqlismainaccesspublicname->fetch_array();

					 $publicsqls=$con->prepare("SELECT count(publicid) FROM pairpurchasereturnpayments WHERE createdid=?");
					 $publicsqls->bind_param("s", $companymainid);
					 $publicsqls->execute();
					 $publicsql = $publicsqls->get_result();
					 $publicans=$publicsql->fetch_array();
					 $oldcodepublic=$publicans[0];
					 $publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
					 $publicsql->close();
					 $publicsqls->close();

					 $privatesqls=$con->prepare("SELECT count(privateid) FROM pairpurchasereturnpayments WHERE createdid=? AND franchisesession=?");
					 $privatesqls->bind_param("ss", $companymainid, $_SESSION['franchisesession']);
					 $privatesqls->execute();
					 $privatesql = $privatesqls->get_result();
					 $privateans=$privatesql->fetch_array();
					 $oldcodeprivate=$privateans[0];
					 $privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;
					 $privatesql->close();
					 $privatesqls->close();

					 $sqlismainaccesspublicname->close();
					 $sqlismainaccesspublicnames->close();

					 $sqlismodulespublicname->close();
					 $sqlismodulespublicnames->close();

					 $sqlpurpayins = $con->prepare("INSERT INTO pairpurchasereturnpayments (createdid,createdby,franchisesession,createdon,term,type,vendorname,vendorid,receiptno,receiptdate,amount,paymentmode,notes,publicid,privateid) VALUES (?, ?, ?, ?, 'RECEIPT', 'purchasereturn', ?, ?, ?, ?, ?, ?, '-', ?, ?)");
					 $sqlpurpayins->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $vendorname, $vendorid, $purchasereturnno, $purchasereturndate, $validpaidamount, $purchasereturnterm, $publiccode, $privatecode);
					 $sqlpurpayins->execute();
					 //FOR INSERT THE PAYMENT DETAILS
				// }
				if($sqlpurpayins){
					 // if ($validpaidamount!=0) {
						  $paymentid=$con->insert_id;
						  $sqle = $con->prepare("INSERT INTO pairpurchasereturnpayhistory (createdid,createdby,franchisesession,createdon,paymentid,vendorid,purchasereturnno,purchasereturndate,amount,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'purchasereturn')");
						  $sqle->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $paymentid, $vendorid, $purchasereturnno, $purchasereturndate, $validpaidamount);
						  $sqle->execute();
						  $sqle->close();
					 //FOR INSERT THE PAYMENT DETAILS HISTORY
					 // }
					 if($validpaidamount==$grandtotal){
						  $sqler = $con->prepare("UPDATE pairpurchasereturns SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='1' WHERE purchasereturnno=? AND purchasereturndate=? AND vendorid=? AND franchisesession=? AND createdid=?");
						  $sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $purchasereturnno, $purchasereturndate, $vendorid, $_SESSION['franchisesession'], $companymainid);
						  $sqler->execute();
						  $sqler->close();
						  //FOR UPDATE THE PAYMENT STATUS PAID
					 }
					 else{
						  $sqler = $con->prepare("UPDATE pairpurchasereturns SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='2' WHERE purchasereturnno=? AND purchasereturndate=? AND vendorid=? AND franchisesession=? AND createdid=?");
						  $sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $purchasereturnno, $purchasereturndate, $vendorid, $_SESSION['franchisesession'], $companymainid);
						  $sqler->execute();
						  $sqler->close();
						  //FOR UPDATE THE PAYMENT STATUS UNPAID
					 }
				}
		  }
		  $sqlmanualinc = $con->prepare("UPDATE pairmainaccess SET modulesuffix=modulesuffix + 1 WHERE franchiseid=? AND moduletype='Manual Journals'");
		  $sqlmanualinc->bind_param("s", $_SESSION['franchisesession']);
		  $sqlmanualinc->execute();
		  $sqlmanualinc->close();
		  //FOR INCREMENT THE AUTO NUMBER SERIES OF THE MANUAL JOURNAL FILE
		  $purchasereturninfoch = '';
		  $sqlismainaccessuserinvs=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
		  $sqlismainaccessuserinvs->bind_param("i", $userid);
		  $sqlismainaccessuserinvs->execute();
		  $sqlismainaccessuserinv = $sqlismainaccessuserinvs->get_result();
		  $infomainaccessuserinv=$sqlismainaccessuserinv->fetch_array();
		  $sqlismainaccessuserinv->close();
		  $sqlismainaccessuserinvs->close();
		  //FOR GET INVOICE MODULE NAME
		  $dateformats=$con->prepare("SELECT * FROM paricountry");
		  $dateformats->execute();
		  $dateformat = $dateformats->get_result();
		  $datefetch=$dateformat->fetch_array();
		  if ($datefetch['date']=='DD/MM/YYYY') {
				$date = 'd/m/Y';
		  }
		  $dateformat->close();
		  $dateformats->close();
		  //FOR DATE FORMATING
		  if($purchasereturnno!=''){
				if($purchasereturninfoch!=''){
					 $purchasereturninfoch.='<br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$purchasereturnno.' ) </span>';
				}
				else{
					 $purchasereturninfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$purchasereturnno.' ) </span>';
				}                   
		  }
		  if($invnumber!=''){
				if($purchasereturninfoch!=''){
					 $purchasereturninfoch.='<br> Invoice Number <span style="color:green;" id="prohisfromtospan">( '.$invnumber.' ) </span>';
				}
				else{
					 $purchasereturninfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Invoice Number <span style="color:green;" id="prohisfromtospan">( '.$invnumber.' ) </span>';
				}                   
		  }
		  if($purchasereturndate!=''){
				if($purchasereturninfoch!=''){
					 $purchasereturninfoch.='<br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($purchasereturndate)).' ) </span>';
				}
				else{
					 $purchasereturninfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($purchasereturndate)).' ) </span>';
				}                   
		  }
		  if($reference!=''){
				if($purchasereturninfoch!=''){
					 $purchasereturninfoch.='<br> Reference <span style="color:green;" id="prohisfromtospan">( '.$reference.' ) </span>';
				}
				else{
					 $purchasereturninfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Reference <span style="color:green;" id="prohisfromtospan">( '.$reference.' ) </span>';
				}                   
		  }
		  if($saleperson!=''){
				if($purchasereturninfoch!=''){
					 $purchasereturninfoch.='<br> Sale Person <span style="color:green;" id="prohisfromtospan">( '.$saleperson.' ) </span>';
				}
				else{
					 $purchasereturninfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Sale Person <span style="color:green;" id="prohisfromtospan">( '.$saleperson.' ) </span>';
				}                   
		  }
		  if($preparedby!=''){
				if($purchasereturninfoch!=''){
					 $purchasereturninfoch.='<br> Prepared By <span style="color:green;" id="prohisfromtospan">( '.$preparedby.' ) </span>';
				}
				else{
					 $purchasereturninfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Prepared By <span style="color:green;" id="prohisfromtospan">( '.$preparedby.' ) </span>';
				}                   
		  }
		  if($checkedby!=''){
				if($purchasereturninfoch!=''){
					 $purchasereturninfoch.='<br> Checked By <span style="color:green;" id="prohisfromtospan">( '.$checkedby.' ) </span>';
				}
				else{
					 $purchasereturninfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Checked By <span style="color:green;" id="prohisfromtospan">( '.$checkedby.' ) </span>';
				}                   
		  }
		  if($invgrandtotal!=''){
				if($purchasereturninfoch!=''){
					 $purchasereturninfoch.='<br> Grand Total <span style="color:green;" id="prohisfromtospan">( '.$invgrandtotal.' ) </span>';
				}
				else{
					 $purchasereturninfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Grand Total <span style="color:green;" id="prohisfromtospan">( '.$invgrandtotal.' ) </span>';
				}                   
		  }
		  //FOR PURCHASERETURN INFORMATIONS HISTORY DETAILS
		  $purreturnveninfoch = '';
		  $sqlismainaccessuservens=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Vendors' ORDER BY id ASC");
		  $sqlismainaccessuservens->bind_param("s", $userid);
		  $sqlismainaccessuservens->execute();
		  $sqlismainaccessuserven = $sqlismainaccessuservens->get_result();
		  $infomainaccessuserven=$sqlismainaccessuserven->fetch_array();
		  $sqlismainaccessuserven->close();
		  $sqlismainaccessuservens->close();
		  if($vendorname!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> '.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$vendorname.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> '.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$vendorname.' ) </span>';
				}                   
		  }
		  if($area!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> PURCHASERETURNING STREET <span style="color:green;" id="prohisfromtospan">( '.$area.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> PURCHASERETURNING STREET <span style="color:green;" id="prohisfromtospan">( '.$area.' ) </span>';
				}                   
		  }
		  if($city!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> PURCHASERETURNING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( '.$city.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> PURCHASERETURNING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( '.$city.' ) </span>';
				}                   
		  }
		  if($state!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> PURCHASERETURNING STATE <span style="color:green;" id="prohisfromtospan">( '.$state.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> PURCHASERETURNING STATE <span style="color:green;" id="prohisfromtospan">( '.$state.' ) </span>';
				}                   
		  }
		  if($district!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> PURCHASERETURNING PIN <span style="color:green;" id="prohisfromtospan">( '.$district.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> PURCHASERETURNING PIN <span style="color:green;" id="prohisfromtospan">( '.$district.' ) </span>';
				}                   
		  }
		  if($pincode!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> PURCHASERETURNING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( '.$pincode.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> PURCHASERETURNING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( '.$pincode.' ) </span>';
				}                   
		  }
		  if($sarea!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> SHIPPING STREET <span style="color:green;" id="prohisfromtospan">( '.$sarea.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING STREET <span style="color:green;" id="prohisfromtospan">( '.$sarea.' ) </span>';
				}                   
		  }
		  if($scity!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> SHIPPING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( '.$scity.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( '.$scity.' ) </span>';
				}                   
		  }
		  if($sstate!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> SHIPPING STATE <span style="color:green;" id="prohisfromtospan">( '.$sstate.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING STATE <span style="color:green;" id="prohisfromtospan">( '.$sstate.' ) </span>';
				}                   
		  }
		  if($sdistrict!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> SHIPPING PIN <span style="color:green;" id="prohisfromtospan">( '.$sdistrict.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING PIN <span style="color:green;" id="prohisfromtospan">( '.$sdistrict.' ) </span>';
				}                   
		  }
		  if($spincode!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> SHIPPING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( '.$spincode.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( '.$spincode.' ) </span>';
				}                   
		  }
		  if($twoworkphone!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> WORK PHONE <span style="color:green;" id="prohisfromtospan">( '.$twoworkphone.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> WORK PHONE <span style="color:green;" id="prohisfromtospan">( '.$twoworkphone.' ) </span>';
				}                   
		  }
		  if($twomobilephone!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> MOBILE PHONE <span style="color:green;" id="prohisfromtospan">( '.$twomobilephone.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> MOBILE PHONE <span style="color:green;" id="prohisfromtospan">( '.$twomobilephone.' ) </span>';
				}                   
		  }
		  if($gstrtype!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> GST TREATMENT <span style="color:green;" id="prohisfromtospan">( '.$gstrtype.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> GST TREATMENT <span style="color:green;" id="prohisfromtospan">( '.$gstrtype.' ) </span>';
				}                   
		  }
		  if($gstno!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> GSTIN <span style="color:green;" id="prohisfromtospan">( '.$gstno.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> GSTIN <span style="color:green;" id="prohisfromtospan">( '.$gstno.' ) </span>';
				}                   
		  }
		  if($pos!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> PLACE OF SUPPLY <span style="color:green;" id="prohisfromtospan">( '.$pos.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> PLACE OF SUPPLY <span style="color:green;" id="prohisfromtospan">( '.$pos.' ) </span>';
				}                   
		  }
		  if($dlno20!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> DL No 20 <span style="color:green;" id="prohisfromtospan">( '.$dlno20.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> DL No 20 <span style="color:green;" id="prohisfromtospan">( '.$dlno20.' ) </span>';
				}                   
		  }
		  if($dlno21!=''){
				if($purreturnveninfoch!=''){
					 $purreturnveninfoch.='<br> DL No 21 <span style="color:green;" id="prohisfromtospan">( '.$dlno21.' ) </span>';
				}
				else{
					 $purreturnveninfoch.=''.(($purchasereturninfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> DL No 21 <span style="color:green;" id="prohisfromtospan">( '.$dlno21.' ) </span>';
				}                   
		  }
		  //FOR PURCHASERETURN VENDOR INFORMATIONS DETAILS HISTORY
		  $purchasereturniteminfoch = '';
		  $sqlismainaccessuserpros=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Products' ORDER BY id ASC");
		  $sqlismainaccessuserpros->bind_param("s", $userid);
		  $sqlismainaccessuserpros->execute();
		  $sqlismainaccessuserpro = $sqlismainaccessuserpros->get_result();
		  $infomainaccessuserpro=$sqlismainaccessuserpro->fetch_array();
		  $sqlismainaccessuserpro->close();
		  $sqlismainaccessuserpros->close();
		  for($i=0; $i<count($_POST['productname']); $i++){
				$productid=htmlspecialchars($_POST['productid'][$i], ENT_QUOTES, 'UTF-8');
				$productname=htmlspecialchars($_POST['productname'][$i], ENT_QUOTES, 'UTF-8');
				$manufacturer=htmlspecialchars($_POST['manufacturer'][$i], ENT_QUOTES, 'UTF-8');
				$producthsn=htmlspecialchars($_POST['producthsn'][$i], ENT_QUOTES, 'UTF-8');
				$productnotes=htmlspecialchars($_POST['productnotes'][$i], ENT_QUOTES, 'UTF-8');
				$productdescription=htmlspecialchars($_POST['productdescription'][$i], ENT_QUOTES, 'UTF-8');
				$itemmodule=htmlspecialchars($_POST['itemmodule'][$i], ENT_QUOTES, 'UTF-8');
				$rack=htmlspecialchars($_POST['rack'][$i], ENT_QUOTES, 'UTF-8');
				if ($access['batchexpiryval']==1) {
					 $batch=htmlspecialchars($_POST['batch'][$i], ENT_QUOTES, 'UTF-8');
					 $expdate=htmlspecialchars($_POST['expdate'][$i], ENT_QUOTES, 'UTF-8');
				}
				else{
					 $batch='';
					 $expdate='';
				}
				$mrp=htmlspecialchars( (($_POST['mrp'][$i]!='')?$_POST['mrp'][$i]:0), ENT_QUOTES, 'UTF-8');
				$vat=htmlspecialchars($_POST['vat'][$i], ENT_QUOTES, 'UTF-8');
				$quantity=htmlspecialchars($_POST['quantity'][$i], ENT_QUOTES, 'UTF-8');
				$unit=htmlspecialchars($_POST['productunit'][$i], ENT_QUOTES, 'UTF-8');
				$productrate=htmlspecialchars($_POST['productrate'][$i], ENT_QUOTES, 'UTF-8');
				$noofpacks=htmlspecialchars($_POST['noofpacks'][$i], ENT_QUOTES, 'UTF-8');
				$prodiscount=htmlspecialchars($_POST['prodiscount'][$i], ENT_QUOTES, 'UTF-8');
				$prodiscounttype=htmlspecialchars($_POST['prodiscounttype'][$i], ENT_QUOTES, 'UTF-8');
				$productvalue=htmlspecialchars($_POST['productvalue'][$i], ENT_QUOTES, 'UTF-8');
				$taxvalue=htmlspecialchars($_POST['taxvalue'][$i], ENT_QUOTES, 'UTF-8');
				$productnetvalue=htmlspecialchars($_POST['productnetvalue'][$i], ENT_QUOTES, 'UTF-8');
				$salequantity=htmlspecialchars($_POST['salequantity'][$i], ENT_QUOTES, 'UTF-8');
				$productwithouttax=htmlspecialchars($_POST['productwithouttax'][$i], ENT_QUOTES, 'UTF-8');
				$productwithtax=htmlspecialchars($_POST['productwithtax'][$i], ENT_QUOTES, 'UTF-8');
				if($productname!=''){
					 if($productname!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$productname.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$productname.' ) </span>';
						  }                   
					 }
					 if($manufacturer!=' '){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( '.$manufacturer.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( '.$manufacturer.' ) </span>';
						  }                   
					 }
					 if($producthsn!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> HSN Code <span style="color:green;" id="prohisfromtospan">( '.$producthsn.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> HSN Code <span style="color:green;" id="prohisfromtospan">( '.$producthsn.' ) </span>';
						  }                   
					 }
					 if($productdescription!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( '.$productdescription.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( '.$productdescription.' ) </span>';
						  }                   
					 }
					 if($batch!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Batch <span style="color:green;" id="prohisfromtospan">( '.$batch.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Batch <span style="color:green;" id="prohisfromtospan">( '.$batch.' ) </span>';
						  }                   
					 }
					 if($expdate!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Expiry <span style="color:green;" id="prohisfromtospan">( '.$expdate.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Expiry <span style="color:green;" id="prohisfromtospan">( '.$expdate.' ) </span>';
						  }                   
					 }
					 if($productrate!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Rate <span style="color:green;" id="prohisfromtospan">( '.$productrate.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Rate <span style="color:green;" id="prohisfromtospan">( '.$productrate.' ) </span>';
						  }                   
					 }
					 if($mrp!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Mrp <span style="color:green;" id="prohisfromtospan">( '.$mrp.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Mrp <span style="color:green;" id="prohisfromtospan">( '.$mrp.' ) </span>';
						  }                   
					 }
					 if($quantity!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Quantity <span style="color:green;" id="prohisfromtospan">( '.$quantity.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Quantity <span style="color:green;" id="prohisfromtospan">( '.$quantity.' ) </span>';
						  }                   
					 }
					 if($unit!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Unit <span style="color:green;" id="prohisfromtospan">( '.$unit.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Unit <span style="color:green;" id="prohisfromtospan">( '.$unit.' ) </span>';
						  }                   
					 }
					 if($noofpacks!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Pack <span style="color:green;" id="prohisfromtospan">( '.$noofpacks.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Pack <span style="color:green;" id="prohisfromtospan">( '.$noofpacks.' ) </span>';
						  }                   
					 }
					 if($productvalue!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Taxable Value <span style="color:green;" id="prohisfromtospan">( '.$productvalue.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Taxable Value <span style="color:green;" id="prohisfromtospan">( '.$productvalue.' ) </span>';
						  }                   
					 }
					 if($prodiscount!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> '.$access['txtprodispurchasereturn'].' <span style="color:green;" id="prohisfromtospan">( '.$prodiscount.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtprodispurchasereturn'].' <span style="color:green;" id="prohisfromtospan">( '.$prodiscount.' ) </span>';
						  }                   
					 }
					 if($prodiscounttype!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Discounted By <span style="color:green;" id="prohisfromtospan">( '.(($prodiscounttype==0)?'%':'?').' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discounted By <span style="color:green;" id="prohisfromtospan">( '.(($prodiscounttype==0)?'%':'?').' ) </span>';
						  }                   
					 }
					 if($taxvalue!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Tax Value <span style="color:green;" id="prohisfromtospan">( '.$taxvalue.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Tax Value <span style="color:green;" id="prohisfromtospan">( '.$taxvalue.' ) </span>';
						  }                   
					 }
					 if($vat!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Gst <span style="color:green;" id="prohisfromtospan">( '.$vat.' % ('.$ansforsepgstval.') ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Gst <span style="color:green;" id="prohisfromtospan">( '.$vat.' % ('.$ansforsepgstval.') ) </span>';
						  }                   
					 }
					 if($productnetvalue!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Amount <span style="color:green;" id="prohisfromtospan">( '.$productnetvalue.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Amount <span style="color:green;" id="prohisfromtospan">( '.$productnetvalue.' ) </span>';
						  }                   
					 }
					 if($salequantity!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> '.($access['purreturntxtsqty']).' <span style="color:green;" id="prohisfromtospan">( '.$salequantity.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.($access['purreturntxtsqty']).' <span style="color:green;" id="prohisfromtospan">( '.$salequantity.' ) </span>';
						  }                   
					 }
					 if($productwithouttax!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( '.$productwithouttax.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( '.$productwithouttax.' ) </span>';
						  }                   
					 }
					 if($productwithtax!=''){
						  if($purchasereturniteminfoch!=''){
								$purchasereturniteminfoch.='<br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( '.$productwithtax.' ) </span>';
						  }
						  else{
								$purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( '.$productwithtax.' ) </span>';
						  }                   
					 }
				}
		  }
		  //FOR PRODUCT ALL ROWS HISTORY IN LOOPING
		  if($totalitems!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Total Items <span style="color:green;" id="prohisfromtospan">( '.$totalitems.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Items <span style="color:green;" id="prohisfromtospan">( '.$totalitems.' ) </span>';
				}                   
		  }
		  if($totalquantity!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Total Qty <span style="color:green;" id="prohisfromtospan">( '.$totalquantity.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Qty <span style="color:green;" id="prohisfromtospan">( '.$totalquantity.' ) </span>';
				}                   
		  }
		  if($totalamount!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Sub Total <span style="color:green;" id="prohisfromtospan">( '.$totalamount.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sub Total <span style="color:green;" id="prohisfromtospan">( '.$totalamount.' ) </span>';
				}                   
		  }
		  if($discountamount!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Discount <span style="color:green;" id="prohisfromtospan">( '.$discountamount.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discount <span style="color:green;" id="prohisfromtospan">( '.$discountamount.' ) </span>';
				}                   
		  }
		  if($totalvatamount!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Total Tax <span style="color:green;" id="prohisfromtospan">( '.$totalvatamount.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Tax <span style="color:green;" id="prohisfromtospan">( '.$totalvatamount.' ) </span>';
				}                   
		  }
		  if($roundoff!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Round Off <span style="color:green;" id="prohisfromtospan">( '.$roundoff.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Round Off <span style="color:green;" id="prohisfromtospan">( '.$roundoff.' ) </span>';
				}                   
		  }
		  if($grandtotal!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Grand Total <span style="color:green;" id="prohisfromtospan">( '.$grandtotal.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Grand Total <span style="color:green;" id="prohisfromtospan">( '.$grandtotal.' ) </span>';
				}                   
		  }
		  if($description!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( '.$description.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( '.$description.' ) </span>';
				}                   
		  }
		  if($notes!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
				}                   
		  }
		  if($terms!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Terms And Conditions <span style="color:green;" id="prohisfromtospan">( '.$terms.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Terms And Conditions <span style="color:green;" id="prohisfromtospan">( '.$terms.' ) </span>';
				}                   
		  }
		  if($fileattach!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Attach <span style="color:green;" id="prohisfromtospan">( Added ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Attach <span style="color:green;" id="prohisfromtospan">( Added ) </span>';
				}                   
		  }
		  if($purchasereturnterm!=''){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Payment Term <span style="color:green;" id="prohisfromtospan">( '.$purchasereturnterm.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Payment Term <span style="color:green;" id="prohisfromtospan">( '.$purchasereturnterm.' ) </span>';
				}                   
		  }
		  if($validpaidamount!=''&&$purchasereturnterm=='CASH'){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Paid Amount <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Paid Amount <span style="color:green;" id="prohisfromtospan">( '.$validpaidamount.' ) </span>';
				}                   
		  }
		  if($validbalance!=''&&$purchasereturnterm=='CASH'){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Balance Due <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Balance Due <span style="color:green;" id="prohisfromtospan">( '.$validbalance.' ) </span>';
				}                   
		  }
		  if($duedates!=''&&$purchasereturnterm=='CREDIT'){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Due Term <span style="color:green;" id="prohisfromtospan">( '.$duedates.' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Due Term <span style="color:green;" id="prohisfromtospan">( '.$duedates.' ) </span>';
				}                   
		  }
		  if($duedate!=''&&$purchasereturnterm=='CREDIT'){
				if($purchasereturniteminfoch!=''){
					 $purchasereturniteminfoch.='<br> Due Date <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($duedate)).' ) </span>';
				}
				else{
					 $purchasereturniteminfoch.=''.(($purchasereturninfoch!=''||$purreturnveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Due Date <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($duedate)).' ) </span>';
				}                   
		  }
		  //FOR PURCHASERETURN OTHER INFORMATIONS LIKE PAYMENT AND TERMS AND DESCRIPTION......
		  $purchasereturntotinfoch = "PURCHASERETURN CREATED<br>".$purchasereturninfoch.$purreturnveninfoch.$purchasereturniteminfoch;
		  if($purchasereturntotinfoch!=''){
				$sqluse = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,uniqueid,useremarks) VALUES ('PURCHASERETURNS', ?, ?, ?, ?, ?)");
				$sqluse->bind_param("sssss", $times, $_SESSION["unqwerty"], $purchasereturnno, $purchaseid, $purchasereturntotinfoch);
				$sqluse->execute();
				$sqluse->close();
		  }
		  //FOR PURCHASERETURN HISTORY
		  $sqlipurchasereturns=$con->prepare("SELECT purchasereturnamount, purchasereturndate, purchasereturnno FROM pairpurchasereturns WHERE franchisesession=? AND createdid=? AND vendorid=? GROUP BY purchasereturndate, purchasereturnno ORDER BY purchasereturndate DESC, purchasereturnno DESC");
		  $sqlipurchasereturns->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $vendorid);
		  $sqlipurchasereturns->execute();
		  $sqlipurchasereturn = $sqlipurchasereturns->get_result();
		  $purchasereturnamount=0;
		  $balanceamount=0;
		  $currentamount=0;
		  $overdueamount=0;
		  while($infopurchasereturn=$sqlipurchasereturn->fetch_array()){
				$purchasereturnamount+=(float)$infopurchasereturn['purchasereturnamount'];
				$paidamount=0;
				$sqlpurchasespays=$con->prepare("SELECT amount FROM pairpurchasereturnpayhistory WHERE franchisesession=? AND createdid=? AND purchasereturnno=? AND purchasereturndate=? AND vendorid=? ORDER BY id ASC");
				$sqlpurchasespays->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $infopurchasereturn['purchasereturnno'], $infopurchasereturn['purchasereturndate'], $vendorid);
				$sqlpurchasespays->execute();
				$sqlpurchasespay = $sqlpurchasespays->get_result();
				while($infopurchasespay=$sqlpurchasespay->fetch_array()){
					 $paidamount+=(float)$infopurchasespay['amount'];
				}
				$balanceamount+=((float)$infopurchasereturn['purchasereturnamount']-$paidamount);
				$diff = abs(time() - strtotime($infopurchasereturn['purchasereturndate']));
				$days = floor(($diff)/ (60*60*24));
				if($days>30){
					 $overdueamount+=((float)$infopurchasereturn['purchasereturnamount']-$paidamount);
				}
				else{
					 $currentamount+=((float)$infopurchasereturn['purchasereturnamount']-$paidamount);
				}
				$sqlpurchasespay->close();
				$sqlpurchasespays->close();
		  }
		  $sqlipurchasereturn->close();
		  $sqlipurchasereturns->close();
		  $cussqlup = $con->prepare("UPDATE paircustomers SET invoiceamount=?, balanceamount=?, currentamount=?, overdueamount=? WHERE id=?");
		  $cussqlup->bind_param("ssssi", $purchasereturnamount, $balanceamount, $currentamount, $overdueamount, $vendorid);
		  $cussqlup->execute();
		  $cussqlup->close();
		  //FOR UPDATE THE VENDOR BALANCE AND OTHER PAYMENT INFORMATIONS
		  if(isset($_POST['submit1'])){
				echo '<script> window.open("purchasereturnprint.php?purchasereturnno='.$purchasereturnno.'&purchasereturndate='.$purchasereturndate.'", "_blank");</script>';
				echo '<script> window.location.href="purchasereturns.php?remarks=Added Successfully";</script>'; 
		  }
		  else{
				$sqluse = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,uniqueid,useremarks) VALUES ('PURCHASERETURNS', ?, ?, ?, ?, '<span style=\"color:green;\" id=\"prohisfromtospan\">Added Successfully</span>')");
				$sqluse->bind_param("ssss", $times, $_SESSION["unqwerty"], $purchasereturnno, $purchaseid);
				$sqluse->execute();
				$sqluse->close();
				echo '<script> window.location.href="purchasereturnview.php?id='.$purchaseid.'&purchasereturnno='.$purchasereturnno.'&purchasereturndate='.$purchasereturndate.'&remarks=Added Successfully";</script>';
		  }
	 }
	 else{
		  header("Location: purchasereturns.php?error=Error Data");
		  //FOR IF THE PURCHASERETURN IS ALREADY EXISTS IN THIS NUMBER AND DATE AND FRANCHISE AND COMPANY
	 }
}
$sqlismainaccessuservens=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Vendors' ORDER BY id ASC");
$sqlismainaccessuservens->bind_param("s", $userid);
$sqlismainaccessuservens->execute();
$sqlismainaccessuserven = $sqlismainaccessuservens->get_result();
$infomainaccessuserven=$sqlismainaccessuserven->fetch_array();
$sqlismainaccessuserven->close();
$sqlismainaccessuservens->close();
//FOR GET VENDOR MODULENAME AND OTHER DETAILS
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
		  New <?= $infomainaccessuser['modulename'] ?>
	 </title>
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6">
	 <div id="loadimgbiggerscrrbackgrey" style="display:none;z-index: 10;width: 100%;height: 100%;position: absolute;background-color: #7f7f7f;opacity: 0.5;"></div>
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
		  $sqlismainaccessusers=$con->prepare("SELECT moduleno, moduleprefix, modulesuffix,modulename FROM pairmainaccess WHERE franchiseid=? AND moduletype='Purchase Returns' ORDER BY id ASC");
		  $sqlismainaccessusers->bind_param("s", $_SESSION['franchisesession']);
		  $sqlismainaccessusers->execute();
		  $sqlismainaccessuser = $sqlismainaccessusers->get_result();
		  $infomainaccessuser=$sqlismainaccessuser->fetch_array();
		  $sqlismainaccessuser->close();
		  $sqlismainaccessusers->close();
	 ?>
	 <!-- FOR PURCHASERETURN MODULE INFORMATIONS AND PREFERENCES -->
		  <div style="max-width: 1650px;">
				<div class="row min-height-480">
					 <div class="col-12">
						  <div class="card mb-4 mt-5">
								<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
									 <p style="font-size:20px;margin-top: -9px !important;margin-bottom: 6px !important;">
										  <i class="fa fa-file-import"></i> New <?= $infomainaccessuser['modulename'] ?>
									 </p>
								<?php
									 $sqlismainaccessusers=$con->prepare("SELECT moduleno, moduleprefix, modulesuffix,modulename FROM pairmainaccess WHERE franchiseid=? AND moduletype='Purchase Returns' ORDER BY id ASC");
									 $sqlismainaccessusers->bind_param("s", $_SESSION['franchisesession']);
									 $sqlismainaccessusers->execute();
									 $sqlismainaccessuser = $sqlismainaccessusers->get_result();
									 $infomainaccessuser=$sqlismainaccessuser->fetch_array();
									 $sqlismainaccessuser->close();
									 $sqlismainaccessusers->close();
									 if($infomainaccessuser['moduleno']!='1'){
									 // IF THE FILE WAS DISABLED BY THE FRANCHISE
								?>
									 <div class="alert alert-danger mt-2 text-white">
										  Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise
									 </div>
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
									 <hr class="p-0 mb-1 mt-1">
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
																	 <button onclick="funaddproduct()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit"  name="submitproduct" id="submitproduct" value="Submit">
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
									 <div class="modal fade" id="Viewfrequentproduct" tabindex="-1" role="dialog">
										  <div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													 <div class="modal-header">
														  <h5 class="modal-title" id="exampleModalLabel">
																Frequently Purchased <?=$infomainaccessuserpro['modulename']?>
														  </h5>
														  <span type="button" onclick="funesfrequentproduct()" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true" id="procloseicon">&times;</span>
														  </span>
													 </div>
													 <form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-0" role="form">
														  <div class="modal-body mbsub">
														  <?php
																include("frequentproductbill.php");
														  ?>
														  </div>
														  <div class="modal-footer mfsub" style="margin: 0px 9px !important;border-top: 1px solid #b6bcc5 !important;">
														  </div>
													 </form>
												</div>
										  </div>
									 </div>
									 <!-- FREQUENT PRODUCT MODAL -->
									 <div class="modal fade" id="Viewcustdetails" tabindex="-1" role="dialog">
										  <div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													 <div class="modal-header">
														  <h5 class="modal-title" id="exampleModalLabel">
																<?=$infomainaccessuserven['modulename']?> Details
														  </h5>
														  <span type="button" onclick="funesvendorview()" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true" id="procloseicon">&times;</span>
														  </span>
													 </div>
													 <form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-0" role="form">
														  <div class="modal-body mbsub">
														  <?php
																include("vendorviewmodal.php");
														  ?>
														  </div>
														  <div class="modal-footer mfsub" style="margin: 0px 9px !important;border-top: 1px solid #b6bcc5 !important;">
														  </div>
													 </form>
												</div>
										  </div>
									 </div>
									 <!-- VENDOR VIEW MODAL -->
									 <link href="customeradd.css" rel="stylesheet">
									 <div class="modal fade" id="custAddNewVendor" tabindex="-1" role="dialog">
										  <div class="modal-dialog modal-lg" role="document">
												<div class="modal-content" style="border-radius: 0px;">
													 <div class="modal-header" style="border-radius:0px !important;">
														  <h5 class="modal-title" style="color:#212529;">
																New <?= $infomainaccessuserven['modulename'] ?>
														  </h5>
														  <span type="button" onclick="funesvendor()" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true" style="font-size: 21px;font-weight: 600;">
																	 &times;
																</span>
														  </span>
													 </div>
													 <form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">
														  <div class="modal-body" id="custmodal" style="padding-bottom: 0px !important;margin-bottom: -24.5px !important;">
														  <?php
																include("vendoraddmodal.php");
														  ?>
														  </div>
														  <div class="modal-footer " style="display: block;margin-bottom: -14.5px;">
																<div class="col">
																	 <button onclick="funaddvendor()"  class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="custsubmitvendor" id="custsubmitvendor" value="Submit">
																		  <span class="label">Save</span>
																		  <span class="spinner"></span>
																	 </button>
																	 <button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funesvendor()">
																		  Cancel
																	 </button>
																</div>
														  </div>
													 </form>
												</div>
										  </div>
									 </div>
									 <!-- VENDOR ADD MODAL -->
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
})
function stringMatch(term, candidate) {
	 return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
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
// FOR SELECT2 ASSIGING
</script>
<?php
	 include('fexternals.php');
	 // FOR COMMON JAVASCRIPT FILES AND SOURCES
?>
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
	 // FOR VENDOR ADD MODAL SAMES AS PURCHASERETURNING CHECKBOX
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
// FOR VENDOR ADD MODAL TAX PREFERENCE RADIO BUTTONS
function showDiv(element){
	 if (element.value == '') {
		  document.getElementById('custgstblock').style.display = 'none';
		  document.getElementById('custplaceofsupply').style.display = 'block';
	 }
	 else if (element.value == 'Registered Business - Regular') {
		  document.getElementById('custgstblock').style.display = 'block';
		  document.getElementById('custplaceofsupply').style.display = 'block';
	 }
	 else if (element.value == 'Registered Business - Composition') {
		  document.getElementById('custgstblock').style.display = 'block';
		  document.getElementById('custplaceofsupply').style.display = 'block';
	 }
	 else if (element.value == 'Unregistered Business') {
		  document.getElementById('custgstblock').style.display = 'none';
	 }
	 else if (element.value == 'Consumer') {
		  document.getElementById('custgstblock').style.display = 'none';
	 }
	 else if (element.value == 'Overseas') {
		  document.getElementById('custplaceofsupply').style.display = 'none';
		  document.getElementById('custgstblock').style.display = 'none';
	 }
	 else if (element.value == 'Special Economic Zone') {
		  document.getElementById('custplaceofsupply').style.display = 'block';
		  document.getElementById('custgstblock').style.display = 'block';
	 }
	 else if (element.value == 'Deemed Export') {
		  document.getElementById('custplaceofsupply').style.display = 'block';
		  document.getElementById('custgstblock').style.display = 'block';
	 }
	 else if (element.value == 'Tax Deductor') {
		  document.getElementById('custplaceofsupply').style.display = 'block';
		  document.getElementById('custgstblock').style.display = 'block';
	 }
	 else if (element.value == 'SEZ Developer') {
		  document.getElementById('custplaceofsupply').style.display = 'block';
		  document.getElementById('custgstblock').style.display = 'block';
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
// FOR VENDOR ADD MODAL GST TYPE CONCEPTS
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
// FOR NEW CATEGORY IN VENDOR ADD MODAL
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
// FOR NEW SUBCATEGORY IN VENDOR ADD MODAL
$("#vendor").on("select2:open", function() {
	 $("#configureunits").attr("data-bs-target","#custAddNewVendor");
	 $("#configureunits").show();
});
$("#vendor").on("select2:open", function() {
<?php
	 if($access['purreturnnewvendordef']=='1'){
?>
	 $("#configureunits").show();
	 document.getElementById("configureunits").innerHTML = "New <?= $infomainaccessuserven['modulename'] ?>";
<?php
	 }
	 else{
?>
	 $("#configureunits").hide();
<?php
	 }
?>
});
$("#product1").on("select2:open", function() {
	 $("#configureunits").attr("data-bs-target","#AddNewProduct");
	 $("#configureunits").show();
});
$("#product1").on("select2:open", function() {
<?php
	 if($access['purreturnnewproductdef']=='1'){
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
// FOR SELECT NEW WORD AND PATHS
function funaddvendor() {
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
		  $('#custvendor').append('<option value="' + custcustomerdname.value + '">' + custcustomerdname.value + '</option>');
		  $('#custvendor').val(custcustomerdname.value).change();
		  $('#custAddNewVendor').modal('hide');
		  return false;
	 }
}
function funesvendor() {
	 $('#custvendor').val('').change();
	 $('#custAddNewVendor').modal('hide');
	 return false;
}
$(document).ready(function(){
	 $("#custsubmitvendor").click(function(e){
		  e.preventDefault();
		  var custvendordname=$("#custcustomerdname").val();
		  var custgsttype = document.getElementById("custgstrtype");
		  var custgsttypeans = custgsttype.options[custgsttype.selectedIndex].text;
		  var custpos = document.getElementById("custpos");
		  var custposans = custpos.options[custpos.selectedIndex].text;
		  var custgstin = $("#custgstin").val();
		  if(custvendordname==""||custgsttypeans=="Select Type of Add"||(custposans=="Select The Place"&&custgsttypeans!="Overseas")||((custgsttypeans=="Registered Business - Regular"||custgsttypeans=="Registered Business - Composition"||custgsttypeans=="Special Economic Zone"||custgsttypeans=="Deemed Export"||custgsttypeans=="Tax Deductor"||custgsttypeans=="SEZ Developer")&&custgstin=='')){
				if (custvendordname == '') {
					 alert("Please Enter the <?= $infomainaccessuserven['modulename'] ?> Name");
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
					 url: "vendoradds.php",
					 data: {
						  vendorcode: $("#custcustomercode").val(),
						  landline: $("#custlandline").val(),
						  cstno: $("#custcstno").val(),
						  vendorid: $("#custcustomerid").val(),
						  publiccode: $("#custpubliccode").val(),
						  privatecode: $("#custprivatecode").val(),
						  salute: $("#custsalute").val(),
						  pcontact: $("#custpcontact").val(),
						  companyname: $("#custcompanyname").val(),
						  vendordname: $("#custcustomerdname").val(),
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
								url: "vendoraddmodal.php",
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
								var custvendordname=$("#custoriginpage").val();
								var billcity=$("#custbillcity").val();
								var mobilephone=$("#custmobilephone").val();
								$('#vendor').append('<option value="' + resarray[1] + '">' + custvendordname + '</option>');
								$('select[name^="vendor"] option[value="' + resarray[1] + '"]').attr("selected","selected");
								$('#vendor').val(resarray[1]).change();
								$('#custAddNewVendor').modal('hide');
						  }
					 }
				});
		  }
	 });
});
// FOR NEW VENDOR
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
						  $("#productwithouttaxspan"+lineNo).css('display', 'inline');
						  $("#productwithouttaxval"+lineNo).html('0');
						  $("#productwithouttax"+lineNo).val('0');
						  $("#productwithouttax"+lineNo).css('display', 'none');
						  $("#productwithouttaxval"+lineNo).css('display', 'inline');
						  $("#productwithouttaxedit"+lineNo).css('display', 'inline');
						  $("#productwithouttaxupdate"+lineNo).css('display', 'none');
						  $("#productwithtaxspan"+lineNo).css('display', 'inline');
						  $("#productwithtaxval"+lineNo).html('0');
						  $("#productwithtax"+lineNo).val('0');
						  $("#productwithtax"+lineNo).css('display', 'none');
						  $("#productwithtaxval"+lineNo).css('display', 'inline');
						  $("#productwithtaxedit"+lineNo).css('display', 'inline');
						  $("#productwithtaxupdate"+lineNo).css('display', 'none');
						  // var btndel = document.getElementsByName('productname[]');
						  // var btndels = document.getElementsByName('product[]');
						  // if ((btndel.length>1)||(btndel[0].value!='')) {
						  //  for(i=0;i<btndel.length;i++){
						  //      if (btndels[i].value!=0) {
						  //          var ids = btndel[i].id.split('productname');
						  //          var id = ids[1];
						  //          productcalc(id);
						  //      }
						  //  }
						  // }
						  // else{
						  //  document.getElementById('totalitems').value=0;
						  //  document.getElementById('totalquantity').value=0;
						  //  document.getElementById('totalamount').value=0;
						  //  document.getElementById('totalvatamount').value=0;
						  //  document.getElementById('roundoff').value=0;
						  //  document.getElementById('grandtotal').value=0;
						  //  document.getElementById('grandtotalfixed').value=0;
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
		  markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td class="tdmove"><svg version="1.1" id="Layer_'+lineNo+'" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="ITEM DETAILS" style="padding-top: 1px !important;<?=(in_array('Item Details', $fieldadd))?'':'display:none !important;'?>"><input type="hidden" name="productid[]" id="productid'+lineNo+'"><input type="hidden" name="productname[]" id="productname'+lineNo+'"><div class="col-sm-9" onclick="andus()" style="width:278px;display: inline-block;" id="selecttheproduct"><select class="form-control  form-control-sm product proitemselect product1 proselect2" name="product[]" id="product'+lineNo+'"  onChange="productchange('+lineNo+')"><option value="" selected disabled>Select</option></select></div><span class="badge" style="display:none; width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan'+lineNo+'"></span><br><input type="hidden" name="itemmodule[]" id="itemmodule'+lineNo+'"><div <?=(in_array('Category', $fieldadd))?'':'style="display:none !important;"'?>><span id="productmanufacturerspan'+lineNo+'" style="display:none; font-size:11px;"><?=$access['txtnamecategory']?>:<input type="text" name="manufacturer[]" id="manufacturer'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;" readonly onChange="productcalc('+lineNo+')">  <span id="productmanufacturerval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><span id="productmanufactureredit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmanufacturerupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Hsn or Sac', $fieldadd))?'':'style="display:none !important;"'?>><span id="producthsncodespan'+lineNo+'" style="display:none; font-size:11px;">HSN Code:</span><input type="text" name="producthsn[]" id="producthsn'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="producthsncodeval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><span id="producthsncodeedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode('+lineNo+')"><i class="fa fa-edit"></i></span><span id="producthsncodeupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Rack', $fieldadd))?'':'style="display:none !important;"'?>><span id="rackspan'+lineNo+'" style="display:none; font-size:11px;">Rack:</span><span id="rackval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><input type="hidden" name="rack[]" id="rack'+lineNo+'"></div><span <?=(in_array('Product Description', $fieldadd))?'':'style="display:none !important;"'?>><span id="productdescriptionspan'+lineNo+'" style="display:none; font-size:11px;">Description:</span><textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription'+lineNo+'" style="height:50px; display:none;width: 100px !important;"></textarea></span><div class="col-sm-9 totalaccounts account'+lineNo+'" onclick="andus()" style="width:278px;display: none;margin-top: 5.5px !important;" id="selecttheproduct"><select style=" width: 100%;" class="select4 form-control form-control-sm" name="accountname[]" id="accountname'+lineNo+'"><option selected disabled value="">Select</option></select></div></td><td style="display:none"><input type="text" name="productnotes[]" id="productnotes'+lineNo+'" class="form-control form-control-sm proitemselect bordernoneinput"></td><td data-label="BATCH" <?=($access['batchexpiryval']==1)?'':'style="display:none;"'?>><div><input type="text" name="batch[]" id="batch'+lineNo+'" onClick="batchget('+lineNo+');" onFocus="batchget('+lineNo+');"  class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;display:inline;" list="" autocomplete="off"><div id="outfordone'+lineNo+'" class="dvi" style="display:none;width: 250px;"></div><input type="text" id="errbatch'+lineNo+'" style="display:none;"></div><span id="productexpdatespan'+lineNo+'" style="display:none; font-size:11px;">EXPIRY:</span><input type="date" name="expdate[]" id="expdate'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productexpdateval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productexpdateedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productexpdateupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate('+lineNo+')"><i class="fa fa-save"></i></span></td><td data-label="RATE" <?=(in_array('Rate', $fieldadd))?'':'style="display:none !important;"'?>><div><span style="font-size:15px !important;"><?php echo $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productrate[]"    id="productrate'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth productselectadd" onChange="productcalc('+lineNo+')" onClick="rateget('+lineNo+');" onFocus="rateget('+lineNo+');" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;"></div><div <?=(in_array('Mrp', $fieldadd))?'':'style="visibility:hidden !important;"'?>><span id="productmrpspan'+lineNo+'" style="display:none; font-size:11px;">MRP:<input type="number" name="mrp[]" id="mrp'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" onChange="productcalc('+lineNo+')"> <span id="productmrpval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productmrpedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmrpupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp('+lineNo+')"><i class="fa fa-save"></i></span></span></div><div class="dvi invpurchasereturngets" id="invpurchasereturngets'+lineNo+'" style="margin-top:-22px;display: none;width: 250px;border-radius: 0px !important;"><table width="100%"><tr style="border-bottom: none;"><td align="center" style="border-right: 1px solid #cccccc;width: 50% !important;display: inline-block !important;text-align: center;"><span onclick="selfgetfun('+lineNo+',0)" id="invonoff'+lineNo+'">SELF</span></td><td align="center" style="width: 50% !important;display: inline-block !important;text-align: center;"><span onclick="othersgetfun('+lineNo+')" id="purchasereturnonoff'+lineNo+'">OTHERS</span></td><input type="text" style="display: none;" id="selforothers'+lineNo+'" value="self"></tr></table></div><div id="ratelist'+lineNo+'" class="dvi ratedvi" style="display:none;width: 250px;"></div><input type="text" id="errrate'+lineNo+'" style="display:none;"></td><td data-label="<?=($access['txtqtypurchasereturn'])?>" <?=(in_array('Quantity', $fieldadd))?'':'style="display:none !important;"'?>><div><input type="number" min="0" step="0.01" name="quantity[]"  id="quantity'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth" oninput="qtytosqty('+lineNo+')" onClick="qtych('+lineNo+')" onFocus="qtych('+lineNo+')" onChange="productcalc('+lineNo+')" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;display:inline;"></div><div <?=(in_array('Unit', $fieldadd))?'':'style="display:none !important;"'?>><span id="productunitspan'+lineNo+'" style="display:none; font-size:11px;">UNIT:</span><input type="text" name="productunit[]" id="productunit'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')" readonly><span id="productunitval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productunitedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editunit('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productunitupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Pack', $fieldadd))?'':'style="display:none !important;"'?>><span id="productnoofpacksspan'+lineNo+'" style="display:none; font-size:11px;">PACK:</span><input type="text" name="noofpacks[]" id="noofpacks'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productnoofpacksval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productnoofpacksedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productnoofpacksupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks('+lineNo+')"><i class="fa fa-save"></i></span></div></td><td data-label="<?=($access['txttaxablepurchasereturn'])?>" <?=(in_array('Taxable Value', $fieldadd))?'':'style="display:none;"'?>> <div id="ruppeitemtablemobdfs"><span style="font-size:15px !important;"><?php echo $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div><div <?=(in_array('Discount', $fieldadd))?'':'style="display:none !important;"'?>><span id="productprodiscountspan'+lineNo+'" style="display:none; font-size:11px;"><?=$access['txtprodispurchasereturn']?>:<div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect'+lineNo+'"> <div class="input-group-prepend"> <input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 35px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> </div><select name="prodiscounttype[]" id="prodiscounttype'+lineNo+'" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 0px !important;" onChange="productcalc('+lineNo+')"><option value="0">%</option><option value="1"><?php echo $resmaincurrencyans; ?></option></select> </div> <input type="hidden" name="prodisvalueforledger[]" id="prodisvalueforledger'+lineNo+'"><span id="productprodiscountval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productprodiscountedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productprodiscountupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount('+lineNo+')"><i class="fa fa-save"></i></span></span></div></td><td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldadd))?'':'style="display:none;"'?>><div id="ruppeitemtablemobasdf"><span style="font-size:15px !important;"><?php echo $resmaincurrencyans; ?></span><input type="hidden" name="cgstvat[]" id="cgstvat'+lineNo+'"><input type="hidden" name="sgstvat[]" id="sgstvat'+lineNo+'"><input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div><div <?=(in_array('GST Percentage', $fieldadd))?'':'style="display:none !important;"'?>><span id="productvatspan'+lineNo+'" style="display:none; font-size:11px;">GST:<input type="number" min="0" step="0.01" name="vat[]" id="vat'+lineNo+'" class="form-control form-control-sm proitemselect notforfixed" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productvatedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editvat('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productvatupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat('+lineNo+')"><i class="fa fa-save"></i></span></span></div><div <?=(in_array('GST Rupee', $fieldadd))?'':'style="display:none !important;"'?>><span id="productcgstvatspan'+lineNo+'" style="display:none; font-size:11px;">CGST:</span><span id="productcgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productsgstvatspan'+lineNo+'" style="display:none; font-size:11px;">SGST:</span><span id="productsgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productigstvatspan'+lineNo+'" style="display:none; font-size:11px;">IGST:</span><span id="productigstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span></div></td><td data-label="AMOUNT" <?=(in_array('Amount', $fieldadd))?'':'style="display:none !important;"'?>><div id="ruppeitemtablemobasdf"><span style="font-size:15px !important;"><?php echo $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div></td><td data-label="<?=$access['purreturntxtsqty']?>" <?=(in_array('Sale Quantity', $fieldadd))?'':'style="display:none;"'?>><div><input type="number" min="0" step="0.01" name="salequantity[]" id="salequantity'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth" onChange="productcalc('+lineNo+')" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;display:inline;background:none;"></div><div <?=(in_array('SALE opparen or UNIT closparen opparen Inclusive GST closparen', $fieldadd))?'':'style="display:none !important;"'?>><span id="productwithtaxspan'+lineNo+'" style="display:none; font-size:11px;"><span style="background-color:#1BBC9B;color:white;padding:3px;">SALE(/UNIT)</span><br>(Inclusive GST):<span style="font-size:11px !important;padding-right:3px !important;"><?php echo $resmaincurrencyans; ?></span></span><input type="text" name="productwithtax[]" id="productwithtax'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onchange="prowithtax('+lineNo+')"> <span id="productwithtaxval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productwithtaxedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editwithtax('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productwithtaxupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changewithtax('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('SALE opparen or UNIT closparen opparen Exclusive GST closparen', $fieldadd))?'':'style="display:none !important;"'?>><span id="productwithouttaxspan'+lineNo+'" style="display:none; font-size:11px;">(Exclusive GST):<span style="font-size:11px !important;padding-right:3px !important;"><?php echo $resmaincurrencyans; ?></span></span><input type="text" name="productwithouttax[]" id="productwithouttax'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onchange="prowithouttax('+lineNo+')"><span id="productwithouttaxval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productwithouttaxedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editwithouttax('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productwithouttaxupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changewithouttax('+lineNo+')"><i class="fa fa-save"></i></span></div></td><td <?=((in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'style="white-space:nowrap !important;"':'style="display:none !important;"'?>><div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldadd))?'display:none !important;':'display:none !important;'?>"><a href="javascript:;" class="p-0" id="dropdownadditionalinfo" data-bs-toggle="dropdown" aria-expanded="false"><svg width="15" height="15" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg></a><div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownadditionalinfo"><div style="background-color: #3c3c46;margin-top: -50px !important;"><a class="nav-link" style="color: #fff;width:max-content !important;" onclick="additionalinfo('+lineNo+')"><span class="nav-link-text ms-2 showorhidewords"> <span id="showadd'+lineNo+'">Show</span><span id="hideadd'+lineNo+'" style="display: none;">Hide</span> Additional Information</span></a></div></div></div><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;margin-left:7px;"></a></td></tr>';
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
								return $(this).text().toLowerCase() == 'cost of goods sold';
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
								searchTerm: params.term
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
				if($access['purreturnnewproductdef']=='1'){
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
	 $("#productprodiscountupdate"+id).css('display', 'inline');
}
function changeprodiscount(id){
	 var quantity = $('#quantity'+id).val();
	 var productrate = $('#productrate'+id).val();
	 var prodiscount = $('#prodiscount'+id).val();
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
function editwithouttax(id){
	 $("#productwithouttaxval"+id).css('display', 'none');
	 $("#productwithouttax"+id).css('display', 'inline');
	 setTimeout(function() {
		  $("#productwithouttax"+id).select();
	 },5);
	 $("#productwithouttaxspan"+id).css('display', 'inline');
	 $("#productwithouttaxedit"+id).css('display', 'none');
	 $("#productwithouttaxupdate"+id).css('display', 'inline');
}
function changewithouttax(id){
	 $("#productwithouttaxval"+id).html($("#productwithouttax"+id).val());
	 $("#productwithouttaxval"+id).css('display', 'inline');
	 $("#productwithouttax"+id).css('display', 'none');
	 $("#productwithouttaxspan"+id).css('display', 'inline');
	 $("#productwithouttaxedit"+id).css('display', 'inline');
	 $("#productwithouttaxupdate"+id).css('display', 'none');
}
//FOR SALE QUANTITY WITHOUT TAX
function editwithtax(id){
	 $("#productwithtaxval"+id).css('display', 'none');
	 $("#productwithtax"+id).css('display', 'inline');
	 setTimeout(function() {
		  $("#productwithtax"+id).select();
	 },5);
	 $("#productwithtaxspan"+id).css('display', 'inline');
	 $("#productwithtaxedit"+id).css('display', 'none');
	 $("#productwithtaxupdate"+id).css('display', 'inline');
}
function changewithtax(id){
	 $("#productwithtaxval"+id).html($("#productwithtax"+id).val());
	 $("#productwithtaxval"+id).css('display', 'inline');
	 $("#productwithtax"+id).css('display', 'none');
	 $("#productwithtaxspan"+id).css('display', 'inline');
	 $("#productwithtaxedit"+id).css('display', 'inline');
	 $("#productwithtaxupdate"+id).css('display', 'none');
}
//FOR SALE QUANTITY WITH THE TAX
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
						  if($("#productwithouttax"+id).is(":focus")){}
						  else{
								changewithouttax(id);
						  }
						  if($("#productwithtax"+id).is(":focus")){}
						  else{
								changewithtax(id);
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
$(document).ready(function(){
	 $('#vendor').change(function(){
		  $('#custaddressdiv').css("display", "none");
		  var id= $('#vendor').val();
		  if(id != ''){
				$("#transactionans").html('');
				$.ajax({
					 type: "GET",
					 url: 'transactionfetch.php?term=0&types=vendor&id='+id+'',
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
					 url: 'frequentproductfetch.php?term=0&types=vendor&id='+id+'',
					 success: function (result) {
						  // console.log(result);
						  $("#frequentproans").append(result);
					 },
					 error: function (error) {
						  // console.log(error);
					 }
				});
				$.get("vendorsearch1.php", {term: id} , function(data){
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
					 $sqlismainaccessfieldcusviews=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Vendors' ORDER BY id ASC");
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
					 // if ((in_array('Vendor Information', $fieldviewcusview))) {
				?>
					 document.getElementById("idforcust").value=obj[0].id;
					 document.getElementById("outstandans").innerHTML=obj[0].balanceamount;
				<?php
					 if ((in_array('Vendor Id', $fieldviewcusview))) {
				?>
					 document.getElementById("custviewcode").innerHTML=obj[0].customercode;
				<?php
					 }
				?>
				<?php
					 if ((in_array('Vendor Public Id', $fieldviewcusview))) {
				?>
					 document.getElementById("custviewpublicid").innerHTML=obj[0].publicid;
				<?php
					 }
				?>
				<?php
					 if ((in_array('Vendor Private Id', $fieldviewcusview))) {
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
					 // if ((in_array('Vendor Display Name', $fieldviewcusview))) {
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
					 if ((in_array('Vendors Visibility', $fieldviewcusview))) {
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
						  document.getElementById("custviewgstrtype").innerHTML=obj[0].gstrtype;
						  if((obj[0].gstrtype=='Registered Business - Regular'||obj[0].gstrtype=='Registered Business - Composition'||obj[0].gstrtype=='Special Economic Zone'||obj[0].gstrtype=='Deemed Export'||obj[0].gstrtype=='Tax Deductor'||obj[0].gstrtype=='SEZ Developer')&&(obj[0].gstrtype!='Unregistered Business'||obj[0].gstrtype!='Consumer'||obj[0].gstrtype!='Overseas')){
								$("#gstinshowhideforcust").show();
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
				<?php
					 if ((in_array('Other Information', $fieldviewcusview))) {
				?>
				<?php
					 if ((in_array('DL dot No dot or 20', $fieldviewcusview))) {
				?>
					 document.getElementById("custviewdlt").innerHTML=obj[0].dlno20;
				<?php
					 }
				?>
				<?php
					 if ((in_array('DL dot No dot or 21', $fieldviewcusview))) {
				?>
					 document.getElementById("custviewdlo").innerHTML=obj[0].dlno21;
				<?php
					 }
				?>
				<?php
					 }
				?>
					 $("#vendorname").val(obj[0].customername);
					 $("#vendorid").val(obj[0].id);
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
					 var gstrtypeans = '<option '+((obj[0].gstrtype=='')?'selected':'')+' disabled value="" data-foo="Select Type of Add">Select Type of Add</option><option '+((obj[0].gstrtype=='Registered Business - Regular')?'selected':'')+' data-foo="Business that is registered under GST" value="Registered Business - Regular">Registered Business - Regular</option><option '+((obj[0].gstrtype=='Registered Business - Composition')?'selected':'')+' data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition">Registered Business - Composition</option><option '+((obj[0].gstrtype=='Unregistered Business')?'selected':'')+' data-foo="Business that has not been registered under GST" value="Unregistered Business">Unregistered Business</option><option '+((obj[0].gstrtype=='Consumer')?'selected':'')+' data-foo="A customer who is a regular consumer" value="Consumer">Consumer</option><option '+((obj[0].gstrtype=='Overseas')?'selected':'')+' data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas">Overseas</option><option '+((obj[0].gstrtype=='Special Economic Zone')?'selected':'')+' data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone">Special Economic Zone</option><option '+((obj[0].gstrtype=='Deemed Export')?'selected':'')+' data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export">Deemed Export</option><option '+((obj[0].gstrtype=='Tax Deductor')?'selected':'')+' data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor">Tax Deductor</option><option '+((obj[0].gstrtype=='SEZ Developer')?'selected':'')+' data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer">SEZ Developer</option>';
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
						  $("#purchasereturningaddressdiv").html(ase);
						  $("#purchasereturningaddressspan").html('<div style="margin-top:-4.5px !important;"> Add New Address </div>');
					 }
					 else{
						  ase='<div id="firstadd">'+obj[0].address+' '+obj[0].city+'</div> <div id="secadd">'+obj[0].state+' '+obj[0].pin+' '+obj[0].country+'</div>';
						  $("#purchasereturningaddressdiv").html(ase);
						  $("#purchasereturningaddressspan").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:12px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
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
					 $("#dlno20span").html('<div style="margin-top:-4.5px !important;"> Add New DL No 20 </div>');
				}
				else{
					 ase5='<div id="dlno20line">'+obj[0].dlno20+'</div>';
					 $("#dlno20div").html(ase5);
					 $("#dlno20span").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
				}
				if(ase6==""){
					 $("#dlno21div").html(ase6);
					 $("#dlno21span").html('<div style="margin-top:-4.5px !important;"> Add New DL No 21 </div>');
				}
				else{
					 ase6='<div id="dlno21line">'+obj[0].dlno21+'</div>';
					 $("#dlno21div").html(ase6);
					 $("#dlno21span").html('<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" X="0" Y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-xs cursor-pointer" style="color:#17A2B7 !important;height:11px !important;margin: -4px 0px 0px -15px !important;"><path d="M469.6 42.4C420.9-6.2 382.3-.2 378.1.7l-4.8 1L42.1 332.8c-3.4 3.4-5.8 7.8-6.8 12.5L1.3 506c-.6 2.8 1.9 5.3 4.7 4.7l160.7-34.1c4.7-1 9.1-3.4 12.5-6.8l331.2-331.2.9-4.9c.9-4.1 6.7-42.8-41.7-91.3zM43.2 464l20.2-95.2c.5-2.3 2.8-3.7 5.1-3 12.4 3.9 29.7 12 46.3 28.6 17.1 17.1 26 35.8 30.5 49.2.8 2.3-.6 4.7-3 5.2l-94.4 20c-2.8.6-5.3-1.9-4.7-4.8zm135.6-39.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8C121.2 355 104 345 89.4 339c-2.6-1.1-3.3-4.5-1.3-6.5l150.8-150.8 95.5-95.5c1-1 2.3-1.4 3.7-1.1 11.8 2.5 34.1 9.9 55.1 30.9 21.4 21.4 29.9 45.4 33.2 58.2.3 1.4 0 2.8-1 3.8l-95.1 95.1-151.5 151.5zm278.4-278.4c-2 2-5.4 1.3-6.5-1.3-6.5-15.6-17.1-34.3-34.6-51.8-16.5-16.5-33.7-26.5-48.3-32.5-2.6-1.1-3.3-4.5-1.3-6.5L387 33.7c.9-.9 2-1.3 3.2-1.2 9.8 1 30.3 6.6 56.5 32.8 26.2 26.2 31.8 46.8 32.8 56.5.1 1.2-.3 2.4-1.2 3.2l-21.1 21.2z"></path></svg>');
				}
				});
		  }
		  else{
				alert("Please Select <?= $infomainaccessuserven['modulename'] ?>");
				$('#custaddressdiv').css("display", "none");
		  }
	 });
});
// FOR VENDOR VIEW INFORMATIONS OTHER DETAILS
var sIndex = 20, offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
$('.main-content').on('scroll', function() {
	 var scrollTop = $(this).scrollTop();
	 if ((scrollTop + $(this).innerHeight() >= this.scrollHeight-50)||scrollTop + $(this).innerHeight() <= this.scrollHeight-50) {
		  if (isPreviousEventComplete && isDataAvailable) {
				isPreviousEventComplete = false;
				$("#loadimg").css("display","block");
				// console.log('ss');
				// ajax for get
				$.ajax({
					 type: "GET",
					 url: 'transactionfetch.php?term=' + sIndex + '&types=vendor&id='+document.getElementById("idforcust").value+'',
					 success: function (result) {
						  $("#transactionans").append(result);
						  sIndex = sIndex + offSet;
						  isPreviousEventComplete = true;
						  if (result == '')
								isDataAvailable = false;
						  $("#loadimg").css("display","none");
						  // console.log("result"+result);
					 },
					 error: function (error) {
						  // console.log(error);
					 }
				});
				// it is done
		  }
	 }
});
// FOR GET TRANSACTION DETAILS OF THE CURRENT SELECTED VENDOR
var sIndexpro = 20, offSetpro = 20, isPreviousEventCompletepro = true, isDataAvailablepro = true;
$('.main-content').on('scroll', function() {
	 var scrollToppro = $(this).scrollTop();
	 if ((scrollToppro + $(this).innerHeight() >= this.scrollHeight-50)||scrollToppro + $(this).innerHeight() <= this.scrollHeight-50) {
		  if (isPreviousEventCompletepro && isDataAvailablepro) {
				isPreviousEventCompletepro = false;
				$("#loadimg").css("display","block");
				// console.log('ss');
				// ajax for get
				$.ajax({
					 type: "GET",
					 url: 'frequentproductfetch.php?term=' + sIndexpro + '&types=vendor&id='+document.getElementById("idforcust").value+'',
					 success: function (result) {
						  $("#frequentproans").append(result);
						  sIndexpro = sIndexpro + offSetpro;
						  isPreviousEventCompletepro = true;
						  if (result == '')
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
// FOR GET THE FREQUENTLY BOUGHTED PRODUCTS INFORMATIONS BY THE SELECTED VENDOR
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
					 $("#productwithouttaxspan"+lineNo).css('display', 'inline');
					 $("#productwithouttaxval"+lineNo).html('0');
					 $("#productwithouttax"+lineNo).val('0');
					 $("#productwithouttax"+lineNo).css('display', 'none');
					 $("#productwithouttaxval"+lineNo).css('display', 'inline');
					 $("#productwithouttaxedit"+lineNo).css('display', 'inline');
					 $("#productwithouttaxupdate"+lineNo).css('display', 'none');
					 $("#productwithtaxspan"+lineNo).css('display', 'inline');
					 $("#productwithtaxval"+lineNo).html('0');
					 $("#productwithtax"+lineNo).val('0');
					 $("#productwithtax"+lineNo).css('display', 'none');
					 $("#productwithtaxval"+lineNo).css('display', 'inline');
					 $("#productwithtaxedit"+lineNo).css('display', 'inline');
					 $("#productwithtaxupdate"+lineNo).css('display', 'none');
					 selfgetfun(lineNo,1);
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
	 var productrate = $('#productrate'+id).val();
	 var prodiscount = $('#prodiscount'+id).val();
	 if (productrate=='') {
		  productrate = 0;
	 }
	 if (quantity=='') {
		  quantity = 0;
	 }
	 if (prodiscount=='') {
		  prodiscount = 0;
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
	 var mrpsqty = ($('#mrp' + id).val()!='')?$('#mrp' + id).val():0;
	 var quantitysqty = ($('#quantity' + id).val()!='')?$('#quantity' + id).val():0;
	 var saleqtysqty = ($('#salequantity' + id).val()!='')?$('#salequantity' + id).val():0;
	 var vatsqty = ($('#vat' + id).val()!='')?$('#vat' + id).val():0;
	 if ((mrpsqty != '') && (quantitysqty != '') && (vatsqty != '') && (saleqtysqty != '')) {
		  saleqtysqty = saleqtysqty === 0 ? 1 : saleqtysqty;
		  var salerateexsqty = (parseFloat(mrpsqty) * ((parseFloat(quantitysqty)) / parseFloat(saleqtysqty)));
		  $('#productwithtax' + id).val(parseFloat(Math.round(salerateexsqty * 100) / 100).toFixed(2));
		  $('#productwithtaxval' + id).html(parseFloat(Math.round(salerateexsqty * 100) / 100).toFixed(2));
		  var gstsqty = (parseFloat(salerateexsqty) * 100) / (100 + parseFloat(vatsqty));
		  $('#productwithouttax' + id).val(parseFloat(Math.round(gstsqty * 100) / 100).toFixed(2));
		  $('#productwithouttaxval' + id).html(parseFloat(Math.round(gstsqty * 100) / 100).toFixed(2));
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
					 $("#gstautotable").append('<tr><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" data-label="TAXABLE VALUE"><input type="hidden" value="'+(oldvat[i].value)+'" id="gstpercent'+nowvat+'" name="gstpercent[]"><input type="hidden" value="'+(oldvat[i].value/2)+'" id="csgstpercent'+nowvat+'" name="csgstpercent[]"><input value="'+oldproductvalue[i].value+'" type="text" name="tax[]" id="tax'+nowvat+'" class="form-control form-control-sm bordernoneinput taxabledesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="CGST %" class="cgstinp" id="cgstinner'+nowvat+'">'+(oldvat[i].value/2)+'%</td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="CGST" class="cgstinp"><div><?php echo $resmaincurrencyans; ?> <input value="'+(oldtaxvalue[i].value/2).toFixed(2)+'" type="text" name="cgst[]" id="cgst'+nowvat+'" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></div></td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="SGST %" class="sgstinp" id="sgstinner'+nowvat+'">'+(oldvat[i].value/2)+'%</td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="SGST" class="sgstinp"><div><?php echo $resmaincurrencyans; ?> <input value="'+(oldtaxvalue[i].value/2).toFixed(2)+'" type="text" name="sgst[]" id="sgst'+nowvat+'" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></div></td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="IGST %" class="igstinp" colspan="2" id="igstinner'+nowvat+'">'+(oldvat[i].value)+'%</td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="IGST" class="igstinp" colspan="2"><div><?php echo $resmaincurrencyans; ?> <input value="'+oldtaxvalue[i].value+'" type="text" name="igst[]" id="igst'+nowvat+'" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></div></td><td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="GST %" class="gstforauto" id="gstinner'+nowvat+'">'+oldvat[i].value+'%</td> <td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;white-space: nowrap;border-left: 1px dashed #999;" data-label="GST"><input value="'+oldtaxvalue[i].value+'" type="text" name="gst[]" id="gst'+nowvat+'"   class="form-control form-control-sm totaldesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;"></td></tr><tr><td colspan="6" style="text-align:right;width: 92.3px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" id="tgstamount">Total GST Amount&nbsp;</td> <td id="tgstinp" style="padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;font-weight:bold;"><div><?php echo $resmaincurrencyans; ?><input value="'+totalvatans.toFixed(2)+'" type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm totaldesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;font-weight:bold;" ></div></td></tr>');
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
	 var disper=document.getElementById('discount').value;
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
$("#prointratax").on("select2:open", function() {
	 document.getElementById("configureunits").innerHTML = "New Intra Tax";
});
$("#prointratax").on("select2:open", function() {
	 $("#configureunits").attr("data-bs-target","#NewIntraTax");
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
	 return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
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
	 return $('<div><div>' + state.text + '</div><div class="foo">' + $(state.element).attr('data-foo') + '</div></div>'
	 );
}
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
								return $('<div><div>' + state.text + '</div><div class="foo">' + $(state.element).attr('data-foo') + '</div></div>'
								);
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
});
// FOR NEW PRODUCT
</script>
<div class="modal fade" id="AddNewBillTerm" tabindex="-1" role="dialog" style="z-index: 1051;">
	 <div class="modal-dialog" role="document">
		  <div class="modal-content">
				<div class="modal-header">
					 <h5 class="modal-title">
						  New <?= $infomainaccessuser['modulename'] ?> Term
					 </h5>
					 <span type="button" onclick="funespurchasereturnterm()" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" id="closeicon">&times;</span>
					 </span>
				</div>
				<div class="modal-body">
					 <form method="post" action="">
						  <div class="row justify-content-center">
								<div class="col-lg-12">
									 <div class="form-group row">
										  <div class="col-sm-6">
												<label for="missingpurchasereturnterm" class="custom-label">
													 <span class="text-danger">
														  <?= $infomainaccessuser['modulename'] ?> Term *
													 </span>
												</label>
										  </div>
										  <div class="col-sm-6">
												<input type="text" name="purchasereturnterm" class="form-control form-control-sm mb-4" id="missingpurchasereturnterm" placeholder="Name" required>
										  </div>
									 </div>
								</div>
						  </div>
					 </form>
				</div>
				<div class="modal-footer " style="margin-top: 10px !important;">
					 <div class="col">
						  <button   onclick="funaddpurchasereturnterm()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitpurchasereturnterm" value="Submit">
								<span class="label">Save</span>
								<span class="spinner"></span>
						  </button>
						  <button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funespurchasereturnterm()">
								Cancel
						  </button>
					 </div>
				</div>
		  </div>
	 </div>
</div>
<script>
function funaddpurchasereturnterm() {
	 var missingpurchasereturnterm = document.getElementById('missingpurchasereturnterm');
	 if (missingpurchasereturnterm.value == '') {
		  alert('Please Enter New <?= $infomainaccessuser['modulename'] ?> Term Name');
		  missingpurchasereturnterm.focus();
		  return false;
	 }
	 else {
		  $.ajax({
				type: "POST",
				url: "termadds.php",
				data: {
					 term: $("#missingpurchasereturnterm").val(),
					 submit: "Submit"
				},
				success:function(result){
					 const resarray = result.split("|");
					 alert(resarray[0]);
					 if(resarray[1]=='0'){}
					 else{
						  $('#purchasereturnterm').append('<option value="' + missingpurchasereturnterm.value + '">' + missingpurchasereturnterm.value + '</option>');
						  $('#purchasereturnterm').val(missingpurchasereturnterm.value).change();
						  $("#purchasereturnterm").select2();
						  $('#AddNewBillTerm').modal('hide');
						  return false;
					 }
				}
		  });
	 }
}
function funespurchasereturnterm() {
	 $("#purchasereturnterm").select2();
	 $('#AddNewBillTerm').modal('hide');
	 return false;
}
$("#saleperson").on("select2:open", function() {
	 $("#configureunits").attr("data-bs-target","#AddNewSaleperson");
});
$("#saleperson").on("select2:open", function() {
	 document.getElementById("configureunits").innerHTML = "New Sale Person";
});
$("#purchasereturnterm").on("select2:open", function() {
	 $("#configureunits").attr("data-bs-target","#AddNewBillTerm");
});
$("#purchasereturnterm").on("select2:open", function() {
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
													 <span class="text-danger"> Sale Person *</span>
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
						  <button   onclick="funaddsaleperson()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitsaleperson" value="Submit">
								<span class="label">Save</span>
								<span class="spinner"></span>
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
													 <span class="text-danger">Name *</span>
												</label>
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
												<label for="missingnoofdays" class="custom-label">
													 <span class="text-danger">No of Dates *</span>
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
						  <button   onclick="funaddduedates()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitduedates" value="Submit">
								<span class="label">Save</span>
								<span class="spinner"></span>
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
$("#gstgstrtype").on("select2:open", function() {
	 $("#configureunits").hide();
});
// FOR GST TYPE
function triggerpayment(purchasereturnno,purchasereturndate,purchasereturnamount,cancelstatus,whatdonext){
	 let allAreFilled = true;
	 document.getElementById("purchasereturnform").querySelectorAll("[required]").forEach(function(i) {
		  if (!allAreFilled) return;
		  if (i.type === "radio") {
				let radioValueCheck = false;
				document.getElementById("purchasereturnform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
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
		  document.getElementById("purchasereturnform").querySelectorAll("[required]").forEach(function(i) {
				if (!allAreFilled) return;
				if (i.type === "radio") {
					 let radioValueCheck = false;
					 document.getElementById("purchasereturnform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
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
					 $.ajax({
						  type: "GET",
						  url: 'financialyear.php?types=purchasereturn&finyear='+document.getElementById("purchasereturndate").value.split('-')[0]+'',
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
					 let invgrandtotal = document.getElementById("invgrandtotal").value;
					 let grandtotal = document.getElementById("grandtotal").value;
					 let grandtotals = document.getElementById("invgrandtotal");
					 if (invgrandtotal==grandtotal) {
						  $("#loadimgbig").css("display","none");
						  $(".showhideload").css("display","block");
						  $("#ihavediv").css("display","block");
						  $("#savecanceldiv").css("display","block");
						  let modaltriggercheck = document.getElementById("triggerconfirm-adddelete");
						  if ($('#triggerconfirm-adddelete').modal('show')) {
								$(".finalsubmitrequired").attr("required","required");
						  }
						  else{
								$(".finalsubmitrequired").removeAttr("required");
						  }
						  isValidFinal = true;
						  checkvalidate();
						  $('#validpurchasereturnno').val($('#purchasereturnno').val());
						  $('#validpurchasereturndate').val($('#purchasereturndate').val());
						  $('#validpurchasereturnamount').val($('#grandtotal').val());
						  var validpurchasereturnamount=$("#validpurchasereturnamount").val();
						  var validpaidamount=$("#validpaidamount").val();
						  $("#validpaidamount").val(validpurchasereturnamount);
						  if (whatdonext==0) {
								$("#loadimgbig").css("display","block");
								$(".showhideload").css("display","none");
								$("#ihavediv").css("display","none");
								$("#savecanceldiv").css("display","none");
								$("#Submit").attr("disabled","disabled");
						  }
						  else if(whatdonext==1){
								ihavereceive();
								$("#Submit").removeAttr("disabled");
						  }
					 }
					 else{
						  alert("Grand Totals Are Not Matched");
						  grandtotals.focus();
						  $('#triggerconfirm-adddelete').modal('hide');
						  $("#loadimgbig").css("display","none");
						  $(".showhideload").css("display","block");
						  $("#ihavediv").css("display","block");
						  $("#savecanceldiv").css("display","block");
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
	 triggerpayment('','','','1','0');
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
					 value = n_array[i];
				}
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
		  if(amt > 999999999.99){
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
function selfgetfun(lineNo,boolean) {
	 $("#invonoff"+lineNo).css("background-color","#1BBC9B");
	 $("#invonoff"+lineNo).css("color","#fff");
	 $("#purchasereturnonoff"+lineNo).css("background-color","#fff");
	 $("#purchasereturnonoff"+lineNo).css("color","#000");
	 $("#selforothers"+lineNo).val('self');
	 var productid= $('#product'+lineNo).val();
	 var customerid = $("#vendor").val();
<?php
	 if ($access['purchasereturnratedef']=='avail') {
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
	 $.get("ratesearchpurchasereturn.php", {term: productid,custid: customerid,ratedef: invratedef,differ: 'self'} , function(datas){
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
					 check+="<div id='option"+lineNo+objbatch[key].purchasereturnno+"inv' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' style='border:none;overflow:hidden;white-space:nowrap;' title='<?=strtoupper($infomainaccessuser['modulename'])?>'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='invpurchasereturntxt'><?=strtoupper($infomainaccessuser['modulename'])?></span></td><td align='right' id='invno"+objbatch[key].purchasereturnno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].purchasereturnno+"'>  "+objbatch[key].purchasereturnno+" </td><td align='right' id='invdt"+objbatch[key].purchasereturnno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].purchasereturndate+"'>"+objbatch[key].purchasereturndate+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' colspan='2' id='rate"+objbatch[key].productrate+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td><td align='right' id='dis"+objbatch[key].productdiscount+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productdiscount+"'><?=$access['txtprodispurchasereturn']?> : "+objbatch[key].productdiscount+" </td></tr></table></div>";
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
// FOR GET OLD RATE OF THE VENDOR AND PRODUCT IN PURCHASERETURN FOR SELF BRANCH
function othersgetfun(lineNo) {
	 $("#invonoff"+lineNo).css("background-color","#fff");
	 $("#invonoff"+lineNo).css("color","#000");
	 $("#purchasereturnonoff"+lineNo).css("background-color","#1BBC9B");
	 $("#purchasereturnonoff"+lineNo).css("color","#fff");
	 $("#selforothers"+lineNo).val('others');
	 var productid= $('#product'+lineNo).val();
	 var customerid = $("#vendor").val();
<?php
	 if ($access['purchasereturnratedef']=='avail') {
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
	 $.get("ratesearchpurchasereturn.php", {term: productid,custid: customerid,ratedef: invratedef,differ: 'others'} , function(datas){
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
					 check+="<div id='option"+lineNo+objbatch[key].purchasereturnno+"inv' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' style='border:none;overflow:hidden;white-space:nowrap;' title='<?=strtoupper($infomainaccessuser['modulename'])?>'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='invpurchasereturntxt'><?=strtoupper($infomainaccessuser['modulename'])?></span></td><td align='right' id='invno"+objbatch[key].purchasereturnno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].purchasereturnno+"'>  "+objbatch[key].purchasereturnno+" </td><td align='right' id='invdt"+objbatch[key].purchasereturnno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].purchasereturndate+"'>"+objbatch[key].purchasereturndate+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' colspan='2' id='rate"+objbatch[key].productrate+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td><td align='right' id='dis"+objbatch[key].productdiscount+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productdiscount+"'><?=$access['txtprodispurchasereturn']?> : "+objbatch[key].productdiscount+" </td></tr></table></div>";
				}
				// console.log(check);
				$("#ratelist"+lineNo).html(check);
				var browsers = document.getElementById("ratelist"+lineNo);
				browsers.style.display = 'none';
				browsers.style.backgroundColor = 'transparent';
				browsers.style.border = 'none';
				// if (boolean==0) {
					 $("#productrate"+lineNo).focus();
				// }
		  }
	 });
}
// FOR GET OLD RATE OF THE VENDOR AND PRODUCT IN PURCHASERETURN FOR OTHER BRANCHES
var alertsbatchexpiry = true;
function batchget(id){
	 if($("#productid"+id).val()==''){
		  $("#product"+id).focus();
		  alert('Please Select <?=$infomainaccessuserpro['modulename']?>');
	 }
	 else{
		  // if (document.getElementById("selforothers"+id).value=='self') {
		  //  selfgetfun(id);
		  // }
		  // else{
		  //  othersgetfun(id);
		  // }
		  var browsersrate = document.getElementById("ratelist"+id);
		  var browsersinvpurchasereturn = document.getElementById("invpurchasereturngets"+id);
		  browsersrate.style.display = 'none';
		  browsersinvpurchasereturn.style.display = 'none';
		  var input = document.getElementById("batch"+id);
		  var browsers = document.getElementById("outfordone"+id);
		  browsers.style.display = 'block';
		  var productid= $('#product'+id).val();
		  input.onclick = function () {
				browsers.style.display = 'block';
				$("#outfordone"+id).scrollTop( 1 );
				$("#outfordone"+id).on('scroll', function() {
					 var scrollTop = $(this).scrollTop();
					 if (scrollTop + $(this).innerHeight() >= this.scrollHeight) {
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
								if (scrollTop + $(this).innerHeight() >= this.scrollHeight) {
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
		  if ($access['purchasereturnbatchdef']=='avail') {
	 ?>
		  var purchasereturnbatchdef = 'and quantity>0 ';
	 <?php
		  }
		  else{
	 ?>
		  var purchasereturnbatchdef = '';
	 <?php
		  }
	 ?>
		  $.get("batchsearch.php", {term: productid,batchdef: purchasereturnbatchdef} , function(datas){
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
						  var batexpoldornow = 0;
						  for (var i = 0; i < oldproductnames.length; i++){
								if (i+1!=id) {
									 if ((oldproductnames[i].value==$('#productname'+id).val())&&(oldbatch[i].value==batqtyspl[6])&&(oldexp[i].value==expratespl[6].split('/')[2]+'-'+expratespl[6].split('/')[1]+'-'+expratespl[6].split('/')[0])) {
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
					 $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
					 if ($(this).text().toLowerCase().indexOf(value) > -1) {
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
		  var browsersinvpurchasereturn = document.getElementById("invpurchasereturngets"+id);
		  browsersinvpurchasereturn.style.display = 'none';
		  browsersrate.style.display = 'none';
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
		  if (firstornoneidcust!=$("#vendor").val()) {
				firstornoneidcust = $("#vendor").val();
				firstornonerate = true;
		  }
		  if (firstornoneidrate!=id) {
				firstornoneidrate = id;
				firstornonerate = true;
		  }
		  if (firstornonerate) {
				firstornonerate = false;
				if (document.getElementById("selforothers"+id).value=='self') {
					 selfgetfun(id,0);
				}
				else{
					 othersgetfun(id);
				}
		  }
		  var browsersbatexp = document.getElementById("outfordone"+id);
		  browsersbatexp.style.display = 'none';
		  var input = document.getElementById("productrate"+id);
		  var browsers = document.getElementById("ratelist"+id);
		  var browsersinvpurchasereturn = document.getElementById("invpurchasereturngets"+id);
		  browsersinvpurchasereturn.style.display = 'block';
		  browsers.style.display = 'block';
		  var productid= $('#product'+id).val();
		  var customerid = $("#vendor").val();
		  input.onclick = function () {
				browsers.style.display = 'block';
				browsersinvpurchasereturn.style.display = 'block';
				$("#ratelist"+id).scrollTop( 1 );
				$("#ratelist"+id).on('scroll', function() {
					 var scrollTop = $(this).scrollTop();
					 if (scrollTop + $(this).innerHeight() >= this.scrollHeight) {
						  $("#ratelist"+id).scrollTop( 201.3 );
					 }
					 else if (scrollTop <= 0) {
						  $("#ratelist"+id).scrollTop( 1 );
					 }
				});
				$("body").on("click",function() {
					 if($("#productrate"+id).is(":focus")){
						  browsers.style.display = 'block';
						  browsersinvpurchasereturn.style.display = 'block';
						  $("#ratelist"+id).scrollTop( 1 );
						  $("#ratelist"+id).on('scroll', function() {
								var scrollTop = $(this).scrollTop();
								if (scrollTop + $(this).innerHeight() >= this.scrollHeight) {
									 $("#ratelist"+id).scrollTop( 201.3 );
								}
								else if (scrollTop <= 0) {
									 $("#ratelist"+id).scrollTop( 1 );
								}
						  });
					 }
					 else{
						  browsers.style.display = 'none';
						  browsersinvpurchasereturn.style.display = 'none';
					 }
				});
		  }
	 <?php
		  if ($access['purchasereturnratedef']=='avail') {
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
		  if (document.getElementById("selforothers"+id).value=='self') {
				var selforothers = 'self';
		  }
		  else{
				var selforothers = 'others';
		  }
		  $.get("ratesearchpurchasereturn.php", {term: productid,custid: customerid,ratedef: invratedef,differ: selforothers} , function(datas){
				const objbatch = JSON.parse(datas);
				option='';
				invno='';
				invdt='';
				rate='';
				for (var key in objbatch) {
					 option+='option'+id+objbatch[key].purchasereturnno+'inv;';
					 invno+='invno'+objbatch[key].purchasereturnno+'inv;';
					 invdt+='invdt'+objbatch[key].purchasereturndate+'inv;';
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
					 $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
					 if ($(this).text().toLowerCase().indexOf(value) > -1) {
					 $(this).parent().css({"display": "block"});
						  var browsers = document.getElementById("ratelist"+id);
						  browsers.style.display = 'block';
						  browsersinvpurchasereturn.style.display = 'block';
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
									 browsersinvpurchasereturn.style.display = 'none';
								}
								else{
									 browsers.style.display = 'block';
									 browsersinvpurchasereturn.style.display = 'block';
								}
						  }
					 }
				});
		  });
	 }
}
// FOR GET THE OLD RATES
function qtytosqty(id) {
	 var qtyval = document.getElementById("quantity"+id).value;
	 document.getElementById("salequantity"+id).value = qtyval;
}
// FOR APPLY QUANTITY VALUE INTO SALE QUANTITY
function prowithouttax(id) {
	 var vatsqty = ($('#vat' + id).val()!='')?$('#vat' + id).val():0;
	 var saleratesqty = $('#productwithouttax' + id).val();
	 var salerateexsqty = $('#productwithtax' + id).val();
	 if (saleratesqty != '') {
		  var gstsqty = (parseFloat(saleratesqty) * parseFloat(vatsqty)) / 100;
		  gstsqty = parseFloat(saleratesqty) + parseFloat(gstsqty);
		  $('#productwithtax' + id).val(parseFloat(Math.round(gstsqty * 100) / 100).toFixed(2));
		  $('#productwithtaxval' + id).html(parseFloat(Math.round(gstsqty * 100) / 100).toFixed(2));
	 }
}
// FOR SALE QUANTITY WITHOUT TAX CALCULATION
function prowithtax(id) {
	 var vatsqty = ($('#vat' + id).val()!='')?$('#vat' + id).val():0;
	 var saleratesqty = $('#productwithouttax' + id).val();
	 var salerateexsqty = $('#productwithtax' + id).val();
	 if (salerateexsqty != '') {
		  var gstsqty = (parseFloat(salerateexsqty) * 100) / (100 + parseFloat(vatsqty));
		  $('#productwithouttax' + id).val(parseFloat(Math.round(gstsqty * 100) / 100).toFixed(2));
		  $('#productwithouttaxval' + id).html(parseFloat(Math.round(gstsqty * 100) / 100).toFixed(2));
	 }
}
// FOR SALE QUANTITY WITHOUT TAX CALCULATION
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
						  changewithouttax(id);
						  changewithtax(id);
					 }
				}
		  }
	 }
});
// FOR AUTOMATICALLY SAVE WHEN CLICK THE ENTER KEY ( ENTER KEY CODE IS 13 )
</script>
</body>
</html>