<?php
/**
 * Created by PhpStorm.
 * User: arcangelo
 * Date: 3/3/19
 * Time: 6:23 PM
 */

require_once __DIR__.'/../classes/Filtervalue.php';
require_once __DIR__.'/../classes/Cookiemanager.php';
require_once __DIR__.'/../classes/Domainhandler.php';
require_once __DIR__.'/Login.php';






class Mainrouter
{
    public function __construct($logged)
    {

        if(!$logged){

            //aggiungi forgot password
            $login  = new Login();
            try{
            $login->DoLogin();
            }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n"; exit;
            }

        }else{
            //gestisci metodi
        }
    }

}