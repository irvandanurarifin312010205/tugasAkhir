<?php

require_once 'koneksi.php';

// Set header agar response berupa JSON
header('Content-Type: application/json');

// Mendapatkan data jadwal harian
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM jadwal_harian";
    $result = $conn->query($sql);

    $jadwalHarian = array();
    while ($row = $result->fetch_assoc()) {
        $jadwalHarian[] = $row;
    }

    echo json_encode($jadwalHarian);
}

// Menambahkan data jadwal harian
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $jenis_kegiatan = $_POST['jenis_kegiatan'];
    $keterangan = $_POST['keterangan'];
    $waktu = $_POST['waktu'];

    $sql = "INSERT INTO jadwal_harian (tanggal, jenis_kegiatan, keterangan, waktu) VALUES ('$tanggal', '$jenis_kegiatan', '$keterangan', '$waktu')";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo json_encode(array('message' => 'Data berhasil ditambahkan'));
    } else {
        echo json_encode(array('message' => 'Gagal menambahkan data'));
    }
}

// Mengupdate data jadwal harian berdasarkan id
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'];
    $tanggal = $input['tanggal'];
    $jenis_kegiatan = $input['jenis_kegiatan'];
    $keterangan = $input['keterangan'];
    $waktu = $input['waktu'];

    $sql = "UPDATE jadwal_harian SET tanggal='$tanggal', jenis_kegiatan='$jenis_kegiatan', keterangan='$keterangan', waktu='$waktu' WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo json_encode(array('message' => 'Data berhasil diupdate'));
    } else {
        echo json_encode(array('message' => 'Gagal mengupdate data'));
    }
}

// Menghapus data jadwal harian berdasarkan id
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'];

    $sql = "DELETE FROM jadwal_harian WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo json_encode(array('message' => 'Data berhasil dihapus'));
    } else {
        echo json_encode(array('message' => 'Gagal menghapus data'));
    }
}
