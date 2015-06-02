import java.io.File;
import java.io.IOException;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;


public class FileReader {



    //public static final String PATH_1 = "\\\\atf.thlab.s3\\artifacts\\MSdialog\\Pat_Activity\\20150212091606_atf.svc@ATF_8648_244";

    public static void main (String args[]) throws IOException, SQLException, ClassNotFoundException {

        String pathToFiles = System.getProperty("path");

        if(pathToFiles != null) {
            List<Jpeg> listOfModelImages = DbConnector.selectFromModelImages();
            List<File> listOfLoadedFiles = getFiles(pathToFiles);
            List<Jpeg> jpegs = convertToJpeg(listOfLoadedFiles);

//        zapobieżenie czytania wielokrotnie tego samego builda

        try {
            DbConnector.buildNumberChecker(jpegs.get(0));
        } catch (SQLException e) {
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }

            //porownanie nazw
            List<Jpeg> insertSet = imageComparison(jpegs, listOfModelImages);

//        DbConnector.insertSqlStatements2(jpegs);
            DbConnector.insertSqlStatements2(insertSet);
        }
        else {
            System.out.print("Please specify path to the files");
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//METODY

    private static List<Jpeg> imageComparison(List<Jpeg> jpegs, List<Jpeg> listOfModelImages) throws IOException {
        List<PairOfPaths> result = getPairOfPaths(jpegs, listOfModelImages);

        Boolean comparisonResult;
        Boolean flague = false;
        String nejm = "";
        String str;

        for(PairOfPaths pairOfPaths : result){

            if(nejm.equals(pairOfPaths.jpeg1.image_name)&& flague){}
            else {
                if(!nejm.equals(pairOfPaths.jpeg1.image_name)) flague = false;

                comparisonResult = Comparator2.compareImages(pairOfPaths.jpeg1.full_path, pairOfPaths.jpeg2.full_path, 0);

                if(comparisonResult) {
                    int index = jpegs.indexOf(pairOfPaths.jpeg1);
                    jpegs.get(index).setStatus("IDENTICAL");
                    nejm = pairOfPaths.jpeg1.image_name.toString();
                    flague = true;
                }else {
                    int index = jpegs.indexOf(pairOfPaths.jpeg1);
                    jpegs.get(index).setStatus("DIFFERENT");
                }
            }
        }
                return jpegs;

    }

    private static List<PairOfPaths> getPairOfPaths(List<Jpeg> listOfFiles1, List<Jpeg> listOfFiles2) {
        List<PairOfPaths> result = new ArrayList<>();
        for(Jpeg file1 : listOfFiles1){
            for(Jpeg file2 : listOfFiles2){
                if(file1.image_name.equals(file2.image_name)){
                    result.add(new PairOfPaths(file1, file2));
                }
            }
        }
        return result;
    }

    public static class PairOfPaths {
        public Jpeg jpeg1;
        public Jpeg jpeg2;
        public PairOfPaths(Jpeg jpeg1, Jpeg jpeg2){
            this.jpeg1 = jpeg1;
            this.jpeg2 = jpeg2;
        }
    }

    public static List<Jpeg> convertToJpeg(List<File> listOfFiles) throws IOException {
        List<Jpeg> helper = new ArrayList<Jpeg>();

        for(File iterator : listOfFiles){
            Jpeg jpeg = new Jpeg(iterator);
            helper.add(jpeg);
        }
        return (helper);
    }


    private static List<File> getFiles(String path) {
        List<File> returned = new ArrayList<>();//Wynik

        File folder = new File(path);
        File[] fList = folder.listFiles();      //Pomocnik do kroczenia po folderach
        for (File file : fList) {
            if (file.isFile() && file.getName().endsWith(".jpg") && !file.getName().contains("tear_down")) {
                returned.add(file);
            } else if (file.isDirectory()) {
                returned.addAll(getFiles(file.getPath()));
            }
        }
        return returned;
    }

}
