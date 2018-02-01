
<!DOCTYPE html>

  <html lang="en" class="">
  <head>
    <meta charset="utf-8" />
    <title>Laguna Creamery Inc</title>
    <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="../sales/css/datepicker.css" />

  </head>
  <body>
    <div class="app app-header-fixed ">


     <!-- nav -->
    
     <!-- / nav -->

     <?php
   
    
    ?>
    <!-- content -->

    <div id="content" class="app-content" role="main">
      <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3">Outlet Inventory</h1>
        </div>
        <div class="wrapper-md">
          <div class="panel panel-default">
            <div class="panel-heading">
              Inventory List
            </div>
            <div class="wrapper-md">
             <div class="wrapper-md bg-white-only b-b">
              <div class="row text-center">
                <div class="col-sm-3 col-xs-6">
                  <div>Quantity in Hand <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
                  <div class="h2 m-b-sm"><input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="inHand"/></div>
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div>Inventory Valuation <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
                  <div class="h2 m-b-sm"><input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="totalAmount"/></div>
                </div>
                <div class="pull-right">  
                  <div class="hero-unit">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                   Starting Date:
                   <input type="text"  required name="search2" data-date-format='yyyy-mm-dd' id="from" >
                   End Date
                   <input type="text" required name="search"  data-date-format='yyyy-mm-dd' id="to" > 
                   <input type="SUBMIT" name="submit" value="search"/>
                   </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <div class="table-responsive">
          <table class="table table-striped b-t b-b">
            <thead>
              <tr>
                <th  style="width:25%">Date</th>
                <th  style="width:25%">Product Name</th>
                <th  style="width:15%">Quantity</th>
                <th  style="width:15%">Unit</th>
                <th  style="width:15%">Wholesale Price</th>
                <th  style="width:15%">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(isset($_POST['submit'])){

               $mysqli= NEW MySQLi("localhost","holly","milk","devapps");

               $search = $mysqli->real_escape_string($_POST['search']);
               $search2 = $mysqli->real_escape_string($_POST['search2']);

               if(empty($search3)){
                $resultSet=$mysqli->query("SELECT DATE(pi.dateInstance) AS dateInstance,p.productName,p.qtyUnit,pi.inventoryQty,p.wholesalePrice,(p.wholesalePrice *(pi.inventoryQty)) AS total,pi.username FROM  products p  JOIN perpetualinventory pi ON p.productID= pi.productID   
                 WHERE   pi.username='{$_SESSION['username']}' and pi.dateInstance BETWEEN '$search2%' AND '$search%'  and pi.active=1 ORDER BY pi.dateInstance");

                if($resultSet->num_rows>0){
                  while($rows=$resultSet->fetch_assoc()){

                    echo "<tr>
                    <td>".$rows['dateInstance']."</td>
                    <td>".$rows['productName']."</td>
                    <td>".$rows['inventoryQty']."<input type=hidden class=iH value=".$rows["inventoryQty"]."></td>
                    <td>".$rows['qtyUnit']."</td>
                    <td>".$rows['wholesalePrice']."</td>
                    <td>".$rows['total']."<input type=hidden class=toT value=".$rows["total"]."></td>
                  </tr>";
 //echo $inHand;
// echo $totalAmount; 

    }//if no data output 
    }//if no data output 
    else{

      echo"No results";
    }
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

<script src="../sales/js/bootstrap-datepicker.js"></script>  
<script>
var inH = 0;
var tota=0;
 $(function(){
  $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
  $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
    var minValue = $(this).val();
    minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
    minValue.setDate(minValue.getDate()+1);
    $("#to").datepicker( "option", "minDate", minValue );
  })
});


  $('.iH').each(function(){
    inH += parseFloat(this.value);

 });

  $('.toT').each(function(){
    tota += parseFloat(this.value);

 });

 var x = document.getElementById("inHand");
 x.setAttribute("value", inH);

 var y = document.getElementById("totalAmount");
 y.setAttribute("value", tota);
</script>

</body>
</html>
