<?php
require 'config.php';



if (!isset($_SESSION['admin_name'])){
    header('location:../guest_index.html');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
  </head>
  <body>
    <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Contact</td>
        <td>Payment mode</td>
        <td>Movie  and ticket</td>
        <td>Reference#</td>
        <td>Price</td>
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo $row["phone"]; ?></td>
        <td><?php echo $row["pmode"]; ?></td>
        <td><?php echo $row["products"]; ?></td>
        <td><?php echo $row["reference"]; ?></td>
        <td><?php echo $row["amount_paid"]; ?></td>
       
     
        <td>
						 		<center>
								 <button  style="background-color:#E55451; border-radius: 25px;" > <a style="color: white;  " class=" delete_payment" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete </a> </button> 
								</center>
						 	</td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
  
<script>
	
	
	$('.delete_payment').click(function(){
		_conf('Are you sure to delete this data?','delete_payment' , [$(this).attr('data-id')])
	})

	function delete_payment($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_payment',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully deleted",'success');
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}


</script>
  </body>
</html>
