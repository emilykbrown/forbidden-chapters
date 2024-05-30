<?php
session_start();
include 'config/db.php'; 

// Function to create a unique ID
// function create_unique_id() {
//     return uniqid('genre_', true);
// }

// Set user_id cookie if not already set
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    setcookie('user_id', uniqid(), time() + 60 * 60 * 24 * 30);
}

// Redirect to logout page if user is not logged in
if (empty($_SESSION['userlogin'])) {
    echo "<script>document.location='logout.php'</script>";
    exit;
}

// If user is logged in
if (!empty($_SESSION['userlogin'])) {
    $urole = $_SESSION['urole'];
    if ($urole == "Admin") {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'components/header.php'; ?>
</head>
<body>
    <?php include 'components/adminNavbar.php'; ?>

    <div class="container mt-5">
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#genre_modal">Add Genre</button>
        <!-- The Modal -->
        <div class="modal" id="genre_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php include 'modals/add_genre.php'; ?>
                </div>
            </div>
        </div>
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
                        echo '<tr>';
                        echo '<td>', $genre_id, '</td>';
                        echo '<td>', $genre, '</td>';
                        echo '<td>', $genre_book_count, '</td>';
                        echo '<td>';
                        echo "<a href='edits/edit_genre.php?id={$genre_id}' name='edit-genre' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>&nbsp;&nbsp;";
                        echo "<button onclick='confirmGenreDelete()' class='btn btn-sm btn-danger deleteBtn' id='deleteBtn'><i class='fa-solid fa-x'></i></button>";
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
$(document).ready(function() {
    $('#genre-table').DataTable();
});


function confirmGenreDelete() {
    var result = confirm("Are you sure you want to delete this genre?");
    if (result) {
        // Redirect to delete.php with the ID parameter
        window.location.href = 'edits/delete_genre.php?id=<?php echo $genre_id; ?>';
    } else {
        // Do nothing
    }
}

</script>
</body>
</html>

<?php
    } else {
        echo "<script>document.location='logout.php'</script>";
        exit;
    }
} else {
    echo "<script>document.location='logout.php'</script>";
    exit;
}
?>
