<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

$query = mysqli_query($conn, "SELECT * FROM tb_musik ORDER BY date_upload ASC");


$title = "Home | Stream Music";
require 'layout/header.php';
?>

<h1>Listen Free Music</h1>
<hr>
<div class="row">
    <div class="col-3">
        <a href="last_listen.php" style="text-decoration: none;">
            <div class="card border border-danger bg-dark text-danger d-flex justify-content-center align-items-center" style="height: 50px">
                <div class="content text-center">
                    <i class="bi bi-clock"></i>
                    <small>Terakhir di dengar</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <a href="library.php" style="text-decoration: none;">
            <div class="card border border-danger bg-dark text-danger d-flex justify-content-center align-items-center" style="height: 50px">
                <div class="content text-center">
                    <i class="bi bi-music-note-list"></i>
                    <small>Library</small>
                </div>
            </div>
        </a>
    </div>
</div>

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