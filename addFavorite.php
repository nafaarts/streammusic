<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

$id_musik = $_GET['id'];
$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn, "SELECT * FROM tb_favorit WHERE id_user = $id_user AND id_musik = $id_musik");
$result = mysqli_fetch_assoc($query);
if (!$result) {
    mysqli_query($conn, "INSERT INTO tb_favorit (id_musik, id_user) VALUES ($id_musik, $id_user)");
    header('location: library.php?q=favorite');
} else {
    echo "<script>alert('Sudah ada di Favorite'); window.location.href = 'library.php?q=favorite'</script>";
}
