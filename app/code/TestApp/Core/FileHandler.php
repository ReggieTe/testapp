<?php 
namespace TestApp\Core;
use TestApp\Core\File;

class FileHandler {

    private $file;

    public function __construct()
    {
        $this->file = new File();
    }

    public  function rename($filePath = null, $fileOldName = null, $fileNewName = null, $fileFormat = null) {
        if (is_dir($filePath)) {
            $fileOldName = $filePath . strtolower($fileOldName) . $fileFormat;
            $fileNewName = $filePath . strtolower($fileNewName) . $fileFormat;

            if (is_file($fileOldName)) {
                return is_file($fileOldName) ? rename($fileOldName, $fileNewName) : false;
            } else {
                return false;
            }
        } else {
            return FALSE;
        }
    }

    public  function create($directoryToCreate = array()) {
        $numberOfDirectory = count($directoryToCreate);
        $directoryCreated = 0;
        if (is_array($directoryToCreate)) {            
            foreach ($directoryToCreate as $key => $directory) {
                if (!is_dir($directory)) {
                    if ($this->file->create($directory)) {
                        $directoryCreated++;
                    }
                } else {
                    $directoryCreated++;
                }
            }
            return ($directoryCreated == $numberOfDirectory ? true : false);
        } else {
            return false;
        }
    }
/**
 * 
 * @param type $contentToUpload   e.g $_FILES['img']['tmp_name']
 * @param type $contentfinalDistination e.g ../../application/developers/$id/$folder/$filetype$key.$ext
 * @return boolean
 */
    public  function upload($contentToUpload = null, $contentfinalDistination = null) {

        //Try a normal upload
        if (!$this->file->upload($contentToUpload, $contentfinalDistination)) {
            //Try an ftp
            if (!$this->file->ftp($contentToUpload, $contentfinalDistination)) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }

    }


    public  function deleteFiles($filesToDeleteDirectory=null) {
        if(is_dir($filesToDeleteDirectory))
        {
        $this->file->iterate($filesToDeleteDirectory);
        }
 else {
            return false;
 }
        
    }

}
