# bubbles

 self-led project exploring the case study of the University of Washington's 
 School of Music key rentals, deposits, and cash transmittals.


#Scope of the project

**Users** 
This project will track general user information, inputed manually. 
There will be no automation of User information upload supported.

**Deposits**
This project will fully support deposit tracking. This will include tracking 
transmittal numbers that act as a reference to an outside source. A feature will support 
alerting users to transmittal numbers that have not yet been added.

**Authorizations** 
Authorizations have been deemed outside the scope of this project.

#Overview
This project is primarily built with **PHP** pages, using **javascript** when necessary, 
and a **MySQL** **phpMyAdmin** backend database. Formatting is mainly covered through **bootstrap.**

There are five main aspects of the program.

**add**
This will be the main page through which new data is entered. Eventually, it will be password 
protected to allow *most* users in. In addition, information on who entered the information will be stored.

**search**
This page will also be password protected to allow *most* users entry. As you can imagine, the page will 
have a method of searching for records. Eventually, advanced searching will be supported. For now, 
I will focus on supporting the following searches:
- user name
- user ID
- user type
- rental key type
- rental key number
- rental date
- transmittal ID
- door name

**edit**
The edit page will allow you to pull up records by their ID, and make edits. This will be one of the
_last_ features implemented, and until it is available, editing will be done through phpMyAdmin, sadly.

**admin**
This portion of th site will only allow a strict few entry. Admins will be allowed to create new key types,
key serial numbers, employees, doors, and transmittals. This is also where transmittals will be populated with deposits.

#Implementation notes
**Deposits and transmittals**

The flow of rentals, with regards to deposits and their transmittals.
- The paper trail starts with the rental occurring. The user inputs the rental, and the deposit is 
instantiated. The deposit will not be given a transmitalID at this time. The rental will be visible on the front page 
alert area labeled *unprocessed deposits.*
- The deposit is handled in the other system, and the other system generates a transmittal with a transmittal number.
- Using the admin tab, a transmittal is created using the transmittal number given by the other system (i.e. ST101). 
On this form, the user will be able to add unprocessed deposits via drop down menus.
- Thge transmittal ID of the transmittal being created will be associated with the Deposits that the user chooses. 
The amounts will be enforced, and an error will pop up if they don't match. :(

**Common.php**
It is important to note that common code will be stored in pages called common.*, and those should be referenced in 
every file. This will lead to more consistency, etc. I'm sure you understand.

#workflows

#TODO:
- create views, starting from most normalized function.
  - example- create vUsersSimple first, concattenating the names of users together.
- normalize inputted data.
  - capitalize all text, etc.
- finish the add transmittal and populate transmittal forms on the admin page.
  - add transmittal should use javascript to add more form slots for deposits that need to be added to the transmittal.
  - the populate transmittal is a retroactive tool, similar to *add Unlock.*
- add workflows to the README.md page...
- add functionality to delete key types. 
  - perhaps a stored procedure that checks if there are still any rentals for that key type.
  - perhaps this is a feature of the OLTP datawarehouse associated with the project.