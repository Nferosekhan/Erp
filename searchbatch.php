<?php
include('lcheck.php');
if(isset($_GET['productid']))
{
?>
<?php
$sql=mysqli_query($con,"SELECT id, batch, expdate, productrate, mrp, noofpacks, quantity, mrp, vat FROM pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='".$_GET['productid']."'");
$skillData = array();
while($info=mysqli_fetch_array($sql))
{
$ccl="";
$ccl1="";
if($info['expdate']!='')
{
$now = time(); // or your date as well
$your_date = strtotime($info['expdate']);
$datediff = $your_date-$now;
$roun=round($datediff / (60 * 60 * 24));

if($roun<33)
{
$ccl=' (Expires in '.$roun.' Days)';
}
}
$ccl.=' - QTY:'.$info['quantity'];
$data['id'] = $info['id'];
$data['batch'] = $info['batch'];
$data['expdate'] = $info['expdate'];
$data['mrp'] = $info['mrp'];
$data['productrate'] = $info['productrate'];
$data['expdate'] = $info['expdate'];
$data['quantity'] = $info['quantity'];
$data['value'] = (($info['batch']!='')?$info['batch']:'No Batch').(($info['expdate']!='')?' | '.date('d/m/Y',strtotime($info['expdate'])):'').$ccl.$ccl1;;
array_push($skillData, $data);
}
// Return results as json encoded array
echo json_encode($skillData);
}
?>