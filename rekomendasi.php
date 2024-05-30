<?php
require '..\hotel\config\functions.php';

session_start();
// cek session
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$username = $_SESSION["username"];
$tabel = $_SESSION["tabel"];

if ($tabel == 'customer') :
    $customer = query("SELECT * FROM 
customer WHERE username = '$username'")[0];
    $idcustomer = $customer['id']; 

endif;

$rekomendasi = mysqli_query($conn, "SELECT MAX(wishlist) FROM kamar");
$result = mysqli_query($conn, "SELECT * FROM 
kamar WHERE id_kamar = '$rekomendasi'");
if (isset($_POST["wishlist"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    // //var_dump(mysqli_affected_rows($conn));
    if (tambahwishlist($_POST) > 0) {
        echo " <script>
                document.location.href = 'kamar.php?id=$rekomendasi'
            </script>
            ";
    } else {
        echo " <script>
            document.location.href = 'kamar.php?id=$rekomendasi'
            </script>
            ";
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Hillhouse Hotel</title>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

        <title>Data Kamar</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="css/index.css">

        <link rel="stylesheet" href="css/owl-carousel.css">

        <link rel="stylesheet" href="css/lightbox.css">
        <link rel="stylesheet" href="halamankamar.css">

    </head>

    </style>
</head>

<body>

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

    <!-- navigasi jumlah halaman -->
    <?php foreach ($result as $row) :
    ?>

    <?php endforeach; ?>
    </div>
    <br>
    <br>
    <br>
    <main class="container2">

        <!-- Left Column / Headphones Image -->
        <div class="left-column">
            <img data-image="black" src="assets\<?= $row["gambar"]; ?>" alt="">

        </div>


        <!-- Right Column -->
        <div class="right-column">

            <!-- Product Description -->
            <div class="product-description">
                <span>Kamar</span>
                <h1><?= $row["nama_kamar"]; ?></h1>
                <p><?= $row["deskripsi"]; ?></p>
                <span>stok : <?= $row["stok_kamar"]; ?> </span>
                <br></br>
                <span>Harga per malam : Rp.<?= $row["harga"]; ?></span>
            </div>

            <!-- Product Configuration -->
            <div class="product-configuration">

                <!-- Product Color -->
                <div class="product-color">
                </div>
                <!-- Cable Configuration -->
                <div class="cable-config">

                    <a href="#">Klik untuk Reservasi!</a>
                </div>
            </div>

            <!-- Product Pricing -->
            <div class="product-price">
                <?php if ($tabel == 'customer') : ?>
                    <?php
                    $result3 = mysqli_query($conn, "SELECT * FROM 
        wishlistcustomer WHERE id_customer=$idcustomer AND id_kamar = '$rekomendasi'");;

                    // if ($row["id_kamar"]!=$idkamar):
                    if (mysqli_fetch_assoc($result3)) : ?>

                        <button class="cart-btn" onclick="window.location.href='hapuswishlist.php?id=<?= $wishlist['id_wishlist']; ?>'">Batal Reservasi</button>

                    <?php else : ?>
                        <form action="" method="post">
                            <input type="hidden" name="id_kamar" value="<?= $row["id_kamar"]; ?>">
                            <input type="hidden" name="id_customer" value="<?= $customer["id"]; ?>">
                            <button class="cart-btn" type="submit" name="wishlist"> Reservasi</button>
                        </form>



                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
        
    </main>


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