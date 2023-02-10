<?php
session_start();
Class Action {
	private $db;

	public function __construct() {
   	include 'config.php';

	
if (!isset($_SESSION['admin_name'])){
    header('location:../guest_index.html');
}
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			// var_dump($_SESSION);
			return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../guest_index.html");
	}


	function save_movie(){
		extract($_POST);
		$data = " title= '".$title."' ";
	
		$data .= ", date_showing = '".$date_showing."' ";
		$data .= ", end_date = '".$end_date."' ";
	

		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/img/'. $fname);
			$data .= ", cover_img = '".$fname."' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO movies set ". $data);
			if($save)
				return 1;
		}else{
			$save = $this->db->query("UPDATE movies set ". $data." where id =".$id);
			if($save)
				return 1;
		}
	}


	function delete_movie(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM movies where id =".$id);
		if($delete)
			return 1;
	}



	function delete_vaccine(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM tb_upload where id =".$id);
		if($delete)
			return 1;
	}


	function delete_payment(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM orders where id =".$id);
		if($delete)
			return 1;
	}

	
	function delete_accounts(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM user_form where id =".$id);
		if($delete)
			return 1;
	}




}