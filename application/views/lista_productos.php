<div class="lista_productos">
	<div class="titulo"><?=$titulo?></div>
	<?php foreach ($productos as $producto) :?>
		<h2><?=$producto['nombre']?></h2>
		<p><img src="<?= base_url('/Assets/img/'.$producto['imagen'])?>"/></p>
	<?php endforeach;?>	
	<?=$paginador?>		
</div>