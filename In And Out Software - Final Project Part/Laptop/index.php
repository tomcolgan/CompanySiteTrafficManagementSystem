<?php 
    session_start();
    if(isset($_SESSION["user"])){
        header('location: dashboard/');
    }
    else
    {
        header('location: login/');

    }