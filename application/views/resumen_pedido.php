<div name="resumen">
	<div class="panel panel-success">
		<div class="panel-heading">
			<table class="table table-hover">
				<tr><th align="center">Resumen del pedido N-<?=" ".$pedido[0]['cod_pedido']?></th></tr>
				<tr>
					<td><?="CLIENTE: ".$pedido[0]['nombre_cliente']." ".$pedido[0]['apellidos_cliente']." |DNI: ".$pedido[0]['dni']?></td>
				</tr>
				<tr>
					<td><?="DIRECCION: ".$pedido[0]['direccion']." |CODIGO POSTAL: ".$pedido[0]['cod_postal']." |POBLACION: ".$pedido[0]['poblacion']?></td>
				</tr>
				<tr>
					<td><?="FECHA: ".$fecha?></td>
				</tr>
			</table>
		</div>
		<div class="panel-body">
			<h3>LISTA PRODUCTOS</h3>
    		<table class="table table-hover">
    			<tr><th>Producto</th><th>Precio Sin Descuento</th><th>Precio Descuento</th><th>Unidades</th><th>Total</th></tr>
        
			<?php foreach ($productos as $producto) : ?>
			<tr>
            	<td><?= $producto['name'] ?></td>
            	<td><?= $producto['precio_no_descuento'] ?></td>
            	<td><?= $producto['price'] ?></td>
            	<td><?= $producto['qty'] ?></td>
            	<?php $tot=$producto['price']*$producto['qty']?>
            	<td><?= $tot?></td>
        	</tr>
        	
			<?php endforeach; ?>
			<tr>
				<td><?="TOTAL: ".$total?></td>
			</tr>
			<tr>
			<td align="center">
				<a href="<?=base_url()?>" class="btn btn-primary" role="button">Volver</a>
			</td>
		</tr>
    		</table>
  		</div>
	</div>
</div>