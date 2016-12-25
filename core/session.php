<?php
	class session{
		static function set($params,$val){
			$_SESSION[$params]=$val;
		}
		static function get($param){
			return $_SESSION[$param];
		}
		static function checkLogin(){
			if(isset ($_SESSION['user'])) return 1;
			else return 0;
				
			
		}
	}
?>