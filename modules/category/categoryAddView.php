<form class="form-horizontal" id="category" name="category">
	<div class="col-md-4 col-md-offset-4">
		<label class="control-label">Kategori Ekle</label><br><br>
		<input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Category"><br>
		<button type="submit" class="btn btn-default" >Kaydet</button>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#category').submit(function(e){
			e.preventDefault();	
			var categoryName = $('#categoryName').val();
			if(categoryName.length != 0){
				$.ajax({
					url: "?op=category-save",
					type: "POST",
					dataType: "json",
					data:{
						category_name: $('#categoryName').val(),
					},
					success: function(data){
						if(data != 0 ){
							alert("Kayıt Oluşturuldu");
							window.location = "?op=category-category";	
						}else{
							alert("İşlem Başarısız");
							//console.log(data);
						}
					},
				});
				
			}else{
				alert("Kategori ismi Boş Geçilemez");
				document.category.categoryName.focus();
				return false;
			}
			
		});
		return false;
		
	});
</script>