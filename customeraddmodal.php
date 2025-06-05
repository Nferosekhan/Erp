<?php
if (!isset($userid)) {
    include("lcheck.php");
}
$cussqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customers' order by id  asc");
$cusinfomainaccessuser=mysqli_fetch_array($cussqlismainaccessuser);
$cussqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customers' order by id  asc");
while($cusinfomainaccessfield=mysqli_fetch_array($cussqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $cusinfomainaccessfield['moduletype']);
    $cusadd = $cusinfomainaccessfield[21];
    $cusfieldadd = explode(',',$cusadd);
    $cusedit = $cusinfomainaccessfield[22];
    $cusfieldedit = explode(',',$cusedit);
    $cusview = $cusinfomainaccessfield[23];
    $cusfieldview = explode(',',$cusview);
}
                                ?>
                                <div id="callpagecust">
                                    <div class="modal fade" id="custAddNewCategory" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Category</h5>
<span type="button" onclick="funescategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="custcloseicon">&times;</span>
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
<input type="text" name="custcategorys" class="form-control form-control-sm mb-4" id="custmissingcategory" placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="button"  name="custsubmitcategory" value="Submit">
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
<div class="modal fade" id="custAddNewSubCategory" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="custexampleModalLabel">New Sub Category</h5>
<span type="button" onclick="funessubcategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="custcloseicon">&times;</span>
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
id="custmissingsubcategory" name="custmissingsubcategory"
placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button   onclick="funaddsubcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="button"  name="custsubmitsubcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funessubcategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<input type="hidden" name="custcustomercode" id="custcustomercode" value="">
<input type="hidden" name="custlandline" id="custlandline" value="">
<input type="hidden" name="custcstno" id="custcstno" value="">
<?php
// if ((in_array('Customer Information', $cusfieldadd))) {
?>
<div class="accordion" id="custaccordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="cusinfo">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#custinfo" aria-expanded="true" aria-controls="custinfo">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading"><?= $cusinfomainaccessuser['modulename'] ?> Information</a>
</div>
</button>
</h5>
<div id="custinfo" class="accordion-collapse collapse show" aria-labelledby="cusinfo">
<div class="accordion-body text-sm">
<?php
$sql = mysqli_query($con, "select count(customercode) from paircustomers where moduletype='Customers'");
$ans = mysqli_fetch_array($sql);
?>
<div class="row justify-content-center" <?=((in_array('Customer Id', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcustomerid" class="custom-label custvendorid" data-toggle="tooltip" title="<?= $cusinfomainaccessuser['modulename'] ?> ID" data-placement="top"><?= $cusinfomainaccessuser['modulename'] ?> ID</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custcustomerid" name="custcustomerid" placeholder="<?= $cusinfomainaccessuser['modulename'] ?> ID" readonly value="<?=$ans[0] + 1 ?>">
</div>
</div>
</div>
</div>
<?php
            $publicsqlcust=mysqli_query($con,"select count(publicid) from paircustomers where createdid='$companymainid' and moduletype='Customers'");
            $publicanscust=mysqli_fetch_array($publicsqlcust);
            $sqlismodulespublicnamecust=mysqli_query($con, "select * from pairmodules where moduletype='Customers' order by id  asc");
                                $infomodulespublicnamecust=mysqli_fetch_array($sqlismodulespublicnamecust);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Customer Public Id', $cusfieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-8">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="custpubliccode" class="custom-label"><?= $cusinfomainaccessuser['modulename'] ?> Id Public</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="custpubliccode" name="custpubliccode" readonly value="<?= $infomodulespublicnamecust['publiccolumn'] . $publicanscust[0]+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<?php
            $privatesqlcust=mysqli_query($con,"select count(privateid) from paircustomers where createdid='$companymainid' and moduletype='Customers' and franchisesession='".$_SESSION['franchisesession']."'");
            $privateanscust=mysqli_fetch_array($privatesqlcust);
            $sqlismainaccesspublicnamecust=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Customers' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
                                $infomainaccesspublicnamecust=mysqli_fetch_array($sqlismainaccesspublicnamecust);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Customer Private Id', $cusfieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-8">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="custprivatecode" class="custom-label"><?= $cusinfomainaccessuser['modulename'] ?> Id Private</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="custprivatecode" name="custprivatecode" readonly value="<?= $infomainaccesspublicnamecust['moduleprefix'] . $infomainaccesspublicnamecust['modulesuffix']+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<div class="row justify-content-center custhighfor" <?=((in_array('Primary Contact', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custpcontact" class="custom-label custprimarycontact" data-toggle="tooltip" title="Primary Contact">Primary Contact <span id="custname"></span></label>
</div>
<div class="col-sm-3 ali">
<input type="text" class="form-control  form-control-sm" id="custsalute" name="custsalute" placeholder="Salutation" >
<!-- style="width:93px;"  -->
<i class="fa fa-angle-down" id="custdrpsalute"></i>
</div>
<div class="col-sm-5 ali one">
<input type="text" class="form-control  form-control-sm" id="custpcontact" name="custpcontact" placeholder="Name" onchange="custcompanynames()" oninput="pco(this)">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Company Name', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcompanyname" class="custom-label custcompanyname" data-toggle="tooltip" title="Company Name" data-placement="top">Company Name</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custcompanyname" name="custcompanyname" placeholder="Company Name" onchange="custcompanynames()" maxlength="300">
</div>
</div>
</div>
</div>
<?php
// if ((in_array('Customer Display Name', $cusfieldadd))) {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcustomerdname" class="custom-label custdisplayname" data-toggle="tooltip" title="Display Name" data-placement="top"><span class="text-danger"> <?= $cusinfomainaccessuser['modulename'] ?></span></label><label class="custom-label custdisplayname" data-toggle="tooltip" title="Display Name" data-placement="top"><span class="text-danger">Name *</span></label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="custcustomerdname" name="custcustomerdname" placeholder="Display Name" required oninput="custnamech(this)">
<script type="text/javascript">
    function custnamech(modcustname) {
        let custnamefinal = document.getElementById("custoriginpage");
        let custcustomerdnameans = modcustname.value;
        let custcustomerdnameanslen = custcustomerdnameans.length;
        if (custcustomerdnameanslen>=0) {custnamefinal.value=custcustomerdnameans;}
    }
</script>
</div>
</div>
</div>
</div>
<?php
// }
?>
<div class="row justify-content-center" <?=((in_array('Category', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcategory" class="custom-label"><span
class="">Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="form-control  form-control-sm" name="custcategory" id="custcategory" >
<option selected disabled>Category</option>
<?php
$sqli = mysqli_query($con, "select * from paircategory where (createdid='$companymainid' or createdid='0') and itemmodule='Customers' and category!='' order by category asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?=$info['category'] ?>">
<?=$info['category'] ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Sub Category', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custsubcategory" class="custom-label"><span
class="">Sub Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="form-control form-control-sm" name="custsubcategory" id="custsubcategory">
<option selected disabled>Sub Category</option>
<?php
$sqli = mysqli_query($con, "select * from pairsubcategory where (createdid='$companymainid' or createdid='0') and itemmodule='Customers' and subcategory!='' order by subcategory asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?=$info['subcategory'] ?>">
<?=$info['subcategory'] ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Work Phone', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custworkphone" class="custom-label workphone" data-toggle="tooltip" title="Work Phone" data-placement="top">Work Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custworkphone" name="custworkphone" placeholder="Work Phone" maxlength="100">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Mobile Phone', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custmobilephone" class="custom-label mobilephone" data-toggle="tooltip" title="Mobile Phone" data-placement="top">Mobile Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custmobilephone" name="custmobilephone" placeholder="Mobile Phone" maxlength="100">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Email', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custemail" class="custom-label email" data-toggle="tooltip" title="Email" data-placement="top">Email</label>
</div>
<div class="col-sm-8 ali">
<input type="email" class="form-control  form-control-sm" id="custemail" name="custemail" placeholder="Email">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Website', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custwebsite" class="custom-label website" data-toggle="tooltip" title="Website" data-placement="top">Website</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custwebsite" name="custwebsite" placeholder="Website" maxlength="180">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Billing Address', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcustomername" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custbillstreet" id="custbillstreet"  placeholder="Street">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custbillcity" id="custbillcity" placeholder="City/Town">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Billing Address', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custbillstate" id="custbillstate" placeholder="State">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="custbillpincode" id="custbillpincode" min="0" placeholder="Pin">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custbillcountry" id="custbillcountry" placeholder="Country/Region">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Shipping Address', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcustomername" class="custom-label" id="custshipword">Shipping Address</label>
</div>
<div class="col-sm-8 shipadd" style="z-index:0;">
<div class="custom-control custom-checkbox" onclick="sameasbillingticaccess()">
<input type="checkbox" class="custom-control-input" name="custsameasbilling" id="custsameasbilling" checked>
<label class="custom-control-label custom-label" for="custsameasbilling"> Same as Billing Address</label>
</div>
</div>
</div>
</div>
</div>
<div id="custtotalshipadd">
<div class="row justify-content-center" <?=((in_array('Shipping Address', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custshipstreet" id="custshipstreet"  placeholder="Street">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custshipcity" id="custshipcity" placeholder="City/Town">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Shipping Address', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custshipstate" id="custshipstate" placeholder="State">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="custshippincode" id="custshippincode" min="0" placeholder="Pin">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custshipcountry" id="custshipcountry" placeholder="Country/Region">
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
// }
?>
<div class="accordion" id="custaccordionRental" <?=((in_array('Customers Visibility', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="accordion-item mb-1 pvi">
<h5 class="accordion-header" id="custheadingfour">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#custcollapsefour"
aria-expanded="true" aria-controls="custcollapsefour">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading"><?= $cusinfomainaccessuser['modulename'] ?> Visibility</a>
</div>
</button>
</h5>
<div id="custcollapsefour" class="accordion-collapse collapse show"
aria-labelledby="custheadingfour">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label mt-2 text-danger custvis">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
</div>
<div class="col-sm-8">
<div class="row">
<div class="col-sm-6 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="custvisibility" id="custvisibilitypublic" value="PUBLIC" <?=($cusinfomainaccessuser['customervisible']=='PUBLIC')?'checked':''?> onclick="custvischeck()">
<label class="custom-control-label custom-label" for="custvisibilitypublic">Public</label>
</div>
</div>
<div class="col-sm-6 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="custvisibility" id="custvisibilityprivate" value="PRIVATE" <?=($cusinfomainaccessuser['customervisible']=='PRIVATE')?'checked':''?> onclick="custvischeck()">
<label class="custom-control-label custom-label" for="custvisibilityprivate">Private</label>
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
<script type="text/javascript">
    $(document).ready(function() {
        let public = document.getElementById("custvisibilitypublic");
        let private = document.getElementById("custvisibilityprivate");
        let answer = document.getElementById("custvisibility");
        if (public.checked==true) {
            answer.value="PUBLIC";
        }
        else{
            answer.value="PRIVATE";
        }
    });
    function custvischeck() {
        let public = document.getElementById("custvisibilitypublic");
        let private = document.getElementById("custvisibilityprivate");
        let answer = document.getElementById("custvisibility");
        if (public.checked==true) {
            answer.value="PUBLIC";
        }
        else{
            answer.value="PRIVATE";
        }
    }
</script>
<input type="hidden" id="custvisibility" value="PUBLIC">
<div class="accordion" id="accordionRental" <?=((in_array('Tax Information', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="custheadingFive">
<button class="accordion-button font-weight-bold" type="button"
data-bs-toggle="collapse" data-bs-target="#custcollapseFive"
aria-expanded="true" aria-controls="custcollapseFive">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Tax
Information</a>
</div>
</button>
</h5>
<div id="custcollapseFive" class="accordion-collapse collapse show"
aria-labelledby="custheadingFive">
<div class="accordion-body text-sm">
<div class="row justify-content-center" <?=((in_array('Tax Preference', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label custtaxpre" for="custinlineRadio3">Tax Preference*</label>
</div>
<div class="col-sm-8">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio"
name="custtaxpref" id="custtaxpref" value="0" checked
onclick="gettaxable()">
<label class="form-check-label"
for="custtaxpref">Taxable</label>
</div>
</div>
</div>
</div>
</div>
<div id="custgstrtypesh">
<div class="row justify-content-center" <?=((in_array('GST Registration Type', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label text-danger" for="custinlineRadio3">GST Registration Type *</label>
</div>
<div class="col-sm-8">
<select class="selectpicker form-control select2" data-live-search="true" title="Search title or description..." onchange="showDiv(this)" id="custgstrtype" name="custgstrtype" <?=((in_array('GST Registration Type', $cusfieldadd))?'required':'')?>>
<option <?=($cusinfomainaccessuser['gsttypecus']=='manual')?'selected':'';?> value="" data-foo="Select Type of Add" disabled>Select Type of Add</option>

                                                                                    <option data-foo="Business that is registered under GST" value="Registered Business - Regular" <?=($cusinfomainaccessuser['gsttypecus']=='Registered Business - Regular')?'selected':'';?>>Registered Business - Regular</option>

                                                                                    <option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition" <?=($cusinfomainaccessuser['gsttypecus']=='Registered Business - Composition')?'selected':'';?>>Registered Business - Composition</option>

                                                                                    <option data-foo="Business that has not been registered under GST" value="Unregistered Business" <?=($cusinfomainaccessuser['gsttypecus']=='Unregistered Business')?'selected':'';?>>Unregistered Business</option>

                                                                                    <option data-foo="A customer who is a regular consumer" value="Consumer" <?=($cusinfomainaccessuser['gsttypecus']=='Consumer')?'selected':'';?>>Consumer</option>

                                                                                    <option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas" <?=($cusinfomainaccessuser['gsttypecus']=='Overseas')?'selected':'';?>>Overseas</option>

                                                                                    <option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone" <?=($cusinfomainaccessuser['gsttypecus']=='Special Economic Zone')?'selected':'';?>>Special Economic Zone</option>

                                                                                    <option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export" <?=($cusinfomainaccessuser['gsttypecus']=='Deemed Export')?'selected':'';?>>Deemed Export</option>

                                                                                    <option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor" <?=($cusinfomainaccessuser['gsttypecus']=='Tax Deductor')?'selected':'';?>>Tax Deductor</option>

                                                                                    <option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer" <?=($cusinfomainaccessuser['gsttypecus']=='SEZ Developer')?'selected':'';?>>SEZ Developer</option>
</select>
</div>
</div>
</div>
</div>
<div id="custgstblock">
<div class="row justify-content-center" <?=((in_array('GSTIN or UIN', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label text-danger" for="custgstin">GSTIN / UIN *</label>
</div>
<div class="col-sm-8">
<input type="text" name="custgstin" placeholder="GSTIN / UIN" id="custgstin" class="form-control form-control-sm">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Business Legal Name', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="custbln">Business Legal Name</label>
</div>
<div class="col-sm-8">
<input type="text" name="custbln" placeholder="Business Legal Name" id="custbln" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Business Trade Name', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="custbtname">Business Trade Name</label>
</div>
<div class="col-sm-8">
<input type="text" name="custbtname" placeholder="Business Trade Name" id="custbtname" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Pan', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="custpan">PAN</label>
</div>
<div class="col-sm-8">
<input type="text" name="custpan" placeholder="PAN" id="custpan" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
<div id="custplaceofsupply">
<div class="row justify-content-center" <?=((in_array('Place Of Supply', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label text-danger" for="custpos">Place Of Supply *</label>
</div>
<div class="col-sm-8">
<select name="custpos" id="custpos" class="select4 form-control form-control-sm" <?=((in_array('Place Of Supply', $cusfieldadd))?'required':'')?>>
<option disabled value="" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=='manual'||'auto')?'selected':''?>>Select The Place</option> 
<option value="JAMMU AND KASHMIR (1)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($cusinfomainaccessuser['placeofsupplydefaultcus']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental" style="margin-top: 15px; <?=((in_array('Other Information', $cusfieldadd))?'':'display:none;')?>">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="custothercollapses">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#custothercollapse" aria-expanded="true" aria-controls="custothercollapse">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Other Information</a>
</div>
</button>
</h5>
<div id="custothercollapse" class="accordion-collapse collapse show" aria-labelledby="custothercollapses">
<div class="accordion-body text-sm">
<div class="row justify-content-center" <?=((in_array('DL dot No dot or 20', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="custdlt" class="custom-label" data-toggle="tooltip" title="DL.NO./20" data-placement="top">DL.NO./20 </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="custdlt" name="custdlt" placeholder="DL.NO./20">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('DL dot No dot or 21', $cusfieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="custdlo" class="custom-label" data-toggle="tooltip" title="DL.NO./21" data-placement="top">DL.NO./21 </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="custdlo" name="custdlo" placeholder="DL.NO./21">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
                                    <script type="text/javascript">
                                        $('.select2-field').select2({
        tags: "true"
    });
$(function(){
$("#custgstrtype").select2({
matcher: matchCustom,
templateResult: formatCustom
});
$("#custcategory").select2({
matcher: matchCustom
});
$("#custsubcategory").select2({
matcher: matchCustom
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
                                        $("#custgstrtype").on("select2:open", function() {
$("#configureunits").hide();
});
$("#custsubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewSubCategory");
});
$("#custsubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#custcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewCategory");
});
$("#custcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Category";
});
$("#custpos").on("select2:open", function() {
$("#configureunits").hide();
});
$('.select4').select4();
function sameasbillingticaccess() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
showorhide.value='1';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
showorhide.value='0';
}
}
$(document).ready(function() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
});
                                    </script>
</div>