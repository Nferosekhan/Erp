<?php
include('lcheck.php');
if((isset($_POST['usernewname']))&&(isset($_POST['oldusernewname'])))
{
   $usernewname = mysqli_real_escape_string($con,$_POST['usernewname']);
   $oldusernewname = mysqli_real_escape_string($con,$_POST['oldusernewname']);

   $query = "select count(*) as cntUser from paircontrols where usernewname='".$usernewname."' and id!='".$oldusernewname."'";

   $result = mysqli_query($con,$query);
   $response = "<span style='color: green;'>Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span style='color: red;'>Not Available.</span>";
      }
   
   }

   echo $response;
   die;
}