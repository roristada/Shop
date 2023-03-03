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
    <link rel="stylesheet" href="./style31.css" />
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
            <?php else : ?>
            <a style="color: brown; font-size: 20px;"> Welcome <?php echo $_SESSION['user'][1]; ?><a>
            <a href="index.php?logout='1'" style="color: black;">Logout</a>
            <?php endif; ?>
            <a href="./cart.php"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </nav><br>

<?php include "db.php" ?>
<?php
$stmt = $pdo->prepare("SELECT * FROM product WHERE productid = ? AND size= ?");
$stmt->bindParam(1, $_GET["productid"]);
$stmt->bindParam(2, $_GET["size"]);
$stmt->execute();
$row = $stmt->fetch();
?>

<html>
<head><meta charset="utf-8"></head>
<body>
<div class="edit">
      <div class="subedit">
        <form action="editproduct.php?size=<?=$row["size"]?>" method="post">
          <input type="hidden" name="productid" value="<?=$row["productid"]?>">
          Productname : <input type="text" required name="productname" value="<?=$row["productname"]?>"><br><br>
          Size: <label> <?=$row["size"]?> </label><br><br>
          Detail : <br>
          <textarea name="detail" rows="3" cols="40"  ><?=$row["detail"]?></textarea><br><br>
          Price : <input type="number" required name="price" value="<?=$row["price"]?>"><br><br>
          Stock : <input type="number" required name="stock" value="<?=$row["stock"]?>"><br><br>
          <input type="submit" value="Edit " id="submit">
        </form>
      </div>
</div>




</body>
</html>