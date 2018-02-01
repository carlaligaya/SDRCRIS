<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  


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
      <h1 class="m-n font-thin h3">Products</h1>
      <br><button class="btn m-b-xs  btn-default" data-toggle="modal" data-target="#modal">Create Product</button>
    </div>
    <div class="wrapper-md">
      <div class="panel panel-default">
        <div class="panel-heading">
          Master List of all products
        </div>
        <div>
          <table class="table" >
            <thead>

              <tr>
                <th data-breakpoints="xs">SKU</th>
                <th>Product Name</th>
                <th data-breakpoints="xs sm md" data-title="Status">Status</th>
                <th data-breakpoints="xs sm md" data-title="Status" style="text-align:right">Unit Price</th>
                <th data-breakpoints="xs sm md" data-title="Status" style="text-align:right">Wholesale Price</th>
                <th data-breakpoints="xs sm md" data-title="Status" style="text-align:right">Retail Price</th>
                <th data-breakpoints="xs sm md" data-title="Status">Shelf Life</th>
                <th data-breakpoints="xs sm md" data-title="Status"></th>
              </tr>
            </thead>
            <tbody>
              <tr data-expanded="true">
                <?php 
                require_once('../../mysqlConnector/mysql_connect.php');
                $query="select * from products order by sku";

                $result=mysqli_query($dbc,$query);
                while($row = $result->fetch_assoc()) {

                 if($row["productType"]==101 ){
                  $productType = "Active";
                  echo"

                  <tr>

                    <td class=sku>".$row["sku"]."</td>
                    <td class=pN>".$row["productName"]."</td>
                    <td >".$productType."</td> 
                    <td class=uP style=text-align:right;width:100px>".$row["unitPrice"]."</td>
                    <td class=wP style=text-align:right;width:100px>".$row["wholesalePrice"]."</td>
                    <td class=rP style=text-align:right;width:120px>".$row["retailPrice"]."</td>
                    <td class=sL style=text-align:center>".$row["shelfLife"]."</td>
                    <td class=pT style=display:none>".$row["productType"]."</td>
                    <td class=qtyU style=display:none>".$row["qtyUnit"]."</td>
                    <td class=pI style=display:none >".$row["productID"]."</td>
                    <td style=width:120px;><button type=button class=btn btn-info btn-lg id=openModal>Edit</button> </td>
                    <td style=width:120px><button type=button class=btn btn-info btn-lg id=openModalChangePrice>Change Price</button> </td>

                  </tr>
                  ";
                }

                else if($row["productType"]==102 ){
                  $productType = "Disabled";
                  echo"


                  <tr>
                    <td class=sku>".$row["sku"]."</td>
                    <td class=pN>".$row["productName"]."</td> 
                    <td >".$productType."</td>
                    <td class=uP style=text-align:right;width:100px>".$row["unitPrice"]."</td>
                    <td class=wP style=text-align:right;width:100px>".$row["wholesalePrice"]."</td>
                    <td class=rP style=text-align:right;width:120px>".$row["retailPrice"]."</td>
                    <td class=sL style=text-align:center>".$row["shelfLife"]."</td>
                    <td class=pT style=display:none>".$row["productType"]."</td>
                    <td class=qtyU style=display:none>".$row["qtyUnit"]."</td>
                    <td class=pI style=display:none >".$row["productID"]."</td>
                    <td style=width:120px><button type=button class=btn btn-info btn-lg id=openModal>Edit</button></td>
                    <td style=width:120px><button type=button class=btn btn-info btn-lg id=openModalChangePrice>Change Price</button> </td>
                  </tr>
                  ";
                }
              }
              ?>


            </tbody>
          </table>
          
      </div>
    </div>
  </div>



</div>
</div>
<!-- /content -->

</div>

<?php 

if (isset($_POST['submit'])){
  $sku= $_POST['sku'];
  $productID=$_POST['productID'];
  $productName=$_POST['productName'];
  $productType=$_POST['productType'];
  $qtyUnit=$_POST['qtyUnit'];
  $shelfLife=$_POST['shelfLife'];
  

  require_once('../../mysqlConnector/mysql_connect.php');
  $updateProduct=" Update products set productName='{$productName}', productType='{$productType}', qtyUnit='{$qtyUnit}', shelfLife='{$shelfLife}' where productID ='{$productID}'";
  $result=mysqli_query($dbc,$updateProduct);
  header("location: productlist.php");
  exit;

} 

if (isset($_POST['changePrice'])){
  $sku= $_POST['sku'];
  $productID=$_POST['productID'];
  $productName=$_POST['productName'];
  $productType=$_POST['productType'];
  $wholesalePrice=$_POST['wholesalePrice'];
  $retailPrice=$_POST['retailPrice'];
  $qtyUnit=$_POST['qtyUnit'];
  $unitPrice=$_POST['unitPrice'];
  $shelfLife=$_POST['shelfLife'];

  require_once('../../mysqlConnector/mysql_connect.php');

  $query="select * from products where productID='{$productID}'";
  $resultQuery=mysqli_query($dbc,$query);
  while($row = $resultQuery->fetch_assoc()) {
    if($row["productType"]==101){

      $disableProduct="Update products set productType=102 where productID='{$productID}'";
      $disableProductResult=mysqli_query($dbc,$disableProduct);

      $addProduct=" insert into products (sku, productName, productType, wholesalePrice, retailPrice, qtyUnit, unitPrice, shelfLife) values ('{$sku}','{$productName}','{$productType}','{$wholesalePrice}','{$retailPrice}', '{$qtyUnit}', '{$unitPrice}', '{$shelfLife}')";
      $addProductResult=mysqli_query($dbc,$addProduct);
      header("location: productlist.php");
      exit;
    }
    else if($row["productType"]==102){
      $addProduct1=" insert into products (sku, productName, productType, wholesalePrice, retailPrice, qtyUnit, unitPrice, shelfLife) values ('{$sku}','{$productName}','{$productType}','{$wholesalePrice}','{$retailPrice}', '{$qtyUnit}', '{$unitPrice}', '{$shelfLife}')";
      $addProductResult1=mysqli_query($dbc,$addProduct1);
      header("location: productlist.php");
      exit;
    }
  }
}

if (isset($_POST['createNewProduct'])){
  $sku=$_POST['sku'];
  $productName=$_POST['productName'];
  $productType=$_POST['productType'];
  $wholesalePrice=$_POST['wholesalePrice'];
  $retailPrice=$_POST['retailPrice'];
  $qtyUnit=$_POST['qtyUnit'];
  $unitPrice=$_POST['unitPrice'];
  $shelfLife=$_POST['shelfLife'];

  require_once('../../mysqlConnector/mysql_connect.php');

  $addNewProduct=" insert into products (sku, productName, productType, wholesalePrice, retailPrice, qtyUnit, unitPrice, shelfLife) values ('{$sku}','{$productName}','{$productType}','{$wholesalePrice}','{$retailPrice}', '{$qtyUnit}', '{$unitPrice}', '{$shelfLife}')";
  $addNewProductResult=mysqli_query($dbc,$addNewProduct);
  header("location: productlist.php");
  exit;
}
?>


<!-- Modal for create new product -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Create Product</h4>
      </div>
      <div class="modal-body2">

       <div class="panel-heading font-bold">All Fields are Required</div>
       <div class="panel-body">
        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
            <label>SKU</label>
            <input  class="form-control" type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min="0" name="sku" value="<?php if (isset($_POST['sku']) && !$flag) echo $_POST['sku']; ?>" placeholder="SKU Code" maxlength="7">
          </div>
          <div class="form-group">
            <label>Product Name</label>
            <input  class="form-control" value="<?php if (isset($_POST['productName']) && !$flag) echo $_POST['productName']; ?>" type="text" name="productName" placeholder="Product Name" required >
          </div>
          
          <div class="form-group">
            <label>Product Unit</label>
            <select name="qtyUnit" class="form-control" required>
              <option value="bottle">bottle</option>
              <option value="tub">tub</option>
              <option value="pcs">pcs</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Unit Price</label>
            <input type="number" step="0.01" min=0 name="unitPrice" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"  placeholder="Unit Price" required>
          </div>

          <div class="form-group">
            <label>wholesale Price</label>
            <input type="number" step="0.01" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min=0 name="wholesalePrice" class="form-control"  placeholder="Unit Price" required>
          </div>
          
          <div class="form-group">
            <label>Retail Price</label>
            <input type="number" step="0.01" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min=0 value="<?php if (isset($_POST['retailPrice']) && !$flag) echo $_POST['retailPrice']; ?>" name="retailPrice" class="form-control"  placeholder="Retail Price" required >
          </div>

          <div class="form-group">
            <label>Product Type</label>
            <select name="productType" class="form-control" required>
              <option value=101>101-Active</option>
              <option value=102>102-Disable</option>
            </select>
          </div>

          <div class="form-group">
            <label>Shelf Life</label>
            <input type="number" min="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="shelfLife" class="form-control"  placeholder="Shelf Life" required>
          </div>

          <input type="submit" name="createNewProduct" value="Create" class="btn btn-sm btn-primary"/>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>

    </div>
    
  </div>
  <div class="modal-footer">
  </div>
</div>
</div>
</div>
<!-- /Modal for create new product -->


<!-- Modal of Edit Product -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-body">
          <!--PRINT INFO-->
          <input type="text" value="text">
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-sm btn-primary" name="submit" value="Save" id="submit" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Modal of Edit Product -->


<!-- Modal of Change Price -->
<div class="modal fade" id="myModalChangePrice" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Price</h4>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-body">
          <!--PRINT INFO-->
          <input type="text" value="text">
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-sm btn-primary" name="changePrice" value="Change" id="changePrice" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Modal of Change Price -->


<script>


  $(document).on('click', "#openModal", function(){
   $(".modal-body").empty();
   $("#myModal").modal("show");

   var SKU =  $(this).closest ('tr').find(".sku").text();
   var pI =  $(this).closest ('tr').find(".pI").text();
   var pN =  $(this).closest ('tr').find(".pN").text();
   var pT =  $(this).closest ('tr').find(".pT").text();
   var qtyU = $(this).closest ('tr').find(".qtyU").text();
   var sL = $(this).closest ('tr').find(".sL").text();

   $(".modal-body").append('SKU: <input name="sku" id="sku" style=border:none;font-size:16px type="text" readOnly value="'+SKU+'"/><input name="productID" id="productID" type="text" style=display:none value="'+pI+'"/><br>');
   $(".modal-body").append('Shelf Life: <input name="shelfLife" style=border:none readOnly type="number" min=0 value="'+sL+'"/><br>');
   $(".modal-body").append('Product Name: <input name="productName" required type="text" value="'+pN+'"/><br>');
   

   if(pT==="101"){
     $(".modal-body").append('Product Type: <select name="productType" required id="productType"> <option value="'+pT+'">'+pT+'-Active</option> <option value=102>102-Disabled</option></select><br>');
   }
   else if(pT==="102"){
     $(".modal-body").append('Product Type: <select name="productType" required id="productType"> <option value="'+pT+'">'+pT+'-Disabled</option> <option value=101>101-Active</option></select><br>');
   }


   if(qtyU==="bottle"){
     $(".modal-body").append('Unit:  <select name="qtyUnit" required id="qtyUnit"> <option value="'+qtyU+'">'+qtyU+'</option> <option value="tub">tub</option><option value="pcs">pcs</option> </select><br>');
   }else if(qtyU==="tub"){
    $(".modal-body").append('Unit:  <select name="qtyUnit" required id="qtyUnit"> <option value="'+qtyU+'">'+qtyU+'</option>  <option value="bottle">bottle</option><option value="pcs">pcs</option> </select><br>');
  }else if(qtyU==="pcs"){
    $(".modal-body").append('Unit:  <select name="qtyUnit" required id="qtyUnit"> <option value="'+qtyU+'">'+qtyU+'</option> <option value="tub">tub</option> <option value="bottle">bottle</option></select><br>');
  }


});



  $(document).on('click', "#openModalChangePrice", function(){
   $(".modal-body").empty();
   $("#myModalChangePrice").modal("show");

   var SKU =  $(this).closest ('tr').find(".sku").text();
   var pI =  $(this).closest ('tr').find(".pI").text();
   var pN =  $(this).closest ('tr').find(".pN").text();
   var uP =  $(this).closest ('tr').find(".uP").text();
   var wP =  $(this).closest ('tr').find(".wP").text();
   var rP =  $(this).closest ('tr').find(".rP").text();
   var pT =  $(this).closest ('tr').find(".pT").text();
   var qtyU = $(this).closest ('tr').find(".qtyU").text();
   var sL = $(this).closest ('tr').find(".sL").text();

   $(".modal-body").append('SKU: <input name="sku" id="sku" style=border:none;font-size:16px type="text" readOnly value="'+SKU+'"/><input name="productType" id="productType" type="text" style=display:none value="'+pT+'"/><br>');
   $(".modal-body").append('Product Name: <input name="productName" style=border:none;font-size:16px  readOnly type="text" value="'+pN+'"/><input name="qtyUnit" id="qtyUnit" type="text" style=display:none value="'+qtyU+'"/><br>');
   $(".modal-body").append('Unit Price: <input name="unitPrice" required type="number" step="0.01" min=0 onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="'+uP+'"/><input name="shelfLife" id="shelfLife" type="number" style=display:none value="'+sL+'"/><br>');
   $(".modal-body").append('Wholesale Price: <input name="wholesalePrice" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required min=0 type="number" step="0.01" value="'+wP+'"/><input name="productID" id="productID" type="text" style=display:none value="'+pI+'"/><br>');
   $(".modal-body").append('Retail Price: <input name="retailPrice" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required type="number" step="0.01" min=0 value="'+rP+'"/><br>');              
 });

</script>
</body>
</html>
