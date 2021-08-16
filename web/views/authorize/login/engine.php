<?php
use TestApp\Core\Hash;
use TestApp\Core\Response;
use TestApp\User\Login;

$response = new Response();
$hash = new Hash();
/* pages */
define("LOGIN_SUCCESS_PAGE", "web/views/redirect/index.php");
define("LOGIN_PAGE", "web/views/home/index.php");
$result = array("error" => true);
$mode="site";
$page = LOGIN_PAGE;


//Cleaning user input
$email= trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$password=trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));  

if (empty($email) || empty($password)) {    
    $result = array("error"=>false ,"message"=> "Invalid details.Please try again");
    $mode=="app"? $response->app($result): $response->site($result['message'],LOGIN_PAGE); 
}

//attempt login 
//get user details using email

$login = new Login($email);
$hashedPassword = $hash->create($password, $login->getSalt());
     
if ($login->login($email,$hashedPassword)) {
    $result = array("error"=>false ,"message"=> "Success");
    $page = LOGIN_SUCCESS_PAGE;
 } else {
    $result = array("error"=>true ,"message"=> "Invalid details.Please try again");
    $page = LOGIN_PAGE;
}
$mode=="app"? $response->app($result): $response->site($result['message'],$page); 


 
                  