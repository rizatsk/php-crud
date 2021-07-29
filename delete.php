<?php 

require_once 'function.php';
// kita tangkap idnya yang dikirimkan dari file index.php melalui tombol delete
$id = $_GET["id"];

// disini juga sama jika berhasil ada data yang dihapus maka lebih  dari 0 dan berhasil
// sekalian jalankan file hapus($id) sekalian mengirimkan data id untuk function hapus yang ada difile function.php
if (hapus($id) > 0 ){
    echo "
    <script>
    alert('Berhasil Mengahapus Data Mahasiswa');
    document.location.href = 'index.php';
    </script>
    ";
}else{
    echo "
    <script>
    alert('Gagal Menghapus Data Mahasiswa');
    document.location.href = 'index.php';
    </script>
    ";
}