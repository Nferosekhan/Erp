<?php
include 'lcheck.php';

if((!isset($_POST['searchTerm']))&&(!isset($_POST['term']))){
	$fetchData = mysqli_query($con,"select term from pairterms where (createdid='$companymainid' OR createdid='0') AND term!='' GROUP BY term order by term asc limit 50");
}else if(isset($_POST['term'])){
	$search = mysqli_real_escape_string($con,$_POST['term']); 
	$fetchData = mysqli_query($con,"select term from pairterms where (createdid='$companymainid' OR createdid='0') AND term!='' AND term='".$search."' GROUP BY term order by term asc limit 50");
}else{
	$search = mysqli_real_escape_string($con,$_POST['searchTerm']); 
	$fetchData = mysqli_query($con,"select term from pairterms where (createdid='$companymainid' OR createdid='0') AND term like '%".$search."%' GROUP BY term limit 50");
}
	 
$data = array();
$data[] = array("id"=>'all', "text"=>'All', "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>All</td></tr></table>");
while ($row = mysqli_fetch_array($fetchData)) {
		if (($row['term']!='BANK ACCOUNT')&&($row['term']!='UPI')) {
        $data[] = array("id"=>$row['term'], "text"=>$row['term'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['term']."</td></tr></table>");
     }
}

echo json_encode($data);
?>