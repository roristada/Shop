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
    <link rel="stylesheet" href="/lightslider-master/src/css/lightslider.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <script src="/lightslider-master/src/js/lightslider.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
    />
    <style>
        .form-control{
            width:60%;
        }
        .display{
            display:flex;
            gap:20px;
        }
    </style>
  </head>
  <body>
    <!-------------------------------------------------------------------------------------------------------------------->
    <div class="tableorder">
      <h2>Order | การสั่งซื้อ</h2>
      <table id="customers">
        <tr>
          <th>Order</th>
          <th>จำนวน</th>
          <th>ราคาสินค้า</th>
          <th>ราคารวมของสินค้า</th>
        </tr>
        <?php 
            include('db.php');
            if(isset($_POST['sub'])){
            $tid = $_GET['tid'];
            $track = $_POST['track'];
            $data2 = $pdo->prepare("UPDATE orderpd SET tracking='$track',statusPD='จัดส่งแล้ว' WHERE tid='$tid'");
            $data2->execute();     
            echo' <script>
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                </script>';
                echo '<script>
                setTimeout(function(){
                swal({
                    title : "อัพเดตข้อมูลเรียบร้อย",
                        text : "",
                        type: "success"
                        },function(){
                            window.location = "orderadmin.php";
                        });
                        },500);
                    </script>'; 
            }
        ?>
        <?php 
                $tid = $_GET['tid'];
                $total = 0;
                $data2 = $pdo->prepare("SELECT product.productname AS pname,orderpd.size AS size,orderpd.quantity AS quantity,orderpd.price AS price,account.address AS address,orderpd.statusPD AS statusPD,company.NofCompany AS cname,orderpd.tracking AS track,company.price AS cprice FROM `orderpd` JOIN product ON orderpd.pid=product.productid AND orderpd.size=product.size JOIN company ON orderpd.Cid=company.cid JOIN account ON orderpd.username=account.username WHERE tid='$tid'");
                  $data2->execute(); 
                  while ($row2 = $data2->fetch()):
                    $address = $row2['address'];
                    $status  = $row2['statusPD'];
                    $cname = $row2['cname'];
                    $track = $row2['track'];
                    $cprice  = $row2['cprice'];
                  ?>
        <tr>
            <td><?php echo $row2['pname']."ไซส์ ".$row2['size'];?></td>
            <td><?php echo $row2['quantity'];?></td>
            <td><?php echo number_format($row2['price'],2);?></td>
            <td><?php echo number_format($row2['price']*$row2['quantity'],2);?></td>
            <?php $total += ($row2['quantity']*$row2['price']); ?>
        </tr>
        <?php endwhile; ?>
      </table>
      <table id="totalprice">
        <tr>
          <th>ค่าบริษัทจัดส่ง</th>
          <td><?php echo $cprice; ?></td>
        </tr>
        <tr>
          <th>ราคารวม</th>
          <td><?php echo number_format($total,2);?></td>
        </tr>
        <tr>
          <th>ที่อยู่การจัดส่ง</th>
          <td><?php echo $address ?></td>
        </tr>
        <tr>
          <th>บริษัทที่เลือกจัดส่ง</th>
          <td><?php echo $cname ?></td>
        </tr>
        <tr>
          <th>Tracking-Number</th>
          <form action="orderdetail.php?tid=<?php echo $tid?>" method="post">
          <td class="display">
            <input class="form-control" type="text" placeholder="Tracking ID" name="track" aria-label="default input example" required>
            <input type="submit" class="btn btn-success" name="sub" value="ยืนยัน"></input>
            </td>
            </form>
        </tr>
      </table>
      <a href="./orderadmin.php" ><Button class="btn btn-danger" value="ย้อนกลับ" style="margin-left:10px;">ย้อนกลับ</Button></a>
    </div>
    <!-------------------------------------------------------------------------------------------------------------------->
    
<!-------------------------------------------------------------------------------------------------------------------->
    <div class="footer-dark">
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-md-3 item">
              <h3>Services</h3>
              <ul>
                <li><a href="#">Web design</a></li>
                <li><a href="#">Development</a></li>
                <li><a href="#">Hosting</a></li>
              </ul>
            </div>
            <div class="col-sm-6 col-md-3 item">
              <h3>About</h3>
              <ul>
                <li><a href="#">Company</a></li>
                <li><a href="#">Team</a></li>
                <li><a href="#">Contract</a></li>
              </ul>
            </div>
            <div class="col-md-6 item text">
              <h4>Zilla shop</h4>
              <p>
                คำว่า ‘ก็อดซิลล่า’มาจากการผสมผสานระหว่างคำว่า ‘กอริลล่า’ กับ
                ‘ปลาวาฬ’ ในภาษาญี่ปุ่น สำหรับตัวของก๊อดซิลล่านั้น
                ผิวหนังที่ขรุขระจนดูเหมือนหินแข็ง
                นั่นเป็นแผลที่เกิดมาจากระเบิดนิวเคลียร์
                ส่วนเสียงคำรามอันเป็นเอกลักษณ์นั้น
                เกิดจากการใช้ถุงมือเคลือบเรซิ่นถูกับสายของเครื่องดนตรีที่ชื่อว่า
                คอนทราเบส
              </p>
            </div>
            <div class="col item social">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-line"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
          <p class="copyright">Zilla shop © 1998</p>
        </div>
      </footer>
    </div>
  </body>
</html>
