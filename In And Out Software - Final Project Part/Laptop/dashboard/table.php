<?php
require_once "../assets/classes/data.php";
$data=new data();
$d=$data->getAll();
$i=0;

    echo $d;
?>