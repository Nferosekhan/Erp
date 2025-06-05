<?php
include('lcheck.php');
if($permissionbooks=='0')
{
  header('Location: dashboard.php');
}
$sqlismainaccessitem=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Items' order by id  asc");
$infomainaccessitem=mysqli_fetch_array($sqlismainaccessitem);
if ($infomainaccessitem['groupaccess']=='0') {
header('Location: preference_billing.php');
}
$sql="SELECT * FROM paircontrols WHERE id='$companymainid';";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if (isset($_POST['submit'])) {
$ch='';
$promodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Products'");
$promodhis=mysqli_fetch_array($promodsql);
$servmodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Services'");
$servmodhis=mysqli_fetch_array($servmodsql);
$invadjmodsql=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' or createdid='$companymainid') and moduletype='Inventory Adjustments'");
$invadjmodhis=mysqli_fetch_array($invadjmodsql);
$productvisible=mysqli_real_escape_string($con, $_POST['defaultvisibleproduct']);
$servicevisible=mysqli_real_escape_string($con, $_POST['defaultvisibleservice']);
if ($promodhis['productvisible']!=$productvisible) {
if ($productvisible=="PUBLIC") {
if ($ch!='') {
$ch.='<br> '.$promodhis['moduletype'].' Visibility <span style="color:green;" id="prohisfromtospan">( From PRIVATE To PUBLIC ) </span>';
}
else{
$ch.=''.$promodhis['moduletype'].' Visibility <span style="color:green;" id="prohisfromtospan">( From PRIVATE To PUBLIC ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$promodhis['moduletype'].' Visibility <span style="color:green;" id="prohisfromtospan">( From PUBLIC To PRIVATE ) </span>';
}
else{
$ch.=''.$promodhis['moduletype'].' Visibility <span style="color:green;" id="prohisfromtospan">( From PUBLIC To PRIVATE ) </span>';
}
}
}
if ($servmodhis['servicevisible']!=$servicevisible) {
if ($servicevisible=="PUBLIC") {
if ($ch!='') {
$ch.='<br> '.$servmodhis['moduletype'].' Visibility <span style="color:green;" id="prohisfromtospan">( From PRIVATE To PUBLIC ) </span>';
}
else{
$ch.=''.$servmodhis['moduletype'].' Visibility <span style="color:green;" id="prohisfromtospan">( From PRIVATE To PUBLIC ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$servmodhis['moduletype'].' Visibility <span style="color:green;" id="prohisfromtospan">( From PUBLIC To PRIVATE ) </span>';
}
else{
$ch.=''.$servmodhis['moduletype'].' Visibility <span style="color:green;" id="prohisfromtospan">( From PUBLIC To PRIVATE ) </span>';
}
}
}
    $txtnamecategory=mysqli_real_escape_string($con, $_POST['txtnamecategory']);

    $proexpdate=mysqli_real_escape_string($con, $_POST['proexpdate']);
    $dashexppro=mysqli_real_escape_string($con, (isset($_POST['dashexppro']))?'1':'0');
    $expinvadj=mysqli_real_escape_string($con, $_POST['expinvadj']);
    $expinvadjcheck=mysqli_real_escape_string($con, (isset($_POST['expinvadjcheck']))?'1':'0');

    $propageload=mysqli_real_escape_string($con, $_POST['propageload']);
    $servpageload=mysqli_real_escape_string($con, $_POST['servpageload']);
    $adjustpageload=mysqli_real_escape_string($con, $_POST['adjustpageload']);

    $stockonhand=mysqli_real_escape_string($con, (isset($_POST['stockonhand']))?'1':'0');
    $proinvadjustment=mysqli_real_escape_string($con, (isset($_POST['proinvadjustment']))?'1':'0');

if($dashexppro!=$access['dashexppro'])
{
if ($dashexppro=="1") {
if($ch!='')
{
$ch.='<br> '.$promodhis['moduletype'].' Expiry Date <span style="color:green;" id="prohisfromtospan">( From Off To On ) </span>';
}
else
{
$ch.=''.$promodhis['moduletype'].' Expiry Date <span style="color:green;" id="prohisfromtospan">( From Off To On ) </span>';
}
}
else{
if($ch!='')
{
$ch.='<br> '.$promodhis['moduletype'].' Expiry Date <span style="color:green;" id="prohisfromtospan">( From On To Off ) </span>';
}
else
{
$ch.=''.$promodhis['moduletype'].' Expiry Date <span style="color:green;" id="prohisfromtospan">( From On To Off ) </span>';
}
}
}
if($proexpdate!=$access['proexpdate'])
{
if($ch!='')
{
$ch.='<br> Expiry date limit <span style="color:green;" id="prohisfromtospan">( From '.$access['proexpdate'].' To '.$proexpdate.' ) </span>';
}
else
{
$ch.='Expiry date limit <span style="color:green;" id="prohisfromtospan">( From '.$access['proexpdate'].' To '.$proexpdate.' ) </span>';
}
}
if($expinvadjcheck!=$access['expinvadjcheck'])
{
if ($expinvadjcheck=="1") {
if($ch!='')
{
$ch.='<br> Expiry '.strtolower($promodhis['moduletype']).' '.strtolower($invadjmodhis['moduletype']).' <span style="color:green;" id="prohisfromtospan">( From Off To On ) </span>';
}
else
{
$ch.='Expiry '.strtolower($promodhis['moduletype']).' '.strtolower($invadjmodhis['moduletype']).' <span style="color:green;" id="prohisfromtospan">( From Off To On ) </span>';
}
}
else{
if($ch!='')
{
$ch.='<br> Expiry '.strtolower($promodhis['moduletype']).' '.strtolower($invadjmodhis['moduletype']).' <span style="color:green;" id="prohisfromtospan">( From On To Off ) </span>';
}
else
{
$ch.='Expiry '.strtolower($promodhis['moduletype']).' '.strtolower($invadjmodhis['moduletype']).' <span style="color:green;" id="prohisfromtospan">( From On To Off ) </span>';
}
}
}
if($expinvadj!=$access['expinvadj'])
{
if($ch!='')
{
$ch.='<br> '.ucfirst($invadjmodhis['moduletype']).' limit <span style="color:green;" id="prohisfromtospan">( From '.$access['expinvadj'].' To '.$expinvadj.' ) </span>';
}
else
{
$ch.=''.ucfirst($invadjmodhis['moduletype']).' limit <span style="color:green;" id="prohisfromtospan">( From '.$access['expinvadj'].' To '.$expinvadj.' ) </span>';
}
}
if($txtnamecategory!=$access['txtnamecategory'])
{
if($ch!='')
{
$ch.='<br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( From '.$access['txtnamecategory'].' To '.$txtnamecategory.' ) </span>';
}
else
{
$ch.=''.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( From '.$access['txtnamecategory'].' To '.$txtnamecategory.' ) </span>';
}
}
if($stockonhand!=$access['stockonhand'])
{
if ($stockonhand=="1") {
if($ch!='')
{
$ch.='<br> Stock on Hand <span style="color:green;" id="prohisfromtospan">( From Off To On ) </span>';
}
else
{
$ch.='Stock on Hand <span style="color:green;" id="prohisfromtospan">( From Off To On ) </span>';
}
}
else{
if($ch!='')
{
$ch.='<br> Stock on Hand <span style="color:green;" id="prohisfromtospan">( From On To Off ) </span>';
}
else
{
$ch.='Stock on Hand <span style="color:green;" id="prohisfromtospan">( From On To Off ) </span>';
}
}
}
if($proinvadjustment!=$access['proinvadjustment'])
{
if ($proinvadjustment=="1") {
if($ch!='')
{
$ch.='<br> '.$promodhis['moduletype'].' '.$invadjmodhis['moduletype'].' <span style="color:green;" id="prohisfromtospan">( From Off To On ) </span>';
}
else
{
$ch.=''.$promodhis['moduletype'].' '.$invadjmodhis['moduletype'].' <span style="color:green;" id="prohisfromtospan">( From Off To On ) </span>';
}
}
else{
if($ch!='')
{
$ch.='<br> '.$promodhis['moduletype'].' '.$invadjmodhis['moduletype'].' <span style="color:green;" id="prohisfromtospan">( From On To Off ) </span>';
}
else
{
$ch.=''.$promodhis['moduletype'].' '.$invadjmodhis['moduletype'].' <span style="color:green;" id="prohisfromtospan">( From On To Off ) </span>';
}
}
}
if ($access['propageload']!=$propageload) {
if ($propageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$promodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$promodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$promodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$promodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['servpageload']!=$servpageload) {
if ($servpageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$servmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$servmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$servmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$servmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}
if ($access['adjustpageload']!=$adjustpageload) {
if ($adjustpageload=="pagenum") {
if ($ch!='') {
$ch.='<br> '.$invadjmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
else{
$ch.=''.$invadjmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Auto Scroll To Page Number ) </span>';
}
}
else{
if ($ch!='') {
$ch.='<br> '.$invadjmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
else{
$ch.=''.$invadjmodhis['moduletype'].' Pages <span style="color:green;" id="prohisfromtospan">( From Page Number To Auto Scroll ) </span>';
}
}
}


    $sqlmainaccessproduct = "update pairmainaccess set productvisible='$productvisible' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Products'"; 
    $sqlmainaccessupproduct = mysqli_query($con, $sqlmainaccessproduct);

    $sqlmainaccessservice = "update pairmainaccess set servicevisible='$servicevisible' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Services'"; 
    $sqlmainaccessupservice = mysqli_query($con, $sqlmainaccessservice);

    $barcodewidth = mysqli_real_escape_string($con, $_POST['barcodewidth']);
    $barcodeheight = mysqli_real_escape_string($con, $_POST['barcodeheight']);
    $barcoderesolution = mysqli_real_escape_string($con, $_POST['barcoderesolution']);


    $sqlaccessup = mysqli_query($con,"update pairaccess set stockonhand='$stockonhand',proinvadjustment='$proinvadjustment',propageload='$propageload',servpageload='$servpageload',adjustpageload='$adjustpageload',txtnamecategory='$txtnamecategory',proexpdate='$proexpdate',dashexppro='$dashexppro',expinvadj='$expinvadj',expinvadjcheck='$expinvadjcheck',barcodewidth='$barcodewidth',barcodeheight='$barcodeheight',barcoderesolution='$barcoderesolution' where createdid='$companymainid'");

            $sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';

 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Products' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."add";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."edit";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."view";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }       
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."col";
                $modcolumncol=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
                if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncol;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncol;
                }
                $modacchis=$coltypemod."col";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }     

              }    
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Products'"; 
                $sqlmainaccessuppro = mysqli_query($con, $sqlmainaccess);
                if ($sqlmainaccessuppro) {
            $sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Services' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addservchanges='';
                $editservchanges='';
                $viewservchanges='';
$sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Services' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Services' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);



                $addservcol=$coltypemod."addserv";
                $addserv=mysqli_real_escape_string($con, (isset($_POST[$addservcol]))?$newmoduleskey:' ');
                $editservcol=$coltypemod."editserv";
                $editserv=mysqli_real_escape_string($con, (isset($_POST[$editservcol]))?$newmoduleskey:' ');
                $viewservcol=$coltypemod."viewserv";
                $viewserv=mysqli_real_escape_string($con, (isset($_POST[$viewservcol]))?$newmoduleskey:' ');
                if($addservchanges!='')
                {
                    $addservchanges.=','.$addserv;
                }
                else
                {
                    $addservchanges.=$addserv;
                }
                if($editservchanges!='')
                {
                    $editservchanges.=','.$editserv;
                }
                else
                {
                    $editservchanges.=$editserv;
                }
                if($viewservchanges!='')
                {
                    $viewservchanges.=','.$viewserv;
                }
                else
                {
                    $viewservchanges.=$viewserv;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addservcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editservcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewservcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }       
            }
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Services' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."colserv";
                $modcolumncol=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
                if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncol;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncol;
                }
                $modacchis=$coltypemod."colserv";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              } 
                $sqlmainaccess = "update pairmainaccess set modulefieldcreate='$addservchanges',modulefieldedit='$editservchanges',modulefieldview='$viewservchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Services'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
              }
              if ($sqlmainaccessup) {
$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Inventory Adjustments' order by id  asc");
            while($infomodules=mysqli_fetch_array($sqlismodules)){
                $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
                $ansmodules = $infomodules[3];
                $newmodules = explode(',',$ansmodules);
            }
                $addchanges='';
                $editchanges='';
                $viewchanges='';
$sqlismoduleshis=mysqli_query($con, "select * from pairmodules where moduletype='Inventory Adjustments' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Inventory Adjustments' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['moduletype']);
    $addhis = $infomainaccesshis[21];
    $addhistory = explode(',',$addhis);
    $edithis = $infomainaccesshis[22];
    $edithistory = explode(',',$edithis);
    $viewhis = $infomainaccesshis[23];
    $viewhistory = explode(',',$viewhis);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
            foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $addcol=$coltypemod."addinven";
                $add=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?$newmoduleskey:' ');
                $editcol=$coltypemod."editinven";
                $edit=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?$newmoduleskey:' ');
                $viewcol=$coltypemod."viewinven";
                $view=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?$newmoduleskey:' ');
                if($addchanges!='')
                {
                    $addchanges.=','.$add;
                }
                else
                {
                    $addchanges.=$add;
                }
                if($editchanges!='')
                {
                    $editchanges.=','.$edit;
                }
                else
                {
                    $editchanges.=$edit;
                }
                if($viewchanges!='')
                {
                    $viewchanges.=','.$view;
                }
                else
                {
                    $viewchanges.=$view;
                }
                $oldaddhis=((in_array($newmoduleskey, $addhistory))?'ENABLE':'DISABLE');
                $newaddhis=mysqli_real_escape_string($con, (isset($_POST[$addcol]))?'ENABLE':'DISABLE');
                $oldedithis=((in_array($newmoduleskey, $edithistory))?'ENABLE':'DISABLE');
                $newedithis=mysqli_real_escape_string($con, (isset($_POST[$editcol]))?'ENABLE':'DISABLE');
                $oldviewhis=((in_array($newmoduleskey, $viewhistory))?'ENABLE':'DISABLE');
                $newviewhis=mysqli_real_escape_string($con, (isset($_POST[$viewcol]))?'ENABLE':'DISABLE');
                if ($oldaddhis=="ENABLE"&&$newaddhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }     
                }
                else if ($oldaddhis=="DISABLE"&&$newaddhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Add <span style="color:green;" id="prohisfromtospan">( From '.$oldaddhis.' To '.$newaddhis.' ) </span>';
                    }        
                }       
                if ($oldedithis=="ENABLE"&&$newedithis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }     
                }
                else if ($oldedithis=="DISABLE"&&$newedithis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' Edit <span style="color:green;" id="prohisfromtospan">( From '.$oldedithis.' To '.$newedithis.' ) </span>';
                    }        
                }
                if ($oldviewhis=="ENABLE"&&$newviewhis=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }     
                }
                else if ($oldviewhis=="DISABLE"&&$newviewhis=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' View <span style="color:green;" id="prohisfromtospan">( From '.$oldviewhis.' To '.$newviewhis.' ) </span>';
                    }        
                }       
            }
                  $sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Inventory Adjustments' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."colinvadj";
                $modcolumncol=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
                if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncol;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncol;
                }
                $modacchis=$coltypemod."colinvadj";
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['moduletype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }

              }
                $sqlmainaccessinvadj = "update pairmainaccess set modulefieldcreate='$addchanges',modulefieldedit='$editchanges',modulefieldview='$viewchanges',modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Inventory Adjustments'"; 
                $sqlmainaccessupinvadj = mysqli_query($con, $sqlmainaccessinvadj);
if($ch!='')
{
$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='Books', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$companymainid', useremarks='".$ch."'");
}
              }
              header('Location:preference_billing.php?remarks=Updated Successfully');
    // $propre=mysqli_real_escape_string($con, (isset($_POST['proinfohead']))?'1':'0');
    // $proinfoadd=mysqli_real_escape_string($con, (isset($_POST['proinfoadd']))?'1':'0');
    // $proinfoedit=mysqli_real_escape_string($con, (isset($_POST['proinfoedit']))?'1':'0');
    // $proinfoview=mysqli_real_escape_string($con, (isset($_POST['proinfoview']))?'1':'0');
    // $prohead=mysqli_real_escape_string($con, (isset($_POST['prohead']))?'1':'0');
    // $servhead=mysqli_real_escape_string($con, (isset($_POST['servhead']))?'1':'0');
    // $proadd=mysqli_real_escape_string($con, (isset($_POST['proadd']))?'1':'0');
    // $proedit=mysqli_real_escape_string($con, (isset($_POST['proedit']))?'1':'0');
    // $proview=mysqli_real_escape_string($con, (isset($_POST['proview']))?'1':'0');
    // $servadd=mysqli_real_escape_string($con, (isset($_POST['servadd']))?'1':'0');
    // $servedit=mysqli_real_escape_string($con, (isset($_POST['servedit']))?'1':'0');
    // $servview=mysqli_real_escape_string($con, (isset($_POST['servview']))?'1':'0');
    // $provishead=mysqli_real_escape_string($con, (isset($_POST['provishead']))?'1':'0');
    // $provisadd=mysqli_real_escape_string($con, (isset($_POST['provisadd']))?'1':'0');
    // $provisedit=mysqli_real_escape_string($con, (isset($_POST['provisedit']))?'1':'0');
    // $provisview=mysqli_real_escape_string($con, (isset($_POST['provisview']))?'1':'0');
    // $proimghead=mysqli_real_escape_string($con, (isset($_POST['proimghead']))?'1':'0');
    // $proimgadd=mysqli_real_escape_string($con, (isset($_POST['proimgadd']))?'1':'0');
    // $proimgedit=mysqli_real_escape_string($con, (isset($_POST['proimgedit']))?'1':'0');
    // $proimgview=mysqli_real_escape_string($con, (isset($_POST['proimgview']))?'1':'0');
    // $propurhead=mysqli_real_escape_string($con, (isset($_POST['propurhead']))?'1':'0');
    // $propuradd=mysqli_real_escape_string($con, (isset($_POST['propuradd']))?'1':'0');
    // $propuredit=mysqli_real_escape_string($con, (isset($_POST['propuredit']))?'1':'0');
    // $propurview=mysqli_real_escape_string($con, (isset($_POST['propurview']))?'1':'0');
    // $prosalehead=mysqli_real_escape_string($con, (isset($_POST['prosalehead']))?'1':'0');
    // $prosaleadd=mysqli_real_escape_string($con, (isset($_POST['prosaleadd']))?'1':'0');
    // $prosaleedit=mysqli_real_escape_string($con, (isset($_POST['prosaleedit']))?'1':'0');
    // $prosaleview=mysqli_real_escape_string($con, (isset($_POST['prosaleview']))?'1':'0');
    // $protaxhead=mysqli_real_escape_string($con, (isset($_POST['protaxhead']))?'1':'0');
    // $protaxadd=mysqli_real_escape_string($con, (isset($_POST['protaxadd']))?'1':'0');
    // $protaxedit=mysqli_real_escape_string($con, (isset($_POST['protaxedit']))?'1':'0');
    // $protaxview=mysqli_real_escape_string($con, (isset($_POST['protaxview']))?'1':'0');
    // $proinvhead=mysqli_real_escape_string($con, (isset($_POST['proinvhead']))?'1':'0');
    // $proinvadd=mysqli_real_escape_string($con, (isset($_POST['proinvadd']))?'1':'0');
    // $proinvedit=mysqli_real_escape_string($con, (isset($_POST['proinvedit']))?'1':'0');
    // $proinvview=mysqli_real_escape_string($con, (isset($_POST['proinvview']))?'1':'0');
    // $prostkhead=mysqli_real_escape_string($con, (isset($_POST['prostkhead']))?'1':'0');
    // $prostkadd=mysqli_real_escape_string($con, (isset($_POST['prostkadd']))?'1':'0');
    // $prostkedit=mysqli_real_escape_string($con, (isset($_POST['prostkedit']))?'1':'0');
    // $prostkview=mysqli_real_escape_string($con, (isset($_POST['prostkview']))?'1':'0');
    // $proothhead=mysqli_real_escape_string($con, (isset($_POST['proothhead']))?'1':'0');
    // $proothadd=mysqli_real_escape_string($con, (isset($_POST['proothadd']))?'1':'0');
    // $proothedit=mysqli_real_escape_string($con, (isset($_POST['proothedit']))?'1':'0');
    // $proothview=mysqli_real_escape_string($con, (isset($_POST['proothview']))?'1':'0');

    // $prounithead=mysqli_real_escape_string($con, (isset($_POST['prounithead']))?'1':'0');
    // $prounitadd=mysqli_real_escape_string($con, (isset($_POST['prounitadd']))?'1':'0');
    // $prounitedit=mysqli_real_escape_string($con, (isset($_POST['prounitedit']))?'1':'0');
    // $prounitview=mysqli_real_escape_string($con, (isset($_POST['prounitview']))?'1':'0');
    // $prohsnhead=mysqli_real_escape_string($con, (isset($_POST['prohsnhead']))?'1':'0');
    // $prohsnadd=mysqli_real_escape_string($con, (isset($_POST['prohsnadd']))?'1':'0');
    // $prohsnedit=mysqli_real_escape_string($con, (isset($_POST['prohsnedit']))?'1':'0');
    // $prohsnview=mysqli_real_escape_string($con, (isset($_POST['prohsnview']))?'1':'0');
    // $proskuhead=mysqli_real_escape_string($con, (isset($_POST['proskuhead']))?'1':'0');
    // $proskuadd=mysqli_real_escape_string($con, (isset($_POST['proskuadd']))?'1':'0');
    // $proskuedit=mysqli_real_escape_string($con, (isset($_POST['proskuedit']))?'1':'0');
    // $proskuview=mysqli_real_escape_string($con, (isset($_POST['proskuview']))?'1':'0');
    // $proupchead=mysqli_real_escape_string($con, (isset($_POST['proupchead']))?'1':'0');
    // $proupcadd=mysqli_real_escape_string($con, (isset($_POST['proupcadd']))?'1':'0');
    // $proupcedit=mysqli_real_escape_string($con, (isset($_POST['proupcedit']))?'1':'0');
    // $proupcview=mysqli_real_escape_string($con, (isset($_POST['proupcview']))?'1':'0');
    // $proeanhead=mysqli_real_escape_string($con, (isset($_POST['proeanhead']))?'1':'0');
    // $proeanadd=mysqli_real_escape_string($con, (isset($_POST['proeanadd']))?'1':'0');
    // $proeanedit=mysqli_real_escape_string($con, (isset($_POST['proeanedit']))?'1':'0');
    // $proeanview=mysqli_real_escape_string($con, (isset($_POST['proeanview']))?'1':'0');
    // $prompnhead=mysqli_real_escape_string($con, (isset($_POST['prompnhead']))?'1':'0');
    // $prompnadd=mysqli_real_escape_string($con, (isset($_POST['prompnadd']))?'1':'0');
    // $prompnedit=mysqli_real_escape_string($con, (isset($_POST['prompnedit']))?'1':'0');
    // $prompnview=mysqli_real_escape_string($con, (isset($_POST['prompnview']))?'1':'0');
    // $proisbhead=mysqli_real_escape_string($con, (isset($_POST['proisbhead']))?'1':'0');
    // $proisbadd=mysqli_real_escape_string($con, (isset($_POST['proisbadd']))?'1':'0');
    // $proisbedit=mysqli_real_escape_string($con, (isset($_POST['proisbedit']))?'1':'0');
    // $proisbview=mysqli_real_escape_string($con, (isset($_POST['proisbview']))?'1':'0');
    // $probranhead=mysqli_real_escape_string($con, (isset($_POST['probranhead']))?'1':'0');
    // $probranadd=mysqli_real_escape_string($con, (isset($_POST['probranadd']))?'1':'0');
    // $probranedit=mysqli_real_escape_string($con, (isset($_POST['probranedit']))?'1':'0');
    // $probranview=mysqli_real_escape_string($con, (isset($_POST['probranview']))?'1':'0');
    // $promanhead=mysqli_real_escape_string($con, (isset($_POST['promanhead']))?'1':'0');
    // $promanadd=mysqli_real_escape_string($con, (isset($_POST['promanadd']))?'1':'0');
    // $promanedit=mysqli_real_escape_string($con, (isset($_POST['promanedit']))?'1':'0');
    // $promanview=mysqli_real_escape_string($con, (isset($_POST['promanview']))?'1':'0');
    // $promolhead=mysqli_real_escape_string($con, (isset($_POST['promolhead']))?'1':'0');
    // $promoladd=mysqli_real_escape_string($con, (isset($_POST['promoladd']))?'1':'0');
    // $promoledit=mysqli_real_escape_string($con, (isset($_POST['promoledit']))?'1':'0');
    // $promolview=mysqli_real_escape_string($con, (isset($_POST['promolview']))?'1':'0');
    // $progenhead=mysqli_real_escape_string($con, (isset($_POST['progenhead']))?'1':'0');
    // $progenadd=mysqli_real_escape_string($con, (isset($_POST['progenadd']))?'1':'0');
    // $progenedit=mysqli_real_escape_string($con, (isset($_POST['progenedit']))?'1':'0');
    // $progenview=mysqli_real_escape_string($con, (isset($_POST['progenview']))?'1':'0');
    // $prosalthead=mysqli_real_escape_string($con, (isset($_POST['prosalthead']))?'1':'0');
    // $prosaltadd=mysqli_real_escape_string($con, (isset($_POST['prosaltadd']))?'1':'0');
    // $prosaltedit=mysqli_real_escape_string($con, (isset($_POST['prosaltedit']))?'1':'0');
    // $prosaltview=mysqli_real_escape_string($con, (isset($_POST['prosaltview']))?'1':'0');
    // $proconshead=mysqli_real_escape_string($con, (isset($_POST['proconshead']))?'1':'0');
    // $proconsadd=mysqli_real_escape_string($con, (isset($_POST['proconsadd']))?'1':'0');
    // $proconsedit=mysqli_real_escape_string($con, (isset($_POST['proconsedit']))?'1':'0');
    // $proconsview=mysqli_real_escape_string($con, (isset($_POST['proconsview']))?'1':'0');
    // $procathead=mysqli_real_escape_string($con, (isset($_POST['procathead']))?'1':'0');
    // $procatadd=mysqli_real_escape_string($con, (isset($_POST['procatadd']))?'1':'0');
    // $procatedit=mysqli_real_escape_string($con, (isset($_POST['procatedit']))?'1':'0');
    // $procatview=mysqli_real_escape_string($con, (isset($_POST['procatview']))?'1':'0');
    // $prosubhead=mysqli_real_escape_string($con, (isset($_POST['prosubhead']))?'1':'0');
    // $prosubadd=mysqli_real_escape_string($con, (isset($_POST['prosubadd']))?'1':'0');
    // $prosubedit=mysqli_real_escape_string($con, (isset($_POST['prosubedit']))?'1':'0');
    // $prosubview=mysqli_real_escape_string($con, (isset($_POST['prosubview']))?'1':'0');
    // $prodimhead=mysqli_real_escape_string($con, (isset($_POST['prodimhead']))?'1':'0');
    // $prodimadd=mysqli_real_escape_string($con, (isset($_POST['prodimadd']))?'1':'0');
    // $prodimedit=mysqli_real_escape_string($con, (isset($_POST['prodimedit']))?'1':'0');
    // $prodimview=mysqli_real_escape_string($con, (isset($_POST['prodimview']))?'1':'0');
    // $proweihead=mysqli_real_escape_string($con, (isset($_POST['proweihead']))?'1':'0');
    // $proweiadd=mysqli_real_escape_string($con, (isset($_POST['proweiadd']))?'1':'0');
    // $proweiedit=mysqli_real_escape_string($con, (isset($_POST['proweiedit']))?'1':'0');
    // $proweiview=mysqli_real_escape_string($con, (isset($_POST['proweiview']))?'1':'0');
    // $prorackhead=mysqli_real_escape_string($con, (isset($_POST['prorackhead']))?'1':'0');
    // $prorackadd=mysqli_real_escape_string($con, (isset($_POST['prorackadd']))?'1':'0');
    // $prorackedit=mysqli_real_escape_string($con, (isset($_POST['prorackedit']))?'1':'0');
    // $prorackview=mysqli_real_escape_string($con, (isset($_POST['prorackview']))?'1':'0');
    // $prodeshead=mysqli_real_escape_string($con, (isset($_POST['prodeshead']))?'1':'0');
    // $prodesadd=mysqli_real_escape_string($con, (isset($_POST['prodesadd']))?'1':'0');
    // $prodesedit=mysqli_real_escape_string($con, (isset($_POST['prodesedit']))?'1':'0');
    // $prodesview=mysqli_real_escape_string($con, (isset($_POST['prodesview']))?'1':'0');

    // $prodelhead=mysqli_real_escape_string($con, (isset($_POST['prodelhead']))?'1':'0');
    // $prodeladd=mysqli_real_escape_string($con, (isset($_POST['prodeladd']))?'1':'0');
    // $prodeledit=mysqli_real_escape_string($con, (isset($_POST['prodeledit']))?'1':'0');
    // $prodelview=mysqli_real_escape_string($con, (isset($_POST['prodelview']))?'1':'0');

    // $productcodehead=mysqli_real_escape_string($con, (isset($_POST['productcodehead']))?'1':'0');
    // $productcodeadd=mysqli_real_escape_string($con, (isset($_POST['productcodeadd']))?'1':'0');
    // $productcodeedit=mysqli_real_escape_string($con, (isset($_POST['productcodeedit']))?'1':'0');
    // $productcodeview=mysqli_real_escape_string($con, (isset($_POST['productcodeview']))?'1':'0');

    // $protaxprefer=mysqli_real_escape_string($con, (isset($_POST['protaxpreferhead']))?'1':'0');
    // $protaxpreferadd=mysqli_real_escape_string($con, (isset($_POST['protaxpreferadd']))?'1':'0');
    // $protaxpreferedit=mysqli_real_escape_string($con, (isset($_POST['protaxpreferedit']))?'1':'0');
    // $protaxpreferview=mysqli_real_escape_string($con, (isset($_POST['protaxpreferview']))?'1':'0');
    // $protaxrate=mysqli_real_escape_string($con, (isset($_POST['protaxratehead']))?'1':'0');
    // $protaxrateadd=mysqli_real_escape_string($con, (isset($_POST['protaxrateadd']))?'1':'0');
    // $protaxrateedit=mysqli_real_escape_string($con, (isset($_POST['protaxrateedit']))?'1':'0');
    // $protaxrateview=mysqli_real_escape_string($con, (isset($_POST['protaxrateview']))?'1':'0');
    // $prointratax=mysqli_real_escape_string($con, (isset($_POST['prointrataxhead']))?'1':'0');
    // $prointrataxadd=mysqli_real_escape_string($con, (isset($_POST['prointrataxadd']))?'1':'0');
    // $prointrataxedit=mysqli_real_escape_string($con, (isset($_POST['prointrataxedit']))?'1':'0');
    // $prointrataxview=mysqli_real_escape_string($con, (isset($_POST['prointrataxview']))?'1':'0');
    // $prointertax=mysqli_real_escape_string($con, (isset($_POST['prointertaxhead']))?'1':'0');
    // $prointertaxadd=mysqli_real_escape_string($con, (isset($_POST['prointertaxadd']))?'1':'0');
    // $prointertaxedit=mysqli_real_escape_string($con, (isset($_POST['prointertaxedit']))?'1':'0');
    // $prointertaxview=mysqli_real_escape_string($con, (isset($_POST['prointertaxview']))?'1':'0');

    // $prolistname=mysqli_real_escape_string($con, (isset($_POST['prolistnamehead']))?'1':'0');
    // $prolistcode=mysqli_real_escape_string($con, (isset($_POST['prolistcodehead']))?'1':'0');
    // $prolistcat=mysqli_real_escape_string($con, (isset($_POST['prolistcathead']))?'1':'0');
    // $prolistunit=mysqli_real_escape_string($con, (isset($_POST['prolistunithead']))?'1':'0');
    // $prolistdes=mysqli_real_escape_string($con, (isset($_POST['prolistdeshead']))?'1':'0');
    // $prolistdel=mysqli_real_escape_string($con, (isset($_POST['prolistdelhead']))?'1':'0');
    // $prolistprice=mysqli_real_escape_string($con, (isset($_POST['prolistpricehead']))?'1':'0');
    // $prolistinttax=mysqli_real_escape_string($con, (isset($_POST['prolistinttaxhead']))?'1':'0');
    // $prolistvis=mysqli_real_escape_string($con, (isset($_POST['prolistvishead']))?'1':'0');
    // $proliststatus=mysqli_real_escape_string($con, (isset($_POST['proliststatushead']))?'1':'0');

    // $salepricenamehead=mysqli_real_escape_string($con, (isset($_POST['salepricenamehead']))?'1':'0');
    // $salepricenameadd=mysqli_real_escape_string($con, (isset($_POST['salepricenameadd']))?'1':'0');
    // $salepricenameedit=mysqli_real_escape_string($con, (isset($_POST['salepricenameedit']))?'1':'0');
    // $salepricenameview=mysqli_real_escape_string($con, (isset($_POST['salepricenameview']))?'1':'0');
    // $salemrphead=mysqli_real_escape_string($con, (isset($_POST['salemrphead']))?'1':'0');
    // $salemrpadd=mysqli_real_escape_string($con, (isset($_POST['salemrpadd']))?'1':'0');
    // $salemrpedit=mysqli_real_escape_string($con, (isset($_POST['salemrpedit']))?'1':'0');
    // $salemrpview=mysqli_real_escape_string($con, (isset($_POST['salemrpview']))?'1':'0');
    // $salepriceratehead=mysqli_real_escape_string($con, (isset($_POST['salepriceratehead']))?'1':'0');
    // $salepricerateadd=mysqli_real_escape_string($con, (isset($_POST['salepricerateadd']))?'1':'0');
    // $salepricerateedit=mysqli_real_escape_string($con, (isset($_POST['salepricerateedit']))?'1':'0');
    // $salepricerateview=mysqli_real_escape_string($con, (isset($_POST['salepricerateview']))?'1':'0');
    // $saledescriptionhead=mysqli_real_escape_string($con, (isset($_POST['saledescriptionhead']))?'1':'0');
    // $saledescriptionadd=mysqli_real_escape_string($con, (isset($_POST['saledescriptionadd']))?'1':'0');
    // $saledescriptionedit=mysqli_real_escape_string($con, (isset($_POST['saledescriptionedit']))?'1':'0');
    // $saledescriptionview=mysqli_real_escape_string($con, (isset($_POST['saledescriptionview']))?'1':'0');

    // $purpricenamehead=mysqli_real_escape_string($con, (isset($_POST['purpricenamehead']))?'1':'0');
    // $purpricenameadd=mysqli_real_escape_string($con, (isset($_POST['purpricenameadd']))?'1':'0');
    // $purpricenameedit=mysqli_real_escape_string($con, (isset($_POST['purpricenameedit']))?'1':'0');
    // $purpricenameview=mysqli_real_escape_string($con, (isset($_POST['purpricenameview']))?'1':'0');
    // $purmrphead=mysqli_real_escape_string($con, (isset($_POST['purmrphead']))?'1':'0');
    // $purmrpadd=mysqli_real_escape_string($con, (isset($_POST['purmrpadd']))?'1':'0');
    // $purmrpedit=mysqli_real_escape_string($con, (isset($_POST['purmrpedit']))?'1':'0');
    // $purmrpview=mysqli_real_escape_string($con, (isset($_POST['purmrpview']))?'1':'0');
    // $purpriceratehead=mysqli_real_escape_string($con, (isset($_POST['purpriceratehead']))?'1':'0');
    // $purpricerateadd=mysqli_real_escape_string($con, (isset($_POST['purpricerateadd']))?'1':'0');
    // $purpricerateedit=mysqli_real_escape_string($con, (isset($_POST['purpricerateedit']))?'1':'0');
    // $purpricerateview=mysqli_real_escape_string($con, (isset($_POST['purpricerateview']))?'1':'0');
    // $purdescriptionhead=mysqli_real_escape_string($con, (isset($_POST['purdescriptionhead']))?'1':'0');
    // $purdescriptionadd=mysqli_real_escape_string($con, (isset($_POST['purdescriptionadd']))?'1':'0');
    // $purdescriptionedit=mysqli_real_escape_string($con, (isset($_POST['purdescriptionedit']))?'1':'0');
    // $purdescriptionview=mysqli_real_escape_string($con, (isset($_POST['purdescriptionview']))?'1':'0');

    // $servsalepricenamehead=mysqli_real_escape_string($con, (isset($_POST['servsalepricenamehead']))?'1':'0');
    // $servsalepricenameadd=mysqli_real_escape_string($con, (isset($_POST['servsalepricenameadd']))?'1':'0');
    // $servsalepricenameedit=mysqli_real_escape_string($con, (isset($_POST['servsalepricenameedit']))?'1':'0');
    // $servsalepricenameview=mysqli_real_escape_string($con, (isset($_POST['servsalepricenameview']))?'1':'0');
    // $servsalemrphead=mysqli_real_escape_string($con, (isset($_POST['servsalemrphead']))?'1':'0');
    // $servsalemrpadd=mysqli_real_escape_string($con, (isset($_POST['servsalemrpadd']))?'1':'0');
    // $servsalemrpedit=mysqli_real_escape_string($con, (isset($_POST['servsalemrpedit']))?'1':'0');
    // $servsalemrpview=mysqli_real_escape_string($con, (isset($_POST['servsalemrpview']))?'1':'0');
    // $servsalepriceratehead=mysqli_real_escape_string($con, (isset($_POST['servsalepriceratehead']))?'1':'0');
    // $servsalepricerateadd=mysqli_real_escape_string($con, (isset($_POST['servsalepricerateadd']))?'1':'0');
    // $servsalepricerateedit=mysqli_real_escape_string($con, (isset($_POST['servsalepricerateedit']))?'1':'0');
    // $servsalepricerateview=mysqli_real_escape_string($con, (isset($_POST['servsalepricerateview']))?'1':'0');
    // $servsaledescriptionhead=mysqli_real_escape_string($con, (isset($_POST['servsaledescriptionhead']))?'1':'0');
    // $servsaledescriptionadd=mysqli_real_escape_string($con, (isset($_POST['servsaledescriptionadd']))?'1':'0');
    // $servsaledescriptionedit=mysqli_real_escape_string($con, (isset($_POST['servsaledescriptionedit']))?'1':'0');
    // $servsaledescriptionview=mysqli_real_escape_string($con, (isset($_POST['servsaledescriptionview']))?'1':'0');

    // $servpurpricenamehead=mysqli_real_escape_string($con, (isset($_POST['servpurpricenamehead']))?'1':'0');
    // $servpurpricenameadd=mysqli_real_escape_string($con, (isset($_POST['servpurpricenameadd']))?'1':'0');
    // $servpurpricenameedit=mysqli_real_escape_string($con, (isset($_POST['servpurpricenameedit']))?'1':'0');
    // $servpurpricenameview=mysqli_real_escape_string($con, (isset($_POST['servpurpricenameview']))?'1':'0');
    // $servpurmrphead=mysqli_real_escape_string($con, (isset($_POST['servpurmrphead']))?'1':'0');
    // $servpurmrpadd=mysqli_real_escape_string($con, (isset($_POST['servpurmrpadd']))?'1':'0');
    // $servpurmrpedit=mysqli_real_escape_string($con, (isset($_POST['servpurmrpedit']))?'1':'0');
    // $servpurmrpview=mysqli_real_escape_string($con, (isset($_POST['servpurmrpview']))?'1':'0');
    // $servpurpriceratehead=mysqli_real_escape_string($con, (isset($_POST['servpurpriceratehead']))?'1':'0');
    // $servpurpricerateadd=mysqli_real_escape_string($con, (isset($_POST['servpurpricerateadd']))?'1':'0');
    // $servpurpricerateedit=mysqli_real_escape_string($con, (isset($_POST['servpurpricerateedit']))?'1':'0');
    // $servpurpricerateview=mysqli_real_escape_string($con, (isset($_POST['servpurpricerateview']))?'1':'0');
    // $servpurdescriptionhead=mysqli_real_escape_string($con, (isset($_POST['servpurdescriptionhead']))?'1':'0');
    // $servpurdescriptionadd=mysqli_real_escape_string($con, (isset($_POST['servpurdescriptionadd']))?'1':'0');
    // $servpurdescriptionedit=mysqli_real_escape_string($con, (isset($_POST['servpurdescriptionedit']))?'1':'0');
    // $servpurdescriptionview=mysqli_real_escape_string($con, (isset($_POST['servpurdescriptionview']))?'1':'0');


    // $servinfohead=mysqli_real_escape_string($con, (isset($_POST['servinfohead']))?'1':'0');
    // $servinfoadd=mysqli_real_escape_string($con, (isset($_POST['servinfoadd']))?'1':'0');
    // $servinfoedit=mysqli_real_escape_string($con, (isset($_POST['servinfoedit']))?'1':'0');
    // $servinfoview=mysqli_real_escape_string($con, (isset($_POST['servinfoview']))?'1':'0');
    // $servcodehead=mysqli_real_escape_string($con, (isset($_POST['servcodehead']))?'1':'0');
    // $servcodeadd=mysqli_real_escape_string($con, (isset($_POST['servcodeadd']))?'1':'0');
    // $servcodeedit=mysqli_real_escape_string($con, (isset($_POST['servcodeedit']))?'1':'0');
    // $servcodeview=mysqli_real_escape_string($con, (isset($_POST['servcodeview']))?'1':'0');
    // $servnhead=mysqli_real_escape_string($con, (isset($_POST['servnhead']))?'1':'0');
    // $servnadd=mysqli_real_escape_string($con, (isset($_POST['servnadd']))?'1':'0');
    // $servnedit=mysqli_real_escape_string($con, (isset($_POST['servnedit']))?'1':'0');
    // $servnview=mysqli_real_escape_string($con, (isset($_POST['servnview']))?'1':'0');
    // $servchead=mysqli_real_escape_string($con, (isset($_POST['servchead']))?'1':'0');
    // $servcadd=mysqli_real_escape_string($con, (isset($_POST['servcadd']))?'1':'0');
    // $servcedit=mysqli_real_escape_string($con, (isset($_POST['servcedit']))?'1':'0');
    // $servcview=mysqli_real_escape_string($con, (isset($_POST['servcview']))?'1':'0');
    // $servunithead=mysqli_real_escape_string($con, (isset($_POST['servunithead']))?'1':'0');
    // $servunitadd=mysqli_real_escape_string($con, (isset($_POST['servunitadd']))?'1':'0');
    // $servunitedit=mysqli_real_escape_string($con, (isset($_POST['servunitedit']))?'1':'0');
    // $servunitview=mysqli_real_escape_string($con, (isset($_POST['servunitview']))?'1':'0');
    // $servhsnhead=mysqli_real_escape_string($con, (isset($_POST['servhsnhead']))?'1':'0');
    // $servhsnadd=mysqli_real_escape_string($con, (isset($_POST['servhsnadd']))?'1':'0');
    // $servhsnedit=mysqli_real_escape_string($con, (isset($_POST['servhsnedit']))?'1':'0');
    // $servhsnview=mysqli_real_escape_string($con, (isset($_POST['servhsnview']))?'1':'0');
    // $servskuhead=mysqli_real_escape_string($con, (isset($_POST['servskuhead']))?'1':'0');
    // $servskuadd=mysqli_real_escape_string($con, (isset($_POST['servskuadd']))?'1':'0');
    // $servskuedit=mysqli_real_escape_string($con, (isset($_POST['servskuedit']))?'1':'0');
    // $servskuview=mysqli_real_escape_string($con, (isset($_POST['servskuview']))?'1':'0');
    // $servupchead=mysqli_real_escape_string($con, (isset($_POST['servupchead']))?'1':'0');
    // $servupcadd=mysqli_real_escape_string($con, (isset($_POST['servupcadd']))?'1':'0');
    // $servupcedit=mysqli_real_escape_string($con, (isset($_POST['servupcedit']))?'1':'0');
    // $servupcview=mysqli_real_escape_string($con, (isset($_POST['servupcview']))?'1':'0');
    // $serveanhead=mysqli_real_escape_string($con, (isset($_POST['serveanhead']))?'1':'0');
    // $serveanadd=mysqli_real_escape_string($con, (isset($_POST['serveanadd']))?'1':'0');
    // $serveanedit=mysqli_real_escape_string($con, (isset($_POST['serveanedit']))?'1':'0');
    // $serveanview=mysqli_real_escape_string($con, (isset($_POST['serveanview']))?'1':'0');
    // $servmpnhead=mysqli_real_escape_string($con, (isset($_POST['servmpnhead']))?'1':'0');
    // $servmpnadd=mysqli_real_escape_string($con, (isset($_POST['servmpnadd']))?'1':'0');
    // $servmpnedit=mysqli_real_escape_string($con, (isset($_POST['servmpnedit']))?'1':'0');
    // $servmpnview=mysqli_real_escape_string($con, (isset($_POST['servmpnview']))?'1':'0');
    // $servisbhead=mysqli_real_escape_string($con, (isset($_POST['servisbhead']))?'1':'0');
    // $servisbadd=mysqli_real_escape_string($con, (isset($_POST['servisbadd']))?'1':'0');
    // $servisbedit=mysqli_real_escape_string($con, (isset($_POST['servisbedit']))?'1':'0');
    // $servisbview=mysqli_real_escape_string($con, (isset($_POST['servisbview']))?'1':'0');
    // $servbranhead=mysqli_real_escape_string($con, (isset($_POST['servbranhead']))?'1':'0');
    // $servbranadd=mysqli_real_escape_string($con, (isset($_POST['servbranadd']))?'1':'0');
    // $servbranedit=mysqli_real_escape_string($con, (isset($_POST['servbranedit']))?'1':'0');
    // $servbranview=mysqli_real_escape_string($con, (isset($_POST['servbranview']))?'1':'0');
    // $servmanhead=mysqli_real_escape_string($con, (isset($_POST['servmanhead']))?'1':'0');
    // $servmanadd=mysqli_real_escape_string($con, (isset($_POST['servmanadd']))?'1':'0');
    // $servmanedit=mysqli_real_escape_string($con, (isset($_POST['servmanedit']))?'1':'0');
    // $servmanview=mysqli_real_escape_string($con, (isset($_POST['servmanview']))?'1':'0');
    // $servmolhead=mysqli_real_escape_string($con, (isset($_POST['servmolhead']))?'1':'0');
    // $servmoladd=mysqli_real_escape_string($con, (isset($_POST['servmoladd']))?'1':'0');
    // $servmoledit=mysqli_real_escape_string($con, (isset($_POST['servmoledit']))?'1':'0');
    // $servmolview=mysqli_real_escape_string($con, (isset($_POST['servmolview']))?'1':'0');
    // $servgenhead=mysqli_real_escape_string($con, (isset($_POST['servgenhead']))?'1':'0');
    // $servgenadd=mysqli_real_escape_string($con, (isset($_POST['servgenadd']))?'1':'0');
    // $servgenedit=mysqli_real_escape_string($con, (isset($_POST['servgenedit']))?'1':'0');
    // $servgenview=mysqli_real_escape_string($con, (isset($_POST['servgenview']))?'1':'0');
    // $servsalthead=mysqli_real_escape_string($con, (isset($_POST['servsalthead']))?'1':'0');
    // $servsaltadd=mysqli_real_escape_string($con, (isset($_POST['servsaltadd']))?'1':'0');
    // $servsaltedit=mysqli_real_escape_string($con, (isset($_POST['servsaltedit']))?'1':'0');
    // $servsaltview=mysqli_real_escape_string($con, (isset($_POST['servsaltview']))?'1':'0');
    // $servconshead=mysqli_real_escape_string($con, (isset($_POST['servconshead']))?'1':'0');
    // $servconsadd=mysqli_real_escape_string($con, (isset($_POST['servconsadd']))?'1':'0');
    // $servconsedit=mysqli_real_escape_string($con, (isset($_POST['servconsedit']))?'1':'0');
    // $servconsview=mysqli_real_escape_string($con, (isset($_POST['servconsview']))?'1':'0');
    // $servcathead=mysqli_real_escape_string($con, (isset($_POST['servcathead']))?'1':'0');
    // $servcatadd=mysqli_real_escape_string($con, (isset($_POST['servcatadd']))?'1':'0');
    // $servcatedit=mysqli_real_escape_string($con, (isset($_POST['servcatedit']))?'1':'0');
    // $servcatview=mysqli_real_escape_string($con, (isset($_POST['servcatview']))?'1':'0');
    // $servsubhead=mysqli_real_escape_string($con, (isset($_POST['servsubhead']))?'1':'0');
    // $servsubadd=mysqli_real_escape_string($con, (isset($_POST['servsubadd']))?'1':'0');
    // $servsubedit=mysqli_real_escape_string($con, (isset($_POST['servsubedit']))?'1':'0');
    // $servsubview=mysqli_real_escape_string($con, (isset($_POST['servsubview']))?'1':'0');
    // $servdimhead=mysqli_real_escape_string($con, (isset($_POST['servdimhead']))?'1':'0');
    // $servdimadd=mysqli_real_escape_string($con, (isset($_POST['servdimadd']))?'1':'0');
    // $servdimedit=mysqli_real_escape_string($con, (isset($_POST['servdimedit']))?'1':'0');
    // $servdimview=mysqli_real_escape_string($con, (isset($_POST['servdimview']))?'1':'0');
    // $servweihead=mysqli_real_escape_string($con, (isset($_POST['servweihead']))?'1':'0');
    // $servweiadd=mysqli_real_escape_string($con, (isset($_POST['servweiadd']))?'1':'0');
    // $servweiedit=mysqli_real_escape_string($con, (isset($_POST['servweiedit']))?'1':'0');
    // $servweiview=mysqli_real_escape_string($con, (isset($_POST['servweiview']))?'1':'0');
    // $servrackhead=mysqli_real_escape_string($con, (isset($_POST['servrackhead']))?'1':'0');
    // $servrackadd=mysqli_real_escape_string($con, (isset($_POST['servrackadd']))?'1':'0');
    // $servrackedit=mysqli_real_escape_string($con, (isset($_POST['servrackedit']))?'1':'0');
    // $servrackview=mysqli_real_escape_string($con, (isset($_POST['servrackview']))?'1':'0');
    // $servdeshead=mysqli_real_escape_string($con, (isset($_POST['servdeshead']))?'1':'0');
    // $servdesadd=mysqli_real_escape_string($con, (isset($_POST['servdesadd']))?'1':'0');
    // $servdesedit=mysqli_real_escape_string($con, (isset($_POST['servdesedit']))?'1':'0');
    // $servdesview=mysqli_real_escape_string($con, (isset($_POST['servdesview']))?'1':'0');

    // $servdelhead=mysqli_real_escape_string($con, (isset($_POST['servdelhead']))?'1':'0');
    // $servdeladd=mysqli_real_escape_string($con, (isset($_POST['servdeladd']))?'1':'0');
    // $servdeledit=mysqli_real_escape_string($con, (isset($_POST['servdeledit']))?'1':'0');
    // $servdelview=mysqli_real_escape_string($con, (isset($_POST['servdelview']))?'1':'0');

    // $servvishead=mysqli_real_escape_string($con, (isset($_POST['servvishead']))?'1':'0');
    // $servvisadd=mysqli_real_escape_string($con, (isset($_POST['servvisadd']))?'1':'0');
    // $servvisedit=mysqli_real_escape_string($con, (isset($_POST['servvisedit']))?'1':'0');
    // $servvisview=mysqli_real_escape_string($con, (isset($_POST['servvisview']))?'1':'0');
    // $servimghead=mysqli_real_escape_string($con, (isset($_POST['servimghead']))?'1':'0');
    // $servimgadd=mysqli_real_escape_string($con, (isset($_POST['servimgadd']))?'1':'0');
    // $servimgedit=mysqli_real_escape_string($con, (isset($_POST['servimgedit']))?'1':'0');
    // $servimgview=mysqli_real_escape_string($con, (isset($_POST['servimgview']))?'1':'0');
    // $servpurhead=mysqli_real_escape_string($con, (isset($_POST['servpurhead']))?'1':'0');
    // $servpuradd=mysqli_real_escape_string($con, (isset($_POST['servpuradd']))?'1':'0');
    // $servpuredit=mysqli_real_escape_string($con, (isset($_POST['servpuredit']))?'1':'0');
    // $servpurview=mysqli_real_escape_string($con, (isset($_POST['servpurview']))?'1':'0');
    // $servsalehead=mysqli_real_escape_string($con, (isset($_POST['servsalehead']))?'1':'0');
    // $servsaleadd=mysqli_real_escape_string($con, (isset($_POST['servsaleadd']))?'1':'0');
    // $servsaleedit=mysqli_real_escape_string($con, (isset($_POST['servsaleedit']))?'1':'0');
    // $servsaleview=mysqli_real_escape_string($con, (isset($_POST['servsaleview']))?'1':'0');
    // $servtaxhead=mysqli_real_escape_string($con, (isset($_POST['servtaxhead']))?'1':'0');
    // $servtaxadd=mysqli_real_escape_string($con, (isset($_POST['servtaxadd']))?'1':'0');
    // $servtaxedit=mysqli_real_escape_string($con, (isset($_POST['servtaxedit']))?'1':'0');
    // $servtaxview=mysqli_real_escape_string($con, (isset($_POST['servtaxview']))?'1':'0');
    // $servinvhead=mysqli_real_escape_string($con, (isset($_POST['servinvhead']))?'1':'0');
    // $servinvadd=mysqli_real_escape_string($con, (isset($_POST['servinvadd']))?'1':'0');
    // $servinvedit=mysqli_real_escape_string($con, (isset($_POST['servinvedit']))?'1':'0');
    // $servinvview=mysqli_real_escape_string($con, (isset($_POST['servinvview']))?'1':'0');
    // $servstkhead=mysqli_real_escape_string($con, (isset($_POST['servstkhead']))?'1':'0');
    // $servstkadd=mysqli_real_escape_string($con, (isset($_POST['servstkadd']))?'1':'0');
    // $servstkedit=mysqli_real_escape_string($con, (isset($_POST['servstkedit']))?'1':'0');
    // $servstkview=mysqli_real_escape_string($con, (isset($_POST['servstkview']))?'1':'0');
    // $servothhead=mysqli_real_escape_string($con, (isset($_POST['servothhead']))?'1':'0');
    // $servothadd=mysqli_real_escape_string($con, (isset($_POST['servothadd']))?'1':'0');
    // $servothedit=mysqli_real_escape_string($con, (isset($_POST['servothedit']))?'1':'0');
    // $servothview=mysqli_real_escape_string($con, (isset($_POST['servothview']))?'1':'0');

    // $servtaxprefer=mysqli_real_escape_string($con, (isset($_POST['servtaxpreferhead']))?'1':'0');
    // $servtaxpreferadd=mysqli_real_escape_string($con, (isset($_POST['servtaxpreferadd']))?'1':'0');
    // $servtaxpreferedit=mysqli_real_escape_string($con, (isset($_POST['servtaxpreferedit']))?'1':'0');
    // $servtaxpreferview=mysqli_real_escape_string($con, (isset($_POST['servtaxpreferview']))?'1':'0');
    // $servtaxrate=mysqli_real_escape_string($con, (isset($_POST['servtaxratehead']))?'1':'0');
    // $servtaxrateadd=mysqli_real_escape_string($con, (isset($_POST['servtaxrateadd']))?'1':'0');
    // $servtaxrateedit=mysqli_real_escape_string($con, (isset($_POST['servtaxrateedit']))?'1':'0');
    // $servtaxrateview=mysqli_real_escape_string($con, (isset($_POST['servtaxrateview']))?'1':'0');
    // $servintratax=mysqli_real_escape_string($con, (isset($_POST['servintrataxhead']))?'1':'0');
    // $servintrataxadd=mysqli_real_escape_string($con, (isset($_POST['servintrataxadd']))?'1':'0');
    // $servintrataxedit=mysqli_real_escape_string($con, (isset($_POST['servintrataxedit']))?'1':'0');
    // $servintrataxview=mysqli_real_escape_string($con, (isset($_POST['servintrataxview']))?'1':'0');
    // $servintertax=mysqli_real_escape_string($con, (isset($_POST['servintertaxhead']))?'1':'0');
    // $servintertaxadd=mysqli_real_escape_string($con, (isset($_POST['servintertaxadd']))?'1':'0');
    // $servintertaxedit=mysqli_real_escape_string($con, (isset($_POST['servintertaxedit']))?'1':'0');
    // $servintertaxview=mysqli_real_escape_string($con, (isset($_POST['servintertaxview']))?'1':'0');

    // $servlistname=mysqli_real_escape_string($con, (isset($_POST['servlistnamehead']))?'1':'0');
    // $servlistcode=mysqli_real_escape_string($con, (isset($_POST['servlistcodehead']))?'1':'0');
    // $servlistcat=mysqli_real_escape_string($con, (isset($_POST['servlistcathead']))?'1':'0');
    // $servlistunit=mysqli_real_escape_string($con, (isset($_POST['servlistunithead']))?'1':'0');
    // $servlistdes=mysqli_real_escape_string($con, (isset($_POST['servlistdeshead']))?'1':'0');
    // $servlistdel=mysqli_real_escape_string($con, (isset($_POST['servlistdelhead']))?'1':'0');
    // $servlistprice=mysqli_real_escape_string($con, (isset($_POST['servlistpricehead']))?'1':'0');
    // $servlistinttax=mysqli_real_escape_string($con, (isset($_POST['servlistinttaxhead']))?'1':'0');
    // $servlistvis=mysqli_real_escape_string($con, (isset($_POST['servlistvishead']))?'1':'0');
    // $servliststatus=mysqli_real_escape_string($con, (isset($_POST['servliststatushead']))?'1':'0');


    // $sqlup=mysqli_query($con,"update paircontrols set  servinfohead='$servinfohead',servinfoadd='$servinfoadd',servinfoedit='$servinfoedit',servinfoview='$servinfoview',servcodehead='$servcodehead',servcodeadd='$servcodeadd',servcodeedit='$servcodeedit',servcodeview='$servcodeview',servname='$servnhead',servnadd='$servnadd',servnedit='$servnedit',servnview='$servnview',servcode='$servchead',servcadd='$servcadd',servcedit='$servcedit',servcview='$servcview',servunithead='$servunithead',servunitadd='$servunitadd',servunitedit='$servunitedit',servunitview='$servunitview',propreference='$propre',proname='$prohead',pronadd='$proadd',pronedit='$proedit',pronview='$proview',procode='$servhead',procadd='$servadd',procedit='$servedit',procview='$servview',proinfoadd='$proinfoadd',proinfoedit='$proinfoedit',proinfoview='$proinfoview',provisibility='$provishead',provisadd='$provisadd',provisedit='$provisedit',provisview='$provisview',proimage='$proimghead',proimgadd='$proimgadd',proimgedit='$proimgedit',proimgview='$proimgview',propurchase='$propurhead',propuradd='$propuradd',propuredit='$propuredit',propurview='$propurview',prosales='$prosalehead',prosaleadd='$prosaleadd',prosaleedit='$prosaleedit',prosaleview='$prosaleview',protaxes='$protaxhead',protaxadd='$protaxadd',protaxedit='$protaxedit',protaxview='$protaxview',proinventory='$proinvhead',proinvadd='$proinvadd',proinvedit='$proinvedit',proinvview='$proinvview',prostock='$prostkhead',prostkadd='$prostkadd',prostkedit='$prostkedit',prostkview='$prostkview',proother='$proothhead',proothadd='$proothadd',proothedit='$proothedit',proothview='$proothview',prounithead='$prounithead',prounitadd='$prounitadd',prounitedit='$prounitedit',prounitview='$prounitview',prohsnhead='$prohsnhead',prohsnadd='$prohsnadd',prohsnedit='$prohsnedit',prohsnview='$prohsnview',proskuhead='$proskuhead',proskuadd='$proskuadd',proskuedit='$proskuedit',proskuview='$proskuview',proupchead='$proupchead',proupcadd='$proupcadd',proupcedit='$proupcedit',proupcview='$proupcview',proeanhead='$proeanhead',proeanadd='$proeanadd',proeanedit='$proeanedit',proeanview='$proeanview',prompnhead='$prompnhead',prompnadd='$prompnadd',prompnedit='$prompnedit',prompnview='$prompnview',proisbhead='$proisbhead',proisbadd='$proisbadd',proisbedit='$proisbedit',proisbview='$proisbview',probranhead='$probranhead',probranadd='$probranadd',probranedit='$probranedit',probranview='$probranview',promanhead='$promanhead',promanadd='$promanadd',promanedit='$promanedit',promanview='$promanview',promolhead='$promolhead',promoladd='$promoladd',promoledit='$promoledit',promolview='$promolview',progenhead='$progenhead',progenadd='$progenadd',progenedit='$progenedit',progenview='$progenview',prosalthead='$prosalthead',prosaltadd='$prosaltadd',prosaltedit='$prosaltedit',prosaltview='$prosaltview',proconshead='$proconshead',proconsadd='$proconsadd',proconsedit='$proconsedit',proconsview='$proconsview',procathead='$procathead',procatadd='$procatadd',procatedit='$procatedit',procatview='$procatview',prosubhead='$prosubhead',prosubadd='$prosubadd',prosubedit='$prosubedit',prosubview='$prosubview',prodimhead='$prodimhead',prodimadd='$prodimadd',prodimedit='$prodimedit',prodimview='$prodimview',proweihead='$proweihead',proweiadd='$proweiadd',proweiedit='$proweiedit',proweiview='$proweiview',prorackhead='$prorackhead',prorackadd='$prorackadd',prorackedit='$prorackedit',prorackview='$prorackview',prodeshead='$prodeshead',prodesadd='$prodesadd',prodesedit='$prodesedit',prodesview='$prodesview',prodelhead='$prodelhead',prodeladd='$prodeladd',prodeledit='$prodeledit',prodelview='$prodelview',productcodehead='$productcodehead',productcodeadd='$productcodeadd',productcodeedit='$productcodeedit',productcodeview='$productcodeview',servhsnhead='$servhsnhead',servhsnadd='$servhsnadd',servhsnedit='$servhsnedit',servhsnview='$servhsnview',servskuhead='$servskuhead',servskuadd='$servskuadd',servskuedit='$servskuedit',servskuview='$servskuview',servupchead='$servupchead',servupcadd='$servupcadd',servupcedit='$servupcedit',servupcview='$servupcview',serveanhead='$serveanhead',serveanadd='$serveanadd',serveanedit='$serveanedit',serveanview='$serveanview',servmpnhead='$servmpnhead',servmpnadd='$servmpnadd',servmpnedit='$servmpnedit',servmpnview='$servmpnview',servisbhead='$servisbhead',servisbadd='$servisbadd',servisbedit='$servisbedit',servisbview='$servisbview',servbranhead='$servbranhead',servbranadd='$servbranadd',servbranedit='$servbranedit',servbranview='$servbranview',servmanhead='$servmanhead',servmanadd='$servmanadd',servmanedit='$servmanedit',servmanview='$servmanview',servmolhead='$servmolhead',servmoladd='$servmoladd',servmoledit='$servmoledit',servmolview='$servmolview',servgenhead='$servgenhead',servgenadd='$servgenadd',servgenedit='$servgenedit',servgenview='$servgenview',servsalthead='$servsalthead',servsaltadd='$servsaltadd',servsaltedit='$servsaltedit',servsaltview='$servsaltview',servconshead='$servconshead',servconsadd='$servconsadd',servconsedit='$servconsedit',servconsview='$servconsview',servcathead='$servcathead',servcatadd='$servcatadd',servcatedit='$servcatedit',servcatview='$servcatview',servsubhead='$servsubhead',servsubadd='$servsubadd',servsubedit='$servsubedit',servsubview='$servsubview',servdimhead='$servdimhead',servdimadd='$servdimadd',servdimedit='$servdimedit',servdimview='$servdimview',servweihead='$servweihead',servweiadd='$servweiadd',servweiedit='$servweiedit',servweiview='$servweiview',servrackhead='$servrackhead',servrackadd='$servrackadd',servrackedit='$servrackedit',servrackview='$servrackview',servdeshead='$servdeshead',servdesadd='$servdesadd',servdesedit='$servdesedit',servdesview='$servdesview',servdelhead='$servdelhead',servdeladd='$servdeladd',servdeledit='$servdeledit',servdelview='$servdelview',servvisibility='$servvishead',servvisadd='$servvisadd',servvisedit='$servvisedit',servvisview='$servvisview',servimage='$servimghead',servimgadd='$servimgadd',servimgedit='$servimgedit',servimgview='$servimgview',servpurchase='$servpurhead',servpuradd='$servpuradd',servpuredit='$servpuredit',servpurview='$servpurview',servsales='$servsalehead',servsaleadd='$servsaleadd',servsaleedit='$servsaleedit',servsaleview='$servsaleview',servtaxes='$servtaxhead',servtaxadd='$servtaxadd',servtaxedit='$servtaxedit',servtaxview='$servtaxview',servinventory='$servinvhead',servinvadd='$servinvadd',servinvedit='$servinvedit',servinvview='$servinvview',servstock='$servstkhead',servstkadd='$servstkadd',servstkedit='$servstkedit',servstkview='$servstkview',servother='$servothhead',servothadd='$servothadd',servothedit='$servothedit',servothview='$servothview',salepricename='$salepricenamehead',salepricenameadd='$salepricenameadd',salepricenameedit='$salepricenameedit',salepricenameview='$salepricenameview',salemrp='$salemrphead',salemrpadd='$salemrpadd',salemrpedit='$salemrpedit',salemrpview='$salemrpview',salepricerate='$salepriceratehead',salepricerateadd='$salepricerateadd',salepricerateedit='$salepricerateedit',salepricerateview='$salepricerateview',saledescription='$saledescriptionhead',saledescriptionadd='$saledescriptionadd',saledescriptionedit='$saledescriptionedit',saledescriptionview='$saledescriptionview',servsalepricename='$servsalepricenamehead',servsalepricenameadd='$servsalepricenameadd',servsalepricenameedit='$servsalepricenameedit',servsalepricenameview='$servsalepricenameview',servsalemrp='$servsalemrphead',servsalemrpadd='$servsalemrpadd',servsalemrpedit='$servsalemrpedit',servsalemrpview='$servsalemrpview',servsalepricerate='$servsalepriceratehead',servsalepricerateadd='$servsalepricerateadd',servsalepricerateedit='$servsalepricerateedit',servsalepricerateview='$servsalepricerateview',servsaledescription='$servsaledescriptionhead',servsaledescriptionadd='$servsaledescriptionadd',servsaledescriptionedit='$servsaledescriptionedit',servsaledescriptionview='$servsaledescriptionview',servtaxpreferadd='$servtaxpreferadd',servtaxpreferedit='$servtaxpreferedit',servtaxpreferview='$servtaxpreferview',servtaxrateadd='$servtaxrateadd',servtaxrateedit='$servtaxrateedit',servtaxrateview='$servtaxrateview',servintrataxadd='$servintrataxadd',servintrataxedit='$servintrataxedit',servintrataxview='$servintrataxview',servintertaxadd='$servintertaxadd',servintertaxedit='$servintertaxedit',servintertaxview='$servintertaxview',protaxpreferadd='$protaxpreferadd',protaxpreferedit='$protaxpreferedit',protaxpreferview='$protaxpreferview',protaxrateadd='$protaxrateadd',protaxrateedit='$protaxrateedit',protaxrateview='$protaxrateview',prointrataxadd='$prointrataxadd',prointrataxedit='$prointrataxedit',prointrataxview='$prointrataxview',prointertaxadd='$prointertaxadd',prointertaxedit='$prointertaxedit',prointertaxview='$prointertaxview',protaxprefer='$protaxprefer',protaxrate='$protaxrate',prointratax='$prointratax',prointertax='$prointertax',servtaxpreference='$servtaxprefer',servtaxrates='$servtaxrate',servintrataxes='$servintratax',servintertaxes='$servintertax',prolistname='$prolistname',prolistcode='$prolistcode',prolistcat='$prolistcat',prolistunit='$prolistunit',prolistdes='$prolistdes',prolistdel='$prolistdel',prolistprice='$prolistprice',prolistinttax='$prolistinttax',prolistvis='$prolistvis',proliststatus='$proliststatus',servlistname='$servlistname',servlistcode='$servlistcode',servlistcat='$servlistcat',servlistunit='$servlistunit',servlistdes='$servlistdes',servlistdel='$servlistdel',servlistprice='$servlistprice',servlistinttax='$servlistinttax',servlistvis='$servlistvis',servliststatus='$servliststatus' where id='$companymainid' or createdid='$companymainid'");

    // $sqlup=mysqli_query($con,"update pairaccess set purpricename='$purpricenamehead',purpricenameadd='$purpricenameadd',purpricenameedit='$purpricenameedit',purpricenameview='$purpricenameview',purmrp='$purmrphead',purmrpadd='$purmrpadd',purmrpedit='$purmrpedit',purmrpview='$purmrpview',purpricerate='$purpriceratehead',purpricerateadd='$purpricerateadd',purpricerateedit='$purpricerateedit',purpricerateview='$purpricerateview',purdescription='$purdescriptionhead',purdescriptionadd='$purdescriptionadd',purdescriptionedit='$purdescriptionedit',purdescriptionview='$purdescriptionview',servpurpricename='$servpurpricenamehead',servpurpricenameadd='$servpurpricenameadd',servpurpricenameedit='$servpurpricenameedit',servpurpricenameview='$servpurpricenameview',servpurmrp='$servpurmrphead',servpurmrpadd='$servpurmrpadd',servpurmrpedit='$servpurmrpedit',servpurmrpview='$servpurmrpview',servpurpricerate='$servpurpriceratehead',servpurpricerateadd='$servpurpricerateadd',servpurpricerateedit='$servpurpricerateedit',servpurpricerateview='$servpurpricerateview',servpurdescription='$servpurdescriptionhead',servpurdescriptionadd='$servpurdescriptionadd',servpurdescriptionedit='$servpurdescriptionedit',servpurdescriptionview='$servpurdescriptionview' where createdid='$companymainid'");
    // // $permissionitems=mysqli_real_escape_string($con, (isset($_POST['items']))?'1':'0');
    // // $permissionproducts=mysqli_real_escape_string($con, (isset($_POST['product']))?'1':'0');
    //  header('Location:preference_billing.php?remarks=Updated Successfully');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <?php
include('externals.php');
      $sqlismainaccessitem=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Items' order by id  asc");
      $infomainaccessitem=mysqli_fetch_array($sqlismainaccessitem);
?>
    <title>
        Preference &gt; <?= $row['books'] ?> &gt; <?= $infomainaccessitem['groupname'] ?>
    </title>
        <style type="text/css">
        table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.table td, .table th {
    white-space: normal;
}
    </style>
    <style>
   input[type="text"]:focus{
        border: 1px solid #3f94eb !important;
        outline: none;
        box-shadow: none !important;
        border-radius: 0px !important;
    }

    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }
    </style>
    <style>
    /*.accordion-button:not(.collapsed)::after {
        background-image: url();
        margin-left: -20px;
        margin-top: -5px;
    }

    .accordion-button:not(.collapsed) a.customcont-heading {
        border-bottom: 1.5px solid #000000;
        color: #000000;
    }*/
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}

.alignright
{
    text-align: right;
}


    @media screen and (min-device-width: 260px) and (max-device-width: 575px) { 
    /* STYLES HERE */

    /* STYLES HERE */
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}
.alignright{
    text-align: center;
    
}
.mobliview
{
    text-align: center;
    
}




}
@media screen and (min-device-width: 366px) and (max-device-width: 575px) { 
.row1
{
    width: auto;
}

}

    
    </style>

</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
   <?php
  // sidebar
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
   <?php 
   // navbar
   include('navhead.php');
    ?>
     <div class="container-fluid py-4 bg-body">
     <?php
   // notifications
     if(isset($_GET['remarks']))
     {
     ?>
     <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -32px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
    <i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?></p>
  </div>
     <?php
     }
     ?>
     <?php
     if(isset($_GET['error']))
     {
     ?>
      <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -32px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>
        <?php
      $sqlismainaccessitem=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Items' order by id  asc");
      $infomainaccessitem=mysqli_fetch_array($sqlismainaccessitem);
      $sqlismainaccesssale=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Sales' order by id  asc");
      $infomainaccesssale=mysqli_fetch_array($sqlismainaccesssale);
      $sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Purchase' order by id  asc");
      $infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
$sqlismainaccessinv=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessinv=mysqli_fetch_array($sqlismainaccessinv);
$sqlismainaccesspro=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Products' order by id  asc");
$infomainaccesspro=mysqli_fetch_array($sqlismainaccesspro);
$sqlismainaccessserv=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Services' order by id  asc");
$infomainaccessserv=mysqli_fetch_array($sqlismainaccessserv);
        ?>
             <div class="card card-body p-3 mt-5" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;max-width: 1650px;height: auto;z-index: 0;">
                <form action="" method="post" style="position: relative;top: -27px;margin-bottom: -78px;">
    <p class="mb-3" style="font-size: 14.6px;color: black;position: relative;top: 15px;"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference </a><span>&gt;</span><a href="preference_billing.php" style="color: #1878F1"> <!-- <i class="fa fa-book"></i> -->
                                    <?= $row['books'] ?> </a> &gt; <!-- <i class="fa fa-shopping-basket"></i>  --><?= $infomainaccessitem['groupname'] ?></p>
                                    <div class="mt-3" style="border-top: 1px solid #dee2e6;position: relative;top: 0px;"></div>
                                    <p class="mb-0" style="font-size: 20px;color: black;position: relative;top: 12px;"><?= $infomainaccessitem['groupname'] ?></p>
                                      <div style="margin-top: -42px !important;">
                                        <div style="visibility: visible;" id="arrowsalltabs">
<svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouch() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('nav-tab').scrollLeft += -90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrow() {
            document.getElementById('nav-tab').scrollLeft += 90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
        </script>
        <script type="text/javascript">   
$(document).ready(function() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
window.onresize = function (event) {
applyOrientation();
}         
function applyOrientation() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
}
});
</script>
        <style type="text/css">
        #nav-tab::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#nav-tab::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#nav-tab::-webkit-scrollbar-track {
  background-color: green;
}

#nav-tab::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#nav-tab::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
.nav-tabs button{
    margin-bottom: 2px !important;
}
.nav-tabs .customcont-header{
    border-bottom: 0px !important;
}

@media screen and (max-width: 560px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 561px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
    <div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: 9px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button <?=(($infomainaccesspro['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=(($infomainaccesspro['moduleaccess']=='1')?'active':'')?>" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccesspro['modulename'] ?> 
</a>  
             
                </div></button>
                <button <?=(($infomainaccessserv['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccesspro['moduleaccess']!='1')&&($infomainaccessserv['moduleaccess']=='1'))?'active':'')?>" id="nav-service-tab" data-bs-toggle="tab" data-bs-target="#nav-service" type="button" role="tab" aria-controls="nav-service"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccessserv['modulename'] ?></a>  
             
                </div></button>
                <button <?=(($infomainaccessinv['moduleaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=((($infomainaccesspro['moduleaccess']!='1')&&($infomainaccessserv['moduleaccess']!='1')&&($infomainaccessinv['moduleaccess']=='1'))?'active':'')?>" id="nav-inventory-tab" data-bs-toggle="tab" data-bs-target="#nav-inventory" type="button" role="tab" aria-controls="nav-inventory"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccessinv['modulename'] ?></a>  
             
                </div></button>
 </div>
</div>
 <!-- <style type="text/css">
     .custom-control-label{
        color: red !important;
     }
 </style> -->
<div class="tab-content" id="nav-tabContent" style="position:relative;top: -18px;">
  <div class="tab-pane fade show mt-4 p-3 <?=(($infomainaccesspro['moduleaccess']=='1')?'active':'')?>" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" <?=(($infomainaccesspro['moduleaccess']=='1')?'':'style="display:none"')?>>
        <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsproexpdate">
<svg id="rightarrowproexpdate" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproexpdate()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproexpdate" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproexpdate()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproexpdate() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#productexpdate').outerWidth()
            var scrollWidth = $('#productexpdate')[0].scrollWidth; 
            var scrollLeft = $('#productexpdate').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproexpdate').style.visibility = 'hidden';
            document.getElementById('rightarrowproexpdate').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproexpdate').style.visibility = 'hidden';
            document.getElementById('leftarrowproexpdate').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproexpdate').style.visibility = 'visible';
            document.getElementById('rightarrowproexpdate').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproexpdate() {
            document.getElementById('productexpdate').scrollLeft += -90;
            var width = $('#productexpdate').outerWidth()
            var scrollWidth = $('#productexpdate')[0].scrollWidth; 
            var scrollLeft = $('#productexpdate').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproexpdate').style.visibility = 'hidden';
            document.getElementById('rightarrowproexpdate').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproexpdate').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproexpdate() {
            document.getElementById('productexpdate').scrollLeft += 90;
            var width = $('#productexpdate').outerWidth()
            var scrollWidth = $('#productexpdate')[0].scrollWidth; 
            var scrollLeft = $('#productexpdate').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproexpdate').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproexpdate').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #productexpdate::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#productexpdate::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#productexpdate::-webkit-scrollbar-track {
  background-color: green;
}

#productexpdate::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#productexpdate::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsproexpdate{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsproexpdate{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchproexpdate()" id="productexpdate" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#productexpdates"
                                                    aria-expanded="true" aria-controls="productexpdates">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the things you would like to show in dashboard</a>
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                            <div id="productexpdates" class="accordion-collapse collapse show"
                                                aria-labelledby="productexpdate">
                                                <div class="accordion-body text-sm">
                                                  <div class="row mb-1">
                                                    <div class="col-lg-6">
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input type="checkbox" class="custom-control-input" name="dashexppro" id="dashexppro" <?= ($access['dashexppro']==1)?'checked':'' ?>>
                                                            <label class="custom-control-label custom-label" for="dashexppro" style="font-size: 14.6px;color:black !important;"> <?=$infomainaccesspro['modulename']?> Expiry Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6"></div>       
                                                  </div>
                                                  <div class="row mb-1" style="margin-left: 1rem;">
                                                      <div class="col-lg-3">
                                                        <label for="proexpdate" class="custom-label text-danger">Expiry date limit *</label>
                                                      </div>
                                                      <div class="col-5 col-sm-3 col-lg-1">
                                                        <input type="number" class="form-control  form-control-sm" id="proexpdate" name="proexpdate" placeholder="Enter The Date" value="<?=$access['proexpdate']?>" required>
                                                      </div>
                                                    </div>
                                                  <div class="row mb-1" style="margin-left: 1rem;">
                                                      <div class="col-lg-6">
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input type="checkbox" class="custom-control-input" name="expinvadjcheck" id="expinvadjcheck" <?= ($access['expinvadjcheck']==1)?'checked':'' ?>>
                                                            <label class="custom-control-label custom-label" for="expinvadjcheck" style="font-size: 14.6px;color:black !important;"> Expiry <?=strtolower($infomainaccesspro['modulename'])?> <?=strtolower($infomainaccessinv['modulename'])?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    </div>
                                                  <div class="row mb-1" style="margin-left: 1rem;">
                                                      <div class="col-lg-3">
                                                        <label for="expinvadj" class="custom-label text-danger"><?=ucfirst($infomainaccessinv['modulename'])?> limit *</label>
                                                      </div>
                                                      <div class="col-5 col-sm-3 col-lg-1">
                                                        <input type="number" class="form-control  form-control-sm" id="expinvadj" name="expinvadj" placeholder="Enter The Limit" value="<?=$access['expinvadj']?>" required max="100" min="1">
                                                      </div>
                                                    </div>
                                                  </div>
 <div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
                                                </div>
                                              </div>
                                            </div>
<br>
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallpro">
<svg id="rightarrowproacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproacc() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#productfield').outerWidth()
            var scrollWidth = $('#productfield')[0].scrollWidth; 
            var scrollLeft = $('#productfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproacc').style.visibility = 'hidden';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproacc').style.visibility = 'hidden';
            document.getElementById('leftarrowproacc').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproacc').style.visibility = 'visible';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproacc() {
            document.getElementById('productfield').scrollLeft += -90;
            var width = $('#productfield').outerWidth()
            var scrollWidth = $('#productfield')[0].scrollWidth; 
            var scrollLeft = $('#productfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproacc').style.visibility = 'hidden';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproacc() {
            document.getElementById('productfield').scrollLeft += 90;
            var width = $('#productfield').outerWidth()
            var scrollWidth = $('#productfield')[0].scrollWidth; 
            var scrollLeft = $('#productfield').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproacc').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproacc').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #productfield::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#productfield::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#productfield::-webkit-scrollbar-track {
  background-color: green;
}

#productfield::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#productfield::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallpro{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpro{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchproacc()" id="productfield" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#productfields"
                                                    aria-expanded="true" aria-controls="productfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                            <div id="productfields" class="accordion-collapse collapse show"
                                                aria-labelledby="productfield">
                                                <div class="accordion-body text-sm">
   <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Products' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Product Visibility')||($newmoduleskey=='Barcode Information')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Product Visibility')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='ProductInformation')) {
                  $fullaccessans = 'product';
                }
                else if (($coltypemod=='ProductVisibility')) {
                  $fullaccessans = 'productsvisible';
                }
                else if (($coltypemod=='BarcodeInformation')) {
                  $fullaccessans = 'barcodeinfo';
                }
                else if (($coltypemod=='SalesInformation')) {
                  $fullaccessans = 'sales';
                }
                else if (($coltypemod=='PurchaseInformation')) {
                  $fullaccessans = 'purchase';
                }
                else if (($coltypemod=='TaxInformation')) {
                  $fullaccessans = 'tax';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Product Public Code')||($newmoduleskey=='Product Private Code')||($newmoduleskey=='Product Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Unit')||($newmoduleskey=='HSN Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'products prosubhead':'' ?> <?= (($newmoduleskey=='Barcode Title')||($newmoduleskey=='Barcode Subtitle')||($newmoduleskey=='Barcode Type')||($newmoduleskey=='Barcode')||($newmoduleskey=='Under Barcode Label')||($newmoduleskey=='Footer Note'))?'barcodeinfo barcodesubhead':'' ?> <?= (($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'sales salessubhead':'' ?> <?= (($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'purchase purchasesubhead':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'tax taxsubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Product Visibility')||($newmoduleskey=='Barcode Information')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'royalblue':'' ?> !important;"> <?=($newmoduleskey=='Category')?'<input type="text" value="'. $access['txtname'.strtolower($newmoduleskey).''] .'" class="form-control form-control-sm" style="border: 1px dashed lightgrey;position: relative;top: -2.5px;" name="txtname'.strtolower($newmoduleskey).'">':''.(str_replace(" or ", " / ",(str_replace("Product", $infomainaccesspro['modulename'],(str_replace("Sales", $infomainaccesssale['groupname'],(str_replace("Purchase", $infomainaccesspurchase['groupname'],$newmoduleskey)))))))).''?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Product Public Code')||($newmoduleskey=='Product Private Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Product Code')||($newmoduleskey=='Unit')||($newmoduleskey=='HSN Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'products':'' ?> <?= (($newmoduleskey=='Product Visibility'))?'productsvisible':'' ?> <?= (($newmoduleskey=='Barcode Information')||($newmoduleskey=='Barcode Title')||($newmoduleskey=='Barcode Subtitle')||($newmoduleskey=='Barcode Type')||($newmoduleskey=='Barcode')||($newmoduleskey=='Under Barcode Label')||($newmoduleskey=='Footer Note'))?'barcodeinfo':'' ?> <?= (($newmoduleskey=='Sales Information')||($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'sales':'' ?> <?= (($newmoduleskey=='Purchase Information')||($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'purchase':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'tax':'' ?> <?= (($newmoduleskey=='Product Public Code')||($newmoduleskey=='Product Private Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Product Code')||($newmoduleskey=='Unit')||($newmoduleskey=='HSN Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'productsadd aevforpro':'' ?> <?= (($newmoduleskey=='Product Visibility'))?'productsvisible':'' ?> <?= (($newmoduleskey=='Barcode Title')||($newmoduleskey=='Barcode Subtitle')||($newmoduleskey=='Barcode Type')||($newmoduleskey=='Barcode')||($newmoduleskey=='Under Barcode Label')||($newmoduleskey=='Footer Note'))?'barcodeinfoadd aevforbarcodeinfo':'' ?> <?= (($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'salesadd aevforsales':'' ?> <?= (($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'purchaseadd aevforpurchase':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'taxadd aevfortax':'' ?>" name="<?= $coltypemod; ?>add" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>" style="color:<?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Product Visibility')||($newmoduleskey=='Barcode Information')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Product Public Code')||($newmoduleskey=='Product Private Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Product Code')||($newmoduleskey=='Unit')||($newmoduleskey=='HSN Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'products':'' ?> <?= (($newmoduleskey=='Product Visibility'))?'productsvisible':'' ?> <?= (($newmoduleskey=='Barcode Information')||($newmoduleskey=='Barcode Title')||($newmoduleskey=='Barcode Subtitle')||($newmoduleskey=='Barcode Type')||($newmoduleskey=='Barcode')||($newmoduleskey=='Under Barcode Label')||($newmoduleskey=='Footer Note'))?'barcodeinfo':'' ?> <?= (($newmoduleskey=='Sales Information')||($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'sales':'' ?> <?= (($newmoduleskey=='Purchase Information')||($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'purchase':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'tax':'' ?> <?= (($newmoduleskey=='Product Public Code')||($newmoduleskey=='Product Private Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Product Code')||($newmoduleskey=='Unit')||($newmoduleskey=='HSN Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'productsedit aevforpro':'' ?> <?= (($newmoduleskey=='Product Visibility'))?'productsvisible':'' ?> <?= (($newmoduleskey=='Barcode Title')||($newmoduleskey=='Barcode Subtitle')||($newmoduleskey=='Barcode Type')||($newmoduleskey=='Barcode')||($newmoduleskey=='Under Barcode Label')||($newmoduleskey=='Footer Note'))?'barcodeinfoedit aevforbarcodeinfo':'' ?> <?= (($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'salesedit aevforsales':'' ?> <?= (($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'purchaseedit aevforpurchase':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'taxedit aevfortax':'' ?>" name="<?= $coltypemod; ?>edit" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?> <?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>" style="color:<?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Product Visibility')||($newmoduleskey=='Barcode Information')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Product Public Code')||($newmoduleskey=='Product Private Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Product Code')||($newmoduleskey=='Unit')||($newmoduleskey=='HSN Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'products':'' ?> <?= (($newmoduleskey=='Product Visibility'))?'productsvisible':'' ?> <?= (($newmoduleskey=='Barcode Information')||($newmoduleskey=='Barcode Title')||($newmoduleskey=='Barcode Subtitle')||($newmoduleskey=='Barcode Type')||($newmoduleskey=='Barcode')||($newmoduleskey=='Under Barcode Label')||($newmoduleskey=='Footer Note'))?'barcodeinfo':'' ?> <?= (($newmoduleskey=='Sales Information')||($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'sales':'' ?> <?= (($newmoduleskey=='Purchase Information')||($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'purchase':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'tax':'' ?> <?= (($newmoduleskey=='Product Public Code')||($newmoduleskey=='Product Private Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Product Code')||($newmoduleskey=='Unit')||($newmoduleskey=='HSN Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'productsview aevforpro':'' ?> <?= (($newmoduleskey=='Product Visibility'))?'productsvisible':'' ?> <?= (($newmoduleskey=='Barcode Title')||($newmoduleskey=='Barcode Subtitle')||($newmoduleskey=='Barcode Type')||($newmoduleskey=='Barcode')||($newmoduleskey=='Under Barcode Label')||($newmoduleskey=='Footer Note'))?'barcodeinfoview aevforbarcodeinfo':'' ?> <?= (($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'salesview aevforsales':'' ?> <?= (($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'purchaseview aevforpurchase':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'taxview aevfortax':'' ?>" name="<?= $coltypemod; ?>view" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>" style="color:<?= (($newmoduleskey=='Product Information')||($newmoduleskey=='Product Visibility')||($newmoduleskey=='Barcode Information')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              // function ProductInformationproduct() {
              //   let products = document.getElementsByClassName("products");
              //   productslen = products.length;
              //   if ($("#ProductInformationproduct").prop("checked")) {
              //   for (i=0;i<productslen;i++) {
              //   products[i].checked=true;
              //   products[i].disabled=false;
              //   }
              //   }
              //   else{
              //   for (i=0;i<productslen;i++) {
              //   products[i].checked=false;
              //   products[i].disabled=true;
              //   }
              //   }
              // }
              function ProductVisibilityproductsvisible() {
                let productsvisible = document.getElementsByClassName("productsvisible");
                productslen = productsvisible.length;
                if ($("#ProductVisibilityproductsvisible").prop("checked")) {
                for (i=0;i<productslen;i++) {
                productsvisible[i].checked=true;
                productsvisible[i].disabled=false;
                }
                }
                else{
                for (i=0;i<productslen;i++) {
                productsvisible[i].checked=false;
                productsvisible[i].disabled=true;
                }
                }
              }
              function BarcodeInformationbarcodeinfo() {
                let barcodeinfo = document.getElementsByClassName("barcodeinfo");
                productslen = barcodeinfo.length;
                if ($("#BarcodeInformationbarcodeinfo").prop("checked")) {
                for (i=0;i<productslen;i++) {
                barcodeinfo[i].checked=true;
                barcodeinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<productslen;i++) {
                barcodeinfo[i].checked=false;
                barcodeinfo[i].disabled=true;
                }
                }
              }
              function SalesInformationsales() {
                let sales = document.getElementsByClassName("sales");
                productslen = sales.length;
                if ($("#SalesInformationsales").prop("checked")) {
                for (i=0;i<productslen;i++) {
                sales[i].checked=true;
                sales[i].disabled=false;
                }
                }
                else{
                for (i=0;i<productslen;i++) {
                sales[i].checked=false;
                sales[i].disabled=true;
                }
                }
              }
              function PurchaseInformationpurchase() {
                let purchase = document.getElementsByClassName("purchase");
                productslen = purchase.length;
                if ($("#PurchaseInformationpurchase").prop("checked")) {
                for (i=0;i<productslen;i++) {
                purchase[i].checked=true;
                purchase[i].disabled=false;
                }
                }
                else{
                for (i=0;i<productslen;i++) {
                purchase[i].checked=false;
                purchase[i].disabled=true;
                }
                }
              }
              function TaxInformationtax() {
                let tax = document.getElementsByClassName("tax");
                productslen = tax.length;
                if ($("#TaxInformationtax").prop("checked")) {
                for (i=0;i<productslen;i++) {
                tax[i].checked=true;
                tax[i].disabled=false;
                }
                }
                else{
                for (i=0;i<productslen;i++) {
                tax[i].checked=false;
                tax[i].disabled=true;
                }
                }
              }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
// let prosubhead = document.getElementsByClassName("prosubhead");
// let prosubheadchnumof = prosubhead.length;
// for (i=0;i<prosubhead.length;i++) {
// if (prosubhead[i].checked) {
// prosubheadchnumof+=1;
// }
// else{
// prosubheadchnumof-=1;
// }
// }
// if (prosubheadchnumof==0) {
// document.getElementById("ProductInformationproduct").checked=false;
// document.getElementById("ProductInformationaddproduct").checked=false;
// document.getElementById("ProductInformationeditproduct").checked=false;
// document.getElementById("ProductInformationviewproduct").checked=false;
// }
// else{
// document.getElementById("ProductInformationproduct").checked=true;
// document.getElementById("ProductInformationaddproduct").checked=true;
// document.getElementById("ProductInformationeditproduct").checked=true;
// document.getElementById("ProductInformationviewproduct").checked=true;
// }
let barcodesubhead = document.getElementsByClassName("barcodesubhead");
let barcodesubheadchnumof = barcodesubhead.length;
for (i=0;i<barcodesubhead.length;i++) {
if (barcodesubhead[i].checked) {
barcodesubheadchnumof+=1;
}
else{
barcodesubheadchnumof-=1;
}
}
if (barcodesubheadchnumof==0) {
document.getElementById("BarcodeInformationbarcodeinfo").checked=false;
document.getElementById("BarcodeInformationaddbarcodeinfo").checked=false;
document.getElementById("BarcodeInformationeditbarcodeinfo").checked=false;
document.getElementById("BarcodeInformationviewbarcodeinfo").checked=false;
}
else{
document.getElementById("BarcodeInformationbarcodeinfo").checked=true;
document.getElementById("BarcodeInformationaddbarcodeinfo").checked=true;
document.getElementById("BarcodeInformationeditbarcodeinfo").checked=true;
document.getElementById("BarcodeInformationviewbarcodeinfo").checked=true;
}
let salessubhead = document.getElementsByClassName("salessubhead");
let salessubheadchnumof = salessubhead.length;
for (i=0;i<salessubhead.length;i++) {
if (salessubhead[i].checked) {
salessubheadchnumof+=1;
}
else{
salessubheadchnumof-=1;
}
}
if (salessubheadchnumof==0) {
document.getElementById("SalesInformationsales").checked=false;
document.getElementById("SalesInformationaddsales").checked=false;
document.getElementById("SalesInformationeditsales").checked=false;
document.getElementById("SalesInformationviewsales").checked=false;
}
else{
document.getElementById("SalesInformationsales").checked=true;
document.getElementById("SalesInformationaddsales").checked=true;
document.getElementById("SalesInformationeditsales").checked=true;
document.getElementById("SalesInformationviewsales").checked=true;
}
let purchasesubhead = document.getElementsByClassName("purchasesubhead");
let purchasesubheadchnumof = purchasesubhead.length;
for (i=0;i<purchasesubhead.length;i++) {
if (purchasesubhead[i].checked) {
purchasesubheadchnumof+=1;
}
else{
purchasesubheadchnumof-=1;
}
}
if (purchasesubheadchnumof==0) {
document.getElementById("PurchaseInformationpurchase").checked=false;
document.getElementById("PurchaseInformationaddpurchase").checked=false;
document.getElementById("PurchaseInformationeditpurchase").checked=false;
document.getElementById("PurchaseInformationviewpurchase").checked=false;
}
else{
document.getElementById("PurchaseInformationpurchase").checked=true;
document.getElementById("PurchaseInformationaddpurchase").checked=true;
document.getElementById("PurchaseInformationeditpurchase").checked=true;
document.getElementById("PurchaseInformationviewpurchase").checked=true;
}
let taxsubhead = document.getElementsByClassName("taxsubhead");
let taxsubheadchnumof = taxsubhead.length;
for (i=0;i<taxsubhead.length;i++) {
if (taxsubhead[i].checked) {
taxsubheadchnumof+=1;
}
else{
taxsubheadchnumof-=1;
}
}
if (taxsubheadchnumof==0) {
document.getElementById("TaxInformationtax").checked=false;
document.getElementById("TaxInformationaddtax").checked=false;
document.getElementById("TaxInformationedittax").checked=false;
document.getElementById("TaxInformationviewtax").checked=false;
}
else{
document.getElementById("TaxInformationtax").checked=true;
document.getElementById("TaxInformationaddtax").checked=true;
document.getElementById("TaxInformationedittax").checked=true;
document.getElementById("TaxInformationviewtax").checked=true;
}
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                // if (($coltypemod=='ProductPublicCode')||($coltypemod=='ProductPrivateCode')||($coltypemod=='ProductCode')||($coltypemod=='CodeorTags')||($coltypemod=='Unit')||($coltypemod=='HSNCode')||($coltypemod=='Category')||($coltypemod=='SubCategory')||($coltypemod=='Delivery')||($coltypemod=='Description')) {
                ?>
                // let aevforproch = document.getElementsByClassName("aevforpro");
                // let aevchnumof = aevforproch.length;
                // for (i=0;i<aevforproch.length;i++) {
                // if (aevforproch[i].checked) {
                //     aevchnumof+=1;
                // }
                // else{
                //     aevchnumof-=1;
                // }
                // }
                //     if (aevchnumof==0) {
                //     document.getElementById("ProductInformationproduct").checked=false;
                //     }
                //     else{
                //     document.getElementById("ProductInformationproduct").checked=true;
                // }
                // let aevforproadd = document.getElementsByClassName("productsadd");
                // let aevnumofproadd = aevforproadd.length;
                // for (i=0;i<aevforproadd.length;i++) {
                // if (aevforproadd[i].checked) {
                //     aevnumofproadd+=1;
                // }
                // else{
                //     aevnumofproadd-=1;
                // }
                // }
                // if (aevnumofproadd==0) {
                // document.getElementById("ProductInformationaddproduct").checked=false;
                // }
                // else{
                // document.getElementById("ProductInformationaddproduct").checked=true;
                // }
                // let aevforproedit = document.getElementsByClassName("productsedit");
                // let aevnumofproedit = aevforproedit.length;
                // for (i=0;i<aevforproedit.length;i++) {
                // if (aevforproedit[i].checked) {
                //     aevnumofproedit+=1;
                // }
                // else{
                //     aevnumofproedit-=1;
                // }
                // }
                // if (aevnumofproedit==0) {
                // document.getElementById("ProductInformationeditproduct").checked=false;
                // }
                // else{
                // document.getElementById("ProductInformationeditproduct").checked=true;
                // }
                // let aevforproview = document.getElementsByClassName("productsview");
                // let aevnumofproview = aevforproview.length;
                // for (i=0;i<aevforproview.length;i++) {
                // if (aevforproview[i].checked) {
                //     aevnumofproview+=1;
                // }
                // else{
                //     aevnumofproview-=1;
                // }
                // }
                // if (aevnumofproview==0) {
                // document.getElementById("ProductInformationviewproduct").checked=false;
                // }
                // else{
                // document.getElementById("ProductInformationviewproduct").checked=true;
                // }
                <?php
                // }
                if (($coltypemod=='BarcodeTitle')||($coltypemod=='BarcodeSubtitle')||($coltypemod=='BarcodeType')||($coltypemod=='Barcode')||($coltypemod=='UnderBarcodeLabel')||($coltypemod=='FooterNote')) {
                ?>
                let aevforbarcodeinfoch = document.getElementsByClassName("aevforbarcodeinfo");
                let aevchnumofbarcodeinfo = aevforbarcodeinfoch.length;
                for (i=0;i<aevforbarcodeinfoch.length;i++) {
                if (aevforbarcodeinfoch[i].checked) {
                    aevchnumofbarcodeinfo+=1;
                }
                else{
                    aevchnumofbarcodeinfo-=1;
                }
                }
                    if (aevchnumofbarcodeinfo==0) {
                    document.getElementById("BarcodeInformationbarcodeinfo").checked=false;
                    }
                    else{
                    document.getElementById("BarcodeInformationbarcodeinfo").checked=true;
                }
                let aevforbarcodeinfoadd = document.getElementsByClassName("barcodeinfoadd");
                let aevnumofbarcodeinfoadd = aevforbarcodeinfoadd.length;
                for (i=0;i<aevforbarcodeinfoadd.length;i++) {
                if (aevforbarcodeinfoadd[i].checked) {
                    aevnumofbarcodeinfoadd+=1;
                }
                else{
                    aevnumofbarcodeinfoadd-=1;
                }
                }
                if (aevnumofbarcodeinfoadd==0) {
                document.getElementById("BarcodeInformationaddbarcodeinfo").checked=false;
                }
                else{
                document.getElementById("BarcodeInformationaddbarcodeinfo").checked=true;
                }
                let aevforbarcodeinfoedit = document.getElementsByClassName("barcodeinfoedit");
                let aevnumofbarcodeinfoedit = aevforbarcodeinfoedit.length;
                for (i=0;i<aevforbarcodeinfoedit.length;i++) {
                if (aevforbarcodeinfoedit[i].checked) {
                    aevnumofbarcodeinfoedit+=1;
                }
                else{
                    aevnumofbarcodeinfoedit-=1;
                }
                }
                if (aevnumofbarcodeinfoedit==0) {
                document.getElementById("BarcodeInformationeditbarcodeinfo").checked=false;
                }
                else{
                document.getElementById("BarcodeInformationeditbarcodeinfo").checked=true;
                }
                let aevforbarcodeinfoview = document.getElementsByClassName("barcodeinfoview");
                let aevnumofbarcodeinfoview = aevforbarcodeinfoview.length;
                for (i=0;i<aevforbarcodeinfoview.length;i++) {
                if (aevforbarcodeinfoview[i].checked) {
                    aevnumofbarcodeinfoview+=1;
                }
                else{
                    aevnumofbarcodeinfoview-=1;
                }
                }
                if (aevnumofbarcodeinfoview==0) {
                document.getElementById("BarcodeInformationviewbarcodeinfo").checked=false;
                }
                else{
                document.getElementById("BarcodeInformationviewbarcodeinfo").checked=true;
                }
                <?php
                }
                if (($coltypemod=='SalePriceName')||($coltypemod=='SaleMRP')||($coltypemod=='SalePriceRate')||($coltypemod=='SaleDescription')) {
                ?>
                let aevforsalesch = document.getElementsByClassName("aevforsales");
                let aevchnumofsales = aevforsalesch.length;
                for (i=0;i<aevforsalesch.length;i++) {
                if (aevforsalesch[i].checked) {
                    aevchnumofsales+=1;
                }
                else{
                    aevchnumofsales-=1;
                }
                }
                    if (aevchnumofsales==0) {
                    document.getElementById("SalesInformationsales").checked=false;
                    }
                    else{
                    document.getElementById("SalesInformationsales").checked=true;
                }
                let aevforsalesadd = document.getElementsByClassName("salesadd");
                let aevnumofsalesadd = aevforsalesadd.length;
                for (i=0;i<aevforsalesadd.length;i++) {
                if (aevforsalesadd[i].checked) {
                    aevnumofsalesadd+=1;
                }
                else{
                    aevnumofsalesadd-=1;
                }
                }
                if (aevnumofsalesadd==0) {
                document.getElementById("SalesInformationaddsales").checked=false;
                }
                else{
                document.getElementById("SalesInformationaddsales").checked=true;
                }
                let aevforsalesedit = document.getElementsByClassName("salesedit");
                let aevnumofsalesedit = aevforsalesedit.length;
                for (i=0;i<aevforsalesedit.length;i++) {
                if (aevforsalesedit[i].checked) {
                    aevnumofsalesedit+=1;
                }
                else{
                    aevnumofsalesedit-=1;
                }
                }
                if (aevnumofsalesedit==0) {
                document.getElementById("SalesInformationeditsales").checked=false;
                }
                else{
                document.getElementById("SalesInformationeditsales").checked=true;
                }
                let aevforsalesview = document.getElementsByClassName("salesview");
                let aevnumofsalesview = aevforsalesview.length;
                for (i=0;i<aevforsalesview.length;i++) {
                if (aevforsalesview[i].checked) {
                    aevnumofsalesview+=1;
                }
                else{
                    aevnumofsalesview-=1;
                }
                }
                if (aevnumofsalesview==0) {
                document.getElementById("SalesInformationviewsales").checked=false;
                }
                else{
                document.getElementById("SalesInformationviewsales").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='PurchasePriceName')||($coltypemod=='PurchaseMRP')||($coltypemod=='PurchasePriceRate')||($coltypemod=='PurchaseDescription')) {
                ?>
                let aevforpurchasech = document.getElementsByClassName("aevforpurchase");
                let aevchnumofpurchase = aevforpurchasech.length;
                for (i=0;i<aevforpurchasech.length;i++) {
                if (aevforpurchasech[i].checked) {
                    aevchnumofpurchase+=1;
                }
                else{
                    aevchnumofpurchase-=1;
                }
                }
                    if (aevchnumofpurchase==0) {
                    document.getElementById("PurchaseInformationpurchase").checked=false;
                    }
                    else{
                    document.getElementById("PurchaseInformationpurchase").checked=true;
                }
                let aevforpurchaseadd = document.getElementsByClassName("purchaseadd");
                let aevnumofpurchaseadd = aevforpurchaseadd.length;
                for (i=0;i<aevforpurchaseadd.length;i++) {
                if (aevforpurchaseadd[i].checked) {
                    aevnumofpurchaseadd+=1;
                }
                else{
                    aevnumofpurchaseadd-=1;
                }
                }
                if (aevnumofpurchaseadd==0) {
                document.getElementById("PurchaseInformationaddpurchase").checked=false;
                }
                else{
                document.getElementById("PurchaseInformationaddpurchase").checked=true;
                }
                let aevforpurchaseedit = document.getElementsByClassName("purchaseedit");
                let aevnumofpurchaseedit = aevforpurchaseedit.length;
                for (i=0;i<aevforpurchaseedit.length;i++) {
                if (aevforpurchaseedit[i].checked) {
                    aevnumofpurchaseedit+=1;
                }
                else{
                    aevnumofpurchaseedit-=1;
                }
                }
                if (aevnumofpurchaseedit==0) {
                document.getElementById("PurchaseInformationeditpurchase").checked=false;
                }
                else{
                document.getElementById("PurchaseInformationeditpurchase").checked=true;
                }
                let aevforpurchaseview = document.getElementsByClassName("purchaseview");
                let aevnumofpurchaseview = aevforpurchaseview.length;
                for (i=0;i<aevforpurchaseview.length;i++) {
                if (aevforpurchaseview[i].checked) {
                    aevnumofpurchaseview+=1;
                }
                else{
                    aevnumofpurchaseview-=1;
                }
                }
                if (aevnumofpurchaseview==0) {
                document.getElementById("PurchaseInformationviewpurchase").checked=false;
                }
                else{
                document.getElementById("PurchaseInformationviewpurchase").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='TaxPreference')||($coltypemod=='TaxRate')||($coltypemod=='IntraStateTaxRate')||($coltypemod=='InterStateTaxRate')) {
                ?>
                let aevfortaxch = document.getElementsByClassName("aevfortax");
                let aevchnumoftax = aevfortaxch.length;
                for (i=0;i<aevfortaxch.length;i++) {
                if (aevfortaxch[i].checked) {
                    aevchnumoftax+=1;
                }
                else{
                    aevchnumoftax-=1;
                }
                }
                    if (aevchnumoftax==0) {
                    document.getElementById("TaxInformationtax").checked=false;
                    }
                    else{
                    document.getElementById("TaxInformationtax").checked=true;
                }
                let aevfortaxadd = document.getElementsByClassName("taxadd");
                let aevnumoftaxadd = aevfortaxadd.length;
                for (i=0;i<aevfortaxadd.length;i++) {
                if (aevfortaxadd[i].checked) {
                    aevnumoftaxadd+=1;
                }
                else{
                    aevnumoftaxadd-=1;
                }
                }
                if (aevnumoftaxadd==0) {
                document.getElementById("TaxInformationaddtax").checked=false;
                }
                else{
                document.getElementById("TaxInformationaddtax").checked=true;
                }
                let aevfortaxedit = document.getElementsByClassName("taxedit");
                let aevnumoftaxedit = aevfortaxedit.length;
                for (i=0;i<aevfortaxedit.length;i++) {
                if (aevfortaxedit[i].checked) {
                    aevnumoftaxedit+=1;
                }
                else{
                    aevnumoftaxedit-=1;
                }
                }
                if (aevnumoftaxedit==0) {
                document.getElementById("TaxInformationedittax").checked=false;
                }
                else{
                document.getElementById("TaxInformationedittax").checked=true;
                }
                let aevfortaxview = document.getElementsByClassName("taxview");
                let aevnumoftaxview = aevfortaxview.length;
                for (i=0;i<aevfortaxview.length;i++) {
                if (aevfortaxview[i].checked) {
                    aevnumoftaxview+=1;
                }
                else{
                    aevnumoftaxview-=1;
                }
                }
                if (aevnumoftaxview==0) {
                document.getElementById("TaxInformationviewtax").checked=false;
                }
                else{
                document.getElementById("TaxInformationviewtax").checked=true;
                }
                <?php
                }
                ?>
              }
// function ProductInformationaddproduct() {
// let product = document.getElementsByClassName("productsadd");
// productslen = product.length;
// let aevforpro = document.getElementsByClassName("aevforpro");
// let prosubhead = document.getElementsByClassName("prosubhead");
// let chnumof = aevforpro.length;
// if ($("#ProductInformationaddproduct").prop("checked")) {
// for (i=0;i<productslen;i++) {
// product[i].checked=true;
// }
// }
// else{
// for (i=0;i<productslen;i++) {
// product[i].checked=false;
// }
// }
// for (i=0;i<aevforpro.length;i++) {
// if (aevforpro[i].checked) {
// chnumof+=1;
// }
// else{
// chnumof-=1;
// }
// }
// for (i=0;i<productslen;i++) {
// if (chnumof==0) {
// prosubhead[i].checked=false;
// }
// else{
// prosubhead[i].checked=true;
// }
// }
// }
// function ProductInformationeditproduct() {
// let product = document.getElementsByClassName("productsedit");
// productslen = product.length;
// let aevforpro = document.getElementsByClassName("aevforpro");
// let prosubhead = document.getElementsByClassName("prosubhead");
// let chnumof = aevforpro.length;
// if ($("#ProductInformationeditproduct").prop("checked")) {
// for (i=0;i<productslen;i++) {
// product[i].checked=true;
// }
// }
// else{
// for (i=0;i<productslen;i++) {
// product[i].checked=false;
// }
// }
// for (i=0;i<aevforpro.length;i++) {
// if (aevforpro[i].checked) {
// chnumof+=1;
// }
// else{
// chnumof-=1;
// }
// }
// for (i=0;i<productslen;i++) {
// if (chnumof==0) {
// prosubhead[i].checked=false;
// }
// else{
// prosubhead[i].checked=true;
// }
// }
// }
// function ProductInformationviewproduct() {
// let product = document.getElementsByClassName("productsview");
// productslen = product.length;
// let aevforpro = document.getElementsByClassName("aevforpro");
// let prosubhead = document.getElementsByClassName("prosubhead");
// let chnumof = aevforpro.length;
// if ($("#ProductInformationviewproduct").prop("checked")) {
// for (i=0;i<productslen;i++) {
// product[i].checked=true;
// }
// }
// else{
// for (i=0;i<productslen;i++) {
// product[i].checked=false;
// }
// }
// for (i=0;i<aevforpro.length;i++) {
// if (aevforpro[i].checked) {
// chnumof+=1;
// }
// else{
// chnumof-=1;
// }
// }
// for (i=0;i<productslen;i++) {
// if (chnumof==0) {
// prosubhead[i].checked=false;
// }
// else{
// prosubhead[i].checked=true;
// }
// }
// }
function BarcodeInformationaddbarcodeinfo() {
let barcodeinfo = document.getElementsByClassName("barcodeinfoadd");
barcodeinfolen = barcodeinfo.length;
let aevforbarcodeinfo = document.getElementsByClassName("aevforbarcodeinfo");
let barcodesubhead = document.getElementsByClassName("barcodesubhead");
let chnumofbarcodeinfo = aevforbarcodeinfo.length;
if ($("#BarcodeInformationaddbarcodeinfo").prop("checked")) {
for (i=0;i<barcodeinfolen;i++) {
barcodeinfo[i].checked=true;
}
}
else{
for (i=0;i<barcodeinfolen;i++) {
barcodeinfo[i].checked=false;
}
}
for (i=0;i<aevforbarcodeinfo.length;i++) {
if (aevforbarcodeinfo[i].checked) {
chnumofbarcodeinfo+=1;
}
else{
chnumofbarcodeinfo-=1;
}
}
for (i=0;i<barcodeinfolen;i++) {
if (chnumofbarcodeinfo==0) {
barcodesubhead[i].checked=false;
}
else{
barcodesubhead[i].checked=true;
}
}
}
function BarcodeInformationeditbarcodeinfo() {
let barcodeinfo = document.getElementsByClassName("barcodeinfoedit");
barcodeinfolen = barcodeinfo.length;
let aevforbarcodeinfo = document.getElementsByClassName("aevforbarcodeinfo");
let barcodesubhead = document.getElementsByClassName("barcodesubhead");
let chnumofbarcodeinfo = aevforbarcodeinfo.length;
if ($("#BarcodeInformationeditbarcodeinfo").prop("checked")) {
for (i=0;i<barcodeinfolen;i++) {
barcodeinfo[i].checked=true;
}
}
else{
for (i=0;i<barcodeinfolen;i++) {
barcodeinfo[i].checked=false;
}
}
for (i=0;i<aevforbarcodeinfo.length;i++) {
if (aevforbarcodeinfo[i].checked) {
chnumofbarcodeinfo+=1;
}
else{
chnumofbarcodeinfo-=1;
}
}
for (i=0;i<barcodeinfolen;i++) {
if (chnumofbarcodeinfo==0) {
barcodesubhead[i].checked=false;
}
else{
barcodesubhead[i].checked=true;
}
}
}
function BarcodeInformationviewbarcodeinfo() {
let barcodeinfo = document.getElementsByClassName("barcodeinfoview");
barcodeinfolen = barcodeinfo.length;
let aevforbarcodeinfo = document.getElementsByClassName("aevforbarcodeinfo");
let barcodesubhead = document.getElementsByClassName("barcodesubhead");
let chnumofbarcodeinfo = aevforbarcodeinfo.length;
if ($("#BarcodeInformationviewbarcodeinfo").prop("checked")) {
for (i=0;i<barcodeinfolen;i++) {
barcodeinfo[i].checked=true;
}
}
else{
for (i=0;i<barcodeinfolen;i++) {
barcodeinfo[i].checked=false;
}
}
for (i=0;i<aevforbarcodeinfo.length;i++) {
if (aevforbarcodeinfo[i].checked) {
chnumofbarcodeinfo+=1;
}
else{
chnumofbarcodeinfo-=1;
}
}
for (i=0;i<barcodeinfolen;i++) {
if (chnumofbarcodeinfo==0) {
barcodesubhead[i].checked=false;
}
else{
barcodesubhead[i].checked=true;
}
}
}
function SalesInformationaddsales() {
let sales = document.getElementsByClassName("salesadd");
saleslen = sales.length;
let aevforsales = document.getElementsByClassName("aevforsales");
let salessubhead = document.getElementsByClassName("salessubhead");
let chnumofsales = aevforsales.length;
if ($("#SalesInformationaddsales").prop("checked")) {
for (i=0;i<saleslen;i++) {
sales[i].checked=true;
}
}
else{
for (i=0;i<saleslen;i++) {
sales[i].checked=false;
}
}
for (i=0;i<aevforsales.length;i++) {
if (aevforsales[i].checked) {
chnumofsales+=1;
}
else{
chnumofsales-=1;
}
}
for (i=0;i<saleslen;i++) {
if (chnumofsales==0) {
salessubhead[i].checked=false;
}
else{
salessubhead[i].checked=true;
}
}
}
function SalesInformationeditsales() {
let sales = document.getElementsByClassName("salesedit");
saleslen = sales.length;
let aevforsales = document.getElementsByClassName("aevforsales");
let salessubhead = document.getElementsByClassName("salessubhead");
let chnumofsales = aevforsales.length;
if ($("#SalesInformationeditsales").prop("checked")) {
for (i=0;i<saleslen;i++) {
sales[i].checked=true;
}
}
else{
for (i=0;i<saleslen;i++) {
sales[i].checked=false;
}
}
for (i=0;i<aevforsales.length;i++) {
if (aevforsales[i].checked) {
chnumofsales+=1;
}
else{
chnumofsales-=1;
}
}
for (i=0;i<saleslen;i++) {
if (chnumofsales==0) {
salessubhead[i].checked=false;
}
else{
salessubhead[i].checked=true;
}
}
}
function SalesInformationviewsales() {
let sales = document.getElementsByClassName("salesview");
saleslen = sales.length;
let aevforsales = document.getElementsByClassName("aevforsales");
let salessubhead = document.getElementsByClassName("salessubhead");
let chnumofsales = aevforsales.length;
if ($("#SalesInformationviewsales").prop("checked")) {
for (i=0;i<saleslen;i++) {
sales[i].checked=true;
}
}
else{
for (i=0;i<saleslen;i++) {
sales[i].checked=false;
}
}
for (i=0;i<aevforsales.length;i++) {
if (aevforsales[i].checked) {
chnumofsales+=1;
}
else{
chnumofsales-=1;
}
}
for (i=0;i<saleslen;i++) {
if (chnumofsales==0) {
salessubhead[i].checked=false;
}
else{
salessubhead[i].checked=true;
}
}
}
function PurchaseInformationaddpurchase() {
let purchase = document.getElementsByClassName("purchaseadd");
purchaselen = purchase.length;
let aevforpurchase = document.getElementsByClassName("aevforpurchase");
let purchasesubhead = document.getElementsByClassName("purchasesubhead");
let chnumofpurchase = aevforpurchase.length;
if ($("#PurchaseInformationaddpurchase").prop("checked")) {
for (i=0;i<purchaselen;i++) {
purchase[i].checked=true;
}
}
else{
for (i=0;i<purchaselen;i++) {
purchase[i].checked=false;
}
}
for (i=0;i<aevforpurchase.length;i++) {
if (aevforpurchase[i].checked) {
chnumofpurchase+=1;
}
else{
chnumofpurchase-=1;
}
}
for (i=0;i<purchaselen;i++) {
if (chnumofpurchase==0) {
purchasesubhead[i].checked=false;
}
else{
purchasesubhead[i].checked=true;
}
}
}
function PurchaseInformationeditpurchase() {
let purchase = document.getElementsByClassName("purchaseedit");
purchaselen = purchase.length;
let aevforpurchase = document.getElementsByClassName("aevforpurchase");
let purchasesubhead = document.getElementsByClassName("purchasesubhead");
let chnumofpurchase = aevforpurchase.length;
if ($("#PurchaseInformationeditpurchase").prop("checked")) {
for (i=0;i<purchaselen;i++) {
purchase[i].checked=true;
}
}
else{
for (i=0;i<purchaselen;i++) {
purchase[i].checked=false;
}
}
for (i=0;i<aevforpurchase.length;i++) {
if (aevforpurchase[i].checked) {
chnumofpurchase+=1;
}
else{
chnumofpurchase-=1;
}
}
for (i=0;i<purchaselen;i++) {
if (chnumofpurchase==0) {
purchasesubhead[i].checked=false;
}
else{
purchasesubhead[i].checked=true;
}
}
}
function PurchaseInformationviewpurchase() {
let purchase = document.getElementsByClassName("purchaseview");
purchaselen = purchase.length;
let aevforpurchase = document.getElementsByClassName("aevforpurchase");
let purchasesubhead = document.getElementsByClassName("purchasesubhead");
let chnumofpurchase = aevforpurchase.length;
if ($("#PurchaseInformationviewpurchase").prop("checked")) {
for (i=0;i<purchaselen;i++) {
purchase[i].checked=true;
}
}
else{
for (i=0;i<purchaselen;i++) {
purchase[i].checked=false;
}
}
for (i=0;i<aevforpurchase.length;i++) {
if (aevforpurchase[i].checked) {
chnumofpurchase+=1;
}
else{
chnumofpurchase-=1;
}
}
for (i=0;i<purchaselen;i++) {
if (chnumofpurchase==0) {
purchasesubhead[i].checked=false;
}
else{
purchasesubhead[i].checked=true;
}
}
}
function TaxInformationaddtax() {
let tax = document.getElementsByClassName("taxadd");
taxlen = tax.length;
let aevfortax = document.getElementsByClassName("aevfortax");
let taxsubhead = document.getElementsByClassName("taxsubhead");
let chnumoftax = aevfortax.length;
if ($("#TaxInformationaddtax").prop("checked")) {
for (i=0;i<taxlen;i++) {
tax[i].checked=true;
}
}
else{
for (i=0;i<taxlen;i++) {
tax[i].checked=false;
}
}
for (i=0;i<aevfortax.length;i++) {
if (aevfortax[i].checked) {
chnumoftax+=1;
}
else{
chnumoftax-=1;
}
}
for (i=0;i<taxlen;i++) {
if (chnumoftax==0) {
taxsubhead[i].checked=false;
}
else{
taxsubhead[i].checked=true;
}
}
}
function TaxInformationedittax() {
let tax = document.getElementsByClassName("taxedit");
taxlen = tax.length;
let aevfortax = document.getElementsByClassName("aevfortax");
let taxsubhead = document.getElementsByClassName("taxsubhead");
let chnumoftax = aevfortax.length;
if ($("#TaxInformationedittax").prop("checked")) {
for (i=0;i<taxlen;i++) {
tax[i].checked=true;
}
}
else{
for (i=0;i<taxlen;i++) {
tax[i].checked=false;
}
}
for (i=0;i<aevfortax.length;i++) {
if (aevfortax[i].checked) {
chnumoftax+=1;
}
else{
chnumoftax-=1;
}
}
for (i=0;i<taxlen;i++) {
if (chnumoftax==0) {
taxsubhead[i].checked=false;
}
else{
taxsubhead[i].checked=true;
}
}
}
function TaxInformationviewtax() {
let tax = document.getElementsByClassName("taxview");
taxlen = tax.length;
let aevfortax = document.getElementsByClassName("aevfortax");
let taxsubhead = document.getElementsByClassName("taxsubhead");
let chnumoftax = aevfortax.length;
if ($("#TaxInformationviewtax").prop("checked")) {
for (i=0;i<taxlen;i++) {
tax[i].checked=true;
}
}
else{
for (i=0;i<taxlen;i++) {
tax[i].checked=false;
}
}
for (i=0;i<aevfortax.length;i++) {
if (aevfortax[i].checked) {
chnumoftax+=1;
}
else{
chnumoftax-=1;
}
}
for (i=0;i<taxlen;i++) {
if (chnumoftax==0) {
taxsubhead[i].checked=false;
}
else{
taxsubhead[i].checked=true;
}
}
}
            </script>
<?php
}
?>
</div>
</div>
</div>
</div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallproductdef">
<svg id="rightarrowproductaccdef" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproductaccdef()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproductaccdef" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproductaccdef()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproductaccdef() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#productdefault').outerWidth()
            var scrollWidth = $('#productdefault')[0].scrollWidth; 
            var scrollLeft = $('#productdefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproductaccdef').style.visibility = 'hidden';
            document.getElementById('rightarrowproductaccdef').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproductaccdef').style.visibility = 'hidden';
            document.getElementById('leftarrowproductaccdef').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproductaccdef').style.visibility = 'visible';
            document.getElementById('rightarrowproductaccdef').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproductaccdef() {
            document.getElementById('productdefault').scrollLeft += -90;
            var width = $('#productdefault').outerWidth()
            var scrollWidth = $('#productdefault')[0].scrollWidth; 
            var scrollLeft = $('#productdefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproductaccdef').style.visibility = 'hidden';
            document.getElementById('rightarrowproductaccdef').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproductaccdef').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproductaccdef() {
            document.getElementById('productdefault').scrollLeft += 90;
            var width = $('#productdefault').outerWidth()
            var scrollWidth = $('#productdefault')[0].scrollWidth; 
            var scrollLeft = $('#productdefault').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproductaccdef').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproductaccdef').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #productdefault::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#productdefault::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#productdefault::-webkit-scrollbar-track {
  background-color: green;
}

#productdefault::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#productdefault::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallproductdef{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallproductdef{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchproductaccdef()" class="accordion-header scrollbar-2" id="productdefault" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#productdefaults"
                                                    aria-expanded="true" aria-controls="productdefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="productdefaults" class="accordion-collapse collapse show"
                                                aria-labelledby="productdefault">
                                                <div class="accordion-body text-sm">
                                                  <?php
                                                  $sqlismainaccessdef=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Products' order by id  asc");
                                                  $infomainaccessdef=mysqli_fetch_array($sqlismainaccessdef);
                                                  ?>
                                                  <div class="row pb-4" style="border-bottom:3px solid #eee;">
                                                                <div class="col-lg-2">
                                                                    <label class="custom-label mt-2">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="row">
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="defaultvisibleproduct" id="publicvisiblepro" value="PUBLIC" <?= ($infomainaccessdef['productvisible']=='PUBLIC')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="publicvisiblepro">Public</label>
                      </div>

                      </div>
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="defaultvisibleproduct" id="privatevisiblepro" value="PRIVATE" <?= ($infomainaccessdef['productvisible']=='PRIVATE')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="privatevisiblepro">Private</label>
                      </div>

                      </div>
                  </div>
              </div>
                                                                </div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
                      </div>
                      </div>
                      </div>
                      </div>

                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallproductdefbarcode">
<svg id="rightarrowproductaccdefbarcode" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproductaccdefbarcode()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproductaccdefbarcode" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproductaccdefbarcode()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproductaccdefbarcode() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#productbarcodedefault').outerWidth()
            var scrollWidth = $('#productbarcodedefault')[0].scrollWidth; 
            var scrollLeft = $('#productbarcodedefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproductaccdefbarcode').style.visibility = 'hidden';
            document.getElementById('rightarrowproductaccdefbarcode').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproductaccdefbarcode').style.visibility = 'hidden';
            document.getElementById('leftarrowproductaccdefbarcode').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproductaccdefbarcode').style.visibility = 'visible';
            document.getElementById('rightarrowproductaccdefbarcode').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproductaccdefbarcode() {
            document.getElementById('productbarcodedefault').scrollLeft += -90;
            var width = $('#productbarcodedefault').outerWidth()
            var scrollWidth = $('#productbarcodedefault')[0].scrollWidth; 
            var scrollLeft = $('#productbarcodedefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproductaccdefbarcode').style.visibility = 'hidden';
            document.getElementById('rightarrowproductaccdefbarcode').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproductaccdefbarcode').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproductaccdefbarcode() {
            document.getElementById('productbarcodedefault').scrollLeft += 90;
            var width = $('#productbarcodedefault').outerWidth()
            var scrollWidth = $('#productbarcodedefault')[0].scrollWidth; 
            var scrollLeft = $('#productbarcodedefault').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproductaccdefbarcode').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproductaccdefbarcode').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #productbarcodedefault::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#productbarcodedefault::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#productbarcodedefault::-webkit-scrollbar-track {
  background-color: green;
}

#productbarcodedefault::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#productbarcodedefault::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallproductdefbarcode{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallproductdefbarcode{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchproductaccdefbarcode()" class="accordion-header scrollbar-2" id="productbarcodedefault" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#productbarcodedefaults" aria-expanded="true" aria-controls="productbarcodedefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the specifications you would like to display in barcode</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="productbarcodedefaults" class="accordion-collapse collapse show" aria-labelledby="productbarcodedefault">
                                                <div class="accordion-body text-sm">
                                                  <div class="row pb-4" style="border-bottom:3px solid #eee;">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="barcodewidth" class="custom-label"><span
                                                                            class="text-danger">Barcode Width</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control  form-control-sm" id="barcodewidth" name="barcodewidth" placeholder="Barcode Width" value="<?=$access['barcodewidth']?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="barcodeheight" class="custom-label"><span
                                                                            class="text-danger">Barcode Height</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control  form-control-sm" id="barcodeheight" name="barcodeheight" placeholder="Barcode Height" value="<?=$access['barcodeheight']?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="barcoderesolution" class="custom-label"><span
                                                                            class="text-danger">Barcode Resolution</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control  form-control-sm" id="barcoderesolution" name="barcoderesolution" placeholder="Barcode Resolution" value="<?=$access['barcoderesolution']?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
                      </div>
                      </div>
                      </div>
                      </div>

<div class="accordion" id="accordionRental">
 <div class="accordion-item mb-1">
<div style="visibility: visible;" id="arrowsstockview">
<svg id="rightarrowstockview" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowstockview()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowstockview" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowstockview()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
  <script type="text/javascript">
 function checkscrolltouchstockview() {
// console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
// console.log($('#nav-tab').scrollLeft());
// console.log($('#nav-tab').width());
var width = $('#prostockviews').outerWidth()
var scrollWidth = $('#prostockviews')[0].scrollWidth; 
var scrollLeft = $('#prostockviews').scrollLeft();
if (scrollLeft===0){
document.getElementById('leftarrowstockview').style.visibility = 'hidden';
document.getElementById('rightarrowstockview').style.visibility = 'visible';
}
else if (scrollLeft!=0){
  if (scrollWidth - width === scrollLeft) {
document.getElementById('rightarrowstockview').style.visibility = 'hidden';
document.getElementById('leftarrowstockview').style.visibility = 'visible'; 
  }
  else{
document.getElementById('leftarrowstockview').style.visibility = 'visible';
document.getElementById('rightarrowstockview').style.visibility = 'visible';
 }
}
 }
 function leftarrowstockview() {
document.getElementById('prostockviews').scrollLeft += -90;
var width = $('#prostockviews').outerWidth()
var scrollWidth = $('#prostockviews')[0].scrollWidth; 
var scrollLeft = $('#prostockviews').scrollLeft();
if (scrollLeft===0){
document.getElementById('leftarrowstockview').style.visibility = 'hidden';
document.getElementById('rightarrowstockview').style.visibility = 'visible';
}
else{
document.getElementById('rightarrowstockview').style.visibility = 'visible';
}
 }
  </script>
  <script type="text/javascript">
 function rightarrowstockview() {
document.getElementById('prostockviews').scrollLeft += 90;
var width = $('#prostockviews').outerWidth()
var scrollWidth = $('#prostockviews')[0].scrollWidth; 
var scrollLeft = $('#prostockviews').scrollLeft();
// alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
if (scrollWidth - width === scrollLeft){
document.getElementById('rightarrowstockview').style.visibility = 'hidden';
}
document.getElementById('leftarrowstockview').style.visibility = 'visible';
 }
  </script>
  <style type="text/css">
  #prostockviews::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#prostockviews::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#prostockviews::-webkit-scrollbar-track {
  background-color: green;
}

#prostockviews::-webkit-scrollbar-button:horizontal:increment {
 background-color: #ffffff !important;
  height: 12px;
 width: 12px;
}

#prostockviews::-webkit-scrollbar-button:horizontal:decrement {
 background-color: #ffffff !important;
  height: 12px;
 width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
 scrollbar-width: none !important;
 scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
 scrollbar-width: none !important;
 scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsstockview{
 visibility: visible !important;
 display: block !important;
 margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 186px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 150px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 570px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 50px !important;
}
}
@media screen and (min-device-width: 571px) and (max-device-width: 3000px){
  #arrowsstockview{
 visibility: hidden !important;
 display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
</style>
<h5 ontouchmove="checkscrolltouchstockview()" class="accordion-header scrollbar-2" id="prostockviews" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button class="accordion-button" type="button"
 data-bs-toggle="collapse" data-bs-target="#prostockviews"
 aria-expanded="true" aria-controls="prostockviews">
 <div class="customcont-header ml-0 mb-1 mt-3">
  <a class="customcont-heading" style="font-size: 18px;"> Select the things you would like to display in view</a>
 </div>
</button>
  </h5>
</div>
  <div id="prostockviews" class="accordion-collapse collapse show" aria-labelledby="prostockview">
<div class="accordion-body text-sm">
 <div class="custom-control custom-checkbox mr-sm-2 mb-1">
<input type="checkbox" class="custom-control-input" name="stockonhand" id="stockonhand" <?= ($access['stockonhand']=='1')?'checked':'' ?> onchange="checkthelist(this)">
<label class="custom-control-label custom-label" for="stockonhand"> Stock on Hand</label>
 </div>
 <div class="custom-control custom-checkbox mr-sm-2 mt-1 mb-1">
<input type="checkbox" class="custom-control-input" name="proinvadjustment" id="proinvadjustment" <?= ($access['proinvadjustment']=='1')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="proinvadjustment"> <?=$infomainaccesspro['modulename']?> <?=$infomainaccessinv['modulename']?></label>
 </div>
 <br>
 <div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
 </div>
 </div>
 </div>
<div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallprocol">
<svg id="rightarrowproacccol" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproacccol()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproacccol" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproacccol()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproacccol() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#productcolumn').outerWidth()
            var scrollWidth = $('#productcolumn')[0].scrollWidth; 
            var scrollLeft = $('#productcolumn').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproacccol').style.visibility = 'hidden';
            document.getElementById('rightarrowproacccol').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproacccol').style.visibility = 'hidden';
            document.getElementById('leftarrowproacccol').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproacccol').style.visibility = 'visible';
            document.getElementById('rightarrowproacccol').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproacccol() {
            document.getElementById('productcolumn').scrollLeft += -90;
            var width = $('#productcolumn').outerWidth()
            var scrollWidth = $('#productcolumn')[0].scrollWidth; 
            var scrollLeft = $('#productcolumn').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproacccol').style.visibility = 'hidden';
            document.getElementById('rightarrowproacccol').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproacccol').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproacccol() {
            document.getElementById('productcolumn').scrollLeft += 90;
            var width = $('#productcolumn').outerWidth()
            var scrollWidth = $('#productcolumn')[0].scrollWidth; 
            var scrollLeft = $('#productcolumn').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproacccol').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproacccol').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #productcolumn::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#productcolumn::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#productcolumn::-webkit-scrollbar-track {
  background-color: green;
}

#productcolumn::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#productcolumn::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallprocol{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallprocol{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchproacccol()" class="accordion-header scrollbar-2" id="productcolumn" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;padding-bottom: 2px !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#productcolumns"
                                                    aria-expanded="true" aria-controls="productcolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable in all <?=strtolower($infomainaccesspro['modulename'])?></a>
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                            <div id="productcolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="productcolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Products' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style="  <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>col" id="<?= $coltypemod; ?>col" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= (($newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>col" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace("Category", $access['txtnamecategory'],$newmoduleskey) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
</div>
</div>
</div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallproductdefpage">
<svg id="rightarrowproductaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproductaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproductaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproductaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproductaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#productdefaultpage').outerWidth()
            var scrollWidth = $('#productdefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#productdefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproductaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowproductaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproductaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowproductaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproductaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowproductaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproductaccdefpage() {
            document.getElementById('productdefaultpage').scrollLeft += -90;
            var width = $('#productdefaultpage').outerWidth()
            var scrollWidth = $('#productdefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#productdefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproductaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowproductaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproductaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproductaccdefpage() {
            document.getElementById('productdefaultpage').scrollLeft += 90;
            var width = $('#productdefaultpage').outerWidth()
            var scrollWidth = $('#productdefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#productdefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproductaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproductaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #productdefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#productdefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#productdefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#productdefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#productdefaultpage::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallproductdefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallproductdefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchproductaccdefpage()" class="accordion-header scrollbar-2" id="productdefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#productdefaultspages"
                                                    aria-expanded="true" aria-controls="productdefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="productdefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="productdefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row" style="padding-top: 5px;padding-bottom: 0px;margin-bottom: 0px;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="propageload" id="propagenum" value="pagenum" <?= ($access['propageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="propagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="propageload" id="propageauto" value="pageauto" <?= ($access['propageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="propageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- </div> -->
            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>

<div class="tab-pane fade show mt-4 p-3 <?=((($infomainaccesspro['moduleaccess']!='1')&&($infomainaccessserv['moduleaccess']=='1'))?'active':'')?>" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab" <?=(($infomainaccessserv['moduleaccess']=='1')?'':'style="display:none"')?>>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallserv">
<svg id="rightarrowservacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowservacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowservacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowservacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchservacc() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#servicefield').outerWidth()
            var scrollWidth = $('#servicefield')[0].scrollWidth; 
            var scrollLeft = $('#servicefield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowservacc').style.visibility = 'hidden';
            document.getElementById('rightarrowservacc').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowservacc').style.visibility = 'hidden';
            document.getElementById('leftarrowservacc').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowservacc').style.visibility = 'visible';
            document.getElementById('rightarrowservacc').style.visibility = 'visible';
          }
            }
          }
          function leftarrowservacc() {
            document.getElementById('servicefield').scrollLeft += -90;
            var width = $('#servicefield').outerWidth()
            var scrollWidth = $('#servicefield')[0].scrollWidth; 
            var scrollLeft = $('#servicefield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowservacc').style.visibility = 'hidden';
            document.getElementById('rightarrowservacc').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowservacc').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowservacc() {
            document.getElementById('servicefield').scrollLeft += 90;
            var width = $('#servicefield').outerWidth()
            var scrollWidth = $('#servicefield')[0].scrollWidth; 
            var scrollLeft = $('#servicefield').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowservacc').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowservacc').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #servicefield::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#servicefield::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#servicefield::-webkit-scrollbar-track {
  background-color: green;
}

#servicefield::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#servicefield::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallserv{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallserv{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchservacc()" class="accordion-header scrollbar-2" id="servicefield" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#servicefields"
                                                    aria-expanded="true" aria-controls="servicefields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                            <div id="servicefields" class="accordion-collapse collapse show"
                                                aria-labelledby="servicefield">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Services' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Services' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Service Information')||($newmoduleskey=='Service Visibility')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Service Information')||($newmoduleskey=='Service Visibility')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='ServiceInformation')) {
                  $fullaccessans = 'service';
                }
                else if (($coltypemod=='ServiceVisibility')) {
                  $fullaccessans = 'servicesvisible';
                }
                else if (($coltypemod=='SalesInformation')) {
                  $fullaccessans = 'servsales';
                }
                else if (($coltypemod=='PurchaseInformation')) {
                  $fullaccessans = 'servpurchase';
                }
                else if (($coltypemod=='TaxInformation')) {
                  $fullaccessans = 'servtax';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>serv()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Service Public Code')||($newmoduleskey=='Service Private Code')||($newmoduleskey=='Service Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Unit')||($newmoduleskey=='SAC Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'services servicesubhead':'' ?> <?= (($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'servsales servsalessubhead':'' ?> <?= (($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'servpurchase servpurchasesubhead':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'servtax servtaxsubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>serv"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= (($newmoduleskey=='Service Information'||$newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>serv" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Service Information')||($newmoduleskey=='Service Visibility')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'royalblue':'' ?> !important;"> <?= str_replace(" or ", " / ",(str_replace("Service", $infomainaccessserv['modulename'],(str_replace("Sales", $infomainaccesssale['groupname'],(str_replace("Purchase", $infomainaccesspurchase['groupname'],$newmoduleskey))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>serv()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Service Public Code')||($newmoduleskey=='Service Private Code')||($newmoduleskey=='Service Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Unit')||($newmoduleskey=='SAC Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'services':'' ?> <?= (($newmoduleskey=='Service Visibility'))?'servicesvisible':'' ?> <?= (($newmoduleskey=='Sales Information')||($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'servsales':'' ?> <?= (($newmoduleskey=='Purchase Information')||($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'servpurchase':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'servtax':'' ?> <?= (($newmoduleskey=='Service Public Code')||($newmoduleskey=='Service Private Code')||($newmoduleskey=='Service Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Unit')||($newmoduleskey=='SAC Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'serviceadd aevforservice':'' ?> <?= (($newmoduleskey=='Service Visibility'))?'servicesvisible':'' ?> <?= (($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'servsalesadd aevforservsales':'' ?> <?= (($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'servpurchaseadd aevforservpurchase':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'servtaxadd aevforservtax':'' ?>" name="<?= $coltypemod; ?>addserv" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>serv" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= (($newmoduleskey=='Service Information'||$newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>serv" style="color:<?= (($newmoduleskey=='Service Information')||($newmoduleskey=='Service Visibility')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>serv()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Service Public Code')||($newmoduleskey=='Service Private Code')||($newmoduleskey=='Service Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Unit')||($newmoduleskey=='SAC Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'services':'' ?> <?= (($newmoduleskey=='Service Visibility'))?'servicesvisible':'' ?> <?= (($newmoduleskey=='Sales Information')||($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'servsales':'' ?> <?= (($newmoduleskey=='Purchase Information')||($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'servpurchase':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'servtax':'' ?> <?= (($newmoduleskey=='Service Public Code')||($newmoduleskey=='Service Private Code')||($newmoduleskey=='Service Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Unit')||($newmoduleskey=='SAC Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'serviceedit aevforservice':'' ?> <?= (($newmoduleskey=='Service Visibility'))?'servicesvisible':'' ?> <?= (($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'servsalesedit aevforservsales':'' ?> <?= (($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'servpurchaseedit aevforservpurchase':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'servtaxedit aevforservtax':'' ?>" name="<?= $coltypemod; ?>editserv" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>serv" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?> <?= (($newmoduleskey=='Service Information'||$newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>serv" style="color:<?= (($newmoduleskey=='Service Information')||($newmoduleskey=='Service Visibility')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>serv()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Service Public Code')||($newmoduleskey=='Service Private Code')||($newmoduleskey=='Service Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Unit')||($newmoduleskey=='SAC Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'services':'' ?> <?= (($newmoduleskey=='Service Visibility'))?'servicesvisible':'' ?> <?= (($newmoduleskey=='Sales Information')||($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'servsales':'' ?> <?= (($newmoduleskey=='Purchase Information')||($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'servpurchase':'' ?> <?= (($newmoduleskey=='Tax Information')||($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'servtax':'' ?> <?= (($newmoduleskey=='Service Public Code')||($newmoduleskey=='Service Private Code')||($newmoduleskey=='Service Code')||($newmoduleskey=='Code or Tags')||($newmoduleskey=='Unit')||($newmoduleskey=='SAC Code')||($newmoduleskey=='Category')||($newmoduleskey=='Sub Category')||($newmoduleskey=='Delivery')||($newmoduleskey=='Description'))?'serviceview aevforservice':'' ?> <?= (($newmoduleskey=='Service Visibility'))?'servicesvisible':'' ?> <?= (($newmoduleskey=='Sale Price Name')||($newmoduleskey=='Sale MRP')||($newmoduleskey=='Sale Price Rate')||($newmoduleskey=='Sale Description'))?'servsalesview aevforservsales':'' ?> <?= (($newmoduleskey=='Purchase Price Name')||($newmoduleskey=='Purchase MRP')||($newmoduleskey=='Purchase Price Rate')||($newmoduleskey=='Purchase Description'))?'servpurchaseview aevforservpurchase':'' ?> <?= (($newmoduleskey=='Tax Preference')||($newmoduleskey=='Tax Rate')||($newmoduleskey=='Intra State Tax Rate')||($newmoduleskey=='Inter State Tax Rate'))?'servtaxview aevforservtax':'' ?>" name="<?= $coltypemod; ?>viewserv" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>serv" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= (($newmoduleskey=='Service Information'||$newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>serv" style="color:<?= (($newmoduleskey=='Service Information')||($newmoduleskey=='Service Visibility')||($newmoduleskey=='Sales Information')||($newmoduleskey=='Purchase Information')||($newmoduleskey=='Tax Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              // function ServiceInformationserviceserv() {
              //   let services = document.getElementsByClassName("services");
              //   serviceslen = services.length;
              //   if ($("#ServiceInformationserviceserv").prop("checked")) {
              //   for (i=0;i<serviceslen;i++) {
              //   services[i].checked=true;
              //   services[i].disabled=false;
              //   }
              //   }
              //   else{
              //   for (i=0;i<serviceslen;i++) {
              //   services[i].checked=false;
              //   services[i].disabled=true;
              //   }
              //   }
              // }
              function ServiceVisibilityservicesvisibleserv() {
                let servicesvisible = document.getElementsByClassName("servicesvisible");
                serviceslen = servicesvisible.length;
                if ($("#ServiceVisibilityservicesvisibleserv").prop("checked")) {
                for (i=0;i<serviceslen;i++) {
                servicesvisible[i].checked=true;
                servicesvisible[i].disabled=false;
                }
                }
                else{
                for (i=0;i<serviceslen;i++) {
                servicesvisible[i].checked=false;
                servicesvisible[i].disabled=true;
                }
                }
              }
              function SalesInformationservsalesserv() {
                let sales = document.getElementsByClassName("servsales");
                serviceslen = sales.length;
                if ($("#SalesInformationservsalesserv").prop("checked")) {
                for (i=0;i<serviceslen;i++) {
                sales[i].checked=true;
                sales[i].disabled=false;
                }
                }
                else{
                for (i=0;i<serviceslen;i++) {
                sales[i].checked=false;
                sales[i].disabled=true;
                }
                }
              }
              function PurchaseInformationservpurchaseserv() {
                let purchase = document.getElementsByClassName("servpurchase");
                serviceslen = purchase.length;
                if ($("#PurchaseInformationservpurchaseserv").prop("checked")) {
                for (i=0;i<serviceslen;i++) {
                purchase[i].checked=true;
                purchase[i].disabled=false;
                }
                }
                else{
                for (i=0;i<serviceslen;i++) {
                purchase[i].checked=false;
                purchase[i].disabled=true;
                }
                }
              }
              function TaxInformationservtaxserv() {
                let tax = document.getElementsByClassName("servtax");
                serviceslen = tax.length;
                if ($("#TaxInformationservtaxserv").prop("checked")) {
                for (i=0;i<serviceslen;i++) {
                tax[i].checked=true;
                tax[i].disabled=false;
                }
                }
                else{
                for (i=0;i<serviceslen;i++) {
                tax[i].checked=false;
                tax[i].disabled=true;
                }
                }
              }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>serv() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>serv");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>serv");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>serv");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>serv");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
// let servicesubhead = document.getElementsByClassName("servicesubhead");
// let servicesubheadchnumof = servicesubhead.length;
// for (i=0;i<servicesubhead.length;i++) {
// if (servicesubhead[i].checked) {
// servicesubheadchnumof+=1;
// }
// else{
// servicesubheadchnumof-=1;
// }
// }
// if (servicesubheadchnumof==0) {
// document.getElementById("ServiceInformationserviceserv").checked=false;
// document.getElementById("ServiceInformationaddserviceserv").checked=false;
// document.getElementById("ServiceInformationeditserviceserv").checked=false;
// document.getElementById("ServiceInformationviewserviceserv").checked=false;
// }
// else{
// document.getElementById("ServiceInformationserviceserv").checked=true;
// document.getElementById("ServiceInformationaddserviceserv").checked=true;
// document.getElementById("ServiceInformationeditserviceserv").checked=true;
// document.getElementById("ServiceInformationviewserviceserv").checked=true;
// }
let servsalessubhead = document.getElementsByClassName("servsalessubhead");
let servsalessubheadchnumof = servsalessubhead.length;
for (i=0;i<servsalessubhead.length;i++) {
if (servsalessubhead[i].checked) {
servsalessubheadchnumof+=1;
}
else{
servsalessubheadchnumof-=1;
}
}
if (servsalessubheadchnumof==0) {
document.getElementById("SalesInformationservsalesserv").checked=false;
document.getElementById("SalesInformationaddservsalesserv").checked=false;
document.getElementById("SalesInformationeditservsalesserv").checked=false;
document.getElementById("SalesInformationviewservsalesserv").checked=false;
}
else{
document.getElementById("SalesInformationservsalesserv").checked=true;
document.getElementById("SalesInformationaddservsalesserv").checked=true;
document.getElementById("SalesInformationeditservsalesserv").checked=true;
document.getElementById("SalesInformationviewservsalesserv").checked=true;
}
let servpurchasesubhead = document.getElementsByClassName("servpurchasesubhead");
let servpurchasesubheadchnumof = servpurchasesubhead.length;
for (i=0;i<servpurchasesubhead.length;i++) {
if (servpurchasesubhead[i].checked) {
servpurchasesubheadchnumof+=1;
}
else{
servpurchasesubheadchnumof-=1;
}
}
if (servpurchasesubheadchnumof==0) {
document.getElementById("PurchaseInformationservpurchaseserv").checked=false;
document.getElementById("PurchaseInformationaddservpurchaseserv").checked=false;
document.getElementById("PurchaseInformationeditservpurchaseserv").checked=false;
document.getElementById("PurchaseInformationviewservpurchaseserv").checked=false;
}
else{
document.getElementById("PurchaseInformationservpurchaseserv").checked=true;
document.getElementById("PurchaseInformationaddservpurchaseserv").checked=true;
document.getElementById("PurchaseInformationeditservpurchaseserv").checked=true;
document.getElementById("PurchaseInformationviewservpurchaseserv").checked=true;
}
let servtaxsubhead = document.getElementsByClassName("servtaxsubhead");
let servtaxsubheadchnumof = servtaxsubhead.length;
for (i=0;i<servtaxsubhead.length;i++) {
if (servtaxsubhead[i].checked) {
servtaxsubheadchnumof+=1;
}
else{
servtaxsubheadchnumof-=1;
}
}
if (servtaxsubheadchnumof==0) {
document.getElementById("TaxInformationservtaxserv").checked=false;
document.getElementById("TaxInformationaddservtaxserv").checked=false;
document.getElementById("TaxInformationeditservtaxserv").checked=false;
document.getElementById("TaxInformationviewservtaxserv").checked=false;
}
else{
document.getElementById("TaxInformationservtaxserv").checked=true;
document.getElementById("TaxInformationaddservtaxserv").checked=true;
document.getElementById("TaxInformationeditservtaxserv").checked=true;
document.getElementById("TaxInformationviewservtaxserv").checked=true;
}
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>serv() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>serv");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>serv");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>serv");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>serv");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                // if (($coltypemod=='ServicePublicCode')||($coltypemod=='ServicePrivateCode')||($coltypemod=='ServiceCode')||($coltypemod=='CodeorTags')||($coltypemod=='Unit')||($coltypemod=='SACCode')||($coltypemod=='Category')||($coltypemod=='SubCategory')||($coltypemod=='Delivery')||($coltypemod=='Description')) {
                ?>
                // let aevforservicech = document.getElementsByClassName("aevforservice");
                // let aevchnumofservice = aevforservicech.length;
                // for (i=0;i<aevforservicech.length;i++) {
                // if (aevforservicech[i].checked) {
                //     aevchnumofservice+=1;
                // }
                // else{
                //     aevchnumofservice-=1;
                // }
                // }
                //     if (aevchnumofservice==0) {
                //     document.getElementById("ServiceInformationserviceserv").checked=false;
                //     }
                //     else{
                //     document.getElementById("ServiceInformationserviceserv").checked=true;
                // }
                // let aevforserviceadd = document.getElementsByClassName("serviceadd");
                // let aevnumofserviceadd = aevforserviceadd.length;
                // for (i=0;i<aevforserviceadd.length;i++) {
                // if (aevforserviceadd[i].checked) {
                //     aevnumofserviceadd+=1;
                // }
                // else{
                //     aevnumofserviceadd-=1;
                // }
                // }
                // if (aevnumofserviceadd==0) {
                // document.getElementById("ServiceInformationaddserviceserv").checked=false;
                // }
                // else{
                // document.getElementById("ServiceInformationaddserviceserv").checked=true;
                // }
                // let aevforserviceedit = document.getElementsByClassName("serviceedit");
                // let aevnumofserviceedit = aevforserviceedit.length;
                // for (i=0;i<aevforserviceedit.length;i++) {
                // if (aevforserviceedit[i].checked) {
                //     aevnumofserviceedit+=1;
                // }
                // else{
                //     aevnumofserviceedit-=1;
                // }
                // }
                // if (aevnumofserviceedit==0) {
                // document.getElementById("ServiceInformationeditserviceserv").checked=false;
                // }
                // else{
                // document.getElementById("ServiceInformationeditserviceserv").checked=true;
                // }
                // let aevforserviceview = document.getElementsByClassName("serviceview");
                // let aevnumofserviceview = aevforserviceview.length;
                // for (i=0;i<aevforserviceview.length;i++) {
                // if (aevforserviceview[i].checked) {
                //     aevnumofserviceview+=1;
                // }
                // else{
                //     aevnumofserviceview-=1;
                // }
                // }
                // if (aevnumofserviceview==0) {
                // document.getElementById("ServiceInformationviewserviceserv").checked=false;
                // }
                // else{
                // document.getElementById("ServiceInformationviewserviceserv").checked=true;
                // }
                <?php
                // }
                if (($coltypemod=='SalePriceName')||($coltypemod=='SaleMRP')||($coltypemod=='SalePriceRate')||($coltypemod=='SaleDescription')) {
                ?>
                let aevforservsalesch = document.getElementsByClassName("aevforservsales");
                let aevchnumofservsales = aevforservsalesch.length;
                for (i=0;i<aevforservsalesch.length;i++) {
                if (aevforservsalesch[i].checked) {
                    aevchnumofservsales+=1;
                }
                else{
                    aevchnumofservsales-=1;
                }
                }
                    if (aevchnumofservsales==0) {
                    document.getElementById("SalesInformationservsalesserv").checked=false;
                    }
                    else{
                    document.getElementById("SalesInformationservsalesserv").checked=true;
                }
                let aevforservsalesadd = document.getElementsByClassName("servsalesadd");
                let aevnumofservsalesadd = aevforservsalesadd.length;
                for (i=0;i<aevforservsalesadd.length;i++) {
                if (aevforservsalesadd[i].checked) {
                    aevnumofservsalesadd+=1;
                }
                else{
                    aevnumofservsalesadd-=1;
                }
                }
                if (aevnumofservsalesadd==0) {
                document.getElementById("SalesInformationaddservsalesserv").checked=false;
                }
                else{
                document.getElementById("SalesInformationaddservsalesserv").checked=true;
                }
                let aevforservsalesedit = document.getElementsByClassName("servsalesedit");
                let aevnumofservsalesedit = aevforservsalesedit.length;
                for (i=0;i<aevforservsalesedit.length;i++) {
                if (aevforservsalesedit[i].checked) {
                    aevnumofservsalesedit+=1;
                }
                else{
                    aevnumofservsalesedit-=1;
                }
                }
                if (aevnumofservsalesedit==0) {
                document.getElementById("SalesInformationeditservsalesserv").checked=false;
                }
                else{
                document.getElementById("SalesInformationeditservsalesserv").checked=true;
                }
                let aevforservsalesview = document.getElementsByClassName("servsalesview");
                let aevnumofservsalesview = aevforservsalesview.length;
                for (i=0;i<aevforservsalesview.length;i++) {
                if (aevforservsalesview[i].checked) {
                    aevnumofservsalesview+=1;
                }
                else{
                    aevnumofservsalesview-=1;
                }
                }
                if (aevnumofservsalesview==0) {
                document.getElementById("SalesInformationviewservsalesserv").checked=false;
                }
                else{
                document.getElementById("SalesInformationviewservsalesserv").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='PurchasePriceName')||($coltypemod=='PurchaseMRP')||($coltypemod=='PurchasePriceRate')||($coltypemod=='PurchaseDescription')) {
                ?>
                let aevforservpurchasech = document.getElementsByClassName("aevforservpurchase");
                let aevchnumofservpurchase = aevforservpurchasech.length;
                for (i=0;i<aevforservpurchasech.length;i++) {
                if (aevforservpurchasech[i].checked) {
                    aevchnumofservpurchase+=1;
                }
                else{
                    aevchnumofservpurchase-=1;
                }
                }
                    if (aevchnumofservpurchase==0) {
                    document.getElementById("PurchaseInformationservpurchaseserv").checked=false;
                    }
                    else{
                    document.getElementById("PurchaseInformationservpurchaseserv").checked=true;
                }
                let aevforservpurchaseadd = document.getElementsByClassName("servpurchaseadd");
                let aevnumofservpurchaseadd = aevforservpurchaseadd.length;
                for (i=0;i<aevforservpurchaseadd.length;i++) {
                if (aevforservpurchaseadd[i].checked) {
                    aevnumofservpurchaseadd+=1;
                }
                else{
                    aevnumofservpurchaseadd-=1;
                }
                }
                if (aevnumofservpurchaseadd==0) {
                document.getElementById("PurchaseInformationaddservpurchaseserv").checked=false;
                }
                else{
                document.getElementById("PurchaseInformationaddservpurchaseserv").checked=true;
                }
                let aevforservpurchaseedit = document.getElementsByClassName("servpurchaseedit");
                let aevnumofservpurchaseedit = aevforservpurchaseedit.length;
                for (i=0;i<aevforservpurchaseedit.length;i++) {
                if (aevforservpurchaseedit[i].checked) {
                    aevnumofservpurchaseedit+=1;
                }
                else{
                    aevnumofservpurchaseedit-=1;
                }
                }
                if (aevnumofservpurchaseedit==0) {
                document.getElementById("PurchaseInformationeditservpurchaseserv").checked=false;
                }
                else{
                document.getElementById("PurchaseInformationeditservpurchaseserv").checked=true;
                }
                let aevforservpurchaseview = document.getElementsByClassName("servpurchaseview");
                let aevnumofservpurchaseview = aevforservpurchaseview.length;
                for (i=0;i<aevforservpurchaseview.length;i++) {
                if (aevforservpurchaseview[i].checked) {
                    aevnumofservpurchaseview+=1;
                }
                else{
                    aevnumofservpurchaseview-=1;
                }
                }
                if (aevnumofservpurchaseview==0) {
                document.getElementById("PurchaseInformationviewservpurchaseserv").checked=false;
                }
                else{
                document.getElementById("PurchaseInformationviewservpurchaseserv").checked=true;
                }
                <?php
                }
                else if (($coltypemod=='TaxPreference')||($coltypemod=='TaxRate')||($coltypemod=='IntraStateTaxRate')||($coltypemod=='InterStateTaxRate')) {
                ?>
                let aevforservtaxch = document.getElementsByClassName("aevforservtax");
                let aevchnumofservtax = aevforservtaxch.length;
                for (i=0;i<aevforservtaxch.length;i++) {
                if (aevforservtaxch[i].checked) {
                    aevchnumofservtax+=1;
                }
                else{
                    aevchnumofservtax-=1;
                }
                }
                    if (aevchnumofservtax==0) {
                    document.getElementById("TaxInformationservtaxserv").checked=false;
                    }
                    else{
                    document.getElementById("TaxInformationservtaxserv").checked=true;
                }
                let aevforservtaxadd = document.getElementsByClassName("servtaxadd");
                let aevnumofservtaxadd = aevforservtaxadd.length;
                for (i=0;i<aevforservtaxadd.length;i++) {
                if (aevforservtaxadd[i].checked) {
                    aevnumofservtaxadd+=1;
                }
                else{
                    aevnumofservtaxadd-=1;
                }
                }
                if (aevnumofservtaxadd==0) {
                document.getElementById("TaxInformationaddservtaxserv").checked=false;
                }
                else{
                document.getElementById("TaxInformationaddservtaxserv").checked=true;
                }
                let aevforservtaxedit = document.getElementsByClassName("servtaxedit");
                let aevnumofservtaxedit = aevforservtaxedit.length;
                for (i=0;i<aevforservtaxedit.length;i++) {
                if (aevforservtaxedit[i].checked) {
                    aevnumofservtaxedit+=1;
                }
                else{
                    aevnumofservtaxedit-=1;
                }
                }
                if (aevnumofservtaxedit==0) {
                document.getElementById("TaxInformationeditservtaxserv").checked=false;
                }
                else{
                document.getElementById("TaxInformationeditservtaxserv").checked=true;
                }
                let aevforservtaxview = document.getElementsByClassName("servtaxview");
                let aevnumofservtaxview = aevforservtaxview.length;
                for (i=0;i<aevforservtaxview.length;i++) {
                if (aevforservtaxview[i].checked) {
                    aevnumofservtaxview+=1;
                }
                else{
                    aevnumofservtaxview-=1;
                }
                }
                if (aevnumofservtaxview==0) {
                document.getElementById("TaxInformationviewservtaxserv").checked=false;
                }
                else{
                document.getElementById("TaxInformationviewservtaxserv").checked=true;
                }
                <?php
                }
                ?>
              }
// function ServiceInformationaddservice() {
// let service = document.getElementsByClassName("serviceadd");
// servicelen = service.length;
// let aevforservice = document.getElementsByClassName("aevforservice");
// let servicesubhead = document.getElementsByClassName("servicesubhead");
// let chnumofservice = aevforservice.length;
// if ($("#ServiceInformationaddserviceserv").prop("checked")) {
// for (i=0;i<servicelen;i++) {
// service[i].checked=true;
// }
// }
// else{
// for (i=0;i<servicelen;i++) {
// service[i].checked=false;
// }
// }
// for (i=0;i<aevforservice.length;i++) {
// if (aevforservice[i].checked) {
// chnumofservice+=1;
// }
// else{
// chnumofservice-=1;
// }
// }
// for (i=0;i<servicelen;i++) {
// if (chnumofservice==0) {
// servicesubhead[i].checked=false;
// }
// else{
// servicesubhead[i].checked=true;
// }
// }
// }
// function ServiceInformationeditservice() {
// let service = document.getElementsByClassName("serviceedit");
// servicelen = service.length;
// let aevforservice = document.getElementsByClassName("aevforservice");
// let servicesubhead = document.getElementsByClassName("servicesubhead");
// let chnumofservice = aevforservice.length;
// if ($("#ServiceInformationeditserviceserv").prop("checked")) {
// for (i=0;i<servicelen;i++) {
// service[i].checked=true;
// }
// }
// else{
// for (i=0;i<servicelen;i++) {
// service[i].checked=false;
// }
// }
// for (i=0;i<aevforservice.length;i++) {
// if (aevforservice[i].checked) {
// chnumofservice+=1;
// }
// else{
// chnumofservice-=1;
// }
// }
// for (i=0;i<servicelen;i++) {
// if (chnumofservice==0) {
// servicesubhead[i].checked=false;
// }
// else{
// servicesubhead[i].checked=true;
// }
// }
// }
// function ServiceInformationviewservice() {
// let service = document.getElementsByClassName("serviceview");
// servicelen = service.length;
// let aevforservice = document.getElementsByClassName("aevforservice");
// let servicesubhead = document.getElementsByClassName("servicesubhead");
// let chnumofservice = aevforservice.length;
// if ($("#ServiceInformationviewserviceserv").prop("checked")) {
// for (i=0;i<servicelen;i++) {
// service[i].checked=true;
// }
// }
// else{
// for (i=0;i<servicelen;i++) {
// service[i].checked=false;
// }
// }
// for (i=0;i<aevforservice.length;i++) {
// if (aevforservice[i].checked) {
// chnumofservice+=1;
// }
// else{
// chnumofservice-=1;
// }
// }
// for (i=0;i<servicelen;i++) {
// if (chnumofservice==0) {
// servicesubhead[i].checked=false;
// }
// else{
// servicesubhead[i].checked=true;
// }
// }
// }
function SalesInformationaddservsales() {
let servsales = document.getElementsByClassName("servsalesadd");
servsaleslen = servsales.length;
let aevforservsales = document.getElementsByClassName("aevforservsales");
let servsalessubhead = document.getElementsByClassName("servsalessubhead");
let chnumofservsales = aevforservsales.length;
if ($("#SalesInformationaddservsalesserv").prop("checked")) {
for (i=0;i<servsaleslen;i++) {
servsales[i].checked=true;
}
}
else{
for (i=0;i<servsaleslen;i++) {
servsales[i].checked=false;
}
}
for (i=0;i<aevforservsales.length;i++) {
if (aevforservsales[i].checked) {
chnumofservsales+=1;
}
else{
chnumofservsales-=1;
}
}
for (i=0;i<servsaleslen;i++) {
if (chnumofservsales==0) {
servsalessubhead[i].checked=false;
}
else{
servsalessubhead[i].checked=true;
}
}
}
function SalesInformationeditservsales() {
let servsales = document.getElementsByClassName("servsalesedit");
servsaleslen = servsales.length;
let aevforservsales = document.getElementsByClassName("aevforservsales");
let servsalessubhead = document.getElementsByClassName("servsalessubhead");
let chnumofservsales = aevforservsales.length;
if ($("#SalesInformationeditservsalesserv").prop("checked")) {
for (i=0;i<servsaleslen;i++) {
servsales[i].checked=true;
}
}
else{
for (i=0;i<servsaleslen;i++) {
servsales[i].checked=false;
}
}
for (i=0;i<aevforservsales.length;i++) {
if (aevforservsales[i].checked) {
chnumofservsales+=1;
}
else{
chnumofservsales-=1;
}
}
for (i=0;i<servsaleslen;i++) {
if (chnumofservsales==0) {
servsalessubhead[i].checked=false;
}
else{
servsalessubhead[i].checked=true;
}
}
}
function SalesInformationviewservsales() {
let servsales = document.getElementsByClassName("servsalesview");
servsaleslen = servsales.length;
let aevforservsales = document.getElementsByClassName("aevforservsales");
let servsalessubhead = document.getElementsByClassName("servsalessubhead");
let chnumofservsales = aevforservsales.length;
if ($("#SalesInformationviewservsalesserv").prop("checked")) {
for (i=0;i<servsaleslen;i++) {
servsales[i].checked=true;
}
}
else{
for (i=0;i<servsaleslen;i++) {
servsales[i].checked=false;
}
}
for (i=0;i<aevforservsales.length;i++) {
if (aevforservsales[i].checked) {
chnumofservsales+=1;
}
else{
chnumofservsales-=1;
}
}
for (i=0;i<servsaleslen;i++) {
if (chnumofservsales==0) {
servsalessubhead[i].checked=false;
}
else{
servsalessubhead[i].checked=true;
}
}
}
function PurchaseInformationaddservpurchase() {
let servpurchase = document.getElementsByClassName("servpurchaseadd");
servpurchaselen = servpurchase.length;
let aevforservpurchase = document.getElementsByClassName("aevforservpurchase");
let servpurchasesubhead = document.getElementsByClassName("servpurchasesubhead");
let chnumofservpurchase = aevforservpurchase.length;
if ($("#PurchaseInformationaddservpurchaseserv").prop("checked")) {
for (i=0;i<servpurchaselen;i++) {
servpurchase[i].checked=true;
}
}
else{
for (i=0;i<servpurchaselen;i++) {
servpurchase[i].checked=false;
}
}
for (i=0;i<aevforservpurchase.length;i++) {
if (aevforservpurchase[i].checked) {
chnumofservpurchase+=1;
}
else{
chnumofservpurchase-=1;
}
}
for (i=0;i<servpurchaselen;i++) {
if (chnumofservpurchase==0) {
servpurchasesubhead[i].checked=false;
}
else{
servpurchasesubhead[i].checked=true;
}
}
}
function PurchaseInformationeditservpurchase() {
let servpurchase = document.getElementsByClassName("servpurchaseedit");
servpurchaselen = servpurchase.length;
let aevforservpurchase = document.getElementsByClassName("aevforservpurchase");
let servpurchasesubhead = document.getElementsByClassName("servpurchasesubhead");
let chnumofservpurchase = aevforservpurchase.length;
if ($("#PurchaseInformationeditservpurchaseserv").prop("checked")) {
for (i=0;i<servpurchaselen;i++) {
servpurchase[i].checked=true;
}
}
else{
for (i=0;i<servpurchaselen;i++) {
servpurchase[i].checked=false;
}
}
for (i=0;i<aevforservpurchase.length;i++) {
if (aevforservpurchase[i].checked) {
chnumofservpurchase+=1;
}
else{
chnumofservpurchase-=1;
}
}
for (i=0;i<servpurchaselen;i++) {
if (chnumofservpurchase==0) {
servpurchasesubhead[i].checked=false;
}
else{
servpurchasesubhead[i].checked=true;
}
}
}
function PurchaseInformationviewservpurchase() {
let servpurchase = document.getElementsByClassName("servpurchaseview");
servpurchaselen = servpurchase.length;
let aevforservpurchase = document.getElementsByClassName("aevforservpurchase");
let servpurchasesubhead = document.getElementsByClassName("servpurchasesubhead");
let chnumofservpurchase = aevforservpurchase.length;
if ($("#PurchaseInformationviewservpurchaseserv").prop("checked")) {
for (i=0;i<servpurchaselen;i++) {
servpurchase[i].checked=true;
}
}
else{
for (i=0;i<servpurchaselen;i++) {
servpurchase[i].checked=false;
}
}
for (i=0;i<aevforservpurchase.length;i++) {
if (aevforservpurchase[i].checked) {
chnumofservpurchase+=1;
}
else{
chnumofservpurchase-=1;
}
}
for (i=0;i<servpurchaselen;i++) {
if (chnumofservpurchase==0) {
servpurchasesubhead[i].checked=false;
}
else{
servpurchasesubhead[i].checked=true;
}
}
}
function TaxInformationaddservtax() {
let servtax = document.getElementsByClassName("servtaxadd");
servtaxlen = servtax.length;
let aevforservtax = document.getElementsByClassName("aevforservtax");
let servtaxsubhead = document.getElementsByClassName("servtaxsubhead");
let chnumofservtax = aevforservtax.length;
if ($("#TaxInformationaddservtaxserv").prop("checked")) {
for (i=0;i<servtaxlen;i++) {
servtax[i].checked=true;
}
}
else{
for (i=0;i<servtaxlen;i++) {
servtax[i].checked=false;
}
}
for (i=0;i<aevforservtax.length;i++) {
if (aevforservtax[i].checked) {
chnumofservtax+=1;
}
else{
chnumofservtax-=1;
}
}
for (i=0;i<servtaxlen;i++) {
if (chnumofservtax==0) {
servtaxsubhead[i].checked=false;
}
else{
servtaxsubhead[i].checked=true;
}
}
}
function TaxInformationeditservtax() {
let servtax = document.getElementsByClassName("servtaxedit");
servtaxlen = servtax.length;
let aevforservtax = document.getElementsByClassName("aevforservtax");
let servtaxsubhead = document.getElementsByClassName("servtaxsubhead");
let chnumofservtax = aevforservtax.length;
if ($("#TaxInformationeditservtaxserv").prop("checked")) {
for (i=0;i<servtaxlen;i++) {
servtax[i].checked=true;
}
}
else{
for (i=0;i<servtaxlen;i++) {
servtax[i].checked=false;
}
}
for (i=0;i<aevforservtax.length;i++) {
if (aevforservtax[i].checked) {
chnumofservtax+=1;
}
else{
chnumofservtax-=1;
}
}
for (i=0;i<servtaxlen;i++) {
if (chnumofservtax==0) {
servtaxsubhead[i].checked=false;
}
else{
servtaxsubhead[i].checked=true;
}
}
}
function TaxInformationviewservtax() {
let servtax = document.getElementsByClassName("servtaxview");
servtaxlen = servtax.length;
let aevforservtax = document.getElementsByClassName("aevforservtax");
let servtaxsubhead = document.getElementsByClassName("servtaxsubhead");
let chnumofservtax = aevforservtax.length;
if ($("#TaxInformationviewservtaxserv").prop("checked")) {
for (i=0;i<servtaxlen;i++) {
servtax[i].checked=true;
}
}
else{
for (i=0;i<servtaxlen;i++) {
servtax[i].checked=false;
}
}
for (i=0;i<aevforservtax.length;i++) {
if (aevforservtax[i].checked) {
chnumofservtax+=1;
}
else{
chnumofservtax-=1;
}
}
for (i=0;i<servtaxlen;i++) {
if (chnumofservtax==0) {
servtaxsubhead[i].checked=false;
}
else{
servtaxsubhead[i].checked=true;
}
}
}
            </script>
<?php
}
?>
<div class="row" style="border-top:1px solid #eee;padding:0px 0;"></div>
            </div>
            </div>
            </div>
            </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallservicedef">
<svg id="rightarrowserviceaccdef" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowserviceaccdef()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowserviceaccdef" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowserviceaccdef()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchserviceaccdef() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#servicedefault').outerWidth()
            var scrollWidth = $('#servicedefault')[0].scrollWidth; 
            var scrollLeft = $('#servicedefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowserviceaccdef').style.visibility = 'hidden';
            document.getElementById('rightarrowserviceaccdef').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowserviceaccdef').style.visibility = 'hidden';
            document.getElementById('leftarrowserviceaccdef').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowserviceaccdef').style.visibility = 'visible';
            document.getElementById('rightarrowserviceaccdef').style.visibility = 'visible';
          }
            }
          }
          function leftarrowserviceaccdef() {
            document.getElementById('servicedefault').scrollLeft += -90;
            var width = $('#servicedefault').outerWidth()
            var scrollWidth = $('#servicedefault')[0].scrollWidth; 
            var scrollLeft = $('#servicedefault').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowserviceaccdef').style.visibility = 'hidden';
            document.getElementById('rightarrowserviceaccdef').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowserviceaccdef').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowserviceaccdef() {
            document.getElementById('servicedefault').scrollLeft += 90;
            var width = $('#servicedefault').outerWidth()
            var scrollWidth = $('#servicedefault')[0].scrollWidth; 
            var scrollLeft = $('#servicedefault').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowserviceaccdef').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowserviceaccdef').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #servicedefault::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#servicedefault::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#servicedefault::-webkit-scrollbar-track {
  background-color: green;
}

#servicedefault::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#servicedefault::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallservicedef{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallservicedef{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchserviceaccdef()" class="accordion-header scrollbar-2" id="servicedefault" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#servicedefaults"
                                                    aria-expanded="true" aria-controls="servicedefaults">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="servicedefaults" class="accordion-collapse collapse show"
                                                aria-labelledby="servicedefault">
                                                <div class="accordion-body text-sm">
                                                  <?php
                                                  $sqlismainaccessdef=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Services' order by id  asc");
                                                  $infomainaccessdef=mysqli_fetch_array($sqlismainaccessdef);
                                                  ?>
                                                  <div class="row pb-3" style="border-bottom: 3px solid #eee;">
                                                                <div class="col-lg-2">
                                                                    <label class="custom-label mt-2">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="row">
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="defaultvisibleservice" id="publicvisibleservice" value="PUBLIC" <?= ($infomainaccessdef['servicevisible']=='PUBLIC')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="publicvisibleservice">Public</label>
                      </div>

                      </div>
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="defaultvisibleservice" id="privatevisibleservice" value="PRIVATE" <?= ($infomainaccessdef['servicevisible']=='PRIVATE')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="privatevisibleservice">Private</label>
                      </div>

                      </div>
                  </div>
              </div>
                                                                </div>
<div class="row" style="border-top:3px solid #eee;padding:0px 0;margin-top: 3px;"></div>
                      </div>
                      </div>
                      </div>
                      </div>
            <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallservcol">
<svg id="rightarrowservacccol" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowservacccol()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowservacccol" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowservacccol()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchservacccol() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#servicecolumn').outerWidth()
            var scrollWidth = $('#servicecolumn')[0].scrollWidth; 
            var scrollLeft = $('#servicecolumn').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowservacccol').style.visibility = 'hidden';
            document.getElementById('rightarrowservacccol').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowservacccol').style.visibility = 'hidden';
            document.getElementById('leftarrowservacccol').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowservacccol').style.visibility = 'visible';
            document.getElementById('rightarrowservacccol').style.visibility = 'visible';
          }
            }
          }
          function leftarrowservacccol() {
            document.getElementById('servicecolumn').scrollLeft += -90;
            var width = $('#servicecolumn').outerWidth()
            var scrollWidth = $('#servicecolumn')[0].scrollWidth; 
            var scrollLeft = $('#servicecolumn').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowservacccol').style.visibility = 'hidden';
            document.getElementById('rightarrowservacccol').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowservacccol').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowservacccol() {
            document.getElementById('servicecolumn').scrollLeft += 90;
            var width = $('#servicecolumn').outerWidth()
            var scrollWidth = $('#servicecolumn')[0].scrollWidth; 
            var scrollLeft = $('#servicecolumn').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowservacccol').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowservacccol').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #servicecolumn::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#servicecolumn::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#servicecolumn::-webkit-scrollbar-track {
  background-color: green;
}

#servicecolumn::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#servicecolumn::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallservcol{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallservcol{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchservacccol()" class="accordion-header scrollbar-2" id="servicecolumn" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;padding-bottom: 2px !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#servicecolumns"
                                                    aria-expanded="true" aria-controls="servicecolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable in all <?=strtolower($infomainaccessserv['modulename'])?></a>
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                            <div id="servicecolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="servicecolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Services' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Services' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>colserv" id="<?= $coltypemod; ?>colserv" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= (($newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>colserv" style="font-size: 14.6px;color:royalblue !important;"> <?= $newmoduleskey; ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
</div>
</div>
</div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallservicedefpage">
<svg id="rightarrowserviceaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowserviceaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowserviceaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowserviceaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchserviceaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#servicedefaultpage').outerWidth()
            var scrollWidth = $('#servicedefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#servicedefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowserviceaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowserviceaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowserviceaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowserviceaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowserviceaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowserviceaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowserviceaccdefpage() {
            document.getElementById('servicedefaultpage').scrollLeft += -90;
            var width = $('#servicedefaultpage').outerWidth()
            var scrollWidth = $('#servicedefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#servicedefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowserviceaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowserviceaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowserviceaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowserviceaccdefpage() {
            document.getElementById('servicedefaultpage').scrollLeft += 90;
            var width = $('#servicedefaultpage').outerWidth()
            var scrollWidth = $('#servicedefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#servicedefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowserviceaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowserviceaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #servicedefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#servicedefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#servicedefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#servicedefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#servicedefaultpage::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallservicedefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallservicedefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchserviceaccdefpage()" class="accordion-header scrollbar-2" id="servicedefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#servicedefaultspages"
                                                    aria-expanded="true" aria-controls="servicedefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="servicedefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="servicedefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row" style="padding-top: 5px;padding-bottom: 0px;margin-bottom: 0px;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="servpageload" id="servpagenum" value="pagenum" <?= ($access['servpageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="servpagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="servpageload" id="servpageauto" value="pageauto" <?= ($access['servpageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="servpageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>

<div class="tab-pane fade show mt-4 p-3 <?=((($infomainaccesspro['moduleaccess']!='1')&&($infomainaccessserv['moduleaccess']!='1')&&($infomainaccessinv['moduleaccess']=='1'))?'active':'')?>" id="nav-inventory" role="tabpanel" aria-labelledby="nav-inventory-tab" <?=(($infomainaccessinv['moduleaccess']=='1')?'':'style="display:none"')?>>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallactionsicedefpage">
<svg id="rightarrowactionsiceaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowactionsiceaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowactionsiceaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowactionsiceaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchactionsiceaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#actionsicedefaultpage').outerWidth()
            var scrollWidth = $('#actionsicedefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#actionsicedefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowactionsiceaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowactionsiceaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowactionsiceaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowactionsiceaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowactionsiceaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowactionsiceaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowactionsiceaccdefpage() {
            document.getElementById('actionsicedefaultpage').scrollLeft += -90;
            var width = $('#actionsicedefaultpage').outerWidth()
            var scrollWidth = $('#actionsicedefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#actionsicedefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowactionsiceaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowactionsiceaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowactionsiceaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowactionsiceaccdefpage() {
            document.getElementById('actionsicedefaultpage').scrollLeft += 90;
            var width = $('#actionsicedefaultpage').outerWidth()
            var scrollWidth = $('#actionsicedefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#actionsicedefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowactionsiceaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowactionsiceaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #actionsicedefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#actionsicedefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#actionsicedefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#actionsicedefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#actionsicedefaultpage::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallactionsicedefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallactionsicedefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchactionsiceaccdefpage()" class="accordion-header scrollbar-2" id="actionsicedefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#actionsicedefaultspages"
                                                    aria-expanded="true" aria-controls="actionsicedefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Click the button below to take an action</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="actionsicedefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="actionsicedefaultpage">
                                                <div class="accordion-body text-sm">
    <a style="background-color: #1BBC9B !important;color: #fff !important;padding: 3px;border-radius: 3px;text-decoration: none;margin: 18px 13px;cursor: pointer;" onclick="window.open('adjustmentadd.php?types=zerobyprefer&status=enabled','_self')" class="p-2">Zero stock for <?=$access['expinvadj']?> <?=strtolower($infomainaccesspro['modulename'])?></a>
    <br><br>
    <a style="background-color: red !important;color: #fff !important;padding: 3px;border-radius: 3px;text-decoration: none;margin: 18px 13px;cursor: pointer;" onclick="window.open('adjustmentadd.php?types=zerobyprefer&status=disabled','_self')" class="p-2">Zero stock for <?=$access['expinvadj']?> <?=strtolower($infomainaccesspro['modulename'])?></a>
<br><br>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 16px;"></div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="inventoryfield">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#inventoryfields"
                                                    aria-expanded="true" aria-controls="inventoryfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="inventoryfields" class="accordion-collapse collapse show"
                                                aria-labelledby="inventoryfield">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Inventory Adjustments' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[21];
    $newans = explode(',',$ans);
    $ans1 = $infomainaccess[22];
    $newans1 = explode(',',$ans1);
    $ans2 = $infomainaccess[23];
    $newans2 = explode(',',$ans2);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Inventory Adjustments' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[3];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
 <div class="row" style=" border-top:<?= (($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; border-bottom:<?= (($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'2px solid #eee;':'0.5px solid #eee' ?>; padding:5px 0">
            <div class="col-lg-2">
              <?php
              if(($coltypemod=='InventoryAdjustmentInformation')) {
                  $fullaccessans = 'inventory';
                }
                else if (($coltypemod=='ItemInformation')) {
                  $fullaccessans = 'items';
                }
                else{
                  $fullaccessans = '';
                }
                ?>
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>inven()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Number')||($newmoduleskey=='Public Id')||($newmoduleskey=='Private Id')||($newmoduleskey=='Batch'))?'inventorys inventoryssubhead':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?= $fullaccessans; ?>inven"
                        <?= ((in_array($newmoduleskey, $newans))||(in_array($newmoduleskey, $newans1))||(in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= ($newmoduleskey=='Batch')?'disabled':'' ?> <?= ($newmoduleskey=='Batch'&&$access['batchexpiryval']==1)?'checked':'' ?> <?= (($newmoduleskey=='Date')||($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?= $fullaccessans; ?>inven" style="font-size: 14.6px;color:<?= (($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> <?= str_replace(" or ", " / ",(str_replace("Inventory Adjustments", $infomainaccessinv['modulename'],(str_replace("Sales", $infomainaccesssale['groupname'],(str_replace("Purchase", $infomainaccesspurchase['groupname'],$newmoduleskey))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
              <div class="row">

                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>inven()" onchange="<?= $coltypemod; ?>add<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Number')||($newmoduleskey=='Public Id')||($newmoduleskey=='Private Id')||($newmoduleskey=='Batch'))?'inventorys':'' ?> <?= (($newmoduleskey=='Number')||($newmoduleskey=='Public Id')||($newmoduleskey=='Private Id')||($newmoduleskey=='Batch'))?'inventorysadd aevforinventorys':'' ?>" name="<?= $coltypemod; ?>addinven" id="<?= $coltypemod; ?>add<?= $fullaccessans; ?>inven" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= ($newmoduleskey=='Batch')?'disabled':'' ?> <?= ($newmoduleskey=='Batch'&&$access['batchexpiryval']==1)?'checked':'' ?> <?= (($newmoduleskey=='Date')||($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>add<?= $fullaccessans; ?>inven" style="color:<?= (($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Add</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>inven()" onchange="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Number')||($newmoduleskey=='Public Id')||($newmoduleskey=='Private Id')||($newmoduleskey=='Batch'))?'inventorys':'' ?> <?= (($newmoduleskey=='Number')||($newmoduleskey=='Public Id')||($newmoduleskey=='Private Id')||($newmoduleskey=='Batch'))?'inventorysedit aevforinventorys':'' ?>" name="<?= $coltypemod; ?>editinven" id="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>inven" <?= ((in_array($newmoduleskey, $newans1)))?'checked':'' ?> <?= ($newmoduleskey=='Batch')?'disabled':'' ?> <?= ($newmoduleskey=='Batch'&&$access['batchexpiryval']==1)?'checked':'' ?> <?= (($newmoduleskey=='Date')||($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>edit<?= $fullaccessans; ?>inven" style="color:<?= (($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?>aev<?= $fullaccessans; ?>inven()" onchange="<?= $coltypemod; ?>view<?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Number')||($newmoduleskey=='Public Id')||($newmoduleskey=='Private Id')||($newmoduleskey=='Batch'))?'inventorys':'' ?> <?= (($newmoduleskey=='Number')||($newmoduleskey=='Public Id')||($newmoduleskey=='Private Id')||($newmoduleskey=='Batch'))?'inventorysview aevforinventorys':'' ?>" name="<?= $coltypemod; ?>viewinven" id="<?= $coltypemod; ?>view<?= $fullaccessans; ?>inven" <?= ((in_array($newmoduleskey, $newans2)))?'checked':'' ?> <?= ($newmoduleskey=='Batch')?'disabled':'' ?> <?= ($newmoduleskey=='Batch'&&$access['batchexpiryval']==1)?'checked':'' ?> <?= (($newmoduleskey=='Date')||($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>view<?= $fullaccessans; ?>inven" style="color:<?= (($newmoduleskey=='Inventory Adjustment Information')||($newmoduleskey=='Item Information'))?'royalblue':'' ?> !important;"> View</label>
                      </div>
                      
                      </div>

                  </div>
                  
            </div>
            
            
            </div>
            <script type="text/javascript">
              // function InventoryAdjustmentInformationinventoryinven() {
              //   let inventorys = document.getElementsByClassName("inventorys");
              //   inventoryslen = inventorys.length;
              //   if ($("#InventoryAdjustmentInformationinventoryinven").prop("checked")) {
              //   for (i=0;i<inventoryslen;i++) {
              //   inventorys[i].checked=true;
              //   inventorys[i].disabled=false;
              //   }
              //   }
              //   else{
              //   for (i=0;i<inventoryslen;i++) {
              //   inventorys[i].checked=false;
              //   inventorys[i].disabled=true;
              //   }
              //   }
              // }
              function <?= $coltypemod; ?><?= $fullaccessans; ?>inven() {
                let fullhigh = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>inven");
                let addhigh = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>inven");
                let edithigh = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>inven");
                let viewhigh = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>inven");
                if (fullhigh.checked == true) {
                  addhigh.checked=true;
                  edithigh.checked=true;
                  viewhigh.checked=true;
                }
                else{
                  addhigh.checked=false;
                  edithigh.checked=false;
                  viewhigh.checked=false;
                }
// let inventoryssubhead = document.getElementsByClassName("inventoryssubhead");
// let inventoryssubheadchnumof = inventoryssubhead.length;
// for (i=0;i<inventoryssubhead.length;i++) {
// if (inventoryssubhead[i].checked) {
// inventoryssubheadchnumof+=1;
// }
// else{
// inventoryssubheadchnumof-=1;
// }
// }
// if (inventoryssubheadchnumof==0) {
// document.getElementById("InventoryAdjustmentInformationinventoryinven").checked=false;
// document.getElementById("InventoryAdjustmentInformationaddinventoryinven").checked=false;
// document.getElementById("InventoryAdjustmentInformationeditinventoryinven").checked=false;
// document.getElementById("InventoryAdjustmentInformationviewinventoryinven").checked=false;
// }
// else{
// document.getElementById("InventoryAdjustmentInformationinventoryinven").checked=true;
// document.getElementById("InventoryAdjustmentInformationaddinventoryinven").checked=true;
// document.getElementById("InventoryAdjustmentInformationeditinventoryinven").checked=true;
// document.getElementById("InventoryAdjustmentInformationviewinventoryinven").checked=true;
// }
              }
              function <?= $coltypemod; ?>aev<?= $fullaccessans; ?>inven() {
                let full = document.getElementById("<?= $coltypemod; ?><?= $fullaccessans; ?>inven");
                let add = document.getElementById("<?= $coltypemod; ?>add<?= $fullaccessans; ?>inven");
                let edit = document.getElementById("<?= $coltypemod; ?>edit<?= $fullaccessans; ?>inven");
                let view = document.getElementById("<?= $coltypemod; ?>view<?= $fullaccessans; ?>inven");
                if (add.checked == true||edit.checked==true||view.checked==true) {
                  full.checked=true;
                }
                else{
                  full.checked=false;
                }
                <?php
                // if (($coltypemod=='Number')||($coltypemod=='PublicId')||($coltypemod=='PrivateId')||($coltypemod=='Batch')) {
                ?>
                // let aevforinventorysch = document.getElementsByClassName("aevforinventorys");
                // let aevchnumofinventorys = aevforinventorysch.length;
                // for (i=0;i<aevforinventorysch.length;i++) {
                // if (aevforinventorysch[i].checked) {
                //     aevchnumofinventorys+=1;
                // }
                // else{
                //     aevchnumofinventorys-=1;
                // }
                // }
                //     if (aevchnumofinventorys==0) {
                //     document.getElementById("InventoryAdjustmentInformationinventoryinven").checked=false;
                //     }
                //     else{
                //     document.getElementById("InventoryAdjustmentInformationinventoryinven").checked=true;
                // }
                // let aevforinventorysadd = document.getElementsByClassName("inventorysadd");
                // let aevnumofinventorysadd = aevforinventorysadd.length;
                // for (i=0;i<aevforinventorysadd.length;i++) {
                // if (aevforinventorysadd[i].checked) {
                //     aevnumofinventorysadd+=1;
                // }
                // else{
                //     aevnumofinventorysadd-=1;
                // }
                // }
                // if (aevnumofinventorysadd==0) {
                // document.getElementById("InventoryAdjustmentInformationaddinventoryinven").checked=false;
                // }
                // else{
                // document.getElementById("InventoryAdjustmentInformationaddinventoryinven").checked=true;
                // }
                // let aevforinventorysedit = document.getElementsByClassName("inventorysedit");
                // let aevnumofinventorysedit = aevforinventorysedit.length;
                // for (i=0;i<aevforinventorysedit.length;i++) {
                // if (aevforinventorysedit[i].checked) {
                //     aevnumofinventorysedit+=1;
                // }
                // else{
                //     aevnumofinventorysedit-=1;
                // }
                // }
                // if (aevnumofinventorysedit==0) {
                // document.getElementById("InventoryAdjustmentInformationeditinventoryinven").checked=false;
                // }
                // else{
                // document.getElementById("InventoryAdjustmentInformationeditinventoryinven").checked=true;
                // }
                // let aevforinventorysview = document.getElementsByClassName("inventorysview");
                // let aevnumofinventorysview = aevforinventorysview.length;
                // for (i=0;i<aevforinventorysview.length;i++) {
                // if (aevforinventorysview[i].checked) {
                //     aevnumofinventorysview+=1;
                // }
                // else{
                //     aevnumofinventorysview-=1;
                // }
                // }
                // if (aevnumofinventorysview==0) {
                // document.getElementById("InventoryAdjustmentInformationviewinventoryinven").checked=false;
                // }
                // else{
                // document.getElementById("InventoryAdjustmentInformationviewinventoryinven").checked=true;
                // }
                <?php
                // }
                ?>
              }
// function InventoryAdjustmentInformationaddinventory() {
// let inventorys = document.getElementsByClassName("inventorysadd");
// inventoryslen = inventorys.length;
// let aevforinventorys = document.getElementsByClassName("aevforinventorys");
// let inventoryssubhead = document.getElementsByClassName("inventoryssubhead");
// let chnumofinventorys = aevforinventorys.length;
// if ($("#InventoryAdjustmentInformationaddinventoryinven").prop("checked")) {
// for (i=0;i<inventoryslen;i++) {
// inventorys[i].checked=true;
// }
// }
// else{
// for (i=0;i<inventoryslen;i++) {
// inventorys[i].checked=false;
// }
// }
// for (i=0;i<aevforinventorys.length;i++) {
// if (aevforinventorys[i].checked) {
// chnumofinventorys+=1;
// }
// else{
// chnumofinventorys-=1;
// }
// }
// for (i=0;i<inventoryslen;i++) {
// if (chnumofinventorys==0) {
// inventoryssubhead[i].checked=false;
// }
// else{
// inventoryssubhead[i].checked=true;
// }
// }
// }
// function InventoryAdjustmentInformationeditinventory() {
// let inventorys = document.getElementsByClassName("inventorysedit");
// inventoryslen = inventorys.length;
// let aevforinventorys = document.getElementsByClassName("aevforinventorys");
// let inventoryssubhead = document.getElementsByClassName("inventoryssubhead");
// let chnumofinventorys = aevforinventorys.length;
// if ($("#InventoryAdjustmentInformationeditinventoryinven").prop("checked")) {
// for (i=0;i<inventoryslen;i++) {
// inventorys[i].checked=true;
// }
// }
// else{
// for (i=0;i<inventoryslen;i++) {
// inventorys[i].checked=false;
// }
// }
// for (i=0;i<aevforinventorys.length;i++) {
// if (aevforinventorys[i].checked) {
// chnumofinventorys+=1;
// }
// else{
// chnumofinventorys-=1;
// }
// }
// for (i=0;i<inventoryslen;i++) {
// if (chnumofinventorys==0) {
// inventoryssubhead[i].checked=false;
// }
// else{
// inventoryssubhead[i].checked=true;
// }
// }
// }
// function InventoryAdjustmentInformationviewinventory() {
// let inventorys = document.getElementsByClassName("inventorysview");
// inventoryslen = inventorys.length;
// let aevforinventorys = document.getElementsByClassName("aevforinventorys");
// let inventoryssubhead = document.getElementsByClassName("inventoryssubhead");
// let chnumofinventorys = aevforinventorys.length;
// if ($("#InventoryAdjustmentInformationviewinventoryinven").prop("checked")) {
// for (i=0;i<inventoryslen;i++) {
// inventorys[i].checked=true;
// }
// }
// else{
// for (i=0;i<inventoryslen;i++) {
// inventorys[i].checked=false;
// }
// }
// for (i=0;i<aevforinventorys.length;i++) {
// if (aevforinventorys[i].checked) {
// chnumofinventorys+=1;
// }
// else{
// chnumofinventorys-=1;
// }
// }
// for (i=0;i<inventoryslen;i++) {
// if (chnumofinventorys==0) {
// inventoryssubhead[i].checked=false;
// }
// else{
// inventoryssubhead[i].checked=true;
// }
// }
// }
            </script>
<?php
}
?>
<!-- <div class="row" style="border-top:1px solid #eee;padding:5px 0;"></div> -->
<br><br>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 0px;"></div>
<div class="row" style="border-top:2px solid #eee;padding:0px 0;margin-top: 3px;"></div>
                                                  
            </div>
            </div>
            </div>
            </div>
            <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="inventorycolumn">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#inventorycolumns"
                                                    aria-expanded="true" aria-controls="inventorycolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable in all <?=strtolower($infomainaccessinv['modulename'])?></a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="inventorycolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="inventorycolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Inventory Adjustments' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where moduletype='Inventory Adjustments' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" <?= (($newmoduleskey=='Import'))?'border-top:2px solid #eee;border-bottom:3px solid #eee;padding-top:18px !important;':'border-top:1.5px solid #eee;border-bottom:1px solid #eee;' ?> padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>colinvadj" id="<?= $coltypemod; ?>colinvadj" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= (($newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>colinvadj" style="font-size: 14.6px;color:royalblue !important;"> <?= str_replace(" or ", " / ",(str_replace("Inventory Adjustments", $infomainaccessinv['modulename'],(str_replace("Sales", $infomainaccesssale['groupname'],(str_replace("Purchase", $infomainaccesspurchase['groupname'],$newmoduleskey))))))) ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
<div class="row" style="border-top:2px solid #eee;padding:5px 0;"></div>
            </div>
            </div>
            </div>
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsallinvadjdefpage">
<svg id="rightarrowinvadjaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowinvadjaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowinvadjaccdefpage" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowinvadjaccdefpage()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchinvadjaccdefpage() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#invadjdefaultpage').outerWidth()
            var scrollWidth = $('#invadjdefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#invadjdefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowinvadjaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowinvadjaccdefpage').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowinvadjaccdefpage').style.visibility = 'hidden';
            document.getElementById('leftarrowinvadjaccdefpage').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowinvadjaccdefpage').style.visibility = 'visible';
            document.getElementById('rightarrowinvadjaccdefpage').style.visibility = 'visible';
          }
            }
          }
          function leftarrowinvadjaccdefpage() {
            document.getElementById('invadjdefaultpage').scrollLeft += -90;
            var width = $('#invadjdefaultpage').outerWidth()
            var scrollWidth = $('#invadjdefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#invadjdefaultpage').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowinvadjaccdefpage').style.visibility = 'hidden';
            document.getElementById('rightarrowinvadjaccdefpage').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowinvadjaccdefpage').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowinvadjaccdefpage() {
            document.getElementById('invadjdefaultpage').scrollLeft += 90;
            var width = $('#invadjdefaultpage').outerWidth()
            var scrollWidth = $('#invadjdefaultpage')[0].scrollWidth; 
            var scrollLeft = $('#invadjdefaultpage').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowinvadjaccdefpage').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowinvadjaccdefpage').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #invadjdefaultpage::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#invadjdefaultpage::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#invadjdefaultpage::-webkit-scrollbar-track {
  background-color: green;
}

#invadjdefaultpage::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#invadjdefaultpage::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallinvadjdefpage{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallinvadjdefpage{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 ontouchmove="checkscrolltouchinvadjaccdefpage()" class="accordion-header scrollbar-2" id="invadjdefaultpage" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#invadjdefaultspages"
                                                    aria-expanded="true" aria-controls="invadjdefaultspages">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="invadjdefaultspages" class="accordion-collapse collapse show"
                                                aria-labelledby="invadjdefaultpage">
                                                <div class="accordion-body text-sm">
<div class="row" style="padding-top: 5px;padding-bottom: 0px;margin-bottom: 0px;">
<div class="col-lg-2">
<label class="custom-label mt-2">Pagination</label>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="adjustpageload" id="adjustpagenum" value="pagenum" <?= ($access['adjustpageload']=='pagenum')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="adjustpagenum">Page Number</label>
</div>
</div>
<div class="col-sm-6">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="adjustpageload" id="adjustpageauto" value="pageauto" <?= ($access['adjustpageload']=='pageauto')?'checked':'' ?>>
<label class="custom-control-label custom-label" for="adjustpageauto">Auto Scroll</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
            </div>
            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
</div> <!-- tab -->
</form>
            <?php
	  include('footer.php');
	  ?>
        </div>

    </main>
    <?php
 include('fexternals.php');
 ?>
<script type="text/javascript">
checkthelist();
function checkthelist() {
    if (document.getElementById("stockonhand").checked==true) {
        // document.getElementById("StockOnHandcol").checked = true;
        document.getElementById("StockOnHandcol").disabled = false;
    }
    else{
        // document.getElementById("StockOnHandcol").checked = false;
        document.getElementById("StockOnHandcol").disabled = true;
    }
}
</script>
    <script type="text/javascript">
    $(function() {
        $("#invoicesuffix").autocomplete({
            source: 'invoicesuffixsearch.php',
            select: function(event, ui) {
                $("#invoicesuffix").val(ui.item.invoicesuffix);
                $("#city").val(ui.item.city);
                $("#district").val(ui.item.district);
                $("#state").val(ui.item.state);
                $("#pincode").val(ui.item.pincode);
            },
            minLength: 2
        });
        $("#email").autocomplete({
            source: 'franchisesearch.php?type=email',
        });
    });
    </script>
    <script>
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
    </script>






    <style>
    /*************************************
 * BUTTON BASE
 */

    .arlina-button {
        position: relative;
        border: 0;
        cursor: pointer;
        outline: 0;
        -webkit-appearance: none;
        -webkit-font-smoothing: antialiased;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .arlina-button[data-loading] {
        cursor: default;
    }


    /* Blue button */
    .arlina-button.blue {
        background: #53b5e6;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.blue:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #58c2f8;
    }

    .arlina-button.blue[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }

    /* Orange button */
    .arlina-button.orange {
        background: #ea8557;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.orange:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #ffa96c;
    }

    .arlina-button.orange[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }


    /* Spinner animation */
    .arlina-button .spinner {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        margin-top: -10px;
        opacity: 0;

        background-image: url("./assets/img/spin.gif");
        background-repeat: no-repeat;

        /* background-image: url(http://2.bp.blogspot.com/-GPSLDnKmX3s/VSvPkXsCHvI/AAAAAAAACOg/Xmm2kIDu-CU/s1600/spin.gif); */


    }


    /*************************************
 * EASING
 */

    .arlina-button,
    .arlina-button .spinner,
    .arlina-button .label {
        -webkit-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -moz-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -ms-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
    }

    .arlina-button.zoom-in,
    .arlina-button.zoom-in .spinner,
    .arlina-button.zoom-in .label,
    .arlina-button.zoom-out,
    .arlina-button.zoom-out .spinner,
    .arlina-button.zoom-out .label {
        -webkit-transition: 0.3s ease all;
        -moz-transition: 0.3s ease all;
        -ms-transition: 0.3s ease all;
        transition: 0.3s ease all;
    }



    /*************************************
 * EXPAND RIGHT
 */

    .arlina-button.expand-left .spinner {
        left: 0.8em;
    }

    .arlina-button.expand-left[data-loading] {
        padding-left: 40px;
    }

    .arlina-button.expand-left[data-loading] .spinner {
        opacity: 1;
    }
    </style>
</body>

</html>