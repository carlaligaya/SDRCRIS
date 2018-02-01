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
    $inNum=$_GET['conNum'];?>
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
        <button type="button" class="btn btn-info btn-sm pull-right" id="openModal" data-toggle="modal" data-target="#myModal">Update Payment Status</button>
        <h1 class="m-n font-thin h3">Invoice / INV-<input type=text style="border:none;background:none" readonly name="inNum" value="<?php echo $inNum; ?>"/></h1>
      </div>

      <div class="wrapper-md">
        <?php  
        require_once('../../mysqlConnector/mysql_connect.php');

        $query="SELECT DATE(invoiceDate) as invoiceDate, DATE(DATE_ADD(invoiceDate,INTERVAL 7 DAY) )AS dueDate, status FROM invoice WHERE invoiceNo='{$inNum}'";
        $result=mysqli_query($dbc,$query);
        while($row = $result->fetch_assoc()) {
          $status=$row["status"];
          echo "<p class='m-t m-b'>Invoice Date: <strong>".$row["invoiceDate"]."</strong><br>
          Due Date: <strong>".$row["dueDate"]."</strong><br>
          ";
          if ($status==0) {
            echo"Payment status: <span class='label bg-warning'>Unpaid</span><br>";
           
            
            
            
          }
          else if($status==1){
            echo"Payment status:<span class='label bg-success'>Paid</span><br>";
            
					//$query12="UPDATE usersinfo SET usersinfo.rating='$updaterating' WHERE usersinfo.fName='Raph';";
					 //  $result12=mysqli_query($dbc,$query12);
            
            
			
			 $query10="SELECT u.userID FROM invoice p JOIN users u ON p.username=u.username WHERE p.invoiceNo='{$inNum}'";
        $result10=mysqli_query($dbc,$query10);
        while($row = $result10->fetch_assoc()) {
          $user=$row["userID"];
        }
        $user;
			
			$query13="SELECT DATE(invoiceDate) as invoiceDate, DATE(DATE_ADD(invoiceDate,INTERVAL 7 DAY) )AS dueDate,  
            ABS(DATEDIFF(invoiceDate,CURDATE())) as days FROM invoice WHERE invoiceNo='{$inNum}'";
            $result13=mysqli_query($dbc,$query13);
            

            
            while($row = $result13->fetch_assoc()) {
             
              $days=$row["days"];
            }
            $days;

            if($days<=7){
		  //formula here
		 	 
              $query10="SELECT DISTINCT( i.invoiceNo), ui.rating,i.username from usersinfo ui JOIN users u ON ui.userID=u.userID JOIN invoice i ON i.username=u.username WHERE i.invoiceNo=3;";
				 $result10=mysqli_query($dbc,$query10);
		   //what to use in where??
		     
            while($row = $result10->fetch_assoc()) {
             
              $rating=$row["rating"];
			  $first_number = 5;
$second_number = 2;
$sum_total = ($rating + $first_number);
$final=($sum_total/$second_number);
//round($final);

//$direct_text = 'The two variables added together = ';
//print($rating);
//print($second_number);
//print ($final);
		
            }
            
		

              $query11="UPDATE usersinfo SET usersinfo.rating='{$final}' WHERE usersinfo.userID='{$user}';";
              $result11=mysqli_query($dbc,$query11);
            }
			else{
				 
              $query10="SELECT DISTINCT( i.invoiceNo), ui.rating,i.username from usersinfo ui JOIN users u ON ui.userID=u.userID JOIN invoice i ON i.username=u.username WHERE i.invoiceNo=3;";
				 $result10=mysqli_query($dbc,$query10);
		   //what to use in where??
		     
            while($row = $result10->fetch_assoc()) {
             
              $rating1=$row["rating"];
			  $first_number1 = 1;
$second_number1 = 2;
$sum_total1 = ($rating1 + $first_number1);
$final1=($sum_total1/$second_number1);

$query15="UPDATE usersinfo SET usersinfo.rating='{$final1}' WHERE usersinfo.userID='{$user}';";
              $result15=mysqli_query($dbc,$query15);
				
				
			}
         
			}
      
    }

    echo "Invoice ID: <strong>INV-<input type=text style='border:none;background:none' readonly name='inNum' value=".$inNum."></strong>";

  }
  
  
  
  ?>
  
</p>
<div>
  <div class="well m-t bg-light lt">
    <div class="row">
      <div class="col-xs-6">
        <?php  
        $query1="SELECT u.userID FROM invoice p JOIN users u ON p.username=u.username WHERE p.invoiceNo='{$inNum}'";
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
        <th style="width: 15%">QTY</th>
        <th style="width: 15%">SKU</th>
        <th style="width:30%">DESCRIPTION</th>
        
        <th style="width: 14%">UNIT PRICE</th>
        <th style="width: 15%;text-align:right">TOTAL</th>
      </tr>
    </thead>
    <tbody>
      <?php  
      $query="Select pu.qty, p.productName, p.sku, p.wholesalePrice, p.productID From invoice2 pu join products p on pu.productID=p.productID where pu.invoiceNo = '{$inNum}'";
      $result=mysqli_query($dbc,$query);
      while($row = $result->fetch_assoc()) {
        echo "  <tr class='productRows'>
        <td >".$row["qty"]."<input type=hidden name=qty class=qty value=".$row["qty"]."></td>
        <td >".$row["sku"]."</td>
        <td>".$row["productName"]."</td>
        <td style=text-align:right>".$row["wholesalePrice"]."</td>";

        $query1="Select (pu.qty*p.wholesalePrice) as total From invoice2 pu join products p on pu.productID=p.productID where pu.invoiceNo = '{$inNum}' and pu.productID='{$row["productID"]}'";
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

<!-- modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Payment Status</h4>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <input type="hidden" name="conNum" value="<?php echo $inNum; ?>">
        <div class="modal-body">

          
          <!--PRINT INFO-->
          <p>Are you sure to change payment status?</p>
        </div>
        
        <div class="modal-footer">
          <a onclick="return confirm('Are you sure?')"><input type="submit" class="btn btn-sm btn-primary" name="update" value="Save" id="submit" /></a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
  
</div>
<!-- /modal -->
<!-- /content -->

<?php 
if(isset($_GET['update'])){
  $inNum=$_GET['conNum'];

  $queryStatus="select status from invoice where invoiceNo='{$inNum}'";
  $resultStatus=mysqli_query($dbc,$queryStatus);
  while($row = $resultStatus->fetch_assoc()) {
    $status=$row["status"];
    if ($status==0) {
      $queryChange="UPDATE invoice SET status=1 WHERE invoiceNo='{$inNum}'";
      $resultChange=mysqli_query($dbc,$queryChange);
    }else if($status==1){
      $queryChange="UPDATE invoice SET status=0 WHERE invoiceNo='{$inNum}'";
      $resultChange=mysqli_query($dbc,$queryChange);
    }
    header("location:admin_invoicelist.php"); 
    exit;
  }
}
?>



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
