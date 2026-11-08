<?php
include 'conn.php';
$conn->query("DELETE FROM pertanyaan WHERE idpertanyaan='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='kuesioneredit.php?id=$_GET[idsurvey]';</script>";
