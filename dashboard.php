<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

$title = "Dashboard | Stream Music";

$query = mysqli_query($conn, "SELECT * FROM tb_musik ORDER BY date_upload ASC");

require 'layout/header.php';
?>

<h1>Dashboard</h1>
<hr>
<a href="tambah.php" class="btn btn-danger mb-3"><i class="bi bi-plus-lg"></i> Tambah Lagu</a>
<?php if (isset($_GET['info']) && ($_GET['info'] == 'added')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selamat!</strong> Musik berhasil di Upload!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<table class="table table-hover table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Artis</th>
            <th scope="col">Durasi</th>
            <th scope="col">Stream</th>
            <th scope="col">Date Upload</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        while ($result = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $result['judul'] ?></td>
                <td><?= $result['artist'] ?></td>
                <td><?= $result['durasi'] ?></td>
                <td><?= $result['stream'] ?> Stream</td>
                <td><?= date('F j, Y - g:i a', $result['date_upload']) ?></td>
                <td>
                    <a href="play.php?id=<?= $result['id_musik'] ?>" class="play"><i class="bi bi-play-circle-fill me-2"></i> PLAY</a>
                    <a href="delete.php?id=<?= $result['id_musik'] ?>" class="ms-3 play"><i class="bi bi-trash me-2"></i> DELETE</a>
                </td>
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