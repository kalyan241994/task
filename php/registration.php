<?php 

$_SESSION['message']='';
$mysqli= new mysqli('localhost','gopi','kalyan','task');

if($_SERVER['REQUEST_METHOD']=='POST'){
	if($_POST['password']==$_POST['retype_pass']){
		// print_r($_FILES);
		$username=$mysqli->real_escape_string($_POST['username']);
		$Email=$mysqli->real_escape_string($_POST['email']);
		$password=md5($_POST['password']);
		$retype_password=md5($_POST['retype_pass']);
		$image=$mysqli->real_escape_string('image/'.$_FILES['image']['name']);

		if(preg_match("!image!",$_FILES['image']['type'])){

			if(copy($_FILES['image']['tmp_name'],$image)){
				$_SESSION['username']=$username;
				$_SESSION['image']=$image;
				$_SESSION['email']=$email;
				$sql="INSERT INTO register (username,email,password,password2,image) VALUES('$username','$Email','$password','$retype_password','$image')";

				if($mysqli->query($sql)===true){
					$_SESSION['message']="Regiration is successful";
					session_start();
					$_SESSION['login_user']=$email;
					header("location:blog.php");
				}else{
					$_SESSION['message']="Regiration is not successfull";
				}
			}else{
				$_SESSION['message']="Failed to upload image";
			}
		}else{
			$_SESSION['message']="Please select jpeg,png";
		}
	}else{
		$_SESSION["message"]="password doesnot match";
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
	<div class="container">
		<div class="register-card">
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<div class="alert alert-danger" role="alert"><?= $_SESSION['message']; ?></div>
					<label>Username</label>
					<input type="text" class="form-control" name="username" placeholder="username">
					<label>Email</label>
					<input type="text" name="email" class="form-control" placeholder="email">
					<label>password</label>
					<input type="password" name="password" class="form-control" placeholder="password">
					<label>Retype-password</label>
					<input type="password" name="retype_pass" class="form-control" placeholder="retype-password">
					<label>Profile image</label><br>
					<input type="file" name="image"><br>
					<input type="submit" value="register" class="form-control btn-success">	
				</div>
			</form>
		</div>
	</div>
</body>
</html>