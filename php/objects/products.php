<?php 
	class Post{
		private $conn;
		private $table_name="posts";

		public $id;
		public $upimage;
		public $email;
		public $matter;
		public $timestamp;


		public function __construct($db){
			$this->conn=$db;
		}
		function readAll(){
			$query="SELECT c.email as email ,p.id,p.upimage,p.email,p.matter,p.timestamp FROM".$this->table_name."p
			LEFT JOIN
			register c
			ON p.email=c.email
			ORDER BY
			p.created DESC";

			$smt=$this->conn->prepare($query);
			$smt->execute();
			return $smt;
		}
	}



?>