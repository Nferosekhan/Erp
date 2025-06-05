<?php
include('lcheck.php');
date_default_timezone_set('Asia/Calcutta');
$createdon=date('Y-m-d H:i:s');
$term = mysqli_real_escape_string($con,$_POST['term']);
$receiptno = mysqli_real_escape_string($con,$_POST['receiptno']);
$headername= mysqli_real_escape_string($con,$_POST['headername']);
//$accountcategory= mysqli_real_escape_string($con,$_POST['accountcategory']);
$receiptdate = mysqli_real_escape_string($con,$_POST['receiptdate']);
$amount = (float)mysqli_real_escape_string($con,$_POST['amount']);
$paymentmode = mysqli_real_escape_string($con,$_POST['paymentmode']);
$notes = mysqli_real_escape_string($con,$_POST['notes']);
if(isset($_POST['edit']))
{
$id = mysqli_real_escape_string($con,$_POST['id']);
$sql=mysqli_query($con,"update pairexpenses set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='$term', headername='$headername',   receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes' where id='$id'");
if($sql)
{
header("Location: expenseview.php?id=".$id."&remarks=Update Successfully");
}
else
{
header("Location: expenses.php?remarks=Error");
}
}
else
{
$sql=mysqli_query($con,"insert into pairexpenses set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='RECEIPT', headername='$headername', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes'");
if($sql)
{
$id=mysqli_insert_id($con);
if(isset($_POST['open']))
{
header("Location: expenseadd.php?remarks=Added Successfully");	
}
else
{
header("Location: expenseview.php?id=".$id."&remarks=Added Successfully");	
}

}
else
{
header("Location: expenses.php?remarks=Error");
}
}
?>
