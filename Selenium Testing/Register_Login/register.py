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

    # Clicks on the register navbar button
    driver.find_element(By.XPATH, "/html/body/nav/div/ul/li[2]/a").click()

    # Checks the register page has been loaded
    assert "Register Page" in driver.title

    # Waits 5 seconds before continuing
    time.sleep(5)

    # Enters text into the registration form
    fname = "Test"
    lname = "Member"
    email = "testmember@test.com"
    password = "P@ssword1"
    verify_password = "P@ssword1"
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", fname) # First name field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", lname) # last name field
    enter_text("/html/body/form/section/div/div/div/div/div/div[3]/input", email) # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[4]/input", password) # Password field
    enter_text("/html/body/form/section/div/div/div/div/div/div[5]/input", verify_password) # Confirm password field

    # Waits 5 seconds before continuing
    time.sleep(5)

    # Clicks the register button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()

    # Checks the login page has been loaded
    assert "Gourmet Grocer" in driver.title

    # Displays popup
    show_popup()

    # Waits 20 seconds before closing the chrome tab
    time.sleep(20)

if __name__ == "__main__":
    main()