<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

$id_musik = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM tb_musik WHERE id_musik = $id_musik");
$lagu = mysqli_fetch_assoc($query);

$query_musik = mysqli_query($conn, "SELECT * FROM tb_musik WHERE id_musik <> $id_musik");

$id_user = $_SESSION['id_user'];
$time = time();

// tambah ke last listen
mysqli_query($conn, "INSERT INTO tb_last_stream (id_musik, id_user, last_stream_date) VALUES ($id_musik, $id_user, $time)");
// tambah jumlah stream
mysqli_query($conn, "UPDATE tb_musik SET stream = stream + 1 WHERE id_musik = $id_musik");

$title = "Play | Stream Music";
require 'layout/header.php';
?>
<h1><?= $lagu['judul'] ?></h1>
<small><?= $lagu['artist'] ?> | <?= $lagu['stream'] ?> stream</small>
<hr>
<div class="container-audio">
    <audio controls loop autoplay>
        <source src="./musik/<?= $lagu['file'] ?>" type="audio/mpeg">
        Your browser dose not Support the audio Tag
    </audio>
</div>

<style>
    /* Start  styling the page */
    .container-audio {
        width: 100%;
        height: auto;
        padding: 20px;
        border-radius: 5px;
        background-color: #eee;
        color: #444;
        margin: 20px auto;
        overflow: hidden;
    }

    audio {
        width: 100%;
    }

    audio:nth-child(2),
    audio:nth-child(4),
    audio:nth-child(6) {
        margin: 0;
    }
</style>
<hr>
<table class="table table-hover table-dark">
    <tbody>
        <?php
        while ($result = mysqli_fetch_assoc($query_musik)) : ?>
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