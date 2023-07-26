<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'barang_k3lh');


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    $kodestock = $data['kodeStock'];
    $namastock = $data['namaStock'];
    $satuan = $data['satuan'];
    $deskripsi = $data['deskripsi'];

    $foto = upload();

    if (!$foto) {
        return false;
    }

    $query = "INSERT INTO stock (kode_stock, nama_barang, satuan,foto,deskripsi) VALUES ('$kodestock','$namastock','$satuan','$foto','$deskripsi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function masuk($data)
{
    global $conn;

    $barang = $data['barangnya'];
    $tglmasuk = $data['tglmasuk'];
    $qty = $data['qty'];
    $satuan = $data['satuan'];
    $keterangan = $data['keterangan'];

    $checkQuery = "SELECT * FROM stok_masuk WHERE id_stock = '$barang' AND tanggal_masuk = '$tglmasuk'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE stok_masuk SET jumlah = jumlah + '$qty' WHERE id_stock = '$barang' AND tanggal_masuk = '$tglmasuk'";
        $hasil = mysqli_query($conn, $updateQuery);
        if (!$hasil) {
            echo "Error: " . mysqli_error($conn);
        }
        $updateStock = "UPDATE stock SET jumlah_stock = jumlah_stock + '$qty' WHERE id_stock = '$barang'";
        $updateStock = mysqli_query($conn, $updateStock);
        if (!$updateStock) {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Insert ke tabel stok_masuk
        $queryStokMasuk = "INSERT INTO stok_masuk (id_stock, tanggal_masuk, jumlah, satuan, keterangan) VALUES ('$barang','$tglmasuk','$qty','$satuan','$keterangan')";
        $insertStokMasuk = mysqli_query($conn, $queryStokMasuk);
        if (!$insertStokMasuk) {
            echo "Error: " . mysqli_error($conn);
        }

        // Update tabel stock
        $updateStockQuery = "UPDATE stock SET jumlah_stock = jumlah_stock + '$qty' WHERE id_stock = '$barang'";
        $updateStockResult = mysqli_query($conn, $updateStockQuery);
        if (!$updateStockResult) {
            echo "Error: " . mysqli_error($conn);
        }
    }
    return mysqli_affected_rows($conn);
}

function keluar($data)
{
    global $conn;

    $id = $data['barangkeluar'];
    $tglkeluar = $data['tglkeluar'];
    $qty = $data['jumlah'];
    $satuan = $data['satuan'];
    $penerima = $data['penerima'];

    $queryBarang = mysqli_query($conn, "SELECT * FROM stock WHERE id_stock = '$id'");
    $barang = mysqli_fetch_assoc($queryBarang);

    $stokBaru = $barang['jumlah_stock'] - $qty;

    if ($stokBaru < 0) {
        // Jumlah yang dibeli melebihi stok yang tersedia, kembalikan false
        echo "
        <script>
            alert('Jumlah Melebihi Stok yang ada :( ');
        </script>
        ";
        return false;
    }

    $checkQuery = "SELECT * FROM stok_keluar WHERE id_stock = '$id' AND tanggal_keluar = '$tglkeluar'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE stok_keluar SET jumlah_stock = jumlah_stock + '$qty' WHERE id_stock = '$id' AND tanggal_keluar = '$tglkeluar'";
        mysqli_query($conn, $updateQuery);
        // Update Table Stock
        mysqli_query($conn, "UPDATE stock SET jumlah_stock = $stokBaru WHERE id_stock = $id");
    } else {
        mysqli_query($conn, "INSERT INTO stok_keluar (id_stock,id_management,jumlah_stock,satuan,tanggal_keluar) VALUES ('$id','$penerima','$qty','$satuan','$tglkeluar')");
        // Update Table Stock
        mysqli_query($conn, "UPDATE stock SET jumlah_stock = $stokBaru WHERE id_stock = $id");
    }



    return mysqli_affected_rows($conn);
}

function user($data)
{
    global $conn;

    $nik = $data['nik'];
    $otoritas = $data['otoritas'];

    mysqli_query($conn, "INSERT INTO management (nik,otoritas) VALUES ('$nik','$otoritas')");

    return mysqli_affected_rows($conn);
}

function editUser($data)
{
    global $conn;

    $id = $data["id"];
    $nik = $data["nik"];
    $otoritas = $data["otoritas"];


    $query = "UPDATE management SET
                    nik         = '$nik',
                    otoritas    = '$otoritas'

                    WHERE id_management  = $id 
        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusUser($id)
{
    global $conn;

    try {
        mysqli_query($conn, "DELETE FROM management WHERE id_management = $id");
    } catch (Exception $e) {
        echo
        "<script>
            alert('User tidak bisa di hapus');
            window.location.href = 'management.php';
        </script>";
    }

    return mysqli_affected_rows($conn);
}

function hapusMasuk($id)
{
    global $conn;

    try {
        mysqli_query($conn, "DELETE FROM stok_masuk WHERE id_masuk = $id");
    } catch (Exception $e) {
        echo
        "<script>
            alert('Data tidak bisa di hapus');
            window.location.href = 'masuk.php';
        </script>";
    }

    return mysqli_affected_rows($conn);
}

function editMasuk($data)
{
    global $conn;

    $id = $data["id"];
    $jumlah = $data["jumlah"];
    $tanggal_masuk = $data["tanggal_masuk"];
    $satuan = $data["satuan"];
    $keterangan = $data["keterangan"];

    // $pilih = mysqli_query($conn, "SELECT * FROM stok_masuk");
    // $barang = mysqli_fetch_assoc($pilih);
    // $stok = mysqli_query($conn, "SELECT * FROM stock");
    // $produk = mysqli_fetch_assoc($stok);

    $query = "UPDATE stok_masuk SET
                        jumlah          = '$jumlah',
                        tanggal_masuk   = '$tanggal_masuk',
                        satuan          = '$satuan',
                        keterangan      = '$keterangan'
    
                        WHERE id_masuk  = $id 
            ";
    mysqli_query($conn, $query);
    // if ($jumlah > $barang['jumlah']) {

    //     $stockBaru = $produk['jumlah_stock'] + $jumlah;


    //     if (!$a) {
    //         echo "Error: " . mysqli_error($conn);
    //     }
    //     $b = mysqli_query($conn, "UPDATE stock SET jumlah_stock = $stockBaru WHERE id_stock = $id");
    //     if (!$b) {
    //         echo "Error: " . mysqli_error($conn);
    //     }
    // } else {
    //     $baru = $produk['jumlah_stock'] - $jumlah;
    //     $query = "UPDATE stok_masuk SET
    //                     jumlah          = '$jumlah',
    //                     tanggal_masuk   = '$tanggal_masuk',
    //                     satuan          = '$satuan',
    //                     keterangan      = '$keterangan'

    //                     WHERE id_masuk  = $id 
    //         ";
    //     $c = mysqli_query($conn, $query);
    //     if (!$c) {
    //         echo "Error: " . mysqli_error($conn);
    //     }
    //     $d = mysqli_query($conn, "UPDATE stock SET jumlah_stock = $baru WHERE id_stock = $id");
    //     if (!$d) {
    //         echo "Error: " . mysqli_error($conn);
    //     }
    // }




    return mysqli_affected_rows($conn);
}




function upload()
{
    $namaFile = $_FILES["foto"]["name"];
    $error = $_FILES["foto"]["error"];
    $tmpName = $_FILES["foto"]["tmp_name"];

    //cek apakah ada foto yg di upload atau tidak
    if ($error === 4) {
        echo
        "<script>
                alert('Upload foto terlebih dahulu');
            </script>";
        return false;
    }

    //cek apakah yang di upload foto atau bukan
    $ekstensiFotoValid = ["jpg", "jpeg", "png"];
    $ekstensiFoto = explode('.', $namaFile);
    $ekstensiFoto = strtolower(end($ekstensiFoto));

    if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
        echo
        "<script>
             alert('Upload foto dongg');
         </script>";
        return false;
    }
    //lolos semua pengecekan
    //generate nama foto baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFoto;




    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);

    return $namaFileBaru;
}
