<!doctype html>
<html lang="en">

<head>
    <?php
    include "./templates/header.php";
    include "../config/config_db.php";

    // make the error message not display on the page
    ini_set('display_errors', '0');

    // get tvshows data based on each genre from database
    $query = "SELECT * FROM tvshows, poster, film, genre WHERE tvshows.id_film = film.id && poster.id_film = tvshows.id_film && tvshows.id_genre = genre.id ORDER BY tvshows.id_genre ASC";

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
    <title>TV Show</title>
</head>

<body>

    <!-- add navbar -->
    <?php include "./templates/navbar.php"; ?>
    <main class="container mt-5 pt-5">
        <a class="button btn-orange back-btn py-1 mt-1" href="../index.php"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-light">TV Show</h1>

        <!-- show tvshows based on genre -->
        <?php foreach ($genres as $key => $genre) : ?>
            <!-- display any genre existing -->
            <h3 class="text-orange col-12 mt-5"><?= $genre ?></h3>

            <!-- displays a card containing movie data according to the genre -->
            <?php
            $query = "SELECT * FROM tvshows, film, genre, poster WHERE film.id = tvshows.id_film && film.id = poster.id_film && genre.id = tvshows.id_genre && genre LIKE '$genre'";
            $film_by_genre = mysqli_query($conn, $query);

            //grouping tvshows based on genre
            include './templates/showAllFilm.php';
            ?>
        <?php endforeach; ?>
    </main>

    <!-- add footer -->
    <?php include "./templates/footer.php"; ?>

</body>

</html>