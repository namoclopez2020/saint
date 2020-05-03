<?php 
include('../includes/load.php');
if(isset($_POST['pago'])){
    $general = datos_generales();
    foreach($general as $datos){
        $moneda = $datos['representacion'];
    }
 if($_POST['pago'] == '2'){
     ?>             
                  <label for="icono" >Porcentaje de impuesto:</label>
                   <div class="input-group"><div class="input-group-prepend">
          <div class="input-group-text"><?php echo $moneda?></div>
        </div><input type="text" id="pagado" class="form-control col-4" ></div>
    <?php
 }
}
?>