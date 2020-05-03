<?php 

if(isset($_GET['id']) && is_numeric($_GET['id'])):
include('../includes/load.php');
$id_producto = remove_junk($db->escape($_GET['id']));
$nombre_producto = remove_junk($db->escape($_GET['producto']));
$sql = "SELECT prov.nombre,prov.telefono,prov.direccion,prov.representante,prov.RUC FROM proveedor as prov INNER JOIN producto_proveedor as p_p ON prov.idproveedor = p_p.id_proveedor WHERE p_p.id_producto = $id_producto";
$all_proveedor_producto=$db->query($sql);

$sql1="select det.estado,p.medida_paq,p.medida_und,prov.nombre as nombre_proveedor,det.id_detalle,det.numero_compra,det.fecha_agregado,
det.paq,det.und from detalle_producto as det INNER JOIN products as p ON p.id_producto=det.id_producto 
INNER JOIN compras as c ON c.numero_compra=det.numero_compra 
INNER JOIN proveedor as prov ON prov.idproveedor=c.id_proveedor WHERE det.id_producto=$id_producto GROUP BY det.id_detalle";
$all_lotes=$db->query($sql1);

?>
<div class="container">
    <div class="row mb-3">
        <div class="col-12"><text class="text-info h3">Producto: " <text class="text-secondary"><?php echo $nombre_producto ?></text>"</text></div>
    </div>
    <hr>
    <div class="card">
        <div class="card-header h4">Lista de proveedores</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable2" style="width:100%"> 
                    <thead class="bg-light">
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Representante</th>
                        <th>RUC</th>
                    </thead>
                    <tbody>
                        <?php foreach($all_proveedor_producto as $prov):?>
                            <tr>
                            <td><?php echo $prov['nombre']?></td>
                            <td><?php echo $prov['telefono']?></td>
                            <td><?php echo $prov['direccion']?></td>
                            <td><?php echo $prov['representante']?></td>
                            <td><?php echo $prov['RUC']?></td>
                            </tr>
                            
                            
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--lotes -->
<div class="container">
    <div class="card">
        <div class="card-header h3">Lotes existentes</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable"> 
                    <thead class="bg-light">
                        <th>#</th>
                        <th>Numero de compra</th>
                        <th>Cantidad</th>
                        <th>Fecha agregado</th>
                        <th>Proveedor</th>
                        <th>Estado</th>
                       
                    </thead>
                    <tbody>
                        <?php
                         $cont=0 ; 
                        foreach($all_lotes as $lote):
                         $cont++?>
                            <tr>
                            <td><?php echo $cont;?></td>
                            <td class="text-center"><?php echo $lote['numero_compra']?></td>
                            <td><?php echo $lote['paq']." ".$lote['medida_paq']."  ".$lote['und']." ".$lote['medida_und']?></td>
                            <td><?php echo read_date($lote['fecha_agregado'])?></td>
                           <td><?php echo $lote['nombre_proveedor']?></td>
                           <td><?php echo $lote['estado']?></td>
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