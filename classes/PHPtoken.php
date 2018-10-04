    <?php
 
    require_once 'config.php';
    
    class PHPtoken {
        
        private static $dbh_internal;
        
        function __construct(){
            global $dbh;
            self::$dbh_internal = $dbh;
        }
        
        public function checkToken($method = 'GET'){
            
            if($method != 'GET' && $method != 'POST'){
                echo 'method invalid'; exit;
            }
            
            $token = self::getToken();
            
            if(isset($token)){
                if($method == 'GET'){
                    if(!isset($_GET[$token])){
                        echo 'invalid token'; exit;
                    } 
                }else{
                    if(!isset($_POST[$token])){
                        echo 'invalid token'; exit;
                    } 
                }                
            }     
            
        }
        
        public function getToken(){
            
            $ip = self::getRealIpAddr();
            $query = self::$dbh_internal->prepare('SELECT token FROM phpauth_tokens WHERE ip = ? ORDER BY dt ASC LIMIT 1');
            
            try{
                $query->execute(array($ip));
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
        }
        
        private function createToken(){
            $length = 32;
            $token = bin2hex(random_bytes($length));
            return $token;
        }
        
        private function saveToken($token){
            
            $query = self::$dbh_internal->prepare('INSERT INTO phpauth_tokens (token,ip) VALUES(?,?)');
            $ip = self::getRealIpAddr();
            try{
                $query->execute(array($token,$ip));
             
                if(self::$dbh_internal->lastInsertId() == 0) 
                    echo 'token not saved'; exit;
                
            }catch(Exception $e ){
                echo 'saveToken error'; exit;
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

    //$phptoken = new PHPtoken();
    //echo $phptoken->getToken();
    //$phptoken->checkToken('GET');


