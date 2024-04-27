<?php
session_start();
include_once 'config/db.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    setcookie('user_id', create_unique_id(), time() + 60 * 60 * 24 * 30);
}

if (empty($_SESSION['userlogin'])) {
    echo "<script>document.location='logout.php'</script>";
}

if (!empty($_SESSION['userlogin'])) {

    $urole = $_SESSION['urole'];
    if ($urole == "Admin") {
        include 'src/fetchNewBook.php';

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <?php
            include 'src/header.php';
            ?>
        </head>

        <?php
        include 'src/adminNavbar.php';
        ?>

        <div class="container mt-5">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#book_modal">Add
                Book</button>

            <!-- The Modal -->
            <div class="modal" id="book_modal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <?php

                        include 'add_book.php';

                        ?>

                    </div>
                </div>
            </div>


            <div class="card">


                <table id="inventory_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Cover</th>
                            <th>ISBN</th>
                            <th>Author First Name</th>
                            <th>Author Last Name</th>
                            <th>Genre</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>The Hunger Games</td>
                            <td><img src="test-img/hungergames.jpg" width="48" height="73.25"></td>
                            <td>9780439023528</td>
                            <td>Suzanne</td>
                            <td>Collins</td>
                            <td>Young Adult</td>
                            <td>Edit Delete</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script>

            $(document).ready(function () {
                $('#inventory_table').DataTable();
            });



        </script>
        </body>

        </html>

        <?php
    } else {
        echo "<script>document.location='logout.php'</script>";
    }
} else {
    echo "<script>document.location='logout.php'</script>";
}
?>