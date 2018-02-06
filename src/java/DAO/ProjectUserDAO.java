/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package DAO;

import Database.DBConnectionFactory;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import Model.ProjectUser;
import java.sql.ResultSet;
import java.util.Date;

/**
 *
 * @author RDE
 */
public class ProjectUserDAO {

    public boolean addProjectUser(int pID, ArrayList<ProjectUser> members) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO project_user"
                    + "(projectID,projectMember, userType, startdate)"
                    + "VALUES(?,?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            for (int i = 0; i < members.size(); i++) {
                ps.setInt(1, pID);
                ps.setInt(2, members.get(i).getProjectMember());
                ps.setInt(3, members.get(i).getUserType());
                ps.setDate(4, new java.sql.Date(new Date().getTime()));
                ps.addBatch();
            }

            ps.executeBatch();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectUserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean addProjectUser(int pID, int uID, int ut) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO project_user"
                    + "(projectID,projectMember,userType,startdate)"
                    + "VALUES(?,?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);
            ps.setInt(2, uID);
            ps.setInt(3, ut);
            ps.setDate(4, new java.sql.Date(new Date().getTime()));

            ps.executeBatch();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectUserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean addProjectUser(ProjectUser pu) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.`project_user`"
                    + "(`projectID`,`projectMember`,`userType`,`startdate`)"
                    + "VALUES(?,?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pu.getProjectID());
            ps.setInt(2, pu.getProjectMember());
            ps.setInt(3, pu.getUserType());
            ps.setDate(4, new java.sql.Date(new Date().getTime()));

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectUserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean DeactivateProjectUser(ProjectUser pu) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();
            String query = "UPDATE `sdrcris`.project_user SET `enddate` = ?, `active` = 0 WHERE `projectID` = ? AND `projectMember` = ? AND `userType` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setDate(1, new java.sql.Date(new Date().getTime()));
            ps.setInt(2, pu.getProjectID());
            ps.setInt(3, pu.getProjectMember());
            ps.setInt(4, pu.getUserType());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectUserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean editRole(int pID, int uID, int ut) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.project_user SET `enddate` = ?, `active` = 0 WHERE `projectID` = ? AND `projectMember` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setDate(1, new java.sql.Date(new Date().getTime()));
            ps.setInt(2, pID);
            ps.setInt(3, uID);

            ps.executeUpdate();
            
            String query1 = "INSERT INTO project_user"
                    + "(projectID,projectMember,userType,startdate)"
                    + "VALUES(?,?,?,?);";
            PreparedStatement ps1 = con.prepareStatement(query1);

            ps1.setInt(1, pID);
            ps1.setInt(2, uID);
            ps1.setInt(3, ut);
            ps1.setDate(4, new java.sql.Date(new Date().getTime()));

            ps1.executeBatch();
            
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectUserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public int getProjectUserType(int pID, int uID) {
        int put = 0;

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT userType FROM `sdrcris`.project_user WHERE projectID = ? AND projectMember=?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);
            ps.setInt(2, uID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                put = rs.getInt("userType");
            }

            ps.close();
            con.close();

            return put;
        } catch (SQLException ex) {
            Logger.getLogger(UserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return put;
    }
}
