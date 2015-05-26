<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(__DIR__.'/controlador.php');

class controlador_usuarios extends controlador 
{

	public function alta()
	{
		//Obtencion de todas las provincias para crear el select
		$provincias['provincias'] = $this->mod_provincias->lista_provincias();
		
		//Establecimiento de las reglas de validación
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
		$this->form_validation->set_rules('apellidos', 'apellidos', 'trim|required');
		$this->form_validation->set_rules('dni', 'dni', 'trim|required|exact_length[9]|callback_DNI_valido');
		$this->form_validation->set_rules('direccion', 'direccion', 'trim|required');
		$this->form_validation->set_rules('postal', 'código postal', 'trim|required|integer|exact_length[5]');
		$this->form_validation->set_rules('poblacion', 'poblacion', 'required|max_length[20]|xss_clean|alpha|trim');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|callback_comprobar_nombre');
		$this->form_validation->set_rules('email', 'email', 'required|max_length[45]|valid_email|xss_clean|trim');
		
		//Edición de los mensajes de error
		$this->form_validation->set_message('required', 'Error. Campo Requerido');
		$this->form_validation->set_message('exact_length', 'Error. El DNI debe tener nueve dígitos');
		$this->form_validation->set_message('valid_email', 'Error. Email no válido');
		$this->form_validation->set_message('max_length', 'Error. Campo demasiado largo');
		$this->form_validation->set_message('alpha', 'Error. El campo no puede contener números');
		$this->form_validation->set_message('integer', 'Error. El campo solo puede contener números');
		$this->form_validation->set_message('DNI_valido', 'Error. DNI no válido');
		$this->form_validation->set_message('comprobar_nombre', 'Error. Nombre de usuario ya usado');
		
		//da formato a los errores
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		if ($this->form_validation->run() == TRUE)
		{
			$datos['nombre'] = $this->input->post('nombre');
			$datos['apellidos'] = $this->input->post('apellidos');
			$datos['dni'] = $this->input->post('dni');
			$datos['direccion'] = $this->input->post('direccion');
			$datos['cod_postal'] = $this->input->post('postal');
			$datos['cod_provincia'] = $this->input->post('select_provincias');
			$datos['poblacion'] = $this->input->post('poblacion');
			$datos['usuario'] = $this->input->post('usuario');
			$datos['correo'] = $this->input->post('email');
			$datos['clave'] = do_hash($this->input->post('password'),'md5');
			
			$this->mod_usuarios->alta_usuario($datos);
			
			//$categoria['categoria'] = $this->mod_productos->listar_categorias();
			
			//$cabecera= $this->load->view("cabecera",$categoria, true);
			
			//$pie= $this->load->view("pie", 0, true);
			
			$cuerpo=$this->load->view('alta_exito',0,true);
			
			$this->Plantilla($cuerpo);
			
			//redirect(site_url());
		}
		else
		{
			//$categoria['categoria'] = $this->mod_productos->listar_categorias();
	
			//$cabecera= $this->load->view("cabecera",$categoria, true);
	
			//$pie= $this->load->view("pie", 0, true);
		
			$cuerpo=$this->load->view('alta_usuario',$provincias,true);
	
			$this->Plantilla($cuerpo);
		}
	}
		
		
		/**
		 * Valida el campo DNI
		 * @param unknown $str
		 * @return boolean
		 */
		public function DNI_valido($str) 
		{
			$str = trim($str);
			$str = str_replace("-", "", $str);
			$str = str_ireplace(" ", "", $str);
			if (!preg_match("/^[0-9]{7,8}[a-zA-Z]{1}$/", $str)) 
			{
				return FALSE;
			} else 
			{
				$n = substr($str, 0, -1);
				$letter = substr($str, -1);
				$letter2 = substr("TRWAGMYFPDXBNJZSQVHLCKE", $n % 23, 1);
				if (strtolower($letter) != strtolower($letter2))
					return FALSE;
			}
			return TRUE;
		}
		
		public function login()
		{
			//Establecimiento de las reglas de validación
			$this->form_validation->set_rules('clave', 'clave', 'trim|md5');
			$this->form_validation->set_rules('usu', 'usu', 'trim');
			
			if ($this->form_validation->run() == TRUE)
			{
				$usuario = $this->input->post('usu');
				$clave = $this->input->post('clave');
				
				if ($this->mod_usuarios->login($usuario, $clave) == true)
				{
					
					//Usuario logueado correctamente
					//Inicio de sesión
					$this->session->set_userdata('user',$usuario);
					$this->session->set_userdata('logueado',true);
					
					redirect(base_url());
				}
				else
				{
					redirect(base_url());
					
					
				}
				
					
			}
			
		}
		
		public function mod_usuario()
		{
			$usuario=$this->session->userdata('user');
			
			//print_r($usuario);
			
			//Obtencion de todas las provincias para crear el select
			$datos['provincias'] = $this->mod_provincias->lista_provincias();
			
			//print_r($this->mod_usuarios->buscar_usuario($usuario)[0]);
			
			$datos['user']=$this->mod_usuarios->buscar_usuario($usuario)[0];
			
			//Establecimiento de las reglas de validación
			$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
			$this->form_validation->set_rules('apellidos', 'apellidos', 'trim|required');
			$this->form_validation->set_rules('dni', 'dni', 'trim|required|exact_length[9]|callback_DNI_valido');
			$this->form_validation->set_rules('direccion', 'direccion', 'trim|required');
			$this->form_validation->set_rules('postal', 'código postal', 'trim|required|integer|exact_length[5]');
			$this->form_validation->set_rules('poblacion', 'poblacion', 'required|max_length[20]|xss_clean|alpha|trim');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
			$this->form_validation->set_rules('usuario', 'usuario', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'required|max_length[45]|valid_email|xss_clean|trim');
			
			//Edición de los mensajes de error
			$this->form_validation->set_message('required', 'Error. Campo Requerido');
			$this->form_validation->set_message('exact_length', 'Error. El DNI debe tener nueve dígitos');
			$this->form_validation->set_message('valid_email', 'Error. Email no válido');
			$this->form_validation->set_message('max_length', 'Error. Campo demasiado largo');
			$this->form_validation->set_message('alpha', 'Error. El campo no puede contener números');
			$this->form_validation->set_message('integer', 'Error. El campo solo puede contener números');
			$this->form_validation->set_message('DNI_valido', 'Error. DNI no válido');
			//$this->form_validation->set_message('comprobar_nombre', 'Error. Nombre de usuario ya usado');
			
			//da formato a los errores
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			
			if ($this->form_validation->run() == TRUE)
			{
				$cod_usuario=$this->input->post('cod_usuario');
				$user['nombre'] = $this->input->post('nombre');
				$user['apellidos'] = $this->input->post('apellidos');
				$user['dni'] = $this->input->post('dni');
				$user['direccion'] = $this->input->post('direccion');
				$user['cod_postal'] = $this->input->post('postal');
				$user['cod_provincia'] = $this->input->post('select_provincias');
				$user['poblacion'] = $this->input->post('poblacion');
				$user['usuario'] = $this->input->post('usuario');
				$user['correo'] = $this->input->post('email');
				$user['clave'] = do_hash($this->input->post('password'),'md5');
				
				if($this->mod_usuarios->modificar_usuario($cod_usuario,$user))
				{
					$cuerpo=$this->load->view('mod_exito',0,true);
					
					$this->Plantilla($cuerpo);
				} 
					
				
					
				//$categoria['categoria'] = $this->mod_productos->listar_categorias();
					
				//$cabecera= $this->load->view("cabecera",$categoria, true);
					
				//$pie= $this->load->view("pie", 0, true);
					
				
					
				//redirect(site_url());
			}
			else
			{
				//$categoria['categoria'] = $this->mod_productos->listar_categorias();
			
				//$cabecera= $this->load->view("cabecera",$categoria, true);
			
				//$pie= $this->load->view("pie", 0, true);
			
				$cuerpo=$this->load->view('mod_usuario',$datos,true);
			
				$this->Plantilla($cuerpo);
			}
		}
		
		//Funcion que comprueba por un callback si el nombre de usuario que se introduce en el
		//formulario de registro existe en la bd, en tal caso, muestra un mensaje de error
		public function comprobar_nombre($nombre)
		{
		
			$usuario = $this->mod_usuarios->existe_nombre_user($nombre);
		
			if ($usuario)
			{
				//$this->form_validation->set_message('comprobarNombre', 'El nombre de usuario ya esta en uso, pruebe otro diferente');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		
		public function dar_baja()
		{
			$usuario=$this->session->userdata('user');
			
			$datos['usuario']=$this->mod_usuarios->existe_nombre_user($usuario);
			
			//print_r($datos);
			
			$cuerpo=$this->load->view('dar_baja',$datos,true);
			
			$this->Plantilla($cuerpo);
			
		}
		
		public function baja_user($cod)
		{
			$this->mod_usuarios->baja_user($cod);
			
			//Al borrar el usuario (ponerlo no activo) cerramos la sesión de dicho usuario
			$this->logout();
		}
		
		public function logout()
		{
			$this->session->unset_userdata('user'); //cierre de sesión
			$this->session->set_userdata('logueado',false); //cierre de sesión
			redirect(site_url());
		}

}