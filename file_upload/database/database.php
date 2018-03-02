<?php
	class database{
		public $server = DB_HOST;
		public $user   = DB_USER;
		public $pass   = DB_PASS;
		public $dbname = DB_NAME;

		public $link;
		public $error;

		public function __construct(){
			$this->connection();
		}
		private function connection(){
			$this->link = new mysqli($this->server,$this->user,$this->pass,$this->dbname);
			if(!$this->link){	
				$this->error = "Connection Error ".$this->link->connect_error;
				return false;
			}
			
		}
		public function insert($qry){
			$insert = $this->link->query($qry) or die($this->link->error.__LINE__);
			if($insert){
				return $insert;
			}
			else{
				return false;
			}

		}
		public function select($qry){
			$result = $this->link->query($qry) or die($this->link->error.__LINE__);
			if ($result->num_rows > 0) {
				return $result;
			}
			else{
				return false;
			}
		}
		public function update($qry){
			$update = $this->link->query($qry) or die($this->kink->error.__LINE__);
			if($update){
				return $update;
			}
			else{
				return false;
			}
		}
		public function delete($qry){
			$delete = $link->query($qry) or die($this->link->error.__LINE__);
			if($delete){
				return $delete;
			}
			else{
				return false;
			}
		}

	}
	
?>