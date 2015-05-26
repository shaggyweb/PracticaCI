<?php foreach ($productos as $producto) :?>
<div class="panel panel-default">
	<div class="panel-heading"><h1><?=$producto['nombre']?></h1>
		<h2><?=$producto['anuncio']?></h2>
	</div>
  		<div class="panel-body">
  			<table>
  				<tr>
  					<td>
   						<img src="<?= base_url('/Assets/img/'.$producto['imagen'])?>"/>
   					</td>
   					<td>
   						<?=$producto['descripcion']?>
   					</td>
   				</tr>
   			</table>
 		</div>
 	<div class="panel-footer">
 		<form name="carrito" method="post" action="<?=base_url('index.php/controlador_carrito/anadir')?>">
			<table>
  				<tr>
  					<input type="hidden" name="id_prod" value="<?=$producto['id_prod']?>"/>
  					<td><?=$producto['precio']." Euros | Descuento "?></td>
  					<td class="descuento"><?=" -".$producto['descuento']. " Euros"?></td>
  				  	<td><input type="submit" class="btn btn-primary" name="anadir" value="Agregar al Carro"/></td>
  				</tr>
  			</table>
  		</form>
 	</div>
 </div>
 <?php endforeach;?>
