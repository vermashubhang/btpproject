import java.io.*;
import java.util.*;
import java.sql.*;

public class Main {
	
	public static Connection dbconn;
    public static Statement statement;
	
	public static void main(String[] args) {
		try
        {
           Class.forName("org.sqlite.JDBC");
           dbconn = DriverManager.getConnection("jdbc:sqlite:/media/shubhang/Drive1/BTP Project/src/db.db"); 
           System.out.println("Connected"); 
           statement = dbconn.createStatement(); 
           statement.setQueryTimeout(30);
           
           statement.executeUpdate("DROP TABLE IF EXISTS roads");
           String sql1 = "CREATE TABLE roads " +
                   "(Road_Name TEXT PRIMARY KEY     NOT NULL," +
                   " Start_Latitude           REAL   , " + 
                   " Start_Longitude            REAL    , " + 
                   " End_Latitude        REAL, " + 
                   " End_Longitude         REAL)"; 
           statement.executeUpdate(sql1);

           
           FileInputStream fstream = new FileInputStream("/media/shubhang/Drive1/BTP Project/Roads_Map.txt");
           BufferedReader br = new BufferedReader(new InputStreamReader(fstream));

           String strLine = null;
           String roadname = null;
           String startpoint = null;
           String endpoint = null;
           //Read File Line By Line
           int i=0;
           while ((strLine = br.readLine()) != null)   {
             // Print the content on the console
             if(i%4==0)
             {
            	 roadname = strLine;
             }
        	 //System.out.println (strLine);
             else if(i%4==1)
             {
            	 startpoint = strLine;
             }
             else if(i%4==2)
             {
            	 endpoint = strLine;
             }
             else
             {
            	 roadname = roadname.trim();
            	 
            	 startpoint = startpoint.trim();
            	 startpoint = startpoint.replaceAll("\\s++","");
            	 endpoint = endpoint.trim();
            	 endpoint = endpoint.replaceAll("\\s++","");
            	 
            	 
            	 String[] arr = startpoint.split(",");
            	 String[] arr1 = endpoint.split(",");
            	 
            	 Float f1,f2,f11,f22;
            	 //f1 = Float.parseFloat(arr[0]);
            	 //f2 = Float.parseFloat(arr[1]);
            	 //f11 = Float.parseFloat(arr1[0]);
            	 //f22 = Float.parseFloat(arr1[1]);
            	 
            	 String sql = "INSERT INTO roads (Road_Name,Start_Latitude,Start_Longitude,End_Latitude,End_Longitude) " +
                         "VALUES ('"+roadname+"',"+arr[0]+","+arr[1]+","+arr1[0]+","+arr1[1]+")";
            	 statement.executeUpdate(sql);
             }
             i++;
           }

           //Close the input stream
           br.close();

           
           /*
           Queue<ResultSet> queue = new LinkedList<ResultSet>(); 
           ResultSet rs = statement.executeQuery("select * from places");
          //try{ 
           while(rs.next()) { 
                 queue.add(rs); 
                 System.out.println(queue.peek().getString("Latitude")); 
           }*/ 
        } catch(Exception e)
        {
            System.out.println("Error : " + e);
        }
	}

}
