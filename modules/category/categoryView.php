<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-10">
		<div class="col-md-3">
			<input type="text"  id="search" name="search" class="input-sm"  placeholder="Search"/>
			<button class=" btn btn-sm btn-default" id="searchbtn">Search</button>
		</div><br><br>
		<div class="responsive-table" id="categorylist">
			
		</div>
	</div>
	<div class="col-md-2" ></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: "?op=category-getCategoryList",
			dataType: "json",
			type: "POST",
			success: function(data){
				//if(data.length>0){
					var content = '<table class="table ">';
					content += '<tr>';
					content += '<th>category_id</td>';
					content +=  '<th>category_name</th>';
					content +=   '<th></th>';
					content +=   '<th><a href="?op=category-createCategory"><button class="btn btn-md btn-default">New Category</button></a></th>';
					content +=   '<th></th>';
					for(i=0; i<data.length; i++){
						content += '<tr>';
						content += '<td>'+data[i]['category_id']+'</td>';
						content += '<td>' +data[i]['category_name']+'</td>';
						content += '<td><button class="btn btn-xs btn-danger delete" id="'+data[i]['category_id']+'">Delete</button></td>';
						content += '<td><button class="btn btn-xs btn-danger edit" id="'+data[i]['category_id']+'">Edit</button></td>';
						content += '<td></td>';
					}
					$('#categorylist').html(content);
				//}
			}
		});
		$(document).on('click', '.delete', function(){
			//console.log("delete");
			var category_id = $(this).attr("id");
			$.ajax({
				url:"?op=category-delete",
				dataType:"json",
				type:"POST",
				data:{ category_id: category_id},
				success: function(data){
					if(data !=0 ){
						alert("Kayıt silindi.");
						window.location ="?op=category-category";
					}else{
						alert("İşlem Başarısız..");
					}
				}
			});
		});
		
		$(document).on('click','.edit',function(){
			var ID = $(this).attr("id");
			window.location = "?op=category-categoryEdit&category_id=" +ID;
		});
		$(document).on('click','#searchbtn',function(){
			//console.log("tıkk");
			var search = $('#search').val();
			if(search.length >= 3){
				$.ajax({
					url:  "?op=category-search",
					type:  "POST",
					dataType: "json",
					data: {search: $('#search').val()
					},
					success:function(data){
						if(data.length>0){
							var content = '<table class="table ">';
							content += '<tr>';
							content += '<th>category_id</td>';
							content +=  '<th>category_name</th>';
							content +=   '<th></th>';
							content +=   '<th><a href="?op=category-createCategory"><button class="btn btn-md btn-default">New Category</button></a></th>';
							content +=   '<th></th>';
							for(i=0; i<data.length; i++){
								content += '<tr>';
								content += '<td>'+data[i]['category_id']+'</td>';
								content += '<td>' +data[i]['category_name']+'</td>';
								content += '<td><button class="btn btn-xs btn-danger delete" id="'+data[i]['category_id']+'">Delete</button></td>';
								content += '<td><button class="btn btn-xs btn-danger edit" id="'+data[i]['category_id']+'">Edit</button></td>';
								content += '<td></td>';
							}
							$('#categorylist').html(content);
						}else{
							alert("Kategori Bulunamadı..");
							window.location = "?op=category-category";
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