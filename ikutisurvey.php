<?php include 'head.php' ?>
<?php
$ambil = $conn->query("SELECT * FROM survey WHERE idsurvey='$_GET[id]'");
$data = $ambil->fetch_assoc();

if (!$_SESSION['akun']) {
    echo "<script> alert('Anda harus login terlebih dahulu');</script>";

    echo "<script> location ='login.php';</script>";
}
?>
<div class="container">
    <div class="row gx-5">
        <div class="col-lg-12">
            <div class="contact-form-area mb-70">
                <h1 class="text-center mb-4">Isi Formulir <?= $data['namasurvey'] ?></h1>
                <form action="" method="post">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <b><label>Nama</label></b>
                                <input type="hidden" name="idsurvey" value="<?= $_GET['id'] ?>">
                                <input type="text" name="nama" value="" class="form-control bg-light border-0" placeholder="Nama Lengkap" style="height: 55px;" required>
                            </div>
                            <div class="form-group">
                                <b><label>Usia</label></b>
                                <input type="number" name="usia" min="1" max="99" value="" class="form-control bg-light border-0" placeholder="Usia" style="height: 55px;" required>
                            </div>
                            <div class="form-group">
                                <b><label>Jenis Layanan Yang Di Terima</label></b>
                                <input type="text" name="jenislayanan" value="" class="form-control bg-light border-0" placeholder="Layanan" style="height: 55px;" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <b><label>Jenis Kelamin</label></b>
                                <br>
                                <input type="radio" name="jekel" value="Laki - Laki" required>
                                <label>Laki - Laki</label>
                                <input type="radio" name="jekel" value="Perempuan" required>
                                <label>Perempuan</label>
                            </div>
                            <div class="form-group">
                                <b><label>Pendidikan</label></b>
                                <br>
                                <input type="radio" name="pendidikan" value="SD" required>
                                <label>SD</label>
                                <input type="radio" name="pendidikan" value="SMP" required>
                                <label>SMP</label>
                                <input type="radio" name="pendidikan" value="SMA" required>
                                <label>SMA</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-dark w-100 py-3" name="simpan" value="simpan" type="submit">Jawab Survey <?= $data['namasurvey'] ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br> <br><br>
<?php include 'foot.php' ?>

<?php
if (isset($_POST["simpan"])) {
    $_SESSION['formulir']['nama'] = $_POST["nama"];
    $_SESSION['formulir']['jekel'] = $_POST["jekel"];
    $_SESSION['formulir']['usia'] = $_POST["usia"];
    $_SESSION['formulir']['pendidikan'] = $_POST["pendidikan"];
    $_SESSION['formulir']['jenislayanan'] = $_POST["jenislayanan"];
    $_SESSION['formulir']['idsurvey'] = $_POST["idsurvey"];
    echo "<script> location ='jawab.php';</script>";
}
?>

</html>