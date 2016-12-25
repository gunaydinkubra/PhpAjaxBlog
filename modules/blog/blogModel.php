<?php
	class blogModel{
		
		function saveBlog($title,$content,$tags,$category_id){
			$db = new db();
			$db->insert(array("title"=>$title, "content"=>$content, "tags"=>$tags, "category_id"=>$category_id),"tbl_blog");
			return $db->query();
		}
		
		function listBlog(){
			$db = new db();
			$db->select();
			$db->from("tbl_blog");
			return $db->fetchAll();
		}
		
		function deleteBlog($blog_id){
			$db = new db();
			$db->delete("tbl_blog");
			$db->where("blog_id=?", array($blog_id));
			return $db->query();
		}
		
		function editBlog($blog_id){
			$db = new db();
			$db->select();
			$db->from("tbl_blog");
			$db->where("blog_id=?", array($blog_id));
			return $db->fetchOneArray();
		}
		function updateBlog($title,$content, $tags,$category_id, $blog_id){
			$db = new db();
			$db->update(array("title"=>$title, "content"=>$content, "tags"=>$tags, "category_id"=>$category_id),"tbl_blog");
			$db->where("blog_id=?", array($blog_id));
			return $db->query();
		}
		
		function searchBlog($params){
			$db = new db();
			$sql = "SELECT * FROM tbl_blog WHERE title LIKE '%".$params."%' or content LIKE '%".$params."%'";
			$db->setSql($sql);
			return $db->fetchAll();
		}
	}
?>