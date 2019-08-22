<?php
/**
 * Created by PhpStorm.
 * User: arcangelo
 * Date: 3/4/19
 * Time: 9:53 PM
 */

namespace Classes;


class Domainhandler
{
    public function checkDomain($domain){



        if(!isset($domain) && empty($_SESSION['dominio'])){
            return false;
        }


        global $dbh;

        $stmt = $dbh->prepare('SELECT COUNT(*) as quanti FROM phpauth_authorized_domain WHERE name = :domain');
        $stmt ->bindParam(':domain',$domain);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($result['quanti'] == 1){ return true;}

        return false;
    }

	public function getDomainFromCookie($cookie){

if(!isset($cookie)){
            throw new \Exception('non riesco a prelevare dominio');
        }


        global $dbh;

        $stmt = $dbh->prepare('SELECT name FROM phpauth_authorized_domain WHERE id = (SELECT domain_id from phpauth_cookie_request where token = :token)');
        $stmt ->bindParam(':token',$cookie);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(isset($result['name']) &&  $result['name'] != ''){ return $result['name'];}

        throw new \Exception('non riesco a prelevare dominio');
	
	}

	public function isAuthorized($user_id,$domain):bool
    {

        global $dbh;

        $stmt = $dbh->prepare('SELECT count(*) as ctn FROM phpauth_domain_user_authorization WHERE user_id = :uid and domain_id = (SELECT domain_id from phpauth_authorized_domain where name = :name)');
        $stmt ->bindParam(':uid',$user_id);
        $stmt ->bindParam(':name',$domain);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return ($result['cnt'] == 1);



    }

    public function getDomains($user_id){
        global $dbh;

        $stmt = $dbh->prepare('SELECT name FROM phpauth_authorized_domain as ad JOIN phpauth_domain_user_authorization dua On ad.id = dua.domain_id WHERE dua.user_id = :uid ');
        $stmt ->bindParam(':uid',$user_id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

}
