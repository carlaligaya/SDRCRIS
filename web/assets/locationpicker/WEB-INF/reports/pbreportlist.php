
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
  <h1 class="m-n font-thin h3">Production Report Module</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading">
      All Production Orders
    </div>
    <div class="table-responsive">
      <table  class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:20%">P.B Number</th>
            <th  style="width:25%">P.O Date</th>
            <th  style="width:15%">Status</th>
            <th  style="width:15%">Update Status</th>
          </tr>
        </thead>
        <tbody>
              <tr>
           <td> <a href="prodorder.html"><u>10000</u></a></td>
            <td>1 November 2016</td>
            <td><span class="label bg-warning">In Production</span></td>
            <td><u>Update</u></span></td>
            </tr><tr>
           <td> <a href="#"><u>9999</u></a></td>
            <td>1 October 2016</td>
            <td><span class="label bg-danger">Canceled</span></td>
            <td>N/A</td>
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
