<?php 
  include 'admin/config.php';



if (!isset($_SESSION['user_name'])){
    header('location:guest_index.html');
}
  $movies = $conn->query("SELECT * FROM movies where '".date('Y-m-d')."' BETWEEN date(date_showing) and date(end_date) order by rand() limit 10");
?>

     
                 <center><h3 class="text" style="font-size: 4rem; font-weight: bolder; color: #fcbf01; 
                 text-shadow: 2px 3px black; text-indent: 20px; margin-top: 50px;">AVAILABLE MOVIES</h3></center>

<div id="movie-carousel-field" style="margin-top: 60px;">

  <div class="list-prev list-nav">
    <a href="javascript:void(0)" class="text"><i class="fa fa-angle-left" style="color: #fcbf01; text-shadow: 2px 3px black;"></i></a>
  </div>
  <div class="list">
    <?php while($row=$movies->fetch_assoc()): ?>
        <div class="movie-item">
          <img class="" src="assets/img/<?php echo $row['cover_img']  ?>" alt="<?php echo $row['title'] ?>" >
          <div class="mov-det">
         

            
          </div>
        </div>
    <?php endwhile; ?>
  </div>
   <div class="list-next list-nav">
    <a href="javascript:void(0)" class="text"><i class="fa fa-angle-right" style="color: #fcbf01; text-shadow: 2px 3px black;"></i></a>
  </div>
</div>

<script>
  
  $('#movie-carousel-field .list-next').click(function(){
    $('#movie-carousel-field .list').animate({
    scrollLeft:$('#movie-carousel-field .list').scrollLeft() + ($('#movie-carousel-field .list').find('img').width() * 3)
   }, 'slow');
  })
  $('#movie-carousel-field .list-prev').click(function(){
    $('#movie-carousel-field .list').animate({
    scrollLeft:$('#movie-carousel-field .list').scrollLeft() - ($('#movie-carousel-field .list').find('img').width() * 3)
   }, 'slow');
  })
  $('.mov-det button').click(function(){
    location.replace('index.php?page=reserve&id='+$(this).attr('data-id'))
  })
</script>