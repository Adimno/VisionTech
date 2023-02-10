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
        <td>Password</td>
        <td>User type</td>
  
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM user_form ORDER BY id DESC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo $row["password"]; ?></td>
        <td><?php echo $row["user_type"]; ?></td>

       
     
        <td>
						 		<center>
								 <button  style="background-color:#E55451; border-radius: 25px;" > <a style="color: white;  " class=" delete_accounts" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete </a> </button> 
								</center>
						 	</td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
  
<script>
	
	
	$('.delete_accounts').click(function(){
		_conf('Are you sure to delete this data?','delete_accounts' , [$(this).attr('data-id')])
	})

	function delete_accounts($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_accounts',
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
