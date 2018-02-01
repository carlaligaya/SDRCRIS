<%-- 
    Document   : dashboard
    Created on : 01 30, 18, 12:31:28 AM
    Author     : RDE
--%>

<%@page import="DAO.UserDAO"%>
<%@page import="Model.User"%>
<%@page import="java.util.ArrayList"%>
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
                                        <h1>Manage User</h1>
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
                                            <span>Manage User</span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!----BODY--->


                                    <div class="page-content-inner">
                                        <!----BODY--->
                                        <div class="row">
                                            <div class="col-md-14">
                                                <div class="portlet light">
                                                    <div class="portlet-title">
                                                        <div class="caption caption-md">
                                                            <i class="icon-bar-chart font-dark hide"></i>
                                                            <span class="caption-subject font-green-steel uppercase bold">MANAGE USERS</span>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body">
                                                        <div class="row list-separated">
                                                            <div class="table-responsive">
                                                                <form method="post" action="ViewUser">
                                                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="10%">First Name</th>
                                                                                <th width="10%">Last Name</th>
                                                                                <th width="10%">Middle Name</th>
                                                                                <th width="10%">Email</th>
                                                                                <th width="20%">Specializations</th>                                           
                                                                                <th width="10%">Masters</th>
                                                                                <th width="10%">Doctorate</th>
                                                                                <th width="10%">Registration Date</th>
                                                                                <th width="10%"></th>    
                                                                            </tr>
                                                                        </thead>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th width="10%">First Name</th>
                                                                                <th width="10%">Last Name</th>
                                                                                <th width="10%">Middle Name</th>
                                                                                <th width="10%">Email</th>
                                                                                <th width="20%">Specializations</th>                                       
                                                                                <th width="10%">Masters</th>
                                                                                <th width="10%">Doctorate</th>
                                                                                <th width="10%">Registration Date</th>
                                                                                <th width="10%"></th>    

                                                                            </tr>
                                                                        </tfoot>
                                                                        <tbody>
                                                                            <%
                                                                                UserDAO ud = new UserDAO();
                                                                                ArrayList<User> user = new ArrayList<User>();

                                                                                user = ud.activeUsers();
                                                                                for (int i = 0; i < user.size(); i++) {
                                                                            %>
                                                                            <tr>
                                                                                <td><%= user.get(i).getFirstName()%></td>
                                                                                <td><%= user.get(i).getLastName()%></td>
                                                                                <td><%= user.get(i).getMiddleName()%></td>
                                                                                <td><%= user.get(i).getEmail()%></td>
                                                                                <td><%= user.get(i).getSpecialization()%></td>
                                                                                <td><% if (user.get(i).getMasteral() == null) {%> <%} else {%> <%= user.get(i).getMasteral()%> <%}%></td>
                                                                                <td><% if (user.get(i).getDoctorate() == null) { %> <%} else {%> <%= user.get(i).getDoctorate()%> <%}%></td>
                                                                                <td><%= user.get(i).getRegistrationDate()%></td>
                                                                                <td><button name="user" value="<%= user.get(i).getUserID()%>" class="btn btn-info pull-right">UPDATE</button></td>
                                                                            </tr>
                                                                            <%}%>
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                            </div>
                                                            <br>
                                                        </div>

                                                    </div>
                                                    <ul class="list-separated list-inline-xs hide">

                                                    </ul>

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