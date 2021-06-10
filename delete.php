<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

$id_musik = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM tb_musik WHERE id_musik = $id_musik");
$lagu = mysqli_fetch_assoc($query);

unlink('./musik/' . $lagu['file']);

mysqli_query($conn, "DELETE FROM tb_musik WHERE id_musik = $id_musik");
mysqli_query($conn, "DELETE FROM tb_favorit WHERE id_musik = $id_musik");
mysqli_query($conn, "DELETE FROM tb_kategori_musik WHERE id_musik = $id_musik");
mysqli_query($conn, "DELETE FROM tb_last_stream WHERE id_musik = $id_musik");

echo "<script>
alert('Berhasil dihapus!');
window.location.href = 'dashboard.php';
</script>";
