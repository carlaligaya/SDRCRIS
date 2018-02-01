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
public class ExpenseCategory {
    private int expensecategoryID;
    private String name;
    private String description;
    private String date;
    private int active;

    public int getExpensecategoryID() {
        return expensecategoryID;
    }

    public void setExpensecategoryID(int expensecategoryID) {
        this.expensecategoryID = expensecategoryID;
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

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public int getActive() {
        return active;
    }

    public void setActive(int active) {
        this.active = active;
    }
    
    
}
