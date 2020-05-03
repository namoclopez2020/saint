<?php 

if(isset($_GET['compra']) && is_numeric($_GET['compra'])):
include('../includes/load.php');
$numero_compra = remove_junk($db->escape($_GET['compra']));

$sql = "select costo_total_compra-pagado as diferencia from compras where numero_compra=$numero_compra";
$dif = find_by_sql($sql);
foreach($dif as $diff):
    $monto = $diff['diferencia'];
endforeach;
?>
<div class="container">
    
   
   
           
           <form  id="form_pago" method="POST">
            <input type="hidden" name="num_compra" id="num_compra" value="<?php echo $numero_compra?>">
           <div class="form-group">
           
                <label for="pago">Cantidad a pagar</label>
                <input type="hidden" class="form-control form-control-sm" name="maximo" id="maximo" value="<?php echo $monto ?>"> 
                <input type="number" class="form-control form-control-sm" name="pago" id="pago" value="<?php echo $monto ?>"> 
           </div>
           <div class="form-group">
           <label class="form-control-label">Medio de Pago</label>
							
								<select class='form-control input-sm form-control-sm' name="medio_pago" id="medio_pago">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
									
								</select>
           </div>
           <div class="form-group mt-3">
           <button type="button" onclick="pagar()" class="btn btn-primary btn-sm btn-block">Pagar</button>
           </div>
       
           </form>
       
</div>


<?php




endif;
?>