<form class="form-horizontal" id="category">
	<!--<input type="hidden" id="category_id" name="category_id"/>-->
	<div class="col-md-4 col-md-offset-4">
		<label class="control-label">Kategori Ekle</label><br><br>
		<input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Category"><br>
		<button type="submit" class="btn btn-default" id="update">Update</button>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		var id = <?php echo $_GET['category_id']; ?>;
		//console.log(id);
		$.ajax({
			url:"?op=category-edit",
			dataType:"json",
			type:"POST",
			data:{category_id:id},
			success:function(data){
				console.log(data);
				$('#categoryName').val(data['category_name']);
			},
		});
		
		$('#update').click(function(e){
			e.preventDefault();
			$.ajax({
				url:"?op=category-update",
				dataType:"json",
				type:"POST",
				data:{
					category_name: $('#categoryName').val(),
					category_id:id,
					},
				success:function(data){
					//console.log($('#categoryName').val());
					if(data !=0 ){
						alert("Kayıt Güncellendi");
						window.location ="?op=category-category";
					}else{
						alert("İşlem Başarısız");
					}
				},
			});
			
		});
		return false;
	});
</script>