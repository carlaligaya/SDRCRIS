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
import Model.ExpenseCategory;
import Model.MethodOfExpense;
import java.text.ParseException;

/**
 *
 * @author carl_
 */
public class ExpenseDAO {

    public boolean addExpenseCategory(ExpenseCategory ec) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.expense_category"
                    + "(`name`, `description`)"
                    + "VALUES(?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, ec.getName());
            ps.setString(2, ec.getDescription());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ExpenseCategory getExpenseCategory(int ecID) {
        ExpenseCategory ec = new ExpenseCategory();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT `name` FROM `sdrcris`.`expense_category` WHERE `expensecategoryID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, ecID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                ec.setExpensecategoryID(rs.getInt("expensecategoryID"));
                ec.setName(rs.getString("name"));
                ec.setDescription(rs.getString("description"));
                ec.setActive(rs.getInt("active"));
            }
            ps.close();
            con.close();
            return ec;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return ec;
    }
    
    public boolean updateExpenseCategory(ExpenseCategory ec){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`expense_category` SET `name` = ?, `description` = ?  WHERE `expensecategoryID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setString(1, ec.getName());
            ps.setString(2, ec.getDescription());
            ps.setInt(3, ec.getExpensecategoryID());
            
            ps.executeUpdate();
            ps.close();
            con.close();
            
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean DeactivateExpenseCategory(int ecID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`expense_category` SET `active` = 0 WHERE `expensecategoryID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, ecID);
            
            ps.executeUpdate();
            ps.close();
            con.close();
            
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ArrayList<ExpenseCategory> getCategories() {
        ArrayList<ExpenseCategory> cat = new ArrayList<ExpenseCategory>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`expense_category` ORDER BY `expensecategoryID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                ExpenseCategory c = new ExpenseCategory();

                c.setExpensecategoryID(rs.getInt("expensecategoryID"));
                c.setName(rs.getString("name"));
                c.setDescription(rs.getString("description"));
                c.setActive(rs.getInt("active"));

                cat.add(c);
            }
            ps.close();
            con.close();
            return cat;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return cat;
    }
    
    public ArrayList<ExpenseCategory> getActiveCategories() {
        ArrayList<ExpenseCategory> cat = new ArrayList<ExpenseCategory>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`expense_category` WHERE `active` = 1 ORDER BY `expensecategoryID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                ExpenseCategory c = new ExpenseCategory();

                c.setExpensecategoryID(rs.getInt("expensecategoryID"));
                c.setName(rs.getString("name"));
                c.setDescription(rs.getString("description"));
                c.setActive(rs.getInt("active"));

                cat.add(c);
            }
            ps.close();
            con.close();
            return cat;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return cat;
    }

    public boolean addExpenseMethod(MethodOfExpense me) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.method_of_expense"
                    + "(`name`, `description`)"
                    + "VALUES(?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, me.getName());
            ps.setString(2, me.getDescription());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public MethodOfExpense getExpenseMethod(int meID) {
       MethodOfExpense em = new MethodOfExpense();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT `name` FROM `sdrcris`.`method_of_expense` WHERE `expensemethodID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, meID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                em.setName(rs.getString("name"));
                em.setDescription(rs.getString("description"));
                em.setActive(rs.getInt("active"));
            }
            ps.close();
            con.close();
            return em;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return em;
    }
    
    public boolean updateExpenseMethod(MethodOfExpense me){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`method_of_expense` SET `name` = ?, `description` = ?  WHERE `expensemethodID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setString(1, me.getName());
            ps.setString(2, me.getDescription());
            ps.setInt(3, me.getExpensemethodID());
            
            ps.executeUpdate();
            ps.close();
            con.close();
            
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean DeactivateExpenseMethod(int meID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.`method_of_expense` SET `active` = 0 WHERE `expensemethodID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, meID);
            
            ps.executeUpdate();
            ps.close();
            con.close();
            
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ArrayList<MethodOfExpense> getMethods() {
        ArrayList<MethodOfExpense> met = new ArrayList<MethodOfExpense>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`method_of_expense` ORDER BY `expensemethodID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                MethodOfExpense m = new MethodOfExpense();

                m.setExpensemethodID(rs.getInt("expensemethodID"));
                m.setName(rs.getString("name"));
                m.setDescription(rs.getString("description"));
                m.setActive(rs.getInt("active"));

                met.add(m);
            }
            ps.close();
            con.close();
            return met;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return met;
    }
    
    public ArrayList<MethodOfExpense> getActiveMethods() {
        ArrayList<MethodOfExpense> met = new ArrayList<MethodOfExpense>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`method_of_expense` WHERE `active` = 1 ORDER BY `expensemethodID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                MethodOfExpense m = new MethodOfExpense();

                m.setExpensemethodID(rs.getInt("expensemethodID"));
                m.setName(rs.getString("name"));
                m.setDescription(rs.getString("description"));
                m.setActive(rs.getInt("active"));

                met.add(m);
            }
            ps.close();
            con.close();
            return met;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return met;
    }
}
