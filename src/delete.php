<?php
require "../config/config_db.php";

// get id sent from movie-details page
$id = $_GET['id'];

// delete data according to the obtained id
$query = "DELETE FROM film_genre WHERE id_film=$id";
$deleteGenre = mysqli_query($conn, $query);

// to perform multiple queries without using multiple_query
if (isset($deleteGenre) && $deleteGenre === true) {
    $query = "DELETE FROM poster WHERE id_film=$id";
    $deletePoster = mysqli_query($conn, $query);

    if (isset($deletePoster) && $deletePoster === true) {

        $query = "DELETE FROM movies WHERE id_film=$id";
        $deleteTVMovies = mysqli_query($conn, $query);

        if (!$deleteTVMovies) {
            $query = "DELETE FROM tvshows WHERE id_film=$id";
            $deleteTVMovies = mysqli_query($conn, $query);
        }

        if (isset($deleteTVMovies) && $deleteTVMovies === true) {
            $query = "DELETE FROM film WHERE id=$id";
            $deleteFilm = mysqli_query($conn, $query);
        }
    }
}

// when you have successfully deleted the data it will return to the index page
header("Location:../index.php?delete=" . $deleteFilm);
