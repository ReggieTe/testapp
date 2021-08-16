<?php 
namespace TestApp\App;
use TestApp\Core\Text;
use TestApp\Core\Date;
use TestApp\Core\Database;



class Country {

    private $id;
    private $name;
    private $code;
    private $langauge;
    private $native;
    private $continent;
    private $capital;
    private $currency;
    private $langauges;
    private $active;
    private $pay;
    private $amount;
    private $accounts;
    private $dateCreated;
    private $dateModified;

    private $text;
    private $date;
    private $client;
    private $table;

    public function __construct($id = null)
    {
        $this->table = "app_country";
        $this->text = new Text();
        $this->date = new Date();
        $this->client = new Database($this->table);

        $this->id = isset($id)?$id:null;
        isset($this->id)?$this->set():"";
    }


    public function set (){

        $countrys =  $this->client->select("SELECT * FROM $this->table WHERE id ='$this->id' LIMIT 1");
        foreach($countrys as $country)
        {
                $this->id = $country['id'];
                $this->name = $country['name'];
                $this->code = $country['phone'];
                //$this->symbol = $country['symbol'];
                $this->language = $country['languages'];
                $this->currency = $country['currency'];
                $this->active = $country['active'];;
                $this->pay = $country['pay'];;
                $this->amount = $country['amount'];;
                $this->accounts = $country['accounts'];;
                $this->dateCreated = $country['date_created'];
                $this->dateModified = $country['date_modified'];
                break;
        }
       
    }

    public function isAllowed()
    {
        return ($this->active)?true:false;
    }

    public function create($data)
    {
        $id = $this->text->keyGen();
        $countryData = array(
                'id' => $id,
                'name'=> $data["name"]["value"],
                'code'=> $data["code"]["value"],
                //'symbol'=>$data["symbol"]["value"],
                'language'=> $data["languages"]["value"],
                'currency' => $data['currency']['value'],
                'date_created'=> $this->date->current(),
                'date_modified'=> $this->date->current()
        );
        return $this->client->insert($countryData);
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
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of langauge
     */ 
    public function getLangauge()
    {
        return $this->langauge;
    }

    /**
     * Set the value of langauge
     *
     * @return  self
     */ 
    public function setLangauge($langauge)
    {
        $this->langauge = $langauge;

        return $this;
    }

    /**
     * Get the value of currency
     */ 
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @return  self
     */ 
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get the value of symbol
     */ 
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set the value of symbol
     *
     * @return  self
     */ 
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get the value of langauges
     */ 
    public function getLangauges()
    {
        return $this->langauges;
    }

    /**
     * Set the value of langauges
     *
     * @return  self
     */ 
    public function setLangauges($langauges)
    {
        $this->langauges = $langauges;

        return $this;
    }

    /**
     * Get the value of capital
     */ 
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Set the value of capital
     *
     * @return  self
     */ 
    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * Get the value of continent
     */ 
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Set the value of continent
     *
     * @return  self
     */ 
    public function setContinent($continent)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of pay
     */ 
    public function getPay()
    {
        return $this->pay;
    }

    /**
     * Set the value of pay
     *
     * @return  self
     */ 
    public function setPay($pay)
    {
        $this->pay = $pay;

        return $this;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of accounts
     */ 
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Set the value of accounts
     *
     * @return  self
     */ 
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }
}