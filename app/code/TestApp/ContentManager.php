<?php
namespace TestApp;

class ContentManager {
    private $page;
    private $name;
    private $description;
    private $keywords;
    
    private $pageContent=array(

        "404"=> array(
            "name"=>"Not Found",
            "description"=>"Acccount verification process",
            "keywords"=>" "), 
     "home"=>array(
         "name"=>"Home",
         "description"=>"We are dedicated to making life easy with the use of high end technology and skill sets combined from varies fields of experts.",
         "keywords"=>" "),    
    "logout"=> array(
         "name"=>"Log Out",
         "description"=>"Thank you for taking your time to visit us.Stay blessed",
         "keywords"=>""),  
   
     "default"=>array(
            "name"=>"App",
            "description"=>"We have an open door approach both from within and outside,so if you have sugguestions or ideas on how best we can deliver our service please hit us up",
            "keywords"=>" ")
    );

    public function __construct() {

        $this->page=strtolower(filter_var($_GET['page']??'home', FILTER_SANITIZE_URL));
        $this->page = $this->page =="dashboard"?strtolower(filter_var($_GET['type']??'home', FILTER_SANITIZE_URL)):$this->page;
        if (!array_key_exists($this->page,$this->pageContent)){
            $this->page="default";
        }
        $this->name = $this->pageContent[$this->page]["name"];
        $this->description = $this->pageContent[$this->page]["description"];
        $this->keywords = $this->pageContent[$this->page]["keywords"];
    }
    /**
     * 
     * @param string $page
     * @return string
     */
    public  function getPageName() {
        
    return $this->name;
    }
    /**
     * 
     * @param string $page
     * @return string
     */
    public  function getPageDescription() {
        
        return $this->description;
    }
    /**
     * 
     * @param string $page
     * @return string
     */
    public  function getPageKeyWords() {
        
        return $this->keywords;
    }
 
}