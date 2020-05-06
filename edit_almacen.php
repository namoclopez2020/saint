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
    $id_almacen = remove_junk($db->escape($_POST['id_almacen']));
    $nombre_almacen =  remove_junk($db->escape($_POST['nombre_almacen']));
    $codigo_almacen =  remove_junk($db->escape($_POST['codigo_almacen']));
    $id_sucursal =  remove_junk($db->escape($_POST['sucursal_almacen']));


$sql="SELECT * FROM almacen where (nombre_almacen='{$nombre_almacen}' OR codigo_almacen='{$codigo_almacen}') AND id_almacen != {$id_almacen}";
$res=$db->query($sql);
if($db->affected_rows() > 0){
    $session->msg('d','Los datos coinciden con otro almacen en uso');
    redirect('edit_almacen.php?id='.$id_almacen,false);
}
if(
    
    $db->query("UPDATE almacen set nombre_almacen = '{$nombre_almacen}' , codigo_almacen='{$codigo_almacen}',
id_sucursal='{$id_sucursal}' where id_almacen=$id_almacen
")
){  
    $session->msg('s','Almacen actualizado correctamente');
    redirect('list-almacen.php',false);
}else{
    $session->msg('d','Actualizacion fallo');
    redirect('edit_almacen.php?id='.$id_almacen,false);
}

  
}
//caputar el id por GET
 $id_almacen= remove_junk($db->escape($_GET['id']));
 if(!is_numeric($id_almacen)){
     redirect('list-almacen.php');
 }




 $sql = "select * from almacen where id_almacen=$id_almacen";
 $datos=$db->query($sql);
 if($db->affected_rows() == 0){
    redirect('list-almacen.php',false);
 }
 //ver si el almacen ya esta en produccion
$verificar_query ="SELECT count(id_producto) as contar from products where id_almacen={$id_almacen}";
$verificar=find_by_sql($verificar_query);
foreach ($verificar as $count) :
    $en_uso = ($count['contar'] > 0 ) ? true : false;
endforeach;

if($en_uso){
    $session->msg('d','El almacen ya esta en produccion');
    redirect('list-almacen.php',false);
}

 $all_almacen=$datos;
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
                <div class="card-header"><text class="h3">Editar Almacen</text></div>
                <div class="card-body">
                <form  method="post">
                    <?php foreach ($all_almacen as $almacen) {?>
                <div class="form-group">
                    <label for="nombre_almacen" >Nombre del almacen:</label>
                    <input type="hidden" name="id_almacen" value="<?php echo $almacen['id_almacen']?>">
                   <input type="text" value="<?php echo $almacen['nombre_almacen']?>" name="nombre_almacen" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Codigo de almacen:</label>
                   <input type="text"  value="<?php echo $almacen['codigo_almacen']?>" name="codigo_almacen" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="sucursal_almacen" >Seleccione sucursal:</label>
                    <select name="sucursal_almacen" class="form-control">
                    <?php  foreach ($all_sucursales as $suc): ?>
                      <option value="<?php echo $suc['id'] ?>" 
                      
                      <?php 
                      if($almacen['id_sucursal'] == $suc['id']){
                          echo "selected";
                      }
                      ?>  >
                        <?php echo $suc['nombre_sucursal'] ?></option>
                    <?php endforeach; 
                    
                    ?>
</select>
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
