<?php
namespace TestApp\User\Record;
use TestApp\Core\Database;
use TestApp\Core\Date;
/**
 * Description of Person
 *
 * @author Reggie Te
 */
class  Timesheet{

    private $id;
    private $addedBy;
    private $projectId;
    private $hoursSpent;
    private $date;
    private $description;

    private $client; 
    private $systemDate; 
    private $table;

    public function __construct($id=null) {
        $this->table ="project_timesheet";        
        $this->client = new Database($this->table);
        $this->systemDate = new Date();
        $this->id = $id;
        $this->id!=null?$this->setUser():'';  
    }
 
    public function getAllData($keys="*") {      
        $result = $this->client->select("select $keys from $this->table");        
        return count($result)!= 0 ? $result:array();
    }
   
    public function get($key="") {      
        $result = $this->client->select("select * from $this->table where addedby='$key'");        
        return count($result)!= 0 ? $result:array();
    }
  
     public function setUser() {        
        $result = $this->client->select("select * from $this->table WHERE id='$this->id' LIMIT 1");        
        foreach ($result as $value) {       
            $this->id = $value["id"];
            $this->addedBy = $value['addedby'];
            $this->projectId = $value["project_id"];
            $this->hoursSpent = $value["hours_spent"];
            $this->date = $value['date'];
            $this->description = $value["description"];
            $this->dateCreated = $value["date_created"];
        break;
        }
    }
  

    public function create($userValue = array()) {
       $dataUser = array(
            "id" => $userValue['id']['value'] ,
            "addedby"=>$userValue['addedby']['value'],
            "project_id" => $userValue['project_id']['value'],
            "hours_spent"=>$userValue['hours_spent']['value'],
            "date"=>$userValue['date']['value'],
            "description"=>$userValue['description']['value'],
            "date_created" => $this->systemDate->current()
        );
        //var_dump($dataUser);
            return $this->client->insert($dataUser);
         }
  
    public function delete(){
        $state=false;
        if ($this->client->delete("id ='$this->id'")) {
            $state = true;
        }
        return $state;
    }
  
    /**
     * 
     * @param string $table
     * @param string $email
     * @param object $client  database instance
     * @return boolean
     */
    

    public function update($data = array()) {
    return $this->client->update($data, "id='$this->id' ")?  true:false;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }  
    
    /**
     * Get the value of addedby
     */ 
    public function getAddedBy()
    {
        return $this->addedBy;
    }
    

    /**
     * Get the value of projectId
     */ 
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Get the value of hoursSpent
     */ 
    public function getHoursSpent()
    {
        return $this->hoursSpent;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of addedBy
     *
     * @return  self
     */ 
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }
}
