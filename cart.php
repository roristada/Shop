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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
        <script src="https://kit.fontawesome.com/2770523e2a.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./style31.css" />
        <script
          src="https://code.jquery.com/jquery-3.6.0.js"
          integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
          crossorigin="anonymous"
        ></script>
        <style>
     
        .cart-page .table input {
            width: 90px;
            height: 34px;
            font-size: 16px;
            color: #212529;
            text-align: center;
            background: #e9ecef;
            border: none;
            margin: auto;
        }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body onload="checkcompany()">
   <?php if(isset($_SESSION['user']) && isset($_COOKIE[$_SESSION['user'][0]]))
              {
                $cookie_data = stripslashes($_COOKIE[$_SESSION['user'][0]]);
                $cart_data = json_decode($cookie_data,JSON_UNESCAPED_UNICODE);
                  foreach($cart_data as $keys => $values){
                    if($cart_data[$keys]['username']==$_SESSION['user'][0])
                    {
                      $pid = $cart_data[$keys]["pid"];
                      $size = $cart_data[$keys]["size"];
                      $product = $pdo->prepare("SELECT price FROM product WHERE productid = '$pid' AND size='$size' ");
                      $product->execute();
                      $row = $product->fetch();
                      if($row['price'] != $cart_data[$keys]['price']){
                          $cart_data[$keys]["price"]  = $row['price'];
                      }
                    }
                  }
                  $item_data = json_encode($cart_data,JSON_UNESCAPED_UNICODE);
                  setcookie($_SESSION['user'][0], $item_data, time() + (86400 * 30));
              }
              ?>
    <script>
      function checkcompany(){
        for(let i=0;i<3;i++){
          if(document.getElementsByName("company")[i].checked == true){
            console.log("OKOK");
            document.getElementById("btn1").disabled = false;
            return;
          }
        }
        document.getElementById("btn1").disabled = true;
      }
    </script>
        <?php
            header('Content-Type: text/html; charset=utf-8');
            $check = 0;
            if(isset($_POST["submit"]) && isset($_SESSION['user'][0]))
            {
             if(isset($_COOKIE[$_SESSION['user'][0]]))
             {
              $cookie_data = stripslashes($_COOKIE[$_SESSION['user'][0]]);
            
              $cart_data = json_decode($cookie_data,JSON_UNESCAPED_UNICODE);
             }
             else
             {
              $cart_data = array();
             }
              foreach($cart_data as $keys => $values)
              {
               if($cart_data[$keys]["pid"] == $_GET["pid"] && $cart_data[$keys]["size"] == $_POST["size"] && $cart_data[$keys]['username']==$_SESSION['user'][0])
               {
                $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $_POST["num"];
                $check = 1;
               }
              }
             if($check == 0)
             {
              $item_array = array(
                'pid'   => $_GET['pid'],
                'pname'   => $_GET['pname'],
                'price'  => $_GET['price'],
                'quantity'  => $_POST['num'],
                'img' => $_GET['pimg'],
                'size' => $_POST['size'],
                'username' => $_SESSION['user'][0]
              );  
              $cart_data[] = $item_array;
             }
             $item_data = json_encode($cart_data,JSON_UNESCAPED_UNICODE);
             setcookie($_SESSION['user'][0], $item_data, time() + (86400 * 30));
             header("location:cart.php");
            }
            if(isset($_GET["action"]))
            {
             if($_GET["action"] == "delete")
             {
              $cookie_data = stripslashes($_COOKIE[$_SESSION['user'][0]]);
              $cart_data = json_decode($cookie_data,JSON_UNESCAPED_UNICODE);
              foreach($cart_data as $keys => $values)
              {
               if($cart_data[$keys]['pid'] == $_GET['pid'] && $cart_data[$keys]['size'] == $_GET['size'] && $cart_data[$keys]['username']==$_SESSION['user'][0])
               {
                unset($cart_data[$keys]);
                $item_data = json_encode($cart_data,JSON_UNESCAPED_UNICODE);
                setcookie($_SESSION['user'][0], $item_data, time() + (86400 * 30));
                header("location:cart.php");
               }
              }
             }
             if($_GET["action"] == "clear")
              {
                $check = false;
                $_SESSION['data'] = $_COOKIE[$_SESSION['user'][0]];
                $tdata = json_decode($_SESSION['data'],true);
                for($i=0;$i<count($tdata);$i++){
                  $pid = $tdata[$i]['pid'];
                  $size = $tdata[$i]['size'];
                  $qty = $tdata[$i]['quantity'];
                  $price = $tdata[$i]['price'];
                  $product = $pdo->prepare("SELECT stock,price FROM product WHERE productid = '$pid' AND size='$size' ");
                  $product->execute();
                  $row = $product->fetch();
                  if($row['stock'] < $qty || $row['price']!=$price){
                    $check = true;
                    echo' <script>
                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                    </script>';
                    echo  '<script>
                        setTimeout(function(){
                        swal({
                            title : "แจ้งเตือนการสั่งซื้อสินค้า!",
                            text : "จำนวนสินค้าบางรายการไม่พอหรือราคามีการเปลี่ยนแปลง กรุณาดำเนินการใหม่",
                            type: "error"
                            },function(){
                                window.location = "cart.php";
                            });
                        },100);
                      </script>';  
                  }
                }
             
                if(!$check){
                  setcookie($_SESSION['user'][0], "", time() - 3600);
                  header("location:data.php");
                }
              }
            }
          
            
            
            ?>
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
           <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                    <?php
                                    
                                      if(isset($_SESSION['user']) && isset($_COOKIE[$_SESSION['user'][0]]))
                                        {

                                          $cookie_data = stripslashes($_COOKIE[$_SESSION['user'][0]]);
                                          $cart_data = json_decode($cookie_data,JSON_UNESCAPED_UNICODE);
                                          foreach($cart_data as $keys => $values)
                                      {
                                    ?>
                                      <?php
                                        $pid = $values['pid'];
                                        $size = $values['size'];
                                        $product = $pdo->prepare("SELECT stock FROM product WHERE productid = '$pid' AND size='$size' ");
                                        $product->execute();
                                        $row = $product->fetch();
                                      ?>
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="./productimage/<?php echo $values["img"]; ?>" alt="Image"></a>
                                                    <p><?php echo $values["pname"].'ไซส์ '.$values["size"]; ?></p><smell style="color:red">&ensp;ยอดคงเหลือ: <?php echo $row['stock']; ?></small>
                                                </div>
                                              
                                            </td>
                                            <td><?=$values['price']?></td>
                                            <td>
                                            <p><?php echo $values["quantity"]; ?></p>
                                            </td>
                                            <td><?php echo number_format($values['quantity']*$values['price'])?></td>
                                            <td><a href="cart.php?action=delete&pid=<?=$values['pid']?>&size=<?=$values['size']?>"><button><i class="fa fa-trash"></i></button></a></td>
                                        </tr>
                                        
                                        <?php 
                                           $_SESSION['total'] += ($values['quantity']*$values['price']);
                                        } ?>
                                      <?php 
                                   } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                    <?php if(isset($_SESSION['user'])) :?>
                                        <script>
                                          function selectcompany(id){
                                              checkcompany();
                                              httpRequest = new XMLHttpRequest();
                                              httpRequest.onreadystatechange = showResult;
                                              var url= "company.php?cid="+id;
                                              httpRequest.open("GET", url);
                                              httpRequest.send();
                                            }
                                            function showResult() {
                                              if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                                                result = httpRequest.responseText;
                                                var total = <?php echo $_SESSION['total']; ?>;
                                                document.getElementById("sc").innerHTML = result;
                                                document.getElementById("gt").innerHTML = (total+Number(result));
                                              }
                                            }
                                            function subform(){
                                              document.getElementById('subform').submit();
                                            }
                                        </script>
                                        <div class="cart-content">
                                            <h1>Cart Summary</h1>
                                            <p>Sub Total<span><?php echo $_SESSION['total']; ?></span></p>
                                            <label>เลือกบริษัทจัดส่ง</label>
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="company" id="flexRadioDefault1" value="CM0001" onclick="selectcompany('CM0001')">
                                              <label class="form-check-label" for="flexRadioDefault1">
                                                KERRY EXPRESS
                                              </label>
                                            </div>
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="company" id="flexRadioDefault1" value="CM0002" onclick="selectcompany('CM0002')">
                                              <label class="form-check-label" for="flexRadioDefault1">
                                                ไปรษณีย์ไทย
                                              </label>
                                            </div>
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="company" id="flexRadioDefault1" value="CM0003" onclick="selectcompany('CM0003')">
                                              <label class="form-check-label" for="flexRadioDefault1">
                                                Ninja Van
                                              </label>
                                            </div>
                                            <br>
                                            <p>Shipping Cost<span id="sc">0</span></p>
                                            <h2>Grand Total<span id="gt">0</span></h2>
                                        </div>
                                        <?php else: ?>
                                          <div class="cart-content">
                                            <h1>Cart Summary</h1>
                                            <p>Sub Total<span>0</span></p>
                                            
                                            <p>Shipping Cost<span>0</span></p>
                                            <h2>Grand Total<span>0</span></h2>
                                        </div>
                                        <?php endif; ?>
                                        <div class="cart-btn">
                                            <a href="cart.php?action=clear" style="text-decoration: none;color: aliceblue;"><button id="btn1" onclick="subform()">Check out</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
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