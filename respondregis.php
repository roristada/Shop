<?php
    include ('db.php');
    $use = $pdo->prepare("SELECT username FROM account" );
    $use->execute();
    $data = array();
    while ($row =$use->fetch() ){
        array_push($data,$row['username']);
    }
    $use = $_GET['use'];
    if (!in_array($use,$data) ) {
        echo "okay";
    } else {
        echo "denied";
    }
?>