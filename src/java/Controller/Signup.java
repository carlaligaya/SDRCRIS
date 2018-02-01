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

/**
 *
 * @author carl_
 */
public class Signup extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        ServletContext context = getServletContext();
        RequestDispatcher dispatcher;
        PrintWriter out = response.getWriter();

        User u = new User();
        UserDAO uDAO = new UserDAO();

        u.setFirstName(request.getParameter("firstname"));
        u.setMiddleName(request.getParameter("middlename"));
        u.setLastName(request.getParameter("lastname"));
        u.setEmail(request.getParameter("email"));
        u.setSpecialization(request.getParameter("specializations"));
        u.setMasteral(request.getParameter("masters"));
        u.setDoctorate(request.getParameter("doctorate"));

        if (request.getParameter("password").equals(request.getParameter("rpassword"))) {
            u.setPassword(request.getParameter("password"));

            if (uDAO.check(request.getParameter("email"), request.getParameter("middlename"))) {
                out.println("<script type=\"text/javascript\">");
                out.println("alert('Account Already exits!');");
                out.println("location='index.jsp';");
                out.println("</script>");
            } else {
                if (uDAO.RegisterUser(u)) {
                    context = getServletContext();
                    dispatcher = context.getRequestDispatcher("/index.jsp");
                    dispatcher.forward(request, response);
                }
            }
        } else {
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Passwords do not match!');");
            out.println("location='index.jsp';");
            out.println("</script>");
        }

    }

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

}
