<?php
$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();

 existe_sucursal_seleccionada();
$sucursal =usar_sucursal();
esta_configurado();
//accion del boton actualizar
if(isset($_GET['id'])){
    $proveedor = find_by_id_proveedor('proveedor',(int)$_GET['id']);
    if(!$proveedor){
      $session->msg("d","ID del proveedor no existe.");
      redirect('list-provider.php');
    } 
    //ver si proveedor esta en uso 
    $verificar_query ="SELECT count(id_producto) as contar from producto_proveedor where  id_proveedor={$proveedor['idproveedor']}";
$verificar=find_by_sql($verificar_query);
foreach ($verificar as $count) :
    $en_uso = ($count['contar'] > 0 ) ? true : false;
endforeach;

if($en_uso){
    $session->msg('d','El proveedor ya esta en produccion');
    redirect('list-provider.php',false);
}

//borrar proveedor
    $delete_id = delete_by_campo('proveedor',(int)$proveedor['idproveedor'],'idproveedor');
    if($delete_id){
        $session->msg("s","Proveedor Eliminado");
        redirect('list-provider.php');
    } else {
        $session->msg("d","Eliminación falló");
        redirect('list-provider.php');
    }
}
?>