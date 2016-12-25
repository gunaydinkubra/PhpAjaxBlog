<?php
	class commentModel{
		
		function listComment(){
			$db = new db();
			$db->select();
			$db->from("tbl_comment");
			return $db->fetchAll();
		}
		function saveComment($content){
			$db = new db();
			$db->insert(array("content"=>$content), "tbl_comment");
			return $db->query();
		}
		function deleteComment($comment_id){
			$db = new db();
			$db->delete("tbl_comment");
			$db->where("comment_id=?",array($comment_id));
			return $db->query();
		}
		
		function editComment($comment_id){
			$db = new db();
			$db->select();
			$db->from("tbl_comment");
			$db->where("comment_id=?",array($comment_id));
			return $db->fetchOneArray();
		}
		function updateComment($comment_id, $content){
			$db = new db();
			$db->update(array("content" => $content),"tbl_comment");
			$db->where("comment_id=?", array($comment_id));
			return $db->query();
		}
		
		function searchComment($params){
			$db = new db();
			$sql = "SELECT * FROM tbl_comment WHERE content LIKE '%".$params."%'";
			$db->setSql($sql);
			return $db->fetchAll();
		}
	}

?>