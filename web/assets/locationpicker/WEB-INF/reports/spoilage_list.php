
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
      <h1 class="m-n font-thin h3">Spoilage List</h1>
    </div>
    <div class="wrapper-md">
      <div class="panel panel-default">
        <div class="panel-heading">
         Spoilage List
       </div>
       <div class="wrapper-md">


        <b>Spoilage List Summary</b> 


          <div class="table-responsive">
            <table class="table table-striped b-t b-b">
              <thead>
                <tr>
                  <th  style="width:30%">Control Number</th>
                  <th  style="width:45%">Dealer Name</th>
                  <th  style="width:30%">Pullout Date</th>
                </tr>
              </thead>

              <?php

              require_once('../../mysqlConnector/mysql_connect.php');
              $query="Select distinct controlNum, concat(i.fName,' ',i.lName) as distributorName, DATE(pullOutDate) AS pullOutDate From pullouts p join users u on p.distributorName=u.username join usersinfo i on u.userID=i.userID order by controlNum desc;";
              $result=mysqli_query($dbc,$query);
              while($row = $result->fetch_assoc()) {
                $conNum=$row["controlNum"];
                echo "<tbody><tr class='productRows'>
                <td >SP-<input type=button name=controlNum id=happy class=cN style=border:none;background:none value=".$conNum."></td>
                <td>".$row["distributorName"]."<input type=hidden name=distributorName value=".$row["distributorName"]."></td>
                <td>".$row["pullOutDate"]."<input type=hidden name=pullOutDate value=".$row["pullOutDate"]."></td>
                <td></td> 
              </tr></tbody>";
            }

            ?>
            <p></p>

            <p></p>

          </table>

          <form id="form" action="spoilage_info.php" method="get">
            <input type="text" style="display:none" id="conNum" name="conNum" />
          </form>

          <span ng-controller="ModalDemoCtrl">
            <script type="text/ng-template" id="myModalContent.html">
              <div ng-include="'tpl/modal.form.html'"></div>
            </script>
            
            
          </span>
        </div>
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
    var cN =  $(this).closest ('tr').find(".cN").val();
    document.getElementById('conNum').setAttribute('value',cN);
    $("#form").submit();

  });

</script>
</body>
<script src="../sales/js/bootstrap-datepicker.js"></script>
</html>