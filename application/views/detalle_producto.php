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
	<table>
  		<tr>
  			<td><?=$producto['precio']." Euros | Descuento "?></td>
  			<td class="descuento"><?=" -".$producto['descuento']. " Euros"?></td>
  			<td><img src="<?= base_url('/Assets/img/carrito2.png')?>"/></td>
  		</tr>
  	</table>
 </div>
 <?php endforeach;?>
