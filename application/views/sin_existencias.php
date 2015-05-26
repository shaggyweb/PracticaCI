<div class="alert alert-warning">
	<div class="panel-heading">Las existencias de los siguientes productos no son suficientes</div>
		<div class="panel-body">
			<table class="table table-hover">
				<tr>
					<th>Producto</th><th>Unidades Introducidas</th>
				</tr>
				<?php foreach ($productos as $producto) : ?>
				<tr>
					<td>
						<?=$producto['name']?>
					</td>
					<td>
						<?=$producto['qty']?>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
		</div>
		<div class="panel-footer">
			<a href="<?=site_url('controlador_carrito/ver_carrito')?>" class="btn btn-primary" role="button">Volver a Carrito</a>
		</div>
</div>
