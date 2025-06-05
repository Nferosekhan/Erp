<?php
include('lcheck.php');
if (isset($_GET['term'])&&$_GET['type']=='scroll') {
$count=1;
$sqli=mysqli_query($con, "select t1.category,t1.itemmodule,t1.productname,t1.id,t2.quantity AS openingstock,t2.batch,t2.expdate,t2.quantity from pairproducts t1,pairbatch t2 where t1.createdid='$companymainid' and ((t1.franchisesession='".$_SESSION["franchisesession"]."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and t1.itemmodule='Products' and t2.productid=t1.id order by t1.productname asc limit ".$_GET['term'].",15");
while($info=mysqli_fetch_array($sqli))
{
?>
    <div class="row hovthepro greycoltxthead ticoruntic" id="<?=$info['id']?>adjust<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, date('dmY',strtotime($info['expdate']))))?>adjust<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, $info['batch']))?>adjust" style="border: 1px solid #ced4da;margin-right: 0px;margin-left: 0px;padding: 6px;" pnames="<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, $info['productname']));?><?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, date('dmY',strtotime($info['expdate']))))?><?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, $info['batch']))?>" pnamesshow="<?=mysqli_real_escape_string($con, $info['productname'])?>" forbat="<?=mysqli_real_escape_string($con, $info['batch'])?>" forexp="<?=(($info['expdate']!='')?date($datemainphp,strtotime($info['expdate'])):'')?>" forstock="<?=mysqli_real_escape_string($con, $info['openingstock'])?>">
      <div class="col-12">
        <div class="row" style="padding: 0px;">
            <div class="col-6" style="padding: 0px;line-height: 15px;">
                <?=((mysqli_real_escape_string($con, $info['productname'])=='')?'&nbsp;':mysqli_real_escape_string($con, $info['productname']))?>
            </div>
            <div class="col-5" style="padding: 0px;text-align: right;">
                <span class="itemmodulehov" style="background-color: #1BBC9B;padding: 2px 3px;border-radius: 5px;text-transform: uppercase;font-size: 10px;color: white;"><?=mysqli_real_escape_string($con, $info['itemmodule'])?></span>
            </div>
            <div class="col-1" style="padding: 0px;text-align: center;"></div>
        </div>
        <div class="row" style="padding: 0px;margin-bottom: -6px;">
            <div class="col-6 greycoltxt" style="color: #777;padding: 0px;font-size: 11px;">
                <?=$access['txtnamecategory']?> : <?=((mysqli_real_escape_string($con, $info['category'])=='')?'&nbsp;':mysqli_real_escape_string($con, $info['category']))?>
            </div>
            <div class="col-5 greycoltxt" style="color: #777;padding: 0px;text-align: right;font-size: 11px;">
                Stock on Hand : <span style="<?=($info['openingstock']>0)?'color: green;':'color:red;'?>"><?=mysqli_real_escape_string($con, $info['openingstock'])?></span>
            </div>
            <div class="col-1" style="padding: 0px;text-align: center;">
                <i class="fa fa-check-circle ticorunticing" aria-hidden="true" style="font-size: 18px;color: darkgrey;width:max-content;visibility: hidden;" id="ticoruntic<?=$info['id']?>adjust<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, date('dmY',strtotime($info['expdate']))))?>adjust<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, $info['batch']))?>adjust"></i>
            </div>
        </div>
        <div class="row" style="padding: 0px;margin-bottom: -6px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">
            <div class="col-6 greycoltxt" style="color: #777;padding: 0px;font-size: 11px;">
                Batch : <?=((mysqli_real_escape_string($con, $info['batch'])=='')?'&nbsp;':mysqli_real_escape_string($con, $info['batch']))?>
            </div>
            <div class="col-5 greycoltxt" style="color: #777;padding: 0px;text-align: right;font-size: 11px;">
                Expiry : <?=((mysqli_real_escape_string($con, $info['expdate'])=='')?'&nbsp;':mysqli_real_escape_string($con, date($datemainphp,strtotime($info['expdate']))))?>
            </div>
            <div class="col-1" style="padding: 0px;text-align: center;"></div>
        </div>
      </div>
    </div>
<?php
}
}
if (isset($_GET['term'])&&$_GET['type']=='typing') {
$count=1;
$sqli=mysqli_query($con, "select t1.category,t1.itemmodule,t1.productname,t1.id,SUM(t2.quantity) AS openingstock,t2.batch,t2.expdate,t2.quantity from pairproducts t1,pairbatch t2 where t1.createdid='$companymainid' and ((t1.franchisesession='".$_SESSION["franchisesession"]."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and t1.itemmodule='Products' and t2.productid=t1.id and t1.productname like '%".$_GET['val']."%' order by t1.productname asc limit 15");
while($info=mysqli_fetch_array($sqli))
{
?>
    <div class="row hovthepro greycoltxthead ticoruntic" id="<?=$info['id']?>adjust<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, date('dmY',strtotime($info['expdate']))))?>adjust<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, $info['batch']))?>adjust" style="border: 1px solid #ced4da;margin-right: 0px;margin-left: 0px;padding: 6px;" pnames="<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, $info['productname']));?><?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, date('dmY',strtotime($info['expdate']))))?><?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, $info['batch']))?>" pnamesshow="<?=mysqli_real_escape_string($con, $info['productname'])?>" forbat="<?=mysqli_real_escape_string($con, $info['batch'])?>" forexp="<?=(($info['expdate']!='')?date($datemainphp,strtotime($info['expdate'])):'')?>" forstock="<?=mysqli_real_escape_string($con, $info['openingstock'])?>">
      <div class="col-12">
        <div class="row" style="padding: 0px;">
            <div class="col-6" style="padding: 0px;line-height: 15px;">
                <?=((mysqli_real_escape_string($con, $info['productname'])=='')?'&nbsp;':mysqli_real_escape_string($con, $info['productname']))?>
            </div>
            <div class="col-5" style="padding: 0px;text-align: right;">
                <span class="itemmodulehov" style="background-color: #1BBC9B;padding: 2px 3px;border-radius: 5px;text-transform: uppercase;font-size: 10px;color: white;"><?=mysqli_real_escape_string($con, $info['itemmodule'])?></span>
            </div>
            <div class="col-1" style="padding: 0px;text-align: center;"></div>
        </div>
        <div class="row" style="padding: 0px;margin-bottom: -6px;">
            <div class="col-6 greycoltxt" style="color: #777;padding: 0px;font-size: 11px;">
                <?=$access['txtnamecategory']?> : <?=((mysqli_real_escape_string($con, $info['category'])=='')?'&nbsp;':mysqli_real_escape_string($con, $info['category']))?>
            </div>
            <div class="col-5 greycoltxt" style="color: #777;padding: 0px;text-align: right;font-size: 11px;">
                Stock on Hand : <span style="<?=($info['openingstock']>0)?'color: green;':'color:red;'?>"><?=mysqli_real_escape_string($con, $info['openingstock'])?></span>
            </div>
            <div class="col-1" style="padding: 0px;text-align: center;">
                <i class="fa fa-check-circle ticorunticing" aria-hidden="true" style="font-size: 18px;color: darkgrey;width:max-content;visibility: hidden;" id="ticoruntic<?=$info['id']?>adjust<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, date('dmY',strtotime($info['expdate']))))?>adjust<?=preg_replace('/\s+/', '', mysqli_real_escape_string($con, $info['batch']))?>adjust"></i>
            </div>
        </div>
        <div class="row" style="padding: 0px;margin-bottom: -6px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">
            <div class="col-6 greycoltxt" style="color: #777;padding: 0px;font-size: 11px;">
                Batch : <?=((mysqli_real_escape_string($con, $info['batch'])=='')?'&nbsp;':mysqli_real_escape_string($con, $info['batch']))?>
            </div>
            <div class="col-5 greycoltxt" style="color: #777;padding: 0px;text-align: right;font-size: 11px;">
                Expiry : <?=((mysqli_real_escape_string($con, $info['expdate'])=='')?'&nbsp;':mysqli_real_escape_string($con, date($datemainphp,strtotime($info['expdate']))))?>
            </div>
            <div class="col-1" style="padding: 0px;text-align: center;"></div>
        </div>
      </div>
    </div>
<?php
}
}
?>