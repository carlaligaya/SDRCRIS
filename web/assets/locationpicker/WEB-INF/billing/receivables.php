
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
        <h1 class="m-n font-thin h3">Receivables List</h1>
      </div>

      <div class="wrapper-md bg-white-only b-b">
        <div class="row text-center">
          <div class="col-sm-3 col-xs-6">
            <div>Number of Outstanding Invoices <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
            <div class="h2 m-b-sm">1</div>
          </div>

          <div class="col-sm-3 col-xs-6">
            <div>Total Receivables<i class="fa fa-fw fa-caret-up text-success text-sm"></i></div>
            <div class="h2 m-b-sm">Php 3136.00</div>
          </div>

        </div>
      </div>


      <div class="wrapper-md">
        <div class="panel panel-default">
          <div class="panel-heading">
            Invoices
          </div>
          <div class="table-responsive">
            <table  class="table table-striped b-t b-b">
              <thead>
                <tr>
                  <th  style="width:20%">Invoice Number</th>
                  <th  style="width:25%">Dealer Name</th>
                  <th  style="width:25%">Invoice Date</th>

                  <th  style="width:25%">Amount</th>
                  <th  style="width:15%">Status</th>
                  <th  style="width:15%">Remind Dealer</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                 <td> <a href="invoice.html"><u>9399034</u></a></td>
                 <td>Marcus Ko</td>
                 <td>20 OCT 2016</td>

                 <td>Php 3136.00</td>
                 <td><span class="label bg-warning">Unpaid</span></td>
                 <td><span class="label bg-success">Remind</span></td>
               </tr>
             </tbody>
           </table>
         </div>
       </div>
     </div>



   </div>
 </div>
 <!-- /content -->





</div>



</body>
</html>
