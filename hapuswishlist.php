<?php
require '..\hotel\config\functions.php';

session_start();
// cek session
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$username = $_SESSION["username"];
$tabel = $_SESSION["tabel"];
$customer = query("SELECT * FROM 
customer WHERE username = '$username'")[0];
$idcustomer = $customer['id'];;

$id = $_GET["id"];
$wishlist = query("SELECT * FROM 
    wishlistcustomer WHERE id_wishlist = '$id'")[0];
$id_kamar = $wishlist['id_kamar'];
if (hapuswishlist($id) > 0) {
    echo " <script>  
         alert('berhasil dihapus dari Reservasi!');
        document.location.href = 'katalogkamar.php'
        </script>
         ";
} else {
    echo " <script>
        alert('gagal dihapus dari Reservasi!');
        document.location.href = 'katalogkamar.php'
        </script>
        ";
}
