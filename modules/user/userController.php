<?php
	class userController{
		
		function logout(){
			session_destroy();
			echo "Anasayfaya Yönlendiriliyorsunuz...";
			header('Refresh:1; url=index.php?op=user-login');
		}
		
		function login(){
			b:: template("login","user/userLogin");
		}
		function check(){
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			$model = new UserModel();
			$result = $model->checkUser($email, $pass);
			if( $result != null ){
				session::set("user",$result);
				
			}
			echo json_encode($result);
		}
		function user(){
			b::template("default","user/user");
		}
		function getUserList(){
			$model = new userModel();
			$result = $model->listUser();
			echo json_encode($result);
			//print_R($result);
		}
		function createUser(){
			b:: template("default","user/userAdd");
		}
		
		function save(){
			$email = $_POST['email']; 
			$pass = $_POST['pass']; 
			$name = $_POST['name']; 
			$surname = $_POST['surname']; 
			$model = new userModel();
			$result =$model->saveUser($email,$pass,$name,$surname);
			echo json_encode($result);
		}
		function delete(){
			$user_id = $_POST['user_id'];
			$model = new userModel();
			$result = $model->deleteUser($user_id);
			echo json_encode($result);
			
		}
		function userEdit(){
			b::template("default","user/userEdit");
		}
		function edit(){
			$user_id = $_POST['user_id'];
			$model = new userModel();
			$result = $model->editUser($user_id);
			echo json_encode($result);
			
		}
		function update(){
			$user_id = $_POST['user_id'];
			$email = $_POST['email']; 
			$pass = $_POST['pass']; 
			$name = $_POST['name']; 
			$surname = $_POST['surname']; 
			$model = new userModel();
			$result = $model->updateUser($user_id, $name, $surname, $pass, $email);
			echo json_encode($result);
		}
		
		function search(){
			$params = $_POST['search'];
			$model = new userModel();
			$result = $model->searchUser($params);
			echo json_encode($result);
			
		}
		
	}

?>