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
   if ($_SESSION['usertype']!=101){
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
        <h1 class="m-n font-thin h3">Production Order</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Create Production Order
          </div>
          <div class="wrapper-md">

           <b>Products to be Ordered
           </b> <br>
           <!--  <button type="submit" name="add" class="btn btn-default" id="add">Add Product</button><br> -->
           <form action="productionorder.php" method="post">
            <div class="table-responsive">
              <table  class="table table-striped b-t b-b" id="myTable">
                <thead>
                  <tr>
                    <th  style="width:25%">SKU</th>
                    <th  style="width:25%">Product Name</th>
                    <th  style="width:10%">Quantity</th>
                    <th  style="width:10%">Produce</th>

                  </tr>
                </thead>
                <tbody id="tableList">
                 <?php

                 $output = NULL;

	//connect to db

                 $mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters


	//query db
//if not work use *
                 $resultSet=$mysqli->query("SELECT pu.poNumber,sku, productName, SUM(pu2.purchaseQty) as purchaseQty,pu2.productID, pu.poNumber FROM purchase pu JOIN purchase2 pu2
                  ON pu.poNumber=pu2.poNumber JOIN
                  products p ON p.productID=pu2.productID WHERE ABS(datediff(datePurchase, curdate())) >=3 and ordered='0' GROUP BY productID;");

                 $resultSet2=$mysqli->query("SELECT DISTINCT pu.poNumber FROM purchase pu WHERE ordered=0 and ABS(datediff(datePurchase, curdate())) >=3 ;");
                 While($row=$resultSet2->fetch_assoc()){
                  echo "
                  <input type=hidden name='poNumber[]' value=".$row['poNumber'].">";

                }
//SELECT p.poNumber FROM purchase p WHERE ABS(datediff(datePurchase, curdate())) >=3 and ordered='0';


                if($resultSet->num_rows>0){
                 while($rows=$resultSet->fetch_assoc()){

                  echo "<tr>
                  <td >".$rows['sku']."<input type=hidden name='productID[]' value=".$rows['productID']."></td>
                  <td >".$rows['productName']."</td>
                  <td >".$rows['purchaseQty']."</td>
                  <td><input type=number min=0 required name='orderQty[]' onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder=quantity>
                  </tr>";
                }
		//if no data output 
              }else{

                echo"No results";
              }


              if($resultSet->num_rows>0){
               while($rows=$resultSet2->fetch_assoc()){
                echo "
                <input type=hidden name='poNumber[]' value=".$row['poNumber'].">";
              }
            }

            ?>
          </tbody>
        </table>
        <button type="submit" name="confirm" class="btn btn-success">Submit</button> 


      </div>
    </form>

    <?php 
    if (isset($_POST['confirm'])){
     require_once('../../mysqlConnector/mysql_connect.php');
     $productID=$_POST['productID'];
     $purchaseQty=$_POST['orderQty'];
     $poNumber=$_POST['poNumber'];
//$orderQty = $mysqli->real_escape_string($_POST['orderQty']);


	  				 $queryUpdate1="UPDATE purchase SET ordered=1 WHERE poNumber IN ('".implode($poNumber,"', '")."')";
					 $result6=mysqli_query($dbc,$queryUpdate1);
					 
					  $queryInsertProduction="insert into productionorder (username,produced) values ('{$_SESSION['username']}',0)";
     $result=mysqli_query($dbc,$queryInsertProduction);
//------- /insert porductionorder -------

//------- get latest production order number -------
     $query2="select productionNo from productionorder order by productionNo DESC LIMIT 1";
     $result2=mysqli_query($dbc,$query2);
     while($row=$result2->fetch_assoc()) {
      $productionNo=$row["productionNo"];
    }
    $productionNo;
//------- /get latest production order number -------

    $items = array_combine($productID,$purchaseQty);
    $pairs = array();

    foreach($items as $key=>$value){
      $pairs[] = '('.intval($key).','.intval($value).','."'$productionNo'".')';
    }

//------- insert porductionorder2 -------
    $query3= "INSERT INTO productionorder2 (productID, qty, productionNo) values".implode(',',$pairs);
    $result3=mysqli_query($dbc,$query3);
//------- /insert porductionorder2 -------

//------- insert produced -------
		$query4="INSERT INTO produced(produced) VALUES ('0');";
		 $result4=mysqli_query($dbc,$query4);
//-------/ insert produced -------

//-------get latest production number FROM produced -------
		$query5="select productionNo from produced order by productionNo DESC LIMIT 1;";
		 $result5=mysqli_query($dbc,$query5);
		 while($row=$result5->fetch_assoc()) {
      $prodN=$row["productionNo"];
    }
    $prodN;
//-------/get latest production number FROM produced -------
$marcus=array();

//------- select qty from productionOrder2 -------
 $mysqli= NEW MySQLi("localhost","holly","milk","devapps");
 $resultSet1=$mysqli->query("select qty,productID from productionorder2 WHERE productionNo='{$productionNo}'");
 if($resultSet1->num_rows>0){
	 
	 
	 while($row = $resultSet1->fetch_assoc()) {
	 
	 $marcus[]= array(
	  'prod' =>$row['productID'],
	  'qty'=>$row['qty']);
	 
	 }
 }
		echo $productionNo;
			 
	$expire= "0000-00-00";
	$alloc="0";
	foreach($marcus as $key=>$value){
		$gina[]= '('.intval($value['prod']).','.intval($value['qty']).','."'$expire'".','."'$alloc'".','."'$productionNo'".')';
		
	}

//------- /select qty from productionOrder2 -------

//------- insert produced2 -------
$query7="INSERT INTO produced2 (productID,producedQty,expirationDate,allocated,productionNo) VALUES ".implode(',',$gina); 
$result7=mysqli_query($dbc,$query7);
//------- /insert produced2 -------
//
   header("location:productionorder.php"); 
   exit; 
					 } 
	
//------- update purchase -------

  ?>
</div>
</div> 
</div>
</div>
</div>
</div>



<!-- /content -->


</div>

<script>
 $(document).on('click', "#add", function(){
   var para = document.createElement("tr");
   var element = document.getElementById("tableList");
   para.setAttribute("class", "trList");
   element.appendChild(para);
   var e = document.getElementById("productChosen");
   var productID = e.options[e.selectedIndex].value;

   var productChosen = $("#productChosen").find(":selected").text();


   $(".trList").append('<td>'+productChosen+'<input type="number" style=display:none readOnly name="productID[]" value="'+productID+'"</td>');
   $(".trList").append('<td><input type="number" min="0" name="orderQty[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="quantity"/></td>');
   $(".trList").append('<td><input type="button" name="delete" id="delete" class="ibtnDel btn btn-outline btn-danger"  value=Delete ></td>');

   para.setAttribute("class", "trListSaved");
 });

 $(document).on('click', "#delete", function(event){
  $(this).closest("tr").remove();

});


</script>
</body>
</html>
