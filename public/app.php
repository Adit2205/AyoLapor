<?php

//session_start(); // Start the session

$conn = mysqli_connect("localhost", "root", "", "laporan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function tambahAduan($username, $tgl, $telp, $lokasi, $isi, $foto, $status, $petugas)
{
    global $conn;

    $query = "INSERT INTO pengaduan VALUES (NULL, '$username' , '$tgl', '$telp', '$lokasi' ,'$isi', '$foto', '$status', '$petugas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function verify($data)
{
    global $conn;

    $id = htmlspecialchars($data["id_pengaduan"]);
    $tgl = htmlspecialchars($data["tgl_pengaduan"]);
    $telp = htmlspecialchars($data["telp"]);
    $lokasi = htmlspecialchars($data["lokasi"]);
    $isi = htmlspecialchars($data["isi_laporan"]);
    $foto = htmlspecialchars($data["foto"]);
    $status = "selesai"; // Ubah status menjadi "selesai" saat diverifikasi

    $query = "UPDATE pengaduan SET
                tgl_pengaduan = '$tgl',
                telp = '$telp',
                lokasi = '$lokasi',
                isi_laporan = '$isi',
                foto = '$foto',
                status = '$status'
                WHERE id_pengaduan = '$id' ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function tanggapan($data)
{
    global $conn;

    $id_pengaduan = htmlspecialchars($data["id_pengaduan"]);
    $tgl_tanggapan = htmlspecialchars($data["tgl_tanggapan"]);
    $tanggapan = htmlspecialchars($data["tanggapan"]);
    $id_petugas = htmlspecialchars($data["id_petugas"]);

    mysqli_query($conn, "INSERT INTO tanggapan VALUES (NULL, '$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')");

    return mysqli_affected_rows($conn);
}

function regisUser($data)
{
    global $conn;

    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $foto_profil = htmlspecialchars($data["foto_profil"]);
//    $telp = htmlspecialchars($data["telp"]);

    mysqli_query($conn, "INSERT INTO masyarakat VALUES ( ' ','$nik', '$nama', '$username', '$password', '$foto_profil' )");

    return mysqli_affected_rows($conn);
}

function addPetugas($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama_petugas"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $telpon = htmlspecialchars($data["telpon"]);
    $level = htmlspecialchars($data["level"]);

    mysqli_query($conn, "INSERT INTO petugas VALUES (NULL, '$nama', '$username', '$password', '$telpon', '$level')");

    return mysqli_affected_rows($conn);
}

function editPetugas($data)
{
    global $conn;

    $id = htmlspecialchars($data["id_petugas"]);
    $nama = htmlspecialchars($data["nama_petugas"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $telpon = htmlspecialchars($data["telpon"]);
    $level = htmlspecialchars($data["level"]);

    $query = "UPDATE petugas SET
                nama_petugas = '$nama',
                username = '$username',
                password = '$password',
                telpon = '$telpon',
                level = '$level'
                WHERE id_petugas = '$id'
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editMasyarakat($data)
{
    global $conn;

    $id = htmlspecialchars($data["id_masyarakat"]);
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);

    $query = "UPDATE masyarakat SET

                nama = '$nama',
                username = '$username',
                password = '$password',
                WHERE id_masyarakat = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deletePetugas($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = $id");

    return mysqli_affected_rows($conn);
}

function deleteMasyarakat($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM masyarakat WHERE id_masyarakat = $id");

    return mysqli_affected_rows($conn);
}

?>
