 <!-- Masthead-->
<?php


if (!isset($_SESSION['user_name'])){
    header('location:guest_index.html');
}

?>
        <header class ="masthead">
            <div class="container h-100">
                <?php include 'movie_carousel.php' ?>
            </div>
        </header>
