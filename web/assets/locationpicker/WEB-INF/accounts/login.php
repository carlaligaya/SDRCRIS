<!DOCTYPE html>



<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php
session_start();
//session_destroy();

$flag=0;

if (isset($_SESSION['badlogin'])){
if ($_SESSION['badlogin']>=3)
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/homepage.php");
}

if (isset($_POST['submit'])){

$message=NULL;
 if (empty($_POST['username'])){
  $_SESSION['username']=FALSE;
  $_SESSION['password']=FALSE;
  $message.='<p>You forgot to enter your username or password!';
  if (isset($_SESSION['badlogin']))
  $_SESSION['badlogin']++;
else
  $_SESSION['badlogin']=1;
} else {
  $_SESSION['username']=$_POST['username'];
  $_SESSION['password']=$_POST['password']; 
     $_SESSION['badlogin']=1;
 }


 

require_once('../../mysqlConnector/mysql_connect.php');
  
if($_SESSION['badlogin'] < 3 ){
    
    $query2="select username, password, usertype, userID from users where username!='{$_SESSION['username']}'";
    $result2=mysqli_query($dbc,$query2);
     while($row = $result2->fetch_assoc()) {
         if ($row["username"]!=$_SESSION['username']){
             $norecord=0;
         }
     }
    
    if($norecord == 0){
        $message.= "<p>Wrong username or password";
                if (isset($_SESSION['badlogin']))
                    $_SESSION['badlogin']++;
                else
                    $_SESSION['badlogin']=1;
    }
    
    
$query="select u.username, u.password, u.usertype, u.userID, i.fName, i.lName from users u join usersinfo i on u.userID = i.userID where username='{$_SESSION['username']}' and password = Password('{$_SESSION['password']}')";
$result=mysqli_query($dbc,$query);
$flag=1;
    
    while($row = $result->fetch_assoc()) {
    
        if ($_SESSION['username']==$row["username"] ) {
            if($row["usertype"]==101){
            $_SESSION['usertype']=101;
            $_SESSION['userID']=$row["userID"];
            header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/../dashboard/homepage_admin.php");
            $_SESSION['name']=$row["fName"] .' '.$row["lName"];//admin
            }else if($row["usertype"]==102){
                $_SESSION['usertype']=102;
                $_SESSION['userID']=$row["userID"];
                header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/../dashboard/homepage_dealer.php");
                $_SESSION['name']=$row["fName"] .' '.$row["lName"];//customer
			}
			else if($row["usertype"]==104){
                $_SESSION['usertype']=104;
                $_SESSION['userID']=$row["userID"];
                header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/../dashboard/homepage_farmer.php");
			$_SESSION['name']=$row["fName"] .' '.$row["lName"];//farmer
            }else if($row["usertype"]==103){
                $message.= "<p>You don't have access";
            }
            $_SESSION['badlogin']=1;
        } else{
                $message.= "<p>Wrong username or password";
                if (isset($_SESSION['badlogin']))
                    $_SESSION['badlogin']++;
                else
                    $_SESSION['badlogin']=1;
}
            
            }
            }
 else{
     
    $message.= "please contact administrator";
    
}               
}/*End of main Submit conditional*/

    
if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
    
}

?>

<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery, Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <link rel="stylesheet" href="../../imports/libs/assets/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../imports/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../imports/libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../../imports/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />

  <link rel="stylesheet" href="../../imports/css/font.css" type="text/css" />
  <link rel="stylesheet" href="../../imports/css/app.css" type="text/css" />
 
  <script src="../../imports/libs/jquery/jquery/dist/jquery.js"></script>
  <script src="../../imports/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
  <script src="../../imports/js/jquery.dataTables.min.js"></script>

</head>
<body>
<div class="app app-header-fixed ">
  

<div class="container w-xxl w-auto-xs" ng-controller="SigninFormController" ng-init="app.settings.container = false;">
  <a href class="navbar-brand block m-t">DairyMAN</a>
  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong>Authorized Personnel Only</strong>
    </div>
    <form name="form" class="form-validation">
      <div class="text-danger wrapper text-center" ng-show="authError">
          
      </div>
      <div class="list-group list-group-sm">
        <div class="list-group-item">
          <input type="text" required name="username" placeholder="Username" class="form-control no-border" ng-model="user.email"  value="<?php if (isset($_POST['username']) && !$flag) echo $_POST['username']; ?>"/>
        </div>
        <div class="list-group-item">
           <input type="password" required name="password" placeholder="Password" class="form-control no-border" ng-model="user.password" >
        </div>
      </div>
     <button type="submit"  name="submit" class="btn btn-lg btn-primary btn-block" href="dashboard.html"> <a href="dashboard.html">Log in</a></button>
  
      <div class="line line-dashed"></div>
     
      
    </form>
  </div>
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
    <p>
  <small class="text-muted">Laguna Creamery, Inc<br>&copy; 2016</small>
</p>
  </div>
</div>


</div>


<script src="../../imports/libs/jquery/jquery/dist/jquery.js"></script>
  <script src="../../imports/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>

  <script src="../../imports/libs/jquery/jquery/dist/jquery.js"></script>
  <script src="../../imports/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
  <script src="../../imports/js/ui-load.js"></script>
  <script src="../../imports/js/ui-jp.config.js"></script>
  <script src="../../imports/js/ui-jp.js"></script>
  <script src="../../imports/js/ui-nav.js"></script>
  <script src="../../imports/js/ui-toggle.js"></script>
  <script src="../../imports/js/ui-client.js"></script>

</body>
</html>
