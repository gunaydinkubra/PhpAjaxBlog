<?php

	class categoryController{
		
		function category(){
				b:: template("default","category/category");
		}
		
		function createCategory(){
			b:: template("default","category/categoryAdd");
		}
		
		function save(){ 
			$category_name = $_POST['category_name']; 
			$model = new categoryModel();
			$result =$model->saveCategory($category_name);
			echo json_encode($result);
		}
		
		function getCategoryList(){
			$model = new categoryModel();
			$result = $model->listCategory();
			echo json_encode($result);
			//print_r($result);
		}
		
		function delete(){
			$category_id = $_POST['category_id'];
			$model = new categoryModel();
			$result = $model->deleteCategory($category_id);
			echo json_encode($result);
		}
		function categoryEdit(){
			b::template("default","category/categoryEdit");
		}
		
		function edit(){
			$category_id = $_POST['category_id'];
			$model = new categoryModel();
			$result = $model->editCategory($category_id);
			echo json_encode($result);
			
		}
		function update(){
			$category_id = $_POST['category_id'];
			$category_name = $_POST['category_name'];
			$model = new categoryModel();
			$result = $model->updateCategory($category_id, $category_name);
			echo json_encode($result);
		}
		
		function search(){
			$params = $_POST['search'];
			$model = new categoryModel();
			$result = $model->searchCategory($params);
			echo json_encode($result);
			
		}
	}
	
	
?>