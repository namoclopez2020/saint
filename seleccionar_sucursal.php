<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(3); 
 existe_por_lo_menos_una_sucursal();
 

 $id_usuario =  $_SESSION['user_id'];
 //generar los demas datos del usuario en variables de sesion
 $sql="Select u.name,ug.group_name,u.image from users as u INNER JOIN user_groups as ug ON u.user_level= ug.id where u.id=$id_usuario";
 $datos = $db->query($sql);
 while($data = $db->fetch_array($datos)){
     $_SESSION['nombre_usuario']=$data['name'];
     $_SESSION['rol_usuario']= $data['group_name'];
     $_SESSION['logo_imagen']=$data['image'];
 
 }
 $all_sucursales=find_all('sucursales');
 include('layouts/header.php');
 include('layouts/navigation.php');

?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Elegir sucursal de trabajo</text></div>
                <div class="card-body">
                <form action="process-sucursal.php" method="post">
               
                <div class="form-group">
                    <label for="sucursal_almacen" >Seleccione sucursal:</label>
                    <select name="sucursal_almacen" class="form-control">
                    <?php  foreach ($all_sucursales as $suc): ?>
                      <option value="<?php echo $suc['id'] ?>">
                        <?php echo $suc['nombre_sucursal'] ?></option>
                    <?php endforeach; ?>
</select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" >Guardar</button>
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