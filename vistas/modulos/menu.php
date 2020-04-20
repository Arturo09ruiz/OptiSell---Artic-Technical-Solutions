<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>
			<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>




			<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Monturas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="categorias">
							
							<i class="fa fa-circle-o"></i>
							<span>Categorias</span>

						</a>

					</li>

					<li>

						<a href="productos">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar Monturas</span>

						</a>

					</li>
				</ul>

				<li>

				<a href="cristales">

					<i class="fa fa-low-vision"></i>
					<span>Administrar Cristales</span>

				</a>







				<li class="treeview">

				

					
					<li>

						<a>
							
							<i class="fa fa-archive"></i>
							<span>Laboratorio Local</span>

						</a>

						<ul class="treeview-menu">
						<li>

						<a href="local">
							
							<i class="fa fa-circle-o"></i>
							<span>Pedidos de Cristales</span>

						</a>

					</li>

					<li>

						<a href="terminados">
							
							<i class="fa fa-circle-o"></i>
							<span>Cristales Terminados</span>

						</a>

					</li>
					<li>

						<a href="entregados">
							
							<i class="fa fa-circle-o"></i>
							<span>Cristales Entregados</span>

						</a>

					</li>
						</ul>


					</li>







					<li class="treeview">

				

					
					<li>

						<a>
							
							<i class="fa fa-flask"></i>
							<span>Laboratorios Externos</span>

						</a>


					

						<ul class="treeview-menu">

						<li>

						<a href="ingresarlaboratorios">
							
							<i class="fa fa-circle-o"></i>
							<span>Laboratorios</span>

						</a>

					</li>
						<li>

						<a href="pedidos">
							
							<i class="fa fa-circle-o"></i>
							<span>Pedidos de Cristales</span>

						</a>

					</li>

					<li>

						<a href="llegados">
							
							<i class="fa fa-circle-o"></i>
							<span>Cristales Llegados</span>

						</a>

					</li>
					<li>

						<a href="entre">
							
							<i class="fa fa-circle-o"></i>
							<span>Cristales Entregados</span>

						</a>

					</li>

						</ul>


					</li>

















	



			


		
		<li class="treeview">

				<a href="#">

					<i class="fa fa-shopping-bag"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>

					

					 <li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>';

					

				

				'</ul>

			</li>';

		
		}




		if($_SESSION["perfil"] == "Laboratorio"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

		




				<li class="treeview">

				

					
					<li>

						<a>
							
							<i class="fa fa-archive"></i>
							<span>Laboratorio Local</span>

						</a>

						<ul class="treeview-menu">
						<li>

						<a href="local">
							
							<i class="fa fa-circle-o"></i>
							<span>Pedidos de Cristales</span>

						</a>

					</li>

						</ul>


					</li>';








		
		}





		if($_SESSION["perfil"] == "Vendedor"){

			echo '<li>

			<a href="clientes">

				<i class="fa fa-users"></i>
				<span>Clientes</span>

			</a>

		</li>
		
		


		<li class="treeview">

				<a href="#">

					<i class="fa fa-shopping-bag"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>';

					

					

				

				'</ul>

			</li>
		


		
		';








		
		}




















		
		

































		?>

		</ul>

	 </section>

</aside>