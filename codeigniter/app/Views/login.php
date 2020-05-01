<?php echo view('componentes/navbar'); ?>
<form id="login" method="post" action="<?=site_url("Login/autenticar");?>" style="margin-top:70px;">
	<div class="container row pt-5 m-auto" >
		<div class="col-md-4	 m-auto card p-4">
			<div class="row text-center">
				<div class="col-md-12">
					<h4>Login</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p>E-mail</p>
					<input type="email" class="form-control" name="email" >
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12">
					<p>Senha</p>
					<input type="password" class="form-control" name="senha"  >
				</div>
			</div>
			<div class="row mt-4">	
				<div class="pr-3 ml-auto">
						<input type="submit" name="logar" value="Entrar">				
				</div>			
			</div>
		</div>
	</div>
</form>
