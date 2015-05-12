<div class="lista_productos">
	<div class="alert alert-info">
		<div class="titulo"><?=$titulo?></div>
	</div>
	<table>
		<tr>
			<?php foreach ($productos as $producto) :?>
			<td>
			<div class="panel panel-default">
				<div class="panel-heading"><?=$producto['nombre']?></div>
  				<div class="panel-body">
  					<table>
  						<tr>
  							<td>
   								<img src="<?= base_url('/Assets/img/'.$producto['imagen'])?>"/>
   							</td>
   							<td>
   								<?=$producto['anuncio']?>
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
  							<td><a href="<?=base_url('index.php/controlador_productos/mostrar_detalles/'.$producto['id_prod'])?>">Ver detalles</a></td>
  						</tr>
  					</table>
  				</div>
  			</div>
  			</td>
  			<?php endforeach;?>	
		</tr>
	</table>
	</div>
	<?=$paginador?>		
</div>