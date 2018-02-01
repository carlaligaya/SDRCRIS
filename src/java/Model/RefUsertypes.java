/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Model;

/**
 *
 * @author RDE
 */
public class RefUsertypes {
    private int usertypeID;
    private String name;
    private int active;

    /**
     * @return the usertypeID
     */
    public int getUsertypeID() {
        return usertypeID;
    }

    /**
     * @param usertypeID the usertypeID to set
     */
    public void setUsertypeID(int usertypeID) {
        this.usertypeID = usertypeID;
    }

    /**
     * @return the name
     */
    public String getName() {
        return name;
    }

    /**
     * @param name the name to set
     */
    public void setName(String name) {
        this.name = name;
    }

    /**
     * @return the active
     */
    public int getActive() {
        return active;
    }

    /**
     * @param active the active to set
     */
    public void setActive(int active) {
        this.active = active;
    }
    
    
}
