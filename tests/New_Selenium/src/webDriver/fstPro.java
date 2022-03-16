package webDriver;
import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.assertThat;

import java.util.concurrent.TimeUnit;
import org.openqa.selenium.By;

import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.interactions.Actions;


public class fstPro {

	WebDriver driver;
		
	public void invoketBrowser() {
		try {
			System.setProperty("webdriver.chrome.driver",".\\drivers\\chromedriver.exe");
			driver =new ChromeDriver();
			driver.manage().deleteAllCookies();
			driver.manage().window().maximize();
			driver.manage().timeouts().implicitlyWait(30,TimeUnit.SECONDS);
			driver.manage().timeouts().pageLoadTimeout(30,TimeUnit.SECONDS);
				
			driver.get("http://localhost/Event-Diary/login.php");
			search();
		}
		catch (Exception e) {
			e.printStackTrace();
		}
	}
	public void search() {
		try { driver.findElement(By.linkText("Register Here")).click();
	    driver.findElement(By.id("fn")).click();
	    driver.findElement(By.id("fn")).sendKeys("Adnan");
	    driver.findElement(By.id("ln")).sendKeys("Sakeeb");
	    driver.findElement(By.id("pw")).sendKeys("1234");
	    driver.findElement(By.id("em")).sendKeys("sakeeb@kea.com");
	    driver.findElement(By.id("ag")).sendKeys("42");
	    driver.findElement(By.id("ad")).sendKeys("Ruten 137");
	    driver.findElement(By.id("ct")).sendKeys("Brønshøj");
	    driver.findElement(By.id("st")).sendKeys("Copenhagen");
	    driver.findElement(By.id("co")).sendKeys("Denmark");
	    driver.findElement(By.id("pc")).sendKeys("2700");
	    driver.findElement(By.id("ph")).sendKeys("71800374");
	    driver.findElement(By.id("customerRegistration")).click();
	    driver.findElement(By.linkText(">Login<")).click();
	    driver.findElement(By.name("email")).sendKeys("sakeeb@kea.com");
	    	driver.findElement(By.name("password")).sendKeys("1234");
			driver.findElement(By.name("submit")).click();
			Thread.sleep(1000);
			driver.findElement(By.linkText("Search Event")).click();
		    driver.findElement(By.id("category")).click();
		    {
		      WebElement dropdown = driver.findElement(By.id("category"));
		      dropdown.findElement(By.xpath("//option[. = 'Rest']")).click();
		    }
		    driver.findElement(By.id("Z7r9jZ1AdAV4S")).click();
		    driver.findElement(By.id("G5viZ9doz1diq")).click();
		    driver.findElement(By.name("save")).click();
		    driver.findElement(By.linkText("Search Event")).click();
		    driver.findElement(By.id("category")).click();
		    {
		      WebElement dropdown = driver.findElement(By.id("category"));
		      dropdown.findElement(By.xpath("//option[. = 'Sports']")).click();
		    }
		    driver.findElement(By.id("G5v0Zpsuu5VdW")).click();
		    driver.findElement(By.id("G5viZpY9n3gG8")).click();
		    driver.findElement(By.name("save")).click();
		    
		    driver.findElement(By.linkText("See Event")).click();
		    driver.findElement(By.name("Category")).click();
		    {
		      WebElement dropdown = driver.findElement(By.name("Category"));
		      dropdown.findElement(By.xpath("//option[. = 'Rest']")).click();
		    }
		    driver.findElement(By.name("submit")).click();
		    driver.findElement(By.name("Category")).click();
		    {
		      WebElement dropdown = driver.findElement(By.name("Category"));
		      dropdown.findElement(By.xpath("//option[. = 'Sports']")).click();
		    }
		    driver.findElement(By.name("submit")).click();
		    driver.findElement(By.linkText("Edit Profile")).click();
		    driver.findElement(By.name("submit")).click();
		    assertThat(driver.switchTo().alert().getText(), is("Are you sure you want to Unsubscribe? You will lose all your saved Events."));
		    driver.switchTo().alert().accept();
		} catch (Exception e) {
			
			e.printStackTrace();
		}
		
		
		
	}
	
	public static void main(String[] args) throws InterruptedException 
	{
		fstPro myObj = new fstPro();
		myObj.invoketBrowser();
	}
}
