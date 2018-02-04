/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import DAO.ProjectDAO;
import Model.Project;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author carl_
 */
public class RegisterProject extends BaseServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

    @Override
    protected void servletAction(HttpServletRequest request, HttpServletResponse response, HttpSession session) throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();

        Project p = new Project();
//        Funding f = new Funding();
//        ProjectBudget pb = new ProjectBudget();
//        ProjectExpense pe = new ProjectExpense();

        ProjectDAO pDAO = new ProjectDAO();

        p.setName(request.getParameter("pName"));
        p.setDescription(request.getParameter("pDescription"));
        p.setStartdate(request.getParameter("pStart"));
        p.setEnddate(request.getParameter("pEnd"));

        if (pDAO.RegisterProject(p)) {
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Project Successfully Registered!');");
            out.println("location='/SDRCRIS/dashboard.jsp';");
            out.println("</script>");
        }else{
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Project Unsuccessfully Registered!');");
            out.println("location='/SDRCRIS/reg_new_project.jsp';");
            out.println("</script>");
        }
    }

}
