<?php
use TestApp\Core\Response;
use TestApp\User\User;
use TestApp\Core\Session; 

define("FAILED_TO_DELETE_PAGE", "web/dashboard/views/close/index.php");        

$response = new Response();
$user = new User();
$session = new Session();

$result = array("error" => true);
$mode= filter_var(@$_POST['mode'], FILTER_SANITIZE_STRING);
$mode = isset($mode)?$mode:"site";
       
if($user->delete())
{
    $result = array("error"=>false ,"reset"=>false  ,"message"=> "Account delete successfully");
    //redirect to home
    $session->destroy();
    echo '<script>  window.location.href="' . URL .'/signup";  </script>';
}
else{
    $result = array("error"=>true ,"reset"=>true ,"message"=> "Account deleting failed.Please try again");
}
 
       
$mode=="app"? $response->app($result): $response->site($result['message'],FAILED_TO_DELETE_PAGE);
        