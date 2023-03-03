<?php include ("db.php");
    session_start();
    $_SESSION['total'] = 0;
    $_SESSION['data'] = "";
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        unset($_SESSION['total']);
        header('location: cart.php');
    }    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order detail</title>
    <script
      src="https://kit.fontawesome.com/2770523e2a.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style31.css" />
    <style>
       body{
        background-image: url(./22536.jpg);
        box-sizing: border-box;
      }
    </style>
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
    />
  </head>
  <body>
  <nav>
      <div class="menu-bar">
        <a href="./index.php" class="logo">
          <img src="./logo.png" alt="" />
        </a>
        <ul class="menu">
          <li><a href="./index.php">Home</a></li>
          <?php if((isset($_SESSION['user'])) and ($_SESSION['user'][0] == "admin011")) : ?>
          <li><a href="./udt.php">Product</a></li>
          <li><a href="./orderadmin.php">Order</a></li>
          <li><a href="./statorder.php">StatProduct</a></li>
          <li><a href="./addform.php">Addproduct</a></li>
          <?php else: ?>
            <li><a href="./Product.php">Product</a></li>
            <li><a href="./order.php">Order</a></li>
            <li><a href="./about-us.php">Contact</a></li>
          <?php endif; ?>
        </ul>
        <div class="r-menu">
            <?php if (!isset($_SESSION['user'])) : ?>
            <a href="./login.php"><i class="fas fa-user"></i></a>
            <?php else : ?>
            <a style="color: brown; font-size: 20px;"> Welcome <?php echo $_SESSION['user'][1]; ?><a>
            <a href="index.php?logout='1'" style="color: black;">Logout</a>
            <?php endif; ?>
            <a href="./cart.php"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </nav>
    <!-------------------------------------------------------------------------------------------------------------------->
    <div class="tableorder">
      <h2>Order | การสั่งซื้อ</h2>
      <?php 
        if(!isset($_SESSION['user'])){
          return;
        }
        $use = $_SESSION['user'][0];
        $data = $pdo->prepare("SELECT * FROM orderpd WHERE username = '$use' GROUP BY DtoOrder,timeOrder");
        $data->execute(); 
        while ($row = $data->fetch()):
          $tid = $row['tid'];
          $time = $row['timeOrder'];
          $total = 0;
      ?>
      <table id="customers">
        <tr>
          <th>เลขที่ใบสั่งซื้อ : <?php echo $row['tid'];?> &ensp;เวลา : <?php echo $row['timeOrder'];?></th>
        </tr>
        <tr>
          <th>Order</th>
          <th>จำนวน</th>
          <th>ราคาสินค้า</th>
          <th>ราคารวมของสินค้า</th>
        </tr>
            <?php $data2 = $pdo->prepare("SELECT product.productname AS pname,orderpd.size AS size,orderpd.quantity AS quantity,orderpd.price AS price,account.address AS address,orderpd.statusPD AS statusPD,company.NofCompany AS cname,orderpd.tracking AS track,company.price AS cprice FROM `orderpd` JOIN product ON orderpd.pid=product.productid AND orderpd.size=product.size JOIN company ON orderpd.Cid=company.cid JOIN account ON orderpd.username=account.username WHERE orderpd.username='$use' AND tid='$tid'");
                  $data2->execute(); 
                  while ($row2 = $data2->fetch()):
                    $address = $row2['address'];
                    $status  = $row2['statusPD'];
                    $cname = $row2['cname'];
                    $track = $row2['track'];
                    $cprice  = $row2['cprice'];
                  ?>
        <tr>
          <td><?php echo $row2['pname'].'ไซส์'.$row2['size']; ?></td>
          <td><?php echo $row2['quantity']; ?></td>
          <td><?php echo number_format($row2['price'],2); ?></td>
          <td><?php echo number_format(($row2['quantity']*$row2['price']),2); ?></td>
          <?php $total += ($row2['quantity']*$row2['price']); ?>
        </tr>
        <?php endwhile; ?>
       
      </table>
      <table id="totalprice">
      <tr>
          <th>ค่าบริษัทจัดส่ง</th>
          <td><?php echo number_format($cprice,2); ?></td>
        </tr>
        <tr>
          <th>ราคารวม</th>
          <td><?php echo number_format(($total+$cprice),2); ?></td>
        </tr>
        <tr>
          <th>ที่อยู่การจัดส่ง</th>
          <td><?php echo $address; ?></td>
        </tr>
        <tr>
          <th>สถานะการสั่งซื้อ</th>
          <td><?php echo $status; ?></td>
        </tr>
        <tr>
          <th>บริษัทที่เลือกจัดส่ง</th>
          <td><?php echo $cname; ?></td>
        </tr>
        <tr>
          <th>Tracking-Number</th>
          <td><?php echo $track; ?></td>
        </tr>
      
      </table>
      <?php endwhile; ?>
  
    </div>
    <!-------------------------------------------------------------------------------------------------------------------->
    
<!-------------------------------------------------------------------------------------------------------------------->
  </body>
</html> 
