<!doctype html>
<html lang="en">

<head>
    <?php
    include "./asset/header.php";
    require "../config/config_db.php";

    // make the error message not display on the page
    ini_set('display_errors', '0');

    // get id sent from index page
    $id = $_GET['id'];

    // get data film from database with special conditions according to the id sent
    $query = "SELECT * FROM film, poster WHERE film.id = poster.id_film && $id = film.id";
    $get_films = mysqli_query($conn, $query);

    // get data genre from database with special conditions according to the id sent
    $query = "SELECT genre.genre FROM film_genre, genre WHERE genre.id = film_genre.id_genre && $id = film_genre.id_film";
    $get_genres = mysqli_query($conn, $query);

    ?>

    <title>Movie Details</title>
</head>

<body>

    <?php
    include "./asset/navbar.php";
    foreach ($get_films as $film) { ?>

        <header>
            <a class="button btn-orange back-btn py-1 mt-1" href="../index.php"><i class="bi bi-arrow-left"></i></a>
            <div class="jumbotron jumbotron-fluid position-relative mx-auto pb-0 text-light">
                <img src=<?= $film['w_poster'] ?> class="img-fluid big-poster" alt="...">
            </div>
        </header>

        <!-- Render the page containing the acquired film data -->
        <main class="container px-5">
            <div class="row position-relative main-title">
                <img src=<?= $film['thumbnail'] ?> style="width: 18rem;" class="img-thumbnail" alt="...">
                <div class="col ml-4 pt-3 ">
                    <h1 class="text text-orange mt-4"><?= $film['title'] ?></h1>
                    <h3 class="text text-orange mb-5"><?= $film['year'] ?></h3>
                    <p class="text-light">Director : <?= $film['director'] ?></p>
                    <p class="text-light">Genre : <?php foreach ($get_genres as $genre) {
                                                        echo $genre['genre'] . ", ";
                                                    } ?></p>
                    <p class="text-light">Actor : <?= $film['actor'] ?></p>
                    <div class="row pl-3">
                        <a class="btn btn-orange mt-2 pb-2" href=""><i class="bi bi-play-fill"></i> Watch Now</a>
                        <!-- edit button -->
                        <a class="btn btn-orange mt-2 pb-2 mx-3" href="./update.php?id=<?= $id ?>"><i class="bi bi-pencil-fill"></i></i> Edit</a>
                        <!-- delete button -->
                        <a class="btn btn-outline-orange mt-2 pb-2" href="./delete.php?id=<?= $id ?>" rola="button" onclick="return confirm('Are you sure you want to delete this user?');"><i class="bi bi-trash-fill"></i> Delete</a>
                    </div>
                </div>
            </div>
            <div class="row px-5">
                <h3 class="text text-orange mt-5">Synopsis</h3>
                <div class="col-12 px-4">
                    <p class="text-light text-justify"><?= $film['synopsis'] ?></p>
                </div>
            </div>
            <div class="row">
                <iframe width="560" class="mx-auto my-5" height="315" src=<?= $film['trailer_link'] ?> title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php } ?>
        </main>

        <footer>
            <span class="text text-orange footer-text d-block mx-auto">Programing Class 2021</span>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>