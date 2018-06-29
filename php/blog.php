<?php 
session_start();
if(!$_SESSION['login_user']){
	header("location:index.php");
}
$user=$_SESSION['login_user'];
$mysqli=new mysqli('localhost','gopi','kalyan','task');
$query="SELECT * FROM register WHERE email='$user' ";
$result=mysqli_query($mysqli,$query);
if($result!=0){
	while($row=mysqli_fetch_assoc($result)){
		$name=$row['username'];
		$pro_img=$row['image'];
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<style type="text/css">
	.navbar{
	background-color: #2c3e50 !important;
	}
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
        <div class="navbar-header">

         <a class="navbar-brand"><img src='<?php echo $pro_img; ?>' width="50" height="50"><span style="color:red;"><?php echo $name ?></span></a>
        
       	<ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Logout</a></li>
            <li><a href="post.php">Post</a></li>
            
        </ul>
        </div>
      </div>
	</nav>
	


	<div class=container>
		<div class="col-md-4">
			<?php 
				$sql="SELECT * FROM posts";
				$Post_result=mysqli_query($mysqli,$sql);
				if($Post_result!=0){
					while($postrow=mysqli_fetch_assoc($Post_result)){
						$Upimage=$postrow['upimage'];
						$post_matter=$postrow['matter'];
					}
				}
			?>
		<img src="<?php echo $Upimage; ?>" class="img-responsive">
		<p><?php echo $post_matter?></p> 
		</div>
	</div>
</body>
</html>