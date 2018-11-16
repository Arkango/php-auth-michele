<?php

require_once 'classes/PHPtoken.php';
require_once 'main.php';

class calderoni extends main{

    function __construct(){

        $phptoken = new PHPtoken();
        try{
            echo 'Token da utilizzare per richieste: '.$phptoken->getToken().'<br>';
        }catch(Exception $e){
            echo $e;
        }

    $phptoken->checkToken('GET');
    parent::ciao();
    }


    public function tables(){
            
    }




}