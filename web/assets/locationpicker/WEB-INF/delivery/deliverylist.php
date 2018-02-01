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
        <h1 class="m-n font-thin h3">Delivery List</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Delivery Receipts
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-b">
              <thead>
                <tr>
                  <th  style="width:20%">Delivery Number</th>
                  <th  style="width:25%">Dealer Name</th>
                  <th  style="width:25%">City</th>
                  <th  style="width:25%">Delivery Date</th>
                  <th  style="width:15%">Status</th>
                </tr>
              </thead>
              <tbody>
               <?php  
               require_once('../../mysqlConnector/mysql_connect.php');

               $query="Select distinct p.drNumber, DATE(p.deliveryDate) AS datePurchase, u.userID, p.distributorName, p.cancel From delivery p JOIN users u ON p.distributorName=u.username order by p.drNumber desc";
               $result=mysqli_query($dbc,$query);
               while($row = $result->fetch_assoc()) {

                $poNumber=$row["drNumber"];
                $userID=$row["userID"];
                $Name=$row["distributorName"];
                $cancel=$row["cancel"];

                echo "<tr class='productRows'>
                <td ><input type=button name=controlNum id=happy class=pN style=border:none;background:none value=".$poNumber."></td>";

                $query1="SELECT concat(i.fName,' ',i.lName) as distributorName, i.city from usersinfo i where userID= '{$userID}'";
                $result1=mysqli_query($dbc,$query1);
                while($rows = $result1->fetch_assoc()) {
                  echo "
                  
                  <td>".$rows["distributorName"]."</td>
                  <td>".$rows["city"]."</td>";


                }

                echo "<td>".$row["datePurchase"]."<input type=hidden name=datePurchase value=".$row["datePurchase"]."></td>";

                if($cancel==1){
                  echo "<td><span class='label bg-danger'>cancel</span></td>";
                }else{
                  $query1="
                  SELECT distinct d.drNumber
                  FROM delivery d 
                  WHERE distributorName='{$Name}' and d.drNumber='{$poNumber}' and NOT exists
                  (SELECT distinct * FROM received r
                  WHERE r.drNumber = d.drNumber );";
                  $result1=mysqli_query($dbc,$query1);
                  while ($row1 = $result1->fetch_assoc()) {
                    echo "<td><span class='label bg-warning'>pending</span></td>";
                  }

                  $query2="
                  SELECT distinct d.drNumber
                  FROM delivery d 
                  WHERE distributorName='{$Name}' and d.drNumber='{$poNumber}' and exists
                  (SELECT distinct * FROM received r
                  WHERE r.drNumber = d.drNumber );";
                  $result2=mysqli_query($dbc,$query2);
                  while ($row2 = $result2->fetch_assoc()) {
                    echo "<td><span class='label bg-success'>received</span></td>";
                  }
                }
              }

              ?>
            </tbody>
          </table>
          <form id="form" action="deliveryreceipt.php" method="GET">
            <input type="text" style="display:none" id="poNum" name="poNum" />
            </form
          </div>
        </div>
      </div>



    </div>
  </div>
  <!-- /content -->





</div>

<script>

  $(document).on('click', '#happy', function(e){
    e.preventDefault();
    var pN =  $(this).closest ('tr').find(".pN").val();
    document.getElementById('poNum').setAttribute('value',pN);
    $("#form").submit();

  });

</script>

</body>
</html>
