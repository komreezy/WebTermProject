# WebTermProject

Make sure to set up the database in order for you to connect to it. Copy and paste the following commands: 
1.) CREATE DATABASE polarize;
2.) CREATE TABLE `polarize`.`trends` ( `text` VARCHAR(100) NOT NULL , `location` VARCHAR(100) NOT NULL , `date` DATE NOT NULL , `volume` INT NOT NULL );

After you do this make sure to modify common.php to put your username and password for access to the database.