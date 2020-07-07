<?php
if(isset($_SESSION["messages"])){
    //print_r($clib->render_flash_msg()["msg"]);
    $msgs=$clib->render_flash_msg();
    
    if($msgs["type"]){
        
        echo '<div class="alert alert-success fade show text-center" role="alert">
            <li class="fa fa-info-circle" ></li> <b>'.$msgs["msg"].'</b>.
        </div>';
        
       // echo '<div class="widget-header bordered no-actions d-flex align-items-center"><h2 style="color:green">' . $msgs["msg"] . '</h2></div>';
    }else{
        
        echo '<div class="alert alert-danger fade show text-center" role="alert">
            <li class="fa fa-info-circle" ></li> <b>'.$msgs["msg"].'</b>.
        </div>';
        //echo '<div class="widget-header bordered no-actions d-flex align-items-center"><h2 style="color:red">' . $msgs["msg"] . '</h2></div>';
    }
}

?>