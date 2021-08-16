<?php
use TestApp\Core\Response;
use TestApp\User\Record\Person as Person;
use TestApp\Core\Validation;
use TestApp\Core\Text;
use TestApp\Core\Session;

define("RESPONSEAPPLICATIONPAGE", "views/list/index.php");
        
$validation = new Validation();
$response = new Response();
$session = new Session();
$text = new Text();

$id = $session->get('usercodeid');
$result = array("error" => true);
$mode= filter_var(@$_POST['mode'], FILTER_SANITIZE_STRING);
$mode = isset($mode)?$mode:"site";
       
        $currentId = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
        $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $age = trim(filter_var($_POST['age'], FILTER_SANITIZE_STRING));
        $gender = trim(filter_var($_POST['gender'], FILTER_SANITIZE_STRING));

        $build = trim(filter_var($_POST['build'], FILTER_SANITIZE_STRING));
        $height = trim(filter_var($_POST['height'], FILTER_SANITIZE_STRING));
        $eyes = trim(filter_var($_POST['eyes'], FILTER_SANITIZE_STRING));
        $weight = trim(filter_var($_POST['weight'], FILTER_SANITIZE_STRING));
        $hair = trim(filter_var($_POST['hair'], FILTER_SANITIZE_STRING));

        $stationTelephone= trim(filter_var($_POST['station_telephone'], FILTER_SANITIZE_STRING));
        $investigationOfficer= trim(filter_var($_POST['investigating_officer'], FILTER_SANITIZE_STRING));
        $contactNumber= trim(filter_var($_POST['contact_number'], FILTER_SANITIZE_STRING));
        $email= trim(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
        $source= trim(filter_var($_POST['source'], FILTER_SANITIZE_STRING)); 
        $caseNumber = trim(filter_var($_POST['casenumber'], FILTER_SANITIZE_STRING)); 

        $lastseenlocation = trim(filter_var($_POST['lastseenlocation'], FILTER_SANITIZE_STRING));
        $lastseenondate = trim(filter_var($_POST['lastseendate'], FILTER_SANITIZE_STRING));
        $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));        
        $reward = trim(filter_var($_POST['reward'], FILTER_SANITIZE_STRING));
        $state = trim(filter_var($_POST['state'], FILTER_SANITIZE_STRING));

        $user_variables = array(            
            "name" => array(
                "value" => $name,
                "error" => "name required.Please try again",
                "invalid" => "invalid name.Please try again",
                "pattern" => "/^[A-Za-z ]{2,60}$/",
                "exist"=>"Name already logged.Please try again",
                "check" =>true),
            "age" => array(
                "value" => $age,
                "error" => "age required.Please try again",
                "invalid" => "invalid age.Please try again",
                "pattern" => "/^[0-9]{2,60}$/",
                "check" =>false
            ),  
            "gender" => array(
                "value" => $gender,
                "error" => "gender required.Please try again",
                "invalid" => "invalid gender.Please try again",
                "pattern" => "/^[0-9]{1,2}$/",
                "check" =>true
            ),
            "build" => array(
                "value" => $build,
                "error" => "Build required.Please try again",
                "invalid" => "invalid build.Please try again",
                "pattern" => "/^[0-9A-Za-z]{1,60}$/",
                "check" =>false
            ),            
            "case_number" => array(
                "value" => $caseNumber,
                "error" => "Case number required.Please try again",
                "invalid" => "invalid case number.Please try again",
                "pattern" => "/^[0-9A-Za-z,.\\/' ]{1,60}$/",
                "check" =>false
            ),
            "height" => array(
                "value" => $height,
                "error" => "height required.Please try again",
                "invalid" => "invalid height.Please try again",
                "pattern" => "/^[0-9A-Za-z]{1,10}$/",
                "check" =>false
            ),
            "eyes" => array(
                "value" => $eyes,
                "error" => "Eyes required.Please try again",
                "invalid" => "invalid eyes.Please try again",
                "pattern" => "/^[0-9A-Za-z]{1,60}$/",
                "check" =>false
            ),
            "weight" => array(
                "value" => $weight,
                "error" => "weight required.Please try again",
                "invalid" => "invalid weight.Please try again",
                "pattern" => "/^[0-9]{1,2}$/",
                "check" =>false
            ),
            "hair" => array(
                "value" => $hair,
                "error" => "hair required.Please try again",
                "invalid" => "invalid hair.Please try again",
                "pattern" => "/^[0-9A-Za-z]{1,60}$/",
                "check" =>false
            ),
            "data_source" => array(
                "value" => $source,
                "error" => "Data source required.Please try again",
                "invalid" => "invalid data source.Please try again",
                "pattern" => "/^[0-9A-Za-z,.\\/':?_= ]{1,100}$/",
                "check" =>false
            ),"station_telephone" => array(
                "value" => $stationTelephone,
                "error" => "Station Telephone required.Please try again",
                "invalid" => "invalid station telephone.Please try again",
                "pattern" => "/^[0-9,.\\/' ]{1,60}$/",
                "check" =>false
            ),
            "investigating_officer" => array(
                "value" => $investigationOfficer,
                "error" => "Investigating Officer required.Please try again",
                "invalid" => "invalid Investigating Officer.Please try again",
                "pattern" => "/^[0-9A-Za-z,.\\/' ]{1,60}$/",
                "check" =>false
            ),
            "contact_number" => array(
                "value" => $contactNumber,
                "error" => "Contact Number required.Please try again",
                "invalid" => "invalid Contact Number.Please try again",
                "pattern" => "/^[0-9]{1,60}$/",
                "check" =>false
            ),
            "email" => array(
                "value" => $email,
                "error" => "Case number required.Please try again",
                "invalid" => "invalid case number.Please try again",
                "pattern" => "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/",
                "check" =>false
            ),
            "last_seen_date" => array(
                "value" => $lastseenondate,
                "error" => "last seen date required.Please try again",
                "invalid" => "invalid last seen date.Please try again",
                "pattern" => "/^[\\/+0-9-]{1,60}$/",
                "check" =>true),
                
            "description" => array(
                "value" => $description,
                "error" => "description required.Please try again",
                "invalid" => "invalid description.Please try again",
                "pattern" => "/^[\\/A-Za-z0-9.,';: ]{2,1000}$/",
                "check" =>true
            ),
            "last_seen_location" => array(
                "value" => $lastseenlocation,
                "error" => "last seen location required.Please try again",
                "invalid" => "invalid last seen location.Please try again",
                "pattern" => "/^[A-Za-z0-9 ]{8,60}$/",
                "check" =>true
                ),           
            "reward" => array(
                "value" => $reward,
                "error" => "Reward required.Please try again",
                "invalid" => "invalid reward.Please try again",
                "pattern" => "/^[0-9.]{1,60}$/",
                "check" =>false
                ),  
            "state" => array(
                    "value" => $state,
                    "error" => "List state required.Please try again",
                    "invalid" => "invalid state.Please try again",
                    "pattern" => "/^[0-9]{1,2}$/",
                    "check" =>true)
        );
               
        foreach($user_variables as $key => $variable)
        {
            if($variable['check']?true:(!empty($variable['value'])? true:false))
            {
                if (!$validation->validate($variable['value'],$variable['pattern'])) {
                    $result = array("error"=>true ,"reset"=>true ,"message"=> $variable['invalid']);
                    $mode=="app"? $response->app($result): $response->site($result['message'],RESPONSEAPPLICATIONPAGE); 
                } 
            }     
        }

    $person = new Person($currentId);
    $result = ($person->update($user_variables))? array("error"=>false ,"reset"=>false ,"redirect"=>URL."dashboard/listmissingperson/$currentId"  ,"message"=> "Account Update Successful"): array("error"=>true ,"reset"=>true ,"message"=> "Account Update failed.Please try again");
    $mode=="app"? $response->app($result): $response->site($result['message'],RESPONSEAPPLICATIONPAGE);