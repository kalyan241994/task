<?php 
class database{
	private $host="localhost";
	private $db_name="task";
	private $username="gopi";
	private $password="kalyan";
	public $conn;

	public function connection(){
		$this->conn=null;
		try{
			$this->conn= new PDO("mysql:host".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
			$this->conn->exec(" set name utf8 ");
		}catch(PDOException $exceptionValue){
			echo "Connection Error:".$exceptionValue->getMessage();
		}
		return $this->conn;
	}

}


?>