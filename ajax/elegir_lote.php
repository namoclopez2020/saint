<?php
include('../includes/load.php');
if(!isset($_POST['lote'])){
    redirect('product-list.php',false);
}
else{
    if($_POST['lote'] == ""){
        unset($_SESSION['lote']);
    }else{
    $_SESSION['lote']=remove_junk($db->escape($_POST['lote']));
    }
}

?>