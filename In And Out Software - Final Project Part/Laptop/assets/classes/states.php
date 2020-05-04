<?php
    class state{
        public function getStatus(){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            return $pdo->query("select * from settings");
        }

        public function update($type){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            $pdo->exec("update settings set date=now() where type='$type'");
        }
    }
?>