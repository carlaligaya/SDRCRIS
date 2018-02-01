
<!DOCTYPE html>
<html lang="en" class="">

<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  

<link rel="stylesheet" type="text/css" href="../sales/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="../sales/css/style.css" />
<!-- star rating  -->


     
  
<script src="../../imports/libs/jquery/js/jquery.min.js"></script>
<!--  star rating-->
  <link rel="stylesheet" href="../libs/assets/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />

  <link rel="stylesheet" href="../../imports/css/font.css" type="text/css" />
  <link rel="stylesheet" href="../../imports/css/app.css" type="text/css" />



</head>
<body>
<header id="header" class="app-header navbar" role="menu">
    <!-- navbar header -->
    <div class="navbar-header bg-dark">
      <button class="pull-right visible-xs dk" ui-toggle-class="show" target=".navbar-collapse">
        <i class="glyphicon glyphicon-cog"></i>
      </button>
      <button class="pull-right visible-xs" ui-toggle-class="off-screen" target=".app-aside" ui-scroll="app">
        <i class="glyphicon glyphicon-align-justify"></i>
      </button>
      <!-- brand -->
      <a href="../dashboard/homepage_dealer.php" class="navbar-brand text-lt">

        <span class="hidden-folded m-l-xs">Holly's Milk</span>
      </a>
      <!-- / brand -->
    </div>
    <!-- / navbar header -->

    <!-- navbar collapse -->
    <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
      <!-- buttons -->
      <div class="nav navbar-nav hidden-xs">
        <a href="#" class="btn no-shadow navbar-btn" ui-toggle-class="app-aside-folded" target=".app">
          <i class="fa fa-dedent fa-fw text"></i>
          <i class="fa fa-indent fa-fw text-active"></i>
        </a>


      </div>
      <!-- / buttons -->

      <!-- link and dropdown -->

      <!-- / link and dropdown -->

      <!-- nabar right -->
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
              
            </span>
            <span class="hidden-sm hidden-md"><?php echo $_SESSION['name'] ?></span> <b class="caret"></b>
          </a>
          <!-- dropdown -->
          <ul class="dropdown-menu animated fadeInRight w">

            
          
            <li>
              <a ui-sref="app.docs">

                Help
              </a>
            </li>
            <li class="divider"></li>
            
            <li>
              <a ui-sref="access.signin" href="../accounts/logout.php">Logout</a>
            </li>
            
          </ul>
          <!-- / dropdown -->
        </li>
      </ul>
      <!-- / navbar right -->
    </div>
    <!-- / navbar collapse -->
  </header>
  <!-- / header -->

  <!-- aside -->
  <aside id="aside" class="app-aside hidden-xs bg-dark">
    <div class="aside-wrap">
      <div class="navi-wrap">
        <!-- user -->
        <div class="clearfix hidden-xs text-center hide" id="aside-user">
          <div class="dropdown wrapper">
            <a href="app.page.profile">
              <span class="thumb-lg w-auto-folded avatar m-t-sm">
                <img src="../img/a0.jpg" class="img-full" alt="...">
              </span>
            </a>
            <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
              <span class="clear">
                <span class="block m-t-sm">
                  <strong class="font-bold text-lt">John.Smith</strong> 
                  <b class="caret"></b>
                </span>
                <span class="text-muted text-xs block">Art Director</span>
              </span>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w hidden-folded">
              <li class="wrapper b-b m-b-sm bg-info m-t-n-xs">
                <span class="arrow top hidden-folded arrow-info"></span>
                <div>
                  <p>300mb of 500mb used</p>
                </div>
                <div class="progress progress-xs m-b-none dker">
                  <div class="progress-bar bg-white" data-toggle="tooltip" data-original-title="50%" style="width: 50%"></div>
                </div>
              </li>
              <li>
                <a href>Settings</a>
              </li>
              <li>
                <a href="page_profile.html">Profile</a>
              </li>
              <li>
                <a href>
                  <span class="badge bg-danger pull-right">3</span>
                  Notifications
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="page_signin.html">Logout</a>
              </li>
            </ul>
            <!-- / dropdown -->
          </div>
          <div class="line dk hidden-folded"></div>
        </div>
        <!-- / user -->

        <!-- nav -->
        <nav ui-nav class="navi clearfix">
          <ul class="nav">


            <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
              <span>Dealer Menu</span>
            </li>
            <li>
              <a href class="auto">      
                <span class="pull-right text-muted">
                  <i class="fa fa-fw fa-angle-right text"></i>
                  <i class="fa fa-fw fa-angle-down text-active"></i>
                </span>
                
                <span>Billing</span>
              </a>
              <ul class="nav nav-sub dk">
                <li class="nav-sub-header">
                  <a href>
                    <span>Sales and Billing</span>
                  </a>
                </li>
                <li>
                  <a href="../billing/invoicelist.php">
                    <span>My Invoices</span>
                  </a>
                </li>
                <li>
                  <a href="../sales/dealer_sales.php">
                    <span>Sales Report</span>
                  </a>
                </li>
                <li>
                </li>      
              </ul>
            </li>

            <li>
              <a href class="auto">      
                <span class="pull-right text-muted">
                  <i class="fa fa-fw fa-angle-right text"></i>
                  <i class="fa fa-fw fa-angle-down text-active"></i>
                </span>
                
                <span>Inventory</span>
              </a>
              <ul class="nav nav-sub dk">
                <li class="nav-sub-header">
                  <a href>
                    <span>Inventory</span>
                  </a>
                </li>
                <li>
                  <a href="../inventory/dealer_inventory.php">
                    <span>My Inventory</span>
                  </a>
                </li>
					  <li>
                  <a href="../inventory/expiryTracker.php">
                    <span>Expiry Tracker</span>
                  </a>
                </li>
				 <li>
                  <a href="../inventory/notify.php">
                    <span>Check Inventory</span>
                  </a>
                </li>
                <li>
                  <a href="../billing/receive.php">
                    <span>Receive Delivery</span>
                  </a>
                </li>
                <li>
                  <a href="../inventory/expired.php">
                    <span>Pull-Out Stock</span>
                  </a>
                </li>

                <li>
                  <a href="../po/purchaseorder.php">
                    <span>Create Purchase Order</span>
                  </a>
				  </li>
				  <li>
                  <a href="../po/polist.php">
                    <span>My Purchase Orders</span>
                  </a>
				 
                </li>
                <li>
				  <a href="../po/purchaseOrderReport.php">
                    <span>Purchase Order Report</span>
                  </a>
                </li>      
              </ul>
            </li>
            <li>
              <a href="../sales/pos.php">
                <i class="icon-user icon text-success-lter"></i>
                <span>Point of Sale</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- nav -->
      </div>
    </div>
  </aside>


  <!-- footer -->
<footer id="footer" class="app-footer" role="footer">
  <div class="wrapper b-t bg-light hidden-print">
    <span class="pull-right">2.2.0 <a href ui-scroll="app" class="m-l-sm text-muted"><i class="fa fa-long-arrow-up"></i></a></span>
    &copy; 2016 Copyright.
  </div>
</footer>
<!--<script src='../libs/angular/angular/angular.js'></script>
<script src='../libs/angular/angular-animate/angular-animate.js'></script>
-->
 
<script src="../libs/jquery/jquery/dist/jquery.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../libs/jquery/js/ui-load.js"></script>
  <script src="../libs/jquery/js/ui-jp.config.js"></script>
  <script src="../libs/jquery/js/ui-jp.js"></script>
  <script src="../libs/jquery/js/ui-nav.js"></script>
  <script src="../libs/jquery/js/ui-toggle.js"></script>
  <script src="../libs/jquery/js/ui-client.js"></script>

</body>
</html>
