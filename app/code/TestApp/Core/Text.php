<?php
namespace TestApp\Core;
/**
 * Description of textFormatter
 *
 * @author Reggie Te
 */
class Text {

    public function __construct() {
      
     
    }

    public  function notification($message = null, $type = 'alert-danger') {
        if (isset($message)) {
            print('<div class="col-md-12"> <div class="alert ' . $type . ' col-md-12"> 
               <a href="#" class="close" data-dismiss="alert"> &times; </a>
                 ' . $message . ' </div></div>');
        }
    }

    public  function cleanse($data=null) {
     
        return htmlspecialchars(stripslashes(trim($data)));   
    }

    public  function clean($word = null, $replace = "../../", $with = "") {
        return str_replace($replace, $with, $word);
    }

    public  function notify($link = '#', $favicon = "ion ion-ios7-people info", $text = "5 new members joined today") {

        return'<li><a href="' . $link . '"> <i class="' . $favicon . '"></i>' . $text . '</a><li>';
    }

    public  function status($status = 0, $conditionToBeMet = 1, $success = true, $failed = FALSE) {
        return $status == $conditionToBeMet ? $success : $failed;
    }

    public  function link($displayText = '', $textRedirectLink = null) {
        return !empty($displayText) ? '<a href="' . $textRedirectLink . '"> ' . $displayText . ' </a>' : $displayText;
    }

    public  function convertArrayToString($array = array()) {
        return !empty($array) ? implode(",", $array) : '';
    }

    public  function convertStringToArray($string, $delimiter = ",") {
        return !empty($string) ? explode($delimiter, $string) : array('0', '1');
    }

    public  function description($word = null, $maxWords = 25) {
        return empty($word) ? "No description Available" : substr($word, 0, $maxWords);
    }

    public  function keyGen($numberOfLetter = 4, $numberofDigits = 8, $encrpty = true) {  //Random code generator
        $code = null;
        $lettersAphl = array("a", "b", "c", "d", "e", "f", "g", "h", "j", "k", "l", "n", "m", "i", "o", "p", "q", "w", "r", "t", "y", "u", "s", "z", "x");
        $numbers = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $letters = array();
        $digits = array();

        for ($index = 0; $index < $numberOfLetter; $index++) {
            array_push($letters, $lettersAphl[rand(0, 24)]);
        }
        for ($index = 0; $index < $numberofDigits; $index++) {
            array_push($digits, $numbers[rand(0, 9)]);
        }
        $digitPiece = trim(implode("", $digits));
        $letterPiece = trim(implode("", $letters));
        $code = $letterPiece . $digitPiece;
        if ($encrpty) {
            $code = substr(md5($code), 0, 20);
        }



        return $code;
    }

    public  function length($word = null, $max = 8) {

        return strlen($word) > $max ? true : false;
    }

    public  function match($word = null, $word1 = null, $length = 8) {
        return strncasecmp($word, $word1, $length) == 0 ? true : false;
    }

    //Create Accounnt Number
    public  function keyGenUsingWords($stringOfLetters = null, $stringOfNumbers = null, $maxLetters = 3, $maxNumbers = 3) {

        $accountCode = substr($stringOfLetters, 0, $maxLetters) . substr($stringOfNumbers, 0, $maxNumbers);
        ;

        return $accountCode;
    }

    public function selectListOptions ($options,$filterIdString,$defaultMessage="Select Option")
      {
        $list="";
        $filterIds = array_filter(explode(",",$filterIdString), function($a) {return $a !== "";});

        if(count($filterIds)==0){
            $list= "<option value='' selected>$defaultMessage</option>";
        } 
        
            foreach ($options as $key => $option) {                
                 if (in_array($key,$filterIds)) {               
                         $list = $list."<option value='$key' selected >$option</option>";                    
                 }
                else
                { 
                        $list = $list."<option value='$key'>$option</option>";
                    
                  
                }
            }
        

         

         return $list;   
      }

      public function selectListOption ($options=array(),$filter=array(),$defaultMessage="Select Option")
      {
        $list="";
            foreach ($options as $key => $option) {                
                 if (!in_array($key,$filter))
                { 
                        $list = $list."<option value='$key'>$option</option>";                  
                }
            }
         return $list;   
      }

      public function selectListOptionsUsingObject ($objects,$filterId,$defaultMessage="")
      {
          $list =array();
         foreach ($objects as $key => $option) {
            $list[$option['id']]=$option['name'];
         }  
         return $this->selectListOptions($list,$filterId,$defaultMessage);   
      }

      public function selectListOptionsUsingTrade ($objects,$filter=array())
      {
          $list =array();
         foreach ($objects as $key => $option) {
            $list[$option['id']]=$option['name'];
         }  

         $filters=array();
         foreach($filter as $tradeItem){ 
            array_push($filters,$tradeItem['id']);
         }
         var_dump($filters);

         return $this->selectListOption($list,$filters);   
      }

      public function getLocationInfoByIp($session=null){
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = @$_SERVER['REMOTE_ADDR'];
            $result  = array('country'=>'', 'city'=>'');

            if(filter_var($client, FILTER_VALIDATE_IP)){
                $ip = $client;
            }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
                $ip = $forward;
            }else{
                $ip = $remote;
            }
            if(!$session->get("global")??false){
                $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
                if($ip_data && $ip_data->geoplugin_countryName != null){
                    $result['country'] = $ip_data->geoplugin_countryCode;
                    $result['city'] = $ip_data->geoplugin_city;
                    $result['ip']= $ip_data->geoplugin_request;
                    $result["region"]= $ip_data->geoplugin_region;
                    $result["regionCode"]= $ip_data->geoplugin_regionCode;
                    $result["regionName"]= $ip_data->geoplugin_regionName;
                    $result["areaCode"]= $ip_data->geoplugin_areaCode;
                    $result["dmaCode"]= $ip_data->geoplugin_dmaCode;
                    $result["countryCode"]= $ip_data->geoplugin_countryCode;
                    $result["countryName"]= $ip_data->geoplugin_countryName;
                    $result["continentCode"]= $ip_data->geoplugin_continentCode;
                    $result["continentName"]= $ip_data->geoplugin_continentName;
                    $result["latitude"]= $ip_data->geoplugin_latitude;
                    $result["longitude"]= $ip_data->geoplugin_longitude;
                    $result["locationAccuracyRadius"]= $ip_data->geoplugin_locationAccuracyRadius;
                    $result["timezone"]= $ip_data->geoplugin_timezone;
                    $result["currencyCode"]= $ip_data->geoplugin_currencyCode;
                    $result["currencySymbol"]= $ip_data->geoplugin_currencySymbol;
                    $result["currencyConverter"]= $ip_data->geoplugin_currencyConverter;

                    $session->set("global",true);
                    $session->set("country",$result["countryCode"]);
                    $session->set("latitude",$result["latitude"]);
                    $session->set("longitude",$result["longitude"]);
                    $session->set("currencyCode",$result["currencyCode"]);
                    $session->set("city",$result["city"]);

            }
        }
    }

    public function generateSignature($data, $passPhrase = null) {
        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5( $getString );
    }

    public function prepareNumber($countryCode,$phoneNumber)
    {
        $firstDigit = substr($phoneNumber,0,0);
        $remainingDigits = substr($phoneNumber,1);
        $firstSymbol = substr($countryCode,0,0);
        if($firstDigit==0)
        {
            if($firstSymbol!="+")
            {
                return "+".$countryCode.$remainingDigits;
            }            
            return $countryCode.$remainingDigits;
        }
        return $phoneNumber;
    }

     

}
