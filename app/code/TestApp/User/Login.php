<?php
namespace TestApp\User;
use TestApp\Core\Session;
use TestApp\Core\Database;
use TestApp\Core\Date;
use TestApp\Core\Hash;
use TestApp\User\User;
use TestApp\App\Check;
use TestApp\Core\Text;
/**
 * Description of User
 *
 * @author Reggie Te
 */
class Login {

    private $id;
    private $email;
    private $salt;
    private $user;
    private $password;
    private $type;
    private $accStatus;
    private $state;

    private $client;    
    private $session;
    private $date;
    private $text;
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
        $this->text = new Text();
        $this->setUser();
    }


    /**
     * 
     * @param string $email   user email
     * @param string $password  user password
     * @param string $table  database table to effect change
     * @param object $client  database instance
     * @return boolean
     */
    public function login($email,$password) {
        $count = 0;
        $result = $this->client->select("select * from $this->table WHERE email=:email AND password=:password LIMIT 1", array(":email" => $email, ":password" => $password));
        foreach ($result as $key => $value) {
            $count++;
            if ($count == 1) {
                $this->session->set('usercodeid', $value['id']);
                $this->userid = $value['id'];
                $this->session->set('loggedIn', true);
                //create auth id  
                $this->user = new User($this->userid);
                $this->user->updateUser(
                    array(
                        "auth_id"=>array("value"=>$this->text->keyGen()),
                        "lastlogin"=>array("value"=>$this->date->current())
                        )
                );
                return true;
            } else {
                return false;
            }
        }
    }

    public function loginWithAuthId($id) {
        $count = 0;
        $result = $this->client->select("select * from $this->table WHERE auth_id=:authid LIMIT 1", array(":authid" => $id));
        foreach ($result as $key => $value) {
            $count++;
            if ($count == 1) {  
                $this->id = $value['id'];             
                return true;
            } else {
                return false;
            }
        }
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
            $this->firstname = $value["firstname"];
            $this->email = $value["email"];
            $this->salt = $value["salt"];
            $this->state = $value["state"];
        }
    }

    /**
     * Get the value of salt
     */ 
    public function getSalt()
    {
        return $this->salt;
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
}
