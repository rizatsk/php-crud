<?php 

// untuk menghubugnkan file function.php
require_once 'function.php';
// menjalankan function read(sekaligus mengirimkan data),datanya berupa mengambil data dari database tb_mahasiswa
$mahasiswa = read("SELECT * FROM tb_mahasiswa");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Belajar CRUD PHP</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">BELAJAR PHP CRUD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">CREATE DATA</a>
            </li>
          </ul>
          <form class="d-flex">
          </form>
        </div>
      </div>
    </nav>
<!-- End Navbar -->

<!-- Tables -->
<section class="table" id="table">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">NIM</th>
                  <th scope="col">NAMA</th>
                  <th scope="col">JURUSAN</th>
                  <th scope="col">PHOTO</th>
                  <th scope="col">AKSI</th>
                </tr>
              </thead>
              <tbody>
                  <!-- membuat variable nomor -->
                  <?php $no = 1; ?>
                  <!-- melakukan perulangan data array ,dengan cara dikeluarkan datanya semua dan dimasukan ke dalam variable $mhs -->
                  <?php foreach($mahasiswa as $mhs): ?>
                <tr>
                  <!-- digunakan untuk melakukan perulangan nomor table sampai datanya habis -->
                  <th scope="row"><?=$no++?></th>
                  <!-- menampilkan data nim  -->
                  <td><?=$mhs['nim']?></td>
                  <td><?=$mhs['nama']?></td>
                  <td><?=$mhs['jurusan']?></td>
                  <td>
                    <!-- menampilkan data photo -->
                    <img src="img/<?=$mhs['photo']?>" alt="<?=$mhs['nama']?>" width="100px" height="100px">    
                  </td>
                  <td>
                    <!-- Ke file edit.php sekalian mengirimkan data id yang diklik -->
                    <a href="edit.php?id=<?=$mhs['id']?>" type="button" class="btn btn-outline-info">edit</a> | 
                    <!-- Ke file delete.php sekalian mengirimkan data id yang diklik -->
                    <a href="delete.php?id=<?=$mhs['id']?>" type="button" class="btn btn-outline-danger">delete</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </div>
        </div>
    </div>
</section>
<!-- end table -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>