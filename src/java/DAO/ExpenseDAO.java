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

/**
 *
 * @author carl_
 */
public class ExpenseDAO {

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

                ps.setInt(1, rs.getInt("expensecategoryID"));
                ps.setString(2, rs.getString("name"));
                ps.setString(3, rs.getString("description"));
                ps.setInt(4, rs.getInt("active"));

                cat.add(c);
            }
            ps.close();
            con.close();
            return cat;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return null;
    }

    public ArrayList<MethodOfExpense> getMethod() {
        ArrayList<MethodOfExpense> met = new ArrayList<MethodOfExpense>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`method_of_expense` ORDER BY `expensemethodID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                MethodOfExpense m = new MethodOfExpense();

                ps.setInt(1, rs.getInt("expensemethodID"));
                ps.setString(2, rs.getString("name"));
                ps.setString(3, rs.getString("description"));
                ps.setInt(4, rs.getInt("active"));

                met.add(m);
            }
            ps.close();
            con.close();
            return met;
        } catch (SQLException ex) {
            Logger.getLogger(ExpenseDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return null;
    }
}
