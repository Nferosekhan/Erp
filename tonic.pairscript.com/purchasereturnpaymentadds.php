<?php
include('lcheck.php');
date_default_timezone_set('Asia/Calcutta');
$createdon=date('Y-m-d H:i:s');
$term = mysqli_real_escape_string($con,$_POST['term']);
$receiptno = mysqli_real_escape_string($con,$_POST['receiptno']);
$vendorname= mysqli_real_escape_string($con,$_POST['vendorname']);
//$accountcategory= mysqli_real_escape_string($con,$_POST['accountcategory']);
$vendorid = mysqli_real_escape_string($con,$_POST['vendorid']);
$receiptdate = mysqli_real_escape_string($con,$_POST['receiptdate']);
$amount = (float)mysqli_real_escape_string($con,$_POST['amount']);
$paymentmode = mysqli_real_escape_string($con,$_POST['paymentmode']);
$notes = mysqli_real_escape_string($con,$_POST['notes']);
$no=mysqli_real_escape_string($con, $_POST["no"]);
$date=mysqli_real_escape_string($con, $_POST["date"]);
$type=mysqli_real_escape_string($con, $_POST["type"]);
$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Payments Made For Purchase Return' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Payments Made For Purchase Return' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
$publicsql=mysqli_query($con,"select count(publicid) from pairpurchasereturnpayments where createdid='$companymainid'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
$privatesql=mysqli_query($con,"select count(privateid) from pairpurchasereturnpayments where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;
if($type!='')
{
	$labelname=strtoupper($type);
	$nocolumn=$type.'no';
	$datecolumn=$type.'date';
	$tabname='pair'.$type.'s';
}
else
{
	$type='purchasereturn';
	$labelname=strtoupper($type);
	$nocolumn=$type.'no';
	$datecolumn=$type.'date';
	$tabname='pair'.$type.'s';
}

if(isset($_POST['edit']))
{
$id = mysqli_real_escape_string($con,$_POST['id']);

$sqlhis=mysqli_query($con,"select * from pairpurchasereturnpayments where id='$id'");
$sqlhisans=mysqli_fetch_array($sqlhis);
$oldreceiptno = $sqlhisans['receiptno'];
$oldvendorname= $sqlhisans['vendorname']; 
$oldreceiptdate = $sqlhisans['receiptdate']; 
$oldamount = $sqlhisans['amount']; 
$oldpaymentmode = $sqlhisans['paymentmode']; 
$oldnotes = $sqlhisans['notes']; 

$sql=mysqli_query($con,"update pairpurchasereturnpayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', type='$type', term='$term', vendorname='$vendorname',    vendorid='$vendorid', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes' where id='$id'");
if($sql)
{
	$ch='';
	            if($vendorname!=$oldvendorname)
				{
					if($ch!='')
					{
						$ch.='<br> Vendor Name <span style="color:green;" id="prohisfromtospan">( From '.$oldvendorname.' To '.$vendorname.' ) </span>';
					}
					else
					{
						$ch.='Vendor Name <span style="color:green;" id="prohisfromtospan">( From '.$oldvendorname.' To '.$vendorname.' ) </span>';
					}					
				}
                if($receiptdate!=$oldreceiptdate)
				{
					if($ch!='')
					{
						$ch.='<br> (Receipt) Date <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptdate.' To '.$receiptdate.' ) </span>';
					}
					else
					{
						$ch.='(Receipt) Date <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptdate.' To '.$receiptdate.' ) </span>';
					}					
				}
				if($receiptno!=$oldreceiptno)
				{
					if($ch!='')
					{
						$ch.='<br> (Receipt) Number <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptno.' To '.$receiptno.' ) </span>';
					}
					else
					{
						$ch.='(Receipt) Number <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptno.' To '.$receiptno.' ) </span>';
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
				// if($payment!=$oldpayment)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Select <span style="color:green;" id="prohisfromtospan">( From '.$oldpayment.' To '.$payment.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Select <span style="color:green;" id="prohisfromtospan">( From '.$oldpayment.' To '.$payment.' ) </span>';
				// 	}					
				// }
                if($amount!=$oldamount)
				{
					if($ch!='')
					{
						$ch.='<br> Selected <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}
					else
					{
						$ch.='Selected <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}					
				}
				if($ch!='')
				{
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='PURCHASEPAYMADE', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='".$ch." '");
				}
$sqle=mysqli_query($con,"delete from pairpurchasereturnpayhistory where paymentid='$id'");	
for($i=0; $i<count($_POST['nos']); $i++)
{
	$paymentid=$id;
	$nos=$_POST['nos'][$i];
	$dates=$_POST['dates'][$i];
	$status=$_POST['status'][$i];
	if(isset($_POST['payments'.$i]))
	{
		$amount=$_POST['amounts'][$i];
		$payment=$_POST['payments'.$i];
		if($amount==$payment)
		{
			$status='1';
		}
		$sqle=mysqli_query($con,"insert into pairpurchasereturnpayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', vendorid='$vendorid', purchasereturnno='$nos', purchasereturndate='$dates', amount='$amount'");
		if($sqle)
		{
			$sqler=mysqli_query($con,"update $tabname set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$status' where $nocolumn='$nos' and $datecolumn='$dates' and vendorid='$vendorid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
			if($sqler)
			{
				//echo 's';
			}
			else
			{
				echo mysqli_error($con);
			}
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		$sqler=mysqli_query($con,"update $tabname set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$status' where $nocolumn='$nos' and $datecolumn='$dates' and vendorid='$vendorid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
	}
}	
header("Location: purchasereturnpaymentview.php?id=".$id."&remarks=Update Successfully");
}
else
{
header("Location: purchasereturnpaymentview.php?id=".$id."&remarks=Error");
}
}
else
{
$sql=mysqli_query($con,"insert into pairpurchasereturnpayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='$term', type='$type', vendorname='$vendorname', vendorid='$vendorid', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes',publicid='$publiccode',privateid='$privatecode'");
if($sql)
{
$id=mysqli_insert_id($con);
for($i=0; $i<count($_POST['nos']); $i++)
{
	$paymentid=$id;
	$nos=$_POST['nos'][$i];
	$dates=$_POST['dates'][$i];
	$status=$_POST['status'][$i];
	if(isset($_POST['payments'.$i]))
	{
		$amount=$_POST['amounts'][$i];
		$payment=$_POST['payments'.$i];
		if($amount==$payment)
		{
			$status='1';
		}
		$sqle=mysqli_query($con,"insert into pairpurchasereturnpayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', vendorid='$vendorid', purchasereturnno='$nos', purchasereturndate='$dates', amount='$amount'");
		if($sqle)
		{
			$sqler=mysqli_query($con,"update $tabname set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$status' where $nocolumn='$nos' and $datecolumn='$dates' and vendorid='$vendorid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
			if($sqler)
			{
				//echo 's';
			}
			else
			{
				echo mysqli_error($con);
			}
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		$sqler=mysqli_query($con,"update $tabname set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$status' where $nocolumn='$nos' and $datecolumn='$dates' and vendorid='$vendorid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
	}
}


   

if(isset($_POST['open']))
{
header("Location: purchasereturnpaymentadd.php?remarks=Added Successfully");	
}
else
{
header("Location: purchasereturnpaymentview.php?id=".$id."&remarks=Added Successfully");	
}

}
else
{
header("Location: purchasereturnpaymentview.php?id=".$id."&remarks=Error");
}
}
?>
