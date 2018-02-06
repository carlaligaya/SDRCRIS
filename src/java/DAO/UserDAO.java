/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package DAO;

import Database.DBConnectionFactory;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;
import Model.User;
import Model.UserTypes;

/**
 *
 * @author carl_
 */
public class UserDAO {

    public boolean RegisterUser(User u) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.user"
                    + "(`firstname`, `middlename`, `lastname`, `email`, `password`, `specializations`, `masters`, `doctorate`, `registrationdate`)"
                    + "VALUES(?,?,?,?,password(?),?,?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            Date d = new Date();

            ps.setString(1, u.getFirstName());
            ps.setString(2, u.getMiddleName());
            ps.setString(3, u.getLastName());
            ps.setString(4, u.getEmail());
            ps.setString(5, u.getPassword());
            ps.setString(6, u.getSpecialization());
            ps.setString(7, u.getMasteral());
            ps.setString(8, u.getDoctorate());
            ps.setDate(9, new java.sql.Date(d.getTime()));

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean ActivateUser(int uID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.user set `active` = 1 WHERE `userID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, uID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean DeactivateUser(int uID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.user SET `active` = 0 WHERE `userID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, uID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public User getUser(int uID) {
        User user = new User();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.user WHERE `userID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, uID);

            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                user.setUserID(rs.getInt("userID"));
                user.setFirstName(rs.getString("firstname"));
                user.setMiddleName(rs.getString("middlename"));
                user.setLastName(rs.getString("lastname"));
                user.setEmail(rs.getString("email"));
                user.setSpecialization(rs.getString("specializations"));
                user.setMasteral(rs.getString("masters"));
                user.setDoctorate(rs.getString("doctorate"));
                user.setRegistrationDate(rs.getString("registrationdate"));
                user.setAdmin(rs.getInt("admin"));
            }

            ps.close();
            rs.close();
            con.close();

            return user;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return user;
    }

    public User getUser(String email, String password) {
        User user = new User();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.user WHERE `email` = ? AND `password` = password(?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, email);
            ps.setString(2, password);

            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                user.setUserID(rs.getInt("userID"));
                user.setFirstName(rs.getString("firstname"));
                user.setMiddleName(rs.getString("middlename"));
                user.setLastName(rs.getString("lastname"));
                user.setEmail(rs.getString("email"));
                user.setSpecialization(rs.getString("specializations"));
                user.setMasteral(rs.getString("masters"));
                user.setDoctorate(rs.getString("doctorate"));
                user.setRegistrationDate(rs.getString("registrationdate"));
                user.setActive(rs.getInt("active"));
                user.setAdmin(rs.getInt("admin"));
            }

            ps.close();
            rs.close();
            con.close();

            return user;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return user;
    }
    
    public String getEmail(int uID) {
        String email = null;

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT `email` FROM `sdrcris`.user WHERE `userID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, uID);

            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                email = rs.getString("email");
            }

            ps.close();
            rs.close();
            con.close();

            return email;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return email;
    }

    public boolean verifyUser(String email, String password) {
        boolean verify = false;

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`user` WHERE `email` = ? AND `password` = password(?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, email);
            ps.setString(2, password);

            ResultSet rs = ps.executeQuery();
            if (rs.next()) {
                verify = true;
            }
            ps.close();
            con.close();
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return verify;
    }
    
    public boolean check(String email, String mname) {
        boolean verify = false;

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`user` WHERE `email` = ? AND `middlename` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, email);
            ps.setString(2, mname);

            ResultSet rs = ps.executeQuery();
            if (rs.next()) {
                verify = true;
            }
            ps.close();
            con.close();
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return verify;
    }

    public ArrayList<User> activeUsers() {
        ArrayList<User> users = new ArrayList<User>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`user` WHERE `active` = 1;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                User user = new User();

                user.setUserID(rs.getInt("userID"));
                user.setFirstName(rs.getString("firstname"));
                user.setMiddleName(rs.getString("middlename"));
                user.setLastName(rs.getString("lastname"));
                user.setEmail(rs.getString("email"));
                user.setSpecialization(rs.getString("specializations"));
                user.setMasteral(rs.getString("masters"));
                user.setDoctorate(rs.getString("doctorate"));
                user.setRegistrationDate(rs.getString("registrationdate"));

                users.add(user);
            }
            ps.close();
            con.close();
            return users;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return users;
    }

    public ArrayList<User> activeResearchMembers() {
        ArrayList<User> users = new ArrayList<User>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.user WHERE `active` = 1 AND `usertype` = 4;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                User user = new User();

                user.setUserID(rs.getInt("userID"));
                user.setFirstName(rs.getString("firstname"));
                user.setMiddleName(rs.getString("middlename"));
                user.setLastName(rs.getString("lastname"));
                user.setEmail(rs.getString("email"));
                user.setSpecialization(rs.getString("specialization"));
                user.setMasteral(rs.getString("masters"));
                user.setDoctorate(rs.getString("doctorate"));
                user.setRegistrationDate(rs.getString("registrationdate"));

                users.add(user);
            }
            ps.close();
            con.close();
            return users;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return users;
    }

    public ArrayList<User> deactivatedUsers() {
        ArrayList<User> users = new ArrayList<User>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.user WHERE `active` <> 1;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                User user = new User();

                user.setUserID(rs.getInt("userID"));
                user.setFirstName(rs.getString("firstname"));
                user.setMiddleName(rs.getString("middlename"));
                user.setLastName(rs.getString("lastname"));
                user.setEmail(rs.getString("email"));
                user.setSpecialization(rs.getString("specialization"));
                user.setMasteral(rs.getString("masters"));
                user.setDoctorate(rs.getString("doctorate"));
                user.setRegistrationDate(rs.getString("registrationdate"));

                users.add(user);
            }
            ps.close();
            con.close();
            return users;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return users;
    }

    public boolean UpdateUser(User u) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.user SET `firstname`=?, `middlename`=?, `lastname`=?, `email`=?, `password`=password(?), `specializations`=?, `masters`=?, `doctorate`=? WHERE `userID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, u.getFirstName());
            ps.setString(2, u.getMiddleName());
            ps.setString(3, u.getLastName());
            ps.setString(4, u.getEmail());
            ps.setString(5, u.getPassword());
            ps.setString(6, u.getSpecialization());
            ps.setString(7, u.getMasteral());
            ps.setString(8, u.getDoctorate());
            ps.setInt(9, u.getUserID());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean ChangePasswordUser(int uID, String pass) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.user SET `password` = password(?) WHERE `userID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, pass);
            ps.setInt(2, uID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    public boolean addType(UserTypes ut){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.`usertypes`"
                    + "(`name`, `description`)"
                    + "VALUES(?,?);";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setString(1, ut.getName());
            ps.setString(2, ut.getDescription());
            ps.setInt(3, ut.getActive());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    public String getType(int tID){
        String type = "";
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT name FROM `sdrcris`.usertypes WHERE usertypeID=?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setInt(1, tID);
            
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                type = rs.getString("name");
            }
            
            ps.close();
            con.close();

            return type;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return type;
    }
    
    public boolean activateType(int tID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.usertypes SET `active` = 1 WHERE `usertypeID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, tID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean deactivateType(int tID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.usertypes SET `active` = 0 WHERE `usertypeID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, tID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ArrayList<UserTypes> getTypes() {
        ArrayList<UserTypes> types = new ArrayList<UserTypes>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.usertypes ORDER BY `usertypeID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                UserTypes t = new UserTypes();

                t.setUsertype(rs.getInt("usertypeID"));
                t.setName(rs.getString("name"));
                t.setDescription(rs.getString("description"));
                t.setActive(rs.getInt("active"));

                types.add(t);
            }
            ps.close();
            con.close();
            return types;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return types;
    }

    public ArrayList<UserTypes> getActiveTypes() {
        ArrayList<UserTypes> types = new ArrayList<UserTypes>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.usertypes WHERE `active` = 1 ORDER BY `usertypeID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                UserTypes t = new UserTypes();

                t.setUsertype(rs.getInt("usertypeID"));
                t.setName(rs.getString("name"));
                t.setDescription(rs.getString("description"));
                t.setActive(rs.getInt("active"));

                types.add(t);
            }
            ps.close();
            con.close();
            return types;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return types;
    }
    
    public boolean RegisterPrincipalInvestigator (int pID){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.user SET `usertype` = 2 WHERE `userID` = ?;"
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
}
