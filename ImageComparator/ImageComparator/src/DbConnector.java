import java.sql.*;
import java.util.ArrayList;
import java.util.List;

import static java.sql.Types.NULL;

/**
 * Created by marcinja on 03/12/2014.
 */
public class DbConnector {
    private final static String DB_URL = "jdbc:mysql://msdidev9.thlab.s3:3306/mydb";
    private final static String USER = "root";
    private final static String PASS = "root";

    public static void main (String args[]){
        selectFromModelImages();
    }

    public static void buildNumberChecker(Jpeg jpeg) throws SQLException, ClassNotFoundException {
        Connection conn = null;
        PreparedStatement preparedStatement;
        Statement stmt;
        try {
            Class.forName("com.mysql.jdbc.Driver");
            System.out.println("Connecting to database...");
            conn = DriverManager.getConnection(DB_URL,USER,PASS);
            System.out.println("Connection established");

            stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery("SELECT r.run_number FROM run r");
            while (rs.next()){
                System.out.println(rs.getString("run_number"));
                if (jpeg.run_ID_Run.equals(rs.getString("run_number"))){
                    System.exit(1);
                }
            }

            String insertTableSQL = "INSERT INTO run VALUES (?,?)";

            preparedStatement = conn.prepareStatement(insertTableSQL);
            preparedStatement.setNull(1, NULL);
            preparedStatement.setString(2, jpeg.run_ID_Run);
            preparedStatement.execute();

        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (conn != null) {
                try {
                    conn.close();
                } catch (SQLException e) {
                    // ignore
                }
            }
        }
    }

    public static List<Jpeg> selectFromModelImages(){
        List<Jpeg> jpegs = new ArrayList<>();
        Connection conn = null;
        Statement stmt;
        try {
            Class.forName("com.mysql.jdbc.Driver");
            System.out.println("Connecting to database...");
            conn = DriverManager.getConnection(DB_URL,USER,PASS);
            System.out.println("Connection established");

            stmt = conn.createStatement();
//            ResultSet rs = stmt.executeQuery("SELECT image_name, full_path FROM model_images");
            ResultSet rs = stmt.executeQuery("SELECT m.image_name, m.class_name, m.test_name, m.user_login, " +
                    "br.browser_shortcut, m.timestamp, m.status, m.full_path, m.build_id, e.env_shortcut, r.run_number " +
                    "FROM run r JOIN model_images m ON r.id_run = m.run_id_run \n" +
                    "JOIN environment e ON m.environment_id_environment = e.id_environment\n" +
                    "JOIN browser br ON m.browser_id = br.id_browser");
            while (rs.next()){

                System.out.println(rs.getString("image_name"));
                System.out.println(rs.getString("class_name"));
                System.out.println(rs.getString("test_name"));
                System.out.println(rs.getString("user_login"));
                System.out.println(rs.getString("browser_shortcut"));
                System.out.println(rs.getString("timestamp"));
                System.out.println(rs.getString("status"));
                System.out.println(rs.getString("full_path"));
                System.out.println(rs.getString("build_id"));
                System.out.println(rs.getString("env_shortcut"));
                System.out.println(rs.getString("run_number"));

                Jpeg helper = new Jpeg();
                helper.setImage_name(rs.getString("image_name"));
                helper.setClass_name(rs.getString("class_name"));
                helper.setTest_name(rs.getString("test_name"));
                helper.setUser_login(rs.getString("user_login"));
                helper.setBrowser_shortcut(rs.getString("browser_shortcut"));
                helper.setTimestamp(rs.getString("timestamp"));
                helper.setStatus(rs.getString("status"));
                helper.setFull_path(rs.getString("full_path"));
                helper.setBuild_ID(rs.getString("build_id"));
                helper.setEnv_ID_Env(rs.getString("env_shortcut"));
                helper.setRun_ID_Run(rs.getString("run_number"));

//                FileReader.ImageAndPath helper = new FileReader.ImageAndPath(rs.getString("image_name"), rs.getString("full_path"));
                jpegs.add(helper);
            }


        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (conn != null) {
                try {
                    conn.close();
                } catch (SQLException e) {
                    // ignore
                }
            }
        }

        return jpegs;
    }

    public static void insertSqlStatements2(List<Jpeg> Jpegs) {
        Connection conn = null;
        PreparedStatement preparedStatement;
        Statement stmt;
        try {
            Class.forName("com.mysql.jdbc.Driver");
            System.out.println("Connecting to database...");
            conn = DriverManager.getConnection(DB_URL,USER,PASS);
            System.out.println("Connection established");
//            conn.prepareStatement()

            for (Jpeg jpeg : Jpegs){
                if(jpeg.status.equals("IDENTICAL")){
                    stmt = conn.createStatement();
                    ResultSet rs = stmt.executeQuery("SELECT status FROM model_images WHERE image_name = '" + jpeg.image_name + "'");
                    rs.first();
                    String res = rs.getNString("STATUS");
//                    System.out.println(rs.getString("status"));
                    jpeg.setStatus(rs.getString("status"));
                }

                String insertTableSQL = "INSERT INTO loaded_images VALUES" +
                        "(?,?,?,?,?,\n" +
                        "(SELECT id_browser FROM browser WHERE browser_shortcut = ?),\n" +
                        "STR_TO_DATE(?,'%Y-%m-%d %H-%i-%S'),\n" +
                        "?,?,?,\n" +
                        "(SELECT id_environment FROM environment WHERE env_shortcut = ?),\n" +
                        "(SELECT id_run FROM run WHERE run_number = ?))";

                preparedStatement = conn.prepareStatement(insertTableSQL);
                preparedStatement.setNull(1, NULL);
                preparedStatement.setString(2, jpeg.image_name);
                preparedStatement.setString(3, jpeg.class_name);
                preparedStatement.setString(4, jpeg.test_name);
                preparedStatement.setString(5, jpeg.user_login);
                preparedStatement.setString(6, jpeg.browser_shortcut);
                preparedStatement.setString(7, jpeg.timestamp);
                preparedStatement.setString(8, jpeg.status);
                preparedStatement.setString(9, jpeg.full_path);
                preparedStatement.setString(10, jpeg.build_ID);
                preparedStatement.setString(11, jpeg.env_ID_Env);
                preparedStatement.setString(12, jpeg.run_ID_Run);

                preparedStatement.execute();
            }

        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (conn != null) {
                try {
                    conn.close();
                } catch (SQLException e) {
                    // ignore
                }
            }
        }
    }

}
