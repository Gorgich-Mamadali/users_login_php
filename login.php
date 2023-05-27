<?php 
session_start();
include 'databaes/db_connect.php';

if(isset($_POST['signup-btn'])){
	$user_name=$_POST['user_name'];
	$national_code=$_POST['national_code'];
	$phone=$_POST['phone'];
	
	$pass=password_hash($_POST['pass'] , PASSWORD_DEFAULT);

	$insert=$conn->prepare("INSERT INTO users SET user_name=?, national_code=?, phone=?, password=?");
	$insert->bindValue(1,$user_name);
	$insert->bindValue(2,$national_code);
	$insert->bindValue(3,$phone);
	$insert->bindValue(4,$pass);
	$insert->execute();
	$alert="ثبت نام موفقیت امیز بود، لطفا وارد شوید";
}else{
	$alert="مشکلی پیش امد، دوباره امتحان کنید";
}

if(isset($_POST['login-btn'])){
	$national_code=$_POST['national_code'];
	$pass=$_POST['pass'];

	$select=$conn->prepare("SELECT * FROM users WHERE national_code=? AND password=?");
	$select->bindValue(1,$national_code);
	$select->bindValue(2,$pass);
	$select->execute();
	$user=$select->fetchAll(PDO::FETCH_ASSOC);

	foreach($user as $user_login){
		if($select->rowCount()>=1){
			$_SESSION['login']=true;
			$_SESSION['national_code']=$user_login['national_code'];
			$_SESSION['pass']=$user_login['password'];
			$_SESSION['id']=$user_login['id'];
			$_SESSION['user_name']=$user_login['user_name'];
			$_SESSION['roll']=$user_login['roll'];
			header("location:index.php");
		}
	}
}


?>

<!DOCTYPE html>
<html dir="rtl">
<head>
	<title>ورود یا ثبت نام</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="shortcut icon" href="image/hotel-logo.webp" type="image/x-icon">
</head>
<body class="bg-body">
	<div class="main">  
		<input type="checkbox" id="chk" aria-hidden="true">
        <h2>به هتل توس خوش امدید</h2>
			<div class="signup">
				<form method="post">
					<label for="chk" aria-hidden="true">ثبت نام</label>
					<input type="text" name="user_name" placeholder="نام و نام خانوادگی" required="">
					<input type="number" name="national_code" placeholder="کد ملی" required="">
                    <input type="number" name="phone" placeholder="شماره موبایل" required="">
					<input type="pass" name="pass" placeholder="رمز عبور" required="">
					<input class="btn" type="submit" name="signup-btn" id="signup-btn" value="ثبت نام">
				</form>
			</div>

			<div class="login">
				<form method="post">
					<label for="chk" aria-hidden="true">ورود</label>
					<input type="number" name="national_code" placeholder="کد ملی" required="">
					<input type="password" name="pass" placeholder="رمز عبور" required="">
					<div class="frget"><a href="">فراموشی رمز عبور</a></div>
					<input class="btn" type="submit" name="login-btn" id="login-btn" value="ورود">
				</form>
			</div>
	</div>
</body>
</html>