<div class="alert alert-info">
		<div class="titulo"><?="Reestablecer Password"?></div>
</div>
<div name="form_email">
	<form method="post" action="<?=base_url('index.php/controlador_usuarios/reestablecer_pass')?>">
	<table>
		<tr>
			<td>Introduzca su email: </td><td><input type="text"  class ="form-control" name="email" value="<?php echo set_value('email'); ?>"/>
			</td><td><?php echo form_error('email'); ?></td>
		</tr>
		<tr><td><input type="submit" class="btn btn-primary" name="enviar" value="Enviar"/></td></tr>
	</table>
</form>
	
</div>
