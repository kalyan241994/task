<?php 
session_start();
if(!$_SESSION['login_user']){
	header("location:index.php");
}
$user=$_SESSION['login_user'];
$mysqli=new mysqli('localhost','gopi','kalyan','task');

if($_SERVER['REQUEST_METHOD']=='POST'){
	$upimage=$mysqli->real_escape_string('image/'.$_FILES['upimage']['name']);
	$email=$mysqli->real_escape_string($_POST['email']);
	$matter=$mysqli->real_escape_string($_POST['matter']);
	if(preg_match("!image!",$_FILES['upimage']['type'])){
		if(copy($_FILES['upimage']['tmp_name'],$upimage)){
			$sql="INSERT INTO posts(upimage,email,matter) VALUES ('$upimage','$email','$matter') ";
			if($mysqli->query($sql)===true){
				$_SESSION['message']="post is uploaded";
			}else{
				$_SESSION['message']="post is not uploaded";
			}
		}else{
			$_SESSION['message']="please select jpg or png";
		}
	}else{
		$_SESSION['message']="something is wrong";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>post</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
	<div class="container register-card">
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Image</label>
				<input type="file" class="form-control" name="upimage">
				<label>Email</label>
				<input type="text" class="form-control" name="email" value="<?php echo($_SESSION['login_user']) ?>">
				<label>Matter</label>
				<textarea class="form-control" name="matter"></textarea><br>
				<input type="submit" value="submit" class="form-control btn-success">
			</div>
		</form>	

	</div>
</body>
</html>

