
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
					<h1 class="m-n font-thin h3">Receivable Report</h1>
				</div>
				<div class="wrapper-md">
					<div class="panel panel-default">
						<div class="panel-heading">
							Receivable Report
						</div>
						<div class="wrapper-md">
							<div class="wrapper-md bg-white-only b-b">
								<div class="row text-center">
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="col-sm-8" align="left">  
											
												<div class="hero-unit">
													<p> Starting Date: <input type="text"  required name="search2" data-date-format='yyyy-mm-dd' id="from" > End Date:<input type="text" required name="search"  data-date-format='yyyy-mm-dd' id="to" > </p>
												</div>
													
											
										</div>
										<div  align="right">
											<p>Search by username: <input type="text" name="search3"><input type="submit" name="submit" value="search"></p>
										</div>
									</form>
									<div class="wrapper-md bg-white-only b-b">
										<div class="row text-center">
											<div class="col-sm-3 col-xs-6">
												<div>Number of Invoices<i class="fa fa-fw fa-caret-up text-success text-sm"></i></div><input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="totalQty">
											</div>
										<!--	<div class="col-sm-3 col-xs-6">
												<div>Total Amount <i class="fa fa-fw fa-caret-up text-success text-sm"></i></div><input class="h2 m-b-sm" style="border:none; text-align:center" readonly id="totalAmount">
											</div> -->

										</div>
									</div>
								</div>

								<b>Receivable Report</b> 

								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline" role="form">
									<div class="table-responsive">
										<table  class="table table-striped b-t b-b">
											<thead>
												<tr>
													<th  style="width:10%">Invoice Date</th>
													<th  style="width:10%">Invoice Number</th>
													<th  style="width:10%">Name</th>
													<th  style="width:20%">Status</th>
													
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
														$resultSet=$mysqli->query("SELECT * FROM invoice WHERE invoiceDate BETWEEN '$search2' AND '$search' ORDER BY invoiceDate;");


														if($resultSet->num_rows>0){
															while($rows=$resultSet->fetch_assoc()){
																$status = $rows['status'];
if($status ==0){
$status="unpaid";	
}
else{
	$status="paid";
}

																echo "</tbody><tr>
																<td >".$rows['invoiceDate']."</td>
																<td >".$rows['invoiceNo']."<input type=hidden class='qtySR' name='qtySR' value=".$rows["invoiceNo"]."></td></td>
																<td >".$rows['username']."</td>
																<td >$status</td>
															
																
															</tr></tbody>";
														}
		//if no data output 
							
													}else{

														echo"No results";
													}

												}

												else{$resultSet=$mysqli->query("SELECT * FROM invoice WHERE username='$search3' and invoiceDate BETWEEN '$search2' AND '$search' ORDER BY invoiceDate ;");
														//put here the session

	//check if there are any info gathered from db
													if($resultSet->num_rows>0){
														while($rows=$resultSet->fetch_assoc()){
$status = $rows['status'];
if($status ==0){
$status="unpaid";	
}
else{
	$status="paid";
}
															echo "<tbody><tr>
															<td >".$rows['invoiceDate']."</td>
																<td >".$rows['invoiceNo']."<input type=hidden class='qtySR' name='qtySR' value=".$rows["invoiceNo"]."></td> 
																<td >".$rows['username']."</td>
																<td >$status</td>

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
	$('.qtySR').each(function(){
		tQty++;

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
