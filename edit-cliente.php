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

if(isset($_POST['actualizar'])){
    $id_cliente = remove_junk($db->escape($_POST['id_cliente']));
    $nombre_cliente = remove_junk($db->escape($_POST['nombre_cliente']));
    $telefono_cliente = remove_junk($db->escape($_POST['telefono_cliente']));
    $direccion_cliente = remove_junk($db->escape($_POST['direccion_cliente']));
    $email_cliente = remove_junk($db->escape($_POST['email_cliente']));
    $tipo_doc = remove_junk($db->escape($_POST['tipo_doc']));
    $credito_max = remove_junk($db->escape($_POST['credito_max']));
    
    $restante = find_by_sql("SELECT credito_restante from cliente where id_cliente='{$id_cliente}'");
    foreach($restante as $rest):
        $credito_restante = $rest['credito_restante'];
    endforeach;
    
    $new_credito_restante = $credito_restante + ($credito_max-$credito_restante);


    if($tipo_doc != 5 ){
        $nro_documento = remove_junk($db->escape($_POST['numero_documento']));
    }
    else{
        $nro_documento = "";
    }
    $pedidos = remove_junk($db->escape($_POST['pedidos_cliente']));
  

//ver si hay algun repetido
$ver ="SELECT count(id_cliente) as contar FROM cliente WHERE (nombre_cliente='{$nombre_cliente}' ";
  $ver.="OR telefono_cliente='{$telefono_cliente}' OR email_cliente='{$email_cliente}' ";
  $ver.="OR nro_documento='{$nro_documento}')  AND id_cliente != {$id_cliente}";
  $contar = find_by_sql($ver);
  foreach ($contar as $cont) :
    $repetido = ($cont['contar'] > 0 ) ? true : false;
  endforeach;
  if($repetido){
      $session->msg('d','El cliente ya existe');
      redirect('edit-cliente.php?id='.$id_cliente,false);
  }

//actualizar proveedor
$actualizar= "UPDATE cliente set nombre_cliente = '{$nombre_cliente}', telefono_cliente = '{$telefono_cliente}' ,";
$actualizar .="direccion_cliente = '{$direccion_cliente}', email_cliente = '{$email_cliente}', tipo_documento='{$tipo_doc}',";
$actualizar .="nro_documento = '{$nro_documento}', credito_max = '{$credito_max}', credito_restante = '{$new_credito_restante}' where id_cliente={$id_cliente}";


if($db->query($actualizar)){
    $session->msg('s','Datos de cliente actualizado correctamente');
    redirect('list-cliente.php',false);
}
else{
    $session->msg('d','Error al actualizar');
    redirect('list-almacen.php',false);
}
}


//caputar el id por GET
 $id_cliente= remove_junk($db->escape($_GET['id']));
 if(!is_numeric($id_cliente)){
     redirect('list-provider.php');
 }


 $all_docs = find_all_docs();
 $sql="SELECT c.credito_max,c.credito_restante,c.tipo_documento,c.id_cliente,tip.documento,c.nombre_cliente,c.telefono_cliente,c.direccion_cliente,c.email_cliente,c.nro_documento,c.date_added,";
 $sql.="c.grupo_cliente,c.pedidos_cliente FROM cliente as c INNER JOIN tipo_documento as tip ON tip.id=c.tipo_documento ";
 $sql.="WHERE id_cliente={$id_cliente}";
 $datos=$db->query($sql);
 if($db->affected_rows() == 0){
    redirect('list-cliente.php',false);
 }
 $all_clientes=$datos;
 $all_sucursales = find_all('sucursales');
 include('layouts/header.php');
 include('layouts/navigation.php');
?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Editar Cliente</text></div>
                <div class="card-body">
                <form  method="post">
                    <?php foreach ($all_clientes as $cliente) {?>
                <div class="form-group">
                    <label for="nombre_proveedor" >Nombre:</label>
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']?>">
                   <input type="text" value="<?php echo $cliente['nombre_cliente']?>" name="nombre_cliente" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="contacto_cliente" >Teléfono:</label>
                   <input type="text"  value="<?php echo $cliente['telefono_cliente']?>" name="telefono_cliente" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="telefono_cliente" >Dirección:</label>
                   <input type="text"  value="<?php echo $cliente['direccion_cliente']?>" name="direccion_cliente" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="direccion_proveedor" >Email:</label>
                   <input type="email"  value="<?php echo $cliente['email_cliente']?>" name="email_cliente" class="form-control form-control-sm">
                </div>
               <div class="form-group">
               <label for="tipo_doc" >Seleccione tipo de documento:</label>
                    <select name="tipo_doc" class="form-control" id="tipo_doc" onchange="elegir_documento()">
                    <?php  foreach ($all_docs as $doc): ?>
                      <option value="<?php echo $doc['id'] ?>" <?php echo ($doc['id'] == $cliente['tipo_documento']) ? 'selected' : '' ?>>
                        <?php echo $doc['documento'] ?></option>
                    <?php endforeach; ?>
                </select>
               </div>
               <div class="form-group" id="numero_doc">
                <label for="codigo_almacen" >Numero de documento:</label>
                 <input type="text" name="numero_documento" class="form-control form-control-sm" value="<?php echo $cliente['nro_documento']?>">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Pedidos:</label>
                   <input type="text" name="pedidos_cliente" class="form-control form-control-sm" value="<?php echo $cliente['pedidos_cliente']?>">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Linea de credito:</label>
                   <input type="text" name="credito_max" class="form-control form-control-sm" value="<?php echo $cliente['credito_max']?>">
                </div>
                    <?php }?>
                <div class="form-group">
                    <button type="submit" name="actualizar" class="btn btn-primary btn-block" >Actualizar</button>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php 
include('layouts/footer.php');
                    
?>
<script>
function elegir_documento() {
    var doc=$('#tipo_doc').find(":selected").val();
   if(doc == 5){
       $('#numero_doc').hide();
   }else{
       $('#numero_doc').show();
   }
}
</script>