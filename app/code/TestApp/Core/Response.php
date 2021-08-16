<?php  
namespace TestApp\Core;

class Response {

    private $type;

    
    public function siteAdmin($message,$page,$footer='views/footer.php')
    {
        $message = $message;
        include $page;
        include $footer;
        exit();
    }

    public function site($message,$page,$footer='web/views/footer.php')
    {
        $message = $message;
        include $page;
        include $footer;
        exit();
    }

    public function app($result)
    {
        header('Content-Type:application/json;charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header('Charset:utf-8');
        echo json_encode($result);
        exit();
    }

    public function elementsDefined($elements=array(),$method="POST")
    {
        foreach($elements as $element){        
            if (!isset($_POST[$element]))
            {                
                $result = array("error"=>false ,"message"=> "Invalid details:$element.Please try again");
                $this->app($result); 
            }
        }
    }

}