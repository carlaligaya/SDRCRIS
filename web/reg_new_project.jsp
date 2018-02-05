<%-- 
    Document   : dashboard
    Created on : 01 30, 18, 12:31:28 AM
    Author     : RDE
--%>

<%@page import="DAO.UserDAO"%>
<%@page import="Model.User"%>
<%@page import="java.util.ArrayList"%>

<%@include file="functions/security.jsp" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
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
                                        <h1>Register New Project</h1>
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
                                            <span>Register New Project</span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <form  action="RegisterProject" method="post">
                                        <div class="page-content-inner">
                                            <!----BODY--->
                                            <div class="page-content-inner">
                                                <!----BODY--->
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="portlet light ">
                                                            <div class="portlet-title">
                                                                <div class="caption caption-md">
                                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                                    <span class="caption-subject font-green-steel uppercase bold">INPUT PROJECT DETAILS</span>
                                                                </div>

                                                            </div>
                                                            <div class="portlet-body">
                                                                <div class="row list-separated">

                                                                    <div class="col-md-10">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Name</label>
                                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" name="pName" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Description</label>
                                                                            <textarea class="form-control"  aria-describedby="emailHelp" placeholder="Description" name="pDescription" required></textarea>

                                                                        </div>	
                                                                                <div class="form-group">
                                                                            <label for="exampleInputEmail1">Name</label>
                                                                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="pStart" required>
                                                                        </div>
                                                                                <div class="form-group">
                                                                            <label for="exampleInputEmail1">Name</label>
                                                                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pEnd" required>
                                                                        </div>
                                                                        <input type="submit" class="btn btn-info" value="REGISTER NEW PROJECT">
                                                                        <div class="pull-left">
                                                                        </div>                                              
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
                                    </form>
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