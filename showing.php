<?php 
  include 'admin/config.php';

  session_start();

if (!isset($_SESSION['user_name'])){
    header('location:guest_index.html');
}
  $movies = $conn->query("SELECT * FROM movies where '".date('Y-m-d')."' BETWEEN date(date_showing) and date(end_date) order by rand()");
?>

<header class="masthead">
	<div class="container-fluid">	

                <center><h3 class="text" style="font-size: 4rem; font-weight: bolder; color: #fcbf01; 
                 text-shadow: 2px 3px black; text-indent: 20px; margin-top: 20px;">NOW SHOWING</h3></center>
  <br> <br>
    <div id="movies">	

	<?php while($row=$movies->fetch_assoc()): ?>
        <div class="movie-item">
          <img class="" src="assets/img/<?php echo $row['cover_img']  ?>" alt="<?php echo $row['title'] ?>" >
          <div class="mov-det">
            <button   style ="margin-top: 110px; margin-right: 33px; text-align: center; font-weight: bolder; "type="button" class="btn btn-warning" data-id="<?php echo $row['id'] ?>">BUY TICKET</button>
          </div>
        </div>
    <?php endwhile; ?>

	</div>

	</div>	
</header>
<script>
	$('.mov-det button').click(function(){
    location.replace('index.php?page=reserve&id='+$(this).attr('data-id'))
  })
</script>