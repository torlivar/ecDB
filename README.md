README
====
Welcome, this is a fork of Stu's fork of Nils' original ecDB project with a great many changes and fixes.

# What is ecDB

ecDB is a small lightweight system to track your electronic components and projects, letting you know what you have,
how much and where it is.

# Changes From Stu's version
This version is more for collaboration. All users can optionally see other users's components (but not edit). To be able to share components between friends.

It is not recomended to run this version with open registration, as it is based on used with in a group of trusting friends or within an organisation.

# Changes From the Original ecDB

### v0.3
* Cleaned footer up display
* Fixed license display
* Fixed category sorting on several pages.
* Widened the main table display
* Added a list users function under admin

### v0.2
* Fixed mysql connection
* Removed Demo user, demo parts and project from new installs
* Added some admin options
* Added default admin user
* Registration now optional tab. Can close off registration to public
* Donation tab now optional (shown by default)
* Public Components optional (hidden by default)
* Removed old non-working twitter unauthenticated api
* Public viewable projects, login not required.
* Projects now have url and markdown description
* Project list now shows how many kits can be built from current component supply
* Project detail now lists qty on order
* Component bin location added to track where on your shelf they live
* Fixed price calculations to two decimal points, no more 2.100000000000000038 weirdness
* Great category modification (table structure cleaned up, no user space visibile)
* Can quickly add/remove/update a component on a project in project view
* Conversion of deprecated mysql_ driver to mysqli_ driver
* Exporting BOM of project
* 'public' components totally removed.
* Cleaned up location field
* Pushed bin location down to component + sub level.
* Minor price css tweaks
* Projects now show up when viewing a component
* Dont show component bin# when not project owner

### v0.1
Nils never versioned his code it seems, so I'm calling the original ecDB code base version 0.1

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

# TODO List
* Category management
* User management
* Better project management

# Acknowledgements
We use the awesome [Parsedown](http://parsedown.org/) written by Emanuil Rusev

# License
ecDB is licensed under a Creative Commons [Attribution-NonCommercial-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-nc-sa/3.0/).
