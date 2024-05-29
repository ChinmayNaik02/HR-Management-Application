# HR Management Application


## Overview

This repository contains the code and resources for a project aimed at designing a comprehensive software solution to streamline and automate human resource (HR) processes within an organization. This project aims to develop a robust and user-friendly system that facilitates efficient management of employee data, attendance, leaves, payroll, performance evaluation, training and development and other HR-related functions. The system provides a centralized platform for HR personnel to store, update, and access employee information, enabling seamless communication and collaboration across departments. Key features include employee data management portals, customizable leave management workflows, real-time attendance tracking, payroll processing, and performance evaluation modules. By implementing the HR Management System, organizations can improve HR efficiency, enhance employee satisfaction, ensure regulatory compliance, and support data-driven decision-making. This document outlines the project's objectives, scope, methodology, technologies used, and anticipated benefits.

## Project Structure

The repository is organized as follows:

- **attendance/**: Directory containing files related to attendance manangement features
- **employee/**: Directory containing files related to employee management features
- **leave/**:  Directory containing files related to leave management features
- **login/**: Directory containing files related to login and sign up functionality
- **payroll/**: Directory containing files related to payroll management of employees
- **training/**: Directory containing files related to training and development of employees related features
- **README.md**: Comprehensive documentation about the project, including project overview, setup instructions and usage guide
- **index.php**: File containing index page of the web application
- **user.sql**: File containing the structures of tables used in the web application

## Setup Instructions

### Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) or any other local server environment installed on your system.
- [MySQL](https://www.mysql.com/) database installed on your local server or a remote server.
- Basic understanding of HTML, CSS, JavaScript, Java (JSP), and PHP.

### Steps to Setup

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-username/HR-Management-Application.git
   
### Database Setup

1. **Import Database Schema:**

    - Open phpMyAdmin or any MySQL database management tool.
    - Create a new database named `employee`.
    - Import the `user.sql` file located in your project directory into your newly created database. This will create the necessary tables for the project.

2. **Configure Database Connection:**

    - Navigate to the `signUpInsert.php`, `login.php`, and any other relevant files containing database connection details.
    - Update the database connection parameters (`dbUrl`, `dbUser`, `dbPassword`) to match your MySQL database configuration.

### Running the Application

3. **Start the Local Server:**

    - Start your XAMPP or any other local server environment.
    - Ensure that Apache Server and MySQL Server are running.

4. **Access the Application:**

    - Open your web browser and navigate to `http://localhost/your-project-folder/`.
    - You should see the homepage of the application.
    - From here, you can navigate through the application and perform various actions such as user login, sign-up, Employee management, Attendance management, etc.

### Additional Notes

- Ensure that the `htdocs` or equivalent directory of your local server environment is set to the root directory of your project.
- If you encounter any issues during setup or while running the application, feel free to [create an issue](https://github.com/ChinmayNaik02/HR-Management-Application/issues) on GitHub for assistance.


## Usage

- **Sign Up**: Navigate to the sign-up page and register for a new account by providing your username and password
- **Login**: After signing up, log in to your account using your username and password
- **Employee Management**: Manage employee data, including personal details and employment history
- **Attendance Tracking**: Monitor and manage employee attendance, including recording attendance, viewing attendance and generating reports based on it 
- **Leave Management**: Automate leave requests, approval workflows, and leave balance tracking for employees
- **Payroll Management**: Simplify salary calculation and payroll reporting
- **Performance Management**: Manage performance employees and provide feedback based on it
- **Training & Development**: Identify training needs, develop training programs, implement a learning management system, and offer career development opportunities
