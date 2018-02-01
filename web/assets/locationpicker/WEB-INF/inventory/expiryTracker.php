
<!DOCTYPE html>
<html lang="en" class="">
<form method="POST">

	<meta charset="utf-8" />
	<title>Laguna Creamery Inc</title>
	<meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="stylesheet" type="text/css" href="../sales/css/datepicker.css" />

</head>
<body>
	<div class="app app-header-fixed ">


		<!-- nav -->
		<?php include '../session/levelOfAccess.php';?>
		<!-- /nav -->

		<?php
		if ($_SESSION['usertype']!=102){
			header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
		}
		?>

		<div id="content" class="app-content" role="main">
			<div class="app-content-body ">


				<div class="bg-light lter b-b wrapper-md">
					<h1 class="m-n font-thin h3">Expiry Tracker</h1>
				</div>
				<div class="wrapper-md">
					<div class="panel panel-default">
						<div class="panel-heading">
							Products Expiry List
						</div>
						<div class="wrapper-md">
							<div class="wrapper-md bg-white-only b-b">
								<div class="row text-center">
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="col-sm-4 form-group">
											Product:
											<select id="productChosen" name="search">
												<?php 
                require_once('../../mysqlConnector/mysql_connect.php');
                $query="select productID, productName, wholesalePrice, retailPrice, sku from products where productType=101;";
                $result=mysqli_query($dbc,$query);
                
                if ($result!=null){
                  while($row=$result->fetch_assoc()) {
                    echo"<option value=".$row["productID"].">".$row["productName"]."</option>";
                  }
                }
                ?>
				</select>
											<input type="SUBMIT"  required name="submit" value="search"/>
										</div>
									</form>
								</div>
							</div>


							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline" role="form">
								<div class="table-responsive">
									<table  class="table table-striped b-t b-b">

										<?php

										$flag=0;
										$output = NULL;
										if(isset($_POST['submit'])){
											$message=NULL;

											if (empty($_POST['productName'])){
												$productName=NULL;
											}else
											$productName=$_POST['productName'];

	//connect to db
											$mysqli = NEW MySQLi("localhost","holly","milk","devapps");

	//get string value from search
	//removes any special characters
											$search = $mysqli->real_escape_string($_POST['search']);


											$resultSet=$mysqli->query("
												Select p.productName,pi.expiryDate, pi.inventoryQty FROM perpetualinventory pi JOIN products p  
												ON p.productID=pi.productID WHERE pi.username='{$_SESSION['username']}' and p.productID='{$search}' and pi.active=1;");
//and p.productName='$search%'");
// WHERE pi.username='{$_SESSION['username']}' and p.productName='$search%'");

											echo '
											<thead>
												<tr>

													<th style="width:10%">Product Name</th>
													<th style="width:10%">Expiry Date</th>
													<th style="width:10%">inventoryQty</th>
												</tr></thead>';

	//check if there are any info gathered from db

												if($resultSet->num_rows>0){
													while($rows=$resultSet->fetch_assoc()){

														$productName= $rows['productName'];
														$expiryDate=$rows['expiryDate'];
														$inventoryQty=$rows['inventoryQty'];

														echo "<tbody><tr>
														<td> {$productName}</td>
														<td> {$expiryDate}</td>
														<td> {$inventoryQty}</td>
													</tr></tbody>";
	//if no data output 
												}
											}else{

												echo"No results";
											}
										}
										?>
										<p></p>

										<p></p>

									</table>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div> 
		<!-- content -->
	</div>
</body>
</html>
