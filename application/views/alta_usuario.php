<div class="alert alert-info">
		<div class="titulo"><?="Nuevo Usuario"?></div>
</div>
<div>
<form method="post" action="<?=base_url('index.php/controlador_usuarios/alta')?>">
	<table>
		<tr>
			<td>Nombre: </td><td><input type="text"  class ="form-control" name="nombre" value="<?php echo set_value('nombre'); ?>"/>
			</td><td><?php echo form_error('nombre'); ?></td>
		</tr>
		<tr>
			<td>Apellidos: </td><td><input type="text" class ="form-control" name="apellidos" value="<?php echo set_value('apellidos'); ?>"/>
			</td><td><?php echo form_error('apellidos'); ?></td>
		</tr>
		<tr>
			<td>DNI: </td><td><input type="text" class ="form-control" name="dni" size="9" maxlength="9" value="<?php echo set_value('dni'); ?>"/>
			</td><td><?php echo form_error('dni'); ?></td>
		</tr>
		<tr>
			<td>Dirección: </td><td><input type="text" class ="form-control" name="direccion" value="<?php echo set_value('direccion'); ?>"/>
			</td><td><?php echo form_error('direccion'); ?></td>
		</tr>
		<tr>
			<td>Código Postal: </td><td><input type="text" class ="form-control" name="postal" size="5" maxlength="5" value="<?php echo set_value('postal'); ?>"/>
			</td><td><?php echo form_error('postal'); ?></td>
		</tr>
		<tr>
			<td>Provincia: </td><td><?=form_dropdown('select_provincias', $provincias, set_value('select_provincias'));?></td>
		</tr>
		<tr>
			<td>Población: </td><td><input type="text" class ="form-control" name="poblacion" value="<?php echo set_value('poblacion');?>"/>
			</td><td><?php echo form_error('poblacion'); ?></td>
		</tr>
		<tr>
			<td>Usuario: </td><td><input type="text" class ="form-control" name="usuario" value="<?php echo set_value('usuario');?>"/>
			</td><td><?php echo form_error('usuario'); ?></td>
		</tr>
		<tr>
			<td>Contraseña: </td><td><input type="password" class ="form-control" name="password" value="<?php echo set_value('password');?>"/>
			</td><td><?php echo form_error('password'); ?>
			</td>
		</tr>
		<tr>
			<td>E-Mail: </td><td><input type="text" class ="form-control" name="email" value="<?php echo set_value('email');?>"/>
			</td><td><?php echo form_error('email'); ?></td>
		</tr>
		<tr><td><input type="submit" class="btn btn-primary" name="enviar" value="Enviar"/></td></tr>
	</table>
</form>
</div>