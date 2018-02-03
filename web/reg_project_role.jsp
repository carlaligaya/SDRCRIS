<%-- 
    Document   : dashboard
    Created on : 01 30, 18, 12:31:28 AM
    Author     : RDE
--%>

<%@page import="Model.ProjectRole"%>
<%@page import="java.util.ArrayList"%>
<%@page import="DAO.RolesDAO"%>
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
                                        <h1>Register Project Role</h1>
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
                                            <span>Register Project Role</span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        <!----BODY--->
                                        <div class="page-content-inner">
                                            <!----BODY--->
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="portlet light ">
                                                        <div class="portlet-title">
                                                            <div class="caption caption-md">
                                                                <i class="icon-bar-chart font-dark hide"></i>
                                                                <span class="caption-subject font-green-steel uppercase bold">REGISTER NEW PROJECT ROLE</span>
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row list-separated">

                                                                <form class="col-md-10" action="RegisterProjectRole" method="post">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Role</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" name ="role" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Description</label>
                                                                        <textarea class="form-control"  aria-describedby="emailHelp" placeholder="Description" name="description" required></textarea>

                                                                    </div>		
                                                                    <div class="pull-left">
                                                                        <input type="submit" class="btn btn-info" value="Register User Types">
                                                                    </div>                                              
                                                                </form>

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
                                                                <span class="caption-subject font-green-steel uppercase bold">REGISTERED PROJECT ROLE TYPE</span>
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row list-separated">
                                                                <div class="table-responsive">
                                                                    <form method="post" action="DeactivateProjectRole">
                                                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="20%">Name</th>
                                                                                    <th width="65%">Description</th>
                                                                                    <th width="15%"></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th>Name</th>
                                                                                    <th>Description</th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </tfoot>
                                                                            <tbody>
                                                                                <%
                                                                                    RolesDAO rd = new RolesDAO();
                                                                                    ArrayList<ProjectRole> roles = new ArrayList<ProjectRole>();

                                                                                    roles = rd.getActiveRoles();
                                                                                    for (int i = 0; i < roles.size(); i++) {
                                                                                %>
                                                                                <tr>
                                                                                    <td><%= roles.get(i).getRole()%></td>
                                                                                    <td><%= roles.get(i).getDescription()%></td>
                                                                                    <td>  <button type="submit" class="btn btn-warning" name="rID" value="<%= roles.get(i).getRoleID()%>">Deactivate</button></td>
                                                                                </tr>
                                                                                <%}%>
                                                                            </tbody>
                                                                        </table>
                                                                    </form>
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