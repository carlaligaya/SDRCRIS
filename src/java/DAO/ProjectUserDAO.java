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
                    + "(projectID,projectMember,role)"
                    + "VALUES(?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            for (int i = 0; i < members.size(); i++) {
                ps.setInt(1, pID);
                ps.setInt(2, members.get(i).getProjectMember());
                ps.setInt(3, members.get(i).getRole());
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

    public boolean addProjectUser(int pID, int uID, int role) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO project_user"
                    + "(projectID,projectMember,role)"
                    + "VALUES(?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);
            ps.setInt(2, uID);
            ps.setInt(3, role);

            ps.executeBatch();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectUserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean editRole(int pID, int uID, int role) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE project_user SET role = ? WHERE projectID = ? AND projectMember = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, role);
            ps.setInt(2, pID);
            ps.setInt(3, uID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectUserDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
}
