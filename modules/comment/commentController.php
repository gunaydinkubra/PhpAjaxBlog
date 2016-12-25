<?php
	class commentController{
		
		function comment(){
			b::template("default", "comment/comment");
		}
		function getCommentList(){
			$model = new commentModel();
			$result = $model->listComment();
			echo json_encode($result);
		}
		function createComment(){
			b::template("default", "comment/commentAdd");
		}
		function save(){
			$content = $_POST['content'];
			$model = new commentModel();
			$result = $model->saveComment($content);
			echo json_encode($result);
		}
		
		function delete(){
			$comment_id = $_POST['comment_id'];
			$model = new commentModel();
			$result = $model->deleteComment($comment_id);
			echo json_encode($result);
		}
		function commentEdit(){
			b::template("default","comment/commentEdit");
		}
		function edit(){
			$comment_id = $_POST['comment_id'];
			$model = new commentModel();
			$result = $model->editComment($comment_id);
			echo json_encode($result);
			
		}
		function update(){
			$comment_id = $_POST['comment_id'];
			$content = $_POST['content'];;
			$model = new commentModel();
			$result = $model->updateComment($comment_id, $content);
			echo json_encode($result);
		}
		
		function search(){
			$params = $_POST['search'];
			$model = new commentModel();
			$result = $model->searchComment($params);
			echo json_encode($result);
			
		}
		
	}


?>