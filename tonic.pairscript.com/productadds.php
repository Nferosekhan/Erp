<?php
include ('lcheck.php');
$prosqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Products' order by id  asc");
while($proinfomainaccessfield=mysqli_fetch_array($prosqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $proinfomainaccessfield['moduletype']);
    $proadd = $proinfomainaccessfield[21];
    $profieldadd = explode(',',$proadd);
    $proedit = $proinfomainaccessfield[22];
    $profieldedit = explode(',',$proedit);
    $proview = $proinfomainaccessfield[23];
    $profieldview = explode(',',$proview);
}
if(isset($_POST['submit']))
{
// $productcodes=mysqli_real_escape_string($con, $_POST['productcode']);
// $publiccodes=mysqli_real_escape_string($con, $_POST['publiccode']);
// $privatecodes=mysqli_real_escape_string($con, $_POST['privatecode']);
$productname=mysqli_real_escape_string($con, $_POST['productname']);
$codetags=mysqli_real_escape_string($con, $_POST['codetags']);
$hsncode=mysqli_real_escape_string($con, $_POST['hsncode']);
$rack=mysqli_real_escape_string($con, $_POST['rack']);
$delivery=mysqli_real_escape_string($con, $_POST['delivery']);
$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Products' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
$prohead = $infomainaccesspublicname['modulename'];
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
    $description=mysqli_real_escape_string($con, $_POST['description']);
}
else{
    $description=" ";
}
if(isset($_POST['procategory']))
{
    $category=mysqli_real_escape_string($con, $_POST['procategory']);
}
else{
    $category=" ";
}
if(isset($_POST['provisibility']))
{
    $pvisibility=mysqli_real_escape_string($con, $_POST['provisibility']);
}
else{
    $pvisibility="PUBLIC";
}
if(isset($_POST['prosubcategory']))
{
    $subcategory=mysqli_real_escape_string($con, $_POST['prosubcategory']);
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
if(mysqli_real_escape_string($con, $_POST['intratax'])!='')
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
if(mysqli_real_escape_string($con, $_POST['intertax'])!='')
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
$barcode=mysqli_real_escape_string($con, $_POST['probarcode']);
$barcodehead=mysqli_real_escape_string($con, $_POST['probarcodehead']);
$barcodetitle=mysqli_real_escape_string($con, $_POST['probarcodetitle']);
$underbarcodelabel=mysqli_real_escape_string($con, $_POST['prounderbarcodelabel']);
$barcodenotes=mysqli_real_escape_string($con, $_POST['probarcodenotes']);
$barcodeformat=mysqli_real_escape_string($con, $_POST['probarcodeformat']);
$sqlup = "insert into pairproducts set createdon='$times',productname='$productname',createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', codetags='$codetags',itemmodule='Products',franchisesession='".$_SESSION["franchisesession"]."',  description='$description',defaultunit='$forpro',category='$category', subcategory='$subcategory',pvisiblity='$pvisibility',delivery='$delivery',productcode='$productcode',taxpref='$taxpref',intratax='$intratax',intertax='$intertax',hsncode='$hsncode',publicid='$publiccode',privateid='$privatecode',rack='$rack',barcodeformat='$barcodeformat',barcode='$barcode',barcodetitle='$barcodetitle',barcodenotes='$barcodenotes',underbarcodelabel='$underbarcodelabel',barcodehead='$barcodehead'";
            $queryuppro = mysqli_query($con, $sqlup);
$tid=mysqli_insert_id($con);
$productid=$tid;
            if ($queryuppro) {
                echo "Added Successfully|".$productid;
             // header('Location:products.php?remarks=Added Successfully');  
$sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Products'"); 
$sqlpricenamequery=mysqli_query($con,"select count(salename) from pairprosale where productid='$productid'");
$anspricenamequery=mysqli_fetch_array($sqlpricenamequery);
$oldpricenamequery=$anspricenamequery[0];
$anspricenames=$_POST['pricename'];
if ($anspricenames!='') {
    $pricename = $anspricenames;
}
else{
    $pricename  = 'SELLING PRICE ' . $oldpricenamequery + 1;
}

$ansmrps=$_POST['mrp'];
    

$anssellprices=$_POST['sellingprice'];
    

$ansdescriptions=$_POST['descriptions'];
    
if ($anspricenames!=''||$ansmrps!=''||$anssellprices!=''||$ansdescriptions!='') {
$sqlupn = "insert into pairprosale set productid='$productid',salename='$pricename',salemrp='$ansmrps',salecost='$anssellprices',saledescription='$ansdescriptions',itemmodule='Products',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            $sqlupnpro = mysqli_query($con,"update pairproducts set salescost='$anssellprices' where id='$tid'");
            if(!$queryupn){
               // header('Location:productadd.php?error=Pricename Added Unsuccessfully');
            }
}
else{
    $sqlupn = "insert into pairprosale set productid='$productid',itemmodule='Products',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            if(!$queryupn){
               // header('Location:productadd.php?error=Pricename Added Unsuccessfully');
            }
}


$sqlpricenamepurquery=mysqli_query($con,"select count(purchasename) from pairpropurchase where productid='$productid'");
$anspurpricenamequery=mysqli_fetch_array($sqlpricenamepurquery);
$oldpurpricenamequery=$anspurpricenamequery[0];
$anspricenamespur=$_POST['pricenamepur'];

if ($anspricenamespur!='') {
    $pricenamepur = $anspricenamespur;
}
else{
    $pricenamepur  = 'PURCHASE PRICE ' . $oldpurpricenamequery + 1;
}

$ansmrpspur=$_POST['mrppur'];
    

$anssellpricespur=$_POST['sellingpricepur'];
    

$ansdescriptionspur=$_POST['descriptionspur'];
    
if ($anspricenamespur!=''||$ansmrpspur!=''||$anssellpricespur!=''||$ansdescriptionspur!='') {
$sqlupn = "insert into pairpropurchase set productid='$productid',purchasename='$pricenamepur',purchasemrp='$ansmrpspur',purchasecost='$anssellpricespur',purchasedescription='$ansdescriptionspur',itemmodule='Products',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            if(!$queryupn){
               // header('Location:productadd.php?error=Pricename Added Unsuccessfully');
            }
}
else{
    $sqlupn = "insert into pairpropurchase set productid='$productid',itemmodule='Products',createdid='$companymainid'";
            $queryupn = mysqli_query($con, $sqlupn);
            if(!$queryupn){
               // header('Location:productadd.php?error=Pricename Added Unsuccessfully');
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
                if (in_array('Unit', $profieldadd)) {
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
                if($category!='')
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
                if($subcategory!='')
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
                if($description!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Description <span style="color:green;" id="prohisfromtospan">( '.$description.' ) </span>';
                    }
                    else
                    {
                        $ch.='Description <span style="color:green;" id="prohisfromtospan">( '.$description.' ) </span>';
                    }    
                }       
                if (in_array('Product Visibility', $profieldadd)) {
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
                if (in_array('Tax Rate', $profieldadd)) {
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
                $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='PRODUCTS', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$productid', useremarks='".$ch."' ");
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
    if(isset($_POST['prosubcategory']))
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
    if(isset($_POST['procategory']))
{
    $sqlupcat = "insert into paircategory set createdon='$times', createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',itemmodule='Products', category='$category'";
                            $queryupcat = mysqli_query($con, $sqlupcat);
}
}
}
}
?>
