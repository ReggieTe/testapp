<?php
namespace TestApp\Core;
use TestApp\Core\File;
use TestApp\Core\JsonList;

/**
 * Description of Log
 *
 * @author Reggie Te
 */
class Log {
    private $userId;
    private $path;
    private $logFiles=array();
    private $jsonList;
    private $file;
    
    public function __construct($userId=null,$path='')
   {
        $this->userId=$userId;
        $this->path = $path;
        $this->file = new File();
        $this->jsonList = new JsonList();

        $this->logFiles = array(($userId!="")? ($path=="admin/"?"../":'').RESOURCE_PATH."$path".$userId."/log.txt": "public/resource/log.txt" );
               
    }

    public function log($message=array()) {        
      //$this->textFile($this->jsonList->encode($message));  
      return false;
    }
    
    private function textFile($content) {        
        foreach($this->logFiles as $log)
        {
            $this->file->textFileCreate($log, $content."\n");
        }        
    }

    public function getLog($userId="") {
    //   $log= ($userId!="")? ($this->path=="admin/"?"../":'').RESOURCE_PATH.$this->path.$userId."/log.txt":"public/resource/log.txt"; 
    //     return(is_file($log))? $this->textFileRead($log):array();   
    return array();         
    }

    public  function textFileRead($filename = "newfile.txt", $permission = "r") {
        $fileContents = array();
        $fileObject = null;        
        $fileObject = fopen($filename, $permission);

        if ($fileObject) {
            // Output one line until end-of-file
            while (!feof($fileObject)) {
                if($fileObject!="")
                {
                    array_push($fileContents, $this->jsonList->decode(fgets($fileObject)));
                }
                
            }
            fclose($fileObject);
            return $fileContents;
        } else {
            return false;
        }
    }
    
}

