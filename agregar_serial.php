<?php 
include('includes/load.php');
if(isset($_POST['agregar_serial']) ){
    $serial_number=remove_junk($db->escape($_POST['serial_number']));
    
    //buscar repetido
    $sql_busqueda="SELECT COUNT(id_serial) as cont from seriales where serial_number='$serial_number'";
    $buscar=find_by_sql($sql_busqueda);
    foreach($buscar as $s):
        $repetido = $s['cont'];
    endforeach;
    if($repetido > 0){
        $session->msg('d','El serial ya existe');
        redirect('seriales.php',false);
    }
    if($_SESSION['lote']==""){
        $session->msg('d','Seleccione lote a trabajar');
        redirect('seriales.php',false);
    }
    $lote = $_SESSION['lote'];

    //ver si ya estan completos los seriales por lote
    $consulta="SELECT  COUNT(id_serial) as cantidad_seriales from seriales WHERE id_detalle_prod=$lote";
    $contar=find_by_sql($consulta);

    foreach($contar as $contador):
        $cantidad_seriales=$contador['cantidad_seriales'];
    endforeach;

    $consulta1="SELECT und from detalle_producto where id_detalle=$lote";
    $contar1=find_by_sql($consulta1);

    foreach($contar1 as $contador1):
        $cantidad_unidades_de_lote=$contador1['und'];
    endforeach;
    
    if($cantidad_seriales >= $cantidad_unidades_de_lote){
        $session->msg('d','Los Seriales ya estan completos para este lote');
        redirect('seriales.php',false);
    }    
    $sql="INSERT INTO seriales (id_detalle_prod,serial_number,status) VALUES ($lote,'{$serial_number}','Vigente')";
    if($db->query($sql)){
        $consulta="SELECT  COUNT(id_serial) as cantidad_seriales from seriales WHERE id_detalle_prod=$lote";
        $contar=find_by_sql($consulta);
    
        foreach($contar as $contador):
            $cantidad_seriales=$contador['cantidad_seriales'];
        endforeach;
    
        $consulta1="SELECT und from detalle_producto where id_detalle=$lote";
        $contar1=find_by_sql($consulta1);
    
        foreach($contar1 as $contador1):
            $cantidad_unidades_de_lote=$contador1['und'];
        endforeach;
        
        if($cantidad_seriales >= $cantidad_unidades_de_lote){
            $sql_update="UPDATE detalle_producto set estado='vigente' where id_detalle=$lote";
            $db->query($sql_update); 
         } 
        $session->msg('s','Serial agregado Exitosamente');
     
        redirect('seriales.php',false);
    }
    
}
?>