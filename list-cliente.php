<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 esta_configurado();
 existe_sucursal_seleccionada();
   $sucursal =usar_sucursal();
   
 $all_clientes=find_all_clientes();
 include('layouts/header.php');
 include('layouts/navigation.php');

?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div class="container mt-4 pt-4">
   <div class="row">
       <div class="col-11 col-md-8 col-lg-10 mx-auto">
          <div class="card">
              <div class="card-header text-primary h3">Lista de clientes</div>
              <div class="card-body">
             <div class="table-responsive">
             <table class="table table-hover" id="myTable" style="width:100%">
               <thead class="bg-primary text-light">
                   <th>#</th>
                   <th>Nombre</th>
                   <th>Teléfono</th>
                   <th>Dirección</th>
                   <th>Email</th>
                   <th>Documneto</th>
                   <th>Nro de documento</th>
                   <th>Fecha Agregado</th>
                   <th>Tipo de cliente</th>
                   <th>Pedidos</th>
                   <th>Acciones</th>
               </thead>
               <tbody>
                  <?php 
                  
                  foreach ($all_clientes as $cliente){
                    
                     ?>
                     <tr>
                       <td><?php echo count_id()?></td>
                    <td><?php echo $cliente['nombre_cliente']?></td>
                    <td><?php echo $cliente['telefono_cliente']?></td>
                    <td><?php echo $cliente['direccion_cliente']?></td>
                    <td><?php echo $cliente['email_cliente']?></td>
                    <td><?php echo $cliente['documento']?></td>
                    <td><?php echo $cliente['nro_documento']?></td>
                    <td><?php echo read_date($cliente['date_added'])?></td>
                    <td><?php echo $cliente['grupo_cliente']?></td>
                    <td><?php echo $cliente['pedidos_cliente']?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_cliente.php?id=<?php echo (int)$cliente['id_cliente'];?>"  class="btn  btn-warning mr-1"  >
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="delete_cliente.php?id=<?php echo (int)$cliente['id_cliente'];?>"  class="btn  btn-danger"  >
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