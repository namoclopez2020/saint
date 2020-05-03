<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 existe_sucursal_seleccionada();
$sucursal =usar_sucursal();
esta_configurado();
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
                <div class="card-header"><text class="h3">Crear almacen</text></div>
                <div class="card-body">
                <form action="process-almacen.php" method="post">
                <div class="form-group">
                    <label for="nombre_almacen" >Nombre del almacen:</label>
                   <input type="text" name="nombre_almacen" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Codigo de almacen:</label>
                   <input type="text" name="codigo_almacen" class="form-control form-control-sm">
                </div>
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