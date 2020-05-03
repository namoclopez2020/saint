<?php
include('includes/load.php');
page_require_level(3);
existe_por_lo_menos_una_sucursal();



if(isset($_POST['sucursal_almacen'])){
 $id_sucursal = remove_junk($db->escape($_POST['sucursal_almacen']));
 
 //generar las variables de sesion
 $session->elegir_sucursal($id_sucursal);
 if(isset($_SESSION['id_sucursal'])){
 
 $session->msg("s", "Bienvenido a sistema de inventario, Sucursal: ".$_SESSION['nombre_sucursal']);
 redirect('admin.php',false);
}
}else{

}
?>