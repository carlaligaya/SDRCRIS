<%-- 
    Document   : dashboard
    Created on : 01 30, 18, 12:31:28 AM
    Author     : RDE
--%>

<%@page import="DAO.ProjectDAO"%>
<%@page import="Model.Project"%>
<%@page import="java.util.ArrayList"%>
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
                    <jsp:include page="functions/login_header.jsp" />
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
                                        <h1>Selection of Project</h1>
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
                                                            <span class="caption-subject font-green-steel uppercase bold">AVAILABLE PROJECTS</span>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body">
                                                        <div class="row list-separated">
                                                            <div class="table-responsive">
                                                                <form method="post" action="ViewProject">
                                                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="20%">Name</th>
                                                                                <th width="50%">Description</th>
                                                                                <th width="10%">Start Date</th>
                                                                                <th width="10%">Access Type</th>    
                                                                                <th width="5%">Select</th> 
                                                                            </tr>
                                                                        </thead>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th width="30%">Name</th>
                                                                                <th width="40%">Description</th>
                                                                                <th width="10%">Start Date</th>
                                                                                <th width="10%">Access Type</th>  
                                                                                <th width="5%">Select</th> 
                                                                            </tr>
                                                                        </tfoot>
                                                                        <tbody>
                                                                            <%                                                                                ProjectDAO pd = new ProjectDAO();
                                                                                ArrayList<Project> projects = new ArrayList<Project>();

                                                                                projects = pd.getActiveProjects();

                                                                                for (int i = 0; i < projects.size(); i++) {
                                                                            %>
                                                                            <tr>
                                                                                <td><%= projects.get(i).getName()%></td>
                                                                                <td><%= projects.get(i).getDescription()%></td>
                                                                                <td><%= projects.get(i).getStartdate()%></td>
                                                                                <td></td>
                                                                               
                                                                                <td>  
                                                                                    <button name="pID" type="submit" class="btn btn-info btn-lg" value="<%= projects.get(i).getProjectID()%>" />
                                                                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                                                                </td>
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