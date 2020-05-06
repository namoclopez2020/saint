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
    $id_proveedor = remove_junk($db->escape($_POST['id_proveedor']));
    $nombre_proveedor =  remove_junk($db->escape($_POST['nombre_proveedor']));
    $contacto_proveedor =  remove_junk($db->escape($_POST['contacto_proveedor']));
    $telefono_proveedor =  remove_junk($db->escape($_POST['telefono_proveedor']));
    $direccion_proveedor =  remove_junk($db->escape($_POST['direccion_proveedor']));
    $ruc_proveedor =  remove_junk($db->escape($_POST['ruc_proveedor']));

//ver si hay algun repetido
$ver ="SELECT count(idproveedor) as contar FROM proveedor WHERE (nombre='{$nombre_proveedor}' ";
$ver.="OR RUC='{$ruc_proveedor}' OR Telefono='{$telefono_proveedor}') AND idproveedor != {$id_proveedor}";
$contar = find_by_sql($ver);
foreach ($contar as $cont) :
  $repetido = ($cont['contar'] > 0 ) ? true : false;
endforeach;
if($repetido){
    $session->msg('d','El proveedor ya existe');
    redirect('edit_provider.php?id='.$id_proveedor,false);
}

//actualizar proveedor
if(
    
    $db->query("UPDATE proveedor set nombre = '{$nombre_proveedor}' , RUC='{$ruc_proveedor}',
    direccion='{$direccion_proveedor}' , representante = '{$contacto_proveedor}',
    Telefono='{$telefono_proveedor}' where idproveedor=$id_proveedor
")
){  
    $session->msg('s','Proveedor actualizado correctamente');
    redirect('list-provider.php',false);
}else{
    $session->msg('d','Actualizacion fallo');
    redirect('edit_provider.php?id='.$id_proveedor,false);
}

  
}
//caputar el id por GET
 $id_proveedor= remove_junk($db->escape($_GET['id']));
 if(!is_numeric($id_proveedor)){
     redirect('list-provider.php');
 }

 


 $sql = "select * from proveedor where idproveedor=$id_proveedor";
 $datos=$db->query($sql);
 if($db->affected_rows() == 0){
    redirect('list-provider.php',false);
 }
 $all_provider=$datos;
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
                <div class="card-header"><text class="h3">Editar Proveedor</text></div>
                <div class="card-body">
                <form  method="post">
                    <?php foreach ($all_provider as $proveedor) {?>
                <div class="form-group">
                    <label for="nombre_proveedor" >Nombre de la empresa:</label>
                    <input type="hidden" name="id_proveedor" value="<?php echo $proveedor['idproveedor']?>">
                   <input type="text" value="<?php echo $proveedor['nombre']?>" name="nombre_proveedor" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="contacto_proveedor" >Nombre del contacto:</label>
                   <input type="text"  value="<?php echo $proveedor['representante']?>" name="contacto_proveedor" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="telefono_proveedor" >Numero de teléfono:</label>
                   <input type="text"  value="<?php echo $proveedor['Telefono']?>" name="telefono_proveedor" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="direccion_proveedor" >Dirección:</label>
                   <input type="text"  value="<?php echo $proveedor['direccion']?>" name="direccion_proveedor" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_proveedor" >RUC:</label>
                   <input type="text"  value="<?php echo $proveedor['RUC']?>" name="ruc_proveedor" class="form-control form-control-sm">
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
