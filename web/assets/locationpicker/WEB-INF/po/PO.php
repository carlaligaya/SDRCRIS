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
  

 <!-- header -->
<?php include '../session/levelOfAccess.php';
$poNum=$_GET['poNum'];?>
<!-- / nav -->

<?php
if ($_SESSION['usertype']!=102){
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
$query="Select date(datePurchase) as datePurchase, ordered From purchase where poNumber = '{$poNum}'";
        $result=mysqli_query($dbc,$query);
        while($row = $result->fetch_assoc()) {
          echo "  <p class='m-t m-b'>P.O Date: <strong>".$row["datePurchase"]."</strong><br>";
          $ordered=$row["ordered"];
        }
        $ordered;

?>
   
        P.O ID: <strong>PO-<input type=text style="border:none;background:none" readonly name="poNum" value="<?php echo $poNum; ?>"/></strong><br>
    </p>
  <div>
    
    <div class="line"></div>
    <table class="table table-striped bg-white b-a">
      <thead>
        <tr>
          <th style="width: 15%">QTY</th>
            <th style="width: 15%">SKU</th>
            <th style="width:30%">DESCRIPTION</th>
        
            <th style="width: 14%">PURCHASE PRICE</th>
          <th style="width:15%;text-align:right">TOTAL</th>
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
          <td colspan="4   " class="text-right no-border"><strong>Grand Total</strong></td>
          <td><strong><span>₱</span><input type="number" style="border:none;text-align:right" readonly id="grandTotal"/></strong></td>
        </tr>
      </tbody>
    </table> 
     
      <?php

      $queryOR="SELECT ordered From purchase where poNumber = '{$poNum}'";
        $resultOR=mysqli_query($dbc,$queryOR);
        while($row = $resultOR->fetch_assoc()) {
          $ordered1=$row["ordered"];
        }
        $ordered1;

	$query="SELECT ABS(DATEDIFF(datePurchase, CURDATE())) as days FROM purchase WHERE poNumber='{$poNum}';";
	 
       $result=mysqli_query($dbc,$query);

		
        while($row = $result->fetch_assoc()) {
	
          $days=$row["days"];
        }
        $days;

      if($ordered1==3){
         echo "<button name=cancel class='btn m-b-xs w-xs btn-danger' disabled>Cancel P.O</button>";
      }else{
        if($days>3){
        echo "<button name=cancel class='btn m-b-xs w-xs btn-danger' disabled>Cancel P.O</button>";
      }else{
        echo "<form action='PO.php' method='POST'><button type='hidden-print' name=cancel class='btn m-b-xs w-xs btn-danger' >Cancel P.O</button>
        <input type=hidden name=poNumber value='$poNum' ></form>";
      }
      }
      
      ?>

      <?php  
      if (isset($_POST['cancel'])){
        $poNumber=$_POST['poNumber'];
        //echo $deletePO2;
        //echo $deletePO;

        $deletePO="UPDATE purchase SET ordered=3 WHERE poNumber='{$poNumber}'";
        $result=mysqli_query($dbc,$deletePO);

        header("location:polist.php"); 
    exit;
      }
      ?>
  </div>
</div>


	</div>
  </div>
  <!-- /content -->
  
 



</div>

<script>
var quantityCount=0;

  $('.total').each(function(){
    quantityCount += parseFloat(this.value);

 });

 var x = document.getElementById("grandTotal");
 x.setAttribute("value", quantityCount);


</script>
</body>
</html>
