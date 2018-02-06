<%@ page import = "java.io.*,java.util.*,javax.mail.*"%>
<%@ page import = "javax.mail.internet.*,javax.activation.*"%>
<%@ page import = "javax.servlet.http.*,javax.servlet.*" %>

<%
    
   String result;
   
   // Recipient's email ID needs to be mentioned.
   String to = "reuelespiritu@gmail.com";

   // Sender's email ID needs to be mentioned
   String from = "reuelespiritu@outlook.com";

   // Assuming you are sending email from localhost
   String host = "localhost";

   // Get system properties object
   Properties properties = System.getProperties();

   // Setup mail server


   properties.setProperty("mail.smtp.host", "smtp-mail.outlook.com");
   properties.setProperty("mail.user", "reuelespiritu@outlook.com");
   properties.put("mail.password", "RDE8214764");
   properties.put("mail.smtp.port", "587");
     properties.put("mail.transport.protocol", "smtp" );
                   properties.put("mail.smtp.auth", "true" );

   
   // Get the default Session object.
   Session mailSession = Session.getDefaultInstance(properties);

   try {
      // Create a default MimeMessage object.
      MimeMessage message = new MimeMessage(mailSession);
      
      // Set From: header field of the header.
      message.setFrom(new InternetAddress(from));
      
      // Set To: header field of the header.
      message.addRecipient(Message.RecipientType.TO,
                               new InternetAddress(to));
      // Set Subject: header field
      message.setSubject("This is the Subject Line!");
      
      // Now set the actual message
      message.setText("This is actual message");
      
      // Send message
      Transport.send(message);
      result = "Sent message successfully....";
   } catch (MessagingException mex) {
      mex.printStackTrace();
      result = "Error: unable to send message....";
   }
%>

<html>
   <head>
      <title>Send Email using JSP</title>
   </head>
   
   <body>
      <center>
         <h1>Send Email using JSP</h1>
      </center>
      
      <p align = "center">
         <% 
            out.println("Result: " + result + "\n");
         %>
      </p>
   </body>
</html>