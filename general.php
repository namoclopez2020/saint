<?php

  $page_title = 'Lista de boletas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   existe_por_lo_menos_una_sucursal();
   existe_sucursal_seleccionada();
   $sucursal =usar_sucursal();
   $all_datos_generales=datos_generales();
   
   $all_sucursales=find_all('sucursales');
   //si se presiona el boton guardar
   if(isset($_POST['guardar'])){
    $moneda = remove_junk($db->escape( $_POST['moneda']));
    $icono = remove_junk($db->escape($_POST['icono']));
    $sucursal = remove_junk($db->escape($_POST['sucursal']));
    $impuesto = remove_junk($db->escape($_POST['impuesto']));
    $porcentaje = remove_junk($db->escape($_POST['porcentaje_impuesto']));
    $sql ="INSERT INTO general_data (moneda,representacion,sucursal,impuesto,porcentaje_impuesto) VALUES ('{$moneda}','{$icono}','{$sucursal}','{$impuesto}',$porcentaje)";
    if($db->query($sql)){
        $session->msg('s','Datos agregados correctamente');
        redirect('general.php',false);
    }

   }
   include('layouts/header.php');
   include('layouts/navigation.php');
?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div  class="container" style="padding-top: 60px">
<?php if(!existe_configuracion()):?>
<div class="row col-12 mx-auto mb-3">
<span class="text-secondary mx-auto">*Esta configuración solo se realizara por unica vez y no podra ser editado posteriormente</span>
</div>
<div class="row">
<div class="col-lg-4 col-md-6 col-12 mx-auto">
<div class="card">
<div class="card-header bg-info text-light h3">Configuracion General</div>
<div class="card-body">
<form action="" method="POST">
<div class="form-group">
<label for="moneda" >Moneda:</label>
<input type="text" name="moneda" class="form-control form-control-sm" placeholder="SOL">
 </div>
 <div class="form-group">
<label for="icono" >Representación de moneda:</label>
<input type="text" name="icono" class="form-control form-control-sm" placeholder="S/.">
 </div>
 <div class="form-group">
<label for="icono" >Impuesto:</label>
<input type="text" name="impuesto" class="form-control form-control-sm" placeholder="IGV-IVA" maxlenght="3">
 </div>
 <div class="form-group row ">
 <div class="col-12"><label for="icono" >Porcentaje de impuesto:</label></div>
<div class="col-12 row ml-1"><input type="number" name="porcentaje_impuesto" class="form-control col-8" placeholder="1"><div class="input-group-prepend ">
          <div class="input-group-text">%</div></div>

        </div>
 </div>
 <div class="form-group">
                    <label for="sucursal" >Seleccione sucursal principal:</label>
                    <select name="sucursal" class="form-control form-control-sm">
                    <?php  foreach ($all_sucursales as $suc): ?>
                      <option value="<?php echo $suc['id'] ?>">
                        <?php echo $suc['nombre_sucursal'] ?></option>
                    <?php endforeach; ?>
</select>
 </div>
 <div class="form-group">
 <button type="submit" class="btn btn-info btn-block" name="guardar">Guardar </button>
 </div>
</form>
</div>
</div>
</div>
</div>
  <?php else:
    foreach($all_datos_generales as $general):
    ?>
<div class="row">
<div class="col-lg-4 col-md-6 col-12 mx-auto">
<div class="card">
<div class="card-header bg-primary text-light h3">Datos Generales</div>
<div class="card-body">
<div class="form-group">
<label for="moneda" >Moneda:</label>
<label name="moneda" class="form-control form-control-sm text-center" ><?php echo $general['moneda']?></label>
</div>
<div class="form-group">
<label for="moneda" >Representacion de moneda:</label>
<label name="moneda" class="form-control form-control-sm text-center" ><?php echo $general['representacion']?></label>
</div>
<div class="form-group">
<label for="moneda" >Sucursal Principal:</label>
<label name="moneda" class="form-control form-control-sm text-center" ><?php echo $general['nombre_sucursal']?></label>
</div>
<div class="form-group">
<label for="moneda" >Impuesto:</label>
<label name="moneda" class="form-control form-control-sm text-center" ><?php echo $general['impuesto']?></label>
</div>
<div class="form-group">
<label for="moneda" >Porcentaje de impuesto:</label>
<label name="moneda" class="form-control form-control-sm text-center" ><?php echo $general['porcentaje_impuesto']." % "?></label>
</div>
</div>
</div>
</div>

</div>
  <?php 
endforeach;
endif;?>
</div>
</div>
<?php include_once('layouts/footer.php'); ?>
	  
</body>
</html>
