<?php	
session_start();	
require'..\hotel\config\functions.php';


// cek cookie
if (isset($_COOKIE['login']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    
    // ambil username berdasarkan id
    $result=mysqli_query($conn,"SELECT username FROM 
    admin WHERE id = '$id'");
    $row= mysqli_fetch_assoc($result);

    // cek coockie dan username
    if($key === hash('sha256',$row['username'])){
        $_SESSION['login'] = true;
    }
}

$tabel='';
// cek session
if (isset($_SESSION["login"])){
    header("Location:logout.php");
    exit;
}

if(isset($_POST["login"])){
    $username = strval($_POST["username"]);
    $password = $_POST["password"]; //inputan password
    $periksa=login($username);
    $tabel=$periksa[1];
    $result=$periksa[0];
    
    $result = mysqli_query($conn,"SELECT * FROM 
    $tabel WHERE username = '$username'");
   
    // //var_dump ($tabel);
  
    // cek username
    if(mysqli_num_rows($result) == 1){
      
        // cek password(bandingkan pass1 dan pass 2)
        $row = mysqli_fetch_assoc($result);
       if( password_verify($password,$row["password"])){
            // set session
            $_SESSION["login"]=true;
            $_SESSION["username"] = $row["username"];
            $_SESSION["tabel"] = $tabel;

            // cek remember me
            if(isset($_POST['remember'])){
                // buat cookie beserta enkripsi
                
                setcookie('id',$row["id"],time()+60);
                setcookie('key',hash('sha256',  $row["username"],
                time()+60));
            }
                       header("Location: halamanutama$tabel.php");
                       // masuk ke halaman index
// masuk ke halaman index
            exit;
       } 
       
    }
    $error = true;

}

?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="login-form-14/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
        <h3 class="mb-4"><a href="landingpage.php">Kembali</a></h3>
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(assets/pexels-kaique1.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
       
			      			<h3 class="mb-4">Halaman Login</h3>
			      		</div>
								
			      	</div>
                      <?php	if (isset($error)):?>
                        <p style="color:red;font-style:italic;align-items:center;">username/password salah</p>
                        <?= "<script>
                        alert('username/password salah');
                        </script>";?>
                        <?php	endif;?> 
							<form action="" class="signin-form" method="post">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
			      		</div>

		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
		            </div>

		            <div class="form-group">
		            	<button type="submit" name="login" class="form-control btn btn-primary rounded submit px-3" >Login</button>
                    
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
                            
			            	<label class="checkbox-wrap checkbox-primary mb-0" >Remember Me
									  <input type="checkbox"name="remember" id="remember" >
									  <span class="checkmark"></span>
										</label>
									</div>
                                    <div class="remember-form">
            </div>
		            </div>
		          </form>
		          <p class="text-center">Tidak Punya profil? <a href="tambahcustomer.php">Daftar</a></p>

		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

