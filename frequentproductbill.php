<?php
if (!isset($userid)) {
include("lcheck.php");
}
$sqlismainaccesspro=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccesspro=mysqli_fetch_array($sqlismainaccesspro);
$sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Purchase' order by id  asc");
$infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
$sqlismainaccessbill=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Bills' order by id  asc");
$infomainaccessbill=mysqli_fetch_array($sqlismainaccessbill);
?>
<!DOCTYPE html>
<html>
<head>
  	<title>
    	Frequent <?=$infomainaccesspro['modulename']?> Details
  	</title>
</head>
<body>
<p id="frequentcustname" style="font-size: 15px;">Vendor Name</p>
<div class="table-responsive mt-3 p-0 min-height-480 mb-3">
<table id="frequentproTable" class="table table-bordered align-items-center mb-0">
	<thead>
	<tr>
	<td class="text-uppercase" style="width:150px;"><span style="font-size:13px;color:grey;"><?=$infomainaccesspro['modulename']?> Name</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;"><?=$infomainaccesspurchase['groupname']?> Frequency</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Last <?=$infomainaccessbill['modulename']?> Date</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Last <?=$infomainaccessbill['modulename']?> Number</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Last <?=$infomainaccessbill['modulename']?> Quantity</span></td>
	</tr>
	</thead>
	<tbody id="frequentproans">
		
	</tbody>
</table>
<div style="text-align: center !important;display: none;" id="loadimg">
	<img src="loading.gif" alt="Loading..." style="margin-top: -60px;" id="loadimgins">
</div>
</div>
</body>
</html>