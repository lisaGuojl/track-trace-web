#!/bin/bash

MYSQL_ROOT=""
MYSQL_PASS=""

option=$1

if [ "$option" == "-create" ]; then
	echo "Creating tables ..."
	mysql --host=us-cdbr-iron-east-01.cleardb.net --user=b69d6d61cb2e3d --password=38c67e52 --reconnect heroku_a2869373e9ca23f < create.sql

elif [ "$option" == "-drop" ]; then
	echo "Dropping tables ..."
	mysql --host=us-cdbr-iron-east-01.cleardb.net --user=b69d6d61cb2e3d --password=38c67e52 --reconnect heroku_a2869373e9ca23f < drop.sql

elif [ "$option" == "-truncate" ]; then
	echo "Truncating table (sesion) ..."
	mysql --host=us-cdbr-iron-east-01.cleardb.net --user=b69d6d61cb2e3d --password=38c67e52 --reconnect heroku_a2869373e9ca23f < truncate.sql

elif [ "$option" == "-reset" ]; then
	echo "Destroying and Setting up tables ..."
	mysql --host=us-cdbr-iron-east-01.cleardb.net --user=b69d6d61cb2e3d --password=38c67e52 --reconnect heroku_a2869373e9ca23f < drop.sql
	mysql --host=us-cdbr-iron-east-01.cleardb.net --user=b69d6d61cb2e3d --password=38c67e52 --reconnect heroku_a2869373e9ca23f < create.sql

elif [ "$option" == "-remote" ]; then
	echo "Logging into remote MySQL (ClearDB) prompt ..."
	mysql --host=us-cdbr-iron-east-01.cleardb.net --user=b69d6d61cb2e3d --password=38c67e52 --reconnect heroku_a2869373e9ca23f

elif [ "$option" == "-help" ]; then
	echo -e "\nHelp guide to MySQL Blockchain database ..."
	echo "Usage: bash mysql.sh -[option]"
	echo "List of options:"
	echo -e "\t1. create: To create tables"
	echo -e "\t2. drop: To drop tables"
	echo -e "\t3. truncate: To truncate table (session)"
	echo -e "\t4. reset: To drop and create tables"
	echo -e "\t5. remote: To login to remote MySQL (ClearDB) prompt"
	echo -e "\t6. help: To see help guide"

else
	echo "Invalid Option ..."

fi