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
        <td>Image</td>
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM tb_upload ORDER BY id DESC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td> <img src="img/<?php echo $row["image"]; ?>" width = 750 title="<?php echo $row['image']; ?>"> </td>
        <td>
						 		<center>
								 <button  style="background-color:#E55451; border-radius: 25px;" > <a style="color: white;  " class=" delete_vaccine" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete </a> </button> 
								</center>
						 	</td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
  
<script>
	
	
	$('.delete_vaccine').click(function(){
		_conf('Are you sure to delete this data?','delete_vaccine' , [$(this).attr('data-id')])
	})

	function delete_vaccine($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_vaccine',
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