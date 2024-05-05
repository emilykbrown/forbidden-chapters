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

        <body>
            <?php
            include 'src/adminNavbar.php';
            ?>

            <div class="container mt-5">

                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#genre_modal">Add
                    Genre</button>

                <!-- The Modal -->
                <div class="modal" id="genre_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <?php

                            include 'add_genre.php';

                            ?>

                        </div>
                    </div>
                </div>
                <div class="card">


                    <table id="genre-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Genre ID</th>
                                <th>Genre</th>
                                <th>Number of Books</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $genres_tbl = $con->prepare("SELECT genres.genre, genres.genre_id, COUNT(books.genre_id) AS genre_book_count
                            FROM genres
                            LEFT JOIN books ON genres.genre_id = books.genre_id
                            GROUP BY genres.genre_id");
                            $genres_tbl->execute();
                            while ($genre_row = $genres_tbl->fetch(PDO::FETCH_ASSOC)) {
                                extract($genre_row);
                                ?>
                                <tr>
                                    <td><?php echo $genre_id; ?></td>
                                    <td><?php echo $genre; ?></td>
                                    <td><?php echo $genre_book_count; ?></td>
                                    <td>
                                        <a href="src/edit_genre.php" name="edit-genre" class="btn btn-warning btn-sm"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-x"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <script>

$(document).ready(function() {
    $('#genre-table').DataTable();
} );



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