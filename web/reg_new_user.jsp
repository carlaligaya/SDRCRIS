<%-- 
    Document   : dashboard
    Created on : 01 30, 18, 12:31:28 AM
    Author     : RDE
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@include file="functions/security.jsp" %>
<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <jsp:include page="dependencies/top_resources.jsp" />  
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-md">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <jsp:include page="functions/header.jsp" />
                    <!-- END HEADER -->
                </div>
            </div>
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->
                            <!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>Register New User</h1>
                                    </div>
                                    <!-- END PAGE TITLE -->
                                    <!-- BEGIN PAGE TOOLBAR -->
                                    <div class="page-toolbar">

                                    </div>
                                    <!-- END PAGE TOOLBAR -->
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    <!-- BEGIN PAGE BREADCRUMBS -->
                                    <ul class="page-breadcrumb breadcrumb">
                                        <li>
                                            <span>Administrative</span>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <a href="manage_user.jsp">Manage User</a>
                                            <i class="fa fa-circle"></i>

                                        </li><li>
                                            <span>Update User Information</span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!----BODY--->

                                    <div class="page-content-inner">
                                        <!----BODY--->

                                        <!-- BEGIN PAGE CONTENT INNER -->
                                        <div class="page-content-inner">
                                            <!----BODY--->
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="portlet light ">
                                                        <div class="portlet-title">
                                                            <div class="caption caption-md">
                                                                <i class="icon-bar-chart font-dark hide"></i>
                                                                <span class="caption-subject font-green-steel uppercase bold">UPDATE USER INFORMATION</span>
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row list-separated">

                                                                <form class="col-md-10">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">First Name</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Middle Name</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Middle Name" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Last Name</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last Name" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Email</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Password</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Re-enter Password</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Re-Enter Password" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Specializations</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Specializations" required>
                                                                        <small>Please input all specializations separated by a comma.</small></div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Masters</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masters" >
                                                                        <small>Leave blank if not applicable.</small> </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Doctorate</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Doctorate" >
                                                                        <small>Leave blank if not applicable.</small></div>
                                                                    <div class="form-group">
                                                                        <label for="sel1">User Type</label>
                                                                        <select class="form-control" id="sel1">
                                                                            <option>System Administrator</option>
                                                                            <option>System User</option>
                                                                            <option>Public User</option>
                                                                        </select>
                                                                    </div> 
                                                                    <input type="submit" class="btn btn-info pull left" value="Update User">
                                                                </form>
                                                            </div>                                              
                                                        </div>							
                                                        <ul class="list-separated list-inline-xs hide">

                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                            </div>
                            <!-- END PAGE CONTENT INNER -->
                        </div>
                    </div>
                    <!-- END PAGE CONTENT BODY -->
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                <a href="javascript:;" class="page-quick-sidebar-toggler">
                    <i class="icon-login"></i>
                </a>

                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
        </div>
    </div>
    <div class="page-wrapper-row">
        <div class="page-wrapper-bottom">
            <!-- BEGIN FOOTER -->

            <jsp:include page="functions/footer.jsp" />
            <!-- END FOOTER -->
        </div>
    </div>
</div>
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
<jsp:include page="dependencies/bottom_resources.jsp" />
</body>

</html>