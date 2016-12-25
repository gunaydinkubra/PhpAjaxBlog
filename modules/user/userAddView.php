<form id="saveUser" name="saveUser" >
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
			<input class="btn btn-default" type="submit" name="save" id="save" />
		</div>
		<div class="col-md-4"></div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#saveUser').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "index.php?op=user-save",
				type: "POST",
				dataType: "json",
				data:{
					email: $('#email').val(),
					pass :$('#pass').val(),
					name: $('#name').val(),
					surname: $('#surname').val(),
				},
				success: function(data){
					if(data != 0 ){
						alert("Kullanıcı Bilgileri Oluşturuldu.");
						 window.location = '?op=user-user';	
					}else{
					console.log(data);
					}
				},
			});
			return false;	
		});
		
	});
</script>