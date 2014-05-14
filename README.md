nest
====

Basic hotel room booking with reporting built with Limonade - a PHP micro framework and MySQL.

## Info
Nest is a very small hotel booking capture solution for usage in a reservation call centre.  There are two types of user (admin and non admin users who 
are typically agents taking calls and recording bookings).  There are two primary aspects to the system and they are booking and reporting.  Some booking 
rules exist and are implemented using the jQuery Validate plugin.

Inside this project exists another super tiny micro project to facilitate standard CRUD operations in Limonade or indeed in other very small PHP apps that
don't have their own persistence layer (see the base model in the lib directory).

For basic instructions on installation and setup please go to the [Wiki](https://github.com/cherrysoft/nest/wiki).

## Security
If you want to use this project in production or beyond the firewall you will want to beef up security somewhat as passwords are encrypted with md5 along
with numerous other 'holes' that would not be deemed acceptable in a production system. 
