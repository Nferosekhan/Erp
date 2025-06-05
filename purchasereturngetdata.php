<?php
include('lcheck.php');
if(!empty($_POST["vendorid"]))
{
$vendorid=mysqli_real_escape_string($con, $_POST["vendorid"]);
$no=mysqli_real_escape_string($con, $_POST["no"]);
$date=mysqli_real_escape_string($con, $_POST["date"]);
$type=mysqli_real_escape_string($con, $_POST["type"]);
$sqlismainaccesspurchasereturn=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Purchase Returns' order by id  asc");
$infomainaccesspurchasereturn=mysqli_fetch_array($sqlismainaccesspurchasereturn);
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

if($vendorid!='')
{
	echo '<span class="pull-right" style="color:#ff0000; font-weight:bold">* Select from Top to Bottom</span>
	<table style="width:100%" class="table table-bordered responsive-table">';
	echo '<thead>';
	echo '<tr class="info">';
	echo '<th style="vertical-align:middle !important;border:1px solid #ddd !important;"><span style="display:inline-block;width:77px;">'. strtoupper($infomainaccesspurchasereturn['modulename']) .' NO</span></th>';
	echo '<th style="vertical-align:middle !important;border:1px solid #ddd !important;"><span style="display:inline-block;width:77px;">'. strtoupper($infomainaccesspurchasereturn['modulename']) .' DATE</span></th>';
	echo '<th style="vertical-align:middle !important;border:1px solid #ddd !important;"><span style="display:inline-block;width:77px;">NAME</span></th>';
	echo '<th style="vertical-align:middle !important;border:1px solid #ddd !important;"><span style="display:inline-block;width:77px;">'. strtoupper($infomainaccesspurchasereturn['modulename']) .' AMOUNT</span></th>';
	echo '<th style="vertical-align:middle !important;border:1px solid #ddd !important;"><span style="display:inline-block;width:77px;">BALANCE</span></th>';
	echo '<th style="vertical-align:middle !important;border:1px solid #ddd !important;"><span style="display:inline-block;width:77px;">SELECT</span></th>';
	echo '<th style="vertical-align:middle !important;border:1px solid #ddd !important;"><span style="display:inline-block;width:77px;">SELECTED</span></th>';
	echo '</tr>';
	echo '</thead>';
	$i=0;
	$totalbalance=0;
	$sqls=mysqli_query($con,"select $nocolumn, $datecolumn, grandtotal, vendorid, vendorname from $tabname where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and vendorid='$vendorid' and paidstatus!='1' GROUP BY $datecolumn, $nocolumn  order by $datecolumn asc, $nocolumn asc");
	while($infos=mysqli_fetch_array($sqls))
	{
		$am=0;
		$sqlse=mysqli_query($con,"select sum(amount) as amount from pairpurchasereturnpayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  purchasereturnno='".$infos[$nocolumn]."' and purchasereturndate='".$infos[$datecolumn]."' and vendorid='$vendorid' ");
		while($infose=mysqli_fetch_array($sqlse))
		{
			$am+=(float)$infose['amount'];
		}
		$bal=(float)$infos['grandtotal']-$am;
		echo '<input type="hidden" name="nos[]" id="no'.$i.'" value="'.$infos[$nocolumn].'">
		<input type="hidden" name="dates[]" id="date'.$i.'" value="'.$infos[$datecolumn].'">
		<input type="hidden" name="status[]" id="status'.$i.'" value="0">';
		if(($no==$infos[$nocolumn])&&($date==$infos[$datecolumn]))
		{
			echo '<tr style="background:yellow">';
		}
		else
		{
			echo '<tr>';
		}
		
		echo '<td data-label="'. strtoupper($infomainaccesspurchasereturn['modulename']) .' NO" style="vertical-align:middle !important;">'.$infos[$nocolumn].'</td>';
		echo '<td data-label="'. strtoupper($infomainaccesspurchasereturn['modulename']) .' DATE" style="vertical-align:middle !important;">'.date('d/m/Y',strtotime($infos[$datecolumn])).'</td>';
		echo '<td data-label="NAME" style="vertical-align:middle !important;">'.(($infos['vendorid']!='')?$infos['vendorname'].' - '.$infos['vendorid']:$infos['vendorname']).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccesspurchasereturn['modulename']) .' AMOUNT" style="vertical-align:middle !important;">'.$infos['grandtotal'].'</td>';
		echo '<td data-label="BALANCE" style="vertical-align:middle !important;">'.$bal.'</td>';
		echo '<td data-label="SELECT" style="vertical-align:middle !important;"><label><input type="checkbox" name="payments'.$i.'" id="payments'.$i.'" onchange="return changeval('.$i.')" value="'.$bal.'" > Select</label></td>';
		echo '<td data-label="SELECTED" style="height:45px !important;vertical-align:middle !important;"  id="amttd"><input type="text" class="form-control amt" name="amounts[]" id="amounts'.$i.'" style="text-align:right;width:100%;float:right;" value="0.00"></td>';
		echo '</tr>';
		$i++;
		$totalbalance+=(float)$bal;
	}
echo '</table>
<script>
document.getElementById("totalbalance").innerHTML="(Pending Balance: Rs.'.$totalbalance.')";
</script>
';
if ($totalbalance==0) {
	echo "<script>$('#submittableview').attr('disabled','disabled');</script>";
}
else{
	echo "<script>$('#submittableview').removeAttr('disabled');</script>";
}
}
else
{
echo ''; 	
}
}
?>