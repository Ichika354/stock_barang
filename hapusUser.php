<?php 

require 'function.php';


$id = $_GET["id"];

if ( hapusUser($id) > 0 ) {
    echo
    "<script>
        alert('Data berhasil dihapus');
        window.location.href = 'management.php';
    </script>";
} else {
     echo
    "<script>
        alert('Data gagal dihapus');
        window.location.href = 'management.php';
    </script>";
}



?>