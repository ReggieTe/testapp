<?php 
namespace TestApp\App;
use TestApp\Core\Text;
use TestApp\Core\Date;
use TestApp\Core\Database;
use TestApp\Core\Cache;

class City {

    private $id;
    private $name;
    private $province;
    private $country;
    private $latitude; 
    private $longitude;
    private $dateCreated;
    private $dateModified;
    private $userId;    
    private $text;
    private $date;
    private $client;
    private $table;
    private $cache;

    public function __construct($id = null)
    {
        $this->table = "app_location_city";
        $this->text = new Text();
        $this->date = new Date();
        $this->client = new Database($this->table);   

        $this->id = isset($id)?$id:null;
        isset($this->id)?$this->set():"";
    }


    public function set (){
       
        $citys = $this->client->select("SELECT * FROM $this->table WHERE id ='$this->id' LIMIT 1");
        foreach($citys as $city)
        {
                $this->id = $city['id'];
                $this->name = $city['name'];
                $this->province = $city['province'];
                $this->country = $city['country'];
                $this->latitude = $city['latitude'];
                $this->longitude = $city['longitude'];
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
                'province'=> $data["province"]["value"],
                'latitude'=> $data["latitude"]["value"],
                'country'=>$data['country']['value'],
                'longitude'=> $data["longitude"]["value"],
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
    
    private function validateLocation($countryCode="ZA"){
        $validLocations = array();
        $validLocationsResult=$this->getAll($countryCode);
        foreach($validLocationsResult as $result){
            array_push($validLocations,$result['id']);
        }
        return $validLocations;
    }


    public function getAll($countryCode="ZA") {
        $this->country = $countryCode;
        // $this->userId = $this->userId?$this->userId:"app/country/".$countryCode;
        // $cache = new Cache($this->userId,INTERNATIONALIZATION_FILE);
        // $data = $cache->execute();
        // if(!$data)
        // {
        //     $cache->create($this->getData());
        //     return $cache->fetch();
        // }
        // return $cache->fetch();
        
        return $this->getData();
   }

   private function getData(){  
        $country = isset($this->country)?$this->country:'ZA';
        //var_dump($country['code']);
        return $this->client->select("SELECT * FROM $this->table where country='ZA'");
   }

   private function refreshCache(){
    $cache = new Cache($this->userId,INTERNATIONALIZATION_FILE);
    return $cache->refresh();
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
     * Get the value of province
     */ 
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set the value of province
     *
     * @return  self
     */ 
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get the value of latitude
     */ 
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the value of latitude
     *
     * @return  self
     */ 
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get the value of longitude
     */ 
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the value of longitude
     *
     * @return  self
     */ 
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

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

    public function getDistance($addressFrom, $addressTo, $unit = ''){
        // Google API key
        $apiKey = 'AIzaSyBLliVkk0Z68GFeyq45z0QUyC-GilJSsU0';
        
        // Change address format
        $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
        $formattedAddrTo     = str_replace(' ', '+', $addressTo);
        
        // Geocoding API request with start address
        $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
        $outputFrom = json_decode($geocodeFrom);
        if(!empty($outputFrom->error_message)){
            return $outputFrom->error_message;
        }
        
        // Geocoding API request with end address
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
        $outputTo = json_decode($geocodeTo);
        if(!empty($outputTo->error_message)){
            return $outputTo->error_message;
        }
        
        // Get latitude and longitude from the geodata
        $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
        $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
        $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
        
        // Calculate distance between latitude and longitude
        $theta    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        
        // Convert unit and return distance
        $unit = strtoupper($unit);
        if($unit == "K"){
            return round($miles * 1.609344, 2).' km';
        }elseif($unit == "M"){
            return round($miles * 1609.344, 2).' meters';
        }else{
            return round($miles, 2).' miles';
        }
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit="K") {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);
      
          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
            return $miles;
          }
        }
      }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of cache
     */ 
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Set the value of cache
     *
     * @return  self
     */ 
    public function setCache($cache)
    {
        $this->cache = $cache;

        return $this;
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