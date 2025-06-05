<?php
include('lcheck.php');
$sqlismainaccessusercus=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
$infomainaccessusercus=mysqli_fetch_array($sqlismainaccessusercus);
$sqlismainaccessinvoice=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Invoices' order by id  asc");
$infomainaccessinvoice=mysqli_fetch_array($sqlismainaccessinvoice);
$sqlismainaccessuserven=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Vendors' order by id  asc");
$infomainaccessuserven=mysqli_fetch_array($sqlismainaccessuserven);
$sqlismainaccesspurchasebill=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Bills' order by id  asc");
$infomainaccesspurchasebill=mysqli_fetch_array($sqlismainaccesspurchasebill);
if (isset($_POST['advadvcuspayaddsubmit'])) {

	$receiptno = htmlspecialchars($_POST['advreceiptno'], ENT_QUOTES, 'UTF-8');
	$customerid = htmlspecialchars($_POST['advcustomername'], ENT_QUOTES, 'UTF-8');
	$selcusname = mysqli_query($con,"select customername from paircustomers where id='$customerid'");
	$fetcusname = mysqli_fetch_array($selcusname);
	$customername = $fetcusname['customername'];
	$receiptdate = htmlspecialchars($_POST['advreceiptdate'], ENT_QUOTES, 'UTF-8');
	$amount = (float)htmlspecialchars($_POST['advamount'], ENT_QUOTES, 'UTF-8');
	$paymentmode = htmlspecialchars($_POST['advpaymentmode'], ENT_QUOTES, 'UTF-8');
	$notes = htmlspecialchars($_POST['advnotes'], ENT_QUOTES, 'UTF-8');

	$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Payments Received' order by id  asc");
	$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
	$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Payments Received' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
	$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
	$publicsql=mysqli_query($con,"select count(publicid) from pairsalespayments where createdid='$companymainid'");
	$publicans=mysqli_fetch_array($publicsql);
	$oldcodepublic=$publicans[0];
	$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
	$privatesql=mysqli_query($con,"select count(privateid) from pairsalespayments where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
	$privateans=mysqli_fetch_array($privatesql);
	$oldcodeprivate=$privateans[0];
	$privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;
	$ordering = $oldcodeprivate+1;

$sql=mysqli_query($con,"insert into pairsalespayments set module='advance',createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='advance', type='advance', customername='$customername', customerid='$customerid', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes',publicid='$publiccode',privateid='$privatecode',ordering='$ordering'");
if($sql)
{
$paymentid=mysqli_insert_id($con);
	$chadd='';
$chadd.=strtoupper($infomainaccessusercus['modulename']).' ADVANCE CREATED';
	            if($customername!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> '.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$customername.' ) </span>';
					}
					else
					{
						$chadd.=''.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$customername.' ) </span>';
					}					
				}
                if($receiptdate!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($receiptdate)).' ) </span>';
					}
					else
					{
						$chadd.=' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($receiptdate)).' ) </span>';
					}					
				}
				if($receiptno!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( '.$receiptno.' ) </span>';
					}
					else
					{
						$chadd.='Reference Number <span style="color:green;" id="prohisfromtospan">( '.$receiptno.' ) </span>';
					}					
				}
                if($paymentmode!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.$paymentmode.' ) </span>';
					}
					else
					{
						$chadd.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.$paymentmode.' ) </span>';
					}					
				}
                if($amount!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
					}
					else
					{
						$chadd.='Amount Received <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
					}					
				}
                if($notes!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
					}
					else
					{
						$chadd.='Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
					}					
				}
	$sqle=mysqli_query($con,"insert into pairsalespayhistory set module='advance',createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', customerid='$customerid', invoiceno='', invoicedate='', amount='$amount',type='advance'");
	$sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Payments Received'");
				if($chadd!='')
				{
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='SALESPAY', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$paymentid', useremarks='".$chadd." '");
				}
header("Location: salespaymentview.php?receiptno=".$receiptno."&receiptdate=".$receiptdate."&id=".$paymentid."&remarks=Added Successfully");
}
}
if (isset($_POST['advadvvenpayaddsubmit'])) {

	$receiptno = htmlspecialchars($_POST['advreceiptno'], ENT_QUOTES, 'UTF-8');
	$vendorid = htmlspecialchars($_POST['advvendorname'], ENT_QUOTES, 'UTF-8');
	$selvenname = mysqli_query($con,"select customername from paircustomers where id='$vendorid'");
	$fetvenname = mysqli_fetch_array($selvenname);
	$vendorname = $fetvenname['customername'];
	$receiptdate = htmlspecialchars($_POST['advreceiptdate'], ENT_QUOTES, 'UTF-8');
	$amount = (float)htmlspecialchars($_POST['advamount'], ENT_QUOTES, 'UTF-8');
	$paymentmode = htmlspecialchars($_POST['advpaymentmode'], ENT_QUOTES, 'UTF-8');
	$notes = htmlspecialchars($_POST['advnotes'], ENT_QUOTES, 'UTF-8');

	$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Payments Made' order by id  asc");
	$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
	$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Payments Made' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
	$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
	$publicsql=mysqli_query($con,"select count(publicid) from pairpurchasepayments where createdid='$companymainid'");
	$publicans=mysqli_fetch_array($publicsql);
	$oldcodepublic=$publicans[0];
	$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
	$privatesql=mysqli_query($con,"select count(privateid) from pairpurchasepayments where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
	$privateans=mysqli_fetch_array($privatesql);
	$oldcodeprivate=$privateans[0];
	$privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;
	$ordering = $oldcodeprivate+1;

$sql=mysqli_query($con,"insert into pairpurchasepayments set module='advance',createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='advance', type='advance', vendorname='$vendorname', vendorid='$vendorid', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes',publicid='$publiccode',privateid='$privatecode',ordering='$ordering'");
if($sql)
{
$paymentid=mysqli_insert_id($con);
	$chadd='';
$chadd.=strtoupper($infomainaccessuserven['modulename']).' ADVANCE CREATED';
	            if($vendorname!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> '.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$vendorname.' ) </span>';
					}
					else
					{
						$chadd.=''.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$vendorname.' ) </span>';
					}					
				}
                if($receiptdate!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($receiptdate)).' ) </span>';
					}
					else
					{
						$chadd.=' Date <span style="color:green;" id="prohisfromtospan">( '.date($datemainphp,strtotime($receiptdate)).' ) </span>';
					}					
				}
				if($receiptno!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( '.$receiptno.' ) </span>';
					}
					else
					{
						$chadd.='Reference Number <span style="color:green;" id="prohisfromtospan">( '.$receiptno.' ) </span>';
					}					
				}
                if($paymentmode!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.$paymentmode.' ) </span>';
					}
					else
					{
						$chadd.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.$paymentmode.' ) </span>';
					}					
				}
                if($amount!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
					}
					else
					{
						$chadd.='Amount Received <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
					}					
				}
                if($notes!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
					}
					else
					{
						$chadd.='Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
					}					
				}
	$sqle=mysqli_query($con,"insert into pairpurchasepayhistory set module='advance',createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', vendorid='$vendorid', billno='', billdate='', amount='$amount',type='advance'");
	$sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Payments Made'");
				if($chadd!='')
				{
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='PURCHASEPAY', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$paymentid', useremarks='".$chadd." '");
				}
header("Location: purchasepaymentview.php?receiptno=".$receiptno."&receiptdate=".$receiptdate."&id=".$paymentid."&remarks=Added Successfully");
}
}
if (isset($_POST['advadvcuspayeditsubmit'])) {

	$receiptno = htmlspecialchars($_POST['advreceiptno'], ENT_QUOTES, 'UTF-8');
	$customerid = htmlspecialchars($_POST['advcustomername'], ENT_QUOTES, 'UTF-8');
	$selcusname = mysqli_query($con,"select customername from paircustomers where id='$customerid'");
	$fetcusname = mysqli_fetch_array($selcusname);
	$customername = $fetcusname['customername'];
	$receiptdate = htmlspecialchars($_POST['advreceiptdate'], ENT_QUOTES, 'UTF-8');
	$amount = (float)htmlspecialchars($_POST['advamount'], ENT_QUOTES, 'UTF-8');
	$paymentmode = htmlspecialchars($_POST['advpaymentmode'], ENT_QUOTES, 'UTF-8');
	$notes = htmlspecialchars($_POST['advnotes'], ENT_QUOTES, 'UTF-8');
	$id = htmlspecialchars($_POST['advid'], ENT_QUOTES, 'UTF-8');

$sqlhis=mysqli_query($con,"select * from pairsalespayments where id='$id'");
$sqlhisans=mysqli_fetch_array($sqlhis);
$oldreceiptno = mysqli_real_escape_string($con,$sqlhisans['receiptno']);
$oldcustomername= mysqli_real_escape_string($con,$sqlhisans['customername']); 
$oldcustomerid= mysqli_real_escape_string($con,$sqlhisans['customerid']); 
$oldreceiptdate = mysqli_real_escape_string($con,$sqlhisans['receiptdate']); 
$oldamount = mysqli_real_escape_string($con,$sqlhisans['amount']); 
$oldpaymentmode = mysqli_real_escape_string($con,$sqlhisans['paymentmode']); 
$oldnotes = mysqli_real_escape_string($con,$sqlhisans['notes']); 

$sql=mysqli_query($con,"update pairsalespayments set module='advance',customername='$customername', customerid='$customerid', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes' where id='$id'");
if($sql)
{

	$ch='';
	            if($customername!=$oldcustomername)
				{
					if($ch!='')
					{
						$ch.='<br> '.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldcustomername.' To '.$customername.' ) </span>';
					}
					else
					{
						$ch.=''.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldcustomername.' To '.$customername.' ) </span>';
					}					
				}
                if($receiptdate!=$oldreceiptdate)
				{
					if($ch!='')
					{
						$ch.='<br> Date <span style="color:green;" id="prohisfromtospan">( From '.date($datemainphp,strtotime($oldreceiptdate)).' To '.date($datemainphp,strtotime($receiptdate)).' ) </span>';
					}
					else
					{
						$ch.=' Date <span style="color:green;" id="prohisfromtospan">( From '.date($datemainphp,strtotime($oldreceiptdate)).' To '.date($datemainphp,strtotime($receiptdate)).' ) </span>';
					}					
				}
				if($receiptno!=$oldreceiptno)
				{
					if($ch!='')
					{
						$ch.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptno.' To '.$receiptno.' ) </span>';
					}
					else
					{
						$ch.='Reference Number <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptno.' To '.$receiptno.' ) </span>';
					}					
				}
                if($paymentmode!=$oldpaymentmode)
				{
					if($ch!='')
					{
						$ch.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldpaymentmode.' To '.$paymentmode.' ) </span>';
					}
					else
					{
						$ch.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldpaymentmode.' To '.$paymentmode.' ) </span>';
					}					
				}
                if($amount!=$oldamount)
				{
					if($ch!='')
					{
						$ch.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}
					else
					{
						$ch.='Amount Received <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}					
				}
                if($notes!=$oldnotes)
				{
					if($ch!='')
					{
						$ch.='<br> Notes <span style="color:green;" id="prohisfromtospan">( From '.$oldnotes.' To '.$notes.' ) </span>';
					}
					else
					{
						$ch.='Notes <span style="color:green;" id="prohisfromtospan">( From '.$oldnotes.' To '.$notes.' ) </span>';
					}					
				}
	$sqle=mysqli_query($con,"update pairsalespayhistory set module='advance',customerid='$customerid',amount='$amount' where paymentid='$id'");
				if($ch!='')
				{
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='SALESPAY', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='".$ch." '");
				}
header("Location: salespaymentview.php?receiptno=".$receiptno."&receiptdate=".$receiptdate."&id=".$id."&remarks=Updated Successfully");
}
}
if (isset($_POST['advadvvenpayeditsubmit'])) {

	$receiptno = htmlspecialchars($_POST['advreceiptno'], ENT_QUOTES, 'UTF-8');
	$vendorid = htmlspecialchars($_POST['advvendorname'], ENT_QUOTES, 'UTF-8');
	$selvenname = mysqli_query($con,"select customername from paircustomers where id='$vendorid'");
	$fetvenname = mysqli_fetch_array($selvenname);
	$vendorname = $fetvenname['customername'];
	$receiptdate = htmlspecialchars($_POST['advreceiptdate'], ENT_QUOTES, 'UTF-8');
	$amount = (float)htmlspecialchars($_POST['advamount'], ENT_QUOTES, 'UTF-8');
	$paymentmode = htmlspecialchars($_POST['advpaymentmode'], ENT_QUOTES, 'UTF-8');
	$notes = htmlspecialchars($_POST['advnotes'], ENT_QUOTES, 'UTF-8');
	$id = htmlspecialchars($_POST['advid'], ENT_QUOTES, 'UTF-8');

$sqlhis=mysqli_query($con,"select * from pairpurchasepayments where id='$id'");
$sqlhisans=mysqli_fetch_array($sqlhis);
$oldreceiptno = mysqli_real_escape_string($con,$sqlhisans['receiptno']);
$oldvendorname= mysqli_real_escape_string($con,$sqlhisans['vendorname']); 
$oldvendorid= mysqli_real_escape_string($con,$sqlhisans['vendorid']); 
$oldreceiptdate = mysqli_real_escape_string($con,$sqlhisans['receiptdate']); 
$oldamount = mysqli_real_escape_string($con,$sqlhisans['amount']); 
$oldpaymentmode = mysqli_real_escape_string($con,$sqlhisans['paymentmode']); 
$oldnotes = mysqli_real_escape_string($con,$sqlhisans['notes']); 

$sql=mysqli_query($con,"update pairpurchasepayments set module='advance',vendorname='$vendorname', vendorid='$vendorid', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes' where id='$id'");
if($sql)
{

	$ch='';
	            if($vendorname!=$oldvendorname)
				{
					if($ch!='')
					{
						$ch.='<br> '.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldvendorname.' To '.$vendorname.' ) </span>';
					}
					else
					{
						$ch.=''.$infomainaccessuserven['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldvendorname.' To '.$vendorname.' ) </span>';
					}					
				}
                if($receiptdate!=$oldreceiptdate)
				{
					if($ch!='')
					{
						$ch.='<br> Date <span style="color:green;" id="prohisfromtospan">( From '.date($datemainphp,strtotime($oldreceiptdate)).' To '.date($datemainphp,strtotime($receiptdate)).' ) </span>';
					}
					else
					{
						$ch.=' Date <span style="color:green;" id="prohisfromtospan">( From '.date($datemainphp,strtotime($oldreceiptdate)).' To '.date($datemainphp,strtotime($receiptdate)).' ) </span>';
					}					
				}
				if($receiptno!=$oldreceiptno)
				{
					if($ch!='')
					{
						$ch.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptno.' To '.$receiptno.' ) </span>';
					}
					else
					{
						$ch.='Reference Number <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptno.' To '.$receiptno.' ) </span>';
					}					
				}
                if($paymentmode!=$oldpaymentmode)
				{
					if($ch!='')
					{
						$ch.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldpaymentmode.' To '.$paymentmode.' ) </span>';
					}
					else
					{
						$ch.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldpaymentmode.' To '.$paymentmode.' ) </span>';
					}					
				}
                if($amount!=$oldamount)
				{
					if($ch!='')
					{
						$ch.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}
					else
					{
						$ch.='Amount Received <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}					
				}
                if($notes!=$oldnotes)
				{
					if($ch!='')
					{
						$ch.='<br> Notes <span style="color:green;" id="prohisfromtospan">( From '.$oldnotes.' To '.$notes.' ) </span>';
					}
					else
					{
						$ch.='Notes <span style="color:green;" id="prohisfromtospan">( From '.$oldnotes.' To '.$notes.' ) </span>';
					}					
				}
	$sqle=mysqli_query($con,"update pairpurchasepayhistory set module='advance',vendorid='$vendorid', amount='$amount' where paymentid='$id'");
				if($ch!='')
				{
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='PURCHASEPAY', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='".$ch." '");
				}
header("Location: purchasepaymentview.php?receiptno=".$receiptno."&receiptdate=".$receiptdate."&id=".$id."&remarks=Updated Successfully");
}
}
?>