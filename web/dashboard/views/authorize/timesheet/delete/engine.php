<?php
use TestApp\Core\Response; 
use TestApp\Core\File;
use TestApp\Core\Session;
use TestApp\User\Record\Timesheet;
define("DELETE_PAGE", "web/dashboard/views/add/index.php");
$file = new File();
$session = new Session();
$response = new Response();
$id= filter_var($_GET['id']??null, FILTER_SANITIZE_STRING);
$addedby = $session->get('usercodeid');
$person = new Timesheet($id);   
 if($person->delete()){
    $result =array("error"=>false ,"reset"=>false  ,"message"=> "Delete record successfully");
 }else
 {
    $result =array("error"=>true ,"reset"=>true ,"message"=> "Failed deleting record.Please try again");
 }
 $response->site($result['message'],DELETE_PAGE);
        