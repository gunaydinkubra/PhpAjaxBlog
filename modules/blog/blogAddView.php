<form name="saveBlog" id="saveBlog" >
	<div class="col-md-12 col-md-offset-2">
		<h2 class="lbl-color">Blog Oluştur</h2>
	</div>
	<div class="col-md-6 col-md-offset-2">
		<label class="control-label lbl-color">Başlık</label>
		<input class="form-control" type="text" name="title" id="title" />
		<label class="control-label lbl-color">İçerik</label>
		<textarea class="form-control" name="content"  cols="70" rows="30" id="topic" ></textarea><br>
		<div id ="category">
			<label class="control-label ">Kategori</label>
		</div><br>
		<input class="btn btn-md btn-default" type="submit" id="save" value="Save"/>
		<input class="btn btn-md btn-default" type="submit" id="publis" value="Publish"/>
	</div>
	<div class="col-lg-1 col-md-1 col-sm-1"></div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<label class="control-label">Tags Space</label>
		<textarea class="form-control" name="tags" cols="30" rows="15" id="tags"></textarea>
	</div>
</form>

<script type="text/javascript">

	$(document).ready(function(){
		$.ajax({
			url:"?op=category-getCategoryList",
			dataType:"json",
			type:"POST",
			success:function(data){
				if(data.length>0){
					var content = '<select class="form-control" id="category_id" name="category_id">';
					content += '<option value ="0" >Seçiniz</option>';
					for(var i=0; i<data.length; i++){
						content += '<option class="option" id="'+data[i]['category_id']+'" value="'+ data[i]['category_id'] +'">' + data[i]['category_name'] + '</option>';	
					}
				content += '</select>';
				
				$('#category').html(content);
				//console.log(data);
				}
			},
		});

		$('#save').click(function(e){
				e.preventDefault();
				var title = $('#title').val();
				var topic = $('#topic').val();
				var tags = $('#tags').val();
				var category_id = $('#category_id option:selected').val();
				if( title.length > 15){
					if(topic.length < 100){
						if(tags.length < 50){
							if(category_id != 0){
								$.ajax({
									url: "?op=blog-save",
									type: "POST",
									dataType: "json",
									data:{
										title:      $('#title').val(),
										topic :     $('#topic').val(),
										tags:       $('#tags').val(),
										category_id:$('#category_id option:selected').val(),
										},
										success: function(data){
											 console.log(data);
											if(data != 0 ){
												 alert("Kayıt İşlemi Başarılı..");
												 window.location = "?op=blog-blog";
											}else{
											alert("Kayıt İşlemi Başarısız..")
											}
										},
								});
							}else{
								alert("Kategori seçimi zorunludur...");
								//document.saveBlog.category_id.focus();
								return false;	
								}
						}else{
							alert("Tag 50 karakterden fazla olamaz..");
							document.saveBlog.tags.focus();
							return false;	
						}
					}else{
						alert("İçerik 100 karakterden fazla olamaz..");
						document.saveBlog.topic.focus();
						return false;
					}
				}else{
					alert("Title Uzunluğu Uygun Değil");
					document.saveBlog.title.focus();
					return false;
				}
		});
		return false;
	});
</script>
