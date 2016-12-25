<?php
	class blogController{
		
		function blog(){
				b:: template("default","blog/blog");
		}
		
		
		function createBlog(){
			b:: template("default","blog/blogAdd");
		}
		
		function save(){
			$title = $_POST['title']; 
			$content = $_POST['topic']; 
			$tags = $_POST['tags']; 
			$category_id = $_POST['category_id']; 
			$model = new blogModel();
			$result =$model->saveBlog($title,$content,$tags,$category_id);
			echo json_encode($result);
		}
		
		function getBlogList(){
			$model = new blogModel();
			$result = $model->listBlog();
			echo json_encode($result);
			//print_r($result);
		}
		
		function delete(){
			$blog_id = $_POST['blog_id'];
			$model = new blogModel();
			$result = $model->deleteBlog($blog_id);
			echo json_encode($result);
		}
		function blogEdit(){
			b:: template("default","blog/blogEdit");
		}
		function edit(){
			$blog_id= $_POST['blog_id'];
			$model = new blogModel();
			$result = $model->editBlog($blog_id);
			echo json_encode($result);
		}
		function update(){
			$title = $_POST['title'];	
			$content = $_POST['content'];
			$tags = $_POST['tags'];
			$category_id = $_POST['category_id']; 
			$blog_id = $_POST['blog_id'];
			$model = new blogModel();
			$result = $model->updateBlog($title,$content, $tags,$category_id, $blog_id);
			echo json_encode($result);
			}
			
			function search(){
			$params = $_POST['search'];
			$model = new blogModel();
			$result = $model->searchBlog($params);
			echo json_encode($result);
			
		}
			
	}
?>