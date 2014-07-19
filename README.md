README
====
Welcome, this is a fork of Nils' original ecDB project with many small changes and fixes

# What is ecDB

[ecDB.net](http://www.ecdb.net) is basically a place where you, as an electronics hobbyist (or professional) can add your own components 
to your personal database to keep track of what components you own, where they are, how many you own and so on. 

## Who and Why

ecDB is created by [Nils Fredriksson](http://nilsf.se) aka. ElectricMan, and designed by [Buildlog](http://buildlog.se). 

The reason I publish the code for [ecDB.net](http://www.ecdb.net) is that I simply don't have enough time, 
and my knowledge is not sufficient to develop [ecDB.net](http://www.ecdb.net) to the point I wish. Therefore 
I need help from the community to make [ecDB.net](http://www.ecdb.net) better!


# Changes
* Fixed mysql connection
* Removed Demo user, demo parts and project from new installs
* Added some admin options
* Added default admin user
* Registration now optional tab. Can close off registration to public
* Removed old non-working twitter unauthenticated api
* Public viewable projects, login not required.

# Install or Upgrade

## New Install Requirements
*  Web Server
*  PHP Version 5.2.4 or above.
*  MySQL Version 5.0 or above.

## New Installation
* Create a new mysql database
* Apply the ecdb_database.sql to the empty database
* Update admin password hash in database
* Copy files to web server
* Edit include/mysql_connect.php 
* Login as admin and set/change any options.

## Upgrading

To upgrade an existing ecDB;

* Apply upgrade.sql to existing database
* Change Admin password in database
* Backup include/mysql_connect.php
* Copy all files to destination
* Restore include/mysql_connect.php
* Login as admin and set/change any options.



# License
ecDB is licensed under a Creative Commons [Attribution-NonCommercial-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-nc-sa/3.0/).
