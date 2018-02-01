<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="../libs/assets/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />

  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />

</head>
<body>
  <div class="app app-header-fixed ">


   <!-- nav -->
   <?php include '../session/levelOfAccess.php';?>
   
   <!-- / nav -->

   <?php
   if ($_SESSION['usertype']!=104){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
  }
  require_once('../../mysqlConnector/mysql_connect.php');
  $query="select productID, productName, wholesalePrice, retailPrice, sku from products";
  $result=mysqli_query($dbc,$query);
  ?>

  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">


      <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Items Produced</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
           List of Production Number
          </div>
          <div class="wrapper-md">

           <br>
          
          
            <div class="table-responsive">
              <table  class="table table-striped b-t b-b" id="myTable">
                <thead>
                  <tr>
                    <th  style="width:25%">Production Number</th>
                    <th  style="width:25%">Production Date</th>
                    <th  style="width:10%">Status</th>
                  </tr>
                </thead>
                <tbody id="tableList">
                 <?php 
				 require_once('../../mysqlConnector/mysql_connect.php');
				 $query="SELECT productionNo,date(producedDate) as producedDate,produced FROM produced ORDER BY productionNo DESC;";
				 $result=mysqli_query($dbc,$query);
				 while($row = $result->fetch_assoc()) {$conNum=$row["productionNo"];
                  echo "<tr>
				<td >PR-<input type=button name=controlNum id=happy class=cN style=border:none;background:none value=".$conNum."></td>
                <td>".$row["producedDate"]."</td>";
				  if($row["produced"]==0){
					  echo " <td><span class='label bg-danger'>Unprocessed</span></td> 
                </tr>";
					  
				  }else{
					   echo " <td><span class='label bg-warning'>processed</span></td> 
                </tr>";
				  }

					

                }
				 
				 ?>
          </tbody>
        </table>
       
  <form id="form" action="producedInfo.php" method="GET">
            <input type="text" style="display:none" id="poNum" name="poNum" />
          </form>

      </div>

   
</div>
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
    var pN =  $(this).closest ('tr').find(".cN").val();
    document.getElementById('poNum').setAttribute('value',pN);
    $("#form").submit();

  });

</script>
</body>
</html>
