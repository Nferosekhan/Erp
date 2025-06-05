<?php
include('lcheck.php');
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Products' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccesscreate']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
$sqlget=mysqli_query($con,"select * from paircurrency");
$row=mysqli_fetch_array($sqlget);
$ans=$row['currencysymbol'];
$res=explode('-',$ans);
if(isset($_POST['submit']))
{
$productcodes=mysqli_real_escape_string($con, $_POST['productcode']);
$publiccodes=mysqli_real_escape_string($con, $_POST['publiccode']);
$privatecodes=mysqli_real_escape_string($con, $_POST['privatecode']);
$productname=mysqli_real_escape_string($con, $_POST['productname']);
$codetags=mysqli_real_escape_string($con, $_POST['codetags']);
$hsncode=mysqli_real_escape_string($con, $_POST['hsncode']);
$rack=mysqli_real_escape_string($con, $_POST['rack']);
// $pvisibility=mysqli_real_escape_string($con, $_POST['visibility']);
$delivery=mysqli_real_escape_string($con, $_POST['delivery']);
$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Products' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
$prohead = $infomainaccessuser['modulename'];
$sqlismainaccesssales=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Sales' order by id  asc");
$infomainaccesssales=mysqli_fetch_array($sqlismainaccesssales);
$salehead = $infomainaccesssales['groupname'];
$sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Purchase' order by id  asc");
$infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
$purhead = $infomainaccesspurchase['groupname'];
$sqlcode=mysqli_query($con,"select count(productcode) from pairproducts where itemmodule='Products'");
$anscode=mysqli_fetch_array($sqlcode);
$oldcode=$anscode[0];
$productcode=$oldcode+1;
$publicsql=mysqli_query($con,"select count(publicid) from pairproducts where createdid='$companymainid' and itemmodule='Products'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
$privatesql=mysqli_query($con,"select count(privateid) from pairproducts where createdid='$companymainid' and itemmodule='Products' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privatecode=$infomainaccesspublicname['moduleprefix'] . $infomainaccesspublicname['modulesuffix']+1;
$ordering = $infomainaccesspublicname['modulesuffix']+1;
if(isset($_POST['defaultunit']))
{
    $defaultunit=mysqli_real_escape_string($con, $_POST['defaultunit']);
    $ansunits=explode(',', $defaultunit);
    $forpro=$ansunits[1];
}
else{
    $forpro=" ";
}
if(isset($_POST['description']))
{
    $descriptionpro=mysqli_real_escape_string($con, $_POST['description']);
}
else{
    $descriptionpro=" ";
}
if(isset($_POST['category']))
{
    $category=mysqli_real_escape_string($con, $_POST['category']);
}
else{
    $category=" ";
}
if(isset($_POST['visibility']))
{
    $pvisibility=mysqli_real_escape_string($con, $_POST['visibility']);
}
else{
    $pvisibility="PUBLIC";
}
if(isset($_POST['subcategory']))
{
    $subcategory=mysqli_real_escape_string($con, $_POST['subcategory']);
}
else{
    $subcategory=" ";
}
if(isset($_POST['taxable']))
{
    $taxpref=mysqli_real_escape_string($con, $_POST['taxable']);
}
else{
    $taxpref=" ";
}
if(isset($_POST['intratax']))
{
    $intratax=mysqli_real_escape_string($con, $_POST['intratax']);
$sqlintrahis=mysqli_query($con, "select * from pairtaxrates where taxgroups!='' and id='$intratax' and (createdid='$companymainid' or createdid='0') order by tax asc");
$sqlintrahisfet = mysqli_fetch_array($sqlintrahis);
if (mysqli_num_rows($sqlintrahis)>0) {
$intrataxs = $sqlintrahisfet['taxname']." - ".$sqlintrahisfet['tax']." %";
}
else{
$intrataxs = '';
}
}
else{
    $intratax="null";
}
if(isset($_POST['intertax']))
{
    $intertax=mysqli_real_escape_string($con, $_POST['intertax']);
$sqlinterhis=mysqli_query($con, "select * from pairtaxrates where id='$intertax' and (createdid='$companymainid' or createdid='0') order by tax asc");
$sqlinterhisfet = mysqli_fetch_array($sqlinterhis);
if (mysqli_num_rows($sqlinterhis)>0) {
$intertaxs = $sqlinterhisfet['taxname']." - ".$sqlinterhisfet['tax']." %";
}
else{
$intertaxs = '';
}
}
else{
    $intertax="null";
}
$barcode=mysqli_real_escape_string($con, $_POST['barcode']);
$barcodehead=mysqli_real_escape_string($con, $_POST['barcodehead']);
$barcodetitle=mysqli_real_escape_string($con, $_POST['barcodetitle']);
$underbarcodelabel=mysqli_real_escape_string($con, $_POST['underbarcodelabel']);
$barcodenotes=mysqli_real_escape_string($con, $_POST['barcodenotes']);
$barcodeformat=mysqli_real_escape_string($con, $_POST['barcodeformat']);
$sqlup = "insert into pairproducts set createdon='$times',productname='$productname',createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', codetags='$codetags',itemmodule='Products',franchisesession='".$_SESSION["franchisesession"]."',  description='$descriptionpro',defaultunit='$forpro',category='$category', subcategory='$subcategory',pvisiblity='$pvisibility',delivery='$delivery',productcode='$productcode',taxpref='$taxpref',intratax='$intratax',intertax='$intertax',hsncode='$hsncode',publicid='$publiccode',privateid='$privatecode',rack='$rack',ordering='$ordering',barcodeformat='$barcodeformat',barcode='$barcode',barcodetitle='$barcodetitle',barcodenotes='$barcodenotes',underbarcodelabel='$underbarcodelabel',barcodehead='$barcodehead'";
            $queryup = mysqli_query($con, $sqlup);
            if ($queryup) {
             header('Location:products.php?remarks=Added Successfully'); 
            }
//autoincname
$tid=mysqli_insert_id($con);
             $sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Products'");  
$productid=$tid;
$anspricenames="";
$sqlpricenamequery=mysqli_query($con,"select count(salename) from pairprosale where productid='$tid'");
$anspricenamequery=mysqli_fetch_array($sqlpricenamequery);
$oldpricenamequery=$anspricenamequery[0];
$pricenames=$_POST['pricename'];
foreach($pricenames as $anspricename){
        $anspricenames.=$anspricename;
}
if ($anspricenames!='') {
    $pricename = $anspricenames;
}
else{
    $pricename  = 'SELLING PRICE ' . $oldpricenamequery + 1;
}
$ansmrps="";
$mrp=$_POST['mrp'];
    foreach($mrp as $ansmrp){
            $ansmrps.=$ansmrp;
}
$anssellprices="";
$sellprice=$_POST['sellingprice'];
    foreach($sellprice as $anssellprice){
            $anssellprices.=$anssellprice;
}
$ansdescriptions="";
$description=$_POST['descriptions'];
    foreach($description as $ansdescription){
            $ansdescriptions.=$ansdescription;
}
$sqlbatpro=mysqli_query($con, "insert into pairbatch set franchisesession='".$_SESSION["franchisesession"]."',createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',manufacturer='',batch='',expdate='',productid='$tid',productname='$productname',mrp='0',vat='0',noofpacks='',quantity='0',prodiscount='0',productrate='0'");
if ($anspricenames!=''||$ansmrps!=''||$anssellprices!=''||$ansdescriptions!='') {
$sqlupn = "insert into pairprosale set productid='$tid',salename='$pricename',salemrp='$ansmrps',salecost='$anssellprices',saledescription='$ansdescriptions',itemmodule='Products',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            $sqlupnpro = mysqli_query($con,"update pairproducts set salescost='$anssellprices' where id='$tid'");
            if(!$queryupn){
                // echo mysqli_error($con);
               header('Location:productadd.php?error=Pricename Added Unsuccessfully');
            }
}
else{
    $sqlupn = "insert into pairprosale set productid='$tid',itemmodule='Products',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            if(!$queryupn){
                // echo mysqli_error($con);
               header('Location:productadd.php?error=Pricename Added Unsuccessfully');
            }
}

$anspricenamespur="";
$sqlpricenamepurquery=mysqli_query($con,"select count(purchasename) from pairpropurchase where productid='$tid'");
$anspurpricenamequery=mysqli_fetch_array($sqlpricenamepurquery);
$oldpurpricenamequery=$anspurpricenamequery[0];
$pricenamepurs=$_POST['pricenamepur'];
foreach($pricenamepurs as $anspricenamepur){
        $anspricenamespur.=$anspricenamepur;
}
if ($anspricenamespur!='') {
    $pricenamepur = $anspricenamespur;
}
else{
    $pricenamepur  = 'PURCHASE PRICE ' . $oldpurpricenamequery + 1;
}
$ansmrpspur="";
$mrppur=$_POST['mrppur'];
    foreach($mrppur as $ansmrppur){
            $ansmrpspur.=$ansmrppur;
}
$anssellpricespur="";
$sellpricepur=$_POST['sellingpricepur'];
    foreach($sellpricepur as $anssellpricepur){
            $anssellpricespur.=$anssellpricepur;
}
$ansdescriptionspur="";
$descriptionpur=$_POST['descriptionspur'];
    foreach($descriptionpur as $ansdescriptionpur){
            $ansdescriptionspur.=$ansdescriptionpur;
}
if ($anspricenamespur!=''||$ansmrpspur!=''||$anssellpricespur!=''||$ansdescriptionspur!='') {
$sqlupn = "insert into pairpropurchase set productid='$tid',purchasename='$pricenamepur',purchasemrp='$ansmrpspur',purchasecost='$anssellpricespur',purchasedescription='$ansdescriptionspur',itemmodule='Products',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            if(!$queryupn){
                // echo mysqli_error($con);
               header('Location:productadd.php?error=Pricename Added Unsuccessfully');
            }
}
else{
    $sqlupn = "insert into pairpropurchase set productid='$tid',itemmodule='Products',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            if(!$queryupn){
                // echo mysqli_error($con);
               header('Location:productadd.php?error=Pricename Added Unsuccessfully');
            }
}
                $ch='';
                $ch.='PRODUCT CREATED';
                if($productname!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$prohead.' Name <span style="color:green;" id="prohisfromtospan">( '.$productname.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$prohead.' Name <span style="color:green;" id="prohisfromtospan">( '.$productname.' ) </span>';
                    }                   
                }
                if($codetags!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Code / Tags <span style="color:green;" id="prohisfromtospan">( '.$codetags.' ) </span>';
                    }
                    else
                    {
                        $ch.='Code / Tags <span style="color:green;" id="prohisfromtospan">( '.$codetags.' ) </span>';
                    }                   
                }
                if (in_array('Unit', $fieldadd)) {
                if($forpro!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Unit <span style="color:green;" id="prohisfromtospan">( '.$forpro.' ) </span>';
                    }
                    else
                    {
                        $ch.='Unit <span style="color:green;" id="prohisfromtospan">( '.$forpro.' ) </span>';
                    }                   
                }
            }
                if($hsncode!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> HSN Code <span style="color:green;" id="prohisfromtospan">( '.$hsncode.' ) </span>';
                    }
                    else
                    {
                        $ch.='HSN Code <span style="color:green;" id="prohisfromtospan">( '.$hsncode.' ) </span>';
                    }                   
                }
                if($category!=' ')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( '.$category.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$access['txtnamecategory'].' <span style="color:green;" id="prohisfromtospan">( '.$category.' ) </span>';
                    }                   
                }
                if($subcategory!=' ')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Subcategory <span style="color:green;" id="prohisfromtospan">( '.$subcategory.' ) </span>';
                    }
                    else
                    {
                        $ch.='Subcategory <span style="color:green;" id="prohisfromtospan">( '.$subcategory.' ) </span>';
                    }                   
                }
                if($rack!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Rack <span style="color:green;" id="prohisfromtospan">( '.$rack.' ) </span>';
                    }
                    else
                    {
                        $ch.='Rack <span style="color:green;" id="prohisfromtospan">( '.$rack.' ) </span>';
                    }                   
                }
                if($delivery!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Delivery <span style="color:green;" id="prohisfromtospan">( '.$delivery.' ) </span>';
                    }
                    else
                    {
                        $ch.='Delivery <span style="color:green;" id="prohisfromtospan">( '.$delivery.' ) </span>';
                    }                   
                }
                if($descriptionpro!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Description <span style="color:green;" id="prohisfromtospan">( '.$descriptionpro.' ) </span>';
                    }
                    else
                    {
                        $ch.='Description <span style="color:green;" id="prohisfromtospan">( '.$descriptionpro.' ) </span>';
                    }    
                }       
                if (in_array('Product Visibility', $fieldadd)) {
                if($pvisibility!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Visibility <span style="color:green;" id="prohisfromtospan">( '.$pvisibility.' ) </span>';
                    }
                    else
                    {
                        $ch.='Visibility <span style="color:green;" id="prohisfromtospan">( '.$pvisibility.' ) </span>';
                    }                   
                }
            }
                if($barcodetitle!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Barcode Title <span style="color:green;" id="prohisfromtospan">( '.$barcodetitle.' ) </span>';
                    }
                    else
                    {
                        $ch.='Barcode Title <span style="color:green;" id="prohisfromtospan">( '.$barcodetitle.' ) </span>';
                    }                   
                }
                if($barcodehead!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Barcode Subtitle <span style="color:green;" id="prohisfromtospan">( '.$barcodehead.' ) </span>';
                    }
                    else
                    {
                        $ch.='Barcode Subtitle <span style="color:green;" id="prohisfromtospan">( '.$barcodehead.' ) </span>';
                    }                   
                }
                if($barcodeformat!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Barcode Type <span style="color:green;" id="prohisfromtospan">( '.$barcodeformat.' ) </span>';
                    }
                    else
                    {
                        $ch.='Barcode Type <span style="color:green;" id="prohisfromtospan">( '.$barcodeformat.' ) </span>';
                    }                   
                }
                if($barcode!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Barcode <span style="color:green;" id="prohisfromtospan">( '.$barcode.' ) </span>';
                    }
                    else
                    {
                        $ch.='Barcode <span style="color:green;" id="prohisfromtospan">( '.$barcode.' ) </span>';
                    }                   
                }
                if($underbarcodelabel!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Under Barcode Label <span style="color:green;" id="prohisfromtospan">( '.$underbarcodelabel.' ) </span>';
                    }
                    else
                    {
                        $ch.='Under Barcode Label <span style="color:green;" id="prohisfromtospan">( '.$underbarcodelabel.' ) </span>';
                    }                   
                }
                if($barcodenotes!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Footer Note <span style="color:green;" id="prohisfromtospan">( '.$barcodenotes.' ) </span>';
                    }
                    else
                    {
                        $ch.='Footer Note <span style="color:green;" id="prohisfromtospan">( '.$barcodenotes.' ) </span>';
                    }                   
                }
                if($anspricenames!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$salehead.' Price Name <span style="color:green;" id="prohisfromtospan">( '.$anspricenames.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$salehead.' Price Name <span style="color:green;" id="prohisfromtospan">( '.$anspricenames.' ) </span>';
                    }                   
                }
                if($ansmrps!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$salehead.' Mrp <span style="color:green;" id="prohisfromtospan">( '.$ansmrps.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$salehead.' Mrp <span style="color:green;" id="prohisfromtospan">( '.$ansmrps.' ) </span>';
                    }                   
                }
                if($anssellprices!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$salehead.' Price / Rate <span style="color:green;" id="prohisfromtospan">( '.$anssellprices.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$salehead.' Price / Rate <span style="color:green;" id="prohisfromtospan">( '.$anssellprices.' ) </span>';
                    }                   
                }
                if($ansdescriptions!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$salehead.' Description <span style="color:green;" id="prohisfromtospan">( '.$ansdescriptions.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$salehead.' Description <span style="color:green;" id="prohisfromtospan">( '.$ansdescriptions.' ) </span>';
                    }                   
                }
                if($anspricenamespur!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$purhead.' Price Name <span style="color:green;" id="prohisfromtospan">( '.$anspricenamespur.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$purhead.' Price Name <span style="color:green;" id="prohisfromtospan">( '.$anspricenamespur.' ) </span>';
                    }                   
                }
                if($ansmrpspur!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$purhead.' Mrp <span style="color:green;" id="prohisfromtospan">( '.$ansmrpspur.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$purhead.' Mrp <span style="color:green;" id="prohisfromtospan">( '.$ansmrpspur.' ) </span>';
                    }                   
                }
                if($anssellpricespur!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$purhead.' Price / Rate <span style="color:green;" id="prohisfromtospan">( '.$anssellpricespur.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$purhead.' Price / Rate <span style="color:green;" id="prohisfromtospan">( '.$anssellpricespur.' ) </span>';
                    }                   
                }
                if($ansdescriptionspur!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$purhead.' Description <span style="color:green;" id="prohisfromtospan">( '.$ansdescriptionspur.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$purhead.' Description <span style="color:green;" id="prohisfromtospan">( '.$ansdescriptionspur.' ) </span>';
                    }                   
                }
                if (in_array('Tax Rate', $fieldadd)) {
                if($taxpref!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Tax Preference <span style="color:green;" id="prohisfromtospan">( Taxable ) </span>';
                    }
                    else
                    {
                        $ch.='Tax Preference <span style="color:green;" id="prohisfromtospan">( Taxable ) </span>';
                    }                   
                }
            }
                if($intratax!='null')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Intra Tax <span style="color:green;" id="prohisfromtospan">( '.$intrataxs.' ) </span>';
                    }
                    else
                    {
                        $ch.='Intra Tax <span style="color:green;" id="prohisfromtospan">( '.$intrataxs.' ) </span>';
                    }                   
                }
                if($intertax!='null')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Inter Tax <span style="color:green;" id="prohisfromtospan">( '.$intertaxs.' ) </span>';
                    }
                    else
                    {
                        $ch.='Inter Tax <span style="color:green;" id="prohisfromtospan">( '.$intertaxs.' ) </span>';
                    }                   
                }
                if($ch!='')
                {
                $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='PRODUCTS', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$tid', useremarks='".$ch."' ");
                }

$sqlunit=mysqli_query($con,"select * from pairunits where (createdid='$companymainid' or createdid='0') and (franchisesession='".$_SESSION["franchisesession"]."' or franchisesession='0') and (itemmodule='Products' or itemmodule='0')");
while($answerunit=mysqli_fetch_array($sqlunit)){
$olduqc=$answerunit['uqc'];
$oldunitname=$answerunit['unitname'];
}
if(isset($_POST['defaultunit']))
{
    $defaultunits=mysqli_real_escape_string($con, $_POST['defaultunit']);
    $anssunits=explode(',', $defaultunits);
    $foruqc=$anssunits[1];
    $forunitname=$anssunits[0];
if ($forunitname!=$oldunitname||$foruqc!=$olduqc) {
    $sqlup = "insert into pairunits set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."',itemmodule='Products', unitname='$forunitname', uqc='$foruqc',franchisesession='".$_SESSION["franchisesession"]."'";
            $queryup = mysqli_query($con, $sqlup);
    }
}

$sqlsubcat="select subcategory from pairsubcategory where subcategory='$subcategory' and itemmodule='Products' and createdid='$companymainid'";
$resultsubcat = mysqli_query($con,$sqlsubcat);
if (mysqli_num_rows($resultsubcat)>0) {
}
else{
    if(isset($_POST['subcategory']))
{
    $sqlupsub = "insert into pairsubcategory set createdon='$times', createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',itemmodule='Products', subcategory='$subcategory'";
                            $queryupsub = mysqli_query($con, $sqlupsub);
}
}

$sqlcat="select category from paircategory where category='$category' and itemmodule='Products' and createdid='$companymainid'";
$resultcat = mysqli_query($con,$sqlcat);
if (mysqli_num_rows($resultcat)>0) {
}
else{
    if(isset($_POST['category']))
{
    $sqlupcat = "insert into paircategory set createdon='$times', createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',itemmodule='Products', category='$category'";
                            $queryupcat = mysqli_query($con, $sqlupcat);
}
}

// $sqlup = "insert into pairproducts set createdon='$times',productname='$productname',createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', codetags='$codetags',itemmodule='Products',franchisesession='".$_SESSION["franchisesession"]."',  description='$description',defaultunit='$defaultunit',category='$category', subcategory='$subcategory',pvisiblity='$pvisibility',delivery='$delivery',productcode='$productcode'";
//             $queryup = mysqli_query($con, $sqlup);
//             if ($queryup) {
//              header('Location:products.php?remarks=Added Successfully');   
//             }
}
// $hsncode=mysqli_real_escape_string($con, $_POST['hsncode']);
// //$foronline=(float)mysqli_real_escape_string($con, $_POST['foronline']);
// $purchaseaccounttype=mysqli_real_escape_string($con, $_POST['purchaseaccounttype']);
// $saleaccounttype=mysqli_real_escape_string($con, $_POST['saleaccounttype']);
// $taxpref=(float)mysqli_real_escape_string($con, $_POST['taxpref']);
// $taxratecountry=mysqli_real_escape_string($con, $_POST['taxratecountry']);
// $intratax=mysqli_real_escape_string($con, $_POST['intratax']);
// $intertax=mysqli_real_escape_string($con, $_POST['intertax']);
// $excemptionreason=mysqli_real_escape_string($con, $_POST['excemptionreason']);
// $trackinventory=(float)mysqli_real_escape_string($con, $_POST['trackinventory']);
// $inventoryaccounttype=mysqli_real_escape_string($con, $_POST['inventoryaccounttype']);
// $openingstock=(float)mysqli_real_escape_string($con, $_POST['openingstock']);
// $openingstockrate=(float)mysqli_real_escape_string($con, $_POST['openingstockrate']);
// $openingason=mysqli_real_escape_string($con, $_POST['openingason']);productcode='$productcode', productimage='$productimage', hsncode='$hsncode',, foronline='$foronline', viewaccess='$viewaccess', purchaseaccounttype='$purchaseaccounttype', saleaccounttype='$saleaccounttype', taxpref='$taxpref', taxratecountry='$taxratecountry', intratax='$intratax', intertax='$intertax', excemptionreason='$excemptionreason', trackinventory='$trackinventory', inventoryaccounttype='$inventoryaccounttype', openingstock='$openingstock', openingstockrate='$openingstockrate', openingason='$openingason'
// $msg = "";
// $msg_class = "";
//     if(($productname!=""))
//     {
//         $sqlcon = "SELECT id From pairproducts WHERE franchisesession='".$_SESSION["franchisesession"]."' and productname = '{$productname}'";
//         $querycon = mysqli_query($con, $sqlcon);
//         $rowCountcon = mysqli_num_rows($querycon);

//         if(!$querycon){
//            die("SQL query failed: " . mysqli_error($con));
//         }

//         if($rowCountcon == 0)
//         {
//             $productimages=array();
//   // Configure upload directory and allowed file types
//     $upload_dir = 'ups/';
//     $allowed_types = array('jpg', 'png', 'jpeg', 'gif');

//     // Define maxsize for files i.e 2MB
//     $maxsize = 2 * 1024 * 1024;

//     // Checks if user sent an empty form
//     if(!empty(array_filter($_FILES['productimage']['name']))) {

//         // Loop through each file in files[] array
//         foreach ($_FILES['productimage']['tmp_name'] as $key => $value) {

//             $file_tmpname = $_FILES['productimage']['tmp_name'][$key];
//             $file_name = $_FILES['productimage']['name'][$key];
//             $file_size = $_FILES['productimage']['size'][$key];
//             $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

//             // Set upload file path
//             $filepath = $upload_dir.$file_name;
//             // Check file type is allowed or not
//             if(in_array(strtolower($file_ext), $allowed_types)) {

//                 // Verify file size - 2MB max
//                 if ($file_size > $maxsize)
//                     header("Location: products.php?error=File size is larger than the allowed limit");

//                 // If file with name already exist then append time in
//                 // front of name of the file to avoid overwriting of file
//                 if(file_exists($filepath)) {
//                     $filepath = $upload_dir.time().$file_name;

//                     if( move_uploaded_file($file_tmpname, $filepath)) {
//                         $productimages[]=$filepath;
//                        // echo "{$file_name} successfully uploaded <br />";
//                     }
//                     else {
//                         //echo "Error uploading {$file_name} <br />";
//                     }
//                 }
//                 else {

//                     if( move_uploaded_file($file_tmpname, $filepath)) {
//                         $productimages[]=$filepath;
//                         //echo "{$file_name} successfully uploaded <br />";
//                     }
//                     else {
//                         //echo "Error uploading {$file_name} <br />";
//                     }
//                 }

//             }
//             else {

//                 // If file extension not valid
//                // echo "Error uploading {$file_name} ";
//               //  echo "({$file_ext} file type is not allowed)<br / >";
//             }
//         }
//     }
//     else {


//     }

// $productimage=implode(",",$productimages);
// $viewaccess='';
// foreach($_POST['viewaccess'] as $viewa)
// {
// if($viewaccess!='')
// {
//     $viewaccess.=','.$viewa;
// }
// else
// {
//     $viewaccess.=''.$viewa;
// }
// }




//             if(!$queryup){
//                die("SQL query failed: " . mysqli_error($con));
//             }
//             else
//             {
//                 $tid=mysqli_insert_id($con);
//                 $productid=$tid;
//                 $productcode='DM'.str_pad($tid,5,"0",STR_PAD_LEFT);
//                 mysqli_query($con, "update pairproducts set productcode='$productcode' where id='$tid'");
//                 mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Reported Problem', '{$tid}')");

//                 $sqlias=mysqli_query($con, "delete from pairpropurchase where productid='$productid'");
//                 for($ip=0;$ip<count($_POST['purchasename']);$ip++)
//                 {
//                     $purchasename=mysqli_real_escape_string($con, $_POST['purchasename'][$ip]);
//                     $purchasemrp=mysqli_real_escape_string($con, $_POST['purchasemrp'][$ip]);
//                     $purchasecost=mysqli_real_escape_string($con, $_POST['purchasecost'][$ip]);
//                     $purchasediscount=mysqli_real_escape_string($con, $_POST['purchasediscount'][$ip]);
//                     $purchaseofferprice=mysqli_real_escape_string($con, $_POST['purchaseofferprice'][$ip]);
//                     $purchaseunit=mysqli_real_escape_string($con, $_POST['purchaseunit'][$ip]);
//                     $purchaseindunit=mysqli_real_escape_string($con, $_POST['purchaseindunit'][$ip]);
//                     if(($purchasename!='')&&($purchasecost!=''))
//                     {
//                         $sqlias=mysqli_query($con, "select purchasename from pairpropurchase where productid='$productid' and purchasename='$purchasename'");
//                         if(mysqli_num_rows($sqlias)==0)
//                         {
//                             $sqliasa=mysqli_query($con, "insert into pairpropurchase set productid='$productid', purchasename='$purchasename', purchasemrp='$purchasemrp', purchasecost='$purchasecost', purchasediscount='$purchasediscount', purchaseofferprice='$purchaseofferprice', purchaseunit='$purchaseunit', purchaseindunit='$purchaseindunit'");
//                         }
//                     }

//                 }

//                 $sqlias=mysqli_query($con, "delete from  where productid='$productid'");
//                 for($ip=0;$ip<count($_POST['salename']);$ip++)
//                 {
//                     $salename=mysqli_real_escape_string($con, $_POST['salename'][$ip]);
//                     $salemrp=mysqli_real_escape_string($con, $_POST['salemrp'][$ip]);
//                     $salecost=mysqli_real_escape_string($con, $_POST['salecost'][$ip]);
//                     $salediscount=mysqli_real_escape_string($con, $_POST['salediscount'][$ip]);
//                     $saleofferprice=mysqli_real_escape_string($con, $_POST['saleofferprice'][$ip]);
//                     $saleunit=mysqli_real_escape_string($con, $_POST['saleunit'][$ip]);
//                     $saleindunit=mysqli_real_escape_string($con, $_POST['saleindunit'][$ip]);
//                     if(($salename!='')&&($salecost!=''))
//                     {
//                         $sqlias=mysqli_query($con, "select salename from  where productid='$productid' and salename='$salename'");
//                         if(mysqli_num_rows($sqlias)==0)
//                         {
//                             $sqliasa=mysqli_query($con, "insert into  set productid='$productid', salename='$salename', salemrp='$salemrp', salecost='$salecost', salediscount='$salediscount', saleofferprice='$saleofferprice', saleunit='$saleunit', saleindunit='$saleindunit'");
//                         }
//                     }

//                 }

//                 header("Location: products.php?remarks=Added Successfully");
//             }
//         }
//         else
//             {
//                 header("Location: products.php?error=This record is Already Found! Kindly check in All Products List");
//             }
//     }
//     else
//             {
//                 header("Location: products.php?error=Error Data");
//             }
// }
// $sqlunit=mysqli_query($con,"select * from pairunits");
// while($answerunit=mysqli_fetch_array($sqlunit)){
// $olduqc=$answerunit['uqc'];
// $oldunitname=$answerunit['unitname'];
// }
// if(isset($_POST['submitunit']) ) {

// $unitname=mysqli_real_escape_string($con, $_POST['missingdefaultunit']);
// $uqc=mysqli_real_escape_string($con, $_POST['uqc']);
// if ($unitname!=$oldunitname||$uqc!=$olduqc) {
//     $unitnames=mysqli_real_escape_string($con, $_POST['missingdefaultunit']);
//     $uqcs=mysqli_real_escape_string($con, $_POST['uqc']);
//     $sqlup = "insert into pairunits set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."',itemmodule='Products', unitname='$unitnames', uqc='$uqcs',franchisesession='".$_SESSION["franchisesession"]."'";
//             $queryup = mysqli_query($con, $sqlup);
//             if($queryup){
//                header('Location:productadd.php?remarks=Unit Added Successfully');
//             }
//             if (!$queryup) {
//             header('Location:productadd.php?error=This is Already Exists Unit');
//         }
//         }
//         else{
//             header('Location:productadd.php?error=This is Already Exists Unit');
//         }
//     }
    // $unitname=mysqli_real_escape_string($con, $_POST['missingdefaultunit']);
    // $uqc=mysqli_real_escape_string($con, $_POST['uqc']);


    //         $sqlup = "insert into pairunits set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', unitname='$unitname', uqc='$uqc',franchisesession='".$_SESSION["franchisesession"]."'";
    //         $queryup = mysqli_query($con, $sqlup);

    //         if(!$queryup){
    //            die("SQL query failed: " . mysqli_error($con));
    //            header('Location:productadd.php?error=This is Already Exists Unit');
    //         }
    //         else{
    //             header('Location:productadd.php?remarks=Unit Added Successfully');
    //         }

// }

// $sqlcat=mysqli_query($con,"select * from paircategory");
// while($answercat=mysqli_fetch_array($sqlcat)){
// $oldcategorys=$answercat['category'];
// }
// if(isset($_POST['submitcategory'])){
// // {
// // $sqlcat=mysqli_query($con,"select * from paircategory");
// // $answercat=mysqli_fetch_array($sqlcat);
// // $oldcategorys=$answercat['category'];
// $categorys=mysqli_real_escape_string($con,$_POST['category']);
// if ($categorys!=$oldcategorys) {
//     $categoryses=mysqli_real_escape_string($con,$_POST['category']);
//     $sqlup = "insert into paircategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."',itemmodule='Products', category='$categoryses'";
//             $queryup = mysqli_query($con, $sqlup);
//             if($queryup){
//                header('Location:productadd.php?remarks=Category Added Successfully');
//             }
//             if (!$queryup) {
//             header('Location:productadd.php?error=This is Already Exists Category');
//         }
//         }
//         else{
//             header('Location:productadd.php?error=This is Already Exists Category');
//         }
// }
// if( isset($_POST['submitcategory'])) {
// $sqlcat=mysqli_query($con,"select * from paircategory");
// $answercat=mysqli_fetch_array($sqlcat);
// $oldcategorys=$answercat['category'];
//     $categorys=$_POST['category'];
//     foreach($categorys as $anscat){
//         if ($anscat!=$oldcategorys) {
//             $sqlup = "insert into paircategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', category='$anscat'";
//             $queryup = mysqli_query($con, $sqlup);
//             if($queryup){
//                header('Location:productadd.php?remarks=Category Added Successfully');
//             }
//         }
//         else{
//             header('Location:productadd.php?error=This is Already Exists Category');
//         }
//         }
// }
// $sqlsubcat=mysqli_query($con,"select * from pairsubcategory");
// while($answersubcat=mysqli_fetch_array($sqlsubcat)){
// $oldsubcategorys=$answersubcat['subcategory'];
// }
// if( isset($_POST['submitsubcategory'])) {
//     $subcategory=mysqli_real_escape_string($con, $_POST['missingsubcategory']);
// if ($subcategory!=$oldsubcategorys) {
//     $subcategoryses=mysqli_real_escape_string($con,$_POST['missingsubcategory']);
//     $sqlup = "insert into pairsubcategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."',itemmodule='Products', subcategory='$subcategoryses'";
//             $queryup = mysqli_query($con, $sqlup);
//             if($queryup){
//                header('Location:productadd.php?remarks=Subcategory Added Successfully');
//             }
//             if (!$queryup) {
//             header('Location:productadd.php?error=This is Already Exists SubCategory');
//         }
//         }
//         else{
//             header('Location:productadd.php?error=This is Already Exists SubCategory');
//         }

     // $subcategory=mysqli_real_escape_string($con, $_POST['missingsubcategory']);


            // $sqlup = "insert into pairsubcategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', subcategory='$subcategory'";
            // $queryup = mysqli_query($con, $sqlup);

            // if(!$queryup){
            //    die("SQL query failed: " . mysqli_error($con));
            // }


// }
$sqlismainaccesssales=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Sales' order by id  asc");
$infomainaccesssales=mysqli_fetch_array($sqlismainaccesssales);
$salehead = $infomainaccesssales['groupname'];
$sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Purchase' order by id  asc");
$infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
$purhead = $infomainaccesspurchase['groupname'];
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
?>
    <title>
        New product - Dmedia
    </title>
    

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- productadd.css -->
    <link href="productedit.css" rel="stylesheet">
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
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
     <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
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
      <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>

     
                                <?php
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
                                ?>
                                
            <div id="fullcontainerwidth">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5 p-3">
                            <div class="card-body p-0">
                                <p class="mb-3 mt-0 ml-0" id="neweditpro" data-toggle="tooltip" title="Products you by and/or sell and that you track quantities of-Products you by and/or sell but don't need to (or can't) track quantities of, for example, nuts and bolts used in an installation" data-placement="right" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;"><i class="fa fa-plus-square-o"></i> New
                                    <?= $infomainaccessuser['modulename'] ?></p>
                                    <!-- <?php
            if (isset($_GET['remarks'])) {
            ?>
                                <div class="toast bg-gradient-success text-white" id="myToast">
                                    <div class="toast-body"><i class="fa fa-check"></i> &nbsp;<?= $_GET['remarks'] ?>
                                    </div>
                                </div>
                                <?php
            }
            ?>
                                <?php
            if (isset($_GET['error'])) {
            ?>
                                <div class="toast bg-gradient-danger text-white" id="myToast">
                                    <div class="toast-body"><i class="fa fa-times"></i> &nbsp;<?= $_GET['error'] ?>
                                    </div>
                                </div>
                                <?php
            }
            ?> -->
                                <!-- <form action="" onsubmit="return checkvalidate()" method="post"
                                    enctype="multipart/form-data" class="form-horizontal" role="form" style="margin: 1rem;">
                    </form> -->
                    <!-- Start AddNewDefaultUnit modal -->
                    <div class="modal fade" id="AddNewDefaultUnit" tabindex="-1" role="dialog">

                    
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Units</h5>
                                    <span type="button" onclick="funesdefaultunit()" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true" id="closeicon">&times;</span>
                                    </span>
                                </div>
                                <div class="modal-body">
                                    <form  action="" method="post" role="form">
                                    <div class="row justify-content-center">


                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group row" id="unitsindes">
                                                        <label for="Unit" class="custom-label text-danger"><span
                                                               class="">Unit *</span></label>

                                                    </div>
                                                    <input type="text" class="form-control  form-control-sm"
                                                        id="missingdefaultunit" name="missingdefaultunit"
                                                        placeholder="Unit" required>

                                                </div>
                                                <div class="col-md-7 unitmod">
                                                    <div class="form-group row" id="unitsindes">
                                                        <label for="Unit" class="custom-label text-danger" id="uqcindes"><span>
                                                                Unique Quanty Code(UQC) *</span></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control  form-control-sm" id="uqc"
                                                            name="uqc" placeholder="Unique Quanty Code(UQC)" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                </form>
                                <div class="modal-footer mfsub" style="margin-bottom: 0px !important;margin-top: 30px !important;">

                                <div class="col">
                                                  <button   onclick="funadddefaultunit()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitunit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>
                                                        <button type="button"
                                        class="btn btn-primary btn-sm btn-custom-grey"
                                        onclick="funesdefaultunit()">Cancel</button> </div>
                                                </div>







                            </div>
                        </div>
                    
                    </div>
                    <!-- End AddNewDefaultUnit modal -->
                    <!-- Start AddNewCategory modal -->
                    
                    <div class="modal fade" id="AddNewCategory" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">New <?=$access['txtnamecategory']?></h5>
                                    <span type="button" onclick="funescategory()" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true" id="closeicon">&times;</span>
                                    </span>
                                </div>
                                <div class="modal-body">
                                    <!-- <form method="post" action=""> -->
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="missingcategory" class="custom-label"><span class="text-danger">
                                                            Name *</span></label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" name="category" class="form-control form-control-sm mb-4" id="missingcategory" placeholder="Name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                                </div><!-- 
                                <div class="modal-body" style="padding: 1rem 0px 0px 2rem !important;">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <label for="Unit" class="custom-label"><span class="text-danger">Name *</span></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="justify-content-center p-1">
                                    <div style="margin-left: 30px;margin-right: 30px;"> -->
                                                                        <!-- <input type="text" name="category" class="form-control form-control-sm mb-4" id="missingcategory" required> -->
                                                                         <!-- </div> -->
                                <?php
                                                                    // $sqli = mysqli_query($con, "select distinct category from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and category!='' order by category asc");
                                                                    // while ($info = mysqli_fetch_array($sqli)) {
                                                                    ?>
                                                                    <?php
                                                                    // }
                                                                    ?>
                                                                     <?php
                                                                    // $sqli = mysqli_query($con, "select * from paircategory where createdid='$companymainid' and createdby='".$_SESSION['unqwerty']."' order by category asc");
                                                                    // while ($info = mysqli_fetch_array($sqli)) {
                                                                    ?>
                                                                    <!-- <div style="margin-left: 30px;margin-right: 30px;">
                                                                        <input type="text" name="categoryies[]" value="<?= $info['category'] ?>" class="form-control form-control-sm mb-4" required>
                                                                         </div> -->
                                                                        <?php
                                                                    // }
                                                                    ?>
                                <!-- <div class="container1">
    <p style="margin-left:180px; padding:0">
<a class="add_form_field btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another Category </span></a></p>
</div> -->
<!-- </div> -->
                                                                   
                                <div class="modal-footer ">

                                <div class="col">
                                                  <button   onclick="funaddcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitcategory" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>
                                                        <button type="button"
                                        class="btn btn-primary btn-sm btn-custom-grey"
                                        onclick="funescategory()">Cancel</button> </div>








                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                    <!-- End AddNewCategory modal -->
                    <!-- Start AddNewSubCategory modal -->
                    
                    <div class="modal fade" id="AddNewSubCategory" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Sub Category</h5>
                                    <span type="button" onclick="funessubcategory()" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true" id="closeicon">&times;</span>
                                    </span>
                                </div>
                                <div class="modal-body mbsub">
                                    <!-- <form method="post" action=""> -->
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="missingsubcategory" class="custom-label"><span class="text-danger">
                                                            Name *</span></label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control  form-control-sm"
                                                        id="missingsubcategory" name="missingsubcategory"
                                                        placeholder="Name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                                </div>
                                <div class="modal-footer mfsub">
                                <div class="col">
                                                  <button   onclick="funaddsubcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitsubcategory" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>
                                                        <button type="button"
                                        class="btn btn-primary btn-sm btn-custom-grey"
                                        onclick="funessubcategory()">Cancel</button> </div>


                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
                    <!-- End AddNewSubCategory modal -->
               <!--
            <div class="sticky" style="height:60px !important;margin-top: 14.5px !important;">
                                    <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 30px !important;margin-top: 9px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="franchises.php" style="margin-top:9px !important;">Cancel</a>
                                </div> -->
                                
                                <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Products' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise</div>
    <?php
}
else
{
?>
                               <form method="post" action="">
<?php
    include('navbottom.php');
    ?>
     <?php
     // if ((in_array('Product Information', $fieldadd))) {
        ?>
                                    
                                    <div class="accordion" id="accordionRental" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading"> <?= $infomainaccessuser['modulename'] ?>
                                                            Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne">
                                                <div class="accordion-body text-sm">
        <?php
            $sql=mysqli_query($con,"select count(productcode) from pairproducts where itemmodule='Products'");
            $ans=mysqli_fetch_array($sql);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Product Code', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="productcode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Code</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="productcode" name="productcode" readonly value="<?= $ans[0]+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<?php
            $publicsql=mysqli_query($con,"select count(publicid) from pairproducts where createdid='$companymainid' and itemmodule='Products'");
            $publicans=mysqli_fetch_array($publicsql);
            $sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
                                $infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Product Public Code', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="publiccode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Code Public</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="publiccode" name="publiccode" readonly value="<?= $infomodulespublicname['publiccolumn'] . $publicans[0]+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<?php
            $privatesql=mysqli_query($con,"select count(privateid) from pairproducts where createdid='$companymainid' and itemmodule='Products' and franchisesession='".$_SESSION['franchisesession']."'");
            $privateans=mysqli_fetch_array($privatesql);
            $sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Products' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
                                $infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Product Private Code', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="privatecode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Code Private</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="privatecode" name="privatecode" readonly value="<?= $infomainaccesspublicname['moduleprefix'] . $infomainaccesspublicname['modulesuffix']+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
     // if ((in_array('Name', $fieldadd))) {
        ?>
                                               <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="productname" class="custom-label"><span
                                                                            class="text-danger">Name
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="productname" name="productname"
                                                                        placeholder="Name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!-- </div> -->
                                                     
                                                    <?php
// }
?>
                                                    <div class="row justify-content-center" <?=((in_array('Code or Tags', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="codetags" class="custom-label"><span
                                                                            class="">Code / Tags</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="codetags" name="codetags"
                                                                        placeholder="Code / Tags">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Unit', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="Unit" class="custom-label"><span
                                                                            class="text-danger">Unit * <svg data-toggle="tooltip" title="The product will be measured in terms of this unit (e.g.: kg, dozen)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8" id="uck" onclick="andus()"><select class="form-control  form-control-sm" name="defaultunit" id="defaultunit" <?=((in_array('Unit', $fieldadd))?'required':'')?>>
                                                                        <option selected disabled value="">Unit</option>
                                                                        <?php
$sqlis = mysqli_query($con, "select uqc, unitname from pairunits where (createdid='$companymainid' or createdid='0') and (franchisesession='".$_SESSION["franchisesession"]."' or franchisesession='0') and (itemmodule='Products' or itemmodule='0') group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
<option value="<?= $infos['unitname']?>,<?=$infos['uqc'] ?>">
<?= $infos['unitname'] ?> - <?= $infos['uqc'] ?>
                                                                        </option>
                                                                        <?php
}
?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('HSN Code', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="hsncode" class="custom-label"><span
                                                                            class="">HSN Code</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="hsncode" name="hsncode"
                                                                        placeholder="HSN Code" maxlength="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <!---
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="sku" class="custom-label"><span
                                                                            class="">SKU <svg data-toggle="tooltip" title="The Stock Keeping of the product" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-bottom: 3px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="sku" name="sku"
                                                                        placeholder="SKU">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     
                                                    <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="upc" class="custom-label">UPC <svg data-toggle="tooltip" title="Twelve digit unique number associated with the bar code (Universal Product Code)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="upc" name="upc" placeholder="UPC">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    International Artical Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="ean" name="ean" placeholder="EAN">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    unambiguously identifies a part design" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="mpn" name="mpn" placeholder="MPN">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    digit unique commercial book identifier (International Standard Book Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="isbn" name="isbn" placeholder="ISBN">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                          </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="brand" id="brand">
                                                                        <option value="brand">Select or Add Brand
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    >
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="manufacturer" id="manufacturer">
                                                                        <option value="manufacturer">Select or Add Manufacturer
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                          <div class="col-sm-8">
                                                                    <input type="text" name="mname" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Molicular Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                          <div class="col-sm-8">
                                                                    <input type="text" name="mname" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Generic Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                          <div class="col-sm-8">
                                                                    <input type="text" name="mname" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Salt Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                         <div class="col-sm-8">
                                                                    <input type="text" name="mname" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Consume Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                    
                                                    
                                                     <div class="row justify-content-center" <?=((in_array('Category', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="Category" class="custom-label"><span
                                                                            class=""><?=$access['txtnamecategory']?></span></label>
                                                                </div>
                                                                <div class="col-sm-8" onclick="andus()">
                                                                    <select
                                                                        class="form-control  form-control-sm"
                                                                        name="category" id="category">
                                                        
                                                                        <?php
                                                                    $sqli = mysqli_query($con, "select * from paircategory where (createdid='$companymainid' or createdid='0') and itemmodule='Products' and category!='' order by category asc");
                                                                    while ($info = mysqli_fetch_array($sqli)) {
                                                                    ?>
                                                                        <option value="<?= $info['category'] ?>">
                                                                            <?= $info['category'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <option selected disabled><?=$access['txtnamecategory']?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Sub Category', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="subcategory" class="custom-label"><span
                                                                            class="">Sub Category</span></label>
                                                                </div>
                                                                <div class="col-sm-8" onclick="andus()">
                                                                    <select
                                                                        class="form-control form-control-sm"
                                                                        name="subcategory" id="subcategory">
                                                        
                                                                        <?php
                                                                    $sqli = mysqli_query($con, "select * from pairsubcategory where (createdid='$companymainid' or createdid='0') and itemmodule='Products' and subcategory!='' order by subcategory asc");
                                                                    while ($info = mysqli_fetch_array($sqli)) {
                                                                    ?>
                                                                        <option value="<?= $info['subcategory'] ?>">
                                                                            <?= $info['subcategory'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                        <option selected disabled>Sub Category</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!---
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label">Dimensions</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group mb-3">
  <div style="border:1px solid lightgrey;width: 272px;height: 32px;">
                                                                        <input class="lwh" type="number" name="" style="border: none;background: #FFFFFF;width: 72.34px;height: 24px;text-align: center;margin-top: 3px;margin-left: 5px;" placeholder="Length">
                                                                        <span style="width: 20.48px;height: 35.19;font-size: 12px;color: #CCCCCC;background: #FFFFFF;margin-left: 3px;margin-right: 3px;">X</span>
                                                                        <input class="lwh" type="number" name="" style="border: none;background: #FFFFFF;width: 72.34px;height: 24px;text-align: center;margin-top: 3px;" placeholder="Width">
                                                                        <span style="width: 20.48px;height: 35.19;font-size: 12px;color: #CCCCCC;background: #FFFFFF;margin-left: 3px;margin-right: 0px;">X</span>
                                                                        <input class="lwh" type="number" name="" style="border: none;background: #FFFFFF;width: 72.34px;height: 24px;text-align: center;margin-top: 3px;" placeholder="Height">
                                                                    </div>
  <div class="input-group-append">
    <select
                                                                        class="input-group-text form-control  form-control-sm"
                                                                        name="dimen" id="dimen"   style="color: #495057;padding: 5px 9.75px;background-color:#EEEEEE;border: 1px solid lightgrey;height: 32px;" required>
                                                                        <option value="dimen" class="OPTION">cm
                                                                        </option>
                                                                        <option value="dimen" class="OPTION">in
                                                                        </option>
                                                                    </select>
  </div>
</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row justify-content-center" style="margin-top:-15px;">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label">Weight</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" name="weight" class="form-control  form-control-sm" style="border:1px solid lightgrey;text-align: center;" placeholder="Weight">
  <div class="input-group-append">
    <select
                                                                        class="form-control  form-control-sm input-group-text"
                                                                        name="weigh" id="weigh"   style="color: #495057;padding: 4px 9.75px;background-color:#EEEEEE;border: 1px solid lightgrey;">
                                                                        <option value="kg" class="OPTION">kg - Kilogram
                                                                        </option>
                                                                        <option value="g" class="OPTION">g - Gram
                                                                        </option>
                                                                        <option value="lb" class="OPTION">lb - Pound
                                                                        </option>
                                                                        <option value="oz" class="OPTION">oz - Ounces
                                                                        </option>
                                                                        <option value="t" class="OPTION">t - Ton
                                                                        </option>
                                                                    </select>
  </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                    <div class="row justify-content-center" <?=((in_array('Rack', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="rack" class="custom-label">
                                                                        <span class="">Rack</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="rack" name="rack" placeholder="Rack">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
          <div class="row justify-content-center deltophead" <?=((in_array('Delivery', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label">Delivery</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="delivery" class="form-control  form-control-sm" id="delinpbrd" placeholder="Delivery">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row justify-content-center" <?=((in_array('Description', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="description" class="custom-label"><span
                                                                            class="">Description</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <textarea
                                                                        class="form-control" id="description"
                                                                        name="description" placeholder="Description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                     
                                                </div>
                                            </div>
                                        </div>
                                   <?php
                                    // }
                                    ?>
                                    <div class="accordion" id="accordionRental" <?=((in_array('Product Visibility', $fieldadd))?'':'style="display:none;"')?>>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingfour">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsefour"
                                                    aria-expanded="true" aria-controls="collapsefour">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading"><?= $infomainaccessuser['modulename'] ?> Visibility</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapsefour" class="accordion-collapse collapse show"
                                                aria-labelledby="headingfour">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label mt-2 text-danger">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibility" id="visibility" value="PUBLIC" <?=($infomainaccessuser['productvisible']=='PUBLIC')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="visibility">Public</label>
                      </div>

                      </div>
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibility" id="novisibility" value="PRIVATE" <?=($infomainaccessuser['productvisible']=='PRIVATE')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="novisibility">Private</label>
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
                                        </div>
                                        </div>
                                    <!---
                                    <?php
                                                     // if($permissionproimage!='0'){
                                                    ?>
                                                    <?php
                                                     // if($permissionproimgadd!='0'){
                                                    ?>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="true" aria-controls="collapseTwo">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">Product Image</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseTwo" class="accordion-collapse collapse show"
                                                aria-labelledby="headingTwo">
                                                <div class="accordion-body text-sm">
                                                    <div class="accordion-body text-sm opacity-8">





                                                        <div class="row text-sm ">
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview"
                                                                        class=" preview1 navbar-brand-img" alt="image">
                                                                </div>
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                <i class="fa fa-pencil-square-o"></i></p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col">
                                                                        <i id="removeImage1" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                                </div>
                                                            </div>



                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                            <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview2"
                                                                        class=" preview2 navbar-brand-img" alt="image">
                                                                </div>
                                                            </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag2" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                <i class="fa fa-pencil-square-o"></i></p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col">
                                                                        <i id="removeImage2" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview3"
                                                                        class=" preview3 navbar-brand-img" alt="image">
                                                                </div>
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag3" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                <i class="fa fa-pencil-square-o"></i></p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col" >
                                                                        <i id="removeImage3" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview4"
                                                                        class=" preview4 navbar-brand-img" alt="image">
                                                                </div>
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag4" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                <i class="fa fa-pencil-square-o"></i></p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col">
                                                                        <i id="removeImage4" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview5"
                                                                        class=" preview5 navbar-brand-img" alt="image">
                                                                </div>
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag5" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                <i class="fa fa-pencil-square-o"></i></p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col ">
                                                                        <i id="removeImage5" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <?php
                                    // }
                                // }
                                    ?>
                                    <?php
                                                     // if($permissionpropurchase!='0'){
                                                    ?>
                                                    <?php
                                                     // if($permissionpropuradd!='0'){
                                                    ?>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingThree">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="true" aria-controls="collapseThree">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">Purchase Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapseThree" class="accordion-collapse collapse show"
                                                aria-labelledby="headingThree">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="table-responsive" style="margin-left: 10%;margin-right: 10%;">
  <table class="table table-bordered" id="purchasetable">
<thead style="color: #000000;font-size: 14px;">
<tr><td></td><td>PRICE NAME</td><td style="text-align: right !important;">MRP <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></th><th style="text-align: right !important;">COST PRICE <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td><td>DESCRIPTION</td><td></td></tr>
</thead>
<tbody>
<tr>
<td style="width:0%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td style="width:18%;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="productname[]" id="productname3" required class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Purchase Price"><br><span id="chk"></span></td>
<td style="width:11%;">
    <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></span>
    </div>
    <input type="age" min="0" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)">
  </div>
</td>
<td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td>
<td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td>
<td style="width:0%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
   <!-- <select>
    <tr id="none" style="display: ;">
    <option><td>name</td></option>
    <option><td colspan="5">name</td></option>
    </tr>
    </select> 
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-8">
    <p style="margin-left:37.2%; padding:0">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div>

                                                        <!-- <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="mrp" class="custom-label"><span
                                                                            class="text-danger">MRP
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 4px 9.75px;background-color:#EEEEEE;border-radius:3px;border: 1px solid lightgrey;">INR</span>
    </div>
    <input type="text" style="padding:5px 8px;border: 1px solid lightgrey;"
                                                                        class="form-control  form-control-sm"
                                                                        id="mrp" name="mrp"
                                                             required>
  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="pur" class="custom-label"><span
                                                                            class="text-danger">Selling
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 4px 9.75px;background-color:#EEEEEE;border-radius:3px;border: 1px solid lightgrey;">INR</span>
    </div>
    <input type="text" style="padding:5px 8px;border: 1px solid lightgrey;"
                                                                        class="form-control  form-control-sm"
                                                                        id="pur" name="pur"
                                                             required>
  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="purchase" class="custom-label"><span
                                                                            class="text-danger">Account
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control form-control-sm"
                                                                        name="purchase" id="purchase" required>
                                                                        <option value="purchase"> Sales</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="purchasedescription" class="custom-label"><span
                                                                            class="">Description</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <textarea style="height: 53.59px !important;width: 247.98;padding: 5px 8px;"
                                                                        class="form-control" id="purchasedescription"
                                                                        name="purchasedescription"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>-->
                                        <?php
                                    // }
                                // }
                                    ?>



                                    <div class="accordion" id="accordionRental" <?=((in_array('Barcode Information', $fieldadd))?'':'style="display:none;"')?>>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingbarcode">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsebarcode"
                                                    aria-expanded="true" aria-controls="collapsebarcode">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">Barcode Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapsebarcode" class="accordion-collapse collapse show"
                                                aria-labelledby="headingbarcode">
                                                <div class="accordion-body text-sm">
                                                    <div class="row justify-content-center" <?=((in_array('Barcode Title', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="barcodetitle" class="custom-label"><span
                                                                            class="">Barcode Title</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="barcodetitle" name="barcodetitle"
                                                                        placeholder="Barcode Title">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Barcode Subtitle', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="barcodehead" class="custom-label"><span
                                                                            class="">Barcode Subtitle</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="barcodehead" name="barcodehead"
                                                                        placeholder="Barcode Subtitle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Barcode Type', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="ean13" class="custom-label"><span
                                                                            class="">Barcode Type</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                      <div class="col-sm-6 my-1">
                                                                      <div class="custom-control custom-radio mr-sm-2">
                                                                        <input type="radio" class="custom-control-input" name="barcodeformat" id="ean13" value="EAN / UPC">
                                                                        <label class="custom-control-label custom-label" for="ean13">EAN-13</label>
                                                                      </div>
                                                                      </div>
                                                                      <div class="col-sm-6 my-1">
                                                                      <div class="custom-control custom-radio mr-sm-2">
                                                                        <input type="radio" class="custom-control-input" name="barcodeformat" id="upca" value="EAN / UPC">
                                                                        <label class="custom-control-label custom-label" for="upca">UPC-A</label>
                                                                      </div>
                                                                      </div>
                                                                      <div class="col-sm-6 my-1">
                                                                      <div class="custom-control custom-radio mr-sm-2">
                                                                        <input type="radio" class="custom-control-input" name="barcodeformat" id="code39" value="CODE39" checked>
                                                                        <label class="custom-control-label custom-label" for="code39">Code-39</label>
                                                                      </div>
                                                                      </div>
                                                                      <div class="col-sm-6 my-1">
                                                                      <div class="custom-control custom-radio mr-sm-2">
                                                                        <input type="radio" class="custom-control-input" name="barcodeformat" id="itf" value="ITF">
                                                                        <label class="custom-control-label custom-label" for="itf">ITF</label>
                                                                      </div>
                                                                      </div>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Barcode', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="barcode" class="custom-label"><span
                                                                            class="">Barcode</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="barcode" name="barcode"
                                                                        placeholder="Barcode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Under Barcode Label', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="underbarcodelabel" class="custom-label"><span
                                                                            class="">Under Barcode Label</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="underbarcodelabel" name="underbarcodelabel"
                                                                        placeholder="Under Barcode Label">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Footer Note', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="barcodenotes" class="custom-label"><span
                                                                            class="">Footer Note</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="barcodenotes" name="barcodenotes"
                                                                        placeholder="Footer Note">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                                    <div class="accordion" id="accordionRental" <?=((in_array('Sales Information', $fieldadd))?'':'style="display:none;"')?>>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingsale">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsesale"
                                                    aria-expanded="true" aria-controls="collapsesale">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading"><?= $salehead ?>
                                                            Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapsesale" class="accordion-collapse collapse show"
                                                aria-labelledby="headingsale">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="table-responsive" <?=(((in_array('Sale Price Name', $fieldadd))||(in_array('Sale MRP', $fieldadd))||(in_array('Sale Price Rate', $fieldadd))||(in_array('Sale Description', $fieldadd)))?'':'style="display:none;"')?>>
  <table class="table table-bordered" id="saletable">
<thead>
<tr><td class="text-uppercase" id="firstclsale"><span id="tdfsize"></span></td>
    <td class="text-uppercase" id="secondclsale" <?=((in_array('Sale Price Name', $fieldadd))?'':'style="display:none;"')?>><span id="tdfsize">PRICE NAME</span></td>
    <td class="text-uppercase" id="thirdclsale" <?=((in_array('Sale MRP', $fieldadd))?'':'style="display:none;"')?>><span id="tdfsize">MRP</span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <td class="text-uppercase" id="fourthclsale" <?=((in_array('Sale Price Rate', $fieldadd))?'':'style="display:none;"')?>><span id="tdfsize">PRICE/RATE</span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <td class="text-uppercase" id="fifthclsale" <?=((in_array('Sale Description', $fieldadd))?'':'style="display:none;"')?>><span id="tdfsize">DESCRIPTION</span></td>
        <td class="text-uppercase" id="sixthclsale"><span id="tdfsize"></span></td></tr>
</thead>
<tbody>
<tr>
<td data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" ><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="PRICE NAME" <?=((in_array('Sale Price Name', $fieldadd))?'':'style="display:none;"')?>><input type="hidden" name="productid[]" id="productid1"><input type="text" name="pricename[]" id="productname1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidthnamdes"  oninput="title(this)" data-toggle="tooltip" title="" placeholder="Sale Price or Trade Price or Wholesale Price"></td>
<td data-label="MRP" <?=((in_array('Sale MRP', $fieldadd))?'':'style="display:none;"')?>>
    <div>
       <span><?php echo $res[0]; ?></span>
    <input type="age" min="0" name="mrp[]" id="quantity1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidth"  onChange="productcalc(1)" placeholder="0.00">
  </div>
</td>
<td data-label="SELLING PRICE" <?=((in_array('Sale Price Rate', $fieldadd))?'':'style="display:none;"')?>><div><span><?php echo $res[0]; ?></span><input placeholder="0.00" type="age" min="0" name="sellingprice[]"  id="productrate1" class="form-control form-control-sm bordernoneinput rup bor totaldesign productselectwidth" onChange="productcalc(1)"></div></td>
<td data-label="DESCRIPTION" <?=((in_array('Sale Description', $fieldadd))?'':'style="display:none;"')?>><input type="text" min="0" name="descriptions[]" id="vat1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidthnamdes"></td>
<td data-label=""><a onclick="addclick()" id="intusymbol"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-deletes" id="intusymbol"><img src="assets/img/delete-row.png" width="15" height="15" id="imgintusymbol"></a></td>
</tr>
    <!-- <tr id="none" style="display: ;"> </tr>--> 
</tbody>
</table>
</div>
<!-- 
<div class="row">
<div class="col-lg-8">
    <p style="margin-left:37.2%; padding:0">
<a class="saleadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div> -->
<!-- <div class="row" style="margin-left: 8.5%;margin-right: 8.5%;">
<div class="col-lg-8">
    <p style="">
<a class="saleadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div> -->
<!-- <select>
    <option><td>name</td></option>
    <option><td colspan="5">name</td></option>
    </select> -->
<!-- <div class="row justify-content-center">
                                                         <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="mrp" class="custom-label"><span
                                                                            class="text-danger">MRP
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 4px 9.75px;background-color:#EEEEEE;border-radius:3px;border: 1px solid lightgrey;">INR</span>
    </div>
    <input type="text" style="padding:5px 8px;border: 1px solid lightgrey;"
                                                                        class="form-control  form-control-sm"
                                                                        id="mrp" name="mrp"
                                                             required>
  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="sales" class="custom-label"><span
                                                                            class="text-danger">Cost Price
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 4px 9.75px;background-color:#EEEEEE;border-radius:3px;border: 1px solid lightgrey;">INR</span>
    </div>
    <input type="text" style="padding:5px 8px;border: 1px solid lightgrey;"
                                                                        class="form-control  form-control-sm"
                                                                        id="sales" name="sales"
                                                             required>
  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="sale" class="custom-label"><span
                                                                            class="text-danger">Account
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control form-control-sm"
                                                                        name="sale" id="sale" required>
                                                                        <option value="sale"> Cost of Goods Sold</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="salesdescription" class="custom-label"><span
                                                                            class="">Description</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <textarea style="height: 53.59px !important;width: 247.98;padding: 5px 8px;"
                                                                        class="form-control" id="salesdescription"
                                                                        name="salesdescription"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> -->
                                        </div>
                                        </div>
                                        </div>


                                                    <div class="accordion" id="accordionRental" <?=((in_array('Purchase Information', $fieldadd))?'':'style="display:none;"')?>>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingpurchase">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsepurchase"
                                                    aria-expanded="true" aria-controls="collapsepurchase">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading"><?= $purhead ?>
                                                            Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapsepurchase" class="accordion-collapse collapse show"
                                                aria-labelledby="headingpurchase">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="table-responsive" <?=(((in_array('Purchase Price Name', $fieldadd))||(in_array('Purchase MRP', $fieldadd))||(in_array('Purchase Price Rate', $fieldadd))||(in_array('Purchase Description', $fieldadd)))?'':'style="display:none;"')?>>
  <table class="table table-bordered" id="purchasetable">
<thead>
<tr><td class="text-uppercase" id="firstclsale"><span id="tdfsize"></span></td>
    <td class="text-uppercase" id="secondclsale" <?=((in_array('Purchase Price Name', $fieldadd))?'':'style="display:none;"')?>><span id="tdfsize">PRICE NAME</span></td>
    <td class="text-uppercase" id="thirdclsale" <?=((in_array('Purchase MRP', $fieldadd))?'':'style="display:none;"')?>><span id="tdfsize">MRP</span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <td class="text-uppercase" id="fourthclsale" <?=((in_array('Purchase Price Rate', $fieldadd))?'':'style="display:none;"')?>><span id="tdfsize">PRICE/RATE</span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <td class="text-uppercase" id="fifthclsale" <?=((in_array('Purchase Description', $fieldadd))?'':'style="display:none;"')?>><span id="tdfsize">DESCRIPTION</span></td>
                                    <td class="text-uppercase" id="sixthclsale"><span id="tdfsize"></span></td></tr>
</thead>
<tbody>
<tr>
<td data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="PRICE NAME" <?=((in_array('Purchase Price Name', $fieldadd))?'':'style="display:none;"')?>><input type="hidden" name="productid[]" id="productid1"><input type="text" name="pricenamepur[]" id="productname1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidthnamdes" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Purchase Price or Trade Price or Wholesale Price"></td>
<td data-label="MRP" <?=((in_array('Purchase MRP', $fieldadd))?'':'style="display:none;"')?>>
    <div>
       <span><?php echo $res[0]; ?></span>
    <input type="age" min="0" name="mrppur[]" id="quantity1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidth" style="height: 21px !important;" onChange="productcalc(1)" placeholder="0.00">
  </div>
</td>
<td data-label="SELLING PRICE" <?=((in_array('Purchase Price Rate', $fieldadd))?'':'style="display:none;"')?>><div><span><?php echo $res[0]; ?></span><input placeholder="0.00" type="age" min="0" name="sellingpricepur[]"  id="productrate1" class="form-control form-control-sm bordernoneinput rup bor totaldesign productselectwidth" style="height: 21px !important;" onChange="productcalc(1)"></div></td>
<td data-label="DESCRIPTION" <?=((in_array('Purchase Description', $fieldadd))?'':'style="display:none;"')?>><input type="text" min="0" name="descriptionspur[]" id="vat1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidthnamdes"></td>
<td data-label=""><a onclick="addclick()" id="intusymbol"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-deletes" id="intusymbol"><img src="assets/img/delete-row.png" width="15" height="15" id="imgintusymbol"></a></td>
</tr>
    <!-- <tr id="none" style="display: ;"> </tr>--> 
</tbody>
</table>
</div>
<!-- 
<div class="row">
<div class="col-lg-8">
    <p style="margin-left:37.2%; padding:0">
<a class="saleadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div> -->
<!-- <div class="row" style="margin-left: 8.5%;margin-right: 8.5%;">
<div class="col-lg-8">
    <p style="">
<a class="saleadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div> -->
<!-- <select>
    <option><td>name</td></option>
    <option><td colspan="5">name</td></option>
    </select> -->
<!-- <div class="row justify-content-center">
                                                         <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="mrp" class="custom-label"><span
                                                                            class="text-danger">MRP
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 4px 9.75px;background-color:#EEEEEE;border-radius:3px;border: 1px solid lightgrey;">INR</span>
    </div>
    <input type="text" style="padding:5px 8px;border: 1px solid lightgrey;"
                                                                        class="form-control  form-control-sm"
                                                                        id="mrp" name="mrp"
                                                             required>
  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="sales" class="custom-label"><span
                                                                            class="text-danger">Cost Price
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 4px 9.75px;background-color:#EEEEEE;border-radius:3px;border: 1px solid lightgrey;">INR</span>
    </div>
    <input type="text" style="padding:5px 8px;border: 1px solid lightgrey;"
                                                                        class="form-control  form-control-sm"
                                                                        id="sales" name="sales"
                                                             required>
  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="sale" class="custom-label"><span
                                                                            class="text-danger">Account
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control form-control-sm"
                                                                        name="sale" id="sale" required>
                                                                        <option value="sale"> Cost of Goods Sold</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="salesdescription" class="custom-label"><span
                                                                            class="">Description</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <textarea style="height: 53.59px !important;width: 247.98;padding: 5px 8px;"
                                                                        class="form-control" id="salesdescription"
                                                                        name="salesdescription"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> -->
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>




                                                    <!-- <div class="accordion" id="accordionRental"> -->
                                        <div class="accordion-item mb-1" <?=((in_array('Tax Information', $fieldadd))?'':'style="display:none;"')?>>
                                            <h5 class="accordion-header" id="headingFive">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                    aria-expanded="true" aria-controls="collapseFive">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">Tax
                                                            Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseFive" class="accordion-collapse collapse show"
                                                aria-labelledby="headingFive">
                                                <div class="accordion-body text-sm">
                                                                
                                                                <div class="row justify-content-center" <?=((in_array('Tax Preference', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label mt-2 text-danger">Tax Preference *</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                      <div class="col-lg-5 my-1" style="z-index: 0;">
                      <div class="custom-control custom-radio mr-sm-2" onclick="taxable()">
                        <input type="radio" class="custom-control-input" name="taxable" id="taxable" value="1" checked>
                        <label class="custom-control-label custom-label" for="taxable">Taxable</label>
                      </div>

                      </div>
                      <!-- <div class="col-lg-5 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2" onclick="nontaxable()">
                        <input type="radio" class="custom-control-input" name="taxable" id="nontaxable" value="0">
                        <label class="custom-control-label custom-label" for="nontaxable">Non Taxable</label>
                      </div>

                      </div> -->
                  </div>
              </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div id="taxablediv">
                                                                <div class="row justify-content-center" id="taxprefer" <?=((in_array('Tax Rate', $fieldadd))?'':'style="display:none;"')?>>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label for="taxratecountry"
                                                                                    class="custom-label"><span
                                                                                        class="">Tax Rate</span></label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group mb-3 input-group-sm" id="flagicon">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="flagimg">
                                                                                            <img src="assets/img/Indian-Flag.png"
                                                                                                width="25"
                                                                                                height="20"></span>
                                                                                    </div>
                                                                                    <?php
                                                                                    $country=mysqli_query($con,"select * from paricountry");
                                                                                    $india=mysqli_fetch_array($country);
                                                                                    ?>
                                                                                    <input type="text"
                                                                                        class="country" id="taxratecountry"
                                                                                        name="taxratecountry"
                                                                                        value="<?= $india['country'] ?>" readonly style="width: 60px !important;">
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="row justify-content-center" id="intrahead" <?=((in_array('Intra State Tax Rate', $fieldadd))?'':'style="display:none;"')?>>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label for="intratax"
                                                                                    class="custom-label"><span
                                                                                        class="" style="border-bottom: 1px dashed grey;">Intra State
                                                                                        Tax Rate</span></label>
                                                                                <!-- <hr class="dash" /> -->
                                                                            </div>
                                                                            <div class="col-sm-8" onclick="andus()">
                                                                                <select
                                                                                    class="select4 form-control  form-control-sm"
                                                                                    name="intratax" id="intratax"
                                                                                    required>
                                                                                    <option selected disabled>Select</option>
                                                                                    <?php
                  $count=1;
                  $sqlit=mysqli_query($con, "select * from pairtaxrates  where taxgroups!=''and (createdid='$companymainid' or createdid='0') order by tax asc");
                  while($infot=mysqli_fetch_array($sqlit))
                  {
                      ?>
                                                                                    <option value="<?=$infot['id']?>">
                                                                                        <?=$infot['taxname']?> -
                                                                                        <?=$infot['tax']?>%
                                                                                    </option>
                                                                                    <?php
                  }
                  ?>
                  
                                                                                </select>
                                                                                <!-- <span style="color:royalblue;font-size: 11px;position: relative;top: -3px;cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal">Config Tax Group</span> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center" id="intrahead" <?=((in_array('Inter State Tax Rate', $fieldadd))?'':'style="display:none;"')?>>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label for="intertax"
                                                                                    class="custom-label"><span
                                                                                        class="" style="border-bottom: 1px dashed grey;">Inter State
                                                                                        Tax Rate</span></label>
                                                                                <!-- <hr class="dash" /> -->
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <select
                                                                                    class="select4 form-control  form-control-sm"
                                                                                    name="intertax" id="intertax"
                                                                                    required>
                                                                                    <option selected disabled>Select</option>
                                                                                    <?php
$taxgroups = '';
$sqlit=mysqli_query($con, "select * from pairtaxrates  where taxgroups!=''and (createdid='$companymainid' or createdid='0') order by tax asc");
while($infotgp=mysqli_fetch_array($sqlit))
{
if ($taxgroups!='') {
$taxgroups .= ",".$infotgp['taxgroups'];
}
else{
$taxgroups .= $infotgp['taxgroups'];
}
}
                  $count=1;
                  $sqlit=mysqli_query($con, "select * from pairtaxrates where (taxgroups='' or taxgroups IS NULL) and (createdid='$companymainid' or createdid='0') and id not in (".$taxgroups.") order by tax asc");
                  while($infot=mysqli_fetch_array($sqlit))
                  {
                      ?>
                                                                                    <option value="<?=$infot['id']?>">
                                                                                        <?=$infot['taxname']?> -
                                                                                        <?=$infot['tax']?>%
                                                                                    </option>
                                                                                    <?php
                  }
                  ?>
                                                                                </select>
                                                                                <!-- <span style="color:royalblue;font-size: 11px;position: relative;top: -3px;cursor: pointer;">Config Tax</span> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>



 





                                                        </div>
                                                        <div class="col-sm-2"> </div>


                                                    </div>
                                                     <div class="row "> 

                                                        <div class="col-sm-6">


                                                            <!-- <div id="nontaxablediv" style="display:none">

                                                                 <div class="row justify-content-center">
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <label for="excemptionreason"
                                                                                    class="custom-label"><span
                                                                                        style="color: #ee0000;">Exemption
                                                                                        Reason*</span></label>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <input type="text"
                                                                                    class="form-control  form-control-sm"
                                                                                    id="excemptionreason"
                                                                                    name="excemptionreason"
                                                                                    placeholder="Exemption Reason">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 

<div class="row justify-content-center" style="position:relative;top: -50px;">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label for="excemptionreason"
                                                                                    class="custom-label"><span
                                                                                        style="color: #ee0000;">Exemption
                                                                                        Reason*</span></label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                    <input type="text"
                                                                                    class="form-control  form-control-sm"
                                                                                    id="excemptionreason"
                                                                                    name="excemptionreason"
                                                                                    placeholder="Exemption Reason">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->





                                                            </div>

                                                         </div> 
                                                         <div class="col-sm-6"> </div> 



                                                     </div> 
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    <!--
                                    <?php
                                                     // if($permissionproinventory!='0'){
                                                    ?>
                                                     <?php
                                                     // if($permissionproinvadd!='0'){
                                                    ?>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingSix">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                    aria-expanded="true" aria-controls="collapseSix">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">Inventory Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseSix" class="accordion-collapse collapse show"
                                                aria-labelledby="headingSix">
                                                <div class="accordion-body text-sm">



                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="trackinventory">
                                                        <label class="form-trackinventory-label custom-label"
                                                            for="trackinventory" style="margin-top: 4px;">
                                                            Track Inventory for this Item <a href="#"
                                                                data-toggle="tooltip" title="Hooray!"><i
                                                                    class="fa fa-question-circle-o" aria-hidden="true"
                                                                    style="font-size: 14px;"></i> </a>
                                                        </label>

                                                        <p><small style="color:#8392AB"> You cannot enable/disable
                                                                inventory tracking once you've created transactions for
                                                                this item</small></p>
                                                    </div>

                                                    <br>
                                                    </br>


                                                     <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="inventoryaccounttype"
                                                                        class="custom-label"><span
                                                                            class="text-danger">Inventory Account
                                                                            Type*</span></label>
                                                                    <hr style="width: 160px" class="dash" />
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="inventoryaccounttype"
                                                                        id="inventoryaccounttype" required disabled>
                                                                        <?php
// $sqlis = mysqli_query($con, "select uqc, unitname from pairunits group by uqc order by unitname asc");
// while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                        <option value="<?= $infosuqc[''] ?>">
                                                                            <?= $infosunitname[''] ?> -
                                                                            <?= $infosuqc[''] ?>
                                                                        </option>
                                                                        <?php
// }
?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="openingstock" class="custom-label"><span
                                                                            class="">Opening Stock</span></label>
                                                                    <hr style="width: 100px" class="dash" />
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="openingstock" name="openingstock" required
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="openingstockrate"
                                                                        class="custom-label"><span class="">Opening
                                                                            Stock Rate per Unit</span></label>
                                                                </div>
                                                                <div class="col-sm-8">

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="input-group-prepend unitchange">
                                                                                <span
                                                                                    class="input-group-text basicaddon1"
                                                                                    id="" placeholder=" BALE - BAL">Unit
                                                                                </span>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-sm-6">

                                                                            <div class="input-group">
                                                                                <div
                                                                                    class="input-group-prepend Unitchange">
                                                                                    <span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="Unitchange1">₹</span>
                                                                                </div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="openingstockrate"
                                                                                    id="openingstockrate"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
 -->
                                                    <!-- <div class="table-responsive">
                                                            <table class="table table-hover  table-bordered" style="width:500px;margin-left: 275px;"
                                                                id="purchasetable">
                                                                <thead>
                                                                    <tr>
                                                                         <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"
                                                                            scope="col" class="text-center"></th>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"
                                                                            scope="col" class="text-center">
                                                                        </th>


                                                                        <th>MRP</th>
                                                                        <th><span style="float: right;">Selling Price</span></th>
                                                                        <th><span style="float: right;">Batch
                                                                            </span></th>
                                                                        <th><span style="float: right;">Expiry </span>
                                                                        </th>
                                                                        <th><span style="float: right;">Unit
                                                                            </span></th>
                                                                            <th><span style="float: right;">Quantity
                                                                            </span></th>
                                                                        <th
                                                                            style="border-top: 1px solid #dee2e6;">
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="1">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td class="btn-delete"
                                                                            style="border-top: 1px solid #dee2e6;cursor: pointer;">
                                                                            <img src="assets/img/delete-row.png"
                                                                                alt="Girl in a jacket" width="15"
                                                                                height="15"
                                                                                style="border-radius: 10px;">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                        <p style="margin-left:272px; padding:0"><a
                                                                class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey"
                                                                style="background-color: #e9ecef;">
                                                                <i style="font-size: 14px;color:#0066cc"
                                                                    class="fa fa-plus-circle"></i> Add another line</a>
                                                        <p>
                                                </div>
                                            </div>
                                        </div> 
                                      <div  id="table">
                                          <div class="table-responsive" style="margin-left: 10%;margin-right: 10%;">
  <table class="table table-bordered" id="inventorytable">
<thead style="color: #000000;font-size: 14px;">
<tr><td></td><td>BRANCH</td><td>OPENING STOCK <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Initial Quantity on Hand">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td><td>AS OF DATE <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Initial Quantity on Hand">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td><td>BATCH</td><td>EXPIRY</td <th>PRICE NAME</th> <td>UNIT</td><td style="text-align: right !important;">MRP</td><td style="text-align: right !important;">RATE PER UNIT</td><td></td></tr>
</thead>
<tbody>
<tr>
<td style="width:0%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td style="width:21%;"><input type="text" class="form-control form-control-sm bordernoneinput bor" name="branch" style="height:21px;padding: 0px;text-align: left;"></td>
<td style="width:15%;"><input type="text" class="form-control form-control-sm bordernoneinput bor" name="openingstock" style="height:21px;padding: 0px;text-align: left;" placeholder="Initial Quantity on Hand"></td>
<td style="width:15%;"><input type="text" class="form-control form-control-sm bordernoneinput bor" name="asd" style="height:21px;padding: 0px;text-align: left;" placeholder="AS OF DATE"></td>
<td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td>
<td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td>
 <td style="width:18%;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="productname[]" id="productname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td> 
<td style="width:8%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td>
<td style="width:11 <input type="number" min="0" step="0.01" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;" onChange="productcalc(1)"> 
    <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></span>
    </div>
    <input type="age" min="0" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)">
  </div>
</td>
<td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td>
<td style="width:0%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
    <select>
    <tr id="none" style="display: ;">
    <option><td>name</td></option>
    <option><td colspan="5">name</td></option>
    </tr>
    </select>
     
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-8">
    <p style="margin-left:37.2%; padding:0">
<a class="inventoryadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div>
  </div>
</div>
</div>
<?php
                                    // }
                                // }
                                    ?>
                                    <?php
                                                     // if($permissionprostock!='0'){
                                                    ?>
                                                     <?php
                                                     // if($permissionprostkadd!='0'){
                                                    ?>
  <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#stock"
                                                    aria-expanded="true" aria-controls="stock">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">Stock Alert</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="stock" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne">
                                                <div class="accordion-body text-sm">
                                                    <div class="row justify-content-center">

                                                    <div class="form-group " style="display: none;">
                    <label for="productcode">Product Code</label>
                    <input type="text" class="form-control  form-control-sm" id="productcode" name="productcode" readonly>
                  </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="codetags" class="custom-label"><span
                                                                            class="">Reorder Point <svg data-toggle="tooltip" title="Thirteen digit unique number (International Artical Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="ptr" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Reorder Point">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    // }
                                // }
                                    ?>
                                    <?php
                                                     // if($permissionproother!='0'){
                                                    ?>
                                                    <?php
                                                     // if($permissionproothadd!='0'){
                                                    ?>
                                        <div class="accordion mb-5" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#other"
                                                    aria-expanded="true" aria-controls="other">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">Other Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="other" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne">
                                                <div class="accordion-body text-sm">
                                                    <div class="row justify-content-center">

                                                    <div class="form-group " style="display: none;">
                    <label for="productcode">Product Code</label>
                    <input type="text" class="form-control  form-control-sm" id="productcode" name="productcode" readonly>
                  </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="codetags" class="custom-label"><span
                                                                            class="">P.T.R <svg data-toggle="tooltip" title="P.T.R" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="ptr" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="P.T.R">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="codetags" class="custom-label"><span
                                                                            class="">P.T.S <svg data-toggle="tooltip" title="P.T.S" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="pts" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="P.T.S">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="codetags" class="custom-label"><span
                                                                            class="">Member Discount <svg data-toggle="tooltip" title="Member Discount" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="md" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Member Discount">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="codetags" class="custom-label"><span
                                                                            class="">DCC Discount <svg data-toggle="tooltip" title="DCC Discount" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="dd" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="DCC Discount">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">

                                            <div class="row col-md-12 fixed-bottom" id="footer" style="background-color: #ffffff;width: 1650px;height: 50px;margin-bottom: 0px;padding-top: 10px;margin-left: 223px;box-shadow: 9px 9px 9px 9px lightgrey;">
                                                <div class="col" >
                                                  <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="franchises.php">Cancel</a>
                                                </div>


                                            </div>

                                        </div>
                                        
                                        <div class="card fbs">
                                            <div class="card-body">
                                                <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="franchises.php">Cancel</a>
                                            </div>
                                        </div




                                    </div>






                            </div>
                        </div>
                    </div>-->
                    <?php
                                    // }
                                // }
                                    ?>
                                     <!-- </div> -->
            <!-- </div> -->
            <!-- <br><br> -->
<?php
}
?>                               
</form>
</div>
</div>
</div>
</div>
</div>
 
            <?php
      include('footer.php');
      ?>
        </div>
    </main>
    <?php
 include('fexternals.php');
 ?>
<script type="text/javascript">
$(document).ready(function() {
$('[data-toggle="tooltip"]').tooltip();
});
</script>
    
    
    


    <script type="text/javascript">
        function andun() {
                                                                $(".select2-container--open .select2-dropdown--above").hide();
                                                                $(".select2-container--open .select2-dropdown--below").hide();
                                                             }
                                                             function andus() {
                                                                 $(".select2-container--open .select2-dropdown--above").show();
                                                                $(".select2-container--open .select2-dropdown--below").show();
                                                             }
$("#subcategory").on("select2:open", function() { 
    $("#configureunits").attr("data-bs-target","#AddNewSubCategory");
});
$("#subcategory").on("select2:open", function() { 
    document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#category").on("select2:open", function() { 
    $("#configureunits").attr("data-bs-target","#AddNewCategory");
});
$("#category").on("select2:open", function() { 
    document.getElementById("configureunits").innerHTML = "New <?=$access['txtnamecategory']?>";
});
$("#defaultunit").on("select2:open", function() { 
    $("#configureunits").attr("data-bs-target","#AddNewDefaultUnit");
});
$("#defaultunit").on("select2:open", function() { 
    document.getElementById("configureunits").innerHTML = "New Unit";
});
$("#intratax").on("select2:open", function() { 
    document.getElementById("configureunits").innerHTML = "New Intra Tax";
});
$("#intratax").on("select2:open", function() { 
    $("#configureunits").attr("data-bs-target","#NewIntraTax");
});
    function funadddefaultunit() {
        var missingdefaultunit = document.getElementById('missingdefaultunit');
        var uqc = document.getElementById('uqc');
        if (missingdefaultunit.value == ''||uqc.value == '') {
            alert('Please Enter New Default Unit Name And UQC');
            missingdefaultunit.focus();
            return false;
        } else {
            $('#defaultunit').append('<option value="' + missingdefaultunit.value+','+uqc.value + '">' + missingdefaultunit.value + '-' + uqc.value +
                '</option>');

                $('select[name^="defaultunit"] option[value="' + missingdefaultunit.value+','+uqc.value + '"]').attr("selected","selected");
            $('#defaultunit').val(missingdefaultunit.value).change();
            $('#AddNewDefaultUnit').modal('hide');
            return false;
        }
    }

    function funesdefaultunit() {
        $('#defaultunit').val('').change();
        $('#AddNewDefaultUnit').modal('hide');
        return false;
    }
    $("#category").on("change", function() {
        var sOptionVal = $(this).val();
        if (sOptionVal == '#AddNewCategory') {
            $('#AddNewCategory').modal('show');
        }
    });
    $("#subcategory").on("change", function() {
        var sOptionVal = $(this).val();
        if (sOptionVal == '#AddNewSubCategory') {
            $('#AddNewSubCategory').modal('show');
        }
    });
    function funaddcategory() {
        var missingcategory = document.getElementById('missingcategory');
        if (missingcategory.value == '') {
            alert('Please Enter New <?=$access['txtnamecategory']?> Name');
            missingcategory.focus();
            return false;
        } else {
            $('#category').append('<option value="' + missingcategory.value + '">' + missingcategory.value +
                '</option>');
            $('#category').val(missingcategory.value).change();
            $('#AddNewCategory').modal('hide');
            return false;
        }
    }

    function funescategory() {
        $('#category').val('').change();
        $('#AddNewCategory').modal('hide');
        return false;
    }
    function funaddsubcategory() {
        var missingsubcategory = document.getElementById('missingsubcategory');
        if (missingsubcategory.value == '') {
            alert('Please Enter New Sub Category Name');
            missingsubcategory.focus();
            return false;
        } else {
            $('#subcategory').append('<option value="' + missingsubcategory.value + '">' + missingsubcategory.value +
                '</option>');
            $('#subcategory').val(missingsubcategory.value).change();
            $('#AddNewSubCategory').modal('hide');
            return false;
        }
    }

    function funessubcategory() {
        $('#subcategory').val('').change();
        $('#AddNewSubCategory').modal('hide');
        return false;
    }
        function funaddintratax() {
        var missingintra = document.getElementById('missingintratax');
        if (missingintratax.value == '') {
            alert('Please Enter New Intra Tax');
            missingintratax.focus();
            return false;
        } else {
            $('#intratax').append('<option value="' + missingintratax.value + '">' + missingintratax.value +
                '</option>');
            $('#intratax').val(missingintratax.value).change();
            $('#NewIntraTax').modal('hide');
            return false;
        }
    }

        function funesintratax() {
        $('#intratax').val('').change();
        $('#NewIntraTax').modal('hide');
        return false;
    }
    </script>

    <script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
    
    







<!-- Start AddNewintratax modal -->
                    <form method="post" action="">
                    <div class="modal fade" id="NewIntraTax" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Intra Tax</h5>
                                    <span type="button" onclick="funesintratax()" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true" id="closeicon">&times;</span>
                                    </span>
                                </div>
                                <div class="modal-body mbsub" >
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="missingintratax" class="custom-label"><span class="text-danger">
                                                            Name *</span></label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control  form-control-sm"
                                                        id="missingintratax" name="missingintratax"
                                                        placeholder="Name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer mfsub" >
                                <div class="col">
                                                  <button   onclick="funaddintratax()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitintratax" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>
                                                        <button type="button"
                                        class="btn btn-primary btn-sm btn-custom-grey"
                                        onclick="funesintratax()">Cancel</button> </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <!-- End AddNewintratax modal -->





</body>
</html>
<!--<div class="table-responsive">
                                                            <table class="table table-hover  table-bordered"
                                                                id="purchasetable">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"
                                                                            scope="col" class="text-center"></th>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"
                                                                            scope="col" class="text-center">
                                                                        </th>


                                                                        <th colspan="2">PURCHASE PRICE NAME</th>
                                                                        <th><span style="float: right;">MRP </span></th>
                                                                        <th><span style="float: right;">COST PRICE
                                                                            </span></th>
                                                                        <th><span style="float: right;">DISCOUNT </span>
                                                                        </th>
                                                                        <th><span style="float: right;">OFFER PRICE
                                                                            </span></th>
                                                                        <th>UNIT</th>
                                                                        <th>INDIVIDUAL UNIT</th>
                                                                        <th
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="1">
                                                                        <td class="index"
                                                                            style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            1 </td>
                                                                        <td
                                                                            style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            <input type="text" name="abc" id="index"
                                                                                value="1">
                                                                        </td>
                                                                        <td
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;cursor: pointer;">

                                                                            <i style="font-size:16px;color:#8392AB;"
                                                                                class='fas'>&#xf58e;</i>
                                                                        </td>

                                                                        <td style="cursor: none;padding:2px;"
                                                                            data-label="Prduct Name">
                                                                            <input type="text" name="purchasename[]"
                                                                                id="purchasename1"
                                                                                placeholder="Purchase Price Name"
                                                                                class="form-control form-control-sm form-control-bn"
                                                                                style="border: none">
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;"
                                                                            data-label="Mrp">
                                                                            <div class="input-group">

                                                                                <input type="number"
                                                                                    class="form-control form-control-bn"
                                                                                    placeholder="0.00"
                                                                                    name="purchasemrp[]"
                                                                                    id="purchasemrp1"
                                                                                    style="border: none">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="purchasecost[]"
                                                                                    id="purchasecost1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="purchasediscount[]"
                                                                                    id="purchasediscount1"
                                                                                    placeholder="Discount"
                                                                                    class="input-group form-control form-control-sm"
                                                                                    style="border: none">
                                                                                <select
                                                                                    style="background-color: #f5f5f5;border: 3px solid #f5f5f5;">
                                                                                    <option value="1">₹</option>
                                                                                    <option value="2">%</option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">

                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span>
                                                                                </div>

                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="purchaseofferprice[]"
                                                                                    id="purchaseofferprice1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <select
                                                                                class="select2-field form-control  form-control-sm"
                                                                                name="purchaseunit[]" id="purchaseunit"
                                                                                required> -->
                                                                                 <?php
// $sqlis = mysqli_query($con, "select uqc, unitname from pairunits group by uqc order by unitname asc");
// while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                                <!-- <option > -->
                                                                                    <!-- value=" -->
                                                                                    <?php
                                                                                 // $infos['uqc'] ?>

                                                                                 <!-- "> -->
                                                                                    <?php
                                                                            // $infos['unitname'] ?>
                                                                            <!-- - -->
                                                                                    <?php
                                                                                     // $infos['uqc'] ?>
                                                                                <!-- </option> -->
                                                                                <?php
// }
?>

                                                                            <!-- </select> -->
                                                                        <!-- </td> -->
                                                                        <!-- <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group boderline1">
                                                                                <div class="input-group-prepend"> <span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span> </div>
                                                                                <input type="text" min="0"
                                                                                    name="purchaseindunit[]"
                                                                                    id="purchaseindunit1"
                                                                                    style="border: none"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm readonly"
                                                                                    disabled="disabled">
                                                                            </div>
                                                                        </td>
                                                                        <td class="btn-delete"
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;cursor: pointer;">
                                                                            <img src="assets/img/delete-row.png"
                                                                                alt="Girl in a jacket" width="15"
                                                                                height="15"
                                                                                style="border-radius: 10px;">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                        <p align="left" style="margin:0; padding:0"><a
                                                                class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey"
                                                                style="background-color: #e9ecef;">
                                                                <i style="font-size: 14px;color:#0066cc"
                                                                    class="fa fa-plus-circle"></i> Add another line</a>
                                                        <p>
                                                        <div class="container row ">
                                                            <div class="col-md-4"
                                                                style="border-top: 2px solid #e9ecef; border-bottom: 2px solid #e9ecef;">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4"
                                                                        style="margin-top: 15px;margin-bottom: -5px;">
                                                                        <label for="purchaseaccounttype"
                                                                            class="custom-label"><span
                                                                                class="">Account</span></label>
                                                                        <hr class="dash" />
                                                                    </div>
                                                                    <div class="col-sm-8">

                                                                        <select
                                                                            style="margin-top: 14px;padding:0px 10px !important;"
                                                                            id="purchaseaccounttype"
                                                                            name="purchaseaccounttype"
                                                                            class="form-select form-control  form-control-sm"
                                                                            aria-label="Default select example"
                                                                            disabled>
                                                                            <option selected>Cost of Goods Sold</option>
                                                                            <option value="1">One</option>
                                                                            <option value="2">Two</option>
                                                                            <option value="3">Three</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                        <!--<div class="table-responsive">
                                                            <table class="table table-bordered" id="saletable">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid ffffff;"
                                                                            scope="col" class="text-center"></th>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"
                                                                            scope="col" class="text-center ">
                                                                        </th>


                                                                        <th colspan="2"
                                                                            style="border-left:5px solid #ffffff;">
                                                                            SELLING PRICE NAME</th>
                                                                        <th style="width: 110px;"><span
                                                                                style="float: right;">MRP</span></th>
                                                                        <th> <span style="float: right;">SELLING
                                                                                PRICE</span></th>
                                                                        <th> <span style="float: right;">dISCOUNT</span>
                                                                        </th>
                                                                        <th>OFFER pRICE</th>
                                                                        <th style="width: 203px;">OFFER VALIDITY</th>
                                                                        <th>UNIT</th>
                                                                        <th>INDIVIDUAL UNIT</th>
                                                                        <th
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="index"
                                                                            style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            1 </td>
                                                                        <td
                                                                            style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            <input type="text" name="abc" id="index"
                                                                                value="1">
                                                                        </td>
                                                                        <td
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;cursor: pointer;">
                                                                            <i style='font-size:16px;color:#8392AB;'
                                                                                class='fas'>&#xf58e;</i>
                                                                        </td>

                                                                        <td style="cursor: none;padding:2px;"><input
                                                                                type="text" name="salename[]"
                                                                                id="salename1"
                                                                                placeholder="Selling Price"
                                                                                class="form-control form-control-sm"
                                                                                style="border: none">
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="salemrp[]" id="salemrp1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="salecost[]" id="salecost1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">

                                                                            </div>
                                                                        </td>





                                                                        <td style="cursor: none;padding:2px;">


                                                                            <div class="input-group">
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="salediscount[]"
                                                                                    id="salediscount"
                                                                                    placeholder="Discount"
                                                                                    class="input-group form-control form-control-sm"
                                                                                    style="border: none">
                                                                                <select
                                                                                    style="background-color: #f5f5f5;border: 3px solid #f5f5f5;">
                                                                                    <option value="1">₹</option>
                                                                                    <option value="2">%</option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="saleofferprice[]"
                                                                                    id="saleofferprice1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;"> Date
                                                                            Range<input type="text"
                                                                                class="form-control  form-control-sm"
                                                                                name="reportrange[]" id="reportrange1">
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <select
                                                                                class="select2-field form-control  form-control-sm"
                                                                                name="salesunit[]" id="salesunit"
                                                                                required> -->
                                                                                <?php
                                                                                 // $sqlis = mysqli_query($con, "select uqc, unitname from pairunits group by uqc order by unitname asc");
// while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                                <!-- <option > -->
                                                                                <!-- value=" -->
                                                                                <?php
                                                                                // $infos['uqc'] ?>

                                                                                <!-- "> -->
                                                                                    <?php
                                                                        // $infos['unitname'] ?>
                                                                        <!-- - -->
                                                                                    <?php
                                                                                     // $infos['uqc'] ?>
                                                                                <!-- </option> -->
                                                                                <?php
// }
?>

                                                                           <!--  </select>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="saleindunit[]"
                                                                                    id="saleindunit" placeholder="0.00"
                                                                                    class="form-control form-control-smreadonly"
                                                                                    disabled="disabled"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            <a class=" btn-delete "><img
                                                                                    src="assets/img/delete-row.png"
                                                                                    width="15" height="15"
                                                                                    style="border-radius: 10px;"></a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <p align="left" style="margin:0; padding:0"><a
                                                                class="saleadd-row btn btn-primary btn-sm btn-custom-grey"
                                                                style="background-color: #e9ecef;">
                                                                <i style="font-size: 14px;color:#0066cc"
                                                                    class="fa fa-plus-circle"></i> Add another line</a>
                                                        <p>

                                                        <div class="container row">
                                                            <div class="col-md-4"
                                                                style="border-top: 2px solid #e9ecef; border-bottom: 2px solid #e9ecef;">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4"
                                                                        style="margin-top: 15px;margin-bottom: -5px;">
                                                                        <label for="saleaccounttype"
                                                                            class="custom-label"><span
                                                                                class="">Account</span></label>
                                                                        <hr class="dash" />
                                                                    </div>
                                                                    <div class="col-sm-8">

                                                                        <select
                                                                            style="margin-top: 14px;padding:0px 10px !important;"
                                                                            id="saleaccounttype" name="saleaccounttype"
                                                                            class="form-select form-control  form-control-md"
                                                                            aria-label="Default select example"
                                                                            disabled>
                                                                            <option selected>Sales</option>
                                                                            <option value="1">One</option>
                                                                            <option value="2">Two</option>
                                                                            <option value="3">Three</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->