
<?php

@include 'admin/config.php';

session_start();

if (!isset($_SESSION['user_name'])){
    header('location:guest_index.html');
}

require 'admin/config.php';
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    if($_FILES["image"]["error"] == 4){
      echo
      "<script> alert('Image Does Not Exist'); </script>"
      ;
    }
    else{
      $fileName = $_FILES["image"]["name"];
      $fileSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];
  
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $fileName);
      $imageExtension = strtolower(end($imageExtension));
      if ( !in_array($imageExtension,  $validImageExtension) ){
        echo
        "
        <script>
          alert('Invalid Image Extension');
        </script>
        ";
      }
      else if($fileSize > 100000000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
        </script>
        ";
      }
      else{
        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtension;
  
        move_uploaded_file($tmpName, 'admin/img/' . $newImageName);
        $query = "INSERT INTO tb_upload VALUES('', '$name', '$newImageName')";
        mysqli_query($conn, $query);
        echo
        "
        <script>
          alert('Successfully Added');
          document.location.href = 'index.php';
        </script>
        ";
      }
    }
  }
  ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Movie Theater | VisionTech</title>
        <link rel="shortcut icon" type="image/png" href="assets/logos/icon.png">
        <link src="admin/assets/font-awesome/css/all.js"/>
        <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
        <script src="admin/assets/font-awesome/js/all.js"></script>
       
        <link href="css/styles.css" rel="stylesheet" />
        <link href="index.css" rel="stylesheet" />
       
          
        <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!--meta tags-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

 <!--bootstrap css-->
 <link rel="stylesheet" href="css/swiper-bundle.min.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<link rel="stylesheet" type="text/css" href="index.css">

<!-- icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- Link Swiper JS -->
<script src="js/swiper-bundle.min.js"></script>

<script src="index.js"></script>
<script src="swiper.js"></script>



  
    <!-- ADDTOCART STYLE -->

    <style>
        .badge-notify {
            background: red;
            position: relative;
            top: -20px;
            right: 10px;
            
        }

        .my-cart-icon-affix {
                 
            padding-bottom: 10px;
            position: fixed;
            z-index: 999;
            background-color: orange;
            border-radius: 10px;
            width: 20px;
           
        }
      
    </style>
    <!-- ADDTOCART STYLE END -->


    </head>

    <body id="page-top" >

    
      
        <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="#">
            <img src="assets/logos/logo_1.jpg" alt="" width="150" height="34">
        </a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                <li class="nav-item"><a class="nav-link"  style="font-weight: bolder;" href="index.php?page=home"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
                </li>
                <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">MOVIES</a>
               <div style ="background-color: gainsboro;"  class="dropdown-menu">
                <a   class="nav-link" style ="background-color: gainsboro;" class="dropdown-item" href="showing1.php">Showing</a>
                  <a  class="nav-link"  style ="background-color: gainsboro;" class="dropdown-item" href="comingsoon.php">Coming soon</a>
               </div>
                 </li>
     
              <!---Modal--->
                <li class="nav-item">
                  <a class="nav-link"><span class='icon-field'><i class="fas fa-upload"></i></span>
                  <button id="myBtn" style="border: none; background: none; font-weight: bolder;"> UPLOAD VACCINE CARD</button></a>
                </li>
                    
               
                        <?php

                        $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                        $row_count = mysqli_num_rows($select_rows);

                        ?>
                       
                   <li class="nav-item">
               <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i><span class="badge badge-notify my-cart-badge"><?php echo $row_count; ?></span></a>
                     </li>
              
                  <!---Modadl--->
                <li class="nav-item">
                    <a class="nav-link" style="font-weight: bolder;" href="logout_user.php"><span class='icon-field'><i class="fa fa-power-off"></i></span> LOGOUT</a>
                </li>
            </ul>
        </div>
    </nav>


    

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
  <span class="close" style="text-align: right;">&times;</span>
    <h5 style="text-align: center; color: #1c1a2e; font-weight: bolder; text-shadow: 2px black;">VACCINE CARD</h5>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data" >
  
    <label  for="name"> Name : </label>
    <input type="text" name="name" id = "name" required value="" > <br>
    <label   for="image">Image : </label>
    <input   type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
    <button  type = "submit" name = "submit" style="border-radius: 10px;">Submit</button>
  </form>
  </div>
</div>
   
    <div class="text">
    <h3  style="color:white; left:80px;  text-transform: uppercase; padding-top: 20px; padding-bottom: 20px; 
         padding-right: 50px; text-align: right; ">Welcome, <span style="color:white;"><?php echo $_SESSION['user_name'];?></span>!</h3>
     </div>

    <!--carousel-->

    
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="active"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class="active"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" class="active"></button>

        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/img/img1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>The Invitation</h5>
              <p><b style="color: #fcbf01; font-weight: bolder; text-shadow: 2px black;">GENRE: </b>Horror <br>
                <b style="color: #fcbf01; font-weight: bolder; text-shadow: 2px black;">SYNOPSIS: </b>After the death of her mother and having no other known relatives, Evie takes a DNA test… <br> 
                                  and discovers a long-lost cousin she never knew she had. Invited by her newfound family to a lavish wedding <br> 
                                  in the English countryside, she’s at first seduced by the sexy aristocrat host but is soon thrust into a nightmare <br> of survival as she uncovers
                                  twisted secrets in her family’s history and the unsettling intentions behind <br> their sinful generosity.
              </p>
            
            <div class="slider-btn">
              <a href="#videotrailer" class="button2 more" id="videolink1"><i class="fas fa-play-circle" aria-hidden="true">&nbsp;</i> Trailer</a>
              <div id="videotrailer" class="mfp-hide" style="max-width: 75%; margin: 0 auto;">
                  <iframe width="853" height="480" src="https://www.youtube.com/embed/5bL1ftuxgOE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>  
            </div>
            </div>
          </div>
          
          <div class="carousel-item">
            <img src="assets/img/img2.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>How To Find Forever</h5>
              <p><b style="color: #fcbf01; font-weight: bolder; text-shadow: 2px black;">GENRE: </b>Romance <br>
                <b style="color: #fcbf01; font-weight: bolder; text-shadow: 2pxblack;">SYNOPSIS: </b>Marley is brilliant at organizing other people's engagements, <br> but unlucky in finding romance herself.
                                  When designing her most important proposal yet, <br> the man who could jeopardize it all may be the one who helps find her own love story.
              </p>

              <div class="slider-btn">

                <a href="#videotrailer2" class="button2 more" id="videolink2"><i class="fas fa-play-circle" aria-hidden="true">&nbsp;</i> Trailer</a>
                <div id="videotrailer2" class="mfp-hide" style="max-width: 75%; margin: 0 auto;">
                  <iframe width="853" height="480" src="https://www.youtube.com/embed/RIv6DquceiI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div> 
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/img/img3.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Luck</h5>
              <p><b style="color: #fcbf01; font-weight: bolder; text-shadow: 2px black;">GENRE: </b>Comedy/Family <br>
                <b style="color: #fcbf01; font-weight: bolder; text-shadow: 2px black;">SYNOPSIS: </b>The story of Sam Greenfield, the unluckiest person in the world. <br> 
                                                Suddenly finding herself in the never-before-seen Land of Luck, she must  <br> 
                                                unite with the magical creatures there to turn her luck around. <br>
              </p>

              <div class="slider-btn">
                <a href="#videotrailer3" class="button2 more" id="videolink3"><i class="fas fa-play-circle" aria-hidden="true">&nbsp;</i> Trailer</a>
                <div id="videotrailer3" class="mfp-hide" style="max-width: 75%; margin: 0 auto;">
                  <iframe width="853" height="480" src="https://www.youtube.com/embed/xSG5UX0EQVg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div> 
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <img src="assets/img/img4.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>She Hulk</h5>
              <p><b style="color: #fcbf01; font-weight: bolder; text-shadow: 2px black;">GENRE: </b>Action/Comedy/Adventure/Sci-Fi/Fantasy<br>
                <b style="color: #fcbf01; font-weight: bolder; text-shadow: 2px black;">SYNOPSIS: </b>Jennifer Walters navigates the complicated life of a single, <br> 30-something attorney who 
                                                                                        also happens to be a green 6-foot-7-inch <br> superpowered hulk. <br>
              </p>

              <div class="slider-btn">
                <a href="#videotrailer4" class="button2 more" id="videolink4"><i class="fas fa-play-circle" aria-hidden="true">&nbsp;</i> Trailer</a>
                <div id="videotrailer4" class="mfp-hide" style="max-width: 75%; margin: 0 auto;">
                  <iframe width="853" height="480" src="https://www.youtube.com/embed/u7JsKhI2An0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div> 
             </div>
            </div>
          </div>

          <!-- button -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>


     <!--end of navigation-->



    <!--Horror Movies -->
    <section class="container" id="popular">
      <div class="heading-cat">
        <h2 class="heading-title">Horror Movies</h2>
      </div>
    </section>

    <body>
      
      <header>
        <section class="container" id="horror-box">
        <div class="bx">
        <img src="movies/Horror_H.P.jpg" alt="H.P. Lovecraft's Witch House">
        <div class="content"></div>
        <h2 class="movie-title">H.P. Lovecraft's Witch House</h2>
       
      </div>
    </div>
  </div>
  <a href='horror-Witch House-detail.php'>
    <button class="detail-btn">
        Details
    </button>
  </a>
  </div>
  </section>

<section class="container" id="horror-box">
    <div class="bx">
      <img src="movies/Horror_Harbinger.jpg" alt="Harbinger">
      <div class="content"></div>
      <h2 class="movie-title">Harbinger</h2>
       
    </div>
  </div>
</div>
<a href='horror-harbinger-detail.php'>
  <button class="detail-btn">
      Details
  </button>
</a>
</div>
</section>

<section class="container" id="horror-box">
  <div class="bx">
    <img src="movies/Horror_HuntingSouls.jpg" alt="Hunting Souls">
    <div class="content"></div>
    <h2 class="movie-title">Hunting Souls</h2>
    
   
  </div>
  </div>
</div>
<a href='horror-huntingsoul-detail.php'>
  <button class="detail-btn">
      Details
  </button>
</a>
</div>
</section>


<section class="container" id="horror-box">
<div class="bx">
  <img src="movies/Horror_TheTwin.jpg" alt="The Twin">
  <div class="content"></div>
  <h2 class="movie-title">The Twin</h2>
 
</div>
</div>
</div>
<a href='horror-twin-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

<section class="container" id="horror-box">
  <div class="bx">
  <img src="movies/Horror_They.jpg" alt="They/Them">
  <div class="content"></div>
  <h2 class="movie-title">They/Them</h2>
   
    </div>   
    <a href='horror-theythem-detail.php'>
      <button class="detail-btn">
          Details
      </button>
    </a>
  </section>    
</header>
</body>

<!--End of Horror Movies -->

 <!--Action Movies -->
 <section class="container" id="popular">
  <div class="heading-cat">
    <h2 class="heading-title">Action Movies</h2>
  </div>
</section>
 
 
  <body>
    
    <header>
      <section class="container" id="action-box">
      <div class="bx">
      <img src="movies/Action_BlackPanther.jpg" alt="Black Panther Wakanda ">
      <div class="content"></div>
      <h2 class="movie-title">Black Panther Wakanda 
        Forever (2022) </h2>
      
      </div>
    </div>
    </div>
    <a href='action-blackpanther-detail.php'>
    <button class="detail-btn">
        Details
    </button>
    </a>
    </div>
    </section>
  
  <section class="container" id="action-box">
  <div class="bx">
    <img src="movies/Action_Minions.jpg" alt="Minions: The Rise of Gru">
    <div class="content"></div>
    <h2 class="movie-title"> Minions: The Rise of Gru</h2>
    
  </div>
</div>
</div>
<a href='action-minions-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

<section class="container" id="action-box">
<div class="bx">
  <img src="movies/Action_Pinocchio.png" alt="Pinocchio">
  <div class="content"></div>
  <h2 class="movie-title">Pinocchio</h2>
  
</div>
</div>
</div>
<a href='action-pinocchio-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

<section class="container" id="action-box">
<div class="bx">
<img src="movies/Action_SpiderMan.jpg" alt="Spider Man: No way Home">
<div class="content"></div>
<h2 class="movie-title">Spider Man: No way Home</h2>

</div>
</div>
</div>
<a href='action-spiderman-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

<section class="container" id="action-box">
<div class="bx">
<img src="movies/Action_TopGun.jpg" alt="Top Gun: Maverick">
<div class="content"></div>
<h2 class="movie-title">Top Gun: Maverick</h2>

</div>
</div>
</div>
<a href='action-topgun-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

    </header>
  </body>    
  
  
    <!--End of Action Movies -->


  <!--Romance Movies -->
  <section class="container" id="popular">
    <div class="heading-cat">
      <h2 class="heading-title">Romance Movies</h2>
    </div>
  </section>

  <body>
    
    <header>
      <section class="container" id="romance-box">
      <div class="bx">
      <img src="movies/Romance_AboutFate.jpg" alt="About Fate">
      <div class="content"></div>
      <h2 class="movie-title">About Fate</h2>
      
    </div>
  </div>
  </div>
  <a href='romance-aboutlove-detail.php'>
  <button class="detail-btn">
      Details
  </button>
  </a>
  </div>
  </section>
    
  <section class="container" id="action-box">
  <div class="bx">
    <img src="movies/Romance_AfterEverHappy.jpg" alt="After Ever Happy">
    <div class="content"></div>
    <h2 class="movie-title">After Ever Happy</h2>
    
  </div>
</div>
</div>
<a href='romance-everhappy-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

<section class="container" id="action-box">
<div class="bx">
  <img src="movies/Romance_DontBlameKarma.jpg" alt="Don't blame Karma">
  <div class="content"></div>
  <h2 class="movie-title">Don't blame Karma</h2>
  
</div>
</div>
</div>
<a href='romantic-dontblamethekarma-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

<section class="container" id="action-box">
<div class="bx">
<img src="movies/Romance_RedeemingLove.jpg" alt="Redeeming Love">
<div class="content"></div>
<h2 class="movie-title">Redeeming Love</h2>

</div>
</div>
</div>
<a href='romance-redeeminglove-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

<section class="container" id="action-box">
<div class="bx">
<img src="movies/Romance_FirstLove.jpg" alt="First Love">
<div class="content"></div>
<h2 class="movie-title">First Love</h2>



</div>
</div>
</div>
<a href='romance-firstlove-detail.php'>
<button class="detail-btn">
    Details
</button>
</a>
</div>
</section>

    </header>
  </body>    
       
  <!--Coming Soon End -->



   

<!--Footer-->
<footer class="page-footer">
  <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12">
          <h3 style="color: rgb(30, 29, 29);">Additional Information</h3>
          <p style="font-size: 20;">The Vision Films is one of the top movie ticketing company in the Philippines. It sell a movie ticket online.
            In addition, Vision Films ensures customer satisfaction and its safety as they watch movies</p>
          <ul class="list-unstyled list-inline">
              <li class="list-inline-item">
                  <a href="#" class="btn-floating btn-sm" style="font-size: 23px; color: rgb(30, 29, 29)"><i class="fab fa-facebook"></i></a>
              </li>
              <li class="list-inline-item">
                  <a href="#" class="btn-floating btn-sm" style="font-size: 23px; color:rgb(30, 29, 29)"><i class="fab fa-instagram"></i></a>
              </li>
              <li class="list-inline-item">
                  <a href="#" class="btn-floating btn-sm" style="font-size: 23px; color:rgb(30, 29, 29)"><i class="fab fa-twitter"></i></a>
              </li>
              <li class="list-inline-item">
                  <a href="#" class="btn-floating btn-sm" style="font-size: 23px; color:rgb(30, 29, 29)"><i class="fab fa-youtube"></i></a>
              </li>
          </ul>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12">
          <h3 style="color: rgb(30, 29, 29);">Contacts</h3>
          <p style="font-size: 20;"><i class="fa fa-envelope" aria-hidden="true" ></i>
              visionfilms@gmail.com
              <br/><i class="fa fa-phone" aria-hidden="true"></i> (02) 8911 0964
          </p>
      </div>
</footer>
<!--end of Footer-->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<script src="comingsoon.js"></script>


<!--end of Footer-->

        <!-- Bootstrap core JS-->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
 
 <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
</html>