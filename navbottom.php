<?php
$sql="select * from paircontrols where username='".$_SESSION["unqwerty"]."'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
?>
<!-- <form action="" method="post"> -->
     <header class="app-header fixed-bottom" style="height:48px !important;z-index: 1 !important;">
        <div class="app-header-inner">  
            <div class="py-2 px-3">
                <div class="app-header-content" style="margin-left: -45px;" id="ilu"> 
                    <div class="row">
                        <div class="col-auto pt-1" style="width:34px !important;margin-top: -8px !important;height: 100px;margin-left: -18px !important;border-top: 1px solid #eff0f4;">
                    </div>
                    <div class="col" style="width:34px !important;margin-top: 1px !important;margin-left: -9px !important;">
                        <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button> 
                                                         <?php
                                                        if ($current_file_name=='productadd.php') {
                                                            ?>
                                                            <!-- <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="products.php" style="margin-top:-3px !important;">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>
                                                            <?php
                                                        if ($current_file_name=='productedit.php') {
                                                            ?>
                                                            <!-- <form action="" method="post">
                                                                <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                                <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="products.php" style="margin-top:-3px !important;">Cancel</a>
                                                            <!-- </form> -->
                                                            <?php
                                                        }
                                                        ?>
                                                     <?php
                                                        if ($current_file_name=='serviceadd.php') {
                                                            ?>
                                                            <!-- <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="services.php" style="margin-top:-3px !important;">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>
                                                        <?php
                                                        if ($current_file_name=='serviceedit.php') {
                                                            ?>
                                                            <!-- <form action="" method="post">
                                                                <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                                <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="services.php" style="margin-top:-3px !important;">Cancel</a>
                                                            <!-- </form> -->
                                                            <?php
                                                        }
                                                        ?>
                                                     <?php
                                                        if ($current_file_name=='customeradd.php'||$current_file_name=='customeredit.php') {
                                                            ?>
                                                            <!-- <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="customers.php" style="margin-top:-3px !important;">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                        if ($current_file_name=='customerdefaulttype.php') {
                                                            ?>
                                                            <!-- <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="preference_billing.php" style="margin-top:-3px !important;">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                        if ($current_file_name=='vendoradd.php'||$current_file_name=='vendoredit.php') {
                                                            ?>
                                                            <!-- <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="vendors.php" style="margin-top:-3px !important;">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                        if ($current_file_name=='invoiceadd.php'||$current_file_name=='invoiceedit.php') {
                                                            ?>
                                                            <!-- <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="invoices.php" style="margin-top:-3px !important;">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>
                                                         <?php
                                                        if ($current_file_name=='manualjournaladd.php'||$current_file_name=='manualjournaledit.php') {
                                                            ?>
                                                            <!-- <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  -->
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="manualjournals.php" style="margin-top:-3px !important;">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>
                                                         <?php
                                                        if ($current_file_name=='training.php') {
                                                            ?>
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="training.php" style="margin-top:-3px !important;">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>
                    </div>
                   </div>
               </div>
            </div>
        </div>
    </header>
<!-- </form> -->
    <!-- background-color: #eff0f4 !important; -->