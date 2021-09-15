dummy_data.sql
--------------
This file is to populate the site with data for development purposes.
Run this when database is reset for any reason.

makeDB.sql
-----------
This file is used to create the database and its schema for Borks app.
Run this to create the database for Borks. Typically used at setup or whenever database has been reset/deleted.

test.sql
---------
This file is used to test sql statements. Write them here and copy and paste into interactive sql shell.
If statement screws things up. Delete database, run makeDB.sql and then dummy_data.sql.

Restart database
-----------------
1. enter mysql shell
2. run 'drop database lamp_hello;'
3. followed by 'source makeDB.sql;' and 'source dummy_data.sql;'

or 

2. run 'source restart_lamp.sql;'
