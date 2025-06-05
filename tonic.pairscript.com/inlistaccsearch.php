<?php
include('lcheck.php');
$seloldval = mysqli_query($con,"select optionslist,chartaccounttypelists from pairchartaccounttypes where optionslist!=''");
if (mysqli_num_rows($seloldval)>0) {
while ($fetoldval = mysqli_fetch_array($seloldval)) {
$explodeoptions = explode(';', $fetoldval['optionslist']);
echo '<optgroup label="'.$fetoldval['chartaccounttypelists'].'">';
for($i=0;$i<count($explodeoptions)-1;$i++){
$finalvalues = explode(',',$explodeoptions[$i]);
echo '<option value="'.$finalvalues[0].'">'.$finalvalues[1].'</option>';
echo '<style>
	  li[role="option"][data-select4-id^="select4-data-select4-'.$_GET['idname'].$_GET['lineNo'].'-result-"][data-select4-id$="-'.$finalvalues[0].'"]{
		padding-left: '.$finalvalues[3].'px !important;
	  }';
if ($finalvalues[3]>10) {
echo 'li[role="option"][data-select4-id^="select4-data-select4-'.$_GET['idname'].$_GET['lineNo'].'-result-"][data-select4-id$="-'.$finalvalues[0].'"]:before{
		content: ".";
    	font-size: 2em;
    	display: inline-block;
    	margin-top: -2em;
	  }';
}
echo '</style>';
}
echo '</optgroup>';
}
}
?>