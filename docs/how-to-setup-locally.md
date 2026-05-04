If you would like to run this applicaiton yourself locally, here is the easiest way using xampp and MySQL.
This guide does not list every step an assumes you have basic knowledge of running a local server.

Steps
1. Download the repo into C:\xampp\htdocs
2. In the main folder with index.php, open a terminal and run the command: *composer install* (this requires composer)
3. Using a database managment software such as MySQL Workbench or DBeaver, create a local database (default is named "." with no password on port 3306)
4. In the vendor folder find and run database_mysql.sql in your database manager.
5. In the main folder find and run the database-creation-statments.sql in your database manager.
6. Open xampp control pannel and start Apache and MySQL
7. Go to localhost/Web-Systems-II-Language-Learning-Application-Project in a web browser
