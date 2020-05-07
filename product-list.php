<?php 

$page_title = 'Admin página de inicio';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
 page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 esta_configurado();

 existe_sucursal_seleccionada();
   $sucursal =usar_sucursal();
   
   
 $all_producto =join_product_table($sucursal[0]);
 include('layouts/header.php');
 include('layouts/navigation.php');
$moneda = $_SESSION['representacion'];
?>
<div class="page">
     <?php include('layouts/nav_page.php')?>
<div class="container mt-4 pt-4">
    
   <div class="row">
  
       <div class="col-11 col-md-8 col-lg-10 mx-auto">
          <div class="card">
              <div class="card-header text-primary h3">Lista de productos</div>
              <div class="card-body">
             <div class="table-responsive">
             <table class="table table-hover" id="myTable" style="width:100%">
               <thead class="bg-primary text-light">
                   <th>#</th>
                   <th>Nombre</th>
                   <th>Codigo</th>
                   <th>Fecha agregado</th>
                   <th>Es Serial</th>
                   <th>Unidad de medida</th>
                   <th>Fraccion</th>
                   <th>Stock</th>
                   <th>Stock minimo</th>
                   <th>Categoria</th>
                   <th>Almacen</th>
                   <th>Costos</th>
                   <th>Acciones</th>
               </thead>
               <tbody>
                  <?php 
                  $cont = 0;
                  foreach ($all_producto as $producto) :
                     $cont++;
                     ?>
                     <tr>
                       <td><?php echo $cont?></td>
                    <td><?php echo $producto['nombre_producto']?></td>
                    <td><?php echo $producto['codigo_producto']?></td>
                    <td><?php echo read_date($producto['fecha_creado'])?></td>
                    <td><?php  echo ($producto['es_serial']) ? 'Si' : 'No'?></td>
                    <td><?php  echo $producto['medida_paq']." / ".$producto['medida_und']?></td>
                    <td><?php echo ($producto['fraccion']!= NULL) ? $producto['fraccion'] : "Sin fraccion" ?> </td>
                    <td><?php  if($producto['stock_paq']!=NULL || $producto['stock_und']!=NULL){
                      echo  ($producto['stock_paq']!=NULL) ? $producto['stock_paq']." ".$producto['medida_paq']. "<br>" : "";
                      echo ($producto['stock_und']!=NULL) ? $producto['stock_und']." ".$producto['medida_und'] : "";
                    }
                    else{
                        echo "Sin compras registradas";
                    }
                    ?></td>
                    <td>
                    <?php 
                    echo $producto['min_paq']." ".$producto['medida_paq']." <br> ".$producto['min_und']." ".$producto['medida_und'];
                    ?>
                    
                    </td>
                    <td><?php echo $producto['categoria']?></td>
                    <td><?php echo $producto['nombre_almacen'] ?> </td>
                    <td><?php echo "<b>COSTO ACTUAL : </b>".$moneda." ".$producto['costo_actual']."<br>".
                                "<b>COSTO ANTERIOR : </b>".$moneda." ".$producto['costo_anterior']."<br>".
                                "<b>COSTO PROMEDIO : </b>".$moneda." ".$producto['costo_promedio']?></td>
                    <td class="text-center">
                      <div class="btn-group">
                      <a class="btn btn-info" href="#" data-toggle="modal" data-target="#myModalmostrar" onclick="mostrar('<?php echo $producto['id_producto']?>','<?php echo urlencode($producto['nombre_producto']) ?>')"> &nbsp;&nbsp;+ info&nbsp;&nbsp;</a>
                  
                        <a href="delete_almacen.php?id=<?php echo (int)$producto['id_producto'];?>"  class="btn  btn-danger ml-3"  >
                          <span class=" fa fa-trash"> </span>
                          </a>
                       <?php if($producto['es_serial']){?>
                       <form action="seriales.php" method="POST" >
                       <input type="hidden" name="id_producto" value ="<?php echo $producto['id_producto']?>">
                       <button type="submit" class="btn btn-primary ml-3">Seriales</button>
                       </form>
                       
                  <?php }?>
                      </div>
                    </td>
                   
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
<?php include('modal/ver_detalle_producto.php')?>
<?php 
include('layouts/footer.php');

?>
<script>

    function mostrar(id,nombre) {
        $(document).ready(function () {
            $("#result").hide("slow");
            $("#cargar_reporte").show("slow");
            $("#editar_resul").load("./ajax/ver_detalle_producto.php?id="+id+"&producto="+nombre, " ", function () {
                $("#editar_resul").show("slow");
                $("#cargar_reporte").hide("slow");
            });
        });
    }

</script>