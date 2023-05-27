<?php 
session_start();
if($_SESSION['roll']!=1){
    header("location:login.php");
}
include 'databaes/db_connect.php';
$select=$conn->prepare("SELECT * FROM users");
$select->execute();
$users=$select->fetchAll(PDO::FETCH_ASSOC);
$row=1;

?>


<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>admin_panel</title>
</head>
<body>
    <header>
        <p> خوش امدید <?= $_SESSION['user_name']; ?></p>
        <a href="login.php">صفحه ورود</a>
        <a href="logout.php">خروج</a>
    </header>

    <div class="container">
        <div class="my-table">
            <table>
            <h3>لیست کاربران</h3>
            
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام و نام خانوادگی</th>
                        <th>کد ملی</th>
                        <th>شماره موبایل</th>
                        <th>رمز عبور</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $users_info) : ?>
                    <tr>
                        <td><?=$row++?></td>
                        <td><?= $users_info['user_name'] ?></td>
                        <td><?= $users_info['national_code'] ?></td>
                        <td><?= $users_info['phone'] ?></td>
                        <td><?= $users_info['password'] ?></td>
                        <td><a href="user_deleat.php?id=<?= $users_info['id']; ?>" class="delet">حذف</a> <a href="user_edit.php?id=<?=$users_info['id'];?>" class="edit">ویرایش</a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>