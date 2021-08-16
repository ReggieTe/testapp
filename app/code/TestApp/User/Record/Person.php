<?php
namespace TestApp\User\Record;
use TestApp\Core\Database;
use TestApp\Core\Date;
use TestApp\Core\FileHandler;
use TestApp\Core\Text;
use TestApp\Core\File;
use TestApp\Core\JsonList;
use TestApp\Core\Cache;
/**
 * Description of Person
 *
 * @author Reggie Te
 */
class  Person{

    private $id;
    private $addedBy;
    private $name;
    private $surname;
    private $natId;
    private $phone;
    private $email;   
    private $dob;
    private $langauge;
    private $interests;   

    private $client;   
    private $date;
    private $file;
    private $table;
    private $jsonList;

    public function __construct($id=null) {
        $this->table ="user_person";        
        $this->client = new Database($this->table);
        $this->date = new Date();
        $this->file = new FileHandler();
        $this->text = new Text();
        $this->jsonList = new JsonList();
        $this->id = $id;
        $this->id!=null?$this->setUser():'';  
    }
 
    public function getAllData($keys="*") {      
        $result = $this->client->select("select $keys from $this->table");        
        return count($result)!= 0 ? $result:array();
    }
   
  
     public function setUser() {        
        $result = $this->client->select("select * from $this->table WHERE id='$this->id' LIMIT 1");        
        foreach ($result as $key => $value) {
            $list = new JsonList($value["id"]);
            $this->matches = $list->get();
            $this->id = $value["id"];
            $this->addedBy = $value['addedby'];
            $this->name = $value["name"];
            $this->surname = $value["surname"];
            $this->nationalid = $value['natid'];
            $this->dob = $value["dob"];
            $this->langauge = $value["language"];
            $this->interests = $value["interests"];            
            $this->phone = $value["phone"];           
            $this->email=$value['email'];
            $this->dateModified = $value["date_modified"];
            $this->dateCreated = $value["date_created"];
        break;
        }
    }
  

    public function create($userValue = array()) {
       $dataUser = array(
            "id" => $userValue['id']['value'] ,
            "addedby"=>$userValue['addedby']['value'],
            "name" => $userValue['name']['value'],
            "surname"=>$userValue['surname']['value'],
            "natid"=>$userValue['natid']['value'],
            "phone"=>$userValue['phone']['value'],
            "dob" => $userValue['dob']['value'],
            "language" => $userValue['language']['value'],
            "interests" => $userValue['interests']['value'],
            'email'=>$userValue['email']['value'],
            "date_modified" => $this->date->current(),
            "date_created" => $this->date->current()
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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }  
   
    /**
     * Get the value of dob
     */ 
    public function getDob()
    {
        return $this->dob;
    }    
    /**
     * Get the value of langauge
     */ 
    public function getLangauge()
    {
        return $this->langauge;
    }
    /**
     * Get the value of interests
     */ 
    public function getInterests()
    {
        return $this->interests;
    }  

    /**
     * Get the value of dateModified
     */ 
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Get the value of dateCreated
     */ 
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }    
    /**
     * Get the value of surname
     */ 
    public function getSurname()
    {
        return $this->surname;
    }    
    /**
     * Get the value of nationalid
     */ 
    public function getNationalId()
    {
        return $this->nationalid;
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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }      
    /**
     * Set the value of nationalId
     *
     * @return  self
     */ 
    public function setNationalId($nationalId)
    {
        $this->nationalId = $nationalId;

        return $this;
    }

    /**
     * Get the value of natId
     */ 
    public function getNatId()
    {
        return $this->natId;
    }

    /**
     * Set the value of natId
     *
     * @return  self
     */ 
    public function setNatId($natId)
    {
        $this->natId = $natId;

        return $this;
    }
}
