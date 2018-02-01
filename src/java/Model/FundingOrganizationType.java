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
public class FundingOrganizationType {
    private int fundingorganization_typeID;
    private String name;
    private String description;
    private int active;

    public int getFundingorganization_typeID() {
        return fundingorganization_typeID;
    }

    public void setFundingorganization_typeID(int fundingorganization_typeID) {
        this.fundingorganization_typeID = fundingorganization_typeID;
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
