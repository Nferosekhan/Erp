<?php
include('lcheck.php');
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where (userid='$userid' and createdid='0') and moduletype='Customers' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
// if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)||($infomainaccessuser['useraccessedit']==0)))) {
// header('Location:dashboard.php');
// }

// $id=mysqli_real_escape_string($con, $_GET['id']);
// $sqlcushis=mysqli_query($con,"select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and itype='DEFAULT'");
// $sqlanscus = mysqli_fetch_array($sqlcushis);
// $oldsalute = $sqlanscus['primarysalutation'];
// $oldpcontact = $sqlanscus['primarycontact'];
// $oldcompanyname = $sqlanscus['companyname'];
// $oldcustomerdname = $sqlanscus['customername'];
// $oldcategory = $sqlanscus['category'];
// $oldsubcategory = $sqlanscus['subcategory'];
// $oldworkphone = $sqlanscus['workphone'];
// $oldmobilephone = $sqlanscus['mobile'];
// $oldemail = $sqlanscus['email'];
// $oldwebsite = $sqlanscus['website'];
// $oldbillstreet = $sqlanscus['billstreet'];
// $oldbillcity = $sqlanscus['billcity'];
// $oldbillstate = $sqlanscus['billstate'];
// $oldbillpincode = $sqlanscus['billpincode'];
// $oldbillcountry = $sqlanscus['billcountry'];
// $oldshipstreet = $sqlanscus['shipstreet'];
// $oldshipcity = $sqlanscus['shipcity'];
// $oldshipstate = $sqlanscus['shipstate'];
// $oldshippincode = $sqlanscus['shippincode'];
// $oldshipcountry = $sqlanscus['shipcountry'];
// $oldcvisibility = $sqlanscus['cvisiblity'];
// $oldtaxpreference = $sqlanscus['custaxprefer'];
// $oldgstrtype = $sqlanscus['gstrtype'];
// $oldgstin = $sqlanscus['gstin'];
// $oldbusinesslegalname = $sqlanscus['buslegname'];
// $oldbusinesstradename = $sqlanscus['bustrdname'];
// $oldpan = $sqlanscus['pan'];
// $oldplaceos = $sqlanscus['placeos'];
// $cushead = $infomainaccessuser['modulename'];
if(isset($_POST['submit']))
{
// $customercode = mysqli_real_escape_string($con, $_POST['customercode']); customercode='$customercode',,  mobile='$mobile', address='$address',  email='$email',   website='$website', tinno='$tinno', cstno='$cstno', landline='$landline' 
// $id=mysqli_real_escape_string($con,$_GET['id']);
$salute= mysqli_real_escape_string($con, $_POST['salute']);
$pcontact= mysqli_real_escape_string($con, $_POST['pcontact']);
$companyname= mysqli_real_escape_string($con, $_POST['companyname']);
$customerdname= mysqli_real_escape_string($con, $_POST['customerdname']);
if(isset($_POST['visibilityc']))
{
    $cvisibility=mysqli_real_escape_string($con, $_POST['visibilityc']);
}
else{
    $cvisibility="PUBLIC";
}

if(isset($_POST['category']))
{
    $category=mysqli_real_escape_string($con, $_POST['category']);
}
else{
    $category=" ";
}
if(isset($_POST['subcategory']))
{
    $subcategory=mysqli_real_escape_string($con, $_POST['subcategory']);
}
else{
    $subcategory=" ";
}
$billstreet = mysqli_real_escape_string($con, $_POST['billstreet']);
$billcity = mysqli_real_escape_string($con, $_POST['billcity']);
$billstate = mysqli_real_escape_string($con, $_POST['billstate']);
$billpincode = mysqli_real_escape_string($con, $_POST['billpincode']);
$billcountry = mysqli_real_escape_string($con, $_POST['billcountry']);
$gstrtype = mysqli_real_escape_string($con, $_POST['gstrtype']);
$gstin = mysqli_real_escape_string($con, $_POST['gstin']);
$businesslegalname = mysqli_real_escape_string($con, $_POST['bln']);
$businesstradename = mysqli_real_escape_string($con, $_POST['btname']);
$taxpreference = mysqli_real_escape_string($con, $_POST['taxpref']);
$workphone = mysqli_real_escape_string($con, $_POST['workphone']);
$mobilephone = mysqli_real_escape_string($con, $_POST['mobilephone']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$website = mysqli_real_escape_string($con, $_POST['website']);
$pan = mysqli_real_escape_string($con, $_POST['pan']);
$placeos = mysqli_real_escape_string($con, $_POST['pos']);
$sameasbilling = mysqli_real_escape_string($con, (isset($_POST['sameasbilling']))?'1':'0');
if ($sameasbilling=='1') {
$shipstreet = mysqli_real_escape_string($con, $_POST['billstreet']);
$shipcity = mysqli_real_escape_string($con, $_POST['billcity']);
$shipstate = mysqli_real_escape_string($con, $_POST['billstate']);
$shippincode = mysqli_real_escape_string($con, $_POST['billpincode']);
$shipcountry = mysqli_real_escape_string($con, $_POST['billcountry']);
}
else{
$shipstreet = mysqli_real_escape_string($con, $_POST['shipstreet']);
$shipcity = mysqli_real_escape_string($con, $_POST['shipcity']);
$shipstate = mysqli_real_escape_string($con, $_POST['shipstate']);
$shippincode = mysqli_real_escape_string($con, $_POST['shippincode']);
$shipcountry = mysqli_real_escape_string($con, $_POST['shipcountry']);
}
// $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
// $address = mysqli_real_escape_string($con, $_POST['address']);
// $email = mysqli_real_escape_string($con, $_POST['email']);
// $website = mysqli_real_escape_string($con, $_POST['website']);
// $tinno = mysqli_real_escape_string($con, $_POST['tinno']);
// $cstno = mysqli_real_escape_string($con, $_POST['cstno']);
// $landline = mysqli_real_escape_string($con, $_POST['landline']);
//
$msg = "";
$msg_class = "";
    // if(($customerdname!=""||$customerdname==""))
    // {       
        $sqls=mysqli_query($con,"select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and itype='DEFAULT'");
            $anss=mysqli_fetch_array($sqls);
            $rowCountanss = mysqli_num_rows($sqls);
         
        // if(!$anss){
        //    die("SQL query failed: " . mysqli_error($con));
        // }
         
        if($rowCountanss != 0) 
        {   
            $sqlup = "update paircustomers set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."',primarysalutation='$salute',primarycontact='$pcontact',companyname='$companyname',customername='$customerdname',cvisiblity='$cvisibility',billstreet='$billstreet',billcity='$billcity',billstate='$billstate',billpincode='$billpincode',billcountry='$billcountry',shipstreet='$shipstreet',shipcity='$shipcity',shipstate='$shipstate',shippincode='$shippincode',shipcountry='$shipcountry',gstrtype='$gstrtype',gstin='$gstin',buslegname='$businesslegalname',bustrdname='$businesstradename',category='$category',subcategory='$subcategory',custaxprefer='$taxpreference',workphone='$workphone',mobile='$mobilephone',email='$email',website='$website',sameasbilling='$sameasbilling',pan='$pan',placeos='$placeos' where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and itype='DEFAULT'";
            $queryup = mysqli_query($con, $sqlup);
             
            // if(!$queryup){
            //    die("SQL query failed: " . mysqli_error($con));
            // }
            // else
            // {
            //     $tid=mysqli_insert_id($con);
            //     mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Unit', '{$tid}')");
                
            // } 

$sqlsubcat="select subcategory from pairsubcategory where subcategory='$subcategory'";
$resultsubcat = mysqli_query($con,$sqlsubcat);
if (mysqli_num_rows($resultsubcat)>0) {
}
else{
    if(isset($_POST['subcategory']))
{
    $sqlupsub = "insert into pairsubcategory set createdon='$times', createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',itemmodule='Customers', subcategory='$subcategory'";
                            $queryupsub = mysqli_query($con, $sqlupsub);
}
}

$sqlcat="select category from paircategory where category='$category'";
$resultcat = mysqli_query($con,$sqlcat);
if (mysqli_num_rows($resultcat)>0) {
}
else{
    if(isset($_POST['category']))
{
    $sqlupcat = "insert into paircategory set createdon='$times', createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',itemmodule='Customers', category='$category'";
                            $queryupcat = mysqli_query($con, $sqlupcat);
}
}

}
else{
    $sqlup = "insert into paircustomers set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', franchisesession='" . $_SESSION["franchisesession"] . "',primarysalutation='$salute',primarycontact='$pcontact',companyname='$companyname',customername='$customerdname',cvisiblity='$cvisibility',billstreet='$billstreet',billcity='$billcity',billstate='$billstate',billpincode='$billpincode',billcountry='$billcountry',shipstreet='$shipstreet',shipcity='$shipcity',shipstate='$shipstate',shippincode='$shippincode',shipcountry='$shipcountry',gstrtype='$gstrtype',gstin='$gstin',buslegname='$businesslegalname',bustrdname='$businesstradename',category='$category',subcategory='$subcategory',custaxprefer='$taxpreference',workphone='$workphone',mobile='$mobilephone',email='$email',website='$website',sameasbilling='$sameasbilling',pan='$pan',placeos='$placeos',moduletype='Customers',itype='DEFAULT'";
        $queryup = mysqli_query($con, $sqlup);
}
header("location:preference_billing.php");
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
?>
    <title>
        Edit Customer - Dmedia
    </title>
    

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- customeredit.css -->
    <link rel="stylesheet" href="customeradd.css">
<!-- gst select design -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet"/>
    <style>
#fullcontainerwidth{
     max-width: 1650px;

}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;

 }
 #edithead{
  font-size:20px;

  border-bottom: 1px dashed lightgrey;

  width: max-content;

 }
 .modal-content{
  border-radius: 0px;

 }
 .modal-header{
  border-radius:0px !important;

 }
 .modal-title{
  color:#212529;

 }
 #closeicon{
  font-size: 21px;

  font-weight: 600;

 }
 .modal-body{
  padding-bottom: 0px !important;

  margin-bottom: -24.5px !important;

 }
.modal-footer{
     display: block;

     margin-bottom: -14.5px;

}
.mbsub{
     padding-bottom: 0px !important;

     margin-bottom: 0px !important;

}
.mfsub{
 display: block;

 }
.customcont-heading{
     font-size: 18px;

}
.vendorid{
     border-bottom: 1px dashed grey;

}
.highfor{
     height:42px;

}
.primarycontact{
     border-bottom: 1px dashed grey;

}
#drpsalute{
     position:relative;
     top: -27px;
     left: 81%;
     color: #ced4da;

}
.companyname{
     border-bottom: 1px dashed grey;

}
.displayname{
     border-bottom: 1px dashed grey;

}
#area{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 0px solid #ced4da;
     width: 145px !important;

}
#city{
     padding: 5px 8px;
     border: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;

}
#state{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 1px solid #ced4da;
     width: 54px !important;

}
#pincode{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 0px solid #ced4da;
     border-right: 0px solid #ced4da;

}
#country{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 1px solid #ced4da;
     width: 45px !important;

}
.cusvis{
     color: #ee0000;

}
.bi-question-circle{
     color: #777777;
     width: 14;
     height: 14;
     cursor: pointer;

}
.taxpre{
    color: #ee0000;

}
#gstblock{
     display: none;

}
</style>
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
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
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
                                ?>
     
     <div id="fullcontainerwidth">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5 p-3">
             <div class="card-body p-0" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">

 <p id="edithead"><i class="fa fa-file-import"></i> Edit <?= $infomainaccessuser['modulename'] ?></p>
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
                                    <form method="post" action="">
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
                                </form>
                                </div><!-- 
                                <div class="modal-body" style="padding: 1rem 0px 0px 2rem !important;">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <label for="Unit" class="custom-label"><span class="text-danger">Name *</span></label>
                                        </div>
                                    </div>
                                </div>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                <div class="justify-content-center p-1">
                                    <div style="margin-left: 30px;margin-right: 30px;"> -->
                                                                        <!-- <input type="text" name="category" class="form-control form-control-sm mb-4" id="missingcategory" > -->
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
                                                                        <input type="text" name="categoryies[]" value="<?= $info['category'] ?>" class="form-control form-control-sm mb-4" >
                                                                         </div> -->
                                                                        <?php
                                                                    // }
                                                                    ?>
                                <!-- <div class="container1">
    <p style="margin-left:180px; padding:0">
<a class="add_form_field btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another Category </span></a></p>
</div> -->
<!-- </div> -->
                                                                    <!-- <script type="text/javascript">
                                                                    $(document).ready(function() {
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    $(add_button).click(function(e) {
        e.preventDefault();
            $(wrapper).prepend('<div style="margin-left: 30px;margin-right: 30px;"><input type="text" name="category[]" class="form-control form-control-sm"><a href="#" class="delete" style="width:max-content;position:relative;top:-27px;left:339px;"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></div>   '); //add input box<div class="mt-1" style="margin-left:30px;"><input type="text" name="cat[]" class="form-control form-control-sm" style="width:332px;"><a href="#" class="delete" style="width:max-content;position:relative;top:-27px;left:345px;"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;" class="mt-1 mb-1"></a></div>
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});</script> -->
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
                                    <form method="post" action="">
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
                                </form>
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
 <form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">

<input type="hidden" name="customercode" id="customercode" value="">
<input type="hidden" name="landline" id="landline" value="">
<input type="hidden" name="cstno" id="cstno" value="">
<!-- margin: 1rem;"> -->
<?php
            // $sql=mysqli_query($con,"select max(id) from paircustomers");
            // $ans=mysqli_fetch_array($sql);
            $sqls=mysqli_query($con,"select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and itype='DEFAULT'");
            $anss=mysqli_fetch_array($sqls);
            $rowCountanss = mysqli_num_rows($sqls);
            ?> 
                                    <?php
if ((in_array('Customer Information', $fieldedit))) {
?>
<div class="accordion" id="accordionRental">
          <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingOne">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              
              <div class="customcont-header ml-0 mb-1">
                <a class="customcont-heading"><?= $infomainaccessuser['modulename'] ?> Information</a> 
             
                </div> 
                
              </button>
            </h5>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
              <div class="accordion-body text-sm">
                <?php
if ((in_array('Customer Id', $fieldedit))) {
?>
                <div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="customerid" class="custom-label vendorid" data-toggle="tooltip" title="Customer ID" data-placement="top"><?= $infomainaccessuser['modulename'] ?> ID</label>
            </div>
                      <div class="col-sm-8 ali">
              <input type="text" class="form-control  form-control-sm" id="customerid" name="customerid" placeholder="Customer ID" disabled value="<?= $rowCountanss!='0'?$anss['customercode']:'' ?>">
            </div>
          </div>
    </div>
</div>
<?php
}
?>
<?php
if ((in_array('Primary Contact', $fieldedit))) {
?>
<div class="row justify-content-center highfor">
   <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="pcontact" class="custom-label primarycontact" data-toggle="tooltip" title="Primary Contact">Primary Contact <span id="name"></span></label>
            </div>
            <div class="col-sm-3 ali">
              <input type="text" class="form-control  form-control-sm" id="salute" name="salute" placeholder="Salutation" value="<?= $rowCountanss!='0'?$anss['primarysalutation']:'' ?>">
               <!-- style="width:93px;"  -->
              <i class="fa fa-angle-down" id="drpsalute"></i>
            </div>
            <div class="col-sm-5 ali one">
              <input type="text" class="form-control  form-control-sm" id="pcontact" name="pcontact" placeholder="Name" onchange="companynames()" oninput="pco(this)" value="<?= $rowCountanss!='0'?$anss['primarycontact']:'' ?>">
               <!-- style="position:relative;left: -36px;width: 236px;"  -->
            </div>
          </div>
    </div>
</div>
<script>
   // function pco(x){
   //  var names=x.value;
   //  var namesl=x.value.length;
   //  if (namesl>=0) {
   //  document.getElementById('customerdname').value=names;        
   //  }
   // }
</script>
<?php
}
?>
<?php
if ((in_array('Company Name', $fieldedit))) {
?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="companyname" class="custom-label companyname" data-toggle="tooltip" title="Company Name" data-placement="top">Company Name</label>
            </div>
            <div class="col-sm-8 ali">
              <input type="text" class="form-control  form-control-sm" id="companyname" name="companyname" placeholder="Company Name" onchange="companynames()" value="<?= $rowCountanss!='0'?$anss['companyname']:'' ?>">
            </div>
          </div>
    </div>
</div>
<?php
}
?>
<?php
// if ((in_array('Customer Display Name', $fieldedit))) {
?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="customerdname" class="custom-label displayname" data-toggle="tooltip" title="Display Name" data-placement="top"><span class="text-danger"> <?= $infomainaccessuser['modulename'] ?></span></label><label class="custom-label displayname" data-toggle="tooltip" title="Display Name" data-placement="top"><span class="text-danger">Name *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="customerdname" name="customerdname" placeholder="Display Name" value="<?= $rowCountanss!='0'?$anss['customername']:'' ?>" required>
            </div>
          </div>
    </div>
</div>
<?php
// }
?>
<?php
if ((in_array('Category', $fieldedit))) {
?>
        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="Category" class="custom-label"><span class="">Category</span></label>
                                                                </div>
                                                                <div class="col-sm-8" onclick="andus()">
                                                                    <select
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="category" id="category">
                                                                        <option selected disabled>Category</option>

                                                                        <?php
                                                                        $sqliss = mysqli_query($con, "select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and itype='DEFAULT'");
                                                                        $infoss=mysqli_fetch_array($sqliss);
                                                                    $sqli = mysqli_query($con, "select * from paircategory where (createdid='$companymainid' or createdid='0') and itemmodule='Customers' order by category asc");
                                                                    while ($info = mysqli_fetch_array($sqli)) {
                                                                    ?>
                                                                        <option <?=($info['category']==$infoss['category'])?'selected':'';?> value="<?= $info['category'] ?>">
                                                                            <?= $info['category'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
            <?php
}
?>
<?php
if ((in_array('Sub Category', $fieldedit))) {
?>
        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="subcategory" class="custom-label"><span
                                                                            class="">Sub Category</span></label>
                                                                </div>
                                                                <div class="col-sm-8" onclick="andus()">
                                                                    <select
                                                                        class="select2-field form-control form-control-sm"
                                                                        name="subcategory" id="subcategory">
                                                                        <option selected disabled>Sub Category</option>
                                                               
                                                                        <?php
                                                                        $sqliss = mysqli_query($con, "select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and itype='DEFAULT'");
                                                                        $infoss=mysqli_fetch_array($sqliss);
                                                                    $sqli = mysqli_query($con, "select * from pairsubcategory where (createdid='$companymainid' or createdid='0') and itemmodule='Customers' order by subcategory asc");
                                                                    while ($info = mysqli_fetch_array($sqli)) {
                                                                    ?>
                                                                        <option <?=($info['subcategory']==$infoss['subcategory'])?'selected':'';?> value="<?= $info['subcategory'] ?>">
                                                                            <?= $info['subcategory'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
            <?php
}
?>
<?php
if ((in_array('Work Phone', $fieldedit))) {
?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="workphone" class="custom-label workphone" data-toggle="tooltip" title="Work Phone" data-placement="top">Work Phone</label>
            </div>
            <div class="col-sm-8 ali">
              <input type="text" class="form-control  form-control-sm" id="workphone" name="workphone" placeholder="Work Phone" value="<?= $rowCountanss!='0'?$anss['workphone']:'' ?>">
            </div>
          </div>
    </div>
</div>
<?php
}
?>
<?php
if ((in_array('Mobile Phone', $fieldedit))) {
?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="mobilephone" class="custom-label mobilephone" data-toggle="tooltip" title="Mobile Phone" data-placement="top">Mobile Phone</label>
            </div>
            <div class="col-sm-8 ali">
              <input type="text" class="form-control  form-control-sm" id="mobilephone" name="mobilephone" placeholder="Mobile Phone" value="<?= $rowCountanss!='0'?$anss['mobile']:'' ?>">
            </div>
          </div>
    </div>
</div>
<?php
}
?>
<?php
if ((in_array('Email', $fieldedit))) {
?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="email" class="custom-label email" data-toggle="tooltip" title="Email" data-placement="top">Email</label>
            </div>
            <div class="col-sm-8 ali">
              <input type="email" class="form-control  form-control-sm" id="email" name="email" placeholder="Email" value="<?= $rowCountanss!='0'?$anss['email']:'' ?>">
            </div>
          </div>
    </div>
</div>
<?php
}
?>
<?php
if ((in_array('Website', $fieldedit))) {
?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="website" class="custom-label website" data-toggle="tooltip" title="Website" data-placement="top">Website</label>
            </div>
            <div class="col-sm-8 ali">
              <input type="text" class="form-control  form-control-sm" id="website" name="website" placeholder="Website" value="<?= $rowCountanss!='0'?$anss['website']:'' ?>">
            </div>
          </div>
    </div>
</div>
<?php
}
?>
<?php
if ((in_array('Billing Address', $fieldedit))) {
?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="customername" class="custom-label">Billing Address</label>
            </div>
            <div class="col-sm-8">
                 <div class="input-group input-group-sm">
     <div class="input-group-prepend">
      
    </div>
              <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstreet" id="area"  placeholder="Street" value="<?= $rowCountanss!='0'?$anss['billstreet']:'' ?>">
      <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcity" id="city" placeholder="City/Town" value="<?= $rowCountanss!='0'?$anss['billcity']:'' ?>">
          </div>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                 <div class="input-group input-group-sm">
     <div class="input-group-prepend">
      
    </div>
              <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstate" id="state" placeholder="State" value="<?= $rowCountanss!='0'?$anss['billstate']:'' ?>">
     <input type="number" autocomplete="off" class="form-control  form-control-sm" name="billpincode" id="pincode" min="0" placeholder="Pin" value="<?= $rowCountanss!='0'?$anss['billpincode']:'' ?>">
     <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcountry" id="country" placeholder="Country/Region" value="<?= $rowCountanss!='0'?$anss['billcountry']:'' ?>">
          </div>
            </div>
          </div>
    </div>
</div>
<?php
}
?>
<?php
if ((in_array('Shipping Address', $fieldedit))) {
?>
<!-- <div class="row justify-content-center sameasbilling" id="sameasbilling">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-6">
        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
                        <label class="custom-control-label custom-label" for="sameasbilling"> Same as Billing Address</label>
                      </div>
                  </div>
              </div>
        </div>
    </div>  -->
<!--     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
                        <label class="custom-control-label custom-label" for="sameasbilling" style="font-size:11px !important;"> Same as Billing Address</label>
                      </div> -->
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="customername" class="custom-label" id="shipword">Shipping Address</label>
            </div>
            <div class="col-sm-8 shipadd" style="z-index:0;">
                <div class="custom-control custom-checkbox" onclick="sameasbillingticaccess()">
                        <input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" <?php if($rowCountanss!='0'){ ?> <?= $anss['sameasbilling']=='1'?'checked':'' ?> <?php } ?>>
                        <label class="custom-control-label custom-label" for="sameasbilling"> Same as Billing Address</label>
                      </div>
                 <!-- <div class="input-group input-group-sm">
     <div class="input-group-prepend">
      
    </div>
              <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstreet" id="area"  placeholder="Street" style="padding: 5px 8px;border-top: 1px solid #ced4da;border-radius: 0px;margin: 0px;font-size: 13.6px;border-bottom: 1px solid #ced4da;border-left: 1px solid #ced4da;border-right: 0px solid #ced4da;width: 145px !important;" value="<?= $rowCountanss!='0'?$anss['customercode']:'' ?>">
      <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcity" id="city" placeholder="City/Town" style="padding: 5px 8px;border: 1px solid #ced4da;border-radius: 0px;margin: 0px;font-size: 13.6px;" value="<?= $rowCountanss!='0'?$anss['customercode']:'' ?>">
          </div> -->
            </div>
          </div>
    </div>
</div>
<div id="totalshipadd">
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                 <div class="input-group input-group-sm">
     <div class="input-group-prepend">
      
    </div>
              <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstreet" id="area"  placeholder="Street" value="<?= $rowCountanss!='0'?$anss['shipstreet']:'' ?>">
      <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcity" id="city" placeholder="City/Town" value="<?= $rowCountanss!='0'?$anss['shipcity']:'' ?>">
          </div>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                 <div class="input-group input-group-sm">
     <div class="input-group-prepend">
      
    </div>
              <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstate" id="state" placeholder="State" value="<?= $rowCountanss!='0'?$anss['shipstate']:'' ?>">
     <input type="number" autocomplete="off" class="form-control  form-control-sm" name="shippincode" id="pincode" min="0" placeholder="Pin" value="<?= $rowCountanss!='0'?$anss['shippincode']:'' ?>">
     <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcountry" id="country" placeholder="Country/Region" value="<?= $rowCountanss!='0'?$anss['shipcountry']:'' ?>">
          </div>
            </div>
          </div>
    </div>
</div>
</div>
<?php
}
?>
<!---
<?php
         if($permissioncuscode!='0')
         {
        ?>
        <?php
         if($permissioncuscodeadd!='0')
         {
        ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="codeortags" class="custom-label" data-toggle="tooltip" title="Code or Tags" data-placement="top">Code/Tags </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="codeortags" name="codeortags" placeholder="Code or Tags">
            </div>
          </div>
    </div>
</div>
<?php
}
}
?>
        <?php
         if($cusgenhead!='0')
         {
        ?>
        <?php
         if($cusgenadd!='0')
         {
        ?>
        <div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="gender" class="custom-label">Gender</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="gender" name="gender" placeholder="Gender">
            </div>
            </div>
            </div>
            </div>
            <?php
}
}
?>
<?php
         if($cusagehead!='0')
         {
        ?>
        <?php
         if($cusageadd!='0')
         {
        ?>
        <div class="row justify-content-center">
    <div class="col-lg-6">
            <div class="form-group row">
            <div class="col-sm-4">
            <label for="age" class="custom-label">Age</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="age" name="age" placeholder="Age">
            </div>
            </div>
            </div>
            </div>
            <?php
}
}
?>-->
<!--
            <?php
         if($cusmailhead!='0')
         {
        ?>
        <?php
         if($cusmailadd!='0')
         {
        ?>
        <div class="row justify-content-center">
    <div class="col-lg-6">
            <div class="form-group row">
            <div class="col-sm-4">
            <label for="email" class="custom-label">Email</label>
            </div>
            <div class="col-sm-8">
              <input type="email" class="form-control  form-control-sm" id="email" name="email" placeholder="Email">
              
            </div>
            </div>
            </div>
            </div>
    <!-- </div> -->
    <?php
}
}
?>
<!-- </div> -->
  <!-- </div> 
  <?php
         if($cusphonehead!='0')
         {
        ?>
        <?php
         if($cusphoneadd!='0')
         {
        ?>
        <div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="phonenumber" class="custom-label">Phone Number</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="phonenumber" name="phonenumber" placeholder="Phone Number">
              
            </div>
            </div>
  <!-- <div class="row justify-content-center mt-1">
<div class="col-lg-6">
<div class="table-responsive" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
  <table class="table table-bordered" id="purchasetable" style="color: #000000;font-size: 14px;">
<thead style="line-height: 9px;">
<tr><th style="color: black !important;"></th><th style="color: black !important;">PHONE NAME</th><th style="color: black !important;">PHONE NUMBER</th><th style="color: black !important;"></th></tr>
</thead>
<tbody>
<tr>
<td style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;" data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc;margin-top: 10px;"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td style="" data-label="PHONE NAME"><input type="text" name="pnm[]" id="pnm"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" placeholder="Phone Name"></td>
<td style="" data-label="PHONE NUMBER"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" placeholder="Phone Number"></td>
<td style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;" data-label=""><a onclick="addclick()" style="cursor: pointer;"><svg style="width: 15px;" width="5" height="5" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-8">
    <p style="margin-left:150px; padding:0">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div>
</div>
</div>
<script type="text/javascript"> $('input[type="text"],input[type="number"],input[type="date"]').hover(function() {
    $(this).attr('title', $(this).val()); });</script> 
</div>
</div>
     <?php
}
}
?>
            <?php
         if($cuswebhead!='0')
         {
        ?>
        <?php
         if($cuswebadd!='0')
         {
        ?>
<div class="row justify-content-center">
    <div class="col-lg-6" style="margin-left: 1px;">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="website" class="custom-label">Website</label>
            </div>
            <div class="col-sm-8 web">
              <input type="text" class="form-control  form-control-sm" id="website" name="website" placeholder="Website" >
            </div>
          </div>
          <?php
}
}
?>
    
            <?php
         if($cusbillhead!='0')
         {
        ?>
        <?php
         if($cusbilladd!='0')
         {
        ?>
          <div class="row justify-content-center" style="margin-left:1px;">
  <div class="col-lg-6 baddress" style="height:48px;">
  <div class="form-group row">
<div class="col-sm-4 p-0">
<label for="customername" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-8" style="padding-left: 6px;">
              <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
      
    </div>
     <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstreet" id="area"  placeholder="Street" style="border: 1px solid #ced4da;border-radius: 0px;">
      <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcity" id="city" placeholder="City/Town" style="border: 1px solid #ced4da;border-radius: 0px;">
  </div>
  </div>
</div>
</div>

<div class="row justify-content-center" style="margin-left: 1px;">
  <div class="col-lg-6 baddress" style="height:48px;">
  <div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8" style="padding-left: 0px;padding-right: 12.3px;">
              <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend" style="margin-left:0px !important;">
      
    </div>
     <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstate" id="state" placeholder="State" style="border: 1px solid #ced4da;border-radius: 0px;">
     <input type="number" autocomplete="off" class="form-control  form-control-sm" name="billpincode" id="pincode" min="0" placeholder="Pin" style="border: 1px solid #ced4da;border-radius: 0px;">
     <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcountry" id="country" placeholder="Country/Region" style="border: 1px solid #ced4da;border-radius: 0px;">
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
         if($cusshiphead!='0')
         {
        ?>
        <?php
         if($cusshipadd!='0')
         {
        ?>
        <div class="row justify-content-center">
              <div class="col-lg-6">
<div class="custom-control custom-checkbox mt-0 mb-3">
                        <input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
                        <label class="custom-control-label custom-label" for="sameasbilling"> Same as Billing Address</label>
                      </div>
                  </div>
              </div>
<div class="row justify-content-center" style="margin-left:1px;">
  <div class="col-lg-6 saddress" style="height:48px;">
  <div class="form-group row">
<div class="col-sm-4 p-0">
<label for="customername" class="custom-label">Shipping Address</label>
</div>
<div class="col-sm-8" style="padding-left: 6px;">
              <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
      
    </div>
   <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstreet" id="street"  placeholder="Street" style="border: 1px solid #ced4da;border-radius: 0px;">
   <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcity" id="city" placeholder="City/Town" style="border: 1px solid #ced4da;border-radius: 0px;">
  </div>
  </div>
  </div>
</div>
</div>

<div class="row justify-content-center" style="margin-left:1px;">
  <div class="col-lg-6" style="height:48px;">
  <div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8" style="padding-left: 6px;padding-right: 11px;">
              <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
      
    </div>
   <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstate" id="state" placeholder="State" style="border: 1px solid #ced4da;border-radius: 0px;">
   <input type="number" autocomplete="off" class="form-control  form-control-sm" name="shippincode" id="pincode" min="0" placeholder="Pin" style="border: 1px solid #ced4da;border-radius: 0px;">
   <input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcountry" id="country" placeholder="Country/Region" style="border: 1px solid #ced4da;border-radius: 0px;">
  </div>
  </div>
  </div>
</div>
</div>
<?php
}
}
?>

<div class="row">
<div class="col-lg-6" style="display:none">
<h6>Shipping Address <label><input type="checkbox" name="sameaddress" id="sameaddress" onchange="sameadd()" value="0"> Same as Billing Address</label></h6>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
<label>Door No. / House Name</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="saddress1" id="saddress1">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>Street Name</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="saddress2" id="saddress2">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>Area</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sarea" id="sarea">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>City</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="scity" id="scity">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>District</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sdistrict" id="sdistrict">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>State</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sstate" id="sstate">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>Pin Code</label>
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="spincode" id="spincode" min="0">
  </div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
<!------------->
<!-- </div> -->
          <!-- <div class="form-group row">
  <div class="col-lg-12" style="height:18px;">
  <div class="form-group row">
<div class="col-sm-4">
<label for="billingadd" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-5">
<input type="hidden" name="address1" id="address1">
<input type="hidden" name="address2" id="address2">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="area" id="area"  placeholder="Street" style="height: 21px;padding: 1.5px;width: 169px;">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="city" id="city" placeholder="City/Town" style="height: 21px;padding: 1.5px;margin-left: -54px;width: 169px;">
</div>
  </div>
</div>
</div>

<div class="row">
  <div class="col-lg-12" style="height:30px;">
  <div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="state" id="state" placeholder="State" style="height: 21px;padding: 1.5px;width: 120px;">
</div>
<div class="col-sm-2">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="pincode" id="pincode" min="0" placeholder="Pin" style="height: 21px;padding: 1.5px;width: 72px;margin-left: -10px;">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="district" id="district" placeholder="Country/Region" style="height: 21px;padding: 1.5px;margin-left: -23.5px;width: 140px;">
</div>
  </div>
</div>
</div>
<div class="form-group row">
  <div class="col-lg-12" style="height:18px;">
  <div class="form-group row">
<div class="col-sm-4">
<label for="shippingadd" class="custom-label">Shipping Address </label>
<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
                        <label class="custom-control-label custom-label" for="sameasbilling"> Same as Billing Address</label>
                      </div>
</div>
<div class="col-sm-5">
<input type="hidden" name="address1" id="address1">
<input type="hidden" name="address2" id="address2">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="area" id="area"  placeholder="Street" style="height: 21px;padding: 1.5px;width: 169px;">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="city" id="city" placeholder="City/Town" style="height: 21px;padding: 1.5px;margin-left: -54px;width: 169px;">
</div>
  </div>
</div>
</div>

<div class="row">
  <div class="col-lg-12" style="height:18px;">
  <div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="state" id="state" placeholder="State" style="height: 21px;padding: 1.5px;width: 120px;">
</div>
<div class="col-sm-2">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="pincode" id="pincode" min="0" placeholder="Pin" style="height: 21px;padding: 1.5px;width: 72px;margin-left: -10px;">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="district" id="district" placeholder="Country/Region" style="height: 21px;padding: 1.5px;margin-left: -23.5px;width: 140px;">
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
          </div>--> 
      </div>
      </div>
          <?php
}
?>
<?php
$sqlvis=mysqli_query($con,"select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and itype='DEFAULT'");
$ansvis=mysqli_fetch_array($sqlvis);
?>
<?php
if ((in_array('Customers Visibility', $fieldedit))) {
?>
        <div class="accordion" id="accordionRental">
          <div class="accordion-item mb-1 pvi">
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
                                                                    <label class="custom-label mt-2 text-danger cusvis">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibilityc" id="visibility" value="PUBLIC" <?php if($rowCountanss!='0'){ ?> <?= $ansvis['cvisiblity']=='PUBLIC'?'checked':'' ?> <?php } ?>>
                        <label class="custom-control-label custom-label" for="visibility">Public</label>
                      </div>
                      
                      </div>
                      <div class="col-sm-6 my-1">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibilityc" id="novisibility" value="PRIVATE" <?php if($rowCountanss!='0'){ ?> <?= $ansvis['cvisiblity']=='PRIVATE'?'checked':'' ?> <?php }else{ ?> checked <?php }  ?>>
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
                                        <?php
}
?>
<?php
if ((in_array('Tax Information', $fieldedit))) {
?>
          <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingFive">
                                                <button class="accordion-button font-weight-bold" type="button"
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
                                                    
                                                                <!-- <div class="row justify-content-center">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="inlineRadio3">Exemption Reason</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                               <select class="form-control  form-control-sm">
                                                                                   <option>Select Type of Add</option>
                                                                               </select> 
                                                                            </div>
                                                                        </div>

                                                                      
 
                                                                    </div>


                                                                    
                                                                </div> -->
<?php
if ((in_array('Tax Preference', $fieldedit))) {
?>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label taxpre" for="inlineRadio3">Tax Preference*</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="taxpref" id="taxpreftaxable" value="0" <?php if($rowCountanss!='0'){ ?> <?= ($ansvis['custaxprefer']=='0')?'checked':''?> <?php }else{ ?> checked <?php }  ?>
                                                                    onchange="gettaxable()">
                                                                <label class="form-check-label"
                                                                    for="taxpreftaxable">Taxable</label>
                                                            </div>
                                                            <!-- <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="taxpref" id="taxprefnontaxable" value="1" <?= ($ansvis['custaxprefer']=='1')?'checked':''?>
                                                                    onchange="gettaxable()">
                                                                <label class="form-check-label" for="taxprefnontaxable">Non
                                                                    Taxable</label>
                                                            </div> -->
                                                                            </div>
                                                                        </div>

                                                                      
 
                                                                    </div>



                                                                </div>
                                                                <?php
}
?>
<?php
if ((in_array('GST Registration Type', $fieldedit))) {
?>
                                                                <div id="gstrtypesh">
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="inlineRadio3">GST Registration Type</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                               <select class="selectpicker form-control select2" data-live-search="true" title="Search title or description..." onchange="showDiv(this)" id="myBtn" name="gstrtype" required>
                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='')?'selected':'';?> <?php }else{ ?> selected <?php }  ?> value="" data-foo="Select Type of Add" disabled>Select Type of Add</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='Registered Business - Regular')?'selected':'';?> <?php } ?> data-foo="Business that is registered under GST" value="Registered Business - Regular">Registered Business - Regular</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='Registered Business - Composition')?'selected':'';?> <?php } ?> data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition">Registered Business - Composition</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='Unregistered Business')?'selected':'';?> <?php } ?> data-foo="Business that has not been registered under GST" value="Unregistered Business">Unregistered Business</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='Consumer')?'selected':'';?> <?php } ?> data-foo="A customer who is a regular consumer" value="Consumer">Consumer</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='Overseas')?'selected':'';?> <?php } ?>  data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas">Overseas</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='Special Economic Zone')?'selected':'';?> <?php } ?> data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone">Special Economic Zone</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='Deemed Export')?'selected':'';?> <?php } ?> data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export">Deemed Export</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='Tax Deductor')?'selected':'';?> <?php } ?> data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor">Tax Deductor</option>

                                                                                    <option <?php if($rowCountanss!='0'){ ?> <?=($ansvis['gstrtype']=='SEZ Developer')?'selected':'';?> <?php } ?> data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer">SEZ Developer</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="gstblock">
                                        
<?php
if ((in_array('GSTIN or UIN', $fieldedit))) {
?>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label text-danger" for="gstin">GSTIN / UIN *</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                               <input type="text" name="gstin" placeholder="GSTIN / UIN" id="gstin" class="form-control form-control-sm" value="<?= $rowCountanss!='0'?$anss['gstin']:'' ?>">
                                                                            </div>
                                                                        </div>

                                                                      
 
                                                                    </div>


                                                                    
                                                                </div>
                                                                    <?php
}
?>
<?php
if ((in_array('Business Legal Name', $fieldedit))) {
?>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="bln">Business Legal Name</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                               <input type="text" name="bln" placeholder="Business Legal Name" id="bln" class="form-control  form-control-sm" value="<?= $rowCountanss!='0'?$anss['buslegname']:'' ?>">
                                                                            </div>
                                                                        </div>

                                                                      
 
                                                                    </div>


                                                                    
                                                                </div>
                                                                   <?php
}
?>
<?php
if ((in_array('Business Trade Name', $fieldedit))) {
?>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="btname">Business Trade Name</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" name="btname" placeholder="Business Trade Name" id="btname" class="form-control  form-control-sm" value="<?= $rowCountanss!='0'?$anss['bustrdname']:'' ?>">
                                                                            </div>
                                                                        </div>

                                                                      
 
                                                                    </div>


                                                                    
                                                                </div>
                                                                <?php
}
?>
</div>
                                                                    <?php
}
?>
<?php
if ((in_array('Pan', $fieldedit))) {
?>


                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="pan">PAN</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                               <input type="text" name="pan" placeholder="PAN" id="pan" class="form-control  form-control-sm" value="<?= $rowCountanss!='0'?$anss['pan']:'' ?>"> 
                                                                            </div>
                                                                        </div>

                                                                      
 
                                                                    </div>


                                                                    
                                                                </div>
                                                                    <?php
}
?>
<?php
if ((in_array('Place Of Supply', $fieldedit))) {
?>
                                                                <div id="placeofsupply">
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label text-danger" for="pos">Place Of Supply *</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                               
        <select name="pos" id="pos" class="select2-field form-control form-control-sm" required>
<option value="JAMMU AND KASHMIR (1)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="JAMMU AND KASHMIR (1)")?'selected':''?> <?php } ?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?> <?php } ?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?> <?php } ?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?> <?php } ?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="ARUNACHAL PRADESH (12)")?'selected':''?> <?php } ?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="ASSAM (18)")?'selected':''?> <?php } ?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="BIHAR (10)")?'selected':''?> <?php } ?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="CENTRE JURISDICTION (99)")?'selected':''?> <?php } ?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="CHANDIGARH (4)")?'selected':''?> <?php } ?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="CHATTISGARH (22)")?'selected':''?> <?php } ?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?> <?php } ?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="DELHI (7)")?'selected':''?> <?php } ?>>DELHI (7)</option>
<option value="GOA (30)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="GOA (30)")?'selected':''?> <?php } ?>>GOA (30)</option>
<option value="GUJARAT (24)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="GUJARAT (24)")?'selected':''?> <?php } ?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="HARYANA (6)")?'selected':''?> <?php } ?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="HIMACHAL PRADESH (2)")?'selected':''?> <?php } ?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="JHARKHAND (20)")?'selected':''?> <?php } ?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="KARNATAKA (29)")?'selected':''?> <?php } ?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="KERALA (32)")?'selected':''?> <?php } ?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?> <?php } ?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="LAKSHADWEEP (31)")?'selected':''?> <?php } ?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="MADHYA PRADESH (23)")?'selected':''?> <?php } ?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="MAHARASHTRA (27)")?'selected':''?> <?php } ?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="MANIPUR (14)")?'selected':''?> <?php } ?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="MEGHALAYA (17)")?'selected':''?> <?php } ?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="MIZORAM (15)")?'selected':''?> <?php } ?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="NAGALAND (13)")?'selected':''?> <?php } ?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="ODISHA (21)")?'selected':''?> <?php } ?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="OTHER TERRITORY (97)")?'selected':''?> <?php } ?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="PUDUCHERRY (34)")?'selected':''?> <?php } ?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="PUNJAB (3)")?'selected':''?> <?php } ?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="RAJASTHAN (8)")?'selected':''?> <?php } ?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="SIKKIM (11)")?'selected':''?> <?php } ?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="TAMIL NADU (33)")?'selected':''?> <?php }else{ ?> selected <?php } ?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="TELANGANA (36)")?'selected':''?> <?php } ?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="TRIPURA (16)")?'selected':''?> <?php } ?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="UTTAR PRADESH (9)")?'selected':''?> <?php } ?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="UTTARAKHAND (5)")?'selected':''?> <?php } ?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?php if($rowCountanss!='0'){ ?> <?=($ansvis['placeos']=="WEST BENGAL (19)")?'selected':''?> <?php } ?>>WEST BENGAL (19)</option>
</select>                                                                      
                                                                               
                                                                               
                                                                            </div>
                                                                        </div>

                                                                      
 
                                                                    </div>


                                                                    
                                                                </div>
                                                                </div>
                                                                   <?php
}
?>
                                                            
                                                                <!-- <div class="row justify-content-center">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="inlineRadio3"
                                                                    style="color: #ee0000;">Tax Preference*</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="taxpref" id="taxpreftaxable" value="0" checked
                                                                    onchange="gettaxable()">
                                                                <label class="form-check-label"
                                                                    for="taxpreftaxable">Taxable</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="taxpref" id="taxprefnontaxable" value="1"
                                                                    onchange="gettaxable()">
                                                                <label class="form-check-label" for="taxprefnontaxable">Non
                                                                    Taxable</label>
                                                            </div>
                                                                            </div>
                                                                        </div>

                                                                      
 
                                                                    </div>



                                                                </div> -->
                                                                </div>
                                                  <!--  <div class="row justify-content-center">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="inlineRadio3">Currency</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group mb-3 input-group-sm">
     <div class="input-group-prepend">
       <span class="input-group-text" style="color: #495057;padding: 8px 4.5px;height:21px;border: none !important;">₹</span>
    </div>
    <input type="age" min="0" name="quantity[]" id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;border-radius: 0px;border-left: 1px solid #ced4da;" onChange="productcalc(1)">
  </div>
                                                                            </div>
                                                                        </div>


                                                            </div>
                                                            <div class="row justify-content-center mt-1">
                                                                <div class="col-lg-6">
                                                            <div class="table-responsive" style="margin-left: 0%;margin-right: 0%;">
  <table class="table table-bordered" id="purchasetable">
<thead style="color: #000000;font-size: 14px;">
<tr><td></td><td>PHONE NAME</td><td>PHONE NUMBER</td><td></td></tr>
</thead>
<tbody>
<tr>
<td data-label="" style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc;margin-top: 10px;"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="PHONE NAME"><input type="text" name="pnm[]" id="pnm" class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Phone Name"></td>
<td data-label="PHONE NUMBER"><input type="text" name="pno[]" id="pno" class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Phone Number"></td>
<td data-label="" style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;"><a onclick="addclick()" style="cursor: pointer;"><svg style="width: 15px;" width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-8">
    <p style="margin-left:150px; padding:0">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div>
</div>
 </div> -->
 <!--
 <div class="row justify-content-center">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="inlineRadio3">Payment Terms</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <select class="form-control  form-control-sm">
                                                                                    <option>Due On Recipts</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                            </div>
                                                        </div>
<div class="row justify-content-center">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="inlineRadio3">Price List</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <select class="form-control  form-control-sm">
                                                                                    <option>Price</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="inlineRadio3">Enable Portal</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="enablep" id="enablep" checked>
                        <label class="custom-control-label custom-label" for="enablep"> Allow Portal Access For Their Customer<br>(Email Address is Mondatry)</label>
                      </div>
                                                                            </div>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label class="form-check-label" for="inlineRadio3">Portal Language</label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <select class="form-control  form-control-sm">
                                                                                    <option>English</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                            </div>
                                                        </div>-->
                                                        <!-- <div class="row justify-content-center"> -->
                                                                <!-- <div class="col-lg-6"> 
                                                                    <label class="form-check-label mb-1" for="inlineRadio3">Contact Person : </label>
                                                            <div class="table-responsive" style="margin-left: 0%;margin-right: 0%;">
  <table class="table table-bordered" id="purchasetable">
<thead>
<tr><td></td><td>SATUATION</td><td>DESIGNATION</td><td>FIRST NAME</td><td>LAST NAME</td><td>EMAIL ADDRESS</td><td>WORK PLACE</td><td>MOBILE PHONE</td><td></td></tr>
</thead>
<tbody>
<tr>
<td style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;" data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc;margin-top: 10px;"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="SATUATION"><input type="text" name="pnm[]" id="pnm"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="SATUATION"></td>
<td data-label="DESIGNATION"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="DESIGNATION"></td>
<td data-label="FIRST NAME"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="FIRST NAME"></td>
<td data-label="LAST NAME"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="LAST NAME"></td>
<td data-label="EMAIL ADDRESS"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="EMAIL ADDRESS"></td>
<td data-label="WORK PLACE"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="WORK PLACE"></td>
<td data-label="MOBILE PHONE"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="MOBILE PHONE"></td>
<td data-label="" style="padding-top: 0px;padding-left: 3px;padding-right: 3px;padding-bottom: 0px;"><a onclick="addclick()" style="cursor: pointer;"><svg style="width: 15px;" width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-8">
    <p style="margin-left:140px; padding:0">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
  </div>
<!-- </div> -->
 <!-- </div> 
 <div class="row justify-content-center">
                                                                     <div class="col-sm-6">
                                                                                <label class="form-check-label mb-1" for="inlineRadio3">Notes (For Internal Use) : </label>
                                                                                <br>
                                                                                <textarea class="form-control  form-control-sm" style="height:60px;"></textarea>
                                                            </div> 
                                                        </div>



                                        </div>




                                                        </div>
                                                    </div>
                                                </div>-->
                                                <?php
}
?>
                                        <!---
                                                <?php
         if($permissioncuspayinfo!='0')
         {
        ?>
        <?php
         if($permissioncuspayadd!='0')
         {
        ?>
                                                <div class="accordion-item mb-1 pvi">
                                            <h5 class="accordion-header" id="otherinfo">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsepaydet"
                                                    aria-expanded="true" aria-controls="collapsepaydet">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Payment Informations</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapsepaydet" class="accordion-collapse collapse show"
                                                aria-labelledby="otherinfo">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="bank" class="custom-label" data-toggle="tooltip" title="Bank" data-placement="top">Bank </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="bank" name="bank" placeholder="Bank">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="acname" class="custom-label" data-toggle="tooltip" title="Account Name" data-placement="top">Account Name </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="acname" name="acname" placeholder="Account Name">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="sortcode" class="custom-label" data-toggle="tooltip" title="Sort Code" data-placement="top">Sort Code </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="sortcode" name="sortcode" placeholder="Sort Code">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="acnumber" class="custom-label" data-toggle="tooltip" title="Account Number" data-placement="top">Account Number </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="acnumber" name="acnumber" placeholder="Account Number">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="ifsc" class="custom-label" data-toggle="tooltip" title="IFSC" data-placement="top">IFSC </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="ifsc" name="ifsc" placeholder="IFSC">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="branch" class="custom-label" data-toggle="tooltip" title="Branch" data-placement="top">Branch </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="branch" name="branch" placeholder="Branch">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="bic" class="custom-label" data-toggle="tooltip" title="BIC/Swift" data-placement="top">BIC/Swift </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="bic" name="bic" placeholder="BIC/Swift">
            </div>
          </div>
                                                            </div>
                                                        </div> 
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="iban" class="custom-label" data-toggle="tooltip" title="IBAN" data-placement="top">IBAN </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="iban" name="iban" placeholder="IBAN">
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
         if($permissioncusbankinfo!='0')
         {
        ?>
        <?php
         if($permissioncusbankadd!='0')
         {
        ?>
                                                <div class="accordion-item mb-1 pvi">
                                            <h5 class="accordion-header" id="otherinfo">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsebank"
                                                    aria-expanded="true" aria-controls="collapsebank">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Bank Details</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapsebank" class="accordion-collapse collapse show"
                                                aria-labelledby="otherinfo">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="bank" class="custom-label" data-toggle="tooltip" title="Bank" data-placement="top">Bank </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="bank" name="bank" placeholder="Bank">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="acname" class="custom-label" data-toggle="tooltip" title="Account Name" data-placement="top">Account Name </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="acname" name="acname" placeholder="Account Name">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="sortcode" class="custom-label" data-toggle="tooltip" title="Sort Code" data-placement="top">Sort Code </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="sortcode" name="sortcode" placeholder="Sort Code">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="acnumber" class="custom-label" data-toggle="tooltip" title="Account Number" data-placement="top">Account Number </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="acnumber" name="acnumber" placeholder="Account Number">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="ifsc" class="custom-label" data-toggle="tooltip" title="IFSC" data-placement="top">IFSC </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="ifsc" name="ifsc" placeholder="IFSC">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="branch" class="custom-label" data-toggle="tooltip" title="Branch" data-placement="top">Branch </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="branch" name="branch" placeholder="Branch">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="bic" class="custom-label" data-toggle="tooltip" title="BIC/Swift" data-placement="top">BIC/Swift </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="bic" name="bic" placeholder="BIC/Swift">
            </div>
          </div>
                                                            </div>
                                                        </div> 
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="iban" class="custom-label" data-toggle="tooltip" title="IBAN" data-placement="top">IBAN </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="iban" name="iban" placeholder="IBAN">
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
         if($permissioncusothinfo!='0')
         {
        ?>
        <?php
         if($permissioncusothadd!='0')
         {
        ?>
                                                <div class="accordion-item mb-1 pvi">
                                            <h5 class="accordion-header" id="otherinfo">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseother"
                                                    aria-expanded="true" aria-controls="collapseother">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Other Informations</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapseother" class="accordion-collapse collapse show"
                                                aria-labelledby="otherinfo">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="dlt" class="custom-label" data-toggle="tooltip" title="DL.NO./20" data-placement="top">DL.NO./20 </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="dlt" name="dlt" placeholder="DL.NO./20">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="dlo" class="custom-label" data-toggle="tooltip" title="DL.NO./21" data-placement="top">DL.NO./21 </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="dlo" name="dlo" placeholder="DL.NO./21">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="salediscount" class="custom-label" data-toggle="tooltip" title="Sale Discount" data-placement="top">Sale Discount </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="salediscount" name="salediscount" placeholder="Sale Discount">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="codeortags" class="custom-label" data-toggle="tooltip" title="Code or Tags" data-placement="top">Code/Tags </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="codeortags" name="codeortags" placeholder="Code or Tags">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="codeortags" class="custom-label" data-toggle="tooltip" title="Code or Tags" data-placement="top">Code/Tags </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="codeortags" name="codeortags" placeholder="Code or Tags">
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
         if($permissioncusattinfo!='0')
         {
        ?>
        <?php
         if($permissioncusattadd!='0')
         {
        ?>
                                            <div class="accordion-item mb-1 pvi">
                                            <h5 class="accordion-header" id="otherinfo">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseattach"
                                                    aria-expanded="true" aria-controls="collapseattach">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Attachment</a>
                                                    </div>
                                                </button>
                                            </h5>
                                             <div id="collapseattach" class="accordion-collapse collapse show"
                                                aria-labelledby="otherinfo">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="bank" class="custom-label" data-toggle="tooltip" title="Bank" data-placement="top">Bank </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="bank" name="bank" placeholder="Bank">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="acname" class="custom-label" data-toggle="tooltip" title="Account Name" data-placement="top">Account Name </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="acname" name="acname" placeholder="Account Name">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="sortcode" class="custom-label" data-toggle="tooltip" title="Sort Code" data-placement="top">Sort Code </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="sortcode" name="sortcode" placeholder="Sort Code">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="acnumber" class="custom-label" data-toggle="tooltip" title="Account Number" data-placement="top">Account Number </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="acnumber" name="acnumber" placeholder="Account Number">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="ifsc" class="custom-label" data-toggle="tooltip" title="IFSC" data-placement="top">IFSC </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="ifsc" name="ifsc" placeholder="IFSC">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="branch" class="custom-label" data-toggle="tooltip" title="Branch" data-placement="top">Branch </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="branch" name="branch" placeholder="Branch">
            </div>
          </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="bic" class="custom-label" data-toggle="tooltip" title="BIC/Swift" data-placement="top">BIC/Swift </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="bic" name="bic" placeholder="BIC/Swift">
            </div>
          </div>
                                                            </div>
                                                        </div> 
                                                        <div class="row justify-content-center">
                                                        <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="iban" class="custom-label" data-toggle="tooltip" title="IBAN" data-placement="top">IBAN </label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="iban" name="iban" placeholder="IBAN">
            </div>
          </div>
                                                            </div>
                                                        </div>-->

                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                        ?>
            
<!-- <div class="row justify-content-center" style="margin-bottom: -14px;">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="customers.php">Cancel</a>
    </div>
</div> -->
            </div>
          </div>
</div>



</div>
<!-- <div class="row justify-content-center" style="margin-bottom: -14px;">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="customers.php">Cancel</a>
    </div>
</div> -->
  <?php
    include('navbottom.php');
    ?>
</form>

             
            </div>
          </div>

     
     
     
     
     
     
      <?php
      include('footer.php');
      ?>
    </div>
  
    </main>
    <script type="text/javascript">
    $(function(){
    $(".select2").select2({
        matcher: matchCustom,
        templateResult: formatCustom
    });
})

function stringMatch(term, candidate) {
    return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}

function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }
    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }
    // Match text of option
    if (stringMatch(params.term, data.text)) {
        return data;
    }
    // Match attribute "data-foo" of option
    if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
        return data;
    }
    // Return `null` if the term should not be displayed
    return null;
}

function formatCustom(state) {
    return $(
        '<div><div>' + state.text + '</div><div class="foo">'
            + $(state.element).attr('data-foo')
            + '</div></div>'
    );
}
</script>
 <?php
 include('fexternals.php');
 ?>
 <!-- gstrtype -->
 <script type="text/javascript">

$(document).ready(function () {
                                                                                   let element=document.getElementById('myBtn');
                                                                                   if (element.value == '') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
// $("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Regular') {
document.getElementById('gstblock').style.display = 'block';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Composition') {
document.getElementById('gstblock').style.display = 'block';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Unregistered Business') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Consumer') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Overseas') {
document.getElementById('placeofsupply').style.display = 'none';
document.getElementById('gstblock').style.display = 'none';
$("#pos").removeAttr("required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Special Economic Zone') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Deemed Export') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Tax Deductor') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'SEZ Developer') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
    // alert
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 4000);
 
});
</script>
<!-- salutation -->
<script type="text/javascript">
$("#salute").click(function(){
document.getElementById('drpsalute').classList.toggle("dropdownsalute");
});
</script>                             
<!-- unit cat sub                                            -->
                                                        <script type="text/javascript">
                                                            function andun() {
                                                                $(".select2-container--open .select2-dropdown--above").hide();
                                                                $(".select2-container--open .select2-dropdown--below").hide();
                                                             }
                                                             function andus() {
                                                                 $(".select2-container--open .select2-dropdown--above").show();
                                                                $(".select2-container--open .select2-dropdown--below").show();
                                                             }
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
                                                        </script>
                                                        <!-- same as billing -->
        <script type="text/javascript">
            function sameasbillingticaccess() {
                let showorhide = document.getElementById('sameasbilling');
                if (showorhide.checked==true) {
                    document.getElementById('totalshipadd').style.display = 'none';
                }
                else{
                    document.getElementById('totalshipadd').style.display = 'block';
                }
            }
            $(document).ready(function() {
                let showorhide = document.getElementById('sameasbilling');
                if (showorhide.checked==true) {
                    document.getElementById('totalshipadd').style.display = 'none';
                }
                else{
                    document.getElementById('totalshipadd').style.display = 'block';
                }
              });
        </script>
        <!-- taxpreference -->
                                                            <script type="text/javascript">
$(document).ready(function() {
  let noaccess = document.getElementById('taxprefnontaxable');
  let access = document.getElementById('taxpreftaxable');
  if (noaccess.checked == true) {
    document.getElementById('gstrtypesh').style.display='none';
  }
  if (access.checked == true) {
    document.getElementById('gstrtypesh').style.display='block';
  }
});
function gettaxable(){
  let noaccess = document.getElementById('taxprefnontaxable');
  let access = document.getElementById('taxpreftaxable');
  if (noaccess.checked == true) {
    document.getElementById('gstrtypesh').style.display='none';
  }
  else{
    document.getElementById('gstrtypesh').style.display='block';
  }
}
            </script>
            <!-- gstblock -->
                                                                            <script type="text/javascript">
        function showDiv(element)
{
    if (element.value == '') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
// $("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Regular') {
document.getElementById('gstblock').style.display = 'block';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Composition') {
document.getElementById('gstblock').style.display = 'block';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Unregistered Business') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Consumer') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Overseas') {
document.getElementById('placeofsupply').style.display = 'none';
document.getElementById('gstblock').style.display = 'none';
$("#pos").removeAttr("required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Special Economic Zone') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Deemed Export') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Tax Deductor') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'SEZ Developer') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
}
    </script>
 <script>
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
    </script>
    <script>
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
    </script>
    <script>
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
    </script>
    <script>
$("#myBtn").on("select2:open", function() { 
    $("#configureunits").hide();
});
$("#pos").on("select2:open", function() {
$("#configureunits").hide();
});
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
</script>
<script type="text/javascript">
  $(function() {
     $( "#unitname" ).autocomplete({
       source: 'unitsearch.php?type=unitname',
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






    
    <script>
    let lineNo = 2;
    $(document).ready(function() {
        $(".purchaseadd-row").click(function() {
            markup =
                '<tr><td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td><input type="text" name="pnm[]" id="pnm' +
                lineNo +
                '"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Phone Name"><td style="width:18%;"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Phone Number"></td><td><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
            tableBody = $("#purchasetable");
            tableBody.append(markup);
            renumber_table('#purchasetable');
            lineNo++;
        });
    });
    $('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchasetable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
    alert('Unable to Delete First row');
}
});
    function renumber_table(tableID) {
        $(tableID + " tr").each(function() {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').html(count);
        });
    }
    </script>
</body>

</html>