<?php
    require_once 'db.php';
    $date = $_GET['date'];
    $res= $pdo->prepare("SELECT DtoOrder,orderpd.pid AS pid,productname,orderpd.size AS size,SUM(quantity) AS NumofSell FROM orderpd JOIN product ON orderpd.pid=product.productid AND orderpd.size=product.size WHERE DtoOrder = '$date' GROUP BY orderpd.pid,orderpd.size");
    $res->execute();
    $data = array();
    foreach ($res as $row){
        $data[] = $row;
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>