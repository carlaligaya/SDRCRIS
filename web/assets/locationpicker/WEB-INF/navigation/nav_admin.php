<!DOCTYPE html>
<html lang="en" class="">

<head>
  <meta charset="utf-8" />
  <title>Laguna Creamery Inc</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  
  <link rel="stylesheet" type="text/css" href="../sales/css/datepicker.css" />
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
      <a href="../dashboard/homepage_admin.php" class="navbar-brand text-lt">

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
              <span>Admin Menu</span>
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
                  <a href="../billing/admin_invoicelist.php">
                    <span>Dealer Invoices List</span>
                  </a>
                </li>
                <li>
                  <a href="../billing/admininvoices.php">
                    <span>Dealer Invoices Report</span>
                  </a>
                </li>
                <li>
                  <a href="../sales/admin_sales.php">
                    <span>Sales Report</span>
                  </a>
                </li>
                <li>
                  <a href="../billing/receivableReport.php">
                    <span>Receivable Report</span>
                  </a>
                </li>
                <li>
                  <a href="../po/admin_polist.php">
                    <span>Purchase Orders</span>
                  </a>
				
                </li>
                <li>
                  <a href="../reports/spoilage_list.php">
                    <span>Spoilage</span>
                  </a>
                </li>
                <li>
				   <a href="../po/purchaseOrderReportAdmin.php">
                    <span>Purchase Order Report</span>
                  </a>
                </li>  
				
              </ul>
            </li>

            <li>
              <a href class="auto">      
                <span class="pull-right text-muted">
                  <i class="fa fa-fw fa-angle-right text"></i>
                  <i class="fa fa-fw fa-angle-down text-active"></i>
                </span>
                
                <span>Distribution</span>
              </a>
              <ul class="nav nav-sub dk">
                <li class="nav-sub-header">
                  <a href>
                    <span>Distribution</span>

                    <li>
                      <a href="../po/allocation.php">
                        <span>Allocate Deliveries</span>
                      </a>
                    </li>
                  </a>
                </li>
                <li>
                  <a href="../delivery/generateDelivery.php">
                    <span>Generate Delivery Receipt</span>
                  </a>
                </li>
                <li>
                  <a href="../delivery/deliverylist.php">
                    <span>Delivery Statuses</span>
                  </a>
                </li>
                <li>
                  <a href="../po/productlist.php">
                    <span>Manage Products</span>
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
                
                <span>Production</span>
              </a>
              <ul class="nav nav-sub dk">
                <li class="nav-sub-header">
                  <a href>
                    <span>Production </span>
                  </a>
                </li>
                <li>
                  <a href="../po/productionorder.php">
                    <span>Create Production Order</span>
                  </a>
                </li>
                <li>
                  <a href="../po/admin_pblist.php">
                    <span>List Production Orders</span>
                  </a>
                </li>
             
                 
              </ul>
            </li>

            <li>
              <a href class="auto">      
                <span class="pull-right text-muted">
                  <i class="fa fa-fw fa-angle-right text"></i>
                  <i class="fa fa-fw fa-angle-down text-active"></i>
                </span>
                
                <span>Dealer Management</span>
              </a>
              <ul class="nav nav-sub dk">
                <li class="nav-sub-header">
                  <a href>
                    <span>Dealer Management</span>
                  </a>
                </li>
                <li>
                  <a href="../accounts/newuser.php">
                    <span>Create Dealer</span>
                  </a>
                </li>
			  <li>
                  <a href="../accounts/dealerMetrics.php">
                    <span>Dealer Metrics</span>
                  </a>
                </li>

                <li>
                  <a href="../accounts/dealerlist.php">
                    <span>List Dealers (Manage)</span>
                  </a>
                </li>
                <li>

                </li>
                <li>
                </li>      
              </ul>
            </li>
          </ul>
        </nav>
        <!-- nav -->
      </div>
    </div>
  </aside>
  <!-- footer -->
  <footer id="footer" class="app-footer" role="footer">
    <div class="wrapper b-t bg-light">
      <span class="pull-right">2.2.0 <a href ui-scroll="app" class="m-l-sm text-muted"><i class="fa fa-long-arrow-up"></i></a></span>
      &copy; 2016 Copyright.
    </div>
  </footer>
  <!-- / footer -->

</body>

 

<script src="../libs/jquery/jquery/dist/jquery.js"></script>
<script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="../libs/jquery/js/ui-load.js"></script>
<script src="../libs/jquery/js/ui-jp.config.js"></script>
<script src="../libs/jquery/js/ui-jp.js"></script>
<script src="../libs/jquery/js/ui-nav.js"></script>
<script src="../libs/jquery/js/ui-toggle.js"></script>
<script src="../libs/jquery/js/ui-client.js"></script>

</html>