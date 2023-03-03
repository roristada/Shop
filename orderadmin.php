<?php include('db.php') ?>
<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        .container{
            background-color:#9becec;
            width:auto;
            height: auto;
            margin-top:30px;
            border-radius:10px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        }
    </style>
    </head>
    <body style="background-color:#deaaaa;">
    <div class="container">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Transaction ID</th>
        <th scope="col">ผู้สั่งซื้อ</th>
        <th scope="col">วันที่สั่งซื้อ</th>
        <th scope="col">เวลาสั่งซื้อ</th>
        <th scope="col">รายละเอียด</th>
      </tr>
    </thead>
    <?php $data = $pdo->prepare("SELECT * FROM orderpd JOIN account ON orderpd.username=account.username WHERE tracking='ยังไม่ระบุ' GROUP BY tid");
             $data->execute();
             while($row = $data->fetch()) : ?>
    <tbody>
      <tr>
        <td><?php echo $row['tid'];?></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['DtoOrder'];?></td>
        <td><?php echo $row['timeOrder'];?></td>
        <td><a href="./orderdetail.php?tid=<?php echo $row['tid']; ?>"><button class="btn btn-success">ดูรายละเอียด</button></td>
      </tr>
    </tbody>
    <?php endwhile; ?>
  </table>
  <a href="./index.php"><button class="btn btn-primary" style="margin-bottom:15px;">กลับสู่หน้าหลัก</button>
</div>
</body>
</html>