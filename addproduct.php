<?php 
if (isset($_POST['submit']) && isset($_FILES['picture'])) {
    include "db.php";
    $date = date('Y:m:d:h:i:s');
    $str = explode(":",$date);
    $val = "PD".$str[0].$str[1].$str[2].$str[3].$str[4].$str[5];
    $pic_name = $_FILES['picture']['name'];   ///
	$xampp_path = $_FILES['picture']['tmp_name'];  ///
    $type = strtolower(pathinfo($pic_name, PATHINFO_EXTENSION)); ///
    $pass_type = array("jpg", "jpeg", "png"); ///
    $len = count($_POST['size']);
    if (in_array($type, $pass_type)) {
        $new_pic = uniqid("PIC-",true).'.'.$type; //
        $update_path = 'productimage/'.$new_pic; //
        move_uploaded_file($xampp_path,$update_path); ///
        foreach($_POST['size'] as $value){
        $stmt = $pdo->prepare("INSERT INTO product VALUES (?,?,?,?,?,?,?,0,0)");
            $stmt->bindParam(1,$val);
            $stmt->bindParam(2,$_POST["productName"]);
            $stmt->bindParam(3,$value);
            $stmt->bindParam(4,$_POST["price"]);
            $stmt->bindParam(5,$new_pic);  ///
            $stmt->bindParam(6,$_POST["detail"]);
            $stmt->bindParam(7,$_POST["stock"]);
            $stmt->execute();
        }
    }else {
        echo "<script>alert('ไม่รองรับไฟล์ประเภทนี้');</script>";
        echo "<script>window.location='addform.php';</script>";
      
    }
    echo "<script>alert('เพิ่มรายการสำเร็จ');</script>";
    echo "<script>window.location='addform.php';</script>";
    }
?>
