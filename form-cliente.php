<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 existe_sucursal_seleccionada();
$sucursal =usar_sucursal();
$all_docs = find_all_docs();
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
                <div class="card-header"><text class="h3">Agregar cliente</text></div>
                <div class="card-body">
                <form action="process_cliente.php" method="post">
                <div class="form-group">
                    <label for="nombre_almacen" >Nombre:</label>
                   <input type="text" name="nombre_cliente" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Teléfono:</label>
                   <input type="text" name="telefono_cliente" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Dirección:</label>
                   <input type="text" name="direccion_cliente" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Email:</label>
                   <input type="email" name="email_cliente" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="tipo_doc" >Seleccione tipo de documento:</label>
                    <select name="tipo_doc" class="form-control" id="tipo_doc" onchange="elegir_documento()">
                    <?php  foreach ($all_docs as $doc): ?>
                      <option value="<?php echo $doc['id'] ?>">
                        <?php echo $doc['documento'] ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                <div class="form-group" id="numero_doc">
                <label for="codigo_almacen" >Numero de documento:</label>
                 <input type="text" name="numero_documento" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Pedidos:</label>
                   <input type="text" name="pedidos_cliente" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="codigo_almacen" >Crédito:</label>
                   <input type="number" name="credito_cliente" class="form-control form-control-sm" value="0">
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