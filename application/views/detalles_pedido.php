<div name="resumen">
	<div class="panel panel-success">
		<div class="panel-heading">
			<table class="table table-hover">
				<tr><th align="center">Resumen del pedido N-<?=" ".$productos[0]['cod_pedido']?></th></tr>
			</table>
		</div>
		<div class="panel-body">
			<h3>LISTA PRODUCTOS</h3>
    		<table class="table table-hover">
    			<tr><th>Producto</th><th>Precio</th><th>Descuento Incluido</th><th>IVA Incluido</th><th>Unidades</th><th>Total</th></tr>
        	<?php $total=0?>
			<?php foreach ($productos as $producto) : ?>
			<tr>
            	<td><?= $producto['nombre'] ?></td>
            	<td><?= $producto['precio'] ?></td>
            	<td><?= $producto['descuento'] ?></td>
            	<td><?= $producto['iva']."%" ?></td>
            	<td><?= $producto['cantidad'] ?></td>
            	<?php $tot=$producto['precio']*$producto['cantidad']?>
            	<td><?= $tot?></td>
            	<?php $total+=$tot?>
        	</tr>
        	
			<?php endforeach; ?>
			<tr>
				<td><?="TOTAL: ".$total?></td>
			</tr>
			<tr>
			<td align="center">
				<a href="<?=site_url('controlador_carrito/mostrar_pedidos')?>" class="btn btn-primary" role="button">Lista Pedidos</a>
			</td>
		</tr>
    		</table>
  		</div>
	</div>
</div>
