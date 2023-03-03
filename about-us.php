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
    <title>About us</title>
    <script src="https://kit.fontawesome.com/2770523e2a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style31.css" />
    <link rel="stylesheet" href="/lightslider-master/src/css/lightslider.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <script src="./lightslider-master/src/js/lightslider.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
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

    <br>
    <div class="Aboutus">
        <h1>About us</h1><hr>
        <p>เว็บของเราเป็นเว็บไซต์ซื้อของออนไลน์ ลูกค้าสามารถซื้อของผ่านทางเว็บไซต์ของเราได้</p>
        ช่องทางการติดต่อ<br><br>
        <div class="col item social">
            <a href="#"><i class="fab fa-facebook-f"></i>zilla shop</a>
            <a href="#"><i class="fab fa-line"></i>zilla shop</a>
            <a href="#"><i class="fab fa-instagram"></i>zilla shop</a>
        </div><hr>
    </div>

    <div class="meet">
        <h1>MEET OUR TEAM</h1>
    </div><br>

    <div class="responsive">
        <div class="gallery">
            <img src="./images/sai.jpg" alt="" width="600" height="400">
            <div class="desc">ธนากร นิทรัพย์</div>
        </div>
      </div>
      
      <div class="responsive">
        <div class="gallery">
            <img src="./images/teen.jpg" alt="Northern Lights" width="600" height="400"> 
            <div class="desc">ธนพัฒน์ พิมพ์บุตร</div>
        </div>
      </div>
      
      <div class="responsive">
        <div class="gallery">
            <img src="./images/oat.jpg" alt="Mountains" width="600" height="400">
            <div class="desc">นครินทร์ หงษ์อ่อน</div>
        </div>
      </div>

      <div class="responsive">
        <div class="gallery">
            <img src="./images/is.jpg" alt="Mountains" width="600" height="400">
            <div class="desc">ธาดา อาจหาญ</div>
        </div>
      </div>
      
      <div class="clearfix"></div>

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