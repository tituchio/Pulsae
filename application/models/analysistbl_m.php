<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analysistbl_m extends MY_Model {
	
	public $_table = 'ANALYSISTBL';
	public $primary_key = 'OID';
	
	public function test(){
		$this->db->get('ANALYSISTBL');
	}
	
}
