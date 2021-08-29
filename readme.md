# GVI App
A web-based system where a user can log in and out of the system to manage timesheets via CRUD operations.

## Description
### User Stories
### Login
* Thevolunteer should be able to login with their email address and password.
### Add new record
 The volunteer must be able to enter a new record that contains the following information:
* Project (dropdownlistofavailableprojects)
* Date
* Descriptionof task(s) they werebusy with (optional)
* Timespent (inhours, withthe minimum being 1hour)
### View dashboard of all volunteers’ time totals for the current month
* The volunteer should be allowed to view a dashboard that contains a list of all the volunteers’ total times for the current month.
* The Gravatar image of each volunteer should appear next to their name
### Logout

## Getting Started

### Dependencies

* PHP >= 7.1.3
* MySQL >= 5.1
* Apache or Nginx
* HTML, CSS and JavaScript 

## Installing

### Project environment variables
* path : app/etc/settings.inc.php
* change URL to your site url
* define('URL', "your_project_url");
* Examples
* xampp(windows):http://localhost/gvipp/
* xampp(ubuntu): http://gvipp.local/

### Add database settings
* define('DB_HOST',"localhost");                        
* define('DB_USER',"your_db_username");              
* define('DB_PASS',"your_db_password");              
* define('DB_NAME',"your_db_name"); 

### Importing database
* create new database your_db_name
* path: db/test.sql
* import db above into your_db_name
* extract the contents on your localhost
* import the db available



## Help
Contact me on tembachakoregis@gmail.com
