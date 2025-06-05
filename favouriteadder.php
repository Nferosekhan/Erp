<?php
include('lcheck.php');
$sqlfavourite=mysqli_query($con, "update pairreportfavourites set reportstatus='".$_GET['reportstatus']."',reporthref='".str_replace('|-|', '&', $_GET['url'])."' where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='".$_GET['reportnames']."'");
if ($sqlfavourite) {
$sqlfavourites = mysqli_query($con,"select * from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportstatus='1'");
if (mysqli_num_rows($sqlfavourites)>0) {
while($fetfavourites = mysqli_fetch_array($sqlfavourites)){
echo '<div class="col-lg-3">
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;">
<span onclick="'.$fetfavourites['reportfunctions'].'()">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<a href="'.$fetfavourites['reporthref'].'" style="color:royalblue;">'.($fetfavourites['reportoriginals']).' 
<svg data-toggle="tooltip" title="Your invoices, ordered by date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</a>
</p>
</div>';
}
}
}
else{
echo "Unstored";
}
?>