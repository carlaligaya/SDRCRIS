<%-- 
    Document   : dashboard
    Created on : 01 30, 18, 12:31:28 AM
    Author     : RDE
--%>

<%@page import="Model.FundingOrganizationType"%>
<%@page import="DAO.FundingDAO"%>
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
                                        <h1>Register Funding Organization Type</h1>
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
                                            <span>Budget Tracker</span>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Register Funding Organization Type</span>
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
                                                                <%  
                                                                    FundingOrganizationType ft = new FundingOrganizationType();
                                                                    FundingDAO fDAO = new FundingDAO();
                                                                    if (session.getAttribute("fotype") != null) {
                                                                        ft = fDAO.getFundingType(Integer.parseInt(session.getAttribute("fotype").toString()));
                                                                %>
                                                                <span class="caption-subject font-green-steel uppercase bold">UPDATE FUNDING ORGANIZATION TYPE</span>
                                                                <%} else {%>
                                                                <span class="caption-subject font-green-steel uppercase bold">REGISTER FUNDING ORGANIZATION TYPE</span>
                                                                <%}%>
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row list-separated">

                                                                <form class="col-md-10" action="RegisterFundingType" method="post">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Name</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" name="FTname" <% if (session.getAttribute("fotype") != null) {%> value="<%= ft.getName()%>" <%}%> required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Description</label>
                                                                        <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Description" name="FTdescription" required><% if (session.getAttribute("fotype") != null) {%> <%= ft.getDescription()%> <%}%></textarea>

                                                                    </div>




                                                                    <div class="pull-left">
                                                                        <%
                                                                            if (session.getAttribute("fotype") != null) {
                                                                        %>
                                                                        <input type="submit" class="btn btn-info" value="Update Funding Organization Type" onclick="form.action = 'UpdateFundingType';">
                                                                        <%} else {%>
                                                                        <input type="submit" class="btn btn-info" value="Register Funding Organization Type">
                                                                        <%}%>
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
                                                                <span class="caption-subject font-green-steel uppercase bold">REGISTERED FUNDING ORGANIZATION TYPES</span>
                                                            </div>

                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row list-separated">
                                                                <div class="table-responsive">
                                                                    <form class="col-md-10" action="ViewFundingType" method="post">
                                                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="40%">Name</th>
                                                                                    <th width="60%">Description</th>
                                                                                    <th></th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th width="40%">Name</th>
                                                                                    <th width="60%">Description</th>
                                                                                    <th></th>
                                                                                    <th></th>
                                                                                </tr>                                    
                                                                            </tfoot>
                                                                            <tbody>
                                                                                <%
                                                                                    ArrayList<FundingOrganizationType> types = new ArrayList<FundingOrganizationType>();

                                                                                    types = fDAO.getActiveOrganizationTypes();

                                                                                    for (int i = 0; i < types.size(); i++) {
                                                                                %>
                                                                                <tr>
                                                                                    <td><%= types.get(i).getName()%></td>
                                                                                    <td><%= types.get(i).getDescription()%></td>
                                                                                    <td><button name="foID" value="<%= types.get(i).getFundingorganization_typeID() %>" class="btn btn-info pull-right" onclick="form.action = 'DeactivateFundingType';">Deactivate</button></td>               
                                                                                    <td><button name="foID" value="<%= types.get(i).getFundingorganization_typeID()%>" class="btn btn-info pull-right" >Update</button></td>               
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
        <!--[if lt IE 9]>
    <script src="assets/global/plugins/respond.min.js"></script>
    <script src="assets/global/plugins/excanvas.min.js"></script> 
    <script src="assets/global/plugins/ie8.fix.min.js"></script> 
    <![endif]-->
        <jsp:include page="dependencies/bottom_resources.jsp" />
    </body>

</html>