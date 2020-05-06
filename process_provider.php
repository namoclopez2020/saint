<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  existe_por_lo_menos_una_sucursal();
  
  existe_sucursal_seleccionada();
 $sucursal =usar_sucursal();
 esta_configurado();
  //traer los datos
  $nombre_empresa =  remove_junk($db->escape($_POST['nombre_empresa']));
  $nombre_contacto =  remove_junk($db->escape($_POST['nombre_contacto']));
  $telefono_proveedor =  remove_junk($db->escape($_POST['telefono_proveedor']));
  $direccion_proveedor = remove_junk($db->escape($_POST['direccion_proveedor']));
  $ruc_proveedor = remove_junk($db->escape($_POST['ruc_proveedor']));

  $sql = "INSERT INTO proveedor (nombre,RUC,representante,direccion,Telefono) VALUES ('{$nombre_empresa}','{$ruc_proveedor}','{$nombre_contacto}','{$direccion_proveedor}','{$telefono_proveedor}')";
  if($db->query($sql)){
      $session->msg('s','Proveedor agregado correctamente');
      redirect('list-provider.php', false);
  }
  else{
      redirect('form-provider.php',false);
  }

?>