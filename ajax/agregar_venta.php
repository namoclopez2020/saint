<?php
	
require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
$generales = datos_generales();
foreach($generales as $general ){
	$moneda = $general['moneda'];
	$icono = $general['representacion'];
	$impuesto_letra = $general['impuesto'];
	$impuesto = $general['porcentaje_impuesto'];
}
 $products = find_all('products'); 
$categorias=find_all('categories');
$session_id=$_SESSION['user_id'];


//capturar datos de la sucursal
$id_sucursal=$_SESSION['id_sucursal'];

if (isset($_POST['id'])){
	$id=remove_junk($db->escape($_POST['id']));


if (isset($_POST['cantidad_und']) && isset($_POST['costo_prod']) && isset($_POST['cantidad_paq']))
{
$cantidad_und=remove_junk($db->escape($_POST['cantidad_und']));
$cantidad_paq = remove_junk($db->escape( $_POST['cantidad_paq']));
$precio_venta= remove_junk($db->escape($_POST['costo_prod']));	
		
}
$es_serial = remove_junk($db->escape($_POST['serializable']));

if($es_serial){
    $numero_serial = remove_junk($db->escape($_POST['serial']));
  $lote= existe_serial($numero_serial);
  if($lote == ""){
      echo false;
      exit();
  }   
  $vigente = lote_vigente($lote);
  if($vigente != "vigente"){
    echo 2;
    exit();
  }

  $pertenece_a_producto = pertenece_a_producto($lote,$id);
     if($pertenece_a_producto != 1){
         echo 3;
         exit();
     } 
    //capturar el id del serial para realizar la insercion en la tabla tmp
   $id_serial_query="SELECT id_serial from seriales where serial_number='{$numero_serial}'";
   $seriales = find_by_sql($id_serial_query);
   foreach($seriales as $serial):
    $id_serial = $serial['id_serial'];
   endforeach;
  
}

}
if (!empty($id)  and !empty($precio_venta))
{
$insert_tmp=$db->query("INSERT INTO tmp (id_producto,cantidad_und,cantidad_paq,precio_tmp,session_id) VALUES ('$id','$cantidad_und','$cantidad_paq','$precio_venta','$session_id')");


if($es_serial){
    
    //buscar ultimo id de compra para asignar un numero nuevo de compra
$sql=$db->query("select LAST_INSERT_ID(id_tmp) as last from tmp where session_id=$session_id order by id_tmp desc limit 0,1 ");
$rw=$db->fetch_array($sql);
$id_tmp=$rw['last'];

//agregar serial 
$insertar_serial=$db->query("INSERT INTO seriales_tmp_venta (id_serial,id_tmp_venta) VALUES ({$id_serial},{$id_tmp})");
    }

    }

if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=$db->query("DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
}

?>
<div class="table-responsive">
<table class="table">
<tr>
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th class='text-right'>COSTO</th>
	
	<th></th>
</tr>
<?php
	$sumador_total=0;
	
	$sql=$db->query("select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
	while ($row=$db->fetch_array($sql))
	{
	$medida_paq=$row['medida_paq'];
	$medida_und=$row['medida_und'];
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad_und=$row['cantidad_und'];
	$cantidad_paq=$row['cantidad_paq'];
	$nombre_producto=$row['nombre_producto'];
    $costo_compra=$row['precio_tmp'];
    $es_serial=$row['es_serial'];
    if($es_serial){
        $numero_serial = find_serial_number($id_tmp);
    }
    else{
        $numero_serial = "";
    }
    $sumador_total+=$costo_compra;
    
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad_paq." ".$medida_paq." ".$cantidad_und." ".$medida_und;?></td>
			<td><?php echo $nombre_producto."<br> S/N: <b>".$numero_serial ."<b>";?></td>
			<td class='text-right'><?php echo $icono." ".$costo_compra;?></td>
			
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="fa fa-trash"></i></a></td>
		</tr>		
		<?php
	}
	
	$total_factura= number_format($sumador_total,2,'.','');
	$total_iva=($total_factura * $impuesto )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$subtotal=$total_factura-$total_iva;

?>
<tr>
	<td class='text-right' colspan=4>SUBTOTAL <?php echo $icono?></td>
	<td class='text-right'><?php echo number_format($subtotal,2);?></td>
	<td></td>
</tr>
<tr>	
	<td class='text-right' colspan=4><?php echo $impuesto_letra." (".$impuesto.")% ".$icono  ?></td>
	<td class='text-right'><?php echo number_format($total_iva,2);?></td>
	<td></td>
</tr>
<tr>
	<td class='text-right' colspan=4>TOTAL <?php echo $icono?></td>
	<td class='text-right'><?php echo number_format($total_factura,2);?></td>
	<td></td>
</tr>

</table>
</div>
</form>
