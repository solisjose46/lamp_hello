# lamp_hello
## lamp based hello world app
###### Ths lamp app is essentially a twitter clone called Borks
** Purpose: to get familiar with apache web servers, http protocol, **
** php and mysql **

###### Configure web server
** These are the steps I took, you may use whatever setup you prefer **
1. get virtualbox
2. get ubuntu server image
3. spin up the server and configure [passwordless ssh](https://linuxize.com/post/how-to-setup-passwordless-ssh-login/)
- headless start and remote login is now possible
4. install apache2 and mysql

###### Configure schema
1. Come up with a database schema that will fit your needs
- see db_schma for example
1. in interactive mysql, run: create database lamp_hello;
2. in interactive mysql, run: use lamp_hello;
3. in interactive mysql, run: source makeDB.sql;

###### Make the interactive web pages
1. register.php, login.php, main.php, logout.php and reset-password.php
- my php files use the mysqli extension, make sure this extension is installed and enabled
- this was giving me issues
2. place these files in /var/www/html to serve to clients
