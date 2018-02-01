
<!DOCTYPE html>
<html lang="en" class="">


<meta charset="utf-8" />
<title>Laguna Creamery Inc</title>
<meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" type="text/css" href="../sales/css/datepicker.css" />

</head>
<body>
  <div class="app app-header-fixed ">


   <!-- nav -->
   <?php include '../session/levelOfAccess.php';?>
   <?php
   if ($_SESSION['usertype']!=102){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
  }
  ?>

  <div id="content" class="app-content" role="main">
   <div class="app-content-body ">


    <div class="bg-light lter b-b wrapper-md">
      <h1 class="m-n font-thin h3">Products in Low Inventory</h1>
    </div>
    <div class="wrapper-md">
      <div class="panel panel-default">
        <div class="panel-heading">
         Low Inventory Products List
       </div>
       <div class="wrapper-md">
         <div class="wrapper-md bg-white-only b-b">
          <div class="row text-center">
            <div class="col-sm-3 col-xs-6" >
              <div>Quantity of Low Inventory <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
              <input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="qtyLow"/>
            </div>

            <div class="col-sm-3 col-xs-6">
              <div>Low Inventory SKUs <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
              <input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="lowSku"/>
            </div>

          </div>
        </div>

        <b>Low Inventory Summary </b> 

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline" role="form">
          <div class="table-responsive">
            <table  class="table table-striped b-t b-b">
              <thead>
                <tr>
                  <th  style="width:10%">SKU</th>
                  <th  style="width:20%">Product Name</th>
                  <th  style="width:20%">Quantity Left</th>
                  <th  style="width:9%">Wholesale Price</th>
                  <th  style="width:9%">Retail Price</th>
                </tr>
              </thead>

              <?php

              require_once('../../mysqlConnector/mysql_connect.php');
              $query="Select p.productName, pi.inventoryQty, p.sku, p.wholesalePrice, p.retailPrice from products p join perpetualinventory pi on p.productID = pi.productID  WHERE pi.username='{$_SESSION['username']}'and pi.active=1";
              $result=mysqli_query($dbc,$query);
              while($row = $result->fetch_assoc()) {
                if($row["inventoryQty"]<=10){

                  echo "<tbody><tr class='productLow'>
                  <td>".$row["sku"]."</td>
                  <td>".$row["productName"]."<input type=hidden name='productName[]' value=".$row["productName"]."></td>
                  <td>".$row["inventoryQty"]."<input type=hidden class=inventoryQty name='inventoryQty' value=".$row["inventoryQty"]."></td> 
                  <td align=right>".$row["wholesalePrice"]."</td>
                  <td align=right>".$row["retailPrice"]."</td>
                </tr></tbody>";

              }   
            }

            ?>
            <p></p>

            <p></p>

          </table>

          <span ng-controller="ModalDemoCtrl">
            <script type="text/ng-template" id="myModalContent.html">
              <div ng-include="'tpl/modal.form.html'"></div>
            </script>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<script>
  var rowCount = 0;
  var quantityCount=0;
  $('.productLow').each(function(){
    rowCount++;

  });

  $('.inventoryQty').each(function(){
    quantityCount += parseFloat(this.value);

  });

  if(rowCount==0){
    $("#confirm").prop('disabled', true); 
  }

  var x = document.getElementById("qtyLow");
  x.setAttribute("value", quantityCount);

  var y = document.getElementById("lowSku");
  y.setAttribute("value", rowCount);

</script>



</body>

</html>
