
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
<style>

#banner
  {
    padding-top: 5em;
  }

  .wrapper
  {
    overflow: hidden;
    padding: 0em 0em 5em 0em;
    background: #FFF;
  }
  .title
  {
    margin-bottom: 3em;
  }
  #welcome
  {
    overflow: hidden;
    width: 1000px;
    padding: 6em 100px 0em 100px;
    text-align: center;
  }
  .container
  {
    margin: 0px auto;
    width: 1200px;
  }
  /*#banner {
    padding: 12em 0 10em 0;
    background-image: url('../img/banner.jpg');
    background-size: cover;
    background-position: top;
    background-attachment: fixed;
    background-repeat: no-repeat;
    text-align: center;
    border-top: 0.5em solid #5385c1;
  }*/
 
</style>
</head>
<body>
  <div class="app app-header-fixed ">


   <!-- header -->
   <?php include '../session/levelOfAccess.php';?>
   <!-- / aside -->


   <!-- content -->
   <div id="content" class="app-content" role="main">
     <div class="app-content-body ">


     <div class="wrapper">
  <div id="banner" class="container"><img src="../img/banner.jpg" width="1150" height="500" alt="" /></div>
  <div id="welcome" class="container">
      
<div class="title">
    <h2>Welcome to Laguna Creamery Inc.</h2>
    </div>
    <p> <strong>Your time is limited, so don’t waste it living someone else’s life.</strong> – Steve Jobs</p>
  </div>
</div>
     <!-- <section id="banner">
        <h1><font color="white"><strong>Welcome <?php echo $_SESSION['name'] ?></strong></font></h1>
        <p><font color="white">Your time is limited, so don’t waste it living someone else’s life. – Steve Jobs</font></p>
      </section> -->

      <!-- <section class="wrapper">
        <div class="inner">
          <div class="flex flex-3">
            <article>
              <header>
                <h3><br /></h3>
              </header>
              <p></p>
              <footer>
                <a ></a>
              </footer>
            </article>
          </div>
        </div>
      </section> -->

      <!--  <div class="jumbotron">
        <h1>Hello, <?php echo $_SESSION['name'] ?>!</h1>
      </div> -->

    </div>
  </div>	    




	<!-- <h1>
	<center>
	<center>Welcome to Dairy MAN </center>
	<?php echo "Today is " . date("Y/m/d") . "<br>"; 
	date_default_timezone_set("asia/manila");
		echo "The time is " . date("h:i:sa");?>
	
	</center>
</h1> -->




<!-- /content -->
</div>

</body>
</html>
