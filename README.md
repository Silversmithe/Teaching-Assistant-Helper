# Teaching Assistant Helper

VERSION: 1.1.1

A web application for helping teaching assistants answer student's questions in lab in a just and efficient order

This section will give an in-depth guide on how to install and run our program, which includes a web page folder as well as a guide on how to install and start a MySQL database to use with our application. This installation guide requires that you be able to alter code in Linux terminal, open and create tables in MySQL, and have access to SCU licensed materials, such as SCU's MySQL database and SCU's webpage system.
  
Installing the Database
 
  	1. Email SCU technical support at support@engr.scu.edu and request to have a MySQL database account made for you.
    2. Record the user name and password from the response, they will be needed to both access the database and rewrite the code in the webpage folder. Your database's name is "sdb_<your_username>"
    3. Open up terminal on a Linux computer and type "setup mysql5"
    4. Next, type "mysql -h dbserver.engr.scu.edu -p -u <your_username> <database_name>" in terminal
    5. Next, the terminal will prompt you for your password, into which you will enter the password you received earlier from the email, giving you access to the database.
    
    
Creating the Tables
   	
   	After following the previous section's steps and still in the terminal window that has MySQL open, type in "
    
   	CREATE TABLE Students (session_id VARCHAR(20), name VARCHAR(20));
    
    CREATE TABLE Sessions (session_id MEDIUMINT NOT NULL AUTO_INCREMENT,
    username VARCHAR(20), title VARCHAR(20), PRIMARY KEY (session_id));
    
    CREATE TABLE QA (session_id VARCHAR(20), student_name VARCHAR(20),
    time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, question VARCHAR(1000),
    answer VARCHAR(1000));
    
    CREATE TABLE TAs (name VARCHAR(20), username VARCHAR(20), password VARCHAR(90), validate BOOL);
    
    CREATE TABLE Announcements (session_id VARCHAR(20), announcement VARCHAR(1000));
    "
   	
    
Changing the Code

    After following the previous two sections, it is now necessary to change the code to access this new database you have created instead of the old database.
    
    1. Go to the "php" folder in the project folder
    2. For every file in that folder, enter the file and wherever you see '$servername = "sdb_shoff";', '$username = "shoff";', '$password = "00001072205";', change the "servername" value to your new database name, "username" to your new username, and change the "password" value to your password
    3. Go to "ta-register.php" and change the "$to" value to your own email to make yourself the administrator. This allows you to receive the emails confirming TAs to use the program
    
    
   
Final Steps
    
    1. Move the folder "tahelper" into your SCU webpage folder   
    2. To start the program, go to "students.engr.scu.edu/~<your_username>/tahelper/index.php
    
