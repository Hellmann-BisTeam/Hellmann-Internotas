<!--<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>vista Persona</h1>
<form action="<?php echo base_url(); ?>Cpersona/guardar" method="POST">
	<table>
		
		<tr>
			<td><label>usuario</label></td>
			<td><input type="text" name="txtUsuario"></td>
		</tr>
		<tr>
			<td><label>Password</label></td>
			<td><input type="password" name="txtClave"></td>
		</tr>

		<tr>
			<td colspan="2"><input type="submit" value="Guardar"></td>
		</tr>
	</table>
</form>
<a href="<?php echo base_url();?>Cusuario/vista_reg">logear</a>
</body>
</html>-->
<div class="col-md-12">
  <br>
  <br>

</div>
<div class="row">
  <div class="col-md-2" >
    <br>
    <br>

  </div>
  <div class="col-md-9" >
      
              <div class="card card-primary">
                <div 2 class="card-title">Usuario Nuevo</h2>
                </div>
                <form role="form" action="<?php echo base_url(); ?>index.php/Cusuario/guardar_usu" method="POST">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Usuario</label>
                      <input type="text" class="form-control" id="txtUsuario"  name="txtUsuario" placeholder="Usuario 1" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Contraseña</label>
                      <input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Password" required>
                    </div>
                    
                    
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" value="Registrar">Registrar</button>
                  </div>
                </form>
          </div>
   </div>	
</div>