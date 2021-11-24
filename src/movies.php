<!doctype html>
<html lang="en">

<head>
    <?php
    include "./asset/header.php";
    include "../config/config_db.php";

    // make the error message not display on the page
    ini_set('display_errors', '0');

    // get movie data based on each genre from database
    $query = "SELECT * FROM movies, poster, film, genre WHERE movies.id_film = film.id && movies.id_film = poster.id_film && movies.id_genre = genre.id ORDER BY movies.id_genre ASC";

    $get_film_genre = mysqli_query($conn, $query);

    // declare an empty genre array 
    $genres = [];

    // add any genre in the genre array based on the data obtained by the database
    foreach ($get_film_genre as $film) {
        array_push($genres, $film['genre']);
    }

    // prevent data duplication
    $genres = array_unique($genres);
    ?>
    <title>Movie</title>
</head>

<body>
    <!-- add navbar -->
    <?php include "./asset/navbar.php"; ?>

    <main class="container mt-5 pt-5">
        <a class="button btn-orange back-btn py-1 mt-1" href="../index.php"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-light">Movie</h1>

        <!-- show movies based on genre -->
        <?php foreach ($genres as $key => $genre) : ?>
            <!-- display any genre existing -->
            <h3 class="text-orange col-12 mt-5"><?= $genre ?></h3>

            <!-- displays a card containing movie data according to the genre -->
            <?php
            $query = "SELECT * FROM movies, film, genre, poster WHERE film.id = movies.id_film && film.id = poster.id_film && genre.id = movies.id_genre && genre LIKE '$genre'";
            $film_by_genre = mysqli_query($conn, $query);

            //grouping movies based on genre
            include './asset/category_genre.php';
            ?>
        <?php endforeach; ?>
    </main>

    <!-- add footer -->
    <?php include "./asset/category_footer.php"; ?>


</body>

</html>