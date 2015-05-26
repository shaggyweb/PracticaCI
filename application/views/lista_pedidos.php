<div class="alert alert-info">
		<div class="titulo"><?="Lista de Pedidos"?></div>
</div>
<div name="pedidos">
	<table class="table table-hover">
		<tr><th>Cod.Pedido</th><th>Nombre</th><th>Apellidos</th><th>Fecha</th><th>Estado</th><th>Direccion</th><th>Poblacion</th></tr>
        
			<?php foreach ($pedidos as $pedido) : ?>
			<tr>
            	<td><?= $pedido['cod_pedido'] ?></td>
            	<td><?= $pedido['nombre_cliente'] ?></td>
            	<td><?= $pedido['apellidos_cliente'] ?></td>
            	<td><?= $pedido['fecha'] ?></td>
            	<td><?= $pedido['estado'] ?></td>
            	<td><?= $pedido['direccion'] ?></td>
            	<td><?= $pedido['poblacion'] ?></td>
            	<td><a href="<?= site_url('controlador_carrito/anular_pedido/'. $pedido['cod_pedido'])?>"><img src="<?= base_url('/Assets/img/icono_eliminar.png')?>"/></a></td>
            	<td><a href="<?= site_url('controlador_carrito/crear_factura/'. $pedido['cod_pedido'])?>"><img src="<?= base_url('/Assets/img/icono_sumar.png')?>"/></a></td>
           
        	</tr>
        	
			<?php endforeach; ?>
			<tr>
        		
				<td align="center">
					<a href="<?=site_url()?>" class="btn btn-primary" role="button">Volver</a>
				</td>
			</tr>
	</table>
</div>
