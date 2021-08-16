<?php
namespace TestApp\Core; 
use TestApp\Core\FileHandler;
use TestApp\Core\Date;
use TestApp\Core\JsonList;
use TestApp\Core\File;

class Cache {    
    private $userId;
    private $expiryPeriod; 
    private $cacheFileToRead;

    private $date;
    private $jsonList;

    public function __construct($userId=null,$cacheName="",$expiryPeriod=12)
    {
        $this->userId=$userId;
        $this->expiryPeriod=$expiryPeriod;
        $this->file = new FileHandler();
        $this->date = new Date();   
        $this->jsonList = new JsonList();    
        $path = RESOURCE_PATH.$this->userId.$cacheName;
        $this->file->create(array($path));
        $this->cacheFileToRead= $path."cache.txt";        
    }

    public function execute(){  
        return $this->checkCache()?($this->checkTimeStamp()? $this->fetch(): false):false;
    }

    public function fetch()
    {        
        $data = $this->getCache();
        return isset($data['data'])?$data['data']: array();
    }
    public function refresh(){
        $file = new File();
        return $file->deleteFile($this->cacheFileToRead);
    }

    public  function create($data=array())
    {         
        $refreshCache=array("timestamp"=>$this->date->current(),"data"=>$data);        
        $text = new TextFile($this->cacheFileToRead);
        $text->write($this->jsonList->encode($refreshCache));                     
    }

    private function checkCache(){
        return(is_file($this->cacheFileToRead))? true:false;
    }

    private function getCache(){
        $text = new TextFile($this->cacheFileToRead);
        $jsonList = new JsonList($text->readSingle());
        return $jsonList->get();
    }

    private function checkTimeStamp(){
        $data = $this->getCache();
        $timeStamp = isset($data['timestamp'])?$data['timestamp']:$this->date->current();
        $time = $this->date->diffTime($timeStamp,"days");
        return $time>=$this->expiryPeriod?false:true;
    }       
}