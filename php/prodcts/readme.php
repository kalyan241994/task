<?php 
header("Acess-Control-Allow-Origin: * ");
header("Content_Type:application/json;charset=UTF-8");


include_once '../config/db.php';
include_once '../objects/products.php';

$database =new database();
$db=$database->connection();


$post = new  Post($db);

$smt=$post->readAll();
$num=$smt->rowCount();


if($num>0){
	$data="";
	$x=1;

	while($row=$smt->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$data .='{';
		$data .='"id":"'.$id.'",';
		$data .='"upimage":"'.$upimage.'",';
		$data .='"email":"'.$email.'",';
		$data .='"matter":"'.html_entity_decode($matter).'",';
		$data .='"timestamp":"' .$timestamp.'",';
		$data .='}';

		$data .= $x<$num ? ',':'';
		$x++;
	}
	echo($data);
}

?>