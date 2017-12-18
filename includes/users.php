<?php
require_once('database.php'); 
class user {

	public function all_users() {
          if(isset($_GET['offset'])){
	            $offset = $_GET['offset'];
	          }else{
	            $offset = 0;
          }
		$data = new Db_connect();
		$query = $data->My_query("SELECT * FROM users LIMIT 10 offset $offset");
		$names = array();
		while ($me = $data->fetch_array($query)) {
			$names[] = $me;
		}
		return $names;
	}
	public function user_by_id($id) {
		$data = new Db_connect();
		$result = $data-> My_query("SELECT * FROM users WHERE id = $id");
		$users = $data-> fetch_assoc($result);
		return $users;
	}
	public function register_user() {
		$data = new Db_connect();
		if (isset($_POST['submit'])) {
		$first = $_POST['first'];
		$last = $_POST['last'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = sha1($_POST['password']);
		$query = $data->My_query("INSERT INTO users(first,last,phone,email,password) VALUES ('$first','$last','$phone','$email','$password')");		}
	}
	public function count_all() {
		$data = new Db_connect();
		$query = $data->My_query("SELECT id FROM users");
		$total = $data ->num_rows($query);
		return $total;
	}
	public function edit_user() {
			$data = new Db_connect();
	  	if (isset($_GET['id'])) {
	  		$id=$_GET['id'];
	  		$query = $data->My_query("SELECT * FROM users WHERE id='$id' LIMIT 1");
	  		$users=array(); 
	  		while ($me = $data->fetch_array($query)) {
	  			$users[] = $me;
	  		}
	  	}
	  	//updating our user...
	  	if (isset($_POST['saved'])) {
	    $first=$_POST['first'];
	    $last=$_POST['last'];
	    $phone=$_POST['phone'];
	    $email=$_POST['email'];
	    $password=SHA1($_POST['password']);
	    $id=$_POST['id'];
	    $query =$data->My_query("UPDATE users SET first='$first',last='$last',phone='$phone',email='$email',password='$password' WHERE id={$id}");
	  	if ($query) {
	  		header("location: index.php?page=Users");
	  	}else{
	  		echo "User not updated";
	  	}
	 }
	 return $users;
}
	public function delete_user() {
		$data = new Db_connect();
		$id = $_GET['id'];
		$query = $data->My_query("DELETE FROM users WHERE id = $id");
		if ($query) {
			header("location: index.php?page=users");
			exit();
		}else{
			echo "Error on deleting user";
		}
	}
}
 ?>