<form>
	<table>
		<tr>
			<td>Nombre: </td><td><input type="text" name="nombre" value="<?php echo set_value('nombre'); ?>"/></td>
		</tr>
		<tr>
			<td>Apellidos: </td><td><input type="text" name="apellidos" value="<?php echo set_value('apellidos'); ?>"/></td>
		</tr>
		<tr>
			<td>DNI: </td><td><input type="text" name="dni" size="9" maxlength="9" value="<?php echo set_value('dni'); ?>"/></td>
		</tr>
		<tr>
			<td>Direccón: </td><td><input type="text" name="direccion" value="<?php echo set_value('direccion'); ?>"/></td>
		</tr>
		<tr>
			<td>Código Postal: </td><td><input type="text" name="postal" size="5" maxlength="5" value="<?php echo set_value('postal'); ?>"/></td>
		</tr>
		<tr>
			<td>Provincia: </td><td><?=form_dropdown('select_provincias', $provincias, set_value('select_provincias'));?></td>
		</tr>
		<tr>
			<td>Población: </td><td><input type="text" name="poblacion" value="<?php echo set_value('poblacion');?>"/></td>
		</tr>
		<tr>
			<td>Usuario: </td><td><input type="text" name="usuario" value="<?php echo set_value('usuario');?>"/></td>
		</tr>
		<tr>
			<td>Contraseña: </td><td><input type="password" name="password" value="<?php echo set_value('usuario');?>"/></td>
		</tr>
		<tr><td><input type="submit" name="enviar" value="Enviar"/></td></tr>
	</table>
</form>
