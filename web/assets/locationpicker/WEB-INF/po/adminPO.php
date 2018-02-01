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
   $poNum=$_GET['poNum'];?>
   
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
        <h1 class="m-n font-thin h3">Purchase Orders / PO-<input type=text style="border:none;background:none" readonly name="poNum" value="<?php echo $poNum; ?>"/></h1>
      </div>

<div class="wrapper-md">
      <?php  
      require_once('../../mysqlConnector/mysql_connect.php');
      $query="SELECT DATE(datePurchase) AS datePurchase, ordered FROM purchase WHERE poNumber='{$poNum}'";
      $result=mysqli_query($dbc,$query);
      while($row = $result->fetch_assoc()) {
        echo "<p class='m-t m-b'>P.O Date: <strong>".$row["datePurchase"]."</strong><br>
         P.O ID: <strong>PO-<input type=text style='border:none;background:none' readonly name='poNum' value=".$poNum."></strong><br> ";

        if($row["ordered"]==0){
                    echo " <td>Status: <span class='label bg-warning'>Unprocess</span></td> 
                </tr>";
                  }else if ($row["ordered"]==1){
                    echo " <td>Status: <span class='label bg-success'>processed</span></td> 
                </tr>";
                  }else if ($row["ordered"]==3){
                    echo " <td>Status: <span class='label bg-danger'>canceled</span></td> 
                </tr>";
                  }
      }
      ?>
       </p>
       <div>
        <div class="well m-t bg-light lt">
          <div class="row">
            <div class="col-xs-6">
            <?php  
            require_once('../../mysqlConnector/mysql_connect.php');
            $query1="SELECT u.userID FROM purchase p JOIN users u ON p.username=u.username WHERE p.poNumber='{$poNum}'";
            $result1=mysqli_query($dbc,$query1);
            while($row = $result1->fetch_assoc()) {
              $userID=$row["userID"];
            }
            $userID;

            $query2="SELECT concat(i.fName,' ',i.lName) as distributorName, i.address, i.city, i.contactNum, i.emailAdd FROM usersinfo i WHERE i.userID='{$userID}'";
              $result2=mysqli_query($dbc,$query2);
              while($row = $result2->fetch_assoc()) {
                echo "<strong>Customer:</strong>
                <h4>".$row["distributorName"]."</h4>
                <p>
                ".$row["address"]."<br>
                ".$row["city"]."<br>
                Phone: ".$row["contactNum"]."<br>
                Email: ".$row["emailAdd"]."<br>
              </p>";
              }


            ?>
            </div>
            
          </div>
        </div>
        <div class="line"></div>
        <table class="table table-striped bg-white b-a">
          <thead>
            <tr>
              <th style="width:15%">QTY</th>
              <th style="width: 15%">SKU</th>
              <th style="width:30%">DESCRIPTION</th>
              
              <th style="width: 14%">UNIT PRICE</th>
              <th style="width: 15%;text-align:right">TOTAL</th>
            </tr>
          </thead>
          <tbody>
            <?php  
          $query="Select pu.purchaseQty, p.productName, p.sku, p.wholesalePrice, p.productID From purchase2 pu join products p on pu.productID=p.productID where pu.poNumber = '{$poNum}'";
          $result=mysqli_query($dbc,$query);
          while($row = $result->fetch_assoc()) {
            echo "  <tr class='productRows'>
                <td >".$row["purchaseQty"]."<input type=hidden name=purchaseQty class=purchaseQty value=".$row["purchaseQty"]."></td>
                <td >".$row["sku"]."</td>
                <td>".$row["productName"]."</td>
                <td style=text-align:right>".$row["wholesalePrice"]."</td>";

                $query1="Select (pu.purchaseQty*p.wholesalePrice) as total From purchase2 pu join products p on pu.productID=p.productID where pu.poNumber = '{$poNum}' and pu.productID='{$row["productID"]}'";
                $result1=mysqli_query($dbc,$query1);
                while($row = $result1->fetch_assoc()) {
                      $total=$row["total"];
                }

                echo "<td style=text-align:right>".$total."<input type=hidden name=unitPrice id=total class=total class=unitPrice value=".$total."></td>
                <td></td> 
              </tr>";
        }
          ?>
            <tr>
            <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
          <td colspan="5    "style="text-align:right"><strong><span>₱</span><input type="number" style="border:none;text-align:right" readonly id="subTotal"/></strong></td>
        </tr>
        
        <tr>
          <td colspan="4" class="text-right no-border"><strong>12% VAT</strong></td>
          <td colspan="5    "style="text-align:right"><strong><span>₱</span><input type="number" style="border:none;text-align:right" readonly id="VAT"/></strong></td>
        </tr>
        <tr>
          <td colspan="4    " class="text-right no-border"><strong>Total</strong></td>
          <td colspan="5    "style="text-align:right"><strong><span>₱</span><input type="number" style="border:none;text-align:right" readonly id="grandTotal"/></strong></td>
        </tr>
          </tbody>
        </table> 
        
      
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
