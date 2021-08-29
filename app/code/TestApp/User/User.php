<?php
namespace TestApp\User;
use TestApp\Core\Session;
use TestApp\Core\Database;
use TestApp\Core\Date;
use TestApp\Core\FileHandler;
use TestApp\Core\JsonList;
use TestApp\Core\Text;
use TestApp\User\Settings;
/**
 * Description of User
 *
 * @author Reggie Te
 */
class User {

    private $id;
    private $authId;
    private $name;
    private $username;
    private $firstname;
    private $surname;    
    private $email;   
    private $password;
    private $salt;    
    
    private $client;    
    private $session;
    private $table;
    private $text;

    public function __construct($id=null,$table="user") { 
        $this->table =$table;        
        $this->session = new Session();
        $this->client = new Database($this->table);
        $this->date = new Date();
        $this->file = new FileHandler();
        $this->text = new Text();
        $this->jsonList = new JsonList();
        $this->id = ($id!=null)? $id :$this->session->get('usercodeid');
        isset($this->id)?$this->setUser():"";  
    }


    public function getAll($keys="*") {      
        $result = $this->client->select("select $keys from $this->table");        
        return count($result)!= 0 ? $result:array();
    }
     

    public function setUser() {  
      
        $result = $this->client->select("select * from $this->table WHERE id='$this->id' LIMIT 1");        
        foreach ($result as $key => $value) {
            $this->id = $value["id"];
            $this->firstname = $value["firstname"];
            $this->surname = $value["surname"];           
            $this->email = $value["email"];           
            $this->password = $value["password"];
            $this->salt = $value["salt"];
        break;
        }
    }
    public function register($userValue = array()) {
        $this->id = $this->text->keyGen();
       $dataUser = array(
            "id" => $this->id ,
            "firstname" => $userValue['firstname'],
            "surname" => $userValue['surname'],       
            "email" => $userValue['email'],
            "password" => $userValue['password'],
            "salt" => $userValue['salt'],            
        );
        return $this->client->insert($dataUser);
    }

    
    /**
     * 
     * @param string $table
     * @param string $email
     * @param object $client  database instance
     * @return boolean
     */
    

    public function updateUser($data = array()) {
        return $this->client->update($data, "id='$this->id' ");
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
        $this->setUser();
        return $this;
    } 
    
    /**
     * Get the value of addedby
     */ 
    public function getAddedby()
    {
        return $this->addedby;
    }

    /**
     * Set the value of addedby
     *
     * @return  self
     */ 
    public function setAddedby($addedby)
    {
        $this->addedby = $addedby;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFullname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFullname($firstname)
    {
        $this->firstname = $firstname;

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
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of salt
     */ 
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the value of salt
     *
     * @return  self
     */ 
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

   
    /**
     * Get the value of surname
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */ 
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of authId
     */ 
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     * Set the value of authId
     *
     * @return  self
     */ 
    public function setAuthId($authId)
    {
        $this->authId = $authId;

        return $this;
    }

}
