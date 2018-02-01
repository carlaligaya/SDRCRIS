
<!DOCTYPE html>

<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  

</head>
<body>
  <div class="app app-header-fixed ">


   <!-- nav -->
   <?php include '../session/levelOfAccess.php';?>
   
   <!-- / nav -->

   <?php
   if ($_SESSION['usertype']!=101){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
  }
  ?>

  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">


      <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Production Order List</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Production Orders
          </div>
          <div class="table-responsive">
            <table  class="table table-striped b-t b-b">
              <thead>
                <tr>
                  <th  style="width:20%">Production Number</th>
                  <th  style="width:25%">Production Order Date</th>
                  <th  style="width:15%">Status</th>
                </tr>
              </thead>
              <tbody>
            <!--  <tr>
           <td> <a href="prodorder.html"><u>10000</u></a></td>
            <td>1 November 2016</td>
            <td><span class="label bg-warning">In Production</span></td>
            </tr><tr>
           <td> <a href="#"><u>9999</u></a></td>
            <td>1 October 2016</td>
            <td><span class="label bg-danger">Canceled</span></td>
          </tr> -->
          <?php

	//connect to db

          $mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters


	//query db
//if not work use *
          $phone =0;								
          $resultSet=$mysqli->query("SELECT produced, productionNo, DATE(productionDate) AS productionDate FROM productionorder ORDER BY productionNo desc, productionDate;");

          if($resultSet->num_rows>0){

           while($rows=$resultSet->fetch_assoc()){
            $status = $rows['produced'];

           $conNum=$rows["productionNo"];
           echo "<tr class='productRows'>
           <td >PB-<input type=button name=controlNum id=happy class=cN style=border:none;background:none value=".$conNum."></td>
           <td>".$rows["productionDate"]."</td>
           ";
          
            if($status==0){
              echo "<td><span class='label bg-danger'>Unprocessed</span></td>";  
            }
            else if ($status==1){
             echo "<td><span class='label bg-warning'>Processed</span></td>";
           }
         echo "</tr>";
       }
     }

     ?>
   </tbody>
 </table>
 <form id="form" action="prodorder.php" method="GET">
  <input type="text" style="display:none" id="conNum" name="conNum" />
</form>
</div>
</div>
</div>



</div>
</div>
<!-- /content -->





</div>
<script>

  $(document).on('click', '#happy', function(e){
    e.preventDefault();
    var cN =  $(this).closest ('tr').find(".cN").val();
    document.getElementById('conNum').setAttribute('value',cN);
    $("#form").submit();

  });

</script>


</body>
</html>
