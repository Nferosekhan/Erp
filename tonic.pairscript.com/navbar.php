<?php
$sql="select * from paircontrols where username='".$_SESSION["unqwerty"]."'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
?>
<div class="collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4" id="navbar">
          <div class="pe-md-3 d-flex align-items-center">
            <ul class="navbar-nav  justify-content-start">
            	<style type="text/css">
            		@media screen and (max-width: 1199px){
            			.dummy{
            				display: none !important;
            			}
            		}
            		@media screen and (min-device-width: 1200px) and (max-device-width: 1900px){
            			.dummys{
            				visibility: hidden !important;
            			}
            		}
            		#dummyes{
            			display: block !important;
            		}
            	</style>
            	<li class="dummy">
            		<a href="">
            			<span class="dummys"><span id="dummyes">abcdefghijklmnopqrs</span>tuvwxyzABCiugfygbcastfkhajxkuff</span>
            		</a>
            	</li>
            	<script type="text/javascript">
            		function myFunction() {
  var x = document.getElementById("dummyes");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
            	</script>
            <li class="nav-item ps-3 d-flex align-items-center" id="ren"  onclick="myFunction()">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
			 <?php
				if($franchisesrole!='')
				{
			?>	
		  <li class="nav-item dropdown px-3 d-flex align-items-center">
             <form action="changefranchise.php" method="post">
			 <input type="hidden" name="url" value="<?=$CurPageURL?>">
			  <select class="franchise-session" id="franchisesession" name="franchisesession" onchange="this.form.submit()">
				
			
				<?php
				  $count=1;
				  $sqlifr=mysqli_query($con, "select * from pairfranchises where id in (".$franchisesrole.") order by id desc");
				  while($infofr=mysqli_fetch_array($sqlifr))
				  {
					?>
					<option value="<?=$infofr['id']?>" <?=($_SESSION['franchisesession']==$infofr['id'])?'selected':''?>><?=$infofr['franchisename']?></option>
					<?php
					}
				?>
				</select>
				</form>
            </li>
		  
		  <?php
				}
				?>
		  </ul>
          </div>
		  
          <ul class="ms-md-auto navbar-nav  justify-content-end">
		 
				<?php
				if(($permissionfranchise=='2')||($permissionuser=='2')||($permissionpreference=='2')||($permissionconfig=='2')||($permissionfranchise=='1')||($permissionuser=='1')||($permissionpreference=='1')||($permissionconfig=='1'))
				{
				?>	
				<script src="https://kit.fontawesome.com/9103b0bf4c.js" crossorigin="anonymous"></script>

            <li class="nav-item dropdown px-2 d-flex align-items-center">
              <a href="javascript:;" class="p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              	<style type="text/css">
              		.spinners{
              			animation-name: myfirst;
                    animation-duration: 1.5s;
                    animation-iteration-count: infinite;
                    animation-timing-function: linear; 
              		}
              		@keyframes myfirst {
              			 from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(360deg);
    }
}
              	</style>
               <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon cursor-pointer icon-lg align-text-bottom spinners"><path d="M258.3 149.8c-57.3 0-103.9 46.6-103.9 103.9 0 57.3 46.6 103.9 103.9 103.9s104-46.6 104-103.9c0-57.3-46.6-103.9-104-103.9zm0 175.9c-39.7 0-71.9-32.3-71.9-71.9 0-39.7 32.3-71.9 71.9-71.9 39.7 0 71.9 32.3 71.9 71.9.1 39.6-32.2 71.9-71.9 71.9z"></path><path d="M491.4 202.9l-38.7-14c-3-9.5-6.6-18.6-10.7-27.1l18.3-38.3c5.6-11.8 3.2-26-6-35.2l-30.5-30.6c-9.3-9.3-23.4-11.7-35.2-6.1l-38.2 18.1c-8.1-3.8-16.7-7.1-27.1-10.3l-14-38.7C304.9 8.5 293.2.4 280.2.4h-43.6c-12.9 0-24.6 8.2-29.1 20.4l-14.1 38.8c-9.7 3.1-18.8 6.7-27.1 10.7l-38.2-18.4c-11.8-5.6-26-3.2-35.2 6L62.1 88.3c-9.3 9.3-11.7 23.5-6 35.3l18 37.8c-5.2 9.8-9.2 18.7-12.2 27l-40.8 14.2C8.6 207 .2 218.7.2 232v43.3c0 13.2 8.4 25 20.7 29.2l40.9 14.3c3.1 8.8 6.9 17.7 11.7 27.1L55.6 384c-5.6 11.9-3.2 26 6.2 35.2L92.6 450c9.2 9.2 23.4 11.7 35.2 6l38.1-18.1c9.7 5.2 18.6 9.2 27.1 12.2l14.2 40.8c4.3 12.5 16 20.8 29.3 20.8h43.3c13.2 0 25-8.4 29.3-20.8l14.2-40.9c8.9-3.1 18-7 27.1-11.7l38.1 17.9c11.8 5.6 26 3.1 35.3-6.2l30.7-30.9c9.2-9.2 11.6-23.3 6-35.2l-18.2-38.4c3.8-8 7.1-16.6 10.3-27.1l38.6-14c12.3-4.3 20.6-16 20.6-29V232c0-13-8.2-24.7-20.4-29.1zm-11.6 71.8l-38.5 14c-9.2 3.3-16.1 10.6-19 19.9v.1c-2.8 9.3-5.7 16.8-8.9 23.5-4.1 8.5-4.2 18.3-.1 26.7l18.2 38.3-29.7 29.9-38-17.9c-8.9-4.1-18.8-4-27.3.5-8 4.1-16 7.6-23.7 10.3-8.9 2.9-16.1 10.1-19.3 19.1l-14.2 40.7h-41.8L223.2 439c-3.1-8.9-10-15.9-19-19-7.3-2.6-15-6.1-23.7-10.7s-19.1-4.8-27.9-.6l-37.9 18-29.9-29.8 17.9-37.9c4.1-8.9 4-18.9-.5-27.3-4.3-8.3-7.7-16.1-10.3-23.9-3.1-8.9-10.2-16-19.1-19.1l-40.6-14.2v-41.8l40.7-14.2c8.9-3.1 15.9-10 19-18.9 2.5-7 6-14.7 10.7-23.5 4.6-8.6 4.9-19 .6-27.9l-18-37.8L115 80.9l38 18.3c8.5 4.1 18.6 4 27.1-.2 7.1-3.5 15.1-6.6 23.6-9.3 9-2.9 16.3-9.9 19.6-19l14-38.5h42.1l13.9 38.4c3.3 9.2 10.6 16.1 19.9 19h.1c9.2 2.8 16.6 5.6 23.4 8.9 8.6 4.1 18.3 4.1 26.8.1l38-18 29.5 29.6-18.2 38-.1.2c-4 8.7-4 18.5.2 26.9 3.6 7.4 6.7 15.3 9.3 23.5 2.7 9 9.8 16.4 18.9 19.8l38.5 14v42.1z"></path></svg>
               <!-- <i class="fa-solid fa-cog fa-spin" style="display: inline-block;"></i> -->
              </a>
              <ul class="dropdown-menu  dropdown-menu-end customdropdown me-sm-n4" aria-labelledby="dropdownMenuButton">
               <?php
			   if($permissionfranchise=='1'||$permissionfranchise=='2')
			   {
				?>
                <li class="nav-item">
                  <a class="nav-link  <?=($current_file_name=='franchises.php')?'active':''?>" href="franchises.php">
                    <i class="fa fa-building" style="margin-left: 3px;"></i>
                    <span class="nav-link-text ms-2"><?= $row['franchiseandroles']?> & Roles</span>
                  </a>
                </li>
				<?php
				}
				?>	
				<?php
				if($permissionuser=='1'||$permissionuser=='2')
				{
				?>		   
				<li class="nav-item">                  
				<a class="nav-link  <?=($current_file_name=='users.php')?'active':''?>" href="users.php">                    
				<i class="fa fa-users"></i>                    
				<span class="nav-link-text ms-2" style="position: relative;left: -2px;"><?= $row['userandroles']?> & Roles</span>                  
				</a>                
				</li> 
					<?php
				}
				?>
			 <?php
			   if($permissionpreference=='1')
			   {
				?>
                 <li class="nav-item">
                  <a class="nav-link  <?=($current_file_name=='preference.php')?'active':''?>" href="preference.php">
                    <i class="fa fa-sliders" style="margin-left: 2px;"></i>
                    <span class="nav-link-text ms-2"> Preference</span>
                  </a>
                </li> 
                 <?php
				}
				?>
				<?php
			   if($permissionconfig=='1')
			   {
				?>
				 <li class="nav-item">
                  <a class="nav-link  <?=($current_file_name=='franchises.php')?'active':''?>" href="config.php">
                    <i class="fa fa-wrench" style="margin-left: 2px;"></i>
                    <span class="nav-link-text ms-2"> Configuration</span>
                  </a>
                </li>
                <?php
				}
				?>
              </ul>
            </li>
            <?php
				}
				?> 
				<?php
            $colsarry=array("4285F4", "34A853", "FBBC05", "EA4335", "00A1F1", "7CBB00", "FFBB00", "F65314");
			    shuffle($colsarry);
			    ?>
            <li class="nav-item dropdown px-3 d-flex align-items-center">
              <a href="javascript:;" class="p-0" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" <?php if($_SESSION["profileimage"]=='')	{ ?>style="width: 35px; height: 35px; text-align:center; border-radius:50px;background-color: #<?=$colsarry[0]?>; color: #fff;" <?php } ?>>
               <?php
			if($_SESSION["profileimage"]!='')
			{
				?>
              <img class="float-left rounded-circle" style="width: 35px; height: 35px;" alt="<?=$_SESSION["firstname"]?>" src="<?=($_SESSION["profileimage"]!='')?$_SESSION["profileimage"]:''?>">
			  <?php
			}
			else
			{
			    
				?>
				<div style="padding-top: 7px; font-size: 18px; margin-top: -3px;"><?=substr($_SESSION["firstname"],0,1)?></div>
				<?php
			}
			?>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownMenuButton1">
               <?php
                if($permissionmyaccount=='1'){
               ?>
                <li class="nav-item">
                  <a class="nav-link  <?=($current_file_name=='myaccount.php')?'active':''?>" href="myaccount.php">
                    <i class="fa fa-user"></i>
                    <span class="nav-link-text ms-2"> My Account</span>
                  </a>
                </li> 
                <?php
              }
              ?>
                 <li class="nav-item">
                  <a class="nav-link  <?=($current_file_name=='logout.php')?'active':''?>" href="logout.php">
                    <i class="fa fa-sign-out-alt"></i>
                    <span class="nav-link-text ms-2"> Logout</span>
                  </a>
                </li> 
                
              </ul>
            </li>
            
			
          </ul>
        </div>