<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 esta_configurado();
 existe_sucursal_seleccionada();
   $sucursal =usar_sucursal();
   
 $all_almacen=find_all_almacen($sucursal[0]);
 include('layouts/header.php');
 include('layouts/navigation.php');

?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div class="container mt-4 pt-4">
   <div class="row">
       <div class="col-11 col-md-8 col-lg-10 mx-auto">
          <div class="card">
              <div class="card-header text-primary h3">Almacenes</div>
              <div class="card-body">
             <div class="table-responsive">
             <table class="table table-hover" id="myTable" style="width:100%">
               <thead class="bg-primary text-light">
                   <th>#</th>
                   <th>Nombre</th>
                   <th>Codigo</th>
                   <th>sucursal</th>
                   <th>Acciones</th>
               </thead>
               <tbody>
                  <?php 
                  $cont = 0;
                  foreach ($all_almacen as $almacen){
                     $cont++;
                     ?>
                     <tr>
                       <td><?php echo $cont?></td>
                    <td><?php echo $almacen['nombre_almacen']?></td>
                    <td><?php echo $almacen['codigo_almacen']?></td>
                    <td><?php echo $almacen['sucursal']?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_almacen.php?id=<?php echo (int)$almacen['id_almacen'];?>"  class="btn  btn-warning"  >
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="delete_almacen.php?id=<?php echo (int)$almacen['id_almacen'];?>"  class="btn  btn-danger"  >
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