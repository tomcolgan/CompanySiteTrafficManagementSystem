<?php

    if(isset($_POST["R"])){
        require_once "../assets/classes/states.php";
        $state=new state();
        echo "ok?";  
        if($_POST["R"] == "ON")
            $state->update('r');
        if($_POST["C"] == "ON")
            $state->update('c'); 

    }
	
    //{'R': 'ON','C': 'ON'}
?>
