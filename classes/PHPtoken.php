    <?php
 
    require_once 'config.php';
    
    class PHPtoken {

        private static $dbh_internal;
        private static $auth_internal;

        function __construct(){
            global $dbh;
            global $auth;
            self::$dbh_internal = $dbh;
            self::$auth_internal = $auth;
        }
        
        public function checkToken($method = 'GET'){
            
            if($method != 'GET' && $method != 'POST' && $method != 'REQUEST'){
                echo 'method invalid'; exit;
            }
            
            $token = self::getToken();
            
            if(isset($token)){
                if(!isset($_REQUEST[$token])){
                    echo 'invalid token'; exit;
                }
            }     
            
        }
        
        public function getToken(){
            
            $ip = self::getRealIpAddr();
            $id = self::$auth_internal->getCurrentUID();
            if($id){
                $hash = self::$auth_internal->getHash($id , '8kx;_>h6uMM2@{mU~.]gz!?(');
                $query = self::$dbh_internal->prepare('SELECT token FROM phpauth_tokens WHERE ip = ? AND hash = ?  ORDER BY dt ASC LIMIT 1');

                try{
                    $query->execute(array($ip,$hash));
                    $row = $query->fetch(PDO::FETCH_ASSOC);

                }catch(Exception $e ){
                    echo 'get token error'; exit;
                }


                if(isset($row['token'])){
                    return $row['token'];
                }else{
                    $token = self::createToken();
                    try{
                        self::saveToken($token);

                        return $token;
                    }catch(Exception $e ){
                        echo 'save token method error'; exit;
                    }
                }
            }else{
                echo 'id not valid'; exit;
            }

        }
        
        private function createToken(){
            $length = 32;
            $token = bin2hex(random_bytes($length));
            return $token;
        }
        
        private function saveToken($token){

            $query = self::$dbh_internal->prepare('INSERT INTO phpauth_tokens (token,ip,hash) VALUES(?,?,?)');
            $id = self::$auth_internal->getCurrentUID();
            if($id){
                $hash =self::$auth_internal->getHash($id , '8kx;_>h6uMM2@{mU~.]gz!?(');
                $ip = self::getRealIpAddr();
                try{
                    $query->execute(array($token,$ip,$hash));


                    if(self::$dbh_internal->lastInsertId() == 0)
                        echo 'token not saved'; exit;

                }catch(Exception $e ){
                    echo 'saveToken error'; exit;
                }
            }else{
                echo 'no valid id '; exit;
            }

            
        }
        
        private function getRealIpAddr()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
                $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip=$_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
        
        
    }




