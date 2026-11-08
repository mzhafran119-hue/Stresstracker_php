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

// Ambil data survei terbaru berdasarkan iduser
$query = $conn->query("
    SELECT j.idjawaban, l.idpertanyaan, p.pertanyaan, l.jawaban as jawaban_terpilih 
    FROM jawaban j
    JOIN listjawaban l ON j.idjawaban = l.idjawaban
    JOIN pertanyaan p ON l.idpertanyaan = p.idpertanyaan
    WHERE j.idjawaban = (
        SELECT MAX(idjawaban)
        FROM jawaban
        WHERE iduser = '$id'
    )
");

// Fungsi untuk menghitung nilai berdasarkan jawaban
function nilai($value)
{
    if ($value == 'A') {
        return 1;
    } elseif ($value == 'B') {
        return 2;
    } elseif ($value == 'C') {
        return 3;
    } else {
        return 4;
    }
}

// Fungsi untuk menentukan hasil tingkat stres
function hasil($value)
{
    if ($value >= 3.26) {
        return "Tinggi";
    } elseif ($value >= 2.51) {
        return "Menengah";
    } elseif ($value >= 1.76) {
        return "Rendah";
    } else {
        return "Sangat Rendah";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="text-center mb-4">Hasil Survei</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban Terpilih</th>
                                <th>Nilai</th>
                                <th>Tingkat Stres</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $currentIdJawaban = null;
                            $total_nilai = 0;
                            $question_count = 0;
                            while ($row = $query->fetch_assoc()) {
                                // Cek jika idjawaban berubah, berarti survey baru dimulai
                                if ($currentIdJawaban !== $row['idjawaban']) {
                                    // Jika bukan yang pertama, tampilkan total sebelumnya
                                    if ($currentIdJawaban !== null) {
                                        $nrr = $total_nilai / $question_count;
                                        $stress_level = hasil($nrr);
                                        echo "<tr style='font-weight: bold;'>";
                                        echo "<td colspan='3'>Total NRR</td>";
                                        echo "<td>" . number_format($nrr, 2) . "</td>";
                                        echo "<td>" . $stress_level . "</td>";
                                        echo "</tr>";
                                        $total_nilai = 0;
                                        $question_count = 0;
                                    }
                                    $currentIdJawaban = $row['idjawaban'];
                                }
                                $nilai_jawaban = nilai($row['jawaban_terpilih']);
                                $total_nilai += $nilai_jawaban;
                                $question_count++;

                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . htmlspecialchars($row['pertanyaan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['jawaban_terpilih']) . "</td>";
                                echo "<td>" . $nilai_jawaban . "</td>";
                                echo "<td></td>";
                                echo "</tr>";
                            }

                            // Tampilkan total NRR untuk survei terakhir
                            if ($question_count > 0) {
                                $nrr = $total_nilai / $question_count;
                                $stress_level = hasil($nrr);
                                echo "<tr style='font-weight: bold;'>";
                                echo "<td colspan='3'>Total NRR</td>";
                                echo "<td>" . number_format($nrr, 2) . "</td>";
                                echo "<td>" . $stress_level . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>
<?php include 'foot.php'; ?>