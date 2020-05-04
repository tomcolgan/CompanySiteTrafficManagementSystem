<?php
    class data{
//   Title: PDO::exec
//   Author: The PHP Group
//   Date: 2020
//   Availability: https://www.php.net/manual/en/pdo.exec.php
// 	 I modified the pdo exec for the function call, for sql
		public function add($data){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            $pdo->exec("insert into data(data, operation, date) values ('$data','N',now())") or print_r($pdo->errorInfo());
        }
//   Title: SELECT query with PDO
//   Author: Riya Basak
//   Date: 2020
//   Availability: https://phpdelusions.net/pdo_examples/select
// 	 I modified the pdo query for the select and id
        public function get($id){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            return $pdo->query("select * from data where id=$id");        
        }

        public function getAll(){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            //return $pdo->query("select * from data");
            $statement = $pdo->prepare("SELECT * FROM DATA");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
return json_encode($results);
        }

        public function getAll2(){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            return $pdo->query("select * from data");
            
        }

        public function updateOperation($id,$op){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            $pdo->exec("update data set operation='$op' , date=now() where id=$id");
        }

    }
?>