<?php
    include 'databaes/db_connect.php';
    $edit=$_GET['id'];
    $select=$conn->prepare("SELECT * FROM users WHERE id=?");
    $select->bindValue(1,$edit);
    $select->execute();
    $users=$select->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['edit-btn'])){
        $user_name=$_POST['user_name'];
        $national_code=$_POST['national_code'];
        $phone=$_POST['phone'];
        $pass=$_POST['pass'];

        $update=$conn->prepare("UPDATE users SET user_name=? , national_code=?, phone=?, password=? WHERE id=$edit");
        $update->bindValue(1,$user_name);
        $update->bindValue(2,$national_code);
        $update->bindValue(3,$phone);
        $update->bindValue(4,$pass);
        $update->execute();
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html dir="rtl">
<head>
	<title>ویرایش اطلاعات کاربر</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="shortcut icon" href="image/hotel-logo.webp" type="image/x-icon">
</head>
<body class="bg-body">
	<div class="main">  
		<input type="checkbox" id="chk" aria-hidden="true">
        <h2>ویرایش اطلاعات کاربر</h2>
			<div class="signup">
				<form method="post">
                    <?php foreach($users as $user) : ?>
                        <label class="lbl" for="user_name">نام و نام خانوادگی</label>
                        <input type="text" name="user_name" value="<?=$user['user_name'];?>" required="">
                        <label class="lbl" for="user_name">کد ملی</label>
                        <input type="number" name="national_code" value="<?= $user['national_code']; ?>" required="">
                        <label class="lbl" for="user_name">شماره تلفن</label>
                        <input type="number" name="phone" value="<?=$user['phone'];?>" required="">
                        <label class="lbl" for="user_name">رمز عبور</label>
                        <input type="pass" name="pass" value="<?=$user['password'];?>" required="">
                        <input class="btn" type="submit" name="edit-btn" id="edit-btn" value="ثبت اطلاعات جدید">
                    <?php endforeach;?>
				</form>
			</div>
	</div>
</body>
</html>