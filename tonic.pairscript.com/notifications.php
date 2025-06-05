<?php
include('lcheck.php');
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
        Notifications
    </title>
    <style>
    table tbody tr:nth-of-type(odd) {}

/*@media screen and (max-width: 3px) {
    .addmenu{
        position: relative;
        left: -57px; 
        top: 36px;
}
.add{
    position: relative;
    left: -60px;
}
}*/
@media screen and (max-width: 993px) {
    .add{
        position: relative;
        left: 0px; 
        top: 36px;
}
.addmenu{
        position: relative;
        left: 0px; 
        top: 36px;
}
}


@media screen and (max-width: 353px) {
    /*.add{
        position: relative;
        left: -90px; 
        top: 36px;
}
.addmenu{
        position: relative;
        left: -96px; 
        top: 36px;
}*/
}


    @media screen and (max-width: 600px) {
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
            padding-bottom: 2em;
        }
    }
    </style>



    <style>
    #tableEditor {
        position: absolute;
        left: 250px;
        top: 161px;
        padding: 5px;
        border: 1px solid #000;
        background: #fff;
    }
    </style>

    <style>
    .checkbox-dropdown {
        width: 220px;
        border: 0px solid #aaa;
        padding: 10px;
        position: relative;
		z-index:5;


        user-select: none;
    }

    /* Display CSS arrow to the right of the dropdown text */
    .checkbox-dropdown:after {

        height: 0;
        position: absolute;
        width: 0;
        border: 6px solid transparent;
        border-top-color: #000;
        top: 50%;
        right: 10px;
        margin-top: -3px;
    }

    /* Reverse the CSS arrow when the dropdown is active */
    .checkbox-dropdown.is-active:after {
        border-bottom-color: #000;
        border-top-color: #fff;
        margin-top: -9px;
    }

    .checkbox-dropdown-list {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        top: 100%;
        /* align the dropdown right below the dropdown text */
        border: inherit;
        border-top: none;
        left: -1px;
        /* align the dropdown to the left */
        right: -1px;
        /* align the dropdown to the right */
        opacity: 0;
        /* hide the dropdown */
        border: 1px solid #aaa;
        transition: opacity 0.4s ease-in-out;
        height: auto;
        overflow: scroll;
        overflow-x: hidden;
        pointer-events: none;
        /* avoid mouse click events inside the dropdown */
    }

    .is-active .checkbox-dropdown-list {
        opacity: 1;
        /* display the dropdown */
        pointer-events: auto;
        /* make sure that the user still can select checkboxes */
    }

    .checkbox-dropdown-list {

        background-color: white;
        padding: 10px;
        text-transform: uppercase;


    }

    .checkbox-dropdown-list li label {

        padding: 10px;


    }

    .checkbox-dropdown-list li:hover {
        background-color: #EDF0F2;
        color: white;
    }

    .dropliststyle {
        padding-left: 10px;
        margin-top: -4px;
        vertical-align: text-bottom;
        font-size: 14px;
    }

    input[type=checkbox] {
        transform: scale(1.25);
    }

    input:disabled {
        background: red;
    }

    input[type="checkbox"i]:disabled {
        color: red;
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

            <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <div class="row">
                                    <div class="col-lg-7"> 
                                <p class="mb-3" style="color:black;font-size:20px;margin-top: -8px;"> Notifications</p>
                            </div>
								
                                 </div>
                             <!-- </div>     -->
								<div class="p-2" align="right">
													
													
                                            <br>
											
                                        </div>
							<script type="text/javascript">
           $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});                     
                            </script>
                            <div class="table-responsive p-0 min-height-480" style="margin-top: -54px;">
                                <table id="someTable" class="table align-items-center table-bordered mb-0">
                                    <thead>
                                        <tr>

                                            <td class="text-uppercase name" style="width:300px;"
                                                id="name"><span style="font-size:13px;color:black;"> Published On</span></td>
												<td class="text-uppercase code" style="width:300px;"
                                                id="code"><span style="font-size:13px;color:black;"> Notification</span></td>
												<td class="text-uppercase code" style="width:300px;"
                                                id="status"><span style="font-size:13px;color:black;"> Status</span></td>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <?php
        
				  $count=1;
				  $sqli=mysqli_query($con, "select t1.id, t2.createdon, t2.viewedon, t1.notification from pairnotifications t1, pairnothistory t2 where t2.createdid='$companymainid'  and t1.id=t2.notificationid order by t1.id desc");
                 
                 
                  while($info=mysqli_fetch_array($sqli))
				  {
			  
					 
					  ?>
                                        <tr style="font-size: 0.775rem !important;">
										
											<td data-label="Published on"><?=date('d/m/Y h:i:s a', strtotime($info['createdon']))?></td>
                                            <td data-label="Name"><span style="color:#1878F1" class="mb-0 text-sm"><?=$info['notification']?></span></td>
											<td data-label="Status">
											<?php if($info['viewedon']!='')
											{
											?>
											<span class="badge badge-sm mybadge" style="text-transform:none; font-weight:normal">Viewed</span>
											<?php           
											}
											else
											{
											  ?>
											<span class="badge badge-sm mybadge bg-danger" style="text-transform:none; font-weight:normal">Not Viewed</span>
											<?php
											}
											?></td>
										</tr>
									<?php
									 $sqlias=mysqli_query($con, "update pairnothistory set viewedon='$times' where notificationid='".$info['id']."'");
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
        tableEl.querySelectorAll('tbody tr').forEach(tr => {
            Array.from(tr.children).forEach(
                (td, ndx) => td.setAttribute('label', tdLabels[ndx])
            );
        });
    }
    </script>


    <script>
    function tableEditorremove() {
        $('#tableEditor').remove();
        return false;
    }
    </script>

    <script>
    $(".checkbox-dropdown").click(function() {
        $(this).toggleClass("is-active");
    });

    $(".checkbox-dropdown ul").click(function(e) {
        e.stopPropagation();
    });








    $("#name").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });



    $("#rate").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });


    if ($('#name').is(":checked")) {
        // it is checked  
        //alert("Name column is checked")
    }
    if ($('#rate').is(":checked")) {
        // it is checked  
        //alert("rate column is checked")
    }
    </script>
    <script>
    $(function() {
        var $chk = $(".grpChkBox input:checkbox");
        var $tbl = $("#someTable");
        var $tblhead = $("#someTable th");

        $chk.prop('checked', true);

        $chk.click(function() {
            var colToHide = $tblhead.filter("." + $(this).attr("name"));
            var index = $(colToHide).index();
            $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
        });
    });


    function funaddcolumn() {
        
       // $('#grpChkBox').css("display" , "none");
    }
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






    <style>
    /*************************************
 * BUTTON BASE
 */

    .arlina-button {
        position: relative;
        border: 0;
        cursor: pointer;
        outline: 0;
        -webkit-appearance: none;
        -webkit-font-smoothing: antialiased;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .arlina-button[data-loading] {
        cursor: default;
    }


    /* Blue button */
    .arlina-button.blue {
        background: #53b5e6;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.blue:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #58c2f8;
    }

    .arlina-button.blue[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }

    /* Orange button */
    .arlina-button.orange {
        background: #ea8557;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.orange:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #ffa96c;
    }

    .arlina-button.orange[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }


    /* Spinner animation */
    .arlina-button .spinner {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        margin-top: -10px;
        opacity: 0;

        background-image: url("assets/img/spin.gif");
        background-repeat: no-repeat;

        /* background-image: url(http://2.bp.blogspot.com/-GPSLDnKmX3s/VSvPkXsCHvI/AAAAAAAACOg/Xmm2kIDu-CU/s1600/spin.gif); */


    }


    /*************************************
 * EASING
 */

    .arlina-button,
    .arlina-button .spinner,
    .arlina-button .label {
        -webkit-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -moz-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -ms-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
    }

    .arlina-button.zoom-in,
    .arlina-button.zoom-in .spinner,
    .arlina-button.zoom-in .label,
    .arlina-button.zoom-out,
    .arlina-button.zoom-out .spinner,
    .arlina-button.zoom-out .label {
        -webkit-transition: 0.3s ease all;
        -moz-transition: 0.3s ease all;
        -ms-transition: 0.3s ease all;
        transition: 0.3s ease all;
    }



    /*************************************
 * EXPAND RIGHT
 */

    .arlina-button.expand-left .spinner {
        left: 0.8em;
    }

    .arlina-button.expand-left[data-loading] {
        padding-left: 40px;
    }

    .arlina-button.expand-left[data-loading] .spinner {
        opacity: 1;
    }
    </style>



</body>

</html>