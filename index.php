<?php

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'config.php';

use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;

$config = new PHPAuthConfig($dbh);
$auth = new PHPAuth($dbh, $config,"it_IT");

//$auth->register('test@email.com', 'T3H-1337-P@$$', 'T3H-1337-P@$$');
//'T3H-1337-P@$$'
//$auth->login($_GET['email'], $_GET['password']);



if (!$auth->isLogged()) {
    //recuperare metodi di registrazione, login, e cancellazione utente e cambio passowrd
    header('HTTP/1.0 403 Forbidden');
    echo "Forbidden";
    exit();
}else{
    //inizializzo una delle classi per cliente(verticalizzazione)
    if(isset($_REQUEST['client'])){
        $client = filter_var($_REQUEST['client'],FILTER_SANITIZE_STRING);
    }

    
    if($client == ''){
        echo'invalid client'; exit;
    }      

    require_once 'clients/'.$client.'/index.php';

}

/*
 * http://localhost/php-auth-michele/?client=banqueting&customer=
 * calderoni&0593c3d0d78ca2e6ad2ff4522668a72919e49092f11bebaf6248fb03db9be2d8=1
 */

?>
