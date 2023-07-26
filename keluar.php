<?php

require 'function.php';
require 'cek.php';

$query = mysqli_query(
    $conn,
    "SELECT a.*, b.kode_stock, b.nama_barang AS barang, c.nik AS nama 
    FROM stok_keluar a 
    INNER JOIN stock b ON a.id_stock = b.id_stock
    INNER JOIN management c ON a.id_management = c.id_management
    "
);

if (isset($_POST["barangout"])) {

    if (keluar($_POST) > 0) {
        echo
        "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = 'keluar.php';
            </script>";
    } else {
        echo
        "<script>
                alert('Data gagal ditambahkan :( ');
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color:#005586;">
        <div style="width: 17em;">
            <a class="navbar-brand" href="index.php">SAFETY EQUIPMENT STOCK</a>
        </div>
        <div class="">
            <button class="btn btn-link btn-sm order-1 order-lg-0 ms-5" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </div>

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-home"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="Referensi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Referensi Stock APD
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock IN
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock OUT
                        </a>
                        <a class="nav-link" href="management.php">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            User Management
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Stock Out</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Stock</th>
                                            <th>Nama Barang</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>NIK-orang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php while ($barang = mysqli_fetch_assoc($query)) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $barang['kode_stock']; ?></td>
                                                <td><?= $barang['barang']; ?></td>
                                                <td><?= $barang['tanggal_keluar']; ?></td>
                                                <td><?= $barang['jumlah_stock']; ?></td>
                                                <td><?= $barang['satuan']; ?></td>
                                                <td><?= $barang['nama']; ?></td>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Out</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <select name="barangkeluar" class="form-control">
                        <?php
                        $ambildata = mysqli_query($conn, "SELECT * FROM stock");
                        while ($fetcharray = mysqli_fetch_array($ambildata)) {

                            $kodebarang = $fetcharray['kode_stock'];
                            $id = $fetcharray['id_stock'];
                        ?>
                            <option value="<?= $id; ?>"><?= $kodebarang; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <input type="date" name="tglkeluar" placeholder="Tanggal Keluar" class="form-control" require> <br>
                    <input type="text" name="jumlah" placeholder="Jumlah" class="form-control" require> <br>
                    <input type="text" name="satuan" placeholder="Satuan" class="form-control" require> <br>
                    <select name="penerima" id="" class="form-control">
                        <option value="" selected disabled>Pilih User</option>
                        <?php
                        $ambildata = mysqli_query($conn, "SELECT * FROM management");
                        while ($fetcharray = mysqli_fetch_array($ambildata)) {

                            $id = $fetcharray['id_management'];
                            $namaOrang = $fetcharray['nik'];
                        ?>
                            <option value="<?= $id; ?>"><?= $namaOrang; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <button type="submit" class="btn btn-primary" name="barangout">Tambah</button>
                </div>
            </form>

            <!-- Modal footer -->


        </div>
    </div>
</div>

</html>