<?php

$_SESSION['message']='';
$mysqli= new mysqli('localhost','gopi','kalyan','task');

if($_SERVER['REQUEST_METHOD']=='POST'){
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	if(empty($email)|| empty($password)){
		$_SESSION['message']="this feilds are required";
	}else{
		$sql="SELECT * FROM register WHERE email='$email' and password='$password'";
		$result=mysqli_query($mysqli,$sql);
		$rows=mysqli_num_rows($result);
		if($rows!=0){
			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
				$dbuser=$row['email'];
				$dbpassword=$row['password'];
			
			}
			if($email=$dbuser && $password=$dbpassword){
				session_start();
				// session_register("email");
				$_SESSION['email']="email";
				$_SESSION['login_user']=$dbuser;

				header("location:blog.php");
			}else{
				echo "invalid user";
			}
		}else{
			echo "string";
		}

	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
	<div class="login-card">
		<form method="post">
			<div class="form-group">
				<div class="alert alert-danger"><?= $_SESSION['message'] ?></div>
				<label>Email Address</label>
				<input type="text" name="email" class="form-control" placeholder="email">
				<label>Password</label>
				<input type="password" name="password" class="form-control" placeholder="password"><br>
				<input type="submit" class="form-control btn-success" value="signin"><br>
				<a href="registration.php">SignUp</a>
			</div>
		</form>
	</div>
</body>
</html>