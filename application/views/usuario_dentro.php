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
				<li><a href="<?=site_url("/controlador_usuarios/alta");?>">Nuevo Usuario</a></li>
			</ul>
		</nav>
	</div>
	<div name="panel_usuer" class="panel_user">
		<div>
			<nav class="navbar navbar-default" role="navigation">
			 <ul class="nav navbar-nav">
			 	<li class="mensaje_user">
			 		<?="Bienvenido ".$this->session->userdata('user');?>
			 	</li>
			 	<li><a href="<?=site_url("controlador_usuarios/mod_usuario");?>">Modificar Datos</a></li>
			 	<li><a href="<?=site_url("controlador_usuarios/dar_baja");?>">Dar Baja</a></li>
			 	<li><a href="<?=site_url("controlador_carrito/mostrar_pedidos");?>">Mostrar Pedidos</a></li>
			 	<li><a href="<?=site_url("controlador_usuarios/logout");?>">Cerrar</a></li>
			</ul>
		</nav>
		</div>
	</div>
</div>
