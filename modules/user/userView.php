<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-10">
		<div class="col-md-3">
			<input type="text"  id="search" name="search" class="input-sm"  placeholder="Search"/>
			<button class=" btn btn-sm btn-default" id="searchbtn">Search</button>
		</div><br><br>
		<div class="responsive-table" id="userlist"></div>
		
	</div>
	<div class="col-md-2" ></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: "?op=user-getUserList",
			type: "POST",
			dataType: "json",
			success:function(data){
				//if(data.length>0){
					var content = '<table class="table">';
					content += '<tr>';
					content += '<th>user_id</th>';
					content += '<th>Name</th>';
					content += '<th>Surname</th>';
					content += '<th>E-mail</th>';
					content += '<th>Password</th>';
					content += '<th></th>'
					content += '<th><a href="?op=user-createUser"><button class="btn btn-md btn-default">New User</button></a></th>'
					content += '<th></th>'
					content += '</tr>';
					for(var i=0; i<data.length; i++){
						content += '<tr>';
						content += '<td id="id">' + data[i]['user_id']+ '</td>';
						content += '<td>' + data[i]['name']+ '</td>';
						content += '<td>' + data[i]['surname']+ '</td>';
						content += '<td>' + data[i]['email']+ '</td>';
						content += '<td>' + data[i]['pass']+ '</td>';
						content += '<td><button class="btn btn-xs btn-danger edit" id="' + data[i]['user_id'] +'">Edit</button></td>';
						content += '<td><button class="btn btn-xs btn-danger delete" id="' + data[i]['user_id'] + '">Delete</button></td>';
						content += '<td></td>';
						content += '</tr>';
						
					}
					content += '</table>';
					$('#userlist').html(content);
					console.log(data);
					
				//}
			},
		});
		
		
		$(document).on('click','.delete',function(){
			//console.log("dihlandi");
			  var user_id = $(this).attr("id");
			$.ajax({
				url : "?op=user-delete" ,
				type : "POST",
				dataType: "json",
				data : {user_id: user_id},
				success: function(data){
					if(data != 0){
					alert("Kayıt Silindi");
					window.location = "?op=user-user";
					}else{
						alert("İşlem Başarısız");
					}
				}
			});
		});	
			
		$(document).on('click','.edit',function(){
			var ID = $(this).attr("id");
			window.location = "?op=user-userEdit&user_id=" +ID;
		});
		
		$(document).on('click','#searchbtn',function(){
			//console.log("tıkk");
			$.ajax({
				url:  "?op=user-search",
				type:  "POST",
				dataType: "json",
				data: {search: $('#search').val()
				},
				success:function(data){
					if(data.length>0){
						var content = '<table class="table">';
						content += '<tr>';
						content += '<th>user_id</th>';
						content += '<th>Name</th>';
						content += '<th>Surname</th>';
						content += '<th>E-mail</th>';
						content += '<th>Password</th>';
						content += '<th></th>'
						content += '<th><a href="?op=user-createUser"><button class="btn btn-md btn-default">New User</button></a></th>'
						content += '<th></th>'
						content += '</tr>';
							for(var i=0; i<data.length; i++){
							content += '<tr>';
							content += '<td id="id">' + data[i]['user_id']+ '</td>';
							content += '<td>' + data[i]['name']+ '</td>';
							content += '<td>' + data[i]['surname']+ '</td>';
							content += '<td>' + data[i]['email']+ '</td>';
							content += '<td>' + data[i]['pass']+ '</td>';
							content += '<td><button class="btn btn-xs btn-danger edit" id="' + data[i]['user_id'] +'">Edit</button></td>';
							content += '<td><button class="btn btn-xs btn-danger delete" id="' + data[i]['user_id'] + '">Delete</button></td>';
							content += '<td></td>';
							content += '</tr>';
							}
						$('#userlist').html(content);
					}
					console.log(data);
				},
			});
		});
		
		return false;
	});
	
					
	
	
</script>