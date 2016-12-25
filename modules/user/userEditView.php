<form id="updateUser" name="updateUser">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<label class="control-lbl">Name</label>
			<input class="form-control" type="text" name="name" id="name" placeholder="Name" />
			<label class="control-lbl">Surname</label>
			<input class="form-control" type="text" name="surname" id="surname" placeholder="Surname" />
			<label class="control-lbl">E-Mail</label>
			<input class="form-control" type="text" name="email" id="email" placeholder="E-Mail" />
			<label class="control-lbl">Password</label>
			<input class="form-control" type="text" name="pass" id="pass" placeholder="Pasword" /><br>
			<input class="btn btn-default" type="submit" name="update" id="update" value="UPDATE" />
		</div>
		<div class="col-md-4"></div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		var id = <?php echo $_GET['user_id']; ?>;
		//console.log(id);
		$.ajax({
			url:"?op=user-edit",
			dataType:"json",
			type:"POST",
			data:{user_id:id},
			success:function(data){
				//console.log(data);
				$('#name').val(data['name']);
				$('#surname').val(data['surname']);
				$('#email').val(data['email']);
				$('#pass').val(data['pass']);
			},
		});
		
		$('#update').click(function(e){
			e.preventDefault();
			$.ajax({
				url:"?op=user-update",
				dataType:"json",
				type:"POST",
				data:{
					user_id: id,
					name: $('#name').val(),
					surname:$('#surname').val(),
					email: $('#email').val(),
					pass: $('#pass').val(),
					},
				success:function(data){
					console.log(data);
					if(data !=0 ){
						alert("Kayıt Güncellendi");
						window.location ="?op=user-user";
					}else{
						alert("İşlem Başarısız");
					}
				},
			});
			
		});
		return false;
	});
</script>