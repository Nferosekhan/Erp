<?php
if (!isset($userid)) {
include("lcheck.php");
}
$sqlismainaccesspro=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccesspro=mysqli_fetch_array($sqlismainaccesspro);
$sqlismainaccesssales=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Sales' order by id  asc");
$infomainaccesssales=mysqli_fetch_array($sqlismainaccesssales);
$sqlismainaccessinvoice=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Invoices' order by id  asc");
$infomainaccessinvoice=mysqli_fetch_array($sqlismainaccessinvoice);
?>
<!DOCTYPE html>
<html>
<head>
  	<title>
    	Frequent <?=$infomainaccesspro['modulename']?> Details
  	</title>
</head>
<body>
<p id="frequentcustname" style="font-size: 15px;">Customer Name</p>
<div class="table-responsive mt-3 p-0 min-height-480 mb-3">
<table id="frequentproTable" class="table table-bordered align-items-center mb-0">
	<thead>
	<tr>
	<td class="text-uppercase" style="width:150px;"><span style="font-size:13px;color:grey;"><?=$infomainaccesspro['modulename']?> Name</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;"><?=$infomainaccesssales['groupname']?> Frequency</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Last <?=$infomainaccessinvoice['modulename']?> Date</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Last <?=$infomainaccessinvoice['modulename']?> Number</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Last <?=$infomainaccessinvoice['modulename']?> Quantity</span></td>
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