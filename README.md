# lamp_hello
## lamp based hello world app
###### This lamp app is essentially a twitter clone called Borks

**Purpose: to get familiar with apache web servers, http protocol, php and mysql**

**These are the steps I took, you may use whatever setup you prefer**

###### Configure web server

1. get virtualbox
2. get ubuntu server image
3. spin up the server and configure [passwordless ssh](https://linuxize.com/post/how-to-setup-passwordless-ssh-login/)
- headless start and remote login is now possible
4. install apache2 and mysql

###### Configure database

1. come up with a database schema that will fit your needs
- see db_schma for example
2. in interactive mysql, run: source makeDB.sql;

###### Make the interactive web pages

1. register.php, login.php, main.php, logout.php and reset-password.php
- these php files use the mysqli extension, make sure this extension is installed and enabled
2. place these files in /var/www/html to serve to clients
