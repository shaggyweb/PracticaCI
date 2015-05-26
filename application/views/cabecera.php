<div>
	<div class="jumbotron" style="background-image: url(<?= base_url('/Assets/img/fondo4.jpg')?>); background-size: 100%; color: white">

   			<h1>TECNONUBA</h1>
        
    </div>
	<p></p>
	<div name="categorias">
		<nav class="navbar navbar-inverse" role="navigation">
			 <ul class="nav navbar-nav">
			 	<li><a href="<?=site_url()?>">INICIO</a></li>
			    <?php foreach ($categoria as $categ) : ?>
				
					
					<li><a href="<?= site_url('/controlador_productos/productos_categoria/'.$categ['id_cat'])?>"><?=$categ['nombre']?></a></li>
					
				<?php endforeach; ?>
				<li><a href="<?=base_url('index.php/controlador_carrito/ver_carrito')?>"><img src="<?= base_url('/Assets/img/carrito2.png')?>"/></a></li>
				<li><a href="<?=site_url("controlador_usuarios/alta");?>">Nuevo Usuario</a></li>
			</ul>
		</nav>
	</div>
	<div name="form_ingreso">
		<nav class="navbar navbar-default" role="navigation">
			<form  class="navbar-form navbar-left" method="post" action="<?=base_url('index.php/controlador_usuarios/login')?>">
				<table>
					<tr>
						<td>Usuario: </td><td><input type="text" class ="form-control" name="usu" value="<?php echo set_value('usu'); ?>"/>
							<?php echo form_error('usu'); ?></td>
						<td>Clave: </td><td><input type="password" class ="form-control" name="clave" value="<?php echo set_value('clave'); ?>"/>
							<?php echo form_error('clave'); ?></td>
						<td><input type="submit" class="btn btn-primary" name="enviar" value="Ingresar"/></td>
					</tr>
				</table>
			</form>
		</nav>
	</div>
</div>
