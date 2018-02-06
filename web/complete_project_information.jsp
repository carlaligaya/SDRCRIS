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
                                        <h1>Complete Project Information</h1>
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
                                            <span>Complete Project Information</span>
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
                                                            <span class="caption-subject font-green-steel uppercase bold">Initial Project Information</span>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body">
                                                        <div class="row list-separated">
                                                            <div class="col-md-6">
                                                                
                                                                <h5>Project Name: </h5>
                                                                <h4>Mapping of health risks from agents of disasters</h4><br>
                                                                <h5>Project Description: </h5>
                                                                <h4>This project aims to capture data for associated health risks</h4><br> 
                                                            </div>
                                                              <div class="col-md-6">
                                                                
                                                                <h5>Start date: </h5>
                                                                <h4>10-22-2016</h4><br>
                                                                <h5>End date: </h5>
                                                                <h4>10-22-2018</h4><br>                                   
                                                              </div>
                                                        </div>
                                                    </div>
                                                    <ul class="list-separated list-inline-xs hide">

                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="page-content-inner">
                                        <!----BODY--->
                                        <div class="row">
                                            <div class="col-md-14">
                                                <div class="portlet light">
                                                    <div class="portlet-title">
                                                        <div class="caption caption-md">
                                                            <i class="icon-bar-chart font-dark hide"></i>
                                                            <span class="caption-subject font-green-steel uppercase bold">ADDITIONAL PROJECT INFORMATION</span>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body">
                                                        <div class="row list-separated">
                                                      <form>      
                                                            
                                                <div class="col-md-12">
    
                                                 <h4><b>Upload Supporting Project Documents</b></h4>
   
                                                            <div action="/" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data" style="background-color:#272727">
                                                            <div class="dz-message" >
                                                                <div class="drag-icon-cph" style="color:white">
                                                                    <i class="fa fa-file-archive-o" ></i>
                                                                </div>
                                                            <b>    <h3 style="color:white">DROP DOCUMENT CONTRACT OR CLICK TO UPLOAD FILES</h3></b>
                                                            </div>
                                                            <div class="fallback">
                                                                <input name="file" type="file" />
                                                            </div>
                                                        </div> <small>Please ensure that the document created is scanned</small>                  
                                                        
                                                        
                                                </div>
                                                            
                                                                                      
                                                <div class="col-md-12">
    
                                                 <h4><b>Fill up additional details on project</b></h4>
   
                                                                       
                                                        
                                                        
<input type="submit" class="btn btn-info pull-right" value="Submit Button">
                                                </div>
                                                            </form>
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