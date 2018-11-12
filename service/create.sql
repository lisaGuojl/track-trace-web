CREATE TABLE login(
	username varchar(40) NOT NULL,
	password varchar(100) NOT NULL,
	role smallint(3) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY(username)
);
 
CREATE TABLE session(
	id int(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
	username varchar(40) NOT NULL,
	auth_key char(32) NOT NULL,
	PRIMARY KEY(id)
);