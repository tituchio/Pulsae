<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends MX_Controller {

	public function __construct(){
		$this->template->set_layout('pulsae');
	}
	
	public function index()
	{
		$this->template->build('cara-beli');
	}
	
}

/* End of file frontend.php */