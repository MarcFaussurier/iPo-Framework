<?php
/*
* Autoloader
*
*/
spl_autoload_register(
        function ($class) {
        $pieces = preg_split('/(?=[A-Z])/',$class);
        switch($pieces[count($pieces) - 1]){
            //If classename like UsersMasterModel
            //-> we include models/UsersMasterModel.php
            case 'Model' :
                $path = './core/models/' . $class . '.php';        
                break;
            //If classename like UsersMasterController
            //-> we include controllers/UsersMasterController.php
            case 'Controller' :
                $path = './core/controllers/' . $class . '.php';
                break;
            //Else, we include classes/$class.php
            default :
                $path = './core/classes/' . $class . '.class.php';
                break;
        }
        try{
            if (!class_exists($class)) {
                 include($path);
                 r("Success fully loaded : ".$class);
                 
            }else{
                +r("Class :".$class." already exists!");
            }
        }
        catch(Exception $ex)
        {
            r("Error while loading : ".$class." Error :".$ex);                                    
        }
        finally{            
        }
        
    });