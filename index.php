<html>
<head>
<title>Daily Logbook</title>
<link rel="stylesheet" href="/logbook/common/style.css">
<link rel="icon" href="/logbook/favicon.ico">
</head>

<body>

<?php
require __DIR__ . '/common/info.inc';
require __DIR__ . '/common/navigation.php';

switch ((isset($_GET['page']) ? $_GET['page'] : 'home')) {
    case 'home':            require __DIR__ . '/home/home.php'; break;
    case 'contacts':        require __DIR__ . '/contacts/contacts.php'; break;
    case 'add_contact':     require __DIR__ . '/contacts/action_process.php'; break;
    case 'edit_contact':    require __DIR__ . '/contacts/edit_contact.php'; break;
    case 'contact_action':  require __DIR__ . '/contacts/edit_process.php'; break;
    case 'admin':           require __DIR__ . '/admin/admintab.php'; break;
    case 'adminfunctions':  require __DIR__ . '/admin/adminfunctions.php'; break; 
    case 'logbook_info':    require __DIR__ . '/admin/logbook_info.php'; break;

    default:                require __DIR__ . '/home/home.php'; break;
}
?>

</body>
</html>
