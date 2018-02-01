
<!DOCTYPE html>
<html lang="en" class="">


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


		<?php
		if ($_SESSION['usertype']!=101){
			header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/login.php");
		}
		?>


		<div id="content" class="app-content" role="main">
			<div class="app-content-body ">


				<div class="bg-light lter b-b wrapper-md">
					<h1 class="m-n font-thin h3">Invoice Report</h1>
				</div>
				<div class="wrapper-md">
					<div class="panel panel-default">
						<div class="panel-heading">
							Invoice Report
						</div>
						<div class="wrapper-md">
							<div class="wrapper-md bg-white-only b-b">
								<div class="row text-center">
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="col-sm-8" align="left">  
											
												<div class="hero-unit">
													<p> Starting Date: <input type="text"  name="search2" data-date-format='yyyy-mm-dd' id="from" > End Date:<input type="text" name="search"  data-date-format='yyyy-mm-dd' id="to" > </p>
												</div>
													
											
										</div>
										<div  align="right">
											<p>Search by username: <input type="text" name="search3"><input type="submit" name="submit" value="search"></p>
										</div>
									</form>
									<div class="wrapper-md bg-white-only b-b">
										<div class="row text-center">
											<div class="col-sm-3 col-xs-6">
												<div>Total Quantity<i class="fa fa-fw fa-caret-up text-success text-sm"></i></div><input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="totalQty">
											</div>
											<div class="col-sm-3 col-xs-6">
												<div>Total Amount <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div><input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="totalAmount">
											</div>

										</div>
									</div>
								</div>

								<b>Invoice Report</b> 

								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline" role="form">
									<div class="table-responsive">
										<table  class="table table-striped b-t b-b">
											<thead>
												<tr>
													<th  style="width:10%">Invoice Date</th>
													<th  style="width:10%">Invoice Number</th>
													<th  style="width:10%">Dealer Name</th>
													<th  style="width:10%">Product Name</th>
													<th  style="width:10%">Quantity</th>
													
													<th  style="width:10%">Unit</th>
														<th  style="width:10%">Status</th>
													<th  style="width:10%;text-align:right">Wholesale Price</th>
													<th  style="width:10%;text-align:right">Total</th>
												</tr>
											</thead>

											<?php

											$output = NULL;
											if(isset($_POST['submit'])){
	//connect to db

												$mysqli= NEW MySQLi("localhost","holly","milk","devapps");
	//get string value from search
	//removes any special characters
												$search = $mysqli->real_escape_string($_POST['search']);
												$search2 = $mysqli->real_escape_string($_POST['search2']);
												$search3 = $mysqli->real_escape_string($_POST['search3']);

	//query db
//if not work use *
													if(empty($search3)){
														$resultSet=$mysqli->query("SELECT i2.invoiceNo,i.status,date(i.invoiceDate) as invoiceDate, username,p.qtyUnit, wholesalePrice ,productName, i2.qty, (qty*wholesalePrice) AS total FROM invoice i JOIN invoice2 i2 
														ON i.invoiceNo = i2.invoiceNo JOIN products p  ON i2.productID=p.productID WHERE invoiceDate BETWEEN '$search2' and '$search'ORDER BY i.invoiceDate asc, i2.invoiceNo;");


														if($resultSet->num_rows>0){
															while($rows=$resultSet->fetch_assoc()){
															$status = $rows['status'];
if($status ==0){
$status="unprocessed";	
}
else{
	$status="processed";
}
																echo "</tbody><tr>
																<td >".$rows['invoiceDate']."</td>
																<td >".$rows['invoiceNo']."</td>
																<td >".$rows['username']."</td>
																<td >".$rows['productName']."</td>
																<td >".$rows['qty']."<input type=hidden class='qty' name='qty' value=".$rows["qty"]."></td>
																<td >".$rows['qtyUnit']."</td>
																   <td><input type=hidden name=status> $status</td>
																<td style=text-align:right> ".$rows["wholesalePrice"]."</td>
																<td  style=text-align:right>".$rows['total']."<input type=hidden class='total' name='total' value=".$rows["total"]."></td>
															</tr></tbody>";
														}
		//if no data output 
													}else{

														echo"No results";
													}

												}

												else{$resultSet=$mysqli->query("SELECT i2.invoiceNo,date(i.invoiceDate) as invoiceDate, i.status,username,p.qtyUnit, wholesalePrice ,productName, i2.qty, (qty*wholesalePrice) AS total FROM invoice i JOIN invoice2 i2 
														ON i.invoiceNo = i2.invoiceNo JOIN products p  ON i2.productID=p.productID WHERE invoiceDate BETWEEN '$search2' and '$search' and username='$search3' ORDER BY i.invoiceDate asc, i2.invoiceNo;");
														//put here the session

	//check if there are any info gathered from db
													if($resultSet->num_rows>0){
															while($rows=$resultSet->fetch_assoc()){
															$status = $rows['status'];
if($status ==0){
$status="unprocessed";	
}
else{
	$status="processed";
}
																echo "</tbody><tr>
																<td >".$rows['invoiceDate']."</td>
																<td >".$rows['invoiceNo']."</td>
																<td >".$rows['username']."</td>
																<td >".$rows['productName']."</td>
																<td >".$rows['qty']."<input type=hidden class='qty' name='qty' value=".$rows["qty"]."></td>
																<td >".$rows['qtyUnit']."</td>
																   <td><input type=hidden name=status> $status</td>
																<td style=text-align:right >".$rows['wholesalePrice']."</td>
																<td style=text-align:right>".$rows['total']."<input type=hidden class='total' name='total' value=".$rows["total"]."></td>
																
															</tr></tbody>";
														}
		//if no data output 
													}else{

														echo"No results";
													}

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

	</div>
</div>
<!-- /content -->





</div>
<script>
	var tQty = 0;
	var tAmount=0;
	$('.qty').each(function(){
		tQty+=parseFloat(this.value);

	});

	$('.total').each(function(){
		tAmount += parseFloat(this.value);

	});


	var x = document.getElementById("totalQty");
	x.setAttribute("value", tQty);

	var y = document.getElementById("totalAmount");
	y.setAttribute("value", tAmount);

</script>



</body>

</script>
<script src="../sales/js/bootstrap-datepicker.js"></script>


</html>
