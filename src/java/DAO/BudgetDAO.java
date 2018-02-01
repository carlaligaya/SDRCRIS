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

                ps.setInt(1, rs.getInt("budgetregistration_typeID"));
                ps.setString(2, rs.getString("name"));
                ps.setString(3, rs.getString("description"));
                ps.setInt(4, rs.getInt("active"));

                types.add(t);
            }
            ps.close();
            con.close();
            return types;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return null;
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

                ps.setInt(1, rs.getInt("registration_methodID"));
                ps.setString(2, rs.getString("name"));
                ps.setString(3, rs.getString("description"));
                ps.setInt(4, rs.getInt("active"));

                methods.add(m);
            }
            ps.close();
            con.close();
            return methods;
        } catch (SQLException ex) {
            Logger.getLogger(BudgetDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return null;
    }
}
