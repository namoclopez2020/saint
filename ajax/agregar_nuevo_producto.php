<?php
$errors =0;
require_once('../includes/load.php');

  // Checkear nivel de permiso para esta pagina
  page_require_level(2);
//$products = join_product_table();

if(isset($_POST['product-categorie'])){
   // si no hay errores
   $nombre_producto =  remove_junk($db->escape($_POST['product-title']));
   $codigo_producto =  remove_junk($db->escape($_POST['codigo_producto']));
   $medida_unidad = remove_junk($db->escape($_POST['medida_unidad']));
   $id_almacen =  remove_junk($db->escape($_POST['product-almacen']));
   $id_categoria =  remove_junk($db->escape($_POST['product-categorie']));
   $usa_empaque =  remove_junk($db->escape($_POST['usa_empaque']));
   $usa_impuesto = remove_junk($db->escape($_POST['usa_impuesto']));
   $es_serial =  remove_junk($db->escape($_POST['es_serial']));
   $costo_anterior=  remove_junk($db->escape($_POST['costo_anterior']));
   $costo_actual=  remove_junk($db->escape($_POST['costo_actual']));
   $costo_promedio =remove_junk($db->escape($_POST['costo_promedio']));
   $precio1 = remove_junk($db->escape($_POST['precio1']));
   $precio2 = remove_junk($db->escape($_POST['precio2']));
   $precio3 = remove_junk($db->escape($_POST['precio3']));
   $proveedor = ($_POST['proveedor']);
   $minimo_und = remove_junk($db->escape($_POST['min_und']));
   //validaciones
   if($usa_empaque=="1"){
     $cantidad_empaque=  remove_junk($db->escape($_POST['fraccion']));
     $medida_empaque= remove_junk($db->escape($_POST['medida_empaque']));
     $minimo_paq = remove_junk($db->escape($_POST['min_paq']));
     
   }
   else{
     $medida_empaque="";
     $cantidad_empaque= "";
     $minimo_paq="0";
   }
   if($usa_impuesto == 1 ){
	   $impuesto = remove_junk($db->escape($_POST['impuesto']));
   }else{
	   $impuesto = "";
   }
   
   $req_fields = array('precio1','precio2','precio3','costo_anterior','costo_actual','costo_promedio','min_und' );
   $errors = validar_negativos ($req_fields);
   if($errors > 0){
     echo false;
     echo $errors;
     exit();
   }
   $date = make_date();
   $query  = "INSERT INTO products (";
   $query .=" nombre_producto,codigo_producto,costo_anterior,costo_promedio,costo_actual,precio1,precio2,precio3,categorie_id,fecha_creado,es_serial,id_almacen,impuesto,usa_empaque,medida_paq,medida_und,fraccion,min_paq,min_und";
   $query .=") VALUES (";
   $query .=" '{$nombre_producto}','{$codigo_producto}','{$costo_anterior}','{$costo_promedio}', '{$costo_actual}', '{$precio1}', '{$precio2}', '{$precio3}', '{$id_categoria}', '{$date}','{$es_serial}','{$id_almacen}','{$impuesto}','{$usa_empaque}','{$medida_empaque}','{$medida_unidad}','{$cantidad_empaque}',{$minimo_paq},{$minimo_und}";
   $query .=")";
   $db->query($query);
   $result = $db->query("SELECT * FROM products ORDER BY id_producto DESC LIMIT 1");
   $last_id=4;
	while ($row = $db->fetch_array($result)) {

            $last_id = $row['id_producto'];

	}
 
   for ($i=0;$i<count($proveedor);$i++) 
      	{ 
			  $id_proveedor=$proveedor[$i];
      	if($i == 0){
			$sql1 = "INSERT INTO producto_proveedor (id_producto,id_proveedor)
			VALUES ($last_id,$id_proveedor);";
		  }else{
			$sql1 .= "INSERT INTO producto_proveedor (id_producto,id_proveedor)
			VALUES ($last_id,$id_proveedor);";
		  }


		}
	
   
   if($db->multi_query($sql1) ){
     echo true;
	//$session->msg('s',"Producto agregado exitosamente. ");
   }else{
     echo false;
	$session->msg('d',' Lo siento, registro falló.');
   }
 }
// $session->msg('s',"Producto agregado exitosamente. ");
?>