<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE
if((isset($_GET['billno']))&&(isset($_GET['billdate']))){
	$billno=htmlspecialchars($_GET['billno'], ENT_QUOTES, 'UTF-8');
	$billdate=htmlspecialchars($_GET['billdate'], ENT_QUOTES, 'UTF-8');
	$sql=$con->prepare("SELECT * FROM pairbills WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? ORDER BY id ASC");
	$sql->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $billno, $billdate);
	$sql->execute();
	$sql->store_result();
	if($sql->num_rows>0){
		$sql->close();
		$sqlismainaccessfields=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
		$sqlismainaccessfields->bind_param("i", $companymainid);
		$sqlismainaccessfields->execute();
		$sqlismainaccessfield = $sqlismainaccessfields->get_result();
		while($infomainaccessfield=$sqlismainaccessfield->fetch_array()){
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
		$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
		$sqlismainaccessusers->bind_param("i", $userid);
		$sqlismainaccessusers->execute();
		$sqlismainaccessuser = $sqlismainaccessusers->get_result();
		$infomainaccessuser=$sqlismainaccessuser->fetch_array();
		if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)||($infomainaccessuser['useraccessedit']==0)))) {
			header('Location:dashboard.php');
		}
		//FOR CHECK THE THIS FILES ACCESSES ARE ALLOW OR NOT
		$sqlprefer=$con->prepare("SELECT * FROM paircontrols WHERE (username = ? OR usernewname = ?)");
		$sqlprefer->bind_param("ss", $_SESSION['unqwerty'],$_SESSION['unqwerty']);
		$sqlprefer->execute();
		$resultprefer = $sqlprefer->get_result();
		$sidebarprefer=$resultprefer->fetch_array();
		if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
			header('location:dashboard.php');
		}
		//FOR CHECK THE THIS FILES BACKENDS CONTROL ACCESSES ARE ON OR OFF
		if(isset($_POST['grandtotal'])){
			date_default_timezone_set('Asia/Calcutta');
			if (($infomainaccessuser['billveninfo']=='defone')||($infomainaccessuser['billveninfo']=='deftwo')) {
				$scriptonetwo = htmlspecialchars($_POST['vendorinfodefault'], ENT_QUOTES, 'UTF-8');
			}
			else{
				$scriptonetwo = 'three';
			}
			//FOR CHECK THE TYPE B2C OR B2B
			$createdon=date('Y-m-d H:i:s');
			$dlno20 = '';
			$dlno21 = '';
			if (($infomainaccessuser['billveninfo']=='one')||($scriptonetwo=='one')) {
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
			$cancelstatuscheck = htmlspecialchars($_POST['cancelstatuscheck'], ENT_QUOTES, 'UTF-8');
			$billterm=htmlspecialchars($_POST['billterm'], ENT_QUOTES, 'UTF-8');
			$oldbillno=htmlspecialchars($_GET['billno'], ENT_QUOTES, 'UTF-8');
			$oldbilldate=htmlspecialchars($_GET['billdate'], ENT_QUOTES, 'UTF-8');
			$billno=htmlspecialchars($_POST['billno'], ENT_QUOTES, 'UTF-8');
			//FOR GET THE CURRENT INVOICE NO
			$billdate=htmlspecialchars($_POST['billdate'], ENT_QUOTES, 'UTF-8');
			$paymentidforupdpayhis = '';
			$publicsqlforupdhis=$con->prepare("SELECT id FROM pairpurchasepayments WHERE receiptno=? AND receiptdate=?");
			$publicsqlforupdhis->bind_param("ss", $billno, $billdate);
			$publicsqlforupdhis->execute();
			$publicsqlforupdhispay = $publicsqlforupdhis->get_result();
			if($publicsqlforupdhispay->num_rows > 0){
				$publicansforupdpayhis=$publicsqlforupdhispay->fetch_array();
				$paymentidforupdpayhis = $publicansforupdpayhis['id'];
				$publicsqlforupdhispay->close();
				$publicsqlforupdhis->close();
			}
			$duedate=htmlspecialchars($_POST['duedate'], ENT_QUOTES, 'UTF-8');
			$duedates=htmlspecialchars(((isset($_POST['duedates']))?$_POST['duedates']:''), ENT_QUOTES, 'UTF-8');
			$orderdcno="";
			if ((in_array('Sale Person', $fieldedit))) {
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
			if ((in_array('Reference', $fieldedit))) {
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
			$billamount=htmlspecialchars($_POST['grandtotal'], ENT_QUOTES, 'UTF-8');
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
			if ((in_array('Terms and Conditions', $fieldedit))) {
				$terms=htmlspecialchars($_POST['terms'], ENT_QUOTES, 'UTF-8');
			}
			else{
				$terms='';
			}
			if ((in_array('Notes', $fieldedit))) {
				$notes=htmlspecialchars($_POST['notes'], ENT_QUOTES, 'UTF-8');
			}
			else{
				$notes='';
			}
			if ((in_array('Description', $fieldedit))) {
				$description=htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
			}
			else{
				$description='';
			}
			$validpaidamount = htmlspecialchars((($_POST['validpaidamount']!='')?$_POST['validpaidamount']:0), ENT_QUOTES, 'UTF-8');
			$validbalance=htmlspecialchars((float)$_POST['grandtotal'], ENT_QUOTES, 'UTF-8') - htmlspecialchars((float)$_POST['validpaidamount'], ENT_QUOTES, 'UTF-8');
			$ansforsepgstval=htmlspecialchars($_POST['ansforsepgstval'], ENT_QUOTES, 'UTF-8');
			//FOR GET PAYMENT DETAILS AND GST VALUES
			if ((in_array('Attachment', $fieldedit))) {
				$fileattach=htmlspecialchars( $_POST['fileattach1'], ENT_QUOTES, 'UTF-8');
				$files = array_filter($_FILES['fileattach']['name']);
				$total_count = count($_FILES['fileattach']['name']);
				for( $i=0 ; $i < $total_count ; $i++ ) {
					$tmpFilePath = $_FILES['fileattach']['tmp_name'][$i];
					if ($tmpFilePath != ""){
						$newFilePath = "ups/fileattach/".time().$_FILES['fileattach']['name'][$i];
						if(move_uploaded_file($tmpFilePath, $newFilePath)) {
							if($fileattach!=""){
								$fileattach.=" | ".$newFilePath;
							}
							else{
								$fileattach.="".$newFilePath;
							}
						}
					}
				}
			}
			else{
				$fileattach='';
			}
			//FOR ATTACHMENT FILES
			if (($infomainaccessuser['billveninfo']=='one')||($scriptonetwo=='one')) {
				$venid=htmlspecialchars($_POST['vendor'], ENT_QUOTES, 'UTF-8');
				$vensqlvenhiss=$con->prepare("SELECT * FROM paircustomers WHERE (franchisesession=? OR cvisiblity='PUBLIC') AND (createdid=? AND moduletype='Vendors') AND id=? ORDER BY id ASC");
				$vensqlvenhiss->bind_param("sss", $_SESSION["franchisesession"], $companymainid, $venid);
				$vensqlvenhiss->execute();
				$vensqlvenhis = $vensqlvenhiss->get_result();
				$vensqlanscus=$vensqlvenhis->fetch_array();
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
			//FOR THE B2B VENDOR CHANGES
			}
			if (($infomainaccessuser['billveninfo']=='two')||($scriptonetwo=='two')) {
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
				$oldtwoworkphone = htmlspecialchars($_POST['oldtwoworkphone'], ENT_QUOTES, 'UTF-8');
				$vendorid = htmlspecialchars($_POST['oldvendorname'], ENT_QUOTES, 'UTF-8');
				$sqlup = $con->prepare("UPDATE paircustomers SET dlno20=?, dlno21=?, createdon=?,createdid=?,createdby=?,franchisesession=?,customername=?,billstreet=?,billcity=?,billstate=?,billpincode=?,billcountry=?,shipstreet=?,shipcity=?,shipstate=?,shippincode=?,shipcountry=?,sameasbilling=?,gstrtype=?,gstin=?,moduletype='Vendors',placeos=?,workphone=?,mobile=?,customercode=?,publicid=?,privateid=?,cvisiblity=? WHERE id=?");
				$sqlup->bind_param("sssssssssssssssssisssssssssi", $dlno20, $dlno21, $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $vendorname, $area, $city, $state, $pincode, $district, $sarea, $scity, $sstate, $spincode, $sdistrict, $twosameasbilling, $gstrtype, $gstno, $pos, $twoworkphone, $twomobilephone, $custcustomercode, $custpubliccode, $custprivatecode, $infomainaccesspublicnamecust['customervisible'], $vendorid);
				$sqlup->execute();
				$sqlup->close();
			//FOR B2C VENDOR CHANGES
			}
			$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
			$sqlismainaccessusers->bind_param("i", $userid);
			$sqlismainaccessusers->execute();
			$sqlismainaccessuser = $sqlismainaccessusers->get_result();
			$infomainaccessuser=$sqlismainaccessuser->fetch_array();
			$sqlismainaccessuser->close();
			$sqlismainaccessusers->close();
			for($i=0; $i<count($_POST['oldproductname']); $i++){
				$productid=htmlspecialchars($_POST['oldproductid'][$i], ENT_QUOTES, 'UTF-8');
				$productname=htmlspecialchars($_POST['oldproductname'][$i], ENT_QUOTES, 'UTF-8');
				$manufacturer=htmlspecialchars($_POST['oldmanufacturer'][$i], ENT_QUOTES, 'UTF-8');
				$producthsn=htmlspecialchars($_POST['oldproducthsn'][$i], ENT_QUOTES, 'UTF-8');
				$productnotes=htmlspecialchars($_POST['oldproductnotes'][$i], ENT_QUOTES, 'UTF-8');
				$productdescription=htmlspecialchars($_POST['oldproductdescription'][$i], ENT_QUOTES, 'UTF-8');
				$itemmodule=htmlspecialchars($_POST['olditemmodule'][$i], ENT_QUOTES, 'UTF-8');
				$batch=htmlspecialchars($_POST['oldbatch'][$i], ENT_QUOTES, 'UTF-8');
				$expdate=htmlspecialchars($_POST['oldexpdate'][$i], ENT_QUOTES, 'UTF-8');
				$mrp=htmlspecialchars( (($_POST['oldmrp'][$i]!='')?$_POST['oldmrp'][$i]:0), ENT_QUOTES, 'UTF-8');
				$vat=htmlspecialchars($_POST['oldvat'][$i], ENT_QUOTES, 'UTF-8');
				$salequantity=htmlspecialchars($_POST['oldessalequantity'][$i], ENT_QUOTES, 'UTF-8');
				$quantity=htmlspecialchars($_POST['oldquantity'][$i], ENT_QUOTES, 'UTF-8');
				$unit=htmlspecialchars($_POST['oldproductunit'][$i], ENT_QUOTES, 'UTF-8');
				$productrate=htmlspecialchars($_POST['oldproductrate'][$i], ENT_QUOTES, 'UTF-8');
				$noofpacks=htmlspecialchars($_POST['oldnoofpacks'][$i], ENT_QUOTES, 'UTF-8');
				$prodiscount=htmlspecialchars($_POST['oldprodiscount'][$i], ENT_QUOTES, 'UTF-8');
				$productvalue=htmlspecialchars($_POST['oldproductvalue'][$i], ENT_QUOTES, 'UTF-8');
				$taxvalue=htmlspecialchars($_POST['oldtaxvalue'][$i], ENT_QUOTES, 'UTF-8');
				$productnetvalue=htmlspecialchars($_POST['oldproductnetvalue'][$i], ENT_QUOTES, 'UTF-8');
				if($productname!=''){
					$sql = $con->prepare("DELETE FROM pairbills WHERE createdid=? AND franchisesession=? AND billno=? AND billdate=?");
					$sql->bind_param("ssss", $companymainid, $_SESSION["franchisesession"], $oldbillno, $oldbilldate);
					$sql->execute();
					$sqldelledger = $con->prepare("DELETE FROM pairledgers WHERE createdid=? AND franchisesession=? AND ledgerno=? AND ledgerdate=? AND (type='bill' OR type='bill payment')");
					$sqldelledger->bind_param("ssss", $companymainid, $_SESSION["franchisesession"], $oldbillno, $oldbilldate);
					$sqldelledger->execute();
					$sqls = $con->prepare("DELETE FROM pairpurchasepayments WHERE receiptno=? AND receiptdate=?");
					$sqls->bind_param("ss", $oldbillno, $oldbilldate);
					$sqls->execute();
					$sqls->close();
					$sqlsant = $con->prepare("DELETE FROM pairpurchasepayhistory WHERE billno=? AND billdate=? AND type='bill'");
					$sqlsant->bind_param("ss", $oldbillno, $oldbilldate);
					$sqlsant->execute();
					$sqlsant->close();
					$sqlmarginsdel = $con->prepare("UPDATE pairmargins SET nowstatus='deleted' WHERE createdid=? AND franchisesession=? AND type='buying' AND billingno=? AND billingdate=? AND nowstatus='added'");
					$sqlmarginsdel->bind_param("iiss",$companymainid, $_SESSION["franchisesession"], $oldbillno, $oldbilldate);
					$sqlmarginsdel->execute();
					$sqlmarginsdel->close();
					//FOR MARGIN DELETION
					if($sql){
						$sql->close();
						$sql4 = $con->prepare("UPDATE pairproducts SET openingstock=openingstock-? WHERE id=?");
						$sql4->bind_param("di", $salequantity, $productid);
						$sql4->execute();
						if($sql4){
							$sql4->close();
							if ($cancelstatuscheck=='1') {
								$sqlbatchupd = $con->prepare("UPDATE pairbatch SET createdon=?, createdid=?, createdby=?, franchisesession=?, productid=?, productname=?, manufacturer=?, producthsn=?, productnotes=?, productdescription=?, batch=?, expdate=?, mrp=?, vat=?, quantity=quantity + ?, productrate=?, noofpacks=?, prodiscount=? WHERE createdid=? AND franchisesession=? AND productid=? AND batch=? AND expdate=?");
								$sqlbatchupd->bind_param("ssssssssssssssissssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $batch, $expdate, $mrp, $vat, $quantity, $productrate, $noofpacks, $prodiscount, $companymainid, $_SESSION["franchisesession"], $productid, $batch, $expdate);
								$sqlbatchupd->execute();
								$sqlbatchupd->close();
							}
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
			$sql2=$con->prepare("SELECT id FROM pairbills WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=?");
			$sql2->bind_param("iiss", $_SESSION['franchisesession'], $companymainid, $oldbillno, $oldbilldate);
			$sql2->execute();
			$sql2->store_result();
			//FOR CHECK THE INVOICE IS IN OR NOT
			if($sql2->num_rows==0){
				for($i=0; $i<count($_POST['productname']); $i++){
					$barcode=htmlspecialchars( $_POST['barcode'][$i], ENT_QUOTES, 'UTF-8');
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
					$productwithouttax=htmlspecialchars((((($_POST['productwithouttax'][$i]!='')&&($_POST['productwithouttax'][$i]!='NaN')))?$_POST['productwithouttax'][$i]:'0'), ENT_QUOTES, 'UTF-8');
					$productwithtax=htmlspecialchars((((($_POST['productwithtax'][$i]!='')&&($_POST['productwithtax'][$i]!='NaN')))?$_POST['productwithtax'][$i]:'0'), ENT_QUOTES, 'UTF-8');
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
						$sql = $con->prepare("INSERT INTO pairbills (barcode,createdon,createdid,createdby,franchisesession,vendorname,vendorid,address1,address2,area,city,state,district,pincode,saddress1,saddress2,sarea,scity,sstate,sdistrict,spincode,gstno,billterm,billno,billdate,billamount,duedate,duedates,productid,productname,manufacturer,producthsn,productnotes,productdescription,itemmodule,rack,batch,expdate,mrp,vat,quantity,unit,productrate,noofpacks,prodiscount,productvalue,taxvalue,cgstvat,sgstvat,productnetvalue,totalitems,orderdcno,reference,saleperson,totalvatamount,totalamount,totalquantity,discounttype,discount,discountamount,freightamount,roundoff,grandtotal,preparedby,checkedby,taxtype,tax,cgst,sgst,igst,gst,gstpercent,csgstpercent,terms,notes,description,fileattach,pos,workphone,mobile,sameasbilling,vendorinfodefault,gstrtype,validpaidamount,validbalance,icsgsthis,prodiscounttype,invnumber,invgrandtotal,salequantity,productwithouttax,productwithtax,accountid,accountname,dlno20,dlno21) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$sql->bind_param("ssssssssssssssssssssssssssssssssssssssssisssssssssssssssssssssssssssssssssssssssssssssssssssisss", $barcode, $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $vendorname, $vendorid, $address1, $address2, $area, $city, $state, $district, $pincode, $saddress1, $saddress2, $sarea, $scity, $sstate, $sdistrict, $spincode, $gstno, $billterm, $billno, $billdate, $billamount, $duedate, $duedates, $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $itemmodule, $rack, $batch, $expdate, $mrp, $vat, $quantity, $unit, $productrate, $noofpacks, $prodiscount, $productvalue, $taxvalue,$cgstvat,$sgstvat, $productnetvalue, $totalitems, $orderdcno, $reference, $saleperson, $totalvatamount, $totalamount, $totalquantity, $discounttype, $discount, $discountamount, $freightamount, $roundoff, $grandtotal, $preparedby, $checkedby, $taxtype, $tax, $cgst, $sgst, $igst, $gst, $gstpercent, $csgstpercent, $terms, $notes, $description, $fileattach, $pos, $twoworkphone, $twomobilephone, $twosameasbilling, $scriptonetwo, $gstrtype, $validpaidamount, $validbalance, $ansforsepgstval, $prodiscounttype, $invnumber, $invgrandtotal, $salequantity, $productwithouttax, $productwithtax, $chartaccountid, $accountname, $dlno20, $dlno21);
						//FOR INSERT THE NEW BILL 
						if($sql->execute()){
							$sql->close();
							$purchaseid=$con->insert_id;
							if($billterm=='CASH'){
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
									$sqlaccins = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'bill')");
				    				$sqlaccins->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $accountname, $chartaccountid, $vendorid, $vendorname, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
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

											$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'bill')");
						    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $defaccountnamediscount, $defaccountiddiscount, $vendorid, $vendorname, $prodisvalueforledger, $prodisvalueforledger, $grandtotal, $publicidmanual, $privateidmanual);
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

										$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'bill')");
					    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $defaccountnametds, $defaccountidtds, $vendorid, $vendorname, $taxvalue, $taxvalue, $grandtotal, $publicidmanual, $privateidmanual);
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

									$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'bill')");
				    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $defaccountname, $defaccountid, $vendorid, $vendorname, $productvalue, $productvalue, $grandtotal, $publicidmanual, $privateidmanual);
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

									$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'bill payment')");
				    				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $vendorid, $vendorname, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
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

									$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'bill payment')");
				    				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $defaccountnamepay, $defaccountidpay, $vendorid, $vendorname, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
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
									$sqlaccins = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'bill')");
				    				$sqlaccins->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $accountname, $chartaccountid, $vendorid, $vendorname, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
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

										$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'bill')");
						    			$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $defaccountnamediscount, $defaccountiddiscount, $vendorid, $vendorname, $prodisvalueforledger, $prodisvalueforledger, $grandtotal, $publicidmanual, $privateidmanual);
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

										$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'bill')");
					    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $defaccountnametds, $defaccountidtds, $vendorid, $vendorname, $taxvalue, $taxvalue, $grandtotal, $publicidmanual, $privateidmanual);
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

									$sqlaccdefault = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'bill')");
				    				$sqlaccdefault->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $billdate, $billno, $defaccountname, $defaccountid, $vendorid, $vendorname, $productvalue, $productvalue, $grandtotal, $publicidmanual, $privateidmanual);
				    				$sqlaccdefault->execute();
				    				$sqlaccdefault->close();
								}
							//FOR INSERT THE MANUAL JOURNAL
							}
							$sqlmargins = $con->prepare("INSERT INTO pairmargins (createdon,createdid,franchisesession,type,billername,billerid,billingno,billingdate,productid,productname,batch,expiry,quantity,mrp,rate,nowstatus,taxablevalue,discountvalue,prodiscounttype) VALUES (?, ?, ?, 'buying', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'added', ?, ?, ?)");
		    				$sqlmargins->bind_param("siisississsssssss", $times, $companymainid, $_SESSION["franchisesession"], $vendorname, $vendorid, $billno, $billdate, $productid, $productname, $batch, $expdate, $quantity, $mrp, $productrate, $productvalue, $prodiscount, $prodiscounttype);
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
									$sqlbatchupd = $con->prepare("UPDATE pairbatch SET createdon=?, createdid=?, createdby=?, franchisesession=?, productid=?, productname=?, manufacturer=?, producthsn=?, productnotes=?, productdescription=?, batch=?, expdate=?, mrp=?, vat=?, quantity=quantity + ?, productrate=?, noofpacks=?, prodiscount=?, inctaxmrp=?, exctaxmrp=? WHERE createdid=? AND franchisesession=? AND productid=? AND batch=? AND expdate=?");
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
				if($billterm=='CASH'){
					if ($validpaidamount!=0) {
						$sqlismodulespublicnames=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Payments Made' ORDER BY id ASC");
						$sqlismodulespublicnames->execute();
						$sqlismodulespublicname = $sqlismodulespublicnames->get_result();
						$infomodulespublicname=$sqlismodulespublicname->fetch_array();

						$sqlismainaccesspublicnames=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Payments Made' AND franchiseid=? ORDER BY id ASC");
						$sqlismainaccesspublicnames->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
						$sqlismainaccesspublicnames->execute();
						$sqlismainaccesspublicname = $sqlismainaccesspublicnames->get_result();
						$infomainaccesspublicname=$sqlismainaccesspublicname->fetch_array();

						$publicsqls=$con->prepare("SELECT count(publicid) FROM pairpurchasepayments WHERE createdid=?");
						$publicsqls->bind_param("s", $companymainid);
						$publicsqls->execute();
						$publicsql = $publicsqls->get_result();
						$publicans=$publicsql->fetch_array();
						$oldcodepublic=$publicans[0];
						$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
						$publicsql->close();
						$publicsqls->close();

						$privatesqls=$con->prepare("SELECT count(privateid) FROM pairpurchasepayments WHERE createdid=? AND franchisesession=?");
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

						$sqlselects=$con->prepare("SELECT id FROM pairpurchasepayments WHERE receiptno=? AND receiptdate=?");
						$sqlselects->bind_param("ss", $billno, $billdate);
						$sqlselects->execute();
						if ($sqlselects->num_rows==0) {
							$sqlselectsql = $sqlselects->get_result();
							$sqlselect=$sqlselectsql->fetch_array();
							$sqlpurchasepayins = $con->prepare("INSERT INTO pairpurchasepayments (createdid,createdby,franchisesession,createdon,term,type,vendorname,vendorid,receiptno,receiptdate,amount,paymentmode,notes,publicid,privateid) VALUES (?, ?, ?, ?, 'RECEIPT', 'bill', ?, ?, ?, ?, ?, ?, '-', ?, ?)");
							$sqlpurchasepayins->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $vendorname, $vendorid, $billno, $billdate, $validpaidamount, $billterm, $publiccode, $privatecode);
							$sqlpurchasepayins->execute();
							if($sqlpurchasepayins){
								$sqlpurchasepayins->close();
								$paymentid=$con->insert_id;
								$sqle = $con->prepare("INSERT INTO pairpurchasepayhistory (createdid,createdby,franchisesession,createdon,paymentid,vendorid,billno,billdate,amount,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'bill')");
								$sqle->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $paymentid, $vendorid, $billno, $billdate, $validpaidamount);
								$sqle->execute();
								$sqle->close();
								$oldesbillno = htmlspecialchars( $_POST['oldesbillno'], ENT_QUOTES, 'UTF-8');
								$oldesbilldate = htmlspecialchars( $_POST['oldesbilldate'], ENT_QUOTES, 'UTF-8');
								$oldesvendorname = htmlspecialchars( $_POST['oldesvendorname'], ENT_QUOTES, 'UTF-8');
								$oldesbillterm = htmlspecialchars( $_POST['oldesbillterm'], ENT_QUOTES, 'UTF-8');
								$oldesvalidpaidamount = htmlspecialchars( $_POST['oldesvalidpaidamount'], ENT_QUOTES, 'UTF-8');
								$chforpayments='';
								$sqlismainaccessuservens=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Vendors' ORDER BY id ASC");
								$sqlismainaccessuservens->bind_param("s", $userid);
								$sqlismainaccessuservens->execute();
								$sqlismainaccessuserven = $sqlismainaccessuservens->get_result();
								$infomainaccessuserven=$sqlismainaccessuserven->fetch_array();
								$sqlismainaccessuserven->close();
								$sqlismainaccessuservens->close();
								if($vendorname!=$oldesvendorname){
									if($chforpayments!=''){
										$chforpayments.='<br> '.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldvendorname.' To '.$vendorname.' ) </span>';
									}
									else{
										$chforpayments.=''.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldvendorname.' To '.$vendorname.' ) </span>';
									}					
								}
								if($billdate!=$oldesbilldate){
									if($chforpayments!=''){
										$chforpayments.='<br> Date <span style="color:green;" id="prohisfromtospan">( From '.date($datemainphp,strtotime($billdate)).' To '.date($datemainphp,strtotime($oldbilldate)).' ) </span>';
									}
									else{
										$chforpayments.=' Date <span style="color:green;" id="prohisfromtospan">( From '.date($datemainphp,strtotime($billdate)).' To '.date($datemainphp,strtotime($oldbilldate)).' ) </span>';
									}					
								}
								if($billno!=$oldesbillno){
									if($chforpayments!=''){
										$chforpayments.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( From '.$oldbillno.' To '.$billno.' ) </span>';
									}
									else{
										$chforpayments.='Reference Number <span style="color:green;" id="prohisfromtospan">( From '.$oldbillno.' To '.$billno.' ) </span>';
									}					
								}
								if($billterm!=$oldesbillterm){
									if($chforpayments!=''){
										$chforpayments.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldesbillterm.' To '.$billterm.' ) </span>';
									}
									else{
										$chforpayments.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldesbillterm.' To '.$billterm.' ) </span>';
									}					
								}
								if($validpaidamount!=$oldesvalidpaidamount){
									if($chforpayments!=''){
										$chforpayments.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidpaidamount.' To '.$validpaidamount.' ) </span>';
									}
									else{
										$chforpayments.='Amount Received <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidpaidamount.' To '.$validpaidamount.' ) </span>';
									}					
								}
								if($validpaidamount!=$oldesvalidpaidamount){
									if($billdate!=''){
										if($chforpayments!=''){
											$chforpayments.='<br> <span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> (Selected) <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($billdate)).' ) </span>';
										}
										else{
											$chforpayments.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> (Selected) <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($billdate)).' ) </span>';
										}
									}
									if($billno!=''){
										if($chforpayments!=''){
											$chforpayments.='<br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$billno.' ) </span>';
										}
										else{
											$chforpayments.=''.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$billno.' ) </span>';
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
									if($chforpayments!=''){
										$chforpayments.='<br> Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidpaidamount.' To '.$validpaidamount.' ) </span>';
									}
									else{
										$chforpayments.='Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidpaidamount.' To '.$validpaidamount.' ) </span>';
									}					
								}
								if($validpaidamount!=$oldesvalidpaidamount){
									if($chforpayments!=''){
										$chforpayments.='<br> Total <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidpaidamount.' To '.$validpaidamount.' ) </span>';
									}
									else{
										$chforpayments.='Total <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidpaidamount.' To '.$validpaidamount.' ) </span>';
									}					
								}
								if($chforpayments!=''){
									$sqlusepayments = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,useremarks) VALUES ('PURCHASEPAY', ?, ?, ?, ?)");
									$sqlusepayments->bind_param("ssss", $times, $_SESSION["unqwerty"], $paymentid, $chforpayments);
									$sqlusepayments->execute();
									$sqlusepayments->close();
								}
								if($paymentidforupdpayhis!=''){
									$sqlusepayments = $con->prepare("UPDATE pairusehistory SET useid=? WHERE useid=?");
									$sqlusepayments->bind_param("ss",$paymentid, $paymentidforupdpayhis);
									$sqlusepayments->execute();
									$sqlusepayments->close();
								}
							}
							//FOR INSERT THE PAYMENT DETAILS
						}
						else{
							$sqlbatchupd = $con->prepare("UPDATE pairpurchasepayments SET createdid=?, createdby=?, franchisesession=?, createdon=?,  term='RECEIPT', type='bill', vendorname=?, vendorid=?, receiptno=?, receiptdate=?, amount=?, paymentmode=?, notes='-' WHERE receiptno=? AND receiptdate=?");
							$sqlbatchupd->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $vendorname, $vendorid, $billno, $billdate, $validpaidamount, $billterm, $billno, $billdate);
							$sqlbatchupd->execute();
							if($sqlbatchupd){
								$sqlbatchupd->close();
								$sqle = $con->prepare("UPDATE pairpurchasepayhistory SET amount=? WHERE billno=? AND billdate=? AND type='bill'");
								$sqle->bind_param("sss", $validpaidamount, $billno, $billdate);
								$sqle->execute();
								$sqle->close();
							}
							//FOR UPDATE THE PAYMENT DETAILS
						}
						$sqlselects->close();
					}
					else{
						$sqlbatchupdant = $con->prepare("UPDATE pairpurchasepayments SET createdid=?, createdby=?, franchisesession=?, createdon=?,  term='RECEIPT', type='bill', vendorname=?, vendorid=?, receiptno=?, receiptdate=?, amount=?, paymentmode=?, notes='-' WHERE receiptno=? AND receiptdate=?");
						$sqlbatchupdant->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $vendorname, $vendorid, $billno, $billdate, $validpaidamount, $billterm, $billno, $billdate);
						$sqlbatchupdant->execute();
						if($sqlbatchupdant){
							$sqlbatchupdant->close();
							$sqleant = $con->prepare("UPDATE pairpurchasepayhistory SET amount=? WHERE billno=? AND billdate=? AND type='bill'");
							$sqleant->bind_param("sss", $validpaidamount, $billno, $billdate);
							$sqleant->execute();
							$sqleant->close();
						}
						//FOR UPDATE THE PAYMENT DETAILS HISTORY
					}
					if($validpaidamount==$grandtotal){
						$sqler = $con->prepare("UPDATE pairbills SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='1' WHERE billno=? AND billdate=? AND vendorid=? AND franchisesession=? AND createdid=?");
	    				$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $billno, $billdate, $vendorid, $_SESSION['franchisesession'], $companymainid);
	    				$sqler->execute();
						$sqler->close();
						//FOR UPDATE THE PAYMENT STATUS PAID
					}
					else{
						$sqler = $con->prepare("UPDATE pairbills SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='2' WHERE billno=? AND billdate=? AND vendorid=? AND franchisesession=? AND createdid=?");
	    				$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $billno, $billdate, $vendorid, $_SESSION['franchisesession'], $companymainid);
	    				$sqler->execute();
						$sqler->close();
						//FOR UPDATE THE PAYMENT STATUS UNPAID
					}
				}
				elseif($billterm=='CREDIT'){
					$sqls = $con->prepare("DELETE FROM pairpurchasepayments WHERE receiptno=? AND receiptdate=?");
					$sqls->bind_param("ss", $billno, $billdate);
					$sqls->execute();
					$sqls->close();
					$sqlsant = $con->prepare("DELETE FROM pairpurchasepayhistory WHERE billno=? AND billdate=? AND type='bill'");
					$sqlsant->bind_param("ss", $billno, $billdate);
					$sqlsant->execute();
					$sqlsant->close();
					//FOR UPDATE THE PAYMENT STATUS UNPAID
					$sqldelledgerpay = $con->prepare("DELETE FROM pairledgers WHERE createdid=? AND franchisesession=? AND ledgerno=? AND ledgerdate=? AND type='bill payment'");
					$sqldelledgerpay->bind_param("ssss", $companymainid, $_SESSION["franchisesession"], $billno, $billdate);
					$sqldelledgerpay->execute();
					$sqler = $con->prepare("UPDATE pairbills SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='0' WHERE billno=? AND billdate=? AND vendorid=? AND franchisesession=? AND createdid=?");
	    			$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $billno, $billdate, $vendorid, $_SESSION['franchisesession'], $companymainid);
	    			$sqler->execute();
					$sqler->close();
					//FOR UPDATE THE PAYMENT STATUS UNPAID
				}
				if($sql){
					$sqlibills=$con->prepare("SELECT billamount, billdate, billno FROM pairbills WHERE franchisesession=? AND createdid=? AND vendorid=? GROUP BY billdate, billno ORDER BY billdate DESC, billno DESC");
					$sqlibills->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $vendorid);
					$sqlibills->execute();
					$billamount=0;
					$balanceamount=0;
					$currentamount=0;
					$overdueamount=0;
					$sqlibill = $sqlibills->get_result();
					while($infobill=$sqlibill->fetch_array()){
						$billamount+=(float)$infobill['billamount'];
						$paidamount=0;
						$sqlpurchasespays=$con->prepare("SELECT amount FROM pairpurchasepayhistory WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? AND vendorid=? ORDER BY id DESC");
						$sqlpurchasespays->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $infobill['billno'], $infobill['billdate'], $vendorid);
						$sqlpurchasespays->execute();
						$sqlpurchasespay = $sqlpurchasespays->get_result();
						while($infopurchasespay=$sqlpurchasespay->fetch_array()){
							$paidamount+=(float)$infopurchasespay['amount'];
						}
						$balanceamount+=((float)$infobill['billamount']-$paidamount);
						$diff = abs(time() - strtotime($infobill['billdate']));
						$days = floor(($diff)/ (60*60*24));
						if($days>30){
							$overdueamount+=((float)$infobill['billamount']-$paidamount);
						}
						else{
							$currentamount+=((float)$infobill['billamount']-$paidamount);
						}
					}
					$sqlidebitnotes=$con->prepare("SELECT debitnoteamount, debitnotedate, debitnoteno FROM pairdebitnotes WHERE franchisesession=? AND createdid=? AND vendorid=? GROUP BY debitnotedate, debitnoteno ORDER BY debitnotedate DESC, debitnoteno DESC");
					$sqlidebitnotes->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $vendorid);
					$sqlidebitnotes->execute();
					$sqlidebitnote = $sqlidebitnotes->get_result();
					while($infodebitnote=$sqlidebitnote->fetch_array()){
						$billamount+=(float)$infodebitnote['debitnoteamount'];
						$paidamount=0;
						$sqlpurchasespays=$con->prepare("SELECT amount FROM pairdebitnotepayhistory WHERE franchisesession=? AND createdid=? AND debitnoteno=? AND debitnotedate=? AND vendorid=? ORDER BY id ASC");
						$sqlpurchasespays->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $infodebitnote['debitnoteno'], $infodebitnote['debitnotedate'], $vendorid);
						$sqlpurchasespays->execute();
						$sqlpurchasespay = $sqlpurchasespays->get_result();
						while($infopurchasespay=$sqlpurchasespay->fetch_array()){
								$paidamount+=(float)$infopurchasespay['amount'];
						}
						$balanceamount-=((float)$infodebitnote['debitnoteamount']);
						$diff = abs(time() - strtotime($infodebitnote['debitnotedate']));
						$days = floor(($diff)/ (60*60*24));
						if($days>30){
								$overdueamount-=((float)$infodebitnote['debitnoteamount']);
						}
						else{
								$currentamount-=((float)$infodebitnote['debitnoteamount']);
						}
						$sqlpurchasespay->close();
						$sqlpurchasespays->close();
					}
					$sqlidebitnote->close();
					$sqlidebitnotes->close();
					$cussqlup = $con->prepare("UPDATE paircustomers SET invoiceamount=?,balanceamount=?,currentamount=?,overdueamount=? WHERE id=?");
					$cussqlup->bind_param("sssss", $billamount, $balanceamount, $currentamount, $overdueamount, $vendorid);
					$cussqlup->execute();
					$cussqlup->close();
					if(isset($_POST['submit1'])){
						echo '<script> window.open("billprint.php?billno='.$billno.'&billdate='.$billdate.'", "_blank");</script>';
						echo '<script> window.location.href="bills.php?remarks=Updated Successfully";</script>'; 
					}
					else{
						$sqluse = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,uniqueid,useremarks) VALUES ('BILLS', ?, ?, ?, ?, '<span style=\"color:green;\" id=\"prohisfromtospan\">Updated Successfully</span>')");
			    		$sqluse->bind_param("ssss", $times, $_SESSION["unqwerty"], $billno, $purchaseid);
			    		$sqluse->execute();
			    		$sqluse->close();
						echo '<script> window.location.href="billview.php?id='.$purchaseid.'&billno='.$billno.'&billdate='.$billdate.'&remarks=Updated Successfully";</script>';
					}
				}
				//FOR VENDOR BALANCE UPDATION DETAILS
			}
			else{
				header("Location: bills.php?error=Error Data");
			}
			if ($sql) {
				$oldesbillno = htmlspecialchars($_POST['oldesbillno'], ENT_QUOTES, 'UTF-8');
				$oldesinvnumber = htmlspecialchars($_POST['oldesinvnumber'], ENT_QUOTES, 'UTF-8');
				$oldesbilldate = htmlspecialchars($_POST['oldesbilldate'], ENT_QUOTES, 'UTF-8');
				$oldesreference = htmlspecialchars($_POST['oldesreference'], ENT_QUOTES, 'UTF-8');
				$oldessaleperson = htmlspecialchars($_POST['oldessaleperson'], ENT_QUOTES, 'UTF-8');
				$oldespreparedby = htmlspecialchars($_POST['oldespreparedby'], ENT_QUOTES, 'UTF-8');
				$oldescheckedby = htmlspecialchars($_POST['oldescheckedby'], ENT_QUOTES, 'UTF-8');
				$oldesinvgrandtotal = htmlspecialchars($_POST['oldesinvgrandtotal'], ENT_QUOTES, 'UTF-8');
				$oldesvendorname = htmlspecialchars($_POST['oldesvendorname'], ENT_QUOTES, 'UTF-8');
				$oldesarea = htmlspecialchars($_POST['oldesarea'], ENT_QUOTES, 'UTF-8');
				$oldescity = htmlspecialchars($_POST['oldescity'], ENT_QUOTES, 'UTF-8');
				$oldesstate = htmlspecialchars($_POST['oldesstate'], ENT_QUOTES, 'UTF-8');
				$oldesdistrict = htmlspecialchars($_POST['oldesdistrict'], ENT_QUOTES, 'UTF-8');
				$oldespincode = htmlspecialchars($_POST['oldespincode'], ENT_QUOTES, 'UTF-8');
				$oldessarea = htmlspecialchars($_POST['oldessarea'], ENT_QUOTES, 'UTF-8');
				$oldesscity = htmlspecialchars($_POST['oldesscity'], ENT_QUOTES, 'UTF-8');
				$oldessstate = htmlspecialchars($_POST['oldessstate'], ENT_QUOTES, 'UTF-8');
				$oldessdistrict = htmlspecialchars($_POST['oldessdistrict'], ENT_QUOTES, 'UTF-8');
				$oldesspincode = htmlspecialchars($_POST['oldesspincode'], ENT_QUOTES, 'UTF-8');
				$oldestwoworkphone = htmlspecialchars($_POST['oldesworkphone'], ENT_QUOTES, 'UTF-8');
				$oldestwomobilephone = htmlspecialchars($_POST['oldesmobile'], ENT_QUOTES, 'UTF-8');
				$oldesgstrtype = htmlspecialchars($_POST['oldesgstrtype'], ENT_QUOTES, 'UTF-8');
				$oldesgstno = htmlspecialchars($_POST['oldesgstno'], ENT_QUOTES, 'UTF-8');
				$oldespos = htmlspecialchars($_POST['oldespos'], ENT_QUOTES, 'UTF-8');
				$oldesdlno20 = htmlspecialchars($_POST['oldesdlno20'], ENT_QUOTES, 'UTF-8');
				$oldesdlno21 = htmlspecialchars($_POST['oldesdlno21'], ENT_QUOTES, 'UTF-8');
				$oldestotalitems = htmlspecialchars($_POST['oldestotalitems'], ENT_QUOTES, 'UTF-8');
				$oldestotalquantity = htmlspecialchars($_POST['oldestotalquantity'], ENT_QUOTES, 'UTF-8');
				$oldestotalamount = htmlspecialchars($_POST['oldestotalamount'], ENT_QUOTES, 'UTF-8');
				$oldesdiscountamount = htmlspecialchars($_POST['oldesdiscountamount'], ENT_QUOTES, 'UTF-8');
				$oldestotalvatamount = htmlspecialchars($_POST['oldestotalvatamount'], ENT_QUOTES, 'UTF-8');
				$oldesroundoff = htmlspecialchars($_POST['oldesroundoff'], ENT_QUOTES, 'UTF-8');
				$oldesgrandtotal = htmlspecialchars($_POST['oldesgrandtotal'], ENT_QUOTES, 'UTF-8');
				$oldesdescription = htmlspecialchars($_POST['oldesdescription'], ENT_QUOTES, 'UTF-8');
				$oldesnotes = htmlspecialchars($_POST['oldesnotes'], ENT_QUOTES, 'UTF-8');
				$oldesterms = htmlspecialchars($_POST['oldesterms'], ENT_QUOTES, 'UTF-8');
				$oldesfileattach = htmlspecialchars($_POST['oldesfileattach'], ENT_QUOTES, 'UTF-8');
				$oldesbillterm = htmlspecialchars($_POST['oldesbillterm'], ENT_QUOTES, 'UTF-8');
				$oldesvalidpaidamount = htmlspecialchars($_POST['oldesvalidpaidamount'], ENT_QUOTES, 'UTF-8');
				$oldesvalidbalance = htmlspecialchars($_POST['oldesvalidbalance'], ENT_QUOTES, 'UTF-8');
				$oldesduedates = htmlspecialchars($_POST['oldesduedates'], ENT_QUOTES, 'UTF-8');
				$oldesduedate = htmlspecialchars($_POST['oldesduedate'], ENT_QUOTES, 'UTF-8'); 
				$billinfoch = '';
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
				if($billno!=$oldesbillno){
					if($billinfoch!=''){
						$billinfoch.='<br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( From '.$oldesbillno.' To '.$billno.' ) </span>';
					}
					else{
						$billinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> '.$infomainaccessuser['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( From '.$oldesbillno.' To '.$billno.' ) </span>';
					}                   
				}
				if($invnumber!=$oldesinvnumber){
					if($billinfoch!=''){
						$billinfoch.='<br> Invoice Number <span style="color:green;" id="prohisfromtospan">( From '.$oldesinvnumber.' To '.$invnumber.' ) </span>';
					}
					else{
						$billinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Invoice Number <span style="color:green;" id="prohisfromtospan">( From '.$oldesinvnumber.' To '.$invnumber.' ) </span>';
					}                   
				}
				if($billdate!=$oldesbilldate){
					if($billinfoch!=''){
						$billinfoch.='<br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesbilldate)).' To '.date($date,strtotime($billdate)).' ) </span>';
					}
					else{
						$billinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> '.$infomainaccessuser['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesbilldate)).' To '.date($date,strtotime($billdate)).' ) </span>';
					}                   
				}
				if($reference!=$oldesreference){
					if($billinfoch!=''){
						$billinfoch.='<br> Reference <span style="color:green;" id="prohisfromtospan">( From '.$oldesreference.' To '.$reference.' ) </span>';
					}
					else{
						$billinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Reference <span style="color:green;" id="prohisfromtospan">( From '.$oldesreference.' To '.$reference.' ) </span>';
					}                   
				}
				if($saleperson!=$oldessaleperson){
					if($billinfoch!=''){
						$billinfoch.='<br> Sale Person <span style="color:green;" id="prohisfromtospan">( From '.$oldessaleperson.' To '.$saleperson.' ) </span>';
					}
					else{
						$billinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Sale Person <span style="color:green;" id="prohisfromtospan">( From '.$oldessaleperson.' To '.$saleperson.' ) </span>';
					}                   
				}
				if($preparedby!=$oldespreparedby){
					if($billinfoch!=''){
						$billinfoch.='<br> Prepared By <span style="color:green;" id="prohisfromtospan">( From '.$oldespreparedby.' To '.$preparedby.' ) </span>';
					}
					else{
						$billinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Prepared By <span style="color:green;" id="prohisfromtospan">( From '.$oldespreparedby.' To '.$preparedby.' ) </span>';
					}                   
				}
				if($checkedby!=$oldescheckedby){
					if($billinfoch!=''){
						$billinfoch.='<br> Checked By <span style="color:green;" id="prohisfromtospan">( From '.$oldescheckedby.' To '.$checkedby.' ) </span>';
					}
					else{
						$billinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Checked By <span style="color:green;" id="prohisfromtospan">( From '.$oldescheckedby.' To '.$checkedby.' ) </span>';
					}                   
				}
				if($invgrandtotal!=$oldesinvgrandtotal){
					if($billinfoch!=''){
						$billinfoch.='<br> Grand Total <span style="color:green;" id="prohisfromtospan">( From '.$oldesinvgrandtotal.' To '.$invgrandtotal.' ) </span>';
					}
					else{
						$billinfoch.='<span style="color:royalblue;">'.$infomainaccessuser['modulename'].' Information</span> <br> Grand Total <span style="color:green;" id="prohisfromtospan">( From '.$oldesinvgrandtotal.' To '.$invgrandtotal.' ) </span>';
					}                   
				}
				//FOR BILL INFORMATIONS HISTORY DETAILS
				$billveninfoch = '';
				$sqlismainaccessuservens=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Vendors' ORDER BY id ASC");
		    	$sqlismainaccessuservens->bind_param("s", $userid);
				$sqlismainaccessuservens->execute();
				$sqlismainaccessuserven = $sqlismainaccessuservens->get_result();
				$infomainaccessuserven=$sqlismainaccessuserven->fetch_array();
				$sqlismainaccessuserven->close();
				$sqlismainaccessuservens->close();
				if($vendorname!=$oldesvendorname){
					if($billveninfoch!=''){
						$billveninfoch.='<br> '.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldesvendorname.' To '.$vendorname.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> '.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldesvendorname.' To '.$vendorname.' ) </span>';
					}                   
				}
				if($area!=$oldesarea){
					if($billveninfoch!=''){
						$billveninfoch.='<br> BILLING STREET <span style="color:green;" id="prohisfromtospan">( From '.$oldesarea.' To '.$area.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> BILLING STREET <span style="color:green;" id="prohisfromtospan">( From '.$oldesarea.' To '.$area.' ) </span>';
					}                   
				}
				if($city!=$oldescity){
					if($billveninfoch!=''){
						$billveninfoch.='<br> BILLING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( From '.$oldescity.' To '.$city.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> BILLING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( From '.$oldescity.' To '.$city.' ) </span>';
					}                   
				}
				if($state!=$oldesstate){
					if($billveninfoch!=''){
						$billveninfoch.='<br> BILLING STATE <span style="color:green;" id="prohisfromtospan">( From '.$oldesstate.' To '.$state.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> BILLING STATE <span style="color:green;" id="prohisfromtospan">( From '.$oldesstate.' To '.$state.' ) </span>';
					}                   
				}
				if($district!=$oldesdistrict){
					if($billveninfoch!=''){
						$billveninfoch.='<br> BILLING PIN <span style="color:green;" id="prohisfromtospan">( From '.$oldesdistrict.' To '.$district.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> BILLING PIN <span style="color:green;" id="prohisfromtospan">( From '.$oldesdistrict.' To '.$district.' ) </span>';
					}                   
				}
				if($pincode!=$oldespincode){
					if($billveninfoch!=''){
						$billveninfoch.='<br> BILLING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( From '.$oldespincode.' To '.$pincode.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> BILLING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( From '.$oldespincode.' To '.$pincode.' ) </span>';
					}                   
				}
				if($sarea!=$oldessarea){
					if($billveninfoch!=''){
						$billveninfoch.='<br> SHIPPING STREET <span style="color:green;" id="prohisfromtospan">( From '.$oldessarea.' To '.$sarea.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING STREET <span style="color:green;" id="prohisfromtospan">( From '.$oldessarea.' To '.$sarea.' ) </span>';
					}                   
				}
				if($scity!=$oldesscity){
					if($billveninfoch!=''){
						$billveninfoch.='<br> SHIPPING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( From '.$oldesscity.' To '.$scity.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING CITY/TOWN <span style="color:green;" id="prohisfromtospan">( From '.$oldesscity.' To '.$scity.' ) </span>';
					}                   
				}
				if($sstate!=$oldessstate){
					if($billveninfoch!=''){
						$billveninfoch.='<br> SHIPPING STATE <span style="color:green;" id="prohisfromtospan">( From '.$oldessstate.' To '.$sstate.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING STATE <span style="color:green;" id="prohisfromtospan">( From '.$oldessstate.' To '.$sstate.' ) </span>';
					}                   
				}
				if($sdistrict!=$oldessdistrict){
					if($billveninfoch!=''){
						$billveninfoch.='<br> SHIPPING PIN <span style="color:green;" id="prohisfromtospan">( From '.$oldessdistrict.' To '.$sdistrict.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING PIN <span style="color:green;" id="prohisfromtospan">( From '.$oldessdistrict.' To '.$sdistrict.' ) </span>';
					}                   
				}
				if($spincode!=$oldesspincode){
					if($billveninfoch!=''){
						$billveninfoch.='<br> SHIPPING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( From '.$oldesspincode.' To '.$spincode.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> SHIPPING COUNTRY/REGION <span style="color:green;" id="prohisfromtospan">( From '.$oldesspincode.' To '.$spincode.' ) </span>';
					}                   
				}
				if($twoworkphone!=$oldestwoworkphone){
					if($billveninfoch!=''){
						$billveninfoch.='<br> WORK PHONE <span style="color:green;" id="prohisfromtospan">( From '.$oldestwoworkphone.' To '.$twoworkphone.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> WORK PHONE <span style="color:green;" id="prohisfromtospan">( From '.$oldestwoworkphone.' To '.$twoworkphone.' ) </span>';
					}                   
				}
				if($twomobilephone!=$oldestwomobilephone){
					if($billveninfoch!=''){
						$billveninfoch.='<br> MOBILE PHONE <span style="color:green;" id="prohisfromtospan">( From '.$oldestwomobilephone.' To '.$twomobilephone.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> MOBILE PHONE <span style="color:green;" id="prohisfromtospan">( From '.$oldestwomobilephone.' To '.$twomobilephone.' ) </span>';
					}                   
				}
				if($gstrtype!=$oldesgstrtype){
					if($billveninfoch!=''){
						$billveninfoch.='<br> GST TREATMENT <span style="color:green;" id="prohisfromtospan">( From '.$oldesgstrtype.' To '.$gstrtype.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> GST TREATMENT <span style="color:green;" id="prohisfromtospan">( From '.$oldesgstrtype.' To '.$gstrtype.' ) </span>';
					}                   
				}
				if($gstno!=$oldesgstno){
					if($billveninfoch!=''){
						$billveninfoch.='<br> GSTIN <span style="color:green;" id="prohisfromtospan">( From '.$oldesgstno.' To '.$gstno.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> GSTIN <span style="color:green;" id="prohisfromtospan">( From '.$oldesgstno.' To '.$gstno.' ) </span>';
					}                   
				}
				if($pos!=$oldespos){
					if($billveninfoch!=''){
						$billveninfoch.='<br> PLACE OF SUPPLY <span style="color:green;" id="prohisfromtospan">( From '.$oldespos.' To '.$pos.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> PLACE OF SUPPLY <span style="color:green;" id="prohisfromtospan">( From '.$oldespos.' To '.$pos.' ) </span>';
					}                   
				}
				if($dlno20!=$oldesdlno20){
					if($billveninfoch!=''){
						$billveninfoch.='<br> DL No 20 <span style="color:green;" id="prohisfromtospan">( From '.$oldesdlno20.' To '.$dlno20.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> DL No 20 <span style="color:green;" id="prohisfromtospan">( From '.$oldesdlno20.' To '.$dlno20.' ) </span>';
					}                   
				}
				if($dlno21!=$oldesdlno21){
					if($billveninfoch!=''){
						$billveninfoch.='<br> DL No 21 <span style="color:green;" id="prohisfromtospan">( From '.$oldesdlno21.' To '.$dlno21.' ) </span>';
					}
					else{
						$billveninfoch.=''.(($billinfoch!='')?'<br>':'').'<span style="color:royalblue;">'.$infomainaccessuserven['modulename'].' Information</span> <br> DL No 21 <span style="color:green;" id="prohisfromtospan">( From '.$oldesdlno21.' To '.$dlno21.' ) </span>';
					}                   
				}
				//FOR BILL VENDOR INFORMATIONS DETAILS HISTORY
				$billiteminfoch = '';
				$sqlismainaccessuserpros=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Products' ORDER BY id ASC");
		    	$sqlismainaccessuserpros->bind_param("s", $userid);
				$sqlismainaccessuserpros->execute();
				$sqlismainaccessuserpro = $sqlismainaccessuserpros->get_result();
				$infomainaccessuserpro=$sqlismainaccessuserpro->fetch_array();
				$sqlismainaccessuserpro->close();
				$sqlismainaccessuserpros->close();
				$curans=0;
				for($cur=0; $cur<count($_POST['productname']); $cur++){
					if ($_POST['productname'][$cur]!='') {
						$curans++;
					}
				}
				$oldans=0;
				for($old=0; $old<count($_POST['oldesproductname']); $old++){
					$oldans++;
				}
				if ($oldans==$curans) {
					for($i=0; $i<count($_POST['oldesproductname']); $i++){
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
						$oldesproductid=htmlspecialchars($_POST['oldesproductid'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductname=htmlspecialchars($_POST['oldesproductname'][$i], ENT_QUOTES, 'UTF-8');
						$oldesmanufacturer=htmlspecialchars($_POST['oldesmanufacturer'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproducthsn=htmlspecialchars($_POST['oldesproducthsn'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductnotes=htmlspecialchars($_POST['oldesproductnotes'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductdescription=htmlspecialchars($_POST['oldesproductdescription'][$i], ENT_QUOTES, 'UTF-8');
						$oldesitemmodule=htmlspecialchars($_POST['oldesitemmodule'][$i], ENT_QUOTES, 'UTF-8');
						if ($access['batchexpiryval']==1) {
							$oldesbatch=htmlspecialchars($_POST['oldesbatch'][$i], ENT_QUOTES, 'UTF-8');
							$oldesexpdate=htmlspecialchars($_POST['oldesexpdate'][$i], ENT_QUOTES, 'UTF-8');
						}
						else{
							$oldesbatch='';
							$oldesexpdate='';
						}
						$oldesmrp=htmlspecialchars( (($_POST['oldesmrp'][$i]!='')?$_POST['oldesmrp'][$i]:0), ENT_QUOTES, 'UTF-8');
						$oldesvat=htmlspecialchars($_POST['oldesvat'][$i], ENT_QUOTES, 'UTF-8');
						$oldesicsgsthis=htmlspecialchars($_POST['oldesicsgsthis'][$i], ENT_QUOTES, 'UTF-8');
						$oldesquantity=htmlspecialchars($_POST['oldesquantity'][$i], ENT_QUOTES, 'UTF-8');
						$oldesunit=htmlspecialchars($_POST['oldesproductunit'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductrate=htmlspecialchars($_POST['oldesproductrate'][$i], ENT_QUOTES, 'UTF-8');
						$oldesnoofpacks=htmlspecialchars($_POST['oldesnoofpacks'][$i], ENT_QUOTES, 'UTF-8');
						$oldesprodiscount=htmlspecialchars($_POST['oldesprodiscount'][$i], ENT_QUOTES, 'UTF-8');
						$oldesprodiscounttype=htmlspecialchars($_POST['oldesprodiscounttype'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductvalue=htmlspecialchars($_POST['oldesproductvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldestaxvalue=htmlspecialchars($_POST['oldestaxvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductnetvalue=htmlspecialchars($_POST['oldesproductnetvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldessalequantity=htmlspecialchars($_POST['oldessalequantity'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductwithouttax=htmlspecialchars($_POST['oldesproductwithouttax'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductwithtax=htmlspecialchars($_POST['oldesproductwithtax'][$i], ENT_QUOTES, 'UTF-8');
						if($productname!=''){
							if($productname!=$oldesproductname){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductname.' To '.$productname.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductname.' To '.$productname.' ) </span>';
								}                   
							}
							if($manufacturer!=$oldesmanufacturer){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesmanufacturer.' To '.$manufacturer.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesmanufacturer.' To '.$manufacturer.' ) </span>';
								}                   
							}
							if($producthsn!=$oldesproducthsn){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> HSN Code <span style="color:green;" id="prohisfromtospan">( From '.$oldesproducthsn.' To '.$producthsn.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> HSN Code <span style="color:green;" id="prohisfromtospan">( From '.$oldesproducthsn.' To '.$producthsn.' ) </span>';
								}                   
							}
							if($productdescription!=$oldesproductdescription){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductdescription.' To '.$productdescription.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductdescription.' To '.$productdescription.' ) </span>';
								}                   
							}
							if($batch!=$oldesbatch){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Batch <span style="color:green;" id="prohisfromtospan">( From '.$oldesbatch.' To '.$batch.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Batch <span style="color:green;" id="prohisfromtospan">( From '.$oldesbatch.' To '.$batch.' ) </span>';
								}                   
							}
							if($expdate!=$oldesexpdate){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Expiry <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesexpdate)).' To '.date($date,strtotime($expdate)).' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Expiry <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesexpdate)).' To '.date($date,strtotime($expdate)).' ) </span>';
								}                   
							}
							if($productrate!=$oldesproductrate){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductrate.' To '.$productrate.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductrate.' To '.$productrate.' ) </span>';
								}                   
							}
							if($mrp!=$oldesmrp){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldesmrp.' To '.$mrp.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldesmrp.' To '.$mrp.' ) </span>';
								}                   
							}
							if($quantity!=$oldesquantity){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Quantity <span style="color:green;" id="prohisfromtospan">( From '.$oldesquantity.' To '.$quantity.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Quantity <span style="color:green;" id="prohisfromtospan">( From '.$oldesquantity.' To '.$quantity.' ) </span>';
								}                   
							}
							if($unit!=$oldesunit){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Unit <span style="color:green;" id="prohisfromtospan">( From '.$oldesunit.' To '.$unit.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Unit <span style="color:green;" id="prohisfromtospan">( From '.$oldesunit.' To '.$unit.' ) </span>';
								}                   
							}
							if($noofpacks!=$oldesnoofpacks){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Pack <span style="color:green;" id="prohisfromtospan">( From '.$oldesnoofpacks.' To '.$noofpacks.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Pack <span style="color:green;" id="prohisfromtospan">( From '.$oldesnoofpacks.' To '.$noofpacks.' ) </span>';
								}                   
							}
							if($productvalue!=$oldesproductvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Taxable Value <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductvalue.' To '.$productvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Taxable Value <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductvalue.' To '.$productvalue.' ) </span>';
								}                   
							}
							if($prodiscount!=$oldesprodiscount){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$access['txtprodisbill'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesprodiscount.' To '.$prodiscount.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtprodisbill'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesprodiscount.' To '.$prodiscount.' ) </span>';
								}                   
							}
							if($prodiscounttype!=$oldesprodiscounttype){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Discounted By <span style="color:green;" id="prohisfromtospan">( From '.(($oldesprodiscounttype==0)?'%':'?').' To '.(($prodiscounttype==0)?'%':'?').' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discounted By <span style="color:green;" id="prohisfromtospan">( From '.(($oldesprodiscounttype==0)?'%':'?').' To '.(($prodiscounttype==0)?'%':'?').' ) </span>';
								}                   
							}
							if($taxvalue!=$oldestaxvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Tax Value <span style="color:green;" id="prohisfromtospan">( From '.$oldestaxvalue.' To '.$taxvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Tax Value <span style="color:green;" id="prohisfromtospan">( From '.$oldestaxvalue.' To '.$taxvalue.' ) </span>';
								}                   
							}
							if($vat!=$oldesvat){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Gst <span style="color:green;" id="prohisfromtospan">( From '.$oldesvat.' % ('.$oldesicsgsthis.') To '.$vat.' % ('.$ansforsepgstval.') ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Gst <span style="color:green;" id="prohisfromtospan">( From '.$oldesvat.' % ('.$oldesicsgsthis.') To '.$vat.' % ('.$ansforsepgstval.') ) </span>';
								}                   
							}
							if($productnetvalue!=$oldesproductnetvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Amount <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductnetvalue.' To '.$productnetvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Amount <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductnetvalue.' To '.$productnetvalue.' ) </span>';
								}                   
							}
							if($salequantity!=$oldessalequantity){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.($access['txtsqty']).' <span style="color:green;" id="prohisfromtospan">( From '.$oldessalequantity.' To '.$salequantity.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.($access['txtsqty']).' <span style="color:green;" id="prohisfromtospan">( From '.$oldessalequantity.' To '.$salequantity.' ) </span>';
								}                   
							}
							if($productwithouttax!=$oldesproductwithouttax){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithouttax.' To '.$productwithouttax.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithouttax.' To '.$productwithouttax.' ) </span>';
								}                   
							}
							if($productwithtax!=$oldesproductwithtax){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithtax.' To '.$productwithtax.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithtax.' To '.$productwithtax.' ) </span>';
								}                   
							}
						}
					}
				}
				elseif ($oldans>$curans) {
					for($i=0; $i<count($_POST['oldesproductname']); $i++){
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
						$oldesproductid=htmlspecialchars($_POST['oldesproductid'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductname=htmlspecialchars($_POST['oldesproductname'][$i], ENT_QUOTES, 'UTF-8');
						$oldesmanufacturer=htmlspecialchars($_POST['oldesmanufacturer'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproducthsn=htmlspecialchars($_POST['oldesproducthsn'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductnotes=htmlspecialchars($_POST['oldesproductnotes'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductdescription=htmlspecialchars($_POST['oldesproductdescription'][$i], ENT_QUOTES, 'UTF-8');
						$oldesitemmodule=htmlspecialchars($_POST['oldesitemmodule'][$i], ENT_QUOTES, 'UTF-8');
						if ($access['batchexpiryval']==1) {
							$oldesbatch=htmlspecialchars($_POST['oldesbatch'][$i], ENT_QUOTES, 'UTF-8');
							$oldesexpdate=htmlspecialchars($_POST['oldesexpdate'][$i], ENT_QUOTES, 'UTF-8');
						}
						else{
							$oldesbatch='';
							$oldesexpdate='';
						}
						$oldesmrp=htmlspecialchars( (($_POST['oldesmrp'][$i]!='')?$_POST['oldesmrp'][$i]:0), ENT_QUOTES, 'UTF-8');
						$oldesvat=htmlspecialchars($_POST['oldesvat'][$i], ENT_QUOTES, 'UTF-8');
						$oldesicsgsthis=htmlspecialchars($_POST['oldesicsgsthis'][$i], ENT_QUOTES, 'UTF-8');
						$oldesquantity=htmlspecialchars($_POST['oldesquantity'][$i], ENT_QUOTES, 'UTF-8');
						$oldesunit=htmlspecialchars($_POST['oldesproductunit'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductrate=htmlspecialchars($_POST['oldesproductrate'][$i], ENT_QUOTES, 'UTF-8');
						$oldesnoofpacks=htmlspecialchars($_POST['oldesnoofpacks'][$i], ENT_QUOTES, 'UTF-8');
						$oldesprodiscount=htmlspecialchars($_POST['oldesprodiscount'][$i], ENT_QUOTES, 'UTF-8');
						$oldesprodiscounttype=htmlspecialchars($_POST['oldesprodiscounttype'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductvalue=htmlspecialchars($_POST['oldesproductvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldestaxvalue=htmlspecialchars($_POST['oldestaxvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductnetvalue=htmlspecialchars($_POST['oldesproductnetvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldessalequantity=htmlspecialchars($_POST['oldessalequantity'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductwithouttax=htmlspecialchars($_POST['oldesproductwithouttax'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductwithtax=htmlspecialchars($_POST['oldesproductwithtax'][$i], ENT_QUOTES, 'UTF-8');
						if($productname!=''){
							if($productname!=$oldesproductname){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductname.' To '.$productname.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductname.' To '.$productname.' ) </span>';
								}                   
							}
							if($manufacturer!=$oldesmanufacturer){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesmanufacturer.' To '.$manufacturer.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesmanufacturer.' To '.$manufacturer.' ) </span>';
								}                   
							}
							if($producthsn!=$oldesproducthsn){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> HSN Code <span style="color:green;" id="prohisfromtospan">( From '.$oldesproducthsn.' To '.$producthsn.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> HSN Code <span style="color:green;" id="prohisfromtospan">( From '.$oldesproducthsn.' To '.$producthsn.' ) </span>';
								}                   
							}
							if($productdescription!=$oldesproductdescription){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductdescription.' To '.$productdescription.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductdescription.' To '.$productdescription.' ) </span>';
								}                   
							}
							if($batch!=$oldesbatch){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Batch <span style="color:green;" id="prohisfromtospan">( From '.$oldesbatch.' To '.$batch.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Batch <span style="color:green;" id="prohisfromtospan">( From '.$oldesbatch.' To '.$batch.' ) </span>';
								}                   
							}
							if($expdate!=$oldesexpdate){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Expiry <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesexpdate)).' To '.date($date,strtotime($expdate)).' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Expiry <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesexpdate)).' To '.date($date,strtotime($expdate)).' ) </span>';
								}                   
							}
							if($productrate!=$oldesproductrate){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductrate.' To '.$productrate.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductrate.' To '.$productrate.' ) </span>';
								}                   
							}
							if($mrp!=$oldesmrp){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldesmrp.' To '.$mrp.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldesmrp.' To '.$mrp.' ) </span>';
								}                   
							}
							if($quantity!=$oldesquantity){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Quantity <span style="color:green;" id="prohisfromtospan">( From '.$oldesquantity.' To '.$quantity.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Quantity <span style="color:green;" id="prohisfromtospan">( From '.$oldesquantity.' To '.$quantity.' ) </span>';
								}                   
							}
							if($unit!=$oldesunit){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Unit <span style="color:green;" id="prohisfromtospan">( From '.$oldesunit.' To '.$unit.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Unit <span style="color:green;" id="prohisfromtospan">( From '.$oldesunit.' To '.$unit.' ) </span>';
								}                   
							}
							if($noofpacks!=$oldesnoofpacks){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Pack <span style="color:green;" id="prohisfromtospan">( From '.$oldesnoofpacks.' To '.$noofpacks.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Pack <span style="color:green;" id="prohisfromtospan">( From '.$oldesnoofpacks.' To '.$noofpacks.' ) </span>';
								}                   
							}
							if($productvalue!=$oldesproductvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Taxable Value <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductvalue.' To '.$productvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Taxable Value <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductvalue.' To '.$productvalue.' ) </span>';
								}                   
							}
							if($prodiscount!=$oldesprodiscount){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$access['txtprodisbill'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesprodiscount.' To '.$prodiscount.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtprodisbill'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesprodiscount.' To '.$prodiscount.' ) </span>';
								}                   
							}
							if($prodiscounttype!=$oldesprodiscounttype){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Discounted By <span style="color:green;" id="prohisfromtospan">( From '.(($oldesprodiscounttype==0)?'%':'?').' To '.(($prodiscounttype==0)?'%':'?').' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discounted By <span style="color:green;" id="prohisfromtospan">( From '.(($oldesprodiscounttype==0)?'%':'?').' To '.(($prodiscounttype==0)?'%':'?').' ) </span>';
								}                   
							}
							if($taxvalue!=$oldestaxvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Tax Value <span style="color:green;" id="prohisfromtospan">( From '.$oldestaxvalue.' To '.$taxvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Tax Value <span style="color:green;" id="prohisfromtospan">( From '.$oldestaxvalue.' To '.$taxvalue.' ) </span>';
								}                   
							}
							if($vat!=$oldesvat){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Gst <span style="color:green;" id="prohisfromtospan">( From '.$oldesvat.' % ('.$oldesicsgsthis.') To '.$vat.' % ('.$ansforsepgstval.') ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Gst <span style="color:green;" id="prohisfromtospan">( From '.$oldesvat.' % ('.$oldesicsgsthis.') To '.$vat.' % ('.$ansforsepgstval.') ) </span>';
								}                   
							}
							if($productnetvalue!=$oldesproductnetvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Amount <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductnetvalue.' To '.$productnetvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Amount <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductnetvalue.' To '.$productnetvalue.' ) </span>';
								}                   
							}
							if($salequantity!=$oldessalequantity){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.($access['txtsqty']).' <span style="color:green;" id="prohisfromtospan">( From '.$oldessalequantity.' To '.$salequantity.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.($access['txtsqty']).' <span style="color:green;" id="prohisfromtospan">( From '.$oldessalequantity.' To '.$salequantity.' ) </span>';
								}                   
							}
							if($productwithouttax!=$oldesproductwithouttax){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithouttax.' To '.$productwithouttax.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithouttax.' To '.$productwithouttax.' ) </span>';
								}                   
							}
							if($productwithtax!=$oldesproductwithtax){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithtax.' To '.$productwithtax.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithtax.' To '.$productwithtax.' ) </span>';
								}                   
							}
						}
						else{
							if($oldesproductname!=''){							
								if($oldesproductname!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductname.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductname.' To &nbsp; ) </span>';
									}
								}
								if($oldesmanufacturer!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> '.$access['txtnamecategory'].' <span style="color:red;" id="prohisfromtospan">( From '.$oldesmanufacturer.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtnamecategory'].' <span style="color:red;" id="prohisfromtospan">( From '.$oldesmanufacturer.' To &nbsp; ) </span>';
									}
								}
								if($oldesproducthsn!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> HSN Code <span style="color:red;" id="prohisfromtospan">( From '.$oldesproducthsn.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> HSN Code <span style="color:red;" id="prohisfromtospan">( From '.$oldesproducthsn.' To &nbsp; ) </span>';
									}
								}
								if($oldesproductdescription!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Description <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductdescription.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductdescription.' To &nbsp; ) </span>';
									}
								}
								if($oldesbatch!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Batch <span style="color:red;" id="prohisfromtospan">( From '.$oldesbatch.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Batch <span style="color:red;" id="prohisfromtospan">( From '.$oldesbatch.' To &nbsp; ) </span>';
									}
								}
								if($oldesexpdate!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Expiry <span style="color:red;" id="prohisfromtospan">( From '.date($date,strtotime($oldesexpdate)).' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Expiry <span style="color:red;" id="prohisfromtospan">( From '.date($date,strtotime($oldesexpdate)).' To &nbsp; ) </span>';
									}
								}
								if($oldesproductrate!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Rate <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductrate.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Rate <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductrate.' To &nbsp; ) </span>';
									}
								}
								if($oldesmrp!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Mrp <span style="color:red;" id="prohisfromtospan">( From '.$oldesmrp.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Mrp <span style="color:red;" id="prohisfromtospan">( From '.$oldesmrp.' To &nbsp; ) </span>';
									}
								}
								if($oldesquantity!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Quantity <span style="color:red;" id="prohisfromtospan">( From '.$oldesquantity.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Quantity <span style="color:red;" id="prohisfromtospan">( From '.$oldesquantity.' To &nbsp; ) </span>';
									}
								}
								if($oldesunit!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Unit <span style="color:red;" id="prohisfromtospan">( From '.$oldesunit.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Unit <span style="color:red;" id="prohisfromtospan">( From '.$oldesunit.' To &nbsp; ) </span>';
									}
								}
								if($oldesnoofpacks!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Pack <span style="color:red;" id="prohisfromtospan">( From '.$oldesnoofpacks.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Pack <span style="color:red;" id="prohisfromtospan">( From '.$oldesnoofpacks.' To &nbsp; ) </span>';
									}
								}
								if($oldesproductvalue!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Taxable Value <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductvalue.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Taxable Value <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductvalue.' To &nbsp; ) </span>';
									}
								}
								if($oldesprodiscount!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Discount <span style="color:red;" id="prohisfromtospan">( From '.$oldesprodiscount.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discount <span style="color:red;" id="prohisfromtospan">( From '.$oldesprodiscount.' To &nbsp; ) </span>';
									}
								}
								if($oldestaxvalue!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Tax Value <span style="color:red;" id="prohisfromtospan">( From '.$oldestaxvalue.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Tax Value <span style="color:red;" id="prohisfromtospan">( From '.$oldestaxvalue.' To &nbsp; ) </span>';
									}
								}
								if($oldesvat!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Gst <span style="color:red;" id="prohisfromtospan">( From '.$oldesvat.' % ('.$oldesicsgsthis.') To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Gst <span style="color:red;" id="prohisfromtospan">( From '.$oldesvat.' % ('.$oldesicsgsthis.') To &nbsp; ) </span>';
									}
								}
								if($oldesproductnetvalue!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Amount <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductnetvalue.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Amount <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductnetvalue.' To &nbsp; ) </span>';
									}
								}
								if($oldessalequantity!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> '.($access['txtsqty']).' <span style="color:red;" id="prohisfromtospan">( From '.$oldessalequantity.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.($access['txtsqty']).' <span style="color:red;" id="prohisfromtospan">( From '.$oldessalequantity.' To &nbsp; ) </span>';
									}
								}
								if($oldesproductwithouttax!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Sale Rate/Unit(Without Gst) <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductwithouttax.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(Without Gst) <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductwithouttax.' To &nbsp; ) </span>';
									}
								}
								if($oldesproductwithtax!=''){
									if($billiteminfoch!=''){
										$billiteminfoch.='<br> Sale Rate/Unit(With Gst) <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductwithtax.' To &nbsp; ) </span>';
									}
									else{
										$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(With Gst) <span style="color:red;" id="prohisfromtospan">( From '.$oldesproductwithtax.' To &nbsp; ) </span>';
									}
								}
							}
						}
					}
				}
				elseif ($curans>$oldans) {
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
						$oldesproductid=htmlspecialchars($_POST['oldesproductid'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductname=htmlspecialchars($_POST['oldesproductname'][$i], ENT_QUOTES, 'UTF-8');
						$oldesmanufacturer=htmlspecialchars($_POST['oldesmanufacturer'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproducthsn=htmlspecialchars($_POST['oldesproducthsn'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductnotes=htmlspecialchars($_POST['oldesproductnotes'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductdescription=htmlspecialchars($_POST['oldesproductdescription'][$i], ENT_QUOTES, 'UTF-8');
						$oldesitemmodule=htmlspecialchars($_POST['oldesitemmodule'][$i], ENT_QUOTES, 'UTF-8');
						if ($access['batchexpiryval']==1) {
							$oldesbatch=htmlspecialchars($_POST['oldesbatch'][$i], ENT_QUOTES, 'UTF-8');
							$oldesexpdate=htmlspecialchars($_POST['oldesexpdate'][$i], ENT_QUOTES, 'UTF-8');
						}
						else{
							$oldesbatch='';
							$oldesexpdate='';
						}
						$oldesmrp=htmlspecialchars( (($_POST['oldesmrp'][$i]!='')?$_POST['oldesmrp'][$i]:0), ENT_QUOTES, 'UTF-8');
						$oldesvat=htmlspecialchars($_POST['oldesvat'][$i], ENT_QUOTES, 'UTF-8');
						$oldesicsgsthis=htmlspecialchars($_POST['oldesicsgsthis'][$i], ENT_QUOTES, 'UTF-8');
						$oldesquantity=htmlspecialchars($_POST['oldesquantity'][$i], ENT_QUOTES, 'UTF-8');
						$oldesunit=htmlspecialchars($_POST['oldesproductunit'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductrate=htmlspecialchars($_POST['oldesproductrate'][$i], ENT_QUOTES, 'UTF-8');
						$oldesnoofpacks=htmlspecialchars($_POST['oldesnoofpacks'][$i], ENT_QUOTES, 'UTF-8');
						$oldesprodiscount=htmlspecialchars($_POST['oldesprodiscount'][$i], ENT_QUOTES, 'UTF-8');
						$oldesprodiscounttype=htmlspecialchars($_POST['oldesprodiscounttype'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductvalue=htmlspecialchars($_POST['oldesproductvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldestaxvalue=htmlspecialchars($_POST['oldestaxvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductnetvalue=htmlspecialchars($_POST['oldesproductnetvalue'][$i], ENT_QUOTES, 'UTF-8');
						$oldessalequantity=htmlspecialchars($_POST['oldessalequantity'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductwithouttax=htmlspecialchars($_POST['oldesproductwithouttax'][$i], ENT_QUOTES, 'UTF-8');
						$oldesproductwithtax=htmlspecialchars($_POST['oldesproductwithtax'][$i], ENT_QUOTES, 'UTF-8');
						if($oldesproductname!=''){
							if($productname!=$oldesproductname){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductname.' To '.$productname.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductname.' To '.$productname.' ) </span>';
								}   
							}
							if($manufacturer!=$oldesmanufacturer){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesmanufacturer.' To '.$manufacturer.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesmanufacturer.' To '.$manufacturer.' ) </span>';
								}   
							}
							if($producthsn!=$oldesproducthsn){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> HSN Code <span style="color:green;" id="prohisfromtospan">( From '.$oldesproducthsn.' To '.$producthsn.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> HSN Code <span style="color:green;" id="prohisfromtospan">( From '.$oldesproducthsn.' To '.$producthsn.' ) </span>';
								}   
							}
							if($productdescription!=$oldesproductdescription){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductdescription.' To '.$productdescription.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductdescription.' To '.$productdescription.' ) </span>';
								}   
							}
							if($batch!=$oldesbatch){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Batch <span style="color:green;" id="prohisfromtospan">( From '.$oldesbatch.' To '.$batch.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Batch <span style="color:green;" id="prohisfromtospan">( From '.$oldesbatch.' To '.$batch.' ) </span>';
								}   
							}
							if($expdate!=$oldesexpdate){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Expiry <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesexpdate)).' To '.date($date,strtotime($expdate)).' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Expiry <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesexpdate)).' To '.date($date,strtotime($expdate)).' ) </span>';
								}   
							}
							if($productrate!=$oldesproductrate){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductrate.' To '.$productrate.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductrate.' To '.$productrate.' ) </span>';
								}   
							}
							if($mrp!=$oldesmrp){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldesmrp.' To '.$mrp.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldesmrp.' To '.$mrp.' ) </span>';
								}   
							}
							if($quantity!=$oldesquantity){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Quantity <span style="color:green;" id="prohisfromtospan">( From '.$oldesquantity.' To '.$quantity.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Quantity <span style="color:green;" id="prohisfromtospan">( From '.$oldesquantity.' To '.$quantity.' ) </span>';
								}   
							}
							if($unit!=$oldesunit){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Unit <span style="color:green;" id="prohisfromtospan">( From '.$oldesunit.' To '.$unit.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Unit <span style="color:green;" id="prohisfromtospan">( From '.$oldesunit.' To '.$unit.' ) </span>';
								}   
							}
							if($noofpacks!=$oldesnoofpacks){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Pack <span style="color:green;" id="prohisfromtospan">( From '.$oldesnoofpacks.' To '.$noofpacks.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Pack <span style="color:green;" id="prohisfromtospan">( From '.$oldesnoofpacks.' To '.$noofpacks.' ) </span>';
								}   
							}
							if($productvalue!=$oldesproductvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Taxable Value <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductvalue.' To '.$productvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Taxable Value <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductvalue.' To '.$productvalue.' ) </span>';
								}   
							}
							if($prodiscount!=$oldesprodiscount){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$access['txtprodisbill'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesprodiscount.' To '.$prodiscount.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtprodisbill'].' <span style="color:green;" id="prohisfromtospan">( From '.$oldesprodiscount.' To '.$prodiscount.' ) </span>';
								}   
							}
							if($prodiscounttype!=$oldesprodiscounttype){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Discounted By <span style="color:green;" id="prohisfromtospan">( From '.(($oldesprodiscounttype==0)?'%':'?').' To '.(($prodiscounttype==0)?'%':'?').' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discounted By <span style="color:green;" id="prohisfromtospan">( From '.(($oldesprodiscounttype==0)?'%':'?').' To '.(($prodiscounttype==0)?'%':'?').' ) </span>';
								}   
							}
							if($taxvalue!=$oldestaxvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Tax Value <span style="color:green;" id="prohisfromtospan">( From '.$oldestaxvalue.' To '.$taxvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Tax Value <span style="color:green;" id="prohisfromtospan">( From '.$oldestaxvalue.' To '.$taxvalue.' ) </span>';
								}   
							}
							if($vat!=$oldesvat){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Gst <span style="color:green;" id="prohisfromtospan">( From '.$oldesvat.' % ('.$oldesicsgsthis.') To '.$vat.' % ('.$ansforsepgstval.') ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Gst <span style="color:green;" id="prohisfromtospan">( From '.$oldesvat.' % ('.$oldesicsgsthis.') To '.$vat.' % ('.$ansforsepgstval.') ) </span>';
								}   
							}
							if($productnetvalue!=$oldesproductnetvalue){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Amount <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductnetvalue.' To '.$productnetvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Amount <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductnetvalue.' To '.$productnetvalue.' ) </span>';
								}   
							}
							if($salequantity!=$oldessalequantity){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.($access['txtsqty']).' <span style="color:green;" id="prohisfromtospan">( From '.$oldessalequantity.' To '.$salequantity.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.($access['txtsqty']).' <span style="color:green;" id="prohisfromtospan">( From '.$oldessalequantity.' To '.$salequantity.' ) </span>';
								}   
							}
							if($productwithouttax!=$oldesproductwithouttax){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithouttax.' To '.$productwithouttax.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithouttax.' To '.$productwithouttax.' ) </span>';
								}   
							}
							if($productwithtax!=$oldesproductwithtax){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithtax.' To '.$productwithtax.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( From '.$oldesproductwithtax.' To '.$productwithtax.' ) </span>';
								}   
							}
						}
						else{							
							if($productname!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$productname.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$infomainaccessuserpro['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$productname.' ) </span>';        
								}
							}
							if($manufacturer!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( '.$manufacturer.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( '.$manufacturer.' ) </span>';        
								}
							}
							if($producthsn!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> HSN Code <span style="color:green;" id="prohisfromtospan">( '.$producthsn.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> HSN Code <span style="color:green;" id="prohisfromtospan">( '.$producthsn.' ) </span>';        
								}
							}
							if($productdescription!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( '.$productdescription.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( '.$productdescription.' ) </span>';        
								}
							}
							if($batch!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Batch <span style="color:green;" id="prohisfromtospan">( '.$batch.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Batch <span style="color:green;" id="prohisfromtospan">( '.$batch.' ) </span>';        
								}
							}
							if($expdate!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Expiry <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($expdate)).' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Expiry <span style="color:green;" id="prohisfromtospan">( '.date($date,strtotime($expdate)).' ) </span>';        
								}
							}
							if($productrate!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Rate <span style="color:green;" id="prohisfromtospan">( '.$productrate.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Rate <span style="color:green;" id="prohisfromtospan">( '.$productrate.' ) </span>';        
								}
							}
							if($mrp!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Mrp <span style="color:green;" id="prohisfromtospan">( '.$mrp.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Mrp <span style="color:green;" id="prohisfromtospan">( '.$mrp.' ) </span>';        
								}
							}
							if($quantity!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Quantity <span style="color:green;" id="prohisfromtospan">( '.$quantity.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Quantity <span style="color:green;" id="prohisfromtospan">( '.$quantity.' ) </span>';        
								}
							}
							if($unit!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Unit <span style="color:green;" id="prohisfromtospan">( '.$unit.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Unit <span style="color:green;" id="prohisfromtospan">( '.$unit.' ) </span>';        
								}
							}
							if($noofpacks!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Pack <span style="color:green;" id="prohisfromtospan">( '.$noofpacks.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Pack <span style="color:green;" id="prohisfromtospan">( '.$noofpacks.' ) </span>';        
								}
							}
							if($productvalue!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Taxable Value <span style="color:green;" id="prohisfromtospan">( '.$productvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Taxable Value <span style="color:green;" id="prohisfromtospan">( '.$productvalue.' ) </span>';        
								}
							}
							if($prodiscount!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.$access['txtprodisbill'].' <span style="color:green;" id="prohisfromtospan">( '.$prodiscount.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.$access['txtprodisbill'].' <span style="color:green;" id="prohisfromtospan">( '.$prodiscount.' ) </span>';        
								}
							}
							if($prodiscounttype!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Discounted By <span style="color:green;" id="prohisfromtospan">( '.(($prodiscounttype==0)?'%':'?').' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discounted By <span style="color:green;" id="prohisfromtospan">( '.(($prodiscounttype==0)?'%':'?').' ) </span>';        
								}
							}
							if($taxvalue!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Tax Value <span style="color:green;" id="prohisfromtospan">( '.$taxvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Tax Value <span style="color:green;" id="prohisfromtospan">( '.$taxvalue.' ) </span>';        
								}
							}
							if($vat!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Gst <span style="color:green;" id="prohisfromtospan">( '.$vat.' % ('.$ansforsepgstval.') ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Gst <span style="color:green;" id="prohisfromtospan">( '.$vat.' % ('.$ansforsepgstval.') ) </span>';        
								}
							}
							if($productnetvalue!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Amount <span style="color:green;" id="prohisfromtospan">( '.$productnetvalue.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Amount <span style="color:green;" id="prohisfromtospan">( '.$productnetvalue.' ) </span>';        
								}
							}
							if($salequantity!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> '.($access['txtsqty']).' <span style="color:green;" id="prohisfromtospan">( '.$salequantity.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> '.($access['txtsqty']).' <span style="color:green;" id="prohisfromtospan">( '.$salequantity.' ) </span>';        
								}
							}
							if($productwithouttax!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( '.$productwithouttax.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(Without Gst) <span style="color:green;" id="prohisfromtospan">( '.$productwithouttax.' ) </span>';        
								}
							}
							if($productwithtax!=''){
								if($billiteminfoch!=''){
									$billiteminfoch.='<br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( '.$productwithtax.' ) </span>';
								}
								else{
									$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sale Rate/Unit(With Gst) <span style="color:green;" id="prohisfromtospan">( '.$productwithtax.' ) </span>';        
								}
							}
						}
					}
				}
				//FOR PRODUCT ALL ROWS HISTORY IN LOOPING
				if($totalitems!=$oldestotalitems){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Total Items <span style="color:green;" id="prohisfromtospan">( From '.$oldestotalitems.' To '.$totalitems.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Items <span style="color:green;" id="prohisfromtospan">( From '.$oldestotalitems.' To '.$totalitems.' ) </span>';
					}
				}
				if($totalquantity!=$oldestotalquantity){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Total Qty <span style="color:green;" id="prohisfromtospan">( From '.$oldestotalquantity.' To '.$totalquantity.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Qty <span style="color:green;" id="prohisfromtospan">( From '.$oldestotalquantity.' To '.$totalquantity.' ) </span>';
					}
				}
				if($totalamount!=$oldestotalamount){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Sub Total <span style="color:green;" id="prohisfromtospan">( From '.$oldestotalamount.' To '.$totalamount.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Sub Total <span style="color:green;" id="prohisfromtospan">( From '.$oldestotalamount.' To '.$totalamount.' ) </span>';
					}
				}
				if($discountamount!=$oldesdiscountamount){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Discount <span style="color:green;" id="prohisfromtospan">( From '.$oldesdiscountamount.' To '.$discountamount.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Discount <span style="color:green;" id="prohisfromtospan">( From '.$oldesdiscountamount.' To '.$discountamount.' ) </span>';
					}
				}
				if($totalvatamount!=$oldestotalvatamount){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Total Tax <span style="color:green;" id="prohisfromtospan">( From '.$oldestotalvatamount.' To '.$totalvatamount.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Total Tax <span style="color:green;" id="prohisfromtospan">( From '.$oldestotalvatamount.' To '.$totalvatamount.' ) </span>';
					}
				}
				if($roundoff!=$oldesroundoff){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Round Off <span style="color:green;" id="prohisfromtospan">( From '.$oldesroundoff.' To '.$roundoff.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Round Off <span style="color:green;" id="prohisfromtospan">( From '.$oldesroundoff.' To '.$roundoff.' ) </span>';
					}
				}
				if($grandtotal!=$oldesgrandtotal){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Grand Total <span style="color:green;" id="prohisfromtospan">( From '.$oldesgrandtotal.' To '.$grandtotal.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Grand Total <span style="color:green;" id="prohisfromtospan">( From '.$oldesgrandtotal.' To '.$grandtotal.' ) </span>';
					}
				}
				if($description!=$oldesdescription){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldesdescription.' To '.$description.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldesdescription.' To '.$description.' ) </span>';
					}
				}
				if($notes!=$oldesnotes){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Notes <span style="color:green;" id="prohisfromtospan">( From '.$oldesnotes.' To '.$notes.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Notes <span style="color:green;" id="prohisfromtospan">( From '.$oldesnotes.' To '.$notes.' ) </span>';
					}
				}
				if($terms!=$oldesterms){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Terms And Conditions <span style="color:green;" id="prohisfromtospan">( From '.$oldesterms.' To '.$terms.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Terms And Conditions <span style="color:green;" id="prohisfromtospan">( From '.$oldesterms.' To '.$terms.' ) </span>';
					}
				}
				if($fileattach!=$oldesfileattach){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Attach <span style="color:green;" id="prohisfromtospan">( Changed ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Attach <span style="color:green;" id="prohisfromtospan">( Changed ) </span>';
					}
				}
				if($billterm!=$oldesbillterm){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Payment Method <span style="color:green;" id="prohisfromtospan">( From '.$oldesbillterm.' To '.$billterm.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Payment Method <span style="color:green;" id="prohisfromtospan">( From '.$oldesbillterm.' To '.$billterm.' ) </span>';
					}
				}
				if($validpaidamount!=$oldesvalidpaidamount&&$billterm=='CASH'){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Cash Received <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidpaidamount.' To '.$validpaidamount.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Cash Received <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidpaidamount.' To '.$validpaidamount.' ) </span>';
					}
				}
				if($validbalance!=$oldesvalidbalance&&$billterm=='CASH'){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Change Due <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidbalance.' To '.$validbalance.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Change Due <span style="color:green;" id="prohisfromtospan">( From '.$oldesvalidbalance.' To '.$validbalance.' ) </span>';
					}
				}
				if($duedates!=$oldesduedates&&$billterm=='CREDIT'){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Due Term <span style="color:green;" id="prohisfromtospan">( From '.$oldesduedates.' To '.$duedates.' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Due Term <span style="color:green;" id="prohisfromtospan">( From '.$oldesduedates.' To '.$duedates.' ) </span>';
					}
				}
				if($duedate!=$oldesduedate&&$billterm=='CREDIT'){
					if($billiteminfoch!=''){
						$billiteminfoch.='<br> Due Date <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesduedate)).' To '.date($date,strtotime($duedate)).' ) </span>';
					}
					else{
						$billiteminfoch.=''.(($billinfoch!=''||$billveninfoch!='')?'<br>':'').'<span style="color:royalblue;">Item Information</span> <br> Due Date <span style="color:green;" id="prohisfromtospan">( From '.date($date,strtotime($oldesduedate)).' To '.date($date,strtotime($duedate)).' ) </span>';
					}
				}
				//FOR BILL OTHER INFORMATIONS LIKE PAYMENT AND TERMS AND DESCRIPTION......
				$billtotinfoch = $billinfoch.$billveninfoch.$billiteminfoch;
				if($billtotinfoch!=''){
					$sqluse = $con->prepare("INSERT INTO pairusehistory (usetype,createdon,createdby,useid,uniqueid,useremarks) VALUES ('BILLS', ?, ?, ?, ?, ?)");
					$sqluse->bind_param("sssss", $times, $_SESSION["unqwerty"], $billno, $purchaseid, $billtotinfoch);
					$sqluse->execute();
					$sqluse->close();
				}
				//FOR INVOICE HISTORY
				$sqlusehisupdqry = $con->prepare("UPDATE pairusehistory SET uniqueid=? WHERE useid=? AND uniqueid=?");
				$sqlusehisupdqry->bind_param("sss", $purchaseid, $billno, $_GET['id']);
				$sqlusehisupdqry->execute();
				$sqlusehisupdqry->close();
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
		Edit <?= $infomainaccessuser['modulename'] ?>
	</title>
	<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
	<?php
		}
		$sqlismainaccessusers=$con->prepare("SELECT moduleno, moduleprefix, modulesuffix,modulename FROM pairmainaccess WHERE franchiseid=? AND moduletype='Bills' ORDER BY id ASC");
		$sqlismainaccessusers->bind_param("s", $_SESSION['franchisesession']);
		$sqlismainaccessusers->execute();
		$sqlismainaccessuser = $sqlismainaccessusers->get_result();
		$infomainaccessuser=$sqlismainaccessuser->fetch_array();
		$sqlismainaccessuser->close();
		$sqlismainaccessusers->close();
		if((isset($_GET['billno']))&&(isset($_GET['billdate']))){
			$billno=htmlspecialchars( $_GET['billno'], ENT_QUOTES, 'UTF-8');
			$billdate=htmlspecialchars( $_GET['billdate'], ENT_QUOTES, 'UTF-8');
			$sql=$con->prepare("SELECT * FROM pairbills WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? ORDER BY id ASC LIMIT 5");
			$sql->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $billno, $billdate);
			$sql->execute();
			$count=1;
			$result = $sql->get_result();
			if($result->num_rows > 0){
				$rows = array();
				while($row = $result->fetch_assoc()){ 
					$rows[] = $row;
				}
				$result->close();
	?>
		<div style="max-width: 1650px;">
			<div class="row min-height-480">
				<div class="col-12">
					<div class="card mb-4 mt-5">
						<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
							<p style="font-size:20px;margin-top: -9px !important;margin-bottom: 6px !important;">
								<i class="fa fa-pencil"></i> Edit <?= $infomainaccessuser['modulename'] ?>
							</p>
						<?php
							if($infomainaccessuser['moduleno']!='1'){
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
								$sqlismainaccessuserpros->bind_param("i", $userid);
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
												<span aria-hidden="true" style="font-size: 21px;font-weight: 600;">&times;</span>
											</span>
										</div>
										<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">
											<div class="modal-body" id="custmodal" style="padding-bottom: 0px !important;margin-bottom: -24.5px !important;">
											<?php
												include("vendoraddmodal.php");
											?>
											</div>
											<div class="modal-footer " style="display: block;margin-top: 24px !important;">
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
							<form autocomplete="off" id="billform" action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
								<div style="display:none;position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10;" id="loadimgbiggerscr">
    								<img src="loading.gif" alt="Loading..." id="loadimgbiggerscrr" style="position: relative; width: 250px; height: 250px; background-color: white;box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);z-index: 9;">
    								<div style="position: absolute; top: 10px; right: 10px; z-index: 10;" onclick="closebigload()">
        								<i class="fa fa-close"></i>
    								</div>
								</div>
							<?php
								$oldarray=array( 'billno','invnumber','billdate','reference','saleperson','preparedby','checkedby','invgrandtotal','vendorname','area','city','state','district','pincode','sarea','scity','sstate','sdistrict','spincode','workphone','mobile','gstrtype','gstno','pos','salequantity','dlno20','dlno21' );
								foreach($oldarray as $oldinfo){
							?>
								<input type="hidden" name="oldes<?=$oldinfo?>" value="<?=$rows[0][$oldinfo]?>">
							<?php
								}
							?>
								<input type="hidden" value="<?=$rows[0]['totalitems']?>" name="oldestotalitems">
								<input type="hidden" value="<?=$rows[0]['totalquantity']?>" name="oldestotalquantity">
								<input type="hidden" value="<?=number_format((float)$rows[0]['totalamount'],2,'.','')?>" name="oldestotalamount">
								<input type="hidden" value="<?=number_format((float)$rows[0]['discountamount'],2,'.','')?>" name="oldesdiscountamount">
								<input type="hidden" value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" name="oldestotalvatamount">
								<input type="hidden" value="<?=number_format((float)$rows[0]['roundoff'],2,'.','')?>" name="oldesroundoff">
								<input type="hidden" value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" name="oldesgrandtotal">
								<input type="hidden" value="<?=$rows[0]['description']?>" name="oldesdescription">
								<input type="hidden" value="<?=$rows[0]['notes']?>" name="oldesnotes">
								<input type="hidden" value="<?=$rows[0]['terms']?>" name="oldesterms">
								<input type="hidden" value="<?=$rows[0]['fileattach']?>" name="oldesfileattach">
								<input type="hidden" value="<?=$rows[0]['billterm']?>" name="oldesbillterm">
								<input type="hidden" value="<?= $rows[0]['validpaidamount'] ?>" name="oldesvalidpaidamount">
								<input type="hidden" value="<?= $rows[0]['validbalance'] ?>" name="oldesvalidbalance">
								<input type="hidden" value="<?=$rows[0]['duedates']?>" name="oldesduedates">
								<input type="hidden" value="<?= $rows[0]['duedate'] ?>" name="oldesduedate">
								<input type="hidden" name="oldbillno" value="<?=$rows[0]['billno']?>">
								<input type="hidden" name="oldbilldate" value="<?=$rows[0]['billdate']?>">
								<input type="hidden" name="billterm" value="<?=$rows[0]['billterm']?>">
								<div class="row">
								<?php
									// if ((in_array('Bill Information', $fieldedit))) {
									$sqlismainaccessuserinv=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
									$sqlismainaccessuserinv->bind_param("s", $userid);
									$sqlismainaccessuserinv->execute();
									$sqlismainaccessuserinv = $sqlismainaccessuserinv->get_result();
									$infomainaccessuserinv=$sqlismainaccessuserinv->fetch_array();
									//FOR INVOICE MODULENAME
								?>
									<div class="col-lg-4">
										<div class="accordion" id="accordionRental">
											<div class="accordion-item mb-1">
												<h5 class="accordion-header" id="headingTwo" >
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
																		<label for="billno" class="custom-label">
																			<span class="text-danger">
																				<?= $infomainaccessuser['modulename'] ?> Number *
																			</span>
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control  form-control-sm" id="billno" name="billno" required  value="<?=$rows[0]['billno']?>" readonly>
																		<input type="hidden" name="cancelstatuscheck" id="cancelstatuscheck" value="<?=$rows[0]['cancelstatus']?>">
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="invnumber" class="custom-label text-danger">
																			Invoice Number *
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control  form-control-sm" id="invnumber" name="invnumber" value="<?=$rows[0]['invnumber']?>" required>
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="billdate" class="custom-label">
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
																	?>
																		<input type="date" class="form-control  form-control-sm" id="billdate" name="billdate" required value="<?=$rows[0]['billdate']?>">
																	</div>
																</div>
															</div>
														<?php
															if ((in_array('Reference', $fieldedit))) {
														?>
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="reference" class="custom-label">
																			Reference
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control  form-control-sm" id="reference" name="reference" value="<?=$rows[0]['reference']?>">
																	</div>
																</div>
															</div>
														<?php
															}
															if ((in_array('Sale Person', $fieldedit))) {
														?>
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="saleperson" class="custom-label">
																			Sale Person
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<select class="select2-field form-control  form-control-sm" name="saleperson" id="saleperson">
																			<option selected disabled>
																				Select
																			</option>
																		<?php
																			$sqlis=$con->prepare("SELECT saleperson FROM pairsaleperson WHERE (createdid=? OR createdid='0') ORDER BY saleperson ASC");
																			$sqlis->bind_param("s", $companymainid);
																			$sqlis->execute();
																			$sqli = $sqlis->get_result();
																			while($info=$sqli->fetch_array()){
																		?>
																			<option value="<?= $info['saleperson'] ?>" <?=($rows[0]['saleperson']==$info['saleperson'])?'selected':''?>>
																				<?= $info['saleperson'] ?>
																			</option>
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
															<div class="col-lg-12" <?=((in_array('Prepared By', $fieldedit))?'':'style="display:none;"')?>>
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="preparedby" class="custom-label">
																			Prepared By
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control  form-control-sm" id="preparedby" maxlength="350" name="preparedby" value="<?=$rows[0]['preparedby']?>">
																	</div>
																</div>
															</div>
															<div class="col-lg-12" <?=((in_array('Checked By', $fieldedit))?'':'style="display:none;"')?>>
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="checkedby" class="custom-label">
																			Checked By
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="form-control  form-control-sm" id="checkedby" maxlength="350" name="checkedby" value="<?=$rows[0]['checkedby']?>">
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group row" style="align-items: center !important;">
																	<div class="col-lg-5">
																		<label for="invgrandtotal" class="custom-label text-danger">
																			Grand Total *
																		</label>
																	</div>
																	<div class="col-lg-7">
																		<div class="input-group">
																			<div class="input-group-prepend" style="border:1px solid #ced4da;">
																				<div class="input-group-text" style="color: #495057;padding: 6px 3.75px 0px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																					<?php echo $resmaincurrencyans; ?>    
																				</div>
																			</div>
																			<input type="number" class="form-control  form-control-sm" id="invgrandtotal" name="invgrandtotal" value="<?=$rows[0]['invgrandtotal']?>" required onchange="invgrandch(this)" style="border:1px solid #ced4da;border-left: 0px !important;">
																			<script type="text/javascript">
																			function invgrandch(x) {
																				let grandtotalch = document.getElementById("invgrandtotal").value;
																				document.getElementById("invgrandtotal").value = parseFloat(Math.round(grandtotalch * 100) / 100).toFixed(2);
																			}
																			</script>
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
								<?php
									// }
								?>
									<input type="hidden" id="custoriginpage">
									<input type="hidden" id="prooriginpage">
								<?php
	 								// if ((in_array('Vendor Information', $fieldedit))) {
								?>
									<div class="col-lg-8">
										<div class="accordion" id="accordionRental">
											<div class="accordion-item mb-1">
												<h5 class="accordion-header" id="headingOne" >
													<button class="accordion-button font-weight-bold" type="button" id="vendorinfotoggler">
														<div class="row" style="width:100% !important;">
															<div class="col-lg-6" id="vendorinfofirst">
																<div class="customcont-header ml-0 mb-1" style="height: 30px;">
																	<a class="customcont-heading" style="padding: 7px 0 7px;">
																		<?= $infomainaccessuserven['modulename'] ?> Information
																	</a>
																	<input type="hidden" id="propos">
																	<input type="hidden" id="proposfinal">
																	<!-- <input type="hidden" id="dlno20" name="dlno20" value="<?=$rows[0]['dlno20']?>"> -->
																	<!-- <input type="hidden" id="dlno21" name="dlno21" value="<?=$rows[0]['dlno21']?>"> -->
																</div>
															</div>
															<div class="col-lg-6" id="vendorinfosecond" style="margin-bottom: 4px !important;">
															<?php
																$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
																$sqlismainaccessusers->bind_param("s", $userid);
																$sqlismainaccessusers->execute();
																$sqlismainaccessuser = $sqlismainaccessusers->get_result();
																$infomainaccessuser=$sqlismainaccessuser->fetch_array();
																$sqlismainaccessuser->close();
																$sqlismainaccessusers->close();
																if (($infomainaccessuser['billveninfo']=='defone')||($infomainaccessuser['billveninfo']=='deftwo')) {
															?>
	 															<div class="row">
					  												<div class="col-lg-2 col-md-2 col-3">
					  													<div class="custom-control custom-radio mr-sm-2">
																			<input type="radio" class="custom-control-input" name="vendorinfodefault" id="onevendorinfo" value="one" <?= ($rows[0]['vendorinfodefault']=='one')?'checked':'' ?> onclick="onetwo()">
																			<label class="custom-control-label custom-label" for="onevendorinfo">
																				B2B
																			</label>
																		</div>
																	</div>
																  	<div class="col-lg-2 col-md-2 col-3">
																	  	<div class="custom-control custom-radio mr-sm-2">
																			<input type="radio" class="custom-control-input" name="vendorinfodefault" id="twovendorinfo" value="two" <?= ($rows[0]['vendorinfodefault']=='two')?'checked':'' ?> onclick="onetwo()">
																			<label class="custom-control-label custom-label" for="twovendorinfo">
																				B2C
																			</label>
																		</div>
																  	</div>
															  	</div>
																<script type="text/javascript">
																$(document).ready(function () {
																	let one = document.getElementById("onevendorinfo");
																	let two = document.getElementById("twovendorinfo");
																	if (one.checked==true) {
																		$("#one").show();
																		$("#two").hide();
																		$("#vendor").attr("required","required");
																	<?php
																		if ($access['billbtwocnamerequired']=='Yes') {
																	?>
																		$("#twovendorname").removeAttr("required");
																	<?php
																		}
																		if ($access['billbtwocwphonerequired']=='Yes') {
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
																					batchget(id);
																					document.getElementById("outfordone"+id).style.display = 'none';
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
																		if ($access['billbtwocnamerequired']=='Yes') {
																	?>
																		$("#twovendorname").attr("required","required");
																	<?php
																		}
																		if ($access['billbtwocwphonerequired']=='Yes') {
																	?>
																		$("#twoworkphone").attr("required","required");
																	<?php
																		}
																	?>
																		$("#twopos").attr("required","required");
																		$("#vendor").removeAttr("required");
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
																					batchget(id);
																					document.getElementById("outfordone"+id).style.display = 'none';
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
																	let one = document.getElementById("onevendorinfo");
																	let two = document.getElementById("twovendorinfo");
																	if (one.checked==true) {
																		$("#one").show();
																		$("#two").hide();
																		$("#vendor").attr("required","required");
																	<?php
																		if ($access['billbtwocnamerequired']=='Yes') {
																	?>
																		$("#twovendorname").removeAttr("required");
																	<?php
																		}
																		if ($access['billbtwocwphonerequired']=='Yes') {
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
																					batchget(id);
																					document.getElementById("outfordone"+id).style.display = 'none';
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
																		if ($access['billbtwocnamerequired']=='Yes') {
																	?>
																		$("#twovendorname").attr("required","required");
																	<?php
																		}
																		if ($access['billbtwocwphonerequired']=='Yes') {
																	?>
																		$("#twoworkphone").attr("required","required");
																	<?php
																		}
																	?>
																		$("#twopos").attr("required","required");
																		$("#vendor").removeAttr("required");
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
																					batchget(id);
																					document.getElementById("outfordone"+id).style.display = 'none';
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
														$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
														$sqlismainaccessusers->bind_param("s", $userid);
														$sqlismainaccessusers->execute();
														$sqlismainaccessuser = $sqlismainaccessusers->get_result();
														$infomainaccessuser=$sqlismainaccessuser->fetch_array();
														$sqlismainaccessuser->close();
														$sqlismainaccessusers->close();
														if ($infomainaccessuser['billveninfo']=='one'||(($infomainaccessuser['billveninfo']=='defone')||($infomainaccessuser['billveninfo']=='deftwo'))) {
													?>
														<div id="one">
															<div class="row">
																<div class="col-lg-12">
																	<div class="form-group row" style="align-items: center !important;">
																		<input type="hidden" name="vendorid" id="vendorid" value="<?=$rows[0]['vendorid']?>">
																		<div class="col-sm-3">
																			<label for="vendorname" class="custom-label">
																				<span class="text-danger">
																					<?= $infomainaccessuserven['modulename'] ?> Name *
																				</span>
																			</label>
																		</div>
																		<div class="col-sm-9" onclick="andus()">
																			<select class="form-control  form-control-sm" name="vendor" id="vendor" required>
																				<option value="" data-foo="" data-receivable="" selected disabled>
																					Select
																				</option>
																			<?php
																				$sqlis=$con->prepare("SELECT id, customername, billcity, mobile, workphone FROM paircustomers WHERE franchisesession=? AND (createdid=? AND moduletype='Vendors') AND id=? ORDER BY customername ASC");
																				$sqlis->bind_param("ssi", $_SESSION["franchisesession"], $companymainid, $rows[0]['vendorid']);
																				$sqlis->execute();
																				$sqli = $sqlis->get_result();
																				while($info=$sqli->fetch_array()){
																			?>
																				<option value="<?=$info['id']?>" <?=($rows[0]['vendorid']==$info['id'])?'selected':''?>>
																					<?=$info['customername']?>
																				</option>
																			<?php
																				}
																				$sqlis->close();
																				$sqli->close();
																			?>
																			</select>
																			<input type="text" class="form-control  form-control-sm" id="vendorname" name="vendorname" placeholder="<?= $infomainaccessuserven['modulename'] ?> Name" style="display:none"  value="<?=$rows[0]['vendorname']?>">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-lg-3">
																</div>
																<div class="col-lg-9">
																	<div class="row mb-1" id="custaddressdiv" style="background-color:#fbfafa; color:#777777; display:none;margin: 0px !important;">
																		<div class="col-lg-12 mb-0 mt-0" style="padding-left: 3px !important;">
																			<div id="ember529" class="info-item cursor-pointer ember-view" style="margin-top:-3px !important;">
																				<div class="row">
																					<div class="col-sm-6">
																						<span class="text-blue" data-bs-toggle="modal" data-bs-target="#Viewcustdetails">
																							<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon align-text-bottom"><path d="M394.8 422h-90c-11 0-20-9-20-20s9-20 20-20h90c11 0 20 9 20 20s-9 20-20 20zm97-145h-187c-11 0-20-9-20-20s9-20 20-20h187c11 0 20 9 20 20s-9 20-20 20zm0-145h-187c-11 0-20-9-20-20s9-20 20-20h187c11 0 20 9 20 20s-9 20-20 20zM227.2 422c-11 0-20-9-20-20v-37.3c0-22.2-22.3-40.3-49.8-40.3H89.8c-27.4 0-49.8 18.1-49.8 40.3V402c0 11-9 20-20 20s-20-9-20-20v-37.3c0-44.3 40.3-80.3 89.8-80.3h67.6c49.5 0 89.8 36 89.8 80.3V402c0 11-8.9 20-20 20zM123.6 244.8C80.8 244.8 46 210 46 167.2s34.8-77.6 77.6-77.6 77.6 34.8 77.6 77.6-34.8 77.6-77.6 77.6zm0-115.1c-20.7 0-37.6 16.9-37.6 37.6 0 20.7 16.8 37.6 37.6 37.6s37.6-16.9 37.6-37.6c0-20.8-16.8-37.6-37.6-37.6z"></path></svg>
																							&nbsp; View <?= $infomainaccessuserven['modulename'] ?> Details
																						</span>
																					</div>
																					<div class="col-sm-6 svgforfrequent">
																						<span class="text-blue" data-bs-toggle="modal" data-bs-target="#Viewfrequentproduct">
																							<svg width="14px" height="14px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000" class="bi bi-cart-check"><path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
																							Frequently Purchased <?=$infomainaccessuserpro['modulename']?>
																						</span>
																					</div>
																				</div>
																				<div id="ember530" class="ember-view">
																					<div id="ember531" class="ember-view">
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-6" style="padding-left: 3px !important;font-size: 13px !important;<?=(in_array('Billing Address', $fieldedit))?'':'display:none;'?>">
																			<div id="ember532" class="popovercontainer address-group ember-view">
																				<span class="font-small" style="color:#777777;">
																					BILLING ADDRESS&nbsp;&nbsp;&nbsp;
																					<input type="hidden" name="pos" id="pos" value="<?=$rows[0]['pos']?>" >
																					<input type="hidden" name="address1" id="address1" value="<?=$rows[0]['address1']?>">
																					<input type="hidden" name="address2" id="address2" value="<?=$rows[0]['address2']?>">
																					<input type="hidden" name="area" id="area" value="<?=$rows[0]['area']?>">
																					<input type="hidden" name="city" id="city" value="<?=$rows[0]['city']?>">
																					<input type="hidden" name="state" id="state" value="<?=$rows[0]['state']?>">
																					<input type="hidden" name="pincode" id="pincode" value="<?=$rows[0]['pincode']?>">
																					<input type="hidden" name="district" id="district" value="<?=$rows[0]['district']?>">
																					<span id="billingaddressspan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#billingaddressmodel" style="font-size:13px !important;">
																						Change
																					</span>
																					<address id="billingaddressdiv" class="font-small ember-view" style="color:green;margin-bottom: 1px !important;">
																						<?=$rows[0]['area']?> <?=$rows[0]['city']?>
																						<br>
																						<?=$rows[0]['state']?> <?=$rows[0]['pincode']?>  <?=$rows[0]['district']?>
																					</address>
																				</span>
																			</div>
																		</div>
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
																						<button   onclick="funbillingaddress()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitbilling" value="Save">
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
																			document.getElementById("state").value=billcity;
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
																		<div class="col-lg-6" style="padding-left: 3px !important;font-size: 13px !important;<?=(in_array('Shipping Address', $fieldedit))?'':'display:none;'?>">
																			<div id="ember532" class="popovercontainer address-group ember-view">
																				<span class="font-small" style="color:#777777;">
																					SHIPPING ADDRESS&nbsp;&nbsp;&nbsp;
																					<input type="hidden" name="saddress1" id="saddress1" value="<?=$rows[0]['saddress1']?>">
																					<input type="hidden" name="saddress2" id="saddress2" value="<?=$rows[0]['saddress2']?>">
																					<input type="hidden" name="sarea" id="sarea" value="<?=$rows[0]['sarea']?>">
																					<input type="hidden" name="scity" id="scity" value="<?=$rows[0]['scity']?>">
																					<input type="hidden" name="sstate" id="sstate" value="<?=$rows[0]['sstate']?>">
																					<input type="hidden" name="spincode" id="spincode" value="<?=$rows[0]['spincode']?>">
																					<input type="hidden" name="sdistrict" id="sdistrict" value="<?=$rows[0]['sdistrict']?>">
																					<span id="shippingaddressspan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#shippingaddressmodel" style="font-size:13px !important;">
																						Change
																					</span>
																					<address id="shippingaddressdiv" class="font-small ember-view" style="color:green;margin-bottom: 1px !important;">
																						<?=$rows[0]['sarea']?> <?=$rows[0]['scity']?>
																						<br>
																						<?=$rows[0]['sstate']?> <?=$rows[0]['spincode']?> <?=$rows[0]['sdistrict']?>
																					</address>
																				</span>
																			</div>
																		</div>
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
																						<button   onclick="funshippingaddress()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitshipping" value="Save">
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
																			document.getElementById("sstate").value=shipcity;
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
																		<div class="col-lg-6" style="padding-left: 3px !important;<?=(in_array('Work Phone', $fieldedit))?'':'display:none;'?>">
																			<input type="hidden" name="mobile" id="mobile" >
																			<input type="hidden" name="workphone" id="workphone" >
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
																										<input type="text" class="form-control  form-control-sm" maxlength="100" id="workworkphone" name="workworkphone" placeholder="Work Phone" maxlength="25">
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																					<div class="modal-footer">
																						<button   onclick="funworkphone()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitwork" value="Save">
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
																		<div class="col-lg-6" style="padding-left: 3px !important;<?=(in_array('Mobile Phone', $fieldedit))?'':'display:none;'?>">
																			<input type="hidden" name="mobile" id="mobile" >
																			<input type="hidden" name="mobilephone" id="mobilephone" >
																			<span class="font-small" style="color:#777777;font-size: 12px !important">
																				MOBILE PHONE&nbsp;&nbsp;&nbsp;
																			</span>
																			<span id="mobiletypespan" class="text-blue cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#mobilephonemodel" style="font-size:12px !important;">
																				Change
																			</span>
																			<div id="mobilephonediv" style="color:green;margin-bottom: 1px !important;">
																			</div>
																		</div>
																		<div class="col-lg-6" style="padding-left: 3px !important;margin-top: 0px ;<?=(in_array('GSTIN', $fieldedit))?'':'display:none;'?>" id="mphonemob">
																			<input type="hidden" name="gstno" id="gstno" >
																			<input type="hidden" name="gstrtype" id="gstrtype" >
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
																										<input type="text" class="form-control  form-control-sm" maxlength="100" id="workmobile" name="workmobile" placeholder="Mobile Phone" maxlength="25">
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																					<div class="modal-footer">
																						<button   onclick="funmobilephone()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitmobile" value="Save">
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
																			document.getElementById("workphone").value=workworkphone;
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
																		function funmobilephone(){
																			var mobile=document.getElementById("workmobile").value;
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
																										<select class="selectpicker form-control select2" data-live-search="true" title="Search title or description..." onchange="showDivcust(this.value)" id="gstgstrtype" name="gstgstrtype">
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
																											<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas">
																												Overseas
																											</option>
																											<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone">
																												Special Economic Zone
																											</option>
																											<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export">
																												Deemed Export
																											</option>
																											<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor">
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
																						<button   onclick="fungstrtype()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitgst" value="Save">
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
													<?php
														}
														if ($infomainaccessuser['billveninfo']=='two'||(($infomainaccessuser['billveninfo']=='defone')||($infomainaccessuser['billveninfo']=='deftwo'))) {
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
																		batchget(id);
																		document.getElementById("outfordone"+id).style.display = 'none';
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
																<div class="col-lg-3">
																	<label for="customername" class="custom-label">
																		<?= ($access['billbtwocnamerequired']=='Yes')? '<span class="text-danger">'. $infomainaccessuserven['modulename'] . ' Name * </span>': $infomainaccessuserven['modulename'] . ' Name ' ?>
																	</label>
																</div>
																<div class="col-lg-9">
																	<input type="text" name="twovendorname" id="twovendorname" class="form-control form-control-sm" placeholder="<?= $infomainaccessuserven['modulename'] ?> Name" <?= ($access['billbtwocnamerequired']=='Yes')? 'required': ' ' ?> value="<?= $rows[0]['vendorname'] ?>">
																	<input type="hidden" name="oldvendorname" value="<?=$rows[0]['vendorid']?>">
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
																			<div class="col-lg-6" <?=(in_array('Billing Address', $fieldedit))?'':'style="display:none;"'?>>
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
																									<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="twobillstreet" id="twobillstreet"  placeholder="Street" value="<?=$rows[0]['area']?>" oninput="twobillstreetoip(this)">
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
																						<label for="twoshipping" class="custom-label" style="width:max-content !important;margin: 0px !important;font-size: 13px !important;color: #777777;">
																							SHIPPING ADDRESS
																						</label>
																					</div>
																					<div class="col-lg-6">
																						<div class="custom-control custom-checkbox" onclick="twosameasbillingticaccess()" style="min-height: 19.5px !important;">
																							<input type="checkbox" class="custom-control-input" name="twosameasbilling" id="twosameasbilling"  <?=($rows[0]['sameasbilling']=='1')?'checked':''?>>
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
																					<?= ($access['billbtwocwphonerequired']=='Yes')? '<span class="text-danger"> WORK PHONE * </span>': ' WORK PHONE ' ?>
																				</label>
																				<input type="text" class="form-control form-control-sm" id="twoworkphone" name="twoworkphone" placeholder="WORK PHONE" value="<?=$rows[0]['workphone']?>" <?= ($access['billbtwocwphonerequired']=='Yes')? 'required': ' ' ?> maxlength="25">
																				<input type="hidden" name="oldtwoworkphone" value="<?=$rows[0]['workphone']?>">
																			</div>
																			<div class="col-lg-6" <?=(in_array('Mobile Phone', $fieldedit))?'':'style="display:none;"'?>>
																				<label for="twomobilephone" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																					MOBILE PHONE
																				</label>
																				<input type="text" class="form-control form-control-sm" id="twomobilephone" name="twomobilephone" placeholder="MOBILE PHONE" value="<?=$rows[0]['mobile']?>" maxlength="25">
																			</div>
																		</div>
																		<div class="row" style="padding:9px 0px !important;margin: 0px !important;">
																			<div class="col-lg-8" <?=(in_array('GSTIN', $fieldedit))?'':'style="display:none;"'?>>
																				<div class="row">
																					<div class="col-lg-6">
																						<label for="twogsttreatment" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																							GST TREATMENT
																						</label>
																						<input type="text" class="form-control form-control-sm" id="twogsttreatment" name="twogsttreatment" placeholder="GST TREATMENT" value="<?=$rows[0]['gstrtype']?>" readonly>
																					</div>
																					<div class="col-lg-6" id="twogstinblock">
																						<label for="twogstin" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																							GSTIN
																						</label>
																						<input type="text" class="form-control form-control-sm" id="twogstin" name="twogstin" placeholder="GSTIN" value="<?=$rows[0]['gstno']?>" readonly>
																					</div>
																				</div>
																			</div>
																			<div class="col-lg-4" <?=(in_array('Place of Supply', $fieldedit))?'':'style="display:none;"'?>>
																				<div class="row">
																					<div class="col-lg-12" id="twoposblock">
																						<label for="twomobilephone" class="custom-label" style="margin:0px !important;font-size: 12px !important;color: #777777;">
																							<span class="text-danger">
																								PLACE OF SUPPLY *
																							</span>
																						</label>
																						<select name="twopos" id="twopos" class="select5 form-control form-control-sm" required onchange="twoposans()">
																							<option value="JAMMU AND KASHMIR (1)" <?=($rows[0]['pos']=="JAMMU AND KASHMIR (1)")?'selected':''?>>
																								JAMMU AND KASHMIR (1)
																							</option>
																							<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($rows[0]['pos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>
																								ANDAMAN AND NICOBAR ISLANDS (35)
																							</option>
																							<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($rows[0]['pos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>
																								ANDHRA PRADESH (NEWLY ADDED) (37)
																							</option>
																							<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($rows[0]['pos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>
																								ANDHRA PRADESH(BEFORE DIVISION) (28)
																							</option>
																							<option value="ARUNACHAL PRADESH (12)" <?=($rows[0]['pos']=="ARUNACHAL PRADESH (12)")?'selected':''?>>
																								ARUNACHAL PRADESH (12)
																							</option>
																							<option value="ASSAM (18)" <?=($rows[0]['pos']=="ASSAM (18)")?'selected':''?>>
																								ASSAM (18)
																							</option>
																							<option value="BIHAR (10)" <?=($rows[0]['pos']=="BIHAR (10)")?'selected':''?>>
																								BIHAR (10)
																							</option>
																							<option value="CENTRE JURISDICTION (99)" <?=($rows[0]['pos']=="CENTRE JURISDICTION (99)")?'selected':''?>>
																								CENTRE JURISDICTION (99)
																							</option>
																							<option value="CHANDIGARH (4)" <?=($rows[0]['pos']=="CHANDIGARH (4)")?'selected':''?>>
																								CHANDIGARH (4)
																							</option>
																							<option value="CHATTISGARH (22)" <?=($rows[0]['pos']=="CHATTISGARH (22)")?'selected':''?>>
																								CHATTISGARH (22)
																							</option>
																							<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($rows[0]['pos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>
																								DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)
																							</option>
																							<option value="DELHI (7)" <?=($rows[0]['pos']=="DELHI (7)")?'selected':''?>>
																								DELHI (7)
																							</option>
																							<option value="GOA (30)" <?=($rows[0]['pos']=="GOA (30)")?'selected':''?>>
																								GOA (30)
																							</option>
																							<option value="GUJARAT (24)" <?=($rows[0]['pos']=="GUJARAT (24)")?'selected':''?>>
																								GUJARAT (24)
																							</option>
																							<option value="HARYANA (6)" <?=($rows[0]['pos']=="HARYANA (6)")?'selected':''?>>
																								HARYANA (6)
																							</option>
																							<option value="HIMACHAL PRADESH (2)" <?=($rows[0]['pos']=="HIMACHAL PRADESH (2)")?'selected':''?>>
																								HIMACHAL PRADESH (2)
																							</option>
																							<option value="JHARKHAND (20)" <?=($rows[0]['pos']=="JHARKHAND (20)")?'selected':''?>>
																								JHARKHAND (20)
																							</option>
																							<option value="KARNATAKA (29)" <?=($rows[0]['pos']=="KARNATAKA (29)")?'selected':''?>>
																								KARNATAKA (29)
																							</option>
																							<option value="KERALA (32)" <?=($rows[0]['pos']=="KERALA (32)")?'selected':''?>>
																								KERALA (32)
																							</option>
																							<option value="LADAKH (NEWLY ADDED) (38)" <?=($rows[0]['pos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>
																								LADAKH (NEWLY ADDED) (38)
																							</option>
																							<option value="LAKSHADWEEP (31)" <?=($rows[0]['pos']=="LAKSHADWEEP (31)")?'selected':''?>>
																								LAKSHADWEEP (31)
																							</option>
																							<option value="MADHYA PRADESH (23)" <?=($rows[0]['pos']=="MADHYA PRADESH (23)")?'selected':''?>>
																								MADHYA PRADESH (23)
																							</option>
																							<option value="MAHARASHTRA (27)" <?=($rows[0]['pos']=="MAHARASHTRA (27)")?'selected':''?>>
																								MAHARASHTRA (27)
																							</option>
																							<option value="MANIPUR (14)" <?=($rows[0]['pos']=="MANIPUR (14)")?'selected':''?>>
																								MANIPUR (14)
																							</option>
																							<option value="MEGHALAYA (17)" <?=($rows[0]['pos']=="MEGHALAYA (17)")?'selected':''?>>
																								MEGHALAYA (17)
																							</option>
																							<option value="MIZORAM (15)" <?=($rows[0]['pos']=="MIZORAM (15)")?'selected':''?>>
																								MIZORAM (15)
																							</option>
																							<option value="NAGALAND (13)" <?=($rows[0]['pos']=="NAGALAND (13)")?'selected':''?>>
																								NAGALAND (13)
																							</option>
																							<option value="ODISHA (21)" <?=($rows[0]['pos']=="ODISHA (21)")?'selected':''?>>
																								ODISHA (21)
																							</option>
																							<option value="OTHER TERRITORY (97)" <?=($rows[0]['pos']=="OTHER TERRITORY (97)")?'selected':''?>>
																								OTHER TERRITORY (97)
																							</option>
																							<option value="PUDUCHERRY (34)" <?=($rows[0]['pos']=="PUDUCHERRY (34)")?'selected':''?>>
																								PUDUCHERRY (34)
																							</option>
																							<option value="PUNJAB (3)" <?=($rows[0]['pos']=="PUNJAB (3)")?'selected':''?>>
																								PUNJAB (3)
																							</option>
																							<option value="RAJASTHAN (8)" <?=($rows[0]['pos']=="RAJASTHAN (8)")?'selected':''?>>
																								RAJASTHAN (8)
																							</option>
																							<option value="SIKKIM (11)" <?=($rows[0]['pos']=="SIKKIM (11)")?'selected':''?>>
																								SIKKIM (11)
																							</option>
																							<option value="TAMIL NADU (33)"  <?=($rows[0]['pos']=="TAMIL NADU (33)")?'selected':''?>>
																								TAMIL NADU (33)
																							</option>
																							<option value="TELANGANA (36)" <?=($rows[0]['pos']=="TELANGANA (36)")?'selected':''?>>
																								TELANGANA (36)
																							</option>
																							<option value="TRIPURA (16)" <?=($rows[0]['pos']=="TRIPURA (16)")?'selected':''?>>
																								TRIPURA (16)
																							</option>
																							<option value="UTTAR PRADESH (9)" <?=($rows[0]['pos']=="UTTAR PRADESH (9)")?'selected':''?>>
																								UTTAR PRADESH (9)
																							</option>
																							<option value="UTTARAKHAND (5)" <?=($rows[0]['pos']=="UTTARAKHAND (5)")?'selected':''?>>
																								UTTARAKHAND (5)
																							</option>
																							<option value="WEST BENGAL (19)" <?=($rows[0]['pos']=="WEST BENGAL (19)")?'selected':''?>>
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
													<?php
														}
													?>
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
								</div>
							<?php
								// if ((in_array('Item Information', $fieldedit))) {
							?>
								<div class="row">
									<div class="accordion" id="accordionRental">
										<div class="accordion-item mb-1">
											<h5 class="accordion-header" id="headingOne" >
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
																	<th <?=((in_array('Barcode', $fieldedit))||(in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'':'style="display:none !important;"'?>>
																	</th>
																<?php
																	if (in_array('Barcode', $fieldedit)) {
																?>
																	<th width="16%">
																		BARCODE
																	</th>
																<?php
																	}
																?>
																<?php
																	if (in_array('Item Details', $fieldedit)) {
																?>
																	<th width="16%">
																		ITEM DETAILS<span class="text-danger"> *</span>
																	</th>
																<?php
																	}
																	if ($access['batchexpiryval']==1) {
																?>
																	<th width="13%">
																		BATCH
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
																	if (in_array('Rate', $fieldedit)) {
																?>
																	<th style="width: 100px;text-align: right !important;">
																		RATE<span class="text-danger"> *</span>
																	</th>
																<?php
																	}
																	if (in_array('Quantity', $fieldedit)) {
																?>
																	<th style="width: 87px !important;text-align: right !important;">
																		<?=($access['txtqtybill'])?><span class="text-danger"> *</span>
																	</th>
																<?php
																	}
																	if ((in_array('Taxable Value', $fieldedit))) {
																?>
																	<th style="text-align: right !important;">
																		<?=($access['txttaxablebill'])?>
																	</th>
																<?php
																	}
																	if ((in_array('Tax Value', $fieldedit))) {
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
																	if ((in_array('Amount', $fieldedit))) {
																?>
																	<th style="text-align: right !important;">
																		AMOUNT
																	</th>
																<?php
																	}
																	if ((in_array('Sale Quantity', $fieldedit))) {
																?>
																	<th style="background-color:#1BBC9B;text-align: right !important;">
																		<?=$access['txtsqty']?>
																	</th>
																<?php
																	}
																?>
																	<th <?=((in_array('Barcode', $fieldedit))||(in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'':'style="display:none !important;"'?>>
																		<div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldedit))?'display:none !important;':'display:none !important;'?>">
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
														<?php
															$i=1;
															foreach($rows as $row){
														?>
															<input type="hidden" name="oldesproductid[]" value="<?=$row['productid']?>">
															<input type="hidden" name="oldesproductname[]" value="<?=$row['productname']?>">
															<input type="hidden" name="oldesmanufacturer[]" value="<?=$row['manufacturer']?>">
															<input type="hidden" name="oldesproducthsn[]" value="<?=$row['producthsn']?>">
															<input type="hidden" name="oldesproductnotes[]" value="<?=$row['productnotes']?>">
															<input type="hidden" name="oldesproductdescription[]" value="<?=$row['productdescription']?>">
															<input type="hidden" name="oldesitemmodule[]" value="<?=$row['itemmodule']?>">
															<input type="hidden" name="oldesrack[]" value="<?=$row['rack']?>">
															<input type="hidden" name="oldesbatch[]" value="<?=$row['batch']?>">
															<input type="hidden" name="oldesexpdate[]" value="<?=$row['expdate']?>">
															<input type="hidden" name="oldesmrp[]" value="<?=$row['mrp']?>">
															<input type="hidden" name="oldesvat[]" value="<?=$row['vat']?>">
															<div style="display:none;">
																<input type="hidden" name="oldesicsgsthis[]" value="<?=$row['icsgsthis']?>">
															</div>
															<input type="hidden" name="oldesquantity[]" value="<?=$row['quantity']?>">
															<input type="hidden" name="oldesproductunit[]" value="<?=$row['unit']?>">
															<input type="hidden" name="oldesproductrate[]" value="<?=$row['productrate']?>">
															<input type="hidden" name="oldesnoofpacks[]" value="<?=$row['noofpacks']?>">
															<input type="hidden" name="oldesprodiscount[]" value="<?=$row['prodiscount']?>">
															<input type="hidden" name="oldesprodiscounttype[]" value="<?=$row['prodiscounttype']?>">
															<input type="hidden" name="oldesproductvalue[]" value="<?=$row['productvalue']?>">
															<input type="hidden" name="oldestaxvalue[]" value="<?=$row['taxvalue']?>">
															<input type="hidden" name="oldesproductnetvalue[]" value="<?=$row['productnetvalue']?>">
															<input type="hidden" name="oldessalequantity[]" value="<?=$row['salequantity']?>">
															<input type="hidden" name="oldesproductwithouttax[]" value="<?=$row['productwithouttax']?>">
															<input type="hidden" name="oldesproductwithtax[]" value="<?=$row['productwithtax']?>">
														<?php
															}
														?>
															<tbody id="purchasetablebody">
															<?php
																$i=1;
																foreach($rows as $row){
															?>
																<input type="hidden" name="oldbarcode[]" id="oldbarcode<?=$i?>" value="<?=$row['barcode']?>">
																<input type="hidden" name="oldproductid[]" id="oldproductid<?=$i?>" value="<?=$row['productid']?>">
																<input type="hidden" name="oldproductname[]" id="oldproductname<?=$i?>" value="<?=$row['productname']?>">
																<input type="hidden" name="oldmanufacturer[]" id="oldmanufacturer<?=$i?>" value="<?=$row['manufacturer']?>">
																<input type="hidden" name="oldproducthsn[]" id="oldproducthsn<?=$i?>" value="<?=$row['producthsn']?>">
																<input type="hidden" name="oldproductnotes[]" id="oldproductnotes<?=$i?>" value="<?=$row['productnotes']?>">
																<input type="hidden" name="oldproductdescription[]" id="oldproductdescription<?=$i?>" value="<?=$row['productdescription']?>">
																<input type="hidden" name="olditemmodule[]" id="olditemmodule<?=$i?>" value="<?=$row['itemmodule']?>">
																<input type="hidden" name="oldrack[]" id="oldrack<?=$i?>" value="<?=$row['rack']?>">
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
																	<td class="priority" style="display:none">
																		<?=$i?>
																	</td>
																	<td class="tdmove" <?=((in_array('Barcode', $fieldedit))||(in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'':'style="display:none !important;"'?>>
																		<svg version="1.1" id="Layer_<?=$i?>" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg>
																	</td>
																	<td data-label="BARCODE" style="<?=(in_array('Barcode', $fieldedit))?'':'display:none !important;'?>">
																		<div>
																			<input type="text" name="barcode[]" id="barcode<?=$i?>" value="<?=$row['barcode']?>" class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" onchange="checkthecode(<?=$i?>)">
																		</div>
																		<div>
																			<span id="viewbarcode<?=$i?>" style="display:none; font-size:11px;color: royalblue;" data-bs-toggle="modal" data-bs-target="#barcodeModal" onclick="generateBarcode(<?=$i?>)">
																				View and Download Barcode
																			</span>
																			<input type="hidden" id="barcodeformat<?=$i?>">
																			<input type="hidden" id="barcodetitle<?=$i?>">
																			<input type="hidden" id="barcodesubtitle<?=$i?>">
																			<input type="hidden" id="barcodeval<?=$i?>">
																			<input type="hidden" id="underbarcodelabel<?=$i?>">
																			<input type="hidden" id="footernote<?=$i?>">
																		</div>
																	</td>
																	<td data-label="ITEM DETAILS" style="padding-top: 1px !important;<?=(in_array('Item Details', $fieldedit))?'':'display:none !important;'?>">
																		<input type="hidden" name="productid[]" id="productid<?=$i?>" value="<?=$row['productid']?>">
																		<input type="hidden" name="productname[]" id="productname<?=$i?>" value="<?=$row['productname']?>">
																		<div class="col-sm-9" onclick="andus()" style="width:278px;display: inline-block;" id="selecttheproduct">
																			<select class="form-control  form-control-sm product proitemselect product1" name="product[]" id="product<?=$i?>" required onChange="productchange(<?=$i?>)">
																				<option value="" data-foo="" data-receivable="" selected disabled>
																					Select
																				</option>
																			<?php
																				$sqlis=$con->prepare("SELECT t1.productname, t1.category, t1.id, t1.description, t1.itemmodule, t1.hsncode, t1.openingstock, t2.tax, t3.salemrp, t3.salecost, t3.salediscount, t3.saleofferprice, t1.manufacturer, t1.defaultunit FROM pairproducts t1, pairtaxrates t2, pairprosale t3 WHERE t1.createdid=? AND ((t1.franchisesession=? AND t1.pvisiblity='PRIVATE') OR t1.pvisiblity='PUBLIC') AND (t2.id=t1.intratax OR t1.intratax='null') AND t3.productid=t1.id AND t1.id=? ORDER BY t1.productname ASC");
																				$sqlis->bind_param("ssi", $companymainid, $_SESSION["franchisesession"], $row['productid']);
																				$sqlis->execute();
																				$sqli = $sqlis->get_result();
																				while($info=$sqli->fetch_array()){
																			?>
																				<option value="<?=htmlspecialchars($info['id'], ENT_QUOTES, 'UTF-8');?>" <?=($row['productid']==$info['id'])?'selected':''?>>
																					<?=$info['productname'];?>
																				</option>
																			<?php
																				}
																				$sqlis->close();
																				$sqli->close();
																			?>
																			</select>
																		</div>
																		<span class="badge" style="width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan<?=$i?>">
																			<?=$row['itemmodule']?>
																		</span>
																		<input type="hidden" name="itemmodule[]" id="itemmodule<?=$i?>" value="<?=$row['itemmodule']?>">
																		<div <?=(in_array('Category', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productmanufacturerspan<?=$i?>" style="display: inline-flex; font-size:11px;">
																				<?=$access['txtnamecategory']?>:
																				<input type="text" name="manufacturer[]" id="manufacturer<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 39px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" value="<?=$row['manufacturer']?>" readonly onChange="productcalc(<?=$i?>)">
																			</span>
																			<span id="productmanufacturerval<?=$i?>" style="display: inline-flex; font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['manufacturer']?>
																			</span>
																			<span id="productmanufactureredit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productmanufacturerupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div <?=(in_array('Hsn or Sac', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="producthsncodespan<?=$i?>" style="font-size:11px;display: inline-flex;">
																				HSN Code:
																			</span>
																			<input type="text" name="producthsn[]" maxlength="100" id="producthsn<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['producthsn']?>" onChange="productcalc(<?=$i?>)">
																			<span id="producthsncodeval<?=$i?>" style="display: inline-flex; font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['producthsn']?>
																			</span>
																			<span id="producthsncodeedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="producthsncodeupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																			<br>
																		</div>
																		<div <?=(in_array('Rack', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="rackspan<?=$i?>" style="display:inline-flex; font-size:11px;">
																				Rack:
																			</span>
																			<span id="rackval<?=$i?>" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['rack']?>
																			</span>
																			<input type="hidden" name="rack[]" id="rack<?=$i?>" value="<?=$row['rack']?>">
																			<br>
																		</div>
																		<span <?=(in_array('Product Description', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productdescriptionspan<?=$i?>" style="font-size:11px;display: block;">
																				Description:
																			</span>
																			<textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription<?=$i?>" style="height:50px; width: 100px;display: inline;"><?=$row['productdescription']?></textarea>
																		</span>
																		<div class="col-sm-9 totalaccounts account<?=$i?>" onclick="andus()" style="width:278px;display: none;margin-top: 5.5px !important;" id="selecttheproduct">
																			<select style=" width: 100%;" class="select4 form-control form-control-sm oldaccnames" name="accountname[]" id="accountname<?=$i?>">
																				<option selected disabled value="">
																					Select
																				</option>
																			<?php
																				$seloldval=$con->prepare("SELECT optionslist FROM pairchartaccounttypes WHERE optionslist!=''");
																				$seloldval->execute();
																				$seloldvals = $seloldval->get_result();
																				if ($seloldvals->num_rows>0) {
																					while($fetoldval=$seloldvals->fetch_array()){
																						$explodeoptions = explode(';', $fetoldval['optionslist']);
																						for($inneri=0;$inneri<count($explodeoptions)-1;$inneri++){
																							$finalvalues = explode(',',$explodeoptions[$inneri]);
																							if($finalvalues[0]==$row['accountid']){
																								echo '<option value="'.$finalvalues[0].'" '.(($finalvalues[0]==$row['accountid'])?'selected':'').'>'.$finalvalues[1].'</option>';
																							}
																						}
																					}
																					$seloldvals->close();
																				}
																				$seloldval->close();
																			?>
																			</select>
																		</div>
																	</td>
																	<td style="display:none">
																		<input type="text" name="productnotes[]" id="productnotes<?=$i?>" class="form-control form-control-sm bordernoneinput" value="<?=$row['productnotes']?>">
																	</td>
																	<td data-label="BATCH" <?=($access['batchexpiryval']==1)?'':'style="display:none;"'?>>
																		<div>
																			<input type="text" name="batch[]" maxlength="100" id="batch<?=$i?>" onClick="batchget(<?=$i?>);" onFocus="batchget(<?=$i?>);"  class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" value="<?=$row['batch']?>" autocomplete="off">
																		</div>
																		<div>
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
																		?>
																			<span id="productexpdatespan<?=$i?>" style="font-size:11px;">
																				EXPIRY:
																			</span>
																			<input type="date" name="expdate[]" id="expdate<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['expdate']?>" onChange="productcalc(<?=$i?>)">
																			<span id="productexpdateval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['expdate']!='')?date($datemainphp,strtotime($row['expdate'])):''?>
																			</span>
																			<span id="productexpdateedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productexpdateupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div>
																			<div id="outfordone<?=$i?>" class="dvi" style="display:none;width: 250px;">
																			</div>
																			<input type="text" id="errbatch<?=$i?>" style="display:none;">
																		</div>
																	</td>
																	<td data-label="RATE" <?=(in_array('Rate', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productrate[]"   required id="productrate<?=$i?>" class="form-control form-control-sm proitemselect mobinp productselectadd productselectwidth" oninput="mobinpadd(this)" onChange="productcalc(<?=$i?>)" onClick="rateget(<?=$i?>);" onFocus="rateget(<?=$i?>);" value="<?=$row['productrate']?>" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;">
																		</div>
																		<div <?=(in_array('Mrp', $fieldedit))?'':'style="visibility:hidden !important;"'?>>
																			<span id="productmrpspan<?=$i?>" style=" font-size:11px;white-space: nowrap !important;">
																				MRP:
																				<input type="number" name="mrp[]" id="mrp<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 39px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" value="<?=$row['mrp']?>" onChange="productcalc(<?=$i?>)">
																				<span id="productmrpval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<span style="margin-right: -3px !important">
																						<?php echo $resmaincurrencyans; ?>
																					</span>
																					<?=$row['mrp']?>
																				</span>
																				<span id="productmrpedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productmrpupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																		<div>
																			<div class="dvi invbillgets" id="invbillgets<?=$i?>" style="margin-top:-22px;display: none;width: 250px;border-radius: 0px !important;">
																				<table width="100%">
																					<tr style="border-bottom: 1px solid #cccccc;margin-bottom: 0px;">
																						<td align="center" style="border-right: 1px solid #cccccc;width: 50% !important;display: inline-block !important;text-align: center;">
																							<span onclick="selfgetfun(<?=$i?>,0)" id="invonoff<?=$i?>">
																								SELF
																							</span>
																						</td>
																						<td align="center" style="width: 50% !important;display: inline-block !important;text-align: center;">
																							<span onclick="othersgetfun(<?=$i?>)" id="billonoff<?=$i?>">
																								OTHERS
																							</span>
																						</td>
																						<input type="text" style="display: none;" value="self" id="selforothers<?=$i?>">
																					</tr>
																				</table>
																			</div>
																			<div id="ratelist<?=$i?>" class="dvi ratedvi" style="display:none;width: 250px;">
																			</div>
																			<input type="text" id="errrate<?=$i?>" style="display:none;">
																		</div>
																	</td>
																	<td data-label="<?=($access['txtqtybill'])?>" <?=(in_array('Quantity', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<input type="number" min="0" step="0.01" name="quantity[]" required id="quantity<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth" oninput="qtytosqty(<?=$i?>)" onClick="qtych(<?=$i?>)" onFocus="qtych(<?=$i?>)" onChange="productcalc(<?=$i?>)" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" value="<?=$row['quantity']?>">
																		</div>
																		<div <?=(in_array('Unit', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productunitspan<?=$i?>" style="font-size:11px;">
																				UNIT:
																			</span>
																			<input type="text" name="productunit[]" id="productunit<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['unit']?>" readonly onChange="productcalc(<?=$i?>)">
																			<span id="productunitval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['unit']?>
																			</span>
																			<span id="productunitedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editunit(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productunitupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div <?=(in_array('Pack', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productnoofpacksspan<?=$i?>" style=" font-size:11px;">
																				PACK:
																			</span>
																			<input type="text" name="noofpacks[]" maxlength="100" id="noofpacks<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['noofpacks']?>" onChange="productcalc(<?=$i?>)">
																			<span id="productnoofpacksval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['noofpacks']?>
																			</span>
																			<span id="productnoofpacksedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productnoofpacksupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																	</td>
																	<td data-label="<?=($access['txttaxablebill'])?>" <?=(in_array('Taxable Value', $fieldedit))?'':'style="display:none;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth productvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['productvalue']?>" >
																		</div>
																		<div <?=(in_array('Discount', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productprodiscountspan<?=$i?>" style=" font-size:11px;white-space: nowrap !important;">
																				<?=$access['txtprodisbill']?>:
																				<div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect<?=$i?>">
																					<div class="input-group-prepend">
																						<input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 35px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(<?=$i?>)" value="<?=$row['prodiscount']?>">
																					</div>
																					<select name="prodiscounttype[]" id="prodiscounttype<?=$i?>" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 0px !important;" onChange="productcalc(<?=$i?>)">
																						<option value="0" <?=($rows[0]['prodiscounttype']=='0')?'selected':''?>>
																							%
																						</option>
																						<option value="1" <?=($rows[0]['prodiscounttype']=='1')?'selected':''?>>
																							<?php echo $resmaincurrencyans; ?>
																						</option>
																					</select>
																				</div>
																				<input type="hidden" name="prodisvalueforledger[]" id="prodisvalueforledger<?=$i?>" value="<?=$row['prodiscount']?>">
																				<span id="productprodiscountval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<?=($rows[0]['prodiscounttype']=='0')?''.$row['prodiscount'].'%':'<span style="color:green !important;margin-right:-3px !important;">'.$resmaincurrencyans.'</span> '.$row['prodiscount'].''?>
																					(<span style="color:green !important;">
																						<span style="color:green !important;margin-right:-3px !important;">
																							<?=$resmaincurrencyans;?>
																						</span>
																						<?=$row['productrate']?> - 
																						<span style="color:green !important;margin-right:-3px !important;">
																							<?=$resmaincurrencyans;?>
																						</span>
																						<?=$row['prodiscount']?>
																					</span>)
																				</span>
																				<span id="productprodiscountedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productprodiscountupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																	</td>
																	<td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldedit))?'':'style="display:none;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="hidden" name="cgstvat[]" id="cgstvat1">
																			<input type="hidden" name="sgstvat[]" id="sgstvat1">
																			<input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth taxvalue1" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['taxvalue']?>" >
																		</div>
																		<div <?=(in_array('GST Percentage', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productvatspan<?=$i?>" style="font-size:11px;white-space: nowrap !important;">
																				GST:
																				<input type="number" min="0" step="0.01" name="vat[]" id="vat<?=$i?>" class="form-control form-control-sm proitemselect notforfixed" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(<?=$i?>)" value="<?=$row['vat']?>">
																				<span id="productvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<?=$row['vat']?>%
																				</span>
																				<span id="productvatedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editvat(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productvatupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																		<div <?=(in_array('GST Rupee', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productcgstvatspan<?=$i?>" style=" font-size:11px;">
																				CGST:
																			</span>
																			<span id="productcgstvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['vat']/2)?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																				<?=($row['taxvalue']/2)?>
																			)</span>
																			<span id="productsgstvatspan<?=$i?>" style=" font-size:11px;">
																				SGST:
																			</span>
																			<span id="productsgstvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['vat']/2)?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span><?=($row['taxvalue']/2)?>
																			)</span>
																			<span id="productigstvatspan<?=$i?>" style="display:none; font-size:11px;">
																				IGST:
																			</span>
																			<span id="productigstvatval<?=$i?>" style="display:none; font-size:11px;" class="text-primary">
																				<?=$row['vat']?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																				<?=$row['taxvalue']?>
																			)</span>
																		</div>
																	</td>
																	<td data-label="AMOUNT" <?=(in_array('Amount', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth productnetvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['productnetvalue']?>" >
																		</div>
																	</td>
																	<td data-label="<?=$access['txtsqty']?>" <?=(in_array('Sale Quantity', $fieldedit))?'':'style="display:none;"'?>>
																		<div>
																			<input type="number" min="0" step="0.01" name="salequantity[]" id="salequantity<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth" onChange="productcalc(<?=$i?>)" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;background:none;" value="<?=$row['salequantity']?>">
																		</div>
																		<div <?=(in_array('SALE opparen or UNIT closparen opparen Inclusive GST closparen', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productwithtaxspan<?=$i?>" style=" font-size:11px;">
																				<span style="background-color:#1BBC9B;color:white;padding:3px;">
																					SALE(/UNIT)
																				</span>
																				<br>
																				(Inclusive GST):
																				<span style="font-size:11px !important;padding-right:3px !important;">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																			</span>
																			<input type="text" name="productwithtax[]" id="productwithtax<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['productwithtax']?>" onchange="prowithtax(<?=$i?>)">
																			<span id="productwithtaxval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['productwithtax']?>
																			</span>
																			<span id="productwithtaxedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editwithtax(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productwithtaxupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changewithtax(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div <?=(in_array('SALE opparen or UNIT closparen opparen Exclusive GST closparen', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productwithouttaxspan<?=$i?>" style=" font-size:11px;">
																				(Exclusive GST):
																				<span style="font-size:11px !important;padding-right:3px !important;">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																			</span>
																			<input type="text" name="productwithouttax[]" id="productwithouttax<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['productwithouttax']?>" onchange="prowithouttax(<?=$i?>)">
																			<span id="productwithouttaxval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['productwithouttax']?>
																			</span>
																			<span id="productwithouttaxedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editwithouttax(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productwithouttaxupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changewithouttax(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																	</td>
																	<td <?=((in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'style="white-space:nowrap !important;"':'style="display:none !important;"'?>>
																		<div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldedit))?'display:none !important;':'display:none !important;'?>">
																			<a href="javascript:;" class="p-0" id="dropdownadditionalinfo" data-bs-toggle="dropdown" aria-expanded="false">
																				<svg width="15" height="15" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg>
																			</a>
																			<div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownadditionalinfo">
																				<div style="background-color: #3c3c46;margin-top: -50px !important;">
																					<a class="nav-link" style="color: #fff;width:max-content !important;" onclick="additionalinfo(<?=$i?>)">
																						<span class="nav-link-text ms-2 showorhidewords">
																							<span id="showadd<?=$i?>">
																								Show
																							</span>
																							<span id="hideadd<?=$i?>" style="display: none;">
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
															<?php
																$i++;
																}
															?>
																<input type="hidden" id="totalinedit" value="<?=$i?>">
																<script type="text/javascript">
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
																setTimeout(function() {
																	$("#totalProCount").html($("#totalinedit").val());
																	// for(i=0;i<document.getElementsByClassName("oldaccnames").length;i++){
																	// 	var lineNo = document.getElementsByClassName("oldaccnames")[i].id.split('accountname')[1];
																	// 	selfgetfun(lineNo,1);
																	// 	var selectingval = document.getElementsByClassName("oldaccnames")[i].value;
																	// 	geteditaccount(lineNo,selectingval);
																	// 	getoldbatched(lineNo);
																	// 	getoldrates(lineNo);
																	// }
																	// function getoldrates(lineNo) {
																	// 	var productid= $('#product'+lineNo).val();
																	// 	var customerid = $("#vendor").val();
																	// <?php
																	// 	if ($access['billratedef']=='avail') {
																	// ?>
																	// 	var invratedef = 'and quantity>0 ';
																	// <?php
																	// 	}
																	// 	else{
																	// ?>
																	// 	var invratedef = '';
																	// <?php
																	// 	}
																	// ?>
																	// 	$.get("ratesearchbill.php", {term: productid,custid: customerid,ratedef: invratedef,differ: 'self'} , function(datas){
																	// 		// console.log("normal"+datas);
																	// 		$("#errrate"+lineNo).val(datas);
																	// 		var letters = "<br /><b>Warning</b>:  Undefined variable $ratedatas in";
																	// 		brrch = document.getElementById("errrate"+lineNo);
																	// 		if (brrch.value.includes(letters)||brrch.value=='') {
																	// 			$("#ratelist"+lineNo).html("");
																	// 			var browsers = document.getElementById("ratelist"+lineNo);
																	// 			browsers.style.display = 'none';
																	// 			browsers.style.backgroundColor = 'transparent';
																	// 			browsers.style.border = 'none';
																	// 		}
																	// 		else{
																	// 			const objbatch = JSON.parse(datas);
																	// 			let check='';
																	// 			for (var key in objbatch) {
																	// 				// console.log("key"+key);
																	// 				check+="<div id='option"+lineNo+objbatch[key].billno+"inv' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' style='border:none;overflow:hidden;white-space:nowrap;' title='<?=strtoupper($infomainaccessuser['modulename'])?>'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='invbilltxt'><?=strtoupper($infomainaccessuser['modulename'])?></span></td><td align='right' id='invno"+objbatch[key].billno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].billno+"'>  "+objbatch[key].billno+" </td><td align='right' id='invdt"+objbatch[key].billno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].billdate+"'>"+objbatch[key].billdate+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' colspan='2' id='rate"+objbatch[key].productrate+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td><td align='right' id='dis"+objbatch[key].productdiscount+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productdiscount+"'><?=$access['txtprodisbill']?> : "+objbatch[key].productdiscount+" </td></tr></table></div>";
																	// 			}
																	// 			// console.log(check);
																	// 			$("#ratelist"+lineNo).html(check);
																	// 			var browsers = document.getElementById("ratelist"+lineNo);
																	// 			browsers.style.display = 'none';
																	// 			browsers.style.backgroundColor = 'transparent';
																	// 			browsers.style.border = 'none';
																	// 		}
																	// 	});
																	// }
																	// function getoldbatched(lineNo) {
																	// 	var productid= $('#product'+lineNo).val();
																	// <?php
																	// 	if ($access['billbatchdef']=='avail') {
																	// ?>
																	// 	var billbatchdef = 'and quantity>0 ';
																	// <?php
																	// 	}
																	// 	else{
																	// ?>
																	// 	var billbatchdef = '';
																	// <?php
																	// 	}
																	// ?>
																	// 	$.get("batchsearch.php", {term: productid,batchdef: billbatchdef} , function(datas){
																	// 		// console.log("normal"+datas);
																	// 		$("#errbatch"+lineNo).val(datas);
																	// 		var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
																	// 		brrch = document.getElementById("errbatch"+lineNo);
																	// 		if (brrch.value.includes(letters)) {
																	// 			$("#outfordone"+lineNo).html("");
																	// 			var browsers = document.getElementById("outfordone"+lineNo);
																	// 			browsers.style.display = 'none';
																	// 			browsers.style.backgroundColor = 'transparent';
																	// 			browsers.style.border = 'none';
																	// 		}
																	// 		else{
																	// 			const objbatch = JSON.parse(datas);
																	// 			let check='';
																	// 			var chnew = 0;
																	// 			for (var key in objbatch) {
																	// 				// console.log("key"+key);
																	// 				chnew++;
																	// 				check+="<div id='option"+lineNo+chnew+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].batch+"'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].quantity+"'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].expdate+"'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
																	// 			}
																	// 			// console.log(check);
																	// 			$("#outfordone"+lineNo).html(check);
																	// 			var browsers = document.getElementById("outfordone"+lineNo);
																	// 			browsers.style.display = 'none';
																	// 			browsers.style.backgroundColor = 'transparent';
																	// 			browsers.style.border = 'none';
																	// 		}
																	// 	});
																	// }
																	// function geteditaccount(lineNoid,selectingvals) {
																	// 	$.ajax({
																	// 		type: "GET",
																	// 		url: 'inlistaccsearch.php?idname=accountname&lineNo='+lineNoid+'',
																	// 		success: function (result) {
																	// 			// console.log(result);
																	// 			if (result!='') {
																	// 				$("#accountname"+lineNoid+"").html(result);
																	// 				$('select[id^="accountname'+lineNoid+'"] option[value="'+selectingvals+'"]').attr("selected","selected");
																	// 			}
																	// 			else{
																	// 				$("#accountname"+lineNoid+"").val("");
																	// 				$("#accountname"+lineNoid+"").append('<option selected disabled value="">Select</option>');
																	// 			}
																	// 		},
																	// 		error: function (error) {
																	// 			// console.log(error);
																	// 		}
																	// 	});
																	// }
																},1500);
																</script>
															</tbody>
														</table>
														<style type="text/css">
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
								</div>
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
														<input required type="text" name="totalitems" id="totalitems" class="form-control form-control-sm "  readonly  value="<?=$rows[0]['totalitems']?>" >
													</div>
												</div>
												<div class="row mt-2">
													<div class="col-lg-6 col-md-6 col-sm-6 col-6">
														<label class="custom-label" for="totalitems" style="margin-top: 0px !important;">
															Total Qty
														</label>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-6">
														<input required type="text" name="totalquantity" id="totalquantity" class="form-control form-control-sm " readonly  value="<?=$rows[0]['totalquantity']?>" >
													</div> 
												</div>
											</div>
											<div class="col-lg-8">
												<div class="table-responsive mt-1" id="gsttablediv" <?=(in_array('Tax Informations', $fieldedit))?'':'style="display:none;"'?>>
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
														<?php
															$newtaxes=array();
															$newcgst=array();
															$newsgst=array();
															$newigst=array();
															$newgst=array();
															$newgstpercent=array();
															$newcsgstpercent=array();
															$sqlitaxes=$con->prepare("SELECT * FROM pairbills WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? ORDER BY id ASC");
															$sqlitaxes->bind_param("ssss", $_SESSION["franchisesession"], $companymainid, $billno, $billdate);
															$sqlitaxes->execute();
															$sqlitax = $sqlitaxes->get_result();
															while($infotaxes=$sqlitax->fetch_array()){
																$anstax = $infotaxes['tax'];
																$anscgst = $infotaxes['cgst'];
																$anssgst = $infotaxes['sgst'];
																$ansigst = $infotaxes['igst'];
																$ansgst = $infotaxes['gst'];
																$ansgstpercent = $infotaxes['gstpercent'];
																$anscsgstpercent = $infotaxes['csgstpercent'];
																$newtaxes = explode(',',$anstax);
																$newcgst = explode(',',$anscgst);
																$newsgst = explode(',',$anssgst);
																$newigst = explode(',',$ansigst);
																$newgst = explode(',',$ansgst);
																$newgstpercent = explode(',',$ansgstpercent);
																$newcsgstpercent = explode(',',$anscsgstpercent);
															}
															$sqlitaxes->close();
															$sqlitax->close();
															for ($i=1; $i <count($newtaxes) ; $i++) {
														?>
															<tr>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" data-label="TAXABLE VALUE">
																	<input type="hidden" value="<?=$newgstpercent[$i]?>" id="gstpercent<?=$newgstpercent[$i]?>" name="gstpercent[]">
																	<input type="hidden" value="<?=$newcsgstpercent[$i]?>" id="csgstpercent<?=$newgstpercent[$i]?>" name="csgstpercent[]">
																	<input value="<?=$newtaxes[$i]?>" type="text" name="tax[]" id="tax<?=$newgstpercent[$i]?>" class="form-control form-control-sm bordernoneinput taxabledesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;">
																</td>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="CGST %" class="cgstinp" id="cgstinner<?=$newgstpercent[$i]?>">
																	<?=$newcsgstpercent[$i]?>%
																</td>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="CGST" class="cgstinp">
																	<div>
																		<?php echo $resmaincurrencyans; ?>
																		<input value="<?=number_format((float)$newcgst[$i],2,'.','')?>" type="text" name="cgst[]" id="cgst<?=$newgstpercent[$i]?>" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;">
																	</div>
																</td>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="SGST %" class="sgstinp" id="sgstinner<?=$newgstpercent[$i]?>">
																	<?=$newcsgstpercent[$i]?>%
																</td>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="SGST" class="sgstinp">
																	<div>
																		<?php echo $resmaincurrencyans; ?>
																		<input value="<?=number_format((float)$newcgst[$i],2,'.','')?>" type="text" name="sgst[]" id="sgst<?=$newgstpercent[$i]?>" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;">
																	</div>
																</td>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="IGST %" class="igstinp" colspan="2" id="igstinner<?=$newgstpercent[$i]?>">
																	<?=number_format((int)$newgstpercent[$i])?>%
																</td>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;" data-label="IGST" class="igstinp" colspan="2">
																	<div>
																		<?php echo $resmaincurrencyans; ?>
																		<input value="<?=$newigst[$i]?>" type="text" name="igst[]" id="igst<?=$newgstpercent[$i]?>" class="form-control form-control-sm amountdesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;">
																	</div>
																</td>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;border-left: 1px dashed #999;border-right: 1px dashed #999;" data-label="GST %" class="gstforauto" id="gstinner<?=$newgstpercent[$i]?>">
																	<?=number_format((int)$newgstpercent[$i])?>%
																</td>
																<td style="text-align: right !important;justify-content: right;justify-items: right;margin-right: 0px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;white-space: nowrap;border-left: 1px dashed #999;" data-label="GST">
																	<input value="<?=$newgst[$i]?>" type="text" name="gst[]" id="gst<?=$newgstpercent[$i]?>"   class="form-control form-control-sm totaldesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;">
																</td>
															</tr>
														<?php
															}
														?>
															<tr>
																<td colspan="6" style="text-align:right;width: 92.3px !important;padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;" id="tgstamount">
																	Total GST Amount&nbsp;
																</td>
																<td id="tgstinp" style="padding-right: 0px !important;background-color:#E9ECEF !important;border: 1px solid #999;font-weight:bold;">
																	<div>
																		<?php echo $resmaincurrencyans; ?>
																		<input value="<?=$rows[0]['totalvatamount']?>" type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm totaldesign"  readonly style="background-color:#E9ECEF !important;text-align: right !important;font-weight:bold;" >
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
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
													<span class="pull-right">:</span>
												</div>
												<div class="col-6">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																<?php echo $resmaincurrencyans; ?>
															</div>
														</div>
														<input required type="text" name="totalamount" id="totalamount" class="form-control form-control-sm" style="background:none; text-align:right;border: 1px solid #e1dbdb;"  readonly  value="<?=number_format((float)$rows[0]['totalamount'],2,'.','')?>" >
													</div>
												</div>
											</div>
											<div class="row mb-1" >
												<div class="col-6" >
													<div class="input-group input-group-sm">
														<div class="input-group-prepend">
															<div class="input-group input-group-sm">
																<div class="input-group-prepend" style="padding-right: 3px !important;">
																	Discount
																</div>
																<input type="text" name="discount" class="form-control form-control-sm"  id="discount" value="<?=number_format((float)$rows[0]['discount'],2,'.','')?>" onChange="discount1()" style="width:24px;border: 1px solid #e0e3e6 !important;border-radius: 0px !important;padding: 0px !important;">
															</div>
														</div>
														<select name="discounttype" id="discounttype" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;" onChange="discount1()">
															<option value="0" <?=($rows[0]['discounttype']=='0')?'selected':''?>>
																%
															</option>
															<option value="1" <?=($rows[0]['discounttype']=='1')?'selected':''?>>
																<?php echo $resmaincurrencyans; ?>
															</option>
														</select>
													</div>
													<span class="pull-right" style="margin-top:-25px !important;">:</span>
												</div>
												<div class="col-6" >
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																<?php echo $resmaincurrencyans; ?>
															</div>
														</div>
														<input required type="text" name="discountamount" id="discountamount" class="form-control form-control-sm " style="background:none; text-align:right;border:1px solid #e1dbdb;" value="<?=number_format((float)$rows[0]['discountamount'],2,'.','')?>" onChange="productcalc1()" >
													</div>
												</div>
											</div>
											<div class="row mb-1" <?=(in_array('Total Tax', $fieldedit))?'':'style="display:none;"'?>>
												<div class="col-6" >
													Total Tax
													<span class="pull-right">:</span>
												</div>
												<div class="col-6">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																<?php echo $resmaincurrencyans; ?>
															</div>
														</div>
														<input required type="text" name="totalvatamount" id="totalvatamount" class="form-control form-control-sm " style="background:none; text-align:right;border: 1px solid #e1dbdb;"  readonly  value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" >
													</div>
												</div>
											</div>
											<div class="row mb-1" style="display:none" >
												<div class="col-6" >
													Freight
													<span class="pull-right">:</span>
													<?php echo $resmaincurrencyans; ?>
												</div>
												<div class="col-6" >
													<input required type="text" name="freightamount" id="freightamount" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right" value="<?=number_format((float)$rows[0]['freightamount'],2,'.','')?>" onChange="productcalc1()" >
												</div>
											</div>
											<div class="row mb-1" >
												<div class="col-6" >
													Round off
													<span class="pull-right">:</span>
												</div>
												<div class="col-6">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																<?php echo $resmaincurrencyans; ?>
															</div>
														</div>
														<input required type="text" name="roundoff" id="roundoff" class="form-control form-control-sm" style="background:none; text-align:right;border:1px solid #e1dbdb;" value="<?=number_format((float)$rows[0]['roundoff'],2,'.','')?>" onChange="productcalcround()" >
													</div>
												</div>
											</div>
											<div class="row mb-1" style="font-size:14.6px;" >
												<div class="col-6" >
													<strong>
														Grand Total
														<span class="pull-right">:</span>
													</strong>
												</div>
												<div class="col-6">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;">
																<?php echo $resmaincurrencyans; ?>
															</div>
														</div>
														<input required type="text" name="grandtotal" id="grandtotal" class="form-control form-control-sm " style="background:none; text-align:right; border: 1px solid #e1dbdb;font-weight: 700 !important;font-size: 14.6px !important;" value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" onChange="productcalc1()" readonly >
													</div>
												</div>
											</div>
											<div class="row mb-1">
												<div class="col-12">
													<span id="grandwords">
														adfsadf
													</span>
												</div>
											</div>
											<div class="row mb-1" style="font-size:18px; display:none" >
												<div class="col-6" >
													<label class="custom-label" for="mode">
														Mode
													</label>
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
								<div class="row mt-2 mb-2">
									<div class="col-lg-8">
										<div class="row" <?=(in_array('Description', $fieldedit))?'':'style="display:none;"'?>>
											<div class="col-lg-2">
												<label class="custom-label" for="description">
													Description
												</label>
											</div>
											<div class="col-lg-10">
												<textarea class="form-control form-control-sm" name="description" id="description" style="height: 60px !important;"><?=$rows[0]['description']?></textarea>
											</div>
										</div>
										<div class="row mt-2" <?=(in_array('Notes', $fieldedit))?'':'style="display:none;"'?>>
											<div class="col-lg-2">
												<label class="custom-label" for="notes">
													Notes
												</label>
											</div>
											<div class="col-lg-10">
												<textarea class="form-control form-control-sm" name="notes" id="notes" style="height: 60px !important;"><?=$rows[0]['notes']?></textarea>
											</div>
										</div>
										<div class="row" <?=(in_array('Terms and Conditions', $fieldedit))?'':'style="display:none;"'?>>
											<div class="col-lg-2">
												<label class="custom-label" for="terms">
													Terms and Conditions
												</label>
											</div>
											<div class="col-lg-10">
												<textarea class="form-control form-control-sm" name="terms" id="terms" style="height: 80px !important;"><?=$rows[0]['terms']?></textarea>
											</div>
										</div>
									</div>
									<div class="col-lg-4" <?=(in_array('Attachment', $fieldedit))?'':'style="display:none;"'?>>
										<label class="custom-label mb-2" for="fileattach">
											Attach File(s) to <?= $infomainaccessuser['modulename'] ?>
										</label>
										<div class="form-group">
											<input type="hidden" name="fileattach1" id="fileattach1" value="<?=$rows[0]['fileattach']?>">
											<input type="file" name="fileattach[]" id="fileattach" class="form-control form-control-sm" multiple onchange="previewatt()">
										</div>
										<span style="font-size:11px;">
											You can upload a maximum of 5 files, 5MB each
										</span>
										<br>
									<?php
										if ($rows[0]['fileattach']!='') {
											$imgs=explode('|',$rows[0]['fileattach']);
											$cot = 1;
											foreach($imgs as $img){
									?>
										<img alt="Attachment" src="<?=str_replace('../ups','ups',$img)?>" id="attach<?=$cot?>" style="height: 30px !important;width: 30px !important;<?=($rows[0]['fileattach']!='')?'':'opacity: 0;'?>">
										<script type="text/javascript">
										function previewatt() {
											var preview = document.getElementById('attach<?=$cot?>');
											var file    = document.getElementById('fileattach').files[0];
											var reader  = new FileReader();
											reader.addEventListener("load", function () {
												preview.src = reader.result;
											}, false);
											if (file) {
												reader.readAsDataURL(file);
											}
										}
										</script>
									<?php
											$cot++;
											}
										}
									?>
									</div>
								</div>
							</div>
							<div style="display:none;">
								<input type="hidden" id="ansforsepgstval" name="ansforsepgstval" value="<?=$rows[0]['icsgsthis']?>">
							</div>
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
															<button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="trigggerbutton" name="triggerbutton" value="Submit"  onClick="triggerpayment('','','','1','1')" disabled>
																<span class="label">NEXT</span>
																<span class="spinner"></span>
															</button>
															<a class="btn btn-primary btn-sm btn-custom-grey" href="bills.php" style="margin-top:-3px !important;">
																Cancel
															</a>
														</div>
														<div class="col-5 col-sm-6">
															<div class="row mb-1" style="font-size:14.6px;" >
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
																				<?php echo $resmaincurrencyans; ?>
																			</div>
																		</div>
																		<input required type="text" name="grandtotalfixed" id="grandtotalfixed" class="form-control form-control-sm" style="background:none; text-align:right; font-size:14.6px;border: 1px solid #e1dbdb;font-weight: 700 !important;" value="0" readonly >
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
														<input type="text" name="validbillno" id="validbillno" class="form-control form-control-sm finalsubmitrequired" readonly required>
													</td>
												</tr>
												<tr>
													<th style="text-align:left !important">
														<label class="custom-label">
															<?= $infomainaccessuser['modulename'] ?> Date
														</label>
													</th>
													<td>
														<input type="date" name="validbilldate" id="validbilldate" class="form-control form-control-sm finalsubmitrequired" readonly required>
													</td>
												</tr>
												<tr>
													<th style="text-align:left !important">
														<label class="custom-label">
															Total Amount
														</label>
													</th>
													<td>
														<input type="number" name="validbillamount" id="validbillamount" class="form-control form-control-sm finalsubmitrequired" readonly required>
													</td>
												</tr>
												<tr>
													<th style="text-align:left !important;white-space:nowrap;background-color: #e9ecef;">
														<label class="custom-label">
															Payment Method
														</label>
													</th>
													<td style="background-color: #e9ecef;">
														<div class="col-lg-12">
															<select class="select2-field form-control  form-control-sm finalsubmitrequired" name="billterm" maxlength="100" id="billterm" required onchange="ihaveblock()">
															<?php
																$sqlis=$con->prepare("SELECT term FROM pairterms WHERE (createdid=? or createdid='0') ORDER BY term ASC");
																$sqlis->bind_param("i", $companymainid);
																$sqlis->execute();
																$sqli = $sqlis->get_result();
																while($info=$sqli->fetch_array()){
																	if (($info['term']!='BANK ACCOUNT')&&($info['term']!='UPI')) {
															?>
																<option value="<?= $info['term'] ?>" <?=($info['term']==$rows[0]['billterm'])?'selected':''?>>
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
												</tr>
												<tr id="validpaidblock">
													<th style="text-align:left !important;background-color: #e9ecef;">
														<label class="custom-label text-danger">
															Cash Received *
														</label>
													</th>
													<td style="background-color: #e9ecef;">
														<input type="number" name="validpaidamount" id="validpaidamount" class="form-control form-control-sm finalsubmitrequired" placeholder="0.00" required oninput="paidamountcalc()" value="<?= $rows[0]['validpaidamount'] ?>">
														<script>
														function paidamountcalc(){
															var validbillamount=$("#validbillamount").val();
															var validpaidamount=$("#validpaidamount").val();
															// $("#validpaidamount").val(validbillamount);
															if((validbillamount!='')&&(validpaidamount!='')){
																var balance=parseFloat(validbillamount)-parseFloat(validpaidamount);
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
																<select class="select2-field form-control  form-control-sm" name="duedates" maxlength="100" id="duedates" onchange="funduedates()">
																<?php
																	$dueinc = 0;
																	$sqlis=$con->prepare("SELECT * FROM pairduedates WHERE (createdid=? or createdid='0') ORDER BY duedate ASC");
																	$sqlis->bind_param("i", $companymainid);
																	$sqlis->execute();
																	$sqli = $sqlis->get_result();
																	while($info=$sqli->fetch_array()){
																?>
																	<option value="<?= $info['noofdays'] ?>,<?=$info['duedate']?>" <?=(($info['noofdays'].','.$info['duedate'])==$rows[0]['duedates'])?'selected':''?>>
																		<?= $info['duedate'] ?>
																	</option>
																	<?php
																		if(($info['noofdays'].','.$info['duedate'])==$rows[0]['duedates']){
																			$dueinc=1;
																		}
																		if ($rows[0]['duedates']=='') {
																	?>
																	<option disabled selected value="">
																		Due Terms
																	</option>
																<?php
																		}
																	}
																	$sqli->close();
																	$sqlis->close();
																?>
																</select>
															</div>
															<div class="col-lg-7 duedatepicker">
																<input type="date" class="form-control  form-control-sm" id="duedate" name="duedate" value="<?= $rows[0]['duedate'] ?>">
															</div>
														</div>
														<script>
														function addDays(date, days) {
															var result = new Date(date);
															days=parseFloat(days);
															result.setDate(result.getDate() + days);
															return result;
														}
														function funduedates(){
															var duedates=$("#duedates").val().split(',')[0];
															var billdate=$("#billdate").val();
															var today="";
															if(duedates!=''){
																// console.log(billdate);
																// console.log(duedates);
																today=addDays(billdate, duedates);
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
														<input type="number" name="validbalance" id="validbalance" class="form-control form-control-sm finalsubmitrequired" value="<?= $rows[0]['validbalance'] ?>" required readonly>
													</td>
												</tr>
											</table>
											<div class="custom-control custom-checkbox mr-sm-2 mx-2 showhideload" id="ihavediv">
												<input type="checkbox" class="custom-control-input" name="ihavereceived" id="ihavereceived" value="1" onclick="ihavereceive()">
												<label class="custom-control-label custom-label" for="ihavereceived">
													I have Paid this Payment
												</label>
											</div>
											<script type="text/javascript">
											var ihaveterm = document.getElementById("billterm").value;
											var ihavereceived = document.getElementById("ihavereceived");
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
											if (ihaveterm=='CASH'&&ihavereceived.checked==true) {
												document.getElementById("savecanceldiv").style.display='block';
											}
											else if(ihaveterm=='CASH'&&ihavereceived.checked==false){
												document.getElementById("savecanceldiv").style.display='none';
											}
											else{
												document.getElementById("savecanceldiv").style.display='block';
											}
											function ihavereceive() {
												var ihaveterm = document.getElementById("billterm").value;
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
												var ihaveterm = document.getElementById("billterm").value;
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
													for (var i = options.length - 1; i >= 0; i--) {
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
												<button type="submit" id="Submit" name="submit" class="btn btn-primary btn-sm btn-custom " >
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
			else{
		?>
		<div class="alert alert-danger text-white">
			No Data Found
		</div>
	<?php
			}
		}
		else{
	?>
		<div class="alert alert-danger text-white">
			No Information
		</div>
	<?php
		}
	?> 
	<?php
		include('footer.php');
		// FOR FOOTER FILES
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
	let noaccess = document.getElementById('custtaxprefnontaxable');
	let access = document.getElementById('custtaxpreftaxable');
	if (noaccess.checked == true) {
		document.getElementById('custgstrtypesh').style.display='none';
	}
	if (access.checked == true) {
		document.getElementById('custgstrtypesh').style.display='block';
	}
});
// FOR VENDOR ADD MODAL SAMES AS BILLING CHECKBOX
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
	if($access['billnewvendordef']=='1'){
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
$(".product1").on("select2:open", function() {
	$("#configureunits").attr("data-bs-target","#AddNewProduct");
	$("#configureunits").show();
});
$(".product1").on("select2:open", function() {
<?php
	if($access['billnewproductdef']=='1'){
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
					});
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
					$("#vat"+lineNo).val(<?=(in_array('Tax Value', $fieldedit))?'obj[0].tax':'0'?>);
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
					$("#productvatval"+lineNo).html(<?=(in_array('Tax Value', $fieldedit))?'obj[0].tax':'0'?>+'%');
					$("#productvatval"+lineNo).css('display', 'inline');
					$("#vat"+lineNo).val(<?=(in_array('Tax Value', $fieldedit))?'obj[0].tax':'0'?>);
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
					// 	for(i=0;i<btndel.length;i++){
					// 		if (btndels[i].value!=0) {
					// 			var ids = btndel[i].id.split('productname');
					// 			var id = ids[1];
					// 			productcalc(id);
					batchget(id);
					document.getElementById("outfordone"+id).style.display = 'none';
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
									batchget(id);
									document.getElementById("outfordone"+id).style.display = 'none';
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
var fetchedit = false;
function addnewrow(lineNo){
	if(fetchedit){
		var y=0;
		var productvalues = document.getElementsByName('productvalue[]');
		for (var i = 0; i < productvalues.length; i++){
			if(productvalues[i].value==''){
				y++;
			}
		}
		if(y==0){
			markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td class="tdmove" <?=((in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'':'style="display:none !important;"'?>><svg version="1.1" id="Layer_'+lineNo+'" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="BARCODE" style="<?=(in_array('Barcode', $fieldedit))?'':'display:none !important;'?>"><div><input type="text" name="barcode[]" id="barcode'+lineNo+'" onchange="checkthecode('+lineNo+')" class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;"></div><div><span id="viewbarcode'+lineNo+'" style="display:none; font-size:11px;color: royalblue;" data-bs-toggle="modal" data-bs-target="#barcodeModal" onclick="generateBarcode('+lineNo+')">View and Download Barcode</span><input type="hidden" id="barcodeformat'+lineNo+'"><input type="hidden" id="barcodetitle'+lineNo+'"><input type="hidden" id="barcodesubtitle'+lineNo+'"><input type="hidden" id="barcodeval'+lineNo+'"><input type="hidden" id="underbarcodelabel'+lineNo+'"><input type="hidden" id="footernote'+lineNo+'"></div></td><td data-label="ITEM DETAILS" style="padding-top: 1px !important;<?=(in_array('Item Details', $fieldedit))?'':'display:none !important;'?>"><input type="hidden" name="productid[]" id="productid'+lineNo+'"><input type="hidden" name="productname[]" id="productname'+lineNo+'"><div class="col-sm-9" onclick="andus()" style="width:278px;display: inline-block;" id="selecttheproduct"><select class="form-control  form-control-sm product proitemselect product1 proselect2" name="product[]" id="product'+lineNo+'"  onChange="productchange('+lineNo+')"><option value="" selected disabled>Select</option></select></div><span class="badge" style="display:none; width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan'+lineNo+'"></span><br><input type="hidden" name="itemmodule[]" id="itemmodule'+lineNo+'"><div <?=(in_array('Category', $fieldedit))?'':'style="display:none !important;"'?>><span id="productmanufacturerspan'+lineNo+'" style="display:none; font-size:11px;"><?=$access['txtnamecategory']?>:<input type="text" name="manufacturer[]" id="manufacturer'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;" readonly onChange="productcalc('+lineNo+')">  <span id="productmanufacturerval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><span id="productmanufactureredit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmanufacturerupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Hsn or Sac', $fieldedit))?'':'style="display:none !important;"'?>><span id="producthsncodespan'+lineNo+'" style="display:none; font-size:11px;">HSN Code:</span><input type="text" name="producthsn[]" maxlength="100" id="producthsn'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="producthsncodeval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><span id="producthsncodeedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode('+lineNo+')"><i class="fa fa-edit"></i></span><span id="producthsncodeupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Rack', $fieldedit))?'':'style="display:none !important;"'?>><span id="rackspan'+lineNo+'" style="display:none; font-size:11px;">Rack:</span><span id="rackval'+lineNo+'" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary"></span><input type="hidden" name="rack[]" id="rack'+lineNo+'"></div><span <?=(in_array('Product Description', $fieldedit))?'':'style="display:none !important;"'?>><span id="productdescriptionspan'+lineNo+'" style="display:none; font-size:11px;">Description:</span><textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription'+lineNo+'" style="height:50px; display:none;width: 100px !important;"></textarea></span><div class="col-sm-9 totalaccounts account'+lineNo+'" onclick="andus()" style="width:278px;display: none;margin-top: 5.5px !important;" id="selecttheproduct"><select style=" width: 100%;" class="select4 form-control form-control-sm" name="accountname[]" id="accountname'+lineNo+'"><option selected disabled value="">Select</option></select></div></td><td style="display:none"><input type="text" name="productnotes[]" id="productnotes'+lineNo+'" class="form-control form-control-sm proitemselect bordernoneinput"></td><td data-label="BATCH" <?=($access['batchexpiryval']==1)?'':'style="display:none;"'?>><div><input type="text" name="batch[]" maxlength="100" id="batch'+lineNo+'" onClick="batchget('+lineNo+');" onFocus="batchget('+lineNo+');"  class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;display:inline;" list="" autocomplete="off"><div id="outfordone'+lineNo+'" class="dvi" style="display:none;width: 250px;"></div><input type="text" id="errbatch'+lineNo+'" style="display:none;"></div><span id="productexpdatespan'+lineNo+'" style="display:none; font-size:11px;">EXPIRY:</span><input type="date" name="expdate[]" id="expdate'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productexpdateval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productexpdateedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productexpdateupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate('+lineNo+')"><i class="fa fa-save"></i></span></td><td data-label="RATE" <?=(in_array('Rate', $fieldedit))?'':'style="display:none !important;"'?>><div><span style="font-size:15px !important;"><?php echo $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productrate[]"    id="productrate'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth productselectadd" onChange="productcalc('+lineNo+')" onClick="rateget('+lineNo+');" onFocus="rateget('+lineNo+');" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;"></div><div <?=(in_array('Mrp', $fieldedit))?'':'style="visibility:hidden !important;"'?>><span id="productmrpspan'+lineNo+'" style="display:none; font-size:11px;">MRP:<input type="number" name="mrp[]" id="mrp'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 63px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" onChange="productcalc('+lineNo+')"> <span id="productmrpval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productmrpedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmrpupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp('+lineNo+')"><i class="fa fa-save"></i></span></span></div><div class="dvi invbillgets" id="invbillgets'+lineNo+'" style="margin-top:-22px;display: none;width: 250px;border-radius: 0px !important;"><table width="100%"><tr style="border-bottom: none;"><td align="center" style="border-right: 1px solid #cccccc;width: 50% !important;display: inline-block !important;text-align: center;"><span onclick="selfgetfun('+lineNo+',0)" id="invonoff'+lineNo+'">SELF</span></td><td align="center" style="width: 50% !important;display: inline-block !important;text-align: center;"><span onclick="othersgetfun('+lineNo+')" id="billonoff'+lineNo+'">OTHERS</span></td><input type="text" style="display: none;" id="selforothers'+lineNo+'" value="self"></tr></table></div><div id="ratelist'+lineNo+'" class="dvi ratedvi" style="display:none;width: 250px;"></div><input type="text" id="errrate'+lineNo+'" style="display:none;"></td><td data-label="<?=($access['txtqtybill'])?>" <?=(in_array('Quantity', $fieldedit))?'':'style="display:none !important;"'?>><div><input type="number" min="0" step="0.01" name="quantity[]"  id="quantity'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth" oninput="qtytosqty('+lineNo+')" onClick="qtych('+lineNo+')" onFocus="qtych('+lineNo+')" onChange="productcalc('+lineNo+')" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;display:inline;"></div><div <?=(in_array('Unit', $fieldedit))?'':'style="display:none !important;"'?>><span id="productunitspan'+lineNo+'" style="display:none; font-size:11px;">UNIT:</span><input type="text" name="productunit[]" id="productunit'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')" readonly><span id="productunitval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productunitedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editunit('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productunitupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('Pack', $fieldedit))?'':'style="display:none !important;"'?>><span id="productnoofpacksspan'+lineNo+'" style="display:none; font-size:11px;">PACK:</span><input type="text" name="noofpacks[]" maxlength="100" id="noofpacks'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productnoofpacksval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productnoofpacksedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productnoofpacksupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks('+lineNo+')"><i class="fa fa-save"></i></span></div></td><td data-label="<?=($access['txttaxablebill'])?>" <?=(in_array('Taxable Value', $fieldedit))?'':'style="display:none;"'?>> <div id="ruppeitemtablemobdfs"><span style="font-size:15px !important;"><?php echo $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div><div <?=(in_array('Discount', $fieldedit))?'':'style="display:none !important;"'?>><span id="productprodiscountspan'+lineNo+'" style="display:none; font-size:11px;"><?=$access['txtprodisbill']?>:<div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect'+lineNo+'"> <div class="input-group-prepend"> <input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 35px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> </div><select name="prodiscounttype[]" id="prodiscounttype'+lineNo+'" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 0px !important;" onChange="productcalc('+lineNo+')"><option value="0">%</option><option value="1"><?php echo $resmaincurrencyans; ?></option></select> </div> <input type="hidden" name="prodisvalueforledger[]" id="prodisvalueforledger'+lineNo+'"><span id="productprodiscountval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productprodiscountedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productprodiscountupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount('+lineNo+')"><i class="fa fa-save"></i></span></span></div></td><td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldedit))?'':'style="display:none;"'?>><div id="ruppeitemtablemobasdf"><span style="font-size:15px !important;"><?php echo $resmaincurrencyans; ?></span><input type="hidden" name="cgstvat[]" id="cgstvat'+lineNo+'"><input type="hidden" name="sgstvat[]" id="sgstvat'+lineNo+'"><input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div><div <?=(in_array('GST Percentage', $fieldedit))?'':'style="display:none !important;"'?>><span id="productvatspan'+lineNo+'" style="display:none; font-size:11px;">GST:<input type="number" min="0" step="0.01" name="vat[]" id="vat'+lineNo+'" class="form-control form-control-sm proitemselect notforfixed" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc('+lineNo+')"> <span id="productvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productvatedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editvat('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productvatupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat('+lineNo+')"><i class="fa fa-save"></i></span></span></div><div <?=(in_array('GST Rupee', $fieldedit))?'':'style="display:none !important;"'?>><span id="productcgstvatspan'+lineNo+'" style="display:none; font-size:11px;">CGST:</span><span id="productcgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productsgstvatspan'+lineNo+'" style="display:none; font-size:11px;">SGST:</span><span id="productsgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productigstvatspan'+lineNo+'" style="display:none; font-size:11px;">IGST:</span><span id="productigstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span></div></td><td data-label="AMOUNT" <?=(in_array('Amount', $fieldedit))?'':'style="display:none !important;"'?>><div id="ruppeitemtablemobasdf"><span style="font-size:15px !important;"><?php echo $resmaincurrencyans; ?></span><input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue'+lineNo+'" class="form-control form-control-sm proitemselect productselectadd"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;float:right;width:146px;" readonly ></div></td><td data-label="<?=$access['txtsqty']?>" <?=(in_array('Sale Quantity', $fieldedit))?'':'style="display:none;"'?>><div><input type="number" min="0" step="0.01" name="salequantity[]" id="salequantity'+lineNo+'" class="form-control form-control-sm proitemselect productselectwidth" onChange="productcalc('+lineNo+')" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;display:inline;background:none;"></div><div <?=(in_array('SALE opparen or UNIT closparen opparen Inclusive GST closparen', $fieldedit))?'':'style="display:none !important;"'?>><span id="productwithtaxspan'+lineNo+'" style="display:none; font-size:11px;"><span style="background-color:#1BBC9B;color:white;padding:3px;">SALE(/UNIT)</span><br>(Inclusive GST):<span style="font-size:11px !important;padding-right:3px !important;"><?php echo $resmaincurrencyans; ?></span></span><input type="text" name="productwithtax[]" id="productwithtax'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onchange="prowithtax('+lineNo+')"> <span id="productwithtaxval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productwithtaxedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editwithtax('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productwithtaxupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changewithtax('+lineNo+')"><i class="fa fa-save"></i></span></div><div <?=(in_array('SALE opparen or UNIT closparen opparen Exclusive GST closparen', $fieldedit))?'':'style="display:none !important;"'?>><span id="productwithouttaxspan'+lineNo+'" style="display:none; font-size:11px;">(Exclusive GST):<span style="font-size:11px !important;padding-right:3px !important;"><?php echo $resmaincurrencyans; ?></span></span><input type="text" name="productwithouttax[]" id="productwithouttax'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" onchange="prowithouttax('+lineNo+')"><span id="productwithouttaxval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productwithouttaxedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editwithouttax('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productwithouttaxupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changewithouttax('+lineNo+')"><i class="fa fa-save"></i></span></div></td><td <?=((in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'style="white-space:nowrap !important;"':'style="display:none !important;"'?>><div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldedit))?'display:none !important;':'display:none !important;'?>"><a href="javascript:;" class="p-0" id="dropdownadditionalinfo" data-bs-toggle="dropdown" aria-expanded="false"><svg width="15" height="15" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg></a><div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownadditionalinfo"><div style="background-color: #3c3c46;margin-top: -50px !important;"><a class="nav-link" style="color: #fff;width:max-content !important;" onclick="additionalinfo('+lineNo+')"><span class="nav-link-text ms-2 showorhidewords"> <span id="showadd'+lineNo+'">Show</span><span id="hideadd'+lineNo+'" style="display: none;">Hide</span> Additional Information</span></a></div></div></div><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;margin-left:7px;"></a></td></tr>';
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
				if($access['billnewproductdef']=='1'){
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
								batchget(id);
								document.getElementById("outfordone"+id).style.display = 'none';
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
$("#validpaidamount").click(function(){
	setTimeout(function() {
		$("#validpaidamount").select();
	},100);
});
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
// FOR SALE QUANTITY WITHOUT TAX EDITS
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
// FOR SALE QUANTITY WITH TAX EDITS
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
								setTimeout(function() {
									productcalc(id);
									batchget(id);
									document.getElementById("outfordone"+id).style.display = 'none';
								},500);
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
				$("#vat"+lineNo).val(<?=(in_array('Tax Value', $fieldedit))?'obj[0].tax':'0'?>);
				$("#productrate"+lineNo).val(obj[0].salecost);
				$("#prodiscount"+lineNo).val(obj[0].salediscount);
				$("#prodisvalueforledger"+lineNo).val(obj[0].salediscount);
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
				$("#productvatval"+lineNo).html(<?=(in_array('Tax Value', $fieldedit))?'obj[0].tax':'0'?>+'%');
				$("#productvatval"+lineNo).css('display', 'inline');
				$("#vat"+lineNo).val(<?=(in_array('Tax Value', $fieldedit))?'obj[0].tax':'0'?>);
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
								batchget(id);
								document.getElementById("outfordone"+id).style.display = 'none';
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
	else{
		document.getElementById('totalitems').value=0;
		document.getElementById('totalquantity').value=0;
		document.getElementById('totalamount').value=0;
		document.getElementById('totalvatamount').value=0;
		document.getElementById('roundoff').value=0;
		document.getElementById('grandtotal').value=0;
		document.getElementById('grandtotalfixed').value=0;
	}
},1500);
// FOR GET THE PRODUCT INFORMATIONS
function productcalc(id){
	if(fetchedit){
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
				<span type="button" onclick="funesbillterm()" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" id="closeicon">&times;</span>
				</span>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="form-group row">
								<div class="col-sm-6">
									<label for="missingbillterm" class="custom-label">
										<span class="text-danger">
											<?= $infomainaccessuser['modulename'] ?> Term *
										</span>
									</label>
								</div>
								<div class="col-sm-6">
									<input type="text" name="billterm" class="form-control form-control-sm mb-4" id="missingbillterm" placeholder="Name" required>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer " style="margin-top: 10px !important;">
				<div class="col">
					<button   onclick="funaddbillterm()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitbillterm" value="Submit">
						<span class="label">Save</span>
						<span class="spinner"></span>
					</button>
					<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funesbillterm()">
						Cancel
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function funaddbillterm() {
	var missingbillterm = document.getElementById('missingbillterm');
	if (missingbillterm.value == '') {
		alert('Please Enter New <?= $infomainaccessuser['modulename'] ?> Term Name');
		missingbillterm.focus();
		return false;
	}
	else {
		$.ajax({
			type: "POST",
			url: "termadds.php",
			data: {
				term: $("#missingbillterm").val(),
				submit: "Submit"
			},
			success:function(result){
				const resarray = result.split("|");
				alert(resarray[0]);
				if(resarray[1]=='0'){}
				else{
					$('#billterm').append('<option value="' + missingbillterm.value + '">' + missingbillterm.value + '</option>');
					$('#billterm').val(missingbillterm.value).change();
					$("#billterm").select2();
					$('#AddNewBillTerm').modal('hide');
					return false;
				}
			}
		});
	}
}
function funesbillterm() {
	$("#billterm").select2();
	$('#AddNewBillTerm').modal('hide');
	return false;
}
$("#saleperson").on("select2:open", function() {
	$("#configureunits").attr("data-bs-target","#AddNewSaleperson");
});
$("#saleperson").on("select2:open", function() {
	document.getElementById("configureunits").innerHTML = "New Sale Person";
});
$("#billterm").on("select2:open", function() {
	$("#configureunits").attr("data-bs-target","#AddNewBillTerm");
});
$("#billterm").on("select2:open", function() {
	document.getElementById("configureunits").innerHTML = "New <?= $infomainaccessuser['modulename'] ?> Term";
});
</script>
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
function triggerpayment(billno,billdate,billamount,cancelstatus,whatdonext){
	let allAreFilled = true;
	document.getElementById("billform").querySelectorAll("[required]").forEach(function(i) {
		if (!allAreFilled) return;
		if (i.type === "radio") {
			let radioValueCheck = false;
			document.getElementById("billform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
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
		document.getElementById("billform").querySelectorAll("[required]").forEach(function(i) {
			if (!allAreFilled) return;
			if (i.type === "radio") {
				let radioValueCheck = false;
				document.getElementById("billform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
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
					$('#validbillno').val($('#billno').val());
					$('#validbilldate').val($('#billdate').val());
					$('#validbillamount').val($('#grandtotal').val());
					var validbillamount=$("#validbillamount").val();
					var validpaidamount=$("#validpaidamount").val();
					$("#validpaidamount").val(validbillamount);
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
	$("#billonoff"+lineNo).css("background-color","#fff");
	$("#billonoff"+lineNo).css("color","#000");
	$("#selforothers"+lineNo).val('self');
	var productid= $('#product'+lineNo).val();
	var customerid = $("#vendor").val();
<?php
	if ($access['billratedef']=='avail') {
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
	$.get("ratesearchbill.php", {term: productid,custid: customerid,ratedef: invratedef,differ: 'self'} , function(datas){
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
				check+="<div id='option"+lineNo+objbatch[key].billno+"inv' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' style='border:none;overflow:hidden;white-space:nowrap;' title='<?=strtoupper($infomainaccessuser['modulename'])?>'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='invbilltxt'><?=strtoupper($infomainaccessuser['modulename'])?></span></td><td align='right' id='invno"+objbatch[key].billno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].billno+"'>  "+objbatch[key].billno+" </td><td align='right' id='invdt"+objbatch[key].billno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].billdate+"'>"+objbatch[key].billdate+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' colspan='2' id='rate"+objbatch[key].productrate+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td><td align='right' id='dis"+objbatch[key].productdiscount+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productdiscount+"'><?=$access['txtprodisbill']?> : "+objbatch[key].productdiscount+" </td></tr></table></div>";
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
// FOR GET OLD RATE OF THE VENDOR AND PRODUCT IN SELF BRANCH
function othersgetfun(lineNo) {
	$("#invonoff"+lineNo).css("background-color","#fff");
	$("#invonoff"+lineNo).css("color","#000");
	$("#billonoff"+lineNo).css("background-color","#1BBC9B");
	$("#billonoff"+lineNo).css("color","#fff");
	$("#selforothers"+lineNo).val('others');
	var productid= $('#product'+lineNo).val();
	var customerid = $("#vendor").val();
<?php
	if ($access['billratedef']=='avail') {
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
	$.get("ratesearchbill.php", {term: productid,custid: customerid,ratedef: invratedef,differ: 'others'} , function(datas){
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
				check+="<div id='option"+lineNo+objbatch[key].billno+"inv' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' style='border:none;overflow:hidden;white-space:nowrap;' title='<?=strtoupper($infomainaccessuser['modulename'])?>'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='invbilltxt'><?=strtoupper($infomainaccessuser['modulename'])?></span></td><td align='right' id='invno"+objbatch[key].billno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].billno+"'>  "+objbatch[key].billno+" </td><td align='right' id='invdt"+objbatch[key].billno+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].billdate+"'>"+objbatch[key].billdate+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' colspan='2' id='rate"+objbatch[key].productrate+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td><td align='right' id='dis"+objbatch[key].productdiscount+"inv' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productdiscount+"'><?=$access['txtprodisbill']?> : "+objbatch[key].productdiscount+" </td></tr></table></div>";
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
// FOR GET OLD RATE OF THE VENDOR AND PRODUCT IN OTHER BRANCH
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
		if ($access['billbatchdef']=='avail') {
	?>
		var billbatchdef = 'and quantity>0 ';
	<?php
		}
		else{
	?>
		var billbatchdef = '';
	<?php
		}
	?>
		$.get("batchsearch.php", {term: productid,batchdef: billbatchdef} , function(datas){
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
							// alert(oldproductnames[i].value+'=='+$('#productname'+id).val()+'---'+oldbatch[i].value+'=='+batqtyspl[6]+'---'+oldexp[i].value+'=='+expratespl[6].split('/')[2]+'-'+expratespl[6].split('/')[1]+'-'+expratespl[6].split('/')[0]);
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
		var browsersinvbill = document.getElementById("invbillgets"+id);
		browsersinvbill.style.display = 'none';
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
		var browsersinvbill = document.getElementById("invbillgets"+id);
		browsersinvbill.style.display = 'block';
		browsers.style.display = 'block';
		var productid= $('#product'+id).val();
		var customerid = $("#vendor").val();
		input.onclick = function () {
			browsers.style.display = 'block';
			browsersinvbill.style.display = 'block';
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
					browsersinvbill.style.display = 'block';
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
					browsersinvbill.style.display = 'none';
				}
			});
		}
	<?php
		if ($access['billratedef']=='avail') {
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
		$.get("ratesearchbill.php", {term: productid,custid: customerid,ratedef: invratedef,differ: selforothers} , function(datas){
			const objbatch = JSON.parse(datas);
			option='';
			invno='';
			invdt='';
			rate='';
			for (var key in objbatch) {
				option+='option'+id+objbatch[key].billno+'inv;';
				invno+='invno'+objbatch[key].billno+'inv;';
				invdt+='invdt'+objbatch[key].billdate+'inv;';
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
function qtytosqty(id) {
	var qtyval = document.getElementById("quantity"+id).value;
	document.getElementById("salequantity"+id).value = qtyval;
}
//FOR CONVERT QUANTITY TO SALE QUANTITY
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
//FOR SALE QUANTITY WITHOUT TAX CALCULATION
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
//FOR SALE QUANTITY WITH TAX CALCULATION
$(document).ready(function (){
	$("#vendor").trigger("change");
	$("input[type='number']").on("change", function () {
		$('input[type="number"]').not('#custbillpincode, #custshippincode, #billpincode, #twobillpincode, #shippincode, #twoshippincode, .notforfixed , #missingnoofdays').each(function () {
			if (!isNaN($(this).val())) {
				$(this).val(parseFloat($(this).val()).toFixed(2));
			}
		});
	});
});
// FOR TO FIX ALL THE NUMBER TYPE INPUTS TO 2 DECIMAL PLACES WHEN CHANGING SELF
$("#trigggerbutton").attr("disabled","disabled");
var sIndexEdit = 5, offSetEdit = 5, isPreviousEventCompleteEdit = true, isDataAvailableEdit = true, ivalue=6;
function editdatafetch() {
if (isPreviousEventCompleteEdit && isDataAvailableEdit) {
isPreviousEventCompleteEdit = false;
$("#loadimg").css("display","block");
// console.log('ss');
// ajax for get
$.ajax({
type: "GET",
url: 'editfetch.php?term=' + sIndexEdit + '&limitings=5&billno=<?=$_GET['billno']?>&billdate=<?=$_GET['billdate']?>&type=bill&i='+ivalue+'',
success: function (result) {
$("#purchasetablebody").append(result);
sIndexEdit = sIndexEdit + offSetEdit;
ivalue+=5;
isPreviousEventCompleteEdit = true;
if (result!='') {
	editdatafetch();
	for(vari=parseInt(ivalue)-5;vari<parseInt(ivalue);vari++){
		document.getElementById("totalProCount").innerHTML = document.getElementsByClassName("product1").length;
		$('#accountname'+vari+'').select4();
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
		$('#product'+vari).select2({
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
		$("#product"+vari).on("select2:open", function() {
			$("#configureunits").attr("data-bs-target","#AddNewProduct");
			$("#configureunits").show();
		})
		$("#product"+vari).on("select2:open", function() {
		<?php
			if($access['billnewproductdef']=='1'){
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
	}
}
if (result == ''){
	isDataAvailableEdit = false;
	fetchedit = true;
	$("#trigggerbutton").removeAttr("disabled");
	let lineNo = document.getElementsByClassName("product1").length+1;
	$(document).ready(function () {
		addnewrow(lineNo);
		$(".productadd-row").click(function () {
			addnewrow(lineNo);
			lineNo++;
		});
	});
	// FOR ADD ANOTHER LINE IN PRODUCT
}
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
editdatafetch();
//FOR FETCH EDIT DATA USING AJAX
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
<?php
	}
	else{
		header("Location:bills.php?error=No Information Found");
	}
}
else{
	header("Location:bills.php?error=No Information Found");  
}
?>