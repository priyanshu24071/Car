Car Management System
This project is a simple web application for managing car details stored in a database. It allows users to perform CRUD (Create, Read, Update, Delete) operations on car records.

Features
Add new car records with details such as car number, user number, names, card number, dates, company, color, and model.
View a list of existing car records with pagination.
Update existing car records with updated details.
Delete unwanted car records from the database.
Technologies Used
HTML: Used for structuring the web pages.
CSS: Used for styling the web pages.
Bootstrap: Used for responsive design and styling.
JavaScript: Used for client-side interactivity.
PHP: Used for server-side scripting and database interactions.
MySQL: Used as the database management system to store car details.
Database Structure
The project uses two tables in the MySQL database:

Car Table: Stores details of car records, including car number, user number, names, card number, dates, company, color, and model.

SQL

CREATE TABLE car (
    id INT AUTO_INCREMENT PRIMARY KEY,
    carNo VARCHAR(50),
    userNo VARCHAR(30),
    arName VARCHAR(30),
    enName VARCHAR(30),
    cardNo VARCHAR(30),
    beginDate DATE,
    endDate DATE,
    company VARCHAR(30),
    color VARCHAR(30),
    model VARCHAR(30)
);
Color Table: Stores available colors for cars.

SQL

CREATE TABLE color (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
);
Setup Instructions
Clone the repository to your local machine.
Import the provided SQL file (database.sql) into your MySQL database to create the necessary tables.
Configure the database connection settings in the config.php file.
Ensure that your web server (such as Apache or Nginx) and MySQL database server are running.
Open the project in a web browser by accessing the appropriate URL.
Usage
Navigate to the homepage to view existing car records and perform CRUD operations.
Use the navigation menu to add new car records, update existing records, or delete records as needed.
Ensure proper input validation while adding or updating car records to maintain data integrity.

Contributors
->Priyanshu Raj Singh
