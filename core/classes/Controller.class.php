<?php

use League\Plates;

class Controller {

        public $templates = null;

        public function Get($key){
            if($key ==  "templates"){
                if($this->templates == null){
                    $this->templates = new League\Plates\Engine('./views');
                }
            }
            return $this->$key;
        }

        public function Set($key, $val){
            $this->$key = $val;
        }
}

?>