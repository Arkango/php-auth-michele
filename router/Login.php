<?php
/**
 * Created by PhpStorm.
 * User: arcangelo
 * Date: 3/4/19
 * Time: 8:31 PM
 */


use Classes\Cookiemanager as CM;
use Classes\Filtervalue as FV;
use Classes\Domainhandler as DM;




class Login
{
    public function __construct()
    {

    }

    public function DoLogin(){
        session_start();
        session_regenerate_id();
        $sessionProvider = new EasyCSRF\NativeSessionProvider();
        $easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);
        $filterValue = new FV();
        $cookieManager = new CM();
        $domainHandler = new DM();




        if($_SERVER['REQUEST_METHOD'] == 'GET'){




                if(!isset($_SERVER['HTTP_REFERER'])){
			$temp_cookie = (isset($_GET['cookie'])) ? $_GET['cookie'] : $_SESSION['cookie'];
$filterValue->filter(FILTER_SANITIZE_NUMBER_INT,$temp_cookie);
                   $_SERVER['HTTP_REFERER'] = $domainHandler->getDomainFromCookie($temp_cookie);

                }
                $filterValue->filter(FILTER_SANITIZE_STRING,$_SERVER['HTTP_REFERER']);


                if(!$domainHandler->checkDomain($_SERVER['HTTP_REFERER'])){
                    throw new Exception('dominio non corretto');
                }

                if(!isset($_GET['cookie']) && !isset($_SESSION['cookie']) ){
                    throw new Exception('cookie non definito');
                }else{
                    $cookie= (isset($_GET['cookie'])) ? $_GET['cookie'] : $_SESSION['cookie'];
                }



                $filterValue->filter(FILTER_SANITIZE_STRING,$cookie);

                if(!$cookieManager->checkCookie($cookie)){
                    throw new Exception('cookie non corretto');
                }




                $_SESSION['dominio'] = $_SERVER['HTTP_REFERER'];
                $_SESSION['my_token'] = $easyCSRF->generate('my_token');
                $_SESSION['cookie'] = $cookie;
                header("Location: /views/login.php");
                exit();

        }

        //parte della post

            global $auth;
            if(!isset($_SESSION['dominio'])){
                throw new Exception('dominio non definito');
            }

            if(!$domainHandler->checkDomain($_SESSION['dominio'])){
                throw new Exception('dati richiesti non provvisti');
            }


            $filterValue->filter(FILTER_SANITIZE_STRING,$_POST['cookie']);


            if($_POST['cookie'] != $_SESSION['cookie']){
                throw new Exception( 'cooie non valido ');
            }

            try {
                $easyCSRF->check('my_token', $_POST['token']);
            }
            catch(Exception $e) {
                echo $e->getMessage();
                exit();
            }

            if(empty($_POST['user']) || empty($_POST['pass'])){
                throw new Exception( 'no data provided');
            }

            $filterValue->filter(FILTER_SANITIZE_STRING,$_POST['user']);
            $filterValue->filter(FILTER_SANITIZE_STRING,$_POST['pass']);


            if(isset($auth->login($_POST['user'], $_POST['pass'])['hash'])){
                $hash = $auth->getCurrentSessionHash();
                header('Location:'.$_SERVER['HTTP_REFERER'].'?hash='.$hash); exit;
            }else{
               // header('Location:'.$_SERVER['HTTP_REFERER'].'/login.php');
                echo 'no logged in';
                session_destroy();
                exit;
            }



    }

}
