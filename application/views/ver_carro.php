<div class="alert alert-info">
		<div class="titulo"><?="Lista de Productos en carro de la compra"?></div>
</div>
<div name="productos">
	<table class="table table-hover">
		<tr><th>Producto</th><th>Precio Sin Descuento</th><th>Precio Descuento</th><th>Unidades</th></tr>
        
			<?php foreach ($productos as $producto) : ?>
			<tr>
            	<td><?= $producto['name'] ?></td>
            	<td><?= $producto['precio_no_descuento'] ?></td>
            	<td><?= $producto['price'] ?></td>
            	<td><?= $producto['qty'] ?></td>
            	<td><a href="<?= site_url('/controlador_carrito/sumar_uni_prod/'. $producto['rowid'].'/'.$producto['qty'])?>"><img src="<?= base_url('/Assets/img/icono_sumar.png')?>"/></a></td>
            	<td><a href="<?= site_url('/controlador_carrito/quitar_uni_prod/'. $producto['rowid'].'/'.$producto['qty'])?>"><img src="<?= base_url('/Assets/img/icono_restar.png')?>"/></a></td>
            	<td><a href="<?= site_url('/controlador_carrito/eliminar_prod/'. $producto['rowid'])?>"><img src="<?= base_url('/Assets/img/icono_eliminar.png')?>"/></a></td>
        	</tr>
        	
			<?php endforeach; ?>
			<tr>
        		
				<td align="center">
					<a href="<?=site_url('controlador_carrito/comprar')?>" class="btn btn-primary" role="button">Finalizar Compra</a>
				</td>
			</tr>
	</table>
</div>