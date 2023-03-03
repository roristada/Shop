<?php include "db.php";
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <script src="https://kit.fontawesome.com/2770523e2a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style31.css" />
    <link rel="stylesheet" href="./lightslider-master/src/css/lightslider.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <style>
      label{
        display: inline-block;
    margin-bottom: .5rem;
    padding: 10px;
    border-radius: 10px;
    font-size:23px;
    background-color: cornsilk;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
      }
      </style>
    <script src="./lightslider-master/src/js/lightslider.js"></script>
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
    <!------------------------------------------------------------------------->
    <form action="search.php" method="post">
      <div class="search">    
          <div class="text-search">
            <input type="text" name="sname" placeholder="Search Here!!">
            <input type="submit" value="Search" 
            style="width: 70px;
            height: 40px;
            border-radius: 10px;
            background-color: #c77486;
            color: #ffffff;">
          </div>
      </div>
    </form>
    <!-------------Slides------------------------------------------------------>
    <?php  
          $product = $pdo->prepare("SELECT COUNT(*) AS c FROM product");
          $product->execute();
          $len = $product->fetch(); 
          $len = $len['c']-1;
          $product2 = $pdo->prepare("SELECT * FROM product LIMIT $len,$len");
          $product2->execute();
          $data1 = $product2->fetch(); 
          $product3 = $pdo->prepare("SELECT productid,picture,SUM(NumofSell) FROM `product` GROUP BY productid ORDER BY SUM(NumofSell) DESC LIMIT 1 ");
          $product3->execute();
          $data2 = $product3->fetch(); 
          $product4 = $pdo->prepare("SELECT productid,picture,SUM(NumofView) FROM `product` GROUP BY productid ORDER BY SUM(NumofView) DESC LIMIT 1 ");
          $product4->execute();
          $data3 = $product4->fetch(); 
                   
    ?>
    <ul id="adaptive" class="cs-hidden">
      <li class="item-a">
        <div class="full-slide 1">
          <div class="slide-content">
          <label>ยอดขายสูงสุด</label>
            <a href="detail.php?pid=<?=$data2['productid']?>"><img src="./productimage/<?=$data2['picture']?>" alt="" /></a>
          </div>
        </div>
      </li>
      <li class="item-b">
        <div class="full-slide 2">
          <div class="slide-content">
          <label>ยอดเข้าชมสูงสุด</label>
          <a href="detail.php?pid=<?=$data3['productid']?>"><img src="./productimage/<?=$data3['picture']?>" alt="" /></a>
          </div>
        </div>
      </li>
      <li class="item-c">
        <div class="full-slide 3">
          <div class="slide-content">
          <label>สินค้ามาใหม่</label>
          <a href="detail.php?pid=<?=$data1['productid']?>"><img src="./productimage/<?=$data1['picture']?>" alt="" /></a>
          </div>
        </div>
      </li>
    </ul>
    <!----------------------------------------------------------------------------------------->
    <!--------------Product Recommend---------------------------------------------------------->
    <section class="Product">
      <div class="rec-text">
        <span><strong>Recommend Product TOP 3</strong></span>
      </div>
      <div class="pro-rec">
      <?php
          $product = $pdo->prepare("SELECT picture,productid,productname,price,SUM(NumofSell) FROM product GROUP BY productid ORDER BY SUM(NumofSell) DESC LIMIT 3");
          $product->execute();
          while($row = $product->fetch()) : ?>
        <div class="pro-box">
          <div class="pro-img">
            <a href="detail.php?pid=<?=$row['productid'];?>">
            <img src="./productimage/<?=$row["picture"] ?>" alt="" /></a>
          </div>
          <div class="pro-de">
            <a href="detail.php?pid=<?=$row['productid'];?>" id="pname"><?=$row["productname"] ?></a>
            <span id="pprice"><?=$row["price"] ?>Bath</span>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
      <!------------------------>
      <div class="rec-text">
        <strong>Product</strong>
      </div>
      <div class="sale-pro">
      <?php
          $product = $pdo->prepare("SELECT * FROM product GROUP BY productid LIMIT 3");
          $product->execute();
          while($row = $product->fetch()) : ?>
        <div class="pro-box">
          <div class="pro-img">
            <a href="#">
            <img src="./productimage/<?=$row["picture"] ?>" alt="" /></a>
          </div>
          <div class="pro-de">
            <a href="#" id="pname"><?=$row["productname"] ?></a>
            <span id="pprice"><?=$row["price"] ?>Bath</span>
          </div>
        </div>
        <?php endwhile; ?>
        </div>
      </div>
      
    </section>
    <!--------------------------------------------------------------------------------------------------->
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

    <script>
      $(document).ready(function () {
        $("#adaptive").lightSlider({
          adaptiveHeight: true,
          item: 1,
          auto: true,
          slideMargin: 0,
          pauseOnHover: true,
          pause: 5000,
          loop: true,
        });
      });
    </script>
  </body>
</html>