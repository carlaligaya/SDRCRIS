<%-- 
    Document   : dashboard
    Created on : 01 30, 18, 12:31:28 AM
    Author     : RDE
--%>

<%@page import="Model.Project"%>
<%@page import="DAO.ProjectDAO"%>
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
                                        <h1>Update Project</h1>
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
                                            <span>Update Project</span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->

                                    <div class="page-content-inner">
                                        <!----BODY--->
                                        <div class="page-content-inner">
                                            <!----BODY--->
                                            <div class="row">
                                                <form method="post" action="UpdateProject"> 
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="portlet light ">
                                                            <div class="portlet-title">
                                                                <div class="caption caption-md">
                                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                                    <span class="caption-subject font-green-steel uppercase bold">STEP 1: UPDATE PROJECT DETAILS</span>
                                                                </div>

                                                            </div>
                                                            <div class="portlet-body">
                                                                <div class="row list-separated">

                                                                    <%
                                                                        ProjectDAO pDAO = new ProjectDAO();
                                                                        Project p = new Project();

                                                                        p = pDAO.getProject(Integer.parseInt(session.getAttribute("viewproject").toString()));
                                                                    %>

                                                                    <div class="col-md-10">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Name</label>
                                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" value="<%= p.getName()%>" style="width: 500px;" name="name" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Description</label>
                                                                            <textarea class="form-control" aria-describedby="emailHelp" placeholder="Description" style="width: 500px;" name="description" required><%= p.getDescription()%></textarea>

                                                                        </div>		
                                                                        <div class="pull-left">
                                                                        </div>                                              
                                                                    </div>

                                                                </div>							


                                                                <ul class="list-separated list-inline-xs hide">

                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="portlet light ">
                                                            <div class="portlet-title">
                                                                <div class="caption caption-md">
                                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                                    <span class="caption-subject font-green-steel uppercase bold">STEP 2: UPDATE PROJECT MEMBERS</span>
                                                                </div>

                                                            </div>
                                                            <div class="portlet-body">
                                                                <div class="row list-separated">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="30%">First Name</th>
                                                                                    <th width="30%">Middle Name</th>
                                                                                    <th width="30%">Last Name</th>
                                                                                    <th width="10%"></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th width="30%">First Name</th>
                                                                                    <th width="30%">Middle Name</th>
                                                                                    <th width="30%">Last Name</th>
                                                                                    <th width="10%"></th>

                                                                                </tr>
                                                                            </tfoot>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul class="list-separated list-inline-xs hide">

                                                            </ul>

                                                        </div>

                                                        <input type="submit" class="btn btn-info pull-right" value="Update Project">
                                                        <a href="assign_project_roles.jsp" class="btn btn-default pull-right" style="margin-right:10px" role="button">Update Project Roles</a>

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