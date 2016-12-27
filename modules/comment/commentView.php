<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-10">
		<div class="col-md-3">
			<input type="text"  id="search" name="search" class="input-sm"  placeholder="Search"/>
			<button class=" btn btn-sm btn-default" id="searchbtn">Search</button>
		</div><br><br>
		<div class="responsive-table" id="commentlist">
			
		</div>
	</div>
	<div class="col-md-2" ></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url:"?op=comment-getCommentList",
			dataType:"json",
			type : "POST",
			success:function(data){
				//if(data.length>0){
					var content = '<table class="table">';
					content += '<tr>';
					content += '<th>comment_id</th>';
					content += '<th>content</th>';
					content += '<th></th>';
					content += '<th><a href="?op=comment-createComment"><button class="btn btn-md btn-default">New Comment</button></a></th>';
					content += '<th></th>';
					content += '<tr>';
					for(i=0;i<data.length; i++){
						content += '<tr>';
						content += '<td>' +data[i]['comment_id'] + '</td>';
						content += '<td>' +data[i]['content'] + '</td>';
						content += '<td><button class="btn btn-xs btn-danger edit" id="'+data[i]['comment_id']+'">Edit</button></td>';
						content += '<td><button class="btn btn-xs btn-danger delete" id="'+data[i]['comment_id']+'">Delete</button></td>';
						content += '<td></td>';
						content += '<tr>';
					}
					$('#commentlist').html(content);
				//}
				
			}
		});
		$(document).on('click','.delete', function(){
			
			var ID = $(this).attr("id");
			$.ajax({
				url:"?op=comment-delete",
				type:"POST",
				dataType:"json",
				data:{comment_id:ID},
				success:function(data){
					if(data != 0){
						alert("Kayıt Silme İşlemi Başarılı.");
						window.location = "?op=comment-comment";
					}else{
						alert("Kayıt Silme İşlemi Başarısız");
						window.location = "?op=comment-comment";
					}
				}
			});
		});
		
		$(document).on('click','.edit',function(){
			var ID = $(this).attr("id");
			window.location = "?op=comment-commentEdit&comment_id=" +ID;
		});
		
		$(document).on('click','#searchbtn',function(){
			//console.log("tıkk");
			var search = $('#search').val();
			if(search.length >= 3){
				$.ajax({
					url:  "?op=comment-search",
					type:  "POST",
					dataType: "json",
					data: {search: $('#search').val()
					},
					success:function(data){
						if(data.length>0){
							var content = '<table class="table">';
							content += '<tr>';
							content += '<th>comment_id</th>';
							content += '<th>content</th>';
							content += '<th></th>';
							content += '<th><a href="?op=comment-createComment"><button class="btn btn-md btn-default">New Comment</button></a></th>';
							content += '<th></th>';
							content += '<tr>';
							for(i=0;i<data.length; i++){
								content += '<tr>';
								content += '<td>' +data[i]['comment_id'] + '</td>';
								content += '<td>' +data[i]['content'] + '</td>';
								content += '<td><button class="btn btn-xs btn-danger edit" id="'+data[i]['comment_id']+'">Edit</button></td>';
								content += '<td><button class="btn btn-xs btn-danger delete" id="'+data[i]['comment_id']+'">Delete</button></td>';
								content += '<td></td>';
								content += '<tr>';
							}
							$('#commentlist').html(content);
						}else{
							alert("Yorum Bulunamadı..");
							window.location = "?op=comment-comment";
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