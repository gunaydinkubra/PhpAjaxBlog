<form  id="userCheck" class="form-inline method="POST" >
	<div class="col-md-12 marginTop200"></div>
	<div class="col-md-6 col-md-offset-4">
		<h2>Lütfen Giriş Yapınız</h2>
		<div class="form-group">
			<label class="sr-only" for="exampleInputEmail3">Email address</label>
			<input type="email" class="form-control" id="email" placeholder="Email">
		  </div>
		  <div class="form-group">
			<label class="sr-only" for="exampleInputPassword3">Password</label>
			<input type="password" class="form-control" id="pass" placeholder="Password">
		  </div>
		  <button type="submit" class="btn btn-default">Sign in</button>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#userCheck').submit(function(e){
			e.preventDefault();	
			
			$.ajax({
				url: "index.php?op=user-check",
				type: "POST",
				dataType: "json",
				data:{
					email: $('#email').val(),
					pass : $('#pass').val(),
				},
				success: function(data){
					//console.log(data);
					if(data != null){
						alert("Başarılı..");
						window.location = '?op=user-user';
                    }else{
                        
						 alert("Kullanıcı Bulunamadı..");
                    }
					
				}
			});
			return false;
		});
	});
</script>
