/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import DAO.ProjectDAO;
import Model.Funding;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author Carl
 */
public class UpdateFunding extends BaseServlet {

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
        Funding f = new Funding();
        
        f.setFundingorganizationID(Integer.parseInt(session.getAttribute("funds").toString()));
        f.setFundingorganization_name(request.getParameter("fName"));
        f.setDescription(request.getParameter("fDescription"));
        f.setFundingorganization_type(Integer.parseInt(request.getParameter("fType")));

        if (pDAO.updateFunding(f)) {
            session.setAttribute("funds", null);
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Funding Organization has been Successfully Updated!');");
            out.println("location='/SDRCRIS/reg_funding_organization.jsp';");
            out.println("</script>");
        } else {
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Funding Organization has been Unsuccessfully Updated!');");
            out.println("location='/SDRCRIS/reg_funding_organization.jsp';");
            out.println("</script>");
        }
    }

}
