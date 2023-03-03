<?php
    require_once 'db.php';
    $pid = $_GET['pid'];
    $res= $pdo->prepare("SELECT * FROM product WHERE productid='$pid'");
    $res->execute();
    $data = array();
    foreach ($res as $row){
        $data[] = $row;
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>