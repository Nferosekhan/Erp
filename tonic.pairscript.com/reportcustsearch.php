<?php
include 'lcheck.php';

if((!isset($_POST['searchTerm']))&&(!isset($_POST['customername']))){
	$fetchData = mysqli_query($con,"select * from paircustomers where customername!='' and moduletype='Customers' and (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid') order by customername limit 50");
}else if(isset($_POST['customername'])){
	$search = mysqli_real_escape_string($con,$_POST['customername']); 
	$fetchData = mysqli_query($con,"select * from paircustomers where id='".$search."' and moduletype='Customers' and (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid') order by customername limit 50");
}else{
	$search = mysqli_real_escape_string($con,$_POST['searchTerm']); 
	$fetchData = mysqli_query($con,"select * from paircustomers where customername like '%".$search."%' and moduletype='Customers' and (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid') limit 50");
}
	 
$data = array();
$data[] = array("id"=>'all', "text"=>'All', "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>All</td></tr><tr style='margin-bottom:0px !important;color:#808080;border:none !important;' class='subtextfoo'><td style='font-size:12px;padding:0px;border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>Work Phone: </td><td style='font-size:12px; text-align:right;padding:0px;border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>Amount Receivable: <span style='color:green;'></span></td></tr></table>");
while ($row = mysqli_fetch_array($fetchData)) {
	 $consigneeid = $row['id'];
      $customername = $row['customername'];
      $workphone = $row['workphone'];
      $balanceamount = $row['balanceamount'];
	if ($row['balanceamount']==0) {
        $data[] = array("id"=>$row['id'], "text"=>$row['customername'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['customername']."</td></tr><tr style='margin-bottom:0px !important;color:#808080;border:none !important;' class='subtextfoo'><td style='font-size:12px;padding:0px;border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>Work Phone: ".$row['workphone']."</td><td style='font-size:12px; text-align:right;padding:0px;border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>Amount Receivable: <span style='color:green;'>".number_format((float)$row['balanceamount'], 2, ".", "")."</span></td></tr></table>");
	}
	else{
        $data[] = array("id"=>$row['id'], "text"=>$row['customername'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['customername']."</td></tr><tr style='margin-bottom:0px !important;color:#808080;border:none !important;' class='subtextfoo'><td style='font-size:12px;padding:0px;border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>Work Phone: ".$row['workphone']."</td><td style='font-size:12px; text-align:right;padding:0px;border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>Amount Receivable: <span style='color:red;'>".number_format((float)$row['balanceamount'], 2, ".", "")."</span></td></tr></table>");
	}
}

echo json_encode($data);
?>