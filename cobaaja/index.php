<?php 
    require 'functions.php';

    $employees = query("SELECT * FROM work JOIN name ON work.id_work = name.id_work JOIN category ON name.id_salary = category.id_salary");

    if (isset($_POST["submit"])) {
        // cek apakah data berhasil ditambahkan atau tidak
        if (tambahData($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan !!');
                    window.location = 'index.php';
                </script>
            ";
        }
    }

    if (isset($_POST["save"])) {
        if (ubahData($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan !!');
                    window.location = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal ditambahkan !!');
                    window.location = 'index.php';
                </script>
            ";
        }
    }

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Bootcamp Arkademy</title>
</head>

<body>
    <!-- Top Navbar -->
    <div class="d-flex align-items-center" style="box-shadow: 0 0 10px 3px;">
        <a href="#" class="navbar-brand">
            <img src="img/logo.png" alt="logoArkademy" width="120">
        </a>

        <p class="font-weight-bold mt-3 ml-3" style="font-size: 25px; font-family: Helvetica;">Arkademy Bootcamp</p>

        <div class="ml-auto p-2 ">
            <button type="button" class="btn btn-warning font-weight-bold" data-toggle="modal"
                data-target="#add_data">ADD</button>
        </div>
    </div>
    <!-- End of Top Navbar -->

    <!-- Table Contained -->
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-6 bg-light py-4" style="border-radius: 10px;">
                <table class="table table-bordered">
                    <thead style="font-family: Helvetica; background-color: lightgray;">
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Work</th>
                            <th class="text-center">Salary</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #fff;">
                        <?php foreach ($employees as $employee) : ?>
                        <tr>
                            <td><?php echo $employee["name"] ?></td>
                            <td class="text-center"><?php echo $employee["name_work"] ?></td>
                            <td class="text-center"><?php echo $employee["salary"] ?></td>
                            <td>
                                <a class="btn btn-primary btn-flat btn-xs" data-toggle="modal"
                                    data-target="#delete_data<?php echo $employee['id_name']?>"><i
                                        class="fa fa-trash"></i></a>
                                <!-- Modal Delete Confirmation -->
                                <div class="modal fade" id="delete_data<?php echo $employee["id_name"];?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Delete Confirmation</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Apakah anda ingin menghapus data ini ?</h6>
                                                <form action="deleteData.php" method="POST" id="modal-delete">
                                                    <input name="id_name" type="hidden"
                                                        value="<?php echo $employee["id_name"]; ?>">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancel</button>
                                                <button name="delete" type="submit" class="btn btn-primary"
                                                    form="modal-delete">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal Delete Confirmation -->
                                
                                <a class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#edit_data<?php echo $employee['id_name']?>"><i class="fa fa-edit"></i></a>                            
                                <!-- Update Data -->
                                <div class="modal fade" id="edit_data<?php echo $employee['id_name']?>" tabindex="-1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="POST" id="modal-save">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Name:</label>
                                                        <input type="hidden" name="id_name" value="<?php echo $employee["id_name"];?>">
                                                        <input type="text" name="name" id="name" value="<?php echo $employee["name"]; ?>"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="work">Work:</label>
                                                        <select name="work" id="work" class="form-control">
                                                            <?php 
                                                                $insertWork = query("SELECT * FROM work");
                                                                foreach ($insertWork as $inWork) {
                                                                    echo '<option value="'.$inWork['id_work'].'">'.$inWork['name_work'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="salary">Salary:</label>
                                                        <select name="salary" id="salary" class="form-control">
                                                            <?php 
                                                                $insertSalary = query("SELECT * FROM category");
                                                                foreach ($insertSalary as $inSal) {
                                                                    echo '<option value="'.$inSal['id_salary'].'">'.$inSal['salary'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button name="save" type="submit" class="btn btn-success" form="modal-save">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Update Data -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Table Contained -->

    <!-- Add Data -->
    <div class="modal fade" id="add_data" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="modal-submit">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="work">Work:</label>
                            <select name="work" id="work" class="form-control">
                                <?php 
                                    $insertWork = query("SELECT * FROM work");
                                    foreach ($insertWork as $inWork) {
                                        echo '<option value="'.$inWork['id_work'].'">'.$inWork['name_work'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary:</label>
                            <select name="salary" id="salary" class="form-control">
                                <?php 
                                    $insertSalary = query("SELECT * FROM category");
                                    foreach ($insertSalary as $inSal) {
                                        echo '<option value="'.$inSal['id_salary'].'">'.$inSal['salary'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button name="submit" type="submit" class="btn btn-success" form="modal-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Add Data -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js'></script>
</body>

</html>