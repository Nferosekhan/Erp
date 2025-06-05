<?php
include('lcheck.php');
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd-m-Y';
}
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Payments Made For Sales Returns' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$sql=mysqli_query($con,"set names utf8");
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes,publicid from pairsalesreturnpayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by id desc limit ".$_GET['term'].",10");
$count=1;
while($info=mysqli_fetch_array($sql))
{
if($info['term']=='CASH SALESRETURN')
{
$sqls=mysqli_query($con,"select cancelstatus from pairsalesreturns where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and salesreturnno='".$info['receiptno']."' and salesreturndate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('salesreturnpaymentview.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
else
{
?>
<tr onclick="window.open('salesreturnpaymentview.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('salesreturnpaymentview.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
<td data-label="Date"><?=date('d/m/Y',strtotime($info['receiptdate']))?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Number', $modulecolumns))) {
                                                ?>
<td data-label="Number"><?=$info['receiptno']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
<?php
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['customername']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
?>
<td data-label="Name"><?=$sqlcusfetch['customername']?></td>
<?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Mode of Payment', $modulecolumns))) {
                                                ?>
<td data-label="Mode of Payment"><?=$info['paymentmode']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount Received', $modulecolumns))) {
                                                ?>
<td data-label="Amount Received"><i class="fa fa-rupee"></i> <?=number_format((float)$info['amount'],2,'.','')?></td>
<?php
                                            }
                                                ?>
                                               <!--  <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="salesreturnpaymentedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> -->
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="salesreturnpaymentedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
</tr>
<?php
$count++;
}
}
?>