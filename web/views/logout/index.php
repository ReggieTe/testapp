<?php
use TestApp\Core\Session; 
$session = new Session();
$session->destroy();
$message="Logged out successfully";
include_once 'web/views/home/index.php';
include_once 'web/views/footer.php'; 
exit();
?>

