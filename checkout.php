<?php
	require 'admin/config.php';

  session_start();

if (!isset($_SESSION['user_name'])){
    header('location:guest_index.html');
}
  
 $reference = uniqid();
 
	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(name, '(',quantity,')') AS ItemQty, price FROM cart";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['price'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);

   ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/png" href="assets/logos/icon.png">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

  
  <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
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
              
                        <?php

                        $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                        $row_count = mysqli_num_rows($select_rows);

                        ?>
                       
                   <li class="nav-item">
               <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                     </li>
              
                  <!---Modadl--->
                <li class="nav-item">
                    <a class="nav-link" style="font-weight: bolder;" href="logout_user.php"><span class='icon-field'><i class="fa fa-power-off"></i></span> LOGOUT</a>
                </li>
            </ul>
        </div>
    </nav>



  <div style="padding-top: 200px;"class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4   class="text-center text-warning  text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">

        <h6 class="lead"><b>Movies(tickets) : </b></h6>
        <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                    $total = 0;
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = number_format($fetch_cart['price']) * number_format($fetch_cart['quantity']);
                            $grand_total = $total += $total_price;
                    ?>
                            <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                    <?php
                        }
                    } else {
                        echo "<div class='display-order'><span>your cart is empty!</span></div>";
                    }
                    ?>

          <h5><b>Total Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
        </div>


        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <input type="hidden" name="reference" value="<?= $reference; ?>">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
          </div>
         
          <h6 class="text-center lead text-white">Select Payment Mode</h6>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="netbanking">Net Banking</option>
              <option value="cards">Debit/Credit Card</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>

</body>

</html>