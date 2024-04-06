<?php
require_once 'koneksi.php'; // Menggunakan require_once untuk mengimpor file koneksi.php
require_once 'sql.php'; // Menggunakan require_once untuk mengimpor file sql.php

$obj = new Crud(); // Menggunakan kelas Crud dengan huruf kapital yang benar

if($_SERVER['REQUEST_METHOD'] == 'POST') { // Menggunakan REQUEST_METHOD untuk memeriksa metode permintaan
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mahasiswa'];
    if($obj->insertData($nim, $nama)) { // Memanggil metode insertData dari objek Crud
        echo '<div class="alert alert-success">Data berhasil disimpan</div>'; // Pesan jika berhasil menyimpan data
    } else{
        echo '<div class="alert alert-danger">Gagal menyimpan data</div>'; // Mengubah pesan jika gagal menyimpan data
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Halaman Utama</title>
</head>
<body>
    <div class="container">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">PHP : CRUD OOP PHP </h6>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NIM:</label>
                                <input type="text" class="form-control" name="nim">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NAMA MAHASISWA:</label>
                                <input type="text" class="form-control" name="nama_mahasiswa">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="mt-4 btn btn-md btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th>NAMA MAHASISWA</th>
                    <td>AKSI</td>
                    <?php 
                    $no=1;
                    $data= $obj->tampilMahasiswa();
                    while($row=$data->fetch_array()){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['nim'];?> </td>
                        <td><?php echo $row['nama_mahasiswa'];?> </td>
                        <td>
                            <?php echo "<a class='btn btn-sm btn-primary' href='edit.php?id_mahasiswa=".$row['id_mahasiswa']."'>edit</a>"; ?>
                            <?php echo "<a class='btn btn-sm btn-danger' href='delete.php?id_mahasiswa=".$row['id_mahasiswa']."'>detele</a>"; ?>
                        </td>
                    </tr>
                    <?php $no==1; }?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
