<?php
/**
 * Created by PhpStorm.
 * User: arcangelo
 * Date: 3/3/19
 * Time: 6:23 PM
 */
namespace Router;
require_once 'Login.php';


use Classes\Domainhandler as DM;





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
            session_start();
            //prefix scelta
            global $group;
            global $auth;
            if($group == "scelta"){

                $domainHanlder = new DM();
                $domains = $domainHanlder->getDomains($auth->getCurrentUID());
                unset($domains[0]);
                $_SESSION['data'] = $domains;
                $_SESSION['hash'] = $auth->getCurrentSessionHash();
                header('Location: https://auth.condivision.cloud/views/main.php');
            }
            //gestisci metodi
        }
    }

}