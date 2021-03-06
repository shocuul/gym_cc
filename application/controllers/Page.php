<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$this->plan_model->where('tipo','promocion');
		$this->plan_model->limit(2);
		$this->data['ads'] = $this->plan_model->images()->result();
		$this->plan_model->where('tipo','galeria');
		$this->plan_model->limit(8);
		$this->data['gallery'] = $this->plan_model->images()->result();
		$this->_render('pages/index', $this->data);
	}

	public function menus(){
		$this->plan_model->where('tipo','menu');
		$this->data['images'] = $this->plan_model->images()->result();
		$this->_render('pages/menus', $this->data);
	}
}
