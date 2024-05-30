<?php
require '..\hotel\config\functions.php';

session_start();
// cek session
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$username = $_SESSION["username"];
$tabel = $_SESSION["tabel"];
// koneksi ke dbms


// ambil data di url
$id = $_GET["id"];
// querry data modul berdasar id
$kamar = query("SELECT * FROM kamar WHERE id_kamar = $id")[0];
// //var_dump($adm["nomorhp"]);


// cek apakah submit telah ditekan
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    // //var_dump(mysqli_affected_rows($conn));
    if (ubahkamar($_POST) > 0) {
        echo " <script>
            alert('kamar berhasil diubah!');
            document.location.href = 'kamar.php?id=$id'
        </script>
        ";
    } else {
        echo " <script>
        alert('kamar gagal diubah!');
        document.location.href = 'kamar.php?id=$id'
        </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Hillhouse Resort</title>
    <link rel="stylesheet" href="css/styleindex.css">

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

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

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

                        <a href="index<?= $tabel; ?>.php" class="logo">
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
    <div class="tabelmodul" style="margin:160px;">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_kamar" value="<?= $kamar["id_kamar"]; ?>">
            <input type="hidden" name="gambarlama" value="<?= $kamar["gambar"]; ?>">
            <ul>
                <li>
                    <label for="nama_kamar">Nama kamar : </label>
                    <input type="text" name="nama_kamar" id="nama_kamar" required value="<?= $kamar["nama_kamar"]; ?>">

                </li>
                <li>
                    <label for="deskripsi">Deskripsi : </label>
                    <input type="text" name="deskripsi" id="deskripsi" required value="<?= $kamar["deskripsi"]; ?>">

                </li>
                <li>
                    <label for="gambarkamar">Gambar Sampul : </label><br>
                    <img src="assets/<?= $kamar["gambar"]; ?>" alt="" width="90"><br>
                    <input type="file" name="gambarkamar" id="gambarkamar">
                </li>
                <li>
                    <label for="stok_kamar">stok kamar: </label>
                    <input type="text" name="stok_kamar" id="stok_kamar" required value="<?= $kamar["stok_kamar"]; ?>">
                </li>


                <button type="submit" name="ubah">Ubah Kamar</button>



            </ul>

        </form>
    </div>




</body>

</html>