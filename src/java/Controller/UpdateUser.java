/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import DAO.UserDAO;
import Model.User;
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
public class UpdateUser extends BaseServlet {

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

        UserDAO uDAO = new UserDAO();
        User u = new User();

        if (session.getAttribute("IDuser") != null) {
            u.setUserID(Integer.parseInt(session.getAttribute("IDuser").toString()));
        } else {
            u.setUserID(Integer.parseInt(session.getAttribute("userID").toString()));
        }

        u.setFirstName(request.getParameter("fn"));
        u.setMiddleName(request.getParameter("mn"));
        u.setLastName(request.getParameter("ln"));
        u.setEmail(request.getParameter("em"));
        u.setPassword(request.getParameter("p1"));
        u.setSpecialization(request.getParameter("spe"));
        u.setMasteral(request.getParameter("mas"));
        u.setDoctorate(request.getParameter("doc"));

        if (request.getParameter("p1").equals(request.getParameter("p2"))) {
            if (uDAO.UpdateUser(u)) {
                ServletContext context = getServletContext();
                RequestDispatcher dispatcher = context.getRequestDispatcher("/manage_user.jsp");
                dispatcher.forward(request, response);

                if (session.getAttribute("IDuser") != null) {
                    out.println("<script type=\"text/javascript\">");
                    out.println("alert('User Details Successfully Updated!');");
                    out.println("location='manage_user.jsp';");
                    out.println("</script>");
                } else {
                    out.println("<script type=\"text/javascript\">");
                    out.println("alert('User Details Successfully Updated!');");
                    out.println("location='update_user.jsp';");
                    out.println("</script>");
                }
            }
        } else {
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Passwords did not match!');");
            out.println("location='update_user.jsp';");
            out.println("</script>");
        }
    }

}
