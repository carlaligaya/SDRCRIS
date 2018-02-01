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
public class MethodOfBudgetRegistration {
    private int registration_methodID;
    private String name;
    private String description;
    private int active;

    public int getRegistration_methodID() {
        return registration_methodID;
    }

    public void setRegistration_methodID(int registration_methodID) {
        this.registration_methodID = registration_methodID;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getActive() {
        return active;
    }

    public void setActive(int active) {
        this.active = active;
    }
    
    
}
