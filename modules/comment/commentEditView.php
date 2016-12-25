<form class="form-horizontal" id="comment">
	<div class="col-md-4 col-md-offset-4">
		<label class="control-label">Yorum Yaz</label><br><br>
		<input type="text" class="form-control" id="commentName" name="commentName" placeholder="Enter Comment"><br>
		<button type="submit" class="btn btn-default" id="update" >Update</button>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		var id = <?php echo $_GET['comment_id']; ?>;
		//console.log(id);
		$.ajax({
			url:"?op=comment-edit",
			dataType:"json",
			type:"POST",
			data:{comment_id:id},
			success:function(data){
				console.log(data);
				$('#commentName').val(data['content']);
			},
		});
		
		$('#update').click(function(e){
			e.preventDefault();
			$.ajax({
				url:"?op=comment-update",
				dataType:"json",
				type:"POST",
				data:{
					content: $('#commentName').val(),
					comment_id:id,
					},
				success:function(data){
					//console.log($('#categoryName').val());
					if(data !=0 ){
						alert("Kayıt Güncellendi");
						window.location ="?op=comment-comment";
					}else{
						alert("iŞlem BaŞarısız");
					}
				},
			});
			
		});
		return false;
	});
</script>