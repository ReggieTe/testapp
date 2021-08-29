<?php
use TestApp\Core\Response;
use TestApp\User\Record\Timesheet;
use TestApp\Core\Validation;
use TestApp\Core\Text;
use TestApp\Core\Session;

define("VIEW_PAGE", "views/list/index.php");
        
$validation = new Validation();
$response = new Response();
$session = new Session();
$text = new Text();

$id = $session->get('usercodeid');
$result = array("error" => true);
$mode= filter_var($_POST['mode']??"site", FILTER_SANITIZE_STRING);  
$currentId = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
$projectid = trim(filter_var($_POST['project'], FILTER_SANITIZE_STRING));
$hours = trim(filter_var($_POST['hours'], FILTER_SANITIZE_STRING));
$date = trim(filter_var($_POST['date'], FILTER_SANITIZE_STRING));
$description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
     

        $user_variables = array(  
            "project_id" => array(
                "value" => $projectid,
                "error" => "projectid required.Please try again",
                "invalid" => "invalid projectid.Please try again",
                "pattern" => "/^[A-Za-z-]{2,60}$/",
                "check" =>false ),  
            "hours_spent" => array(
                "value" => $hours,
                "error" => "Hours spent required.Please try again",
                "invalid" => "invalid hours spent.Please try again",
                "pattern" => "/^[0-9]{1,30}$/",
                "check" =>true),
            "date" => array(
                "value" => $date,
                "error" => "Date required.Please try again",
                "invalid" => "invalid date.Please try again",
                "pattern" => "/^[0-9\/-]{1,15}$/",
                "check" =>false ),
            

            "description" => array(
                "value" => $description,
                "error" => "description required.Please try again",
                "invalid" => "invalid description.Please try again",
                "pattern" => "/^[0-9A-Za-z@.,'\-&#; ]{1,1000}$/",
                "check" =>false),                     
        );
               
        foreach($user_variables as $key => $variable)
        {
            if($variable['check']?true:(!empty($variable['value'])? true:false))
            {
                if (!$validation->validate($variable['value'],$variable['pattern'])) {
                    $result = array("error"=>true ,"reset"=>true ,"message"=> $variable['invalid']);
                    $mode=="app"? $response->app($result): $response->site($result['message'],VIEW_PAGE); 
                } 
            }     
        }

    $person = new Timesheet($currentId);
    $result = ($person->update($user_variables))? array("error"=>false ,"reset"=>false ,"redirect"=>URL."dashboard/add/update/$currentId"  ,"message"=> "Time sheet Update Successful"): array("error"=>true ,"reset"=>true ,"message"=> "Time sheet Update failed.Please try again");
    $mode=="app"? $response->app($result): $response->site($result['message'],VIEW_PAGE);