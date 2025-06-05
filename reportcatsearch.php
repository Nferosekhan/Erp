<?php
include 'lcheck.php';

if((!isset($_POST['searchTerm']))&&(!isset($_POST['category']))){
	$fetchData = mysqli_query($con,"select * from paircategory where category!='' order by category limit 50");
}else if(isset($_POST['category'])){
	$search = mysqli_real_escape_string($con,$_POST['category']); 
	$fetchData = mysqli_query($con,"select * from paircategory where id='".$search."' order by category limit 50");
}else{
	$search = mysqli_real_escape_string($con,$_POST['searchTerm']); 
	$fetchData = mysqli_query($con,"select * from paircategory where category like '%".$search."%' limit 50");
}
	 
$data = array();
$data[] = array("id"=>'all', "text"=>'All', "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>All</td></tr></table>");
while ($row = mysqli_fetch_array($fetchData)) {
        $data[] = array("id"=>$row['id'], "text"=>$row['category'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['category']."</td></tr></table>");
}

echo json_encode($data);
?>