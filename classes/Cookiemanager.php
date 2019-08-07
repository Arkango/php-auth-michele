<?php
/**
 * Created by PhpStorm.
 * User: arcangelo
 * Date: 3/3/19
 * Time: 6:00 PM
 */

namespace Classes;


class Cookiemanager
{

    public function checkCookie($name){




        global $dbh;
        $stmt = $dbh->prepare('SELECT COUNT(*) as quanti FROM phpauth_cookie_request WHERE token = :name and domain_id = (select id from phpauth_authorized_domain where name = :refer)');
        $stmt ->bindParam(':name',$name);
        $stmt ->bindParam(':refer',$_SERVER['HTTP_REFERER']);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($result['quanti'] == 1){ return true;}

        return false;

    }

}