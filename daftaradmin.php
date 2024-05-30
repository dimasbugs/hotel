<?php
session_start();	
// cek session
if (!isset($_SESSION["login"])){
    header("Location: login.php");
}
$username=$_SESSION["username"];
$tabel='admin';


// koneksi ke database
// seolah olah file function ada di sini
require'..\hotel\config\functions.php';



$adm = query("SELECT * FROM admin ORDER BY id DESC ");//ASC urut id membesar, DESC mengecil,

//limit membuat batasan data  yang ditampilkan index ke berapa,berapa data
//  ambil data dari database tabel admin / query

// tombol cari di klik
if(isset( $_POST["cari"])){
    $adm = cari($_POST["keyword"]);
    
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Akun</title>
    <link rel="stylesheet" href="css/styleindex.css">
    <link rel="stylesheet" href="css/tabel.css">

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
                        
                        <a href="halamanutama<?= $tabel;?>.php"class="logo">
                            <img src="assets/hillhousey.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="halamanutamaadmin.php">Kembali</a></li> 
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
                            <h6>About Us</h6>
                            <h2>Data Admin</h2>
                            <div style="margin-top:30px;margin-bottom:30px;">
                            <button type="submit" name="Tambah"><a  href="tambahadmin.php" style="font-style: unset;color:white;">Tambah</a></button></div>

                            <div style="
                            display: flex;
                            justify-content: left;">
                                <form action="" method="post">

                                <input type="text" name="keyword" id="keyword" size="40px" autofocus 
                                placeholder="Masukkan keyword pencarian" autocomplete="off">
                                <button type="submit" name="cari">Cari</button></form></div>

                        </div>
                       
            </div>
        </div>
        

</section>






<div style="margin:30px;margin-top:0px;overflow-x:auto;">
<div >
<table border="1" cellpadding="10" cellspacing="0"style="margin-top:50px;">

<tr>
<!-- kop tabel-->
<th>No.</th>
<th>Nama</th>
<th>Email</th>
<th>NomorHp</th>
<th>JenisKelamin</th>
<th>Alamat</th>
<th>Kode Kabupaten</th>
</tr>
<?php $i=1?><!--  nomor urut -->
<?php foreach($adm as $row) :?>
<tr>
<td><?= $i?></td>

<td><?= $row["nama"];	?></td>
<td><?= $row["email"];	?></td>
<td><?= $row["nomorhp"];	?></td>
<td><?= $row["jeniskelamin"];	?></td>
<td><?= $row["alamat"];	?></td>
<td><?= $row["kabupaten"];	?></td>
</tr>
<?php $i++?>
<?php	endforeach; ?>
</table></div>
 </div>

<!-- navigasi jumlah halaman -->


</body>
</html>





