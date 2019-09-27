<?php
    require 'functions.php';

    $id = $_POST["id_name"];
    if (isset($_POST["delete"])){
        if (hapusData($id) > 0) {
            echo "
                <script>
                    alert('Data berhasil dihapus !!');
                    window.location = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal dihapus !!');
                    window.location = 'index.php';
                </script>
            ";
        }
    }
?>