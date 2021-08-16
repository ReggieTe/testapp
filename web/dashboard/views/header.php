<?php  
use TestApp\Core\Session;
use TestApp\User\User;
use TestApp\Core\Text;
use TestApp\ContentManager;
use TestApp\App\AccountType;
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
$phone = $userCurrent->getPhone();
$radius= $userCurrent->getRadius();
$location = $userCurrent->getLocation();
$type = $userCurrent->getType();
$address = $userCurrent->getAddress();  
$image = $userCurrent->getImage();
$twitter = $userCurrent->getTwitter();
$website = $userCurrent->getWebsite();
$facebook = $userCurrent->getFacebook();
$linkedin = $userCurrent->getLinkedin();
$countryCode =$userCurrent->getCountry();
$minimumBudget=$userCurrent->getMinimumAmount();
$accountTypeCode=$userCurrent->getType();
$verifyPhone= $userCurrent->getVerifyPhone();
$verifyEmail=$userCurrent->getVerify();
?>
 <style> #about-us-cover,.account-body{  height:800px; } </style>
<link href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="//onesignal.github.io/emoji-picker/lib/css/emoji.css" rel="stylesheet">
<link href="<?= URL ?>public/assets/backend/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />          
<link href="<?= URL ?>public/assets/backend/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="<?= URL ?>public/assets/backend/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="<?=URL?>public/assets/css/chat.css" rel="stylesheet">
<link href="<?=URL?>public/assets/css/app.css" rel="stylesheet">


