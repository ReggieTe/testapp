<?php
use TestApp\Core\Response;
use TestApp\User\Record\Person as Person;
use TestApp\Core\Validation;
use TestApp\Core\Text;
use TestApp\Core\Session;
use TestApp\App\Email;

define("RESPONSEAPPLICATIONPAGE", "views/add/index.php");        
$validation = new Validation();
$response = new Response();
$person = new Person();
$session = new Session();
$text = new Text();




$response = new Response();
$validation = new Validation();
$text = new Text();
$emailObj = new Email();

$id = $session->get('usercodeid');
$result = array("error" => true);
$mode= filter_var($_POST['mode']??"site", FILTER_SANITIZE_STRING);       
        $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $surname = trim(filter_var($_POST['surname'], FILTER_SANITIZE_STRING));
        $natid = trim(filter_var($_POST['natid'], FILTER_SANITIZE_STRING));
        $phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_STRING));
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
        $dob = trim(filter_var($_POST['dob'], FILTER_SANITIZE_STRING));
        $language = trim(filter_var($_POST['language'], FILTER_SANITIZE_STRING)); 
        $interests = SortInterests($_POST['interests']);
     

        $user_variables = array(            
            "name" => array(
                "value" => $name,
                "error" => "name required.Please try again",
                "invalid" => "invalid name.Please try again",
                "pattern" => "/^[A-Za-z]{2,60}$/",
                "exist"=>"Name already logged.Please try again",
                "check" =>true),
            "surname" => array(
                "value" => $surname,
                "error" => "surname required.Please try again",
                "invalid" => "invalid surname.Please try again",
                "pattern" => "/^[A-Za-z]{2,60}$/",
                "check" =>false ),  
            "natid" => array(
                "value" => $natid,
                "error" => "National id required.Please try again",
                "invalid" => "invalid National id.Please try again",
                "pattern" => "/^[0-9]{1,30}$/",
                "check" =>true),
            "phone" => array(
                "value" => $phone,
                "error" => "Phone required.Please try again",
                "invalid" => "invalid phone.Please try again",
                "pattern" => "/^[0-9]{1,15}$/",
                "check" =>false ),
            

            "email" => array(
                "value" => $email,
                "error" => "email required.Please try again",
                "invalid" => "invalid email.Please try again",
                "pattern" => "/^[0-9A-Za-z@.]{1,100}$/",
                "check" =>false),
            "dob" => array(
                "value" => $dob,
                "error" => "Dob required.Please try again",
                "invalid" => "invalid dob.Please try again",
                "pattern" => "/^[0-9\/-]{1,60}$/",
                "check" =>false),
            "language" => array(
                "value" => $language,
                "error" => "language required.Please try again",
                "invalid" => "invalid language.Please try again",
                "pattern" => "/^[A-Z0-9a-z]{1,20}$/",
                "check" =>false),
            "interests" => array(
                "value" => $interests,
                "error" => "interests required.Please try again",
                "invalid" => "invalid interests.Please try again",
                "pattern" => "/^[0-9A-Za-z,]{1,60}$/",
                "check" =>false),            
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
        $newId = $text->keyGen();
        $user_variables['id']=array("value"=>$newId); 
        $user_variables['addedby'] = array("value"=>$id); 
        $result = ($person->create($user_variables))? array("error"=>false ,"reset"=>false ,"redirect"=>URL."dashboard/home"  ,"message"=> "Person added successful"): array("error"=>true ,"reset"=>true ,"message"=> "Account Update failed.Please try again");
       
        if(!$result['error']){
            $emailObj->sendMail("Account Created", "This email is to notify you that account has been created on ".SITE_NAME, $email) ;
        }
        $mode=="app"? $response->app($result): $response->site($result['message'],RESPONSEAPPLICATIONPAGE);
        
        function SortInterests($interests = array()){
            $interestBag = array();
            foreach ($interests as $interest) {
                array_push($interestBag, $interest);
            }
            return implode(",", $interestBag);
        };