<?php
include('lcheck.php');
if($taxes=='0'||$permissionconfig=='0')
{
  header('Location: dashboard.php');
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
    Configuration &gt; Tax Rates
  </title>
<style>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
   .add{
    position: relative;
    top: 36px; 
  }
  table {
    border: 0;
    margin-top: 30px;
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
     <script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 4000);
 
});
</script>
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body py-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-0" style="font-size: 14.6px;color: black;position: relative;top: -12px;border-bottom: 1px solid #dee2e6;"><a href="config.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Configuration</a> <span>&gt;</span> Tax Rates</p>
               <p class="mb-3" style="font-size: 20px;margin-top: 9px;color:black;margin-left: 18px;"><i class="fa fa-line-chart"></i> Tax Rates</p>
			 <div align="right" class=" p-2" style="margin-top: -60px;margin-right: -18px;">
			 <a href="taxadd.php" class="btn btn-custom btn-sm p-2 add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:10px;padding-right: 5px;"><p style="width: max-content;margin-top:-7px;margin-left: -3px;padding: 0px;margin-right: -3px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New Tax</span></p></a>
        <a href="taxgadd.php" class="btn btn-custom btn-sm p-2 add"style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:27px;padding-right: 5px;"><p style="width: max-content;margin-top:-7px;margin-left: -3px;padding: 0px;margin-right: -3px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New Tax Group</span></p></a>
			 <br>
			 </div>
              <div class="table-responsive p-3" style="margin-top:-15px;">
                <table class="table align-items-center table-bordered mb-0">
                  <thead>
                    <tr>
					  <td class="text-uppercase" style="width:50%;word-wrap: break-word;color: black;"><span style="font-size:13px;">TAX NAME</span></td>
                      <td class="text-uppercase" style="width:50%;word-wrap: break-word;color: black;"><span style="font-size:13px;">Tax Rate %</span></td>
                  </thead>
                  <tbody>
				  <?php
				  $count=1;
				  $sqli=mysqli_query($con, "select * from pairtaxrates where createdid='$companymainid' or createdid='0' order by tax asc");
				  while($info=mysqli_fetch_array($sqli))
				  {
					  ?>
                    <tr  onclick="window.open('taxview.php?id=<?=$info['id']?>', '_self')">					
						<td data-label="Tax Name" class="">&nbsp;<span style="color:#1878F1;"><?=$info['taxname']?></span> <span style="color:#28A745;"><?=($info['taxgroups']!='')?'(Tax Group)':'(Tax)'?></span></td>
					    <td data-label="Tax %" class="">&nbsp;<?=$info['tax']?></td>
                    </tr>
					<?php
					$count++;
				  }
				  ?>
                    
                  </tbody>
                </table>
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
 <script>
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
</script>
</body>

</html>