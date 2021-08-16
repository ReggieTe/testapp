<?php

        define("RESPONSEAPPLICATIONPAGE", "web/dashboard/views/clients/index.php");
        $page = RESPONSEAPPLICATIONPAGE;
        $success_page = $page;
        $table = "userclient";
//Changing the table ,to validate
        $check->setTable($table);

        $clientid = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

        $app_values = array(
            "client" => array(
                "value" => $clientid,
                "error" => "Invalid client.Please try again",
                "success" => "Client account blocked successfully",
                "fault" => "Error blocking account.Please try again"
            )
        );


//****validating app name

        if ($check->data('id', $app_values['client']['value'])) {
            //Update app
            $appData = array(
                "state" => 0
            );

            $result = $client->update($table, $appData, "id='{$app_values['client']['value']}'");

            if ($result) {
                //Log Changes
                $change = new Log($client, null, $app_values['client']['value'], "client");
                $change->log(
                        array(
                            'type' => "de-activation_link_sent/" . Date::current()
                            , "description" => "De-Activation link sent to  client /" . $app_values['client']['value'] . "/ by /" . Session::get('usercodeid')
                            , 'amount' => ""
                        )
                );
                //**************************
                $newUser = new User($client);
                $newUser->setTable($table);
                $newUser->setUserid($app_values['client']['value']);
                $newUser->setRetriveDataWithEmail();
                //Send Notification Message            
                Email::sendMail("Account De-Activated", Email::custom("Account has been De-activated ,wait for further instructions from the Administrator"), $newUser->getEmail());


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
   


