<?php
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkear nivel de permiso para esta pagina
  page_require_level(1);
  existe_por_lo_menos_una_sucursal();
 
  existe_sucursal_seleccionada();
  $sucursal=usar_sucursal();
  esta_configurado();
  $all_categories = find_all('categories');
  $all_almacen=find_all_almacen($sucursal[0]);
  $all_providers= find_all('proveedor');

 
 include('layouts/header.php');
 include('layouts/navigation.php');

?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
  <div class ="container-fluid" style="padding-top: 60px;">
  <div class="row">
  <div class="col-md-7">
      <div class="card">
        <div class="card-header">
          <strong>
            <span class="fa fa-th"></span>
            <span>Agregar producto</span>
         </strong>
        </div>
		  <!-- formulario general -->
		  
        <div class="card-body" id="padre">
         <div class="col-md-12">
           <!-- para pruebas -->
      <!-- <form method="post" action="ajax/agregar_nuevo_producto.php" id="agregar_producto" name="agregar_producto" method="POST"  class="clearfix" >-->
        <form method="post" id="agregar_productos" name="agregar_productos" method="POST"  class="clearfix" >  
          <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" id="product-title" placeholder="Descripcion" >
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="codigo_producto" id="codigo_producto" placeholder="Codigo del producto" required>
               </div>
              </div>
			  
			  
              
			  <div class="form-group">
                <div class="row">
					
                  
					<div class="col-md-6">
                    <select class="form-control" name="product-almacen" required>
                      <option value="">Selecciona una almacen</option>
                    <?php  foreach ($all_almacen as $almacen): ?>
                      <option value="<?php echo $almacen['id_almacen'] ?>">
                        <?php echo $almacen['nombre_almacen'] ?></option>
                    <?php endforeach; ?>
                    </select>
					</div>
					
					<div class="col-md-6">
                    <select class="form-control" name="product-categorie"    required>
                      <option value="">Selecciona una instancia</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo $cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
          </div>
          <div class="col-md-6">
                    <select class="form-control" name="usa_empaque" id="usa_empaque" onchange="load()" required>
                      <option value="">Usa empaque?</option>
                      <option value="1">Si</option>
                      <option value="0">No</option>
                    </select>
          </div>
           <div class="col-md-6">
           <select class="form-control" name="medida_unidad" id="medida_unidad"  required>
                      <option value="">Medida para unidad</option>
                      <option value="und">unidad</option>
                      <option value="gr">gramos</option>
                      <option value="ml">mililitros</option>
                    </select>
            </div>
          <div class="col-md-6">
                    <select class="form-control" name="usa_impuesto" id="usa_impuesto" onchange="load1()" required>
                      <option value="">Usa impuesto</option>
                      <option value="1">Si</option>
                      <option value="0">No</option>
                    </select>
          </div>
          <div class="col-md-6" id="serial">
                    <select class="form-control" name="es_serial"  id="es_serial" required>
                      <option value="" >Es serializable?</option>
                      <option value="1">Si</option>
                      <option value="0">No</option>
                    </select>
					</div>
                </div>
				  
              </div>

			  <div class="resultados" id="resultados" > <!--cambio de formulario segun tipo-->
			 
        </div>
        <div class="resultados1" id="resultados1"> <!--cambio de formulario segun tipo-->
			 
			  </div>
			  
			  
              
         </div>
        </div>
		  <!-- formulario de formulario -->
		
		  
		  
      </div>
    </div>
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Costos y precios</span>
         </strong>
        </div>
		  <!-- formulario general -->
		  
        <div class="card-body" id="padre">
          <div class="row">
          <div class="col-md-6">
          <div class="form-group">
          <text class="h4">Costos</text>
          </div>
          <div class="form-group">
  <input type="number" class="form-control" name="costo_anterior"  placeholder="Costo anterior" required>
         </div>
         <div class="form-group">
  <input type="number" class="form-control" name="costo_actual"  placeholder="Costo actual" required>
         </div>
         <div class="form-group">
  <input type="number" class="form-control" name="costo_promedio" placeholder="costo promedio" required>
         </div>
    
        
   
    
    
       
     </div>
     <div class="col-6">
      <div class="form-group">
        <text class="h4">Precios</text>
      </div>
      <div class="form-group">
        
        <input type="number" name="precio1" class="form-control" placeholder="Precio 1">
      </div>
      <div class="form-group">
        
      <input type="number" name="precio2" class="form-control" placeholder="Precio 2">
      </div>
      <div class="form-group" style="">
       
      <input type="number" name="precio3" class="form-control" placeholder="Precio 3">
      </div>
     </div>
          </div>
          <div class="row">
          <div class="col-12">
         <div class="form-group">
         <label for="codigo_almacen" >Stock minimo:</label>
         <div class="row">
         <div class="col-3">
         <input type="number" name="min_paq" class="form-control form-control-sm" >
         </div>
         <div class="col-3">
         <label for="" class="form-control-label">PAQ</label>
         </div>
            <div class="col-3">
            <input type="number" name="min_und" class="form-control form-control-sm" required>
            </div>
            <div class="col-3">
            <label for="" class="form-control-label">UND</label>
            </div>
         </div>
            
         </div>
          </div>
          </div>
        
        </div>
        
		  <!-- formulario de formulario -->
		
		  
		  
      </div>
     
    </div>
    
    
      
      </div>
      <div class="row"><div class="col-md-12 col-lg-7 col-12 ">
        <div class="card">
        <div class="card-header">
          <text class="h4">Proveedores</text>
        </div>  
        <div class="card-body mx-auto">
        <div class="form-group">
                    
                      <select id="multiselect1"  multiple="multiple" name="proveedor[]">
                        <?php foreach ($all_providers as $pro) : ?>
                        <option value="<?php echo $pro['idproveedor']?>" ><?php echo $pro['nombre']?></option>
                        <?php endforeach?> 
                      </select>
                    </div>
        </div></div>
    
      </div>
      </div>
      <div class="row">
        <div class="col-12">
        <button type="submit" name="add_product" class="btn btn-danger btn-block">Agregar producto</button>
          </form>
        </div>
   
    </div>
   
    </div>
    
  
  </div>
  
  
  </div>
  
                   
                    </div>
                    </div>
                    </div>


<?php include_once('layouts/footer.php'); 


?>

<script type="text/javascript" src="./libs/js/formulario_productos_add.js"></script>