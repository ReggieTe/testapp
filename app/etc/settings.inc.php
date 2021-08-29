<?php
define('SITE_MODE', "prod"); 
define('SITE_PATH', "app");
define('SITE_VERSION', "1");
define('SITE_NAME', "GVI App");
define('SITE_NUMBER', "+27 (0) 61054 9027");
define('EWALLET_NUMBER',"0610549027");
define('PAYPAL_EMAIL',"tembachakoregis@gmail.co.za");
define('SITE_EMAIL', "hello@testapp.co.za");
define('SITE_EMAIL_BUG_REPORT', "bugs@testapp.co.za");
define('SITE_LOCATION', "Cape Town ,South Africa");
define('SITE_COUNTRY', "South Africa");
define('SITE_FACEBOOK',"");
define('SITE_LINKEDIN',"");
define('SITE_TWITTER',"");
//Server
define('URL', "http://localhost/gviApp/");
define('SUBDIR',"/testapp");   
define("SERVER_DCUMENT_ROOT",$_SERVER['DOCUMENT_ROOT']);
define('RELATIVEFILEPATH',$_SERVER['DOCUMENT_ROOT']."/"); 
define('USER_DEFAULT_IMAGE',"public/assets/image/user.png");
//local storage 
define('DB_HOST',"localhost");                        
define('DB_USER',"root");                  
define('DB_PASS',"");                     
define('DB_NAME',"testapp"); 

define("PROJECTS",array(
"wildlife-conservation"=>"Wildlife Conservation",
"womens-empowerment"=>"Women’s empowerment",
"health-care"=>"Health care",
"sports-and-surfing"=>"Sports and surfing",
));

$hoursSpent=array();
for($i=1;$i<24;$i++){
    $hoursSpent[$i]="$i";
}

define("HOURSPENT",$hoursSpent);