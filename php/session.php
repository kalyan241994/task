<?php
   
$servername = "localhost";
$username = "id5508109_gopi";
$password = "kalyan143";
$database="id5508109_epitychis";


$conn =mysqli_connect($servername, $username, $password,$database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	
}else{
	echo "connceted successfully";
}
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $user_id=$_SESSION['login_id'];
   
   $ses_sql = mysqli_query($conn,"select username from superuser where name = '$user_check' ");
	
  
//   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
//   $login_session = $row['name'];
   
   
   if(!isset($_SESSION['login_user'])){
      header("location:logincareeradmin.php");
   }
?>