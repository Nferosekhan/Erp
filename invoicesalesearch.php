<?php
include 'lcheck.php';

if((!isset($_POST['searchTerm']))&&(!isset($_POST['customername']))){
	$fetchData = mysqli_query($con,"select * from paircustomers where customername!='' order by customername limit 200");
}else if(isset($_POST['customername'])){
	$search = mysqli_real_escape_string($con,$_POST['customername']); 
	$fetchData = mysqli_query($con,"select * from paircustomers where id='".$search."' order by customername limit 200");
}else{
	$search = mysqli_real_escape_string($con,$_POST['searchTerm']); 
	$fetchData = mysqli_query($con,"select * from paircustomers where customername like '%".$search."%' limit 200");
}
	 
$data = array();

while ($row = mysqli_fetch_array($fetchData)) {
	 $consigneeid = $row['id'];
      $customername = $row['customername'];
      $workphone = $row['workphone'];
      $balanceamount = $row['balanceamount'];
        $data[] = array("id"=>$row['id'], "text"=>$row['customername'], "html"=>"<table width='100%'><tr><td colspan='2' style='padding:0px;'>".$row['customername']."</td></tr><tr><td style='color:#bbbbbb; font-size:12px;padding:0px;'>Work Phone: ".$row['workphone']."</td><td style='color:#bbbbbb; font-size:12px; text-align:right;padding:0px;'>Amount Receivable: ".$row['balanceamount']."</td></tr>");
}

echo json_encode($data);