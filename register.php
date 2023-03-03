<?php      echo' <script>
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        </script>'; 
?>
<?php
    include ('db.php');  
	if(isset($_POST['btn'])){
	session_start();
    $usrname = $_POST['username'];
    $password = md5($_POST['password1']);
    $title = $_POST['title'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $data = $pdo->prepare("INSERT INTO account VALUES ('$usrname','$title','$name','$address','$contact','$password')");
    $data->execute(); 
	$_SESSION['user'] = array();
        array_push($_SESSION['user'],$usrname);
        array_push($_SESSION['user'],$name);
	echo '<script>
		setTimeout(function(){
		swal({
			title : "ดำเนินการสมัครเรียบร้อย",
				text : "",
				type: "success"
				},function(){
					window.location = "index.php";
				});
				},500);
			</script>'; 
	}
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/665e7718e7.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<style>
		#btnss{
			width: 125px;
			margin-left: auto;
			margin-right: auto;
			height: 50px;
			background-color: #2cbe2c;
			border-radius: 27px;
			font-size: large;
	    	color: white;
		}
		
	</style>
</head>
<body onload="checkall()">
	<script>
		var ch1=0,ch2=0,ch3=0,ch4=0,ch5=0;
		 function linktologin(){
			window.location.replace("./login.php");
		}
		function checkall(){
			if(ch1+ch2+ch3+ch4+ch5 != 5){
				document.getElementById("btnss").style.backgroundColor = "gray";
				document.getElementById("btnss").disabled = true;
				document.getElementById("btnss").innerHTML = "กรอกข้อมูล";
			}else{
				document.getElementById("btnss").disabled = false;
				document.getElementById("btnss").style.backgroundColor = " #2cbe2c";
				document.getElementById("btnss").innerHTML = "ยืนยัน";
			}
		}
		function send() {
          httpRequest = new XMLHttpRequest();
          httpRequest.onreadystatechange = showResult;
		  var use = document.getElementById("usrname").value;
          var url= "respondregis.php?use="+use;
          httpRequest.open("GET", url);
          httpRequest.send();
        }
		function checkvalid(){
			const ch = /[A-Za-z]/;
			const digit = /\d/;
			let str = document.getElementById("usrname").value;
			let strl = str.length;
			return (ch.test(str) && digit.test(str) && strl >= 8);	
		}
		function checkvalid2(){
			const ch = /[A-Za-z]/;
			const digit = /\d/;
			let str = document.getElementById("pass1").value;
			let strl = str.length;
			return (ch.test(str) && digit.test(str) && strl >= 6);	
		}
        function showResult() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
				
				if(httpRequest.responseText == "okay"){
					console.log(checkvalid());
					if(document.getElementById("usrname").value!="" && checkvalid()==1){
						document.getElementById("sm").style.color = "green";
						document.getElementById("sm").innerHTML = "Username สามารถใช้งานได้";
						ch1 = 1;
						checkall()
					}else{
						console.log("this!");
						document.getElementById("sm").style.color = "red";
						document.getElementById("usrname").style.border = "1px solid red";
						document.getElementById("sm").innerHTML = "ภาษาอังกฤษและตัวเลข 8 ตัวขึ้นไป";
						ch1 = 0;
						checkall()
					}
		  		}else{
					document.getElementById("sm").style.color = "red";
					document.getElementById("usrname").style.border = "1px solid red";
					document.getElementById("sm").innerHTML = "Username ถูกใช้งานไปแล้ว";
				}	
			}
		}
		function checkpassword(){
			pass1 = document.getElementById("pass1").value;
			pass2 = document.getElementById("pass2").value;
			if(pass1!="" && pass2!=""){
				if(pass1.localeCompare(pass2)!=0 || checkvalid2()!=1){
					document.getElementById("sd1").style.display = "inline";
					document.getElementById("sd2").style.display = "inline";
					document.getElementById("sd1").style.color = "red";
					document.getElementById("pass1").style.border = "1px solid red";
					document.getElementById("sd1").innerHTML = "พาสเวิร์ดไม่ถูกต้องหรือไม่ตรงกัน";
					document.getElementById("sd2").style.color = "red";
					document.getElementById("pass2").style.border = "1px solid red";
					document.getElementById("sd2").innerHTML = "พาสเวิร์ดไม่ถูกต้องหรือไม่ตรงกัน";
				}else{
					document.getElementById("sd1").style.display = "none";
					document.getElementById("pass1").style.border = "none";
					ch2 = 1;checkall()
					document.getElementById("sd2").style.display = "none";
					document.getElementById("pass2").style.border = "none";
				}
			}else{
				ch2 = 0;checkall()
			}
		}
		function checkaddress(){
			let ad = document.getElementById("ad").value;
			if(ad == ""){
				ch3=0;checkall()
			}else{
				ch3=1;checkall()
			}
			
		}
		function checkname(){
			let n = document.getElementById("n").value;
			if(n == ""){
				ch4=0;checkall()
			}else{
				ch4=1;checkall()
			}
			
		}
		function checkcontact(){
			let ct = document.getElementById("ct").value;
			if(ct == ""){
				ch5=0;checkall()
			}else{
				ch5=1;checkall()
			}
		}
		
		
	</script>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-regis">
				<div class="wrap-title">
					<button id="cancer"class="login100-form-btn" onclick="linktologin()" >
						X
					</button>
					<div class="regis-title">
						ลงทะเบียน
					</div>
				</div>
				<form action="register.php" method="post" class="regis-form">
					<div class="row-space">
						<div class="input-g">
							<label class="label-regis">ชื่อบัญชี (Username)</label>
							<div>
								<input class="input100-regis" type="text" name="username" id="usrname" placeholder="ภาษาอังกฤษและตัวเลข 8 ตัวขึ้นไป" onfocusout="send()"><br>
								<small id="sm"></small>
							</div>
						</div>
						<div class="input-g">
							<label class="label-regis">รหัสผ่าน (Password)</label>
							<div>
							<input class="input100-regis" type="password" id="pass1" name="password1" placeholder="ภาษาอังกฤษและตัวเลข 6 ตัวขึ้นไป" onfocusout="checkpassword()"><br>
							<small id="sd1"></small>
							</div>
						</div>
						<div class="input-g">
							<label class="label-regis">ยืนยันรหัสผ่าน (confirmpassword)</label>
							<div>
							<input class="input100-regis" type="password" id="pass2" name="password2" placeholder="ภาษาอังกฤษและตัวเลข 6 ตัวขึ้นไป" onfocusout="checkpassword()"><br>
							<small id="sd2"></small>
							</div>
						</div>
						<div class="input-g">
							<label class="label-regis">คำนำหน้า</label>
							<select id="fnt" name="title" class="form-select" aria-label="Default select example">
								<option value="นาย" selected>นาย</option>
								<option value="นาง">นาง</option>
								<option value="นางสาว">นางสาว</option>
							  </select>
							<label class="label-regis">ชื่อ</label>
							<input class="input100-regis" type="text" name="name" id="n" placeholder="มานามานะ" onfocusout="checkname()">
						</div>
			
						<div class="input-g">
							<label class="label-regis">ที่อยู่</label>
							<input class="input100-regis" type="text" name="address" id="ad" placeholder="130/44 ถ.เศรษฐศิริ แขวง สามเสนนอก กรุงเทพ 10400" onfocusout="checkaddress()">
						</div>
						<div class="input-g">
							<label class="label-regis">ช่องทางการติดต่อ</label>
							<input class="input100-regis" type="text" name="contact" id="ct" placeholder="LINE: OZ เบอร์โทร:088-744-5614" onfocusout="checkcontact()">
						</div>
					</div>
					<div class="container-login100-form-btn">
						<button id="btnss" name="btn">ยืนยัน</buttton>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>