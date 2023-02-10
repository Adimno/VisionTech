
<?php include ('config.php') 


?>

<style>
	
</style>

<nav id="sidebar" class='mx-lt-5 bg-light' style="background-color: #1c1a2e !important;">
	<div class="container-fluid">
		
		<div class="sidebar-list">
				
				<a href="admin_index.php?page=payment" class="nav-item nav-payment"><span class='icon-field'><i ></i></span> Payments</a>
				<a href="admin_index.php?page=movielist" class="nav-item nav-movielist"><span class='icon-field'><i class="fa fa-film"></i></span> Movie List</a>
				<a href="admin_index.php?page=vaccine" class="nav-item nav-vaccine"><span class='icon-field'><i class="fa fa-plus-square"></i></span> Vaccine cards</a>
				<a href="admin_index.php?page=admin_create" class="nav-item nav-admin_create"><span class='icon-field'><i class="fa fa-registered"></i></span> Admin create</a>
				<a href="admin_index.php?page=accounts" class="nav-item nav-accounts"><span class='icon-field'><i class="fa fa-user-circle"></i></span> Accounts</a>
		</div>

	</div>
</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>