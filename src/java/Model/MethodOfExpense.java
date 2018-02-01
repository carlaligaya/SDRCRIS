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
public class MethodOfExpense {
   
    private int expensemethodID;
    private String name;
    private String description;
    private int active;

    public int getExpensemethodID() {
        return expensemethodID;
    }

    public void setExpensemethodID(int expensemethodID) {
        this.expensemethodID = expensemethodID;
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
