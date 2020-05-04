<?php

$page_title = 'Nueva factura';
  require_once('includes/load.php');

  // Chequear el nivel del usuario
   page_require_level(1);
   existe_por_lo_menos_una_sucursal();
   esta_configurado();

   existe_sucursal_seleccionada();
   $sucursal =usar_sucursal();
   $general = datos_generales();
   foreach($general as $datos){
	   $moneda = $datos['representacion'];
   }
   
 $all_producto =join_product_table($sucursal[0]);
 
  include('layouts/header.php');
  include('layouts/navigation.php');
   
 
 ?>
 <div class="page">
	  <?php include('layouts/nav_page.php');?>
 <div class="container mt-4">
 <div class="row">
 <div class="col-11 mx-auto mb-2">
 <text class="text-secondary">*Los productos que usan serial estaran disponibles en venta cuando se agreguen todos los numero de serie despues de la compra</text>
 </div>
 </div>
   <div class="container-fluid ">
	  <div class="card">
		  <div class="card-header"><i class="fa fa-edit">Nueva Compra</i></div>
		  <div class="card-body">
		  <form id="datos_compra" method="POST" >
			<div class="form-row">
			<div class="form-group col-md-4 form-group-typeahead">
			  <label for="inputCity">Proveedor</label>
			  <input type="text" class="form-control input-sm" id="nombre_proveedor" placeholder="Selecciona un proveedor" >
					  <input id="id_proveedor" type='hidden'>
     		 
			 
			</div>
			<div class="form-group col-md-4">
     		 <label for="inputCity">RUC</label>
		
			<input type="text" class="form-control input-sm" id="RUC" placeholder="RUC" readonly>
			
			</div>
			<div class="form-group col-md-4">
     		 <label for="inputCity">Telefono</label>
			  <input type="text" class="form-control input-sm" id="tel" placeholder="tel" readonly>
    		</div>	
			</div>
			<div class="form-row">
			<div class="form-group col-md-4">
                      <label class="form-control-label">Fecha</label>
                      <input type="text" id="fecha" value="" class="form-control input-datepicker">
			</div>
			<div class="form-group col-md-2">
			<label class="form-control-label">Pago</label>
							
								<select class='form-control input-sm' id="condiciones">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
								
								</select>
							
			</div>
			<div class="form-group col-md-2">
			<label for="email" class="form-control-label">Tipo de pago</label>
							
								<select class='form-control input-sm' id="tipo_pago" onchange="load()">
									<option value="1">Total</option>
									<option value="2">Parcial</option>
									
								</select>
							
			</div>
			<div class="form-group col-md-4" id="ajax_pago">
   				
							
			</div>
			
			</div>
			<div class="form-row">
				<div class="col-12">
				<div class="pull-right">
						
						<a href="add_provider.php" class="btn btn-secondary " >
						 <span class="fa fa-user"></span> Nuevo proveedor
						</a>
					<!--	<button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-ing"></span> Agregar productos
						</button>-->
						<button type="submit" class="btn btn-success ">
						  <span class="fa fa-print"></span> Imprimir
						</button>
					</div>	
				</div>
			</div>
			</form>
				
		  </div>
	  </div>
   </div>
   <div class="container-fluid">
	   <div class="card bg-light" >
		<div class="card-body">
		<div class="row">
	   <div class="col-12 col-md-8 col-lg-5">
		   <div class="card"><div class="card-header bg-success text-light">Elegir productos</div>
		   <div class="card-body">
		   <div class="table-responsive">
		   <table class="table" id="producto_compra_venta" style="width:100%">
							  <thead>
							<tr  class="warning">
					<th style="width:10%">Código</th>
					<th style="width:20%">Producto</th>
					<th>Categoria</th>
					<th>Stock</th>
					<th>Medidas</th>
					<th>Es Serial</th>
					<th><span class="30%">Cant.</span></th>
					<th><span class="">Costo</span></th>
					<th class='text-center' style="width: 36px;">Agregar</th>
					</tr>	
							</thead>
							<tbody>
                  <?php 
                  $cont = 0;
                  foreach ($all_producto as $producto) :
                     $cont++;
                     ?>
                     <tr>
					 <td><?php echo $producto['codigo_producto']?></td>
                    <td><?php echo $producto['nombre_producto']?></td>
					<td><?php echo $producto['categoria']?></td>
					<td><?php  if($producto['stock_paq']!=NULL || $producto['stock_und']!=NULL){
                      echo  ($producto['stock_paq']!=NULL) ? $producto['stock_paq']." ".$producto['medida_paq']." " : "";
                      echo ($producto['stock_und']!=NULL) ? $producto['stock_und']." ".$producto['medida_und']." " : "";
                    }
                    else{
                        echo "Sin compras registradas";
                    }
                    ?></td>
					<td><?php  echo $producto['medida_paq'] ." / ".$producto['medida_und']?></td>
					<td><?php  echo ($producto['es_serial']) ? 'Si' : 'No'?></td>
					<td>
					
					
					<?php if($producto['usa_empaque']){?>
					<div class="form-group row">
					<input type="number" class="form-control form-control-sm col-2 col-lg-2"   id="cantidad_paq_<?php echo (int)$producto['id_producto']; ?>"  value="0" >
					 <span class="col-4 col-lg-2"><?php echo $producto['medida_paq']?></span>
					 <input type="number" class="form-control form-control-sm col-2 col-lg-2"   id="cantidad_und_<?php echo (int)$producto['id_producto']; ?>"  value="0" >
					 <span class="col-4 col-lg-2"><?php echo $producto['medida_und']?></span>
					 </div>
					 <?php }
					 else{
						 ?>
						 <div class="form-group row">
					
					 <input type="number" class="form-control form-control-sm col-3 ml-3"   id="cantidad_und_<?php echo (int)$producto['id_producto']; ?>"  value="1" >
					 <span class="col-4"><?php echo $producto['medida_und']?></span>
					 </div>
						 <?php 
					 }
					 ?>
				

					</td>
					<td><input type="text" class="form-control form-control-sm col-3" id="costo_prod_<?php echo $producto['id_producto']?>"  ></td>
					<td>
					<a class='btn btn-info'href="#" onclick="agregar('<?php echo (int)$producto['id_producto'] ?>')"><i class="fa fa-plus"></i></a>
					</td>
                   
                  </tr>
                  <?php endforeach;?>
               </tbody>
							  </table>
		   </div>
		   </div>
		</div>
		   
		   
	   </div>
	   
		   <div class="col-12 col-md-6 col-lg-7">
			   <div class="card">
			   <div class="card-header bg-secondary text-light h3">Detalle de compra</div>
			   <div class="card-body" id="resultados"></div>
			   </div>
			  
		</div>
	   
   </div>
		</div>
	   
	   </div>
 
   </div>
   
	
	
		
	<?php include_once('layouts/footer.php'); ?>
	<script type="text/javascript" src="./libs/js/VentanaCentrada.js"></script>
	<script src="./libs/js/nueva_compra.js"></script>

	
    <script>
		function load(){
	var tipo_pago=$('#tipo_pago').find(":selected").val();
$("#loader2").fadeIn('slow');
	$.ajax({
		type:"POST",
		url:'./ajax/tipo_pago.php',
		data:"pago="+tipo_pago,
		 beforeSend: function(objeto){
	$("#ajax_pago").html("Mensaje: Cargando...");
	  },
		success:function(data){
			$("#ajax_pago").html(data);
			
			
			
		}
	})
}



	$(document).ready(function() {

		$('#nombre_proveedor').autocomplete({
			source: function(request, response){
				$.ajax({
					url:"./ajax/autocomplete/proveedores.php",
					dataType:"json",
					data:{q:request.term},
					success: function(data){
						response(data);
					}

				});
			},
			minLength: 1,
			select: function(event,ui){
				event.preventDefault();
								$('#id_proveedor').val(ui.item.id_proveedor);
								$('#nombre_proveedor').val(ui.item.nombre_empresa);
								$('#tel').val(ui.item.telefono);
								$('#RUC').val(ui.item.ruc);
																
          
			}
		});
	

	});
	
					
	
	</script>	
  </body>
</html>