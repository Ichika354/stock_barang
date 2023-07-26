<?php
require 'function.php';

if (isset($_POST['submit'])) {
    $NIK = $_POST['NIK'];
    $Password = $_POST['password'];

    $cekdatabase = mysqli_query($conn, "SELECT * FROM users WHERE nik='$NIK'");
    $hitung = mysqli_num_rows($cekdatabase);

    $row = mysqli_fetch_assoc($cekdatabase);
    //cek password
    $verif = password_verify($Password, $row["password"]);
    if ($verif) {
        if ($hitung > 0) {
            $_SESSION['log'] = 'True';
            header('location:index.php');
        } else {
            header('location:login.php');
        };
    }
};

if (!isset($_SESSION['log'])) {
} else {
    header('location:index.php');
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
    <title>Stok Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputNIK">NIK</label>
                                                <input class="form-control py-4" name="NIK" id="inputNIK" type="NIK" placeholder="NIK" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Lihat password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Lupa Password?</a>
                                                <button class="btn btn-primary" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">Login sesuai akun HRIS, <a href="register.html">Registrasi</a> apabila memiliki akun</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div> -->

    <div class="login">

        <form class="form" method="post">
            <p class="form-title">Sign in to your account</p>
            <div class="input-container">
                <input placeholder="Enter NIK" type="text" name="NIK">
            </div>
            <div class="input-container">
                <input placeholder="Enter password" type="password" id="passwordInput" name="password">
            </div>
            <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility()">
            <label for="showPasswordCheckbox">Show Password</label>
            <button class="submit" type="submit" name="submit">
                Sign in
            </button>

            <p class="signup-link">
                No account?
                <a href="register.php">Sign up</a>
            </p>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>

</html>