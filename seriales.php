<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 esta_configurado();

 existe_sucursal_seleccionada();
$sucursal = usar_sucursal();


if(!isset($_POST["id_producto"]) && !isset($_SESSION['id_producto'])){
    redirect('product-list.php',false);
}
if(isset($_SESSION['lote'])){
    $lote = $_SESSION['lote'];
}
else {
    $lote="";
}
if(isset($_POST['id_producto'])){
    $id_producto=remove_junk($db->escape($_POST['id_producto']));
    $_SESSION['id_producto'] = $id_producto;
}else{

}



$id_producto= $_SESSION['id_producto'];
$lotes = find_all_lotes($_SESSION['id_producto']);
$all_seriales = all_seriales_of_product($_SESSION['id_producto'],$lote);
$consulta="SELECT nombre_producto from products where id_producto =$id_producto ";
$query = find_by_sql($consulta);
foreach($query as $prod):
    $nombre_producto = $prod['nombre_producto'];
endforeach;

 include('layouts/header.php');
 include('layouts/navigation.php');

?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div class="container mt-4 pt-4">
<div class="row">
<div class="col-5">
<div class="card">
<div class="card-header">Agregar Serial</div>
<div class="card-body">
<form action="agregar_serial.php" method="POST">
<div class="form-group">
<input type="text" class="form-control" name="serial_number">
</div>
<div class="form-group">
<button type="submit" class="btn btn-success btn-block" name="agregar_serial">Agregar</button>
</div>
</form>
</div>
</div>
</div>
<div class="col-7">
    <div class="card">
         <div class="card-header">
         Lista de Seriales de "<?php echo $nombre_producto?>"
         </div>
         <div class="card-body">
         <div class="row mb-4">
         <div class="col-12">
         <div class="form-group">
         <select class='form-control input-sm' id="lote" onchange="elegir_lote()">
									<option value="">Elegir lote</option>
									<?php foreach($lotes as $lot):?>
                                    <option value="<?php echo $lot['id_detalle']?>"<?php echo ($lote==$lot['id_detalle']) ? 'selected' : '' ?>><?php echo $lot['fecha']." -- ".$lot['estado']?></option>
                                    <?php endforeach;?>
								</select>
         </div>
								
         </div>
         </div>
         <div class="table-responsive">
         <table id="myTable">
         <thead>
         <th>Serial</th>
         <th>Estado</th>
         <th>Lote</th>
         </thead>
         <tbody>
         <?php foreach($all_seriales as $serial):?>
         <tr>
         <td><?php echo $serial['serial_number']?></td>
         <td><?php echo $serial['status']?></td>
         <td><?php echo $serial['fecha']?></td>
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
</div>
<?php 
include('layouts/footer.php');

?>
<script>
 /*$('body').click(function(e){
        
          alert('hola');
        });*/
function elegir_lote(){
    var lote=$('#lote').find(":selected").val();
    
$("#loader2").fadeIn('slow');
	$.ajax({
		type:"POST",
		url:'./ajax/elegir_lote.php',
		data:"lote="+lote,
		 beforeSend: function(objeto){
	//$("#ajax_pago").html("Mensaje: Cargando...");
	  },
		success:function(data){
           location=location;
			//$("#ajax_pago").html(data);
			
			
			
		}
	})
}
</script>