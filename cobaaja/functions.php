<?php 
    // koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "bcarkademy");

    // function untuk menampilkan data (SELECT)
    function query($query) {
        global $conn;

        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    // function untuk menambahkan data (INSERT)
    function tambahData($data) {
        global $conn;

        $name = $data["name"];
        $nameWork = $data["work"];
        $salary = $data["salary"];

        $query = "INSERT INTO name VALUES ('', '$name', '$nameWork', '$salary')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // function untuk mengedit data (UPDATE)
    function ubahData($data) {
        global $conn;
        $id_name = $data["id_name"];
        $name = $data["name"];
        $nameWork = $data["work"];
        $salary = $data["salary"];
        
        $query = "UPDATE name SET
                    name = '$name',
                    id_work = '$nameWork',
                    id_salary = '$salary'
                    WHERE id_name = $id_name
                ";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // function untuk menghapus data (DELETE)
    function hapusData($id) {
        global $conn;

        $query = "DELETE FROM name WHERE id_name = $id";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
?>