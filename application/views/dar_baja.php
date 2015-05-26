<div class="alert alert-warning">
	<table align="center">
		<tr>
			<td>
			Va a borrar el usuario<?=" ".$usuario[0]['nombre']?>
			</td>
		</tr>
			
		<tr>
			<td align="center">
				<a href="<?= site_url('controlador_usuarios/baja_user/'. $usuario[0]['cod_usuario'])?>" class="btn btn-success" role="button">SI</a>
				<a href="<?=base_url()?>" class="btn btn-danger" role="button">NO</a>
			</td>
		</tr>
		
	</table>
</div>

