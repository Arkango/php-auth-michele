<?php

//da rimuovere
//$dbh = new PDO("mysql:host=127.0.0.1;dbname=phpauth", "root", "arcangelo");

namespace Config;

class AuthConfigLocal{
    public $host = 'localhost';
    public $dbname = 'phpauth';
    public $dbuser = 'root';
    public $dbpass = '';
    public $debug = 1;
}

class AuthConfig{
    public $host = 'localhost';
    public $dbname = 'authcond_phpauth';
    public $dbuser = 'authcond_user_0';
    public $dbpass = 'NumberDronedSwardsKnelt98';
    public $debug = 1;
}