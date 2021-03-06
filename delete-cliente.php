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
    $cliente = find_by_id_cliente('cliente',(int)$_GET['id']);
    if(!$cliente){
      $session->msg("d","ID del cliente no existe.");
      redirect('list-provider.php');
    } 
    //ver si cliente esta en uso 
    $verificar_query ="SELECT count(id) as contar from ventas where  id_cliente={$cliente['id_cliente']}";
$verificar=find_by_sql($verificar_query);
foreach ($verificar as $count) :
    $en_uso = ($count['contar'] > 0 ) ? true : false;
endforeach;

if($en_uso){
    $session->msg('d','El cliente esta registrado en alguna venta');
    redirect('list-cliente.php',false);
}

//borrar proveedor
    $delete_id = delete_by_campo('cliente',(int)$cliente['id_cliente'],'id_cliente');
    if($delete_id){
        $session->msg("s","Cliente Eliminado");
        redirect('list-cliente.php');
    } else {
        $session->msg("d","Eliminación falló");
        redirect('list-cliente.php');
    }
}
?>