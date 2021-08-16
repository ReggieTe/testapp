<?php 
namespace TestApp\App;
use TestApp\Core\Text;
use TestApp\Core\Date;
use TestApp\Core\Database;



class Province {

    private $id;
    private $name;
    private $country;
    private $dateCreated;
    private $dateModified;

    private $text;
    private $date;
    private $client;
    private $table;

    public function __construct($id = null)
    {
        $this->table = "app_location_province";
        $this->text = new Text();
        $this->date = new Date();
        $this->client = new Database($this->table);

        $this->id = isset($id)?$id:null;
        isset($this->id)?$this->set():"";
    }


    public function set (){

        $provinces =  $this->client->select("SELECT * FROM $this->table WHERE id ='$this->id' LIMIT 1");
        foreach($provinces as $province)
        {
                $this->id = $province['id'];
                $this->name = $province['name'];
                $this->country = $province['country'];
                $this->dateCreated = $province['date_created'];
                $this->dateModified = $province['date_modified'];
                break;
        }
       
    }

    public function create($data)
    {
        $id = $this->text->keyGen();
        $provinceData = array(
                'id' => isset($data["id"]["value"])?$data["id"]["value"]:$id,
                'name'=> $data["name"]["value"],
                'country'=> $data["country"]["value"],
                'date_created'=> $this->date->current(),
                'date_modified'=> $this->date->current()
        );
        return $this->client->insert($provinceData);
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
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
}