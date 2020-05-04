<?php
 error_reporting(0);
    require_once "../assets/classes/states.php";
    $state=new state();
    $s=$state->getStatus();
    $date = date('m/d/Y h:i:s a', time());
    $dateStr = strtotime($date);
    $mm= date('i', $dateStr);
    
    $x=0;
    $tab=array();
    foreach($s as $ss){
        $dd= $dateStr - strtotime($ss[2])  ;
        if($dd<60)
            $tab[count($tab)]="on";
        else
            $tab[count($tab)]="off";
    }
    //echo json_encode(array("data"=>$array));
?>
<?php ?>
<!-- set font to Comic Sans, and use a defined margin -->
<!-- setting status of raspberry pi and camera, but i couldnt get this part to work right -->
<table style="font-family: Comic Sans MS;margin-left:15px">
    <tr>
        <th style="padding-bottom:10px;">Camera</th>
        <th style="padding-bottom:10px;padding-left:5px"><span class="dot" <?php if($tab[0] == "on") echo 'style="background-color:#00ff00;"' ; else echo 'style="background-color:#ff0000;"';?>></span></th>
    </tr>
    <tr>
        <th>Raspberry</th>
        <th style="padding-left:5px"><span class="dot" <?php if($tab[1] == "on") echo 'style="background-color:#00ff00;"' ; else echo 'style="background-color:#ff0000;"';?>></span></th>
    </tr>
</table>