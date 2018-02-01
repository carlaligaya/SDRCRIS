
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
  <h1 class="m-n font-thin h3">Invoice List</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      Invoices
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:20%">Invoice Number</th>
            <th  style="width:25%">Invoice Date</th>
            <th  style="width:25%">Dealer Name</th>
            <th  style="width:15%">Status</th>
          </tr>
        </thead>
        <tbody>
        <?php

              require_once('../../mysqlConnector/mysql_connect.php');
              $query="Select distinct invoiceNo, concat(i.fName,' ',i.lName) as distributorName, DATE(invoiceDate) AS invoiceDate From invoice p join users u on p.username=u.username join usersinfo i on u.userID=i.userID order by invoiceNo desc;";
              $result=mysqli_query($dbc,$query);
              while($row = $result->fetch_assoc()) {
                $invoiceNo=$row["invoiceNo"];
                echo "<tr class='productRows'>
                <td >INV-<input type=button name=invoiceNo id=happy class=cN style=border:none;background:none value=".$invoiceNo."></td>
                <td>".$row["invoiceDate"]."<input type=hidden name=invoiceDate value=".$row["invoiceDate"]."></td>
                <td>".$row["distributorName"]."<input type=hidden name=distributorName value=".$row["distributorName"]."></td>";

                $queryStatus="select status from invoice where invoiceNo='{$invoiceNo}'";
                $resultStatus=mysqli_query($dbc,$queryStatus);
                while($row = $resultStatus->fetch_assoc()) {
                  $status=$row["status"];
                  if ($status==0) {
                    echo"<td><span class='label bg-warning'>Unpaid</span></td>";
                  }else if($status==1){
                    echo"<td><span class='label bg-success'>Paid</span></td>";
                  }
                }


                 
              echo "
              </tr>";
            }

            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



	</div>
  </div>
  <form id="form" action="admin_invoice.php" method="get">
            <input type="text" style="display:none" id="conNum" name="conNum" />
   </form>
  <!-- /content -->
  
  



</div>

<script>

  $(document).on('click', '#happy', function(e){
    e.preventDefault();
    var cN =  $(this).closest ('tr').find(".cN").val();
    document.getElementById('conNum').setAttribute('value',cN);
    $("#form").submit();

  });

</script>

</body>
</html>
