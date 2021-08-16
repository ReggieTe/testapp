<?php
namespace TestApp;
use TestApp\Core\Response;
/**
 * Description of Bootstrap
 *
 * @author Reggie Te
 */
class Bootstrap {

    private $page;
    private $type;
    private $method;
    private $app;
    private $mode;
    private $currentFilePath;
    
    public function __construct() {
            $this->page=strtolower(filter_var($_GET['page']??'home', FILTER_SANITIZE_URL));
            $this->type = filter_var(strtolower(trim($_GET['type']??'home', FILTER_SANITIZE_STRING)));
            $this->method = filter_var(strtolower(trim($_GET['method']??'home', FILTER_SANITIZE_STRING)));
            $this->app = filter_var(strtolower(trim($_GET['app']??'home', FILTER_SANITIZE_STRING)));
            $this->mode = filter_var(strtolower(trim($_POST['mode']??'mode', FILTER_SANITIZE_STRING)));
            $this->currentFilePath="views/$this->page/index.php";
        } 
    
    public function init() {
        $templateDir="web";
        switch ($this->page) {
            case 'dashboard':
                    $this->currentFilePath=$templateDir."/dashboard/views/$this->type/index.php";
                    $this->render();
                break;            
            default:
                    $this->currentFilePath=$templateDir."/views/$this->page/index.php";
                    $this->render();                    
                break;
        }
              
    }
    public function initAdmin() {
        $this->currentFilePath="views/$this->page/index.php";
        $this->render('');      
    }  
    public function AdminController()
    {        
        $path= "views/authorize/$this->type/$this->method/engine.php";
        include is_file($path)? $path : "views/home/index.php";
    } 
    
    public function adminMainAuthorizeController()
    {
         $path = "web/dashboard/views/authorize/" . $this->method . "/index.php";
         include is_file($path)? $path:'web/dashboard/views/home/index.php';
    } 

    public function adminSubAuthorizeController()
    {
        $path = "web/dashboard/views/authorize/$this->method/$this->app/engine.php";
        include is_file($path)? $path:'web/dashboard/views/home/index.php';
    } 
    
    public function renderPage($page='home')
    {
        return "web/dashboard/views/$page/index.php";
    }

    private function render($templateDir="web/"){
        
       switch ($this->mode) {
           case 'app':
            include file_exists($this->currentFilePath)?$this->currentFilePath:"Invalid";
               break;           
           default:
                include $templateDir."views/header.php"; 
                include file_exists($this->currentFilePath)?$this->currentFilePath: $templateDir."views/home/index.php";
                include $templateDir."views/footer.php";
               break;
        }         
    }
}
