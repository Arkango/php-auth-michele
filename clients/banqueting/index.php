<?php

    require_once 'classes/PHPtoken.php';

    //inizializzo una delle classi per customere  singolo
    if(isset($_GET['customer'])){
        $customer = filter_var($_GET['customer'],FILTER_SANITIZE_STRING);
    }elseif(isset($_POST['customer'])){
        $customer = filter_var($_POST['customer'],FILTER_SANITIZE_STRING);
    }

    if($customer == ''){
        echo'invalid customer'; exit;
    } 


    require_once $customer.'.php';
    //require_once 'main.php';

    $start_customer = new $customer();