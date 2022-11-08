<?php
$username=$email=$user_type=$password=$search="";
$id=$rowcount=0;
$update=false;
$db=new mysqli('localhost','root','','login_crud') or die (mysqli_error($mysqli));

//Delete records
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
	$db->query("DELETE FROM users WHERE id=$id") or die ($db->error());

	$_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: userslist.php");
}

//Edit
if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update=true;
	$result=$db->query("SELECT * FROM users WHERE id=$id") or die ($db->error());
	$row=$result->fetch_array();
	$username=$row['username'];
	$email=$row['email'];
	$password=$row['password'];
}

//Update
if(isset($_POST['update'])){
	$id = $_POST['id'];
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password = md5($password);
	$db->query("UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id") or die ($db->error());

	$_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: userslist.php");

}

?>