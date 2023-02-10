<?php
session_start();

if (!isset($_SESSION['admin_name'])){
    header('location:../guest_index.html');
}

?>
<nav class="navbar navbar-light fixed-top " style="background-color: #1c1a2e;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
	  	<div class="col-md-2 float-right">
	  		<a href="ajax.php?action=logout"><i class="fa fa-power-off"></i> <b style ="color: white;">ADMIN</b></a>
	    </div>
    </div>
  </div>
  
</nav>
