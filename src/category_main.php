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