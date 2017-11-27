<html>
<body>
<?php

// SQL connection, drawing from things the user inputs into the forms
$connection = new PDO($dbinfo, $username, $password);

// Create New Logbook
$new_logbook_title = $_POST['new_logbook'];
$new_table_name = 'posts_' . preg_replace('/\s+/', '', strtolower($new_logbook_title));
$active = 1;

$query_text = 'CREATE TABLE ' . $new_table_name . ' (
    time timestamp NOT NULL DEFAULT NOW(),
    username varchar(25) DEFAULT NULL,
    message text,
    crossout tinyint(1) NOT NULL DEFAULT "0",
    post_id mediumint(9) NOT NULL AUTO_INCREMENT,
    filenames text DEFAULT NULL,
    PRIMARY KEY (post_id)
    ) ENGINE=InnoDb AUTO_INCREMENT=0 DEFAULT CHARACTER SET=latin1;';

$query = $connection->prepare($query_text);
$query->execute();

$query_text = 'INSERT INTO logbooks (title, table_name, active)
    VALUES(:title, :table_name, :active)';
$query = $connection->prepare($query_text);
$query->bindParam(':table_name', $new_table_name);
$query->bindParam(':title', $new_logbook_title);
$query->bindParam(':active', $active);
$query->execute();

mkdir(__DIR__ . '/../main/daily_log/uploads/' . $new_table_name);
header("Location: /logbook/index.php?page=admin")

?>
</body>
</html>
