<?php
namespace TestApp\App;

class Check {

    private $client;
    private $table;
    private $uniqueIdentifer;
            
    function __construct($client,$table="") {
        $this->client=$client;
        $this->table= $table;
        $this->uniqueIdentifer="";
    }

  
    
    public function setUniqueIdentifer($uniqueIdentifer="id=0") {
        
        $this->uniqueIdentifer= $uniqueIdentifer!=""?" AND ".$uniqueIdentifer:"";
    }

    public function data($name, $value) {
        $count = 0;
        $result = $this->client->select("Select * from $this->table where $name=:$name $this->uniqueIdentifer", array(":$name" => $value));
        return count($result) > 0 ? true : false;
    }


    public function data1($name, $value) {
        $count = 0;

        $result = $this->client->select("Select * from $this->table where $name=:$name $this->_uniqueIdentifer", array(":$name" => $value));
        echo $result;
        foreach ($result as $key => $value) {
            $count++;
        }

        return $count > 0 ? true : false;
    }

}
