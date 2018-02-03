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
import java.util.logging.Level;
import java.util.logging.Logger;
import Model.ProjectRole;

/**
 *
 * @author Carl
 */
public class RolesDAO {

    public boolean addRole(ProjectRole r) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.`projectrole`"
                    + "(`role`, `description`)"
                    + "VALUES(?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, r.getRole());
            ps.setString(2, r.getDescription());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(RolesDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

     public boolean ActivateRole(int rID){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`projectrole` SET `active` = 1 WHERE `roleID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setInt(1, rID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(RolesDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    public boolean DeactivateRole(int rID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`projectrole` SET `active` = 0 WHERE `roleID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, rID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(RolesDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ArrayList<ProjectRole> getRoles() {
        ArrayList<ProjectRole> roles = new ArrayList<ProjectRole>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`projectrole` ORDER BY `roleID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                ProjectRole r = new ProjectRole();

                ps.setInt(1, rs.getInt("roleID"));
                ps.setString(2, rs.getString("role"));
                ps.setString(3, rs.getString("description"));
                ps.setInt(4, rs.getInt("active"));

                roles.add(r);
            }
            ps.close();
            con.close();
            return roles;
        } catch (SQLException ex) {
            Logger.getLogger(RolesDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return roles;
    }
    
    public ArrayList<ProjectRole> getActiveRoles() {
        ArrayList<ProjectRole> roles = new ArrayList<ProjectRole>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`projectrole` WHERE `active` = 1 ORDER BY `roleID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                ProjectRole r = new ProjectRole();

                r.setRoleID(rs.getInt("roleID"));
                r.setRole(rs.getString("role"));
                r.setDescription(rs.getString("description"));
                r.setAcive(rs.getInt("active"));

                roles.add(r);
            }
            ps.close();
            con.close();
            return roles;
        } catch (SQLException ex) {
            Logger.getLogger(RolesDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return roles;
    }
}
