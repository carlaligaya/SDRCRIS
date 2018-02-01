
<!DOCTYPE html>

<html lang="en" class="">
<meta charset="utf-8" />
<title>Laguna Creamery Inc</title>
<meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" type="text/css" href="../sales/css/style.css" />
<style type="text/css">

  .set-bg {
    max-width: 100%;
    background-color: transparent;
    border-spacing: 0;
    border-color: transparent;
  }
</style>
</head>
<body>
 <div class="app app-header-fixed hidden-print">
  <!-- nav -->
  <?php include '../session/levelOfAccess.php';
  ?>

  <?php
  if ($_SESSION['usertype']!=102){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
  } ?>
  <div id="content" class="app-content" role="main">
   <div class="app-content-body ">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="well">
            <div class="box">
              <div class="text-info">Products</div>
              <hr>
              <table cellpadding="2" cellspacing="2" >
               <thead>
                 <tr>

                  <th style="width:auto">Product Name</th>
                  <th style="width:auto">Retail Price</th>
                  <th style="width:auto">Quantity</th>
                  <th style="width:auto">Expiry Date</th>
                  <th style="width:auto">Add</th>
                </tr>
              </thead>
              <tbody id="mainList">
               <?php 
			    $time = date("Y/m/d");
                $date = strtotime($time);
				
               require_once('../../mysqlConnector/mysql_connect.php');
               $query="SELECT i.productID,i.expiryDate, p.productName, p.retailPrice, i.inventoryQty, i.expiryDate
               FROM perpetualinventory i JOIN products p ON i.productID = p.productID where inventoryQty>0 and pulloutStat=0";
               $result=mysqli_query($dbc,$query);
               while($row = $result->fetch_assoc()) {
				   
                  $expiryDate=strtotime($row["expiryDate"]);
                  if($date<=$expiryDate){
                 echo"

                 <tr>
                  <td class=pR style=display:none>".$row["productID"]."</td>
                  <td class=pN>".$row["productName"]."</td> 
                  <td class=rP>".$row["retailPrice"]."</td>
                  <td class=qty>".$row["inventoryQty"]."</td>
                  <td>".$row["expiryDate"]."</td>
                  <td><button type=submit name=add  class=btn btn-info btn-lg addc id=add>Add</button></td>
                </tr>";
				  }
				  }
              ?>
            </tbody>
          </table>

            <!--  <button class="buttons btn btn-primary" ng-click="add(products.milk)">1L Whole Milk</button>
            <button class="buttons btn btn-primary" ng-click="add(products.1llfmilk)">1L Low Fat Milk</button>-->
          </div>

          <br>
          

        </div>
      </div>

      <div class="col-sm-7">
        <div  class="well">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Order Summary</h3>
              </div>
              <center> <H2>Laguna Creamery, Inc.</H2></center>
              <div class="panel-body"  style="max-height:320px; overflow:auto;">
               <div style="display: none" id="orderList">
                <div class="text" ng-hide="order.length">
                  Select products.
                </div>

                <ul class="list-group">
                  <li class="list-group-item" ng-repeat = "item in order">
                    <div id="receipt">
                      <table class="set-bg" style="text-align: left; width: 500px;" border="1" cellpadding="2" cellspacing="2" id="dataTable2" align="left">
                        <thead>
                          <tr>
                            <th style="width:100px">Product Name</th>
                            <th style="width:50px">Retail Price</th>
                            <th style="width:50px">Quantity</th>
                            <th style="width:50px">Subtotal</th>
                            <th style="width:10px">Delete</th>
                          </tr>
                        </thead> 

                        <tbody style="width:auto" id="tableList">           
                        </tbody>
                      </table>

                    </div>

                    
                    <div class="panel-footer" ng-show="order.length">
                     <div>
                      Received: <input id="received" required type="number" min=0 onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="received" class="received"/>
                    </div>
                    <div class="label label-danger">Total:
                     <input id="total" readonly style="width:40px;background:transparent;border:none" type="number" name="total" class="total"/></div>
                     <div class="pull-right">
                      Change: <input id="change" style="border:none" readonly type="number" min=0 onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="change" class="change"/>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="panel-footer" ng-show="order.length">
            <div class="text-muted">

            </div>
          </div>
          <div class="pull-right">
            <input type="submit" class="btn btn-danger" name="confirm" value="Confirm">
            <button type="button" class="btn btn-default" onclick="printContent()">Print Receipt</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
<!-- content -->
<?php
if (isset($_POST['confirm'])){
  $productID=$_POST['productID'];
  $qtySold=$_POST['qtySold'];
  $productName=$_POST['productName'];
  $total=$_POST['total'];
  echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
  $items = array_combine($productID,$qtySold);
  $pairs = array();


  $query="insert into sales(sold, status) values(1,0)";
  $result=mysqli_query($dbc,$query);
  			//ok

  $query2="select receiptNum from sales order by dateSR DESC LIMIT 1";
  $result2=mysqli_query($dbc,$query2);
              //ok
  while($row = $result2->fetch_assoc()) {
    $receiptNum=$row["receiptNum"];
  }
  $receiptNum;
  foreach($items as $key=>$value){
    $pairs[] = '('.intval($key).','.intval($value).','."'{$_SESSION['username']}'".','."'$receiptNum'".','."'$total'".')';
  }
  $query3= "INSERT INTO salessr (productID, qtySR, username, receiptNum, totalSold) values".implode(',',$pairs);
  $result3=mysqli_query($dbc,$query3);
              //ok

              //update inventory

  $query7="select productID, expiryDate, inventoryQty
  from perpetualinventory where inventoryQty<=0";
  $result7=mysqli_query($dbc,$query7);
  while($rowC = $result7->fetch_assoc()) {
   $query8="update perpetualinventory set active=0 where expiryDate='{$rowC['expiryDate']}' and productID='{$rowC['productID']}'";
   $result8=mysqli_query($dbc,$query8);
 }


 $query4="select productID, qtySR
 from salessr 
 where receiptNum='{$receiptNum}'";
 $result4=mysqli_query($dbc,$query4);
 while($rowA = $result4->fetch_assoc()) {
   $query6="select min(expiryDate) as expiryDate from perpetualinventory where productID ='{$rowA['productID']}' and active=1";
   $result6=mysqli_query($dbc,$query6);
   while($rowB = $result6->fetch_assoc()) {
     $expiryDate=$rowB['expiryDate'];
   }
   $expiryDate;




   $query5="UPDATE perpetualinventory
   SET perpetualinventory.inventoryQty=perpetualinventory.inventoryQty-'{$rowA['qtySR']}'
   WHERE perpetualinventory.productID='{$rowA['productID']}'
   AND perpetualinventory.expiryDate = '$expiryDate' and active=1";
   $result5=mysqli_query($dbc,$query5);


 }
}

?>





<!-- PRINTING -->
<div class="visible-print" >

  <div style="margin-bottom: 6%;" align="center">
    <!--logo-->
    <img src="../img/creamery.png" alt=""/><br>
    <h3><span class="hidden-folded m-l-xs">Holly's Milk</span></h3>
    <p>Prepared By: <?php echo $_SESSION['username']; ?> </p>
    <p id="DateHere"></p>
  </div>

  <p style="margin-left: 5%;">Receipt #<?php 
   $query2="select receiptNum from sales order by dateSR DESC LIMIT 1";
   $result2=mysqli_query($dbc,$query2);

   while($row = $result2->fetch_assoc()) {
    $receiptNum=$row["receiptNum"];
  }
  $receiptNum;
  echo $receiptNum;?></p>

  <div id="print" style="width: 90%; margin-left: auto; margin-right: auto;">

  </div>
  <footer>
    <div style='text-align:center;
    position:fixed;
    height:50px;
    background-color:red;
    bottom:0px;
    left:0px;
    right:0px;
    margin-bottom:0px;'>Page 1 
    <!--<span class="pageCounter"></span>/<span class="totalPages"></span>-->
  </div>
</footer>
</div>





<script>
  function printContent(){
   $('#print').empty();
        //change table layout

        var m_names = new Array("January", "February", "March",
          "April", "May", "June", "July", "August", "September",
          "October", "November", "December");
        var d = new Date();
        var curr_date = d.getDate();
        var curr_month = d.getMonth();
        var curr_year = d.getFullYear();
        var today = m_names[curr_month] + " " + curr_date
        + ", " + curr_year;
        $("#DateHere").html(today);
  $('div#receipt').clone().appendTo('#print');
  
  	window.print();
  }

</script>

<script>
  var change = 0;
  $(document).on('click', "#add", function(){

    document.getElementById("orderList").style.display = "block";

           //  document.getElementById().disabled = true; 

           $(this).prop('disabled', true);   
           var pR =  $(this).closest('tr').find(".pR").text();
           var pN =  $(this).closest('tr').find(".pN").text();
           var rP =  $(this).closest('tr').find(".rP").text();
           var qty =  $(this).closest('tr').find(".qty").text();

           var para = document.createElement("tr");
           var element = document.getElementById("tableList");
           para.setAttribute("class", "trList");
           element.appendChild(para);
           $(".trList").append('<td style=display:none><input name="productID[]" class="pID" id="productID" type="text" readOnly value="'+pR+'" /></td>');
           $(".trList").append('<td><input style="width:100%;border:none" name="productName" id="productName" type="text" readOnly value="'+pN+'"/></td>');
           $(".trList").append('<td><input type="hidden" class="currQty" value="'+qty+'"/> <input style="width:60px;border:none"  name="retailPrice" class="retailPrice" type="number" readOnly value="'+rP+'"/></td>');
           $(".trList").append('<td>  <input style="width:50px"  type="number" class="num" id="orderValue" required min=0 type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="qtySold[]"></td> <td><input style="width:50px;border:none"  readOnly type="number" class="eachQty" /></td>');
           $(".trList").append('<td ><button type=button class="btn btn-danger btn-xs pull-center" id="delete"><span class="glyphicon glyphicon-trash"></span></button></td>');
           para.setAttribute("class", "trListSaved");
           
         });


  $(document).on('click', "#delete", function(event){

    var pid = $(this).closest("tr").find('.pID').val();
    console.log(pid);
    $("#mainList").find('.pR').each(function () {
      var mPid = $(this).text();
      if(mPid===pid){
       console.log("entered");
       var x = $(this).closest("tr").find('button').attr("disabled", false);
     }
   });

    $(this).closest("tr").remove();

    var sumTotal =0;

    $("#tableList").find('.eachQty').each(function () {
      var rp = parseInt($(this).val(), 10);
      sumTotal +=rp;
      $("#total").val(sumTotal);

    });
  });

  $(document).unbind('keyUp').on('keyup', "#orderValue", function(){
   var x =  parseInt($(this).val(), 10);               
   var y = parseInt( $(this).closest('tr').find('.currQty').val(), 10);
   if(x<=y){
     var currEnter =  $(this).val();
     var rp = $(this).closest('tr').find('.retailPrice').val();

     var sumEach = rp * currEnter;
     $(this).closest('tr').find('.eachQty').val(sumEach);
     var sumTotal = 0;
     $('#dataTable2 tbody tr').each(function() {
      var $row = $(this);
      var rp = parseInt($row.find('.eachQty').val(),10);
      sumTotal +=rp;
      $("#total").val(sumTotal);
    });
   } else{
     alert("ERROR PLEASE ENTER EQUALS TO OR LESS THAN " + y);
     
      $('#dataTable2 tbody tr').each(function() {
      var $row = $(this);
      var rp = parseInt($row.find('.eachQty').val(),10);
      sumTotal +=rp;
      $("#total").val(sumTotal);
    });
   
   } 
 });

  $(document).unbind('keyUp').on('keyup', "#received", function(){
    x =  $(this).val();
    y = $("#total").val();
    change=x-y;
    $("#change").attr("value", change);
  });
</script>

</body>
</html>
