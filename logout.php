<?php require('includes/config.php');
//l
//logout
$user->logout(); 

//logged in return to index page
header('Location: index.php');
exit;
?>