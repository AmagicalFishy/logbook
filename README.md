# Lab Logbook 

A virtual logbook.

## Getting Started
Clone this repository into the server root. In Ubuntu, for example:

```
cd /var/www/html
sudo git clone https://github.com/AmagicalFishy/logbook
```
In Arch, the directory would be ```/srv/http```

### Prerequisites
Must have LAMP (Linux, Apache2, MySQL [MariaDB], PHP) installed and some extra packages, depending on your distro. In Ubuntu 16, one would:

```
sudo apt-get install apache2 mysql-server php libapache-mod-php sqlite php-sqlite3 php7.0-mysql
```
When installing MySQL/MariaDB, you'll probably be asked to create a root user for the database. Make sure to remember whatever password you set up.

### Setting Up
First, change the ``php.ini`` file to uncomment the lines:

``extension=pdo_mysql.so``

``extension=pdo_sqlite.so``

``extension=mysqli.so``

On Ubuntu, this is located in ``/etc/php/7.0/apache2/php.ini``
On Arch, it is located in ``/etc/php/php.ini``

I also like to set PHP to display errors. This means changing the lines in ``php.ini``:
```
display_errors = Off
```
to...
```
display_errors = On
```
Now restart Apache2: ``sudo systemctl restart apache2`` or ``sudo systemctl restart http``

Start SQL: ``sudo systemctl start mariadb.service`` or ``sudo systemctl start mysql.serivce``

Enable SQL: ``sudo systemctl enable mariadb.service`` or ``sudo systemctl enable mysql.service``

Now, go into ``/var/www/html/logbook/setup`` and run the SQL file (this sets up the appropriate databases for the logbook). The way to do this is:

```
mysql -u root -p 
source logbook.sql
```
(This is logging into MYSQL as the root user you set up earlier, then running the SQL file). If everything is successful, you should get some output like:

```

Query OK, 1 row affected (0.00 sec)

Query OK, 0 rows affected (0.00 sec)

Database changed
Query OK, 0 rows affected (0.26 sec)

Empty set (0.00 sec)

Query OK, 0 rows affected, 1 warning (0.00 sec)

Query OK, 0 rows affected (0.18 sec)
```

Now you want to set the password for your logbook. There are no users, just a single password. The default password is "lablog", but you can change it on line 11 of ``/logbook/common/info.inc``.

### Setting up logs
Once you've done all of the above, open a browser go to ``localhost/logbook``, click on the "Admin" tab, and type in the desired name of your logbook. You can add as many as you'd like. WARNING: Since this is meant to be the online version of a scientific notebook, you cannot delete logbooks unless you alter the database directly (the equivalent of ripping out pages in your notebook!) In the future, you will be able to make them inactive, but there is no deletion.

## Deployment

Contact whomever your server administrator is

## Authors

* **Javier King** - *Initial work* - [AmagicalFishy](https://github.com/AmagicalFishy)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
