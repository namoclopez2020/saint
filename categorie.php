<?php
  $page_title = 'Lista de categorías';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page (1=Admin , 2= special user, 3=user)
  page_require_level(1);
  existe_por_lo_menos_una_sucursal();
  esta_configurado();
  existe_sucursal_seleccionada();
  $sucursal =usar_sucursal();
  $all_categories = find_all('categories');
?>
<?php
	  
	 
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
	 $rep=0;
	 foreach($all_categories as $categ){
		 
	 if($_POST['categorie-name']==$categ['name']){ 
		 $rep++;
		}
	 }
	  
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";
	   if($rep==0){
      if($db->query($sql)){
        $session->msg("s", "Categoría agregada exitosamente.");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló ");
        redirect('categorie.php',false);
      }
	   }else{
		$session->msg("d", "Lo siento,  categoria repetida");
        redirect('categorie.php',false);   
	   }
   } else {
     $session->msg("d",$errors);
     redirect('categorie.php',false);
   }
 }
 include('layouts/header.php');
 include('layouts/navigation.php');
?>

<div class="page">
  <?php include('layouts/nav_page.php')?> 
   <div  class="container" style="padding-top: 60px">
   <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <strong>
            <span class=""></span>
            <span>Agregar categoría</span>
         </strong>
        </div>
        <div class="card-body">
          <form method="post" action="categorie.php">
            <div class="form-group">
                <input type="text" class="form-control" name="categorie-name" placeholder="Nombre de la categoría" required>
            </div>
            <button type="submit" name="add_cat" class="btn btn-primary">Agregar categoría</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <strong>
          <span class=""></span>
          <span>Lista de categorías</span>
       </strong>
      </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover" id="myTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Categorías</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn  btn-warning"  >
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn  btn-danger"  >
                          <span class=" fa fa-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          </div>
        
       </div>
    </div>
    </div>
   </div>
  </div>
              </div>
  <?php include_once('layouts/footer.php'); ?>
