<?php 

if(isset($_GET['compra']) && is_numeric($_GET['compra'])):
include('../includes/load.php');
$numero_compra = remove_junk($db->escape($_GET['compra']));

$sql = "SELECT p.medida_paq,p.medida_und,p.nombre_producto,det.cant_paq,det.cant_und,det.costo_compra,det.id_detalle_comp FROM detalle_compra as det ";
$sql.= "INNER JOIN products as p ON p.id_producto = det.id_producto_compra where det.num_compra=$numero_compra ";
$sql.= "GROUP BY det.id_detalle_comp";
$compras = find_by_sql($sql);

//pagos
$pagos = find_pagos($numero_compra);

?>
<div class="container">
    <div class="row mb-3">
       
    </div>
    <hr>
    <div class="card">
        <div class="card-header h4">Lista de productos</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable2" style="width:100%"> 
                    <thead class="bg-light">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
                       
                    </thead>
                    <tbody>
                    <?php
                    $cont = 0;
                    foreach ($compras as $compra) : $cont++?>
                    <tr>
                    <td><?php echo $cont; ?></td>
                    <td><?php echo $compra['nombre_producto']?></td>
                    <td><?php echo $compra['cant_paq']." ".$compra['medida_paq']." / ".$compra['cant_und']." ".$compra['medida_und']?></td>
                    <td><?php echo dinero($compra['costo_compra']);?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- pagos -->
<div class="container">
    <div class="row mb-3">
       
    </div>
    <hr>
    <div class="card">
        <div class="card-header h4">Pagos</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable2" style="width:100%"> 
                    <thead class="bg-light">
                        <th>#</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Método de pago</th>
                       
                    </thead>
                    <tbody>
                    <?php
                    $cont = 0;
                    foreach ($pagos as $pago) : $cont++?>
                    <tr>
                    <td><?php echo $cont; ?></td>
                    <td><?php echo dinero($pago['monto_pagado'])?></td>
                    <td><?php echo read_date($pago['fecha_pago'])?></td>
                    <td><?php echo $pago['name'];?></td>
                    <td><?php echo $pago['metodo_pago']?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php




endif;
?>