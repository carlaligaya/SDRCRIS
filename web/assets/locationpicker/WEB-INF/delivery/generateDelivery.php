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
  <h1 class="m-n font-thin h3">Generate Delivery</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      Customers

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
                <div class="text-center">
                  Customers : <select name="sel_name">
                  <?php
                  require_once('../../mysqlConnector/mysql_connect.php');
                  $query="
                  SELECT distinct username
                  FROM allocation
                  WHERE receiptGenerated=0";
                  $result=mysqli_query($dbc,$query);
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["username"].">".$row["username"]."</option>";
                  }
                  ?>
                </select>  <input class="btn btn-default" type="submit" name="submit" value="Search" />
              </div>
            </form>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
    <div class="table-responsive">
      <table class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:25%">Dealer Name</th>
            <th  style="width:25%">Product Name</th>
             <th  style="width:15%">Quantity</th>
            <th  style="width:15%">Exipation Date</th>
              
          </tr>
        </thead>
        <tbody>
              <?php  
              if (isset($_POST['submit'])){
                $username=$_POST['sel_name'];
                $query="
                  SELECT distinct a.username, p.productName, a.qtyAllocated, a.expirationDate, p.productID, a.purchaseNo
                  FROM allocation a
                  JOIN products p
                  ON a.productID=p.productID
                  WHERE receiptGenerated=0 AND a.username='{$username}'";
                $result=mysqli_query($dbc,$query);
                while ($row = $result->fetch_assoc()) {
                  echo "<tr class='productRows'>
                  <td>".$row["username"]."<input type=hidden name='name' value=".$row["username"]."></td>
                  <td>".$row["productName"]."<input type=hidden name='productID[]' value=".$row["productID"]."></td> 
                  <td>".$row["qtyAllocated"]."<input type=hidden name='qtyAllocated[]' value=".$row["qtyAllocated"]."></td>
                  <td>".$row["expirationDate"]."<input type=hidden name='expirationDate[]' value=".$row["expirationDate"]."><input type=hidden name='purchaseNo[]' value=".$row["purchaseNo"]."></td>
                  </tr>";
                }
              }

              ?>
        </tbody>
      </table>
    </div>
    <button type="submit" class="btn btn-default pull-right" name="confirm">Confirm</button>
    </form>
  </div>
</div>



	</div>
  </div>
  <!-- /content -->
  
  <?php  
  $items = array();
  $pairs3 = array();
  if (isset($_POST['confirm'])){
    $name=$_POST['name'];
    $productID=$_POST['productID'];
    $qtyAllocated=$_POST['qtyAllocated'];
    $expirationDate=$_POST['expirationDate'];
    $purchaseNo=$_POST['purchaseNo'];
    $deliveredBy="n/a";
    $cancel=0;

    $sql = "SELECT MAX(`drNumber`) AS drNumber FROM `delivery`";
    $result=mysqli_query($dbc,$sql);
    while ($row = $result->fetch_assoc()) {
      $drNumber=$row["drNumber"];
      $drNumber=$drNumber+1;
    }
    $drNumber;

    foreach ($productID as $key => $value) {
      $items[] = array(
       'productID' => $productID[$key],
       'qtyAllocated' =>  $qtyAllocated[$key],
       'expirationDate' =>  date('Y-m-d', strtotime($expirationDate[$key]))
      );
    }

  
    foreach($items as $key=>$value){

      $pairs3[] = '('.intval($value['productID']).','.intval($value['qtyAllocated']).',"'.$value['expirationDate'].'",'."'$name'".','."'$deliveredBy'".','."'$drNumber'".','."'$cancel'".')';
    }

    //print_r($pairs3);

    $sql = "INSERT INTO `delivery`(`productID`, `quantityDR`,`expiryDate`,`distributorName`, `deliveredBy`, `drNumber`, `cancel`) VALUES".implode(',',$pairs3);
    $result=mysqli_query($dbc,$sql);

    // echo $sql;

    $sql = "UPDATE allocation set receiptGenerated=1 WHERE purchaseNo IN ('".implode($purchaseNo,"', '")."') AND username='{$name}' AND productID IN ('".implode($productID,"', '")."')";
    $result=mysqli_query($dbc,$sql);

  }
  ?>



</div>



</body>
</html>
