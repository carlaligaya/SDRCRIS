/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package DAO;

import Database.DBConnectionFactory;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;
import Model.Funding;
import Model.Project;
import Model.ProjectBudget;
import Model.ProjectExpense;
import Model.ProjectFunding;
import Model.ProjectUser;
import Model.User;

/**
 *
 * @author RDE
 */
public class ProjectDAO {

    public boolean RegisterProject(Project u) {
        

        try {
            SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.`project`"
                    + "(`name`, `startdate`, `enddate`, `description`)"
                    + "VALUES(?,?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, u.getName());
            String start = u.getStartdate();
            Date s = sdf.parse(start);
            String end = u.getEnddate();
            Date e = sdf.parse(end);
            ps.setDate(2, new java.sql.Date(s.getTime()));
            ps.setDate(3, new java.sql.Date(e.getTime()));
            ps.setString(4, u.getDescription());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ParseException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public Project getProject(int pID) {
        Project project = new Project();
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.`project` WHERE `projectID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);

            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                project.setProjectID(rs.getInt("projectID"));
                project.setName(rs.getString("name"));
                project.setDescription(rs.getString("description"));
                project.setStartdate(df.format(rs.getDate("startdate")));
                project.setEnddate(df.format(rs.getDate("enddate")));
                project.setActive(rs.getInt("active"));
            }

            ps.close();
            rs.close();
            con.close();

            return project;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return project;
    }

    public ArrayList<User> getProjectMembers(int pID) {
        ArrayList<User> users = new ArrayList<User>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.user u JOIN `sdrcris`.project_user pu ON u.userID=pu.projectMember WHERE projectID = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                User user = new User();

                user.setUserID(rs.getInt("userID"));
                user.setFirstName(rs.getString("firstname"));
                user.setMiddleName(rs.getString("middlename"));
                user.setLastName(rs.getString("lastname"));
                user.setEmail(rs.getString("email"));
                user.setUserType(rs.getInt("usertype"));
                user.setRole(rs.getInt("role"));
                user.setSpecialization(rs.getString("specializations"));
                user.setMasteral(rs.getString("masters"));
                user.setDoctorate(rs.getString("doctorate"));
                user.setRegistrationDate(rs.getString("registrationdate"));

                users.add(user);
            }
            ps.close();
            con.close();
            return users;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return users;
    }

    public ArrayList<String> getEmails(int pID, int uID) {
        ArrayList<String> emails = new ArrayList<String>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.user u JOIN `sdrcris`.project_user pu ON u.userID=pu.projectMember WHERE projectID = ? AND userID <> ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);
            ps.setInt(2, uID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                String email = rs.getString("email");

                emails.add(email);
            }
            ps.close();
            con.close();
            return emails;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return emails;
    }

    public ArrayList<Project> getProjects(int projectMemberID) {
        ArrayList<Project> projects = new ArrayList<Project>();
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.project p JOIN `sdrcris`.project_user pu ON p.projectID=pu.projectID WHERE pu.projectMember=? ORDER BY p.projectID;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, projectMemberID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                Project p = new Project();

                p.setProjectID(rs.getInt("projectID"));
                p.setName(rs.getString("name"));
                p.setDescription("description");
                p.setStartdate(df.format(rs.getDate("startdate")));
                p.setEnddate(df.format(rs.getDate("enddate")));
                p.setActive(rs.getInt("active"));

                projects.add(p);
            }
            ps.close();
            con.close();
            return projects;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return projects;
    }

    public ArrayList<Project> getProjects() {
        ArrayList<Project> projects = new ArrayList<Project>();
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.project ORDER BY projectID;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                Project p = new Project();

                p.setProjectID(rs.getInt("projectID"));
                p.setName(rs.getString("name"));
                p.setDescription(rs.getString("description"));
                p.setStartdate(df.format(rs.getDate("startdate")));
                p.setEnddate(df.format(rs.getDate("enddate")));
                p.setActive(rs.getInt("active"));

                projects.add(p);
            }
            ps.close();
            con.close();
            return projects;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return projects;
    }
    
    public ArrayList<Project> getActiveProjects() {
        ArrayList<Project> projects = new ArrayList<Project>();
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.project WHERE `active` = 1 ORDER BY projectID;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                Project p = new Project();

                p.setProjectID(rs.getInt("projectID"));
                p.setName(rs.getString("name"));
                p.setDescription(rs.getString("description"));
                p.setStartdate(df.format(rs.getDate("startdate")));
                p.setEnddate(df.format(rs.getDate("enddate")));
                p.setActive(rs.getInt("active"));

                projects.add(p);
            }
            ps.close();
            con.close();
            return projects;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return projects;
    }

    public boolean EditProject(Project u) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.project SET `name` = ?, `description` = ? WHERE `projectID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, u.getName());
            ps.setString(2, u.getDescription());
            ps.setInt(3, u.getProjectID());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean DeactivateProject(int pID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.project SET `active` = 0 WHERE `projectID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean addProjectUser(ProjectUser pu) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.`project_user`"
                    + "(`projectID`,`projectMember`,`role`,`startdate`)"
                    + "VALUES(?,?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pu.getProjectID());
            ps.setInt(2, pu.getProjectMember());
            ps.setInt(3, pu.getRole());
            ps.setDate(4, (java.sql.Date) new Date());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean DeactivateProjectUser(ProjectUser pu) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();
            String query = "UPDATE `sdrcris`.project_user SET `enddate` = ? AND `active` = 0 WHERE `projectID` = ? AND `projectMember` = ? AND `role` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setDate(1, (java.sql.Date) new Date());
            ps.setInt(2, pu.getProjectID());
            ps.setInt(3, pu.getProjectMember());
            ps.setInt(4, pu.getRole());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

//    public boolean editRole(int pID, int uID, int role) {
//        try {
//            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
//            Connection con = myFactory.getConnection();
//
//            String query = "UPDATE project_user SET role = ? WHERE projectID = ? AND projectMember = ?;";
//            PreparedStatement ps = con.prepareStatement(query);
//
//            ps.setInt(1, role);
//            ps.setInt(2, pID);
//            ps.setInt(3, uID);
//
//            ps.executeUpdate();
//            ps.close();
//            con.close();
//
//            return true;
//        } catch (SQLException ex) {
//            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
//        }
//        return false;
//    }
    public boolean addFundingOrganization(Funding f) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.funding"
                    + "(`fundingorganization_name`, `description`, `fundingorganization_type`)"
                    + "VALUES(?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, f.getFundingorganization_name());
            ps.setString(2, f.getDescription());
            ps.setInt(3, f.getFundingorganization_type());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public Funding getFunding(int fID) {
        Funding f = new Funding();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.funding WHERE `funding_projectID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, fID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {

                f.setFundingorganizationID(rs.getInt("fundingorganizationID"));
                f.setFundingorganization_name(rs.getString("fundingorganization_name"));
                f.setDescription(rs.getString("description"));
                f.setFundingorganization_type(rs.getInt("fundingorganization_type"));
                f.setActive(rs.getInt("active"));

            }
            ps.close();
            con.close();
            return f;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return f;
    }

    public boolean updateFunding(Funding f) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.funding SET `fundingorganization_name` = ?, `description` = ?, `fundingorganization_type` = ? WHERE fundingorganizationID = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, f.getFundingorganization_name());
            ps.setString(2, f.getDescription());
            ps.setInt(3, f.getFundingorganization_type());
            ps.setInt(4, f.getFundingorganizationID());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean deactivateFunding(int fID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.funding SET `active` = 0, WHERE fundingorganizationID = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, fID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ArrayList<Funding> getFundingOrgs() {
        ArrayList<Funding> funds = new ArrayList<Funding>();

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.funding ORDER BY `fundingorganizationID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                Funding f = new Funding();

                f.setFundingorganizationID(rs.getInt("fundingorganizationID"));
                f.setFundingorganization_name(rs.getString("fundingorganization_name"));
                f.setDescription(rs.getString("description"));
                f.setFundingorganization_type(rs.getInt("fundingorganization_type"));
                f.setActive(rs.getInt("active"));

                funds.add(f);
            }
            ps.close();
            con.close();
            return funds;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return funds;
    }

    public boolean addProjectFunding(ProjectFunding pf) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.project_funding"
                    + "(`projectID`, `fundingID`, `startdate`)"
                    + "VALUES(?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pf.getProjectID());
            ps.setInt(2, pf.getFundingID());
            ps.setDate(3, new java.sql.Date(new Date().getTime()));

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean deactivateProjectFunding(int pID, int pfID) {
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.project_funding SET `enddate` = ?, `active` = 0 WHERE `projectID` = ? AND `fundingID` =?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setDate(1, new java.sql.Date(new Date().getTime()));
            ps.setInt(2, pID);
            ps.setInt(3, pfID);

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ArrayList<ProjectFunding> getProjectFunding(int pID) {
        ArrayList<ProjectFunding> PF = new ArrayList<ProjectFunding>();
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.project_funding WHERE `projectID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                ProjectFunding pf = new ProjectFunding();

                pf.setProjectID(rs.getInt("projectID"));
                pf.setFundingID(rs.getInt("fundingID"));
                pf.setStartdate(df.format(rs.getDate("startdate")));
                pf.setEnddate(df.format(rs.getDate("startdate")));
                pf.setActive(rs.getInt("active"));

                PF.add(pf);
            }
            ps.close();
            con.close();
            return PF;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return PF;
    }

    public boolean addProjectBudget(ProjectBudget pb) {
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.project_budget"
                    + "(`amount`, `date`, `remarks`, `budget_type`, `budget_projectID`, `budget_acquisition`)"
                    + "VALUES(?,?,?,?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setFloat(1, pb.getAmount());
            ps.setDate(2, (java.sql.Date) df.parse(pb.getDate()));
            ps.setString(3, pb.getRemarks());
            ps.setInt(4, pb.getBudget_type());
            ps.setInt(5, pb.getBudget_projectID());
            ps.setInt(6, pb.getBudget_acquisition());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ParseException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean updateProjectBudget(ProjectBudget pb) {
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");
        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.project_budget SET `active` = 0 WHERE `budgetID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pb.getBudgetID());

            ps.executeUpdate();

            String query1 = "INSERT INTO `sdrcris`.project_budget"
                    + "(`amount`, `date`, `remarks`, `budget_type`, `budget_projectID`, `budget_acquisition`)"
                    + "VALUES(?,?,?,?,?,?);";
            PreparedStatement ps1 = con.prepareStatement(query1);

            ps1.setFloat(1, pb.getAmount());
            ps1.setDate(2, (java.sql.Date) df.parse(pb.getDate()));
            ps1.setString(3, pb.getRemarks());
            ps1.setInt(4, pb.getBudget_type());
            ps1.setInt(5, pb.getBudget_projectID());
            ps1.setInt(6, pb.getBudget_acquisition());

            ps1.executeUpdate();
            ps.close();
            ps1.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ParseException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ProjectBudget getProjectBudget(int pbID) {
        ProjectBudget pb = new ProjectBudget();
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.project_budget WHERE `budget_projectID` = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pbID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {

                pb.setBudgetID(rs.getInt("budgetID"));
                pb.setAmount(rs.getFloat("amount"));
                pb.setDate(df.format(rs.getDate("date")));
                pb.setRemarks(rs.getString("remarks"));
                pb.setBudget_type(rs.getInt("budget_type"));
                pb.setBudget_projectID(rs.getInt("budget_projectID"));
                pb.setBudget_acquisition(rs.getInt("budget_acquisition"));
                pb.setActive(rs.getInt("active"));

            }
            ps.close();
            con.close();
            return pb;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return pb;
    }

    public ArrayList<ProjectBudget> getBudget(int pID) {
        ArrayList<ProjectBudget> budget = new ArrayList<ProjectBudget>();
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.project_budget WHERE `budget_projectID` = ? ORDER BY `budgetID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                ProjectBudget pb = new ProjectBudget();

                pb.setBudgetID(rs.getInt("budgetID"));
                pb.setAmount(rs.getFloat("amount"));
                pb.setDate(df.format(rs.getDate("date")));
                pb.setRemarks(rs.getString("remarks"));
                pb.setBudget_type(rs.getInt("budget_type"));
                pb.setBudget_projectID(rs.getInt("budget_projectID"));
                pb.setBudget_acquisition(rs.getInt("budget_acquisition"));
                pb.setActive(rs.getInt("active"));

                budget.add(pb);
            }
            ps.close();
            con.close();
            return budget;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return budget;
    }

    public boolean addProjectExpense(ProjectExpense pe) {
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "INSERT INTO `sdrcris`.project_expenses"
                    + "(`amount`, `remarks`, `date`, `expense_projectID`, `expense_category`, `expense_method`)"
                    + "VALUES(?,?,?,?,?,?);";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setFloat(1, pe.getAmount());
            ps.setString(2, pe.getRemarks());
            ps.setDate(3, (java.sql.Date) df.parse(pe.getDate()));
            ps.setInt(4, pe.getExpense_projectID());
            ps.setInt(5, pe.getExpense_category());
            ps.setInt(6, pe.getExpense_method());

            ps.executeUpdate();
            ps.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ParseException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public boolean updateProjectExpense(ProjectExpense pe) {
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "UPDATE `sdrcris`.project_expenses SET `active` = 0 WHERE expenseID = ?;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pe.getExpenseID());

            ps.executeUpdate();

            String query1 = "INSERT INTO `sdrcris`.project_expenses"
                    + "(`amount`, `remarks`, `date`, `expense_projectID`, `expense_category`, `expense_method`)"
                    + "VALUES(?,?,?,?,?,?);";
            PreparedStatement ps1 = con.prepareStatement(query1);

            ps1.setFloat(1, pe.getAmount());
            ps1.setString(2, pe.getRemarks());
            ps1.setDate(3, (java.sql.Date) df.parse(pe.getDate()));
            ps1.setInt(4, pe.getExpense_projectID());
            ps1.setInt(5, pe.getExpense_category());
            ps1.setInt(6, pe.getExpense_method());

            ps1.executeUpdate();
            ps.close();
            ps1.close();
            con.close();

            return true;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ParseException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }

    public ProjectExpense getProjectExpense(int peID) {
        ProjectExpense pe = new ProjectExpense();

        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.project_expense WHERE `expense_projectID` = ? ORDER BY `expenseID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, peID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {

                pe.setExpenseID(rs.getInt("expenseID"));
                pe.setAmount(rs.getFloat("amount"));
                pe.setRemarks(rs.getString("remarks"));
                pe.setDate(df.format(rs.getDate("date")));
                pe.setExpense_projectID(rs.getInt("expense_projectID"));
                pe.setExpense_category(rs.getInt("expense_category"));
                pe.setExpense_method(rs.getInt("expense_method"));
                pe.setActive(rs.getInt("active"));

            }
            ps.close();
            con.close();
            return pe;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return pe;
    }

    public ArrayList<ProjectExpense> getExpense(int pID) {
        ArrayList<ProjectExpense> expense = new ArrayList<ProjectExpense>();
        DateFormat df = new SimpleDateFormat("yyyy-MM-dd");

        try {
            DBConnectionFactory myFactory = DBConnectionFactory.getInstance();
            Connection con = myFactory.getConnection();

            String query = "SELECT * FROM `sdrcris`.project_expense WHERE `expense_projectID` = ? ORDER BY `expenseID`;";
            PreparedStatement ps = con.prepareStatement(query);

            ps.setInt(1, pID);

            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                ProjectExpense pe = new ProjectExpense();

                pe.setExpenseID(rs.getInt("expenseID"));
                pe.setAmount(rs.getFloat("amount"));
                pe.setRemarks(rs.getString("remarks"));
                pe.setDate(df.format(rs.getDate("date")));
                pe.setExpense_projectID(rs.getInt("expense_projectID"));
                pe.setExpense_category(rs.getInt("expense_category"));
                pe.setExpense_method(rs.getInt("expense_method"));
                pe.setActive(rs.getInt("active"));

                expense.add(pe);
            }
            ps.close();
            con.close();
            return expense;
        } catch (SQLException ex) {
            Logger.getLogger(ProjectDAO.class.getName()).log(Level.SEVERE, null, ex);
        }

        return expense;
    }
}
