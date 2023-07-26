<?php

require 'function.php';
require 'cek.php';

$id = $_GET['id'];
$query = query("SELECT a.*, b.kode_stock AS kode FROM stok_masuk a INNER JOIN stock b ON a.id_stock = b.id_stock WHERE a.id_masuk = $id")[0];



if (isset($_POST["edit"])) {
    
    if (editMasuk($_POST) > 0) {
        echo
        "<script>
            alert('Data berhasil diubah');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo
        "<script>
            alert('Data gagal diubah :( ');
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
    <title>Referensi</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="sb-nav-fixed">
    <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color:#005586;">
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
        </div> -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Referensi</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <div class="card" style="width: 34rem;">
                                <div class="card-header">
                                    <h4 class="mb-0">Edit Stock In</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $query['id_masuk']; ?>">
                                        <div class="row mb-3">
                                            <label for="kode" class="col-sm-2 col-form-label" style="width: 7rem;">Kode Stock</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="kode" name="kode" disabled value="<?= $query['kode']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="jumlah" class="col-sm-2 col-form-label" style="width: 7rem;">Jumlah</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $query['jumlah']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="tanggal_masuk" class="col-sm-2 col-form-label"  style="width: 7rem;">Tanggal Masuk</label>
                                            <div class="col-sm-6">
                                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= $query['tanggal_masuk']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="satuan" class="col-sm-2 col-form-label"  style="width: 7rem;">Satuan</label>
                                            <div class="col-sm-6">
                                                <select class="form-select" id="satuan" name="satuan" required>
                                                    <option value="" selected disabled>Pilih Satuan</option>
                                                    <option value="box">BOX</option>
                                                    <option value="pcs">PCS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="keterangan" class="col-sm-2 col-form-label"  style="width: 7rem;">Keterangan</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required><?= $query['keterangan']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="gambar" class="col-sm-2 col-form-label"  style="width: 7rem;">Image</label>
                                            <div class="col-sm-6">
                                                <input type="file" class="form-control" id="gambar" name="foto" accept="image/*">
                                            </div>
                                        </div>
                                        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                        <button type="submit" class="btn btn-warning">Reset</button>
                                        <button type="submit" class="btn btn-white border">Batal</button>
                                    </form>
                                </div>
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

</html>