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
public class QualitativeDataSet {
    private int qualitative_data_setID;
    private int qualitative_projectID;
    private String name;
    private String description;
    private int active;
    private String createdon;
    private int createdby;
    private int qualitative_sourceID;

    public int getQualitative_data_setID() {
        return qualitative_data_setID;
    }

    public void setQualitative_data_setID(int qualitative_data_setID) {
        this.qualitative_data_setID = qualitative_data_setID;
    }

    public int getQualitative_projectID() {
        return qualitative_projectID;
    }

    public void setQualitative_projectID(int qualitative_projectID) {
        this.qualitative_projectID = qualitative_projectID;
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

    public String getCreatedon() {
        return createdon;
    }

    public void setCreatedon(String createdon) {
        this.createdon = createdon;
    }

    public int getCreatedby() {
        return createdby;
    }

    public void setCreatedby(int createdby) {
        this.createdby = createdby;
    }

    public int getQualitative_sourceID() {
        return qualitative_sourceID;
    }

    public void setQualitative_sourceID(int qualitative_sourceID) {
        this.qualitative_sourceID = qualitative_sourceID;
    }
}
