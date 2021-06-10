<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}
$id_user = $_SESSION['id_user'];
$query_kat = mysqli_query($conn, "SELECT * FROM tb_kategori");

if (isset($_GET['q'])) {
    $kategori = $_GET['q'];
    if ($_GET['q'] == 'favorite') {
        $query = mysqli_query($conn, "SELECT tb_favorit.*, tb_musik.* FROM tb_favorit JOIN tb_musik ON tb_favorit.id_musik = tb_musik.id_musik WHERE id_user = $id_user");
        $nama_kategori = 'Favorite';
    } else {
        $query = mysqli_query($conn, "SELECT tb_kategori.kategori, tb_kategori_musik.*, tb_musik.* FROM tb_kategori_musik JOIN tb_musik ON tb_kategori_musik.id_musik = tb_musik.id_musik JOIN tb_kategori ON tb_kategori_musik.id_kategori = tb_kategori.id_kategori WHERE tb_kategori_musik.id_kategori = $kategori");
        $nama_kategori = $_GET['kat'];
    }
}


$title = "Library | Stream Music";
require 'layout/header.php';
?>

<h1>Library</h1>
<?php if (!isset($_GET['q'])) : ?>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <a href="library.php?q=favorite" style="text-decoration: none;">
                <div class="card border border-danger bg-dark text-danger d-flex justify-content-center align-items-center mb-3" style="height: 50px">
                    <div class="content text-center">
                        <i class="bi bi-heart-fill me-2"></i>
                        <small>Favorite</small>
                    </div>
                </div>
            </a>
        </div>
        <?php while ($result = mysqli_fetch_assoc($query_kat)) : ?>
            <div class="col-md-3">
                <a href="library.php?q=<?= $result['id_kategori'] ?>&kat=<?= $result['kategori'] ?>" style="text-decoration: none;">
                    <div class="card border border-danger bg-dark text-danger d-flex justify-content-center align-items-center mb-3" style="height: 50px">
                        <div class="content text-center">
                            <i class="bi bi-collection-play-fill me-2"></i>
                            <small><?= $result['kategori'] ?></small>
                        </div>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <small><?= $nama_kategori ?></small>
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
                    <th>
                        <a href="play.php?id=<?= $result['id_musik'] ?>" class="play"><i class="bi bi-play-circle-fill me-2"></i> PLAY</a>
                        <?php if ($nama_kategori == "Favorite") : ?>
                            <a href="removeFavorite.php?id=<?= $result['id_musik'] ?>" class="ms-3 play"><i class="bi bi-heart me-2"></i> REMOVE FAVORITE</a>
                        <?php endif; ?>
                    </th>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>

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