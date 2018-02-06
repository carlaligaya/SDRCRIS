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
import Model.FundingOrganizationType;

/**
 *
 * @author carl_
 */
public class FundingDAO {
    public boolean addFundingType(FundingOrganizationType fot){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

           String query = "INSERT INTO `sdrcris`.`funding_organization_type`"
                    + "(`name`, `description`)"
                    + "VALUES(?,?);";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setString(1, fot.getName());
            ps.setString(2, fot.getDescription());
            
            ps.executeUpdate();
            ps.close();
            con.close();
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(FundingDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    public boolean updateFundingType(FundingOrganizationType fot){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

           String query = "UPDATE `sdrcris`.`funding_organization_type` SET `name` = ?, `description` = ? WHERE fundingorganization_typeID = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setString(1, fot.getName());
            ps.setString(2, fot.getDescription());
            ps.setInt(3, fot.getFundingorganization_typeID());
            
            ps.executeUpdate();
            ps.close();
            con.close();
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(FundingDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    public boolean deactivateFundingType(int ftID){
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

           String query = "UPDATE `sdrcris`.`funding_organization_type` SET `active` = 0 WHERE fundingorganization_typeID = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setInt(1, ftID);
            
            ps.executeUpdate();
            ps.close();
            con.close();
            return true;
        } catch (SQLException ex) {
            Logger.getLogger(FundingDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    public ArrayList<FundingOrganizationType> getActiveOrganizationTypes() {
        ArrayList<FundingOrganizationType> types = new ArrayList<FundingOrganizationType>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`funding_organization_type` WHERE `active` = 1 ORDER BY `fundingorganization_typeID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                FundingOrganizationType t = new FundingOrganizationType();

                t.setFundingorganization_typeID(rs.getInt("fundingorganization_typeID"));
                t.setName(rs.getString("name"));
                t.setDescription(rs.getString("description"));
                t.setActive( rs.getInt("active"));

                types.add(t);
            }
            ps.close();
            con.close();
            return types;
        } catch (SQLException ex) {
            Logger.getLogger(FundingDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return types;
    }
    
    public String getType(int tID){
        String type = "";
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT name FROM `sdrcris`.`funding_organization_type` WHERE `fundingorganization_typeID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setInt(1, tID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                type = rs.getString("name");
            }
            ps.close();
            con.close();
            return type;
        } catch (SQLException ex) {
            Logger.getLogger(FundingDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return type;
    }
    
    public FundingOrganizationType getFundingType(int foID){
        FundingOrganizationType fo = new FundingOrganizationType();
        
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`funding_organization_type` WHERE `fundingorganization_typeID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);
            
            ps.setInt(1, foID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                fo.setFundingorganization_typeID(rs.getInt("fundingorganization_typeID"));
                fo.setName(rs.getString("name"));
                fo.setDescription(rs.getString("description"));
                fo.setActive(rs.getInt("active"));
            }
            ps.close();
            con.close();
            return fo;
        } catch (SQLException ex) {
            Logger.getLogger(FundingDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return fo;
    }
}
