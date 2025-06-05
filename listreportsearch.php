<?php
include('lcheck.php');
if (isset($_GET['billfrom'])) {
$sql=mysqli_query($con, "select vendorname,gstno,pos,billno,grandtotal,billdate,productvalue,sum(cgst25) as cgst25,sum(cgst6) as cgst6,sum(cgst9) as cgst9,sum(cgst14) as cgst14,sum(sgst25) as sgst25,sum(sgst6) as sgst6,sum(sgst9) as sgst9,sum(sgst14) as sgst14,sum(gst25) as igst25,sum(gst6) as igst6,sum(gst9) as igst9,sum(gst14) as igst14 from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and gstrtype='Registered Business - Regular' and (billdate>='".$_GET['billfrom']."' and billdate<='".$_GET['billto']."') GROUP BY billdate, billno order by billdate asc, billno desc");
while($info=mysqli_fetch_array($sql))
{
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;">
<span><?=$info['vendorname']?></span>
<br>
<span style="color: royalblue;"><?=$info['gstno']?></span>
<br>
<span>Place of Supply : <span><?=$info['pos']?></span></span>
<br>
<span>Invoice Number : <?=$info['billno']?></span>
<br>
<span>Amount : <?=$info['grandtotal']?></span>
</td>
<td data-label="INVOICE DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;">
<?=$info['billdate']?>
</td>
<td data-label="REVERSE CHARGE" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"></td>
<td data-label="TAXABLE AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">
<?=$info['productvalue']?>
</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">
<?=$info['igst25']?>
<br>
<?=$info['igst6']?>
<br>
<?=$info['igst9']?>
<br>
<?=$info['igst14']?>
</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">
<?=$info['cgst25']?>
<br>
<?=$info['cgst6']?>
<br>
<?=$info['cgst9']?>
<br>
<?=$info['cgst14']?>
</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">
<?=$info['sgst25']?>
<br>
<?=$info['sgst6']?>
<br>
<?=$info['sgst9']?>
<br>
<?=$info['sgst14']?>
</td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
}
?>