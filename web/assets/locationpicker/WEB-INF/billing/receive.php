
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
   if ($_SESSION['usertype']!=102){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
  }
  ?>


  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
     

      <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Receive Delivery</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Delivery Receipts
          </div>

          <div class="wrapper-md bg-white-only b-b">
            <div class="row text-center">

              
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
                <div>
                  Delivery Receipt Number : <select name="sel_name">
                  <?php
                  require_once('../../mysqlConnector/mysql_connect.php');
                  $query="
                  SELECT distinct d.drNumber
                  FROM delivery d 
                  WHERE distributorName='{$_SESSION['username']}' and cancel=0 and NOT exists
                  (SELECT distinct * FROM received r
                  WHERE r.drNumber = d.drNumber );";
                  $result=mysqli_query($dbc,$query);
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["drNumber"].">".$row["drNumber"]."</option>";
                  }
                  ?>
                </select>  <input class="btn btn-default" type="submit" name="submit" value="Search" />
              </div>
            </form>
          </div>
        </div>

        <div class="table-responsive">
          <table  ui-options="{
          sAjaxSource: 'api/datatable.json',
          aoColumns: [
          { mData: 'engine' },
          { mData: 'browser' },
          { mData: 'platform' },
          { mData: 'version' },
          { mData: 'grade' }
          ]
        }" class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:10%">SKU</th>
            <th  style="width:20%">Product Name</th>
            <th  style="width:12%;text-align:center;">Purchase Price</th>
            <th  style="width:10%;text-align:center;">Retail Price</th>
            <th  style="width:20%;text-align:center;">Delivery Qty</th>
            <th  style="width:15%">Unit</th>
            <th  style="width:15%">Expiration</th>
          </tr>
        </thead>
        <tbody>
          <?php  
          if(isset($_POST['submit'])){

            $drNumber=$_POST['sel_name'];
            $query2=" select drNumber, p.productID, p.productName, p.sku, p.qtyUnit, p.retailPrice, p.wholesalePrice, d.quantityDR, d.expiryDate from delivery d join products p on d.productID= p.productID where d.drNumber='{$drNumber}' order by p.sku";
            $result2=mysqli_query($dbc,$query2);
            echo "<form action=receive.php method=post>";
            while($row = $result2->fetch_assoc()) {
              echo"
              <tbody>
                <tr class='productRows'>
                  <td>".$row["sku"]."</td>
                  <td>".$row["productName"]."<input type=hidden name='drNumber' value=".$row["drNumber"]."></td> 
                  <td align='right'>".$row["wholesalePrice"]."</td>
                  <td align='right'>".$row["retailPrice"]."</td>
                  <td><input type=number style='text-align:right;' required onkeypress='return event.charCode >= 48 && event.charCode <= 57' min=0 name='qtyRec[]' class='receiveQty' value=".$row["quantityDR"]."></td>
                  <td>".$row["qtyUnit"]." <input type=hidden name='productID[]' value=".$row["productID"]."></td>
                  <td>".$row["expiryDate"]."<input type=hidden name='expiryDate' value=".$row["expiryDate"]."></td>
                </tr>
              </tbody>";
            }

            
          }
          ?>
        </tbody>
      </table>
      <br>
      <?php  
      echo "<div><button class='btn btn-success' type=submit id=confirmR name=confirmR value=Confirm />Confirm Receive</button></div>";
      echo "</form>";
      ?>
      <br>
    </div>
  </div>
</div>



</div>
</div>
<!-- /content -->

<?php  
if(isset($_POST['confirmR'])){
  
  $drNumber=$_POST['drNumber'];
  $qtyRec=$_POST['qtyRec'];
  $productID=$_POST['productID'];
  $expiryDate=$_POST['expiryDate'];
  
  $items= array_combine($productID,$qtyRec);
  $pairs = array();
  
  foreach($items as $key=>$value){
    $pairs[] = '('.intval($key).','.intval($value).','.$drNumber.','."'{$_SESSION['username']}'".')';
  }
                //add to received table
  $query="INSERT INTO received (productID, quantityRC, drNumber, receivedBy) values".implode(',',$pairs);
  $result=mysqli_query($dbc,$query);
  
                //add to inventory
  
                    //not yet exist inventory
  $searchNotExist="select r.productID, r.quantityRC, r.dateReceived
  from received r 
  where drNumber='{$drNumber}'";
  $nExist=mysqli_query($dbc,$searchNotExist);
  while($row = $nExist->fetch_assoc()) {
    $insertIntoData="insert into perpetualinventory (productID, inventoryQty, dateInstance, username, expiryDate, active, pulloutStat) values ('{$row["productID"]}','{$row["quantityRC"]}','{$row["dateReceived"]}','{$_SESSION['username']}','{$expiryDate}','1','0')";
    $insertResult=mysqli_query($dbc,$insertIntoData);
  }

  $productIDsold = array();
  
  $qtySold = array();
  $soldItem = array();
  $pairs = array();
  $mysqli= NEW MySQLi("localhost","holly","milk","devapps");
  $resultSet=$mysqli->query("SELECT r.productID, sum(r.qtySR)as qtySR  FROM sales s JOIN salessr r ON s.receiptNum=r.receiptNum WHERE s.status=0 GROUP BY r.productID");

  $sold= array();
  if($resultSet->num_rows>0){
  while($row = $resultSet->fetch_assoc()) {
    //$receiptNum = $row['receiptNum'];
    $productIDsold=$row['productID'];
    $qtySold=$row['qtySR'];

    $sold[] = array( 
      'productID' => $row['productID'],
       'qtySR' => $row['qtySR']
    );
  }

  $insertInvoice="insert into invoice (username, status) values('{$_SESSION['username']}',0) ";
  $resultInsert=mysqli_query($dbc,$insertInvoice);

  $getLatest="select invoiceNo from invoice order by invoiceNo DESC LIMIT 1";
  $resultLatest=mysqli_query($dbc,$getLatest);
  while ($row=$resultLatest->fetch_assoc()) {
    $invoiceNo=$row["invoiceNo"];
  }
  $invoiceNo;
  $total=0;

  foreach($sold as $key=>$value){

    $pairs[] = '('.intval($value['productID']).','.intval($value['qtySR']).','."'$invoiceNo'".','."'$total'".')';
  }

  //print_r($pairs);

  $insertProducts="insert into invoice2 (productID, qty, invoiceNo, total) values".implode(',',$pairs);
  $resultInsertProduct=mysqli_query($dbc,$insertProducts);
  
  $closeInvoice="Update sales set status=1 where status=0 ";
  $resultClose=mysqli_query($dbc,$closeInvoice);
  
  }
  
  echo "<script>alert('success');</script>";
  
}

?>



</div>

<script>
  var rowCount = 0;
  var quantityCount=0;
  $('.productRows').each(function(){
    rowCount++;

  });

  $('.receiveQty').each(function(){
    quantityCount += parseFloat(this.value);

  });

  if(rowCount==0){
    $("#confirmR").prop('disabled', true); 
  }

  var x = document.getElementById("qtyReceive");
  x.setAttribute("value", quantityCount);

  var y = document.getElementById("receiveSku");
  y.setAttribute("value", rowCount);

</script>

</body>
</html>
