<!doctype html>
<html lang="en">

<head>
  <?php
  include "./asset/header.php";
  include "../config/config_db.php";

  // make the error message not display on the page
  ini_set('display_errors', '0');

  // get movie data based on each genre from database
  $query = "SELECT * FROM film_genre, film, genre, poster WHERE film.id = film_genre.id_film && film.id = poster.id_film && genre.id = film_genre.id_genre";
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
  <title>Category</title>
</head>

<body>

  <?php include "./asset/navbar.php" ?>
  <main class="container mt-5 pt-5">
    <a class="button btn-orange back-btn py-1 mt-1" href="../index.php"><i class="bi bi-arrow-left"></i></a>
    <h1 class="text-light">Genre</h1>

    <?php foreach ($genres as $key => $genre) : ?>
      <!-- display any genre existing -->
      <h3 class="text-orange col-12 mt-5"><?= $genre ?></h3>

      <!-- displays a card containing movie data according to the genre -->
      <?php
      $query = "SELECT * FROM film_genre, film, genre, poster WHERE film.id = film_genre.id_film && film.id = poster.id_film && genre.id = film_genre.id_genre && genre LIKE '$genre'";
      $film_by_genre = mysqli_query($conn, $query);
      foreach ($film_by_genre as $key => $film) : ?>
        <!-- with a condition where there are only 3 cards in one row--> -->
        <?php if ($key === 0) : ?>
          <div class="row mt-5">
            <div class="card bg-dark text-light mx-auto" style="width: 18rem;">
              <img src=<?= $film['thumbnail'] ?> class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title overflow-hidden"><?= $film['title'] ?></h5>
                <p class="card-text"><?= $film['year'] ?></p>
                <a href="./src/movie-details.php?id=<?= $film['id'] ?>" class="btn btn-orange">See Details</a>
              </div>
            </div>
          <?php elseif ($key % 3 != 0) : ?>
            <div class="card bg-dark text-light mx-auto" style="width: 18rem;">
              <img src=<?= $film['thumbnail'] ?> class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title overflow-hidden"><?= $film['title'] ?></h5>
                <p class="card-text"><?= $film['year'] ?></p>
                <a href="./src/movie-details.php?id=<?= $film['id'] ?>" class="btn btn-orange">See Details</a>
              </div>
            </div>
          <?php elseif ($key % 3 === 0) : ?>
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
          <?php endif; ?>
        <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
  </main>

  <footer>
    <span class="text text-orange footer-text d-block mx-auto">Programing Class 2021</span>
  </footer>



  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>