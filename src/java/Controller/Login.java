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
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author carl_
 */
public class Login extends HttpServlet {

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
        PrintWriter out = response.getWriter();
        User u = new User();
        UserDAO uDAO = new UserDAO();

        if (uDAO.verifyUser(request.getParameter("email"), request.getParameter("password"))) {
            u = uDAO.getUser(request.getParameter("email"), request.getParameter("password"));

            if (u.getActive() == 1) {
                HttpSession session = request.getSession();
                session.setAttribute("successful", "success");
                session.setAttribute("userID", u.getUserID());
                session.setAttribute("firstName", u.getFirstName());
                session.setAttribute("middleName", u.getMiddleName());
                session.setAttribute("lastName", u.getLastName());
                session.setAttribute("email", u.getEmail());
                session.setAttribute("specialization", u.getSpecialization());
                session.setAttribute("masteral", u.getMasteral());
                session.setAttribute("doctorate", u.getDoctorate());
                session.setAttribute("registrationDate", u.getRegistrationDate());

                ServletContext context = getServletContext();
                RequestDispatcher dispatcher = context.getRequestDispatcher("/login_selection.jsp");
                dispatcher.forward(request, response);

            } else {
                out.println("<script type=\"text/javascript\">");
                out.println("alert('Account is no longer active!');");
                out.println("location='index.jsp';");
                out.println("</script>");
            }
        } else {
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Account does not exist!');");
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
