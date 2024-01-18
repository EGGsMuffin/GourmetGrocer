from selenium import webdriver
from selenium.webdriver.common.by import By
import time
import tkinter as tk

# Sets the Selenium webdriver to Chrome
driver = webdriver.Chrome()

# Function used to enter text into an input field
def enter_text(input_xpath, new_text):
    # Find Element by XPATH
    input = driver.find_element(By.XPATH, input_xpath)

    # Clears the input. Necessary if there is already text in the input
    input.clear()

    # Enter text into the element
    input.send_keys(new_text)

# Function to show the pop-up
def show_popup():
    popup = tk.Tk()
    popup.title("Selenium has finished")
    label = tk.Label(popup, text="Testing has been successfully completed!")
    label.pack(padx=10, pady=10)
    popup.mainloop()

def main():
    # Load Webpage
    driver.get("http://localhost/GourmetGrocer/")

    # Check the correct page has been loaded
    assert "Gourmet Grocer" in driver.title

    # Enters text into the login form
    email = "adminsRule@lols.com"
    password = "P4ssword@2"
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", email) # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", password) # password field

    # Clicks the login button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()

    # Checks the menu page has been loaded
    assert "Menu" in driver.title

    # Waits 5 seconds before continuing
    time.sleep(5)

    # Clicks the category button
    driver.find_element(By.XPATH, "/html/body/section/div/div/div/div[6]/a/div/h5").click()

    # Checks the category management page has been loaded
    assert "Categories Management Page" in driver.title

    # Waits 5 seconds before continuing
    time.sleep(5)

    # Clicks the create button
    driver.find_element(By.XPATH, "/html/body/div/section/div/div/div/div/a").click()

    # Checks the create category page has been loaded
    assert "Create Category Page" in driver.title

    # Waits 5 seconds before continuing
    time.sleep(5)

    # Enters text into the register form
    name = "Test"
    description = "Test is a test"
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", name) # category name field
    enter_text("/html/body/form/section/div/div/div/div/div/div[4]/input", description) # description field

    # Waits 5 seconds before continuing
    time.sleep(5)
    
    # Clicks the register button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()

    # Checks the category management page has been loaded
    assert "Categories Management Page" in driver.title

    # Waits 5 seconds before continuing
    time.sleep(5)

    # Clicks the delete button
    driver.find_element(By.XPATH, "/html/body/div/table/tbody/tr[6]/td[4]/div/div[2]/a").click()

    # Checks the delete category page has been loaded
    assert "Delete Category Page" in driver.title
    
    # Waits 5 seconds before continuing
    time.sleep(5)

    # Clicks the delete button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()

    # Checks the delete category page has been loaded
    assert "Categories Management Page" in driver.title

    # Waits 5 seconds before continuing
    time.sleep(5)

    # Displays popup
    show_popup()

    # Waits 20 seconds before closing the chrome tab
    time.sleep(20)

if __name__ == "__main__":
    main()