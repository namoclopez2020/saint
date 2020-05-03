<?php

  $page_title = 'Lista de boletas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   existe_por_lo_menos_una_sucursal();
  
   existe_sucursal_seleccionada();
   $sucursal =usar_sucursal();
   esta_configurado();
   $all_cuentas_por_pagar =cuentas_por_pagar($sucursal[0]);
   include('layouts/header.php');
   include('layouts/navigation.php');
?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div  class="container" style="padding-top: 60px">
	
    <div class="col-md-12">
		<div class="card card-default">
		<div class="card-header">
		    
			<h4><i class='fa fa-search'></i> Cuentas por pagar</h4>
		</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="myTable" style="width:100%">
						<thead>
							<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
                    <th>Numero de compra</th>
					<th>Cantidad pagada</th>
					<th class=''>Total</th>
					<th class=''>Acciones</th>
					
				</tr>
						</thead>
						<tbody>
                        <?php $cont = 0;
                         foreach ($all_cuentas_por_pagar as $cuentas) : 
                         $cont++;
                         ?>
					<tr>
                    <td><?php echo $cont;?></td>
                    <td><?php echo $cuentas['fecha']?></td>
					<td><?php echo $cuentas['numero_compra']?></td>
                    <td><?php echo dinero($cuentas['pagado'])?></td>
                    <td><?php echo dinero($cuentas['costo_total_compra'])?></td>
                    <td>
					<div class="btn-group">
					<a class="btn btn-info mr-1" href="#" data-toggle="modal" data-target="#myModalpago" onclick="mostrar('<?php echo $cuentas['numero_compra']?>')">Pagar</a>
					
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
	<?php include('modal/nuevo_pago.php')?>
    <?php include_once('layouts/footer.php'); ?>
	<div id="mensaje"></div>
	<script>


function mostrar(compra) {
	$(document).ready(function () {
		$("#result").hide("slow");
		$("#cargar_reporte").show("slow");
		$("#editar_resul").load("./ajax/nuevo_pago.php?compra="+compra, " ", function () {
			$("#editar_resul").show("slow");
			$("#cargar_reporte").hide("slow");
		});
	});
}

function pagar (){
	var parametros = $("#form_pago").serialize();
	$.ajax({
					type: "POST",
					url: "ajax/pago_process.php",
					data: parametros,
					 beforeSend: function(objeto){
					//	$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					display_msg(datos,'success');
					setTimeout('document.location.reload()',2000);
				  }
			});
}
</script>

  </body>
</html>
