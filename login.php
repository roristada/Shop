<?php      
    echo' <script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    </script>';
?>
<?php
	if(isset($_POST['btn'])){
    session_start();
    include ('db.php');  
    $usrname = $_POST['username'];
    $password = $_POST['password'];
    $data = $pdo->prepare("SELECT * FROM account WHERE username='$usrname' ");
    $data->execute(); 
    $row = $data->fetch();
    if($row==""){
        echo  '<script>
        setTimeout(function(){
        swal({
            title : "ไม่พบชื่อผู้ใช้ในระบบ",
            text : "",
            type: "error"
            },function(){
                window.location = "login.php";
            });
        },500);
    </script>';  
    }
    else if($row['password'] != md5($password)){
        echo  '<script>
        setTimeout(function(){
        swal({
            title : "พาสเวิร์ดไม่ถูกต้อง",
            text : "",
            type: "warning"
            },function(){
                window.location = "login.php";
            });
        },500);
    </script>';  
    }else{
        echo  '<script>
            setTimeout(function(){
            swal({
                title : "ล็อคอินสำเร็จ",
                text : "",
                type: "success"
                },function(){
                    window.location = "index.php";
                });
            },500);
        </script>';  
        $_SESSION['user'] = array();
        array_push($_SESSION['user'],$row['username']);
        array_push($_SESSION['user'],$row['name']);
		$_SESSION['total'] = 0;
        header("location:index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://kit.fontawesome.com/665e7718e7.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div id="image"></div>
				<form action="login.php" method="post" class="login100-form validate-form">
					<span class="login100-form-title">
						Login
					</span>
					<label class="label">Username</label>
					<div class="wrap-input100">
						<input class="input100" id="in1" type="text" name="username">
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
					<label class="label">Password</label>
					<div class="wrap-input100">
						<input class="input100" type="password" name="password">
						<span class="symbol-input100">
							<i class="fa fa-lock" ></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="btn">
							Login
						</button>
					</div>


					<div class="text-center p-t-136">
						<a class="txt2" href="./register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>