<?php
    class user{
//this is the function for login process for id and password
        public function login($id,$password){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            return $pdo->query("select count(*) from user where id='$id' and password='$password'")->fetchColumn();
        }
//for updating password
        public function updatePassword($id,$password){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            $pdo->exec("update user set password='$password' where id='$id'");
        }
//for getting the password using user id
        public function getPassword($id){
            require_once "../assets/config/config.php";
            $c=new config();
            $pdo=$c->cnx();
            $res= $pdo->query("select password from user where id='$id'");
            foreach($res as $r){
                return $r[0];
            }
        }
    }
?>