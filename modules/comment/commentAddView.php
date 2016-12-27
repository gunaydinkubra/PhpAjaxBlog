<form class="form-horizontal" name="comment" id="comment">
<div class="col-md-4 col-md-offset-4">
    <label class="control-label">Yorum Yaz</label><br><br>
    <input type="text" class="form-control" id="commentName" name="commentName" placeholder="Enter Comment"><br>
    <button type="submit" class="btn btn-default" >Kaydet</button>
</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#comment').submit(function(e){
			e.preventDefault();
			var content = $('#commentName').val();
			if(content.length !=0){
				$.ajax({
					url:"?op=comment-save",
					dataType:"json",
					type:"POST",
					data:{content: $('#commentName').val()},
					success: function(data){
						if(data != 0){
							alert("Kayıt Başarılı..");
							window.location = "?op=comment-comment";
						}else{
							alert("Kayıt Başarısız..");
						}
						
					}
				});
		
			}else{
				alert("Yorum alanı boş geçilemez");
				document.comment.commentName.focus();
				return false;
			}
		});	
		return false;
	});

</script>