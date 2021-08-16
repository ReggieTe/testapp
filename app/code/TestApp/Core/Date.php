<?php 
namespace TestApp\Core;
use \DateTime;
/**
 * Description of Date
 *
 * @author Reggie Te
 */
class Date {

     public  function current() {
        return date("y-m-d h:i:sa");
    }
    
     public  function today() {
        return date("y-m-d");
    }

    public function diff($from,$to){
        $origin = new DateTime($from);
        $target = new DateTime($to);
        $interval = $origin->diff($target);
        return $interval->format('%a');
    }

    
    // Will return the number of days between the two dates passed in
    public function countDays($userDate="") { 
    $userDate = ($userDate=="")?$this->today:$userDate;
    $origin = new DateTime($this->today());
    $target = new DateTime($userDate);
    $interval = $origin->diff($target);
    return $interval->format('%a');
    } 
    
    public function diffTime($date,$mode="minutes"){
        $start_date = new DateTime($date);
        $since_start = $start_date->diff(new DateTime($this->current()));
        $values = array(    
            "years"=>$since_start->y,
            "months"=>$since_start->m,
            "days"=>$since_start->d,
            "hours"=>$since_start->h,
            "minutes"=>$since_start->i,
            "secounds"=>$since_start->s,
        );
        return in_array($mode,$values)? $values[$mode]:false;
    }

    public function format($date) 
    {  
        $origin = new DateTime($date);
        return $origin->format('%a'); 
    }
 

}
