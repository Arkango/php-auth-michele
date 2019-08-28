<?php
/**
 * Created by PhpStorm.
 * User: arcangelo
 * Date: 3/3/19
 * Time: 6:23 PM
 */
namespace Router;
require_once 'Login.php';

use Classes\Cookiemanager;
use Classes\Domainhandler as DM;
use Classes\Filtervalue;
use Classes\PHPtoken;




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

            //prefix scelta
            global $group;
            global $auth;
            if($group == "scelta"){
                $domainHanlder = new DM();
                $domains = $domainHanlder->getDomains($auth->getCurrentUID());
                if(count($domains) == 0){
                    echo 'nessun servizio abilitato';
                }else{
                    foreach ($domains as $domain){
                        print_r($domain);
                    }
                }
            }


            //gestisci metodi
        }
    }

}