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
public class QuantitativeDataSet {
    private int quantitative_date_setID;
    private int quantitative_data_projectID;
    private String name;
    private String description;
    private int active;
    private String created_on;
    private int created_by; 

    public int getQuantitative_date_setID() {
        return quantitative_date_setID;
    }

    public void setQuantitative_date_setID(int quantitative_date_setID) {
        this.quantitative_date_setID = quantitative_date_setID;
    }

    public int getQuantitative_data_projectID() {
        return quantitative_data_projectID;
    }

    public void setQuantitative_data_projectID(int quantitative_data_projectID) {
        this.quantitative_data_projectID = quantitative_data_projectID;
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

    public String getCreated_on() {
        return created_on;
    }

    public void setCreated_on(String created_on) {
        this.created_on = created_on;
    }

    public int getCreated_by() {
        return created_by;
    }

    public void setCreated_by(int created_by) {
        this.created_by = created_by;
    }
    
    
}
