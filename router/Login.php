<?php
/**
 * Created by PhpStorm.
 * User: arcangelo
 * Date: 3/4/19
 * Time: 8:31 PM
 */

namespace Router;

require_once 'classes/Filtervalue.php';
require_once 'classes/Cookiemanager.php';
require_once 'classes/Domainhandler.php';

use Classes\Cookiemanager as CM;
use Classes\Filtervalue as FV;
use Classes\Domainhandler as DM;


class Login
{
    public function __construct()
    {

    }

    public function DoLogin()
    {
        session_start();
        session_regenerate_id();
        $sessionProvider = new \EasyCSRF\NativeSessionProvider();
        $easyCSRF = new \EasyCSRF\EasyCSRF($sessionProvider);
        $filterValue = new FV();
        $cookieManager = new CM();
        $domainHandler = new DM();

        $_SESSION['message'] = [];


        if ($_SERVER['REQUEST_METHOD'] == 'GET') {


            if (!isset($_SERVER['HTTP_REFERER'])) {
                $temp_cookie = (array_key_exists('cookie',$_GET)) ? @$_GET['cookie'] : @$_SESSION['cookie'];

                $filterValue->filter(FILTER_SANITIZE_NUMBER_INT, $temp_cookie);
                if($temp_cookie == ""){
                    array_push($_SESSION['message'], 'cookie non corretto');
                    exit(header("Location: http://".$_SERVER['HTTP_HOST']."/tokenGenerate.php"));

                }
                 $_SESSION['HTTP_REFERER_'] = $domainHandler->getDomainFromCookie($temp_cookie);
                 $_SERVER['HTTP_REFERER'] = $domainHandler->getDomainFromCookie($temp_cookie);

            }
            $filterValue->filter(FILTER_SANITIZE_STRING, $_SERVER['HTTP_REFERER']);


            if (!$domainHandler->checkDomain($_SERVER['HTTP_REFERER'])) {
                array_push($_SESSION['message'], 'dominio non corretto');
            }

            if (!isset($_GET['cookie']) && !isset($_SESSION['cookie'])) {
                array_push($_SESSION['message'], 'cookie non definito');
            } else {
                $cookie = (isset($_GET['cookie'])) ? $_GET['cookie'] : $_SESSION['cookie'];
            }


            $filterValue->filter(FILTER_SANITIZE_STRING, $cookie);

            if (!$cookieManager->checkCookie($cookie)) {
                array_push($_SESSION['message'], 'cookie non corretto');
            }


            $_SESSION['dominio'] = $_SERVER['HTTP_REFERER'];
            $_SESSION['my_token'] = $easyCSRF->generate('my_token');
            $_SESSION['cookie'] = $cookie;
            header("Location: /views/login.php");
            exit();

        }

        //parte della post

        global $auth;
        if (!isset($_SESSION['dominio'])) {
            array_push($_SESSION['message'], 'dominio non definito');

        }

        if (!$domainHandler->checkDomain($_SESSION['dominio'])) {
            array_push($_SESSION['message'], 'dati richiesti non provvisti');
        }


        $filterValue->filter(FILTER_SANITIZE_STRING, $_POST['cookie']);


        if ($_POST['cookie'] != $_SESSION['cookie']) {
            array_push($_SESSION['message'], 'cookie non valido ');
        }

        try {
            $easyCSRF->check('my_token', $_POST['token']);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }

        if (empty($_POST['user']) || empty($_POST['pass'])) {
            array_push($_SESSION['message'], 'no data provided');

        }

        $filterValue->filter(FILTER_SANITIZE_STRING, $_POST['user']);
        $filterValue->filter(FILTER_SANITIZE_STRING, $_POST['pass']);


        if (isset($auth->login($_POST['user'], $_POST['pass'])['hash'])) {
            $hash = $auth->getCurrentSessionHash();

            $Uid = $auth->getCurrentUID();


            if(!$domainHandler->isAuthorized($Uid,$_SESSION['dominio'])){

                $_SESSION['HTTP_REFERER_'] ='auth.condivision.cloud';
            }


            if($_SESSION['HTTP_REFERER_'] == 'localhost' || $_SESSION['HTTP_REFERER_'] == 'auth.condivision.cloud'  ){
                echo ' <form id="hashPush" method="POST" action="https://'.$_SESSION['HTTP_REFERER_'].'/index.php">
                    <input type="hidden" value="'.$hash.'" name="hash">
                    </form>
                    
                    <script> document.getElementById("hashPush").submit(); </script>
            ';
                exit;
            }


            echo ' <form id="hashPush" method="POST" action="https://'.$_SESSION['HTTP_REFERER_'].'/fl_core/checkLogin.php">
                    <input type="hidden" value="'.$hash.'" name="hash">
                    </form>
                    
                    <script> document.getElementById("hashPush").submit(); </script>
            ';
            exit;
        } else {
            // header('Location:'.$_SERVER['HTTP_REFERER'].'/login.php');
            array_push($_SESSION['message'], 'no logged in');
            session_destroy();
            header("Location: /views/login.php");

            exit();
        }


    }

}
