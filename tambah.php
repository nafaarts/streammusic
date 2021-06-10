<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

$title = "Tambah | Stream Music";

$query = mysqli_query($conn, "SELECT * FROM tb_kategori");

if (isset($_POST['submit'])) {
    $ekstensi_diperbolehkan = array('mp3');
    $nama = $_FILES['musik_file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['musik_file']['size'];
    $file_tmp = $_FILES['musik_file']['tmp_name'];

    $judul = $_POST['judul'];
    $artis = $_POST['artis'];
    $kategori = $_POST['kategori'];
    $time = time();
    $nama_file = $time . "($artis)." . $ekstensi;

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 106639418) {
            move_uploaded_file($file_tmp, 'musik/' . $nama_file);
            $query = mysqli_query($conn, "INSERT INTO tb_musik (file, judul, artist, durasi, stream, date_upload) VALUES('$nama_file', '$judul', '$artis', '0', 0, $time)");
            if ($query) {
                $last_id = mysqli_insert_id($conn);
                foreach ($kategori as $id) {
                    mysqli_query($conn, "INSERT INTO tb_kategori_musik (id_musik, id_kategori) VALUES($last_id, $id)");
                }
                header("location: getDuration.php?id=$last_id");
            } else {
                echo 'GAGAL MENGUPLOAD GAMBAR';
            }
        } else {
            echo 'UKURAN FILE TERLALU BESAR';
        }
    } else {
        echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
    }
}

require 'layout/header.php';
?>

<h1>Tambah</h1>
<hr>
<a href="dashboard.php" class="btn btn-danger mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" placeholder="Masukan Judul Lagu" name="judul" required>
    </div>
    <div class="mb-3">
        <label for="artis" class="form-label">Artis</label>
        <input type="text" class="form-control" id="artis" placeholder="Masukan Artis Lagu" name="artis" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Genre</label>
        <select class="form-select" multiple aria-label="multiple select example" name="kategori[]" required>
            <?php while ($result = mysqli_fetch_assoc($query)) : ?>
                <option value="<?= $result['id_kategori'] ?>"><?= $result['kategori'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">File Musik</label>
        <div class="input-group">
            <input type="file" class="form-control" id="uploadMusik" aria-label="Upload" name="musik_file" required>
            <button class="btn btn-danger" type="submit" name="submit" id="inputGroupFileAddon04">Submit</button>
        </div>
    </div>
</form>


<?php require 'layout/footer.php'; ?>