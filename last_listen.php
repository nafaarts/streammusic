<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn, "SELECT DISTINCT tb_last_stream.id_musik, MAX(tb_last_stream.last_stream_date), tb_musik.* FROM tb_last_stream JOIN tb_musik ON tb_last_stream.id_musik = tb_musik.id_musik GROUP BY tb_last_stream.id_musik ORDER BY MAX(tb_last_stream.last_stream_date) DESC, tb_last_stream.id_musik");

$title = "Home | Stream Music";
require 'layout/header.php';
?>

<h1>Terakhir Di Dengar</h1>
<hr>

<table class="table table-hover table-dark">
    <tbody>
        <?php
        while ($result = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $result['judul'] ?></td>
                <td><?= $result['artist'] ?></td>
                <td><?= $result['durasi'] ?></td>
                <td><?= $result['stream'] ?> Stream</td>
                <th><a href="play.php?id=<?= $result['id_musik'] ?>" class="play"><i class="bi bi-play-circle-fill me-2"></i> PLAY</a></th>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<style>
    .play {
        text-decoration: none;
        color: grey;
    }

    .play:hover {
        color: red;
    }
</style>

<?php require 'layout/footer.php'; ?>