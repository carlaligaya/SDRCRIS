<%-- 
    Document   : dashboard
    Created on : 01 30, 18, 12:31:28 AM
    Author     : RDE
--%>

<%@page import="DAO.UserDAO"%>
<%@page import="Model.User"%>
<%@page import="Model.UserTypes"%>
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
                                        <h1>Update User</h1>
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

                                        </li>
                                        <li>
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

                                                                <%
                                                                    UserDAO uDAO = new UserDAO();
                                                                    User u = new User();

                                                                    if (session.getAttribute("IDuser") != null) {
                                                                        u = uDAO.getUser(Integer.parseInt(session.getAttribute("IDuser").toString()));
                                                                    } else {
                                                                        u = uDAO.getUser(Integer.parseInt(session.getAttribute("userID").toString()));
                                                                    }

                                                                %>

                                                                <form class="col-md-10" method="post" action="UpdateUser">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">First Name</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name" value="<%= u.getFirstName()%>" name="fn" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Middle Name</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Middle Name" value="<%= u.getMiddleName()%>" name="mn" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Last Name</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last Name" value="<%= u.getLastName()%>" name="ln" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Email</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value="<%= u.getEmail()%>" name="em" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Password</label>
                                                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="p1" value="<%= u.getPassword()%>" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Re-enter Password</label>
                                                                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Re-Enter Password" name="p2" value="<%= u.getPassword()%>" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Specializations</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Specializations" value="<%= u.getSpecialization()%>" name="spe" required>
                                                                        <small>Please input all specializations separated by a comma.</small></div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Masters</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masters" value="<%= u.getMasteral()%>" name="mas">
                                                                        <small>Leave blank if not applicable.</small> </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Doctorate</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Doctorate" value="<%= u.getDoctorate()%>" name="doc">
                                                                        <small>Leave blank if not applicable.</small></div>

                                                                    <%
                                                                        String type = uDAO.getType(u.getUserType());
                                                                    %>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Current User Type</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value="<%= type%>" name="em" disabled>
                                                                    </div>

                                                                    <!--                                                                    <div class="form-group">
                                                                                                                                            <label for="sel1">New User Type</label>
                                                                                                                                            <select name="uTypes" class="form-control">
                                                                    <%
                                                                        ArrayList<UserTypes> types = new ArrayList<UserTypes>();

                                                                        types = uDAO.getActiveTypes();
                                                                        for (int i = 0; i < types.size(); i++) {
                                                                    %>
                                                                    <option value="<%= types.get(i).getUsertype()%>"> <%= types.get(i).getName()%></option>
                                                                    <%}%>
                                                                </select>
                                                            </div> -->
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