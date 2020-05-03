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
}

if (isset($_POST['cantidad_und']) && isset($_POST['costo_prod']) && isset($_POST['cantidad_paq']))
{
$cantidad_und=remove_junk($db->escape($_POST['cantidad_und']));
$cantidad_paq = remove_junk($db->escape( $_POST['cantidad_paq']));
$costo_compra= remove_junk($db->escape($_POST['costo_prod']));	
		
}

if (!empty($id)  and !empty($costo_compra))
{
$insert_tmp=$db->query("INSERT INTO tmp_compra (id_producto_compra,cantidad_und,cantidad_paq,costo_compra_tmp,session_id_compra) VALUES ('$id','$cantidad_und','$cantidad_paq','$costo_compra','$session_id')");

}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=$db->query("DELETE FROM tmp_compra WHERE id_tmp_compra='".$id_tmp."'");
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
	
	$sql=$db->query("select * from products, tmp_compra where products.id_producto=tmp_compra.id_producto_compra  and tmp_compra.session_id_compra='".$session_id."'");
	while ($row=$db->fetch_array($sql))
	{
	$medida_paq=$row['medida_paq'];
	$medida_und=$row['medida_und'];
	$id_tmp=$row["id_tmp_compra"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad_und=$row['cantidad_und'];
	$cantidad_paq=$row['cantidad_paq'];
	$nombre_producto=$row['nombre_producto'];
    $costo_compra=$row['costo_compra_tmp'];
	$sumador_total+=$costo_compra;
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad_paq." ".$medida_paq." ".$cantidad_und." ".$medida_und;?></td>
			<td><?php echo $nombre_producto;?></td>
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
