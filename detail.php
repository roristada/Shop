<?php include "db.php";
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header('location: index.php');
    }
?>
<?php if(!isset($_SESSION['user'])){
  header('location: login.php');
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductDetail</title>
    <script src="https://kit.fontawesome.com/2770523e2a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style31.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <style>
      #si{
        color: green;
      }
      #btn1:focus,#btn2:focus,#btn3:focus,#btn4:focus{
        background-color:green;
      }
      #btn{
        width: 80px;
      }
      body{
        background-image: url(./22536.jpg);
        box-sizing: border-box;
      }
      .product-container-detail .product-box-detail input {
        width: 103px;
        position: relative;
        height: 40px;
        color: #000000;
        font-size: 16px;
        text-align: center;
        background: #ffffff;
        top: 0px;
      }
      .button{
        width: 84px;
        background-color: green;
        border-radius: 5px;
        border: none;
        color: white;
        text-align: center;
        font-size: 20px;
        padding: 5px;
      }
      .button:focus{
        bo
      }
      .dis{
        display : flex;
        gap : 10px;
      }
      .ra{
        display:flex;
        height: 50px;
      }
      label{
        font-size: xx-large;
      }
        </style>
</head>
<body onload="send()">
  <?php $pid = $_GET['pid']; ?>
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
    <!-------------------------------------------------------------------------------------------->
    <!------------------------------Product Detail------------------------------------------------>
    <?php 
      $pro = $pdo->prepare("SELECT * FROM `product` WHERE productid='$pid' ");
      $pro->execute();
      $row = $pro->fetch();
      $total = $row['NumofView'] + 1;
      $data = $pdo->prepare("UPDATE product SET NumofView = $total WHERE productid='$pid'");
      $data->execute();
      ?>
    <div class="product-container-detail">
        <div class="product-box-detail">
            <div class="product-img-detail">
              <img src="./productimage/<?=$row["picture"] ?>">
            </div>
            <div class="product-details-detail">
                <div class="p-name-detail">
                    <?=$row['productname'] ?>
                </div>
               
                <div class="p-price-detail">
                  ราคา <?=$row['price']?> THB
                </div>
      <script>
        var httpRequest;
        var result;
        var arr = [];
        var stock = [];
        var ch = false;
        function checkbut(){
          for(let i=0;i<4;i++){
          
            if(document.getElementsByName("size")[i].checked == true){
              
                document.getElementById("btnsub").disabled = false;
                document.getElementById("btnsub").style.backgroundColor = "green";
                return;
            }
          }
          document.getElementById("btnsub").disabled = true;
          document.getElementById("btnsub").style.backgroundColor = "gray";
        }
        function send() {
          checkbut();
          httpRequest = new XMLHttpRequest();
          httpRequest.onreadystatechange = showResult;
          var pid = "<?php echo $pid; ?>";
         
          var url= "ajaxres.php?pid="+pid;
         
          httpRequest.open("GET", url);
          httpRequest.send();
        }
        function showResult() {
          bsize = ['S','M','L','XL'];
          if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            result = httpRequest.responseText;
            var obj = jQuery.parseJSON(result);
            
            for(let i=0;i<obj.length;i++){
              arr.push(obj[i]["size"]);
              stock.push(obj[i]["stock"]);
            }
            sizex = obj[0]['size'];
            for(let i=0;i<4;i++){
              if(arr.indexOf(bsize[i]) == -1){   
                let str = "btn"+(i+1);
                document.getElementById(str).disabled = true;
              }
            }
            for(let i=0;i<stock.length;i++){
              if(stock[i] == 0){  
                if(arr[i]=="S"){
                  let str = "btn1";
                  document.getElementById(str).disabled = true;
                }
                else if(arr[i]=="M"){
                  let str = "btn2";
                  document.getElementById(str).disabled = true;
                }
                else if(arr[i]=="L"){
                  let str = "btn3";
                  document.getElementById(str).disabled = true;
                }
                else if(arr[i]=="XL"){
                  let str = "btn4";
                  document.getElementById(str).disabled = true;
                }
              } 
            }
          }
        }
        function send3(size){
          send();
          showResult();
          const index = arr.indexOf(size);
          const num  = stock[index];
          document.getElementById("vale").innerHTML = num;
          document.getElementById("si").innerHTML = size;
          ch = true;
          document.getElementById("num").addEventListener("change", function() {
            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
            if (v > parseInt(num)) this.value = parseInt(num);
          });
          
        }
    </script>
                <div class="pd">
                คุณเลือกไซส์
                <strong id="si">-</strong>
                </div> 
                <div class="pd">
                ยอดสินค้าคงเหลือ
                <strong id="vale">-</strong>
                </div>
                <div class="qty">
                    <form  action="cart.php?pid=<?=$row['productid']?>&pname=<?=$row['productname']?>&pimg=<?=$row['picture']?>&price=<?=$row['price']?>" method = "post">
                    <div class="ra">
                    <label >ไซส์</label></input>
                      <input type="radio" name="size" id="btn1" value="S" onclick="send3('S')">
                      <label id="btn1">S</label></input>
                      <input type="radio"  name="size" id="btn2" value="M" onclick="send3('M')">
                      <label id="btn2">M</label></input>
                      <input type="radio"  name="size" id="btn3" value="L" onclick="send3('L')">
                      <label id="btn3">L</label></input>
                      <input type="radio"  name="size" id="btn4" value="XL" onclick="send3('XL')">
                      <label id="btn4">XL</label></input>
                    </div>
                      <div class="dis"> 
                      <input class="form-control" id="num" type="number" name="num" value=1 min=1 max="50" aria-label="default input example">
                       <button class="button" type="submit" id="btnsub" name="submit">สั่งซื้อ</button>
                      </div>
                    </form>                
                  </div>
                <div class="p-price-detail">
                  รายละเอียดของสินค้า
                </div>
                <div class="p-detail">
                    <?=$row['detail']?>
                </div>
                <a href="product.php"><button id="btn" class="btn btn-danger">ย้อนกลับ</button></a>
            </div>
            
        </div>
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