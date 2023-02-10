	<?php  //output checkout
	// Checkout and save customer info in the orders table
		// Checkout and save customer info in the orders table
		require 'admin/config.php';
		session_start();


       



		if (!isset($_SESSION['user_name'])){
			header('location:guest_index.html');
		}
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $pmode = $_POST['pmode'];

	  $reference= $_POST['reference'];
	  $data = '';

	  $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,pmode,products,amount_paid,reference)VALUES(?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssss',$name,$email,$phone,$pmode,$products,$grand_total,$reference);
	  $stmt->execute();
	  $stmt2 = $conn->prepare('DELETE FROM cart');
	  $stmt2->execute();
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-white">Thank You!</h1>
								<h2 class="text-white">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-warning rounded p-2">Items Purchased : ' . $products . '</h4>
								<h4 class =" text-white">Your Name : ' . $name . '</h4>
								<h4 class =" text-white"> Your E-mail : ' . $email . '</h4>
								<h4 class =" text-white">Your Phone : ' . $phone . '</h4>
								<h4 class =" text-white">Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								<h4 class =" text-white">Payment Mode : ' . $pmode . '</h4>
								<h4 class =" text-white">Reference number : ' . $reference . '</h4>
				
								</div>';
								
	  echo $data;
	}
	  ?>
 

