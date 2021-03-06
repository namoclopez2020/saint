<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  existe_por_lo_menos_una_sucursal();
  
  existe_sucursal_seleccionada();
 $sucursal =usar_sucursal();
 esta_configurado();
  //traer los datos
  $nombre_almacen =  remove_junk($db->escape($_POST['nombre_almacen']));
  $codigo_almacen =  remove_junk($db->escape($_POST['codigo_almacen']));
  $id_sucursal =  remove_junk($db->escape($_POST['sucursal_almacen']));

  //verificar si ya existe 
  $ver = "SELECT count(id_almacen) as contar FROM almacen where nombre_almacen='{$nombre_almacen}' OR codigo_almacen='{$codigo_almacen}'";
  $cuenta = find_by_sql($ver);
  foreach( $cuenta as $contar):
    $repetido = ($contar['contar'] > 0) ? true : false;
  endforeach;
  if($repetido){
    $session->msg('d',$repetido);
    redirect('form-almacen.php',false);
  }

  $sql = "INSERT INTO almacen (nombre_almacen,codigo_almacen,id_sucursal) VALUES ('{$nombre_almacen}','{$codigo_almacen}','{$id_sucursal}')";
  if($db->query($sql)){
    $session->msg('s','Almacen agregado correctamente');
    redirect('list-almacen.php', false);
  }
  else{
      redirect('form-almacen.php',false);
  }

?>