<?php session_start();
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductDetail</title>
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
    <style>
      input{
        text-align: center;
      }
      #red{
        color: red;
      }
    </style>
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
    <script>
      function checksize(){
        var s="",m="",l="",xl="";
        if (document.getElementById('s').checked) {
          s = document.getElementById('s').value;
        }
        if (document.getElementById('m').checked) {
          m = document.getElementById('m').value;
        }
        if (document.getElementById('l').checked) {
          l = document.getElementById('l').value;
        }
        if (document.getElementById('xl').checked) {
          xl = document.getElementById('xl').value;
        }
        if(s=="" && m=="" && l=="" && xl==""){
          document.getElementById("sub").disabled = true;
        }
        else{
          document.getElementById("sub").disabled = false;
        }
      }
    </script>
    <!-------------------------------------------------------------------------------------------->
    <!------------------------------Product Detail------------------------------------------------>
    <div class="product-container-detail">
    <form  action="addproduct.php" method="post"enctype="multipart/form-data" >   
          ชื่อสินค้า<span id="red"> *</span> <input class="form-control" type="text" aria-label="default input example" name="productName" required><br><br>
          ราคา<span id="red"> *</span> <input class="form-control" type="number" aria-label="default input example" name="price" required><br><br>
          รูป<span id="red"> *</span> <input class="form-control" type="file" aria-label="default input example" name="picture" required><br><br>
          รายละเอียด<br><textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detail"></textarea><br>
          ไซส์<span id="red"> *</span> &ensp;S&emsp;&ensp;<input class="form-check-input" type="checkbox" id="s" value="S" name="size[]" checked onclick="checksize()">&emsp;
          &ensp;M&emsp;&ensp;<input class="form-check-input" type="checkbox" id="m" value="M" name="size[]" onclick="checksize()">&emsp;
          &ensp;L&emsp;&ensp;<input class="form-check-input" type="checkbox" id="l" value="L" name="size[]" onclick="checksize()">&emsp;
          &ensp;XL&emsp;&ensp;<input class="form-check-input" type="checkbox" id="xl" value="XL" name="size[]" onclick="checksize()"><br><br>
          จำนวนสินค้า<span id="red"> *</span><input class="form-control" type="number" aria-label="default input example" name="stock" required><br>
          <input type="submit" id="sub" class="btn btn-success" name="submit" value="เพิ่มข้อมูล" >         
     </form>
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