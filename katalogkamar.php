<?php
require '..\hotel\config\functions.php';
session_start();
// cek session
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$username = $_SESSION["username"];
$tabel = $_SESSION["tabel"];

if ($tabel === '') :
    $kamar = query("SELECT * FROM kamar WHERE username='$username'");
endif;
if ($tabel === 'admin') :
    $kamar = query("SELECT * FROM kamar");
endif;


if ($tabel === 'customer') :
    $customer = query("SELECT * FROM customer WHERE username='$username'");
    $id_customer = $customer[0]['id'];
    $kamar = query("SELECT * FROM kamar ORDER BY id_kamar");
    $wishlist = query("SELECT * FROM wishlistcustomer  WHERE id_customer='$id_customer'ORDER BY id_wishlist");
endif;



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="tab.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="halamankamar.css">
    <link rel="stylesheet" href="css/owl-carousel.css">

    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" href="style.css">
    <title>Katalog kamar</title>
</head>

<header class="header-area header-sticky" style="position:sticky;">
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
                        <li class="scroll-to-section"><a href="halamanutama<?= $tabel; ?>.php">Kembali</a></li>
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

<body>
<section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading" style="margin-bottom: 40px;">
                            <?php if ($tabel === 'admin') : ?>
                                <button class="btn btn-primary btn-sm" style="margin-bottom:10px;width:content-fit;background-color:#E3B04B;border-color:#E3B04B;">
                                    <h5 style="color:black;"><a style="font-style: unset;color:white;" href="tambahkamar.php">Tambahkan Kamar</a></h5>
                                </button>
                                <div style="margin-top:30px;">

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if ($tabel === 'admin') : ?>
        <div>

            <?php $i = 1 ?><!--  nomor urut -->
            <?php foreach ($kamar as $row) : ?>

                <?php $i++ ?>
                <div class="container mt-5 mb-5">
                    <div class="d-flex justify-content-center row">
                        <div class="col-md-10">
                            <div class="row p-2 bg-white border rounded">
                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="assets\<?= $row["gambar"]; ?>" alt="" style="object-fit:cover;"></div>
                                <div class="col-md-6 mt-1">
                                    <h5><?= $row["nama_kamar"]; ?></h5>
                                    <div class="d-flex flex-row">
                                        <div class="ratings mr-2"><i class="fa fa-archive"> Stok :</i></div><span><?= $row["stok_kamar"]; ?></span>
                                    </div>
                                    <div class="mt-1 mb-1 spec-1"><span><?= $row["deskripsi"];    ?></span></div>
                                    <div class="mt-1 mb-1 spec-1"><span>Jumlah Reservasi : <?= $row["wishlist"];    ?></span></div>
                                </div>
                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                    <div class="d-flex flex-row align-items-center">
                                        <h4 class="mr-1"></h4>
                                    </div>
                                    <h6 class="text-success">Silahkan dilihat</h6>
                                    <div class="d-flex flex-column mt-4">

                                        <?php if ($tabel === 'admin') : ?>
                                            <button class="btn btn-primary btn-sm" type="button" style="margin-bottom:10px;" onclick="location.href='ubahkamar.php?id=<?= $row["id_kamar"];
                                                                                                                                                                        ?>'"><a href="ubahkamar.php?id=<?= $row["id_kamar"];
                                                                                                                                                                                                        ?>" style="color:white;">ubah</a></button>
                                            <button class="btn btn-primary btn-sm" type="button" style="margin-bottom:10px;" onclick="return confirm('yakin akan menghapus?'),location.href='hapuskamar.php?id=<?= $row["id_kamar"];
                                                                                                                                                                                                                ?>'"> <a href="hapuskamar.php?id=<?= $row["id_kamar"];
                                                                                                                                                                                                                                                    ?>" style="color:white;">hapus</a></button>
                                        <?php endif; ?>
                                        <button class="btn btn-primary btn-sm" type="button" onclick="location.href='kamar.php?id=<?= $row["id_kamar"];
                                                                                                                                    ?>'"> <a href="kamar.php?id=<?= $row["id_kamar"];
                                                                                                                                                                    ?>" style="color:white;">lihat</a> </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else : ?>

        <section class="kamarcustomer" style="width:auto; display:flex; justify-content:center;">

            <!-- product -->
            <div class="tabs">
                <input type="radio" class="tabs__radio" name="tabs-example" id="tab1" checked>
                <label for="tab1" class="tabs__label">Katalog Kamar</label>
                <div class="tabs__content">
                    <section class="product">
                        <button class="pre-btn"><img src="assets/arrow.png" alt=""></button>
                        <button class="nxt-btn"><img src="assets/arrow.png" alt=""></button>
                        <div class="product-container">
                            <?php $b = 1 ?>
                            <?php foreach ($kamar as $row) : ?>

                                <?php foreach ($customer as $row2) : ?>
                                    <div class="product-card">
                                        <div class="product-image">
                                            <span class="discount-tag">Kamar <?php echo $b; ?></span>
                                            <img src="assets/<?= $row["gambar"]; ?>" class="product-thumb" alt="">
                                            <button class="card-btn" onclick="window.location.href='kamar.php?id=<?= $row['id_kamar']; ?>'">lihat</button>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-brand"><?= $row["nama_kamar"];    ?></h3>
                                            <span class="price">IDR <?= $row["harga"];    ?> </span>
                                        </div>
                                    </div>
                                    <?php $b++ ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </section>

                </div>
                <input type="radio" class="tabs__radio" name="tabs-example" id="tab2">
                <label for="tab2" class="tabs__label">Reservasi</label>
                <div class="tabs__content">
                    <section class="product">

                        <div class="container mt-5 mb-5">
                            <div class="d-flex justify-content-center row">
                                <div class="col-md-10">
                                    <?php $b = 1 ?>
                                    <?php foreach ($wishlist as $row3) : ?>

                                        <?php foreach ($customer as $row4) : ?>
                                            <?php
                                            $idkamar = $row3['id_kamar'];
                                            $kamarwishlist = query("SELECT * FROM kamar WHERE id_kamar='$idkamar'")[0];
                                            ?>
                                            <div class="row p-2 bg-white border rounded">
                                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="assets/<?= $kamarwishlist["gambar"]; ?>" style="object-fit:cover;"></div>
                                                <div class="col-md-6 mt-1">
                                                    <h5><?= $kamarwishlist["nama_kamar"];    ?></h5>

                                                    <div class="mt-1 mb-1 spec-1"><span><?= $kamarwishlist["deskripsi"]; ?></span></div>
                                                    <div class="mt-1 mb-1 spec-1"></div>

                                                </div>
                                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <h4 class="mr-1"></h4>
                                                    </div>
                                                    <h6 class="text-success">Silahkan dilihat</h6>
                                                    <div class="d-flex flex-column mt-4">
                                                        <button class="btn btn-primary btn-sm" type="button" onclick="location.href='kamar.php?id=<?= $row3["id_kamar"];
                                                                                                                                                    ?>'"> <a href="kamar.php?id=<?= $row3["id_kamar"];
                                                                                                                                                                                    ?>" style="color:white;">lihat</a> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                </div>


        </section>



    <?php endif; ?>

    </div>


    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
            <div class="col-lg-4 col-xs-12">
                    <div class="right-text-content">
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="logo">
                        <a href="index.html"><img src="assets/hillhouse.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="left-text-content">
                        <p>© Kelompok 3
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>