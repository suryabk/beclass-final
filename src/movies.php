<!doctype html>
<html lang="en">

<head>
    <?php
    include "./asset/header.php";
    include "../config/config_db.php";

    // make the error message not display on the page
    ini_set('display_errors', '0');

    // get movie data based on each genre from database
    $query = "SELECT * FROM movies, film, genre, poster WHERE movies.id_types && film.id = movies.id_film && film.id = poster.id_film && genre.id = movies.id_genre";

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
    <title>TV Shows</title>
</head>

<body>

    <?php
    include "./asset/navbar.php";
    include "./category_main.php"; ?>

</body>

</html>