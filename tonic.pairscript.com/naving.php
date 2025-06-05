<?php
include('lcheck.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>history</title>
</head>
<body>
<nav>
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
	
		<a class="customcont-heading">Overview</a>	
             
				</div></button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
		<div class="customcont-header ml-0">
	
		<a class="customcont-heading">History</a>	
             
				</div>
		
		</button>
		
  </div>
  
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<h6 class="m-3"><?= $row['franchiseandroles'];?> Details</h6>	  
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <label style="font-weight:bold;"><?= $row['franchiseandroles'];?> Name</label>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['franchisename']?>
        </div>
      </div>
	  
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <label style="font-weight:bold;"><?= $row['franchiseandroles'];?> Address</label>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['street']?> <?=$info['city']?> <?=$info['pincode']?> <?=$info['state']?> <?=$info['country']?>
        </div>
      </div>
	  
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <label style="font-weight:bold;"><?= $row['franchiseandroles'];?> Phone</label>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['mobile']?>
        </div>
      </div>
	  <div class="row m-3" style="align-items: center;">
	  
		  <div class="col-sm-3 col-md-2 col-6">
          <label style="font-weight:bold;"><?= $row['franchiseandroles'];?> E-mail</label>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['email']?>
        </div>
      </div>
	  
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <label style="font-weight:bold;">Website</label>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['website']?>
        </div>
      </div>
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <label style="font-weight:bold;">GSTIN</label>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['gstno']?>
        </div>
      </div>
	  <hr>
<h6 class="m-3"><?= $row['franchiseandroles'];?> Roles</h6>	  
	  <div class="row m-3">
        <div class="col-sm-12 col-md-12 col-12">
		
		<div class="row" style="align-items: end; border-top:1px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
<div class="col-lg-2 p-0" style="height:90px">
    
    <div class="tree ">
<ul style="padding-left:0; margin-bottom:0">
    <li><span>SALES</span>
        <ul>
            <li><span>Invoice</span>
                <ul>
                <li style="font-size:10px;"><span>New Invoice </span> <!--div style="float:right; margin: auto;  width: 8%; height:15px"><hr style="background-color: #515558; margin-top:14px"></div--></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
</div>

</div>
<div class="col-lg-10 px-0">
   <div class="row align-items-center">
<div class="col-lg-2 pe-0">	
	<div class="form-check">
	
	  <input class="form-check-input" type="radio" name="invoice" id="invoiceno" value="0" <?=($info['invoice']=='0')?'checked':''?>>	
<label class="form-check-label" for="invoiceno">No Access
	  </label> <i class="fa fa-info-circle"></i>
	</div>
	</div>
<div class="col-lg-2 p-0">	
	<div class="form-check">	
	  <input class="form-check-input" type="radio" name="invoice" id="invoicefull" value="1"  <?=($info['invoice']=='1')?'checked':''?>>
<label class="form-check-label" for="invoicefull">Full Access
	  </label> <i class="fa fa-info-circle"></i>
	</div>
  </div>


 <div class="col-lg-2" style="background-color:#F7F7F7; height:42px; align-item:middle; margin-right:-10px;">	
	<label for="invoice" class="custom-label" style="margin-top: 0.7rem; margin-left:0rem;font-size: 0.8rem;">Transaction Series</label>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:5px 0">	
	<input type="text" class="form-control  form-control-sm myinput" id="invoiceprefix" name="invoiceprefix" placeholder="Prefix (Static Characters E.g. INV-)" value="<?=$info['invoiceprefix']?>" readonly>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:5px 0">	
	<input type="text" class="form-control  form-control-sm myinput" id="invoicesuffix" name="invoicesuffix" placeholder="Suffix (Automatic Numbering E.g. 001)" style="width:98%" value="<?=$info['invoicesuffix']?>" readonly>
  </div>

</div> 
  </div>
  
</div>
        </div>
      </div>

	  
	  
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
	  <div class="table-responsive m-3">
	  <table class="table table-bordered">
	  <thead>
	  <tr>
	  <th>DATE</th>
	  <th>DETAILS</th>
	  </tr>
	  </thead>
	  <tbody>
	  <?php
	  $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='FRANCHISE' and useid='$id'");
	  while($infouse=mysqli_fetch_array($sqluse))
	  {
	  ?>
		<tr>
		  <td data-label="DATE" style="color:grey"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
		  <td data-label="DETAILS"><?=$infouse['useremarks']?> <span  style="color:grey"><?=$info['createdby']?></span></td>
		</tr>
	  <?php
	  }
	  ?>
	  
	  </tbody>
	  </table>
	  </div>
	  </div>
</div>

			  
			
            </div>
          </div>
</div>





</form>

			 
            </div>
          </div>
</body>
</html>