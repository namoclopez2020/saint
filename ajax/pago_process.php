<?php
include('../includes/load.php');
page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 esta_configurado();

 existe_sucursal_seleccionada();
$sucursal = usar_sucursal();

if(!isset($_POST['pago'])){
    echo "";
}
else{
    $pago = remove_junk($db->escape($_POST['pago']));
    $medio_pago = remove_junk($db->escape($_POST['medio_pago']));
    $numero_compra = remove_junk($db->escape($_POST['num_compra']));
}

?>