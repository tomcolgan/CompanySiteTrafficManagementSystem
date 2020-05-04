<?php 
    require_once "../assets/classes/data.php";
    $data=new data();
    if(isset($_POST["id"]) && isset($_POST["operation"])){
        
        $data->updateOperation($_POST["id"],$_POST["operation"]);
        echo "ok";
    }
    else
        echo "error";

?>