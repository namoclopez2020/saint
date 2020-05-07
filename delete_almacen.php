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
    $almacen = find_by_id_almacen('almacen',(int)$_GET['id']);
    if(!$almacen){
      $session->msg("d","ID del almacen no existe.");
      redirect('list-almacen.php');
    } 
    //ver si almacen esta en uso 
    $verificar_query ="SELECT count(id_producto) as contar from products where id_almacen={$almacen['id_almacen']}";
$verificar=find_by_sql($verificar_query);
foreach ($verificar as $count) :
    $en_uso = ($count['contar'] > 0 ) ? true : false;
endforeach;

if($en_uso){
    $session->msg('d','El almacen ya esta en produccion');
    redirect('list-almacen.php',false);
}

//borrar almacen
    $delete_id = delete_by_campo('almacen',(int)$almacen['id_almacen'],'id_almacen');
    if($delete_id){
        $session->msg("s","Almacen Eliminado");
        redirect('list-almacen.php');
    } else {
        $session->msg("d","Eliminación falló");
        redirect('list-almacen.php');
    }
}
?>