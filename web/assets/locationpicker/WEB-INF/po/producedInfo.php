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
if ($_SESSION['usertype']!=104){
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");

}
?>

  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    

<div class="bg-light lter b-b wrapper-md hidden-print">
  <a href class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>
  <h1 class="m-n font-thin h3">Production Order / PR-<input type=text style="border:none;background:none" readonly name="poNum" value="<?php echo $poNum; ?>"/></h1>
</div>
<div class="wrapper-md">
<?php  
require_once('../../mysqlConnector/mysql_connect.php');
$query="Select date(producedDate) as datePurchase From produced where productionNo = '$poNum'";
        $result=mysqli_query($dbc,$query);
        while($row = $result->fetch_assoc()) {
          echo "  <p class='m-t m-b'>Production Date: <strong>".$row["datePurchase"]."</strong><br>";
        }

?>
   
        P.O ID: <strong>PO-<input type=text style="border:none;background:none" readonly name="poNum" value="<?php echo $poNum; ?>"/></strong><br>
    </p>
  <div>
    
    <div class="line"></div>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    <table class="table table-striped bg-white b-a">
      <thead>
        <tr>
          <th style="width: 15%">SKU</th>
            <th style="width: 15%">Product Name</th>
            <th style="width:30%">Quantity</th>
        
            <th style="width: 14%">Produced Quantity</th>

        </tr>
      </thead>
      <tbody>
          <?php  
          $query="Select p.sku,p.productName,p2.producedQty,p.productID FROM produced2 p2 JOIN products p ON p2.productID=p.productID where p2.productionNo = '{$poNum}'";
          $result=mysqli_query($dbc,$query);
          while($row = $result->fetch_assoc()) {
            echo "  <tr class='productRows'>
                <td >".$row["sku"]."<input type=hidden  name='productID[]' class=productID value=".$row["productID"]."></td>
                <td >".$row["productName"]."<input type=hidden name='poNum' class=productID value=".$poNum."></td>
                <td>".$row["producedQty"]."<input type=hidden name='producedQty[]' class=producedQty value=".$row["producedQty"]."></td>
                <td ><input type=number onkeypress='return event.charCode >= 48 && event.charCode <= 57'required min='0' name=qtyProduced class=qtyProduced value=".$row["producedQty"]."></td>

               
              </tr>";
        }
          ?>
        
        
      </tbody>
    </table> 
     <button name="submit"  >Submit</button>
            
          </form>
      <?php
	  if(isset($_GET['submit'])){
		  $poNum=$_GET['poNum'];
		  $producedQty=$_GET['qtyProduced'];
		  $productID=$_GET['productID'];
		 $query2="UPDATE produced SET produced=1 WHERE productionNo='{$poNum}'";
          $result2=mysqli_query($dbc,$query2);

		$query3="update produced2 p2
inner join products p on
    p2.productID = p.productID
set p2.expirationDate= DATE(DATE_ADD(curdate(),INTERVAL p.shelfLife DAY) ) 
WHERE  p2.productionNo='{$poNum}' and p.productID IN ('".implode($productID,"', '")."')";
		        $result3=mysqli_query($dbc,$query3);
				
	
				
				
        header("location:produced.php"); 
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
