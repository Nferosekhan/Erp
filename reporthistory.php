<?php
include('lcheck.php');
// if($_GET['types']=='inv'){
$historydata = $_GET['titles'].'<span style="color:green;" id="prohisfromtospan"> ( Generated )</span><br>'.$_GET['fromto'].'<br>'.$_GET['printdownpdfcsv'].'';
$sqlhistory=mysqli_query($con, "insert into pairusehistory set usetype='REP".$_GET['types']."', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$companymainid', useremarks='$historydata'");
if ($sqlhistory) {
echo "Stored";
}
else{
echo "Unstored";
}
// }
?>