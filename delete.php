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

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Memeriksa metode permintaan
    // Menghapus data mahasiswa berdasarkan ID
    if ($obj->deleteData($id_mahasiswa)) {
        echo '<div class="alert alert-success">Data berhasil dihapus</div>';// Pesan jika berhasil menghapus data
    } else {
        echo '<div class="alert alert-danger">Gagal menghapus data</div>';// Mengubah pesan jika gagal menghapus data
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
    <title>Delete Data Mahasiswa</title>
</head>
<body>
    <div class="container">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Delete Data Mahasiswa</h6>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                <div class="card-body">
                    <p>Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                    <button type="submit" class="mt-4 btn btn-md btn-danger">Delete</button>
                    <a href="index.php" class="mt-4 btn btn-md btn-primary">Kembali ke Halaman Utama</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
