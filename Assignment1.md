Assignment 1 
Name : PHP form 
Topic :  Dev 
Assignment Guideline : 
  
Design and develop a form that asks the user to enter their personal info and fill out a short survey.  The form will be valid HTML, contain no tables, and have content completely separate from presentation by using external CSS rules.  The form will also have logic that will allow the user to go back and make changes if they find that they entered the wrong info.
Specifications
Implementation:
General
•	Code is indented to show tag parent/child relationships.
•	Your page should contain proper semantic formatting of content.
•	The root directory for this assignment should be ~/public_html/dig3134/assignment02
•	The image directory for this assignment should be ~/public_html/dig3134/assignment02/image
•	The CSS directory for this assignment should be ~/public_html/dig3134/assignment02/css
•	Your HTML pages should be located in the root directory for this assignment and should be called form_entry.php, form_preview.php, and form_confirmed.php
•	The <title>’s of form_entry.php, form_preview.php, and form_confirmed.php should be “Assignment 2 – first_name last_name”.
•	All directories and filenames should contain no spaces or uppercase letters.
•	All links need to be functional.
•	All of your .php files need to have corresponding .txt symbolically linked files in the root directory.
HTML
•	Web page validates as HTML 5 (http://validator.w3.orgLinks to an external site.).
CSS
•	The CSS directory for this assignment should be ~/public_html/dig3134/assignment02/css
•	All styles must be documented in an external CSS file called styles.css and linked to the document using the @import url rule or the <link> element.
o	All presentational HTML attributes should be replaced with CSS rules.
o	Use classes and/or id’s where appropriate.
PHP Functional Spec:
General
•	No global variables should be used.
•	Your logic should check if variables/superglobal arrays exist before trying to access values stored inside.
•	Form submission should use the POST method
•	You should mix standard HTML and PHP wherever possible (as opposed to outputting all of your HTML with PHP echo statements).
Form Processing
•	Page 1 (form_entry.php)
o	A page that contains blank form fields that the user will fill in.  The submit button should be labeled “Preview Answers”.
•	Page 2 (form_preview.php)
o	Once the user hits submit, the data they entered on Page 1 will be presented back to them with label information (for example: First Name – Dan Novatnak).
o	There will also be two buttons on the page.  One button will be labeled “Edit”, and the other button will be labeled “Finish”.
o	Edit Button
	If the user hits the Edit button on Page 2, they will be sent to Page 1, and all of the data that they entered will appear as pre-filled values of each form field.  These values should be stored using Cookies and not hidden form fields (or any other more advanced method).
	Once back on Page 1, functionality will continue as described in “Page 1” above.
o	Finish Button
	If the user hits the Finish button on Page 2, they should be sent to Page 3.
•	Page 3 (form_confirmed.php)
o	The user should be shown a message that says “Thank you, your data has been submitted”
•	Your form should be divided visually into at least 2 different styled fieldsets with legends.
•	Questions should have obvious visual dividers.
Presentation
Content
The user should be shown two fieldsets:
•	The first fieldset will contain text input fields to enter a first name, last name, e-mail, phone number, and students server address.
•	The second fieldset will contain 5 questions of your choosing. 
o	Use common sense: Avoid obscene, offensive, or otherwise inappropriate questions.


**Code** 
*form_entry.php :*

 <?php
if ($_SERVER["REQUEST_METHOD"] != "POST" && !isset($_GET['from_preview'])) {
    setcookie('first_name', '', time() - 3600, "/");
    setcookie('last_name', '', time() - 3600, "/");
    setcookie('email', '', time() - 3600, "/");
    setcookie('phone', '', time() - 3600, "/");
    setcookie('server_address', '', time() - 3600, "/");
    setcookie('question1', '', time() - 3600, "/");
    setcookie('question2', '', time() - 3600, "/");
    setcookie('question3', '', time() - 3600, "/");
    setcookie('question4', '', time() - 3600, "/");
    setcookie('question5', '', time() - 3600, "/");
    $first_name = '';
    $last_name = '';
    $email = '';
    $phone = '';
    $server_address = '';
    $question1 = '';
    $question2 = '';
    $question3 = '';
    $question4 = '';
    $question5 = '';
} else {
    //  fill all   fields with cookies if they exist
    $first_name = isset($_COOKIE['first_name']) ? $_COOKIE['first_name'] : '';
    $last_name = isset($_COOKIE['last_name']) ? $_COOKIE['last_name'] : '';
    $email = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';
    $phone = isset($_COOKIE['phone']) ? $_COOKIE['phone'] : '';
    $server_address = isset($_COOKIE['server_address']) ? $_COOKIE['server_address'] : '';
    $question1 = isset($_COOKIE['question1']) ? $_COOKIE['question1'] : '';
    $question2 = isset($_COOKIE['question2']) ? $_COOKIE['question2'] : '';
    $question3 = isset($_COOKIE['question3']) ? $_COOKIE['question3'] : '';
    $question4 = isset($_COOKIE['question4']) ? $_COOKIE['question4'] : '';
    $question5 = isset($_COOKIE['question5']) ? $_COOKIE['question5'] : '';
}
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2 – form_entry</title>
    <link rel="stylesheet" href="asigcss.css">
</head>
<body>
    <div class="formone"> 
    <form action="form_preview.php" method="POST">
        <fieldset>
            <legend>Personal Information</legend>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            <br>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <br>
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            <br>
            <label for="server_address">Student Server Address:</label>
            <input type="text" id="server_address" name="server_address" value="<?php echo htmlspecialchars($server_address); ?>" required>
        </fieldset>

        <fieldset>
            <legend>Survey</legend>
            <label for="question1">Question 1: favourite car?</label>
            <input type="text" id="question1" name="question1" value="<?php echo htmlspecialchars($question1); ?>" required>
            <br>
            <label for="question2">Question 2: pet name?</label>
            <input type="text" id="question2" name="question2" value="<?php echo htmlspecialchars($question2); ?>" required>
            <br>
            <label for="question3">Question 3: favourite dish?</label>
            <input type="text" id="question3" name="question3" value="<?php echo htmlspecialchars($question3); ?>" required>
            <br>
            <label for="question4">Question 4: house number?</label>
            <input type="text" id="question4" name="question4" value="<?php echo htmlspecialchars($question4); ?>" required>
            <br>
            <label for="question5">Question 5: phone brand?</label>
            <input type="text" id="question5" name="question5" value="<?php echo htmlspecialchars($question5); ?>" required>
            <br>
        </fieldset>
        <input type="submit" value="Preview Answers">
    </form>
    </div>
</body>
</html>


form_preview.php : 

<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Set cookies for each form blank
       setcookie('first_name', $_POST['first_name'], time() + 3600, "/");  
       setcookie('last_name', $_POST['last_name'], time() + 3600, "/");
       setcookie('email', $_POST['email'], time() + 3600, "/");
       setcookie('phone', $_POST['phone'], time() + 3600, "/");
       setcookie('server_address', $_POST['server_address'], time() + 3600, "/");
       setcookie('question1', $_POST['question1'], time() + 3600, "/");
       setcookie('question2', $_POST['question2'], time() + 3600, "/");
       setcookie('question3', $_POST['question3'], time() + 3600, "/");
       setcookie('question4', $_POST['question4'], time() + 3600, "/");
       setcookie('question5', $_POST['question5'], time() + 3600, "/");   
       $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $server_address = $_POST['server_address'];
    $question1 = $_POST['question1'];
    $question2 = $_POST['question2'];
    $question3 = $_POST['question3'];
    $question4 = $_POST['question4'];
    $question5 = $_POST['question5']; 
   }else {
    header("Location: form_entry.php");
    exit;
} 
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2 – Your Name</title>
    <link rel="stylesheet" href="asigcss.css">
</head>
<body>
    <div class="formone">  
<form action="form_preview.php" method="POST">
        <fieldset>
            <legend>Personal Information</legend>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            <br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
            <br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            <br>

            <label for="server_address">Student Server Address:</label>
            <input type="text" id="server_address" name="server_address" value="<?php echo htmlspecialchars($server_address); ?>" required>
        </fieldset>

        <fieldset>
            <legend>Survey</legend>
            <label for="question1">Question 1: favourit car ?</label>
            <input type="text" id="question1" name="question1" value="<?php echo htmlspecialchars($question1); ?>" required>
            <br>
            <label for="question1">Question 2: pet name ?:</label>
            <input type="text" id="question2" name="question2" value="<?php echo htmlspecialchars($question2); ?>" required>
            <br>
            <label for="question1">Question 3: favourit dish ?</label>
            <input type="text" id="question3" name="question3"  value="<?php echo htmlspecialchars($question3); ?>"required>
            <br>
            <label for="question1">Question 4:house number ?</label>
            <input type="text" id="question4" name="question4" value="<?php echo htmlspecialchars($question4); ?>" required>
            <br>
            <label for="question1">Question 5:phone brand ?</label>
            <input type="text" id="question5" name="question5" value="<?php echo htmlspecialchars($question5); ?>" required>
            <br> 
             
        </fieldset>
</form>
    </div>
    <!-- Buttons for Edit and Finish -->
   <div class="prevform"> 
    <form action="form_entry.php" method="POST"   style="background-color:none;" >
        <input type="submit" value="Edit" style="background-color:#E23D28;">
    </form>

    <form action="form_confirmed.php" method="POST" >
        <input type="submit" value="Finish">
    </form>
    </div>  
</body>
</html>

form_confirmed.php :
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment</title>
</head>
<style>
</style>
 <link rel="stylesheet" href="asigcss.css">
<body>
    <div class="confirm" style="background-color:cornsilk;
    box-shadow: 0.5px 0.5px 1px 1px #218838  ;"> 
    <h1>Thank you, your data has been submitted!</h1>
    </div>
</body>
</html>
<?php
// Clear cookies by setting expire time in the past
setcookie('first_name', '', time() - 3600, "/");
setcookie('last_name', '', time() - 3600, "/");
setcookie('email', '', time() - 3600, "/");
setcookie('phone', '', time() - 3600, "/");
setcookie('server_address', '', time() - 3600, "/");
setcookie('question1', '', time() - 3600, "/");
setcookie('question2', '', time() - 3600, "/");
setcookie('question3', '', time() - 3600, "/");
setcookie('question4', '', time() - 3600, "/");
setcookie('question5', '', time() - 3600, "/");
 
?>


*asigcss.css :* 


body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

 
.formone  {
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: rgb(248, 248, 229);
    
}
.prevform  {
    display: flex;
    justify-content: space-between ;
    align-items: center ;
    padding: 10px ;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

 
fieldset {
    border: 1px solid #ccc;
    padding-right: 4.5vh;
    margin-bottom: 15px;
      
    
}

 
legend {
    font-weight: bold;
}

 
label {
    display: block;
    margin-bottom: 5px;
    background-color:rgb(251, 250, 243);
    
}

input[type="text"], input[type="email"], input[type="tel"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border-radius: 3px;   
    border: 1px solid #ccc;
} 
/* Submit Button Styling */
input[type="submit"] {
    background-color:#4CBB17;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #218838;
    box-shadow: 0.5px 0.5px 1px 1px #218838  ;
}


#### Assignment readme : 


# Project Documentation

## Installation and Setup

### Installing XAMPP

#### Download XAMPP:
- Go to the [XAMPP official website](https://www.apachefriends.org/index.html).
- Download the version of XAMPP suitable for your operating system (Windows, macOS, or Linux).

#### Install XAMPP:
- Run the downloaded installer.
- Follow the installation prompts. It’s usually recommended to install XAMPP in the default directory (`C:\xampp` on Windows).

#### Start XAMPP:
- Open the XAMPP Control Panel. You can find it in the XAMPP installation directory or via a shortcut on your desktop.
- In the XAMPP Control Panel, click the “Start” button next to Apache to start the Apache server.

### Configuring Apache Server

#### Access Apache Configuration:
- In the XAMPP Control Panel, click on the “Config” button next to Apache.
- Select “Apache (httpd.conf)” to open the Apache configuration file in a text editor.

#### Check Document Root:
- Locate the line `DocumentRoot "C:/xampp/htdocs"`. This is the directory where Apache serves your files from.
- Ensure this path points to the `htdocs` folder in your XAMPP installation directory.

#### Restart Apache:
- After making any configuration changes, restart Apache by clicking the “Stop” button and then the “Start” button in the XAMPP Control Panel.

### Using Localhost

#### Accessing Your Project:
- Place your project files inside the `htdocs` directory located in your XAMPP installation directory (`C:\xampp\htdocs`).
- For example, if your project folder is named `my_project`, place it in `htdocs` so the path becomes `C:\xampp\htdocs\my_project`.

#### Viewing Your Project:
- Open a web browser and go to `http://localhost/my_project/` to view your project. Replace `my_project` with the actual folder name of your project.

### File Location

#### HTML/PHP Files:
- Your HTML and PHP files should be placed inside the `htdocs` directory or a subdirectory within `htdocs`.
- Example file structure: `C:\xampp\htdocs\my_project\form_entry.php`, `C:\xampp\htdocs\my_project\form_preview.php`.

 


