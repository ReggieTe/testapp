<?php 
namespace TestApp\App;
use TestApp\Core\Text;
use TestApp\Core\Date;
use TestApp\Core\Database;



class AccountType {

    private $id;
    private $name;
    private $displayName;
    private $permisson;
    private $dateCreated;
    private $dateModified;

   
    private $text;
    private $date;
    private $client;
    private $table;

    public function __construct($id = null)
    {
        $this->table = "app_account_type";
        $this->text = new Text();
        $this->date = new Date();
        $this->client = new Database($this->table);

        $this->id = isset($id)?$id:null;
        isset($this->id)?$this->set():"";
    }


    public function set (){
        
        $types = $this->client->select("SELECT * FROM $this->table WHERE id ='$this->id' LIMIT 1");
        if(count($types)==0)
        {
            $types = $this->client->select("SELECT * FROM $this->table WHERE name ='default' LIMIT 1");
        }
        foreach($types as $type)
        {
                $this->id = $type['id'];
                $this->name = $type['name'];
                $this->displayName = $type['display_name'];
                //$this->permisson = $type['permission'];
                $this->dateCreated = $type['date_created'];
                $this->dateModified = $type['date_modified'];
                break;
        }
       
    }

    public function create($data)
    {
        $id = $this->text->keyGen();
        $industryData = array(
                'id' => $id,
                'name'=> $data["name"]["value"],
                'display_name'=> $data["display_name"]["value"],
                //'permission'=> $data["type"]["value"],
                'date_created'=> $this->date->current(),
                'date_modified'=> $this->date->current()
        );
        return $this->client->insert($industryData);
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

    /**
     * Get the value of permisson
     */ 
    public function getPermisson()
    {
        return $this->permisson;
    }

    /**
     * Set the value of permisson
     *
     * @return  self
     */ 
    public function setPermisson($permisson)
    {
        $this->permisson = $permisson;

        return $this;
    }

    /**
     * Get the value of displayName
     */ 
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set the value of displayName
     *
     * @return  self
     */ 
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }
}