<?php	
require'..\hotel\config\functions.php';

session_start();	
// cek session
if (!isset($_SESSION["login"])){
    header("Location: login.php");
}
$username=$_SESSION["username"];
$tabel=$_SESSION["tabel"];


$id = $_GET["id"];

    if ( hapuskamar($id)>0){
        echo" <script>  
        alert('');
        document.location.href = 'katalogkamar.php'
        </script>
         ";

        }else{
        echo" <script>
        alert('');
        document.location.href = 'katalogkamar.php'
        </script>
        ";
}
