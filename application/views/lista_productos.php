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
  						<form name="carrito" method="post" action="<?=base_url('index.php/controlador_carrito/anadir')?>">
  							<table>
  								<tr>
  									<input type="hidden" name="id_prod" value="<?=$producto['id_prod']?>"/>
  									<td><?=$producto['precio']." Euros | Descuento "?></td>
  									<td class="descuento"><?=" -".$producto['descuento']. " Euros"?></td>
  									<td><a href="<?=base_url('index.php/controlador_productos/mostrar_detalles/'.$producto['id_prod'])?>">Ver detalles</a></td>
    				  				<td><input type="submit" class="btn btn-primary" name="anadir" value="Agregar al Carro"/></td>
  									
  								</tr>
  								<tr><?php echo form_error('cantidad'); ?></tr>
  							</table>
  						</form>
  					</div>
  				</div>
  			</td>
  			<?php endforeach;?>	
		</tr>
	</table>
	<?=$paginador?>		
</div>