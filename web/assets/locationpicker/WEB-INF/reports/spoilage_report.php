
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

   <!-- modal -->

    <?php include '../view/modal.html';?>
   <!-- /modal -->

   <!-- content -->
   <div id="content" class="app-content" role="main">
     <div class="app-content-body ">


      <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Spoilage Products</h1>
      </div>
      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
           Spoilage Products List
         </div>
         <div class="wrapper-md">
           <div class="wrapper-md bg-white-only b-b">
            <div class="row text-center">
              <div class="col-sm-3 col-xs-6" >
                <div>Quantity of Spoilage Products <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
                <input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="qtyExpired"/>
              </div>

              <div class="col-sm-3 col-xs-6">
                <div>Spoilage SKUs <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
                <input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="expiredSku"/>
              </div>

            </div>
          </div>

          <b>Spoilage Stock Summary</b> 

          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline" role="form">
          <br>
          <div>
            From: <input type="text"  name="fromDate" data-date-format='yyyy-mm-dd' id="from" > To:<input type="text" name="toDate"  data-date-format='yyyy-mm-dd' id="to" > <button class="btn btn-success" name=confirm id=confirm ng-click="open('lg')">Search</button>
          </div>
            <div class="table-responsive">
              <table class="table table-striped b-t b-b">
                <thead>
                  <tr>
                    <th  style="width:10%">SKU</th>
                    <th  style="width:25%">Product Name</th>
                    <th  style="width:20%">Expiration Date</th>
                    <th  style="width:20%">Pullout Date</th>
                    <th  style="width:10%">Quantity</th>
                  </tr>
                </thead>

                <?php
                $mysqli= NEW MySQLi("localhost","holly","milk","devapps");

                $fromDate = $mysqli->real_escape_string($_POST['fromDate']);
                $toDate = $mysqli->real_escape_string($_POST['toDate']);

                $resultSet=$mysqli->query("SELECT p.sku,p.productName,s.dateSR,sr.username,p.qtyUnit,p.retailPrice,sr.qtySR,(retailPrice * qtySR) AS total FROM products p JOIN salessr sr ON sr.productId=p.productId
                JOIN sales s ON sr.receiptNum=s.receiptNum WHERE username='$search3' and dateSR BETWEEN '$search2' AND '$search' ORDER BY dateSR");
                
                if($resultSet->num_rows>0){
                  while($rows=$resultSet->fetch_assoc()){
                    echo "<tbody><tr class='productRows'>
                   <td>".$row["sku"]."<input type=hidden name='productID[]' value=".$row["productID"]."></td>
                   <td>".$row["productName"]."<input type=hidden name='productName[]' value=".$row["productName"]."></td>
                   <td>".$row["expiryDate"]."<input type=hidden name='expiryDate[]' value=".$row["expiryDate"]."></td>
                   <td></td> 
                   <td>".$row["inventoryQty"]."<input type=hidden class='inventoryQty' name='inventoryQty[]' value=".$row["inventoryQty"]."></td>
                 </tr></tbody>";
                  }
                }

                $time = date("Y/m/d");
                $date = strtotime($time);

                require_once('../../mysqlConnector/mysql_connect.php');
                $query="SELECT i.expiryDate, i.productID, i.inventoryQty, p.productName, p.sku from perpetualinventory i join products p
                on i.productID=p.productID where i.active!=0 and i.pulloutStat=0";
                $result=mysqli_query($dbc,$query);
                while($row = $result->fetch_assoc()) {

                  $expiryDate=strtotime($row["expiryDate"]);
                  if($date>=$expiryDate){

                   echo "<tbody><tr class='productRows'>
                   <td>".$row["sku"]."<input type=hidden name='productID[]' value=".$row["productID"]."></td>
                   <td>".$row["productName"]."<input type=hidden name='productName[]' value=".$row["productName"]."></td>
                   <td>".$row["expiryDate"]."<input type=hidden name='expiryDate[]' value=".$row["expiryDate"]."></td>
                   <td></td> 
                   <td>".$row["inventoryQty"]."<input type=hidden class='inventoryQty' name='inventoryQty[]' value=".$row["inventoryQty"]."></td>
                 </tr></tbody>";
               }
             }

             ?>
             <p></p>

             <p></p>

           </table>

           <span ng-controller="ModalDemoCtrl">
            <script type="text/ng-template" id="myModalContent.html">
              <div ng-include="'tpl/modal.form.html'"></div>
            </script>
            
            
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<?php

if (isset($_POST['confirm'])){


  require_once('../../mysqlConnector/mysql_connect.php');
  $productID=$_POST['productID'];
  $inventoryQty=$_POST['inventoryQty'];
  //$pullOutName=$_POST['pullOutName']; --- do we still need this colum?
  $expiryDate=$_POST['expiryDate'];

  
    //-------insert to pullouts -------
    $query="insert into pullouts (distributorName) values ('{$_SESSION['username']}')";
    $result=mysqli_query($dbc,$query);
  //------- /insert to pullouts -------

  //------- get latest pullout control number -------
    $query2="select controlNum from pullouts order by controlNum DESC LIMIT 1";
    $result2=mysqli_query($dbc,$query2);
    while($row=$result2->fetch_assoc()) {
      $controlNum=$row["controlNum"];
    }
    $controlNum;
  //------- /get latest pullout control number -------

    $items = array_combine($productID,$inventoryQty);
    $pairs = array();

    $remarks="spoilage";

    foreach($items as $key=>$value){
      $pairs[] = '('.intval($key).','.intval($value).','."'$controlNum'".','."'$remarks'".')';
    }

  //------- inserting to pullouts2 table -------
    $query3= "INSERT INTO pullouts2 (productID, pullOutQty, controlNum, remarks) values".implode(',',$pairs);
    $result3=mysqli_query($dbc,$query3);
  //------- /inserting to pullouts2 table -------

  //------- update inventory -------
    $query4= "UPDATE perpetualinventory SET pulloutStat=1 WHERE productID IN ('".implode($productID,"', '")."') AND expiryDate IN ('".implode($expiryDate,"', '")."')";
    $result4=mysqli_query($dbc,$query4);
  //------- /update inventory -------

    echo "<script type='text/javascript'>alert('submitted successfully!')</script>";

    header("location:expired.php"); 
    exit;
}

?>
<!-- /content -->
</div>
<script>
var rowCount = 0;
var quantityCount=0;
  $('.productRows').each(function(){
    rowCount++;

 });

  $('.inventoryQty').each(function(){
    quantityCount += parseFloat(this.value);

 });

if(rowCount==0){
  $("#confirm").prop('disabled', true); 
}

 var x = document.getElementById("qtyExpired");
 x.setAttribute("value", quantityCount);

 var y = document.getElementById("expiredSku");
 y.setAttribute("value", rowCount);

</script>

<script type="text/javascript">
 $(function(){
        $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });
</script>
</body>
<script src="../sales/js/bootstrap-datepicker.js"></script>
</html>