<div>
	<p>Tecnonuba</p>
	<p><a href="<?=site_url("controlador_usuarios/alta");?>">Nuevo Usuario</a></p>
	<div name="categorias">
		<table border="1">
			<tr>
				<?php foreach ($categoria as $categ)
			
					echo "<td>".$categ['nombre']."</td>";
				?>
			</tr>
	</table>
	</div>
</div>
