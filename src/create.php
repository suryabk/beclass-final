<!doctype html>
<html lang="en">

<head>
    <?php
    include "./asset/header.php";
    require "../config/config_db.php";

    // make the error message not display on the page
    ini_set('display_errors', '0');

    // get genre data from database to use on form
    $get_genre = "SELECT genre FROM genre";
    $result_genre = mysqli_query($conn, $get_genre);

    // get id sent from index page
    $id = $_GET['id'];

    // get data form from POST method
    if (isset($_POST['submit'])) {
        // Declare variable
        $id = $_POST['id'];
        $title = $_POST['title'];
        $year = $_POST['year'];
        $director = $_POST['director'];
        $actor = $_POST['actor'];
        $types = $_POST['types'];
        $category = $_POST['category'];
        $trailer = $_POST['trailer'];
        $synopsis = $_POST['synopsis'];
        $thumbnail = $_POST['thumbnail'];

        // provide default value when the user doesn't fill in
        if ($thumbnail === "") {
            $thumbnail = "https://res.cloudinary.com/dqqtuqump/image/upload/w_auto,q_auto,f_auto/v1637334674/php-crud/thumbnail_eiscsy.jpg";
        };
        $wPoster = $_POST['wPoster'];
        if ($wPoster === "") {
            $wPoster = "https://res.cloudinary.com/dqqtuqump/image/upload/w_auto,q_auto,f_auto/v1637397382/php-crud/wide_ey9k8r.jpg";
        };

        // because the genre will have more than one data then it is made into an array
        $genres = [];
        // push data to array genre
        foreach ($_POST['genre'] as $item) {
            array_push($genres, $item);
        }

        // Insert into table film
        $query = "INSERT INTO film (id,title,year,director,actor,synopsis,id_category) VALUES ('$id', '$title', '$year', '$director', '$actor', '$synopsis', '$category');";
        $send_film = mysqli_query($conn, $query);

        //insert into table poster
        if (isset($send_film) && $send_film === true) {
            $query = "INSERT INTO poster(trailer_link,thumbnail,w_poster,id_film) VALUES ('$trailer','$thumbnail','$wPoster','$id');";
            $send_poster = mysqli_query($conn, $query);
        }
        if (isset($send_poster) && $send_poster === true) {
            // Insert into table film_genre
            foreach ($genres as $key => $genre) {
                $query = "INSERT INTO film_genre(id_genre, id_film) VALUES ($genre,$id);";
                $send_genre = mysqli_multi_query($conn, $query);
            }
        }
        if ($types === "1") {
            $id_types = intval($types);
            $name_type = "TV Show";
            foreach ($genres as $key => $genre) {
                $query = "INSERT INTO tvshows(id_types, id_genre, id_film) VALUES ($id_types, $genre, $id)";
                $send_tvshows = mysqli_multi_query($conn, $query);
            }
        } elseif ($types === "2") {
            $id_types = intval($types);
            $name_type = "Movie";
            foreach ($genres as $key => $genre) {
                $query = "INSERT INTO movies(id_types, id_genre, id_film) VALUES ($id_types, $genre, $id)";
                $send_movies = mysqli_multi_query($conn, $query);
            }
        }

        $id += 1;
    }
    ?>
    <title>Create</title>
</head>

<body>

    <?php include "./asset/navbar.php"; ?>

    <main class="container body-crud px-5 text-light py-5">
        <a class="button btn-orange back-btn text-dark py-1" href="../index.php"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-orange mb-5">Add New TV Show / Movie</h1>

        <form class="row g-3" action="" method="POST">
            <!-- When the form is successfully submitted it will give a success message  -->
            <?php if (isset($send_film) && $send_film === true) { ?>
                <div class="alert alert-success col-12  " role="alert">
                    Successfully Added New <?= $name_type; ?>
                </div>
            <?php } ?>

            <div class="form-group col-md-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Insert Title" required>
            </div>
            <div class="form-group col-md-4">
                <label for="year" class="form-label">Year Release</label>
                <input type="number" class="form-control" name="year" placeholder="Insert Year" required>
            </div>
            <div class="form-group col-md-4">
                <label for="director" class="form-label">Director</label>
                <input type="text" class="form-control" name="director" placeholder="Directed by">
            </div>
            <div class="form-group col-md-4">
                <label for="category">Category</label>
                <select name="category" class="form-control">
                    <option value="1">SU</option>
                    <option value="2">13+</option>
                    <option value="3">17+</option>
                    <option value="4">21+</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="actor" class="form-label">Actor</label>
                <input type="text" class="form-control" name="actor" placeholder="Insert Actor name">
            </div>
            <div class="form-group col-md-4">
                <label for="types">Type</label>
                <select name="types" class="form-control">
                    <option value="1">TV Show</option>
                    <option value="2">Movie</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="trailer" class="form-label">Trailer</label>
                <input type="text" class="form-control" name="trailer" placeholder="Insert Link">
            </div>
            <div class="form-group col-md-4">
                <label for="thumbnail" class="form-label">Thumbnail Poster</label>
                <input type="text" class="form-control" name="thumbnail" placeholder="Insert Link" value="">
            </div>
            <div class="form-group col-md-4">
                <label for="wPoster" class="form-label">Wide Poster</label>
                <input type="text" class="form-control" name="wPoster" placeholder="Insert Link" value="">
            </div>
            <div class="form-group col-md-8">
                <label class="form-label">Genre</label><br>
                <?php foreach ($result_genre as $i => $result) : ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="genre[]" value="<?= $i + 1; ?>">
                        <label class="form-check-label" for="genre"><?= $result['genre'] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group col-md-12">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea class="form-control" name="synopsis" rows="3"></textarea>
            </div>
            <input type="hidden" name="id" value="<?= $id ?>" />
            <div class="col-12">
                <button class="btn btn-orange" name="submit" type="submit">Add Movie</button>
            </div>
        </form>
    </main>

    <footer>
        <span class="text text-orange footer-text d-block mx-auto">Programing Class 2021</span>
    </footer>

    <script>
        // so that when the page is refreshed, the data will not be re-sent
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>