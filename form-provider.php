<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 existe_sucursal_seleccionada();
$sucursal =usar_sucursal();
esta_configurado();
 include('layouts/header.php');
 include('layouts/navigation.php');

?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Agregar proveedor</text></div>
                <div class="card-body">
                <form action="process_provider.php" method="post">
                <div class="form-group">
                    <label for="nombre_almacen" >Nombre de la empresa:</label>
                   <input type="text" name="nombre_empresa" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Nombre del contacto:</label>
                   <input type="text" name="nombre_contacto" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Numero de telefono:</label>
                   <input type="text" name="telefono_proveedor" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Direccion:</label>
                   <input type="text" name="direccion_proveedor" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >RUC:</label>
                   <input type="text" name="ruc_proveedor" class="form-control form-control-sm">
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