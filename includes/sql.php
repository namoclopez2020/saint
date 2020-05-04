<?php
  require_once(LIB_PATH_INC.'load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/

function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}
function find_all_almacen($id_sucursal) {
  global $db;
  return find_by_sql("SELECT a.id_almacen,a.nombre_almacen,a.codigo_almacen,s.nombre_sucursal as sucursal
   FROM almacen as a INNER JOIN sucursales as s ON a.id_sucursal=s.id where a.id_sucursal=$id_sucursal 
  ");
}


function find_all_user_name($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT name FROM ".$db->escape($table)."ORDER BY name");
   }
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
function find_by_id_egreso($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id_egreso='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
function find_by_correlativo($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE correlativo='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
function find_by_id1($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE idproveedor='{$db->escape($id)}' ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
function find_by_id2($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id_cliente='{$db->escape($id)}' ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function delete_by_egreso($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id_egreso=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function delete_by_correlativo($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE correlativo=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function vigencia_registro($table,$id)
{
  global $db;
  if(tableExists($table))
   {

    
    $update="0";
    /*if($estado==0){
      $update=1;
    }*/
    $sql = "UPDATE ".$db->escape($table);
    $sql .= " set status='{$update}' WHERE correlativo=". $db->escape($id);
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function borrar_pagos($id){
  global $db;

  $borrar="delete from pagos_registro where id_correlativo_registro=".  $db->escape($id);
  $db->query($borrar);
  return ($db->affected_rows() === 1) ? true : false;
}



function delete_by_id1($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE idproveedor=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function delete_by_id2($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id_cliente=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,username,password,user_level,status FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  function find_grouplevel_by_id($id)
  {
	global $db;
	  $sql="SELECT user_level FROM users WHERE id=$id LIMIT 1";
	  $resul=$db->query($sql);
	  $resu=$db->fetch_array($resul);
	  $result=$resu['user_level'];
	  return $result;
  }
  //funcion para saber si ya se selecciono una sucursal de trabajo
 function existe_sucursal_seleccionada(){
     global $session;
  if(!isset($_SESSION['nombre_sucursal'])){
    $session->msg('d','Por favor seleccine una sucursal de trabajo...');
    redirect('seleccionar_sucursal.php', false);
  } else{
   
  }
 
}
function usar_sucursal () {
  global $session;
  $nombre_sucursal=$_SESSION['nombre_sucursal'];
$id_sucursal=$_SESSION['id_sucursal'];
$direccion_sucursal=$_SESSION['direccion_sucursal'];
$telefono_sucursal = $_SESSION['telefono_sucursal'];
$ruc_sucursal= $_SESSION['ruc_sucursal'];
$ruta_logo=$_SESSION['ruta_imagen'];
$email_sucursal=$_SESSION['email_sucursal'];
$wsp_sucursal=$_SESSION['wsp_sucursal'];
$sucursal = [$id_sucursal,$nombre_sucursal,$direccion_sucursal,$telefono_sucursal,$ruc_sucursal,$ruta_logo,$email_sucursal,
$wsp_sucursal];
return $sucursal;
}
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('index.php', false);


      //if Group status Deactive
     elseif($login_level['group_status'] == '0' ):
           $session->msg('d','Este nivel de usuario esta inactivo!');
           redirect('admin.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver esta seccion.");
            redirect('admin.php', false);
        endif;

     }
  function find_pagos($numero_compra){
    global $db;
    $numero_compra = remove_junk($db->escape($numero_compra));
    $sql = "SELECT p.id,u.name,p.monto_pagado,p.fecha_pago,p.metodo_pago FROM pagos as p ";
    $sql.="INNER JOIN users as u ON P.id_usuario = u.id WHERE p.num_compra = $numero_compra ";
    $sql.="GROUP BY p.id ";
    return find_by_sql($sql);
  }

  function es_empaque($id_producto){
    
    global $db;
    $id= remove_junk($db->escape($id_producto));
    $sql = "SELECT usa_empaque from products where id_producto=$id";
    $result = $db->query($sql);
    $usa_empaque=$db->fetch_array($result);
    return( $usa_empaque == 1 ? true : false);
    
  }
  function find_all_lotes($id_producto){
    global $db;
    $id=remove_junk($db->escape($id_producto));
    $sql="SELECT *,date_format(fecha_agregado, '%d %m %Y') as fecha FROM detalle_producto where id_producto=$id";
    return find_by_sql($sql);
  }
  function cuentas_por_pagar($sucursal){
    global $db;
    $id_sucursal = remove_junk($db->escape($sucursal));
    $sql = "SELECT *,date_format(fecha_compra,'%d/%m/%Y') as fecha FROM compras where suc_id=$id_sucursal ";
    $sql.=" AND status_compra='Parcial'";
    return find_by_sql($sql);
  }
  function datos_generales () {
    global $db;
    $sql ="Select g.impuesto,g.porcentaje_impuesto,g.id,g.moneda,g.representacion,s.nombre_sucursal from general_data as g INNER JOIN sucursales as s ON g.sucursal=s.id GROUP BY g.id";
    return find_by_sql($sql);
  }
  
  function existe_por_lo_menos_una_sucursal(){
    global $session;
    global $db;
    $sql="Select count(id) from sucursales";
    $res = find_by_sql($sql);
    if($res == 0){
      redirect ('form-sucursal.php',false);
    }
  }
  function all_seriales_of_product($id_producto,$lote){
    global $db;
    $id_producto = remove_junk($db->escape($id_producto));
    $lote = remove_junk($db->escape($lote));
    $sql="SELECT DATE_FORMAT(det.fecha_agregado, '%d %m %Y') as fecha,s.serial_number,s.status,s.id_detalle_prod from seriales as s INNER JOIN detalle_producto AS det ";
    $sql.="ON s.id_detalle_prod=det.id_detalle INNER JOIN products as p ON det.id_producto=p.id_producto where det.id_producto=$id_producto ";
   if($lote != ""){
    $sql.="and det.id_detalle=$lote ";
    } 
    $sql.="GROUP BY s.serial_number ";
    return find_by_sql($sql);
  }
  function existe_configuracion() {
    global $session;
    global $db;
    $sql="Select count(id) as cont from general_data";
    $res = find_by_sql($sql);
    foreach($res as $data){ $cont = $data['cont'];}
    return ($cont >  0 ? true : false);
  }
  function esta_configurado(){
    global $session;
    if(!existe_configuracion()){
      $session->msg("d", "¡Lo siento! Debe ingresar los datos generales");
      redirect('general.php',false);
    }
  }
   /*--------------------------------------------------------------*/
   /* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
  function join_product_table($id_sucursal){
     global $db;
     $sql  =" SELECT p.usa_empaque,p.id_producto,p.nombre_producto,codigo_producto,p.fecha_creado,p.es_serial,p.medida_paq,p.medida_und,p.fraccion,p.stock_paq,p.stock_und,c.name ";
    $sql  .=" AS categoria,a.nombre_almacen ";
    $sql  .=" FROM products p";
    $sql  .=" LEFT JOIN categories c ON c.id = p.categorie_id";
    $sql  .=" LEFT JOIN almacen as a ON p.id_almacen = a.id_almacen where a.id_sucursal=$id_sucursal";
	//$sql  .=" LEFT JOIN sucursales s ON s.id=p.id_sucursales";
    $sql  .=" GROUP BY p.nombre_producto,p.id_producto ORDER BY p.id_producto DESC";
    return find_by_sql($sql);

   }
   
   
 function join_product_table_sucursal($sucursal){
     global $db;
     $sql  =" SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.prov,p.media_id,p.date,p.id_sucursal,p.compuesto_prod,p.laboratorio,p.fecha_caducidad,visto,c.name";
    $sql  .=" AS categorie,m.file_name AS image";
    $sql  .=" FROM products p";
    $sql  .=" LEFT JOIN categories c ON c.id = p.categorie_id";
    $sql  .=" LEFT JOIN media m ON m.id = p.media_id";
	$sql  .=" LEFT JOIN sucursales s ON s.id=p.id_sucursal";
	$sql.=" WHERE id_sucursal='$sucursal'";
    $sql  .=" ORDER BY p.id ASC";
    return find_by_sql($sql);

   }
function join_sucursal_table(){
     global $db;
     $sql  =" SELECT * FROM sucursales";
    return find_by_sql($sql);

   }
  /*--------------------------------------------------------------*/	
  /* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

   function find_product_by_title($product_name){
     global $db;
     $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT name FROM products WHERE name like '%$p_name%' LIMIT 1";
     $result = find_by_sql($sql);
     return $result;
   }
//encontrar el nombre del producto por cualquier palabra
  function find_product_by_anything($palabra,$sucursal){
	  global $db;
	  $sql="SELECT * FROM categories WHERE name='".$palabra."'";
	  $id_cat=find_by_sql($sql);
	  
	  foreach($id_cat as $categ){
		  $id_categoria=$categ['id'];
	  }
	  $aColumns = array('name','categorie_id','laboratorio');//Columnas de busqueda
		 $sTable = "products";
		 $sWhere = "";
			
	  		$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if(isset($id_categoria) && $i==1){
					$sWhere .= $aColumns[$i]." LIKE '%".$id_categoria."%' OR ";
				}else{
				$sWhere .= $aColumns[$i]." LIKE '%".$palabra."%' OR ";
				}
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ') AND id_sucursal='.$sucursal.'';
	  $consulta="SELECT name FROM products $sWhere LIMIT 1" ;
	  $resultado=find_by_sql($consulta);
	  return $resultado;
	  
		
  }
//encontrar toda la info del producto por cualquier palabra
 function find_product_info_by_anything($palabra,$sucursal){
	  global $db;
	  $sql="SELECT * FROM categories WHERE name='".$palabra."'";
	  $id_cat=find_by_sql($sql);
	  foreach($id_cat as $categ){
		  $id_categoria=$categ['id'];
	  }
	  $aColumns = array('name','categorie_id','laboratorio');//Columnas de busqueda
		// $sTable = "products";
		 $sWhere = "";
			
	  		$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if(isset($id_categoria) && $i==1){
					$sWhere .= $aColumns[$i]." LIKE '%".$id_categoria."%' OR ";
				}else{
					$sWhere .= $aColumns[$i]." LIKE '%".$palabra."%' OR ";
				}
				
				
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ') AND id_sucursal='.$sucursal.'';
	  $consulta="SELECT * FROM products $sWhere " ;
	  $resultado=find_by_sql($consulta);
	  return $resultado;
	  
		
  }

  /*--------------------------------------------------------------*/
  /* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
    $sql  = "SELECT * FROM products ";
    $sql .= " WHERE name ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }
function find_all_product_info_by_title_1($title){
    global $db;
    $sql  = "SELECT * FROM products ";
    $sql .= " WHERE name LIKE '%".$title."%' ";
   // $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }

function find_all_provider(){
    global $db;
    $sql  = "SELECT * FROM proveedor";
    return find_by_sql($sql);
  }
function find_provider_by_id($id){
  global $db;
  $id= remove_junk($db->escape($id));
  $sql = "SELECT * FROM proveedor where idproveedor=$id";
  return find_by_sql($sql);
}
  /*--------------------------------------------------------------*/
  /* Function for Update product quantity
  /*--------------------------------------------------------------*/
  function update_product_qty($qty,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $sql = "UPDATE products SET quantity=quantity -'{$qty}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }
  /*--------------------------------------------------------------*/
  /* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
 function find_recent_product_added($limit){
   global $db;
   $sql   = " SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
   $sql  .= "m.file_name AS image FROM products p";
   $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
 function find_higest_saleing_product($limit){
   global $db;
   $sql  = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.qty) AS totalQty";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON p.id = s.product_id ";
   $sql .= " GROUP BY s.product_id";
   $sql .= " ORDER BY SUM(s.qty) DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for find all sales
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT s.id,s.qty,s.price,s.date,p.name";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON s.product_id = p.id";
   $sql .= " ORDER BY s.date DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display Recent sale
 /*--------------------------------------------------------------*/
function find_recent_sale_added($limit){
  global $db;
  $sql  = "SELECT s.id,s.qty,s.price,s.date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " ORDER BY s.date DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}
//funcion para calcular en la venta cuantas unidades, blister, y cajas se venderan
function convertir_cantidad_numerico($cantidad,$id_producto){
	global $db;
	$sql="SELECT quantity,cantidad_blister,cantidad_unidad FROM products WHERE id='".$id_producto."'";
	$result=find_by_sql($sql);
	
	$blister=0;
	
	foreach($result as $results){
		$stock=$results['quantity'];
		$blisters_en_caja=$results['cantidad_blister'];
		$unidades_en_blister=$results['cantidad_unidad'];
		
	}
	list($cantidad_cajas,$cantidad_unidades)=explode("F",$cantidad);
	while($cantidad_unidades>=$unidades_en_blister){
		$blister++;
		$cantidad_unidades=$cantidad_unidades-$unidades_en_blister;
	}
	$total=$cantidad_cajas.",".$blister.",".$cantidad_unidades;
    return $total;
}
//funcion para validar stock
function convertir_cantidad_numerico1($cantidad,$id_producto){
	global $db;
	$sql="SELECT quantity,cantidad_blister,cantidad_unidad FROM products WHERE id='".$id_producto."'";
	$result=find_by_sql($sql);
	
	$blister=0;
	
	foreach($result as $results){
		$stock=$results['quantity'];
		$blisters_en_caja=$results['cantidad_blister'];
		$unidades_en_blister=$results['cantidad_unidad'];
		
	}
	list($cantidad_cajas,$cantidad_unidades)=explode("F",$cantidad);
	
	$total=$cantidad_cajas.",".$cantidad_unidades;
    return $total;
}

function stock_final_producto_venta($cantidad,$id_producto){
	global $db;
	$sql="SELECT quantity,cantidad_blister,cantidad_unidad FROM products WHERE id='".$id_producto."'";
		$result=find_by_sql($sql);
		foreach($result as $results){
			$stock=$results['quantity'];
			$blisters_en_caja=$results['cantidad_blister'];
			$unidades_en_blister=$results['cantidad_unidad'];
		}
	
$unidades_por_caja=$unidades_en_blister*$blisters_en_caja;
$unidades_para_blister=$unidades_en_blister;


list($a,$b)= explode('F', $stock);
list($c,$d) = explode ('F',$cantidad);

$total_a = ($a*$unidades_por_caja)+$b;
$total_b = ($c*$unidades_por_caja)+$d;

$numerico=$total_a-$total_b;
$cajas=(int)($numerico/$unidades_por_caja);
$unidades=$numerico%$unidades_por_caja;

$resultado=$cajas."F".$unidades;
$cantidad_blister=(int)($unidades/$unidades_para_blister);
$unidades_restantes=$unidades-($unidades_para_blister*$cantidad_blister);

	
	$sql = "UPDATE products SET quantity='{$resultado}' WHERE id = '{$id_producto}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);
}


function sumar_stock($cantidad_paq,$cantidad_und,$id_producto){
	global $db;
	$sql="SELECT usa_empaque,stock_paq,stock_und,fraccion FROM products WHERE id_producto='".$id_producto."'";
	$result=find_by_sql($sql);
	foreach($result as $results){
      $stock_paq=$results['stock_paq'];
      $stock_und=$results['stock_und'];
      $unidades_por_caja = $results['fraccion'];
      $usa_empaque= $results['usa_empaque'];
  }
  if($usa_empaque):

    $total_und_BD = ($stock_paq*$unidades_por_caja)+$stock_und;
    $total_und_funcion = ($cantidad_paq*$unidades_por_caja)+$cantidad_und;
    
    $numerico=$total_und_BD+$total_und_funcion;
    $paq=(int)($numerico/$unidades_por_caja);
    $und=$numerico%$unidades_por_caja;
  else:
    $paq="";
    $und=$stock_und+$cantidad_und;
  endif;
  
	

	
	$sql = "UPDATE products SET stock_paq='{$paq}' , stock_und='{$und}' WHERE id_producto = '{$id_producto}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);
}

/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function join_compras_table($id_sucursal){
  global $db;
  $id_sucursal = remove_junk($db->escape($id_sucursal));
  $sql = "SELECT p.nombre,c.numero_compra,c.costo_total_compra,c.pagado,DATE_FORMAT(c.fecha_compra, '%d/%m/%Y')
   AS fecha,c.metodo_pago, ";
   $sql.="c.status_compra from compras as c INNER JOIN proveedor as p ";
   $sql.="ON c.id_proveedor = p.idproveedor ";
   $sql.="where c.suc_id=$id_sucursal";
   return find_by_sql($sql);
}
function find_sale_by_dates_v2($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
  $sql  = "SELECT s.date, p.name,p.sale_price,p.buy_price,";
  $sql .= "COUNT(s.product_id) AS total_records,";
  $sql .= "SUM(s.qty) AS total_sales,";
  $sql .= "SUM(s.price) AS total_saleing_price,";
  $sql .= "SUM(p.buy_price * s.qty) AS total_buying_price ";
  $sql .= "FROM sales s ";
  $sql .= "LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
  $sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(s.date) DESC";
  return $db->query($sql);
}
function  find_sale_by_dates_user($start,$end,$vendedor){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start));
  $end_date    = date("Y-m-d", strtotime($end));
  $sql  = "SELECT * FROM sales where";
  $sql .= " DATE_FORMAT(date, '%Y-%m-%d') between '{$start_date}' and '{$end_date}' and id_vendedor='$vendedor'";
  //$sql .= " GROUP BY date,id_vendedor,product_id,qty";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function  dailySales($year,$month,$day){
  global $db;
  $sql  = "SELECT * FROM sales where";
  $sql .= " date = '{$year}-{$month}-{$day}'";
  //$sql .= " GROUP BY date,id_vendedor,product_id,qty";
  return find_by_sql($sql);
}
function  dailySalesByUser($year,$month,$day,$vendedor){
  global $db;
  $sql  = "SELECT * FROM sales where";
  $sql .= " DATE_FORMAT(date, '%Y-%m-%d') = '{$year}-{$month}-{$day}' and id_vendedor='$vendedor'";
  //$sql .= " GROUP BY date,id_vendedor,product_id,qty";
  return find_by_sql($sql);
}
function  dailySalesBySucursal($year,$month,$day,$sucursal){
  global $db;
  $sql  = "SELECT * FROM sales where";
  $sql .= " DATE_FORMAT(date, '%Y-%m-%d') = '{$year}-{$month}-{$day}' and id_sucursal='$sucursal'";
  //$sql .= " GROUP BY date,id_vendedor,product_id,qty";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function  monthlySales($year,$month){
  global $db;
  $sql  = "SELECT * ";
  $sql .= " FROM sales";
  $sql .= " WHERE DATE_FORMAT(date, '%Y-%m' ) = '{$year}-{$month}'";
 
  return find_by_sql($sql);
}

function  monthlySalesBySucursal($year,$month,$sucursal){
  global $db;
  $sql  = "SELECT * ";
  $sql .= " FROM sales";
  $sql .= " WHERE DATE_FORMAT(date, '%Y-%m' ) = '{$year}-{$month}' and id_sucursal='$sucursal'";
 
  return find_by_sql($sql);
}

function  monthlySalesByUser($year,$month,$usuario){
  global $db;
  $sql  = "SELECT * ";
  $sql .= " FROM sales";
  $sql .= " WHERE DATE_FORMAT(date, '%Y-%m' ) = '{$year}-{$month}' and id_vendedor='$usuario'";
 
  return find_by_sql($sql);
}

function insertar_movimiento_producto($id_producto,$tipo_movimiento,$cantidad,$id_usuario,$fecha){
	global $db;
$sql= "INSERT INTO movimientos (id_tipo_movimiento,id_vendedor_mov,id_producto_mov,cantidad_mov,fecha_movimiento) VALUES ('$tipo_movimiento','$id_usuario','$id_producto','$cantidad','$fecha')";
	 $insertar = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);
}
?>
