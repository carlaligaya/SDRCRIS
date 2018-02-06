/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Database;

import java.sql.Connection;

/**
 *
 * @author carl_
 */
public abstract class DBConnectionFactory {
    
    String url = "jdbc:mysql://localhost:3306/sdrcris";
    String username = "root";
    String password = "";

    /**
     *
     * @return
     */
    public static DBConnectionFactory getInstance() {
        return new DBConnectionFactoryImpl();
    }

    /**
     *
     * @return
     */
    public abstract Connection getConnection();
    
}
