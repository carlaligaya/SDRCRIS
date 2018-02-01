
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
   $conNum= $_GET['conNum'];?>
   
   <!-- / nav -->

   <?php
   if ($_SESSION['usertype']!=101){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");

  }
  ?>




  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">


      <div class="bg-light lter b-b wrapper-md hidden-print">
        <a href class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>
        <h1 class="m-n font-thin h3">Production Orders / PB-<?php echo $_GET['conNum'];?></h1>
      </div>
      <div class="wrapper-md">
        <?php  
        require_once('../../mysqlConnector/mysql_connect.php');

        $query="SELECT DATE(productionDate) as productionDate, produced FROM productionorder WHERE productionNo='{$conNum}'";
        $result=mysqli_query($dbc,$query);
        while($row = $result->fetch_assoc()) {
          $status=$row["produced"];
          echo "<p class='m-t m-b'>P.B Date: <strong>".$row["productionDate"]."</strong><br> ";
          if ($status==0) {
            echo"Status:<span class='label bg-danger'>Unprocessed</span><br>";
          }else if($status==1){
            echo"Status:<span class='label bg-warning'>Processed</span><br>";
          }

          echo "Production ID: <strong><input type=text style='border:none;background:none' readonly name='inNum' value=".$conNum."></strong>";

        }
        ?>
        <div>
          <div class="well m-t bg-light lt">
            <div class="row">


            </div>
          </div>
          <div class="line"></div>
          <table class="table table-striped bg-white b-a">
            <thead>
              <tr>
                <th style="width: 15%">QTY</th>
                <th style="width: 15%">SKU</th>
                <th style="width:30%">DESCRIPTION</th>
                <th style="width:14%;text-align:right">Unit Price</th>
                <th style="width:15%;text-align:right">Total</th>
              </tr>
            </thead>
            <tbody>

              <?php
              require_once('../../mysqlConnector/mysql_connect.php');


              $query="SELECT p.sku, po.qty, p.productName, p.unitPrice, (po.qty*p.unitPrice) as total FROM productionorder2 po JOIN products p ON p.productID=po.productID WHERE productionNo='{$conNum}'";
              $result=mysqli_query($dbc,$query);
              while($rows=$result->fetch_assoc()){

                echo "<tr>
                <td >".$rows['qty']."</td>
                <td >".$rows['sku']."</td>
                <td >".$rows['productName']."</td>
                <td style=text-align:right>".$rows['unitPrice']."</td>
                <td style=text-align:right>".$rows['total']."<input type=hidden name=unitPrice id=total class=total class=unitPrice value=".$rows['total']."></td>


              </tr>";
            }



            ?>
            <tr>
              <td colspan="4" class="text-right"><strong>Grandtotal</strong></td>
              <td colspan="5 " style="text-align:right"><strong><span>₱</span><input type="number" style="border:none;text-align:right" readonly id="subTotal"/></strong></td>
            </tr>

          </tbody>
        </table> 

        <button class="btn m-b-xs w-xs btn-danger">Cancel P.B</button>
      </div>
    </div>


  </div>
</div>
<!-- /content -->





</div>

<script>
var quantityCount=0;
var vat=0;
var grandTotal;

  $('.total').each(function(){
    quantityCount += parseFloat(this.value);

 });

 var x = document.getElementById("subTotal");
 x.setAttribute("value", quantityCount);

 vat=quantityCount*0.12;
 var v = document.getElementById("VAT");
 v.setAttribute("value", vat);

 grandTotal=vat+quantityCount;
 var g = document.getElementById("grandTotal");
 g.setAttribute("value",grandTotal);



</script>

</body>
</html>
