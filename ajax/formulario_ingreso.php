<?php if(isset($_POST['impuesto'])){
  if($_POST['impuesto']==1){
    ?> 
  <div class="form-group">
    <text class="h3"> Impuesto</text>
  </div>
      <div class="form-group">
       <div class="row">
				     <div class="col-md-4">
                   <div class="input-group">
					   

                     <input type="text" class="form-control" value="18" name="impuesto" placeholder="Impuesto agregado" required>
                    
                  </div>
                 </div>
				   
               
               </div>
              </div>

    
    
    <?php
  }
}
?>

<?php 
if(isset($_POST['empaque'])){
	

if($_POST['empaque'] == "1"){
?>

<div class="form-group">
    <text class="h3"> Cantidad en empaque</text>
  </div>
      <div class="form-group">
       <div class="row">
				     <div class="col-md-4">
                   <div class="input-group">
					   
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="text" class="form-control" name="fraccion" placeholder="Cantidad" required>
                    
                  </div>
                 </div>
                 <div class="col-md-6">
                 <select class="form-control" name="medida_empaque" id="medida_empaque"  required>
                      <option value="">Medida para empaque</option>
                      <option value="paq">paquete</option>
                      <option value="kg">Kilos</option>
                      <option value="lt">Litros</option>
                    </select>
                 </div>
				   
               
               </div>
              </div>




<?php
}
}


