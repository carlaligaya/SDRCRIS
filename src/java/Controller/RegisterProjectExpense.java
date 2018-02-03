/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import DAO.ProjectDAO;
import Model.ProjectExpense;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author carl_
 */
public class RegisterProjectExpense extends BaseServlet {

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

        ProjectDAO pDAO = new ProjectDAO();
        ProjectExpense pe = new ProjectExpense();

        pe.setAmount(Float.parseFloat(request.getParameter("amount")));
        pe.setRemarks(request.getParameter("remarks"));
        pe.setDate(request.getParameter("date"));
        pe.setExpense_projectID(Integer.parseInt(session.getAttribute("viewproject").toString()));
        pe.setExpense_category(Integer.parseInt(request.getParameter("expenseC")));
        pe.setExpense_method(Integer.parseInt(request.getParameter("expenseM")));

        if (pDAO.addProjectExpense(pe)) {
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Project Expense Successfully Registered!');");
            out.println("location='reg_expenses.jsp';")
            out.println("</script>");
        } else {
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Project Expense Unsuccessfully Registered!');");
            out.println("location='reg_expenses.jsp';")
            out.println("</script>");
        }

    }

}
