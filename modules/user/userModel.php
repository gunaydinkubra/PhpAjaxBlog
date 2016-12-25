<?php
	class userModel{
		
		function checkUser($email,$pass){
			$db = new db();
			$db->select();
			$db->from("tbl_user");
			$db->where("email=? and pass=?",array($email,$pass));
			return $db->fetchOneArray();
			
		}
		function saveUser($email,$pass,$name,$surname){
			$db = new db();
			$db->insert(array("email"=>$email, "pass"=>$pass, "name"=>$name, "surname"=>$surname),"tbl_user");
			return $db->query();
		}
		function listUser(){
			$db = new db();
			$db->select();
			$db->from("tbl_user");
			return $db->fetchAll();
		}
		function deleteUser($user_id){
			$db = new db();
			$db->delete("tbl_user");
			$db->where("user_id=?", array($user_id));
			return $db->query();
		}
		function editUser($user_id){
			$db = new db();
			$db->select();
			$db->from("tbl_user");
			$db->where("user_id=?",array($user_id));
			return $db->fetchOneArray();
		}
		function updateUser($user_id, $name, $surname, $pass, $email){
			$db = new db();
			$db->update(array("name" => $name, "surname"=>$surname, "pass"=>$pass, "email"=>$email),"tbl_user");
			$db->where("user_id=?", array($user_id));
			return $db->query();
		}
		function searchUser($params){
			$db = new db();
			$sql = "SELECT * FROM tbl_user WHERE name LIKE '%".$params."%' or surname LIKE '%".$params."%'";
			$db->setSql($sql);
			return $db->fetchAll();
		}
	}
	
?>