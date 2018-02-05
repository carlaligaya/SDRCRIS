/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import DAO.BudgetDAO;
import Model.BudgetRegistrationType;
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
public class UpdateBudgetType extends BaseServlet {

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

        BudgetDAO bDAO = new BudgetDAO();
        BudgetRegistrationType bt = new BudgetRegistrationType();

        bt.setBudgetregistration_typeID(Integer.parseInt(session.getAttribute("Btype").toString()));
        bt.setName(request.getParameter("BTname"));
        bt.setDescription(request.getParameter("BTdescription"));

        if (bDAO.updateBudgetType(bt)) {
            session.setAttribute("Btype", null);
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Budget Registration Type Successfully Updated!');");
            out.println("location='/SDRCRIS/reg_budget_type.jsp';");
            out.println("</script>");
        } else {
            out.println("<script type=\"text/javascript\">");
            out.println("location='/SDRCRIS/reg_budget_type.jsp';");
            out.println("location='.jsp';");
            out.println("</script>");
        }
    }

}
