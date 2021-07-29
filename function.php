<?php 
// untuk menghubungkan ke database
// localhost itu host dari servernya.
// root =  usernamenya
// '' (kosong) itu untuk password databasenya
// db_mahasiswa yaitu databasenya .
$connection =  mysqli_connect('localhost','root','','db_mahasiswa');

function read($data){
    // digunakan untuk supaya variable connection bisa digunakan didalam function read ini
    global $connection;
    // menjalankan perintah sqlnya ,
    // $data itu dikirimkan dari file index.php yaitu berupa ini "SELECT * FROM tb_mahasiswa"
    $result = mysqli_query($connection,$data);
    // variable yang isinya array kosong untuk menampung isi dari array assosiative dari databasenya.
    $rows = [];
    // mengeluarkan isi databasenya dan dijadikan array assosiative
    while($row = mysqli_fetch_assoc($result)){
        // memasukan data array assosative ke dalam array index[0]
        $rows[] = $row;
    }
    // mengembalikan nilai databasenya yang sudah jadi array index[0] yang isinya array assosiative.
    return $rows;
}

// kita tangkap datanya berupa inputan yang diinput oleh user berupa nim,nama,jurusan.
// dengan membuat variable data.
function create($data){
    global $connection;
    
    // disini kita ambil data nim
    $nim = $data['nim'];
    $nama = $data['nama'];
    $jurusan = $data['jurusan'];

    // menjalankan fungsi upload , sekaligus upload() ini berupa isi dari nama photo yang baru
    $photo = upload();

    // mengecek jika tidak ada datanya karena ada kesalahan saat upload tidak dijalankan code program selanjutnya.
    if(!$photo){return false;}
    

    // memasukan data kedalam table tb_mahasiswa
    $create = "INSERT INTO tb_mahasiswa VALUES(
        '',
        '$nim',
        '$nama',
        '$jurusan',
        '$photo'
        )";

    // kita jalankan perintahnya  parameter yang pertama $connection databasenya , parameter yang kedua $create perintahnya.
    mysqli_query($connection, $create);
    // kita kembalikan baris dari databasenya seperti semula.
    return mysqli_affected_rows($connection);
}

// fungsi untuk upload photo
function upload(){
    // kita ambil 1 1 data dari file photonya
    $nama = $_FILES['photo']['name'];
    $type = $_FILES['photo']['type'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $error = $_FILES['photo']['error'];
    $size = $_FILES['photo']['size'];
    
    // kita cek apakah ada photo yang diupload
    // jika tidak ada maka kasih notifikasi dan berhentikan jalanya program
    if ($error === 4){
        // notif bahwa file photo harus diupload
        echo "
        <script>
        alert('Mohon Upload File Photo!');
        </script>
        ";
        // memberhentikan jalanya code program selanjutanya
        return false;
    }

    // pemecah data type dari image/jpg dengan pemecahnya slice ('/') menjadi array = [image][jpg]
    $type = explode('/',$type);
    // kita ambil data pertama yaitu [image]
    $type = array_shift($type);

    // jika typenya bukan sama dengan "image" dikasih notifiksai dan maka hentikan jalanya code program.
    if($type != "image"){
        echo "
        <script>
        alert('Mohon Untuk Upload File Gambar!');
        </script>
        ";
        return false;
    }

    // jika ukuran filenya lebih dari 1mb dikasih notifikasi dan maka hentikan jalanya code program.
    if($size > 1000000){
        echo "
        <script>
        alert('Mohon Untuk Upload File Gambarnya tidak boleh lebih dari 1MB!');
        </script>
        ";
        return false;
    }

    // mengambil extensi file dari nama filenya contoh rizat.jpg kita hanya mau ambil jpg nya aja.
    // dipecah dari rizat.jpg menjadi [rizat][jpg] dengan pemecahnya titik ('.');
    $extensiFile = explode('.',$nama);
    // mengambil data terkahir dari extensi file yaitu [jpg]
    $extensiFile = end($extensiFile);

    // membuat nama file baru untuk photonya agar nama file photo tidak ada yang sama.
    // membuat nama file baru berisikan uniqid();
    $namaFileBaru = uniqid();
    // kita tambahkan string ('.') dibelakang uniqid contoh menjadi (1231asd1d2.) ada titiknya dibelakang
    $namaFileBaru .= ".";
    // tambahkan extensi filenya yang sudah kita ambil contoh menjadi (1231sad.jpg) menambagkan jpg dibelakang titik
    $namaFileBaru .= $extensiFile;

    // memindahkan file dari server, ke folder kita agar bisa kita gunakan untuk menampilkan fotonya
    // contoh masuk folder img/12sadsa1.jpeg
    move_uploaded_file($tmp_name, 'img/'.$namaFileBaru);
    // mengembalikan nama file baru yang kita bikin dengan uniqid.
    return $namaFileBaru;
}

// $id ini itu data id yang dikirimkan dari file delete.php
function hapus($id){
    global $connection;

    // membuat variable berisi perintah untuk menghapus data dari table tb_mahasiswa yang ber id yang dikirimkan
    $delete = "DELETE FROM tb_mahasiswa WHERE id = $id ";

    // jalankan perintahnya ke databasenya dengan variable $connection dengan perintah variable $delete
    mysqli_query($connection,$delete);
    return mysqli_affected_rows($connection);
}

function edit($data){
    global $connection;
    $id = $data['id'];
    $nim = $data['nim'];
    $nama = $data['nama'];
    $jurusan = $data['jurusan'];
    $photoLama = $data['photoLama'];

    // jika user tidak mengupdate/tidak mengirimkan file photo barunya
    // maka menggunakan photo lama
    if ($_FILES['photo']['error'] === 4){
        $photo = $photoLama;
    }else{
        // jika mengirimkan maka jalankan fungsi upload 
        $photo = upload();
        // mengecek jika tidak ada datanya karena ada kesalahan saat upload tidak dijalankan code program selanjutnya.
        if(!$photo){return false;}
    }

    //membuat variable berisi perintah untuk mengupdate datanya dimana datanya sesuai dengan id yang dikirimkan melalui variable $id.
    $update = "UPDATE tb_mahasiswa SET
        nim = '$nim',
        nama = '$nama',
        jurusan = '$jurusan',
        photo = '$photo'
        WHERE id=$id
        ";

    //jalankan perintahnya ke databasenya dengan variable $connection dengan perintah variable $update
    mysqli_query($connection, $update);
    return mysqli_affected_rows($connection);
}