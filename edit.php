<?php 

require_once 'function.php';

// menangkap data id yang dikirimkan dari file index.php melalui tombol edit
$id = $_GET["id"];
// menjalankan function read , sama seperti difile index bedanya kita hanya ingin menampilkan data 1 aja yang sesuai dengan id yang dikirimkan
// jangan lupa kita kasih [0] untuk mengeluarkan array assosiative dari array .
$mahasiswa = read("SELECT * FROM tb_mahasiswa WHERE id=$id")[0];

// sama seperti di file create.php jika tombol submit ditekan
if (isset($_POST['submit'])){
    if (edit($_POST) > 0 ){
        echo "
        <script>
        alert('Berhasil Edit Data Mahasiswa');
        document.location.href = 'index.php';
        </script>
        ";
    }else{
        echo "
        <script>
        alert('Gagal Edit Data Mahasiswa');
        </script>
        ";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Update Data</title>
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
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">CREATE DATA</a>
            </li>
          </ul>
          <form class="d-flex">
          </form>
        </div>
      </div>
    </nav>
<!-- End Navbar -->

<!-- FORM -->
<section class="form mt-5" id="from">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h4>Update Data Mahasiswa</h4>
                <!-- method post untuk mengirimkan data menggunakan metode post dan enctype untuk mengirimkan file. -->
                <form method="post" enctype="multipart/form-data">
                <!-- type hidden tidak akan terlihat di tampilan webnya -->
                  <!-- jangan lupa kita bikin inputan hidden untuk mengisi data id dan photoLama -->
                    <input type="hidden" name="id" value="<?=$mahasiswa['id']?>">
                    <input type="hidden" name="photoLama" value="<?=$mahasiswa['photo']?>">
                  <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="number" name="nim" class="form-control" id="nim" value="<?=$mahasiswa['nim']?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?=$mahasiswa['nama']?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" id="jurusan" value="<?=$mahasiswa['jurusan']?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <br>
                    <img src="img/<?=$mahasiswa['photo']?>" alt="<?=$mahasiswa['nama']?>" width="200px" height="200px">
                    <input type="file" name="photo" class="form-control" id="photo">
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Form -->


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