<?php include 'head.php'; ?>
<?php
// Pastikan pengguna sudah login
@session_start();
include 'conn.php';

if (!isset($_SESSION['akun'])) {
    header("Location: login.php");
    exit();
}

// Ambil data pengguna dari sesi
$akun = $_SESSION['akun'];
$id = $akun['id'];
$username = $akun['username'];

// Ambil data pengguna dari database
$query = $conn->query("SELECT * FROM akun WHERE id='$id'");
$userData = $query->fetch_assoc();
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="text-center mb-4">Edit Profil</h1>
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($userData['username']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($userData['email']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?= htmlspecialchars($userData['nama']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nohp" class="form-label">Nomor HP</label>
                            <input type="text" id="nohp" name="nohp" class="form-control" value="<?= htmlspecialchars($userData['nohp']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" value="<?= htmlspecialchars($userData['alamat']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Isi jika ingin mengubah password">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-dark" name="update_profile" value="update_profile" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// Proses pembaruan profil
if (isset($_POST['update_profile'])) {
    $newUsername = $_POST['username'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];

    // Cek jika username baru ada yang sama di database
    if ($newUsername !== $username) {
        $usernameCheck = $conn->query("SELECT * FROM akun WHERE username='$newUsername' AND id != '$id'");
        if ($usernameCheck->num_rows > 0) {
            echo "<script>alert('Username sudah digunakan. Silakan pilih username lain.');</script>";
            echo "<script>location = 'profile.php';</script>";
            exit();
        }
    }

    // Cek jika email baru ada yang sama di database
    if ($email !== $userData['email']) {
        $emailCheck = $conn->query("SELECT * FROM akun WHERE email='$email' AND id != '$id'");
        if ($emailCheck->num_rows > 0) {
            echo "<script>alert('Email sudah digunakan. Silakan pilih email lain.');</script>";
            echo "<script>location = 'profile.php';</script>";
            exit();
        }
    }

    // Update data pengguna di database
    $updateQuery = "UPDATE akun SET nama='$nama', nohp='$nohp', alamat='$alamat', username='$newUsername', email='$email'";

    // Update password jika diisi
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateQuery .= ", password='$hashedPassword'";
    }

    $updateQuery .= " WHERE id='$id'";

    if ($conn->query($updateQuery) === TRUE) {
        // Update data di sesi
        $_SESSION['akun']['username'] = $newUsername; // Update username di sesi jika berhasil
        $_SESSION['akun']['email'] = $email;
        $_SESSION['akun']['nama'] = $nama;
        $_SESSION['akun']['nohp'] = $nohp;
        $_SESSION['akun']['alamat'] = $alamat;
        echo "<script>alert('Profil berhasil diperbarui');</script>";
        echo "<script>location = 'profile.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui profil');</script>";
        echo "<script>location = 'profile.php';</script>";
    }
}
?>
<br><br>
<?php include 'foot.php'; ?>

</html>