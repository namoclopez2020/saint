<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 esta_configurado();
 existe_sucursal_seleccionada();
   $sucursal =usar_sucursal();
   
 $all_provider=find_all_provider();
 include('layouts/header.php');
 include('layouts/navigation.php');

?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div class="container mt-4 pt-4">
   <div class="row">
       <div class="col-11 col-md-8 col-lg-10 mx-auto">
          <div class="card">
              <div class="card-header text-primary h3">Proveedores</div>
              <div class="card-body">
             <div class="table-responsive">
             <table class="table table-hover" id="myTable" style="width:100%">
               <thead class="bg-primary text-light">
                   <th>#</th>
                   <th>Nombre</th>
                   <th>Representante</th>
                   <th>Teléfono</th>
                   <th>RUC</th>
                   <th>Dirección</th>
                   <th>Acciones</th>
               </thead>
               <tbody>
                  <?php 
                  
                  foreach ($all_provider as $provider){
                    
                     ?>
                     <tr>
                       <td><?php echo count_id()?></td>
                    <td><?php echo $provider['nombre']?></td>
                    <td><?php echo $provider['representante']?></td>
                    <td><?php echo $provider['Telefono']?></td>
                    <td><?php echo $provider['RUC']?></td>
                    <td><?php echo $provider['direccion']?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_provider.php?id=<?php echo (int)$provider['id_provider'];?>"  class="btn  btn-warning"  >
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="delete_provider.php?id=<?php echo (int)$provider['id_provider'];?>"  class="btn  btn-danger"  >
                          <span class=" fa fa-trash"></span>
                        </a>
                      </div>
                    </td>
                   
                  </tr>
                  <?php }?>
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