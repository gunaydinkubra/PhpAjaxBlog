<?php
	class b{
		
		static function request(){
			if(!isset($_GET['op']) || $_GET['op']==""  ){
				$modul = 'user';
				$function = 'login';
				
			}else{
				$operation = $_GET['op'];
				$link = explode("-", $operation);
				$modul = $link[0];
				$function = $link[1];
			}
			b::getModul($modul);
			$controller = $modul."Controller";
			$newController = new $controller();
			if( $function == 'login' || $function == 'check'|| $function == 'logout'){
				$newController->$function();
			}elseif(session::checkLogin()==1){
				$newController->$function();
			}else 
				b::template("login", "user/userLogin");
		
		}
		static function getModul($modulName){
			include 'modules/'.$modulName.'/'.$modulName.'Controller.php';
			include 'modules/'.$modulName.'/'.$modulName.'Model.php';
		}
		static function template($template,$path, $data=null){
			include 'template/'.$template.'/header.php';
			include 'modules/'.$path.'View.php';
			include 'template/'.$template.'/footter.php';
		}
	}
?>