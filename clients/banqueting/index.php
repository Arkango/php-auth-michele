<?php

    require_once 'classes/PHPtoken.php';

    //inizializzo una delle classi per customere  singolo
    if(isset($_REQUEST['customer'])){
        $customer = filter_var($_REQUEST['customer'],FILTER_SANITIZE_STRING);
    }

    if($customer == ''){
        echo'invalid customer'; exit;
    } 


    require_once $customer.'.php';
    //require_once 'main.php';

    $start_customer = new $customer();