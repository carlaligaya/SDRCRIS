
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
   <?php include '../session/levelOfAccess.php';
   $conNum=$_GET['conNum'];
   ?>
   
   <!-- / nav -->

   <?php
   if ($_SESSION['usertype']!=101){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
  }
  ?>


  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">

      <form>
        <div class="bg-light lter b-b wrapper-md hidden-print">
          <button name="conNum" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
          <h1 class="m-n font-thin h3"> Spoilage Products /SP- <input type=text style="border:none;background:none" readonly name="conNum" value="<?php echo $conNum; ?>"/></h1>
        </div>
      </form>

      <div class="wrapper-md">
        <?php 
        $conNum=$_GET['conNum'];
        require_once('../../mysqlConnector/mysql_connect.php');
        $query="Select distinct controlNum, concat(i.fName,' ',i.lName) as distributorName, DATE(pullOutDate) AS pullOutDate, concat(i.address,' ',i.city) as address From pullouts p join users u on p.distributorName=u.username join usersinfo i on u.userID=i.userID where controlNum = '$conNum'";
        $result=mysqli_query($dbc,$query);
        while($row = $result->fetch_assoc()) {
          echo"
            <p class=m-t m-b>Dealer: <strong>".$row["distributorName"]."</strong><br>
             Address: <strong>".$row["address"]."</strong><br>
             Pullout Date: <strong>".$row["pullOutDate"]."</strong><br>
             Control Number: <strong>".$row["controlNum"]."</strong><br>
           </p>";
        }
        
       ?>
       <div class="wrapper-md"><div class="wrapper-md bg-white-only b-b">
            <div class="row text-center">
              <div class="col-sm-3 col-xs-6" >
                <div>Quantity of Pullout Products <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
                <input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="qtyPullout"/>
              </div>

              <div class="col-sm-3 col-xs-6">
                <div>Net Loss (in PESOS)<i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
                <input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="netLoss"/>
              </div>

            </div>
          </div>
       <div>
        
        <div class="line"></div>
        <table class="table table-striped bg-white b-a">
          <thead>
            <tr>
              <th style="width: 20%">QTY</th>
              <th style="width: 20%">SKU</th>
              <th style="width:20%">DESCRIPTION</th>
              <th style="width:20%">Unit</th>
              <th style="width:9%">Unit Price</th>
              <th style="width:9%">TOTAL</th>
            </tr>
          </thead>
          <?php
          $conNum=$_GET['conNum'];
          require_once('../../mysqlConnector/mysql_connect.php');
          $query="Select p.sku, p.productName, u.pullOutQty, p.unitPrice, (p.unitPrice * u.pullOutQty) AS total, p.qtyUnit From pullouts2 u join products p on u.productID=p.productID where u.controlNum='$conNum'";
          $result=mysqli_query($dbc,$query);
          while($row = $result->fetch_assoc()){
            echo"
            <tbody><tr class='productRows'>
                <td >".$row["pullOutQty"]."<input type=hidden name=pullOutQty class=pullOutQty value=".$row["pullOutQty"]."></td>
                <td >".$row["sku"]."</td>
                <td>".$row["productName"]."</td>
                <td>".$row["qtyUnit"]."</td>
                <td style=text-align:right>".$row["unitPrice"]."</td>
                <td style=text-align:right>".$row["total"]."<input type=hidden name=unitPrice class=unitPrice value=".$row["total"]."></td>
                <td></td> 
              </tr></tbody>
            ";
          }
          ?>
            
        </table> 

        
      </div>
    </div>


  </div>
</div>
<!-- /content -->





</div>
<script>
var loss = 0;
var quantityCount=0;
  $('.unitPrice').each(function(){
    loss+=parseFloat(this.value);

 });

  $('.pullOutQty').each(function(){
    quantityCount += parseFloat(this.value);

 });


 var x = document.getElementById("qtyPullout");
 x.setAttribute("value", quantityCount);

 var y = document.getElementById("netLoss");
 y.setAttribute("value", loss);

</script>


</body>
</html>
