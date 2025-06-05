<?php
include('lcheck.php');
if ((isset($_GET['term']))&&($_GET['type']=='invoice')) {
$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
$sqlismainaccessusers->bind_param("i", $userid);
$sqlismainaccessusers->execute();
$sqlismainaccessuser = $sqlismainaccessusers->get_result();
$infomainaccessuser=$sqlismainaccessuser->fetch_array();
$sqlismainaccessuserbills=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
$sqlismainaccessuserbills->bind_param("s", $userid);
$sqlismainaccessuserbills->execute();
$sqlismainaccessuserbill = $sqlismainaccessuserbills->get_result();
$infomainaccessuserbill=$sqlismainaccessuserbill->fetch_array();
$sqlismainaccessfields=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
$sqlismainaccessfields->bind_param("i", $companymainid);
$sqlismainaccessfields->execute();
$sqlismainaccessfield = $sqlismainaccessfields->get_result();
while($infomainaccessfield=$sqlismainaccessfield->fetch_array()){
	$coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
	$add = $infomainaccessfield['modulefieldcreate'];
	$fieldadd = explode(',',$add);
	$edit = $infomainaccessfield['modulefieldedit'];
	$fieldedit = explode(',',$edit);
	$view = $infomainaccessfield['modulefieldview'];
	$fieldview = explode(',',$view);
}
$sqlismainaccessfield->close();
$sqlismainaccessfields->close();
$invoiceno=htmlspecialchars( $_GET['invoiceno'], ENT_QUOTES, 'UTF-8');
$invoicedate=htmlspecialchars( $_GET['invoicedate'], ENT_QUOTES, 'UTF-8');
$sql=$con->prepare("SELECT * FROM pairinvoices WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? ORDER BY id ASC LIMIT ".$_GET['term'].",".$_GET['limitings']."");
$sql->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $invoiceno, $invoicedate);
$sql->execute();
$count=1;
$result = $sql->get_result();
if($result->num_rows > 0){
	$rows = array();
	while($row = $result->fetch_assoc()){ 
		$rows[] = $row;
	}
	$result->close();
$sql->close();
$i=$_GET['i'];
foreach($rows as $row){
?>
<tr>
																	<td class="priority" style="display:none">
																		<?=$i?>
																	</td>
																	<td class="tdmove" <?=((in_array('Barcode', $fieldedit))||(in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit)))?'':'style="display:none !important;"'?>>
																		<svg version="1.1" id="Layer_<?=$i?>" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg>
																	</td>
																	<td data-label="BARCODE" style="<?=(in_array('Barcode', $fieldedit))?'':'display:none !important;'?>">
																		<div>
																			<input type="text" name="barcode[]" id="barcode<?=$i?>" value="<?=$row['barcode']?>" class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" onchange="checkthecode(<?=$i?>)">
																		</div>
																		<div>
																			<span id="viewbarcode<?=$i?>" style="display:none; font-size:11px;color: royalblue;" data-bs-toggle="modal" data-bs-target="#barcodeModal" onclick="generateBarcode(<?=$i?>)">
																				View and Download Barcode
																			</span>
																			<input type="hidden" id="barcodeformat<?=$i?>">
																			<input type="hidden" id="barcodetitle<?=$i?>">
																			<input type="hidden" id="barcodesubtitle<?=$i?>">
																			<input type="hidden" id="barcodeval<?=$i?>">
																			<input type="hidden" id="underbarcodelabel<?=$i?>">
																			<input type="hidden" id="footernote<?=$i?>">
																		</div>
																	</td>
																	<td data-label="ITEM DETAILS" style="padding-top: 1px !important;<?=(in_array('Item Details', $fieldedit))?'':'display:none !important;'?>">
																		<input type="hidden" name="productid[]" id="productid<?=$i?>" value="<?=$row['productid']?>">
																		<input type="hidden" name="productname[]" id="productname<?=$i?>" value="<?=$row['productname']?>">
																		<div class="col-sm-9" onclick="andus()" style="width:278px;display: inline-block;" id="selecttheproduct">
																			<select class="form-control  form-control-sm product proitemselect product1" name="product[]" id="product<?=$i?>" required onChange="productchange(<?=$i?>)">
																				<option value="" data-foo="" data-receivable="" selected disabled>
																					Select
																				</option>
																			<?php
																				$sqlis=$con->prepare("SELECT t1.productname, t1.category, t1.id, t1.description, t1.itemmodule, t1.hsncode, t1.openingstock, t2.tax, t3.salemrp, t3.salecost, t3.salediscount, t3.saleofferprice, t1.manufacturer, t1.defaultunit FROM pairproducts t1, pairtaxrates t2, pairprosale t3 WHERE t1.createdid=? AND ((t1.franchisesession=? AND t1.pvisiblity='PRIVATE') OR t1.pvisiblity='PUBLIC') AND (t2.id=t1.intratax OR t1.intratax='null') AND t3.productid=t1.id AND t1.id=? ORDER BY t1.productname ASC");
																				$sqlis->bind_param("ssi", $companymainid, $_SESSION["franchisesession"], $row['productid']);
																				$sqlis->execute();
																				$sqli = $sqlis->get_result();
																				while($info=$sqli->fetch_array()){
																			?>
																				<option value="<?=htmlspecialchars( $info['id'], ENT_QUOTES, 'UTF-8');?>" <?=($row['productid']==$info['id'])?'selected':''?>>
																					<?=$info['productname'];?>
																				</option>
																			<?php
																				}
																				$sqlis->close();
																				$sqli->close();
																			?>
																			</select>
																		</div>
																		<span class="badge" style="width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan<?=$i?>">
																			<?=$row['itemmodule']?>
																		</span>
																		<input type="hidden" name="itemmodule[]" id="itemmodule<?=$i?>" value="<?=$row['itemmodule']?>">
																		<div <?=(in_array('Category', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productmanufacturerspan<?=$i?>" style="display: inline-flex; font-size:11px;">
																				<?=$access['txtnamecategory']?>:
																				<input type="text" name="manufacturer[]" id="manufacturer<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 39px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" value="<?=$row['manufacturer']?>" readonly onChange="productcalc(<?=$i?>)">
																			</span>
																			<span id="productmanufacturerval<?=$i?>" style="display: inline-flex; font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['manufacturer']?>
																			</span>
																			<span id="productmanufactureredit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productmanufacturerupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div <?=(in_array('Hsn or Sac', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="producthsncodespan<?=$i?>" style="font-size:11px;display: inline-flex;">
																				HSN Code:
																			</span>
																			<input type="text" name="producthsn[]" id="producthsn<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['producthsn']?>" onChange="productcalc(<?=$i?>)">
																			<span id="producthsncodeval<?=$i?>" style="display: inline-flex; font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['producthsn']?>
																			</span>
																			<span id="producthsncodeedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="producthsncodeupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																			<br>
																		</div>
																		<div <?=(in_array('Rack', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="rackspan<?=$i?>" style="display:inline-flex; font-size:11px;">
																				Rack:
																			</span>
																			<span id="rackval<?=$i?>" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['rack']?>
																			</span>
																			<input type="hidden" name="rack[]" id="rack<?=$i?>" value="<?=$row['rack']?>">
																			<br>
																		</div>
																		<span <?=(in_array('Product Description', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productdescriptionspan<?=$i?>" style="font-size:11px;display: block;">
																				Description:
																			</span>
																			<textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription<?=$i?>" style="height:50px; width: 146px;display: inline;"><?=$row['productdescription']?></textarea>
																		</span>
																		<div class="col-sm-9 totalaccounts account<?=$i?>" onclick="andus()" style="width:278px;display: none;margin-top: 5.5px !important;" id="selecttheproduct">
																			<select style=" width: 100%;" class="select4 form-control form-control-sm oldaccnames" name="accountname[]" id="accountname<?=$i?>">
																				<option selected disabled value="">
																					Select
																				</option>
																			<?php
																				$seloldval=$con->prepare("SELECT optionslist FROM pairchartaccounttypes WHERE optionslist!=''");
																				$seloldval->execute();
																				// $seloldval->store_result();
																				$seloldvals = $seloldval->get_result();
																				if ($seloldvals->num_rows>0) {
																					while($fetoldval=$seloldvals->fetch_array()){
																						$explodeoptions = explode(';', $fetoldval['optionslist']);
																						for($inneri=0;$inneri<count($explodeoptions)-1;$inneri++){
																							$finalvalues = explode(',',$explodeoptions[$inneri]);
																							if($finalvalues[0]==$row['accountid']){
																								echo '<option value="'.$finalvalues[0].'" '.(($finalvalues[0]==$row['accountid'])?'selected':'').'>'.$finalvalues[1].'</option>';
																							}
																						}
																					}
																					$seloldvals->close();
																				}
																				$seloldval->close();
																			?>
																			</select>
																		</div>
																	</td>
																	<td style="display:none">
																		<input type="text" name="productnotes[]" id="productnotes<?=$i?>" class="form-control form-control-sm bordernoneinput" value="<?=$row['productnotes']?>">
																	</td>
																	<td data-label="BATCH" <?=($access['batchexpiryval']==1)?'':'style="display:none;"'?>>
																		<div>
																			<input type="text" name="batch[]" id="batch<?=$i?>" onClick="batchget(<?=$i?>);" onFocus="batchget(<?=$i?>);"  class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" value="<?=$row['batch']?>" autocomplete="off">
																		</div>
																		<div>
																		<?php
																			$dateformats=$con->prepare("SELECT * FROM paricountry");
																			$dateformats->execute();
																			$dateformat = $dateformats->get_result();
																			$datefetch=$dateformat->fetch_array();
																			if ($datefetch['date']=='DD/MM/YYYY') {
																				$date = date('d-m-Y');
																			}
																			$dateformat->close();
																			$dateformats->close();
																		?>
																			<span id="productexpdatespan<?=$i?>" style="font-size:11px;">
																				EXPIRY:
																			</span>
																			<input type="date" name="expdate[]" id="expdate<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['expdate']?>" onChange="productcalc(<?=$i?>)">
																			<span id="productexpdateval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['expdate']!='')?date($date,strtotime($row['expdate'])):''?>
																			</span>
																			<span id="productexpdateedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productexpdateupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div>
																			<div id="outfordone<?=$i?>" class="dvi" style="display:none;width: 250px;"></div>
																			<input type="text" id="errbatch<?=$i?>" style="display:none;">
																		</div>
																	</td>
																	<td data-label="RATE" <?=(in_array('Rate', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productrate[]"   required id="productrate<?=$i?>" class="form-control form-control-sm proitemselect mobinp productselectadd productselectwidth" oninput="mobinpadd(this)" onChange="productcalc(<?=$i?>)" onClick="rateget(<?=$i?>);" onFocus="rateget(<?=$i?>);" value="<?=$row['productrate']?>" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;">
																		</div>
																		<div <?=(in_array('Mrp', $fieldedit))?'':'style="visibility:hidden !important;"'?>>
																			<span id="productmrpspan<?=$i?>" style=" font-size:11px;white-space: nowrap !important;">
																				MRP:
																				<input type="number" name="mrp[]" id="mrp<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 39px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" value="<?=$row['mrp']?>" onChange="productcalc(<?=$i?>)">
																				<span id="productmrpval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<span style="margin-right: -3px !important">
																						<?php echo $resmaincurrencyans; ?>
																					</span>
																					<?=$row['mrp']?>
																				</span>
																				<span id="productmrpedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productmrpupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																		<div>
																			<div class="dvi invbillgets" id="invbillgets<?=$i?>" style="margin-top:-22px;display: none;width: 250px;border-radius: 0px !important;">
																				<table width="100%">
																					<tr style="border-bottom: 1px solid #cccccc;margin-bottom: 0px;">
																						<td align="center" style="border-right: 1px solid #cccccc;width: 50% !important;display: inline-block !important;text-align: center;">
																							<span onclick="invgetfun(<?=$i?>,0)" id="invonoff<?=$i?>">
																								<?= strtoupper($infomainaccessuser['modulename']) ?>
																							</span>
																						</td>
																						<td align="center" style="width: 50% !important;display: inline-block !important;text-align: center;">
																							<span onclick="billgetfun(<?=$i?>)" id="billonoff<?=$i?>">
																								<?= strtoupper($infomainaccessuserbill['modulename']) ?>
																							</span>
																						</td>
																						<input type="text" style="display: none;" value="inv" id="billorinv<?=$i?>">
																					</tr>
																				</table>
																			</div>
																			<div id="ratelist<?=$i?>" class="dvi ratedvi" style="display:none;width: 250px;"></div>
																			<input type="text" id="errrate<?=$i?>" style="display:none;">
																		</div>
																	</td>
																	<td data-label="<?=($access['txtqtyinv'])?>" <?=(in_array('Quantity', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<input type="number" min="0" step="0.01" name="quantity[]" required id="quantity<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth" onClick="qtych(<?=$i?>)" onFocus="qtych(<?=$i?>)" onChange="productcalc(<?=$i?>)" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" value="<?=$row['quantity']?>">
																		</div>
																		<div <?=(in_array('Unit', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productunitspan<?=$i?>" style="font-size:11px;">
																				UNIT:
																			</span>
																			<input type="text" name="productunit[]" id="productunit<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['unit']?>" readonly onChange="productcalc(<?=$i?>)">
																			<span id="productunitval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['unit']?>
																			</span>
																			<span id="productunitedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editunit(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productunitupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div <?=(in_array('Pack', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productnoofpacksspan<?=$i?>" style=" font-size:11px;">
																				PACK:
																			</span>
																			<input type="text" name="noofpacks[]" id="noofpacks<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['noofpacks']?>" onChange="productcalc(<?=$i?>)">
																			<span id="productnoofpacksval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['noofpacks']?>
																			</span>
																			<span id="productnoofpacksedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productnoofpacksupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																	</td>
																	<td data-label="<?=$access['txttaxableinv']?>" <?=(in_array('Taxable Value', $fieldedit))?'':'style="display:none;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth productvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['productvalue']?>" >
																		</div>
																		<div <?=(in_array('Discount', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productprodiscountspan<?=$i?>" style=" font-size:11px;white-space: nowrap !important;">
																				<?=$access['txtprodisinv']?>:
																				<div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect<?=$i?>">
																					<div class="input-group-prepend">
																						<input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 35px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(<?=$i?>)" value="<?=$row['prodiscount']?>">
																					</div>
																					<select name="prodiscounttype[]" id="prodiscounttype<?=$i?>" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 0px !important;" onChange="productcalc(<?=$i?>)">
																						<option value="0" <?=($rows[0]['prodiscounttype']=='0')?'selected':''?>>
																							%
																						</option>
																						<option value="1" <?=($rows[0]['prodiscounttype']=='1')?'selected':''?>>
																							<?php echo $resmaincurrencyans; ?>
																						</option>
																					</select>
																				</div>
																				<input type="hidden" name="prodisvalueforledger[]" id="prodisvalueforledger<?=$i?>" value="<?=$row['prodiscount']?>">
																				<span id="productprodiscountval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<?=($rows[0]['prodiscounttype']=='0')?''.$row['prodiscount'].'%':'<span style="color:green !important;margin-right:-3px !important;">'.$resmaincurrencyans.'</span> '.$row['prodiscount'].''?>
																					(<span style="color:green !important;">
																						<span style="color:green !important;margin-right:-3px !important;">
																							<?=$resmaincurrencyans;?>
																						</span>
																						<?=$row['productrate']?>
																						-
																						<span style="color:green !important;margin-right:-3px !important;">
																							<?=$resmaincurrencyans;?>
																						</span>
																						<?=$row['prodiscount']?>
																					</span>)
																				</span>
																				<span id="productprodiscountedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productprodiscountupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																		<div style="<?=(in_array('Profit Margin', $fieldedit))?'':'display:none;'?>">
																			<span data-bs-toggle="modal" data-bs-target="#ViewMarginDetails" style="color: green;font-size:13px;" id="margintotal<?=$i?>" onclick="getmargindetails(<?=$i?>)">
																				Profit Margin :
																				<span id="totalmarginvalue<?=$i?>">
																					<?=$row['margintotalvalue']?>
																				</span>
																			</span>
																			<input type="hidden" name="marginupdates[]" id="formarginupdates<?=$i?>" value="<?=$row['marginupdates']?>">
																			<input type="hidden" name="margintotalvalue[]" id="margintotalvalue<?=$i?>" value="<?=$row['margintotalvalue']?>">
																		</div>
																	</td>
																	<td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldedit))?'':'style="display:none;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="hidden" name="cgstvat[]" id="cgstvat1">
																			<input type="hidden" name="sgstvat[]" id="sgstvat1">
																			<input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth taxvalue1" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['taxvalue']?>" >
																		</div>
																		<div <?=(in_array('GST Percentage', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productvatspan<?=$i?>" style="font-size:11px;white-space: nowrap !important;">
																				GST:
																				<input type="number" min="0" step="0.01" name="vat[]" id="vat<?=$i?>" class="form-control form-control-sm proitemselect notforfixed" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(<?=$i?>)" value="<?=$row['vat']?>">
																				<span id="productvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<?=$row['vat']?>%
																				</span>
																				<span id="productvatedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editvat(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productvatupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																		<div <?=(in_array('GST Rupee', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productcgstvatspan<?=$i?>" style=" font-size:11px;">
																				CGST:
																			</span>
																			<span id="productcgstvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['vat']/2)?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																				<?=($row['taxvalue']/2)?>)
																			</span>
																			<span id="productsgstvatspan<?=$i?>" style=" font-size:11px;">
																				SGST:
																			</span>
																			<span id="productsgstvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['vat']/2)?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																				<?=($row['taxvalue']/2)?>)
																			</span>
																			<span id="productigstvatspan<?=$i?>" style="display:none; font-size:11px;">
																				IGST:
																			</span>
																			<span id="productigstvatval<?=$i?>" style="display:none; font-size:11px;" class="text-primary"><?=$row['vat']?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																				<?=$row['taxvalue']?>)
																			</span>
																		</div>
																	</td>
																	<td data-label="AMOUNT" <?=(in_array('Amount', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth productnetvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['productnetvalue']?>" >
																		</div>
																	</td>
																	<td <?=((in_array('Barcode', $fieldedit))||(in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit)))?'style="white-space:nowrap !important;"':'style="display:none !important;"'?>>
																		<div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldedit))?'display:none !important;':'display:none !important;'?>">
																			<a href="javascript:;" class="p-0" id="dropdownadditionalinfo" data-bs-toggle="dropdown" aria-expanded="false">
																				<svg width="15" height="15" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg>
																			</a>
																			<div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownadditionalinfo">
																				<div style="background-color: #3c3c46;margin-top: -50px !important;">
																					<a class="nav-link" style="color: #fff;width:max-content !important;" onclick="additionalinfo(<?=$i?>)">
																						<span class="nav-link-text ms-2 showorhidewords">
																							<span id="showadd<?=$i?>">
																								Show
																							</span>
																							<span id="hideadd<?=$i?>" style="display: none;">
																								Hide
																							</span>
																							Additional Information
																						</span>
																					</a>
																				</div>
																			</div>
																		</div>
																		<a class="btn-delete" style="cursor:pointer">
																			<img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;margin-left: 3px;">
																		</a>
																	</td>
																</tr>
<?php
$i++;
}
}
}
if ((isset($_GET['term']))&&($_GET['type']=='bill')) {
$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
$sqlismainaccessusers->bind_param("i", $userid);
$sqlismainaccessusers->execute();
$sqlismainaccessuser = $sqlismainaccessusers->get_result();
$infomainaccessuser=$sqlismainaccessuser->fetch_array();
$sqlismainaccessuserbills=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
$sqlismainaccessuserbills->bind_param("s", $userid);
$sqlismainaccessuserbills->execute();
$sqlismainaccessuserbill = $sqlismainaccessuserbills->get_result();
$infomainaccessuserbill=$sqlismainaccessuserbill->fetch_array();
$sqlismainaccessfields=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
$sqlismainaccessfields->bind_param("i", $companymainid);
$sqlismainaccessfields->execute();
$sqlismainaccessfield = $sqlismainaccessfields->get_result();
while($infomainaccessfield=$sqlismainaccessfield->fetch_array()){
	$coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
	$add = $infomainaccessfield['modulefieldcreate'];
	$fieldadd = explode(',',$add);
	$edit = $infomainaccessfield['modulefieldedit'];
	$fieldedit = explode(',',$edit);
	$view = $infomainaccessfield['modulefieldview'];
	$fieldview = explode(',',$view);
}
$sqlismainaccessfield->close();
$sqlismainaccessfields->close();
$billno=htmlspecialchars( $_GET['billno'], ENT_QUOTES, 'UTF-8');
$billdate=htmlspecialchars( $_GET['billdate'], ENT_QUOTES, 'UTF-8');
$sql=$con->prepare("SELECT * FROM pairbills WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? ORDER BY id ASC LIMIT ".$_GET['term'].",".$_GET['limitings']."");
$sql->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $billno, $billdate);
$sql->execute();
$count=1;
$result = $sql->get_result();
if($result->num_rows > 0){
	$rows = array();
	while($row = $result->fetch_assoc()){ 
		$rows[] = $row;
	}
	$result->close();
$sql->close();
$i=$_GET['i'];
foreach($rows as $row){
?>
<tr>
																	<td class="priority" style="display:none">
																		<?=$i?>
																	</td>
																	<td class="tdmove" <?=((in_array('Barcode', $fieldedit))||(in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'':'style="display:none !important;"'?>>
																		<svg version="1.1" id="Layer_<?=$i?>" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg>
																	</td>
																	<td data-label="BARCODE" style="<?=(in_array('Barcode', $fieldedit))?'':'display:none !important;'?>">
																		<div>
																			<input type="text" name="barcode[]" id="barcode<?=$i?>" value="<?=$row['barcode']?>" class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" onchange="checkthecode(<?=$i?>)">
																		</div>
																		<div>
																			<span id="viewbarcode<?=$i?>" style="display:none; font-size:11px;color: royalblue;" data-bs-toggle="modal" data-bs-target="#barcodeModal" onclick="generateBarcode(<?=$i?>)">
																				View and Download Barcode
																			</span>
																			<input type="hidden" id="barcodeformat<?=$i?>">
																			<input type="hidden" id="barcodetitle<?=$i?>">
																			<input type="hidden" id="barcodesubtitle<?=$i?>">
																			<input type="hidden" id="barcodeval<?=$i?>">
																			<input type="hidden" id="underbarcodelabel<?=$i?>">
																			<input type="hidden" id="footernote<?=$i?>">
																		</div>
																	</td>
																	<td data-label="ITEM DETAILS" style="padding-top: 1px !important;<?=(in_array('Item Details', $fieldedit))?'':'display:none !important;'?>">
																		<input type="hidden" name="productid[]" id="productid<?=$i?>" value="<?=$row['productid']?>">
																		<input type="hidden" name="productname[]" id="productname<?=$i?>" value="<?=$row['productname']?>">
																		<div class="col-sm-9" onclick="andus()" style="width:278px;display: inline-block;" id="selecttheproduct">
																			<select class="form-control  form-control-sm product proitemselect product1" name="product[]" id="product<?=$i?>" required onChange="productchange(<?=$i?>)">
																				<option value="" data-foo="" data-receivable="" selected disabled>
																					Select
																				</option>
																			<?php
																				$sqlis=$con->prepare("SELECT t1.productname, t1.category, t1.id, t1.description, t1.itemmodule, t1.hsncode, t1.openingstock, t2.tax, t3.salemrp, t3.salecost, t3.salediscount, t3.saleofferprice, t1.manufacturer, t1.defaultunit FROM pairproducts t1, pairtaxrates t2, pairprosale t3 WHERE t1.createdid=? AND ((t1.franchisesession=? AND t1.pvisiblity='PRIVATE') OR t1.pvisiblity='PUBLIC') AND (t2.id=t1.intratax OR t1.intratax='null') AND t3.productid=t1.id AND t1.id=? ORDER BY t1.productname ASC");
																				$sqlis->bind_param("ssi", $companymainid, $_SESSION["franchisesession"], $row['productid']);
																				$sqlis->execute();
																				$sqli = $sqlis->get_result();
																				while($info=$sqli->fetch_array()){
																			?>
																				<option value="<?=htmlspecialchars($info['id'], ENT_QUOTES, 'UTF-8');?>" <?=($row['productid']==$info['id'])?'selected':''?>>
																					<?=$info['productname'];?>
																				</option>
																			<?php
																				}
																				$sqlis->close();
																				$sqli->close();
																			?>
																			</select>
																		</div>
																		<span class="badge" style="width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan<?=$i?>">
																			<?=$row['itemmodule']?>
																		</span>
																		<input type="hidden" name="itemmodule[]" id="itemmodule<?=$i?>" value="<?=$row['itemmodule']?>">
																		<div <?=(in_array('Category', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productmanufacturerspan<?=$i?>" style="display: inline-flex; font-size:11px;">
																				<?=$access['txtnamecategory']?>:
																				<input type="text" name="manufacturer[]" id="manufacturer<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 39px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" value="<?=$row['manufacturer']?>" readonly onChange="productcalc(<?=$i?>)">
																			</span>
																			<span id="productmanufacturerval<?=$i?>" style="display: inline-flex; font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['manufacturer']?>
																			</span>
																			<span id="productmanufactureredit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productmanufacturerupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div <?=(in_array('Hsn or Sac', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="producthsncodespan<?=$i?>" style="font-size:11px;display: inline-flex;">
																				HSN Code:
																			</span>
																			<input type="text" name="producthsn[]" id="producthsn<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['producthsn']?>" onChange="productcalc(<?=$i?>)">
																			<span id="producthsncodeval<?=$i?>" style="display: inline-flex; font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['producthsn']?>
																			</span>
																			<span id="producthsncodeedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="producthsncodeupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																			<br>
																		</div>
																		<div <?=(in_array('Rack', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="rackspan<?=$i?>" style="display:inline-flex; font-size:11px;">
																				Rack:
																			</span>
																			<span id="rackval<?=$i?>" style=" font-size:11px;white-space:nowrap;max-width:163px;overflow:hidden;text-overflow:ellipsis;" class="text-primary">
																				<?=$row['rack']?>
																			</span>
																			<input type="hidden" name="rack[]" id="rack<?=$i?>" value="<?=$row['rack']?>">
																			<br>
																		</div>
																		<span <?=(in_array('Product Description', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productdescriptionspan<?=$i?>" style="font-size:11px;display: block;">
																				Description:
																			</span>
																			<textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription<?=$i?>" style="height:50px; width: 100px;display: inline;"><?=$row['productdescription']?></textarea>
																		</span>
																		<div class="col-sm-9 totalaccounts account<?=$i?>" onclick="andus()" style="width:278px;display: none;margin-top: 5.5px !important;" id="selecttheproduct">
																			<select style=" width: 100%;" class="select4 form-control form-control-sm oldaccnames" name="accountname[]" id="accountname<?=$i?>">
																				<option selected disabled value="">
																					Select
																				</option>
																			<?php
																				$seloldval=$con->prepare("SELECT optionslist FROM pairchartaccounttypes WHERE optionslist!=''");
																				$seloldval->execute();
																				$seloldvals = $seloldval->get_result();
																				if ($seloldvals->num_rows>0) {
																					while($fetoldval=$seloldvals->fetch_array()){
																						$explodeoptions = explode(';', $fetoldval['optionslist']);
																						for($inneri=0;$inneri<count($explodeoptions)-1;$inneri++){
																							$finalvalues = explode(',',$explodeoptions[$inneri]);
																							if($finalvalues[0]==$row['accountid']){
																								echo '<option value="'.$finalvalues[0].'" '.(($finalvalues[0]==$row['accountid'])?'selected':'').'>'.$finalvalues[1].'</option>';
																							}
																						}
																					}
																					$seloldvals->close();
																				}
																				$seloldval->close();
																			?>
																			</select>
																		</div>
																	</td>
																	<td style="display:none">
																		<input type="text" name="productnotes[]" id="productnotes<?=$i?>" class="form-control form-control-sm bordernoneinput" value="<?=$row['productnotes']?>">
																	</td>
																	<td data-label="BATCH" <?=($access['batchexpiryval']==1)?'':'style="display:none;"'?>>
																		<div>
																			<input type="text" name="batch[]" id="batch<?=$i?>" onClick="batchget(<?=$i?>);" onFocus="batchget(<?=$i?>);"  class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" value="<?=$row['batch']?>" autocomplete="off">
																		</div>
																		<div>
																		<?php
																			$dateformats=$con->prepare("SELECT * FROM paricountry");
																			$dateformats->execute();
																			$dateformat = $dateformats->get_result();
																			$datefetch=$dateformat->fetch_array();
																			if ($datefetch['date']=='DD/MM/YYYY') {
																				$date = date('d-m-Y');
																			}
																			$dateformat->close();
																			$dateformats->close();
																		?>
																			<span id="productexpdatespan<?=$i?>" style="font-size:11px;">
																				EXPIRY:
																			</span>
																			<input type="date" name="expdate[]" id="expdate<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['expdate']?>" onChange="productcalc(<?=$i?>)">
																			<span id="productexpdateval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['expdate']!='')?date($date,strtotime($row['expdate'])):''?>
																			</span>
																			<span id="productexpdateedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productexpdateupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div>
																			<div id="outfordone<?=$i?>" class="dvi" style="display:none;width: 250px;">
																			</div>
																			<input type="text" id="errbatch<?=$i?>" style="display:none;">
																		</div>
																	</td>
																	<td data-label="RATE" <?=(in_array('Rate', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productrate[]"   required id="productrate<?=$i?>" class="form-control form-control-sm proitemselect mobinp productselectadd productselectwidth" oninput="mobinpadd(this)" onChange="productcalc(<?=$i?>)" onClick="rateget(<?=$i?>);" onFocus="rateget(<?=$i?>);" value="<?=$row['productrate']?>" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;">
																		</div>
																		<div <?=(in_array('Mrp', $fieldedit))?'':'style="visibility:hidden !important;"'?>>
																			<span id="productmrpspan<?=$i?>" style=" font-size:11px;white-space: nowrap !important;">
																				MRP:
																				<input type="number" name="mrp[]" id="mrp<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 39px !important;padding: 0px !important;height: 18px !important;" min="0" step="0.01" value="<?=$row['mrp']?>" onChange="productcalc(<?=$i?>)">
																				<span id="productmrpval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<span style="margin-right: -3px !important">
																						<?php echo $resmaincurrencyans; ?>
																					</span>
																					<?=$row['mrp']?>
																				</span>
																				<span id="productmrpedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productmrpupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																		<div>
																			<div class="dvi invbillgets" id="invbillgets<?=$i?>" style="margin-top:-22px;display: none;width: 250px;border-radius: 0px !important;">
																				<table width="100%">
																					<tr style="border-bottom: 1px solid #cccccc;margin-bottom: 0px;">
																						<td align="center" style="border-right: 1px solid #cccccc;width: 50% !important;display: inline-block !important;text-align: center;">
																							<span onclick="selfgetfun(<?=$i?>,0)" id="invonoff<?=$i?>">
																								SELF
																							</span>
																						</td>
																						<td align="center" style="width: 50% !important;display: inline-block !important;text-align: center;">
																							<span onclick="othersgetfun(<?=$i?>)" id="billonoff<?=$i?>">
																								OTHERS
																							</span>
																						</td>
																						<input type="text" style="display: none;" value="self" id="selforothers<?=$i?>">
																					</tr>
																				</table>
																			</div>
																			<div id="ratelist<?=$i?>" class="dvi ratedvi" style="display:none;width: 250px;">
																			</div>
																			<input type="text" id="errrate<?=$i?>" style="display:none;">
																		</div>
																	</td>
																	<td data-label="<?=($access['txtqtybill'])?>" <?=(in_array('Quantity', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<input type="number" min="0" step="0.01" name="quantity[]" required id="quantity<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth" oninput="qtytosqty(<?=$i?>)" onClick="qtych(<?=$i?>)" onFocus="qtych(<?=$i?>)" onChange="productcalc(<?=$i?>)" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" value="<?=$row['quantity']?>">
																		</div>
																		<div <?=(in_array('Unit', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productunitspan<?=$i?>" style="font-size:11px;">
																				UNIT:
																			</span>
																			<input type="text" name="productunit[]" id="productunit<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['unit']?>" readonly onChange="productcalc(<?=$i?>)">
																			<span id="productunitval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['unit']?>
																			</span>
																			<span id="productunitedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editunit(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productunitupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeunit(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div <?=(in_array('Pack', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productnoofpacksspan<?=$i?>" style=" font-size:11px;">
																				PACK:
																			</span>
																			<input type="text" name="noofpacks[]" id="noofpacks<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['noofpacks']?>" onChange="productcalc(<?=$i?>)">
																			<span id="productnoofpacksval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['noofpacks']?>
																			</span>
																			<span id="productnoofpacksedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productnoofpacksupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																	</td>
																	<td data-label="<?=($access['txttaxablebill'])?>" <?=(in_array('Taxable Value', $fieldedit))?'':'style="display:none;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth productvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['productvalue']?>" >
																		</div>
																		<div <?=(in_array('Discount', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productprodiscountspan<?=$i?>" style=" font-size:11px;white-space: nowrap !important;">
																				<?=$access['txtprodisbill']?>:
																				<div class="input-group input-group-sm" style="width: max-content !important;display: none;" id="discountselect<?=$i?>">
																					<div class="input-group-prepend">
																						<input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 35px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(<?=$i?>)" value="<?=$row['prodiscount']?>">
																					</div>
																					<select name="prodiscounttype[]" id="prodiscounttype<?=$i?>" class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;max-width: fit-content !important;border-radius: 0px !important;padding: 0px 3px !important;display: none;height: 18px !important;margin-top: 0px !important;" onChange="productcalc(<?=$i?>)">
																						<option value="0" <?=($rows[0]['prodiscounttype']=='0')?'selected':''?>>
																							%
																						</option>
																						<option value="1" <?=($rows[0]['prodiscounttype']=='1')?'selected':''?>>
																							<?php echo $resmaincurrencyans; ?>
																						</option>
																					</select>
																				</div>
																				<input type="hidden" name="prodisvalueforledger[]" id="prodisvalueforledger<?=$i?>" value="<?=$row['prodiscount']?>">
																				<span id="productprodiscountval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<?=($rows[0]['prodiscounttype']=='0')?''.$row['prodiscount'].'%':'<span style="color:green !important;margin-right:-3px !important;">'.$resmaincurrencyans.'</span> '.$row['prodiscount'].''?>
																					(<span style="color:green !important;">
																						<span style="color:green !important;margin-right:-3px !important;">
																							<?=$resmaincurrencyans;?>
																						</span>
																						<?=$row['productrate']?> - 
																						<span style="color:green !important;margin-right:-3px !important;">
																							<?=$resmaincurrencyans;?>
																						</span>
																						<?=$row['prodiscount']?>
																					</span>)
																				</span>
																				<span id="productprodiscountedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productprodiscountupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																	</td>
																	<td data-label="TAX VALUE" <?=(in_array('Tax Value', $fieldedit))?'':'style="display:none;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="hidden" name="cgstvat[]" id="cgstvat1">
																			<input type="hidden" name="sgstvat[]" id="sgstvat1">
																			<input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth taxvalue1" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['taxvalue']?>" >
																		</div>
																		<div <?=(in_array('GST Percentage', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productvatspan<?=$i?>" style="font-size:11px;white-space: nowrap !important;">
																				GST:
																				<input type="number" min="0" step="0.01" name="vat[]" id="vat<?=$i?>" class="form-control form-control-sm proitemselect notforfixed" style="display:none;width: 27px !important;padding: 0px !important;height: 18px !important;" onChange="productcalc(<?=$i?>)" value="<?=$row['vat']?>">
																				<span id="productvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																					<?=$row['vat']?>%
																				</span>
																				<span id="productvatedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editvat(<?=$i?>)">
																					<i class="fa fa-edit"></i>
																				</span>
																				<span id="productvatupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat(<?=$i?>)">
																					<i class="fa fa-save"></i>
																				</span>
																			</span>
																		</div>
																		<div <?=(in_array('GST Rupee', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productcgstvatspan<?=$i?>" style=" font-size:11px;">
																				CGST:
																			</span>
																			<span id="productcgstvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['vat']/2)?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																				<?=($row['taxvalue']/2)?>
																			)</span>
																			<span id="productsgstvatspan<?=$i?>" style=" font-size:11px;">
																				SGST:
																			</span>
																			<span id="productsgstvatval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=($row['vat']/2)?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span><?=($row['taxvalue']/2)?>
																			)</span>
																			<span id="productigstvatspan<?=$i?>" style="display:none; font-size:11px;">
																				IGST:
																			</span>
																			<span id="productigstvatval<?=$i?>" style="display:none; font-size:11px;" class="text-primary">
																				<?=$row['vat']?>% 
																				(<span style="margin-right: -3px !important">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																				<?=$row['taxvalue']?>
																			)</span>
																		</div>
																	</td>
																	<td data-label="AMOUNT" <?=(in_array('Amount', $fieldedit))?'':'style="display:none !important;"'?>>
																		<div>
																			<span style="font-size:15px !important;">
																				<?php echo $resmaincurrencyans; ?>
																			</span>
																			<input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth productnetvalue1"style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;" readonly value="<?=$row['productnetvalue']?>" >
																		</div>
																	</td>
																	<td data-label="SALE QUANTITY" <?=(in_array('Sale Quantity', $fieldedit))?'':'style="display:none;"'?>>
																		<div>
																			<input type="number" min="0" step="0.01" name="salequantity[]" id="salequantity<?=$i?>" class="form-control form-control-sm proitemselect productselectwidth" onChange="productcalc(<?=$i?>)" style="margin-bottom: 3px !important;text-align: right !important;padding: 0px !important;background:none;" value="<?=$row['salequantity']?>">
																		</div>
																		<div <?=(in_array('SALE opparen or UNIT closparen opparen Inclusive GST closparen', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productwithtaxspan<?=$i?>" style=" font-size:11px;">
																				<span style="background-color:#1BBC9B;color:white;padding:3px;">
																					SALE(/UNIT)
																				</span>
																				<br>
																				(Inclusive GST):
																				<span style="font-size:11px !important;padding-right:3px !important;">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																			</span>
																			<input type="text" name="productwithtax[]" id="productwithtax<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['productwithtax']?>" onchange="prowithtax(<?=$i?>)">
																			<span id="productwithtaxval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['productwithtax']?>
																			</span>
																			<span id="productwithtaxedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editwithtax(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productwithtaxupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changewithtax(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																		<div <?=(in_array('SALE opparen or UNIT closparen opparen Exclusive GST closparen', $fieldedit))?'':'style="display:none !important;"'?>>
																			<span id="productwithouttaxspan<?=$i?>" style=" font-size:11px;">
																				(Exclusive GST):
																				<span style="font-size:11px !important;padding-right:3px !important;">
																					<?php echo $resmaincurrencyans; ?>
																				</span>
																			</span>
																			<input type="text" name="productwithouttax[]" id="productwithouttax<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 33px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['productwithouttax']?>" onchange="prowithouttax(<?=$i?>)">
																			<span id="productwithouttaxval<?=$i?>" style=" font-size:11px;" class="text-primary">
																				<?=$row['productwithouttax']?>
																			</span>
																			<span id="productwithouttaxedit<?=$i?>" style=" font-size:11px; cursor:pointer" class="text-blue" onclick="editwithouttax(<?=$i?>)">
																				<i class="fa fa-edit"></i>
																			</span>
																			<span id="productwithouttaxupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changewithouttax(<?=$i?>)">
																				<i class="fa fa-save"></i>
																			</span>
																		</div>
																	</td>
																	<td <?=((in_array('Barcode', $fieldedit))||(in_array('Item Details', $fieldedit))||($access['batchexpiryval']==1)||(in_array('Rate', $fieldedit))||(in_array('Quantity', $fieldedit))||(in_array('Taxable Value', $fieldedit))||(in_array('Tax Value', $fieldedit))||(in_array('Amount', $fieldedit))||(in_array('Sale Quantity', $fieldedit)))?'style="white-space:nowrap !important;"':'style="display:none !important;"'?>>
																		<div class="app-utility-item app-user-dropdown dropdown" style="margin-right: 0px !important; <?=(in_array('Additional Informations', $fieldedit))?'display:none !important;':'display:none !important;'?>">
																			<a href="javascript:;" class="p-0" id="dropdownadditionalinfo" data-bs-toggle="dropdown" aria-expanded="false">
																				<svg width="15" height="15" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg>
																			</a>
																			<div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownadditionalinfo">
																				<div style="background-color: #3c3c46;margin-top: -50px !important;">
																					<a class="nav-link" style="color: #fff;width:max-content !important;" onclick="additionalinfo(<?=$i?>)">
																						<span class="nav-link-text ms-2 showorhidewords">
																							<span id="showadd<?=$i?>">
																								Show
																							</span>
																							<span id="hideadd<?=$i?>" style="display: none;">
																								Hide
																							</span>
																							Additional Information
																						</span>
																					</a>
																				</div>
																			</div>
																		</div>
																		<a class="btn-delete" style="cursor:pointer">
																			<img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;margin-left: 3px;">
																		</a>
																	</td>
																</tr>
<?php
$i++;
}
}
}
?>