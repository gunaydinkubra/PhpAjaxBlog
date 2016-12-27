<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-10">
		<div class="col-md-3">
			<input type="text"  id="search" name="search" class="input-sm"  placeholder="Search"/>
			<button class=" btn btn-sm btn-default" id="searchbtn">Search</button>
		</div><br><br>
		
		<div class="responsive-table" id="bloglist">
		</div>
	</div>
	<div class="col-md-2" ></div>
</div>
<div id="editt"></div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: "?op=blog-getBlogList",
			type: "POST",
			dataType: "json",
			success:function(data){
				//if(data.length>0){
					var content = '<table class="table">';
					content += '<tr>';
					content += '<th>blog_id</th>';
					content += '<th>Title</th>';
					content += '<th>Content</th>';
					content += '<th>Tags</th>';
					content += '<th>Category_id</th>';
					content += '<th></th>';
					content += '<th><a href="?op=blog-createBlog"><button class="btn btn-md btn-default" ">New Blog</button></a></th>';
					content += '<th></th>';
					content += '</tr>';
					for(var i=0; i<data.length; i++){
						content += '<tr>';
						content += '<td id="id">' + data[i]['blog_id']+ '</td>';
						content += '<td>' + data[i]['title']+ '</td>';
						content += '<td>' + data[i]['content']+ '</td>';
						content += '<td>' + data[i]['tags']+ '</td>';
						content += '<td>' + data[i]['category_id']+ '</td>';
						content += '<td><button class="btn btn-xs btn-danger edit" id="' + data[i]['blog_id'] +'">Edit</button></td>';
						content += '<td><button class="btn btn-xs btn-danger delete"id="' + data[i]['blog_id'] +'">Delete</button></td>';
						content += '<td></td>';
						content += '</tr>';
						
					}
					$('#bloglist').html(content);
					//console.log(data)
					
				//}
			},
		});
		$(document).on('click','.delete',function(){
			var ID = $(this).attr("id");
			$.ajax({
				url:"?op=blog-delete",
				dataType:"json",
				type:"POST",
				data:{blog_id: ID},
				success:function(data){
					if(data !=0 ){
						alert("Kayıt Silindi..");
						window.location= "?op=blog-blog";
					}else{
						alert("Silme İşlemi Başarısız");
					}
				},
				
				
			});
		});
		
		$(document).on('click','.edit',function(){
			var ID = $(this).attr("id");
			window.location ="?op=blog-blogEdit&blog_id=" +ID;
		});
		
		$(document).on('click','#searchbtn',function(){
			//console.log("tıkk");
			var search = $('#search').val();
			if(search.length >= 3){
				$.ajax({
					url:  "?op=blog-search",
					type:  "POST",
					dataType: "json",
					data: {search: $('#search').val()
					},
					success:function(data){
						if(data.length > 0){
							var content = '<table class="table">';
							content += '<tr>';
							content += '<th>blog_id</th>';
							content += '<th>Title</th>';
							content += '<th>Content</th>';
							content += '<th>Tags</th>';
							content += '<th>Category_id</th>';
							content += '<th></th>';
							content += '<th><a href="?op=blog-createBlog"><button class="btn btn-md btn-default" ">New Blog</button></a></th>';
							content += '<th></th>';
							content += '</tr>';
							for(var i=0; i<data.length; i++){
								content += '<tr>';
								content += '<td id="id">' + data[i]['blog_id']+ '</td>';
								content += '<td>' + data[i]['title']+ '</td>';
								content += '<td>' + data[i]['content']+ '</td>';
								content += '<td>' + data[i]['tags']+ '</td>';
								content += '<td>' + data[i]['category_id']+ '</td>';
								content += '<td><button class="btn btn-xs btn-danger edit" id="' + data[i]['blog_id'] +'">Edit</button></td>';
								content += '<td><button class="btn btn-xs btn-danger delete"id="' + data[i]['blog_id'] +'">Delete</button></td>';
								content += '<td></td>';
								content += '</tr>';
								
							}
							$('#bloglist').html(content);
						}else{
							alert("Blog Bulunamadı..");
							window.location = "?op=blog-blog";
						}
					},
				});
			}else{
				alert("En az 3 karakter giriniz..");
				return false;
				}
		});
		return false;
	});
	
</script>