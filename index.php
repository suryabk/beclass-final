<!doctype html>
<html lang="en">

<head>
    <?php
    include "./src/templates/header.php";
    require "./config/config_db.php";

    // make the error message not display on the page
    ini_set('display_errors', '0');

    // get data film from database
    $query = "SELECT * FROM film, poster WHERE film.id = poster.id_film";
    $get_films = mysqli_query($conn, $query);

    // get latest id film for new film to be added
    $get_latest_id = NULL;
    foreach ($get_films as $key => $film) {
        $get_latest_id = $film["id"];
    }
    ?>
    <title>NETFLOX</title>
</head>

<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand mr-5" href="#">NETFLOX</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="./src/tvshows.php">TV Show</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="./src/movies.php">Movie</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="./src/category.php">Category</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a class="btn btn-outline-orange my-2 my-sm-0 mx-4" onclick="return alert('Cuman Hiasan Boss')">Sign In</a>
                    <a class="btn btn-orange my-2 my-sm-0" onclick="return alert('Cuman Hiasan Boss')">Log In</a>
                </form>
            </div>
        </div>
    </nav>

    <header>
        <div class="jumbotron jumbotron-fluid position-relative mx-auto">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./src/images/eternals.jpg" class="d-block w-100" alt="Eternals Poster">
                    </div>
                    <div class="carousel-item">
                        <img src="./src/images/ghostbuster.jpg" class="d-block w-100" alt="Ghost Buster Poster">
                    </div>
                    <div class="carousel-item">
                        <img src="./src/images/rednotice.jpg" class="d-block w-100" alt="Red Notice Poster">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </div>
    </header>

    <main class="container mt-5 pt-5">
        <h3 class="text-center text-orange">Watch Now</h3>
        <!-- Send latest id to create page -->
        <a href="./src/create.php?id=<?= $get_latest_id + 1 ?>" class="btn btn-orange d-block mx-auto mt-5 col-md-3 col-lg-2 col-sm-4 col-5">Add New Movie +</i></a>

        <!-- Render the card containing the acquired film data, 
        with a condition where there are only 3 cards in one row-->
        <?php foreach ($get_films as $key => $film) { ?>
            <?php if ($key === 0) { ?>
                <div class="row mt-5">
                    <div class="card bg-dark text-light mx-auto" style="width: 18rem;">
                        <img src=<?= $film['thumbnail'] ?> class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title overflow-hidden"><?= $film['title'] ?></h5>
                            <p class="card-text"><?= $film['year'] ?></p>
                            <a href="./src/movie-details.php?id=<?= $film['id'] ?>" class="btn btn-orange">See Details</a>
                        </div>
                    </div>
                <?php  } elseif ($key % 3 != 0) { ?>
                    <div class="card bg-dark text-light mx-auto" style="width: 18rem;">
                        <img src=<?= $film['thumbnail'] ?> class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title overflow-hidden"><?= $film['title'] ?></h5>
                            <p class="card-text"><?= $film['year'] ?></p>
                            <a href="./src/movie-details.php?id=<?= $film['id'] ?>" class="btn btn-orange">See Details</a>
                        </div>
                    </div>
                <?php  } elseif ($key % 3 === 0) { ?>
                </div>
                <div class="row mt-5">
                    <div class="card bg-dark text-light mx-auto" style="width: 18rem;">
                        <img src=<?= $film['thumbnail'] ?> class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title overflow-hidden"><?= $film['title'] ?></h5>
                            <p class="card-text"><?= $film['year'] ?></p>
                            <a href="./src/movie-details.php?id=<?= $film['id'] ?>" class="btn btn-orange">See Details</a>
                        </div>
                    </div>
                <?php  } ?>
            <?php } ?>
                </div>
    </main>

    <footer>
        <span class="text text-orange footer-text d-block mx-auto">Programing Class 2021</span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>