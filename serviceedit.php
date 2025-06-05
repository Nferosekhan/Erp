<?php
include('lcheck.php');
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqli=mysqli_query($con, "select * from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and id='$id' and itemmodule='Services' order by productname asc");
if(mysqli_num_rows($sqli)>0)
{
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Services' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Services' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)||($infomainaccessuser['useraccessedit']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
$sqlget=mysqli_query($con,"select * from paircurrency");
$rows=mysqli_fetch_array($sqlget);
$ans=$rows['currencysymbol'];
$res=explode('-',$ans);
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqlprohis = mysqli_query($con,"select * from pairproducts where id='$id' and itemmodule='Services'");
$sqlanspro = mysqli_fetch_array($sqlprohis);
$oldproname = $sqlanspro['productname'];
$oldcodetags = $sqlanspro['codetags'];
$oldprohsn = $sqlanspro['hsncode'];
$oldprounit = $sqlanspro['defaultunit'];
$oldprocat = $sqlanspro['category'];
$oldprosub = $sqlanspro['subcategory'];
$oldprodel = $sqlanspro['delivery'];
$oldprodes = $sqlanspro['description'];
$oldprovis = $sqlanspro['pvisiblity'];
$oldprotaxprefer = $sqlanspro['taxpref'];
$oldprointrataxs = $sqlanspro['intratax'];
$sqlintrahis=mysqli_query($con, "select * from pairtaxrates where taxgroups!='' and id='$oldprointrataxs' and (createdid='$companymainid' or createdid='0') order by tax asc");
$sqlintrahisfet = mysqli_fetch_array($sqlintrahis);
if (mysqli_num_rows($sqlintrahis)>0) {
$oldprointratax = $sqlintrahisfet['taxname']." - ".$sqlintrahisfet['tax']." %";
}
else{
$oldprointratax = '';
}
$oldprointertaxs = $sqlanspro['intertax'];
$sqlinterhis=mysqli_query($con, "select * from pairtaxrates where id='$oldprointertaxs' and (createdid='$companymainid' or createdid='0') order by tax asc");
$sqlinterhisfet = mysqli_fetch_array($sqlinterhis);
if (mysqli_num_rows($sqlinterhis)>0) {
$oldprointertax = $sqlinterhisfet['taxname']." - ".$sqlinterhisfet['tax']." %";
}
else{
$oldprointertax = '';
}
//saletable
$prosalehis=mysqli_query($con,"select * from pairprosale where productid='$id' and itemmodule='Services'");
$prosalehisans=mysqli_fetch_array($prosalehis);
$oldprosalename = $prosalehisans['salename'];
$oldprosalemrp = $prosalehisans['salemrp'];
$oldprosalecost = $prosalehisans['salecost'];
$oldprosaledes = $prosalehisans['saledescription'];
//purchasetable
$propurhis=mysqli_query($con,"select * from pairpropurchase where productid='$id' and itemmodule='Services'");
$propurhisans=mysqli_fetch_array($propurhis);
$oldpropurname = $propurhisans['purchasename'];
$oldpropurmrp = $propurhisans['purchasemrp'];
$oldpropurcost = $propurhisans['purchasecost'];
$oldpropurdes = $propurhisans['purchasedescription'];
$servhead = $infomainaccessuser['modulename'];
$sqlismainaccesssales=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Sales' order by id  asc");
$infomainaccesssales=mysqli_fetch_array($sqlismainaccesssales);
$salehead = $infomainaccesssales['groupname'];
$sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Purchase' order by id  asc");
$infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
$purhead = $infomainaccesspurchase['groupname'];
}
if(isset($_POST['submit']))
{
// $productcodes=mysqli_real_escape_string($con, $_POST['productcode']);
$productname=mysqli_real_escape_string($con, $_POST['productname']);
$codetags=mysqli_real_escape_string($con, $_POST['codetags']);
$hsncode=mysqli_real_escape_string($con, $_POST['hsncode']);
// $pvisibility=mysqli_real_escape_string($con, $_POST['visibility']);
$delivery=mysqli_real_escape_string($con, $_POST['delivery']);
$sqlcode=mysqli_query($con,"select count(productcode) from pairproducts where createdid='$companymainid' and itemmodule='Services'");
$anscode=mysqli_fetch_array($sqlcode);
// $oldcode=$anscode[0];
// if($oldcode!=$productcodes)
// {
    // $productcode=mysqli_real_escape_string($con, $_POST['productcode']);
// }
// else{
    // $productcode=$oldcode+1;
// }
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
    $descriptionsinfo=mysqli_real_escape_string($con, $_POST['description']);
}
else{
    $descriptionsinfo=" ";
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
if(isset($_POST['taxpref']))
{
    $taxpref=mysqli_real_escape_string($con, $_POST['taxpref']);
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
$sqlup = "update pairproducts set createdon='$times',productname='$productname',createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', codetags='$codetags',itemmodule='Services',franchisesession='".$_SESSION["franchisesession"]."',  description='$descriptionsinfo',defaultunit='$forpro',category='$category', subcategory='$subcategory',pvisiblity='$pvisibility',delivery='$delivery',taxpref='$taxpref',intratax='$intratax',intertax='$intertax',hsncode='$hsncode' where id='$id' and itemmodule='Services'";
            $queryup = mysqli_query($con, $sqlup);
$sqlpricenamequerydel = mysqli_query($con,"delete from pairprosale where productid='$id' and itemmodule='Services'");
$anspricenames="";
$sqlpricenamequery=mysqli_query($con,"select count(salename) from pairprosale where productid='$id' and itemmodule='Services'");
$anspricenamequery=mysqli_fetch_array($sqlpricenamequery);
if (mysqli_num_rows($sqlpricenamequery)==0) {
$oldpricenamequery=0;
}
else{
$oldpricenamequery=$anspricenamequery[0];
}
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
if ($anspricenames!=''||$ansmrps!=''||$anssellprices!=''||$ansdescriptions!='') {
$sqlupn = "insert into pairprosale set productid='$id',salename='$pricename',salemrp='$ansmrps',salecost='$anssellprices',saledescription='$ansdescriptions',itemmodule='Services',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            $sqlupnpro = mysqli_query($con,"update pairproducts set salescost='$anssellprices' where id='$id'");
            if(!$queryupn){
               header('Location:serviceedit.php?error=Pricename Updated Unsuccessfully');
            }
}
else{
    $sqlupn = "insert into pairprosale set productid='$id',itemmodule='Services',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            if(!$queryupn){
               header('Location:serviceedit.php?error=Pricename Added Unsuccessfully');
            }
}           

$sqlpricenamepurquerydel = mysqli_query($con,"delete from pairpropurchase where productid='$id' and itemmodule='Services'");
$anspricenamespur="";
$sqlpricenamepurquery=mysqli_query($con,"select count(purchasename) from pairpropurchase where productid='$id' and itemmodule='Services'");
$anspurpricenamequery=mysqli_fetch_array($sqlpricenamepurquery);
if (mysqli_num_rows($sqlpricenamepurquery)==0) {
$oldpurpricenamequery=0;
}
else{
$oldpurpricenamequery=$anspurpricenamequery[0];
}
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
$sqlupnpur = "insert into pairpropurchase set productid='$id',purchasename='$pricenamepur',purchasemrp='$ansmrpspur',purchasecost='$anssellpricespur',purchasedescription='$ansdescriptionspur',itemmodule='Services',createdid='$companymainid'";
            $queryupnpur = mysqli_query($con, $sqlupnpur);
            if(!$queryupnpur){
               header('Location:serviceedit.php?error=Pricename Added Unsuccessfully');
            }
}
else{
    $sqlupn = "insert into pairpropurchase set productid='$id',itemmodule='Services',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            if(!$queryupn){
               header('Location:serviceedit.php?error=Pricename Added Unsuccessfully');
            }
}
            if(!$queryup){
               die("SQL query failed: " . mysqli_error($con));
            }
            else
            {
                $ch='';
                if($productname!=$oldproname)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$servhead.' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldproname.' To '.$productname.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$servhead.' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldproname.' To '.$productname.' ) </span>';
                    }                   
                }
                if($codetags!=$oldcodetags)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Code / Tags <span style="color:green;" id="prohisfromtospan">( From '.$oldcodetags.' To '.$codetags.' ) </span>';
                    }
                    else
                    {
                        $ch.='Code / Tags <span style="color:green;" id="prohisfromtospan">( From '.$oldcodetags.' To '.$codetags.' ) </span>';
                    }                   
                }
                if($forpro!=$oldprounit)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Unit <span style="color:green;" id="prohisfromtospan">( From '.$oldprounit.' To '.$forpro.' ) </span>';
                    }
                    else
                    {
                        $ch.='Unit <span style="color:green;" id="prohisfromtospan">( From '.$oldprounit.' To '.$forpro.' ) </span>';
                    }                   
                }
                if($hsncode!=$oldprohsn)
                {
                    if($ch!='')
                    {
                        $ch.='<br> SAC Code <span style="color:green;" id="prohisfromtospan">( From '.$oldprohsn.' To '.$hsncode.' ) </span>';
                    }
                    else
                    {
                        $ch.='SAC Code <span style="color:green;" id="prohisfromtospan">( From '.$oldprohsn.' To '.$hsncode.' ) </span>';
                    }                   
                }
                if($category!=$oldprocat)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Category <span style="color:green;" id="prohisfromtospan">( From '.$oldprocat.' To '.$category.' ) </span>';
                    }
                    else
                    {
                        $ch.='Category <span style="color:green;" id="prohisfromtospan">( From '.$oldprocat.' To '.$category.' ) </span>';
                    }                   
                }
                if($subcategory!=$oldprosub)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Subcategory <span style="color:green;" id="prohisfromtospan">( From '.$oldprosub.' To '.$subcategory.' ) </span>';
                    }
                    else
                    {
                        $ch.='Subcategory <span style="color:green;" id="prohisfromtospan">( From '.$oldprosub.' To '.$subcategory.' ) </span>';
                    }                   
                }
                if($delivery!=$oldprodel)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Delivery <span style="color:green;" id="prohisfromtospan">( From '.$oldprodel.' To '.$delivery.' ) </span>';
                    }
                    else
                    {
                        $ch.='Delivery <span style="color:green;" id="prohisfromtospan">( From '.$oldprodel.' To '.$delivery.' ) </span>';
                    }                   
                }
                if($descriptionsinfo!=$oldprodes)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Description <span style="color:green;" id="prohisfromtospan">( From '.$oldprodes.' To '.$descriptionsinfo.' ) </span>';
                    }
                    else
                    {
                        $ch.='Description <span style="color:green;" id="prohisfromtospan">( From '.$oldprodes.' To '.$descriptionsinfo.' ) </span>';
                    }    
                }
                if($pvisibility!=$oldprovis)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Visibility <span style="color:green;" id="prohisfromtospan">( From '.$oldprovis.' To '.$pvisibility.' ) </span>';
                    }
                    else
                    {
                        $ch.='Visibility <span style="color:green;" id="prohisfromtospan">( From '.$oldprovis.' To '.$pvisibility.' ) </span>';
                    }                   
                }
                if($anspricenames!=$oldprosalename)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$salehead.' Price Name <span style="color:green;" id="prohisfromtospan">( From '.$oldprosalename.' To '.$anspricenames.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$salehead.' Price Name <span style="color:green;" id="prohisfromtospan">( From '.$oldprosalename.' To '.$anspricenames.' ) </span>';
                    }                   
                }
                if($ansmrps!=$oldprosalemrp)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$salehead.' Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldprosalemrp.' To '.$ansmrps.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$salehead.' Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldprosalemrp.' To '.$ansmrps.' ) </span>';
                    }                   
                }
                if($anssellprices!=$oldprosalecost)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$salehead.' Price / Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldprosalecost.' To '.$anssellprices.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$salehead.' Price / Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldprosalecost.' To '.$anssellprices.' ) </span>';
                    }                   
                }
                if($ansdescriptions!=$oldprosaledes)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$salehead.' Description <span style="color:green;" id="prohisfromtospan">( From '.$oldprosaledes.' To '.$ansdescriptions.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$salehead.' Description <span style="color:green;" id="prohisfromtospan">( From '.$oldprosaledes.' To '.$ansdescriptions.' ) </span>';
                    }                   
                }
                if($anspricenamespur!=$oldpropurname)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$purhead.' Price Name <span style="color:green;" id="prohisfromtospan">( From '.$oldpropurname.' To '.$anspricenamespur.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$purhead.' Price Name <span style="color:green;" id="prohisfromtospan">( From '.$oldpropurname.' To '.$anspricenamespur.' ) </span>';
                    }                   
                }
                if($ansmrpspur!=$oldpropurmrp)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$purhead.' Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldpropurmrp.' To '.$ansmrpspur.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$purhead.' Mrp <span style="color:green;" id="prohisfromtospan">( From '.$oldpropurmrp.' To '.$ansmrpspur.' ) </span>';
                    }                   
                }
                if($anssellpricespur!=$oldpropurcost)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$purhead.' Price / Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldpropurcost.' To '.$anssellpricespur.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$purhead.' Price / Rate <span style="color:green;" id="prohisfromtospan">( From '.$oldpropurcost.' To '.$anssellpricespur.' ) </span>';
                    }                   
                }
                if($ansdescriptionspur!=$oldpropurdes)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$purhead.' Description <span style="color:green;" id="prohisfromtospan">( From '.$oldpropurdes.' To '.$ansdescriptionspur.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$purhead.' Description <span style="color:green;" id="prohisfromtospan">( From '.$oldpropurdes.' To '.$ansdescriptionspur.' ) </span>';
                    }                   
                }
                if($taxpref!=$oldprotaxprefer)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Tax Preference <span style="color:green;" id="prohisfromtospan">( From '.$oldprotaxprefer.' To '.$taxpref.' ) </span>';
                    }
                    else
                    {
                        $ch.='Tax Preference <span style="color:green;" id="prohisfromtospan">( From '.$oldprotaxprefer.' To '.$taxpref.' ) </span>';
                    }                   
                }
                if($intratax!=$oldprointrataxs)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Intra Tax <span style="color:green;" id="prohisfromtospan">( From '.$oldprointratax.' To '.$intrataxs.' ) </span>';
                    }
                    else
                    {
                        $ch.='Intra Tax <span style="color:green;" id="prohisfromtospan">( From '.$oldprointratax.' To '.$intrataxs.' ) </span>';
                    }                   
                }
                if($intertax!=$oldprointertaxs)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Inter Tax <span style="color:green;" id="prohisfromtospan">( From '.$oldprointertax.' To '.$intertaxs.' ) </span>';
                    }
                    else
                    {
                        $ch.='Inter Tax <span style="color:green;" id="prohisfromtospan">( From '.$oldprointertax.' To '.$intertaxs.' ) </span>';
                    }                   
                }
                if($ch!='')
                {
                $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='SERVICES', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='".$ch."' ");
                }
            }
            header('Location:serviceview.php?id='.$id.'&remarks=Updated Successfully');
$sqlunit=mysqli_query($con,"select * from pairunits where (createdid='$companymainid' or createdid='0') and (franchisesession='".$_SESSION["franchisesession"]."' or franchisesession='0') and (itemmodule='Services' or itemmodule='0')");
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
    $sqlup = "insert into pairunits set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."',itemmodule='Services', unitname='$forunitname', uqc='$foruqc',franchisesession='".$_SESSION["franchisesession"]."'";
            $queryup = mysqli_query($con, $sqlup);
    }
}

$sqlsubcat="select subcategory from pairsubcategory where subcategory='$subcategory' and itemmodule='Services' and createdid='$companymainid'";
$resultsubcat = mysqli_query($con,$sqlsubcat);
if (mysqli_num_rows($resultsubcat)>0) {
}
else{
    if(isset($_POST['subcategory']))
{
    $sqlupsub = "insert into pairsubcategory set createdon='$times', createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',itemmodule='Services', subcategory='$subcategory'";
                            $queryupsub = mysqli_query($con, $sqlupsub);
}
}

$sqlcat="select category from paircategory where category='$category' and itemmodule='Services' and createdid='$companymainid'";
$resultcat = mysqli_query($con,$sqlcat);
if (mysqli_num_rows($resultcat)>0) {
}
else{
    if(isset($_POST['category']))
{
    $sqlupcat = "insert into paircategory set createdon='$times', createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',itemmodule='Services', category='$category'";
                            $queryupcat = mysqli_query($con, $sqlupcat);
}
}

// $tid=mysqli_insert_id($con);
// $productid=$tid;
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

//                 $sqlias=mysqli_query($con, "delete from pairprosale where productid='$productid'");
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
//                         $sqlias=mysqli_query($con, "select salename from pairprosale where productid='$productid' and salename='$salename'");
//                         if(mysqli_num_rows($sqlias)==0)
//                         {
//                             $sqliasa=mysqli_query($con, "insert into pairprosale set productid='$productid', salename='$salename', salemrp='$salemrp', salecost='$salecost', salediscount='$salediscount', saleofferprice='$saleofferprice', saleunit='$saleunit', saleindunit='$saleindunit'");
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
//                header('Location:productedit.php?id='.$id.'&remarks=Unit Added Successfully');
//             }
//             if (!$queryup) {
//             header('Location:productedit.php?id='.$id.'&error=This is Already Exists Unit');
//         }
//         }
//         else{
//             header('Location:productedit.php?id='.$id.'&error=This is Already Exists Unit');
//         }
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
//                header('Location:productedit.php?id='.$id.'&remarks=Category Added Successfully');
//             }
//             if (!$queryup) {
//             header('Location:productedit.php?id='.$id.'&error=This is Already Exists Category');
//         }
//         }
//         else{
//             header('Location:productedit.php?id='.$id.'&error=This is Already Exists Category');
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
//                header('Location:productedit.php?id='.$id.'&remarks=Subcategory Added Successfully');
//             }
//             if (!$queryup) {
//             header('Location:productedit.php?id='.$id.'&error=This is Already Exists SubCategory');
//         }
//         }
//         else{
//             header('Location:productedit.php?id='.$id.'&error=This is Already Exists SubCategory');
//         }

     // $subcategory=mysqli_real_escape_string($con, $_POST['missingsubcategory']);


            // $sqlup = "insert into pairsubcategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', subcategory='$subcategory'";
            // $queryup = mysqli_query($con, $sqlup);

            // if(!$queryup){
            //    die("SQL query failed: " . mysqli_error($con));
            // }


// }
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
        Edit Service - Dmedia
    </title>
    

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- productedit.css -->
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
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Services' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
                                ?>
     
            
                                
            <div id="fullcontainerwidth">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
                                <!-- <div class="sticky">
                                    <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 30px !important;margin-top: 9px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="franchises.php" style="margin-top:9px !important;">Cancel</a>
                                </div> -->
                                <p class="mb-3" id="neweditpro"><i class="fa fa-pencil-square-o"></i> Edit
                                    <?= $infomainaccessuser['modulename'] ?></p>
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
                                    <h5 class="modal-title">New Category</h5>
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
                                    <?php

if(isset($_GET['id']))
{
$count=1;
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqli=mysqli_query($con, "select * from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and id='$id' and itemmodule='Services' order by productname asc");
if(mysqli_num_rows($sqli)>0)
{
$info=mysqli_fetch_array($sqli);

$unitdata = $info['defaultunit'];
$categorydata = $info['category'];
$subcategorydata = $info['subcategory'];

$Descriptioninfo = $info['description'];







// echo "Descriptioninfo";
// echo $Descriptioninfo;


// echo json_encode($info);
?>
                                <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Services' order by id  asc");
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
      <form action="" method="post">
      <?php 
                                    include('navbottom.php');
                                    ?>
                                <form action="" onsubmit="return checkvalidate()" method="post"
                                    enctype="multipart/form-data" class="form-horizontal" role="form">
                                    <input type="hidden" name="id" id="id" value="<?=$info['id']?>">
                                    <?php
     // if ((in_array('Service Information', $fieldedit))) {
        ?>
                                    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingOne">
                                                <button class="accordion-button font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading"><?= $infomainaccessuser['modulename'] ?> Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne">
                                                <div class="accordion-body text-sm">
                                                    <div class="row justify-content-center" <?=((in_array('Service Code', $fieldedit))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="productcode" class="custom-label"><span
                                                                            class=""><?= $infomainaccessuser['modulename'] ?> Code</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="productcode" name="productcode"
                                                                        placeholder="Service Code"  disabled value="<?=$info['productcode']?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Service Public Code', $fieldedit))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="publiccode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Code Public</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="publiccode" name="publiccode" readonly value="<?= $info['publicid'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="row justify-content-center" <?=((in_array('Service Private Code', $fieldedit))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="privatecode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Code Private</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="privatecode" name="privatecode" readonly value="<?= $info['privateid'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
     // if ((in_array('Name', $fieldedit))) {
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
                                                                        placeholder="Service Name"  required value="<?=$info['productname']?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <?php
          // }
          ?>
                                                    <div class="row justify-content-center" <?=((in_array('Code or Tags', $fieldedit))?'':'style="display:none;"')?>>
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
                                                                        placeholder="Code / Tags" value="<?=$info['codetags']?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Unit', $fieldedit))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="Unit" class="custom-label"><span
                                                                            class="text-danger">Unit * <svg data-toggle="tooltip" title="The service will be measured in terms of this unit (e.g.: kg, dozen)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
                                                                </div>
                                                               <div class="col-sm-8" id="uck" onclick="andus()"><select class="form-control  form-control-sm" name="defaultunit" id="defaultunit" <?=((in_array('Unit', $fieldedit))?'required':'')?>>
                                                                        <option selected disabled value="">Unit</option>
                                                                        <?php
                                                                        $sqliss = mysqli_query($con, "select * from pairproducts where id='".$id."' and itemmodule='Services'");
                                                                        $infoss=mysqli_fetch_array($sqliss);
$sqlis = mysqli_query($con, "select uqc, unitname from pairunits where (createdid='$companymainid' or createdid='0') and (franchisesession='".$_SESSION["franchisesession"]."' or franchisesession='0') and (itemmodule='Services' or itemmodule='0') group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
<option <?=($infos['uqc']==$infoss['defaultunit'])?'selected':'';?> value="<?= $infos['unitname']?>,<?=$infos['uqc'] ?>">
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
                                                    <div class="row justify-content-center" <?=((in_array('SAC Code', $fieldedit))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="hsncode" class="custom-label"><span
                                                                            class="">SAC Code</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="hsncode" name="hsncode"
                                                                        placeholder="SAC Code" value="<?=$info['hsncode']?>" maxlength="100">
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
                                                                        placeholder="SKU" required>
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
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="ean" class="custom-label"><span>EAN <svg data-toggle="tooltip" title="Thirteen digit unique number (International Artical Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
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
                                                    <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="mpn" class="custom-label"><span>MPN <svg data-toggle="tooltip" title="Manufacturing Part Number unambiguously identifies a part design" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
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
                                                    <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="isbn" class="custom-label"><span>ISBN <svg data-toggle="tooltip" title="Thirteen digit unique commercial book identifier (International Standard Book Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
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
                                                     <div class="row justify-content-center">
                                                         <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="brand" class="custom-label"><span
                                                                            class="">Brand</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="brand" id="brand" required>
                                                                        <option value="brand">Select or Add Brand
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                         <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="manufacturer" class="custom-label"><span
                                                                            class="">Manufacturer</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="manufacturer" id="manufacturer" required>
                                                                        <option value="manufacturer">Select or Add Manufacturer
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label">Molicular Name</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="mname" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Molicular Name"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label">Generic Name</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="mname" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Generic Name"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label">Salt Composition</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="mname" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Salt Name"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label">Consume Time</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="mname" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Consume Name"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                    <div class="row justify-content-center" <?=((in_array('Category', $fieldedit))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="Category" class="custom-label"><span
                                                                            class="">Category</span></label>
                                                                </div>
                                                                <div class="col-sm-8" onclick="andus()">
                                                                    
                                                                    <select
                                                                        class="form-control  form-control-sm"
                                                                        name="category" id="category">
                                                        

                                                                    <option selected disabled>Category</option>
                                                                        <?php
                                                                        $sqliss = mysqli_query($con, "select * from pairproducts where id='".$id."' and itemmodule='Services'");
                                                                        $infoss=mysqli_fetch_array($sqliss);
                                                                    $sqlic = mysqli_query($con, "select * from paircategory where (createdid='$companymainid' or createdid='0') and itemmodule='Services' and category!='' order by category asc");
                                                                    while ($infoc = mysqli_fetch_array($sqlic)) {
                                                                    ?>
                                                                        <option <?=($infoc['category']==$infoss['category'])?'selected':'';?> value="<?= $infoc['category'] ?>">
                                                                            <?= $infoc['category'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                     <div class="row justify-content-center" <?=((in_array('Sub Category', $fieldedit))?'':'style="display:none;"')?>>
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
                                                        
                                                                        <option selected disabled>Sub Category</option>
                                                                        <?php
                                                                        $sqliss = mysqli_query($con, "select * from pairproducts where id='".$id."' and itemmodule='Services'");
                                                                        $infoss=mysqli_fetch_array($sqliss);
                                                                    $sqli = mysqli_query($con, "select * from pairsubcategory where (createdid='$companymainid' or createdid='0') and itemmodule='Services' and subcategory!='' order by subcategory asc");
                                                                    while ($infosub = mysqli_fetch_array($sqli)) {
                                                                    ?>
                                                                        <option <?=($infosub['subcategory']==$infoss['subcategory'])?'selected':'';?> value="<?= $infosub['subcategory'] ?>">
                                                                            <?= $infosub['subcategory'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <!------
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
                                                                        name="weigh" id="weigh"   style="color: #495057;padding: 4px 9.75px;background-color:#EEEEEE;border: 1px solid lightgrey;" required>
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
                                                    </div>
                                                    <div class="row justify-content-center" style="margin-top:-15px;">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label class="custom-label">Rack</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="rack" class="form-control  form-control-sm" style="border:1px solid lightgrey;" placeholder="Rack"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                    <div class="row justify-content-center" <?=((in_array('Delivery', $fieldedit))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="delivery" class="custom-label"><span
                                                                            class="">Delivery</span></label>
                                                                </div>
                                                                <?php
                                                                    $sqli = mysqli_query($con, "select delivery from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and id='".$id."' and itemmodule='Services' order by delivery asc");
                                                                    $infod = mysqli_fetch_array($sqli);
                                                                    ?>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="delivery" name="delivery" class="form-control  form-control-sm" id="delinpbrd" placeholder="Delivery" value="<?= $infod['delivery'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Description', $fieldedit))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="description" class="custom-label"><span
                                                                            class="">Description</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <textarea
                                                                        class="form-control" id="description"
                                                                        name="description"><?= $info['description'] ?></textarea>
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
                                                      <?php
                                                        $sqlvis=mysqli_query($con,"select * from pairproducts where id='$id' and itemmodule='Services'");
                                                        $ansvis=mysqli_fetch_array($sqlvis);
                                                    ?>
                                                    <div class="accordion-item mb-1" <?=((in_array('Service Visibility', $fieldedit))?'':'style="display:none;"')?>>
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
                        <input type="radio" class="custom-control-input" name="visibility" id="visibility" value="PUBLIC" <?= $ansvis['pvisiblity']=='PUBLIC'?'checked':'' ?> >
                        <label class="custom-control-label custom-label" for="visibility">Public</label>
                      </div>
                      
                      </div>
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibility" id="novisibility" value="PRIVATE" <?= $ansvis['pvisiblity']=='PRIVATE'?'checked':'' ?> >
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
                                    <!--
                                    <?php
                                                     if($permissionproimage!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionproimgedit!='0'){
                                                    ?>
                                      <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button font-weight-bold" type="button"
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
                                                    <div class="row text-sm">
                                                        <div class="col-sm-2">
                                                            <div class="row imagePreview">
                                                                <img src="assets/img/productimage.png" id="ImgPreview"
                                                                    class=" preview1navbar-brand-img" alt="Pencil_logo"
                                                                    style="height:100px;padding-top: 12px;">
                                                            </div>
                                                            <div class="row" style="padding-top: 10px;">

                                                                <div class="col-sm-2">
                                                                    <span class="btn_upload">
                                                                        <input type="file" id="imag" title=""
                                                                            class="input-img" />
                                                                        <img src="assets/img/Pencil-Icons.png"
                                                                            id="Pencil_logo" class="navbar-brand-img"
                                                                            alt="Pencil_logo" style="height:20px;">
                                                                    </span>

                                                                </div>
                                                                <div class="col-sm-1">| </div>
                                                                <div class="col-sm-2">
                                                                    <i id="removeImage1" class="fa fa-trash"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-sm-7"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="row imagePreview">
                                                                <img src="assets/img/productimage.png" id="ImgPreview2"
                                                                    class=" preview2 navbar-brand-img" alt="Pencil_logo"
                                                                    style="height:100px;padding-top: 12px;">
                                                            </div>
                                                            <div class="row" style="padding-top: 10px;">

                                                                <div class="col-sm-2">
                                                                    <span class="btn_upload">
                                                                        <input type="file" id="imag2" title=""
                                                                            class="input-img" />
                                                                        <img src="assets/img/Pencil-Icons.png"
                                                                            id="Pencil_logo" class="navbar-brand-img"
                                                                            alt="Pencil_logo" style="height:20px;">
                                                                    </span>
                                                                </div>
                                                                <div class="col-sm-1">| </div>
                                                                <div class="col-sm-2">
                                                                    <i id="removeImage2" class="fa fa-trash"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-sm-7"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="row imagePreview">
                                                                <img src="assets/img/productimage.png" id="ImgPreview3"
                                                                    class=" preview3 navbar-brand-img" alt="Pencil_logo"
                                                                    style="height:100px;padding-top: 12px;">
                                                            </div>
                                                            <div class="row" style="padding-top: 10px;">
                                                                <div class="col-sm-2">
                                                                    <span class="btn_upload">
                                                                        <input type="file" id="imag3" title=""
                                                                            class="input-img" />
                                                                        <img src="assets/img/Pencil-Icons.png"
                                                                            id="Pencil_logo" class="navbar-brand-img"
                                                                            alt="Pencil_logo" style="height:20px;">
                                                                    </span>
                                                                </div>
                                                                <div class="col-sm-1">| </div>
                                                                <div class="col-sm-2">
                                                                    <i id="removeImage3" class="fa fa-trash"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-sm-7"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="row imagePreview">
                                                                <img src="assets/img/productimage.png" id="ImgPreview4"
                                                                    class=" preview4 navbar-brand-img" alt="Pencil_logo"
                                                                    style="height:100px;padding-top: 12px;">
                                                            </div>
                                                            <div class="row" style="padding-top: 10px;">
                                                                <div class="col-sm-2">
                                                                    <span class="btn_upload">
                                                                        <input type="file" id="imag4" title=""
                                                                            class="input-img" />
                                                                        <img src="assets/img/Pencil-Icons.png"
                                                                            id="Pencil_logo" class="navbar-brand-img"
                                                                            alt="Pencil_logo" style="height:20px;">
                                                                    </span>
                                                                </div>
                                                                <div class="col-sm-1">| </div>
                                                                <div class="col-sm-2">
                                                                    <i id="removeImage4" class="fa fa-trash"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-sm-7"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="row imagePreview">
                                                                <img src="assets/img/productimage.png" id="ImgPreview5"
                                                                    class=" preview5 navbar-brand-img" alt="Pencil_logo"
                                                                    style="height:100px;padding-top: 12px;">
                                                            </div>
                                                            <div class="row" style="padding-top: 10px;">
                                                                <div class="col-sm-2">
                                                                    <span class="btn_upload">
                                                                        <input type="file" id="imag5" title=""
                                                                            class="input-img" />
                                                                        <img src="assets/img/Pencil-Icons.png"
                                                                            id="Pencil_logo" class="navbar-brand-img"
                                                                            alt="Pencil_logo" style="height:20px;">
                                                                    </span>
                                                                </div>
                                                                <div class="col-sm-1">| </div>
                                                                <div class="col-sm-2">
                                                                    <i id="removeImage5" class="fa fa-trash"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-sm-7"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                    ?>
                                    <?php
                                                     if($permissionpropurchase!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionpropuredit!='0'){
                                                    ?>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingThree">
                                                <button class="accordion-button font-weight-bold" type="button"
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
<td style="width:11%;"><!-- <input type="number" min="0" step="0.01" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;" onChange="productcalc(1)"> 
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
                                        </div>
                                            </div>
                                          <?php
                                    }
                                }
                                    ?>-->
                                                    <div class="accordion" id="accordionRental" <?=((in_array('Sales Information', $fieldedit))?'':'style="display:none;"')?>>
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
                                            <?php
$sqlisale=mysqli_query($con, "select * from pairprosale where productid='".$id."' and itemmodule='Services'");
$sale=mysqli_fetch_array($sqlisale);
?>   
                                             <div id="collapsesale" class="accordion-collapse collapse show"
                                                aria-labelledby="headingsale">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="table-responsive" <?=(((in_array('Sale Price Name', $fieldedit))||(in_array('Sale MRP', $fieldedit))||(in_array('Sale Price Rate', $fieldedit))||(in_array('Sale Description', $fieldedit)))?'':'style="display:none;"')?>>
  <table class="table table-bordered" id="saletable">
<thead>
<tr><td class="text-uppercase" id="firstclsale"><span id="tdfsize"></span></td>
    <td class="text-uppercase" id="secondclsale" <?=((in_array('Sale Price Name', $fieldedit))?'':'style="display:none;"')?>><span id="tdfsize">PRICE NAME</span></td>
    <td class="text-uppercase" id="thirdclsale" <?=((in_array('Sale MRP', $fieldedit))?'':'style="display:none;"')?>><span id="tdfsize">MRP</span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <td class="text-uppercase" id="fourthclsale" <?=((in_array('Sale Price Rate', $fieldedit))?'':'style="display:none;"')?>><span id="tdfsize">PRICE/RATE</span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <td class="text-uppercase" id="fifthclsale" <?=((in_array('Sale Description', $fieldedit))?'':'style="display:none;"')?>><span id="tdfsize">DESCRIPTION</span></td>
                                    <td class="text-uppercase" id="sixthclsale"><span id="tdfsize"></span></td></tr>
</thead>
<tbody>
<tr>
<td data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="PRICE NAME" <?=((in_array('Sale Price Name', $fieldedit))?'':'style="display:none;"')?>><input type="hidden" name="productid[]" id="productid1"><input type="text" name="pricename[]" id="productname1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidthnamdes" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Sale Price or Trade Price or Wholesale Price" value="<?=$sale['salename']?>"></td>
<td data-label="MRP" <?=((in_array('Sale MRP', $fieldedit))?'':'style="display:none;"')?>>
    <div>
       <span><?php echo $res[0]; ?></span>
    <input type="age" min="0" name="mrp[]" id="quantity1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidth" onChange="productcalc(1)" placeholder="0.00" value="<?=$sale['salemrp']?>">
  </div>
</td>
<td data-label="SELLING PRICE" <?=((in_array('Sale Price Rate', $fieldedit))?'':'style="display:none;"')?>><div><span><?php echo $res[0]; ?></span><input placeholder="0.00" type="age" min="0" name="sellingprice[]"  id="productrate1" class="form-control form-control-sm bordernoneinput rup bor totaldesign productselectwidth" onChange="productcalc(1)" value="<?=$sale['salecost']?>"></div></td>
<td data-label="DESCRIPTION" <?=((in_array('Sale Description', $fieldedit))?'':'style="display:none;"')?>><input type="text" min="0" name="descriptions[]" id="vat1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidthnamdes" value="<?=$sale['saledescription']?>"></td>
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
                                                    <div class="accordion" id="accordionRental" <?=((in_array('Purchase Information', $fieldedit))?'':'style="display:none;"')?>>
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
                                            <?php
$sqlipur=mysqli_query($con, "select * from pairpropurchase where productid='".$id."' and itemmodule='Services'");
$pur=mysqli_fetch_array($sqlipur);
?>   
                                             <div id="collapsepurchase" class="accordion-collapse collapse show"
                                                aria-labelledby="headingpurchase">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="table-responsive" <?=(((in_array('Purchase Price Name', $fieldedit))||(in_array('Purchase MRP', $fieldedit))||(in_array('Purchase Price Rate', $fieldedit))||(in_array('Purchase Description', $fieldedit)))?'':'style="display:none;"')?>>
  <table class="table table-bordered" id="purchasetable">
<thead>
<tr><td class="text-uppercase" id="firstclsale"><span id="tdfsize"></span></td>
    <td class="text-uppercase" id="secondclsale" <?=((in_array('Purchase Price Name', $fieldedit))?'':'style="display:none;"')?>><span id="tdfsize">PRICE NAME</span></td>
    <td class="text-uppercase" id="thirdclsale" <?=((in_array('Purchase MRP', $fieldedit))?'':'style="display:none;"')?>><span id="tdfsize">MRP</span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <td class="text-uppercase" id="fourthclsale" <?=((in_array('Purchase Price Rate', $fieldedit))?'':'style="display:none;"')?>><span id="tdfsize">PRICE/RATE</span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <td class="text-uppercase" id="fifthclsale" <?=((in_array('Purchase Description', $fieldedit))?'':'style="display:none;"')?>><span id="tdfsize">DESCRIPTION</span></td>
                                    <td class="text-uppercase" id="sixthclsale"><span id="tdfsize"></span></td></tr>
</thead>
<tbody>
<tr>
<td data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="PRICE NAME" <?=((in_array('Purchase Price Name', $fieldedit))?'':'style="display:none;"')?>><input type="hidden" name="productid[]" id="productid1"><input type="text" name="pricenamepur[]" id="productname1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidthnamdes" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Purchase Price or Trade Price or Wholesale Price" value="<?=$pur['purchasename']?>"></td>
<td data-label="MRP" <?=((in_array('Purchase MRP', $fieldedit))?'':'style="display:none;"')?>>
    <div>
       <span><?php echo $res[0]; ?></span>
    <input type="age" min="0" name="mrppur[]" id="quantity1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidth" onChange="productcalc(1)" placeholder="0.00" value="<?=$pur['purchasemrp']?>">
  </div>
</td>
<td data-label="SELLING PRICE" <?=((in_array('Purchase Price Rate', $fieldedit))?'':'style="display:none;"')?>><div><span><?php echo $res[0]; ?></span><input placeholder="0.00" type="age" min="0" name="sellingpricepur[]"  id="productrate1" class="form-control form-control-sm bordernoneinput rup bor totaldesign productselectwidth" onChange="productcalc(1)" value="<?=$pur['purchasecost']?>"></div></td>
<td data-label="DESCRIPTION" <?=((in_array('Purchase Description', $fieldedit))?'':'style="display:none;"')?>><input type="text" min="0" name="descriptionspur[]" id="vat1" class="form-control form-control-sm bordernoneinput bor totaldesign productselectwidthnamdes" value="<?=$pur['purchasedescription']?>"></td>
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
                                        <div class="accordion-item mb-1" <?=((in_array('Tax Information', $fieldedit))?'':'style="display:none;"')?>>
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
                                            <?php
                                            $sqlitax=mysqli_query($con, "select * from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and id='".$id."' and itemmodule='Services' order by productname asc");
                                            $anstax=mysqli_fetch_array($sqlitax);
                                            ?>
                                            <div id="collapseFive" class="accordion-collapse collapse show"
                                                aria-labelledby="headingFive">
                                                <div class="accordion-body text-sm">
                                                    <div class="row justify-content-center" <?=((in_array('Tax Preference', $fieldedit))?'':'style="display:none;"')?>>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                    <label class="custom-label mt-2 text-danger">Tax Preference *</label>
                                                                </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="row">
                                                                                <div class="col-lg-5 my-1" style="z-index: 0;">
                      <div class="custom-control custom-radio mr-sm-2" onclick="taxable()">
                        <input type="radio" class="custom-control-input" name="taxpref" id="taxpreftaxable" value="1" <?=($anstax['taxpref']==1)?'checked':'';?>>
                        <label class="custom-control-label custom-label" for="taxpreftaxable">Taxable</label>
                      </div>

                      </div>
                      <!-- <div class="col-lg-5 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2" onclick="nontaxable()">
                        <input type="radio" class="custom-control-input" name="taxpref" id="taxprefnontaxable" value="0" <?=($anstax['taxpref']==0)?'checked':'';?>>
                        <label class="custom-control-label custom-label" for="taxprefnontaxable">Non Taxable</label>
                      </div>

                      </div> -->
                  </div>
                  
                                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <div id="taxablediv">
                                                                <div class="row justify-content-center" id="taxprefer" <?=((in_array('Tax Rate', $fieldedit))?'':'style="display:none;"')?>>
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
                                                                                        class="country"
                                                                                        id="taxratecountry"
                                                                                        name="taxratecountry"
                                                                                        value="<?= $india['country'] ?>" readonly style="width: 60px !important;">
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="row justify-content-center" id="intrahead" <?=((in_array('Intra State Tax Rate', $fieldedit))?'':'style="display:none;"')?>>
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
                                                                                    $sqliss = mysqli_query($con, "select * from pairproducts where id='".$id."' and itemmodule='Services'");
                                                                        $infoss=mysqli_fetch_array($sqliss);
                  $count=1;
                  $sqlit=mysqli_query($con, "select * from pairtaxrates where taxgroups!=''and (createdid='$companymainid' or createdid='0') order by tax asc");
                  while($infot=mysqli_fetch_array($sqlit))
                  {
                      ?>
                                                                                    <option <?=($infot['id']==$infoss['intratax'])?'selected':'';?> value="<?=$infot['id']?>">
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
                                                                <div class="row justify-content-center" id="intrahead" <?=((in_array('Inter State Tax Rate', $fieldedit))?'':'style="display:none;"')?>>
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
                                                                                    $sqliss = mysqli_query($con, "select * from pairproducts where id='".$id."' and itemmodule='Services'");
                                                                        $infoss=mysqli_fetch_array($sqliss);
                  $count=1;
                  $sqlit=mysqli_query($con, "select * from pairtaxrates where (taxgroups='' or taxgroups IS NULL) and (createdid='$companymainid' or createdid='0') and id not in (".$taxgroups.") order by tax asc");
                  while($infot=mysqli_fetch_array($sqlit))
                  {
                      ?>
                                                                                    <option <?=($infot['id']==$infoss['intertax'])?'selected':'';?> value="<?=$infot['id']?>">
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
                                                     if($permissionproinventory!='0'){
                                                    ?>
                                                     <?php
                                                     if($permissionproinvedit!='0'){
                                                    ?>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingSix">
                                                <button class="accordion-button font-weight-bold" type="button"
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


                                                   <!--  <div class="row justify-content-center">
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
$sqlis = mysqli_query($con, "select uqc, unitname from pairunits group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                        <option value="<?= $infos['uqc'] ?>">
                                                                            <?= $infos['unitname'] ?> -
                                                                            <?= $infos['uqc'] ?>
                                                                        </option>
                                                                        <?php
}
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
    <svg></td><td>BATCH</td><td>EXPIRY</td><!-- <th>PRICE NAME</th> <td>UNIT</td><td style="text-align: right !important;">MRP</td><td style="text-align: right !important;">RATE PER UNIT</td><td></td></tr>
</thead>
<tbody>
<tr>
<td style="width:0%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td style="width:21%;"><input type="text" class="form-control form-control-sm bordernoneinput bor" name="branch" style="height:21px;padding: 0px;text-align: left;"></td>
<td style="width:15%;"><input type="text" class="form-control form-control-sm bordernoneinput bor" name="openingstock" style="height:21px;padding: 0px;text-align: left;" placeholder="Initial Quantity on Hand"></td>
<td style="width:15%;"><input type="text" class="form-control form-control-sm bordernoneinput bor" name="asd" style="height:21px;padding: 0px;text-align: left;" placeholder="AS OF DATE"></td>
<td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td>
<td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td>
<!-- <td style="width:18%;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="productname[]" id="productname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td> 
<td style="width:8%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td>
<td style="width:11%;"><!-- <input type="number" min="0" step="0.01" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;" onChange="productcalc(1)"> 
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
<a class="inventoryadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div>
  </div>
</div>
</div>
                                        </div> 
                                        <?php
                                    }
                                }
                                    ?>
                                    <?php
                                                     if($permissionprostock!='0'){
                                                    ?>
                                                     <?php
                                                     if($permissionprostkedit!='0'){
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
                                    }
                                }
                                    ?>
                                    <?php
                                                     if($permissionproother!='0'){
                                                    ?>
                                                     <?php
                                                     if($permissionproothedit!='0'){
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
                                        <!---<div class="row justify-content-center">

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
                                        </div>-->
                                        



                                    </div>






                            </div>
                        </div>
                    </div>
                                        <!-- <div class="row justify-content-center" id="footer">
                                            <hr>
                                            <div class="row col-md-12">
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-primary btn-sm btn-custom"
                                                        type="submit" name="submit" value="Submit">Save</button>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="franchises.php">Cancel</a>
                                                </div>
                                                <div class="col-md-10"></div>
                                            </div>

                                        </div> -->


                                    </div> 






                            </div>
                        </div>
                    </div>
                     <?php
                                    }
                                }
                                    ?>
                                    
                    </form>
                    <?php
// if($info['productimage']!='')
{
    ?>
    <div class="row">
    <?php
    // $imgs=explode(',',$info['productimage']);
    // foreach($imgs as $img)
    {
    ?>
    <div class="col-lg-3">
    <!-- <img src="<?=$img?>" class="img-responsive"> -->
    </div>
    <?php
    }
    ?>
    </div>
    <?php
}
?>

<?php
}
}
else
{
    ?>
    <div class="alert alert-danger">No Results Found</div>
    <?php
    
}
?>
                    
                </div>
            </div>
            <?php
        }
        ?>
                    </form>
            <?php 
                                    // include('navbottom.php');
                                    ?>
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
    document.getElementById("configureunits").innerHTML = "New Category";
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
            alert('Please Enter New Category Name');
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
    
    
    
    


<!-- Start AddNewSubCategory modal -->
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
                    <!-- End AddNewSubCategory modal -->


    
    
    <script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
    
</body>

</html>
<?php
}
else{
header("Location:services.php?error=No Information Found");
}
}
else{
header("Location:services.php?error=No Information Found");  
}
?>