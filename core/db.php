<?php

class db{
	
	private $hostName = 'localhost';
	private $userName = 'root';
	private $pass = '';
	private $dbName = 'ders_db';
	public  $sql='';
	public  $connection;
	
	function __construct(){
		$this->connection = mysqli_connect($this->hostName, $this->userName, $this->pass, $this->dbName);
		mysqli_set_charset($this->connection,"utf8");
		if(!$this->connection){
			die("Hata".mysqli_connect_error());
		}
	}
	
	function select($columName=null){
		$this->sql = "select ";
		if($columName==null){
			$this->sql .= " * ";
		}else{
			for($i=0; $i<count($columName); $i++){
				$this->sql .= " ".$columName[$i].",";
			}
		}
		$this->sql = substr($this->sql, 0,-1);
	}
	function from($tableName){
		$this->sql .= ' from '.$tableName;
		
	}
	//where "email=? and pass=?"
	function where($string, $param){
		$stringParts = explode("?", $string);
		$where = ' where ';
		for($i=0; $i<count($param); $i++){
			$where .= $stringParts[$i]."'".$param[$i]."' ";
		}
		$this->sql .= $where."";
	
	}
	function insert($columName, $tableName){
		$this->sql = " INSERT INTO ".$tableName." (";
		$field = "";
		$values = "";
		foreach($columName as $fieldName => $value){
			$field .= $fieldName.", ";
			$values .= "'".$value."', ";
		}
		$field = substr($field, 0,-2);
		$values = substr($values, 0,-2);
		$this->sql .= $field.") VALUES (".$values.")";
	}
	function delete($tableName){
		$this->sql .= "DELETE  FROM ".$tableName." ";
	}
	function update($dizi, $tableName){
		$this->sql = " UPDATE ".$tableName." SET ";
		foreach($dizi as $colum => $value){
			$this->sql .= $colum."= '".$value."'  ,";
			
		}
		$this->sql = substr($this->sql, 0,-1);
	}
	
	function query(){
		return mysqli_query($this->connection, $this->sql);
		
	}
	
	function fetchAll(){
		$result = $this->query();
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
	
	function fetchOneArray(){
		$result = $this->query();
		return mysqli_fetch_assoc($result);
	}
	
	function setSql($sorgu){
		$this->sql = $sorgu;
		
	}
}
/*$db = new db();
$sql = "SELECT * FROM tbl_user WHERE title LIKE  ' %b% ' or content LIKE ' %b%' ";
$db->setSql($sql);
//return $db->query();
echo $db->sql;*/

?>




