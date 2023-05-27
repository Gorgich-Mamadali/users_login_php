<?php 
    include 'databaes/db_connect.php';
    $del=$_GET['id'];
    $select=$conn->prepare("DELETE FROM users WHERE id=?");
    $select->bindValue(1,$del);
    $select->execute();
    header("location:index.php");

?>