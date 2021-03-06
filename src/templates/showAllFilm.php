<?php foreach ($filmByGenre as $key => $film) : ?>
    <!-- with a condition where there are only 3 cards in one row -->
    <?php if ($key === 0) : ?>
        <div class="row mt-5">
            <div class="card bg-dark text-light mx-auto" style="width: 18rem;">
                <img src=<?= $film['thumbnail'] ?> class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title overflow-hidden"><?= $film['title'] ?></h5>
                    <p class="card-text"><?= $film['year'] ?></p>
                    <a href="./movie-details.php?id=<?= $film['id_film'] ?>" class="btn btn-orange">See Details</a>
                </div>
            </div>
        <?php elseif ($key % 3 != 0) : ?>
            <div class="card bg-dark text-light mx-auto" style="width: 18rem;">
                <img src=<?= $film['thumbnail'] ?> class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title overflow-hidden"><?= $film['title'] ?></h5>
                    <p class="card-text"><?= $film['year'] ?></p>
                    <a href="./movie-details.php?id=<?= $film['id_film'] ?>" class="btn btn-orange">See Details</a>
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
                    <a href="./movie-details.php?id=<?= $film['id_film'] ?>" class="btn btn-orange">See Details</a>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
        </div>