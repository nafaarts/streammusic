<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

$id_musik = $_GET['id'];
$id_user = $_SESSION['id_user'];

mysqli_query($conn, "DELETE FROM tb_favorit WHERE id_musik = $id_musik AND id_user = $id_user");
echo "<script>
alert('Berhasil dihapus dari Favorit!');
window.location.href = 'library.php?q=favorite';
</script>";
