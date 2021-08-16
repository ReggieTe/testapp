<?php 
namespace TestApp\Core;

/**
 * Description of File
 * This class is for handle all the files operations
 * Anything to do with file handling must define in this class
 *
 * @author Reggie Te
 * @copyright (c) 2016, Reggie Te
 * @version 1.0
 */
class File {

    /**
     * 
     * @param bytes $contentToUpload   file bytes to be upload to the server
     * @param string $directoryToUploadTo    name of the file being uploaded
     * @return boolean     to reflect whether the upload was successful or not
     */
    public  function upload($contentToUpload = null,$directoryToUploadTo = null) {
        if ($contentToUpload != null && $directoryToUploadTo != null) {
            if (is_uploaded_file($contentToUpload)) {

                return copy($contentToUpload, $directoryToUploadTo);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
/**
 * 
 * @param mixed $fileToBeFTP file to be transferred 
 * @param mixed $fileFinalDistination where the file is to be transferred to
 * @return boolean
 */
    public  function ftp($fileToBeFTP=null,$fileFinalDistination=null) {
      
        //details are defined in the ../config/setting.php file
        $connectionId = ftp_connect(FTP_SERVER);
        $loginResult = ftp_login($connectionId, FTP_USERNAME, FTP_PASSWORD); // login with username and password
        if ($loginResult) {

            if (ftp_put($connectionId,$fileFinalDistination,$fileToBeFTP,FTP_BINARY)) {// upload a file
                // copy($file, $relativepath); //Move to orginal directory from the ftp upload folder
                ftp_close($connectionId); // close the connection
                return true;
            } else {
                ftp_close($connectionId); // close the connection
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $whereToCreateDirectory  path on the server where to create directory
     * @return boolean
     */
    public  function create($whereToCreateDirectory = null) {

        if ($whereToCreateDirectory != null) {
            if(is_dir($whereToCreateDirectory)){ return true;}else
                {
            return !is_dir($whereToCreateDirectory) ? mkdir($whereToCreateDirectory,0777, true) : FALSE;
            
                }
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $path  path where the content to be deleted resides
     * @return boolean
     */
    public  function iterate($directoryToIterate = null) {
       
        if (is_dir($directoryToIterate)) {
            $dirContent = $this->parse($directoryToIterate);
            if (is_array($dirContent)) {
                foreach ($dirContent as $fileName) {
                    if (array_search('.', str_split($fileName))) {
                        //delete file
                        $this->deleteFile($directoryToIterate . '/' . $fileName);
                    } else {
                        //check for subdirectory
                        //delete all files
                        $this->iterate($directoryToIterate . '/' . $fileName);
                        //delete directory
                        $this->deleteDirectory($directoryToIterate . '/' . $fileName);
                    }
                }
            }
            return $this->deleteDirectory($directoryToIterate);
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $fileToDelete  file to delete from server
     * @return boolean
     */
    public  function deleteFile($fileToDelete = null) {

        if ($fileToDelete != null) {
            return is_file($fileToDelete) ? unlink($fileToDelete) : false;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $directoryToDelete   directory to remove
     * @return boolean
     */
    public  function deleteDirectory($directoryToDelete = null) {
        if ($directoryToDelete != null) {
            return is_dir($directoryToDelete) ? rmdir($directoryToDelete) : false;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $directoryToParse path where the content to be diplayed resides
     * @return boolean
     */
    public  function parse($directoryToParse = null) {
        if ($directoryToParse != null) {
            // Define an array to hold the files
            $files = array();

            if (is_dir($directoryToParse)) {
// Open the current directory

                $directoryContent = ($directoryToParse == null ? null : (is_dir($directoryToParse) ? dir($directoryToParse) : null) );

// Loop through all of the files:
                while (false !== ($file = $directoryContent->read())) {
                    // If the file is not this file, and does not start with a '.' or '~'
                    // and does not end in LCK, then store it for later display:
                    if (($file[0] != '.') && ($file[0] != '~') && (substr($file, -3) != 'LCK')) {
                        // Store the filename, and full data from a stat() call:
                        array_push($files,$file);
                    }
                }
// Close the directory
                $directoryContent->close();
// Sort the files so that they are alphabetical
            }
            ksort($files);

            return $files;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $dir  directory to clean
     * @param array $fileCodes   user valid file codes
     * @return boolean
     */
    public  function clean($directoryToClean = null, $fileCodes = array()) {
        if ($directoryToClean != null && $fileCodes != null) {
            $avialableFiles = array();

            foreach ($this->parse($directoryToClean) as $name => $stats) {
                array_push($avialableFiles, $name);
            }
            //retrive files that are hanging e.g directory with no record in the database
            foreach (array_diff($avialableFiles, $fileCodes) as $key => $value) {
                $filePath = $directoryToClean . "/" . $value;
                //delete files and sub directories
                $this->iterate($filePath);
                //delete directory
                $this->deleteDirectory($filePath);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param int $bytes the file in bytes
     * @param boolean $withTag optional to return value with size tag e.g 2KB or 2MB
     * @return string formatted bytes
     */
    public  function size($bytes = 0, $withTag = false) {
        $display = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

        // Now, constantly divide the value by 1024 until it is less than 1024
        $level = 0;
        while ($bytes > 1024) {
            $bytes /= 1024;
            $level++;
        }
        return round($bytes, 1) . ' ' . $withTag ? $display[$level] : '';
    }
    public  function textFileCreate($filename = "newfile.txt", $content = "John Doe\n", $permission = "a") {
        if (!file_exists($filename)) {
            touch($filename);
        }
        $fileObject = fopen($filename, $permission);
        if ($fileObject) {
            fwrite($fileObject, $content);
            fclose($fileObject);
        } else {
            return false;
        }
    }

    public  function textFileRead($filename = "newfile.txt", $permission = "r") {
        $fileContents = array();
        $fileObject = null;
        if (!is_file($filename)) {
            $this->textFileCreate($filename);
        }
        $fileObject = fopen($filename, $permission);
        if ($fileObject) {
            // Output one line until end-of-file
            while (!feof($fileObject)) {
                array_push($fileContents, fgets($fileObject));
            }
            fclose($fileObject);
            return $fileContents;
        } else {
            return false;
        }
    }
}
