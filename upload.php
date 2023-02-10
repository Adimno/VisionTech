<?php
require 'admin/config.php';

session_start();

if (!isset($_SESSION['user_name'])){
    header('location:guest_index.html');
}

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
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Upload Image File</title>
    </head>
    <body>

    <!-- modal form -->
      <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
    
        <label style="color:white;" for="name">Name : </label>
        <input type="text" name="name" id = "name" required value="" > <br>
        <label style="color:white;"  for="image">Image : </label>
        <input  style="color:white;" type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
        <button  type = "submit" name = "submit">Submit</button>
      </form>
    <!-- end of modal form -->
      <br>
      

<!-- Trigger/Open The Modal -->
<button id="myBtn">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
    
    <label  for="name"> Name : </label>
    <input type="text" name="name" id = "name" required value="" > <br>
    <label   for="image">Image : </label>
    <input   type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
    <button  type = "submit" name = "submit">Submit</button>
  </form>
  </div>

</div>
  

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

    </body>
  </html>