<?php


require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'router/Mainrouter.php';
$config = new AuthConfig();
if($config->debug){

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;
use Mainrouter as MR;
$dbh = new PDO("mysql:host=".$config->host.";dbname=".$config->dbname, $config->dbuser, $config->dbpass);
$config = new PHPAuthConfig($dbh);
$auth = new PHPAuth($dbh, $config,"it_IT");
//$auth->register('test@email.com', 'T3H-1337-P@$$', 'T3H-1337-P@$$');
//'T3H-1337-P@$$'
//$auth->login($_GET['email'], $_GET['password']);
if (!$auth->isLogged()) {
    //router
    new MR(0);
    //recuperare metodi di registrazione, login, e cancellazione utente e cambio passowrd
    header('HTTP/1.0 403 Forbidden');
    echo "Forbidden";
    exit();
}else{

    $group = $_GET['group'];
    $method = $_GET['method'];

    //router
    new MR(1);

    $auth->logout($auth->getCurrentSessionHash());
    /* codice da riadattare
    //inizializzo una delle classi per cliente(verticalizzazione)
    if(isset($_REQUEST['client'])){
        $client = filter_var($_REQUEST['client'],FILTER_SANITIZE_STRING);
    }

    
    if($client == ''){
        echo'invalid client'; exit;
    }      

    require_once 'clients/'.$client.'/index.php';
    */

}

/*
 * http://localhost/php-auth-michele/?client=banqueting&customer=
 * calderoni&0593c3d0d78ca2e6ad2ff4522668a72919e49092f11bebaf6248fb03db9be2d8=1
 */

?>
