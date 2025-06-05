<?php
include 'lcheck.php';

if((!isset($_POST['searchTerm']))&&(!isset($_POST['checkedby']))){
	$fetchData = mysqli_query($con,"select checkedby from pairinvoices where checkedby!='' GROUP BY checkedby order by checkedby limit 50");
}else if(isset($_POST['checkedby'])){
	$search = mysqli_real_escape_string($con,$_POST['checkedby']); 
	$fetchData = mysqli_query($con,"select checkedby from pairinvoices where checkedby!='' AND checkedby='".$search."' GROUP BY checkedby order by checkedby limit 50");
}else{
	$search = mysqli_real_escape_string($con,$_POST['searchTerm']); 
	$fetchData = mysqli_query($con,"select checkedby from pairinvoices where checkedby like '%".$search."%' GROUP BY checkedby limit 50");
}
	 
$data = array();
$data[] = array("id"=>'all', "text"=>'All', "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>All</td></tr></table>");
while ($row = mysqli_fetch_array($fetchData)) {
        $data[] = array("id"=>$row['checkedby'], "text"=>$row['checkedby'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['checkedby']."</td></tr></table>");
}

echo json_encode($data);
?>