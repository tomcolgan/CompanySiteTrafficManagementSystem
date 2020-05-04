<?php
    if(isset($_POST["data"])){
        require_once "../assets/classes/data.php";
        $data=new data();
        $data->add($_POST["data"]);
        echo "ok";
    }
?>