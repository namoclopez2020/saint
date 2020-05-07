<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  existe_por_lo_menos_una_sucursal();
  
  existe_sucursal_seleccionada();
 $sucursal =usar_sucursal();
 esta_configurado();
  //traer los datos
  $nombre_cliente = remove_junk($db->escape($_POST['nombre_cliente']));
  $telefono_cliente = remove_junk($db->escape($_POST['telefono_cliente']));
  $direccion_cliente = remove_junk($db->escape($_POST['direccion_cliente']));
  $email_cliente = remove_junk($db->escape($_POST['email_cliente']));
  $tipo_documento = remove_junk($db->escape($_POST['tipo_doc']));
  $fecha = make_date();
  $grupo_cliente = "Ordinario";
  $pedidos_cliente = remove_junk($db->escape($_POST['pedidos_cliente']));

  if($tipo_documento != 5){
      $numero_documento = remove_junk($db->escape($_POST['numero_documento']));
  }else{
      $numero_documento = "";
  }
  
  //ver si hay algun repetido
  $ver ="SELECT count(id_cliente) as contar FROM cliente WHERE nombre_cliente='{$nombre_cliente}' ";
  $ver.="OR telefono_cliente='{$telefono_cliente}' OR email_cliente='{$email_cliente}' ";
  $ver.="OR nro_documento='{$numero_documento}' ";
  $contar = find_by_sql($ver);
  foreach ($contar as $cont) :
    $repetido = ($cont['contar'] > 0 ) ? true : false;
  endforeach;
  if($repetido){
      $session->msg('d','El cliente ya existe');
      redirect('form-cliente.php',false);
  }

  $sql = "INSERT INTO cliente (nombre_cliente,telefono_cliente,direccion_cliente,email_cliente,tipo_documento,nro_documento,date_added,grupo_cliente,pedidos_cliente) ";
  $sql .="VALUES ('{$nombre_cliente}','{$telefono_cliente}','{$direccion_cliente}','{$email_cliente}','{$tipo_documento}','{$numero_documento}','{$fecha}','{$grupo_cliente}','{$pedidos_cliente}')";
  if($db->query($sql)){
      $session->msg('s','Cliente agregado correctamente');
      redirect('list-cliente.php', false);
  }
  else{
      redirect('form-cliente.php',false);
  }

?>