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
import Model.BudgetRegistrationType;
import Model.MethodOfBudgetRegistration;

/**
 *
 * @author carl_
 */
public class BudgetDAO {

    public boolean addBudgetType(BudgetRegistrationType bt) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.budget_registration_type"
                    + "(`name`, `description`)"
                    + "VALUES(?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, bt.getName());
            ps.setString(2, bt.getDescription());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public BudgetRegistrationType getBudgetType(int btID) {
        BudgetRegistrationType bt = new BudgetRegistrationType();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT `name` FROM `sdrcris`.`budget_registration_type` WHERE `budgetregistration_typeID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, btID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                bt.setBudgetregistration_typeID(rs.getInt("budgetregistration_typeID"));
                bt.setName(rs.getString("name"));
                bt.setDescription(rs.getString("description"));
                bt.setActive(rs.getInt("active"));
            }
            ps.close();
            con.close();
            return bt;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return bt;
    }
    
    public boolean updateBudgetType(BudgetRegistrationType bt){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`budget_registration_type` SET `name` = ?, `description` = ?  WHERE `budgetregistration_typeID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setString(1, bt.getName());
            ps.setString(2, bt.getDescription());
            ps.setInt(3, bt.getBudgetregistration_typeID());
            
            ps.executeUpdate();
            ps.close();
            con.close();
            
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    public boolean DeactivateBudgetType(int btID){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`budget_registration_type` SET `active` = 0 WHERE `budgetregistration_typeID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, btID);
            
            ps.executeUpdate();
            ps.close();
            con.close();
            
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ArrayList<BudgetRegistrationType> getBudgetTypes() {
        ArrayList<BudgetRegistrationType> types = new ArrayList<BudgetRegistrationType>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`budget_registration_type` ORDER BY `budgetregistration_typeID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                BudgetRegistrationType t = new BudgetRegistrationType();

                t.setBudgetregistration_typeID(rs.getInt("budgetregistration_typeID"));
                t.setName(rs.getString("name"));
                t.setDescription(rs.getString("description"));
                t.setActive(rs.getInt("active"));

                types.add(t);
            }
            ps.close();
            con.close();
            return types;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return types;
    }
    
        public ArrayList<BudgetRegistrationType> getActiveBudgetTypes() {
        ArrayList<BudgetRegistrationType> types = new ArrayList<BudgetRegistrationType>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`budget_registration_type` WHERE `active` = 1 ORDER BY `budgetregistration_typeID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                BudgetRegistrationType t = new BudgetRegistrationType();

                t.setBudgetregistration_typeID(rs.getInt("budgetregistration_typeID"));
                t.setName(rs.getString("name"));
                t.setDescription(rs.getString("description"));
                t.setActive(rs.getInt("active"));

                types.add(t);
            }
            ps.close();
            con.close();
            return types;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return types;
    }

    public boolean addBudgetMethod(MethodOfBudgetRegistration bm) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.method_of_budget_registration"
                    + "(`name`, `description`)"
                    + "VALUES(?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, bm.getName());
            ps.setString(2, bm.getDescription());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public MethodOfBudgetRegistration getBudgetMethod(int bmID) {
        MethodOfBudgetRegistration bm = new MethodOfBudgetRegistration();
        
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT `name` FROM `sdrcris`.`method_of_budget_registration` WHERE `registration_methodID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, bmID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                bm.setRegistration_methodID(rs.getInt("registration_methodID"));
                bm.setName(rs.getString("name"));
                bm.setDescription(rs.getString("description"));
                bm.setActive(rs.getInt("active"));
            }
            ps.close();
            con.close();
            return bm;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return bm;
    }
    
    public boolean updateBudgetMethod(MethodOfBudgetRegistration bm){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`method_of_budget_registration` SET `name` = ?, `description` = ?  WHERE `registration_methodID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setString(1, bm.getName());
            ps.setString(2, bm.getDescription());
            ps.setInt(3, bm.getRegistration_methodID());
            
            ps.executeUpdate();
            ps.close();
            con.close();
            
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    public boolean DeactivateBudgetMethod(int bmID){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`method_of_budget_registration` SET `active` = 0 WHERE `registration_methodID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, bmID);
            
            ps.executeUpdate();
            ps.close();
            con.close();
            
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ArrayList<MethodOfBudgetRegistration> getBudgetMethods() {
        ArrayList<MethodOfBudgetRegistration> methods = new ArrayList<MethodOfBudgetRegistration>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`method_of_budget_registration` ORDER BY `registration_methodID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                MethodOfBudgetRegistration m = new MethodOfBudgetRegistration();

                m.setRegistration_methodID(rs.getInt("registration_methodID"));
                m.setName(rs.getString("name"));
                m.setDescription(rs.getString("description"));
                m.setActive(rs.getInt("active"));

                methods.add(m);
            }
            ps.close();
            con.close();
            return methods;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return methods;
    }
    
    public ArrayList<MethodOfBudgetRegistration> getActiveBudgetMethods() {
        ArrayList<MethodOfBudgetRegistration> methods = new ArrayList<MethodOfBudgetRegistration>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`method_of_budget_registration` WHERE `active` = 1 ORDER BY `registration_methodID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                MethodOfBudgetRegistration m = new MethodOfBudgetRegistration();

                m.setRegistration_methodID(rs.getInt("registration_methodID"));
                m.setName(rs.getString("name"));
                m.setDescription(rs.getString("description"));
                m.setActive(rs.getInt("active"));

                methods.add(m);
            }
            ps.close();
            con.close();
            return methods;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return methods;
    }
}
