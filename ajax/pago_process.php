<?php
include('../includes/load.php');
page_require_level(1);
 existe_por_lo_menos_una_sucursal();
 esta_configurado();

 existe_sucursal_seleccionada();
$sucursal = usar_sucursal();

if(!isset($_POST['pago'])){
    echo "";
}
else{
    $pago = remove_junk($db->escape($_POST['pago']));
    $medio_pago = remove_junk($db->escape($_POST['medio_pago']));
    switch ($medio_pago) {
        case 1:
            $metodo_pago = "Efectivo";
            break;
        case 2:
            $metodo_pago = "Cheque";
            break;
        case 3:
            $metodo_pago = "Transferencia Bancaria";
            break;
    }
    $numero_compra = remove_junk($db->escape($_POST['num_compra']));
    $maximo = remove_junk($db->escape($_POST['maximo']));
    
    $fecha = make_date();
    $id_usuario = $_SESSION['user_id'];
    $id_sucursal = $sucursal[0];
    if($pago > $maximo){
        echo false;
    }else{
    $sql= "INSERT INTO pagos(num_compra,monto_pagado,fecha_pago,id_usuario,id_sucursal,metodo_pago) ";
    $sql.= "VALUES ($numero_compra,$pago,'{$fecha}',$id_usuario,$id_sucursal,'{$metodo_pago}')";
    $db->query($sql);

    //actualizar en compras
    $sql1="UPDATE compras SET pagado = pagado + $pago where numero_compra = $numero_compra";
    $db->query($sql1);

    //consultar si ya se pago todo
    $sql = "select costo_total_compra-pagado as diferencia from compras where numero_compra=$numero_compra";
    $dif = find_by_sql($sql);
    foreach($dif as $diff):
    $monto_restante = $diff['diferencia'];
    endforeach;
    
    if($monto_restante == 0){
        $sql_estado="UPDATE compras set status_compra = 'Total'";
        $db->query($sql_estado);
    }
    echo true;
}
}

?>