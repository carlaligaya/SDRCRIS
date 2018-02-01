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
        <h1 class="m-n font-thin h3">Delivery Receipt # <input type=text style="border:none;background:none" readonly name="poNum" value="<?php echo $poNum; ?>"/></h1>
      </div>
      <div class="wrapper-md">
        <div>

          <div class="well m-t bg-light lt">
            <div class="row">
              <div class="col-xs-6">
                <?php  
                require_once('../../mysqlConnector/mysql_connect.php');
                $query1="SELECT u.userID FROM delivery p JOIN users u ON p.distributorName=u.username WHERE p.drNumber='{$poNum}'";
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
              <div class="col-xs-6">
                <strong>DETAILS</strong><br>
                <?php
                $query3="SELECT DISTINCT drNumber, DATE(deliveryDate) as deliveryDate, cancel FROM delivery WHERE drNumber='{$poNum}'"; 
                $result3=mysqli_query($dbc,$query3);
                while($row = $result3->fetch_assoc()) {
                  echo "<B>Date of Delivery:</B> ".$row["deliveryDate"]." <br>";
                  $cancelStatus=$row["cancel"];
                }

                if($cancelStatus==1){
                  echo "<td><B>Status: </B><span class='label bg-danger'>cancel</span></td>";
                }else{

                  $query1="
                  SELECT distinct d.drNumber
                  FROM delivery d 
                  WHERE d.drNumber='{$poNum}' and NOT exists
                  (SELECT distinct * FROM received r
                  WHERE r.drNumber = d.drNumber );";
                  $result1=mysqli_query($dbc,$query1);
                  while ($row1 = $result1->fetch_assoc()) {
                    echo "<td><B>Status: </B><span class='label bg-warning'>pending</span></td>";
                  }

                  $query2="
                  SELECT distinct d.drNumber
                  FROM delivery d 
                  WHERE d.drNumber='{$poNum}' and exists
                  (SELECT distinct * FROM received r
                  WHERE r.drNumber = d.drNumber );";
                  $result2=mysqli_query($dbc,$query2);
                  while ($row2 = $result2->fetch_assoc()) {
                    echo "<td><B>Status: </B><span class='label bg-success'>received</span></td>";
                  }
                }
                ?>
              </div>
            </div>
          </div>
          <div class="line"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <table class="table table-striped bg-white b-a">
              <thead>
                <tr>
                  <th style="width: 140px">SKU</th>
                  <th style="width: 140px">Product Name</th>
                  <th style="width: 50px;text-align:right">Wholesale Price</th>
                  <th style="width: 60px;text-align:center">Quantity</th>
                  <th style="width: 90px">EXPIRY DATE</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $query3="SELECT d.expiryDate, p.sku, p.productName, p.wholesalePrice, d.quantityDR FROM delivery d JOIN products p ON d.productID=p.productID WHERE d.drNumber='{$poNum}'";
                $result3=mysqli_query($dbc,$query3);
                while ($row = $result3->fetch_assoc()) {
                  echo "<tr>
                  <td >".$row["sku"]."</td>
                  <td >".$row["productName"]."</td>
                  <td style='text-align:right'>".$row["wholesalePrice"]."</td>
                  <td style='text-align:center'>".$row["quantityDR"]."</td>
                  <td >".$row["expiryDate"]."</td>
                </tr>";
              }
              ?>
              

            </tbody>
          </table>   
          <input type="hidden" name="poNum" value="<?php echo $poNum; ?>">
          <?php  
          if($cancelStatus==1){
            echo "<align='right'><button class='btn m-b-xs w-xs btn-danger' name='cancel' disabled>Cancel</button></align>"; 
          }else{
            echo "<align='right'><button class='btn m-b-xs w-xs btn-danger' name='cancel'>Cancel</button></align>"; 
          }
          ?>
        </form>
      </div>
    </div>
  </div>




</div>
</div>
<!-- /content -->
<?php 
if(isset($_GET['cancel'])){
  $poNum=$_GET['poNum'];

  $cancelQuery="UPDATE delivery set cancel=1 WHERE drNumber='{$poNum}'";
  $result4=mysqli_query($dbc,$cancelQuery);
  header("location:deliverylist.php"); 
  exit;
}
?>




</div>


</body>
</html>
