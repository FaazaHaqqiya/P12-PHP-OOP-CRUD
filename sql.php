<?php 
class Crud extends Database 
{
    public function prepare($data)
    {
        $perintah= $this->koneksi->prepare($data);
        if(!$perintah) die("Terjadi kesalahan pada prepare statement" . $this->koneksi->error);
        return $perintah;
    }

    public function query($data)
    {
        $perintah= $this->koneksi->query($data);
        if(!$perintah) die("Terjadi kesalahan sql" . $this->koneksi->error);
        return $perintah;
    }

    public function tampilMahasiswa()
    {
        $sql = "SELECT id_mahasiswa, nim, nama_mahasiswa FROM tb_mahasiswa";
        return $this->query($sql); 
    }

    public function insertData($nim, $nama_mahasiswa)
    {
        $sql = "INSERT INTO tb_mahasiswa (nim, nama_mahasiswa) VALUES (?,?)";
        if($stmt = $this->prepare($sql)) {
            $stmt->bind_param("ss", $param_nim, $param_nama);
            $param_nim = $nim;
            $param_nama = $nama_mahasiswa;
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        $stmt->close();
    }

    public function detailData($data)
{
    $sql = "SELECT id_mahasiswa, nim, nama_mahasiswa FROM tb_mahasiswa WHERE id_mahasiswa=?";
    if($stmt = $this->prepare($sql)) {
        $stmt->bind_param('i', $param_data);
        $param_data = $data;
        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result->num_rows == 1) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        }
    }
    return false;
}


    public function updateData($nim, $nama, $data)
    {
        $sql = "UPDATE tb_mahasiswa SET nim=?, nama_mahasiswa=? WHERE id_mahasiswa=?";
        if($stmt = $this->prepare($sql)) {
            $stmt->bind_param("ssi", $param_nim, $param_nama, $param_data);
            $param_nim = $nim;
            $param_nama = $nama;
            $param_data = $data; 
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        $stmt->close();
    }

    public function deleteData($data)
    {
        $sql = "DELETE FROM tb_mahasiswa WHERE id_mahasiswa=?";
        if($stmt = $this->prepare($sql)) {
            $stmt->bind_param("i", $param_data);
            $param_data = $data;
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        $stmt->close();
    }
}

?>
