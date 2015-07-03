package marcinJachymek;

import org.apache.commons.io.FileUtils;
import org.junit.Test;
import org.openqa.selenium.*;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.Select;

import java.io.File;
import java.util.List;

import static org.junit.Assert.*;

/**
 * Created by marcinja on 30-Jun-15.
 */
public class Lesson2examples {

    @Test
    public void testCheckBox() {
        WebDriver driver = new FirefoxDriver();
        driver.get("http://www.kurshtml.edu.pl/html/pole_wyboru,formularze.html");
        this.waitForAwhile();

        //Get the Checkbox as WebElement using it's value attribute
        WebElement answer = driver.findElement(By.xpath("//input[@value='Odpowiedź nr1']"));

        //Check if its already selected? otherwise select the Checkbox
        //by calling click() method
        if (!answer.isSelected()) answer.click();

        //Verify Checkbox is Selected
        assertTrue(answer.isSelected());

        //Check Checkbox if selected? If yes, deselect it
        //by calling click() method
        if (answer.isSelected())  answer.click();

        //Verify Checkbox is Deselected
        assertFalse(answer.isSelected());
    }

    @Test
    public void testRadioButton() {
        WebDriver driver = new FirefoxDriver();
        String htmlPath = this.createPathToHtml("radiobuttons.html");
        System.out.println(String.format("Will open browser at '%s'", htmlPath));
        driver.get(htmlPath);

        WebElement gender = driver.findElement(By.cssSelector("input[value=male]"));

        //Check if its already selected? otherwise select the Radiobutton
        //by calling click() method
        if (!gender.isSelected())
            gender.click();

        //Verify Radiobutton is selected
        assertTrue(gender.isSelected());
    }

    @Test
    public void testDropdown() {
        WebDriver driver = new FirefoxDriver();
        driver.get("https://msdi-ver.thlab.s3/rscon-frontend/#!/login");

        //Get the Dropdown as a Select using its name attribute
        Select country = new Select(driver.findElement(By.id("countryListSelect")));

        //Verify Dropdown has four options for selection
        assertEquals(44, country.getOptions().size());

        //With Select class we can select an option in Dropdown using
        //Visible Text
        country.selectByVisibleText("Belgien (Deutsch)");
        assertEquals("Belgien (Deutsch)", country.getFirstSelectedOption().getText());

        country.deselectByVisibleText("Belgien (Deutsch)"); //deselect

        //or we can select an option in Dropdown using value attribute
        country.selectByValue("4");
        assertEquals("Canada (English)", country.getFirstSelectedOption().getText());

        //or we can select an option in Dropdown using index
        country.selectByIndex(0);
        assertEquals("Australia (English)", country.getFirstSelectedOption().getText());
    }

    @Test
    public void testTakesScreenshot() {
        WebDriver driver = new FirefoxDriver();
        driver.get("https://msdi-ver.thlab.s3/rscon-frontend/#!/login");
        try {
            File scrFile = ((TakesScreenshot)driver).getScreenshotAs(OutputType.FILE);

            FileUtils.copyFile(scrFile, new File("c:\\temp\\main_page.png"));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Test
    public void testDoubleClick() throws Exception {

        WebDriver driver = new FirefoxDriver();
        driver.get("https://msdi-ver.thlab.s3/rscon-frontend/#!/login");

        WebElement message = driver.findElement(By.cssSelector("button[type=submit]"));

        Actions builder = new Actions(driver);
        builder.doubleClick(message).build().perform();

        driver.close();
    }

    @Test
    public void testElementAttribute() {
        WebDriver driver = new FirefoxDriver();
        driver.get("https://msdi-ver.thlab.s3/rscon-frontend/#!/login");

        WebElement password = driver.findElement(By.cssSelector("label[for=password]"));
        assertEquals("ng-binding", password.getAttribute("class"));
    }

    @Test
    public void testElementText() {
        WebDriver driver = new FirefoxDriver();

        String htmlPath = this.createPathToHtml("selenium1.html");
        System.out.println(String.format("Will open browser at '%s'", htmlPath));
        driver.get("https://msdi-ver.thlab.s3/rscon-frontend/#!/login");

        //Get the Elements
        WebElement username = driver.findElement(By.cssSelector("label[for=username]"));
        WebElement password = driver.findElement(By.cssSelector("label[for=password]"));

        //Get the Elements text
        String usernameText = username.getText();
        String passwordText = password.getText();

        //Verify displayed text
        assertEquals("Username or Email", usernameText);
        assertEquals("Password", passwordText);

        assertTrue(usernameText.contains("or"));
        assertTrue(usernameText.startsWith("Username"));
        assertTrue(usernameText.endsWith("Email"));

    }

    @Test
    public void selenium1() {
        WebDriver driver = new FirefoxDriver();

        String htmlPath = this.createPathToHtml("selenium1.html");
        System.out.println(String.format("Will open browser at '%s'", htmlPath));
        driver.get(htmlPath);

        this.waitForAwhile();

        driver.quit();
    }

    private String createPathToHtml(String htmlFilename) {
        char sc = File.separatorChar;
        String currentDir = System.getProperty("user.dir");
        String resourcesPath = currentDir + sc + "src" + sc + "test" + sc + "resources";
        String htmlPath = resourcesPath + sc + htmlFilename;
        return htmlPath;
    }

    private void waitForAwhile() {
        try {
            Thread.sleep(3 * 1000);
        } catch (InterruptedException ex) {
            // for simplicity we don't care
        }
    }
}
