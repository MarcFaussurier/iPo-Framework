<?php
/*
*   Class Core
*
*/
class Core {

    public $config = array();

    public function __construct(){
        $this->CnfLoad();  
        r($this->config);  
        $this->UrlToController();   
    }

    public function CnfLoad($cnfname = "ShCMS"){
            $this->config = (array) $this->config;
            $this->config[$cnfname] = (new Config($cnfname))->Data;
            $this->config = (object)  $this->config;
    }

    /*
    *   Si $Slug = site.com/ OR site.com            => if exists MainController->action('Index') runing it
    *   Sinon si site.com/aaaa OR site.com/aaaa     => if exists MainController->action('aaaa') runing it
    *   Sinon si aaaaController existe              => if exists aaaaController->action('Index') runing it
    */
    public function UrlToController(){

        $DefaultController = "RootController";  
        $ChoosedController = null;      
        $Slug = explode('/',$_GET["path"]);

        $ControllerArgs = array();    
        foreach($Slug as $key => $val){
            $tmp_controller = $val."Controller";
            preg_match_all('/^[A-Za-z]{1,}$/i',$val,$matches);
            if($tmp_controller != "Controller" && count($matches[0]) > 0 && is_alpa  && class_exists($tmp_controller)){
                r("FOUNDED ".$tmp_controller);
                $ChoosedController = $tmp_controller;
                $ControllerArgs = array();                
            }
            array_push($ControllerArgs,$val);
        }
        if($ChoosedController == null){
            $ChoosedController = $DefaultController;
        }
        $Controller = new $ChoosedController($this,$ControllerArgs);
    }

    static public function Init(){
        new self();
    }
}

?>