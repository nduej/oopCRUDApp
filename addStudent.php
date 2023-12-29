<?php

session_start();

include_once 'classes/register.php';
$re = new Register();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $register = $re->addRegister($_POST, $_FILES);

}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Registration Form</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <br>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <?php

                    if (isset($register)) {
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>
                                <?= $register ?>

                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php

                    }
                    ?>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Add Student</h2>
                            </div>
                            <div class="col-md-6">
                                <a href="index.php" class="btn btn-info float-right">Show Student Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form action="addStudent.php" method="POST" enctype="multipart/form-data">
                            <label for="">Name</label>
                            <input type="text" name="name" placeholder="Enter Your Name" class="form-control">

                            <label for="">Email</label>
                            <input type="email" name="email" placeholder="Enter Your Email" class="form-control">

                            <label for="">Phone Number</label>
                            <input type="number" name="phone" placeholder="Enter Your Phone Number"
                                class="form-control">

                            <label for="">Profile Image</label>
                            <input type="file" name="photo" placeholder="Insert Your Photo" class="form-control">

                            <label for="">Address</label>
                            <textarea name="address" id="" cols="15" class="form-control"></textarea><br>

                            <input type="submit" name="register_button" value="Register"
                                class="btn btn-success form-control">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>