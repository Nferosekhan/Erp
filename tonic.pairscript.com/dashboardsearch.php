<?php
include('lcheck.php');
$sqlismainaccesspro=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccesspro=mysqli_fetch_array($sqlismainaccesspro);
if (isset($_GET['term'])&&$_GET['types']=='proexpdate') {
$currentDateNow = new DateTime();
$NowDateValue = new DateTime();
$finalNowDate = $NowDateValue->format('Y-m-d');
$dateexpmax = $access['proexpdate'];
$currentDateNow->modify('+'.$dateexpmax.' days');
$finalDateAfter = $currentDateNow->format('Y-m-d');
$expiryproducts = mysqli_query($con,"select pairbatch.productid,pairbatch.productname,pairbatch.quantity,pairbatch.batch,pairbatch.expdate from pairbatch join pairproducts on pairproducts.id=pairbatch.productid and pairproducts.isactive='0' where pairbatch.expdate!='' and pairbatch.createdid='$companymainid' and pairbatch.franchisesession='".$_SESSION["franchisesession"]."' and pairbatch.quantity>=1 GROUP BY pairbatch.batch,pairbatch.expdate,pairbatch.productname order by pairbatch.expdate asc,pairbatch.quantity desc limit ".$_GET['term'].",5");
while($expiryprofetch = mysqli_fetch_array($expiryproducts)){
$productactive = mysqli_query($con,"select * from pairproducts where id='".$expiryprofetch['productid']."' and isactive='0'");
if (mysqli_num_rows($productactive)>0) {
if (($expiryprofetch['expdate']<=$finalDateAfter)) {
if ($expiryprofetch['expdate']>$finalDateAfter) {
$classnames = 'nothing';
}
else if ($expiryprofetch['expdate']<$finalDateAfter) {
$classnames = 'onlyblink';
}
else if ($expiryprofetch['expdate']==$finalDateAfter) {
$classnames = 'onlyred';
}
?>
<tr style="vertical-align: middle;" class="<?=$classnames?>">
<td data-label="<?=$infomainaccesspro['modulename']?> Name" style="padding: 0rem 0.3rem;font-size:13px;"><span style="display: inline-block;max-width: 300px;"><?=$expiryprofetch['productname']?></span></td>
<td data-label="Quantity" style="padding: 0rem 0.3rem;font-size:13px;"><span style="display: inline-block;max-width: 80px;"><?=$expiryprofetch['quantity']?></span></td>
<td data-label="Batch" style="padding: 0rem 0.3rem;font-size:13px;"><span style="display: inline-block;max-width: 80px;"><?=($expiryprofetch['batch']!='')?$expiryprofetch['batch']:'&nbsp;'?></span></td>
<td data-label="Expiry" style="padding: 0rem 0.3rem;font-size:13px;"><span style="display: inline-block;max-width: 80px;"><?=date($datemainphp,strtotime($expiryprofetch['expdate']))?></span></td>
</tr>
<?php
}
}
}
}
?>