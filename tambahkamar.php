<?php
require '..\hotel\config\functions.php';

session_start();
// cek session
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$username = $_SESSION["username"];
$tabel = $_SESSION["tabel"];
if (isset($_POST["tambah"])) {

    if (tambahkamar($_POST) > 0) {
        echo " <script>  
        alert('kamar baru berhasil ditambahkan!');
       document.location.href = 'katalogkamar.php'
       </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}
$admin = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
$admin = mysqli_fetch_assoc($admin);


?>
<!DOCTYPE html>
<html>

<head>
    <title>Halaman Data Kamar</title>
    <link rel="stylesheet" href="design/styleindex.css">

    <style>

    </style>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

        <title>Hillhouse Resort</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

        <!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.css"> -->

        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="css/index.css">

        <link rel="stylesheet" href="css/owl-carousel.css">

        <link rel="stylesheet" href="css/lightbox.css">

    </head>

    </style>
</head>

<body>

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->

                        <a href="halamanutama<?= $tabel; ?>.php" class="logo">
                            <img src="assets/hillhousey.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="katalogkamar.php">Kembali</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <br>
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h2>Tambah kamar</h2>
                        </div>

                    </div>
                </div>

    </section>

    <div style="margin:80px;margin-top:0px; padding-right:30px;">

        <div class="tabelkamar">
            <form action="" method="post" enctype="multipart/form-data">

                <ul>

                    <li>
                        <label for="nama_kamar">Nama kamar : </label>
                        <input type="text" name="nama_kamar" id="nama_kamar" required>

                    </li>
                    <li>
                        <label for="gambarkamar">Gambar Sampul : </label>
                        <input type="file" name="gambarkamar" id="gambarkamar">
                    </li>
                    <li>
                        <label for="deskripsi">Deskripsi : </label>
                        <input type="text" name="deskripsi" id="deskripsi" required>

                    </li>

                    <li>
                        <label for="stok_kamar">jumlah stok : </label>
                        <input type="text" name="stok_kamar" id="stok_kamar" required>
                    </li>
                    <li>
                        <label for="harga">harga : </label>
                        <input type="text" name="harga" id="harga" required>
                    </li>
                    <input type="hidden" name="username" value="<?= $admin["username"]; ?>">



                    <button type="submit" name="tambah">Tambah kamar</button>



                </ul>

            </form>
        </div>



</body>

</html>