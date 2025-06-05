<?php
include 'lcheck.php';

if((!isset($_POST['searchTerm']))&&(!isset($_POST['preparedby']))){
	$fetchData = mysqli_query($con,"select preparedby from pairinvoices where preparedby!='' GROUP BY preparedby order by preparedby limit 50");
}else if(isset($_POST['preparedby'])){
	$search = mysqli_real_escape_string($con,$_POST['preparedby']); 
	$fetchData = mysqli_query($con,"select preparedby from pairinvoices where preparedby!='' AND preparedby='".$search."' GROUP BY preparedby order by preparedby limit 50");
}else{
	$search = mysqli_real_escape_string($con,$_POST['searchTerm']); 
	$fetchData = mysqli_query($con,"select preparedby from pairinvoices where preparedby like '%".$search."%' GROUP BY preparedby limit 50");
}
	 
$data = array();
$data[] = array("id"=>'all', "text"=>'All', "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>All</td></tr></table>");
while ($row = mysqli_fetch_array($fetchData)) {
        $data[] = array("id"=>$row['preparedby'], "text"=>$row['preparedby'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['preparedby']."</td></tr></table>");
}

echo json_encode($data);
?>