<?php	
require'..\hotel\config\functions.php';



$tabel='admin';
if(isset($_POST["register"])){

    if (tambahadmin($_POST)>0){
        echo "<script>
        alert('user baru berhasil ditambahkan!');
        </script>";
    }else{
        echo mysqli_error($conn);

    }

}
$kabupaten=query("SELECT * FROM kabupaten");
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
        <h3 class="mb-4"><a href="daftaradmin.php">Kembali</a></h3>
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(assets/pexels-kaique1.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
       
			      			<h3 class="mb-4">Pendaftaran Admin</h3>
			      		</div>
								
			      	</div>

							<form action="" class="signin-form" method="post" enctype="multipart/form-data">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
			      		</div>
                <div class="form-group mb-3">
			      			<label class="label" for="name">Nama</label>
			      			<input type="text" class="form-control" name="nama" id="nama" placeholder="nama" required>
			      		</div>
                <div class="form-group mb-3">
			      			<label class="label" for="email">Email</label>
			      			<input type="text" class="form-control" name="email" id="email" placeholder="email" required>
			      		</div>
                <div class="form-group mb-3">
			      			<label class="label" for="nomorhp">Nomor Handphone</label>
			      			<input type="text" class="form-control" name="nomorhp" id="nomorhp" placeholder="nomorhp" required>
			      		</div>

                
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
		            </div>
                <div class="form-group mb-3">
		            	<label class="label" for="password2">Konfirmasi Password</label>
		              <input type="password" class="form-control" name="password2" id="password2" placeholder="Konfirmasi Password" required>
		            </div>
                <div class="form-group mb-3" >
			      			<label class="label" for="alamat">Alamat</label>
			      			<input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" required>
			      		</div>
				<div class="form-group mb-3">
                  <label for="kabupaten">Kabupaten :</label>
                  <select name="kabupaten" id="kabupaten"required>
				  <option value="">pilih Kabupaten</option>
						  <?php	foreach($kabupaten as $row):?> 
						  <option value="<?= $row['id_kabupaten']?>"><?= $row['nama_kabupaten']?></option>
						  <?php	endforeach;?>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="jeniskelamin">Jenis Kelamin :</label>
                  <select name="jeniskelamin" id="jeniskelamin"required>
                          <option value="">pilih Jenis Kelamin</option><option value="Laki laki">Laki laki</option>
                          <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                


		            <div class="form-group">
		            	<button type="submit" name="register" class="form-control btn btn-primary rounded submit px-3" >Daftar</button>
                    
		            </div>
				</div>
		        </form>

		        
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

