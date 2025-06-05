<?php
include 'lcheck.php';

$selectproduct = mysqli_query($con,"select productname from pairproducts where id='".$_GET['productid']."' and createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
$fetchproduct = mysqli_fetch_array($selectproduct);

$checkbymargin = mysqli_query($con,"select * from pairmargins where productid='".$_GET['productid']."' and type='buying' and createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and batch='".$_GET['batch']."' and expiry='".$_GET['expiry']."' and quantity>0 and nowstatus='added' GROUP BY billingdate, billingno order by billingdate asc, billingno asc");

$checkbybill = mysqli_query($con,"select * from pairbills where productid='".$_GET['productid']."' and createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and batch='".$_GET['batch']."' and expdate='".$_GET['expiry']."' and quantity>0 GROUP BY billdate, billno order by billdate asc, billno asc");

$quantityans = 0;

$billerans = '';

if (mysqli_num_rows($checkbymargin)>0) {

$checkbymargininner = mysqli_query($con,"select * from pairmargins where productid='".$_GET['productid']."' and type='buying' and createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and batch='".$_GET['batch']."' and expiry='".$_GET['expiry']."' and quantity>0 and nowstatus='added' GROUP BY billingdate, billingno order by billingdate asc, billingno asc");

$checkmarginqty = (int)$_GET['proqty'];

while($fetchmargininner = mysqli_fetch_array($checkbymargininner)){

if($checkmarginqty>0){

if($fetchmargininner['quantity']>$checkmarginqty){
$marginqty = $checkmarginqty;
}
else{
$marginqty = (int)$fetchmargininner['quantity'];
$checkmarginqty-=$marginqty;
}

if ($quantityans!=(int)$_GET['proqty']) {
$quantityans+=$marginqty;
$billerans.=$fetchmargininner['billerid'].'|||'.$fetchmargininner['billername'].'|||'.$fetchmargininner['billingno'].'|||'.$fetchmargininner['billingdate'].'|||'.$marginqty.'|||'.(($marginqty*$_GET['prorate'])-($marginqty*$fetchmargininner['rate'])).'|||'.$fetchmargininner['rate'].'|||'.$fetchmargininner['batch'].'|||'.$fetchmargininner['expiry'].'|||'.$fetchmargininner['prodiscounttype'].'|||'.$fetchmargininner['discountvalue'].'|||'.$_GET['prodiscounttype'].'|||'.$_GET['discountvalue'].'|-|';
}

}

}

// if ($quantityans<(int)$_GET['proqty']) {

// if(mysqli_num_rows($checkbybill)>0){

// $checkbybillinner = mysqli_query($con,"select * from pairbills where productid='".$_GET['productid']."' and createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and batch='".$_GET['batch']."' and expdate='".$_GET['expiry']."' and quantity>0 GROUP BY billdate, billno order by billdate asc, billno asc");

// while($fetchbillinner = mysqli_fetch_array($checkbybillinner)){

// if($checkmarginqty>0){

// if($fetchbillinner['quantity']>$checkmarginqty){
// $billqty = $checkmarginqty;
// }
// else{
// $billqty = (int)$fetchbillinner['quantity'];
// $checkmarginqty-=$billqty;
// }

// if (($quantityans!=(int)$_GET['proqty'])&&(strpos($billerans, $fetchbillinner['billno']) === false)) {
// $quantityans+=$billqty;
// $billerans.=$fetchbillinner['vendorid'].'|||'.$fetchbillinner['vendorname'].'|||'.$fetchbillinner['billno'].'|||'.$fetchbillinner['billdate'].'|||'.$billqty.'|||'.(($billqty*$_GET['prorate'])-($billqty*$fetchbillinner['productrate'])).'|||'.$fetchbillinner['productrate'].'|||'.$fetchbillinner['batch'].'|||'.$fetchbillinner['expdate'].'|-|';
// }

// }

// }

if ($quantityans<(int)$_GET['proqty']) {

for ($i=$quantityans+1;$i<=(int)$_GET['proqty'];$i++) {
$quantityans+=1;
$billerans.='|-|';
}

}

// }

// }

}
// else if(mysqli_num_rows($checkbybill)>0){

// $checkbybillinnernxt = mysqli_query($con,"select * from pairbills where productid='".$_GET['productid']."' and createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and batch='".$_GET['batch']."' and expdate='".$_GET['expiry']."' and quantity>0 GROUP BY billdate, billno order by billdate asc, billno asc");

// $checkmarginqty = (int)$_GET['proqty'];

// while($fetchbillinnernxt = mysqli_fetch_array($checkbybillinnernxt)){

// if($checkmarginqty>0){

// if($fetchbillinnernxt['quantity']>$checkmarginqty){
// $billqty = $checkmarginqty;
// }
// else{
// $billqty = (int)$fetchbillinnernxt['quantity'];
// $checkmarginqty-=$billqty;
// }

// if ($quantityans!=(int)$_GET['proqty']) {
// $quantityans+=$billqty;
// $billerans.=$fetchbillinnernxt['vendorid'].'|||'.$fetchbillinnernxt['vendorname'].'|||'.$fetchbillinnernxt['billno'].'|||'.$fetchbillinnernxt['billdate'].'|||'.$billqty.'|||'.(($billqty*$_GET['prorate'])-($billqty*$fetchbillinnernxt['productrate'])).'|||'.$fetchbillinnernxt['productrate'].'|||'.$fetchbillinnernxt['batch'].'|||'.$fetchbillinnernxt['expdate'].'|-|';
// }

// }

// }

// if ($quantityans<(int)$_GET['proqty']) {

// for ($i=$quantityans+1;$i<=(int)$_GET['proqty'];$i++) {
// $quantityans+=1;
// }

// }

// }
else{

if ($quantityans<(int)$_GET['proqty']) {

for ($i=$quantityans+1;$i<=(int)$_GET['proqty'];$i++) {
$quantityans+=1;
$billerans.='|-|';
}

}

}

// echo (int)$_GET['proqty'].'|||'.$quantityans.'|||'.$billerans;

$responseouputs = array(
    'htmlvalues' => '',
    'margintotal' => '',
    'productname' => '',
    'formarginupdates' => ''
);

ob_start();

$runtheans = explode('|-|', $billerans);
$emptyqty = 0;
$margintotal = 0;
$showtheempty=true;
for($ans=0;$ans<count($runtheans);$ans++){
if (strpos($runtheans[$ans], '|||')!==false) {
$runtheansnxt = explode('|||', $runtheans[$ans]);
$emptyqty+=floatval($runtheansnxt[4]);
// $margintotal+=$runtheansnxt[5];
?>
<tr>
	<td data-label="Description"><span style="color: royalblue;">Purchase</span><br>Name : <?=$runtheansnxt[1]?><br>Number : <?=$runtheansnxt[2]?><br>Date : <?=date($datemainphp,strtotime($runtheansnxt[3]))?><br><span style="font-size:10px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">BATCH: <?=($runtheansnxt[7]!='')?$runtheansnxt[7]:'&nbsp;'?></span><br><span style="font-size:10px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">EXPIRY: <?=($runtheansnxt[8]!='')?date($datemainphp,strtotime($runtheansnxt[8])):'&nbsp;'?></span></td>
	<td data-label="Purchase Rate" style="text-align: right;"><span style="font-size: 11px;">RATE: <?=$resmaincurrencyans?> <?=number_format(floatval($runtheansnxt[4]) * floatval($runtheansnxt[6]),2,'.','')?></span><br><span style="font-size: 10px;"><?=$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[9]=='0')?floatval($runtheansnxt[10]).'%':$resmaincurrencyans.' '.floatval($runtheansnxt[10])).'(</span><span style="font-size: 10px;color:green !important;">'.$resmaincurrencyans.' '.number_format(floatval($runtheansnxt[4]) * floatval($runtheansnxt[6]),2,'.','').' - '.$resmaincurrencyans.' '.(($runtheansnxt[9]=='0')?number_format((((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100),2,'.',''):$resmaincurrencyans.' '.(number_format(floatval($runtheansnxt[10]),2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span>'?></span><br>
	<?php
		if ($runtheansnxt[9]=='0') {
			$finalmarginpurchase = number_format(((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) - (((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
			echo '<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].': '.$resmaincurrencyans.' '.number_format(((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) - (((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','').'</span>';
		}
		else{
			$finalmarginpurchase = number_format(((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
			echo '<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].': '.$resmaincurrencyans.' '.number_format(((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','').'</span>';
		}
	?>
	</td>
	<td data-label="Quantity" style="text-align: right;"><?=floatval($runtheansnxt[4])?></td>
	<td data-label="Sale Rate" style="text-align: right;"><span style="font-size: 11px;">RATE: <?=$resmaincurrencyans?> <?=number_format(floatval($runtheansnxt[4]) * $_GET['prorate'],2,'.','')?></span><br><span style="font-size: 10px;"><?=$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[11]=='0')?$runtheansnxt[12].'%':$resmaincurrencyans.' '.$runtheansnxt[12]).'(</span><span style="font-size: 10px;color:green !important;">'.$resmaincurrencyans.' '.number_format(floatval($runtheansnxt[4]) * floatval($runtheansnxt[6]),2,'.','').' - '.$resmaincurrencyans.' '.(($runtheansnxt[11]=='0')?number_format((((floatval($runtheansnxt[4]) * $_GET['prorate']) * $runtheansnxt[12]) / 100),2,'.',''):$resmaincurrencyans.' '.(number_format($runtheansnxt[12],2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span>'?></span><br>
	<?php
		if ($runtheansnxt[11]=='0') {
			$finalmarginsales = number_format(((floatval($runtheansnxt[4]) * $_GET['prorate']) - (((floatval($runtheansnxt[4]) * $_GET['prorate']) * $runtheansnxt[12]) / 100)),2,'.','');
			echo '<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].': '.$resmaincurrencyans.' '.number_format(((floatval($runtheansnxt[4]) * $_GET['prorate']) - (((floatval($runtheansnxt[4]) * $_GET['prorate']) * $runtheansnxt[12]) / 100)),2,'.','');
		}
		else{
			$finalmarginsales = number_format(((floatval($runtheansnxt[4]) * $_GET['prorate']) - ($runtheansnxt[12])),2,'.','');
			echo '<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].': '.$resmaincurrencyans.' '.number_format(((floatval($runtheansnxt[4]) * $_GET['prorate']) - ($runtheansnxt[12])),2,'.','');
		}
		$margintotal += number_format(($finalmarginsales - $finalmarginpurchase),2,'.','');
	?>
	</td>
	<td data-label="Profit Margin" style="text-align: right;"><?=$resmaincurrencyans?> <?=number_format(($finalmarginsales - $finalmarginpurchase),2,'.','')?></td>
</tr>
<?php
}
else{
if (($showtheempty==true)&&(($quantityans-$emptyqty)>0)) {
$showtheempty=false;
// $margintotal+=$_GET['prorate'] - $_GET['prorate'];

$selectpurrate = mysqli_query($con,"select purchasecost from pairpropurchase where productid='".$_GET['productid']."' and createdid='$companymainid'");
$fetchpurrate = mysqli_fetch_array($selectpurrate);

if($access['profitvalidationrule']=='1'){
if ($ans!=0) {
		if ($runtheansnxt[9]=='0') {
			$finalmarginpurchasenxt = number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
			$finalmarginpurchaseans =  $resmaincurrencyans.' '.number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
		}
		else{
			$finalmarginpurchasenxt = number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
			$finalmarginpurchaseans =  $resmaincurrencyans.' '.number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
		}
		if ($runtheansnxt[11]=='0') {
			$finalmarginsalesnxt = number_format(((($quantityans-$emptyqty) * $_GET['prorate']) - (((($quantityans-$emptyqty) * $_GET['prorate']) * $runtheansnxt[12]) / 100)),2,'.','');
			$finalmarginsalesans =  $resmaincurrencyans.' '.number_format(((($quantityans-$emptyqty) * $_GET['prorate']) - (((($quantityans-$emptyqty) * $_GET['prorate']) * $runtheansnxt[12]) / 100)),2,'.','');
		}
		else{
			$finalmarginsalesnxt = number_format(((($quantityans-$emptyqty) * $_GET['prorate']) - ($runtheansnxt[12])),2,'.','');
			$finalmarginsalesans =  $resmaincurrencyans.' '.number_format(((($quantityans-$emptyqty) * $_GET['prorate']) - ($runtheansnxt[12])),2,'.','');
		}
$rateforsale = '<span style="font-size: 11px;">RATE: '.$resmaincurrencyans.number_format(($quantityans-$emptyqty) * $_GET['prorate'],2,'.','').'</span><br>'.('<span style="font-size: 10px;">'.$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[11]=='0')?$runtheansnxt[12].'%':$resmaincurrencyans.' '.$runtheansnxt[12]).'(</span><span style="font-size: 10px;color:green !important;">'.$resmaincurrencyans.' '.number_format(($quantityans-$emptyqty) * $_GET['prorate'],2,'.','').' - '.$resmaincurrencyans.' '.(($runtheansnxt[11]=='0')?number_format((((($quantityans-$emptyqty) * $_GET['prorate']) * $runtheansnxt[12]) / 100),2,'.',''):$resmaincurrencyans.' '.(number_format($runtheansnxt[12],2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span></span>').'<br>'.'<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].$finalmarginsalesans.'</span>';
$rateforpur = '<span style="font-size: 11px;">RATE: '.$resmaincurrencyans.' '.number_format(($quantityans-$emptyqty) * floatval($runtheansnxt[6]),2,'.','').'</span><br>'.('<span style="font-size: 10px;">'.$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[9]=='0')?floatval($runtheansnxt[10]).'%':$resmaincurrencyans.' '.floatval($runtheansnxt[10])).'(</span><span style="font-size: 10px;color:green !important;">'.$resmaincurrencyans.' '.number_format(($quantityans-$emptyqty) * floatval($runtheansnxt[6]),2,'.','').' - '.$resmaincurrencyans.' '.(($runtheansnxt[9]=='0')?number_format((((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100),2,'.',''):$resmaincurrencyans.' '.(number_format(floatval($runtheansnxt[10]),2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span></span>').'<br>'.'<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].$finalmarginpurchaseans.'</span>';
$martotalforpur = number_format(($finalmarginsalesnxt - $finalmarginpurchasenxt),2,'.','');
$margintotal+=$martotalforpur;
}
else{
if ($fetchpurrate['purchasecost']!='') {
$rateforsale = $resmaincurrencyans.' '.$_GET['prorate'];
$rateforpur = $resmaincurrencyans.' '.number_format($fetchpurrate['purchasecost'],2,'.','');
$martotalforpur = ($quantityans-$emptyqty)*($_GET['prorate']) - ($quantityans-$emptyqty)*($fetchpurrate['purchasecost']);
$margintotal+=$martotalforpur;
}
else{
$rateforsale = $resmaincurrencyans.' '.$_GET['prorate'];
$rateforpur = '0.00';
$martotalforpur = ($quantityans-$emptyqty)*($_GET['prorate']);
$margintotal+=($quantityans-$emptyqty)*($_GET['prorate']);
}
}
}
else{
if ($ans!=0) {
		if ($runtheansnxt[9]=='0') {
			$finalmarginpurchasenxt = number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
			$finalmarginpurchaseans =  $resmaincurrencyans.' '.number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
		}
		else{
			$finalmarginpurchasenxt = number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
			$finalmarginpurchaseans =  $resmaincurrencyans.' '.number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
		}
		if ($runtheansnxt[11]=='0') {
			$finalmarginsalesnxt = number_format(((($quantityans-$emptyqty) * $_GET['prorate']) - (((($quantityans-$emptyqty) * $_GET['prorate']) * $runtheansnxt[12]) / 100)),2,'.','');
			$finalmarginsalesans =  $resmaincurrencyans.' '.number_format(((($quantityans-$emptyqty) * $_GET['prorate']) - (((($quantityans-$emptyqty) * $_GET['prorate']) * $runtheansnxt[12]) / 100)),2,'.','');
		}
		else{
			$finalmarginsalesnxt = number_format(((($quantityans-$emptyqty) * $_GET['prorate']) - ($runtheansnxt[12])),2,'.','');
			$finalmarginsalesans =  $resmaincurrencyans.' '.number_format(((($quantityans-$emptyqty) * $_GET['prorate']) - ($runtheansnxt[12])),2,'.','');
		}
$rateforsale = '<span style="font-size: 11px;">RATE: '.$resmaincurrencyans.number_format(($quantityans-$emptyqty) * $_GET['prorate'],2,'.','').'</span><br>'.('<span style="font-size: 10px;">'.$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[11]=='0')?$runtheansnxt[12].'%':$resmaincurrencyans.' '.$runtheansnxt[12]).'(</span><span style="font-size: 10px;color:green !important;">'.$resmaincurrencyans.' '.number_format(($quantityans-$emptyqty) * $_GET['prorate'],2,'.','').' - '.$resmaincurrencyans.' '.(($runtheansnxt[11]=='0')?number_format((((($quantityans-$emptyqty) * $_GET['prorate']) * $runtheansnxt[12]) / 100),2,'.',''):$resmaincurrencyans.' '.(number_format($runtheansnxt[12],2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span></span>').'<br>'.'<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].$finalmarginsalesans.'</span>';
$rateforpur = '<span style="font-size: 11px;">RATE: '.$resmaincurrencyans.' '.number_format(($quantityans-$emptyqty) * floatval($runtheansnxt[6]),2,'.','').'</span><br>'.('<span style="font-size: 10px;">'.$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[9]=='0')?floatval($runtheansnxt[10]).'%':$resmaincurrencyans.' '.floatval($runtheansnxt[10])).'(</span><span style="font-size: 10px;color:green !important;">'.$resmaincurrencyans.' '.number_format(($quantityans-$emptyqty) * floatval($runtheansnxt[6]),2,'.','').' - '.$resmaincurrencyans.' '.(($runtheansnxt[9]=='0')?number_format((((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100),2,'.',''):$resmaincurrencyans.' '.(number_format(floatval($runtheansnxt[10]),2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span></span>').'<br>'.'<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].$finalmarginpurchaseans.'</span>';
$martotalforpur = number_format(($finalmarginsalesnxt - $finalmarginpurchasenxt),2,'.','');
}
else{
if ($fetchpurrate['purchasecost']!='') {
$rateforsale = $resmaincurrencyans.' '.$_GET['prorate'];
$rateforpur = $resmaincurrencyans.' '.number_format($fetchpurrate['purchasecost'],2,'.','');
$martotalforpur = ($quantityans-$emptyqty)*($_GET['prorate']) - ($quantityans-$emptyqty)*($fetchpurrate['purchasecost']);
}
else{
$rateforsale = $resmaincurrencyans.' '.$_GET['prorate'];
$rateforpur = $_GET['prorate'];
$martotalforpur = ($quantityans-$emptyqty)*($_GET['prorate']) - ($quantityans-$emptyqty)*($_GET['prorate']);
}
}
$margintotal+=$martotalforpur;
}
?>
<tr>
	<td data-label="Description">
		<?php
		if ($ans!=0) {
		?>
		<span style="color: royalblue;">Last Purchase</span><br>Name : <?=$runtheansnxt[1]?><br>Number : <?=$runtheansnxt[2]?><br>Date : <?=date($datemainphp,strtotime($runtheansnxt[3]))?>
		<?php
		}
		else{
			if ($fetchpurrate['purchasecost']!='') {
		?>
		<span style="color: royalblue;">Product Information Rate</span>
		<?php
			}
			else{
			?>
			<span style="color: royalblue;">No Purchase Information</span>
			<?php
			}
		}
		?>
	</td>
	<td data-label="Purchase Rate" style="text-align: right;"><?=$rateforpur?></td>
	<td data-label="Quantity" style="text-align: right;"><?=$quantityans-$emptyqty?></td>
	<td data-label="Sale Rate" style="text-align: right;"><?=$rateforsale?></td>
	<td data-label="Profit Margin" style="text-align: right;"><?=$resmaincurrencyans?> <?=$martotalforpur?></td>
</tr>
<?php
}
}
}
?>
<tr>
	<td data-label="Total Profit Margin" colspan="5" style="text-align: right;">Total Profit Margin : <?=$resmaincurrencyans?> <?=$margintotal?></td>
</tr>
<?php
$response['htmlvalues'] = ob_get_clean();
$response['margintotal'] = number_format($margintotal,2,'.','');
$response['productname'] = $fetchproduct['productname'];
$response['formarginupdates'] = $billerans;
echo json_encode($response);
?>