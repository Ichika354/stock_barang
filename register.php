<?php
require 'function.php';

function regis($data){
    global $conn;

    $nik = $data['nik'];
    $password = $data['password'];
    $confirm = $data['confirm'];
    $nik_sama = mysqli_query($conn, "SELECT * FROM users WHERE nik = '$nik'");

    if (mysqli_fetch_assoc($nik_sama)){
        echo "<script>
                    alert('NIK yang dipilih sudah terdaftar')
                </script>";
        return false;
    }

    if ($confirm !== $password) {
        echo "<script>
                    alert('Password tidak sama')
                </script>";
        return false;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users VALUES('', '$nik','$hash')");

    return mysqli_affected_rows($conn);

}

if (isset($_POST['submit'])){
    if (regis($_POST) > 0) {
        echo
        "<script>
                alert('Akun berhasil terbuat');
            </script>";
    } else {
        echo mysqli_error($connect);
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
    <title>Stok Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>


    <div class="login">

        <form class="form" method="post">
            <p class="form-title">Sign up to your account</p>
            <div class="input-container">
                <input placeholder="Enter NIK" type="text" name="nik">
            </div>
            <div class="input-container">
                <input placeholder="Enter password" type="password" id="passwordInput" name="password">
            </div>
            <div class="input-container">
                <input placeholder="Enter confirm password" type="password" id="passwordInput" name="confirm">
            </div>
            <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility()">
            <label for="showPasswordCheckbox">Show Password</label>
            <button class="submit" type="submit" name="submit">
                Sign in
            </button>

            <p class="signup-link">
                Have account?
                <a href="login.php">Sign in</a>
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