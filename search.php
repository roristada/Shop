<?php include "db.php" ?>
<?php      echo' <script>
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        </script>'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <script src="https://kit.fontawesome.com/2770523e2a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style31.css" />
    <link rel="stylesheet" href="/lightslider-master/src/css/lightslider.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <script src="/lightslider-master/src/js/lightslider.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <!---------------Navbar---------------------------------------------------------------------->
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
            <?php elseif(($_SESSION['user'][0] == "admin011")) : ?>
            <a href="./login.php"><i class="fas fa-user-astronaut"></i></a>
            <a href="index.php?logout='1'" style="color: black;font-weight:bold;">Logout</a>
            <?php elseif(isset($_SESSION['user'])) : ?>
              <a href="./login.php"><i class="fas fa-user"></i></a>
              <a href="index.php?logout='1'" style="color: black;font-weight:bold;">Logout</a>
            <?php endif; ?>
            <a href="./cart.php"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </nav>
      <!--------------------------------------------------------------------------------------->
      <div class="prod-text">
        <strong>Product</strong>
      </div>
      <div class="pro">
      <?php
        $product = $pdo->prepare("SELECT * FROM product WHERE productname LIKE ? GROUP BY productid" );
        if(!empty($_POST["sname"]))
        $value = '%'.$_POST["sname"].'%';
        $product->bindParam(1,$value);
        $product->execute();
        $test = $product->fetch();
        if(empty($_POST["sname"]) || $test==""){
          echo  '<script>
          setTimeout(function(){
          swal({
              title : "ไม่พบรายการที่ค้นหา",
              text : "",
              type: "error"
              },function(){
                  window.location = "index.php";
              });
          },100);
      </script>';
        }
        while($row = $product->fetch()) : ?>
        <div class="pro-box">
          <div class="pro-img">
            <a href="detail.php?pid=<?=$row['productid']?>">
            <img src="./productimage/<?=$row["picture"] ?>" alt="" /></a>
          </div>
          <div class="pro-de">
            <a href="detail.php?pid=<?=$row['productid']?>" id="pname"><?=$row["productname"] ?></a>
            <span id="pprice"><?=$row["price"] ?> Bath</span>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
 <!---------------------------------------Footer------------------------------------------------------>
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
                คำว่า ‘ก็อดซิลล่า’มาจากการผสมผสานระหว่างคำว่า ‘กอริลล่า’ กับ ‘ปลาวาฬ’ ในภาษาญี่ปุ่น
                สำหรับตัวของก๊อดซิลล่านั้น ผิวหนังที่ขรุขระจนดูเหมือนหินแข็ง นั่นเป็นแผลที่เกิดมาจากระเบิดนิวเคลียร์ ส่วนเสียงคำรามอันเป็นเอกลักษณ์นั้น เกิดจากการใช้ถุงมือเคลือบเรซิ่นถูกับสายของเครื่องดนตรีที่ชื่อว่า คอนทราเบส
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