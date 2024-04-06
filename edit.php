<?php
require_once 'koneksi.php';
require_once 'sql.php';

$obj = new Crud();

// Memeriksa apakah parameter 'id_mahasiswa' diberikan
if (!isset($_GET['id_mahasiswa'])) {
    die("Error: ID mahasiswa tidak diberikan");
}

$id_mahasiswa = $_GET['id_mahasiswa'];

// Mengambil detail data mahasiswa berdasarkan ID
$detail_mahasiswa = $obj->detailData($id_mahasiswa);

// Memastikan bahwa detail mahasiswa ada dan valid
if (!$detail_mahasiswa) {
    die("Error: Data mahasiswa tidak ditemukan atau tidak valid");
}

// Jika detail mahasiswa ditemukan dan valid, kita bisa melanjutkan
$nim = htmlspecialchars($detail_mahasiswa['nim']);
$nama_mahasiswa = htmlspecialchars($detail_mahasiswa['nama_mahasiswa']);

if($_SERVER['REQUEST_METHOD'] == 'POST') { // Menggunakan REQUEST_METHOD untuk memeriksa metode permintaan
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mahasiswa'];
    if($obj->UpdateData($nim, $nama, $id_mahasiswa)) { // Memanggil metode UpdateData dari objek Crud
        // Jika update berhasil, ambil data mahasiswa terbaru dari basis data
        $detail_mahasiswa = $obj->detailData($id_mahasiswa);
        // Memastikan bahwa detail mahasiswa ada dan valid
        if ($detail_mahasiswa) {
            // Update variabel $nim dan $nama_mahasiswa dengan data terbaru
            $nim = htmlspecialchars($detail_mahasiswa['nim']);
            $nama_mahasiswa = htmlspecialchars($detail_mahasiswa['nama_mahasiswa']);
        }
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
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    <div class="container">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Mahasiswa</h6>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post"> <!-- Menggunakan REQUEST_URI untuk mendapatkan URL saat ini -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NIM:</label>
                                <input type="text" class="form-control" name="nim" value="<?php echo htmlspecialchars($nim); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NAMA MAHASISWA:</label>
                                <input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo htmlspecialchars($nama_mahasiswa); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="mt-4 btn btn-md btn-success">Simpan</button>
                            <a href="index.php" class="mt-4 btn btn-md btn-primary">Kembali ke Halaman Utama</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
