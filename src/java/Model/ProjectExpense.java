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
public class ProjectExpense {

    private int expenseID;
    private float amount;
    private String remarks;
    private String date;
    private int expense_projectID;
    private int expense_category;
    private int expense_method;
    private int active;

    public int getExpenseID() {
        return expenseID;
    }

    public void setExpenseID(int expenseID) {
        this.expenseID = expenseID;
    }

    public float getAmount() {
        return amount;
    }

    public void setAmount(float amount) {
        this.amount = amount;
    }

    public String getRemarks() {
        return remarks;
    }

    public void setRemarks(String remarks) {
        this.remarks = remarks;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public int getExpense_projectID() {
        return expense_projectID;
    }

    public void setExpense_projectID(int expense_projectID) {
        this.expense_projectID = expense_projectID;
    }

    public int getExpense_category() {
        return expense_category;
    }

    public void setExpense_category(int expense_category) {
        this.expense_category = expense_category;
    }

    public int getExpense_method() {
        return expense_method;
    }

    public void setExpense_method(int expense_method) {
        this.expense_method = expense_method;
    }
    
    public int getActive() {
        return active;
    }

    public void setActive(int active) {
        this.active = active;
    }

}
