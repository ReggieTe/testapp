<?php  
use TestApp\Core\Session;
use TestApp\User\User;
use TestApp\Core\Text;
use TestApp\ContentManager;
use TestApp\Core\Validation;
use TestApp\Core\Response;

$text = new Text();
$session = new Session();
$contentManager = new ContentManager();    
$userCurrent = new User();
$validate = new Validation();
$response = new Response();

include "../views/header.php"; 
$username = $userCurrent->getUsername();
$firstname = $userCurrent->getFirstname();
$surname = $userCurrent->getSurname();
$email = $userCurrent->getEmail();
?>
