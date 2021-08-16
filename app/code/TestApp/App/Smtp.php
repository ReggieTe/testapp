<?php 
namespace TestApp\App;
use TestApp\Core\Text;
use TestApp\Core\Date;
use TestApp\Core\Database;

class Smtp{
    private $id;
    private $type;
    private $host;
    private $email;
    private $password;
    private $secure;
    private $portNo;
    private $ghost;
    private $gmail;
    private $gpassword;
    private $gsecure;
    private $gportNo;
    private $dateCreated;
    private $dateModified;

    private $text;
    private $date;
    private $client;
    private $table;

    public function __construct()
    {
        $this->table = "app_smtp_settings";
        $this->text = new Text();
        $this->date = new Date();
        $this->client = new Database($this->table);        
        $this->set();
        
    }

    public function set (){
       
        $citys = $this->client->select("SELECT * FROM $this->table limit 1");
        foreach($citys as $city)
        {
                $this->id = $city['id'];
                $this->type = $city['type'];
                $this->host = $city['host'];
                $this->email = $city['email'];
                $this->password = $city['password'];
                $this->secure = $city['secure'];
                $this->portNo = $city['port_no'];
                $this->ghost = $city['ghost'];
                $this->gmail = $city['gmail'];
                $this->gpassword = $city['gpassword'];
                $this->gsecure = $city['gsecure'];
                $this->gportNo = $city['gport_no'];
                $this->dateCreated = $city['date_created'];
                $this->dateModified = $city['date_modified'];
                break;
        }
       
    }

    public function create($data)
    {
        $id = $this->text->keyGen();
        $cityData = array(
                'id' => $id,
                'name'=> $data["name"]["value"],
                'type'=> $data["type"]["value"],
                'host'=> $data["host"]["value"],
                'email'=> $data["email"]["value"],
                'password'=> $data["password"]["value"],
                'secure'=> $data["secure"]["value"],
                'port_no'=> $data["port_no"]["value"],
                'ghost'=> $data["ghost"]["value"],
                'gmail'=> $data["gmail"]["value"],
                'gpassword'=> $data["gpassword"]["value"],
                'gsecure'=> $data["gsecure"]["value"],
                'gport_no'=> $data["gport_no"]["value"],
                'date_created'=> $this->date->current(),
                'date_modified'=> $this->date->current()
        );
        return $this->client->insert($cityData);
    }    
      
    public function update($data=array())
    {
        return $this->client->update($data,"id ='$this->id'");
    }

    public function delete($where="")
    {
        return $this->client->delete($where);
    }
    public function getAll() {
     
        return $this->client->select("SELECT * FROM $this->table");
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
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of host
     */ 
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the value of host
     *
     * @return  self
     */ 
    public function setHost($host)
    {
        $this->host = $host;

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
     * Get the value of secure
     */ 
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * Set the value of secure
     *
     * @return  self
     */ 
    public function setSecure($secure)
    {
        $this->secure = $secure;

        return $this;
    }

    /**
     * Get the value of portNo
     */ 
    public function getPortNo()
    {
        return $this->portNo;
    }

    /**
     * Set the value of portNo
     *
     * @return  self
     */ 
    public function setPortNo($portNo)
    {
        $this->portNo = $portNo;

        return $this;
    }

    /**
     * Get the value of ghost
     */ 
    public function getGhost()
    {
        return $this->ghost;
    }

    /**
     * Set the value of ghost
     *
     * @return  self
     */ 
    public function setGhost($ghost)
    {
        $this->ghost = $ghost;

        return $this;
    }

    /**
     * Get the value of gmail
     */ 
    public function getGmail()
    {
        return $this->gmail;
    }

    /**
     * Set the value of gmail
     *
     * @return  self
     */ 
    public function setGmail($gmail)
    {
        $this->gmail = $gmail;

        return $this;
    }

    /**
     * Get the value of gpassword
     */ 
    public function getGpassword()
    {
        return $this->gpassword;
    }

    /**
     * Set the value of gpassword
     *
     * @return  self
     */ 
    public function setGpassword($gpassword)
    {
        $this->gpassword = $gpassword;

        return $this;
    }

    /**
     * Get the value of gsecure
     */ 
    public function getGsecure()
    {
        return $this->gsecure;
    }

    /**
     * Set the value of gsecure
     *
     * @return  self
     */ 
    public function setGsecure($gsecure)
    {
        $this->gsecure = $gsecure;

        return $this;
    }

    /**
     * Get the value of gportNo
     */ 
    public function getGportNo()
    {
        return $this->gportNo;
    }

    /**
     * Set the value of gportNo
     *
     * @return  self
     */ 
    public function setGportNo($gportNo)
    {
        $this->gportNo = $gportNo;

        return $this;
    }

    /**
     * Get the value of dateCreated
     */ 
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set the value of dateCreated
     *
     * @return  self
     */ 
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get the value of dateModified
     */ 
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set the value of dateModified
     *
     * @return  self
     */ 
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }
}