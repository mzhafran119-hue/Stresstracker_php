<?php
include 'conn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar Akun - Aplikasi Pemantau Tingkat Kestresan Siswa SMA</title>
    <link rel="stylesheet" href="assets/backend/node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/backend/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="assets/backend/css/style.css" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid">
            <div class="row">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-center mb-3">Daftar Akun</h3>
                            <form method="post">
                                <div class="form-group">
                                    <input type="text" name="nama_daftar" class="form-control bg-light border-0" placeholder="Nama" style="height: 55px;" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username_daftar" class="form-control bg-light border-0" placeholder="Username" style="height: 55px;" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email_daftar" class="form-control bg-light border-0" placeholder="Email" style="height: 55px;" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_daftar" class="form-control bg-light border-0" placeholder="Password" style="height: 55px;" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="nohp_daftar" class="form-control bg-light border-0" placeholder="Nomor HP" style="height: 55px;" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="alamat_daftar" class="form-control bg-light border-0" placeholder="Alamat" style="height: 75px;" required></textarea>
                                </div>
                                <button class="btn btn-dark w-100 py-3" name="register" value="register" type="submit">Daftar</button>
                                <br><br>
                                <center>
                                    <a href="login.php">Sudah punya akun? Login di sini</a>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/backend/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="assets/backend/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/backend/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/backend/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/backend/js/misc.js"></script>
</body>

</html>

<?php
if (isset($_POST["register"])) {
    $nama_daftar = $_POST["nama_daftar"];
    $username_daftar = $_POST["username_daftar"];
    $email_daftar = $_POST["email_daftar"];
    $password_daftar = $_POST["password_daftar"];
    $nohp_daftar = $_POST["nohp_daftar"];
    $alamat_daftar = $_POST["alamat_daftar"];
    $level_daftar = 'User'; // Set level otomatis sebagai User

    // Cek apakah username sudah ada
    $cek_username = $conn->query("SELECT * FROM akun WHERE username='$username_daftar'");
    if ($cek_username->num_rows > 0) {
        echo "<script>alert('Username sudah ada, silakan pilih username lain');</script>";
        echo "<script>location ='register.php';</script>";
    } else {
        // Cek apakah email sudah ada
        $cek_email = $conn->query("SELECT * FROM akun WHERE email='$email_daftar'");
        if ($cek_email->num_rows > 0) {
            echo "<script>alert('Email sudah digunakan, silakan pilih email lain');</script>";
            echo "<script>location ='register.php';</script>";
        } else {
            // Simpan akun baru ke database
            $conn->query("INSERT INTO akun (nama, username, email, password, nohp, alamat, level) VALUES ('$nama_daftar', '$username_daftar', '$email_daftar', '$password_daftar', '$nohp_daftar', '$alamat_daftar', '$level_daftar')");
            echo "<script>alert('Pendaftaran Berhasil, silakan login');</script>";
            echo "<script>location ='login.php';</script>";
        }
    }
}
?>