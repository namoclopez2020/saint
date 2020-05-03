<?php

  $page_title = 'Lista de boletas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   existe_por_lo_menos_una_sucursal();
  
   existe_sucursal_seleccionada();
   $sucursal =usar_sucursal();
   esta_configurado();
   $all_compras =join_compras_table($sucursal[0]);
   include('layouts/header.php');
   include('layouts/navigation.php');
?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div  class="container" style="padding-top: 60px">
	
    <div class="col-md-12">
		<div class="card card-default">
		<div class="card-header">
		    <div class="btn-group pull-right">
				<a  href="nueva_compra.php" class="btn btn-info"><span class="fa fa-plus" ></span> Nueva Compra</a>
			</div>
			<h4><i class='fa fa-search'></i> Buscar Compras</h4>
		</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="myTable" style="width:100%">
						<thead>
							<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
					<th>Medio de Pago</th>
					<th>Estado</th>
					<th>Cantidad pagada</th>
					<th class=''>Total</th>
					<th class=''>Acciones</th>
					
				</tr>
						</thead>
						<tbody>
						<?php foreach ($all_compras as $compras) :?>
					<tr>
					<td><?php echo $compras['numero_compra']?></td>
					<td><?php echo $compras['fecha']?></td>
					<td><?php 
					switch ($compras['metodo_pago']) {
    			case 1:
      				echo "Efectivo";
       			break;
    			case 2:
       			 echo "Cheque";
				break;
				case 3:
       			 echo "Tranferencia";
				break;
				case 4:
       			 echo "Credito";
				break;
								}
					?></td>
					<td><?php 
					switch ($compras['status_compra']) {
    			case 'Total':
      				echo "<span class='badge badge-pill badge-success'>Pagado</span>";
       			break;
    			case 'Parcial':
       			 echo "<span class='badge badge-pill badge-warning'>Parcial</span>";
				break;
								}
					?></td>
					<td class="text-center"><?php echo dinero($compras['pagado']);?></td>
					<td><?php echo dinero($compras['costo_total_compra']);?></td>
					<td>
					<div class="btn-group">
					<a class="btn btn-info mr-1" href="#" data-toggle="modal" data-target="#myModalcompras" onclick="mostrar('<?php echo $compras['numero_compra']?>')">Detalles</a>
					<a href="" class="btn btn-secondary"><span class="fa fa-print"> PDF</span></a>
					</div>
					</td>
					</tr>
						<?php endforeach;?>
						</tbody>
					</table>
 				</div>
			</div>
		</div>	
		
	</div>
	</div>
	</div>
	<?php include('modal/ver_detalle_compra.php')?>
    <?php include_once('layouts/footer.php'); ?>
	<script>

function mostrar(compra) {
	$(document).ready(function () {
		$("#result").hide("slow");
		$("#cargar_reporte").show("slow");
		$("#editar_resul").load("./ajax/ver_detalle_compra.php?compra="+compra, " ", function () {
			$("#editar_resul").show("slow");
			$("#cargar_reporte").hide("slow");
		});
	});
}

</script>
  </body>
</html>
