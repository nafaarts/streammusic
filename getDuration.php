<?php
session_start();
require 'connection.php';

$id_musik = $_GET['id'];

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

if (isset($_GET['detik'])) {
    $detik = $_GET['detik'];
    mysqli_query($conn, "UPDATE tb_musik SET durasi = '$detik' WHERE id_musik = $id_musik");
    header("location: dashboard.php?info=added");
    die;
} else {
    $query = mysqli_query($conn, "SELECT * FROM tb_musik WHERE id_musik = $id_musik");
    $result = mysqli_fetch_assoc($query);
}

?>

<html>

<body>
    <p>Please Wait for 3 Sec...</p>
    <hr>
    <audio id="myAudio" controls>
        <source src="./musik/<?= $result['file'] ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <script>
        function myFunction() {
            var x = document.getElementById("myAudio").duration;
            fancyTimeFormat(x);
        }

        function fancyTimeFormat(duration) {
            // Hours, minutes and seconds
            var hrs = ~~(duration / 3600);
            var mins = ~~((duration % 3600) / 60);
            var secs = ~~duration % 60;

            // Output like "1:01" or "4:03:59" or "123:03:59"
            var ret = "";

            if (hrs > 0) {
                ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
            }

            ret += "" + mins + ":" + (secs < 10 ? "0" : "");
            ret += "" + secs;
            window.location.href = "getDuration.php?id=<?= $id_musik ?>&detik=" + ret;
        }

        setInterval(() => {
            myFunction();
        }, 2000);
    </script>
</body>

</html>