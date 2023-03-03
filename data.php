<?php      
    echo' <script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    </script>';
?>
<?php
    session_start();
      include ('db.php') ;
      $tdata = json_decode($_SESSION['data'],true);
      $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
      $date = $date->format('Y:m:d:h:i:sa');
      $cdate = 
      $str = explode(":",$date);
      $tid = "TD".$str[0].$str[1].$str[2].$str[3].$str[4].substr($str[5],0,2);
      $cdate = $str[2]."/".$str[1]."/".$str[0];
      $time = $str[3].":".$str[4].":".$str[5];
      $usr = $_SESSION['user'][0];
      $cid = $_SESSION['cid'];
      for($i=0;$i<count($tdata);$i++){
        $pid = $tdata[$i]['pid'];
        $size = $tdata[$i]['size'];
        $qty = $tdata[$i]['quantity'];
        $price = $tdata[$i]['price'];
        $status = "ยังไม่ได้จัดส่ง";
        $track = "ยังไม่ระบุ";
        $product = $pdo->prepare("SELECT * FROM product WHERE productid='$pid' AND size='$size'");
        $product->execute();
        $row = $product->fetch();
        $product = $pdo->prepare("INSERT INTO orderpd VALUES ('$tid','$pid','$size',$qty,'$usr','$status','$track','$cdate','$cid','$time',$price)");
        $product->execute();
        $totalstock = $row['stock']-$qty;
        $totalSell = $row['NumofSell']+$qty;
        $product = $pdo->prepare("UPDATE product SET stock=$totalstock,NumofSell=$totalSell WHERE productid='$pid' AND size='$size'");
        $product->execute();

    }
    $_SESSION['total'] = 0;
    echo  '<script>
    setTimeout(function(){
    swal({
        title : "ทำการสั่งซื้อเรียบร้อย!",
        text : "",
        type: "success"
        },function(){
            window.location = "index.php";
        });
    },100);
  </script>';  
 ?>