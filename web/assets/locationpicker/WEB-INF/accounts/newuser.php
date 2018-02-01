<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  

</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="app app-header-fixed ">
  

 <!-- nav -->
   <?php include '../session/levelOfAccess.php';?>
   
   <!-- / nav -->
   
<?php


//if ($_SESSION['usertype']!=101){
  //     header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
   // } 
    
$flag=0;
if (isset($_POST['submit'])){

$message=NULL;

 if (empty($_POST['username'])){
  $username=FALSE;
  $message.='<p>You forgot to enter the username!';
 }else
  $username=$_POST['username'];

 if (empty($_POST['password'])){
  $password=NULL;
 }else
  $password=$_POST['password'];

 if (empty($_POST['retypepassword'])){
  $retypepassword=NULL;
 }else
  $retypepassword=$_POST['retypepassword'];


 if (empty($_POST['usertype'])){
  $usertype=NULL;
 }else
  $usertype=$_POST['usertype'];


if(!isset($message)){
if($retypepassword==$password){
require_once('../../mysqlConnector/mysql_connect.php');

$query="Insert into USERS (username,password,usertype) values ('{$username}',PASSWORD('$password'),'{$usertype}')";

$result=mysqli_query($dbc,$query);
echo $result;


$result='<div class="alert alert-success">Thank You! I will be in touch</div>';

    $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';




$flag=1;
}
else{
	echo "password do not match! retype password!";
	
}
}
 

}/*End of main Submit conditional*/

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>


<?php
if ($_SESSION['usertype']!=101){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
    } 
    
$flag=0;
if (isset($_POST['submit'])){

$message=NULL;

  if (empty($_POST['password'])){
  $password=NULL;
 }else
  $password=$_POST['password'];

 if (empty($_POST['retypepassword'])){
  $retypepassword=NULL;
 }else
  $retypepassword=$_POST['retypepassword'];

 if (empty($_POST['tinNum'])){
  $tinNum=FALSE;
  $message.='<p>You forgot to enter the TIN Number!';
 }else
  $tinNum=$_POST['tinNum'];

 if (empty($_POST['fName'])){
  $fName=FALSE;
  $message.='<p>You forgot to enter the First Name!';
 }else
  $fName=$_POST['fName'];

 if (empty($_POST['lName'])){
  $lName=FALSE;
  $message.='<p>You forgot to enter the Last Name!';
 }else
  $lName=$_POST['lName'];

 if (empty($_POST['contactNum'])){
  $contactNum=FALSE;
  $message.='<p>You forgot to enter the Contact Number!';
 }else
  $contactNum=$_POST['contactNum'];

 if (empty($_POST['emailAdd'])){
  $emailAdd=FALSE;
  $message.='<p>You forgot to enter the Email Address!';
 }else
  $emailAdd=$_POST['emailAdd'];

 if (empty($_POST['address'])){
  $address=FALSE;
  $message.='<p>You forgot to enter the Address!';
 }else
  $address=$_POST['address'];

 if (empty($_POST['city'])){
  $city=FALSE;
  $message.='<p>You forgot to enter the City!';
 }else
  $city=$_POST['city'];

 if (empty($_POST['rating'])){
  $rating=FALSE;
  $message.='<p>You forgot to select the rating!';
 }else
  $rating=$_POST['rating'];



if(!isset($message)){
if($retypepassword==$password){
require_once('../../mysqlConnector/mysql_connect.php');
$quertGetID= "SELECT userID from users order by userID DESC LIMIT 1";
$resultID=mysqli_query($dbc,$quertGetID);
while($row=$resultID->fetch_assoc()) {
	$id=$row["userID"];
}
$id;
$query="Insert into USERSINFO (userID,tinNum,address,city,contactNum,emailAdd,fName,lName,rating) values ('{$id}','{$tinNum}','{$address}','{$city}','{$contactNum}','{$emailAdd}','{$fName}','{$lName}','{$rating}')";

$result=mysqli_query($dbc,$query);

echo $result;
$flag=1;
}
else{
	echo "password do not match! retype password!";
	
}
}
 

}/*End of main Submit conditional*/

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}
?>
<?php
//if ($_SESSION['usertype']!=101){
 // header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."../../accounts/login.php");
//}
?>


  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">
	    
	    
<div class="container">
    <h1 class="well">Create New User</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text"  required name="fName"  placeholder="Enter First Name Here.."   class="form-control" value="<?php if (isset($_POST['fName']) && !$flag) echo $_POST['fName']; ?>"/>  
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<input type="text"  required name="lName"  placeholder="Enter Last Name Here.." class="form-control" value="<?php if (isset($_POST['lName']) && !$flag) echo $_POST['lName']; ?>"/>  
							</div>
							<div class="col-sm-6 form-group">
								<label>User Name</label>
								<input type="text" required name="username" placeholder="Enter your desired Username here.." class="form-control" value="<?php if (isset($_POST['username']) && !$flag) echo $_POST['username']; ?>"/>  
							</div>
							<div class="col-sm-6 form-group">
								<label>Password</label>
								<input type="password"  required name="password"  placeholder="Enter your desired Password here.." class="form-control"  value="<?php if (isset($_POST['password']) && !$flag) echo $_POST['password']; ?>"/>  
								<label>Re-type Password</label>
								<input type="password"  required name="retypepassword"  placeholder="Re-type your desired Password here.." class="form-control"   value="<?php if (isset($_POST['retypepassword']) && !$flag) echo $_POST['retypepassword']; ?>"/>
							</div>
						</div>					
						<div class="form-group">
							<label>Address</label>
							<textarea  required name="address" placeholder="Enter Address Here.." rows="3" class="form-control" value="<?php if (isset($_POST['address']) && !$flag) echo $_POST['address']; ?>"/> </textarea>
						</div>	
						
<p>City:</p> <br>
               <select name="city">
						
                        <option value="Manila">Manila</option>
                        <option value="Caloocan">Caloocan</option>
						<option value="Las Piñas">Las Piñas</option>
                        <option value="Makati">Makati</option>
						<option value="Malabon">Malabon</option>
                        <option value="Mandaluyong">Mandaluyong</option>
						<option value="Marikina">Marikina</option>
                        <option value="Muntinlupa">Muntinlupa</option>
						<option value="Navotas">Navotas</option>
                        <option value="Pasay">Pasay</option>
						<option value="Pasig">Pasig</option>
                        <option value="Parañaque">Parañaque</option>
						<option value="Quezon City">Quezon City</option>
                        <option value="San Juan">San Juan</option>
						<option value="Taguig">Taguig</option>
                        <option value="Valenzuela">Valenzuela </option>
				

                    </select>
						<div class="row">	
							<div class="col-sm-4 form-group">
								<label>Email Address</label>
						<input type="text"  required name="emailAdd"  placeholder="Enter Email Address Here.." class="form-control"  value="<?php if (isset($_POST['emailAdd']) && !$flag) echo $_POST['emailAdd']; ?>"/> 
							</div>	
							<div class="col-sm-4 form-group">
							<label>Contact Number</label>
						<input type="number"  required name="contactNum"  placeholder="Enter Contact Number Here.." class="form-control"  value="<?php if (isset($_POST['contactNum']) && !$flag) echo $_POST['contactNum']; ?>"/> 
							</div>		
								<div class="col-sm-4 form-group">
							<label>TIN Number</label>
						<input type="text"  required name="tinNum"  placeholder="Enter TIN Number Here.." class="form-control"  value="<?php if (isset($_POST['tinNum']) && !$flag) echo $_POST['tinNum']; ?>"/> 
							</div>	
							<div class="col-sm-4 form-group">
							<p>Usertype:</p> <br>
               <select name="usertype">
						
                        <option value=101>101- ADMIN</option>
                        <option value=102>102- DEALER</option>
						<option value=104>104- FARMER</option>
                       
                    </select>
								<p>Rating:</p> <br>
               <select name="rating">
						
                        <option value=1>1</option>
                        <option value=2>2</option>
						<option value=3>3</option>
                        <option value=4>4</option>
						<option value=5>5</option>
                        <option value=10>ADMIN</option>
                       
                    </select>
					
							
							</div>	
							
						</div>
						<div class="row">
								
							
						</div>						
				
				
					<button type="submit" name="submit" class="btn btn-lg btn-info">Submit</button>					
					</div>
				</form> 
				</div>
	</div>
	</div>
         
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

</body>
</html>
