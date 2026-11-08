<html>
<title>Hasil Laporan Survey</title>
<style type="text/css">
    body {
        -webkit-print-color-adjust: exact;
        padding: 50px;
    }

    * {
        font-size: 10pt !important;

    }

    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
    }

    #table td,
    #table th {
        padding: 8px;
        padding-top: 5px;
        color: black;
        border: solid 1px black;
    }

    #table tr {
        padding-top: 5px;
        padding-bottom: 5px;
    }


    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    @page {
        size: auto;
        margin: 0;
    }
</style>
<?php
include('../conn.php');
$idsurvey = $_GET['idsurvey'];
$tahun = $_GET['tahun'];
function nilai($value)
{
    if ($value == 'A') {
        $nilai = 1;
    } elseif ($value == 'B') {
        $nilai = 2;
    } elseif ($value == 'C') {
        $nilai = 3;
    } else {
        $nilai = 4;
    }
    return $nilai;
}
function hasil($value)
{
    if ($value >= 3.26) {
        $nilai = "A";
    } elseif ($value >= 2.51) {
        $nilai = "B";
    } elseif ($value >= 1.76) {
        $nilai = "C";
    } else {
        $nilai = "D";
    }
    return $nilai;
}
?>

<body>
    <table style='width:670px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
        <tr>
            <td>
                <center>
                    <b style="font-size: 25pt !important">ANALISIS DATA</b><br>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <b style="font-size: 15pt !important">Aplikasi Pemantau Tingkat Kestresan Siswa SMA <br>Menggunakan Metode Perceived Stress Scale</b><br><br>
                </center>
            </td>
        </tr>
    </table>
    <br>
    <center>
        <span>------------------------------------------------------------------------------------------------------------------------------------------------------</span>
    </center>
    <br>
    <table class="table table-bordered table-striped" id="table" width="670px">
        <thead>
            <?php
            $ambilpertanyaan = $conn->query("SELECT * FROM pertanyaan WHERE idsurvey = '$idsurvey'");
            $jumlahpertanyaan = $ambilpertanyaan->num_rows;
            ?>
            <tr>
                <th width="15px" align="left">No.</th>
                <th colspan="<?= $jumlahpertanyaan ?>" align="center"></th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th align="left">Resp</th>
                <?php
                $u = 1;
                $ambilpertanyaan = $conn->query("SELECT*FROM pertanyaan where idsurvey = '$idsurvey' order by idpertanyaan asc");
                while ($pertanyaan = $ambilpertanyaan->fetch_assoc()) { ?>
                    <th>U<?= $u ?></th>
                <?php
                    $u++;
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $ambiljawaban = $conn->query("SELECT * FROM jawaban WHERE idsurvey = '$idsurvey' AND YEAR(waktu) = '$tahun' ORDER BY idjawaban ASC");
            ?>
            <?php
            $columnSums = array(); // Array to store column sums

            while ($jawaban = $ambiljawaban->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <?php
                    $u = 1;
                    $ambilpertanyaan = $conn->query("SELECT * FROM pertanyaan WHERE idsurvey = '$idsurvey' ORDER BY idpertanyaan ASC");
                    $totalu = 0;
                    $U = [];
                    while ($pertanyaan = $ambilpertanyaan->fetch_assoc()) {
                        $ambillistjawaban = "SELECT * FROM listjawaban WHERE idpertanyaan = '$pertanyaan[idpertanyaan]' AND idjawaban = '$jawaban[idjawaban]'";
                        $listjawaban = mysqli_query($conn, $ambillistjawaban);
                        $nilai = $listjawaban->fetch_assoc();
                        $U[$pertanyaan['idpertanyaan']] = isset($U[$pertanyaan['idpertanyaan']]) ? $U[$pertanyaan['idpertanyaan']] + nilai($nilai['jawaban']) : nilai($nilai['jawaban']);
                        $total[$u][] = nilai($nilai['jawaban']);

                        // Update column sum
                        if (!isset($columnSums[$pertanyaan['idpertanyaan']])) {
                            $columnSums[$pertanyaan['idpertanyaan']] = 0;
                        }
                        $columnSums[$pertanyaan['idpertanyaan']] += nilai($nilai['jawaban']);

                    ?>
                        <td><?= nilai($nilai['jawaban']) ?></td>
                    <?php
                        $totalu++;
                        $u++;
                    }
                    ?>
                    <td></td>
                    <?php
                    $no++;
                    ?>
                </tr>
            <?php
            }
            ?>
            <?php
            $jumlahpenjawab = $no - 1;
            $pembagi = 1 / $totalu;
            ?>
            <tr>
                <td>Nilai Unsur</td>
                <?php
                foreach ($U as $pertanyaanId => $sum) {
                ?>
                    <td><?= $columnSums[$pertanyaanId] ?></td>
                <?php
                }
                ?>
                <td></td>
            </tr>
            <tr>
                <td>NRR/Unsur</td>
                <?php
                foreach ($U as $pertanyaanId => $sum) {
                ?>
                    <td><?= $columnSums[$pertanyaanId] / $jumlahpenjawab ?></td>
                <?php
                }
                ?>
                <td></td>
            </tr>
            <tr>
                <td>NRR/Unsur</td>
                <?php
                $totalnrrunsur = 0;
                foreach ($U as $pertanyaanId => $sum) {
                ?>
                    <td><?= ($columnSums[$pertanyaanId] / $jumlahpenjawab) * $pembagi ?></td>
                <?php
                    $totalnrrunsur += ($columnSums[$pertanyaanId] / $jumlahpenjawab) * $pembagi;
                }
                ?>
                <td><?= $totalnrrunsur ?></td>
            </tr>
            <tr>
                <td colspan="<?= $jumlahpertanyaan + 1 ?>" align="center">PERCEIVED STRESS SCALE (PSS)</td>
                <td><?= hasil($totalnrrunsur) ?>
            </tr>
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>

</html>