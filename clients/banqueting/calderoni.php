<?php

require_once 'classes/PHPtoken.php';
require_once 'main.php';

class calderoni extends main{

    function __construct(){
       // echo 'classe calderoni inizializzata';
        $phptoken = new PHPtoken();
    //echo $phptoken->getToken();
    $phptoken->checkToken('GET');
    parent::ciao();
    }


    public function tables(){
            
    }




}