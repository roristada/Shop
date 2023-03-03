<?php
    session_start();
    require_once 'db.php';
    $cid = $_GET['cid'];
    $res= $pdo->prepare("SELECT * FROM company WHERE cid='$cid'");
    $res->execute();
    $result = $res->fetch();
    $data = $result['price'];
    $_SESSION['cid'] = $result['cid'];
    echo $data;
?>