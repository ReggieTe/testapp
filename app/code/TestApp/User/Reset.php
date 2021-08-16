<?php
namespace TestApp\User;
use TestApp\Core\Session;
use TestApp\Core\Database;
use TestApp\Core\Date;
use TestApp\Core\Hash;
/**
 * Description of User
 *
 * @author Reggie Te
 */
class Reset {

    private $id;
    private $email;
    private $salt;
    private $password;
    private $type;
    private $accStatus;
    private $state;

    private $client;    
    private $session;
    private $date;
    private $file;
    private $hash;
    private $table;

    public function __construct($email ="",$table="user") {
        $this->table = $table;
        $this->client = new Database($this->table);
        $this->session = new Session();
        $this->date = new Date();
        $this->hash = new Hash();        
        $this->email=$email;
        $this->setUser();
    }



  
    /**
     * 
     * @param string $table
     * @param string $id
     * @param object $client database instance
     * @return string
     */
    public function recordLoginTime() {

        return $this->client->update(array("lastlogin" => $this->date->current()), "id='$this->userid'");
    }

    public function recordLogOutTime() {
        return $this->client->update(array("lastlogout" => $this->date->current()), "id='$this->userid'");
    }

  
    public function setUser() {            
        $result = $this->client->select("select * from $this->table WHERE email ='$this->email' LIMIT 1");
        foreach ($result as $key => $value) {
            $this->id = $value["id"];
            $this->username = $value["username"];
            $this->fullname = $value["firstname"];
            $this->location = $value["location"];
            $this->address = $value["address"];
            $this->phone = $value["phone"];
            $this->email = $value["email"];
            $this->salt = $value["salt"];
            $this->type = $value["type"];
            $this->accStatus = $value["verify"];
            $this->state = $value["state"];
            $this->commencementDate = $value["commencement_date"];
            $this->regDate = $value["reg_date"];
            $this->changedDate = $value["changed_date"];
            $this->lastPasswordResetRequestDate = $value["last_password_reset_request_date"];
            $this->lastlogin = $value["lastlogin"];
            $this->lastlogout = $value["lastlogout"];
        break;
        }
    }
    public function decryptLink($link = null) {
        $count = 0;
        $result = $this->client->select("select * from $this->table");
        foreach ($result as $key => $value) {
            if (!empty($value['email']) && !empty($value['salt'])) {
                
                if ($link == $this->hash->create($value['email'], $value['salt'])) {
                    $this->session->set("id", $value['id']);
                    $this->session->set("email", $value['email']);
                    $this->session->set("createNewPassword", true);
                    $count++;
                }
            }
        }
        return $count > 0 ? true : false;
    }
    public function activateAccount() {
        return $this->client->update(array("state" =>array("value"=>1)), "email='$this->email'");
    }
      /**
     * 
     * @param string $id  userid
     * @param string $table   user datatable
     * @param string $psswrd  use password
     * @param object $client  database instance
     * @return boolean
     */
    public function updatePassword($id, $psswrd) {
        $salt = uniqid(mt_rand());
        $password = $this->hash->create($psswrd, $salt);
        $data = array("password" =>array("value"=>$password), "salt" => array("value"=>$salt));
        return $this->client->update($data, "id='$id' ");
    }

    /**
     * Get the value of salt
     */ 
    public function getSalt()
    {
        return $this->salt;
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

        return $this;
    }

    /**
     * Get the value of accStatus
     */ 
    public function getAccStatus()
    {
        return $this->accStatus;
    }

    /**
     * Set the value of accStatus
     *
     * @return  self
     */ 
    public function setAccStatus($accStatus)
    {
        $this->accStatus = $accStatus;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}
