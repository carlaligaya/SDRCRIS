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
public class ProjectBudget {
    private int budgetID;
    private float amount;
    private String date;
    private String remarks;
    private int budget_type;
    private int budget_projectID;
    private int budget_acquisition;
    private int active;

    public int getBudgetID() {
        return budgetID;
    }

    public void setBudgetID(int budgetID) {
        this.budgetID = budgetID;
    }

    public float getAmount() {
        return amount;
    }

    public void setAmount(float amount) {
        this.amount = amount;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getRemarks() {
        return remarks;
    }

    public void setRemarks(String remarks) {
        this.remarks = remarks;
    }

    public int getBudget_type() {
        return budget_type;
    }

    public void setBudget_type(int budget_type) {
        this.budget_type = budget_type;
    }

    public int getBudget_projectID() {
        return budget_projectID;
    }

    public void setBudget_projectID(int budget_projectID) {
        this.budget_projectID = budget_projectID;
    }

    public int getBudget_acquisition() {
        return budget_acquisition;
    }

    public void setBudget_acquisition(int budget_acquisition) {
        this.budget_acquisition = budget_acquisition;
    }

    public int getActive() {
        return active;
    }

    public void setActive(int active) {
        this.active = active;
    }

   
}
