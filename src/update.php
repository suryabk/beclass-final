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
        $result_genre = mysqli_query($conn,$get_genre);
        
        // get id sent from movie-details page
        $id = $_GET['id'];

        // get data film from database with special conditions according to the id sent
        $query = "SELECT * FROM film, poster WHERE film.id = poster.id_film && film.id =".$id;
        $get_films = mysqli_query($conn, $query);

        // get data form from POST method
        if(isset($_POST['submit'])){
            // Declare variable
            $id = $_POST['id'];
            $title = $_POST['title'];
            $year = $_POST['year']; 
            $director = $_POST['director'];
            $actor = $_POST['actor'];
            $category = $_POST['category'];
            $trailer = $_POST['trailer'];
            $synopsis = $_POST['synopsis'];
            $thumbnail = $_POST['thumbnail'];
            $wPoster = $_POST['wPoster']; 
            $genres = $_POST['genre'];
            
                
             // update table film with condition when the user does not fill in the synopsis
            if($synopsis != ""){
                $query = "UPDATE film SET title='$title' ,year='$year' ,director='$director' ,actor='$actor',synopsis='$synopsis',id_category='$category' WHERE id=$id";
            }else{
                $query = "UPDATE film SET title='$title' ,year='$year' ,director='$director' ,actor='$actor' ,id_category='$category' WHERE id=$id";
            }
            $update_film = mysqli_query($conn, $query);

            //update table poster
            if(isset($update_film) && $update_film === true){
                $query = "UPDATE poster SET trailer_link='$trailer',thumbnail='$thumbnail',w_poster='$wPoster' WHERE id_film='$id'";
                $update_poster = mysqli_query($conn, $query); 
                }
                if(isset($genres)){
                    // to update table film_genre, delete existing data first
                    $query = "DELETE FROM film_genre WHERE id_film=$id";
                    $update_genre = mysqli_multi_query($conn, $query);
                        // after that we insert the new datato table film_genre
                         foreach ($genres as $genre) {
                            $query = "INSERT INTO film_genre(id_genre, id_film) VALUES ($genre,$id);";
                            $send_genre = mysqli_multi_query($conn, $query);
                    }
                }
            }
    ?>
    <title>Update</title>
  </head>
  <body>

    <?php include "./asset/navbar.php"; ?>
    
    <a class="button btn-orange back-btn text-dark py-1" href="./movie-details.php?id=<?= $id?>"><i class="bi bi-arrow-left"></i></a>
    
    <main class="container body-crud px-5 text-light py-5">
        <h1 class="text-orange mb-5">Update a Movie</h1>
        <?php foreach ($get_films as $film) { ?>
        
        <!-- The form has been filled from some data obtained from the database, so the user only changes the desired data -->
        <form class="row g-3" action="" method="POST">
            
        <!-- When the form is successfully submitted it will give a success message  -->
            <?php if(isset($update_film) && $update_film === true) { ?>
                <div class="alert alert-success col-12" role="alert">
                Successfully Edit A Movie
                </div>
            <?php } ?>

            <div class="form-group col-md-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="<?=$film['title']?>" class="form-control" name="title" placeholder="Insert Title" required>
            </div>
            <div class="form-group col-md-4">
                <label for="year" class="form-label">Year Release</label>
                <input type="number" value="<?=$film['year']?>" class="form-control" name="year" placeholder="Insert Year" required>
            </div>
            <div class="form-group col-md-4">
                <label for="director" class="form-label">Director</label>
                <input type="text" value="<?=$film['director']?>" class="form-control" name="director"  placeholder="Directed by" >
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
                <input type="text" value=<?=$film['actor']?> class="form-control" name="actor" placeholder="Insert Actor name">
            </div>
            <div class="form-group col-md-4">
                <label for="trailer" class="form-label">Trailer</label>
                <input type="text" value=<?=$film['trailer_link']?> class="form-control" name="trailer" placeholder="Insert Link">
            </div>
            <div class="form-group col-md-4">
                <label for="thumbnail" class="form-label">Thumbnail Poster</label>
                <input type="text" value=<?=$film['thumbnail']?> class="form-control" name="thumbnail" placeholder="Insert Link" value="">
            </div>
             <div class="form-group col-md-4">
                <label for="wPoster" class="form-label">Wide Poster</label>
                <input type="text" value=<?=$film['w_poster']?> class="form-control" name="wPoster" placeholder="Insert Link" value="">
            </div>
            <div class="form-group col-md-8">
                <label class="form-label">Genre</label><br>
                <?php foreach ($result_genre as $i => $result) { ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="genre[]" value="<?= $i+1;?>">
                        <label class="form-check-label" for="genre"><?= $result['genre']?></label>
                     </div>
                <?php }; ?>
            </div>
            <div class="form-group col-md-12">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea class="form-control" name="synopsis" rows="3"></textarea>
            </div>
            <input type="hidden" name="id" value="<?= $id?>" />
            <div class="col-12">
                <button class="btn btn-orange" name="submit" type="submit">Update Movie</button>
            </div>
        </form>
        <?php }?>
    </main>

    <footer>
        <span class="text text-orange footer-text d-block mx-auto">Programing Class 2021</span>
    </footer>

    <script>
        // so that when the page is refreshed, the data will not be re-sent
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>