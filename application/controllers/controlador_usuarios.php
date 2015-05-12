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
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|alpha');
		$this->form_validation->set_rules('apellidos', 'apellidos', 'trim|required|alpha');
		$this->form_validation->set_rules('dni', 'dni', 'trim|required|exact_length[9]|callback_DNI_valido');
		$this->form_validation->set_rules('direccion', 'direccion', 'trim|required');
		$this->form_validation->set_rules('postal', 'código postal', 'trim|required|integer|exact_length[5]');
		$this->form_validation->set_rules('poblacion', 'poblacion', 'required|max_length[20]|xss_clean|trim');
		$this->form_validation->set_rules('password', 'password', 'trim|required|md5');
		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'required|max_length[45]|valid_email|xss_clean|trim');
		
		//Edición de los mensajes de error
		$this->form_validation->set_message('required', 'Campo Requerido');
		$this->form_validation->set_message('exact_length', 'El DNI debe tener nueve dígitos');
		$this->form_validation->set_message('valid_email', 'Email no válido');
		$this->form_validation->set_message('max_length', 'Campo demasiado largo');
		$this->form_validation->set_message('alpha', 'El campo no puede contener números');
		$this->form_validation->set_message('integer', 'El campo solo puede contener números');
		$this->form_validation->set_message('DNI_valido', 'DNI no válido');
		
		//da formato a los errores
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
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
			$datos['clave'] = $this->input->post('password');
			
			$this->mod_usuarios->alta_usuario($datos);
			
			$categoria['categoria'] = $this->mod_productos->listar_categorias();
			
			$cabecera= $this->load->view("cabecera",$categoria, true);
			
			$pie= $this->load->view("pie", 0, true);
			
			$cuerpo=$this->load->view('alta_exito',0,true);
			
			$this->plantilla($cuerpo);
			
			//redirect(site_url());
		}
		else
		{
			$categoria['categoria'] = $this->mod_productos->listar_categorias();
	
			$cabecera= $this->load->view("cabecera",$categoria, true);
	
			$pie= $this->load->view("pie", 0, true);
		
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
			$this->form_validation->set_rules('usuario', 'usuario', 'trim');
			
			if ($this->form_validation->run() == TRUE)
			{
				$usuario = $this->input->post('usuario');
				$clave = $this->input->post('clave');
				
				if ($this->mod_usuarios->login($usuario, $clave) == true)
				{
					
					//Usuario logueado correctamente
					//Inicio de sesión
					$this->session->set_userdata('user',$usuario);
					
					redirect(base_url());
				}
				else
				{
					redirect(base_url());
					
					
				}
				
					
			}
			
		}
		
		public function logout()
		{
			$this->session->unset_userdata('user'); //cierre de sesión
			redirect(site_url());
		}

}