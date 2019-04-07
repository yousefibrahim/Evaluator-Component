<?php
 // database class make connection with sql and return data
class DB {
        public $pdo;
        public function __construct($host, $dbname, $username, $password) {
                $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
        }
        public function query($query, $params = array()) {
                $statement = $this->pdo->prepare($query);
                $statement->execute($params);
                /*if(explode((' ',$query,[,0])=='SELECT')*/ {
                $data = $statement->fetchAll();
                return $data;
				}
				
                
        }
}








?>
