CREATE DATABASE logbook;
GRANT ALL ON logbook.* TO logbook@localhost IDENTIFIED BY 'logbook';
USE logbook;

CREATE TABLE contacts (
    name_id mediumint(5) NOT NULL AUTO_INCREMENT, 
    name varchar(25) DEFAULT NULL,
	email varchar(40) DEFAULT NULL,
	email2 varchar(40) DEFAULT NULL,
	phone varchar(20) DEFAULT NULL,
	phone2 varchar(20) DEFAULT NULL,
    PRIMARY KEY (name_id)
) ENGINE=InnoDb DEFAULT CHARACTER SET=latin1;

SHOW WARNINGS;

/*Logbook Name Table*/
DROP TABLE IF EXISTS titles;
CREATE TABLE logbooks (
    title varchar(25) DEFAULT NULL,
    table_name varchar(25),
    active boolean DEFAULT true, 
    PRIMARY KEY (table_name)
) ENGINE=InnoDb AUTO_INCREMENT=0 DEFAULT CHARACTER SET=latin1;


