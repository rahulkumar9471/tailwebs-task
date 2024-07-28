# Teacher Portal

## Overview

This project is a Teacher Portal built with PHP that includes functionality for teacher login, student management, and adding new students. The portal allows teachers to view, edit, and delete student records, and add new students through a modal popup.

## Features

- **Login Functionality**: Secure login for teachers with credential validation.
- **Teacher Portal Home**: Displays a list of students with options to edit and delete student details.
- **Inline Editing**: Allows for inline editing of student details.
- **Add New Student**: Adds new students via a modal popup, handling duplicate entries and updating marks.

## Technology Stack

- **Front-End**: HTML, CSS, Vanilla JavaScript
- **Back-End**: PHP
- **Database**: MySQL

## Setup Instructions

### 1. Clone the Repository

1. Open a terminal or command prompt.
2. Navigate to the XAMPP `htdocs` directory:
   ```bash
   cd /path/to/xampp/htdocs

3. Clone the repository:
Clone the Repository:

Run the git clone command:
git clone https://github.com/rahulkumar9471/tailwebs-task.git
This will create a folder named tailwebs-task in the htdocs directory.

4.Import the Database
Open phpMyAdmin:

Go to your browser and navigate to http://localhost/phpmyadmin.
Create a New Database:

Click on the "Databases" tab.
Enter a name for the database (e.g., robust) and click "Create".
Import the Database:

Select the newly created database.
Click on the "Import" tab.
Click "Choose File" and select the SQL file from the DB folder.
Click "Go" to import the database.

5. Run the Project
Access the Login Page:

Open your browser and navigate to http://localhost/tailwebs-task/login.html.
Login with Credentials:

Username: admin
Password: admin
