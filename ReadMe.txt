Author: Md. Nabid Imteaj
Date: 8 March, 2014
Course: Web Technologies [B]
Faculty: Debajyoti Kormoker
American International University - Bangladesh (AIUB)
e-mail: nabid.imteaj@live.com
-----------------------------------------------------

Library Management System
~~~~~~~~~~~~~~~~~~~~~~~~~~
Admin default username: admin
Admin default password: admin
Sample Username   : Nabid 
Password for Nabid: admin

Environment
~~~~~~~~~~~~~
Implented in an environment, MySQL server with username "root"
and no password. If changed then modify dbase.php line 2.
OS: Ubuntu 12.04
Xampp version: 1.8.2-3 (linux)
PHP Version 5.4.22

Functionality
~~~~~~~~~~~~~
Admin can - Approve an registerd user.
			Deny and registered user.
			Add books into library.
			Delete books from library.
			Modify books of library.
			Take return of borrowed books by user.
Anonymous can - Only register.
Users can - View his fine.
	    Select books from available books to borrow.
	    Cancel a book selected to be borrowed.
	    Confirm a list of books to borrow.

Bugs
~~~~~~
[Fixed] Users can take any numbers of books.
[Fixed] Users can take any numbers of copies, While returning, only one copy. is added.
If user cancel a book from selected book list to borrow, number of copy is incremented if the page is refreshed.

Further Use
~~~~~~~~~~~
Any one can feel free to read, edit and modify this Library management system.
All codes are done by me. Any one can redistribute this for educational purpose.

Last Updated
~~~~~~~~~~~~
March 16, 2014.
