<?php	
// koneksi database
$conn = mysqli_connect("localhost","root","","hotel");


function query($querry){
    global $conn;
    $result = mysqli_query($conn,$querry);
    $rows=[];
    while ( $row = mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}
// function tambah($data){
//     // vmbil data dari tiap elemen form
//     global $conn;
//     // html special char agar kode html yang diinputkan tidak berjalan
//     // ndak wajib se, cuman buat keamanan
//     $nama = htmlspecialchars($data["nama"]);
//     $username = htmlspecialchars($data["username"]);
//     $perusahaan = htmlspecialchars($data["perusahaan"]);
//     $email = htmlspecialchars($data["email"]);
//     $tanggallahir = htmlspecialchars($data["tanggallahir"]);
//     $nomorhp = htmlspecialchars($data["nomorhp"]);
//     $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
//     $alamat = htmlspecialchars($data["alamat"]);
//     $password = htmlspecialchars($data["password"]);
//     $kabupaten = htmlspecialchars($data["kabupaten"]);
    
    
//     $password = password_hash($password,PASSWORD_DEFAULT);
//     $querry = "INSERT INTO 
//     Values
//     ('','$nama','$username','$perusahaan','$email','$tanggallahir','$nomorhp',
//     '$jeniskelamin','$alamat','$password','$kabupaten')
//     ";
//     mysqli_query($conn,$querry);



//     // tambah user baru ke database
// }
function hapus($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM admin WHERE id = $id ");
    return mysqli_affected_rows($conn); 
    
    // $username = strtolower(stripslashes($data["username"]));
    // $result = mysqli_query($conn,"SELECT username FROM 
    // admin WHERE username = '$username'");
    // if (mysqli_fetch_assoc($result)){
    //     echo"<script>
    //     alert('username sudah terdaftar');
    //     </script>";
    //     return false;
    // }
    // $result = mysqli_query($conn,"SELECT username FROM 
    //  WHERE username = '$username'");
    // if (mysqli_fetch_assoc($result)){
    //     echo"<script>
    //     alert('username sudah terdaftar');
    //     </script>";
    //     return false;
    // }
    // $result = mysqli_query($conn,"SELECT username FROM 
    // customer WHERE username = '$username'");
    // if (mysqli_fetch_assoc($result)){
    //     echo"<script>
    //     alert('username sudah terdaftar');
    //     </script>";
    //     return false;
    // }


}

function hapuscustomer($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM customer WHERE id = $id ");
    return mysqli_affected_rows($conn);

}

function uploadgambarkamar()
{

    $namafile = $_FILES['gambarkamar']['name'];
    $ukuranfile = $_FILES['gambarkamar']['size'];
    $error = $_FILES['gambarkamar']['error'];
    $tmpName = $_FILES['gambarkamar']['tmp_name'];

    if ($error === 4) {
        echo "<script/>
        alert ('pilih gambar terlebih dahulu');
        </script/>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $typegambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $typegambarvalid)) {
        echo "<script/>
        alert ('yang anda upload bukan gambar');
        </script/>";
        return false;
    }
    // cek ukuran 
    if ($ukuranfile > 100000000) {
        echo "<script/>
        alert ('ukuran gambar terlalu besar');
        </script/>";
        return false;
    }
    // lolos pengecaekan gambar , siap diupload
    //generate nama baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;
    //var_dump($namafilebaru);
    move_uploaded_file($tmpName, 'assets/' . $namafilebaru);

    return $namafilebaru;
}
function hapuskamar($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM kamar WHERE id_kamar = $id ");
    mysqli_query($conn,"DELETE FROM wishlistcustomer WHERE id_kamar = $id ");
    return mysqli_affected_rows($conn);

}

function ubahkamar($data)
{
    // vambil data dari tiap elemen form
    global $conn;
    // html special char agar kode html yang diinputkan tidak berjalan
    // ndak wajib se, cuman buat keamanan
    //var_dump($data);
    $id = $data["id_kamar"];
    $namakamar = htmlspecialchars($data["nama_kamar"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $stokkamar = htmlspecialchars($data["stok_kamar"]);
    // upload gambar/modul  
    $gambarkamarlama = htmlspecialchars($data["gambarlama"]);

    // cek user memilih gambar baru apa nda
    
    if ($_FILES['gambarkamar']['error'] === 4) {
        $gambarkamar = $gambarkamarlama;
    } else {
        $gambarkamar = uploadgambarkamar();
    }
    

    $querry = "UPDATE kamar SET 
                    nama_kamar = '$namakamar',
                    deskripsi ='$deskripsi',
                    stok_kamar = '$stokkamar',
                    gambar = '$gambarkamar'
                    WHERE id_kamar = $id";
    //tambah user baru ke database

    mysqli_query($conn, $querry);
    return mysqli_affected_rows($conn);
}
function hapuswishlist($id){
    global $conn;
    $wishlist = query("SELECT * FROM 
    wishlistcustomer WHERE id_wishlist = '$id'")[0];
    $id_kamar=$wishlist['id_kamar'];
    $jumlahwishlistsekarang=query("SELECT wishlist FROM 
    kamar WHERE id_kamar = '$id_kamar'")[0];
    $wishlist >0;
    $hasil=$jumlahwishlistsekarang["wishlist"]-1;
    
    $querry = "UPDATE kamar SET 
    wishlist = '$hasil'
    WHERE id_kamar = $id_kamar";
    mysqli_query($conn,$querry);
    mysqli_query($conn,"DELETE FROM wishlistcustomer WHERE id_wishlist = $id ");
    return mysqli_affected_rows($conn);

}


function ubah($data){
    // vambil data dari tiap elemen form
    global $conn;
    // html special char agar kode html yang diinputkan tidak berjalan
    // ndak wajib se, cuman buat keamanan
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $nomorhp = htmlspecialchars($data["nomorhp"]);
    $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);
    $kabupaten = htmlspecialchars($data["kabupaten"]);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
        if($password!==$password2){
            echo "<script>
            alert('Konfirmasi password tidak sesuai');
            </script>";
            return false;
    
        }
        $gambarsampullama = htmlspecialchars($data["gambarlama"]);
    
    // cek user memilih gambar baru apa nda
        if($_FILES['fotoprofil']['error']===4){
            $fotoprofil = $gambarsampullama;
        }else{
            $fotoprofil= uploadfoto();
    
        }
        // enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);
        $querry = "UPDATE admin SET 
        nama = '$nama',
        username ='$username',
        email = '$email',
        nomorhp = '$nomorhp',
        jeniskelamin = '$jeniskelamin',
        alamat = '$alamat',
        password ='$password',
        fotoprofil ='$fotoprofil',
        kabupaten ='$kabupaten'
        WHERE id = $id
    ";
    mysqli_query($conn,$querry);
    return mysqli_affected_rows($conn);

    } else {
      echo"<script>
      alert('email yang anda masukkan tidak valid');
      document.location.href = 'registrasicustomer.php'
      </script>";
    }
   
}

function ubahcustomer($data){
    // vambil data dari tiap elemen form
    global $conn;
    // html special char agar kode html yang diinputkan tidak berjalan
    // ndak wajib se, cuman buat keamanan
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $nomorhp = htmlspecialchars($data["nomorhp"]);
    $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kabupaten = htmlspecialchars($data["kabupaten"]);
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if($password!==$password2){
            echo "<script>
            alert('Konfirmasi password tidak sesuai');
            </script>";
            return false;
    
        }
        $gambarsampullama = htmlspecialchars($data["gambarlama"]);
    
    // cek user memilih gambar baru apa nda
        if($_FILES['fotoprofil']['error']===4){
            $fotoprofil = $gambarsampullama;
        }else{
            $fotoprofil= uploadfoto();
    
        }
        // enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);
    
        $querry = "UPDATE customer SET 
                        nama = '$nama',
                        username ='$username',
                        email = '$email',
                        nomorhp = '$nomorhp',
                        jeniskelamin = '$jeniskelamin',
                        alamat = '$alamat',
                        password ='$password',
                        fotoprofil='$fotoprofil',
                        kabupaten='$kabupaten'
                        
                        WHERE id = $id
        ";
        mysqli_query($conn,$querry);
        return mysqli_affected_rows($conn);

    } else {
      echo"<script>
      alert('email yang anda masukkan tidak valid');
      document.location.href = 'registrasicustomer.php'
      </script>";
    }

   

}
        
    
function cari($keyword){

    $query = "SELECT * FROM admin
            WHERE 
             nama LIKE '%$keyword%' OR 
             username LIKE '%$keyword%' OR
             nomorhp LIKE '%$keyword%' OR
             email LIKE '%$keyword%' OR
             kabupaten LIKE '%$keyword%'
             ";// Like dengan %cari yang mirip dari depan
    
    return query($query);

}

function caricustomer($keyword){

    $query = "SELECT * FROM customer
            WHERE 
             nama LIKE '%$keyword%' OR 
             username LIKE '%$keyword%' OR
             nomorhp LIKE '%$keyword%' OR
             email LIKE '%$keyword%' OR
             kabupaten LIKE '%$keyword%'
             ";// Like dengan %cari yang mirip dari depan
    
    return query($query);

}
function profil($data){
    global $conn; 
    $username = $data;

    $result = mysqli_query($conn,"SELECT username FROM 
    admin WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)){
        
        return $result;

    }
    $result = mysqli_query($conn,"SELECT username FROM 
    customer WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)){
        
        return $result;
        
    }



}
function login($data){
    global $conn; 
    // mysqli_query($conn,"CREATE VIEW admin as SELECT * FROM 
    // admin");
    // mysqli_query($conn,"CREATE VIEW  as SELECT * FROM 
    // ");
    // mysqli_query($conn,"CREATE VIEW customer as SELECT * FROM 
    // customer");
    
    $username = $data;
    
    $result = mysqli_query($conn,"SELECT * FROM 
    admin WHERE username = '$username'");
    // //var_dump($result);
    
    if (mysqli_fetch_assoc($result)){

        return [$result,"admin"];

    }
    $result = mysqli_query($conn,"SELECT * FROM 
    customer WHERE username = '$username'");
    // //var_dump($result);
    if (mysqli_fetch_assoc($result)){

        return [$result,"customer"];
        
        
    }
    else{
        echo"<script>
        alert('username tidak terdaftar');
        document.location.href = 'login.php'
        </script>";

        // header("Location: login.php");
        return false;
        
    }

}

function tambahkamar($data)
{
    // vmbil data dari tiap elemen form
    global $conn;
    // html special char agar kode html yang diinputkan tidak berjalan
    // ndak wajib se, cuman buat keamanan
    $namakamar = htmlspecialchars($data["nama_kamar"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $stokkamar = htmlspecialchars($data["stok_kamar"]);

    $username = htmlspecialchars($data["username"]);
    // upload gambar/modul  

    $gambarkamar = uploadgambarkamar();
    if (!$gambarkamar) {
        return false;
    }

    $harga = htmlspecialchars($data["harga"]);

    mysqli_query($conn, "INSERT INTO kamar
   Values
   ('','$namakamar','$gambarkamar','$deskripsi','$stokkamar','$username','$harga')
   ");
    // tambah user baru ke database
    return mysqli_affected_rows($conn);
}

function tambahadmin($data){
    // vambil data dari tiap elemen form
    global $conn;
    // html special char agar kode html yang diinputkan tidak berjalan
    // ndak wajib se, cuman buat keamanan
    $nama = htmlspecialchars($data["nama"]);
    $username = strtolower(stripslashes($data["username"]));
    $email = htmlspecialchars($data["email"]);
    $nomorhp = htmlspecialchars($data["nomorhp"]);
    $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kabupaten = htmlspecialchars($data["kabupaten"]);
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // cek username sudah ada apa lom
    $result = mysqli_query($conn,"SELECT username FROM 
    admin WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)){
        echo"<script>
        alert('username sudah terdaftar');
        </script>";
        return false;
    }
    $result = mysqli_query($conn,"SELECT username FROM 
    customer WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)){
        echo"<script>
        alert('username sudah terdaftar');
        </script>";
        return false;
    }

    // cek konfirmasi password
    if($password!==$password2){
        echo "<script>
        alert('Konfirmasi password tidak sesuai');
        </script>";
        return false;

    }
    // enkripsi password
    $password = password_hash($password,PASSWORD_DEFAULT);

    // tambah user baru ke database
    mysqli_query($conn,"INSERT INTO admin
    Values
    ('','$nama','$username','$email','$nomorhp',
    '$jeniskelamin','$alamat','$password','profil.png',$kabupaten)");

    return mysqli_affected_rows($conn);

    } else {
      echo"<script>
      alert('email yang anda masukkan tidak valid');
      document.location.href = 'registrasicustomer.php'
      </script>";
    }
}

function tambahcustomer($data){
    // vambil data dari tiap elemen form
    global $conn;
    // html special char agar kode html yang diinputkan tidak berjalan
    // ndak wajib se, cuman buat keamanan
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $nomorhp = htmlspecialchars($data["nomorhp"]);
    $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kabupaten = htmlspecialchars($data["kabupaten"]);
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);

    
    // cek username sudah ada apa lom
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $result = mysqli_query($conn,"SELECT username FROM 
    customer WHERE username = '$username'");
        if (mysqli_fetch_assoc($result)){
            echo"<script>
            alert('username sudah terdaftar');
            </script>";
            return false;
        }
        $result = mysqli_query($conn,"SELECT username FROM 
        admin WHERE username = '$username'");
        if (mysqli_fetch_assoc($result)){
            echo"<script>
            alert('username sudah terdaftar');
            </script>";
            return false;
        }

        // cek konfirmasi password
        if($password!==$password2){
            echo "<script>
            alert('Konfirmasi password tidak sesuai');
            </script>";
            return false;
        }
        // enkripsi password
        $passbaru=$password;
        $password = password_hash($password,PASSWORD_DEFAULT);
        // //var_dump(password_verify($passbaru,$password));
        
        mysqli_query($conn,"INSERT INTO customer
        Values
        ('','$nama','$username','$email','$nomorhp',
        '$jeniskelamin','$alamat','$password','profil.png',$kabupaten)
        ");
        // tambah user baru ke database
        return mysqli_affected_rows($conn);
            

      } else {
        echo"<script>
        alert('email yang anda masukkan tidak valid');
        document.location.href = 'registrasicustomer.php'
        </script>";
      }

    
    

    

}
function upload(){

    $namafile = $_FILES['gambarsampul']['name'];
    $ukuranfile=$_FILES['gambarsampul']['size'];
    $error=$_FILES['gambarsampul']['error'];
    $tmpName=$_FILES['gambarsampul']['tmp_name'];

    if ( $error === 4 ){
        echo"<script/>
        alert ('pilih gambar terlebih dahulu');
        </script/>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $typegambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar = explode('.',$namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if( !in_array($ekstensigambar,$typegambarvalid)){
        echo"<script/>
        alert ('yang anda upload bukan gambar');
        </script/>";
        return false;
    }
    // cek ukuran 
    if ($ukuranfile > 100000000){
        echo"<script/>
        alert ('ukuran gambar terlalu besar');
        </script/>";
        return false;

    }
    // lolos pengecaekan gambar , siap diupload
    //generate nama baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;
    //var_dump($namafilebaru);
    move_uploaded_file($tmpName,'modul/sampul/'.$namafilebaru);

    return $namafilebaru;


    
}
function uploadfoto(){

    $namafile = $_FILES['fotoprofil']['name'];
    $ukuranfile=$_FILES['fotoprofil']['size'];
    $error=$_FILES['fotoprofil']['error'];
    $tmpName=$_FILES['fotoprofil']['tmp_name'];

    if ( $error === 4 ){
        
        return 'profil.png';
        
    }

    // cek apakah yang diupload adalah gambar
    $typegambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar = explode('.',$namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if( !in_array($ekstensigambar,$typegambarvalid)){
        echo"<script/>
        alert ('yang anda upload bukan gambar');
        </script/>";
        return false;
    }
    // cek ukuran 
    if ($ukuranfile > 100000000){
        echo"<script/>
        alert ('ukuran gambar terlalu besar');
        </script/>";
        return false;

    }
    // lolos pengecaekan gambar , siap diupload
    //generate nama baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;
    //var_dump($namafilebaru);
    move_uploaded_file($tmpName,'fotoprofil/'.$namafilebaru);

    return $namafilebaru;


    
}

function tambahwishlist($data){
    // vmbil data dari tiap elemen form
    global $conn;
    // html special char agar kode html yang diinputkan tidak berjalan
    // ndak wajib se, cuman buat keamanan
    
    $id_kamar = htmlspecialchars($data["id_kamar"]);
    $id_customer = htmlspecialchars($data["id_customer"]);
    
    $result = mysqli_query($conn,"SELECT * FROM 
    wishlistcustomer WHERE id_customer=$id_customer AND id_kamar = '$id_kamar'");
    if (mysqli_fetch_assoc($result)){
        echo"<script>
        alert('kamar sudah ada di wishlist ');
        </script>";

        return false;
    }


    mysqli_query($conn,"INSERT INTO wishlistcustomer
   Values
   ('','$id_kamar','$id_customer')
   ");
    $querry = "UPDATE kamar SET 
    wishlist = +1
    WHERE id_kamar = $id_kamar";
    //tambah user baru ke database

    mysqli_query($conn,$querry);
    // tambah user baru ke database
    return mysqli_affected_rows($conn);


}





 ?>