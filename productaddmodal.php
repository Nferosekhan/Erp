<?php
if (!isset($userid)) {
    include("lcheck.php");
}
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
$prosqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Products' order by id  asc");
$proinfomainaccessuser=mysqli_fetch_array($prosqlismainaccessuser);
$sqlgetcur=mysqli_query($con,"select * from paircurrency");
$rowcur=mysqli_fetch_array($sqlgetcur);
$anscur=$rowcur['currencysymbol'];
$rescurrency=explode('-',$anscur);
?>
<div id="callpagepro">
    <!----------------------------------------------- pro cat sub unit modal start --------------------------->
<!----------------------------------------------- Start AddNewDefaultUnit modal ---------------------------->
<div class="modal fade" id="proAddNewDefaultUnit" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Units</h5>
<span type="button" onclick="profunesdefaultunit()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form  action="" method="post" role="form">
<div class="row justify-content-center">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group row" id="prounitsindes">
<label for="proUnit" class="custom-label text-danger"><span
class="">Unit *</span></label>
</div>
<input type="text" class="form-control  form-control-sm"
id="promissingdefaultunit" name="promissingdefaultunit"
placeholder="Unit" required>
</div>
<div class="col-md-7 unitmod">
<div class="form-group row" id="prounitsindes">
<label for="proUnit" class="custom-label text-danger" id="prouqcindes"><span>
Unique Quanty Code(UQC) *</span></label>
</div>
<div class="form-group row">
<input type="text" class="form-control  form-control-sm" id="prouqc"
name="prouqc" placeholder="Unique Quanty Code(UQC)" required>
</div>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer mfsub" style="margin-bottom: 0px !important;margin-top: 30px !important;">
<div class="col">
<button   onclick="profunadddefaultunit()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="button"  name="prosubmitunit" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="profunesdefaultunit()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!------------------------------------ End AddNewDefaultUnit modal ------------------------------------>
<!------------------------------------ Start AddNewCategory modal ------------------------------------>
<div class="modal fade" id="proAddNewCategory" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New <?=$access['txtnamecategory']?></h5>
<span type="button" onclick="profunescategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
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
<input type="text" name="procategory" class="form-control form-control-sm mb-4" id="promissingcategory" placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer ">
<div class="col">
<button   onclick="profunaddcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="button"  name="prosubmitcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="profunescategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!-- </form> -->
<!------------------------------------ End AddNewCategory modal ------------------------------------>
<!------------------------------------ Start AddNewSubCategory modal ------------------------------------>
<div class="modal fade" id="proAddNewSubCategory" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="proexampleModalLabel">New Sub Category</h5>
<span type="button" onclick="profunessubcategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
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
id="promissingsubcategory" name="promissingsubcategory"
placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button   onclick="profunaddsubcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="button"  name="prosubmitsubcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="profunessubcategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!-- </form> -->
<!------------------------------------- End AddNewSubCategory modal ------------------------------------->
<!------------------------------------- pro cat sub unit modal end ------------------------------------->
<?php
 // if ((in_array('Product Information', $profieldadd))) {
?>
<div class="accordion" id="proaccordionRental" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingOne">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#procollapseOne"
aria-expanded="true" aria-controls="procollapseOne">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading"> <?= $proinfomainaccessuser['modulename'] ?> Information</a>
</div>
</button>
</h5>
<div id="procollapseOne" class="accordion-collapse collapse show"
aria-labelledby="proheadingOne">
<div class="accordion-body text-sm">
<?php
$sql=mysqli_query($con,"select count(productcode) from pairproducts where itemmodule='Products'");
$ans=mysqli_fetch_array($sql);
?>
<div class="row justify-content-center" <?=((in_array('Product Code', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="proproductcode" class="custom-label"><?= $proinfomainaccessuser['modulename'] ?> Code</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="proproductcode" name="proproductcode" readonly value="<?= $ans[0]+1 ?>">
</div>
</div>
</div>
</div>
<?php
            $publicsqlpro=mysqli_query($con,"select count(publicid) from pairproducts where createdid='$companymainid' and itemmodule='Products'");
            $publicanspro=mysqli_fetch_array($publicsqlpro);
            $sqlismodulespublicnamepro=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
                                $infomodulespublicnamepro=mysqli_fetch_array($sqlismodulespublicnamepro);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Product Public Code', $profieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-8">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="propubliccode" class="custom-label"><?= $proinfomainaccessuser['modulename'] ?> Code Public</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="propubliccode" name="propubliccode" readonly value="<?= $infomodulespublicnamepro['publiccolumn'] . $publicanspro[0]+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<?php
            $privatesqlpro=mysqli_query($con,"select count(privateid) from pairproducts where createdid='$companymainid' and itemmodule='Products' and franchisesession='".$_SESSION['franchisesession']."'");
            $privateanspro=mysqli_fetch_array($privatesqlpro);
            $sqlismainaccesspublicnamepro=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Products' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
                                $infomainaccesspublicnamepro=mysqli_fetch_array($sqlismainaccesspublicnamepro);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Product Private Code', $profieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-8">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="proprivatecode" class="custom-label"><?= $proinfomainaccessuser['modulename'] ?> Code Private</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="proprivatecode" name="proprivatecode" readonly value="<?= $infomainaccesspublicnamepro['moduleprefix'] . $infomainaccesspublicnamepro['modulesuffix']+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<?php
 // if ((in_array('Name', $profieldadd))) {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="proproductname" class="custom-label"><span
class="text-danger">Name
*</span></label>
</div>
<div class="col-sm-8">
<input type="text"
class="form-control  form-control-sm"
id="proproductname" name="proproductname"
placeholder="Name" required oninput="pronamech(this)">
<script type="text/javascript">
    function pronamech(modproname) {
        let pronamefinal = document.getElementById("prooriginpage");
        let propronameans = modproname.value;
        let propronameanslen = propronameans.length;
        if (propronameanslen>=0) {pronamefinal.value=propronameans;}
    }
</script>
<input type="text" id="ppp" style="display: none;">
</div>
</div>
</div>
</div>
<?php
// }
?>
<div class="row justify-content-center" <?=((in_array('Code or Tags', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="procodetags" class="custom-label"><span
class="">Code / Tags</span></label>
</div>
<div class="col-sm-8">
<input type="text"
class="form-control  form-control-sm"
id="procodetags" name="procodetags"
placeholder="Code / Tags">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Unit', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="proUnit" class="custom-label"><span
class="text-danger">Unit * <svg data-toggle="tooltip" title="The product will be measured in terms of this unit (e.g.: kg, dozen)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
</div>
<div class="col-sm-8" id="prouck" onclick="andus()">
<select class="form-control  form-control-sm" name="prodefaultunit" id="prodefaultunit" <?=((in_array('Unit', $profieldadd))?'required':'')?>>
<option selected disabled value="">Unit</option>
<?php
$sqlis = mysqli_query($con, "select uqc, unitname from pairunits where (createdid='$companymainid' or createdid='0') and (franchisesession='".$_SESSION["franchisesession"]."' or franchisesession='0') and (itemmodule='Products' or itemmodule='0') group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
<option value="<?= $infos['unitname']?>,<?=$infos['uqc'] ?>">
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
<div class="row justify-content-center" <?=((in_array('HSN Code', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prohsncode" class="custom-label"><span
class="">HSN Code</span></label>
</div>
<div class="col-sm-8">
<input type="text"
class="form-control  form-control-sm"
id="prohsncode" name="prohsncode"
placeholder="HSN Code" maxlength="100">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Category', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="procategory" class="custom-label"><span
class=""><?=$access['txtnamecategory']?></span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select class="form-control  form-control-sm" name="procategory" id="procategory">
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
<div class="row justify-content-center" <?=((in_array('Sub Category', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prosubcategory" class="custom-label"><span class="">Sub Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select class="form-control form-control-sm" name="prosubcategory" id="prosubcategory">
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
<div class="row justify-content-center" <?=((in_array('Rack', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prorack" class="custom-label"><span
class="">Rack</span></label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="prorack" name="prorack" placeholder="Rack">
</div>
</div>
</div>
</div>
<div class="row justify-content-center deltophead" <?=((in_array('Delivery', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label">Delivery</label>
</div>
<div class="col-sm-8">
<input type="text" name="prodelivery" class="form-control  form-control-sm" id="prodelinpbrd" placeholder="Delivery">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Description', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prodescription" class="custom-label"><span
class="">Description</span></label>
</div>
<div class="col-sm-8">
<textarea
class="form-control" id="prodescription"
name="prodescription" placeholder="Description"></textarea>
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
<div class="accordion" id="proaccordionRental" <?=((in_array('Product Visibility', $profieldadd))?'':'style="display:none;"')?>>
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingfour">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#procollapsefour"
aria-expanded="true" aria-controls="procollapsefour">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading"><?= $proinfomainaccessuser['modulename'] ?> Visibility</a>
</div>
</button>
</h5>
 <div id="procollapsefour" class="accordion-collapse collapse show" aria-labelledby="proheadingfour">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-8">
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
<input type="radio" class="custom-control-input" name="provisibility" id="provisibilitypublic" value="PUBLIC" <?=($proinfomainaccessuser['productvisible']=='PUBLIC')?'checked':''?> onclick="provischeck()">
<label class="custom-control-label custom-label" for="provisibilitypublic">Public</label>
</div>
</div>
<div class="col-sm-6 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="provisibility" id="provisibilityprivate" value="PRIVATE" <?=($proinfomainaccessuser['productvisible']=='PRIVATE')?'checked':''?> onclick="provischeck()">
<label class="custom-control-label custom-label" for="provisibilityprivate">Private</label>
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
        let public = document.getElementById("provisibilitypublic");
        let private = document.getElementById("provisibilityprivate");
        let answer = document.getElementById("provisibility");
        if (public.checked==true) {
            answer.value="PUBLIC";
        }
        else{
            answer.value="PRIVATE";
        }
    });
    function provischeck() {
        let public = document.getElementById("provisibilitypublic");
        let private = document.getElementById("provisibilityprivate");
        let answer = document.getElementById("provisibility");
        if (public.checked==true) {
            answer.value="PUBLIC";
        }
        else{
            answer.value="PRIVATE";
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        let proean13 = document.getElementById("proean13");
        let proupca = document.getElementById("proupca");
        let procode39 = document.getElementById("procode39");
        let proitf = document.getElementById("proitf");
        let answerprobarcodeformat = document.getElementById("probarcodeformat");
        if (proean13.checked==true) {
            answerprobarcodeformat.value="EAN / UPC";
        }
        else if (proupca.checked==true){
            answerprobarcodeformat.value="EAN / UPC";
        }
        else if (procode39.checked==true){
            answerprobarcodeformat.value="CODE39";
        }
        else if (proitf.checked==true){
            answerprobarcodeformat.value="ITF";
        }
    });
    function probarcodeformatcheck() {
        let proean13 = document.getElementById("proean13");
        let proupca = document.getElementById("proupca");
        let procode39 = document.getElementById("procode39");
        let proitf = document.getElementById("proitf");
        let answerprobarcodeformat = document.getElementById("probarcodeformat");
        if (proean13.checked==true) {
            answerprobarcodeformat.value="EAN / UPC";
        }
        else if (proupca.checked==true){
            answerprobarcodeformat.value="EAN / UPC";
        }
        else if (procode39.checked==true){
            answerprobarcodeformat.value="CODE39";
        }
        else if (proitf.checked==true){
            answerprobarcodeformat.value="ITF";
        }
    }
</script>
<input type="hidden" id="provisibility" value="PUBLIC">
<input type="hidden" id="probarcodeformat" value="EAN / UPC">


                                    <div class="accordion" id="accordionRental" <?=((in_array('Barcode Information', $profieldadd))?'':'style="display:none;"')?>>
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
                                                    <div class="row justify-content-center" <?=((in_array('Barcode Title', $profieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="probarcodetitle" class="custom-label"><span
                                                                            class="">Barcode Title</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="probarcodetitle" name="probarcodetitle"
                                                                        placeholder="Barcode Title">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Barcode Subtitle', $profieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="probarcodehead" class="custom-label"><span
                                                                            class="">Barcode Subtitle</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="probarcodehead" name="probarcodehead"
                                                                        placeholder="Barcode Subtitle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Barcode Type', $profieldadd))?'':'style="display:none;"')?>>
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
                                                                        <input type="radio" class="custom-control-input" name="probarcodeformat" id="proean13" value="EAN / UPC" onclick="probarcodeformatcheck()">
                                                                        <label class="custom-control-label custom-label" for="proean13">EAN-13</label>
                                                                      </div>
                                                                      </div>
                                                                      <div class="col-sm-6 my-1">
                                                                      <div class="custom-control custom-radio mr-sm-2">
                                                                        <input type="radio" class="custom-control-input" name="probarcodeformat" id="proupca" value="EAN / UPC" onclick="probarcodeformatcheck()">
                                                                        <label class="custom-control-label custom-label" for="proupca">UPC-A</label>
                                                                      </div>
                                                                      </div>
                                                                      <div class="col-sm-6 my-1">
                                                                      <div class="custom-control custom-radio mr-sm-2">
                                                                        <input type="radio" class="custom-control-input" name="probarcodeformat" id="procode39" value="CODE39" checked onclick="probarcodeformatcheck()">
                                                                        <label class="custom-control-label custom-label" for="procode39">Code-39</label>
                                                                      </div>
                                                                      </div>
                                                                      <div class="col-sm-6 my-1">
                                                                      <div class="custom-control custom-radio mr-sm-2">
                                                                        <input type="radio" class="custom-control-input" name="probarcodeformat" id="proitf" value="ITF" onclick="probarcodeformatcheck()">
                                                                        <label class="custom-control-label custom-label" for="proitf">ITF</label>
                                                                      </div>
                                                                      </div>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Barcode', $profieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="probarcode" class="custom-label"><span
                                                                            class="">Barcode</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="probarcode" name="probarcode"
                                                                        placeholder="Barcode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Under Barcode Label', $profieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="prounderbarcodelabel" class="custom-label"><span
                                                                            class="">Under Barcode Label</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="prounderbarcodelabel" name="prounderbarcodelabel"
                                                                        placeholder="Under Barcode Label">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" <?=((in_array('Footer Note', $profieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="probarcodenotes" class="custom-label"><span
                                                                            class="">Footer Note</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="probarcodenotes" name="probarcodenotes"
                                                                        placeholder="Footer Note">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

<div class="accordion" id="proaccordionRental" <?=((in_array('Sales Information', $profieldadd))?'':'style="display:none;"')?>>
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingsale">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#procollapsesale" aria-expanded="true" aria-controls="procollapsesale">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">
<?php
      $sqlismainaccesssale=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Sales' order by id  asc");
      $infomainaccesssale=mysqli_fetch_array($sqlismainaccesssale);
?>
<?= $infomainaccesssale['groupname'] ?> Information</a>
</div>
</button>
</h5>
<div id="procollapsesale" class="accordion-collapse collapse show"
aria-labelledby="proheadingsale">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="table-responsive" <?=(((in_array('Sale Price Name', $profieldadd))||(in_array('Sale MRP', $profieldadd))||(in_array('Sale Price Rate', $profieldadd))||(in_array('Sale Description', $profieldadd)))?'':'style="display:none;"')?>>
<table class="table table-bordered" id="prosaletable">
<thead>
<tr><td class="text-uppercase" id="profirstclsale"><span id="protdfsize"></span></td>
<td class="text-uppercase" id="prosecondclsale" <?=((in_array('Sale Price Name', $profieldadd))?'':'style="display:none;"')?>><span id="protdfsize">PRICE NAME</span></td>
<td class="text-uppercase" id="prothirdclsale" <?=((in_array('Sale MRP', $profieldadd))?'':'style="display:none;"')?>><span id="protdfsize">MRP</span> <svg version="1.1" id="proproLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
<path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
<path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
<svg></td>
<td class="text-uppercase" id="profourthclsale" <?=((in_array('Sale Price Rate', $profieldadd))?'':'style="display:none;"')?>><span id="protdfsize">PRICE/RATE</span> <svg version="1.1" id="proproLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
<path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
<path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
<svg></td>
<td class="text-uppercase" id="profifthclsale" <?=((in_array('Sale Description', $profieldadd))?'':'style="display:none;"')?>><span id="protdfsize">DESCRIPTION</span></td>
<td class="text-uppercase" id="prosixthclsale"><span id="protdfsize"></span></td></tr>
</thead>
<tbody>
<tr>
<td data-label=""><svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" ><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="PRICE NAME" <?=((in_array('Sale Price Name', $profieldadd))?'':'style="display:none;"')?>><input type="hidden" name="proproductid[]" id="proproductid1"><input type="text" name="propricename[]" id="proproductname1" class="form-control form-control-sm totaldesign  bordernoneinput bor"  oninput="title(this)" data-toggle="tooltip" title="" placeholder="Sale Price or Trade Price or Wholesale Price"></td>
<td data-label="MRP" <?=((in_array('Sale MRP', $profieldadd))?'':'style="display:none;"')?>>
  <div><?php echo $rescurrency[0]; ?>
<input type="age" min="0" name="promrp[]" id="proquantity1" class="bordernoneinput bor"  onChange="productcalc(1)" placeholder="0.00"></div>
</td>
<td data-label="SELLING PRICE" <?=((in_array('Sale Price Rate', $profieldadd))?'':'style="display:none;"')?>>
<div><?php echo $rescurrency[0]; ?>
<input  placeholder="0.00" type="age" min="0" name="prosellingprice[]"  id="proproductrate1" class="bordernoneinput rup bor" onChange="productcalc(1)"></div></td>
<td data-label="DESCRIPTION" <?=((in_array('Sale Description', $profieldadd))?'':'style="display:none;"')?>><input type="text" min="0" name="prodescriptions[]" id="provat1" class="form-control form-control-sm totaldesign  bordernoneinput bor"></td>
<td data-label=""><a onclick="addclick()" id="prointusymbol"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="proPath"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="proOval-1"></path></svg> </a><a class="btn-deletes" id="prointusymbol"><img src="assets/img/delete-row.png" width="15" height="15" id="proimgintusymbol"></a></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="accordion" id="proaccordionRental" <?=((in_array('Purchase Information', $profieldadd))?'':'style="display:none;"')?>>
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingpurchase">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#procollapsepurchase" aria-expanded="true" aria-controls="procollapsepurchase">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">
<?php
      $sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Purchase' order by id  asc");
      $infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
?>
<?= $infomainaccesspurchase['groupname'] ?> Information</a>
</div>
</button>
</h5>
<div id="procollapsepurchase" class="accordion-collapse collapse show"
aria-labelledby="proheadingpurchase">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
 <div class="table-responsive" <?=(((in_array('Purchase Price Name', $profieldadd))||(in_array('Purchase MRP', $profieldadd))||(in_array('Purchase Price Rate', $profieldadd))||(in_array('Purchase Description', $profieldadd)))?'':'style="display:none;"')?>>
  <table class="table table-bordered" id="propurchasetable">
<thead>
<tr><td class="text-uppercase" id="profirstclsale"><span id="protdfsize"></span></td>
 <td class="text-uppercase" id="prosecondclsale" <?=((in_array('Purchase Price Name', $profieldadd))?'':'style="display:none;"')?>><span id="protdfsize">PRICE NAME</span></td>
 <td class="text-uppercase" id="prothirdclsale" <?=((in_array('Purchase MRP', $profieldadd))?'':'style="display:none;"')?>><span id="protdfsize">MRP</span> <svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
 <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
 <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
 <svg></td>
<td class="text-uppercase" id="profourthclsale" <?=((in_array('Purchase Price Rate', $profieldadd))?'':'style="display:none;"')?>><span id="protdfsize">PRICE/RATE</span> <svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
 <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
 <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
 <svg></td>
<td class="text-uppercase" id="profifthclsale" <?=((in_array('Purchase Description', $profieldadd))?'':'style="display:none;"')?>><span id="protdfsize">DESCRIPTION</span></td>
 <td class="text-uppercase" id="prosixthclsale"><span id="protdfsize"></span></td></tr>
</thead>
<tbody>
<tr>
<td data-label=""><svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="PRICE NAME" <?=((in_array('Purchase Price Name', $profieldadd))?'':'style="display:none;"')?>><input type="hidden" name="proproductid[]" id="purproproductid1"><input type="text" name="propricenamepur[]" id="purproproductname1" class="form-control form-control-sm totaldesign  bordernoneinput bor" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Purchase Price or Trade Price or Wholesale Price"></td>
<td data-label="MRP" <?=((in_array('Purchase MRP', $profieldadd))?'':'style="display:none;"')?>>
  <div><?php echo $rescurrency[0]; ?>
<input type="age" min="0" name="promrppur[]" id="purproquantity1" class="bordernoneinput bor" onChange="productcalc(1)" placeholder="0.00"></div>
</td>
<td data-label="SELLING PRICE" <?=((in_array('Purchase Price Rate', $profieldadd))?'':'style="display:none;"')?>>
<div><?php echo $rescurrency[0]; ?>
<input  placeholder="0.00" type="age" min="0" name="prosellingpricepur[]"  id="purproproductrate1" class="bordernoneinput rup bor" onChange="productcalc(1)"></div></td>
<td data-label="DESCRIPTION" <?=((in_array('Purchase Description', $profieldadd))?'':'style="display:none;"')?>><input type="text" min="0" name="prodescriptionspur[]" id="purprovat1" class="form-control form-control-sm totaldesign  bordernoneinput bor"></td>
<td data-label=""><a onclick="addclick()" id="prointusymbol"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="proPath"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="proOval-1"></path></svg> </a><a class="btn-deletes" id="prointusymbol"><img src="assets/img/delete-row.png" width="15" height="15" id="proimgintusymbol"></a></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="accordion" id="proaccordionRental" <?=((in_array('Tax Information', $profieldadd))?'':'style="display:none;"')?>>
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingFive">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#procollapseFive"
aria-expanded="true" aria-controls="procollapseFive">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Tax Information</a>
</div>
</button>
</h5>
<div id="procollapseFive" class="accordion-collapse collapse show" aria-labelledby="proheadingFive">
<div class="accordion-body text-sm">
<div class="row justify-content-center" <?=((in_array('Tax Preference', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label mt-2 text-danger">Tax Preference *</label>
</div>
<div class="col-sm-8">
<div class="row">
<div class="col-lg-5 my-1" style="z-index: 0;">
<div class="custom-control custom-radio mr-sm-2" onclick="taxable()">
<input type="radio" class="custom-control-input" name="protaxable" id="protaxable" value="1" checked>
<label class="custom-control-label custom-label" for="protaxable">Taxable</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="protaxablediv">
<div class="row justify-content-center" id="protaxprefer" <?=((in_array('Tax Rate', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="protaxratecountry" class="custom-label"><span class="">Tax Rate</span></label>
</div>
<div class="col-sm-8">
<div class="input-group mb-3 input-group-sm" id="proflagicon">
<div class="input-group-prepend">
<span class="input-group-text" id="proflagimg">
<img src="assets/img/Indian-Flag.png" width="25" height="20"></span>
</div>
<?php
$country=mysqli_query($con,"select * from paricountry");
$india=mysqli_fetch_array($country);
?>
<input type="text" class="country" id="protaxratecountry" name="protaxratecountry" value="<?= $india['country'] ?>" readonly style="width: 60px !important;">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" id="prointrahead" <?=((in_array('Intra State Tax Rate', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prointratax"
class="custom-label"><span
class="" style="border-bottom: 1px dashed grey;">Intra State
Tax Rate</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="select4 form-control form-control-sm"
name="prointratax" id="prointratax"
required>
<option selected disabled>Select</option>
<?php
$count=1;
$sqlit=mysqli_query($con, "select * from pairtaxrates where taxgroups!=''and (createdid='$companymainid' or createdid='0') order by tax asc");
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
</div>
</div>
</div>
</div>
<div class="row justify-content-center" id="prointrahead" <?=((in_array('Inter State Tax Rate', $profieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prointertax" class="custom-label"><span class="" style="border-bottom: 1px dashed grey;">Inter State Tax Rate</span></label>
</div>
<div class="col-sm-8">
<select class="select4 form-control form-control-sm" name="prointertax" id="prointertax" required>
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
                                        $('.select2-field').select2({
        tags: "true"
    });
$(function(){
$("#custgstrtype").select2({
matcher: matchCustom,
templateResult: formatCustom
});
$("#prodefaultunit").select2({
matcher: matchCustom
});
$("#procategory").select2({
matcher: matchCustom
});
$("#prosubcategory").select2({
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
if($(state.element).attr('data-receivable')=="")
{
return $(
'<div><div>' + state.text + '</div></div>'
);
}
else
{
if($(state.element).attr('data-receivable')=="0")
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:green">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
else
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:red">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
}
}
 $("#prointratax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prointertax").on("select2:open", function() {
$("#configureunits").hide();
});
$('.select4').select4();
$("#prosubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewSubCategory");
});
$("#prosubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#procategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewCategory");
});
$("#procategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New <?=$access['txtnamecategory']?>";
});
$("#prodefaultunit").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewDefaultUnit");
});
$("#prodefaultunit").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Unit";
});
                                    </script>
                                    <?php
                                    if ($current_file_name=='invoiceadd.php'||$current_file_name=='salesreturnadd.php'||$current_file_name=='billadd.php'||$current_file_name=='purchasereturnadd.php') {
                                        ?>
                                        <script type="text/javascript">
                    $(document).ready(function() {
                        window.onresize = function (event) {
  applyOrientation();
}
let modaltriggercheck = document.getElementById("triggerconfirm-adddelete");
if (modaltriggercheck.classList.contains('show')) {
    $(".finalsubmitrequired").attr("required","required");
                }
                else{
                    $(".finalsubmitrequired").removeAttr("required");
                }
function applyOrientation() {
                        if (window.innerHeight >= window.innerWidth) {
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
                        var taxabledesign = document.getElementsByClassName('taxabledesign'); 
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }

                        if (window.innerHeight <= window.innerWidth) {
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
                        var taxabledesign = document.getElementsByClassName('taxabledesign');
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }
}
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
var taxabledesign = document.getElementsByClassName('taxabledesign');
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
});
var x = window.matchMedia("(max-width: 991px)");
myFunction(x);
x.addListener(myFunction);
                </script>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <script type="text/javascript">
                    $(document).ready(function() {
                        window.onresize = function (event) {
  applyOrientation();
}
function applyOrientation() {
                        if (window.innerHeight >= window.innerWidth) {
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
                        var taxabledesign = document.getElementsByClassName('taxabledesign'); 
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }

                        if (window.innerHeight <= window.innerWidth) {
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
                        var taxabledesign = document.getElementsByClassName('taxabledesign');
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }
}
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
var taxabledesign = document.getElementsByClassName('taxabledesign');
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
});
var x = window.matchMedia("(max-width: 991px)");
myFunction(x);
x.addListener(myFunction);
                </script>
                                        <?php
                                    }
                                    ?>
</div>