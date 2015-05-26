<form method="post" action="<?=base_url('index.php/controlador_usuarios/mod_usuario')?>">
	<input type="hidden" name="cod_usuario" value="<?=$user['cod_usuario']?>">
	<table>
		<tr>
			<td>Nombre: </td><td><input type="text"  class ="form-control" name="nombre" value="<?=set_value('nombre', $user['nombre']); ?>"/>
			</td><td><?php echo form_error('nombre'); ?></td>
		</tr>
		<tr>
			<td>Apellidos: </td><td><input type="text" class ="form-control" name="apellidos" value="<?=set_value('apellidos', $user['apellidos']); ?>"/>
			</td><td><?php echo form_error('apellidos'); ?></td>
		</tr>
		<tr>
			<td>DNI: </td><td><input type="text" class ="form-control" name="dni" size="9" maxlength="9" value="<?=set_value('dni', $user['dni']); ?>"/>
			</td><td><?php echo form_error('dni'); ?></td>
		</tr>
		<tr>
			<td>Direccón: </td><td><input type="text" class ="form-control" name="direccion" value="<?=set_value('direccion', $user['direccion']); ?>"/>
			</td><td><?php echo form_error('direccion'); ?></td>
		</tr>
		<tr>
			<td>Código Postal: </td><td><input type="text" class ="form-control" name="postal" size="5" maxlength="5" value="<?=set_value('postal', $user['cod_postal']); ?>"/>
			</td><td><?php echo form_error('postal'); ?></td>
		</tr>
		<tr>
			<td>Provincia: </td><td><?=form_dropdown('select_provincias', $provincias, set_value('select_provincias',$user['cod_provincia']));?></td>
		</tr>
		<tr>
			<td>Población: </td><td><input type="text" class ="form-control" name="poblacion" value="<?=set_value('poblacion', $user['poblacion']); ?>"/>
			</td><td><?php echo form_error('poblacion'); ?></td>
		</tr>
		<tr>
			<td>Usuario: </td><td><input type="text" class ="form-control" name="usuario" value="<?=set_value('usuario', $user['usuario']); ?>"/>
			</td><td><?php echo form_error('usuario'); ?></td>
		</tr>
		<tr>
			<td>Contraseña: </td><td><input type="password" class ="form-control" name="password" value="<?=set_value('password', $user['clave']); ?>"/>
			</td><td><?php echo form_error('password'); ?>
			</td>
		</tr>
		<tr>
			<td>E-Mail: </td><td><input type="text" class ="form-control" name="email" value="<?=set_value('email', $user['correo']); ?>"/>
			</td><td><?php echo form_error('email'); ?></td>
		</tr>
		<tr><td><input type="submit" class="btn btn-primary" name="enviar" value="Modificar"/></td></tr>
	</table>
</form>
