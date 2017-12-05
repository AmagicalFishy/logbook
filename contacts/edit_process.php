<html>
<body>
<?php
include "../common/info.inc";
$connection = new PDO("mysql:host=localhost;dbname=logbook", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Processing...";

// Array of forms that take change-info
$change_array = array(
    "1" => "name_change",
    "2" => "email_change",
    "3" => "email2_change",
    "4" => "phone_change",
    "5" => "phone2_change"
);

// Array of info
$column_array = array(
    "1" => "name",
    "2" => "email",
    "3" => "email2",
    "4" => "phone",
    "5" => "phone2"
);

// Go through each entry in each array and change the appropriate
// database entry
for ($i = 1; $i <= 5; $i++) {
    
    if (!empty($_POST[ $change_array[$i]])) {
        $column_name = $column_array[$i];
        $change_val = $_POST[$change_array[$i]];
        $id = $_POST["name_id_ref"];
        $perform_edit = $connection->prepare("UPDATE contacts SET $column_name = :column_value WHERE name_id = :name_id");
        $perform_edit->bindParam(":column_value", $change_val, PDO::PARAM_STR);
        $perform_edit->bindParam(":name_id", $id, PDO::PARAM_INT);
        $perform_edit->execute();
        }
}

header("Location: /logbook/index.php?page=contacts");
?>
</body>
</html>
