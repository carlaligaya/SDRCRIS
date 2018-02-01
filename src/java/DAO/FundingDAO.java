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

    public ArrayList<FundingOrganizationType> getOrganizationTypes() {
        ArrayList<FundingOrganizationType> types = new ArrayList<FundingOrganizationType>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`funding_organization_type` ORDER BY `fundingorganization_typeID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                FundingOrganizationType t = new FundingOrganizationType();

                ps.setInt(1, rs.getInt("fundingorganization_typeID"));
                ps.setString(2, rs.getString("name"));
                ps.setString(3, rs.getString("description"));
                ps.setInt(4, rs.getInt("active"));

                types.add(t);
            }
            ps.close();
            con.close();
            return types;
        } catch (SQLException ex) {
            Logger.getLogger(FundingDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return null;
    }
}
