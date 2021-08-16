<?php

        define("RESPONSEAPPLICATIONPAGE", "web/dashboard/views/clients/index.php");
        $page = RESPONSEAPPLICATIONPAGE;
        $success_page = $page;
        $table = "userclient";
//Changing the table ,to validate
        $check->setTable($table);

        $clientId = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

        $app_values = array(
            "client" => array(
                "value" => $clientId,
                "error" => "Invalid admin.Please try again",
                "success" => "Password reset link sent successfully",
                "fault" => "Error Sending Password reset link.Please try again"
            )
        );


//****validating app name

        if ($check->data('id', $app_values['client']['value'])) {
              //Log Changes
    $change=new Log($client,null,$app_values['client']['value'], "client");
    $change->log(
            array(
                'type'=>"Account_activation_link_sent/".Date::current()
                ,"description"=>"Account Activation link sent to  client /".$app_values['client']['value']."/ by /".Session::get('usercodeid')
                ,'amount'=>""
                )
            );
    //**************************
            //Update app
                     $passwordResetLinkRequester=new User($client);
                     $passwordResetLinkRequester->setUserid($app_values['client']['value']);
                     $passwordResetLinkRequester->setTable($table);
                     $passwordResetLinkRequester->setRetriveDataWithEmail();//
                     
                     $userEmail=$passwordResetLinkRequester->getEmail();
                     $userSalt=$passwordResetLinkRequester->getSalt();
                      
                    $resetlink = URL . "admin/authorize/password/new/".Hash::create($userEmail, $userSalt);
             
            $result =  Email::sendMail("Requested: Account Password Reset Link",Email::resetPassword($resetlink), $userEmail);

            if ($result) {

                $message = $app_values['client']['success'];
                include_once $success_page;
                include 'views/footer.php';
                exit();
            } else {
                $message = $app_values['client']['error'];
                require $page;
                include 'views/footer.php';
                exit();
            }
        } else {
            $message = $app_values['client']['fault'];
            require $page;
            include 'views/footer.php';
            exit();
        }
        /*         * **end name validation********** */

        break;
  

