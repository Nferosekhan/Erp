<?php
if (!isset($userid)) {
include("lcheck.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  	<title>
    	<?=$infomainaccesspro['modulename']?> Margin Details
  	</title>
</head>
<body>
<p id="marginproname" style="font-size: 19px;line-height: 23px;">Product Name</p>
<div class="table-responsive mt-3 p-0 min-height-480 mb-3">
<table id="promargintable" class="table table-bordered align-items-center mb-0">
	<thead>
	<tr>
	<td class="text-uppercase" style="width:150px;"><span style="font-size:13px;color:grey;">Description</span></td>
	<!-- <td class="text-uppercase" style="width:80px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>"><span style="font-size:13px;color:grey;">Batch</span></td> -->
	<!-- <td class="text-uppercase" style="width:80px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>"><span style="font-size:13px;color:grey;">Expiry</span></td> -->
	<td class="text-uppercase" style="width:213px;text-align: right !important;"><span style="font-size:13px;color:grey;">Purchase Rate</span></td>
	<td class="text-uppercase" style="width:50px;text-align: right !important;"><span style="font-size:13px;color:grey;">Quantity</span></td>
	<td class="text-uppercase" style="width:195px;text-align: right !important;"><span style="font-size:13px;color:grey;">Sale Rate</span></td>
	<td class="text-uppercase" style="width:130px;text-align: right !important;"><span style="font-size:13px;color:grey;">Profit Margin</span></td>
	</tr>
	</thead>
	<tbody id="promarginans">
		
	</tbody>
</table>
<div style="text-align: center !important;display: none;" id="loadimg">
	<img src="loading.gif" alt="Loading..." style="margin-top: -60px;" id="loadimgins">
</div>
</div>
</body>
</html>