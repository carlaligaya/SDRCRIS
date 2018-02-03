<%
    String login = (String) session.getAttribute("successful");
    if (login == null || !login.equals("success")) {
        out.println("<script type=\"text/javascript\">");
        out.println("alert('Please login to be able to access the Social Development Research Center Research Information System!');");
        out.println("location='index.jsp';");
        out.println("</script>");
        return;
    }


%>