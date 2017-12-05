<html>
<body>
<?php
// SQL connection, drawing from things the user inputs into the forms
$connection = new PDO($dbinfo, $username, $password);
$add_user = $_POST["add_user"];
$entered_name = $_POST["entered_name"];
$perform_add_user = $connection->prepare("INSERT INTO contacts (name) VALUE(:name)");
$perform_delete_user = $connection->prepare("DELETE FROM contacts WHERE name = :name");

// Add or delete user depending on what option is selected
if (!empty($_POST["entered_name"]) == 1) {
    if ($add_user == 1) {
        $perform_add_user->bindParam(":name", $entered_name, PDO::PARAM_STR);
        $perform_add_user->execute();
    }
    else if ($add_user == 0) {
        $perform_delete_user->bindParam(":name", $entered_name, PDO::PARAM_STR);
        $perform_delete_user->execute();
    }
}

header("Location: /logbook/index.php?page=contacts");
?>
</body>
</html>
