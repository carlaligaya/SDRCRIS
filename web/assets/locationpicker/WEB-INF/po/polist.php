
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
  <h1 class="m-n font-thin h3">Purchase Order List</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      My Purchase Orders
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:20%">P.O Number</th>
            <th  style="width:20%">P.O Date</th>
            <th  style="width:15%">Status</th>
            <th  style="width:15%;text-align:right">Total</th>
            
          </tr>
        </thead>
        <tbody > 
              
           <?php  
            require_once('../../mysqlConnector/mysql_connect.php');

            $query="Select poNumber, DATE(datePurchase) AS datePurchase, ordered From purchase where username ='{$_SESSION['username']}' order by poNumber desc";
              $result=mysqli_query($dbc,$query);
              while($row = $result->fetch_assoc()) {
                $poNumber=$row["poNumber"];
                $ordered=$row["ordered"];

                

                echo "<tr class='productRows'>
                <td >PO-<input type=button name=controlNum id=happy class=pN style=border:none;background:none value=".$poNumber."></td>
                <td>".$row["datePurchase"]."<input type=hidden name=datePurchase value=".$row["datePurchase"]."></td>";
                
                $getTotal="select SUM(p.wholesalePrice* pu.purchaseQty) AS total from purchase2 pu join products p on pu.productID=p.productID where poNumber='{$poNumber}'";
                $resultTotal=mysqli_query($dbc,$getTotal);
                while($row = $resultTotal->fetch_assoc()) {
                  $total = $row["total"];
                }
                    $total;
                

                if($ordered==0){
                    echo " <td><span class='label bg-warning'>Unprocess</span></td> 
                ";
                  }else if ($ordered==1){
                    echo " <td><span class='label bg-success'>processed</span></td> 
                ";
                  }else if ($ordered==3){
                    echo " <td><span class='label bg-danger'>canceled</span></td> 
                ";
                  }
                  echo " <td style='text-align:right'>".$total."</td> </tr>";
            }

           ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<form id="form" action="PO.php" method="GET">
            <input type="text" style="display:none" id="poNum" name="poNum" />
          </form>


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
