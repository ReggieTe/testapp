<?php 
namespace TestApp\Core;

class TextFile{

    private $textfile;

    public function __construct($textfile)
    {
        $this->textfile = $textfile;
    }

    public function write($content="",$mode="w")
    {
        $myfile = fopen($this->textfile,$mode);
        fwrite($myfile,$content."\n");
        fclose($myfile);
        return $this;
    }
    public function readSingle()
    {
        $fileContents ="";
        $fh = fopen($this->textfile,'r');
        $fileContents =fread($fh,filesize($this->textfile));
        fclose($fh);
        return $fileContents;
    } 


    public function read($json=false)
    {
        $fileContents =array();
        $fh = fopen($this->textfile,'r');
        while ($line = fgets($fh)) {  
                  if(!empty($line))
                  {
                    array_push($fileContents,(($json)? json_decode($line,true):$line));
                  } 
        }
        fclose($fh);
        return $fileContents;
    } 
}

