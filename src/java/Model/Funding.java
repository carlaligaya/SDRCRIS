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
public class Funding {
    private int fundingorganizationID;
    private String fundingorganization_name;
    private String description;
    private int fundingorganization_type;
    private int active;

    public int getFundingorganizationID() {
        return fundingorganizationID;
    }

    public void setFundingorganizationID(int fundingorganizationID) {
        this.fundingorganizationID = fundingorganizationID;
    }

    public String getFundingorganization_name() {
        return fundingorganization_name;
    }

    public void setFundingorganization_name(String fundingorganization_name) {
        this.fundingorganization_name = fundingorganization_name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getFundingorganization_type() {
        return fundingorganization_type;
    }

    public void setFundingorganization_type(int fundingorganization_type) {
        this.fundingorganization_type = fundingorganization_type;
    }

    public int getActive() {
        return active;
    }

    public void setActive(int active) {
        this.active = active;
    }
    
    
}
