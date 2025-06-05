<?php
include('lcheck.php');
$sqlismainaccesspro=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccesspro=mysqli_fetch_array($sqlismainaccesspro);
$sqlismainaccesssales=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Sales' order by id  asc");
$infomainaccesssales=mysqli_fetch_array($sqlismainaccesssales);
$sqlismainaccessinvoice=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Invoices' order by id  asc");
$infomainaccessinvoice=mysqli_fetch_array($sqlismainaccessinvoice);
$sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Purchase' order by id  asc");
$infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
$sqlismainaccessbill=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Bills' order by id  asc");
$infomainaccessbill=mysqli_fetch_array($sqlismainaccessbill);
if (isset($_GET['term'])) {
?>
<?php
if ($_GET['types']=="customer") {
$sql = "SELECT productid, COUNT(productid) as count,productname,quantity,MAX(invoicedate) as lastdate,MAX(invoiceno) as lastno FROM pairinvoices where franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='".$_GET['id']."' GROUP BY productid ORDER BY count DESC,lastdate desc,lastno desc,quantity desc limit ".$_GET['term'].",20";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
$sqlprostock=mysqli_query($con, "select * from pairproducts where id='".$row['productid']."' order by productname asc");
$fetprostock=mysqli_fetch_array($sqlprostock);
$sqlstocktotal=mysqli_query($con,"SELECT id, batch, expdate, productrate, mrp, noofpacks, sum(quantity) as total, mrp, vat FROM pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='".$row['productid']."'");
$infostocktotal=mysqli_fetch_array($sqlstocktotal);
?>
<tr>
	<td data-label="<?=$infomainaccesspro['modulename']?> Name"><?=$row['productname']?><br>
	 <span style="font-size: 11px;display: block;margin-top: -3px;">Stock On Hand : 
	<?php
	if((float)$infostocktotal['total']>0)
	{
	?>
	<span style="margin-left: 1.8rem;font-size: 11px;" class="text-success">
		<?=$infostocktotal['total']?>
	</span>
	<?php
	}
	else
	{
	?><span style="margin-left: 1.8rem;font-size: 11px;" class="text-danger">
		<?=$infostocktotal['total']?>
	</span>
	<?php
	}	
	?>
	 </span>
	</td>
	<td data-label="<?=$infomainaccesssales['groupname']?> Frequency"><?=$row['count']?></td>
	<td data-label="Last <?=$infomainaccessinvoice['modulename']?> Date"><?=date($datemainphp,strtotime($row['lastdate']))?></td>
	<td data-label="Last <?=$infomainaccessinvoice['modulename']?> Number"><?=$row['lastno']?></td>
	<td data-label="Last <?=$infomainaccessinvoice['modulename']?> Quantity"><?=$row['quantity']?></td>
</tr>
<?php
}
}
?>
<?php
if ($_GET['types']=="vendor") {
$sql = "SELECT productid, COUNT(productid) as count,productname,quantity,MAX(billdate) as lastdate,MAX(billno) as lastno FROM pairbills where franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND vendorid='".$_GET['id']."' GROUP BY productid ORDER BY count DESC,lastdate desc,lastno desc,quantity desc limit ".$_GET['term'].",20";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
$sqlprostock=mysqli_query($con, "select * from pairproducts where id='".$row['productid']."' order by productname asc");
$fetprostock=mysqli_fetch_array($sqlprostock);
$sqlstocktotal=mysqli_query($con,"SELECT id, batch, expdate, productrate, mrp, noofpacks, sum(quantity) as total, mrp, vat FROM pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='".$row['productid']."'");
$infostocktotal=mysqli_fetch_array($sqlstocktotal);
?>
<tr>
	<td data-label="<?=$infomainaccesspro['modulename']?> Name"><?=$row['productname']?><br>
	 <span style="font-size: 11px;display: block;margin-top: -3px;">Stock On Hand : 
	<?php
	if((float)$infostocktotal['total']>0)
	{
	?>
	<span style="margin-left: 1.8rem;font-size: 11px;" class="text-success">
		<?=$infostocktotal['total']?>
	</span>
	<?php
	}
	else
	{
	?><span style="margin-left: 1.8rem;font-size: 11px;" class="text-danger">
		<?=$infostocktotal['total']?>
	</span>
	<?php
	}	
	?>
	 </span>
	</td>
	<td data-label="<?=$infomainaccesspurchase['groupname']?> Frequency"><?=$row['count']?></td>
	<td data-label="Last <?=$infomainaccessbill['modulename']?> Date"><?=date($datemainphp,strtotime($row['lastdate']))?></td>
	<td data-label="Last <?=$infomainaccessbill['modulename']?> Number"><?=$row['lastno']?></td>
	<td data-label="Last <?=$infomainaccessbill['modulename']?> Quantity"><?=$row['quantity']?></td>
</tr>
<?php
}
}
?>
<?php
}
?>