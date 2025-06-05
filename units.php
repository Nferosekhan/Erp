<?php
include('lcheck.php');
if($userrole!='SUPER ADMIN')
{
	header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
  <title>
    Units - Dmedia
  </title>
<style>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  table {
    border: 0;
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
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-none" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-0">
        <nav aria-label="breadcrumb">
        </nav>
        <?php include('navbar.php'); ?>
      </div>
    </nav>
    <!-- End Navbar -->
     <div class="container-fluid py-4 bg-body">
          <h6 class="font-weight-bolder mb-3">Units</h6>
	 <?php
	 if(isset($_GET['remarks']))
	 {
	 ?>
	 <div class="toast bg-gradient-success text-white" id="myToast"><div class="toast-body"><i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?></div></div>
	 <?php
	 }
	 ?>
	 <?php
	 if(isset($_GET['error']))
	 {
	 ?>
	 <div class="toast bg-gradient-danger text-white" id="myToast"><div class="toast-body"><i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></div></div>
	 <?php
	 }
	 ?>
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4">
             <div class="card-body px-0 pt-0 pb-2">
			 <div align="right" class=" p-2">
			 <a href="unitadd.php" class="btn btn-primary btn-sm p-2">+ Add New</a>
			 <br>
			 </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder">S.No</th>
					  <th class="text-lowercase text-capitalize text-xs font-weight-bolder">Unit Name</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder ps-2">UQC</th>			  
					  <th class="text-lowercase text-capitalize text-xs font-weight-bolder">Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $count=1;
				  $sqli=mysqli_query($con, "select * from pairunits order by uqc asc");
				  while($info=mysqli_fetch_array($sqli))
				  {
					  ?>
                    <tr>
						<td data-label="S.No" class="">&nbsp;<?=$count?></td>
						
						<td data-label="Unit Name" class="">&nbsp;<?=$info['unitname']?></td>
					  <td data-label="UQC" class="">&nbsp;<?=$info['uqc']?></td>
                      <td  data-label="Edit"class="">&nbsp;
                        <a href="unitedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
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